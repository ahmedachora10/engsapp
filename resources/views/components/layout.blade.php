<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="SdOb2Xhqe5z32pQa28aXuvf6trLW3P2D4jQwmIXcIG8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>منصة مهندسون </title>
    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100;200;300;400;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?tick=120">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}?tick=120">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" />
    @section('styles')
    @show
    @stack('css')
</head>

<body class="text-left {{ Route::currentRouteName() == 'home' ? 'mainbg' : '' }}">
    @if (Route::currentRouteName() == 'home')
        <div class="container bg-topright">
            <img class=""
                src="{{ app()->getLocale() == 'ar' ? asset('images/bg-topright.svg') : asset('images/bg-topleft.svg') }}"
                alt="">
        </div>
    @else
        <x-socialnavbar />
    @endif
    <x-navbar>
        <x-slot name="activelink">
            {{ $linkselected ?? '' }}
        </x-slot>
    </x-navbar>

    @section('panels')
    @show

    {{ $slot }}
    <x-footer />

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('js/messages_ar.js') }}"></script>
    @endif
    <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}?tick=120"></script>
    <script>
        const windowFocusedEvent = new CustomEvent("windowFocused", {});

        function windowFocusListener() {
            if (!document.hidden) {
                document.dispatchEvent(windowFocusedEvent);
            }
        }

        document.addEventListener("visibilitychange", windowFocusListener);
        document.addEventListener("DOMContentLoaded", windowFocusListener);

        // AOS.init({
        //     startEvent: "windowFocused",
        // });
        AOS.init({
            once: true,
            duration: 850,
            startEvent: "windowFocused",
            // offset: jQuery(window).height() * 0.25,
        });
        $(function (){
           $(document).on('click','.mobile-menu.active .menu-hash-nav',function (){
               $('#menuToggle').click();
           })
        });

    </script>

    @section('scripts')
    @show

</body>

</html>
