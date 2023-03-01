<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IAMX - own your identity - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <!-- <link href="/css/DIDVerification.css" rel="stylesheet"> -->
    <script src="/js/jquery-3.6.3.min.js"></script>
</head>

<body>
    @include('layout_files.spinner')
    @include('layout_files.header')
    <main class="mainPage p-5 mx-auto d-block">
        @yield('content')
    </main>

    @include('layout_files.footer')
    @stack('scripts')
</body>

</html>
