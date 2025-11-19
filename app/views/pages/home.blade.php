@extends('layouts.app')

@section('title', 'Home')

{{-- Page specific styles --}}
@push('additional-styles')
@endpush

@section('content')
    <h1>Welcome to Home!</h1>
    <div class="mt-3">
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>
@endsection

{{-- Page specific scripts --}}
@push('additional-scripts')
@endpush
