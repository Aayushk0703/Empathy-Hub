@extends('adminlte::page')

@section('title', 'New Payment')

@section('content_header')
    <h1 class="m-0">New Payment</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.payments.store') }}">
                @include('admin.payments._form')
            </form>
        </div>
    </div>
@stop
