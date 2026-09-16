@extends('layouts.app')
@section('title', 'User Directory')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Registered User Directory</h2>
        <p style="color: var(--text-secondary);">Manage all registered clients and administrative personnel.</p>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Accounts Count</th>
                    <th>Registered At</th>
                    <th>Admin Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>#{{ $u->id }}</td>
                        <td><strong>{{ $u->name }}</strong></td>
                        <td>
                            <span class="badge {{ $u->role === 'admin' ? 'badge-transfer' : 'badge-active' }}">
                                {{ strtoupper($u->role) }}
                            </span>
                        </td>
                        <td>
                            @if($u->status === 'active')
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-blocked">Blocked</span>
                            @endif
                        </td>
                        <td>{{ $u->accounts()->count() }} Accounts</td>
                        <td style="font-size: 13px; color: var(--text-secondary);">{{ $u->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('show.user.accounts', $u->id) }}" class="btn btn-secondary" style="padding: 0.3rem 0.8rem; font-size: 12px;">View Accounts</a>
                            @if($u->role !== 'admin')
                                @if($u->status === 'active')
                                    <form action="{{ route('user.block', $u->id) }}" method="POST" style="display:inline-block; margin-left: 4px;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.8rem; font-size: 12px; color: var(--danger);">Block User</button>
                                    </form>
                                @else
                                    <form action="{{ route('user.unblock', $u->id) }}" method="POST" style="display:inline-block; margin-left: 4px;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary" style="padding: 0.3rem 0.8rem; font-size: 12px;">Unblock</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
