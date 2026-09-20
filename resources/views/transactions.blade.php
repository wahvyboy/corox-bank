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
    <div style="background: #ecfdf5; border: 1.5px solid #10b981; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 38px; height: 38px; background: #10b981; color: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 800;">✓</div>
            <div>
                <div style="font-weight: 800; color: #065f46; font-size: 15px;">Transfer Completed Successfully!</div>
                <div style="font-size: 13px; color: #047857;">Your official Corox Bank transfer receipt has been generated with bank logo & security verification seal.</div>
            </div>
        </div>
        <a href="{{ route('transaction.receipt', session('receipt_id')) }}" class="btn btn-primary" style="white-space: nowrap; font-size: 14px; font-weight: 700; background: #047857; border: none; padding: 0.7rem 1.2rem; display: flex; align-items: center; gap: 8px;">
            📄 View & Print Official Receipt
        </a>
    </div>
@endif

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Type</th>
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
                            @if($tx->transaction_type === 'deposit')
                                <span class="badge badge-deposit">Deposit</span>
                            @elseif($tx->transaction_type === 'withdraw')
                                <span class="badge badge-withdraw">Withdrawal</span>
                            @else
                                <span class="badge badge-transfer">Wire Transfer</span>
                            @endif
                        </td>
                        <td><code>{{ $tx->routing_number ?? '026009593' }}</code></td>
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
                        <td colspan="8" style="text-align: center; color: var(--text-secondary); padding: 2rem;">No transaction history recorded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($transactions->hasPages())
        <div style="padding: 1.25rem 1.5rem; border-top: 1px solid #E5E7EB; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div style="font-size: 13px; color: var(--text-secondary); font-weight: 600;">
                Showing transactions {{ $transactions->firstItem() ?? 0 }}–{{ $transactions->lastItem() ?? 0 }} of {{ $transactions->total() }}
            </div>
            <div class="pagination-wrapper">
                {{ $transactions->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
