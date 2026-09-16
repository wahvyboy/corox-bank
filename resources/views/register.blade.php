<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Corox Bank | Open Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .back-home-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted-light);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 1.5rem;
            transition: all 0.25s ease;
            padding: 8px 16px;
            border-radius: var(--radius-pill);
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .back-home-btn:hover {
            color: var(--pure-white);
            background: var(--brand-red);
            transform: translateX(-3px);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }
        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        .form-section-title {
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--brand-red);
            margin: 1.8rem 0 1rem;
            padding-bottom: 0.4rem;
            border-bottom: 1px solid var(--border-subtle);
        }
    </style>
</head>
<body>
    <div class="auth-wrapper" style="padding: 4rem 1.5rem; flex-direction: column; justify-content: center;">
        <div style="width: 100%; max-width: 680px; display: flex; justify-content: flex-start;">
            <a href="{{ route('home') }}" class="back-home-btn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Website Home
            </a>
        </div>

        <div class="auth-card" style="max-width: 680px;">
            <div class="auth-brand" style="margin-bottom: 1.8rem;">
                <a href="{{ route('home') }}" style="display: inline-block;">
                    <img src="/images/corox_logo_transparent.png" alt="Corox Bank Official Logo" style="max-height: 85px; width: auto; object-fit: contain;">
                </a>
                <h1 style="margin-top: 1.2rem; font-size: 1.5rem; color: var(--brand-dark); font-weight: 800;">Open Your Corox Account</h1>
                <p style="color: var(--text-muted-dark); font-size: 13px; margin-top: 0.3rem;">Complete your application to open a USD Commercial Checking or High-Yield Savings account.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin-left: 1.2rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <!-- Section 1: Personal Details -->
                <div class="form-section-title" style="margin-top: 0;">1. Personal Information</div>
                
                <div class="form-group">
                    <label for="full_name" class="form-label">Legal Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required placeholder="e.g. Johnathan Alexander Doe">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="john.doe@example.com">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required placeholder="+1 (555) 019-2834">
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                </div>

                <!-- Section 2: Residential Address -->
                <div class="form-section-title">2. Residential Address</div>

                <div class="form-group">
                    <label for="address" class="form-label">Street Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required placeholder="123 Financial Plaza, Suite 400">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required placeholder="New York">
                    </div>
                    <div class="form-group">
                        <label for="state" class="form-label">State</label>
                        <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" required placeholder="NY">
                    </div>
                </div>

                <div class="form-group">
                    <label for="zip_code" class="form-label">Zip Code</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ old('zip_code') }}" required placeholder="10005">
                </div>

                <!-- Section 3: Account Type & Credentials -->
                <div class="form-section-title">3. Account Type & Portal Credentials</div>

                <div class="form-group">
                    <label for="account_type_requested" class="form-label">Initial USD Account Selection</label>
                    <select name="account_type_requested" id="account_type_requested" class="form-control" required>
                        <option value="Checking" {{ old('account_type_requested') == 'Checking' ? 'selected' : '' }}>Corox Commercial Checking (USD)</option>
                        <option value="Savings" {{ old('account_type_requested') == 'Savings' ? 'selected' : '' }}>Corox High-Yield Savings (5.15% APY USD)</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">Account Username</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="Choose a username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password (min 8 chars)</label>
                        <input type="password" name="password" id="password" class="form-control" required placeholder="Create a password">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 1.5rem;">Submit Account Application</button>
            </form>

            <div style="text-align: center; margin-top: 2rem; font-size: 14px;">
                <p style="color: var(--text-muted-dark);">Already have an account? <a href="{{ route('login') }}" style="color: var(--brand-red); font-weight:800;">Sign In</a></p>
            </div>
        </div>
    </div>
</body>
</html>
