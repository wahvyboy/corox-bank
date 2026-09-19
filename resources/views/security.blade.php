@extends('layouts.public')

@section('title', 'Security, FDIC Insurance & Fraud Protection | Corox Bank')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">INSTITUTIONAL INTEGRITY • MEMBER FDIC • 256-BIT ENCRYPTION</div>
    <h1>Security, FDIC Insurance &amp; Fraud Protection</h1>
    <p>Your assets are protected by 39 years of unblemished institutional stability, federal FDIC insurance up to $250,000, and military-grade 256-bit cryptographic encryption.</p>
</section>

<div class="section-container">

    <!-- Split Showcase -->
    <div class="showcase-split" style="margin-bottom: 4rem;">
        <div>
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FEDERAL DEPOSIT INSURANCE</span>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Backed by the Full Faith &amp; Credit of the US Government</h2>
            <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem;">
                Corox Commercial Bank is an insured member of the Federal Deposit Insurance Corporation (FDIC). Every depositor is directly insured up to at least <strong>$250,000 USD</strong> for individual accounts, and up to <strong>$500,000 USD</strong> for joint accounts. Since the FDIC's inception in 1933, no depositor has ever lost a single penny of insured funds.
            </p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Open an Insured Account</a>
                <a href="#routing" class="btn btn-secondary btn-lg">Verify ABA Routing</a>
            </div>
        </div>
        <div class="showcase-img-box">
            <img src="/images/corox_vault.jpg" alt="Corox Bank Institutional Security Vault">
        </div>
    </div>

    <!-- 4 Security Pillars -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">DEFENSE-IN-DEPTH</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Multi-Tiered Protection Architecture</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">From biometric device authentication to cryptographic wire verification.</p>
    </div>

    <div class="cards-grid" style="margin-bottom: 4rem;">
        <div class="feature-card">
            <div class="feature-icon" style="background: rgba(5,150,105,0.1); color: #059669;">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3>FDIC Coverage ($250,000)</h3>
            <p>Direct federal deposit insurance backed by the US Government across all checking, savings, money market, and certificate of deposit accounts.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h3>256-Bit TLS 1.3 Encryption</h3>
            <p>Every session and ledger entry is guarded by AES-256 military-grade encryption with perfect forward secrecy, blocking unauthorized interception.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3>Zero Liability Guarantee</h3>
            <p>You are never held liable for unauthorized debit card purchases or digital wire transactions reported within standard federal guidelines.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <h3>Real-Time Fraud Monitoring</h3>
            <p>Continuous algorithmic surveillance inspects transaction patterns 24/7, immediately halting suspicious disbursements and notifying you via SMS.</p>
        </div>
    </div>

    <!-- FedWire Routing & Clearing Verification Box -->
    <div id="routing" class="calc-card" style="margin-bottom: 4rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">OFFICIAL CLEARING DETAILS</span>
            <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Corox Bank Wire &amp; ACH Routing Guide</h2>
            <p style="color: #4B5563; font-size: 1.05rem;">Use these verified credentials for all incoming domestic wires, direct deposits, and external transfers.</p>
        </div>

        <div class="comparison-table-wrapper" style="box-shadow: none; margin-bottom: 1rem;">
            <table class="comparison-table">
                <tbody>
                    <tr>
                        <td style="width: 35%;"><strong>Receiving Institution</strong></td>
                        <td><strong>Corox Commercial Bank</strong></td>
                    </tr>
                    <tr>
                        <td><strong>ABA / FedWire Routing Number</strong></td>
                        <td><strong style="color: var(--brand-red); font-size: 1.2rem; font-family: monospace;">026009593</strong> <span style="font-size: 12px; color: #059669; font-weight: 700;">(Verified Active)</span></td>
                    </tr>
                    <tr>
                        <td><strong>ACH Direct Deposit Routing</strong></td>
                        <td><strong style="font-family: monospace; font-size: 1.2rem;">026009593</strong></td>
                    </tr>
                    <tr>
                        <td><strong>SWIFT / BIC Code (International)</strong></td>
                        <td><strong style="font-family: monospace; font-size: 1.2rem;">CRXBXUS33</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Deposit Insurance Status</strong></td>
                        <td><strong style="color: #059669;">FDIC Certificate #39482 (Member FDIC)</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Wire Operations Desk</strong></td>
                        <td><strong>1-800-COROX-BK</strong> (Direct Operations)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Fraud Hotline & Security Contact -->
    <div style="background: #FEF2F2; border: 1px solid rgba(204,0,0,0.2); border-radius: var(--radius-lg); padding: 2.5rem; text-align: center; margin-bottom: 4rem;">
        <svg width="40" height="40" fill="none" stroke="#CC0000" stroke-width="2" viewBox="0 0 24 24" style="margin: 0 auto 1rem;"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <h3 style="font-size: 1.6rem; font-weight: 800; color: #991B1B; margin-bottom: 0.5rem;">Suspect Fraudulent Activity or Compromised Card?</h3>
        <p style="color: #7F1D1D; max-width: 650px; margin: 0 auto 1.5rem; font-size: 15px;">
            If you notice an unauthorized charge or suspect your login credentials have been compromised, immediately lock your card in Online Banking or contact our 24/7 Fraud Rapid Response Unit.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="tel:18002676925" class="btn btn-primary btn-lg">Call 24/7 Fraud Unit: 1-800-COROX-BK</a>
            <a href="{{ route('contact') }}" class="btn btn-secondary btn-lg" style="background: #FFFFFF; color: #991B1B; border-color: rgba(204,0,0,0.3);">Submit Incident Report</a>
        </div>
    </div>

    <!-- Security FAQ Accordion -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">SECURITY QUESTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">Security &amp; FDIC FAQs</h2>
    </div>

    <div class="faq-container">
        <div class="faq-item active">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>What occurs if my bank account exceeds $250,000 USD?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Standard FDIC insurance covers up to $250,000 per depositor, per account ownership category. If you have both individual and joint accounts, your combined coverage can easily exceed $500,000 to $1,000,000+. For institutional accounts with balances exceeding $250,000, Corox Bank provides our Insured Cash Sweep (ICS) facility, extending full FDIC coverage up to $50,000,000 USD.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>How does Corox Bank authenticate wire transfers?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                All outward wire transfers require two-factor cryptographic verification (SMS one-time passcode or hardware security key). Commercial wire transfers exceeding configured corporate limits require dual-signatory executive authorization before release to the Federal Reserve FedWire queue.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>How do I lock my debit or credit card instantly?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                You can instantly toggle your card lock on or off from the Corox Client Dashboard under "My USD Accounts". When locked, all incoming transactions are declined immediately until you unlock it.
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
