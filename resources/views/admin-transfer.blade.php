@extends('layouts.app')
@section('title', 'Admin Transfer Override')
@section('content')
<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Admin Wire Transfer Override</h2>
        <p style="color: var(--text-secondary);">Perform inter-account wire transfers between any two Corox Bank USD accounts.</p>
    </div>
</div>

<div style="background: var(--bg-surface); border: 1px solid var(--navy-border); border-radius: var(--radius-xl); padding: 2.5rem; max-width: 600px;">
    <form action="{{ url('/admin/transfer') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="from_account_number" class="form-label">Source Account Number</label>
            <input type="text" name="from_account_number" id="from_account_number" class="form-control" required placeholder="e.g. 1002847591">
        </div>

        <div class="form-group">
            <label for="to_account_number" class="form-label">Destination Account Number</label>
            <input type="text" name="to_account_number" id="to_account_number" class="form-control" required placeholder="e.g. 1007788990">
        </div>

        <div class="form-group">
            <label for="amount" class="form-label">Transfer Amount (USD $)</label>
            <input type="number" step="0.01" min="1" name="amount" id="amount" class="form-control" required placeholder="0.00">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Execute Wire Override</button>
    </form>
</div>
@endsection
