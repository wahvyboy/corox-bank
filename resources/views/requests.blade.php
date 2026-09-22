@extends('layouts.app')
@section('title', 'Pending Account Requests')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Pending Account Creation Requests</h2>
        <p style="color: var(--text-secondary);">Review client applications for USD Checking and Savings accounts.</p>
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
                    <th>Routing Number</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Admin Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $account)
                    <tr>
                        <td><strong>{{ $account->user ? $account->user->name : 'Unknown' }}</strong></td>
                        <td>{{ $account->account_type ?? 'Checking' }}</td>
                        <td><code>{{ $account->account_number }}</code></td>
                        <td><code>{{ $account->routing_number ?? '071923456' }}</code></td>
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
                                <form action="{{ route('account.approve', $account->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="Approve">
                                    <button type="submit" class="btn btn-primary" style="padding: 0.3rem 0.8rem; font-size: 12px;">Approve Account</button>
                                </form>
                                <form action="{{ route('account.approve', $account->id) }}" method="POST" style="display:inline-block; margin-left: 4px;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="Reject">
                                    <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.8rem; font-size: 12px; color: var(--danger);">Reject</button>
                                </form>
                            @else
                                <span style="color: var(--text-muted); font-size: 12px;">Action Completed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-secondary); padding: 2rem;">No pending account requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
