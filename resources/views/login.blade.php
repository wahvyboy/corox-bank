<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Corox Bank | Sign In</title>
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
    </style>
</head>
<body>
    <div class="auth-wrapper" style="flex-direction: column; justify-content: center;">
        <div style="width: 100%; max-width: 500px; display: flex; justify-content: flex-start;">
            <a href="{{ route('home') }}" class="back-home-btn">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Website Home
            </a>
        </div>

        <div class="auth-card">
            <div class="auth-brand" style="margin-bottom: 1.8rem;">
                <a href="{{ route('home') }}" style="display: inline-block;">
                    <img src="/images/corox_logo_transparent.png" alt="Corox Bank Official Logo" style="max-height: 85px; width: auto; object-fit: contain;">
                </a>
                <h1 style="margin-top: 1.2rem; font-size: 1.5rem; color: var(--brand-dark); font-weight: 800;">Sign In to Online Banking</h1>
                <p style="color: var(--text-muted-dark); font-size: 13px; margin-top: 0.2rem;">Secure 256-Bit Encrypted Financial Portal</p>
            </div>

            @if($errors->has('loginError'))
                <div class="alert alert-error">
                    {{ $errors->first('loginError') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">User ID / Username</label>
                    <input type="text" name="name" id="name" class="form-control" required autofocus placeholder="Enter your User ID">
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 1rem;">Sign In to Account</button>
            </form>

            <div style="text-align: center; margin-top: 2rem; font-size: 14px;">
                <p style="color: var(--text-muted-dark);">Don't have an online banking account yet? <a href="{{ route('register') }}" style="color: var(--brand-red); font-weight:800;">Open USD Account</a></p>
            </div>
        </div>
    </div>
</body>
</html>
