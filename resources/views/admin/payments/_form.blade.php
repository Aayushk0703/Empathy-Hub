@csrf

<div class="form-row">
    <div class="form-group col-md-6">
        <label>User (optional)</label>
        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
            <option value="">-- none --</option>
            @php($selectedUser = old('user_id', $payment->user_id ?? ''))
            @foreach(($users ?? []) as $u)
                <option value="{{ $u->id }}" {{ (string)$selectedUser === (string)$u->id ? 'selected' : '' }}>
                    #{{ $u->id }} - {{ $u->name }} ({{ $u->email }})
                </option>
            @endforeach
        </select>
        @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-6">
        <label>Product (optional)</label>
        <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
            <option value="">-- none --</option>
            @php($selectedProduct = old('product_id', $payment->product_id ?? ''))
            @foreach(($products ?? []) as $p)
                <option value="{{ $p->id }}" {{ (string)$selectedProduct === (string)$p->id ? 'selected' : '' }}>
                    #{{ $p->id }} - {{ $p->name }}
                </option>
            @endforeach
        </select>
        @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Amount</label>
        <input type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror"
               value="{{ old('amount', $payment->amount ?? 0) }}" min="0" required>
        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-2">
        <label>Currency</label>
        <input name="currency" class="form-control @error('currency') is-invalid @enderror"
               value="{{ old('currency', $payment->currency ?? 'INR') }}" maxlength="3" required>
        @error('currency') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-3">
        <label>Status</label>
        @php($status = old('status', $payment->status ?? 'pending'))
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ $status === 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="failed" {{ $status === 'failed' ? 'selected' : '' }}>Failed</option>
            <option value="refunded" {{ $status === 'refunded' ? 'selected' : '' }}>Refunded</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-3">
        <label>Paid at (optional)</label>
        <input type="datetime-local" name="paid_at" class="form-control @error('paid_at') is-invalid @enderror"
               value="{{ old('paid_at', optional(($payment->paid_at ?? null))->format('Y-m-d\\TH:i')) }}">
        @error('paid_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Provider (optional)</label>
        <input name="provider" class="form-control @error('provider') is-invalid @enderror"
               value="{{ old('provider', $payment->provider ?? '') }}" placeholder="razorpay/stripe/cash">
        @error('provider') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group col-md-6">
        <label>Reference (optional)</label>
        <input name="reference" class="form-control @error('reference') is-invalid @enderror"
               value="{{ old('reference', $payment->reference ?? '') }}">
        @error('reference') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<button class="btn btn-primary" type="submit">Save</button>
<a class="btn btn-secondary" href="{{ route('admin.payments.index') }}">Cancel</a>
