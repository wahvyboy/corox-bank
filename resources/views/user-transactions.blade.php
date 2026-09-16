@extends('layouts.app')
@section('title', 'Client Transactions')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Transaction History for {{ $user->name }}</h2>
        <p style="color: var(--text-secondary);">User ID: #{{ $user->id }}</p>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Type</th>
                    <th>Routing Number</th>
                    <th>Description</th>
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
                            ${{ number_format($tx->amount, 2) }}
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('transaction.receipt', $tx->id) }}" class="btn btn-sm btn-secondary" style="font-size: 12px; padding: 4px 10px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                🧾 Receipt
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-secondary); padding: 2rem;">No transaction history for this user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
