<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <script type="module">
        $('.submit').click(function() {
            if ($(this).data('href')) {
                window.location.href = $(this).data('href');
            }
            if ($(this).data('validate') && !$(this).parents('form')[0].reportValidity()) {
                return false;
            }
            $(this).parents('form').attr('action', $(this).data('action'));
            $('<input>').attr({
                type: 'hidden',
                'name': '_method',
                'value': $(this).data('method'),
            }).appendTo($(this).parents('form'));
            $(this).parents('form').submit();
        });
        flatpickr('input[type="date"]', {
            allowInput: true, // formValidationの為必要
            altInput: true,
            altFormat: 'Y/m/d',
            dateFormat: 'Y-m-d',
            locale: 'ja',
        });
        flatpickr('input[type="datetime-local"]', {
            allowInput: true, // formValidationの為必要
            altInput: true,
            enableTime: true,
            altFormat: 'Y/m/d H:i',
            dateFormat: 'Y-m-d H:i',
            locale: 'ja',
        });
    </script>
</head>

<body class="h-full font-sans antialiased">
    <div x-cloak x-data="{ isOpenOffCanvasMenu: false }">
        <x-organisms.offset-canvas-menu />
        <x-organisms.sidebar />
        <div class="md:pl-64 flex flex-col">
            <x-organisms.header />
            <main class="flex-1">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <x-molecules.alert />
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    @livewireScripts
</body>

</html>
