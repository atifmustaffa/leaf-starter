<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', app()->config('app.name')) - {{ app()->config('app.fullname') }}</title>

    @section('styles')
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    {{-- Global Style --}}
    <link href="{{ assets('css/main.css') }}" rel="stylesheet">
    @show

    @stack('additional-styles')
</head>

<body class="d-flex flex-column vh-100">

    @section('navbar')
        @include('partials.navbar')
    @show

    <div class="container flex-grow-1 overflow-auto py-3">
        @sectionMissing('hide-layout-flash')
          @include('partials.flash')
        @endif

        <div class="content">
            @yield('content')
        </div>
    </div>

    @section('footer')
        <footer>
            <div class="container">
                <p>&copy; {{ date('Y') }} {{ app()->config('app.fullname') }}. All rights reserved.</p>
            </div>
        </footer>
    @show

    @section('scripts')
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    {{-- Global Script --}}
    <script src="{{ assets('js/main.js') }}"></script>
    @show
    
    @stack('additional-scripts')

</body>

</html>
