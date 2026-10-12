@extends('layouts.app')
@section('title', 'Send Wire / ACH / NPP Transfer')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Send Wire Transfer &amp; Real-Time Electronic Remittance</h2>
        <p style="color: var(--text-secondary);">Direct wire &amp; clearing across domestic (FedWire, ACH, NPP, Bacs, SEPA) and international SWIFT networks.</p>
    </div>
</div>

<div class="portal-form-card">
    <form action="{{ url('/user/transfer') }}" method="POST" id="transferForm">
        @csrf
        <div class="form-group">
            <label for="from_account_number" class="form-label">Source Account</label>
            <select name="from_account_number" id="from_account_number" class="form-control" required onchange="handleSourceAccountChange()">
                @forelse(Auth::user()->accounts()->where('status', 'active')->get() as $acc)
                    <option value="{{ $acc->account_number }}"
                            data-currency="{{ $acc->currency }}"
                            data-symbol="{{ $acc->currency_symbol }}"
                            data-routing="{{ $acc->routing_number }}"
                            {{ request()->get('from') == $acc->account_number ? 'selected' : '' }}>
                        {{ $acc->account_type }} - {{ $acc->account_number }} (Balance: {{ $acc->currency_symbol }}{{ number_format($acc->balance, 2) }} {{ $acc->currency }})
                    </option>
                @empty
                    <option value="">No Active Accounts Available</option>
                @endforelse
            </select>
        </div>

        <div class="form-group">
            <label for="to_account_number" class="form-label">Destination Account / IBAN Number</label>
            <input type="text" name="to_account_number" id="to_account_number" class="form-control" required placeholder="e.g. 1007788990 or beneficiary account / IBAN">
        </div>

        <div class="form-group">
            <label for="routing_number" class="form-label" id="routingLabel">Destination ABA Routing / SWIFT / BSB / Sort Code</label>
            <input type="text" name="routing_number" id="routing_number" class="form-control" value="071923456" required placeholder="Enter 9-digit ABA, SWIFT/BIC, 6-digit BSB or Sort Code">
        </div>

        <!-- Adaptive Quick Routing Chips based on Currency -->
        <div id="quickChipsContainer" style="margin-top: -0.5rem; margin-bottom: 1.25rem; display: flex; flex-wrap: wrap; gap: 6px; align-items: center;">
            <span style="font-size: 11px; font-weight: 700; color: #6B7280; text-transform: uppercase;">Quick Bank Select:</span>
            <div id="quickChipsList" style="display: flex; flex-wrap: wrap; gap: 6px;"></div>
        </div>

        <!-- Dynamic Live Bank Lookup Badge (Instant Directory Resolution) -->
        <div id="bankLookupBadge" style="background: #ecfdf5; border: 1px solid #10b981; border-radius: 10px; padding: 1rem 1.2rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 12px; transition: all 0.2s ease;">
            <div id="bankBadgeIcon" style="width: 36px; height: 36px; background: #10b981; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px;">✓</div>
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                    <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; color: #047857;">Verified Receiving Bank</span>
                    <span id="bankCountryBadge" style="font-size: 11px; font-weight: 700; background: #d1fae5; color: #065f46; padding: 1px 8px; border-radius: 9999px;">US</span>
                </div>
                <div style="font-size: 15px; font-weight: 800; color: #065f46;" id="receivingBankName">Corox Bank (Internal Clearing)</div>
                <div style="font-size: 12px; color: #047857; margin-top: 2px;" id="receivingNetwork">Direct FedWire &amp; ACH Electronic Rail</div>
            </div>
        </div>

        <div class="form-group">
            <label for="amount" class="form-label">
                Transfer Amount (<span id="currSymbol">$</span> <span id="currCode">USD</span>)
            </label>
            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required placeholder="0.00">
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Wire Remittance Memo / Description (Optional)</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="e.g. Invoice settlement, commercial trade remittance">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Execute Wire Transfer</button>
    </form>
</div>

<script src="{{ asset('js/bank-directory.js') }}"></script>
<script>
    const PRESETS_BY_CURRENCY = {
        'AUD': [
            { code: '082001', name: 'Corox Bank / NAB (082-001)' },
            { code: '062000', name: 'Commonwealth Bank (062-000)' },
            { code: '032001', name: 'Westpac (032-001)' },
            { code: '012002', name: 'ANZ (012-002)' },
            { code: '182512', name: 'Macquarie Bank (182-512)' }
        ],
        'USD': [
            { code: '071923456', name: 'Corox Bank (071923456)' },
            { code: '026009593', name: 'Bank of America (026009593)' },
            { code: '021000021', name: 'Chase (021000021)' },
            { code: '121000248', name: 'Wells Fargo (121000248)' },
            { code: '101205681', name: 'Fidelity (101205681)' },
            { code: '062000019', name: 'Regions (062000019)' }
        ],
        'GBP': [
            { code: '200000', name: 'Barclays (20-00-00)' },
            { code: '400000', name: 'HSBC UK (40-00-00)' },
            { code: '300000', name: 'Lloyds Bank (30-00-00)' },
            { code: '600001', name: 'NatWest (60-00-01)' },
            { code: '040075', name: 'Revolut UK (04-00-75)' }
        ],
        'EUR': [
            { code: 'DEUTDEDD', name: 'Deutsche Bank (DEUTDEDD)' },
            { code: 'BNPAFRPP', name: 'BNP Paribas (BNPAFRPP)' },
            { code: 'BSCHESMM', name: 'Santander (BSCHESMM)' },
            { code: 'INGBNL2A', name: 'ING Bank (INGBNL2A)' }
        ],
        'CNY': [
            { code: 'BKCHCNBJ', name: 'Bank of China (BKCHCNBJ)' },
            { code: 'ICBCCNBS', name: 'ICBC (ICBCCNBS)' },
            { code: 'PCBCCNBJ', name: 'China Construction Bank' }
        ],
        'CAD': [
            { code: 'ROYCCAT2', name: 'RBC Royal Bank (ROYCCAT2)' },
            { code: 'TDOMCATTTOR', name: 'TD Canada Trust (TDOMCATTTOR)' },
            { code: 'BNSCCATT', name: 'Scotiabank (BNSCCATT)' }
        ],
        'JPY': [
            { code: 'BOTKJPJT', name: 'MUFG Bank (BOTKJPJT)' },
            { code: 'SMBCJPJT', name: 'SMBC (SMBCJPJT)' }
        ],
        'CHF': [
            { code: 'UBSWCHZH', name: 'UBS Switzerland (UBSWCHZH)' },
            { code: 'PICTCHGG', name: 'Pictet & Cie (PICTCHGG)' }
        ]
    };

    function renderPresets(currency) {
        const list = document.getElementById('quickChipsList');
        if (!list) return;
        list.innerHTML = '';
        const presets = PRESETS_BY_CURRENCY[currency] || PRESETS_BY_CURRENCY['USD'];
        presets.forEach(p => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-routing-chip';
            btn.style.cssText = 'background: #F3F4F6; border: 1px solid #D1D5DB; border-radius: 9999px; padding: 3px 10px; font-size: 11.5px; font-weight: 700; color: #1F2937; cursor: pointer;';
            btn.innerText = p.name;
            btn.onclick = function() {
                setRoutingPreset(p.code);
            };
            list.appendChild(btn);
        });
    }

    function handleSourceAccountChange() {
        const select = document.getElementById('from_account_number');
        if (!select || !select.selectedOptions || select.selectedOptions.length === 0) return;
        const opt = select.selectedOptions[0];
        const currency = opt.getAttribute('data-currency') || 'USD';
        const symbol = opt.getAttribute('data-symbol') || '$';
        const routing = opt.getAttribute('data-routing');

        document.getElementById('currCode').innerText = currency;
        document.getElementById('currSymbol').innerText = symbol;

        const routingLabel = document.getElementById('routingLabel');
        if (routingLabel) {
            if (currency === 'AUD') {
                routingLabel.innerText = 'Destination Australian BSB (6 Digits) or SWIFT/BIC';
            } else if (currency === 'GBP') {
                routingLabel.innerText = 'Destination UK Sort Code (6 Digits) or SWIFT/BIC';
            } else if (currency === 'EUR') {
                routingLabel.innerText = 'Destination BIC / SWIFT Code or SEPA Clearing Code';
            } else {
                routingLabel.innerText = 'Destination ABA Routing / SWIFT Code';
            }
        }

        renderPresets(currency);

        const routingInput = document.getElementById('routing_number');
        if (routing) {
            routingInput.value = routing;
        }
        resolveReceivingBank();
    }

    function resolveReceivingBank() {
        const routingInput = document.getElementById('routing_number');
        const bankBadgeName = document.getElementById('receivingBankName');
        const bankCountryBadge = document.getElementById('bankCountryBadge');
        const receivingNetwork = document.getElementById('receivingNetwork');
        if (!routingInput || !bankBadgeName) return;

        const code = routingInput.value.trim();

        if (typeof window.resolveBankDirectory === 'function') {
            const result = window.resolveBankDirectory(code);
            bankBadgeName.innerText = result.name;
            if (bankCountryBadge) bankCountryBadge.innerText = result.country;
            if (receivingNetwork) receivingNetwork.innerText = result.network || 'Electronic Clearing Rail';
        } else {
            bankBadgeName.innerText = code.length >= 6 ? 'Commercial Bank (Code: ' + code + ')' : 'Corox Bank (Internal Clearing)';
        }
    }

    window.setRoutingPreset = function(code) {
        const routingInput = document.getElementById('routing_number');
        if (routingInput) {
            routingInput.value = code;
            resolveReceivingBank();
            routingInput.focus();
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const routingInput = document.getElementById('routing_number');
        if (routingInput) {
            routingInput.addEventListener('input', resolveReceivingBank);
            routingInput.addEventListener('change', resolveReceivingBank);
        }
        handleSourceAccountChange();
    });
</script>
@endsection
