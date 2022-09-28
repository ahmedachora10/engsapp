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
    <meta charset="utf-8" />
    <title>لوحة تحكم المنصة الهندسية | تسجيل الدخول</title>
    <meta name="description" content="لوحة تحكم المنصة الهندسية | تسجيل الدخول" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;700&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('adminAssets/assets/css/pages/login/classic/login-5.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->

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
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
                style="background-image: url({{ asset('adminAssets/assets/media/bg/bg-2.jpg') }});">
                <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{ asset('adminAssets/assets/media/logos/logo-white.svg') }}" class="max-h-75px"
                                alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-10">
                            <h3 class="opacity-40 font-weight-normal">تسجيل الدخول</h3>
                            <p class="opacity-40">لوحة تحكم | المنصة الهندسية</p>
                        </div>
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        @if (session()->has('warning') || $errors->any())
                            <div class="alert alert-custom alert-danger fade show mb-5" role="alert">
                                <div class="alert-icon">
                                    <i class="flaticon-warning"></i>
                                </div>
                                <div class="alert-text">
                                    {{ session()->get('warning') }}
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="ki ki-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form class="form" action="{{ route('admin.auth.login') }}" method="POST"
                            id="kt_login_signin_form">
                            @csrf
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                    type="email" placeholder="الايميل" name="email" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                    type="password" placeholder="كلمة المرور" name="password" />
                            </div>
                            <div class="form-group text-center mt-10">
                                <button id="kt_login_signin_submit" type="submit"
                                    class="btn btn-pill btn-primary opacity-90 px-15 py-3">تسجيل الدخول</button>
                            </div>
                        </form>

                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
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
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('adminAssets/assets/js/pages/custom/login/login-general.js') }}"></script>
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
