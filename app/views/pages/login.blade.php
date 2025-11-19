@extends('layouts.app')

@section('title', 'Login')

{{-- Page specific styles --}}
@push('additional-styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-4">
            <form method="post" action="{{ route('auth.login') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control" id="username" name="username" aria-describedby="usernameHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
@endsection

{{-- Page specific scripts --}}
@push('additional-scripts')
@endpush
