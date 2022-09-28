<x-layout>
    <div class="login-page" data-aos="fade-down-menu">
        <div class="container">
            <div class="row justify-content-center no-gutters">
                <div class="bg-white col-md-12 col-xl-10 my-5 rounded-7">
                    <div class="row no-gutters">

                        <div
                            class="col-lg-6 col-xl-6 d-flex flex-column flex-fill justify-content-center p-3 p-md-5 pt-4 py-xl-0">
                            <a class="btn-back" href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                            <h1 class="text-center my-4">{{ __('main.signin') }}</h1>
                            <form id="login-form" method="post" action="{{ route('auth.login.serve') }}">
                                @csrf
                                <div class="login-select d-flex justify-content-center flex-column flex-md-row mb-4">
                                    <label   class="action_label  mr-0 mr-md-2 mb-3 mb-md-0">
                                        <input type="radio" name="user_type" value="company" checked>
                                        <div class="action">{{ __('form.engineeringoffice') }}</div>
                                    </label>
                                    <label class="action_label  mr-0 mr-md-2 mb-3 mb-md-0">
                                        <input type="radio" name="user_type" value="freelancer">
                                        <div class="action">{{ __('form.freelancers') }}</div>
                                    </label>
                                    <label class="action_label">
                                        <input type="radio" name="user_type" value="user">
                                        <div class="action">{{ __('form.user') }}</div>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('form.username') }}</label>
                                    <span class="has-icon email-icon">
                                        <input type="email" class="form-control" id="email" name="email" required
                                            placeholder="{{ __('form.placeholders.email') }}">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('form.password') }}</label>
                                    <span class="has-icon lock-icon">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required placeholder="*********">
                                    </span>
                                </div>
                                @if (session()->has('warning'))
                                    <div id="password-error" class="invalid-feedback" style="display: block;">
                                        {{ session()->get('warning') }}</div>
                                @endif

                                <div class="form-row">
                                    <div class="col-12">
                                        <a href="{{route('user.password.forget')}}" class="forgotpassword">{{ __('form.forgotpassword') }}</a>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center mt-4">
                                    <div class="col-6">
                                        <button class="btn btn-primary has-shadow btn-40 font-weight-bold"
                                            type="submit">{{ __('form.buttons.login') }}</button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center">
                                        <a href="{{ route('auth.register') }}"
                                            class="btn-40 font-weight-bold">{{ __('form.buttons.createaccount') }}</a>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex flex-column mt-5 social-list-rounded text-center">
                                <p>{{ __('main.login.oauthloginmsg') }}</p>
                                <div class="d-flex justify-content-center mt-3">

                                    <a href="{{ route('auth.login.google') }}"
                                        class="icon d-flex align-items-center justify-content-center gmail mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.35" height="14.741"
                                            viewBox="0 0 19.35 14.741">
                                            <g id="gmail" transform="translate(0.001 0)">
                                                <g id="Group_15028" data-name="Group 15028"
                                                    transform="translate(1.261 0)">
                                                    <path id="Path_7206" data-name="Path 7206"
                                                        d="M50.446,122.808l-1.235,12.4H34.374l-1-12.164,8.414,4.711Z"
                                                        transform="translate(-33.379 -120.471)" fill="#fff" />
                                                    <path id="Path_7207" data-name="Path 7207"
                                                        d="M54.583,60.983l-8.235,7.735-8.235-7.735H54.583Z"
                                                        transform="translate(-37.935 -60.983)" fill="#fff" />
                                                </g>
                                                <path id="Path_7208" data-name="Path 7208"
                                                    d="M2.257,113.612v11.169H.912A.912.912,0,0,1,0,123.869v-11.9l1.474.04Z"
                                                    transform="translate(-0.001 -110.04)" fill="#f14336" />
                                                <path id="Path_7209" data-name="Path 7209"
                                                    d="M454.545,109.081v11.9a.913.913,0,0,1-.913.912h-1.344V110.726l.744-1.758Z"
                                                    transform="translate(-435.195 -107.154)" fill="#d32e2a" />
                                                <path id="Path_7210" data-name="Path 7210"
                                                    d="M19.35,61.9V62.91l-2.257,1.645L9.675,69.962,2.257,64.555,0,62.91V61.9a.913.913,0,0,1,.912-.912H1.44l8.235,6,8.235-6h.528A.913.913,0,0,1,19.35,61.9Z"
                                                    transform="translate(-0.001 -60.983)" fill="#f14336" />
                                                <path id="Path_7211" data-name="Path 7211"
                                                    d="M2.257,113.612,0,113.262v-1.3Z"
                                                    transform="translate(-0.001 -110.04)" fill="#d32e2a" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 mt-3 mt-md-0">
                            <div class="login-slider">
                                <div>
                                    <img src="{{ asset('storage/login-slide1.jpg') }}" class="img-fluid w-100" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('storage/login-slide2.jpg') }}" class="img-fluid w-100" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('storage/login-slide3.jpg') }}" class="img-fluid w-100" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('storage/login-slide4.jpg') }}" class="img-fluid w-100" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('styles')
        <meta name="google-signin-client_id" content="691835261872-vr73vfgae177vni1vs5m4r7nhehd2ns9.apps.googleusercontent.com">

    @endsection
    @section('scripts')
        <script>
            $(function() {
                $('#login-form').validate();
            });

        </script>

    @endsection
</x-layout>
