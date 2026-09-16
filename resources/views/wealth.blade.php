@extends('layouts.public')
@section('title', 'Private Wealth Advisory & Asset Management Since 1987')
@section('content')
<section class="page-hero">
    <div class="hero-tag">WEALTH MANAGEMENT • ESTABLISHED 1987</div>
    <h1>Private Wealth Management & Advisory</h1>
    <p>Preserving capital, optimizing global yields, and structuring legacy wealth for high-net-worth individuals and families.</p>
</section>

<div class="section-container">
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div class="showcase-img-box">
            <img src="/images/wealth_management.jpg" alt="Corox Bank Private Wealth Management Office">
        </div>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Dedicated Senior Advisory</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                With over 39 years of asset management experience, Corox Bank wealth officers provide tailor-made portfolio strategies across equities, Treasuries, and private placement markets.
            </p>
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Schedule Advisory Consultation</a>
        </div>
    </div>

    <div class="cards-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3>Portfolio Management</h3>
            <p>Direct access to dedicated wealth advisors crafting customized USD stock, bond, and ETF growth portfolios.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top: 1.5rem;">Schedule Call</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3>Retirement & IRAs</h3>
            <p>Traditional and Roth IRAs with tax-advantaged growth to build a bulletproof retirement nest egg.</p>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Explore IRAs</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3>Private Concierge Desk</h3>
            <p>Bespoke credit facilities, custom wire structuring, and 24/7 personal relationship management.</p>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Inquire Concierge</a>
        </div>
    </div>
</div>
@endsection
