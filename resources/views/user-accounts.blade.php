@extends('layouts.app')
@section('title', 'Client Accounts')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">USD Accounts for {{ $user->name }}</h2>
        <p style="color: var(--text-secondary);">User ID: #{{ $user->id }} • Status: {{ strtoupper($user->status) }}</p>
    </div>
    <a href="{{ route('show.admin.create.account.form') }}" class="btn btn-primary">Create Account for {{ $user->name }}</a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Account Type</th>
                    <th>Account Number</th>
                    <th>Routing Number</th>
                    <th>Balance (USD)</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $account)
                    <tr>
                        <td><strong>{{ $account->account_type ?? 'Checking' }}</strong></td>
                        <td><code>{{ $account->account_number }}</code></td>
                        <td><code>{{ $account->routing_number ?? '026009593' }}</code></td>
                        <td style="font-weight: 700; color: var(--accent-gold-bright);">${{ number_format($account->balance, 2) }}</td>
                        <td>
                            @if($account->status === 'active')
                                <span class="badge badge-active">Active</span>
                            @elseif($account->status === 'pending')
                                <span class="badge badge-pending">Pending Approval</span>
                            @else
                                <span class="badge badge-blocked">Blocked</span>
                            @endif
                        </td>
                        <td style="font-size: 13px; color: var(--text-secondary);">{{ $account->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($account->status === 'active')
                                <form action="{{ route('account.approve', $account->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="Block">
                                    <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.8rem; font-size: 12px; color: var(--danger);">Block Account</button>
                                </form>
                            @else
                                <form action="{{ route('account.approve', $account->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="Approve">
                                    <button type="submit" class="btn btn-primary" style="padding: 0.3rem 0.8rem; font-size: 12px;">Approve Account</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-secondary); padding: 2rem;">No accounts found for this user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
