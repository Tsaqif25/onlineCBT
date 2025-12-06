<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- ============================= -->
    <!--      CSS LIBRARIES VOLT      -->
    <!-- ============================= -->

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- SIMPLEBAR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.min.css') }}">

    <!-- VOLT CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/volt.css') }}">

    <!-- Inertia Routes -->
    @routes

    <!-- Inertia + Vite -->
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body>
    @inertia

    <!-- ============================= -->
    <!--         JS LIBRARIES         -->
    <!-- ============================= -->

    <!-- BOOTSTRAP JS -->
     <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset('assets/js/volt.js') }}"></script>

</body>
</html>
