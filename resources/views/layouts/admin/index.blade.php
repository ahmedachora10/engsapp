<!DOCTYPE html>

<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html direction="rtl" dir="rtl" style="direction: rtl">

<!--begin::Head-->

<head>
    {{-- <base href=""> --}}
    <meta charset="utf-8" />
    <title>لوحة التحكم | المنصه الهندسية</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="لوحة تحكم موقع المنصه الهندسية" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />

    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;700&display=swap" rel="stylesheet">

    <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('adminAssets/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}"
        rel="stylesheet" type="text/css" />

    <!--end::Page Vendors Styles-->
    <link href="{{ asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}"
        rel="stylesheet" type="text/css" />
    @stack('styles')

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('adminAssets/assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('adminAssets/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('adminAssets/assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet"
        type="text/css" />

    <!--end::Layout Themes-->
    {{-- <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> --}}
    <style>
        .table.table-head-custom thead tr,
        .table.table-head-custom thead th {
            letter-spacing: unset !important;
            font-weight: bold;
        }

    </style>
</head>

<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed @yield('subHeaderClasses')">

    <!--[html-partial:include:{"file":"layout.html"}]/-->
    @include('layouts.admin.layout')
    <!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-user.html"}]/-->
    @include('layouts.admin.partials._extras.offcanvas.quick-user')
    <!--[html-partial:include:{"file":"partials/_extras/scrolltop.html"}]/-->
    @include('layouts.admin.partials._extras.scrolltop')

    @stack('models')


    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";

    </script>

    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };

    </script>

    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('adminAssets/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('adminAssets/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('adminAssets/assets/js/scripts.bundle.js') }}"></script>

    <!--end::Global Theme Bundle-->

    <!--begin::Page Vendors(used by this page)-->
    {{-- <script src="{{ asset('adminAssets/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}

    <!--end::Page Vendors-->
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        });

    </script>
    <!--begin::Page Scripts(used by this page)-->
    {{-- <script src="{{ asset('adminAssets/assets/js/pages/widgets.js') }}"></script> --}}
    @stack('scripts')
    <!--end::Page Scripts-->
</body>

<!--end::Body-->

</html>
