<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
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
            background-image: 
                radial-gradient(at 10% 10%, rgba(99, 102, 241, 0.03) 0px, transparent 50%),
                radial-gradient(at 90% 90%, rgba(99, 102, 241, 0.03) 0px, transparent 50%);
            background-attachment: fixed;
            line-height: 1.6;
            font-weight: 400;
        }
        
        .invoice-container {
            max-width: 900px;
            margin: 0 auto 40px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .invoice-container:hover {
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1), 0 10px 15px -5px rgba(0, 0, 0, 0.05);
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
        
        .invoice-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%;
            background: linear-gradient(to top, rgba(0,0,0,0.05), transparent);
            pointer-events: none;
        }
        
        .invoice-header-left {
            position: relative;
            z-index: 1;
        }
        
        .invoice-logo {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            animation: fadeInDown 0.5s ease-out;
        }
        
        .logo-placeholder {
            width: 48px;
            height: 48px;
            background-color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: 800;
            color: var(--primary-color);
            font-size: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .invoice-logo:hover .logo-placeholder {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        
        .company-title {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .invoice-header h1 {
            font-size: 36px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
            animation: fadeInUp 0.5s ease-out;
            background: linear-gradient(to right, #ffffff, rgba(255,255,255,0.8));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .invoice-header .invoice-id {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 5px;
            animation: fadeInUp 0.7s ease-out;
        }
        
        .invoice-header-right {
            position: relative;
            z-index: 1;
            text-align: right;
            animation: fadeInLeft 0.5s ease-out;
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
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .invoice-status:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
        
        .invoice-status i {
            margin-right: 8px;
            font-size: 16px;
        }
        
        .invoice-amount {
            font-size: 32px;
            font-weight: 800;
            margin-top: 5px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            animation: fadeInUp 0.5s ease-out;
            animation-fill-mode: both;
        }
        
        .invoice-info-section:nth-child(1) {
            animation-delay: 0.1s;
        }
        
        .invoice-info-section:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .invoice-info-section:nth-child(3) {
            animation-delay: 0.3s;
        }
        
        .invoice-info-section.text-right {
            text-align: right;
        }
        
        .invoice-info-card {
            background-color: var(--secondary-color);
            border-radius: 16px;
            padding: 25px;
            height: 100%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.7);
        }
        
        .invoice-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border-color: rgba(99, 102, 241, 0.2);
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
            background-color: rgba(99, 102, 241, 0.1);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
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
        
        .invoice-table-container {
            margin: 30px 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.7s ease-out;
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
            padding: 18px 20px;
            text-align: left;
        }
        
        .invoice-table td {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            vertical-align: middle;
            transition: all 0.2s ease;
        }
        
        .invoice-table tr:last-child td {
            border-bottom: none;
        }
        
        .invoice-table tr {
            transition: all 0.2s ease;
        }
        
        .invoice-table tr:hover {
            background-color: rgba(99, 102, 241, 0.03);
        }
        
        .invoice-table tr:hover td {
            transform: translateX(5px);
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
            margin-top: 4px;
        }
        
        .invoice-totals-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 40px;
            animation: fadeInUp 0.9s ease-out;
        }
        
        .invoice-message {
            flex: 1;
            padding-right: 40px;
        }
        
        .invoice-message h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-color);
            position: relative;
            display: inline-block;
        }
        
        .invoice-message h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }
        
        .invoice-message p {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.7;
        }
        
        .invoice-totals {
            width: 350px;
            background-color: var(--secondary-color);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(226, 232, 240, 0.7);
            transition: all 0.3s ease;
        }
        
        .invoice-totals:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border-color: rgba(99, 102, 241, 0.2);
        }
        
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .totals-table td {
            padding: 12px 0;
            font-size: 14px;
        }
        
        .totals-table .total-row td {
            padding-top: 20px;
            font-size: 24px;
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
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            animation: fadeInUp 1.1s ease-out;
        }
        
        .footer-info {
            flex: 1;
            padding-right: 20px;
        }
        
        .footer-info h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-color);
            position: relative;
            display: inline-block;
        }
        
        .footer-info h4::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }
        
        .footer-info p {
            margin: 8px 0;
            font-size: 13px;
            color: var(--text-light);
        }
        
        .footer-qr {
            width: 120px;
            height: 120px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: var(--text-light);
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }
        
        .footer-qr img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .footer-qr::after {
            content: 'Scan to pay';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 5px;
            background-color: rgba(255,255,255,0.9);
            font-size: 10px;
            text-align: center;
            font-weight: 600;
        }
        
        .print-actions {
            display: flex;
            justify-content: center;
            margin: 40px 0;
            gap: 15px;
            animation: fadeInDown 0.5s ease-out;
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
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
        }
        
        .btn-secondary {
            background-color: white;
            color: var(--text-color);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        
        .btn-secondary:hover {
            background-color: var(--light-gray);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
        }
        
        .btn-download {
            background-color: #10b981;
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        
        .btn-download:hover {
            background-color: #059669;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
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
        
        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .invoice-info {
                flex-direction: column;
                gap: 20px;
            }
            
            .invoice-totals-container {
                flex-direction: column;
            }
            
            .invoice-message {
                padding-right: 0;
                margin-bottom: 30px;
            }
            
            .invoice-totals {
                width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .invoice-header {
                flex-direction: column;
                gap: 20px;
                padding: 30px;
            }
            
            .invoice-header-right {
                text-align: left;
            }
            
            .invoice-body {
                padding: 30px;
            }
            
            .invoice-footer {
                flex-direction: column;
                gap: 30px;
            }
            
            .footer-qr {
                margin: 0 auto;
            }
            
            .print-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
            }
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
            
            .invoice-info-card:hover,
            .invoice-totals:hover {
                transform: none;
                box-shadow: none;
            }
            
            .invoice-table tr:hover td {
                transform: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-actions">
        <button class="btn btn-primary" onclick="window.print()">
            <i class="bi bi-printer"></i> Print Invoice
        </button>
        
        <button class="btn btn-download">
            <i class="bi bi-download"></i> Download PDF
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
                        <p>{{ $invoice->customer_address ?? 'Customer Address' }}</p>
                        <p>{{ $invoice->customer_city ?? 'Customer City' }}, {{ $invoice->customer_zip ?? '54321' }}</p>
                        <p>Email: {{ $invoice->customer_email ?? 'customer@example.com' }}</p>
                    </div>
                </div>
                
                <div class="invoice-info-section">
                    <div class="invoice-info-card">
                        <h3><i class="bi bi-info-circle"></i> Details</h3>
                        <p><span class="label">Invoice Number:</span> <span class="value">{{ $invoice->invoice_number }}</span></p>
                        <p><span class="label">Invoice Date:</span> <span class="value">{{ $invoice->submit_date ? $invoice->submit_date->format('d M Y') : now()->format('d M Y') }}</span></p>
                        <p><span class="label">Delivery Date:</span> <span class="value">{{ $invoice->delivery_date ? $invoice->delivery_date->format('d M Y') : now()->addDays(7)->format('d M Y') }}</span></p>
                        <p><span class="label">Payment Terms:</span> <span class="value">Net 30 Days</span></p>
                        <p><span class="label">Due Date:</span> <span class="value">{{ $invoice->delivery_date ? $invoice->delivery_date->addDays(30)->format('d M Y') : now()->addDays(37)->format('d M Y') }}</span></p>
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
                    
                    <div class="mt-4 pt-3 border-top border-light">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield-check text-success me-2"></i>
                            <span class="small fw-medium">All transactions are secure and encrypted</span>
                        </div>
                        <div class="d-flex align-items-center mt-2">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            <span class="small fw-medium">Invoice history is available in your customer portal</span>
                        </div>
                    </div>
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
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=INV:{{ $invoice->invoice_number }}_AMT:{{ $invoice->total_price ?? $invoice->total_amount ?? 0 }}_DATE:{{ $invoice->submit_date ? $invoice->submit_date->format('Ymd') : now()->format('Ymd') }}" alt="QR Code for Payment">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>