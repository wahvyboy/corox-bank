@extends('layouts.public')

@section('title', 'Contact Corox Bank | Direct Wire Desk & Institutional Support')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">CLIENT RELATIONS • 24/7 WIRE DESK • ROUTING 026009593</div>
    <h1>Contact Corox Commercial Bank</h1>
    <p>Connect directly with our commercial wire desk, private wealth concierges, or 24/7 fraud rapid response unit.</p>
</section>

<div class="section-container">

    <!-- 3 Core Support Channels -->
    <div class="cards-grid" style="margin-bottom: 4rem;">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <h3>Commercial Wire Desk</h3>
            <p>Direct assistance for high-value domestic FedWire, international SWIFT transfers, and ACH batch clearing.</p>
            <div style="margin: 1rem 0; font-size: 14px;">
                <div><strong>Telephone:</strong> 1-800-COROX-BK</div>
                <div><strong>Routing:</strong> <code>026009593</code></div>
                <div><strong>Hours:</strong> Mon – Fri: 7:00 AM – 8:00 PM ET</div>
            </div>
            <a href="tel:18002676925" class="btn btn-primary" style="width: 100%; text-align: center;">Call Wire Desk</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon" style="background: rgba(204,0,0,0.1); color: var(--brand-red);">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <h3>24/7 Fraud &amp; Card Security</h3>
            <p>Immediate support for stolen cards, suspicious transactions, or compromised online banking credentials.</p>
            <div style="margin: 1rem 0; font-size: 14px;">
                <div><strong>Hotline:</strong> 1-800-267-6925</div>
                <div><strong>Priority:</strong> Immediate Response</div>
                <div><strong>Availability:</strong> 24 Hours / 365 Days</div>
            </div>
            <a href="tel:18002676925" class="btn btn-primary" style="width: 100%; text-align: center; background: #991B1B;">Report Fraud</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3>Private Wealth Concierge</h3>
            <p>Dedicated relationship managers for Private Client and Family Office account holders.</p>
            <div style="margin: 1rem 0; font-size: 14px;">
                <div><strong>Direct Desk:</strong> 1-888-COROX-PW</div>
                <div><strong>Email:</strong> wealth@coroxbank.com</div>
                <div><strong>Executive Desk:</strong> By Appointment</div>
            </div>
            <a href="{{ route('wealth') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Wealth Advisory</a>
        </div>
    </div>

    <!-- Contact & Message Form -->
    <div class="calc-card" style="max-width: 850px; margin: 0 auto 4rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">SECURE COMMUNICATIONS</span>
            <h2 style="font-family: var(--font-serif); font-size: 2rem; color: #111827; margin-bottom: 0.5rem;">Send a Secure Message</h2>
            <p style="color: #4B5563; font-size: 14px;">Inquiries are routed to the appropriate department within 1 business hour.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 1.5rem; background: #ECFDF5; border-left: 4px solid #059669; color: #065F46; padding: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <form id="contactForm" onsubmit="event.preventDefault(); document.getElementById('contactSuccess').style.display = 'block'; this.reset();" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem;">
            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Full Name</label>
                <input type="text" required placeholder="e.g. Robert Henderson" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Email Address</label>
                <input type="email" required placeholder="name@company.com" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Phone Number</label>
                <input type="tel" placeholder="+1 (555) 000-0000" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Department</label>
                <select style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px; background: #FFFFFF;">
                    <option>Commercial Treasury &amp; FedWire</option>
                    <option>Personal Deposit Accounts</option>
                    <option>Credit Cards &amp; Rewards</option>
                    <option>Mortgage &amp; Lending</option>
                    <option>Private Wealth Management</option>
                    <option>Compliance &amp; Security</option>
                </select>
            </div>

            <div style="grid-column: span 2;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Subject</label>
                <input type="text" required placeholder="Brief description of your inquiry" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px;">
            </div>

            <div style="grid-column: span 2;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 0.4rem;">Message</label>
                <textarea rows="4" required placeholder="Please provide details regarding your inquiry. Do not include sensitive passwords or PINs." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #D1D5DB; border-radius: var(--radius-sm); font-size: 14px; resize: vertical;"></textarea>
            </div>

            <div id="contactSuccess" style="display: none; grid-column: span 2; background: #ECFDF5; border-left: 4px solid #059669; color: #065F46; padding: 1rem; border-radius: var(--radius-sm); font-size: 14px;">
                ✓ Your inquiry has been securely submitted to the Corox Bank operations desk. A representative will contact you shortly.
            </div>

            <div style="grid-column: span 2; margin-top: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Transmit Secure Message</button>
            </div>
        </form>
    </div>

    <!-- Corporate Directory & Locations -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">PHYSICAL DIRECTORY</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Executive Offices &amp; Regional Hubs</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Serving commercial clients across key financial centers.</p>
    </div>

    <div class="cards-grid" style="margin-bottom: 4rem;">
        <div class="feature-card">
            <h3>New York Financial District</h3>
            <div style="font-size: 12px; font-weight: 700; color: var(--brand-red); text-transform: uppercase; margin-bottom: 0.5rem;">Corporate Headquarters</div>
            <p style="font-size: 14px; line-height: 1.6;">
                140 Broadway, 38th Floor<br>
                New York, NY 10005<br>
                Tel: +1 (212) 555-0190
            </p>
        </div>

        <div class="feature-card">
            <h3>Chicago Commercial Center</h3>
            <div style="font-size: 12px; font-weight: 700; color: var(--brand-red); text-transform: uppercase; margin-bottom: 0.5rem;">Midwest Operations &amp; Clearing</div>
            <p style="font-size: 14px; line-height: 1.6;">
                200 S. Wacker Drive, Suite 2400<br>
                Chicago, IL 60606<br>
                Tel: +1 (312) 555-0144
            </p>
        </div>

        <div class="feature-card">
            <h3>San Francisco Tech Banking</h3>
            <div style="font-size: 12px; font-weight: 700; color: var(--brand-red); text-transform: uppercase; margin-bottom: 0.5rem;">Commercial &amp; Venture Treasury</div>
            <p style="font-size: 14px; line-height: 1.6;">
                555 California Street, 29th Floor<br>
                San Francisco, CA 94104<br>
                Tel: +1 (415) 555-0182
            </p>
        </div>
    </div>

</div>
@endsection
