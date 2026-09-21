@extends('layouts.app')
@section('title', 'Account Summary')
@section('content')

<div class="wf-dashboard-wrapper">
    <!-- Wells Fargo Desktop Top Red Bar (Image 4) -->
    <div class="wf-desktop-topbar">
        <div class="wf-desktop-topbar-brand">
            <span>COROX BANK</span>
            <span class="wf-desktop-topbar-tagline">Commercial &amp; Private Wealth Portal</span>
        </div>
        <div class="wf-desktop-topbar-links">
            <a href="{{ route('show.transfer.form') }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                Transfer &amp; Pay
            </a>
            <a href="{{ route('show.transaction.history') }}">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Statements &amp; Activity
            </a>
            <span class="wf-desktop-topbar-wire">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                Wire Desk: 1-800-COROX-BK
            </span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="wf-desktop-topbar-signoff">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Off
                </button>
            </form>
        </div>
    </div>

    <!-- Account Summary Header Bar (Images 1, 2, 4) -->
    <div class="wf-summary-bar">
        <div class="wf-summary-selector">
            <h1 class="wf-summary-title">Account Summary</h1>
            <div class="wf-account-filter-pill">
                <span>Business and Personal Accounts</span>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>
        <div class="wf-summary-meta">
            <div class="wf-meta-item">
                <span class="wf-meta-label">Total Liquidity:</span>
                <span class="wf-meta-val">${{ number_format($totalBalance ?? Auth::user()->accounts()->where('status', 'active')->sum('balance'), 2) }}</span>
            </div>
            <div class="wf-meta-badge">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                ABA 026009593 • FDIC Insured
            </div>
        </div>
    </div>

    <!-- Wells Fargo 2-Column Desktop Grid / 1-Column Mobile Layout (Image 4) -->
    <div class="wf-dashboard-grid">
        <!-- Left Main Accounts Column (~68%) -->
        <div class="wf-accounts-column">
            <!-- Account Cards (Images 1, 2, 4) -->
            <div class="wf-account-cards-list">
                @forelse($accounts as $index => $acc)
                    <div class="wf-account-card">
                        <div class="wf-account-card-main">
                            <div class="wf-account-card-left">
                                <div class="wf-account-icon-box">
                                    @if($acc->account_type === 'Checking')
                                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    @else
                                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="wf-account-name">
                                        {{ strtoupper($acc->account_type === 'Checking' ? 'COMMERCIAL CHECKING' : 'HIGH-YIELD LIQUIDITY SAVINGS') }}
                                    </h3>
                                    <div class="wf-account-number">
                                        ...{{ substr($acc->account_number, -4) }}
                                        <span class="wf-account-routing">Routing: {{ $acc->routing_number ?? '026009593' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="wf-account-card-right">
                                <div class="wf-balance-amount">
                                    ${{ number_format($acc->balance, 2) }}
                                </div>
                                <div class="wf-balance-label">Available balance</div>
                            </div>

                            <div class="wf-account-card-menu">
                                <button class="wf-dots-btn" type="button" aria-label="Account actions">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Card Quick Action Links (Image 4) -->
                        <div class="wf-account-quick-links">
                            <a href="{{ route('show.transfer.form') }}?from={{ $acc->account_number }}" class="wf-quick-link">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                                Send Wire Transfer
                            </a>
                            <a href="{{ route('show.deposit.form') }}" class="wf-quick-link">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
                                Deposit USD
                            </a>
                            <a href="{{ route('show.transaction.history') }}?account_number={{ $acc->account_number }}" class="wf-quick-link">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                View Activity &amp; Statements
                            </a>
                        </div>
                    </div>

                    <!-- In-between Promotional Banner (Image 1 & 2) -->
                    @if($loop->first)
                        <div class="wf-promo-card">
                            <div class="wf-promo-content">
                                <div class="wf-promo-icon">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                                </div>
                                <span class="wf-promo-text">Earn 5.15% APY with Corox Commercial High-Yield Market Savings</span>
                            </div>
                            <a href="{{ route('show.deposit.form') }}" class="wf-promo-action">View Yield Rates →</a>
                        </div>
                    @endif
                @empty
                    <div class="wf-account-card" style="padding: 2.5rem; text-align: center;">
                        <p style="color: var(--text-muted-dark); font-size: 15px;">No active USD bank accounts found.</p>
                        <a href="{{ route('create.bank.account') }}" class="btn btn-primary" style="margin-top: 1rem;">Open a USD Account</a>
                    </div>
                @endforelse
            </div>

            <!-- In-Between Promo Banner 2: Wealth Advisory (Image 2) -->
            <div class="wf-advisory-banner">
                <div class="wf-advisory-left">
                    <div class="wf-advisory-pie">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    </div>
                    <div>
                        <div class="wf-advisory-title">Corox Advisors / Private Wealth Management</div>
                        <div class="wf-advisory-sub">Institutional asset allocation, fixed income treasuries, and bespoke estate planning.</div>
                    </div>
                </div>
                <a href="{{ route('wealth') }}" class="wf-advisory-btn">Explore Wealth Portal</a>
            </div>

            <!-- Recent Activity Section (Last Transaction: 3 years ago) -->
            <div class="wf-activity-card">
                <div class="wf-activity-header">
                    <div>
                        <h2 class="wf-activity-title">Recent Account Activity</h2>
                        <div class="wf-activity-sub">Last settlement recorded: September 18, 2023 (3 years ago)</div>
                    </div>
                    <a href="{{ route('show.transaction.history') }}" class="btn btn-secondary btn-sm" style="font-size: 13px; font-weight: 700;">
                        View All 720 Transactions →
                    </a>
                </div>

                <div class="table-responsive" style="margin-top: 1rem;">
                    <table class="wf-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description / Memo</th>
                                <th>Type</th>
                                <th style="text-align: right;">Amount (USD)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($recentTransactions) && $recentTransactions->count() > 0)
                                @foreach($recentTransactions as $tx)
                                    <tr>
                                        <td style="color: #6B7280; font-size: 13px; white-space: nowrap;">
                                            {{ $tx->created_at->format('M d, Y') }}
                                        </td>
                                        <td style="font-weight: 600; color: #1F2937; font-size: 13.5px;">
                                            {{ $tx->description ?? 'FedWire Settlement' }}
                                        </td>
                                        <td>
                                            @if($tx->transaction_type === 'deposit')
                                                <span class="badge badge-deposit">Deposit</span>
                                            @elseif($tx->transaction_type === 'withdraw')
                                                <span class="badge badge-withdraw">Wire Debit</span>
                                            @else
                                                <span class="badge badge-transfer">Internal Transfer</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; font-weight: 800; font-size: 14px; color: {{ $tx->transaction_type === 'deposit' ? 'var(--success)' : ($tx->transaction_type === 'withdraw' ? 'var(--brand-red)' : '#1F2937') }};">
                                            {{ $tx->transaction_type === 'deposit' ? '+' : ($tx->transaction_type === 'withdraw' ? '-' : '') }}${{ number_format($tx->amount, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" style="text-align: center; color: #6B7280; padding: 1.5rem;">No recent transactions recorded.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Account Disclosures (Image 4) -->
            <div class="wf-disclosures-box">
                <div class="wf-disclosures-title">* Account Disclosures</div>
                <p>Deposit products offered by Corox Bank, N.A. Member FDIC. Equal Housing Lender. Investment and insurance products are not FDIC insured, not bank guaranteed, and may lose value.</p>
                <p>FedWire and ACH routing operations are governed under Federal Reserve Regulation CC and the Uniform Commercial Code (UCC) Article 4A.</p>
            </div>
        </div>

        <!-- Right Sidebar Widgets Column (~32% - Image 4) -->
        <div class="wf-sidebar-column">
            <!-- User Greeting & Sign Off Card (Image 4) -->
            <div class="wf-user-widget">
                <div class="wf-user-greeting">
                    Welcome, {{ strtoupper(Auth::user()->full_name ?? Auth::user()->name) }}
                </div>
                <div class="wf-last-signon">
                    Your last sign on was September 18, 2023
                </div>
                <div class="wf-user-actions">
                    <a href="{{ route('show.bank.accounts') }}" class="wf-user-action-link">
                        <span>View or send messages</span>
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin-top: 0.5rem;">
                        @csrf
                        <button type="submit" class="wf-signoff-btn">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Sign Off
                        </button>
                    </form>
                </div>
            </div>

            <!-- Commercial Wire Desk Widget -->
            <div class="wf-tool-card">
                <div class="wf-tool-card-header">
                    <div class="wf-tool-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <div class="wf-tool-title">Direct Wire Desk</div>
                        <div class="wf-tool-phone">1-800-COROX-BK</div>
                    </div>
                </div>
                <div class="wf-tool-card-body">
                    <div class="wf-tool-detail">
                        <span>FedWire Routing:</span>
                        <strong>026009593</strong>
                    </div>
                    <div class="wf-tool-detail">
                        <span>Status:</span>
                        <strong style="color: var(--success);">Operational • Real-Time Settlement</strong>
                    </div>
                    <a href="{{ route('show.transfer.form') }}" class="btn btn-primary btn-block" style="margin-top: 0.8rem; font-size: 13px; font-weight: 700;">
                        Initiate Outward Wire
                    </a>
                </div>
            </div>

            <!-- Planning & Tools Accordion (Image 4) -->
            <div class="wf-accordion-card">
                <div class="wf-accordion-header">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Planning &amp; Tools
                </div>
                <ul class="wf-accordion-list">
                    <li>
                        <a href="{{ route('personal') }}">
                            <span>Calculate debt-to-income ratio</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wealth') }}">
                            <span>View My Retirement Plan&reg;</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cards') }}">
                            <span>View My Credit Options Guide</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('security') }}">
                            <span>FDIC $250k Coverage Certificate</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Service Offers & Feedback (Image 4) -->
            <div class="wf-offers-card">
                <div class="wf-offers-title">Commercial Service Offers</div>
                <ul class="wf-offers-list">
                    <li>
                        <a href="{{ route('business') }}">
                            <span>Set up corporate direct deposit</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('personal') }}">
                            <span>High-Yield Liquidity APY (5.15%)</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">
                            <span>Give Feedback to Settlement Desk</span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
