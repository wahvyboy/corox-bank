<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="application-name" content="Corox Bank">
    <meta name="description" content="Corox Bank Commercial Banking &amp; Digital Wealth Management Platform">

    <title>Corox Bank | @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    @yield('styles')
</head>
<body>

    <!-- Corox Institutional Mobile Portal Top Bar (Red Header) -->
    <header class="app-mobile-topbar">
        <button class="app-mobile-user-btn" onclick="toggleSidebar()" aria-label="User Account">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </button>
        <a href="{{ route('home') }}" class="app-mobile-brand-title">
            COROX BANK
        </a>
        <button class="app-mobile-nav-toggle" onclick="toggleSidebar()" aria-label="Toggle Navigation Menu">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </header>

    <!-- Sidebar Backdrop for Mobile -->
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()" aria-hidden="true"></div>

    <div class="app-layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <a href="{{ route('home') }}" style="display: flex; align-items: center; text-decoration: none;">
                    <img src="/images/corox_logo_white_text.png" alt="Corox Bank Logo" style="height: 42px; width: auto; object-fit: contain;">
                </a>
                <button class="sidebar-close-btn" onclick="toggleSidebar()" aria-label="Close Sidebar">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="sidebar-nav">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <div class="sidebar-nav-label">Administration</div>
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                            Admin Dashboard
                        </a>
                        <a href="{{ route('show.users') }}" class="{{ request()->routeIs('show.users') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            User Directory
                        </a>
                        <a href="{{ route('show.requests') }}" class="{{ request()->routeIs('show.requests') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            Account Requests
                        </a>

                        <div class="sidebar-nav-label">Operations</div>
                        <a href="{{ route('show.admin.deposit.form') }}" class="{{ request()->routeIs('show.admin.deposit.form') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
                            Deposit USD
                        </a>
                        <a href="{{ route('show.admin.withdraw.form') }}" class="{{ request()->routeIs('show.admin.withdraw.form') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20V4m0 0l-4 4m4-4l4 4"/></svg>
                            Withdraw USD
                        </a>
                        <a href="{{ route('show.admin.transfer.form') }}" class="{{ request()->routeIs('show.admin.transfer.form') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                            Wire Transfer
                        </a>
                        <a href="{{ route('show.admin.create.account.form') }}" class="{{ request()->routeIs('show.admin.create.account.form') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Create USD Account
                        </a>
                    @else
                        <div class="sidebar-nav-label">Client Portal</div>
                        <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                            My Dashboard
                        </a>
                        <a href="{{ route('show.bank.accounts') }}" class="{{ request()->routeIs('show.bank.accounts') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            My USD Accounts
                        </a>
                        <a href="{{ route('show.transaction.history') }}" class="{{ request()->routeIs('show.transaction.history') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Transaction History
                        </a>

                        <div class="sidebar-nav-label">Transactions</div>
                        <a href="{{ route('show.transfer.form') }}" class="{{ request()->routeIs('show.transfer.form') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                            Send Wire / ACH
                        </a>
                        <a href="{{ route('show.deposit.form') }}" class="{{ request()->routeIs('show.deposit.form') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
                            Deposit USD
                        </a>
                        <a href="{{ route('show.withdraw.form') }}" class="{{ request()->routeIs('show.withdraw.form') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20V4m0 0l-4 4m4-4l4 4"/></svg>
                            Withdraw USD
                        </a>
                        <a href="{{ route('create.bank.account') }}" class="{{ request()->routeIs('create.bank.account') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            Request New Account
                        </a>
                    @endif
                @endauth
            </nav>

            @auth
            <div class="sidebar-footer">
                <div style="margin-bottom: 0.8rem; font-size: 13px;">
                    <div style="color: var(--text-muted-light);">Signed in as:</div>
                    <strong style="color: var(--pure-white);">{{ Auth::user()->name }}</strong>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-block">
                        Sign Out
                    </button>
                </form>
            </div>
            @endauth
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Authenticated Mobile Bottom Navigation Bar (Corox Institutional Mobile Tab Bar) -->
    <nav class="mobile-bottom-bar app-bottom-bar" aria-label="Portal Navigation">
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="mobile-bottom-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                    <span>Admin</span>
                </a>
                <a href="{{ route('show.users') }}" class="mobile-bottom-item {{ request()->routeIs('show.users') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Users</span>
                </a>
                <a href="{{ route('show.requests') }}" class="mobile-bottom-item {{ request()->routeIs('show.requests') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>Requests</span>
                </a>
                <a href="{{ route('show.admin.transfer.form') }}" class="mobile-bottom-item {{ request()->routeIs('show.admin.transfer.form') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                    <span>Wire</span>
                </a>
            @else
                <a href="{{ route('user.dashboard') }}" class="mobile-bottom-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                    <span>Accounts</span>
                </a>
                <a href="{{ route('show.transfer.form') }}" class="mobile-bottom-item {{ request()->routeIs('show.transfer.form') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                    <span>Transfer</span>
                </a>
                <a href="{{ route('show.transfer.form') }}?type=wire" class="mobile-bottom-item">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Wire / Pay</span>
                </a>
                <a href="{{ route('show.deposit.form') }}" class="mobile-bottom-item {{ request()->routeIs('show.deposit.form') ? 'active' : '' }}">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span>Deposit</span>
                </a>
            @endif
        @endauth
        <button type="button" class="mobile-bottom-item" onclick="toggleSidebar()" aria-label="Open Menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            <span>Menu</span>
        </button>
    </nav>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar && backdrop) {
                sidebar.style.transform = '';
                const isOpen = sidebar.classList.toggle('open');
                backdrop.classList.toggle('open', isOpen);
                document.body.classList.toggle('sidebar-open', isOpen);
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.key === 'Esc') {
                const sidebar = document.getElementById('sidebar');
                const backdrop = document.getElementById('sidebarBackdrop');
                if (sidebar && sidebar.classList.contains('open')) {
                    sidebar.style.transform = '';
                    sidebar.classList.remove('open');
                    if (backdrop) backdrop.classList.remove('open');
                    document.body.classList.remove('sidebar-open');
                }
            }
        });

        // Swipe-to-dismiss (swipe left) on Sidebar
        (function initSidebarSwipe() {
            const sidebar = document.getElementById('sidebar');
            if (!sidebar) return;

            let startX = 0;
            let currentX = 0;
            let isSwiping = false;

            sidebar.addEventListener('touchstart', function(e) {
                if (!sidebar.classList.contains('open')) return;
                startX = e.touches[0].clientX;
                currentX = startX;
                isSwiping = true;
                sidebar.style.transition = 'none';
            }, { passive: true });

            sidebar.addEventListener('touchmove', function(e) {
                if (!isSwiping) return;
                currentX = e.touches[0].clientX;
                const deltaX = currentX - startX;
                // Only allow dragging to the left (dismiss direction for left-sided sidebar)
                if (deltaX < 0) {
                    sidebar.style.transform = `translateX(${deltaX}px)`;
                }
            }, { passive: true });

            sidebar.addEventListener('touchend', function(e) {
                if (!isSwiping) return;
                isSwiping = false;
                sidebar.style.transition = 'transform 0.3s cubic-bezier(0.16, 1, 0.3, 1)';
                const deltaX = currentX - startX;
                if (deltaX < -70) {
                    toggleSidebar();
                } else {
                    sidebar.style.transform = '';
                }
            }, { passive: true });
        })();
    </script>
    @yield('scripts')
</body>
</html>
