@extends('layouts.public')

@section('title', 'Private Wealth Advisory & Asset Management | Corox Bank')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">PRIVATE WEALTH • FIDUCIARY STEWARDSHIP • ESTABLISHED 1987</div>
    <h1>Private Wealth Management &amp; Advisory</h1>
    <p>Preserving family capital, structuring tax-efficient estate legacies, and optimizing global portfolio yields with over 39 years of fiduciary stewardship.</p>
</section>

<div class="section-container">

    <!-- Split Showcase -->
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div class="showcase-img-box">
            <img src="/images/wealth_management.jpg" alt="Corox Bank Private Wealth Management Advisory Suite">
        </div>
        <div>
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">BESPOKE WEALTH STEWARDSHIP</span>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">A Relationship Founded on Fiduciary Duty</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                At Corox Bank, our wealth management officers operate as strict legal fiduciaries, held to the highest standard of client loyalty and transparency. We construct bespoke portfolios designed to withstand volatile market cycles while systematically reducing federal estate and capital gains tax liabilities.
            </p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="#consultation" class="btn btn-primary btn-lg">Schedule Confidential Consultation</a>
                <a href="#tiers" class="btn btn-secondary btn-lg">Explore Wealth Tiers</a>
            </div>
        </div>
    </div>

    <!-- 4 Wealth Pillars -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">OUR ADVISORY PILLARS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Comprehensive Multi-Generational Services</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Integrated planning coordinating your legal, tax, and investment strategies.</p>
    </div>

    <div class="cards-grid" style="margin-bottom: 4rem;">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3>Fiduciary Portfolio Management</h3>
            <p>Customized asset allocation across domestic equities, sovereign Treasuries, private debt, and real asset funds designed for after-tax total return.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3>Trust &amp; Estate Architecture</h3>
            <p>Structure irrevocable dynasty trusts, charitable foundations, and generational transfer vehicles that protect family assets against litigation and estate taxation.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3>Family Office &amp; Philanthropy</h3>
            <p>Comprehensive family governance, direct multi-generational financial literacy, bill pay administration, and structured charitable donor-advised funds.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3>Bespoke Credit &amp; Liquidity</h3>
            <p>Access customized securities-backed credit lines (SBLOC), commercial aircraft financing, and super-prime residential bridge loans without liquidating equities.</p>
        </div>
    </div>

    <!-- Wealth Tiers -->
    <div id="tiers" style="margin-bottom: 2rem; text-align: center;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">MEMBERSHIP TIERS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Private Wealth Relationship Tiers</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Tiered service levels tailored to your total investable household assets.</p>
    </div>

    <div class="comparison-table-wrapper">
        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Wealth Tier</th>
                    <th>Investable Assets</th>
                    <th>Dedicated Advisor</th>
                    <th>Custom Tax Strategy</th>
                    <th>Alternative Assets</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Premier Wealth</strong></td>
                    <td>$250,000 – $1,000,000</td>
                    <td>Regional Senior Advisor</td>
                    <td>Annual Tax-Loss Harvesting</td>
                    <td>Public REITs &amp; ETFs</td>
                    <td><a href="#consultation" class="btn btn-secondary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Inquire Tier</a></td>
                </tr>
                <tr>
                    <td class="highlight-col"><strong>Private Client ★</strong></td>
                    <td class="highlight-col">$1,000,000 – $5,000,000</td>
                    <td class="highlight-col">Dedicated Private Banker</td>
                    <td class="highlight-col">Quarterly CPA Alignment</td>
                    <td class="highlight-col">Private Equity &amp; Structured Debt</td>
                    <td class="highlight-col"><a href="#consultation" class="btn btn-primary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Request Banker</a></td>
                </tr>
                <tr>
                    <td><strong>Family Office Multi-Family</strong></td>
                    <td>$5,000,000+</td>
                    <td>Executive Committee Desk</td>
                    <td>Full Legal &amp; Trust Structuring</td>
                    <td>Direct Co-Investments &amp; Real Assets</td>
                    <td><a href="#consultation" class="btn btn-secondary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Family Office Desk</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Consultation Request Form -->
    <div id="consultation" class="calc-card" style="max-width: 800px; margin: 0 auto 4rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">CONFIDENTIAL ADVISORY</span>
            <h2 style="font-family: var(--font-serif); font-size: 2rem; color: #111827; margin-bottom: 0.5rem;">Schedule a Wealth Consultation</h2>
            <p style="color: #4B5563; font-size: 14px;">Connect with a Managing Director at our Private Wealth Advisory office.</p>
        </div>

        <form action="{{ route('contact') }}" method="GET" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem;">
            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Full Legal Name</label>
                <input type="text" required placeholder="e.g. Eleanor Vance" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Business / Personal Email</label>
                <input type="email" required placeholder="name@domain.com" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Telephone Number</label>
                <input type="tel" required placeholder="+1 (555) 000-0000" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Investable Household Assets</label>
                <select style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px; background: #FFFFFF;">
                    <option>$250,000 – $1,000,000 USD</option>
                    <option>$1,000,000 – $5,000,000 USD</option>
                    <option>$5,000,000 – $25,000,000 USD</option>
                    <option>$25,000,000+ USD</option>
                </select>
            </div>

            <div style="grid-column: span 2;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Primary Areas of Interest</label>
                <input type="text" placeholder="e.g. Trust &amp; Estate Planning, SBLOC credit facility, Discretionary portfolio" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div style="grid-column: span 2; margin-top: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Submit Confidential Request</button>
            </div>
        </form>
    </div>

    <!-- FAQ Accordion -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FREQUENTLY ASKED QUESTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">Private Wealth FAQs</h2>
    </div>

    <div class="faq-container">
        <div class="faq-item active">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>What does it mean that Corox Wealth advisors are fiduciaries?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                As legal fiduciaries, our wealth advisors are bound by US law to act exclusively in your best financial interest at all times. We do not accept third-party commissions or push proprietary fund products, eliminating conflicts of interest.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Can Corox Bank coordinate with my current CPA and estate attorney?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Yes. Our wealth officers regularly conduct quarterly strategy sessions directly with your external tax accountants and legal counsel to ensure your investment allocations remain fully synchronized with your estate tax structures.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>What is a Securities-Backed Line of Credit (SBLOC)?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                An SBLOC allows you to borrow against the value of your non-retirement investment portfolio at competitive institutional rates. This provides immediate liquid cash for real estate or business investments without triggering capital gains taxes from selling assets.
            </div>
        </div>
    </div>

</div>

@section('scripts')
<script>
    function toggleFaq(el) {
        const item = el.parentElement;
        item.classList.toggle('active');
    }
</script>
@endsection
@endsection
