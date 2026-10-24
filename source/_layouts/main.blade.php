<!DOCTYPE html>
<html lang="{{ $page->language ?? 'zh-Hant' }}">
<head>
    @include('_components.head')
    @stack('head')
</head>
<body class="bg-bg text-main1 font-sans antialiased selection:bg-main2 selection:text-white min-h-screen">
    @include('_components.nav')

    <main class="w-full">
        @yield('body')
    </main>

    @include('_components.footer')

    @stack('scripts')
</body>
</html>
