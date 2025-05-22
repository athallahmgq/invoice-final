<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Astra Corp</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-rgb: 99, 102, 241;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --success: #10b981;
            --success-rgb: 16, 185, 129;
            --danger: #ef4444;
            --danger-rgb: 239, 68, 68;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #e2e8f0;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .register-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Left side - Brand & Illustration */
        .brand-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            position: relative;
            overflow: hidden;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            min-height: 100%;
        }
        
        .brand-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
            transform: rotate(30deg);
        }
        
        .brand-section::after {
            content: '';
            position: absolute;
            bottom: -10%;
            left: -10%;
            width: 60%;
            height: 60%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
        }
        
        .brand-logo {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 10;
        }
        
        .brand-icon {
            width: 48px;
            height: 48px;
            background-color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-left: 0.75rem;
        }
        
        .illustration-wrapper {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 2rem auto;
            z-index: 5;
        }
        
        .illustration {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
        }
        
        .welcome-text {
            position: relative;
            z-index: 5;
            margin-bottom: 2rem;
        }
        
        .welcome-text h1 {
            font-size: 2.75rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-text p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        /* Right side - Registration Form */
        .form-section {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .register-card {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            transition: all 0.3s ease;
        }
        
        .register-card:hover {
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .register-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0.75rem;
            position: relative;
            display: inline-block;
        }
        
        .register-header h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            border-radius: 2px;
        }
        
        .register-header p {
            color: var(--gray);
            font-size: 1rem;
        }
        
        .form-floating {
            margin-bottom: 1.5rem;
        }
        
        .form-floating > .form-control {
            padding: 1.5rem 1rem 0.5rem;
            height: calc(3.5rem + 2px);
            line-height: 1.25;
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.2s ease;
        }
        
        .form-floating > label {
            padding: 1rem;
            color: var(--gray);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
        }
        
        .password-field {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            z-index: 5;
            padding: 0.25rem;
            font-size: 1.1rem;
            transition: all 0.2s ease;
        }
        
        .password-toggle:hover {
            color: var(--primary);
        }
        
        .password-requirements {
            background-color: rgba(var(--primary-rgb), 0.05);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 0.75rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary);
        }
        
        .password-requirements p {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .password-requirements ul {
            margin: 0;
            padding-left: 1.25rem;
        }
        
        .password-requirements li {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
        }
        
        .password-requirements li.valid {
            color: var(--success);
        }
        
        .password-requirements li.valid::marker {
            color: var(--success);
        }
        
        .form-check-input {
            width: 1.1rem;
            height: 1.1rem;
            margin-top: 0.2rem;
            border: 1.5px solid var(--border);
            border-radius: 0.25rem;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.1);
            border-color: var(--primary);
        }
        
        .form-check-label {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .form-check-label a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        
        .form-check-label a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .btn-register {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            border: none;
            color: white;
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            transition: all 0.3s ease;
            z-index: -1;
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(var(--primary-rgb), 0.3);
        }
        
        .btn-register:hover::before {
            left: 0;
        }
        
        .btn-register:active {
            transform: translateY(-1px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--border);
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
        
        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .btn-social {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border-radius: 12px;
            background-color: white;
            border: 1px solid var(--border);
            color: var(--dark);
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .btn-social:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-light);
        }
        
        .btn-social i {
            font-size: 1.25rem;
        }
        
        .btn-google i {
            color: #ea4335;
        }
        
        .btn-facebook i {
            color: #1877f2;
        }
        
        .register-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .register-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        
        .register-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            border: none;
            font-size: 0.9rem;
            background-color: #fee2e2;
            color: #b91c1c;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .alert-danger {
            border-left: 4px solid #ef4444;
        }
        
        .alert ul {
            margin: 0.5rem 0 0 1.5rem;
            padding: 0;
        }
        
        .alert li {
            margin-bottom: 0.25rem;
        }
        
        /* Floating labels animation */
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary);
            transform: scale(0.85) translateY(-0.75rem) translateX(0.15rem);
        }
        
        /* Progress bar for password strength */
        .password-strength {
            height: 6px;
            border-radius: 3px;
            margin-top: 0.5rem;
            background-color: #e2e8f0;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        
        .strength-weak {
            background-color: #ef4444;
            width: 25%;
        }
        
        .strength-fair {
            background-color: #f59e0b;
            width: 50%;
        }
        
        .strength-good {
            background-color: #3b82f6;
            width: 75%;
        }
        
        .strength-strong {
            background-color: #10b981;
            width: 100%;
        }
        
        .strength-text {
            font-size: 0.8rem;
            margin-top: 0.25rem;
            text-align: right;
            font-weight: 500;
        }
        
        .text-weak {
            color: #ef4444;
        }
        
        .text-fair {
            color: #f59e0b;
        }
        
        .text-good {
            color: #3b82f6;
        }
        
        .text-strong {
            color: #10b981;
        }
        
        /* Animations */
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
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .register-card {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .brand-logo {
            animation: fadeInLeft 0.6s ease-out;
        }
        
        .welcome-text {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .illustration-wrapper {
            animation: fadeInUp 1s ease-out;
        }
        
        /* Responsive styles */
        @media (max-width: 991.98px) {
            .brand-section {
                display: none;
            }
            
            .form-section {
                padding: 2rem 1.5rem;
            }
            
            .register-card {
                padding: 2rem;
            }
            
            /* Show a small brand header on mobile */
            .mobile-brand {
                display: flex;
                align-items: center;
                margin-bottom: 2rem;
                justify-content: center;
            }
            
            .mobile-brand .brand-icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }
        }
        
        @media (min-width: 992px) {
            .mobile-brand {
                display: none;
            }
            
            .register-container {
                flex-direction: row;
            }
            
            .brand-section, 
            .form-section {
                width: 50%;
            }
            
            .form-section {
                padding: 3rem;
            }
        }
        
        /* Floating particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 15s infinite ease-in-out;
        }
        
        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }
        
        .particle:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 20%;
            right: 20%;
            animation-delay: 2s;
        }
        
        .particle:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 30%;
            animation-delay: 4s;
        }
        
        .particle:nth-child(4) {
            width: 50px;
            height: 50px;
            bottom: 30%;
            right: 10%;
            animation-delay: 6s;
        }
        
        .particle:nth-child(5) {
            width: 30px;
            height: 30px;
            top: 50%;
            left: 10%;
            animation-delay: 8s;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) translateX(0);
            }
            25% {
                transform: translateY(-20px) translateX(10px);
            }
            50% {
                transform: translateY(0) translateX(20px);
            }
            75% {
                transform: translateY(20px) translateX(10px);
            }
            100% {
                transform: translateY(0) translateX(0);
            }
        }
        
        /* Form step indicators */
        .step-indicators {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .step-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: var(--border);
            margin: 0 0.25rem;
            transition: all 0.3s ease;
        }
        
        .step-indicator.active {
            background-color: var(--primary);
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Left Side - Brand & Illustration -->
        <div class="brand-section">
            <div class="particles">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>
            
            <div class="brand-logo d-flex align-items-center">
                <div class="brand-icon">A</div>
                <span class="brand-name">Astra Corp</span>
            </div>
            
            <div class="illustration-wrapper">
                <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" class="illustration">
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.3" />
                            <stop offset="100%" style="stop-color:#ffffff;stop-opacity:0.1" />
                        </linearGradient>
                    </defs>
                    <path fill="url(#gradient)">
                        <animate attributeName="d" dur="10000ms" repeatCount="indefinite" values="M440.5,320.5Q418,391,355.5,442.5Q293,494,226,450.5Q159,407,99,367Q39,327,31.5,247.5Q24,168,89,125.5Q154,83,219.5,68Q285,53,335.5,94.5Q386,136,424.5,193Q463,250,440.5,320.5Z;M453.78747,319.98894Q416.97789,389.97789,353.96683,436.87838Q290.95577,483.77887,223.95577,447.43366Q156.95577,411.08845,105.64373,365.97789Q54.33169,320.86732,62.67444,252.61056Q71.01719,184.3538,113.01965,135.21007Q155.02211,86.06634,220.52211,66.46683Q286.02211,46.86732,335.5,91.94472Q384.97789,137.02211,437.78747,193.51106Q490.59704,250,453.78747,319.98894Z;M411.39826,313.90633Q402.59677,377.81265,342.92059,407.63957Q283.24442,437.46649,215.13648,432.5428Q147.02853,427.61911,82.23325,380.9572Q17.43796,334.29529,20.45223,250.83809Q23.46649,167.38089,82.5856,115.05707Q141.70471,62.73325,212.19045,63.73015Q282.67618,64.72705,352.67308,84.79839Q422.66998,104.86972,421.43486,177.43486Q420.19974,250,411.39826,313.90633Z;M440.5,320.5Q418,391,355.5,442.5Q293,494,226,450.5Q159,407,99,367Q39,327,31.5,247.5Q24,168,89,125.5Q154,83,219.5,68Q285,53,335.5,94.5Q386,136,424.5,193Q463,250,440.5,320.5Z;"></animate>
                    </path>
                </svg>
            </div>
            
            <div class="welcome-text">
                <h1>Join Our Community</h1>
                <p>Create an account to access all features, manage your projects, and connect with our team.</p>
            </div>
        </div>
        
        <!-- Right Side - Registration Form -->
        <div class="form-section">
            <!-- Mobile Brand (visible only on small screens) -->
            <div class="mobile-brand">
                <div class="brand-icon">A</div>
                <span class="brand-name">Astra Corp</span>
            </div>
            
            <div class="register-card">
                <div class="register-header">
                    <h2>Create Account</h2>
                    <p>Fill in your details to get started</p>
                </div>
                
                @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        <strong>Oops! There were some problems with your input.</strong>
                    </div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form method="POST" action="{{ route('register.submit') }}" id="registerForm">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
                        <label for="name"><i class="bi bi-person me-2"></i>Full Name</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                        <label for="email"><i class="bi bi-envelope me-2"></i>Email Address</label>
                    </div>
                    
                    <div class="form-floating mb-2 password-field">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required onkeyup="checkPasswordStrength()">
                        <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="bi bi-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    
                    <div class="password-strength">
                        <div class="password-strength-bar" id="passwordStrengthBar"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                    
                    <div class="password-requirements">
                        <p><i class="bi bi-shield-lock me-2"></i>Password should contain:</p>
                        <ul>
                            <li id="length-check">At least 8 characters</li>
                            <li id="uppercase-check">At least one uppercase letter</li>
                            <li id="number-check">At least one number</li>
                            <li id="special-check">At least one special character</li>
                        </ul>
                    </div>
                    
                    <div class="form-floating mb-4 password-field">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                        <label for="password_confirmation"><i class="bi bi-lock-fill me-2"></i>Confirm Password</label>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <i class="bi bi-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                    
                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-register w-100 mb-3">
                        <i class="bi bi-person-plus me-2"></i>Create Account
                    </button>
                </form>
                
                <div class="divider">or sign up with</div>
                
                <div class="social-login">
                    <button class="btn-social btn-google">
                        <i class="bi bi-google"></i>
                        <span>Google</span>
                    </button>
                    <button class="btn-social btn-facebook">
                        <i class="bi bi-facebook"></i>
                        <span>Facebook</span>
                    </button>
                </div>
                
                <div class="register-footer">
                    <p>Already have an account? <a href="{{ route('login.form') }}">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
        
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('strengthText');
            
            // Check requirements
            const hasLength = password.length >= 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            
            // Update requirement indicators
            document.getElementById('length-check').className = hasLength ? 'valid' : '';
            document.getElementById('uppercase-check').className = hasUpperCase ? 'valid' : '';
            document.getElementById('number-check').className = hasNumber ? 'valid' : '';
            document.getElementById('special-check').className = hasSpecial ? 'valid' : '';
            
            // Calculate strength
            let strength = 0;
            if (password.length > 0) strength += 1;
            if (hasLength) strength += 1;
            if (hasUpperCase) strength += 1;
            if (hasNumber) strength += 1;
            if (hasSpecial) strength += 1;
            
            // Update strength bar
            strengthBar.className = 'password-strength-bar';
            strengthText.className = 'strength-text';
            
            if (password.length === 0) {
                strengthBar.style.width = '0';
                strengthText.textContent = '';
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.classList.add('text-weak');
                strengthText.textContent = 'Weak';
            } else if (strength === 3) {
                strengthBar.classList.add('strength-fair');
                strengthText.classList.add('text-fair');
                strengthText.textContent = 'Fair';
            } else if (strength === 4) {
                strengthBar.classList.add('strength-good');
                strengthText.classList.add('text-good');
                strengthText.textContent = 'Good';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.classList.add('text-strong');
                strengthText.textContent = 'Strong';
            }
        }
        
        // Check password match
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.setCustomValidity("Passwords don't match");
            } else {
                this.setCustomValidity('');
            }
        });
        
        // Initialize password strength on page load
        document.addEventListener('DOMContentLoaded', function() {
            checkPasswordStrength();
        });
    </script>
</body>
</html>