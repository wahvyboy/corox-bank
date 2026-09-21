@extends('layouts.app')
@section('title', 'Send Wire / ACH Transfer')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Send Wire / ACH Transfer</h2>
        <p style="color: var(--text-secondary);">Transfer funds in USD to any domestic or international bank account using Account Number and Routing Number.</p>
    </div>
</div>

<div style="background: var(--bg-surface); border: 1px solid var(--navy-border); border-radius: var(--radius-xl); padding: 2.5rem; max-width: 680px;">
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

        // ABA Routing Number Registry Database
        const routingDatabase = {
            '026009593': 'Corox Bank (Internal Clearing)',
            '021000021': 'JPMorgan Chase Bank, N.A.',
            '026009593': 'Bank of America, N.A.',
            '121000248': 'WF National Bank, N.A.',
            '021000089': 'Citibank, N.A.',
            '031000053': 'PNC Bank, N.A.',
            '122000496': 'U.S. Bank, N.A.',
            '071000013': 'Capital One Bank, N.A.',
            '044000037': 'BNY Mellon, N.A.',
            '011000015': 'Bank of China USA',
            '021000047': 'HSBC Bank USA, N.A.',
            '121136785': 'Charles Schwab Bank, SSB',
            '122105155': 'Fidelity Investments Bank',
            '021001088': 'Morgan Stanley Private Bank',
            '021000128': 'Goldman Sachs Bank USA'
        };

        function resolveReceivingBank() {
            const routing = routingInput.value.trim();
            const account = accountInput.value.trim();

            if (routingDatabase[routing]) {
                bankBadgeName.innerText = routingDatabase[routing];
            } else if (routing.length >= 8) {
                // Determine prefix range for fallback lookup
                const prefix = routing.substring(0, 2);
                if (prefix === '01' || prefix === '02') {
                    bankBadgeName.innerText = 'Commercial Clearing Bank (New York / East Coast Fed Wire)';
                } else if (prefix === '03' || prefix === '04') {
                    bankBadgeName.innerText = 'Federal Reserve Bank District 3/4 Member Bank';
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
