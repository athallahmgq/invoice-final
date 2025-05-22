<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --primary-color: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary-color: #f8fafc;
            --text-color: #334155;
            --text-light: #64748b;
            --border-color: #e2e8f0;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-gray: #f1f5f9;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 30px;
            color: var(--text-color);
            background-color: #f8fafc;
            line-height: 1.6;
            font-weight: 400;
        }
        
        .invoice-container {
            max-width: 900px;
            margin: 0 auto 40px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
        }
        
        .invoice-header {
            position: relative;
            padding: 40px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            overflow: hidden;
        }
        
        .invoice-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
            transform: rotate(30deg);
        }
        
        .invoice-header-left {
            position: relative;
            z-index: 1;
        }
        
        .invoice-logo {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .logo-placeholder {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: 800;
            color: var(--primary-color);
        }
        
        .company-title {
            font-size: 20px;
            font-weight: 700;
        }
        
        .invoice-header h1 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            letter-spacing: 0.5px;
        }
        
        .invoice-header .invoice-id {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 5px;
        }
        
        .invoice-header-right {
            position: relative;
            z-index: 1;
            text-align: right;
        }
        
        .invoice-status {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 30px;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            color: white;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }
        
        .invoice-status i {
            margin-right: 8px;
            font-size: 16px;
        }
        
        .invoice-amount {
            font-size: 28px;
            font-weight: 800;
            margin-top: 5px;
        }
        
        .invoice-amount-label {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .invoice-body {
            padding: 40px;
        }
        
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 30px;
        }
        
        .invoice-info-section {
            flex: 1;
            position: relative;
        }
        
        .invoice-info-section.text-right {
            text-align: right;
        }
        
        .invoice-info-section h3 {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .invoice-info-section h3 i {
            margin-right: 8px;
            font-size: 16px;
            color: var(--primary-color);
        }
        
        .invoice-info-section p {
            margin: 8px 0;
            font-size: 14px;
            color: var(--text-color);
        }
        
        .invoice-info-section .company-name {
            font-weight: 700;
            font-size: 18px;
            color: var(--primary-color);
            margin-bottom: 8px;
        }
        
        .invoice-info-section .customer-name {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 8px;
        }
        
        .invoice-info-section .label {
            color: var(--text-light);
            margin-right: 5px;
            font-size: 13px;
        }
        
        .invoice-info-section .value {
            font-weight: 600;
        }
        
        .invoice-info-card {
            background-color: var(--secondary-color);
            border-radius: 12px;
            padding: 20px;
            height: 100%;
        }
        
        .invoice-table-container {
            margin: 30px 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
        }
        
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .invoice-table th {
            background-color: var(--light-gray);
            color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 15px;
            text-align: left;
        }
        
        .invoice-table td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            vertical-align: middle;
        }
        
        .invoice-table tr:last-child td {
            border-bottom: none;
        }
        
        .invoice-table tr:hover {
            background-color: rgba(99, 102, 241, 0.03);
        }
        
        .invoice-table .text-right {
            text-align: right;
        }
        
        .invoice-table .item-price {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .invoice-table .item-id {
            color: var(--text-light);
            font-size: 12px;
            font-weight: 500;
        }
        
        .invoice-totals-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 40px;
        }
        
        .invoice-message {
            flex: 1;
            padding-right: 40px;
        }
        
        .invoice-message h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-color);
        }
        
        .invoice-message p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
        }
        
        .invoice-totals {
            width: 350px;
        }
        
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .totals-table td {
            padding: 10px 0;
            font-size: 14px;
        }
        
        .totals-table .total-row td {
            padding-top: 20px;
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-color);
        }
        
        .totals-table .subtotal-row {
            border-bottom: 1px solid var(--border-color);
        }
        
        .totals-table .subtotal-row td {
            padding-bottom: 15px;
        }
        
        .totals-table .tax-row td {
            padding-top: 15px;
        }
        
        .invoice-footer {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
        }
        
        .footer-info {
            flex: 1;
        }
        
        .footer-info h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-color);
        }
        
        .footer-info p {
            margin: 5px 0;
            font-size: 13px;
            color: var(--text-light);
        }
        
        .footer-qr {
            width: 100px;
            height: 100px;
            background-color: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: var(--text-light);
            border-radius: 8px;
        }
        
        .print-actions {
            display: flex;
            justify-content: center;
            margin: 40px 0;
            gap: 10px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
        }
        
        .btn-secondary {
            background-color: white;
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }
        
        .btn-secondary:hover {
            background-color: var(--light-gray);
            transform: translateY(-2px);
        }
        
        .btn i {
            margin-right: 8px;
            font-size: 16px;
        }
        
        /* Watermark for draft or copy */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(0,0,0,0.03);
            font-weight: 800;
            pointer-events: none;
            z-index: 1;
            text-transform: uppercase;
            white-space: nowrap;
        }
        
        
        /* Print styles */
        @media print {
            body {
                background-color: white;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .invoice-container {
                width: 100%;
                max-width: none;
                margin: 0;
                box-shadow: none;
                border-radius: 0;
            }
            
            .print-actions {
                display: none !important;
            }
            
            .invoice-header {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%) !important;
                color: white !important;
            }
            
            .invoice-table th {
                background-color: var(--light-gray) !important;
            }
        }
    </style>

    
</head>
<body>
    <div class="print-actions">
        <button class="btn btn-primary" onclick="window.print()">
            <i class="bi bi-printer"></i> Print Invoice
        </button>
       
        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-secondary">
            <i class="bi bi-x-lg"></i> Close
        </a>
        
    </div>

    <div class="invoice-container">
        <!-- Optional Watermark for draft or copy -->
        <!-- <div class="watermark">PAID</div> -->
        
        <div class="invoice-header">
            <div class="invoice-header-left">
                <div class="invoice-logo">
                    <div class="logo-placeholder">A</div>
                    <div class="company-title">Astra Corp</div>
                </div>
                <h1>INVOICE</h1>
                <div class="invoice-id">{{ $invoice->invoice_number }}</div>
            </div>
            <div class="invoice-header-right">
                <div class="invoice-status">
                    <i class="bi bi-check-circle-fill"></i> Paid
                </div>
                <div class="invoice-amount-label">Total Amount</div>
                <div class="invoice-amount">Rp {{ number_format($invoice->total_price ?? $invoice->total_amount ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
        
        <div class="invoice-body">
            <div class="invoice-info">
                <div class="invoice-info-section">
                    <div class="invoice-info-card">
                        <h3><i class="bi bi-building"></i> From</h3>
                        <p class="company-name">PT Astra Corp.</p>
                        <p>Jl. Industri Jaya No. 123</p>
                        <p>Kota Makmur, 12345</p>
                        <p>Telp: (021) 555-1234</p>
                        <p>Email: info@astracorp.com</p>
                    </div>
                </div>
                
                <div class="invoice-info-section">
                    <div class="invoice-info-card">
                        <h3><i class="bi bi-person"></i> To</h3>
                        <p class="customer-name">{{ $invoice->customer_name }}</p>
                        
                        <p>Customer City, 54321</p>
                        <p>Email: customer@example.com</p>
                    </div>
                </div>
                
                <div class="invoice-info-section">
                    <div class="invoice-info-card">
                        <h3><i class="bi bi-info-circle"></i> Details</h3>
                        <p><span class="label">Invoice Number:</span> <span class="value">{{ $invoice->invoice_number }}</span></p>
                        <p><span class="label">Invoice Date:</span> <span class="value">{{ $invoice->submit_date ? $invoice->submit_date->format('d M Y') : 'N/A' }}</span></p>
                        <p><span class="label">Delivery Date:</span> <span class="value">{{ $invoice->delivery_date->format('d M Y') }}</span></p>
                        <p><span class="label">Payment Terms:</span> <span class="value">Net 30 Days</span></p>
                        <p><span class="label">Due Date:</span> <span class="value">{{ $invoice->delivery_date->addDays(30)->format('d M Y') }}</span></p>
                    </div>
                </div>
            </div>
            
            <div class="invoice-table-container">
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>Coil Number</th>
                            <th>Width (mm)</th>
                            <th>Length (mm)</th>
                            <th>Thickness (mm)</th>
                            <th>Weight (kg)</th>
                            <th class="text-right">Price (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->details as $index => $detail)
                        <tr>
                            <td>
                                {{ $detail->coil_number }}
                                <div class="item-id">#COIL-{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td>{{ number_format($detail->width, 2) }}</td>
                            <td>{{ number_format($detail->length, 2) }}</td>
                            <td>{{ number_format($detail->thickness, 2) }}</td>
                            <td>{{ number_format($detail->weight, 2) }}</td>
                            <td class="text-right item-price">{{ number_format($detail->price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="invoice-totals-container">
                <div class="invoice-message">
                    <h3>Thank You for Your Business</h3>
                    <p>We appreciate your prompt payment and look forward to continuing to provide you with our products and services in the future. If you have any questions or concerns regarding this invoice, please don't hesitate to contact our accounting department.</p>
                </div>
                
                <div class="invoice-totals">
                    <table class="totals-table">
                        <tr class="subtotal-row">
                            <td>Subtotal:</td>
                            <td class="text-right">Rp {{ number_format($invoice->total_price ?? $invoice->total_amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="tax-row">
                            <td>Tax (0%):</td>
                            <td class="text-right">Rp 0</td>
                        </tr>
                        <tr class="total-row">
                            <td>Total:</td>
                            <td class="text-right">Rp {{ number_format($invoice->total_price ?? $invoice->total_amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="invoice-footer">
                <div class="footer-info">
                    <h4>Payment Information</h4>
                    <p>Bank: Bank Central Asia (BCA)</p>
                    <p>Account Name: PT Astra Corp</p>
                    <p>Account Number: 1234567890</p>
                    <p>Swift Code: CENAIDJA</p>
                </div>
                
                <div class="footer-info">
                    <h4>Terms & Conditions</h4>
                    <p>1. Payment is due within 30 days</p>
                    <p>2. Please include invoice number on your payment</p>
                    <p>3. Late payments are subject to a 2% monthly fee</p>
                </div>
                
                <div class="footer-qr">
                    Scan to pay
                </div>
            </div>
        </div>
    </div>
</body>
</html>