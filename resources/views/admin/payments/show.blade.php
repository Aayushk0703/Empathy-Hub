@extends('adminlte::page')

@section('title', 'View Payment')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Payment #{{ $payment->id }}</h1>
        <div>
            <a class="btn btn-outline-primary" href="{{ route('admin.payments.edit', $payment) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('admin.payments.index') }}">Back</a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">User</dt>
                <dd class="col-sm-9">{{ optional($payment->user)->name ?? '-' }}</dd>
                <dt class="col-sm-3">Product</dt>
                <dd class="col-sm-9">{{ optional($payment->product)->name ?? '-' }}</dd>
                <dt class="col-sm-3">Amount</dt>
                <dd class="col-sm-9">{{ $payment->currency }} {{ number_format((float)$payment->amount, 2) }}</dd>
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ ucfirst($payment->status) }}</dd>
                <dt class="col-sm-3">Paid at</dt>
                <dd class="col-sm-9">{{ optional($payment->paid_at)->toDayDateTimeString() ?? '-' }}</dd>
                <dt class="col-sm-3">Provider</dt>
                <dd class="col-sm-9">{{ $payment->provider ?? '-' }}</dd>
                <dt class="col-sm-3">Reference</dt>
                <dd class="col-sm-9">{{ $payment->reference ?? '-' }}</dd>
            </dl>
        </div>
    </div>
@stop
