@extends('layouts.app')
@section('title', 'Admin Withdraw Override')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Admin Withdrawal Override (USD)</h2>
        <p style="color: var(--text-secondary);">Directly debit funds from any target Corox Bank USD account.</p>
    </div>
</div>

<div style="background: var(--bg-surface); border: 1px solid var(--navy-border); border-radius: var(--radius-xl); padding: 2.5rem; max-width: 600px;">
    <form action="{{ url('/admin/withdraw') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="account_number" class="form-label">Target Account Number</label>
            <input type="text" name="account_number" id="account_number" class="form-control" required placeholder="e.g. 1002847591">
        </div>

        <div class="form-group">
            <label for="amount" class="form-label">Withdrawal Amount (USD $)</label>
            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required placeholder="0.00">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Execute Admin Withdrawal</button>
    </form>
</div>
@endsection
