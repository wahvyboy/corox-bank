@extends('layouts.app')
@section('title', 'Admin Create Account')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Create Account for Client</h2>
        <p style="color: var(--text-secondary);">Directly create an active multi-currency Checking, Savings, or Investment account for a registered client.</p>
    </div>
</div>

<div class="portal-form-card">
    <form action="{{ url('/admin/create-bank-account') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Target Client Username</label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="e.g. client, kylie, or john_doe">
        </div>

        <div class="form-group">
            <label for="currency" class="form-label">Account Currency</label>
            <select name="currency" id="currency" class="form-control" required>
                @foreach(\App\Services\CurrencyService::all() as $code => $cData)
                    <option value="{{ $code }}" {{ $code === 'USD' ? 'selected' : '' }}>
                        {{ $code }} ({{ $cData['symbol'] }}) — {{ $cData['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="account_type" class="form-label">Account Type</label>
            <select name="account_type" id="account_type" class="form-control" required>
                <option value="Checking">Corox Commercial Checking</option>
                <option value="Savings">Corox High-Yield Savings</option>
                <option value="Investment">Corox Private Wealth &amp; Investment Portfolio</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Create Active Bank Account</button>
    </form>
</div>
@endsection
