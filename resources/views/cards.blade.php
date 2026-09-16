@extends('layouts.public')
@section('title', 'Corox Infinite Credit Cards & Rewards')
@section('content')
<section class="page-hero">
    <div class="hero-tag">PREMIUM CREDIT PRODUCTS • ESTABLISHED 1987</div>
    <h1>Corox Infinite Metal & Platinum Cards</h1>
    <p>Earn cash back, luxury travel perks, and airport lounge access with zero foreign exchange fees worldwide.</p>
</section>

<div class="section-container">
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Corox Infinite Rewards Signature</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                Crafted from heavy brushed metallic gold and deep carbon onyx alloy. Enjoy 3.5% cash rewards on dining and travel, $200 USD statement bonus, and comprehensive travel protection.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Apply for Corox Infinite Card</a>
        </div>
        <div class="showcase-img-box">
            <img src="/images/corox_cards.jpg" alt="Corox Bank Gold Metallic Credit Card">
        </div>
    </div>

    <div class="cards-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <h3>Corox Infinite Rewards Card</h3>
            <p>3x points on dining & travel, $200 USD welcome bonus, zero annual fee in your first year.</p>
            <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 1.5rem;">Apply Now</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3>Platinum Cash Back Card</h3>
            <p>Unlimited 2% cash back on all USD purchases automatically credited to your Corox checking account.</p>
            <a href="{{ route('register') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Apply Now</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3>Business Executive Card</h3>
            <p>High purchasing limits, employee expense controls, and seamless sync with accounting software.</p>
            <a href="{{ route('register') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Apply Now</a>
        </div>
    </div>
</div>
@endsection
