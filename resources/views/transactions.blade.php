@extends('layouts.app')
@section('title', 'Transaction History')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">USD Transaction History</h2>
        <p style="color: var(--text-secondary);">Comprehensive ledger of all deposits, withdrawals, and wire transfers.</p>
    </div>
</div>

@if(session('receipt_id'))
    <div class="tx-success-banner">
        <div class="tx-success-left">
            <div class="tx-success-icon">✓</div>
            <div>
                <div class="tx-success-title">Transfer Completed Successfully!</div>
                <div class="tx-success-sub">Your official Corox Bank transfer receipt has been generated with bank logo &amp; security verification seal.</div>
            </div>
        </div>
        <a href="{{ route('transaction.receipt', session('receipt_id')) }}" class="tx-success-btn">
            📄 View &amp; Print Official Receipt
        </a>
    </div>
@endif

<div class="table-card">
    <!-- Desktop Ledger Table (>= 768px) -->
    <div class="table-responsive tx-desktop-table">
        <table>
            <thead>
                <tr>
                    <th>Date &amp; Time</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Routing Number</th>
                    <th>Description / Memo</th>
                    <th>From Account</th>
                    <th>To Account</th>
                    <th>Amount (USD)</th>
                    <th style="text-align: center;">Receipt</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $tx)
                    <tr>
                        <td style="color: var(--text-secondary); font-size: 13px;">{{ $tx->created_at->format('M d, Y h:i A') }}</td>
                        <td>
                            @if($tx->deposit_method === 'check')
                                <span class="badge badge-deposit" style="background: #EEF2FF; color: #4338CA; border: 1px solid #C7D2FE;">📸 Check Deposit</span>
                            @elseif($tx->transaction_type === 'deposit')
                                <span class="badge badge-deposit">Deposit</span>
                            @elseif($tx->transaction_type === 'withdraw')
                                <span class="badge badge-withdraw">Withdrawal</span>
                            @else
                                <span class="badge badge-transfer">Wire Transfer</span>
                            @endif
                        </td>
                        <td>
                            @if($tx->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                                <div style="font-size: 11px; color: #92400E; font-weight: 600; margin-top: 2px;">Clears Tomorrow</div>
                            @elseif($tx->status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @else
                                <span class="badge badge-active">Completed</span>
                            @endif
                        </td>
                        <td><code>{{ $tx->routing_number ?? '071923456' }}</code></td>
                        <td>{{ $tx->description ?? 'N/A' }}</td>
                        <td>{{ $tx->fromAccount ? $tx->fromAccount->account_number : '—' }}</td>
                        <td>{{ $tx->toAccount ? $tx->toAccount->account_number : '—' }}</td>
                        <td style="font-weight: 700; color: {{ $tx->transaction_type === 'deposit' ? 'var(--success)' : ($tx->transaction_type === 'withdraw' ? 'var(--danger)' : 'var(--text-primary)') }};">
                            {{ $tx->transaction_type === 'deposit' ? '+' : ($tx->transaction_type === 'withdraw' ? '-' : '') }}${{ number_format($tx->amount, 2) }}
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('transaction.receipt', $tx->id) }}" class="btn btn-sm btn-secondary" style="font-size: 12px; padding: 4px 10px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                🧾 Receipt
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; color: var(--text-secondary); padding: 2rem;">No transaction history recorded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Transaction Feed (< 768px) -->
    <div class="tx-mobile-feed">
        @forelse($transactions as $tx)
            <div class="tx-mobile-card tx-type-{{ $tx->transaction_type }}" style="{{ $tx->status === 'pending' ? 'border-left-color: #D97706;' : '' }}">
                <div class="tx-mobile-header">
                    <div style="display: flex; gap: 6px; align-items: center; flex-wrap: wrap;">
                        @if($tx->deposit_method === 'check')
                            <span class="badge badge-deposit" style="background: #EEF2FF; color: #4338CA; border: 1px solid #C7D2FE;">📸 Check</span>
                        @elseif($tx->transaction_type === 'deposit')
                            <span class="badge badge-deposit">Deposit</span>
                        @elseif($tx->transaction_type === 'withdraw')
                            <span class="badge badge-withdraw">Withdrawal</span>
                        @else
                            <span class="badge badge-transfer">Wire</span>
                        @endif

                        @if($tx->status === 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($tx->status === 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            <span class="badge badge-active">Completed</span>
                        @endif
                    </div>
                    <div class="tx-mobile-date">{{ $tx->created_at->format('M d, Y • h:i A') }}</div>
                </div>

                <div class="tx-mobile-main">
                    <div class="tx-mobile-desc">{{ $tx->description ?? 'FedWire Settlement' }}</div>
                    <div class="tx-mobile-amount amount-{{ $tx->transaction_type }}" style="{{ $tx->status === 'pending' ? 'color: #D97706;' : '' }}">
                        {{ $tx->transaction_type === 'deposit' ? '+' : ($tx->transaction_type === 'withdraw' ? '-' : '') }}${{ number_format($tx->amount, 2) }}
                    </div>
                </div>

                <div class="tx-mobile-details">
                    @if($tx->status === 'pending')
                        <div class="tx-mobile-detail-row" style="background: #FEF3C7; padding: 4px 8px; border-radius: 4px; border: 1px solid #FDE68A;">
                            <span style="color: #92400E; font-weight: 700;">Settlement:</span>
                            <span style="color: #92400E; font-weight: 700;">Clears Tomorrow (Pending Admin Settlement)</span>
                        </div>
                    @endif
                    <div class="tx-mobile-detail-row">
                        <span>Routing ABA:</span>
                        <code>{{ $tx->routing_number ?? '071923456' }}</code>
                    </div>
                    @if($tx->fromAccount || $tx->toAccount)
                        <div class="tx-mobile-detail-row">
                            <span>Account Flow:</span>
                            <span>{{ $tx->fromAccount ? '...' . substr($tx->fromAccount->account_number, -4) : 'Source' }} &rarr; {{ $tx->toAccount ? '...' . substr($tx->toAccount->account_number, -4) : 'Beneficiary' }}</span>
                        </div>
                    @endif
                </div>

                <div class="tx-mobile-actions">
                    <a href="{{ route('transaction.receipt', $tx->id) }}" class="btn btn-sm btn-secondary" style="font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; gap: 4px;">
                        🧾 View Official Receipt
                    </a>
                </div>
            </div>
        @empty
            <div style="text-align: center; color: var(--text-secondary); padding: 2rem; font-size: 13.5px;">No transaction history recorded yet.</div>
        @endforelse
    </div>

    @if($transactions->hasPages())
        <div class="tx-pagination-wrapper">
            <div style="font-size: 13px; color: var(--text-secondary); font-weight: 600;">
                Showing transactions {{ $transactions->firstItem() ?? 0 }}–{{ $transactions->lastItem() ?? 0 }} of {{ $transactions->total() }}
            </div>
            <div class="pagination-wrapper">
                {{ $transactions->links('partials.pagination') }}
            </div>
        </div>
    @endif
</div>
@endsection
