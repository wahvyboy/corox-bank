@extends('layouts.public')

@section('title', 'Corox Infinite Metal & Platinum Credit Cards | Corox Bank')

@section('content')
<!-- Institutional Hero -->
<section class="page-hero">
    <div class="hero-tag">PREMIUM CREDIT PRODUCTS • ESTABLISHED 1987</div>
    <h1>Corox Infinite Metal &amp; Platinum Cards</h1>
    <p>Crafted from precision-milled metallic alloy. Earn unlimited cash back, premium global lounge privileges, and zero foreign transaction fees worldwide.</p>
</section>

<div class="section-container">

    <!-- Card Visualizer & Interactive Switcher -->
    <div class="card-visualizer-container">
        <div class="card-stage">
            <div class="realistic-card card-theme-gold" id="visualizerCard">
                <div class="card-top">
                    <div class="card-chip-box">
                        <div class="card-chip"></div>
                        <svg width="22" height="22" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8.5 16.5a5 5 0 010-9M12 19a8.5 8.5 0 000-14M15.5 21.5a12 12 0 000-19"/>
                        </svg>
                    </div>
                    <div style="text-align: right;">
                        <span style="font-family: var(--font-serif); font-weight: 900; font-size: 16px; letter-spacing: 1px; color: #FFFFFF;" id="cardBrandName">COROX INFINITE</span>
                        <div style="font-size: 9px; letter-spacing: 1.5px; color: #DDAA00;" id="cardTierName">SIGNATURE METAL</div>
                    </div>
                </div>

                <div class="card-number" id="cardNumberDisplay">4829 •••• •••• 8829</div>

                <div class="card-bottom">
                    <div>
                        <div class="card-holder-label">CARDHOLDER</div>
                        <div class="card-holder-name">ALEXANDER VAUGHN</div>
                    </div>
                    <div style="text-align: right;">
                        <div class="card-holder-label">EXPIRES</div>
                        <div class="card-holder-name">09/29</div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">SELECT CARD PROFILE</span>
            <div class="card-selector-tabs">
                <button class="card-selector-tab active" onclick="switchCard('gold')">Infinite Metal</button>
                <button class="card-selector-tab" onclick="switchCard('platinum')">Platinum Cash</button>
                <button class="card-selector-tab" onclick="switchCard('executive')">Business Exec</button>
            </div>

            <h2 id="cardTitle" style="font-size: 1.85rem; font-weight: 800; margin-bottom: 0.75rem;">Corox Infinite Rewards Signature</h2>
            <p id="cardDesc" style="color: var(--text-secondary); font-size: 14.5px; line-height: 1.7; margin-bottom: 1.5rem;">
                Machined from 18-gram brushed metallic gold alloy. Enjoy 3.5% cash back on fine dining &amp; international travel, a $200 USD statement bonus, and complimentary Priority Pass™ lounge access.
            </p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.8rem; background: #F9FAFB; padding: 1.2rem; border-radius: var(--radius-md); border: 1px solid #E5E7EB;">
                <div>
                    <div style="font-size: 11px; text-transform: uppercase; color: #6B7280; font-weight: 700;">Annual Fee</div>
                    <div id="cardFee" style="font-size: 1.25rem; font-weight: 800; color: #111827;">$0 First Year <span style="font-size: 12px; color: #6B7280;">(then $95)</span></div>
                </div>
                <div>
                    <div style="font-size: 11px; text-transform: uppercase; color: #6B7280; font-weight: 700;">Intro APR</div>
                    <div id="cardApr" style="font-size: 1.25rem; font-weight: 800; color: #059669;">0% for 15 Mos</div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg" id="cardApplyBtn">Apply for Infinite Metal</a>
                <a href="#comparison" class="btn btn-secondary btn-lg">Compare All Cards</a>
            </div>
        </div>
    </div>

    <!-- Interactive Cash Back & Rewards Estimator -->
    <div class="calc-card">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">INTERACTIVE REWARDS ESTIMATOR</span>
            <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Calculate Your Annual Rewards Earnings</h2>
            <p style="color: #4B5563; font-size: 1.05rem;">Estimate how much cash back you will accumulate each year based on your typical monthly spend.</p>
        </div>

        <div class="calc-grid">
            <div class="calc-inputs">
                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Dining, Restaurants &amp; Food Delivery</span>
                        <span class="calc-group-value" id="diningValDisplay">$600 / mo</span>
                    </div>
                    <input type="range" class="calc-range" id="diningRange" min="0" max="3000" step="50" value="600" oninput="calculateRewards()">
                </div>

                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Travel, Airlines &amp; Hotels</span>
                        <span class="calc-group-value" id="travelValDisplay">$800 / mo</span>
                    </div>
                    <input type="range" class="calc-range" id="travelRange" min="0" max="5000" step="100" value="800" oninput="calculateRewards()">
                </div>

                <div class="calc-group">
                    <div class="calc-group-header">
                        <span>Everyday Groceries &amp; Retail</span>
                        <span class="calc-group-value" id="retailValDisplay">$1,200 / mo</span>
                    </div>
                    <input type="range" class="calc-range" id="retailRange" min="0" max="4000" step="100" value="1200" oninput="calculateRewards()">
                </div>
            </div>

            <div class="calc-result-box">
                <div class="calc-result-label">ESTIMATED ANNUAL CASH BACK</div>
                <div class="calc-result-amount" id="totalRewardsDisplay">$964.00</div>
                <div style="color: #D1D5DB; font-size: 13px;">Includes $200 USD first-year statement welcome bonus</div>

                <div class="calc-breakdown">
                    <div class="calc-breakdown-item">
                        <span>Monthly Average</span>
                        <strong id="monthlyRewardDisplay">$80.33</strong>
                    </div>
                    <div class="calc-breakdown-item">
                        <span>3-Year Projection</span>
                        <strong id="threeYearRewardDisplay">$2,492.00</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Card Comparison Matrix -->
    <div id="comparison" style="margin-bottom: 2rem; text-align: center;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">COMPREHENSIVE SPECIFICATIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827; margin-bottom: 0.5rem;">Compare Corox Credit Card Products</h2>
        <p style="color: #4B5563; font-size: 1.05rem;">Choose the card engineered specifically for your lifestyle and purchasing volume.</p>
    </div>

    <div class="comparison-table-wrapper">
        <table class="comparison-table">
            <thead>
                <tr>
                    <th style="width: 25%;">Feature &amp; Benefit</th>
                    <th class="highlight-col" style="width: 25%;">Corox Infinite Rewards ★</th>
                    <th style="width: 25%;">Platinum Cash Back</th>
                    <th style="width: 25%;">Business Executive</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Card Material</strong></td>
                    <td class="highlight-col">18g Heavy Brushed Metal</td>
                    <td>12g Reinforced Matte Poly</td>
                    <td>16g Black Onyx Titanium</td>
                </tr>
                <tr>
                    <td><strong>Cash Back / Multiplier</strong></td>
                    <td class="highlight-col"><span style="color: var(--brand-red); font-weight: 800;">3.5%</span> Dining &amp; Travel, 1.5% All Else</td>
                    <td><strong>2.0% Unlimited</strong> on all USD purchases</td>
                    <td><span style="color: #2563EB; font-weight: 800;">2.5%</span> on all business expenses</td>
                </tr>
                <tr>
                    <td><strong>Welcome Statement Bonus</strong></td>
                    <td class="highlight-col"><strong>$200 USD</strong> after $1,500 spend</td>
                    <td><strong>$150 USD</strong> after $1,000 spend</td>
                    <td><strong>$500 USD</strong> after $5,000 spend</td>
                </tr>
                <tr>
                    <td><strong>Annual Membership Fee</strong></td>
                    <td class="highlight-col">$0 Year 1, then $95</td>
                    <td><strong style="color: #059669;">$0 Always</strong></td>
                    <td>$195 / year</td>
                </tr>
                <tr>
                    <td><strong>Foreign Transaction Fees</strong></td>
                    <td class="highlight-col"><strong style="color: #059669;">0% Worldwide</strong></td>
                    <td><strong style="color: #059669;">0% Worldwide</strong></td>
                    <td><strong style="color: #059669;">0% Worldwide</strong></td>
                </tr>
                <tr>
                    <td><strong>Airport Lounge Access</strong></td>
                    <td class="highlight-col">Priority Pass™ Select (1,300+ Lounges)</td>
                    <td>Not Included</td>
                    <td>Priority Pass™ + 2 Guests Free</td>
                </tr>
                <tr>
                    <td><strong>Travel Insurance &amp; Delay</strong></td>
                    <td class="highlight-col">Up to $10,000 trip cancellation</td>
                    <td>Secondary car rental waiver</td>
                    <td>Up to $25,000 comprehensive</td>
                </tr>
                <tr>
                    <td><strong>Cell Phone Protection</strong></td>
                    <td class="highlight-col">Up to $800 per claim ($50 ded.)</td>
                    <td>Up to $600 per claim ($50 ded.)</td>
                    <td>Up to $1,000 per claim ($25 ded.)</td>
                </tr>
                <tr>
                    <td><strong>Direct Account Linkage</strong></td>
                    <td class="highlight-col">Auto-debit from Corox Checking</td>
                    <td>Auto-debit from Corox Checking</td>
                    <td>Direct ACH Wire Integration</td>
                </tr>
                <tr>
                    <td><strong>Action</strong></td>
                    <td class="highlight-col">
                        <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 13px; width: 100%; text-align: center;">Apply Infinite</a>
                    </td>
                    <td>
                        <a href="{{ route('register') }}" class="btn btn-secondary" style="font-size: 13px; width: 100%; text-align: center;">Apply Platinum</a>
                    </td>
                    <td>
                        <a href="{{ route('register') }}" class="btn btn-secondary" style="font-size: 13px; width: 100%; text-align: center;">Apply Executive</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- 3-Step Process -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">EXPEDITED ONBOARDING</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">How to Apply in 3 Simple Steps</h2>
    </div>

    <div class="process-grid">
        <div class="process-step-card">
            <div class="process-step-num">1</div>
            <h4>Check Pre-Approval</h4>
            <p>Complete our secure 60-second digital questionnaire. See your approved credit limit with zero impact on your credit score.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num">2</div>
            <h4>Confirm &amp; Instant Access</h4>
            <p>Accept your terms and instantly add your digital Corox card to Apple Pay or Google Wallet for immediate contactless purchasing.</p>
        </div>
        <div class="process-step-card">
            <div class="process-step-num">3</div>
            <h4>Metal Delivery</h4>
            <p>Your heavy metallic alloy card is shipped via expedited FedEx Courier in an encrypted, tamper-evident security vault package.</p>
        </div>
    </div>

    <!-- FAQ Accordion -->
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: var(--brand-red); font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 0.5rem;">FREQUENTLY ASKED QUESTIONS</span>
        <h2 style="font-family: var(--font-serif); font-size: 2.1rem; color: #111827;">Credit Card FAQs</h2>
    </div>

    <div class="faq-container">
        <div class="faq-item active">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Will checking my card pre-approval affect my credit score?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                No. Corox Bank uses a soft inquiry during the pre-approval phase, which will not impact your credit score in any way. A formal hard inquiry is only conducted if you explicitly choose to accept your final credit card offer.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>How are cash back rewards credited to my account?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Your accumulated rewards can be redeemed at any time with no minimum threshold. You can choose direct deposit into your Corox Commercial Checking or High-Yield Savings account, apply them as a statement credit, or convert them into airline partner miles.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>What are the foreign exchange and international transaction fees?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                All Corox Bank credit cards feature 0% foreign transaction fees. Whether you make a purchase in London, Tokyo, or online in a foreign currency, you receive the raw interbank exchange rate without markups or hidden fees.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>How fast does the physical metal card arrive?</span>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                Upon final verification, your custom laser-engraved metal card is dispatched via priority express shipping and typically arrives at your registered residential or corporate address within 2 to 3 business days.
            </div>
        </div>
    </div>

</div>

@section('scripts')
<script>
    const cardData = {
        gold: {
            theme: 'card-theme-gold',
            brand: 'COROX INFINITE',
            tier: 'SIGNATURE METAL',
            number: '4829 •••• •••• 8829',
            title: 'Corox Infinite Rewards Signature',
            desc: 'Machined from 18-gram brushed metallic gold alloy. Enjoy 3.5% cash back on fine dining & international travel, a $200 USD statement bonus, and complimentary Priority Pass™ lounge access.',
            fee: '$0 First Year <span style="font-size: 12px; color: #6B7280;">(then $95)</span>',
            apr: '0% for 15 Mos',
            btnText: 'Apply for Infinite Metal'
        },
        platinum: {
            theme: 'card-theme-platinum',
            brand: 'COROX PLATINUM',
            tier: 'CASH BACK TITANIUM',
            number: '4112 •••• •••• 3410',
            title: 'Corox Platinum Cash Back Card',
            desc: 'Streamlined everyday purchasing with unlimited 2.0% cash back on all USD transactions. Zero annual fees, complimentary rental car coverage, and 0% intro APR on balance transfers.',
            fee: '$0 Forever <span style="font-size: 12px; color: #059669;">(No Annual Fee)</span>',
            apr: '0% for 18 Mos',
            btnText: 'Apply for Platinum Cash'
        },
        executive: {
            theme: 'card-theme-executive',
            brand: 'COROX EXECUTIVE',
            tier: 'COMMERCIAL TREASURY',
            number: '4790 •••• •••• 9912',
            title: 'Corox Business Executive Card',
            desc: 'Designed for corporate enterprises and business principals. 2.5% back on all commercial vendor expenditures, high revolving credit limits up to $250,000, and integrated accounting sync.',
            fee: '$195 / Year <span style="font-size: 12px; color: #6B7280;">(Tax-deductible)</span>',
            apr: 'Prime + 4.99%',
            btnText: 'Apply for Business Executive'
        }
    };

    function switchCard(type) {
        document.querySelectorAll('.card-selector-tab').forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');

        const card = document.getElementById('visualizerCard');
        card.className = 'realistic-card ' + cardData[type].theme;
        document.getElementById('cardBrandName').innerText = cardData[type].brand;
        document.getElementById('cardTierName').innerText = cardData[type].tier;
        document.getElementById('cardNumberDisplay').innerText = cardData[type].number;
        document.getElementById('cardTitle').innerText = cardData[type].title;
        document.getElementById('cardDesc').innerText = cardData[type].desc;
        document.getElementById('cardFee').innerHTML = cardData[type].fee;
        document.getElementById('cardApr').innerText = cardData[type].apr;
        document.getElementById('cardApplyBtn').innerText = cardData[type].btnText;
    }

    function calculateRewards() {
        const dining = parseFloat(document.getElementById('diningRange').value);
        const travel = parseFloat(document.getElementById('travelRange').value);
        const retail = parseFloat(document.getElementById('retailRange').value);

        document.getElementById('diningValDisplay').innerText = '$' + dining.toLocaleString() + ' / mo';
        document.getElementById('travelValDisplay').innerText = '$' + travel.toLocaleString() + ' / mo';
        document.getElementById('retailValDisplay').innerText = '$' + retail.toLocaleString() + ' / mo';

        // 3.5% on dining & travel, 1.5% on retail + $200 intro bonus
        const annualDiningTravelRewards = (dining + travel) * 12 * 0.035;
        const annualRetailRewards = retail * 12 * 0.015;
        const totalAnnual = annualDiningTravelRewards + annualRetailRewards + 200;
        const monthlyAverage = totalAnnual / 12;
        const threeYearProjection = (totalAnnual - 200) * 3 + 200;

        document.getElementById('totalRewardsDisplay').innerText = '$' + totalAnnual.toFixed(2);
        document.getElementById('monthlyRewardDisplay').innerText = '$' + monthlyAverage.toFixed(2);
        document.getElementById('threeYearRewardDisplay').innerText = '$' + threeYearProjection.toFixed(2);
    }

    function toggleFaq(el) {
        const item = el.parentElement;
        item.classList.toggle('active');
    }
</script>
@endsection
@endsection
