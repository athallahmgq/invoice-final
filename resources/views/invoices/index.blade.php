@extends('layouts.app')

@section('title', 'Invoice History')

@section('content')
<!-- Page Header with Glass Effect -->
<div class="position-relative mb-4">
    <div class="page-header-bg rounded-3"></div>
    <div class="position-relative p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-2">
            <div>
                <h1 class="display-6 fw-bold text-white mb-2">Invoice History</h1>
                <p class="text-white text-opacity-75 mb-0">Manage and track all your invoice records</p>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="d-inline-flex gap-2">
                    <a href="{{ route('invoices.create') }}" class="btn bg-white d-flex align-items-center">
                        <i class="bi bi-plus-circle me-md-2"></i>
                        <span class="d-none d-md-inline">Create Invoice</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-body">
                <div class="stat-card-icon bg-primary bg-opacity-10">
                    <i class="bi bi-receipt"></i>
                </div>
                <div class="stat-card-info">
                    <span class="stat-card-label">Total Invoices</span>
                    <span class="stat-card-value">{{ $invoices->total() }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-body">
                <div class="stat-card-icon bg-success bg-opacity-10">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-card-info">
                    <span class="stat-card-label">Paid</span>
                    <span class="stat-card-value">{{ $invoices->count() }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-body">
                <div class="stat-card-icon bg-warning bg-opacity-10">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-card-info">
                    <span class="stat-card-label">Pending</span>
                    <span class="stat-card-value">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-body">
                <div class="stat-card-icon bg-danger bg-opacity-10">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
                <div class="stat-card-info">
                    <span class="stat-card-label">Overdue</span>
                    <span class="stat-card-value">0</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-5">
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="form-control search-input" id="searchInput" placeholder="Search invoices by number, customer or amount...">
                </div>
            </div>
            <div class="col-md-7">
                <div class="d-flex flex-wrap gap-2">
                    <div class="filter-item">
                        <select class="form-select" id="statusFilter">
                            <option value="">All Statuses</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <select class="form-select" id="dateFilter">
                            <option value="">All Time</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <button type="button" class="btn btn-primary d-flex align-items-center">
                            <i class="bi bi-funnel me-2"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invoices Table Card -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table invoice-table" id="invoicesTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Invoice Number</th>
                        <th>Customer</th>
                        <th>Delivery Date</th>
                        <th>Submit Date</th>
                        <th>Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $index => $invoice)
                    <tr>
                        <td>{{ $invoices->firstItem() + $index }}</td>
                        <td>
                            <span class="fw-medium">{{ $invoice->invoice_number }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar">
                                    {{ strtoupper(substr($invoice->customer_name, 0, 1)) }}
                                </div>
                                <span class="ms-2">{{ $invoice->customer_name }}</span>
                            </div>
                        </td>
                        <td>{{ $invoice->delivery_date->format('d M Y') }}</td>
                        <td>{{ $invoice->submit_date->format('d M Y') }}</td>
                        <td class="fw-medium">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <span class="status-badge status-paid">Paid</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="action-button view" data-bs-toggle="tooltip" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="action-button edit" data-bs-toggle="tooltip" title="Edit Invoice">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button delete" onclick="return confirm('Are you sure you want to delete this invoice?');" data-bs-toggle="tooltip" title="Delete Invoice">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="bi bi-file-earmark-x"></i>
                                </div>
                                <h5>No Invoices Found</h5>
                                <p>Start creating your first invoice to see it here</p>
                                <a href="{{ route('invoices.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i> Create First Invoice
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($invoices->count() > 0)
    <div class="card-footer bg-white py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="pagination-info">
                Showing <span>{{ $invoices->firstItem() }}</span> to <span>{{ $invoices->lastItem() }}</span> of <span>{{ $invoices->total() }}</span> entries
            </div>
            <div class="mt-3 mt-md-0">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    /* Modern UI Styles */
    :root {
        --primary: #4361ee;
        --primary-rgb: 67, 97, 238;
        --success: #10b981;
        --success-rgb: 16, 185, 129;
        --warning: #f59e0b;
        --warning-rgb: 245, 158, 11;
        --danger: #ef4444;
        --danger-rgb: 239, 68, 68;
        --light-bg: #f8f9fb;
        --border-color: #e9ecef;
    }
    
    /* Page Header with Glass Effect */
    .page-header {
        margin-top: -2rem;
        margin-left: -2rem;
        margin-right: -2rem;
    }
    
    .page-header-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--primary), #6366f1);
        z-index: 0;
    }
    
    /* Stats Cards */
    .stat-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card-body {
        padding: 1.5rem;
        display: flex;
        align-items: center;
    }
    
    .stat-card-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-right: 1rem;
    }
    
    .stat-card-info {
        display: flex;
        flex-direction: column;
    }
    
    .stat-card-label {
        font-size: 0.875rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    
    .stat-card-value {
        font-size: 1.75rem;
        font-weight: 700;
    }
    
    /* Search and Filter */
    .search-container {
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 10;
    }
    
    .search-input {
        padding-left: 2.75rem;
        height: 48px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background-color: #fff;
    }
    
    .search-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.15);
        border-color: var(--primary);
    }
    
    .filter-item {
        flex: 1;
        min-width: 150px;
    }
    
    .form-select {
        height: 48px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
    }
    
    .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.15);
        border-color: var(--primary);
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
        padding: 1rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
    }
    
    .invoice-table tbody tr {
        transition: background-color 0.2s;
    }
    
    .invoice-table tbody tr:hover {
        background-color: rgba(var(--primary-rgb), 0.02);
    }
    
    .invoice-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Avatar */
    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.35rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    
    .status-paid {
        background-color: rgba(var(--success-rgb), 0.1);
        color: var(--success);
    }
    
    .status-pending {
        background-color: rgba(var(--warning-rgb), 0.1);
        color: var(--warning);
    }
    
    .status-overdue {
        background-color: rgba(var(--danger-rgb), 0.1);
        color: var(--danger);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .action-button {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .action-button:hover {
        transform: translateY(-3px);
    }
    
    .action-button.view {
        background-color: var(--primary);
    }
    
    .action-button.edit {
        background-color: var(--warning);
    }
    
    .action-button.delete {
        background-color: var(--danger);
    }
    
    /* Empty State */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-state-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: var(--light-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #6c757d;
        margin-bottom: 1.5rem;
    }
    
    .empty-state h5 {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: #6c757d;
        margin-bottom: 1.5rem;
    }
    
    /* Pagination */
    .pagination-info {
        color: #6c757d;
        font-size: 0.875rem;
    }
    
    .pagination-info span {
        font-weight: 600;
        color: #212529;
    }
    
    .pagination {
        margin-bottom: 0;
    }
    
    .page-link {
        color: var(--primary);
        border-radius: 6px;
        margin: 0 2px;
    }
    
    .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    /* Buttons */
    .btn {
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        transition: all 0.2s;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
    
    /* Dropdown */
    .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 0.5rem;
    }
    
    .dropdown-item {
        border-radius: 6px;
        padding: 0.6rem 1rem;
    }
    
    .dropdown-item:hover {
        background-color: rgba(var(--primary-rgb), 0.05);
    }
    
    /* Card */
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header {
            margin-top: -1rem;
            margin-left: -1rem;
            margin-right: -1rem;
        }
        
        .stat-card-body {
            padding: 1rem;
        }
        
        .stat-card-icon {
            width: 48px;
            height: 48px;
            font-size: 1.5rem;
        }
        
        .stat-card-value {
            font-size: 1.5rem;
        }
        
        .invoice-table th,
        .invoice-table td {
            padding: 0.75rem 1rem;
        }
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Enhanced search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const table = document.getElementById('invoicesTable');
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Show empty state if no results
                const visibleRows = table.querySelectorAll('tbody tr:not([style="display: none;"])');
                const emptyStateRow = table.querySelector('.empty-state-row');
                
                if (visibleRows.length === 0 && !emptyStateRow) {
                    const tbody = table.querySelector('tbody');
                    const tr = document.createElement('tr');
                    tr.className = 'empty-state-row';
                    tr.innerHTML = `
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                                <h5>No Results Found</h5>
                                <p>We couldn't find any invoices matching your search</p>
                                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('searchInput').value = ''; this.closest('tr').remove(); document.querySelectorAll('#invoicesTable tbody tr').forEach(r => r.style.display = '');">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i> Clear Search
                                </button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                } else if (visibleRows.length > 0 && emptyStateRow) {
                    emptyStateRow.remove();
                }
            });
        }
    });
</script>
@endsection