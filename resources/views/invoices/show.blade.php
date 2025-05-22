@extends('layouts.app')

@section('title', 'Invoice Detail - ' . $invoice->invoice_number)

@section('content')
<!-- Page Header with Glass Effect -->
<div class="position-relative mb-4">
    <div class="page-header-bg rounded-3"></div>
    <div class="position-relative p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-2">
            <div>
                <h1 class="h3 fw-bold mb-1 text-white">Invoice Detail</h1>
                <p class="text-white text-opacity-75 mb-0">Viewing invoice #{{ $invoice->invoice_number }}</p>
            </div>
            
        </div>
    </div>
</div>

<!-- Status Card -->
<div class="card border-0 shadow-sm mb-4 status-card">
    <div class="card-body p-0">
        <div class="d-flex flex-wrap">
            <div class="status-item">
                <div class="d-flex align-items-center">
                    <div class="status-icon bg-success bg-opacity-10">
                        <i class="bi bi-check-circle-fill text-success"></i>
                    </div>
                    <div>
                        <span class="status-label">Status</span>
                        <span class="status-value">Paid</span>
                    </div>
                </div>
            </div>
            <div class="status-item">
                <div class="d-flex align-items-center">
                    <div class="status-icon bg-primary bg-opacity-10">
                        <i class="bi bi-calendar-check text-primary"></i>
                    </div>
                    <div>
                        <span class="status-label">Delivery Date</span>
                        <span class="status-value">{{ $invoice->delivery_date->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="status-item">
                <div class="d-flex align-items-center">
                    <div class="status-icon bg-info bg-opacity-10">
                        <i class="bi bi-clock text-info"></i>
                    </div>
                    <div>
                        <span class="status-label">Submit Date</span>
                        <span class="status-value">{{ $invoice->submit_date->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="status-item">
                <div class="d-flex align-items-center">
                    <div class="status-icon bg-warning bg-opacity-10">
                        <i class="bi bi-cash-stack text-warning"></i>
                    </div>
                    <div>
                        <span class="status-label">Total Amount</span>
                        <span class="status-value">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Invoice Information Card -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header border-0 bg-white pt-4 pb-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon-wrapper me-3">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Invoice Information</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-hash"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Invoice Number</div>
                        <div class="info-value">{{ $invoice->invoice_number }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Customer</div>
                        <div class="info-value">{{ $invoice->customer_name }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Delivery Date</div>
                        <div class="info-value">{{ $invoice->delivery_date->format('d F Y') }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Submit Date</div>
                        <div class="info-value">{{ $invoice->submit_date->format('d F Y H:i') }}</div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-calendar-plus"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Created</div>
                        <div class="info-value">{{ $invoice->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Invoice Summary Card -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header border-0 bg-white pt-4 pb-3">
                <div class="d-flex align-items-center">
                    <div class="card-icon-wrapper me-3">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Invoice Summary</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="summary-card">
                            <div class="summary-icon bg-success bg-opacity-10">
                                <i class="bi bi-cash text-success"></i>
                            </div>
                            <div class="summary-content">
                                <div class="summary-label">Total Amount</div>
                                <div class="summary-value">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="summary-card">
                            <div class="summary-icon bg-info bg-opacity-10">
                                <i class="bi bi-list-check text-info"></i>
                            </div>
                            <div class="summary-content">
                                <div class="summary-label">Total Items</div>
                                <div class="summary-value">{{ count($invoice->details) }}</div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    
                    <a href="{{ route('invoices.print', $invoice->id) }}" type="blank" class="action-button">
                        <div class="action-icon">
                            <i class="bi bi-printer"></i>
                        </div>
                        <span class="text-black ">Print</span>
                    </a>
                    
                    <button type="button" class="action-button">
                        <div class="action-icon">
                            <i class="bi bi-download"></i>
                        </div>
                        <span>Download</span>
                    </button>
                    <button type="button" class="action-button" data-bs-toggle="modal" data-bs-target="#shareInvoiceModal">
                        <div class="action-icon">
                            <i class="bi bi-share"></i>
                        </div>
                        <span>Share</span>
                    </button>
                    <button type="button" class="action-button">
                        <div class="action-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <span>Email</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Items Card -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 bg-white pt-4 pb-3">
        <div class="d-flex align-items-center">
            <div class="card-icon-wrapper me-3">
                <i class="bi bi-list-ul"></i>
            </div>
            <h5 class="mb-0 fw-bold">Invoice Items</h5>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table invoice-table">
                <thead>
                    <tr>
                        <th>Coil Number</th>
                        <th>Width (mm)</th>
                        <th>Length (mm)</th>
                        <th>Thickness (mm)</th>
                        <th>Weight (kg)</th>
                        <th class="text-end">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->details as $detail)
                    <tr>
                        <td class="fw-medium">{{ $detail->coil_number }}</td>
                        <td>{{ number_format($detail->width, 2) }}</td>
                        <td>{{ number_format($detail->length, 2) }}</td>
                        <td>{{ number_format($detail->thickness, 2) }}</td>
                        <td>{{ number_format($detail->weight, 2) }}</td>
                        <td class="text-end fw-bold">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total Amount:</td>
                        <td class="text-end fw-bold fs-5 text-primary">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex justify-content-between mb-5">
    <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back to List
    </a>
    <div class="d-flex gap-2">
        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-2"></i> Edit Invoice
        </a>
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="moreActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="moreActionsDropdown">
                <li><a class="dropdown-item" href="#"><i class="bi bi-envelope me-2"></i> Email Invoice</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-excel me-2"></i> Export to Excel</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i> Delete Invoice</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Share Invoice Modal -->
<div class="modal fade" id="shareInvoiceModal" tabindex="-1" aria-labelledby="shareInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="shareInvoiceModalLabel">Share Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="shareEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="shareEmail" placeholder="Enter recipient's email">
                </div>
                <div class="mb-3">
                    <label for="shareMessage" class="form-label">Message (Optional)</label>
                    <textarea class="form-control" id="shareMessage" rows="3" placeholder="Add a message"></textarea>
                </div>
                <div class="share-options">
                    <button type="button" class="share-option">
                        <div class="share-icon bg-success bg-opacity-10">
                            <i class="bi bi-whatsapp text-success"></i>
                        </div>
                        <span>WhatsApp</span>
                    </button>
                    <button type="button" class="share-option">
                        <div class="share-icon bg-primary bg-opacity-10">
                            <i class="bi bi-envelope text-primary"></i>
                        </div>
                        <span>Email</span>
                    </button>
                    <button type="button" class="share-option">
                        <div class="share-icon bg-info bg-opacity-10">
                            <i class="bi bi-link-45deg text-info"></i>
                        </div>
                        <span>Copy Link</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Share Invoice</button>
            </div>
        </div>
    </div>
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
        height: 100%;
        background: linear-gradient(135deg, var(--primary), #6366f1);
        z-index: -1;
    }
    
    /* Status Card */
    .status-card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .status-item {
        padding: 1.25rem;
        flex: 1;
        min-width: 200px;
        border-right: 1px solid var(--border-color);
    }
    
    .status-item:last-child {
        border-right: none;
    }
    
    .status-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.25rem;
    }
    
    .status-label {
        display: block;
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    
    .status-value {
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    /* Card Styles */
    .card {
        border-radius: 12px;
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
    
    /* Info Items */
    .info-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background-color: rgba(var(--primary-rgb), 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1rem;
    }
    
    .info-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        font-weight: 600;
    }
    
    /* Summary Cards */
    .summary-card {
        display: flex;
        align-items: center;
        background-color: var(--light-bg);
        border-radius: 12px;
        padding: 1.25rem;
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
        flex: 1;
    }
    
    .summary-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    
    .summary-value {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    
    .progress {
        height: 6px;
        border-radius: 3px;
        background-color: rgba(var(--primary-rgb), 0.1);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
    }
    
    .action-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: none;
        border: none;
        padding: 0.75rem;
        border-radius: 10px;
        transition: background-color 0.2s;
        min-width: 80px;
    }
    
    .action-button:hover {
        background-color: var(--light-bg);
    }
    
    .action-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background-color: rgba(var(--primary-rgb), 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    
    .action-button span {
        font-size: 0.85rem;
        font-weight: 500;
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
        font-size: 0.85rem;
        color: #6c757d;
        padding: 1rem 1.5rem;
        border-bottom-width: 1px;
    }
    
    .invoice-table td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
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
    
    /* Share Modal */
    .share-options {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
        margin-top: 1.5rem;
    }
    
    .share-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: none;
        border: none;
        padding: 0.75rem;
        border-radius: 10px;
        transition: background-color 0.2s;
        min-width: 80px;
    }
    
    .share-option:hover {
        background-color: var(--light-bg);
    }
    
    .share-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    
    .share-option span {
        font-size: 0.85rem;
        font-weight: 500;
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
    }
    
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .dropdown-menu {
        border-radius: 10px;
        overflow: hidden;
        padding: 0.5rem;
    }
    
    .dropdown-item {
        border-radius: 6px;
        padding: 0.6rem 1rem;
    }
    
    
</style>
@endsection