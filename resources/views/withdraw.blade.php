@extends('layouts.app')
@section('title', 'Withdraw USD')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Withdraw Funds (USD)</h2>
        <p style="color: var(--text-secondary);">Request a withdrawal or ATM payout from your active Corox Bank account.</p>
    </div>
</div>

<div style="background: var(--bg-surface); border: 1px solid var(--navy-border); border-radius: var(--radius-xl); padding: 2.5rem; max-width: 600px;">
    <form action="{{ url('/user/withdraw') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="account_number" class="form-label">Select USD Account</label>
            <select name="account_number" id="account_number" class="form-control" required>
                @foreach(Auth::user()->accounts()->where('status', 'active')->get() as $acc)
                    <option value="{{ $acc->account_number }}">
                        {{ $acc->account_type }} - {{ $acc->account_number }} (Balance: ${{ number_format($acc->balance, 2) }} USD)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount" class="form-label">Withdrawal Amount (USD $)</label>
            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required placeholder="0.00">
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Withdrawal Reason / Note</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="e.g. ATM Cash Withdrawal">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Process Withdrawal</button>
    </form>
</div>
@endsection
