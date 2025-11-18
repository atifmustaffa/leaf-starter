@extends('layouts.app')

@section('title', 'Home')

{{-- Page specific styles --}}
@section('styles')
@endsection

@section('content')
    <h1>Welcome to Home!</h1>
    <div class="mt-3">
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>
@endsection

{{-- Page specific scripts --}}
@section('scripts')
@endsection
