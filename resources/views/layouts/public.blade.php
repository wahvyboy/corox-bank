<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Corox Bank — Leading Commercial & Digital Banking Solutions. Member FDIC.">
    <meta name="application-name" content="Corox Bank">
    <meta name="robots" content="noindex, nofollow">

    <title>Corox Bank | @yield('title', 'Premier Commercial & Digital Banking')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css?v={{ time() }}">
    @yield('styles')
</head>
<body>

    <!-- Corox Institutional Top Utility Bar -->
    <div class="wf-utility-bar">
        <div class="wf-utility-inner">
            <div class="wf-segments">
                <a href="{{ route('home') }}" class="wf-segment {{ request()->routeIs('home') || request()->routeIs('personal') ? 'active' : '' }}">Personal</a>
                <a href="{{ route('business') }}" class="wf-segment {{ request()->routeIs('business') ? 'active' : '' }}">Small Business</a>
                <a href="{{ route('business') }}" class="wf-segment">Commercial</a>
                <a href="{{ route('wealth') }}" class="wf-segment {{ request()->routeIs('wealth') ? 'active' : '' }}">Wealth Management</a>
            </div>
            <div class="wf-quick-links">
                <a href="{{ route('about') }}">About Corox</a>
                <a href="{{ route('security') }}">Security & FDIC</a>
                <a href="{{ route('contact') }}">Contact Us</a>
                <span class="wf-wire-desk-badge">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Wire Desk: 1-800-COROX-BK
                </span>
            </div>
        </div>
    </div>

    <!-- Main Institutional Header -->
    <header class="site-header">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="brand-logo">
                <img src="/images/corox_logo.png" alt="Corox Bank Logo" class="brand-logo-img" style="height: 48px; width: auto; object-fit: contain;" loading="eager" fetchpriority="high">
            </a>

            <nav>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('personal') }}" class="nav-link {{ request()->routeIs('personal') ? 'active' : '' }}">Banking</a></li>
                    <li><a href="{{ route('cards') }}" class="nav-link {{ request()->routeIs('cards') ? 'active' : '' }}">Credit Cards</a></li>
                    <li><a href="{{ route('loans') }}" class="nav-link {{ request()->routeIs('loans') ? 'active' : '' }}">Loans & Mortgages</a></li>
                    <li><a href="{{ route('business') }}" class="nav-link {{ request()->routeIs('business') ? 'active' : '' }}">Business & Treasury</a></li>
                    <li><a href="{{ route('wealth') }}" class="nav-link {{ request()->routeIs('wealth') ? 'active' : '' }}">Wealth</a></li>
                    <li><a href="{{ route('security') }}" class="nav-link {{ request()->routeIs('security') ? 'active' : '' }}">Security</a></li>
                </ul>
            </nav>

            <div class="header-cta">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-nav header-btn-portal">Online Banking</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-nav header-btn-portal">Online Banking</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-nav header-btn-signon">Sign On</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-nav header-btn-register">Open Account</a>
                @endauth
                <button class="nav-mobile-btn" id="mobileMenuToggle" onclick="openMobileDrawer()" aria-label="Open Navigation Menu" aria-expanded="false" aria-controls="mobileDrawer">
                    <span class="nav-mobile-btn-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </span>
                    <span class="nav-mobile-btn-text">MENU</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Moving Live Ticker Bar (Pure White Institutional Style) -->
    <div class="ticker-bar" id="heroTickerBar">
        <div class="ticker-container">
            <div class="ticker-badge">
                <span class="pulse-dot"></span> LIVE RATES &amp; MARKETS
            </div>
            <div class="ticker-track-wrapper">
                <div class="ticker-track" id="tickerTrack">
                    <!-- First Loop -->
                    <div class="ticker-item"><span class="ticker-label">INSTITUTION:</span><span class="ticker-val">Corox Commercial Bank</span></div>
                    <div class="ticker-item"><span class="ticker-label">Corox High-Yield Savings:</span><span class="ticker-val ticker-up">5.15% APY</span></div>
                    <div class="ticker-item"><span class="ticker-label">12-Month Fixed CD:</span><span class="ticker-val ticker-up">4.85% APY</span></div>
                    <div class="ticker-item"><span class="ticker-label">30-Yr Fixed Mortgage:</span><span class="ticker-val">5.98% APR</span></div>
                    <div class="ticker-item"><span class="ticker-label">Corox ABA Routing:</span><span class="ticker-val">026009593</span></div>
                    <div class="ticker-item"><span class="ticker-label">FDIC Insurance:</span><span class="ticker-val ticker-up">$250,000 Protected</span></div>
                    <div class="ticker-item"><span class="ticker-label">S&amp;P 500:</span><span class="ticker-val ticker-up" id="sp500-val">5,612.40 ▲ +0.85%</span></div>
                    <div class="ticker-item"><span class="ticker-label">NASDAQ:</span><span class="ticker-val ticker-up" id="nasdaq-val">17,890.15 ▲ +1.12%</span></div>
                    <div class="ticker-item"><span class="ticker-label">DOW JONES:</span><span class="ticker-val ticker-up" id="dow-val">40,845.20 ▲ +0.45%</span></div>
                    <div class="ticker-item"><span class="ticker-label">GOLD (XAU/USD):</span><span class="ticker-val ticker-up" id="gold-val">$2,425.80/oz ▲ +1.20%</span></div>
                    <div class="ticker-item"><span class="ticker-label">CRUDE OIL (WTI):</span><span class="ticker-val ticker-down" id="oil-val">$78.40/bbl ▼ -0.65%</span></div>
                    <div class="ticker-item"><span class="ticker-label">10-YR TREASURY:</span><span class="ticker-val ticker-down" id="treasury-val">4.18% ▼ -0.04</span></div>

                    <!-- Duplicate Loop for Seamless Infinite Scroll -->
                    <div class="ticker-item"><span class="ticker-label">INSTITUTION:</span><span class="ticker-val">Corox Commercial Bank</span></div>
                    <div class="ticker-item"><span class="ticker-label">Corox High-Yield Savings:</span><span class="ticker-val ticker-up">5.15% APY</span></div>
                    <div class="ticker-item"><span class="ticker-label">12-Month Fixed CD:</span><span class="ticker-val ticker-up">4.85% APY</span></div>
                    <div class="ticker-item"><span class="ticker-label">30-Yr Fixed Mortgage:</span><span class="ticker-val">5.98% APR</span></div>
                    <div class="ticker-item"><span class="ticker-label">Corox ABA Routing:</span><span class="ticker-val">026009593</span></div>
                    <div class="ticker-item"><span class="ticker-label">FDIC Insurance:</span><span class="ticker-val ticker-up">$250,000 Protected</span></div>
                    <div class="ticker-item"><span class="ticker-label">S&amp;P 500:</span><span class="ticker-val ticker-up" id="sp500-val2">5,612.40 ▲ +0.85%</span></div>
                    <div class="ticker-item"><span class="ticker-label">NASDAQ:</span><span class="ticker-val ticker-up" id="nasdaq-val2">17,890.15 ▲ +1.12%</span></div>
                    <div class="ticker-item"><span class="ticker-label">DOW JONES:</span><span class="ticker-val ticker-up" id="dow-val2">40,845.20 ▲ +0.45%</span></div>
                    <div class="ticker-item"><span class="ticker-label">GOLD (XAU/USD):</span><span class="ticker-val ticker-up" id="gold-val2">$2,425.80/oz ▲ +1.20%</span></div>
                    <div class="ticker-item"><span class="ticker-label">CRUDE OIL (WTI):</span><span class="ticker-val ticker-down" id="oil-val2">$78.40/bbl ▼ -0.65%</span></div>
                    <div class="ticker-item"><span class="ticker-label">10-YR TREASURY:</span><span class="ticker-val ticker-down" id="treasury-val2">4.18% ▼ -0.04</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer Backdrop -->
    <div class="mobile-nav-backdrop" id="mobileDrawerBackdrop" onclick="closeMobileDrawer()" aria-hidden="true"></div>

    <!-- Mobile Navigation Drawer -->
    <aside class="mobile-nav-drawer" id="mobileDrawer" role="dialog" aria-modal="true" aria-label="Mobile Navigation Menu">
        <div class="mobile-nav-header">
            <a href="{{ route('home') }}" class="mobile-nav-brand">
                <img src="/images/corox_logo_white_text.png" alt="Corox Bank Logo" class="brand-logo-img" style="height: 38px;">
            </a>
            <button class="mobile-drawer-close" onclick="closeMobileDrawer()" aria-label="Close Navigation Menu">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Banking Segments Selector (Moved from header on mobile) -->
        <div class="drawer-segments-wrapper">
            <div class="drawer-segments-title">Select Banking Division</div>
            <div class="drawer-segments-grid">
                <a href="{{ route('home') }}" class="drawer-segment-pill {{ request()->routeIs('home') || request()->routeIs('personal') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Personal</span>
                </a>
                <a href="{{ route('business') }}" class="drawer-segment-pill {{ request()->routeIs('business') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Small Business</span>
                </a>
                <a href="{{ route('business') }}" class="drawer-segment-pill">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Commercial</span>
                </a>
                <a href="{{ route('wealth') }}" class="drawer-segment-pill {{ request()->routeIs('wealth') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    <span>Wealth Mgmt</span>
                </a>
            </div>
        </div>

        <!-- Mobile Quick Action Portal Buttons -->
        <div class="mobile-drawer-cta">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="btn btn-primary btn-block">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                    Online Banking Portal
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary btn-block">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Sign On to Account
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-block">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Open New Account
                </a>
            @endauth
        </div>

        <!-- Organized Categorized Navigation Groups -->
        <div class="mobile-drawer-content">
            <div class="mobile-nav-group">
                <div class="mobile-nav-group-title">Personal &amp; Commercial Banking</div>
                <ul class="mobile-nav-list">
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                            </span>
                            <span>Home Overview</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('personal') }}" class="{{ request()->routeIs('personal') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </span>
                            <span>Banking &amp; Checking</span>
                            <span class="mobile-nav-badge">5.15% APY</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cards') }}" class="{{ request()->routeIs('cards') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </span>
                            <span>Credit Cards (Infinite Metal)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loans') }}" class="{{ request()->routeIs('loans') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </span>
                            <span>Loans &amp; Mortgages</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mobile-nav-group">
                <div class="mobile-nav-group-title">Corporate &amp; Wealth Solutions</div>
                <ul class="mobile-nav-list">
                    <li>
                        <a href="{{ route('business') }}" class="{{ request()->routeIs('business') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <span>Business &amp; Treasury Clearing</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wealth') }}" class="{{ request()->routeIs('wealth') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            </span>
                            <span>Private Wealth &amp; Advisory</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mobile-nav-group">
                <div class="mobile-nav-group-title">Security, Support &amp; Information</div>
                <ul class="mobile-nav-list">
                    <li>
                        <a href="{{ route('security') }}" class="{{ request()->routeIs('security') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </span>
                            <span>Security Guarantee &amp; FDIC</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </span>
                            <span>About Corox Bank</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                            <span class="mobile-nav-icon">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </span>
                            <span>Customer Support Desk</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Drawer Institutional Regulatory Footer -->
        <div class="mobile-drawer-footer">
            <div class="drawer-support-card">
                <div class="drawer-support-title">Direct Wire Desk</div>
                <div class="drawer-support-phone">1-800-COROX-BK</div>
                <div class="drawer-support-sub">Routing No: 026009593 • Member FDIC</div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Mobile Bottom Navigation Bar (Thumb Zone) -->
    <nav class="mobile-bottom-bar" aria-label="Mobile Bottom Navigation">
        <a href="{{ route('home') }}" class="mobile-bottom-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
            <span>Home</span>
        </a>
        <a href="{{ route('personal') }}" class="mobile-bottom-item {{ request()->routeIs('personal') ? 'active' : '' }}">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            <span>Banking</span>
        </a>
        <a href="{{ route('cards') }}" class="mobile-bottom-item {{ request()->routeIs('cards') ? 'active' : '' }}">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Cards</span>
        </a>
        @auth
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="mobile-bottom-item">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Portal</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="mobile-bottom-item {{ request()->routeIs('login') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span>Sign On</span>
            </a>
        @endauth
        <button type="button" class="mobile-bottom-item" onclick="openMobileDrawer()" aria-label="Open Navigation Menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            <span>Menu</span>
        </button>
    </nav>

    <!-- Site Footer in Corox Brand Red (#CC0000) -->
    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="brand-logo" style="margin-bottom: 1.2rem;">
                    <img src="/images/corox_logo_white_text.png" alt="Corox Bank Logo" class="brand-logo-img" style="height: 44px; filter: brightness(1);" loading="eager">
                </div>
                <p style="color: rgba(255, 255, 255, 0.9); font-size: 14px; line-height: 1.7; margin-bottom: 1.2rem;">
                    Corox Bank provides commercial clearing, digital financial solutions, FedWire/ACH payment rails, and private wealth management for individuals and corporations nationwide.
                </p>
                <p style="color: #FFFFFF; font-size: 13px; font-weight: 700; margin-bottom: 1rem;">
                    FedWire &amp; ACH Routing Number: 026009593
                </p>

                <!-- Social Media Links -->
                <div class="social-links" style="display: flex; gap: 0.8rem; align-items: center; margin-top: 1.2rem;">
                    <a href="#" aria-label="LinkedIn" class="social-icon-btn">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.25V10.9H6.46M7.86 6.75a1.47 1.47 0 1 0 0 2.94 1.47 1.47 0 0 0 0-2.94Z"/></svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="social-icon-btn">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H7.5v-3H10V9.5C10 7.01 11.49 5.65 13.75 5.65c1.08 0 2.21.19 2.21.19v2.43h-1.25c-1.23 0-1.61.77-1.61 1.56V12h2.73l-.44 3h-2.29v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="social-icon-btn">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Banking Solutions</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('personal') }}">Commercial Checking</a></li>
                    <li><a href="{{ route('personal') }}">High-Yield Savings (5.15% APY)</a></li>
                    <li><a href="{{ route('business') }}">Corporate Treasury Clearing</a></li>
                    <li><a href="{{ route('wealth') }}">Private Wealth &amp; Advisory</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Financing &amp; Cards</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('cards') }}">Corox Infinite Metal Cards</a></li>
                    <li><a href="{{ route('loans') }}">Fixed Rate Mortgages</a></li>
                    <li><a href="{{ route('loans') }}">Commercial Lines of Credit</a></li>
                    <li><a href="{{ route('cards') }}">Business Executive Cards</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Security &amp; Regulatory</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('security') }}">Member FDIC ($250,000 Protection)</a></li>
                    <li><a href="{{ route('security') }}">256-Bit Financial Encryption</a></li>
                    <li><a href="{{ route('about') }}">About Corox Bank</a></li>
                    <li><a href="{{ route('contact') }}">Customer Support &amp; Wire Desk</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; 2026 Corox Bank. All Rights Reserved. Member FDIC. Equal Housing Lender. Investment and insurance products are not FDIC insured, not bank guaranteed, and may lose value.</div>
        </div>
    </footer>

    <!-- Financial Ticker & Mobile Drawer Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const marketAssets = {
                sp500: { price: 5612.40, change: 0.85, ids: ['sp500-val', 'sp500-val2'] },
                nasdaq: { price: 17890.15, change: 1.12, ids: ['nasdaq-val', 'nasdaq-val2'] },
                dow: { price: 40845.20, change: 0.45, ids: ['dow-val', 'dow-val2'] },
                gold: { price: 2425.80, change: 1.20, ids: ['gold-val', 'gold-val2'], prefix: '$', suffix: '/oz' },
                oil: { price: 78.40, change: -0.65, ids: ['oil-val', 'oil-val2'], prefix: '$', suffix: '/bbl' },
                treasury: { price: 4.18, change: -0.04, ids: ['treasury-val', 'treasury-val2'], prefix: '', suffix: '%' }
            };

            function updatePrices() {
                Object.keys(marketAssets).forEach(key => {
                    const asset = marketAssets[key];
                    const delta = (Math.random() - 0.48) * (asset.price * 0.0012);
                    asset.price = +(asset.price + delta).toFixed(2);
                    
                    const isUp = delta >= 0;
                    const arrow = isUp ? '▲' : '▼';
                    const changeFormatted = `${arrow} ${isUp ? '+' : ''}${(asset.change + delta * 0.05).toFixed(2)}%`;
                    const priceFormatted = `${asset.prefix || ''}${asset.price.toLocaleString('en-US')}${asset.suffix || ''}`;

                    asset.ids.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) {
                            el.className = `ticker-val ${isUp ? 'ticker-up' : 'ticker-down'}`;
                            el.innerHTML = `${priceFormatted} ${changeFormatted}`;
                        }
                    });
                });
            }

            // Optimize Ticker Animation & Battery Usage with IntersectionObserver
            const tickerBar = document.getElementById('heroTickerBar');
            const tickerTrack = document.getElementById('tickerTrack');
            let tickerInterval = null;

            function startTickerUpdates() {
                if (!tickerInterval) {
                    tickerInterval = setInterval(updatePrices, 3500);
                    if (tickerTrack) tickerTrack.style.animationPlayState = 'running';
                }
            }

            function stopTickerUpdates() {
                if (tickerInterval) {
                    clearInterval(tickerInterval);
                    tickerInterval = null;
                    if (tickerTrack) tickerTrack.style.animationPlayState = 'paused';
                }
            }

            if (tickerBar && 'IntersectionObserver' in window) {
                const tickerObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            startTickerUpdates();
                        } else {
                            stopTickerUpdates();
                        }
                    });
                }, { threshold: 0.05 });
                tickerObserver.observe(tickerBar);
            } else {
                startTickerUpdates();
            }
        });

        // Mobile Navigation Drawer Handlers with Focus Trapping (inert)
        function openMobileDrawer() {
            const drawer = document.getElementById('mobileDrawer');
            const backdrop = document.getElementById('mobileDrawerBackdrop');
            const toggleBtn = document.getElementById('mobileMenuToggle');
            const mainEl = document.querySelector('main');

            if (drawer && backdrop) {
                drawer.style.transform = '';
                drawer.classList.add('open');
                backdrop.classList.add('open');
                document.body.classList.add('drawer-open');
                if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
                if (mainEl) mainEl.inert = true;
                drawer.focus();
            }
        }

        function closeMobileDrawer() {
            const drawer = document.getElementById('mobileDrawer');
            const backdrop = document.getElementById('mobileDrawerBackdrop');
            const toggleBtn = document.getElementById('mobileMenuToggle');
            const mainEl = document.querySelector('main');

            if (drawer && backdrop) {
                drawer.style.transform = '';
                drawer.classList.remove('open');
                backdrop.classList.remove('open');
                document.body.classList.remove('drawer-open');
                if (toggleBtn) {
                    toggleBtn.setAttribute('aria-expanded', 'false');
                    toggleBtn.focus();
                }
                if (mainEl) mainEl.inert = false;
            }
        }

        // Close mobile drawer on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.key === 'Esc') {
                closeMobileDrawer();
            }
        });

        // Touch Swipe-to-Dismiss Gesture
        (function initDrawerSwipe() {
            const drawer = document.getElementById('mobileDrawer');
            if (!drawer) return;

            let startX = 0;
            let currentX = 0;
            let isSwiping = false;

            drawer.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
                currentX = startX;
                isSwiping = true;
                drawer.style.transition = 'none';
            }, { passive: true });

            drawer.addEventListener('touchmove', function(e) {
                if (!isSwiping) return;
                currentX = e.touches[0].clientX;
                const deltaX = currentX - startX;
                // Only allow dragging to the right (dismiss direction)
                if (deltaX > 0) {
                    drawer.style.transform = `translateX(${deltaX}px)`;
                }
            }, { passive: true });

            drawer.addEventListener('touchend', function(e) {
                if (!isSwiping) return;
                isSwiping = false;
                drawer.style.transition = 'transform 0.3s cubic-bezier(0.16, 1, 0.3, 1)';
                const deltaX = currentX - startX;
                if (deltaX > 75) {
                    closeMobileDrawer();
                } else {
                    drawer.style.transform = '';
                }
            }, { passive: true });
        })();
    </script>
    @yield('scripts')
</body>
</html>
