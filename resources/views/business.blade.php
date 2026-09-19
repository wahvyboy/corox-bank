@extends('layouts.public')

@section('title', 'Commercial Banking & Treasury Management | Corox Bank')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">COMMERCIAL BANKING • FEDWIRE ROUTING 026009593 • MEMBER FDIC</div>
    <h1>Commercial Banking &amp; Treasury Management</h1>
    <p>Comprehensive corporate liquidity, automated overnight sweeps, direct US FedWire/ACH payment rails, and institutional credit facilities for growing enterprises.</p>
</section>

<div class="section-container">

    <!-- Split Showcase -->
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div>
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">INSTITUTIONAL LIQUIDITY RAILS</span>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Direct Access to US Payment Infrastructure</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                Corox Bank operates direct clearing interfaces with the Federal Reserve FedWire funds service and Automated Clearing House (ACH) networks under routing number <strong>026009593</strong>. Accelerate accounts payable, automate payroll, and streamline corporate disbursements with institutional certainty.
            </p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Open Commercial Account</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary btn-lg">Contact Treasury Desk</a>
            </div>
        </div>
        <div class="showcase-img-box">
            <img src="/images/business_treasury.jpg" alt="Corox Bank Commercial Treasury Management Operations">
        </div>
    </div>

    <!-- Institutional Stat Strip -->
    <div class="stat-strip">
        <div>
            <div class="stat-strip-num">$4.2B+</div>
            <div class="stat-strip-label">Annual Wire Volume</div>
        </div>
        <div>
            <div class="stat-strip-num">99.99%</div>
            <div class="stat-strip-label">Payment Rails Uptime</div>
        </div>
        <div>
            <div class="stat-strip-num">026009593</div>
            <div class="stat-strip-label">FedWire Routing Code</div>
        </div>
        <div>
            <div class="stat-strip-num">256-Bit</div>
            <div class="stat-strip-label">AES Data Encryption</div>
        </div>
    </div>

    <!-- 6-Grid Core Capabilities -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">TREASURY CAPABILITIES</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">End-to-End Enterprise Cash Management</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Tailored for mid-market corporations, tech firms, and institutional asset managers.</p>
    </div>

    <div class="cards-grid" style="margin-bottom: 4rem;">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
            </div>
            <h3>FedWire &amp; Same-Day ACH</h3>
            <p>Initiate immediate high-value funds transfers directly through the Federal Reserve FedWire system. Same-day ACH for domestic vendor disbursements.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3>Automated Liquidity Sweeps</h3>
            <p>Maximize interest on idle operating capital. Our automated sweep mechanism transfers excess funds into high-yielding institutional deposits overnight.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3>Dual Authorization &amp; Controls</h3>
            <p>Establish granular role-based approvals. Require dual-signatory confirmation on wire transfers exceeding customizable dollar thresholds.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <h3>Merchant Processing &amp; POS</h3>
            <p>Accept credit card, debit, and digital wallet payments with transparent interchange-plus pricing and guaranteed next-business-day settlement.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3>Commercial Lines of Credit</h3>
            <p>Secure flexible revolving credit facilities up to $5,000,000 USD to smooth out seasonal working capital cycles and fund inventory purchases.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <h3>International FX &amp; Hedging</h3>
            <p>Execute spot and forward foreign exchange contracts across 40+ global currencies to hedge international supply chain currency fluctuations.</p>
        </div>
    </div>

    <!-- Commercial Account Comparison Table -->
    <div style="margin-bottom: 2rem; text-align: center;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">TIERED COMMERCIAL OPTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Commercial Operating Account Comparison</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Select the treasury framework aligned with your corporate transaction frequency.</p>
    </div>

    <div class="comparison-table-wrapper">
        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Operating Tier</th>
                    <th>Best Suited For</th>
                    <th>Monthly Allowance</th>
                    <th>Overnight Sweep</th>
                    <th>FedWire Fee</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Business Basic Checking</strong></td>
                    <td>Startups &amp; Small Businesses (&lt; 200 txns/mo)</td>
                    <td>200 Free Transactions</td>
                    <td>Optional Add-on</td>
                    <td>$15 / wire</td>
                    <td><a href="{{ route('register') }}" class="btn btn-secondary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Open Basic</a></td>
                </tr>
                <tr>
                    <td class="highlight-col"><strong>Commercial Treasury ★</strong></td>
                    <td class="highlight-col">Mid-Market Enterprises &amp; Fast-Growing Firms</td>
                    <td class="highlight-col">Unlimited ACH &amp; 500 Txns</td>
                    <td class="highlight-col"><strong style="color: #059669;">Included Free (4.85% APY)</strong></td>
                    <td class="highlight-col"><strong style="color: #059669;">5 Free / Month</strong></td>
                    <td class="highlight-col"><a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Open Treasury</a></td>
                </tr>
                <tr>
                    <td><strong>Corporate Institutional Sweep</strong></td>
                    <td>Large Enterprises &amp; Private Equity Funds</td>
                    <td>Unlimited Transactions</td>
                    <td>Multi-Bank Sweep to $50M FDIC</td>
                    <td>Zero Fee Wire Desk</td>
                    <td><a href="{{ route('contact') }}" class="btn btn-secondary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Contact Desk</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FAQ Accordion -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FREQUENTLY ASKED QUESTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">Commercial Treasury FAQs</h2>
    </div>

    <div class="faq-container">
        <div class="faq-item active">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>How do I set up multi-user corporate permissions?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Your designated corporate administrator can create distinct user roles within the Corox Online Banking portal, configuring permission tiers for accountants (view-only), payroll managers (initiate ACH), and corporate officers (dual-signatory wire release).
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>What is the cutoff time for same-day FedWire transfers?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Domestic FedWire transfers submitted before 5:00 PM Eastern Time (ET) are processed and cleared on the same business day across Federal Reserve member institutions.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Can Corox Bank provide extended FDIC insurance beyond $250,000?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Yes. Through our Insured Cash Sweep (ICS®) network partnership, large institutional balances can be distributed across participating FDIC-insured institutions, providing full FDIC insurance protection on balances up to $50,000,000 USD under a single consolidated Corox statement.
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
