@extends('layouts.public')
@section('title', 'Loans & Mortgages')
@section('content')
<section class="page-hero">
    <h1>Mortgages & Lending Solutions</h1>
    <p>Competitive fixed rates, home mortgages, auto financing, and commercial lines of credit funded in USD.</p>
</section>

<div class="section-container">
    <div class="cards-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
            </div>
            <h3>Home Mortgages</h3>
            <p>15-year and 30-year fixed rate residential mortgages with low down payment options starting from 3.5% down.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top: 1.5rem;">Apply for Mortgage</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <h3>Auto Loans</h3>
            <p>Fast approval auto financing for new and pre-owned vehicles with APR rates as low as 4.49%.</p>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Calculate Auto Loan</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3>Personal Lines of Credit</h3>
            <p>Revolving credit lines up to $100,000 USD to cover unexpected expenses or home renovation projects.</p>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="margin-top: 1.5rem;">Check Eligibility</a>
        </div>
    </div>
</div>
@endsection
