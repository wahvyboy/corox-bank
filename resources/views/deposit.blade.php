@extends('layouts.app')
@section('title', 'Deposit USD')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Deposit Funds (USD)</h2>
        <p style="color: var(--text-secondary);">Direct deposit funds into your active Corox Bank account.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem;">
    <!-- Mobile Check Deposit Card -->
    <a href="{{ route('show.deposit.check') }}" class="wf-action-card" style="border: 2px solid #CC0000; background: linear-gradient(180deg, #FFFFFF 0%, #FFF5F5 100%); position: relative;">
        <div style="position: absolute; top: 12px; right: 12px; background: #CC0000; color: #FFFFFF; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Recommended</div>
        <div class="wf-action-icon-box" style="background: rgba(204, 0, 0, 0.1); color: #CC0000; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 0.75rem;">
            📸
        </div>
        <h3 style="font-size: 1.15rem; font-weight: 800; color: #111827; margin-bottom: 0.35rem;">Mobile Check Deposit</h3>
        <p style="font-size: 13px; color: #4B5563; margin-bottom: 1rem; line-height: 1.4;">Snap a photo of the front and back of your endorsed paper check to deposit instantly.</p>
        <span style="font-size: 13px; font-weight: 700; color: #CC0000; display: inline-flex; align-items: center; gap: 4px;">
            Open Check Scanner &rarr;
        </span>
    </a>

    <!-- Direct Deposit / Wire Instructions Card -->
    <div class="wf-action-card" style="background: #FFFFFF;">
        <div class="wf-action-icon-box" style="background: rgba(16, 185, 129, 0.1); color: #059669; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 0.75rem;">
            🏛️
        </div>
        <h3 style="font-size: 1.15rem; font-weight: 800; color: #111827; margin-bottom: 0.35rem;">Incoming Wire Routing</h3>
        <p style="font-size: 13px; color: #4B5563; margin-bottom: 0.6rem; line-height: 1.4;">Direct outward senders to Corox Bank routing <code>026009593</code> and your active account number.</p>
        <span style="font-size: 12px; font-weight: 600; color: #059669;">FedWire &amp; ACH Eligible</span>
    </div>
</div>

<div class="portal-form-card">
    <div style="font-size: 15px; font-weight: 800; color: #111827; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #E5E7EB;">
        Direct Wire / ACH Electronic Credit
    </div>
    <form action="{{ url('/user/deposit') }}" method="POST">
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
            <label for="amount" class="form-label">Deposit Amount (USD $)</label>
            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required placeholder="0.00">
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Deposit Source / Reference</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="e.g. Check deposit, ACH transfer">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Confirm Deposit</button>
    </form>
</div>
@endsection
