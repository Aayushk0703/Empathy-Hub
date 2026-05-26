@extends('adminlte::page')

@section('title', 'Edit Payment')

@section('content_header')
    <h1 class="m-0">Edit Payment #{{ $payment->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.payments.update', $payment) }}">
                @method('PUT')
                @include('admin.payments._form', ['payment' => $payment])
            </form>
        </div>
    </div>
@stop
