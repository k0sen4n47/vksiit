<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title-page')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>

<body>
    @unless(View::hasSection('noHeaderFooter'))
    @include('inc.header')
    @endunless

    <div class="container">
        @yield('content')
    </div>

    @unless(View::hasSection('noHeaderFooter'))
    @include('inc.footer')
    @endunless
</body>

</html>