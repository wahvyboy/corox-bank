@extends('layouts.app')
@section('title', 'Request Bank Account')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Request USD Bank Account</h2>
        <p style="color: var(--text-secondary);">Submit a request for an additional Corox Bank Checking or Savings account.</p>
    </div>
</div>

<div class="portal-form-card">
    <form action="{{ url('/user/create-bank-account') }}" method="POST">
        @csrf
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

        <div class="form-group">
            <label class="form-label">Currency</label>
            <input type="text" class="form-control" value="USD ($) - United States Dollar" readonly>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Account Request</button>
    </form>
</div>
@endsection
