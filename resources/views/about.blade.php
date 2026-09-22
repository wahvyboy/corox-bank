@extends('layouts.public')

@section('title', 'About Corox Bank | Heritage & Institutional Strength Since 1987')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">FOUNDED 1987 • TIER 1 CAPITAL RATIO 14.2% • MEMBER FDIC</div>
    <h1>About Corox Commercial Bank</h1>
    <p>39 years of disciplined fiscal stewardship, conservative balance sheet management, and dedicated commercial clearing for corporations and families nationwide.</p>
</section>

<div class="section-container">

    <!-- Split Showcase -->
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div>
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">OUR HERITAGE</span>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Decades of Uncompromising Financial Stability</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.2rem;">
                Chartered in 1987, Corox Commercial Bank was established with a singular vision: to deliver institutional-grade commercial treasury, reliable domestic FedWire clearing, and private wealth management with the personalized attention of a private mercantile bank.
            </p>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                Throughout market cycles and economic volatility, Corox Bank has maintained pristine liquidity reserves, a Tier 1 Risk-Based Capital Ratio of 14.2% (far surpassing regulatory requirements), and an unbroken record of depositor security.
            </p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Open an Account</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary btn-lg">Contact Executive Office</a>
            </div>
        </div>
        <div class="showcase-img-box">
            <img src="/images/corox_hero_bg.jpg" alt="Corox Bank Corporate Financial Headquarters">
        </div>
    </div>

    <!-- Institutional Stat Strip -->
    <div class="stat-strip">
        <div>
            <div class="stat-strip-num">$14.8B</div>
            <div class="stat-strip-label">Total Assets Under Custody</div>
        </div>
        <div>
            <div class="stat-strip-num">14.2%</div>
            <div class="stat-strip-label">Tier 1 Capital Ratio</div>
        </div>
        <div>
            <div class="stat-strip-num">39 Yrs</div>
            <div class="stat-strip-label">Continuous Fiscal Operation</div>
        </div>
        <div>
            <div class="stat-strip-num">100%</div>
            <div class="stat-strip-label">FDIC Regulatory Compliance</div>
        </div>
    </div>

    <!-- Heritage Timeline -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">INSTITUTIONAL MILESTONES</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Four Decades of Growth &amp; Innovation</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">A legacy built on security, client fiduciary responsibility, and technological excellence.</p>
    </div>

    <div class="process-grid">
        <div class="process-step-card">
            <div class="process-step-num" style="font-size: 1rem; width: 48px; height: 48px;">1987</div>
            <h4>Bank Charter Established</h4>
            <p>Founded as a specialized commercial clearing institution serving Midwest industrial and commercial enterprises.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num" style="font-size: 1rem; width: 48px; height: 48px;">1999</div>
            <h4>Direct FedWire Integration</h4>
            <p>Direct clearing integration with the Federal Reserve Bank under ABA routing number <code>071923456</code>.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num" style="font-size: 1rem; width: 48px; height: 48px;">2012</div>
            <h4>Private Wealth Division</h4>
            <p>Expanded into private family office advisory, fiduciary asset management, and customized liquidity facilities.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num" style="font-size: 1rem; width: 48px; height: 48px;">2024</div>
            <h4>Next-Gen Digital Platform</h4>
            <p>Deployment of our institutional digital banking architecture, real-time client ledger, and high-yield deposit rails.</p>
        </div>
    </div>

    <!-- Executive Leadership & Governance -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">EXECUTIVE GOVERNANCE</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Senior Leadership Team</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Seasoned financial officers steering Corox Bank with conservative risk management.</p>
    </div>

    <div class="cards-grid" style="margin-bottom: 4rem;">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3>Marcus Sterling</h3>
            <div style="font-size: 12px; font-weight: 700; color: var(--brand-red); text-transform: uppercase; margin-bottom: 0.5rem;">Chairman &amp; Chief Executive Officer</div>
            <p>Over 32 years of commercial banking leadership. Former Managing Director of Treasury Operations at top-5 US institutions.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3>Sarah Kensington</h3>
            <div style="font-size: 12px; font-weight: 700; color: var(--brand-red); text-transform: uppercase; margin-bottom: 0.5rem;">Chief Risk &amp; Compliance Officer</div>
            <p>Oversees regulatory compliance, federal audit integrity, and multi-tier fraud prevention architecture across all deposit accounts.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3>David Vance, CFA</h3>
            <div style="font-size: 12px; font-weight: 700; color: var(--brand-red); text-transform: uppercase; margin-bottom: 0.5rem;">Head of Private Wealth &amp; Advisory</div>
            <p>Directs discretionary asset allocation, tax-efficient estate structures, and private family office advisory relationships.</p>
        </div>
    </div>

</div>
@endsection
