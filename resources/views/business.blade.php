@extends('layouts.public')
@section('title', 'Corporate Treasury & Commercial Banking Since 1987')
@section('content')
<section class="page-hero">
    <div class="hero-tag">COMMERCIAL BANKING • ESTABLISHED 1987</div>
    <h1>Corporate Treasury & High-Volume Clearing</h1>
    <p>Empowering corporations, startups, and institutions with commercial wire clearing, multi-tier approvals, and USD liquidity management.</p>
</section>

<div class="section-container">
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Institutional Treasury Management</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                Since 1987, Corox Bank has powered enterprise liquidity for top commercial firms worldwide. Access direct ACH settlement, corporate credit lines, and custom wire thresholds.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Open Business Account</a>
        </div>
        <div class="showcase-img-box">
            <img src="/images/business_treasury.jpg" alt="Corox Bank Corporate Treasury Boardroom">
        </div>
    </div>

    <div class="cards-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3>Commercial Checking</h3>
            <p>Designed for businesses needing multi-user authorization, batch ACH transfers, and corporate card management.</p>
            <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 1.5rem;">Open Business Account</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
            </div>
            <h3>Corporate Treasury & Wires</h3>
            <p>Automate high-value USD wire transfers using Corox Bank ABA Routing <code>026009593</code> with custom approval limits.</p>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Contact Treasury Team</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <h3>Merchant Payment Gateway</h3>
            <p>Seamlessly collect customer payments via card, ACH direct debit, and wire transfer with real-time settlement.</p>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Learn More</a>
        </div>
    </div>
</div>
@endsection
