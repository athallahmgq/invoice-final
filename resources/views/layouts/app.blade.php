<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Invoice App')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --primary: #4361ee;
            --primary-rgb: 67, 97, 238;
            --primary-dark: #3a56d4;
            --primary-light: #6e85f2;
            --secondary: #6c757d;
            --success: #10b981;
            --success-rgb: 16, 185, 129;
            --danger: #ef4444;
            --danger-rgb: 239, 68, 68;
            --warning: #f59e0b;
            --warning-rgb: 245, 158, 11;
            --info: #0ea5e9;
            --info-rgb: 14, 165, 233;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --border-color: #e2e8f0;
            --sidebar-width: 280px;
            --header-height: 70px;
            --sidebar-collapsed-width: 80px;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            --transition-speed: 0.3s;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--dark);
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            line-height: 1.6;
        }
        
        /* ===== HEADER STYLES ===== */
        .app-header {
            height: var(--header-height);
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
            transition: all var(--transition-speed) ease;
        }
        
        .header-brand {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all var(--transition-speed) ease;
        }
        
        .header-brand i {
            font-size: 1.75rem;
            margin-right: 0.75rem;
        }
        
        .header-brand:hover {
            color: var(--primary-dark);
        }
        
        .header-toggle {
            background: none;
            border: none;
            color: var(--gray);
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
        }
        
        .header-toggle:hover {
            color: var(--primary);
            background-color: rgba(var(--primary-rgb), 0.05);
        }
        
        .header-search {
            position: relative;
            margin-left: 1.5rem;
            display: none;
        }
        
        @media (min-width: 768px) {
            .header-search {
                display: block;
            }
        }
        
        .header-search-input {
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background-color: #f9fafb;
            width: 300px;
            font-size: 0.9rem;
            transition: all var(--transition-speed) ease;
        }
        
        .header-search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
            background-color: white;
        }
        
        .header-search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 1rem;
            pointer-events: none;
        }
        
        .header-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .header-action-btn {
            background: none;
            border: none;
            color: var(--gray);
            font-size: 1.25rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all var(--transition-speed) ease;
        }
        
        .header-action-btn:hover {
            color: var(--primary);
            background-color: rgba(var(--primary-rgb), 0.05);
        }
        
        .header-action-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: var(--danger);
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
        
        .header-user {
            position: relative;
            margin-left: 0.5rem;
        }
        
        .header-user-toggle {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            font-weight: 600;
            color: var(--dark);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 10px;
            transition: all var(--transition-speed) ease;
        }
        
        .header-user-toggle:hover {
            background-color: rgba(var(--primary-rgb), 0.05);
        }
        
        .header-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.2);
        }
        
        .header-user-info {
            display: none;
        }
        
        @media (min-width: 768px) {
            .header-user-info {
                display: block;
            }
        }
        
        .header-user-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--dark);
            margin: 0;
            line-height: 1.2;
        }
        
        .header-user-role {
            font-size: 0.8rem;
            color: var(--gray);
            margin: 0;
        }
        
        .header-user-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.75rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            min-width: 240px;
            display: none;
            z-index: 1000;
            overflow: hidden;
            animation: fadeIn 0.2s ease;
        }
        
        .header-user-menu.show {
            display: block;
        }
        
        .header-user-menu-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }
        
        .header-user-menu-name {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        
        .header-user-menu-email {
            font-size: 0.85rem;
            color: var(--gray);
            margin: 0;
        }
        
        .header-user-menu-body {
            padding: 0.75rem;
        }
        
        .header-user-menu-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
        }
        
        .header-user-menu-item:hover {
            background-color: rgba(var(--primary-rgb), 0.05);
            color: var(--primary);
        }
        
        .header-user-menu-item i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            color: var(--gray);
            transition: all var(--transition-speed) ease;
        }
        
        .header-user-menu-item:hover i {
            color: var(--primary);
        }
        
        .header-user-menu-footer {
            padding: 0.75rem;
            border-top: 1px solid var(--border-color);
        }
        
        .header-user-menu-item.danger {
            color: var(--danger);
        }
        
        .header-user-menu-item.danger i {
            color: var(--danger);
        }
        
        .header-user-menu-item.danger:hover {
            background-color: rgba(var(--danger-rgb), 0.05);
            color: var(--danger);
        }
        
        /* ===== SIDEBAR STYLES ===== */
        .app-sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background-color: white;
            border-right: 1px solid var(--border-color);
            z-index: 1020;
            transition: all var(--transition-speed) ease;
            overflow-y: auto;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.03);
        }
        
        .app-sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-section {
            padding: 1.5rem 1.5rem 0.5rem;
        }
        
        .app-sidebar.collapsed .sidebar-section {
            padding: 1.5rem 0.75rem 0.5rem;
            text-align: center;
        }
        
        .sidebar-header {
            font-weight: 600;
            color: var(--gray);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            transition: all var(--transition-speed) ease;
        }
        
        .app-sidebar.collapsed .sidebar-header {
            font-size: 0.7rem;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem;
        }
        
        .sidebar-item {
            margin-bottom: 0.5rem;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.85rem 1rem;
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            border-radius: 10px;
            transition: all var(--transition-speed) ease;
            position: relative;
        }
        
        .sidebar-link:hover {
            background-color: rgba(var(--primary-rgb), 0.05);
            color: var(--primary);
        }
        
        .sidebar-link.active {
            color: var(--primary);
            background-color: rgba(var(--primary-rgb), 0.08);
            font-weight: 600;
        }
        
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 4px;
            background-color: var(--primary);
            border-radius: 0 4px 4px 0;
        }
        
        .sidebar-link i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
            transition: all var(--transition-speed) ease;
        }
        
        .app-sidebar.collapsed .sidebar-link span {
            display: none;
        }
        
        .app-sidebar.collapsed .sidebar-link {
            justify-content: center;
            padding: 0.85rem;
        }
        
        .app-sidebar.collapsed .sidebar-link i {
            margin-right: 0;
            font-size: 1.4rem;
        }
        
        .app-sidebar.collapsed .sidebar-header {
            opacity: 0;
            height: 0;
            margin: 0;
            overflow: hidden;
        }
        
        .sidebar-divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 1rem 0;
            opacity: 0.6;
        }
        
        /* Sidebar Footer */
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }
        
        .app-sidebar.collapsed .sidebar-footer {
            padding: 1rem 0.75rem;
            text-align: center;
        }
        
        .sidebar-footer-text {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        .app-sidebar.collapsed .sidebar-footer-text {
            display: none;
        }
        
        .sidebar-footer-version {
            font-size: 0.75rem;
            color: var(--gray);
            opacity: 0.7;
        }
        
        .app-sidebar.collapsed .sidebar-footer-version {
            display: none;
        }
        
        /* ===== MAIN CONTENT STYLES ===== */
        .app-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2rem;
            transition: margin-left var(--transition-speed) ease;
            min-height: calc(100vh - var(--header-height));
        }
        
        .app-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            font-size: 1rem;
            color: var(--gray);
            margin-bottom: 0;
        }
        
        /* ===== CARD STYLES ===== */
        .app-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
            border: none;
        }
        
        .app-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }
        
        .app-card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .app-card-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
            color: var(--dark);
        }
        
        .app-card-body {
            padding: 1.5rem;
        }
        
        .app-card-footer {
            background-color: #f9fafb;
            border-top: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
        }
        
        /* ===== ALERT STYLES ===== */
        .app-alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .app-alert-icon {
            margin-right: 1rem;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .app-alert-content {
            flex: 1;
        }
        
        .app-alert-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .app-alert-message {
            margin-bottom: 0;
        }
        
        .app-alert-success {
            background-color: rgba(var(--success-rgb), 0.1);
            color: var(--success);
        }
        
        .app-alert-danger {
            background-color: rgba(var(--danger-rgb), 0.1);
            color: var(--danger);
        }
        
        .app-alert-warning {
            background-color: rgba(var(--warning-rgb), 0.1);
            color: var(--warning);
        }
        
        .app-alert-info {
            background-color: rgba(var(--info-rgb), 0.1);
            color: var(--info);
        }
        
        /* ===== BUTTON STYLES ===== */
        .app-btn {
            font-weight: 500;
            padding: 0.65rem 1.25rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
        }
        
        .app-btn i {
            font-size: 1.1rem;
        }
        
        .app-btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.2);
        }
        
        .app-btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(var(--primary-rgb), 0.3);
        }
        
        .app-btn-outline-primary {
            background-color: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }
        
        .app-btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(var(--primary-rgb), 0.2);
        }
        
        .app-btn-success {
            background-color: var(--success);
            color: white;
            box-shadow: 0 4px 12px rgba(var(--success-rgb), 0.2);
        }
        
        .app-btn-success:hover {
            background-color: #0da56f;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(var(--success-rgb), 0.3);
        }
        
        .app-btn-danger {
            background-color: var(--danger);
            color: white;
            box-shadow: 0 4px 12px rgba(var(--danger-rgb), 0.2);
        }
        
        .app-btn-danger:hover {
            background-color: #e43535;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(var(--danger-rgb), 0.3);
        }
        
        /* ===== FORM STYLES ===== */
        .app-form-control {
            padding: 0.65rem 1rem;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background-color: white;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .app-form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
            outline: none;
        }
        
        .app-form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            color: var(--dark);
        }
        
        .app-form-select {
            padding: 0.65rem 1rem;
            border-radius: 10px;
            border: 1.5px solid var(--border-color);
            background-color: white;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .app-form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
            outline: none;
        }
        
        /* ===== TABLE STYLES ===== */
        .app-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 1rem;
        }
        
        .app-table th {
            font-weight: 600;
            color: var(--dark);
            background-color: #f9fafb;
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
        }
        
        .app-table td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            color: var(--dark);
        }
        
        .app-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .app-table tbody tr:hover {
            background-color: rgba(var(--primary-rgb), 0.02);
        }
        
        .app-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* ===== FOOTER STYLES ===== */
        .app-footer {
            background-color: white;
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border-color);
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed) ease;
        }
        
        .app-footer.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        .footer-link {
            color: var(--gray);
            text-decoration: none;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        
        .footer-link:hover {
            color: var(--primary);
        }
        
        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .app-alert {
            animation: slideDown 0.3s ease forwards;
        }
        
        /* ===== RESPONSIVE STYLES ===== */
        @media (max-width: 992px) {
            .app-sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }
            
            .app-sidebar.mobile-show {
                transform: translateX(0);
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }
            
            .app-content, .app-footer {
                margin-left: 0 !important;
            }
            
            .app-overlay {
                position: fixed;
                top: var(--header-height);
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1010;
                display: none;
                backdrop-filter: blur(2px);
                transition: all 0.3s ease;
            }
            
            .app-overlay.show {
                display: block;
            }
        }
        
        /* ===== UTILITIES ===== */
        .badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
        }
        
        .badge-dot-success {
            background-color: var(--success);
        }
        
        .badge-dot-warning {
            background-color: var(--warning);
        }
        
        .badge-dot-danger {
            background-color: var(--danger);
        }
        
        .badge-status {
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        
        .badge-status-success {
            background-color: rgba(var(--success-rgb), 0.1);
            color: var(--success);
        }
        
        .badge-status-warning {
            background-color: rgba(var(--warning-rgb), 0.1);
            color: var(--warning);
        }
        
        .badge-status-danger {
            background-color: rgba(var(--danger-rgb), 0.1);
            color: var(--danger);
        }
        
        /* Dark mode toggle */
        .dark-mode-toggle {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .dark-mode-toggle:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(var(--primary-rgb), 0.4);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="app-header">
        <button class="header-toggle" id="sidebar-toggle" aria-label="Toggle Sidebar">
            <i class="bi bi-list"></i>
        </button>
        
        <a href="{{ route('home') }}" class="header-brand">
            <i class="bi bi-receipt"></i>
            <span>Astra Corp</span>
        </a>
        
        <div class="header-search">
            <i class="bi bi-search header-search-icon"></i>
            <input type="text" class="header-search-input" placeholder="Search...">
        </div>
        
        <div class="header-actions">
            <button class="header-action-btn" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="header-action-badge">3</span>
            </button>
            
            <button class="header-action-btn" aria-label="Messages">
                <i class="bi bi-envelope"></i>
                <span class="header-action-badge">5</span>
            </button>
            
            @guest
                <div class="d-flex">
                    <a href="{{ route('login.form') }}" class="app-btn app-btn-outline-primary me-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="{{ route('register.form') }}" class="app-btn app-btn-primary">
                        <i class="bi bi-person-plus"></i> Register
                    </a>
                </div>
            @else
                <div class="header-user">
                    <button class="header-user-toggle" id="user-menu-toggle">
                        <div class="header-user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <div class="header-user-info">
                            <p class="header-user-name">{{ Auth::user()->name }}</p>
                            <p class="header-user-role">Administrator</p>
                        </div>
                        <i class="bi bi-chevron-down ms-2"></i>
                    </button>
                    
                    <div class="header-user-menu" id="user-menu">
                        <div class="header-user-menu-header">
                            <p class="header-user-menu-name">{{ Auth::user()->name }}</p>
                            <p class="header-user-menu-email">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <div class="header-user-menu-body">
                            <a href="#" class="header-user-menu-item">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="#" class="header-user-menu-item">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                            <a href="#" class="header-user-menu-item">
                                <i class="bi bi-bell"></i>
                                <span>Notifications</span>
                            </a>
                        </div>
                        
                        <div class="header-user-menu-footer">
                            <a href="#" class="header-user-menu-item danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </header>
    
    <!-- Sidebar -->
    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-section">
            <div class="sidebar-header">Dashboard</div>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="{{ route('invoices.index') }}" class="sidebar-link {{ request()->routeIs('invoices.index') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Clients</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="bi bi-box"></i>
                        <span>Products</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-header">Reports</div>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('reports.sales') ? 'active' : '' }}">
                        <i class="bi bi-graph-up"></i>
                        <span>Sales Report</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('reports.clients') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart"></i>
                        <span>Client Report</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('reports.tax') ? 'active' : '' }}">
                        <i class="bi bi-calculator"></i>
                        <span>Tax Report</span>
                    </a>
                </li>
            </ul>
        </div>
        
        @auth
            <div class="sidebar-section">
                <div class="sidebar-header">Account</div>
                <ul class="sidebar-menu">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="bi bi-person"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endauth
        
        <div class="sidebar-footer">
            <p class="sidebar-footer-text">©️ {{ date('Y') }} InvoiceApp</p>
            <p class="sidebar-footer-version">v2.0.1</p>
        </div>
    </aside>
    
    <!-- Overlay for mobile -->
    <div class="app-overlay" id="sidebar-overlay"></div>
    
    <!-- Main Content -->
    <main class="app-content" id="main-content">
        @if (session('success'))
            <div class="app-alert app-alert-success mb-4">
                <div class="app-alert-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="app-alert-content">
                    <h6 class="app-alert-title">Success!</h6>
                    <p class="app-alert-message">{{ session('success') }}</p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="app-alert app-alert-danger mb-4">
                <div class="app-alert-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="app-alert-content">
                    <h6 class="app-alert-title">Error!</h6>
                    <p class="app-alert-message">{{ session('error') }}</p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="app-alert app-alert-danger mb-4">
                <div class="app-alert-icon">
                    <i class="bi bi-exclamation-octagon-fill"></i>
                </div>
                <div class="app-alert-content">
                    <h6 class="app-alert-title">Whoops!</h6>
                    <p class="app-alert-message">There were some problems with your input.</p>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="app-footer" id="footer">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <span class="text-muted">©️ {{ date('Y') }} InvoiceApp. All rights reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="footer-link me-3">
                    <i class="bi bi-question-circle"></i> Help
                </a>
                <a href="#" class="footer-link me-3">
                    <i class="bi bi-shield-check"></i> Privacy
                </a>
                <a href="#" class="footer-link">
                    <i class="bi bi-file-text"></i> Terms
                </a>
            </div>
        </div>
    </footer>
    
    <!-- Dark Mode Toggle Button -->
    <button class="dark-mode-toggle" id="dark-mode-toggle" aria-label="Toggle Dark Mode">
        <i class="bi bi-moon"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const footer = document.getElementById('footer');
        const overlay = document.getElementById('sidebar-overlay');
        
        function toggleSidebar() {
            const isMobile = window.innerWidth < 992;
            
            if (isMobile) {
                sidebar.classList.toggle('mobile-show');
                overlay.classList.toggle('show');
                document.body.classList.toggle('overflow-hidden');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                footer.classList.toggle('expanded');
            }
        }
        
        sidebarToggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
        
        // User menu toggle
        const userMenuToggle = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-menu');
        
        if (userMenuToggle) {
            userMenuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                userMenu.classList.toggle('show');
            });
            
            // Close user menu when clicking outside
            document.addEventListener('click', function(event) {
                if (userMenu && userMenu.classList.contains('show') && 
                    !userMenuToggle.contains(event.target) && 
                    !userMenu.contains(event.target)) {
                    userMenu.classList.remove('show');
                }
            });
        }
        
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.app-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const closeBtn = alert.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.click();
                } else {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 300);
                }
            }, 5000);
        });
        
        // Handle responsive behavior
        function handleResize() {
            const isMobile = window.innerWidth < 992;
            
            if (isMobile) {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
                footer.classList.remove('expanded');
            } else {
                sidebar.classList.remove('mobile-show');
                overlay.classList.remove('show');
                document.body.classList.remove('overflow-hidden');
            }
        }
        
        window.addEventListener('resize', handleResize);
        handleResize(); // Initial check
        
        // Dark mode toggle
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const htmlElement = document.documentElement;
        
        // Check for saved theme preference or use device preference
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            enableDarkMode();
        }
        
        darkModeToggle.addEventListener('click', () => {
            if (htmlElement.classList.contains('dark-mode')) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });
        
        function enableDarkMode() {
            htmlElement.classList.add('dark-mode');
            darkModeToggle.innerHTML = '<i class="bi bi-sun"></i>';
            localStorage.setItem('theme', 'dark');
        }
        
        function disableDarkMode() {
            htmlElement.classList.remove('dark-mode');
            darkModeToggle.innerHTML = '<i class="bi bi-moon"></i>';
            localStorage.setItem('theme', 'light');
        }
        
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>