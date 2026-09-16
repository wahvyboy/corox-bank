@extends('layouts.app')
@section('title', 'Official Transfer Receipt - Corox Bank')
@section('content')

<style>
    .receipt-wrapper {
        max-width: 720px;
        margin: 0 auto;
        padding: 2.5rem;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        color: #1e293b;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        position: relative;
        overflow: hidden;
    }

    .receipt-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f1f5f9;
        margin-bottom: 2rem;
    }

    .receipt-brand {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .receipt-logo {
        height: 52px;
        width: auto;
        object-fit: contain;
    }

    .receipt-bank-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .receipt-bank-sub {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .receipt-status-badge {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        padding: 6px 14px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .receipt-amount-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #ffffff;
        border-radius: 14px;
        padding: 2rem;
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
    }

    .receipt-amount-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #94a3b8;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .receipt-amount-value {
        font-size: 2.8rem;
        font-weight: 900;
        color: #10b981;
        letter-spacing: -1px;
    }

    .receipt-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .receipt-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.25rem;
        border: 1px solid #f1f5f9;
    }

    .receipt-section-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .receipt-detail-row {
        margin-bottom: 0.85rem;
    }

    .receipt-detail-row:last-child {
        margin-bottom: 0;
    }

    .receipt-label {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 2px;
    }

    .receipt-value {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
    }

    .receipt-footer {
        border-top: 1px dashed #cbd5e1;
        padding-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        color: #64748b;
    }

    .receipt-seal {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #047857;
        font-weight: 700;
        font-size: 12px;
    }

    .action-buttons {
        max-width: 720px;
        margin: 1.5rem auto 0 auto;
        display: flex;
        gap: 1rem;
        justify-content: space-between;
    }

    /* Print Styles */
    @media print {
        body * {
            visibility: hidden;
        }
        .receipt-wrapper, .receipt-wrapper * {
            visibility: visible;
        }
        .receipt-wrapper {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            max-width: 100%;
            box-shadow: none;
            border: none;
        }
        .action-buttons, .navbar, .sidebar, header, footer {
            display: none !important;
        }
    }
</style>

<div class="action-buttons">
    <a href="{{ url('/user/show-transaction-history') }}" class="btn btn-secondary">
        ← Back to Transaction History
    </a>
    <button onclick="window.print()" class="btn btn-primary" style="display: flex; align-items: center; gap: 8px;">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
        Print / Save Official Receipt
    </button>
</div>

<div class="receipt-wrapper" style="margin-top: 1.5rem;">
    <!-- Header -->
    <div class="receipt-header">
        <div class="receipt-brand">
            <img src="{{ asset('images/corox_logo_transparent.png') }}" alt="Corox Bank Logo" class="receipt-logo" onerror="this.src='{{ asset('images/corox_logo.png') }}'">
            <div>
                <div class="receipt-bank-name">Corox Bank</div>
                <div class="receipt-bank-sub">Federal Reserve Wire Clearing System</div>
            </div>
        </div>
        <div class="receipt-status-badge">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            SETTLED & COMPLETED
        </div>
    </div>

    <!-- Amount Card -->
    <div class="receipt-amount-card">
        <div class="receipt-amount-label">Official Wire Transfer Amount</div>
        <div class="receipt-amount-value">${{ number_format($transaction->amount, 2) }} USD</div>
        <div style="font-size: 13px; color: #cbd5e1; margin-top: 6px;">Reference ID: <strong>STB-TXN-{{ str_pad($transaction->id, 8, '0', STR_PAD_LEFT) }}</strong></div>
    </div>

    <!-- Grid -->
    <div class="receipt-grid">
        <!-- Sender Box -->
        <div class="receipt-section">
            <div class="receipt-section-title">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                Originator (Sender)
            </div>
            <div class="receipt-detail-row">
                <div class="receipt-label">Account Holder</div>
                <div class="receipt-value">{{ $transaction->user ? $transaction->user->name : ($transaction->fromAccount && $transaction->fromAccount->user ? $transaction->fromAccount->user->name : 'Corox Bank Client') }}</div>
            </div>
            <div class="receipt-detail-row">
                <div class="receipt-label">Source Account Number</div>
                <div class="receipt-value"><code>{{ $transaction->fromAccount ? $transaction->fromAccount->account_number : 'Internal Ledger' }}</code></div>
            </div>
            <div class="receipt-detail-row">
                <div class="receipt-label">Originating Bank</div>
                <div class="receipt-value">Corox Bank (Routing: 026009593)</div>
            </div>
        </div>

        <!-- Recipient Box -->
        <div class="receipt-section">
            <div class="receipt-section-title">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                Beneficiary (Recipient)
            </div>
            <div class="receipt-detail-row">
                <div class="receipt-label">Beneficiary Account / Name</div>
                <div class="receipt-value">
                    @if($transaction->toAccount && $transaction->toAccount->user)
                        {{ $transaction->toAccount->user->name }}
                    @else
                        External Beneficiary Account
                    @endif
                </div>
            </div>
            <div class="receipt-detail-row">
                <div class="receipt-label">Destination Account Number</div>
                <div class="receipt-value">
                    <code>
                        @if($transaction->toAccount)
                            {{ $transaction->toAccount->account_number }}
                        @else
                            {{ Str::between($transaction->description, 'Account: ', ' (') ?: 'Wire Destination' }}
                        @endif
                    </code>
                </div>
            </div>
            <div class="receipt-detail-row">
                <div class="receipt-label">ABA Routing / SWIFT Code</div>
                <div class="receipt-value"><code>{{ $transaction->routing_number ?? '026009593' }}</code></div>
            </div>
        </div>
    </div>

    <!-- Additional Details -->
    <div class="receipt-section" style="margin-bottom: 2rem;">
        <div class="receipt-section-title">Transaction Audit & Remittance Info</div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="receipt-detail-row">
                <div class="receipt-label">Execution Date & Time</div>
                <div class="receipt-value">{{ $transaction->created_at->format('F d, Y - h:i:s A') }} EST</div>
            </div>
            <div class="receipt-detail-row">
                <div class="receipt-label">Transaction Type</div>
                <div class="receipt-value" style="text-transform: capitalize;">{{ $transaction->transaction_type }} (Electronic Settlement)</div>
            </div>
            <div class="receipt-detail-row" style="grid-column: span 2;">
                <div class="receipt-label">Wire Remittance Memo / Description</div>
                <div class="receipt-value" style="font-weight: 500; color: #334155;">{{ $transaction->description ?? 'No memo provided.' }}</div>
            </div>
        </div>
    </div>

    <!-- Footer Seal -->
    <div class="receipt-footer">
        <div class="receipt-seal">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            <div>
                <div>VERIFIED DIGITAL TRANSACTION RECORD</div>
                <div style="font-weight: 500; font-size: 11px; color: #64748b;">Issued by Corox Bank • Federal Reserve System</div>
            </div>
        </div>
        <div style="text-align: right;">
            <div>Page 1 of 1</div>
            <div style="font-size: 11px; color: #94a3b8;">Confidential Banking Notice</div>
        </div>
    </div>
</div>

@endsection
