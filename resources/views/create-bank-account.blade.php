@extends('layouts.app')
@section('title', 'Request Bank Account')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Request New Bank Account</h2>
        <p style="color: var(--text-secondary);">Submit an application for a multi-currency Commercial Checking, High-Yield Savings, or Wealth Investment account.</p>
    </div>
</div>

<div class="portal-form-card">
    <form action="{{ url('/user/create-bank-account') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="currency" class="form-label">Select Account Currency</label>
            <select name="currency" id="currency" class="form-control" required>
                @foreach(\App\Services\CurrencyService::all() as $code => $cData)
                    <option value="{{ $code }}" {{ (Auth::user()->accounts()->first() && Auth::user()->accounts()->first()->currency === $code) || $code === 'USD' ? 'selected' : '' }}>
                        {{ $code }} ({{ $cData['symbol'] }}) — {{ $cData['name'] }} [{{ $cData['country'] }}]
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="account_type" class="form-label">Account Category</label>
            <select name="account_type" id="account_type" class="form-control" required>
                <option value="Checking">Commercial Checking</option>
                <option value="Savings">High-Yield Liquidity Savings</option>
                <option value="Investment">Private Wealth &amp; Investment Portfolio</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Clearing System &amp; Security</label>
            <input type="text" class="form-control" value="Corox Bank Global Clearing • Real-Time Electronic Settlement" readonly>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Account Request</button>
    </form>
</div>
@endsection
