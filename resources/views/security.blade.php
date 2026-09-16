@extends('layouts.public')
@section('title', 'FDIC Insurance & Bank Security Standard')
@section('content')
<section class="page-hero">
    <div class="hero-tag">FEDERAL PROTECTION • ESTABLISHED 1987</div>
    <h1>Institutional Vault & FDIC Deposit Insurance</h1>
    <p>Your money is backed by 39 years of unblemished fiscal stability, FDIC federal deposit coverage up to $250,000, and 256-bit encryption.</p>
</section>

<div class="section-container">
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div class="showcase-img-box">
            <img src="/images/corox_vault.jpg" alt="Corox Bank High Security Vault">
        </div>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Federal Reserve & FDIC Compliance</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                Since 1987, Corox Bank has complied with rigorous Federal Reserve bank capital requirements. Deposits are insured up to $250,000 per depositor by the FDIC.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Open FDIC Insured Account</a>
        </div>
    </div>

    <div class="cards-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3>FDIC Coverage ($250,000)</h3>
            <p>Every dollar in your Corox USD checking or savings account is backed by the United States government.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3>256-Bit SSL Infrastructure</h3>
            <p>Military-grade cryptographic protocols protect all session data and interbank wire routing communications.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <h3>24/7 Automated Threat Engine</h3>
            <p>Real-time security analytics monitor account logins and wire transfers to prevent unauthorized access.</p>
        </div>
    </div>
</div>
@endsection
