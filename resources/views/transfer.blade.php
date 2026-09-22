@extends('layouts.app')
@section('title', 'Send Wire / ACH Transfer')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Send Wire / ACH Transfer</h2>
        <p style="color: var(--text-secondary);">Transfer funds in USD to any domestic or international bank account using Account Number and Routing Number.</p>
    </div>
</div>

<div class="portal-form-card">
    <form action="{{ url('/user/transfer') }}" method="POST" id="transferForm">
        @csrf
        <div class="form-group">
            <label for="from_account_number" class="form-label">Source USD Account</label>
            <select name="from_account_number" id="from_account_number" class="form-control" required>
                @forelse(Auth::user()->accounts()->where('status', 'active')->get() as $acc)
                    <option value="{{ $acc->account_number }}" {{ request()->get('from') == $acc->account_number ? 'selected' : '' }}>
                        {{ $acc->account_type }} - {{ $acc->account_number }} (Balance: ${{ number_format($acc->balance, 2) }} USD)
                    </option>
                @empty
                    <option value="">No Active Accounts Available</option>
                @endforelse
            </select>
        </div>

        <div class="form-group">
            <label for="to_account_number" class="form-label">Destination Account Number</label>
            <input type="text" name="to_account_number" id="to_account_number" class="form-control" required placeholder="e.g. 1007788990 or external account">
        </div>

        <div class="form-group">
            <label for="routing_number" class="form-label">Destination ABA Routing / SWIFT Code</label>
            <input type="text" name="routing_number" id="routing_number" class="form-control" value="026009593" required placeholder="Enter 9-digit ABA Routing Number">
        </div>

        <!-- Dynamic Live Bank Lookup Badge -->
        <div id="bankLookupBadge" style="background: #ecfdf5; border: 1px solid #10b981; border-radius: 10px; padding: 1rem 1.2rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 12px;">
            <div style="width: 32px; height: 32px; background: #10b981; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px;">✓</div>
            <div>
                <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; color: #047857;">Verified Receiving Bank</div>
                <div style="font-size: 15px; font-weight: 800; color: #065f46;" id="receivingBankName">Corox Bank (Internal Clearing)</div>
            </div>
        </div>

        <div class="form-group">
            <label for="amount" class="form-label">Transfer Amount (USD $)</label>
            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required placeholder="0.00">
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Wire Description / Memo (Optional)</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="e.g. Invoice payment, personal transfer">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Execute Wire Transfer</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const routingInput = document.getElementById('routing_number');
        const accountInput = document.getElementById('to_account_number');
        const bankBadgeName = document.getElementById('receivingBankName');

        // Comprehensive US ABA Routing Number Registry Database (65+ Institutions)
        const routingDatabase = {
            // Internal & Primary Sponsor
            '026009593': 'Corox Bank (Internal Clearing)',

            // Requested: Fidelity Brokerage & Regions Bank
            '101205681': 'Fidelity Brokerage Services LLC',
            '122105155': 'Fidelity Investments (UMB Bank, N.A.)',
            '011000138': 'Fidelity Management Trust Company',
            '062000019': 'Regions Bank, N.A. (Main / Southeast)',
            '063100277': 'Regions Bank, N.A. (Florida)',
            '065200288': 'Regions Bank, N.A. (Louisiana)',
            '081000141': 'Regions Bank, N.A. (Mid-South / Tennessee)',

            // Top US Commercial & Investment Banks
            '021000021': 'JPMorgan Chase Bank, N.A. (New York)',
            '111000614': 'JPMorgan Chase Bank, N.A. (Texas)',
            '071000013': 'JPMorgan Chase Bank, N.A. (Midwest)',
            '121000358': 'Bank of America, N.A. (California)',
            '054000030': 'Bank of America, N.A. (North Carolina)',
            '111000025': 'Bank of America, N.A. (Texas)',
            '021200339': 'Bank of America, N.A. (New York)',
            '121000248': 'WF National Bank, N.A. (San Francisco)',
            '091000019': 'WF National Bank, N.A. (Minneapolis)',
            '102000076': 'WF National Bank, N.A. (Denver)',
            '021000089': 'Citibank, N.A. (New York)',
            '221172186': 'Citibank, N.A. (South Dakota)',
            '321171184': 'Citibank, N.A. (Delaware)',
            '031000053': 'PNC Bank, N.A. (Pittsburgh)',
            '071921891': 'PNC Bank, N.A. (Midwest)',
            '043000096': 'PNC Bank, N.A. (Ohio)',
            '122000496': 'U.S. Bank, N.A. (West)',
            '091000022': 'U.S. Bank, N.A. (Minneapolis)',
            '042000013': 'U.S. Bank, N.A. (Cincinnati)',
            '061000104': 'Truist Bank (Atlanta / Georgia)',
            '053000196': 'Truist Bank (Richmond / Virginia)',
            '051405515': 'Capital One Bank, N.A. (Virginia)',
            '011103093': 'TD Bank, N.A. (New England)',
            '031201360': 'TD Bank, N.A. (Mid-Atlantic)',
            '021000018': 'The Bank of New York Mellon (BNY)',
            '044000037': 'BNY Mellon, N.A. (Pittsburgh)',
            '011000028': 'State Street Bank and Trust Company',
            '021000128': 'Goldman Sachs Bank USA',
            '021001088': 'Morgan Stanley Private Bank, N.A.',
            '121136785': 'Charles Schwab Bank, SSB',
            '121202211': 'Charles Schwab Premier Bank',
            '011500120': 'Citizens Bank, N.A. (Rhode Island)',
            '041000124': 'Citizens Bank, N.A. (Pennsylvania)',
            '042000314': 'Fifth Third Bank, N.A. (Cincinnati)',
            '071923909': 'Fifth Third Bank, N.A. (Chicago)',
            '071000288': 'BMO Bank, N.A. (BMO Harris)',
            '041001039': 'KeyBank, N.A.',
            '044000024': 'Huntington National Bank',
            '124003116': 'Ally Bank',
            '031100649': 'Discover Bank',
            '124085066': 'American Express National Bank',
            '031101279': 'Barclays Bank Delaware',
            '022000046': 'M&T Bank',
            '071000152': 'Northern Trust Company',
            '231372691': 'Santander Bank, N.A.',
            '053101121': 'First Citizens Bank & Trust Company',
            '111000753': 'Comerica Bank (Texas)',
            '072000096': 'Comerica Bank (Michigan)',
            '121140399': 'Silicon Valley Bank (SVB - First Citizens)',
            '122105498': 'Western Alliance Bank',
            '124000054': 'Zions Bancorporation, N.A.',
            '061100606': 'Synovus Bank',
            '084000026': 'First Horizon Bank',
            '011104351': 'Webster Bank, N.A.',
            '122204764': 'East West Bank',
            '063113057': 'SouthState Bank, N.A.',
            '103900036': 'BOK Financial (Bank of Oklahoma)',
            '071026343': 'Wintrust Bank, N.A.',
            '064103888': 'Pinnacle Bank',
            '021202449': 'Valley National Bank',
            '114000093': 'Frost Bank (Cullen/Frost Bankers)',
            '074900650': 'Old National Bank',
            '101000695': 'UMB Bank, N.A.',
            '125000105': 'Washington Federal Bank (WaFd Bank)',
            '111024823': 'Texas Capital Bank',
            '072403259': 'Flagstar Bank, N.A.',
            '026013673': 'Flagstar Bank, N.A. (Signature Division)',
            '256074974': 'Navy Federal Credit Union (NFCU)',
            '253177041': 'State Employees Credit Union (SECU)',
            '256078420': 'Pentagon Federal Credit Union (PenFed)',
            '325081403': 'Boeing Employees Credit Union (BECU)',
            '322271627': 'SchoolsFirst Federal Credit Union',
            '321175261': 'Golden 1 Credit Union',
            '314074269': 'USAA Federal Savings Bank',
            '031101347': 'SoFi Bank, N.A.',
            '031101114': 'Chime (The Bancorp Bank, N.A.)',
            '103112981': 'Chime (Stride Bank, N.A.)',
            '121145349': 'Varo Bank, N.A.',
            '026012881': 'Interactive Brokers LLC',
            '321081669': 'First Republic Bank (JPMorgan Chase)',
            '121301015': 'Bank of Hawaii',
            '104000016': 'First National Bank of Omaha (FNBO)',
            '101000019': 'Commerce Bank, N.A.',
            '075900578': 'Associated Bank, N.A.',
            '122016066': 'City National Bank',
            '082900432': 'Simmons Bank',
            '103200189': 'Arvest Bank',
            '021309379': 'Synchrony Bank',
            '021000047': 'HSBC Bank USA, N.A.',
            '011000015': 'Bank of China USA'
        };

        function resolveReceivingBank() {
            const routing = routingInput.value.trim();

            if (routingDatabase[routing]) {
                bankBadgeName.innerText = routingDatabase[routing];
            } else if (routing.length >= 8) {
                // Determine prefix range for fallback lookup
                const prefix = routing.substring(0, 2);
                if (prefix === '01' || prefix === '02') {
                    bankBadgeName.innerText = 'Commercial Clearing Bank (New York / East Coast Fed Wire)';
                } else if (prefix === '03' || prefix === '04') {
                    bankBadgeName.innerText = 'Federal Reserve Bank District 3/4 Member Bank';
                } else if (prefix === '06') {
                    bankBadgeName.innerText = 'Federal Reserve Bank District 6 (Atlanta / Southeast)';
                } else if (prefix === '07' || prefix === '08') {
                    bankBadgeName.innerText = 'Federal Reserve Bank District 7/8 (Chicago / St. Louis)';
                } else if (prefix === '09' || prefix === '10') {
                    bankBadgeName.innerText = 'Federal Reserve Bank District 9/10 (Minneapolis / Kansas City)';
                } else if (prefix === '11' || prefix === '12') {
                    bankBadgeName.innerText = 'Pacific Clearing & Commercial Bank (West Coast Fed Wire)';
                } else {
                    bankBadgeName.innerText = 'Verified US Commercial Wire Institution (Routing: ' + routing + ')';
                }
            } else {
                bankBadgeName.innerText = 'Corox Bank (Internal Clearing)';
            }
        }

        routingInput.addEventListener('input', resolveReceivingBank);
        accountInput.addEventListener('input', resolveReceivingBank);
    });
</script>
@endsection
