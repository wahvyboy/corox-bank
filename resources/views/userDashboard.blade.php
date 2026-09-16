@extends('layouts.app')
@section('title', 'Client Dashboard')
@section('content')
<div class="welcome-hero">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2>Welcome back, {{ Auth::user()->name }}</h2>
            <p>Corox Bank Commercial Banking & Settlement Desk</p>
            <div class="routing-badge">
                ABA Routing Number: 026009593
            </div>
        </div>
        <div>
            <a href="{{ route('show.transfer.form') }}" class="btn btn-primary">Send Wire / ACH</a>
        </div>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-title">Active USD Accounts</div>
        <div class="stat-value">{{ Auth::user()->accounts()->where('status', 'active')->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Total USD Liquidity</div>
        <div class="stat-value">${{ number_format(Auth::user()->accounts()->where('status', 'active')->sum('balance'), 2) }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">FDIC Protection Status</div>
        <div class="stat-value" style="font-size: 1.4rem; color: var(--success);">Covered ($250k)</div>
    </div>
</div>

<h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem;">Quick Banking Operations</h3>
<div class="cards-grid" style="margin-top: 0;">
    <a href="{{ route('show.bank.accounts') }}" class="feature-card">
        <div class="feature-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
        </div>
        <h3>My Accounts</h3>
        <p>View balances, 10-digit account numbers, and routing info.</p>
    </a>

    <a href="{{ route('show.transfer.form') }}" class="feature-card">
        <div class="feature-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
        </div>
        <h3>Send Wire Transfer</h3>
        <p>Execute real-time ACH and wire transfers across USD accounts.</p>
    </a>

    <a href="{{ route('show.deposit.form') }}" class="feature-card">
        <div class="feature-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
        </div>
        <h3>Deposit USD</h3>
        <p>Fund your Corox checking or savings account instantly.</p>
    </a>
</div>
@endsection
