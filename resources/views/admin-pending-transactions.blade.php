@extends('layouts.app')
@section('title', 'Pending Transactions Queue')
@section('content')

<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Transaction Settlement Queue</h2>
        <p style="color: var(--text-secondary);">Review, inspect, and approve pending outward wires and mobile check deposits.</p>
    </div>
    <div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="font-size: 13px; font-weight: 600;">
            &larr; Admin Dashboard
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="margin-bottom: 1.5rem; background: #ECFDF5; border: 1.5px solid #10B981; color: #065F46; padding: 1rem 1.25rem; border-radius: 8px; font-weight: 600;">
        ✓ {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" style="margin-bottom: 1.5rem; background: #FEF2F2; border: 1.5px solid #EF4444; color: #991B1B; padding: 1rem 1.25rem; border-radius: 8px; font-weight: 600;">
        ⚠️ {{ session('error') }}
    </div>
@endif

<!-- Queue Filter Tabs -->
<div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
    <a href="{{ route('admin.pending.transactions') }}" class="btn {{ empty($type) ? 'btn-primary' : 'btn-secondary' }}" style="font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 20px;">
        All Pending ({{ $pendingCount }})
    </a>
    <a href="{{ route('admin.pending.transactions', ['type' => 'check']) }}" class="btn {{ $type === 'check' ? 'btn-primary' : 'btn-secondary' }}" style="font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 20px;">
        📸 Mobile Checks ({{ $pendingChecksCount }})
    </a>
    <a href="{{ route('admin.pending.transactions', ['type' => 'wire']) }}" class="btn {{ $type === 'wire' ? 'btn-primary' : 'btn-secondary' }}" style="font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 20px;">
        ⚡ Wire Transfers ({{ $pendingWiresCount }})
    </a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Ref # / Date</th>
                    <th>Client / User</th>
                    <th>Type &amp; Method</th>
                    <th>Account Flow</th>
                    <th>Amount (USD)</th>
                    <th>Status / Clearing</th>
                    <th>Verification Details</th>
                    <th style="text-align: right;">Admin Settlement</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingTransactions as $tx)
                    <tr>
                        <td>
                            <strong>#{{ $tx->id }}</strong>
                            <div style="font-size: 12px; color: var(--text-secondary);">{{ $tx->created_at->format('M d, Y h:i A') }}</div>
                        </td>
                        <td>
                            <strong>{{ $tx->user ? $tx->user->name : 'Client #' . $tx->user_id }}</strong>
                            <div style="font-size: 11.5px; color: var(--text-secondary);">{{ $tx->user ? $tx->user->email : '' }}</div>
                        </td>
                        <td>
                            @if($tx->deposit_method === 'check')
                                <span class="badge badge-deposit" style="background: #EEF2FF; color: #4338CA; border: 1px solid #C7D2FE;">📸 Check Deposit</span>
                            @elseif($tx->transaction_type === 'withdraw')
                                <span class="badge badge-withdraw">Withdrawal</span>
                            @else
                                <span class="badge badge-transfer">⚡ Wire Transfer</span>
                            @endif
                        </td>
                        <td style="font-size: 12.5px;">
                            @if($tx->deposit_method === 'check')
                                <div>Deposit to: <code>{{ $tx->toAccount ? $tx->toAccount->account_number : '—' }}</code></div>
                                <div style="font-size: 11px; color: var(--text-secondary);">Check #: {{ $tx->check_number ?? 'N/A' }}</div>
                            @elseif($tx->fromAccount && $tx->toAccount)
                                <div>From: <code>{{ $tx->fromAccount->account_number }}</code></div>
                                <div>To: <code>{{ $tx->toAccount->account_number }}</code></div>
                            @elseif($tx->fromAccount)
                                <div>From: <code>{{ $tx->fromAccount->account_number }}</code></div>
                                <div style="color: var(--text-secondary); font-size: 11.5px;">External Wire Out</div>
                            @else
                                —
                            @endif
                        </td>
                        <td style="font-weight: 800; font-size: 15px; color: {{ $tx->deposit_method === 'check' ? 'var(--success)' : '#111827' }};">
                            ${{ number_format($tx->amount, 2) }}
                        </td>
                        <td>
                            <span class="badge badge-pending">Pending Review</span>
                            <div style="font-size: 11px; color: #92400E; margin-top: 3px; font-weight: 600;">
                                Clears: {{ $tx->clearing_date ? \Carbon\Carbon::parse($tx->clearing_date)->format('M d, Y') : 'Next Day' }}
                            </div>
                        </td>
                        <td>
                            @if($tx->deposit_method === 'check' && ($tx->check_front_image || $tx->check_back_image))
                                <div style="display: flex; gap: 6px; align-items: center;">
                                    @if($tx->check_front_image)
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="openCheckModal('{{ asset($tx->check_front_image) }}', 'Front of Check #{{ $tx->check_number }}')" style="padding: 3px 8px; font-size: 11px; font-weight: 700;">
                                            🖼️ Front
                                        </button>
                                    @endif
                                    @if($tx->check_back_image)
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="openCheckModal('{{ asset($tx->check_back_image) }}', 'Back of Check #{{ $tx->check_number }}')" style="padding: 3px 8px; font-size: 11px; font-weight: 700;">
                                            🖼️ Back
                                        </button>
                                    @endif
                                </div>
                            @else
                                <div style="font-size: 12px; color: #4B5563; max-width: 220px; line-height: 1.3;">
                                    {{ $tx->description ?? 'No memo' }}
                                </div>
                            @endif
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            {{-- Approve Action Form --}}
                            <form action="{{ route('admin.transaction.approve', $tx->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Approve transaction #{{ $tx->id }} for ${{ number_format($tx->amount, 2) }}? This will clear funds immediately.');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary" style="padding: 5px 12px; font-size: 12px; font-weight: 700; background: #059669; border-color: #059669;">
                                    ✓ Approve
                                </button>
                            </form>

                            {{-- Reject Action Form --}}
                            <form action="{{ route('admin.transaction.reject', $tx->id) }}" method="POST" style="display: inline-block; margin-left: 4px;" onsubmit="return confirm('Reject transaction #{{ $tx->id }}? Any held wire funds will be refunded.');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-secondary" style="padding: 5px 10px; font-size: 12px; font-weight: 600; color: #DC2626;">
                                    ✕ Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-secondary); padding: 3rem;">
                            <div style="font-size: 28px; margin-bottom: 0.5rem;">🎉</div>
                            <div style="font-weight: 700; font-size: 16px; color: #111827;">No Pending Transactions</div>
                            <p style="font-size: 13px; color: #6B7280; margin: 4px 0 0 0;">All outward wire transfers and mobile check deposits have been reviewed and settled.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pendingTransactions->hasPages())
        <div class="tx-pagination-wrapper">
            <div style="font-size: 13px; color: var(--text-secondary); font-weight: 600;">
                Showing pending {{ $pendingTransactions->firstItem() ?? 0 }}–{{ $pendingTransactions->lastItem() ?? 0 }} of {{ $pendingTransactions->total() }}
            </div>
            <div class="pagination-wrapper">
                {{ $pendingTransactions->links('partials.pagination') }}
            </div>
        </div>
    @endif
</div>

<!-- Check Image Inspection Lightbox Modal -->
<div id="checkModal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.85); z-index: 9999; align-items: center; justify-content: center; padding: 1.5rem;" onclick="closeCheckModal()">
    <div style="background: #FFFFFF; border-radius: 12px; max-width: 800px; width: 100%; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);" onclick="event.stopPropagation()">
        <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #E5E7EB; display: flex; justify-content: space-between; align-items: center;">
            <h4 id="modalTitle" style="margin: 0; font-size: 16px; font-weight: 800; color: #111827;">Check Inspection</h4>
            <button type="button" onclick="closeCheckModal()" style="background: none; border: none; font-size: 22px; cursor: pointer; color: #6B7280; line-height: 1;">&times;</button>
        </div>
        <div style="padding: 1.25rem; text-align: center; background: #111827;">
            <img id="modalImg" src="" alt="Check Inspection" style="max-width: 100%; max-height: 70vh; object-fit: contain; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
        </div>
        <div style="padding: 0.85rem 1.25rem; background: #F9FAFB; display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn-secondary" onclick="closeCheckModal()" style="font-size: 13px; font-weight: 700;">Close Preview</button>
        </div>
    </div>
</div>

<script>
function openCheckModal(imgSrc, title) {
    document.getElementById('modalImg').src = imgSrc;
    document.getElementById('modalTitle').innerText = title;
    const modal = document.getElementById('checkModal');
    modal.style.display = 'flex';
}
function closeCheckModal() {
    const modal = document.getElementById('checkModal');
    modal.style.display = 'none';
}
</script>

@endsection
