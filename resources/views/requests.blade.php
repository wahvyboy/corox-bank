@extends('layouts.app')
@section('title', 'Pending Account Requests')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Pending Account Creation Requests</h2>
        <p style="color: var(--text-secondary);">Review client applications, assign or adjust account currencies, and issue official approvals.</p>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>User / Client</th>
                    <th>Account Type</th>
                    <th>Generated Account #</th>
                    <th>Routing / Clearing</th>
                    <th>Currency</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th style="min-width: 260px;">Admin Currency &amp; Approval</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $account)
                    <tr>
                        <td><strong>{{ $account->user ? ($account->user->full_name ?? $account->user->name) : 'Unknown' }}</strong><br><span style="font-size: 11px; color: var(--text-secondary);">@ {{ $account->user ? $account->user->name : '' }}</span></td>
                        <td>{{ $account->account_type ?? 'Checking' }}</td>
                        <td><code>{{ $account->account_number }}</code></td>
                        <td><code>{{ $account->routing_number ?? '071923456' }}</code></td>
                        <td>
                            <span class="badge" style="background: #EFF6FF; color: #1D4ED8; font-weight: 700; border: 1px solid #BFDBFE;">
                                {{ $account->currency ?? 'USD' }} ({{ $account->currency_symbol }})
                            </span>
                        </td>
                        <td>
                            @if($account->status === 'active')
                                <span class="badge badge-active">Active</span>
                            @elseif($account->status === 'pending')
                                <span class="badge badge-pending">Pending Approval</span>
                            @else
                                <span class="badge badge-blocked">Blocked</span>
                            @endif
                        </td>
                        <td style="font-size: 13px; color: var(--text-secondary);">{{ $account->created_at->format('M d, Y h:i A') }}</td>
                        <td>
                            @if($account->status === 'pending')
                                <form action="{{ route('account.approve', $account->id) }}" method="POST" style="display: flex; align-items: center; gap: 4px; flex-wrap: wrap;">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Choose / Override Currency Before Approval -->
                                    <select name="currency" class="form-control" style="width: 100px; font-size: 11.5px; padding: 4px 6px; height: 32px; font-weight: 700;" title="Select Account Currency">
                                        @foreach(\App\Services\CurrencyService::all() as $code => $cData)
                                            <option value="{{ $code }}" {{ ($account->currency ?? 'USD') === $code ? 'selected' : '' }}>
                                                {{ $code }} ({{ $cData['symbol'] }})
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" name="action" value="Approve">
                                    <button type="submit" class="btn btn-primary" style="padding: 0.35rem 0.75rem; font-size: 11.5px; font-weight: 700; height: 32px;">
                                        ✓ Approve
                                    </button>

                                    <button type="submit" name="action" value="Reject" class="btn btn-secondary" style="padding: 0.35rem 0.6rem; font-size: 11.5px; color: var(--danger); height: 32px;" onclick="return confirm('Reject this account request?');">
                                        Reject
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('account.approve', $account->id) }}" method="POST" style="display: flex; align-items: center; gap: 4px;">
                                    @csrf
                                    @method('PUT')
                                    <select name="currency" class="form-control" style="width: 95px; font-size: 11.5px; padding: 2px 6px; height: 28px;" title="Switch Account Currency">
                                        @foreach(\App\Services\CurrencyService::all() as $code => $cData)
                                            <option value="{{ $code }}" {{ ($account->currency ?? 'USD') === $code ? 'selected' : '' }}>
                                                {{ $code }} ({{ $cData['symbol'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="action" value="UpdateCurrency">
                                    <button type="submit" class="btn btn-secondary btn-sm" style="font-size: 11px; padding: 3px 8px;">Update</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-secondary); padding: 2rem;">No pending account requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
