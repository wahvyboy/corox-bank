@extends('layouts.public')
@section('title', 'Contact Support')
@section('content')
<section class="page-hero">
    <h1>Contact Corox Bank</h1>
    <p>We are available 24/7/365 to assist with wire routing, account inquiries, and commercial desk operations.</p>
</section>

<div class="section-container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
        <div style="background: var(--bg-surface); border: 1px solid var(--navy-border); border-radius: var(--radius-xl); padding: 2.5rem;">
            <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--accent-gold-bright);">Headquarters & Routing Info</h2>
            
            <div style="margin-bottom: 1.5rem;">
                <strong style="color: var(--text-primary); display: block;">Corox Bank Corporate Tower</strong>
                <p style="color: var(--text-secondary); font-size: 14px;">100 Wall Street, 24th Floor<br>New York, NY 10005, USA</p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <strong style="color: var(--text-primary); display: block;">Direct Wire ABA Routing Number</strong>
                <p style="color: var(--accent-gold-bright); font-size: 18px; font-weight: 800;">026009593</p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <strong style="color: var(--text-primary); display: block;">Telephone Assistance</strong>
                <p style="color: var(--text-secondary); font-size: 14px;">Toll-Free USA: 1-800-COROX-BK (1-800-267-6925)<br>International: +1 (212) 555-0199</p>
            </div>
        </div>

        <div style="background: var(--bg-surface); border: 1px solid var(--navy-border); border-radius: var(--radius-xl); padding: 2.5rem;">
            <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem;">Send Inquiry</h2>
            <form onsubmit="event.preventDefault(); alert('Thank you for contacting Corox Bank. A representative will respond shortly.');">
                <div class="form-group">
                    <label class="form-label">Your Name</label>
                    <input type="text" class="form-control" required placeholder="John Doe">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" required placeholder="john@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" rows="4" required placeholder="How can we assist your financial needs?"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
