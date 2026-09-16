@extends('layouts.app')
@section('title', 'Admin Create Account')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Create Account for Client</h2>
        <p style="color: var(--text-secondary);">Directly create an active USD Checking or Savings account for a registered client.</p>
    </div>
</div>

<div style="background: var(--bg-surface); border: 1px solid var(--navy-border); border-radius: var(--radius-xl); padding: 2.5rem; max-width: 600px;">
    <form action="{{ url('/admin/create-bank-account') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Target Client Username</label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="e.g. client or john_doe">
        </div>

        <div class="form-group">
            <label for="account_type" class="form-label">Account Type</label>
            <select name="account_type" id="account_type" class="form-control" required>
                <option value="Checking">Corox Commercial Checking (USD)</option>
                <option value="Savings">Corox High-Yield Savings (USD)</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">ABA Routing Number</label>
            <input type="text" class="form-control" value="026009593 (Corox Bank)" readonly>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Create Active USD Account</button>
    </form>
</div>
@endsection
