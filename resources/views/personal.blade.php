@extends('layouts.public')

@section('title', 'Personal USD Checking & High-Yield Savings | Corox Bank')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">PERSONAL BANKING • MEMBER FDIC • ROUTING 026009593</div>
    <h1>Personal Checking &amp; High-Yield Savings</h1>
    <p>Maximize liquidity, earn institutional-grade interest rates, and protect your capital with full FDIC insurance up to $250,000 per depositor.</p>
</section>

<div class="section-container">

    <!-- 4-Product Institutional Grid -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">CORE DEPOSIT ACCOUNTS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Engineered for Maximum Liquidity &amp; Return</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Open online in minutes with $0 minimum deposit and immediate digital access.</p>
    </div>

    <div class="cards-grid" style="margin-bottom: 4rem;">
        <!-- Card 1: Commercial Checking -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="feature-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: var(--brand-red); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">EVERYDAY LIQUIDITY</div>
                <h3>Corox Premier Checking</h3>
                <p>Zero monthly maintenance fees, free contactless Visa debit card, fee-free worldwide ATM access, and full FedWire &amp; ACH capabilities.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #F9FAFB; border-radius: var(--radius-sm); border: 1px solid #E5E7EB; font-size: 13px;">
                    <div><strong>Min. Opening:</strong> $0</div>
                    <div><strong>Monthly Fee:</strong> <span style="color: #059669; font-weight: 700;">$0 (Waived)</span></div>
                    <div><strong>Routing No:</strong> <code>026009593</code></div>
                </div>
            </div>
            <a href="{{ route('register') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Open Checking</a>
        </div>

        <!-- Card 2: High-Yield Savings -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between; border: 2px solid var(--brand-red); position: relative;">
            <div style="position: absolute; top: -12px; right: 20px; background: var(--brand-red); color: #FFFFFF; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 999px; letter-spacing: 0.5px;">MOST POPULAR</div>
            <div>
                <div class="feature-icon" style="background: rgba(204,0,0,0.1); color: var(--brand-red);">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: var(--brand-red); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">INSTITUTIONAL YIELD</div>
                <h3>Corox High-Yield Savings</h3>
                <p>Grow your liquid cash at an industry-leading <strong>5.15% APY</strong>. Compounded daily and paid monthly with zero lock-in periods.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #FEF2F2; border-radius: var(--radius-sm); border: 1px solid rgba(204,0,0,0.15); font-size: 13px;">
                    <div><strong>Annual Yield:</strong> <span style="color: var(--brand-red); font-size: 16px; font-weight: 900;">5.15% APY</span></div>
                    <div><strong>Compounding:</strong> Daily</div>
                    <div><strong>FDIC Insured:</strong> Up to $250,000</div>
                </div>
            </div>
            <a href="{{ route('register') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Open Savings</a>
        </div>

        <!-- Card 3: Fixed Term CDs -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="feature-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: #4B5563; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">GUARANTEED LOCK-IN</div>
                <h3>Certificate of Deposit (CD)</h3>
                <p>Lock in guaranteed high returns with flexible 6, 12, or 24-month terms. Predictable earnings backed by full federal deposit insurance.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #F9FAFB; border-radius: var(--radius-sm); border: 1px solid #E5E7EB; font-size: 13px;">
                    <div><strong>12-Mo Rate:</strong> <span style="color: #111827; font-weight: 800;">4.85% APY</span></div>
                    <div><strong>Min. Deposit:</strong> $500</div>
                    <div><strong>Early Penalty:</strong> 90 Days Interest</div>
                </div>
            </div>
            <a href="{{ route('register') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Lock CD Rate</a>
        </div>

        <!-- Card 4: Money Market -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="feature-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: #4B5563; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem;">TIERED LIQUIDITY</div>
                <h3>Premier Money Market</h3>
                <p>The flexibility of checking combined with premium yields. Enjoy check-writing privileges and tiered yields up to 4.50% APY.</p>
                <div style="margin: 1.2rem 0; padding: 0.8rem; background: #F9FAFB; border-radius: var(--radius-sm); border: 1px solid #E5E7EB; font-size: 13px;">
                    <div><strong>Tiered Yield:</strong> Up to 4.50% APY</div>
                    <div><strong>Check Writing:</strong> Included Free</div>
                    <div><strong>Min. Opening:</strong> $1,000</div>
                </div>
            </div>
            <a href="{{ route('register') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Explore Money Market</a>
        </div>
    </div>

    <!-- Interactive Compound Interest & Savings Growth Calculator -->
    <div class="calc-card">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">GROWTH SIMULATOR</span>
            <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Compound Interest &amp; Savings Growth Calculator</h2>
            <p style="color: #4B5563; font-size: 1.05rem;">See how rapidly your wealth compounds at Corox Bank's 5.15% APY compared to standard national averages.</p>
        </div>

        <div class="calc-grid">
            <div class="calc-inputs">
                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Initial Deposit</span>
                        <span class="calc-group-value" id="initDepositDisplay">$10,000</span>
                    </div>
                    <input type="range" class="calc-range" id="initDepositRange" min="500" max="100000" step="500" value="10000" oninput="calculateSavingsGrowth()">
                </div>

                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Monthly Contribution</span>
                        <span class="calc-group-value" id="monthlyDepositDisplay">$500 / mo</span>
                    </div>
                    <input type="range" class="calc-range" id="monthlyDepositRange" min="0" max="5000" step="100" value="500" oninput="calculateSavingsGrowth()">
                </div>

                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Investment Horizon</span>
                        <span class="calc-group-value" id="termDisplay">3 Years</span>
                    </div>
                    <input type="range" class="calc-range" id="termRange" min="1" max="10" step="1" value="3" oninput="calculateSavingsGrowth()">
                </div>
            </div>

            <div class="calc-result-box">
                <div class="calc-result-label">PROJECTED FUTURE BALANCE</div>
                <div class="calc-result-amount" id="totalSavingsDisplay">$31,280.45</div>
                <div style="color: #4ADE80; font-weight: 700; font-size: 14px;" id="totalInterestDisplay">+ $3,280.45 Total Interest Earned</div>

                <div class="calc-breakdown">
                    <div class="calc-breakdown-item">
                        <span>Total Principal Saved</span>
                        <strong id="totalPrincipalDisplay">$28,000.00</strong>
                    </div>
                    <div class="calc-breakdown-item">
                        <span>Annual Yield APY</span>
                        <strong style="color: #FFD700;">5.15% Fixed</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Account Comparison Table -->
    <div style="margin-bottom: 2rem; text-align: center;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">ACCOUNT SPECIFICATIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Compare Deposit Account Features</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Transparent banking with zero hidden fees and direct FedWire routing.</p>
    </div>

    <div class="comparison-table-wrapper">
        <table class="comparison-table">
            <thead>
                <tr>
                    <th style="width: 25%;">Account Features</th>
                    <th style="width: 25%;">Premier Checking</th>
                    <th class="highlight-col" style="width: 25%;">High-Yield Savings ★</th>
                    <th style="width: 25%;">Fixed Term CD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Interest Rate (APY)</strong></td>
                    <td>0.10% APY</td>
                    <td class="highlight-col"><strong style="color: var(--brand-red); font-size: 16px;">5.15% APY</strong></td>
                    <td><strong style="color: #111827; font-size: 15px;">4.85% APY</strong></td>
                </tr>
                <tr>
                    <td><strong>Monthly Maintenance Fee</strong></td>
                    <td><strong style="color: #059669;">$0 (No Fee)</strong></td>
                    <td class="highlight-col"><strong style="color: #059669;">$0 (No Fee)</strong></td>
                    <td><strong style="color: #059669;">$0 (No Fee)</strong></td>
                </tr>
                <tr>
                    <td><strong>Minimum Opening Deposit</strong></td>
                    <td>$0</td>
                    <td class="highlight-col"><strong>$0</strong></td>
                    <td>$500</td>
                </tr>
                <tr>
                    <td><strong>FedWire &amp; ACH Routing</strong></td>
                    <td><code>026009593</code> (Direct)</td>
                    <td class="highlight-col"><code>026009593</code> (Direct)</td>
                    <td><code>026009593</code> (Direct)</td>
                </tr>
                <tr>
                    <td><strong>FDIC Insurance</strong></td>
                    <td>$250,000 per depositor</td>
                    <td class="highlight-col">$250,000 per depositor</td>
                    <td>$250,000 per depositor</td>
                </tr>
                <tr>
                    <td><strong>Debit Card Access</strong></td>
                    <td>Contactless Visa Debit Card</td>
                    <td class="highlight-col">Digital Wallet Linked</td>
                    <td>N/A (Term Deposit)</td>
                </tr>
                <tr>
                    <td><strong>Mobile Check Deposit</strong></td>
                    <td>Up to $50,000 / day</td>
                    <td class="highlight-col">Up to $50,000 / day</td>
                    <td>Initial transfer only</td>
                </tr>
                <tr>
                    <td><strong>Action</strong></td>
                    <td>
                        <a href="{{ route('register') }}" class="btn btn-secondary" style="font-size: 13px; width: 100%; text-align: center;">Open Checking</a>
                    </td>
                    <td class="highlight-col">
                        <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 13px; width: 100%; text-align: center;">Open Savings</a>
                    </td>
                    <td>
                        <a href="{{ route('register') }}" class="btn btn-secondary" style="font-size: 13px; width: 100%; text-align: center;">Lock CD Rate</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FAQ Accordion -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FREQUENTLY ASKED QUESTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">Personal Banking FAQs</h2>
    </div>

    <div class="faq-container">
        <div class="faq-item active">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>How is my money insured at Corox Bank?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Corox Bank is a full member of the Federal Deposit Insurance Corporation (FDIC). Your deposits are automatically insured up to $250,000 for individual accounts and up to $500,000 for joint accounts, backed by the full faith and credit of the United States government.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>How often is interest paid on the High-Yield Savings account?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Interest is compounded daily based on your end-of-day ledger balance and is credited directly to your account on the last business day of each calendar month.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>What is the Corox Bank ABA FedWire routing number?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                The Corox Bank official routing number for incoming and outgoing domestic FedWire and ACH transfers is <strong>026009593</strong>.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Can I access my funds from abroad?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Yes. Your Corox Visa debit card works worldwide across all Visa-affiliated ATMs and merchant terminals with zero foreign transaction fees from Corox Bank.
            </div>
        </div>
    </div>

</div>

@section('scripts')
<script>
    function calculateSavingsGrowth() {
        const principal = parseFloat(document.getElementById('initDepositRange').value);
        const monthly = parseFloat(document.getElementById('monthlyDepositRange').value);
        const years = parseInt(document.getElementById('termRange').value);
        const annualRate = 0.0515; // 5.15% APY
        const monthlyRate = annualRate / 12;
        const totalMonths = years * 12;

        document.getElementById('initDepositDisplay').innerText = '$' + principal.toLocaleString();
        document.getElementById('monthlyDepositDisplay').innerText = '$' + monthly.toLocaleString() + ' / mo';
        document.getElementById('termDisplay').innerText = years + (years === 1 ? ' Year' : ' Years');

        // Future Value of Initial Principal: P * (1 + r)^n
        let futureBalance = principal * Math.pow(1 + monthlyRate, totalMonths);

        // Future Value of Monthly Contributions: PMT * [((1 + r)^n - 1) / r]
        if (monthlyRate > 0 && monthly > 0) {
            futureBalance += monthly * ((Math.pow(1 + monthlyRate, totalMonths) - 1) / monthlyRate);
        }

        const totalPrincipalSaved = principal + (monthly * totalMonths);
        const totalInterestEarned = Math.max(0, futureBalance - totalPrincipalSaved);

        document.getElementById('totalSavingsDisplay').innerText = '$' + futureBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('totalInterestDisplay').innerText = '+ $' + totalInterestEarned.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' Total Interest Earned';
        document.getElementById('totalPrincipalDisplay').innerText = '$' + totalPrincipalSaved.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    function toggleFaq(el) {
        const item = el.parentElement;
        item.classList.toggle('active');
    }
</script>
@endsection
@endsection
