@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="welcome-hero">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2>Corox Bank Administration Terminal</h2>
            <p>System Administrator: {{ Auth::user()->name }}</p>
            <div class="routing-badge">
                Master Wire Desk • ABA Routing: 026009593
            </div>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="{{ route('admin.pending.transactions') }}" class="btn btn-primary" style="background: #059669; border-color: #059669;">
                Settlement Queue ({{ \App\Models\Transaction::where('status', 'pending')->count() }})
            </a>
            <a href="{{ route('show.requests') }}" class="btn btn-secondary">Review Account Requests</a>
        </div>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-title">Total Registered Users</div>
        <div class="stat-value">{{ \App\Models\User::count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Active Bank Accounts</div>
        <div class="stat-value">{{ \App\Models\Account::where('status', 'active')->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Pending Transactions (Wires/Checks)</div>
        <div class="stat-value" style="color: #D97706;">{{ \App\Models\Transaction::where('status', 'pending')->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Pending Account Requests</div>
        <div class="stat-value" style="color: var(--accent-gold-bright);">{{ \App\Models\Account::where('status', 'pending')->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Total System Deposits (USD)</div>
        <div class="stat-value">${{ number_format(\App\Models\Account::sum('balance'), 2) }}</div>
    </div>
</div>

<h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem;">Administrative Control Panel</h3>
<div class="cards-grid" style="margin-top: 0;">
    <a href="{{ route('admin.pending.transactions') }}" class="feature-card" style="border-left: 4px solid #059669;">
        <div class="feature-icon" style="background: rgba(16, 185, 129, 0.1); color: #059669;">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3>Transaction Settlement Queue</h3>
        <p>Inspect check photos, review pending wires, and issue one-click approvals or refunds.</p>
    </a>

    <a href="{{ route('show.users') }}" class="feature-card">
        <div class="feature-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3>User Management</h3>
        <p>Inspect client accounts, view transaction logs, and block/unblock user access.</p>
    </a>

    <a href="{{ route('show.requests') }}" class="feature-card">
        <div class="feature-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
        </div>
        <h3>Account Approval Queue</h3>
        <p>Review submitted client account requests and issue formal approvals.</p>
    </a>

    <a href="{{ route('show.admin.deposit.form') }}" class="feature-card">
        <div class="feature-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
        </div>
        <h3>Admin Ledger Override</h3>
        <p>Directly credit deposits, process ledger withdrawals, or execute override wires.</p>
    </a>
</div>
@endsection
