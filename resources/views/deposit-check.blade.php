@extends('layouts.app')
@section('title', 'Mobile Check Deposit')
@section('content')

<div class="dashboard-header">
    <div>
        <h2 style="font-size: 1.8rem; font-weight: 800;">Mobile Check Deposit</h2>
        <p style="color: var(--text-secondary);">Snap photos of the front and back of your endorsed check to deposit funds securely.</p>
    </div>
    <div>
        <a href="{{ route('show.deposit.form') }}" class="btn btn-secondary" style="font-size: 13px; font-weight: 600;">
            &larr; Standard Deposit Options
        </a>
    </div>
</div>

<div class="portal-form-card" style="max-width: 780px; margin: 0 auto;">
    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom: 1.25rem;">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 1.25rem;">
            <ul style="margin: 0; padding-left: 1.2rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('deposit.check') }}" method="POST" enctype="multipart/form-data" id="checkDepositForm">
        @csrf

        {{-- Account Selection --}}
        <div class="form-group">
            <label for="account_number" class="form-label" style="font-weight: 700; color: #111827;">Deposit Into Account</label>
            <select name="account_number" id="account_number" class="form-control" required style="font-size: 14px; font-weight: 600;">
                @foreach($accounts as $acc)
                    <option value="{{ $acc->account_number }}">
                        {{ $acc->account_type }} — {{ $acc->account_number }} (Available: ${{ number_format($acc->balance, 2) }} USD)
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Dual Camera Capture Viewfinders (Front & Back) --}}
        <div class="check-capture-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
            
            {{-- Front of Check --}}
            <div class="check-capture-card">
                <div class="check-capture-header">
                    <span class="check-step-badge">1</span>
                    <div>
                        <h4 style="margin: 0; font-size: 15px; font-weight: 800; color: #111827;">Front of Check</h4>
                        <p style="margin: 0; font-size: 12px; color: #6B7280;">Ensure all 4 corners and amount are clearly visible</p>
                    </div>
                </div>

                <div class="check-viewfinder" id="frontViewfinder" onclick="document.getElementById('check_front').click()">
                    <div class="viewfinder-corners">
                        <div class="corner top-left"></div>
                        <div class="corner top-right"></div>
                        <div class="corner bottom-left"></div>
                        <div class="corner bottom-right"></div>
                    </div>
                    <div class="viewfinder-content" id="frontContent">
                        <div class="viewfinder-icon">📷</div>
                        <span class="viewfinder-text">Tap to snap or upload <strong>Front of Check</strong></span>
                        <span class="viewfinder-sub">Good lighting • Dark plain background</span>
                    </div>
                    <img id="frontPreview" class="check-preview-img" src="" alt="Front of Check Preview" style="display: none;">
                </div>
                <input type="file" name="check_front" id="check_front" accept="image/*" capture="environment" required style="display: none;" onchange="handleCheckPreview(this, 'frontPreview', 'frontContent')">
            </div>

            {{-- Back of Check --}}
            <div class="check-capture-card">
                <div class="check-capture-header">
                    <span class="check-step-badge">2</span>
                    <div>
                        <h4 style="margin: 0; font-size: 15px; font-weight: 800; color: #111827;">Back of Check</h4>
                        <p style="margin: 0; font-size: 12px; color: #6B7280;">Must be endorsed: "For Mobile Deposit Only at Corox Bank"</p>
                    </div>
                </div>

                <div class="check-viewfinder" id="backViewfinder" onclick="document.getElementById('check_back').click()">
                    <div class="viewfinder-corners">
                        <div class="corner top-left"></div>
                        <div class="corner top-right"></div>
                        <div class="corner bottom-left"></div>
                        <div class="corner bottom-right"></div>
                    </div>
                    <div class="viewfinder-content" id="backContent">
                        <div class="viewfinder-icon">📷</div>
                        <span class="viewfinder-text">Tap to snap or upload <strong>Back of Check</strong></span>
                        <span class="viewfinder-sub">Sign endorsement line prior to snapping</span>
                    </div>
                    <img id="backPreview" class="check-preview-img" src="" alt="Back of Check Preview" style="display: none;">
                </div>
                <input type="file" name="check_back" id="check_back" accept="image/*" capture="environment" required style="display: none;" onchange="handleCheckPreview(this, 'backPreview', 'backContent')">
            </div>

        </div>

        {{-- Amount & Check Details --}}
        <div style="background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 10px; padding: 1.25rem; margin-bottom: 1.5rem;">
            <div style="font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #374151; margin-bottom: 0.85rem; display: flex; align-items: center; gap: 6px;">
                <span>💵</span> Captured Check Details &amp; Amount Confirmation
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="amount" class="form-label" style="font-weight: 700; color: #111827;">Check Amount (USD $)</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-weight: 800; color: #374151; font-size: 16px;">$</span>
                        <input type="number" step="0.01" min="1" max="100000" name="amount" id="amount" class="form-control" required placeholder="0.00" style="padding-left: 28px; font-size: 18px; font-weight: 800; color: #111827;">
                    </div>
                    <small style="color: #6B7280; font-size: 11.5px; margin-top: 4px; display: block;">Enter or confirm the exact numeric amount written on the check</small>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label for="check_number" class="form-label" style="font-weight: 700; color: #111827;">Check Number (Optional)</label>
                    <input type="text" name="check_number" id="check_number" class="form-control" placeholder="e.g. 1042" style="font-size: 15px; font-weight: 600;">
                    <small style="color: #6B7280; font-size: 11.5px; margin-top: 4px; display: block;">Found at the top-right or MICR line of check</small>
                </div>
            </div>
        </div>

        {{-- Regulatory & Clearing Disclosure --}}
        <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 8px; padding: 0.85rem 1rem; margin-bottom: 1.5rem; display: flex; align-items: flex-start; gap: 10px; font-size: 12px; color: #1E40AF; line-height: 1.45;">
            <span style="font-size: 16px; line-height: 1;">ℹ️</span>
            <div>
                <strong>Regulation CC Funds Availability Notice:</strong> Mobile check deposits are reviewed by Corox Bank administrators. Once approved, funds typically settle and clear on the <strong>next business day</strong>. Please retain the physical paper check for 14 days following deposit confirmation.
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitCheckBtn" style="font-weight: 800; letter-spacing: 0.3px; padding: 0.9rem; font-size: 15px; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <span>Submit Mobile Check Deposit</span>
            <span>&rarr;</span>
        </button>
    </form>
</div>

<script>
function handleCheckPreview(input, previewId, contentId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            const content = document.getElementById(contentId);
            preview.src = e.target.result;
            preview.style.display = 'block';
            content.style.display = 'none';

            // Check if this was the front check and amount is empty
            if (previewId === 'frontPreview') {
                const amountInput = document.getElementById('amount');
                if (!amountInput.value) {
                    amountInput.focus();
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
