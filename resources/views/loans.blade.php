@extends('layouts.public')

@section('title', 'Mortgages & Commercial Lending | Corox Bank')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">LENDING SOLUTIONS • COMPETITIVE FIXED RATES • EQUAL HOUSING LENDER</div>
    <h1>Mortgages &amp; Lending Solutions</h1>
    <p>Empowering homeowners and commercial developers with transparent rates, fast digital pre-approvals, and customized financing terms funded directly in USD.</p>
</section>

<div class="section-container">

    <!-- 4-Product Lending Grid -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FINANCING OPTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Residential Mortgages &amp; Commercial Credit</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">From first-time home buyers to seasoned commercial developers.</p>
    </div>

    <div class="cards-grid" style="margin-bottom: 4rem;">
        <!-- Card 1: 30-Yr Fixed -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="feature-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: var(--brand-red); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">RESIDENTIAL MORTGAGE</div>
                <h3>30-Year Fixed Mortgage</h3>
                <p>The gold standard of predictability. Lock in your rate for the entire life of your loan with down payment options starting as low as 3.5%.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #F9FAFB; border-radius: var(--radius-sm); border: 1px solid #E5E7EB; font-size: 13px;">
                    <div><strong>Fixed APR:</strong> <span style="color: var(--brand-red); font-weight: 800; font-size: 15px;">5.98% APR</span></div>
                    <div><strong>Down Payment:</strong> From 3.5%</div>
                    <div><strong>Max Amount:</strong> Up to $2,500,000</div>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Apply for 30-Yr</a>
        </div>

        <!-- Card 2: 15-Yr Fixed -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="feature-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: var(--brand-red); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">ACCELERATED EQUITY</div>
                <h3>15-Year Fixed Mortgage</h3>
                <p>Pay off your property in half the time and save tens of thousands in lifetime interest with our lowest fixed mortgage rates.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #F9FAFB; border-radius: var(--radius-sm); border: 1px solid #E5E7EB; font-size: 13px;">
                    <div><strong>Fixed APR:</strong> <span style="color: #059669; font-weight: 800; font-size: 15px;">5.25% APR</span></div>
                    <div><strong>Term:</strong> 180 Months</div>
                    <div><strong>Closing Credit:</strong> Up to $1,500</div>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Apply for 15-Yr</a>
        </div>

        <!-- Card 3: HELOC -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="feature-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: #4B5563; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">HOME EQUITY</div>
                <h3>Corox Home Equity (HELOC)</h3>
                <p>Leverage the equity in your primary or secondary residence with a revolving line of credit up to $500,000 for renovations or investments.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #F9FAFB; border-radius: var(--radius-sm); border: 1px solid #E5E7EB; font-size: 13px;">
                    <div><strong>Variable APR:</strong> Prime + 1.25%</div>
                    <div><strong>Draw Period:</strong> 10 Years</div>
                    <div><strong>No Closing Costs:</strong> On lines &gt; $50k</div>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Inquire HELOC</a>
        </div>

        <!-- Card 4: Commercial Lending -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="feature-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: #4B5563; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">COMMERCIAL CREDIT</div>
                <h3>Commercial Real Estate (CRE)</h3>
                <p>Substantial debt facilities for multi-family, logistics, and office acquisitions with loan amounts up to $10,000,000 USD.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #F9FAFB; border-radius: var(--radius-sm); border: 1px solid #E5E7EB; font-size: 13px;">
                    <div><strong>Facility Limit:</strong> Up to $10,000,000</div>
                    <div><strong>Amortization:</strong> Up to 25 Years</div>
                    <div><strong>Underwriting:</strong> Dedicated Banker</div>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Commercial Inquiries</a>
        </div>
    </div>

    <!-- Interactive Mortgage Payment Calculator -->
    <div class="calc-card">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">MORTGAGE ESTIMATOR</span>
            <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Monthly Mortgage Payment Calculator</h2>
            <p style="color: #4B5563; font-size: 1.05rem;">Estimate your monthly principal and interest payments based on loan size, term, and interest rate.</p>
        </div>

        <div class="calc-grid">
            <div class="calc-inputs">
                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Total Loan Amount</span>
                        <span class="calc-group-value" id="loanAmountDisplay">$450,000</span>
                    </div>
                    <input type="range" class="calc-range" id="loanAmountRange" min="50000" max="1500000" step="10000" value="450000" oninput="calculateMortgage()">
                </div>

                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Interest Rate (APR)</span>
                        <span class="calc-group-value" id="loanAprDisplay">5.98%</span>
                    </div>
                    <input type="range" class="calc-range" id="loanAprRange" min="3.5" max="9.5" step="0.1" value="5.98" oninput="calculateMortgage()">
                </div>

                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Loan Term</span>
                        <span class="calc-group-value" id="loanTermDisplay">30 Years (360 Mos)</span>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <button type="button" class="card-selector-tab" onclick="setTerm(15, this)">15 Years</button>
                        <button type="button" class="card-selector-tab active" onclick="setTerm(30, this)">30 Years</button>
                    </div>
                </div>
            </div>

            <div class="calc-result-box">
                <div class="calc-result-label">ESTIMATED MONTHLY PAYMENT</div>
                <div class="calc-result-amount" id="monthlyPaymentDisplay">$2,692.14</div>
                <div style="color: #D1D5DB; font-size: 13px;">Principal &amp; Interest Only (Taxes &amp; Insurance Excluded)</div>

                <div class="calc-breakdown">
                    <div class="calc-breakdown-item">
                        <span>Total Interest Paid</span>
                        <strong id="totalInterestPaidDisplay">$519,170</strong>
                    </div>
                    <div class="calc-breakdown-item">
                        <span>Total Cost of Loan</span>
                        <strong id="totalLoanCostDisplay">$969,170</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loan Comparison Rate Sheet -->
    <div style="margin-bottom: 2rem; text-align: center;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">CURRENT LENDING RATES</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Transparent Institutional Lending Schedule</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Direct rates updated daily based on federal benchmark yields.</p>
    </div>

    <div class="comparison-table-wrapper">
        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Loan Program</th>
                    <th>Interest Rate</th>
                    <th>APR</th>
                    <th>Est. Payment per $100k</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>30-Year Fixed Conforming</strong>
                        <div style="font-size: 12px; color: #6B7280;">Standard single-family primary residence</div>
                    </td>
                    <td>5.875%</td>
                    <td><strong style="color: var(--brand-red);">5.980% APR</strong></td>
                    <td>$598.25 / mo</td>
                    <td><a href="{{ route('contact') }}" class="btn btn-primary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Apply Now</a></td>
                </tr>
                <tr>
                    <td>
                        <strong>15-Year Fixed Conforming</strong>
                        <div style="font-size: 12px; color: #6B7280;">Rapid payoff &amp; reduced lifetime interest</div>
                    </td>
                    <td>5.125%</td>
                    <td><strong style="color: #059669;">5.250% APR</strong></td>
                    <td>$803.88 / mo</td>
                    <td><a href="{{ route('contact') }}" class="btn btn-primary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Apply Now</a></td>
                </tr>
                <tr>
                    <td>
                        <strong>30-Year Fixed Jumbo</strong>
                        <div style="font-size: 12px; color: #6B7280;">Loan amounts above conforming limits up to $2.5M</div>
                    </td>
                    <td>6.250%</td>
                    <td><strong>6.375% APR</strong></td>
                    <td>$624.50 / mo</td>
                    <td><a href="{{ route('contact') }}" class="btn btn-secondary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Inquire</a></td>
                </tr>
                <tr>
                    <td>
                        <strong>Home Equity Line of Credit (HELOC)</strong>
                        <div style="font-size: 12px; color: #6B7280;">Revolving variable line against equity</div>
                    </td>
                    <td>Prime + 1.25%</td>
                    <td><strong>8.500% APR</strong></td>
                    <td>Interest-Only Draw</td>
                    <td><a href="{{ route('contact') }}" class="btn btn-secondary" style="font-size: 12px; padding: 0.4rem 0.8rem;">Inquire</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- 4-Step Lending Process -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">ROADMAP TO CLOSING</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">Your Journey from Application to Funded</h2>
    </div>

    <div class="process-grid">
        <div class="process-step-card">
            <div class="process-step-num">1</div>
            <h4>Digital Pre-Approval</h4>
            <p>Submit your financial details online. Receive an official pre-qualification letter in as fast as 15 minutes.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num">2</div>
            <h4>Officer Consultation</h4>
            <p>Connect with a dedicated Corox mortgage officer to lock your rate and structure your repayment strategy.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num">3</div>
            <h4>Underwriting &amp; Appraisal</h4>
            <p>Our expedited digital underwriting team validates your documents and schedules property appraisal seamlessly.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num">4</div>
            <h4>Clear to Close</h4>
            <p>Sign documents digitally or at your preferred location. Funds are wired directly via FedWire clearing.</p>
        </div>
    </div>

    <!-- FAQ Accordion -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FREQUENTLY ASKED QUESTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">Lending &amp; Mortgage FAQs</h2>
    </div>

    <div class="faq-container">
        <div class="faq-item active">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>What is the minimum down payment for a Corox residential mortgage?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Qualified borrowers can purchase a primary residential property with as little as 3.5% down on conventional and conforming loan programs. Jumbo mortgages typically require a minimum of 10% to 20% down.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Can I lock in my interest rate while shopping for a home?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Yes. Corox Bank offers our "Lock &amp; Shop" program, allowing you to lock in an interest rate for up to 90 days while you search for your ideal residential property, protecting you against market rate increases.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Are there prepayment penalties if I pay off my mortgage early?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                No. None of our residential mortgage programs carry prepayment penalties. You may make additional principal payments or pay off your loan balance in full at any time without incurring fees.
            </div>
        </div>
    </div>

</div>

@section('scripts')
<script>
    let currentYears = 30;

    function setTerm(years, btn) {
        currentYears = years;
        btn.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('loanTermDisplay').innerText = years + ' Years (' + (years * 12) + ' Mos)';
        calculateMortgage();
    }

    function calculateMortgage() {
        const principal = parseFloat(document.getElementById('loanAmountRange').value);
        const apr = parseFloat(document.getElementById('loanAprRange').value);
        const monthlyRate = (apr / 100) / 12;
        const totalPayments = currentYears * 12;

        document.getElementById('loanAmountDisplay').innerText = '$' + principal.toLocaleString();
        document.getElementById('loanAprDisplay').innerText = apr.toFixed(2) + '%';

        // Monthly payment: M = P [ i(1 + i)^n ] / [ (1 + i)^n – 1]
        let monthlyPayment = 0;
        if (monthlyRate > 0) {
            monthlyPayment = principal * (monthlyRate * Math.pow(1 + monthlyRate, totalPayments)) / (Math.pow(1 + monthlyRate, totalPayments) - 1);
        } else {
            monthlyPayment = principal / totalPayments;
        }

        const totalCost = monthlyPayment * totalPayments;
        const totalInterest = Math.max(0, totalCost - principal);

        document.getElementById('monthlyPaymentDisplay').innerText = '$' + monthlyPayment.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('totalInterestPaidDisplay').innerText = '$' + Math.round(totalInterest).toLocaleString();
        document.getElementById('totalLoanCostDisplay').innerText = '$' + Math.round(totalCost).toLocaleString();
    }

    function toggleFaq(el) {
        const item = el.parentElement;
        item.classList.toggle('active');
    }
</script>
@endsection
@endsection
