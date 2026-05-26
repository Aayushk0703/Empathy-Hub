@extends('adminlte::page')

@section('title', 'Payments')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0">Payments</h1>
        <a class="btn btn-primary" href="{{ route('admin.payments.create') }}">
            <i class="fas fa-plus"></i> New Payment
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid at</th>
                    <th style="width: 220px;"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ optional($payment->user)->name ?? '-' }}</td>
                        <td>{{ optional($payment->product)->name ?? '-' }}</td>
                        <td>{{ $payment->currency }} {{ number_format((float)$payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>{{ optional($payment->paid_at)->format('Y-m-d') ?? '-' }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline-info" href="{{ route('admin.payments.show', $payment) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.payments.edit', $payment) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.payments.destroy', $payment) }}"
                                  onsubmit="return confirm('Delete this payment?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4 text-muted">No payments yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($payments->hasPages())
            <div class="card-footer">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
@stop
