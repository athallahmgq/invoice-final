<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function generateInvoiceNumber()
    {
        $yearMonth = Carbon::now()->format('ym');
        $prefix = 'JSGI-INV-' . $yearMonth . '-';
        $lastInvoice = Invoice::where('invoice_number', 'LIKE', $prefix . '%')
                            ->orderBy('invoice_number', 'desc')
                            ->first();
        $nextNumber = 1;
        if ($lastInvoice) {
            $lastNumStr = substr($lastInvoice->invoice_number, strlen($prefix));
            $nextNumber = intval($lastNumStr) + 1;
        }
        return $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $invoices = Invoice::where('user_id', Auth::id())->orderBy('submit_date', 'desc')->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $invoiceNumber = $this->generateInvoiceNumber();
        return view('invoices.create', compact('invoiceNumber'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:100',
            'delivery_date' => 'required|date',
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'details' => 'required|array|min:1',
            'details.*.coil_number' => 'required|string|max:50',
            'details.*.width' => 'required|numeric|min:0',
            'details.*.length' => 'required|numeric|min:0',
            'details.*.thickness' => 'required|numeric|min:0',
            'details.*.weight' => 'required|numeric|min:0',
            'details.*.price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $totalAmount = 0;
            foreach ($request->details as $detail) {
                $totalAmount += (float)$detail['price'];
            }

            $invoice = Invoice::create([
                'user_id' => Auth::id(),
                'invoice_number' => $request->invoice_number,
                'customer_name' => $request->customer_name,
                'delivery_date' => $request->delivery_date,
                'submit_date' => Carbon::now(),
                'total_amount' => $totalAmount,
            ]);

            foreach ($request->details as $detailData) {
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'coil_number' => $detailData['coil_number'],
                    'width' => $detailData['width'],
                    'length' => $detailData['length'],
                    'thickness' => $detailData['thickness'],
                    'weight' => $detailData['weight'],
                    'price' => $detailData['price'],
                ]);
            }

            DB::commit();
            return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create invoice. ' . $e->getMessage())->withInput();
        }
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $invoice->load('details');
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $invoice->load('details'); // Load details untuk form edit
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:100',
            'delivery_date' => 'required|date',
            // Invoice number tidak diubah saat edit biasanya, jika boleh, tambahkan validasi unique:invoices,invoice_number,.$invoice->id
            'details' => 'required|array|min:1',
            'details.*.id' => 'nullable|integer|exists:invoice_details,id', // Untuk detail yang sudah ada
            'details.*.coil_number' => 'required|string|max:50',
            'details.*.width' => 'required|numeric|min:0',
            'details.*.length' => 'required|numeric|min:0',
            'details.*.thickness' => 'required|numeric|min:0',
            'details.*.weight' => 'required|numeric|min:0',
            'details.*.price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $invoice->update([
                'customer_name' => $request->customer_name,
                'delivery_date' => $request->delivery_date,
            ]);

            $newTotalAmount = 0;
            $submittedDetailIds = [];

            foreach ($request->details as $detailData) {
                $detailId = $detailData['id'] ?? null;

                $attributes = [
                    'coil_number' => $detailData['coil_number'],
                    'width' => $detailData['width'],
                    'length' => $detailData['length'],
                    'thickness' => $detailData['thickness'],
                    'weight' => $detailData['weight'],
                    'price' => $detailData['price'],
                ];

                if ($detailId) {
                    // Update existing detail
                    $detail = InvoiceDetail::find($detailId);
                    // Pastikan detail ini milik invoice yang sedang diedit
                    if ($detail && $detail->invoice_id == $invoice->id) {
                        $detail->update($attributes);
                        $submittedDetailIds[] = $detail->id;
                    }
                } else {
                    // Create new detail
                    $newDetail = $invoice->details()->create($attributes);
                    $submittedDetailIds[] = $newDetail->id;
                }
                $newTotalAmount += (float)$detailData['price'];
            }

            // Delete details that were removed from the form
            InvoiceDetail::where('invoice_id', $invoice->id)
                         ->whereNotIn('id', $submittedDetailIds)
                         ->delete();

            $invoice->update(['total_amount' => $newTotalAmount]);

            DB::commit();
            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update invoice. ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        DB::beginTransaction();
        try {
            // Detail akan terhapus otomatis karena onDelete('cascade') di migrasi
            $invoice->delete();
            DB::commit();
            return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('invoices.index')->with('error', 'Failed to delete invoice. ' . $e->getMessage());
        }
    }

    public function print(Invoice $invoice)
    {
        $invoice->load('details'); // Pastikan detail invoice juga dimuat
        return view('invoices.print', compact('invoice'));
    }
}