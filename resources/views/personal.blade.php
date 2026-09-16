@extends('layouts.public')
@section('title', 'Personal USD Banking Solutions')
@section('content')
<section class="page-hero">
    <div class="hero-tag">PERSONAL BANKING • SINCE 1987</div>
    <h1>Personal USD Checking & High-Yield Savings</h1>
    <p>Empowering personal growth with high-yield savings (4.85% APY), zero-fee checking, and direct FedWire routing <code>026009593</code>.</p>
</section>

<div class="section-container">
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div class="showcase-img-box">
            <img src="/images/personal_banking.jpg" alt="Corox Bank Personal Banking Mobile App">
        </div>
        <div>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Seamless Mobile & Online Execution</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                Manage your checking balances, initiate direct wire transfers, and deposit checks instantly from your tablet, smartphone, or laptop with 24/7 security.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Open Personal USD Account</a>
        </div>
    </div>

    <div class="cards-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <h3>Corox Commercial Checking</h3>
            <p>Zero monthly maintenance fees, free debit card, and full access to FedWire & ACH transfers with routing number <code>026009593</code>.</p>
            <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 1.5rem;">Open Checking</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3>High-Yield USD Savings</h3>
            <p>Earn an industry-leading 4.85% APY on your USD balance with daily compounding and no locking period.</p>
            <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top: 1.5rem;">Open Savings</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3>Certificate of Deposit (CDs)</h3>
            <p>Lock in guaranteed high returns up to 5.25% APY on 12-month and 24-month fixed term USD certificates.</p>
            <a href="{{ route('register') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Explore CDs</a>
        </div>
    </div>
</div>
@endsection
