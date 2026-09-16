@extends('layouts.public')

@section('title', 'Premier Commercial & Digital Banking Solutions')

@section('content')
<!-- Wells Fargo Signature Wireframe Hero Section with Embedded Sign-On -->
<section class="wf-hero-wrapper">
    <div class="wf-hero-grid">
        <!-- Left: Signature Embedded Sign-On Box -->
        <div class="wf-signon-card">
            <div>
                <div class="wf-signon-header">
                    <svg width="22" height="22" fill="none" stroke="#CC0000" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <h3>Good day, Sign On</h3>
                </div>

                @if($errors->has('loginError'))
                    <div class="alert alert-error" style="font-size: 13px; padding: 0.6rem; margin-bottom: 1rem; border-left: 4px solid #CC0000; background: #FEF2F2; color: #991B1B;">
                        {{ $errors->first('loginError') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="wf-input-group">
                        <label for="hero_name">Username / User ID</label>
                        <input type="text" name="name" id="hero_name" required placeholder="Enter username" autofocus>
                    </div>

                    <div class="wf-input-group">
                        <label for="hero_password">Password</label>
                        <input type="password" name="password" id="hero_password" required placeholder="••••••••">
                    </div>

                    <div class="wf-form-options">
                        <label class="wf-checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Save Username</span>
                        </label>
                        <a href="{{ route('login') }}" style="color: #4B5563; font-size: 12px; font-weight: 600;">Forgot Password?</a>
                    </div>

                    <button type="submit" class="wf-signon-btn">Sign On</button>
                </form>

                <div class="wf-signon-sublinks">
                    <a href="{{ route('register') }}" style="color: var(--brand-red); font-weight: 700;">Enroll in Online Banking</a>
                    <span>•</span>
                    <a href="{{ route('security') }}">Security Guarantee</a>
                </div>
            </div>

            <div class="wf-security-banner">
                <svg width="15" height="15" fill="#059669" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/></svg>
                <span>256-Bit SSL Encrypted • Member FDIC</span>
            </div>
        </div>

        <!-- Right: Wells Fargo Hero Promo Showcase -->
        <div class="wf-hero-promo">
            <img src="/images/corox_hero_bg.jpg" alt="Corox Bank Institutional Building" class="wf-hero-promo-bg">
            <div class="wf-hero-promo-content">
                <div class="wf-hero-eyebrow">
                    ★ FEATURED SAVINGS OPPORTUNITY
                </div>
                <h1 class="wf-hero-title">Financial Strength Built for Your Ambitions</h1>
                <p style="color: #E5E7EB; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1.5rem;">
                    Earn more on your liquid capital with institutional interest rates and full FDIC insurance up to $250,000. Direct clearing on US payment rails with FedWire routing.
                </p>

                <div class="wf-hero-rate-box">
                    <div class="wf-hero-rate-num">5.15%</div>
                    <div class="wf-hero-rate-label">APY Corox High-Yield Savings</div>
                </div>

                <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; margin-bottom: 1.8rem;">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg" style="box-shadow: 0 6px 20px rgba(204,0,0,0.4);">Open an Account</a>
                    <a href="{{ route('personal') }}" class="btn btn-secondary btn-lg" style="background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.3); color: #FFFFFF;">Compare Checking Options</a>
                </div>

                <div style="display: flex; gap: 1.2rem; flex-wrap: wrap; font-size: 13px; color: #D1D5DB; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 1.2rem;">
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="15" height="15" fill="#4ADE80" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Zero Monthly Maintenance
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="15" height="15" fill="#4ADE80" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        $0 Minimum Opening Balance
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="15" height="15" fill="#4ADE80" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Direct FedWire Routing 026009593
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Wells Fargo 6-Tile "What Can We Help You With?" Action Wireframe -->
<section class="wf-actions-section">
    <div class="wf-actions-header">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">WHAT CAN WE HELP YOU WITH TODAY?</span>
        <h2>Explore Core Financial Solutions</h2>
        <p style="color: #4B5563; font-size: 1.05rem; max-width: 680px; margin: 0 auto;">Designed for seamless digital execution, transparent terms, and institutional reliability.</p>
    </div>

    <div class="wf-actions-grid">
        <!-- Tile 1: Checking Accounts -->
        <a href="{{ route('personal') }}" class="wf-action-card">
            <div class="wf-action-icon-box">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <h3>Commercial Checking</h3>
            <p>Everyday liquidity with zero minimum balance options, contactless Visa debit cards, and worldwide ATM access.</p>
            <span class="wf-action-link">Explore Checking &rarr;</span>
        </a>

        <!-- Tile 2: High-Yield Savings -->
        <a href="{{ route('personal') }}" class="wf-action-card">
            <div class="wf-action-icon-box">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3>High-Yield Savings</h3>
            <p>Grow your reserves at 5.15% APY with automatic compound interest and zero monthly maintenance surcharges.</p>
            <span class="wf-action-link">View Savings Rates &rarr;</span>
        </a>

        <!-- Tile 3: Credit Cards -->
        <a href="{{ route('cards') }}" class="wf-action-card">
            <div class="wf-action-icon-box">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <h3>Corox Infinite Cards</h3>
            <p>Heavy titanium cards offering unlimited 3.5% cash back, premium airline travel protections, and zero foreign fees.</p>
            <span class="wf-action-link">Find Your Card &rarr;</span>
        </a>

        <!-- Tile 4: Mortgages -->
        <a href="{{ route('loans') }}" class="wf-action-card">
            <div class="wf-action-icon-box">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
            </div>
            <h3>Home Mortgages</h3>
            <p>Fixed and adjustable residential loans with competitive closing rates and fast digital pre-approval.</p>
            <span class="wf-action-link">Calculate Payment &rarr;</span>
        </a>

        <!-- Tile 5: Commercial Treasury -->
        <a href="{{ route('business') }}" class="wf-action-card">
            <div class="wf-action-icon-box">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
            </div>
            <h3>Commercial Treasury</h3>
            <p>Direct ACH wire integration, corporate liquidity sweeps, multi-signatory approvals, and merchant settlement.</p>
            <span class="wf-action-link">Commercial Banking &rarr;</span>
        </a>

        <!-- Tile 6: Wealth Management -->
        <a href="{{ route('wealth') }}" class="wf-action-card">
            <div class="wf-action-icon-box">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3>Private Wealth Advisory</h3>
            <p>Fiduciary wealth planning, custom tax-efficient portfolios, trust administration, and family office services.</p>
            <span class="wf-action-link">Private Wealth &rarr;</span>
        </a>
    </div>
</section>

<!-- Wells Fargo Institutional Rates Sheet Table -->
<section style="background: #FFFFFF; padding: 4.5rem 1.5rem; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB;">
    <div style="max-width: 1320px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">CURRENT INSTITUTIONAL YIELDS</span>
            <h2 style="font-family: var(--font-serif); font-size: 2.2rem; color: #111827; margin-bottom: 0.5rem;">Transparent Banking Rates &amp; Terms</h2>
            <p style="color: #4B5563; font-size: 1.05rem;">Direct rates updated continuously with FDIC deposit insurance protection.</p>
        </div>

        <div class="wf-rate-card">
            <div style="overflow-x: auto;">
                <table class="wf-rate-table">
                    <thead>
                        <tr>
                            <th>Account / Product</th>
                            <th>Interest Rate / APY</th>
                            <th>Minimum Opening</th>
                            <th>Key Benefit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="wf-rate-badge">SAVINGS</span>
                                <div class="wf-rate-product-name">Corox High-Yield Savings</div>
                                <div style="font-size: 13px; color: #6B7280;">Compounded daily, paid monthly</div>
                            </td>
                            <td>
                                <div class="wf-rate-num">5.15% <span style="font-size: 13px; font-weight: 700; color: #4B5563;">APY</span></div>
                            </td>
                            <td><strong style="color: #111827;">$0</strong></td>
                            <td style="color: #4B5563;">Zero maintenance fees, instant FedWire transfers</td>
                            <td>
                                <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 13px; padding: 0.5rem 1.1rem;">Open Online</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="wf-rate-badge">CERTIFICATE</span>
                                <div class="wf-rate-product-name">12-Month Fixed Jumbo CD</div>
                                <div style="font-size: 13px; color: #6B7280;">Guaranteed lock-in return</div>
                            </td>
                            <td>
                                <div class="wf-rate-num">4.85% <span style="font-size: 13px; font-weight: 700; color: #4B5563;">APY</span></div>
                            </td>
                            <td><strong style="color: #111827;">$500</strong></td>
                            <td style="color: #4B5563;">Fixed interest guaranteed for 365 days</td>
                            <td>
                                <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 13px; padding: 0.5rem 1.1rem;">Lock Rate</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="wf-rate-badge">CHECKING</span>
                                <div class="wf-rate-product-name">Premier Commercial Checking</div>
                                <div style="font-size: 13px; color: #6B7280;">Everyday business &amp; personal liquidity</div>
                            </td>
                            <td>
                                <strong style="color: #111827; font-size: 1.15rem;">$0 Monthly Fee</strong>
                            </td>
                            <td><strong style="color: #111827;">$25</strong></td>
                            <td style="color: #4B5563;">Free contactless debit card &amp; worldwide ATM fee rebates</td>
                            <td>
                                <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 13px; padding: 0.5rem 1.1rem;">Open Checking</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="wf-rate-badge">HOME LOAN</span>
                                <div class="wf-rate-product-name">30-Year Fixed Residential Mortgage</div>
                                <div style="font-size: 13px; color: #6B7280;">Predictable monthly payments</div>
                            </td>
                            <td>
                                <div style="font-size: 1.5rem; font-weight: 900; color: #111827; font-family: var(--font-serif);">5.98% <span style="font-size: 13px; font-weight: 700; color: #4B5563;">APR</span></div>
                            </td>
                            <td><strong style="color: #111827;">3.5% down</strong></td>
                            <td style="color: #4B5563;">Fast digital pre-qualification and closing cost credit</td>
                            <td>
                                <a href="{{ route('loans') }}" class="btn btn-secondary" style="font-size: 13px; padding: 0.5rem 1.1rem; border: 1px solid #D1D5DB; color: #111827; background: #F9FAFB;">Check Rates</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Wells Fargo Split Feature Showcase 1: Credit Cards -->
<section class="wf-split-feature">
    <div>
        <span class="wf-feature-eyebrow">EXCLUSIVE INSTITUTIONAL CARDS</span>
        <h2 class="wf-split-title">Corox Infinite Metal &amp; Platinum Cards</h2>
        <p class="wf-split-p">
            Engineered for discerning individuals and corporate executives who demand worldwide purchasing power, zero foreign transaction fees, and concierge travel protections.
        </p>

        <ul class="wf-check-list">
            <li class="wf-check-item">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Unlimited 3.5% cash rewards on executive dining, flights, and luxury hotel accommodations.
            </li>
            <li class="wf-check-item">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Laser-engraved matte black &amp; crimson heavy titanium card body with contactless chip.
            </li>
            <li class="wf-check-item">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                0% introductory APR on purchases and balance transfers for the initial 15 billing cycles.
            </li>
        </ul>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('cards') }}" class="btn btn-primary btn-lg">Apply for Corox Infinite</a>
            <a href="{{ route('cards') }}" class="btn btn-secondary btn-lg" style="background: #F3F4F6; color: #111827; border: 1px solid #D1D5DB;">Compare Card Benefits</a>
        </div>
    </div>

    <div class="wf-split-img-box">
        <img src="/images/corox_cards.jpg" alt="Corox Infinite Metal Cards" loading="eager">
    </div>
</section>

<!-- Wells Fargo Split Feature Showcase 2: Security & FDIC -->
<section class="wf-split-feature reverse" style="background: #FAF9F6; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB;">
    <div>
        <span class="wf-feature-eyebrow">REGULATORY SECURITY &amp; INTEGRITY</span>
        <h2 class="wf-split-title">FDIC Protection Up to $250,000 &amp; Zero Liability</h2>
        <p class="wf-split-p">
            Your deposits are backed by the full faith and credit of the United States Government. Combined with military-grade 256-bit encryption and real-time behavioral fraud defenses, your wealth is safe 24 hours a day, 365 days a year.
        </p>

        <ul class="wf-check-list">
            <li class="wf-check-item">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Member FDIC: Direct protection up to $250,000 per depositor for each ownership category.
            </li>
            <li class="wf-check-item">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Zero Liability Protection: You are never responsible for unauthorized purchases reported promptly.
            </li>
            <li class="wf-check-item">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Direct Clearing Rails: Official routing number 026009593 for instantaneous interbank settlement.
            </li>
        </ul>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('security') }}" class="btn btn-primary btn-lg">Security Center</a>
            <a href="{{ route('about') }}" class="btn btn-secondary btn-lg" style="background: #FFFFFF; color: #111827; border: 1px solid #D1D5DB;">About Corox Bank</a>
        </div>
    </div>

    <div class="wf-split-img-box">
        <img src="/images/corox_vault.jpg" alt="Corox Bank Institutional Security Vault" loading="eager">
    </div>
</section>

<!-- Wells Fargo Financial Insights & Editorial Knowledge Hub -->
<section class="wf-editorial-section">
    <div class="wf-editorial-container">
        <div style="text-align: center;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FINANCIAL INTELLIGENCE</span>
            <h2 style="font-family: var(--font-serif); font-size: 2.2rem; color: #111827; margin-bottom: 0.5rem;">Institutional Insights &amp; Market Perspectives</h2>
            <p style="color: #4B5563; font-size: 1.05rem;">Actionable financial strategies curated by Corox Treasury and Private Wealth economists.</p>
        </div>

        <div class="wf-editorial-grid">
            <div class="wf-editorial-card">
                <div>
                    <span style="color: #CC0000; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.5rem;">CASH MANAGEMENT</span>
                    <h3>Maximizing Liquidity in Changing Interest Rate Environments</h3>
                    <p>Discover how modern corporate treasurers combine high-yield liquid savings with short-term certificate ladders to maximize return while keeping working capital accessible.</p>
                </div>
                <div class="wf-editorial-meta">
                    <span>5 Min Read</span>
                    <a href="{{ route('personal') }}" style="color: #CC0000; font-weight: 700;">Read Analysis &rarr;</a>
                </div>
            </div>

            <div class="wf-editorial-card">
                <div>
                    <span style="color: #CC0000; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.5rem;">COMMERCIAL TREASURY</span>
                    <h3>Optimizing Real-Time FedWire &amp; ACH Payment Clearing</h3>
                    <p>How automated same-day settlements and direct routing clearance accelerate invoice collection, minimize reconciliation friction, and eliminate float costs for scaling firms.</p>
                </div>
                <div class="wf-editorial-meta">
                    <span>7 Min Read</span>
                    <a href="{{ route('business') }}" style="color: #CC0000; font-weight: 700;">Read Guide &rarr;</a>
                </div>
            </div>

            <div class="wf-editorial-card">
                <div>
                    <span style="color: #CC0000; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.5rem;">WEALTH PRESERVATION</span>
                    <h3>Multi-Generational Wealth: Structuring Fiduciary Trusts</h3>
                    <p>Essential strategies for protecting family assets, reducing transfer tax burdens, and ensuring smooth business succession across generations with our private trust desk.</p>
                </div>
                <div class="wf-editorial-meta">
                    <span>6 Min Read</span>
                    <a href="{{ route('wealth') }}" style="color: #CC0000; font-weight: 700;">Read Strategy &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Wells Fargo Style Institutional Trust & Regulatory Ribbon -->
<div style="background: #FFFFFF; padding: 3.5rem 1.5rem; border-bottom: 1px solid #E5E7EB;">
    <div style="max-width: 1320px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem; text-align: center;">
        <div style="padding: 1rem;">
            <div style="font-size: 2rem; font-weight: 900; color: var(--brand-red); font-family: var(--font-serif); margin-bottom: 0.4rem;">$250,000</div>
            <div style="font-weight: 800; font-size: 15px; color: #111827; margin-bottom: 0.3rem;">FDIC Insured Coverage</div>
            <div style="font-size: 13px; color: #6B7280; line-height: 1.5;">Direct federal deposit guarantee for every qualifying account owner.</div>
        </div>

        <div style="padding: 1rem;">
            <div style="font-size: 2rem; font-weight: 900; color: var(--brand-red); font-family: var(--font-serif); margin-bottom: 0.4rem;">026009593</div>
            <div style="font-weight: 800; font-size: 15px; color: #111827; margin-bottom: 0.3rem;">Direct FedWire Routing</div>
            <div style="font-size: 13px; color: #6B7280; line-height: 1.5;">Direct access to official US payment infrastructure and clearing.</div>
        </div>

        <div style="padding: 1rem;">
            <div style="font-size: 2rem; font-weight: 900; color: var(--brand-red); font-family: var(--font-serif); margin-bottom: 0.4rem;">24/7/365</div>
            <div style="font-weight: 800; font-size: 15px; color: #111827; margin-bottom: 0.3rem;">Continuous Fraud Defense</div>
            <div style="font-size: 13px; color: #6B7280; line-height: 1.5;">Zero Liability coverage on all unauthorized verified transactions.</div>
        </div>

        <div style="padding: 1rem;">
            <div style="font-size: 2rem; font-weight: 900; color: var(--brand-red); font-family: var(--font-serif); margin-bottom: 0.4rem;">Equal Housing</div>
            <div style="font-weight: 800; font-size: 15px; color: #111827; margin-bottom: 0.3rem;">Lender &amp; Fiduciary</div>
            <div style="font-size: 13px; color: #6B7280; line-height: 1.5;">Committed to fair lending and transparent institutional guidance.</div>
        </div>
    </div>
</div>
@endsection
