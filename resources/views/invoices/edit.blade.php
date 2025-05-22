@extends('layouts.app')

@section('title', 'Edit Invoice - ' . $invoice->invoice_number)

@section('content')
<!-- Page Header with Glass Effect -->
<div class="position-relative mb-4">
    <div class="page-header-bg rounded-3"></div>
    <div class="position-relative p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-2">
            <div>
                <h1 class="h3 fw-bold mb-1 text-white">Edit Invoice</h1>
                <p class="text-white text-opacity-75 mb-0">Updating invoice #{{ $invoice->invoice_number }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="card-header border-0 bg-white pt-4 pb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="card-icon-wrapper me-3">
                        <i class="bi bi-pen"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Invoice Information</h5>
                </div>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                    <i class="bi bi-clock me-1"></i> Last updated: {{ $invoice->updated_at->format('d M Y, H:i') }}
                </span>
            </div>
        </div>
        
        <div class="card-body p-4">
            <!-- Invoice Information Section -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control-plaintext border-bottom rounded-0" id="invoice_number" name="invoice_number_display" value="{{ $invoice->invoice_number }}" readonly>
                        <label for="invoice_number" class="text-muted">Invoice Number</label>
                        <div class="form-text small">Invoice number cannot be changed</div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', $invoice->customer_name) }}" placeholder="Enter customer name" required>
                        <label for="customer_name">Customer Name</label>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', $invoice->delivery_date->format('Y-m-d')) }}" required>
                        <label for="delivery_date">Delivery Date</label>
                        @error('delivery_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Invoice Summary -->
            <div class="invoice-summary mt-4">
                <div class="row g-3">
                    <div class="col-md-6 col-lg-3">
                        <div class="summary-item">
                            <div class="summary-icon bg-primary bg-opacity-10">
                                <i class="bi bi-circle-fill text-primary"></i>
                            </div>
                            <div class="summary-content">
                                <span class="summary-label">Invoice Status</span>
                                <span class="summary-value">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="summary-item">
                            <div class="summary-icon bg-success bg-opacity-10">
                                <i class="bi bi-cash-stack text-success"></i>
                            </div>
                            <div class="summary-content">
                                <span class="summary-label">Total Amount</span>
                                <span class="summary-value" id="total_amount_display">Rp 0,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="summary-item">
                            <div class="summary-icon bg-info bg-opacity-10">
                                <i class="bi bi-list-check text-info"></i>
                            </div>
                            <div class="summary-content">
                                <span class="summary-label">Line Items</span>
                                <span class="summary-value" id="total_items_count">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="summary-item">
                            <div class="summary-icon bg-warning bg-opacity-10">
                                <i class="bi bi-clock-history text-warning"></i>
                            </div>
                            <div class="summary-content">
                                <span class="summary-label">Created On</span>
                                <span class="summary-value">{{ $invoice->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Invoice Details Section -->
            <div class="mt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <div class="card-icon-wrapper me-3">
                            <i class="bi bi-list-ul"></i>
                        </div>
                        <h5 class="mb-0 fw-bold">Invoice Line Items</h5>
                    </div>
                    <button type="button" class="btn btn-primary" id="add_line_item">
                        <i class="bi bi-plus-lg me-2"></i> Add Item
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table invoice-table" id="invoice_details_table">
                        <thead>
                            <tr>
                                <th>Coil Number</th>
                                <th>Width (mm)</th>
                                <th>Length (mm)</th>
                                <th>Thickness (mm)</th>
                                <th>Weight (kg)</th>
                                <th>Price (Rp)</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="invoice_details_body">
                            {{-- Template untuk baris baru (dihide dan disabled) --}}
                            <tr class="detail-item-template" style="display: none;">
                                <td>
                                    <input type="hidden" name="details[__INDEX__][id]" value="" disabled>
                                    <input type="text" name="details[__INDEX__][coil_number]" class="form-control form-control-sm coil-number" placeholder="Coil Number" disabled>
                                </td>
                                <td><input type="number" step="0.01" name="details[__INDEX__][width]" class="form-control form-control-sm width" placeholder="Width" disabled></td>
                                <td><input type="number" step="0.01" name="details[__INDEX__][length]" class="form-control form-control-sm length" placeholder="Length" disabled></td>
                                <td><input type="number" step="0.01" name="details[__INDEX__][thickness]" class="form-control form-control-sm thickness" placeholder="Thickness" disabled></td>
                                <td><input type="number" step="0.01" name="details[__INDEX__][weight]" class="form-control form-control-sm weight" placeholder="Weight" disabled></td>
                                <td><input type="number" step="0.01" name="details[__INDEX__][price]" class="form-control form-control-sm price-item" placeholder="Price" disabled></td>
                                <td class="text-center">
                                    <button type="button" class="btn-delete-item" disabled>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        
                            @php $detailIndex = 0; @endphp
                            {{-- Loop untuk details yang sudah ada atau dari old input --}}
                            @foreach (old('details', $invoice->details->toArray()) as $index => $detail)
                            <tr class="detail-item">
                                <td>
                                    <input type="hidden" name="details[{{ $detailIndex }}][id]" value="{{ $detail['id'] ?? '' }}">
                                    <input type="text" name="details[{{ $detailIndex }}][coil_number]" class="form-control form-control-sm coil-number @error('details.'.$detailIndex.'.coil_number') is-invalid @enderror" value="{{ $detail['coil_number'] ?? '' }}" placeholder="Coil Number">
                                </td>
                                <td><input type="number" step="0.01" name="details[{{ $detailIndex }}][width]" class="form-control form-control-sm width @error('details.'.$detailIndex.'.width') is-invalid @enderror" value="{{ $detail['width'] ?? '' }}" placeholder="Width"></td>
                                <td><input type="number" step="0.01" name="details[{{ $detailIndex }}][length]" class="form-control form-control-sm length @error('details.'.$detailIndex.'.length') is-invalid @enderror" value="{{ $detail['length'] ?? '' }}" placeholder="Length"></td>
                                <td><input type="number" step="0.01" name="details[{{ $detailIndex }}][thickness]" class="form-control form-control-sm thickness @error('details.'.$detailIndex.'.thickness') is-invalid @enderror" value="{{ $detail['thickness'] ?? '' }}" placeholder="Thickness"></td>
                                <td><input type="number" step="0.01" name="details[{{ $detailIndex }}][weight]" class="form-control form-control-sm weight @error('details.'.$detailIndex.'.weight') is-invalid @enderror" value="{{ $detail['weight'] ?? '' }}" placeholder="Weight"></td>
                                <td><input type="number" step="0.01" name="details[{{ $detailIndex }}][price]" class="form-control form-control-sm price-item @error('details.'.$detailIndex.'.price') is-invalid @enderror" value="{{ $detail['price'] ?? '' }}" placeholder="Price"></td>
                                <td class="text-center">
                                    <button type="button" class="btn-delete-item remove-line-item">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @php $detailIndex++; @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Total Price:</td>
                                <td class="fw-bold text-primary" id="total_price_cell">Rp 0,00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="form-text mt-2">
                    <i class="bi bi-info-circle me-1"></i> Total price is automatically calculated when you enter prices for each line item
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                <div>
                    <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-2"></i> Cancel
                    </a>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-outline-primary">
                        <i class="bi bi-eye me-2"></i> View Invoice
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i> Update Invoice
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    /* Modern UI Styles */
    :root {
        --primary: #4361ee;
        --primary-rgb: 67, 97, 238;
        --success: #10b981;
        --success-rgb: 16, 185, 129;
        --info: #0ea5e9;
        --info-rgb: 14, 165, 233;
        --warning: #f59e0b;
        --warning-rgb: 245, 158, 11;
        --danger: #ef4444;
        --danger-rgb: 239, 68, 68;
        --light-bg: #f8f9fb;
        --border-color: #e9ecef;
    }
    
    /* Page Header with Glass Effect */
    .page-header-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--primary), #6366f1);
        z-index: -1;
    }
    
    /* Card Styles */
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }
    
    .card-icon-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background-color: rgba(var(--primary-rgb), 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    /* Form Controls */
    .form-control, .form-select {
        padding: 0.6rem 1rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.15);
        border-color: var(--primary);
    }
    
    .form-control-plaintext {
        font-weight: 600;
        color: var(--primary);
        font-size: 1.1rem;
    }
    
    .form-floating > .form-control,
    .form-floating > .form-control-plaintext {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }
    
    .form-floating > .form-control-plaintext ~ label {
        opacity: 0.65;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }
    
    .form-floating > .form-control-plaintext {
        padding-left: 0;
    }
    
    /* Invoice Summary */
    .invoice-summary {
        background-color: var(--light-bg);
        border-radius: 12px;
        padding: 1.5rem;
    }
    
    .summary-item {
        display: flex;
        align-items: center;
        height: 100%;
    }
    
    .summary-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.5rem;
    }
    
    .summary-content {
        display: flex;
        flex-direction: column;
    }
    
    .summary-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    
    .summary-value {
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    /* Invoice Table */
    .invoice-table {
        margin-bottom: 0;
    }
    
    .invoice-table thead {
        background-color: var(--light-bg);
    }
    
    .invoice-table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        padding: 1rem 1.5rem;
        border-bottom-width: 1px;
    }
    
    .invoice-table td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
    }
    
    .invoice-table tbody tr {
        transition: background-color 0.2s;
    }
    
    .invoice-table tbody tr:hover {
        background-color: rgba(var(--primary-rgb), 0.02);
    }
    
    .invoice-table tfoot {
        background-color: var(--light-bg);
    }
    
    .invoice-table tfoot td {
        padding: 1rem 1.5rem;
    }
    
    /* Delete Button */
    .btn-delete-item {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background-color: rgba(var(--danger-rgb), 0.1);
        color: var(--danger);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .btn-delete-item:hover {
        background-color: var(--danger);
        color: white;
        transform: translateY(-3px);
    }
    
    /* Buttons */
    .btn {
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        transition: all 0.2s;
    }
    
    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-primary:hover {
        background-color: #3a56d4;
        border-color: #3a56d4;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.2);
    }
    
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary);
        border-color: var(--primary);
        transform: translateY(-3px);
    }
    
    /* Badge */
    .badge {
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .invoice-summary {
            padding: 1rem;
        }
        
        .summary-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }
        
        .summary-value {
            font-size: 1rem;
        }
        
        .invoice-table th,
        .invoice-table td {
            padding: 0.75rem 0.5rem;
        }
    }
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.getElementById('invoice_details_body');
    const addLineButton = document.getElementById('add_line_item');
    const templateRow = document.querySelector('.detail-item-template');
    const totalItemsCount = document.getElementById('total_items_count');
    const totalAmountDisplay = document.getElementById('total_amount_display');
    
    let rowIndex = {{ count($invoice->details) }}; // Start from the number of existing items

    // Update total price and other summary information
    function updateSummary() {
        let total = 0;
        let itemCount = tableBody.querySelectorAll('.detail-item').length;
        
        tableBody.querySelectorAll('.price-item').forEach(function(priceInput) {
            if (priceInput.value && priceInput.closest('tr').style.display !== 'none') {
                total += parseFloat(priceInput.value);
            }
        });
        
        // Update displays with animation
        const totalPriceCell = document.getElementById('total_price_cell');
        const formattedTotal = 'Rp ' + total.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
        // Add highlight effect
        totalPriceCell.classList.add('highlight');
        totalAmountDisplay.classList.add('highlight');
        
        // Update text
        totalPriceCell.textContent = formattedTotal;
        totalAmountDisplay.textContent = formattedTotal;
        totalItemsCount.textContent = itemCount;
        
        // Remove highlight effect after animation
        setTimeout(() => {
            totalPriceCell.classList.remove('highlight');
            totalAmountDisplay.classList.remove('highlight');
        }, 500);
    }

    // Add a new row with animation
    function addRow() {
        const newRow = templateRow.cloneNode(true);
        newRow.classList.remove('detail-item-template');
        newRow.classList.add('detail-item');
        newRow.style.display = ''; // Make it visible
        newRow.style.opacity = '0';
        newRow.style.transform = 'translateY(10px)';

        newRow.innerHTML = newRow.innerHTML.replace(/__INDEX__/g, rowIndex);

        // Remove disabled attribute from all inputs and buttons
        newRow.querySelectorAll('input, button').forEach(el => el.removeAttribute('disabled'));

        const hiddenIdInput = newRow.querySelector('input[name*="[id]"]');
        if(hiddenIdInput) hiddenIdInput.value = '';

        tableBody.appendChild(newRow);
        
        // Animate the new row
        setTimeout(() => {
            newRow.style.transition = 'all 0.3s ease';
            newRow.style.opacity = '1';
            newRow.style.transform = 'translateY(0)';
        }, 10);
        
        rowIndex++;

        newRow.querySelector('.remove-line-item').addEventListener('click', function() {
            const row = this.closest('tr');
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.remove();
                updateSummary();
            }, 300);
        });

        const newPriceInput = newRow.querySelector('.price-item');
        if (newPriceInput) {
            newPriceInput.addEventListener('input', updateSummary);
        }
        
        newRow.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => {
            if (!input.name.includes('[id]')) { // don't reset ID
                input.value = '';
            }
        });
        
        // Focus on the first input of the new row
        const firstInput = newRow.querySelector('input[type="text"]');
        if (firstInput) {
            firstInput.focus();
        }
        
        updateSummary();
    }
    
    // Add event listener to the "Add Line" button
    addLineButton.addEventListener('click', addRow);
    
    // Add event listeners to existing rows
    tableBody.querySelectorAll('.detail-item').forEach(row => {
        row.querySelector('.remove-line-item').addEventListener('click', function() {
            const row = this.closest('tr');
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.remove();
                updateSummary();
            }, 300);
        });
        
        row.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', updateSummary);
        });
    });
    
    // Calculate summary on page load
    updateSummary();
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes highlight {
            0% { background-color: rgba(var(--primary-rgb), 0.2); }
            100% { background-color: transparent; }
        }
        
        .highlight {
            animation: highlight 0.5s ease;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush