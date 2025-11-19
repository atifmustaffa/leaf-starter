@extends('layouts.app')

@section('title', 'Dashboard')

{{-- Page specific styles --}}
@push('additional-styles')
@endpush

@section('content')
    <h1>Welcome to Dashboard!</h1>
    <div class="mt-3">
        <a href="{{ route('auth.logout') }}" class="btn btn-danger">Logout</a>
    </div>
@endsection

{{-- Page specific scripts --}}
@push('additional-scripts')
@endpush
