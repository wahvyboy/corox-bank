@extends('layouts.app')
@section('title', 'My Bank Accounts')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">My Bank Accounts</h2>
        <p style="color: var(--text-secondary);">Manage active multi-currency accounts, routing / clearing identifiers, and request new accounts.</p>
    </div>
    <a href="{{ route('create.bank.account') }}" class="btn btn-primary">Request New Bank Account</a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Account Type</th>
                    <th>Account Number</th>
                    <th>Routing / Clearing Code</th>
                    <th>Currency</th>
                    <th>Available Balance</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $account)
                    <tr>
                        <td><strong>{{ $account->account_type ?? 'Checking' }}</strong></td>
                        <td><code>{{ $account->account_number }}</code></td>
                        <td><code>{{ $account->routing_number ?? '071923456' }}</code></td>
                        <td>
                            <span class="badge" style="background: #EFF6FF; color: #1D4ED8; font-weight: 700; border: 1px solid #BFDBFE;">
                                {{ $account->currency ?? 'USD' }} ({{ $account->currency_symbol }})
                            </span>
                        </td>
                        <td style="font-weight: 700; color: var(--accent-gold-bright);">{{ $account->currency_symbol }}{{ number_format($account->balance, 2) }}</td>
                        <td>
                            @if($account->status === 'active')
                                <span class="badge badge-active">Active</span>
                            @elseif($account->status === 'pending')
                                <span class="badge badge-pending">Pending Approval</span>
                            @else
                                <span class="badge badge-blocked">Blocked</span>
                            @endif
                        </td>
                        <td>
                            @if($account->status === 'active')
                                <a href="{{ route('show.transfer.form') }}?from={{ $account->account_number }}" class="btn btn-secondary" style="padding: 0.3rem 0.8rem; font-size: 12px;">Transfer Funds</a>
                            @else
                                <span style="color: var(--text-muted); font-size: 12px;">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-secondary); padding: 2rem;">No accounts found. Click "Request New Bank Account" to open one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
