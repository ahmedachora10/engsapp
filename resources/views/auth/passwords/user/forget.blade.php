<x-layout>
    <div class="login-page" data-aos="fade-down-menu">
        <div class="container">
            <div class="row justify-content-center no-gutters">
                <div class="bg-white col-md-12 col-xl-10 my-5 rounded-7">
                    <div class="row no-gutters">

                        <div
                            class="col-lg-6 col-xl-6 d-flex flex-column flex-fill justify-content-between p-3 p-md-5 pt-4 py-xl-0">
                            <a class="btn-back my-4" href="{{ route('home') }}">{{ __('form.buttons.back') }}</a>
                            <h1 class="text-center my-3">{{ __('main.forgotpassword') }}</h1>
                            <form id="login-form" class="mb-5" method="post" action="{{ route('user.password.forget') }}">
                                @csrf
                                <div class="form-group mb-5">
                                    <label for="email">{{ __('form.username') }}</label>
                                    <span class="has-icon email-icon">
                                        <input type="email" class="form-control" id="email" name="email" required
                                            placeholder="{{ __('form.placeholders.email') }}">
                                        @error('email')<span>{{$errors->first('email')}}</span>@enderror
                                    </span>
                                </div>

                                <p class="text-center mb-5">{{ __('main.forgotpassword_hint') }}</p>
                                @if (session()->has('warning'))
                                    <div id="password-error" class="invalid-feedback" style="display: block;">
                                        {{ session()->get('warning') }}</div>
                                @endif



                                <div class="form-row justify-content-center  mt-5 mb-3">
                                    <div class="col-6">
                                        <button class="btn btn-primary has-shadow btn-40 font-weight-bold"
                                            type="submit">{{ __('form.buttons.forgotpassword') }}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-xl-6 mt-3 mt-md-0">
                            <img src="{{ asset('images/reset.svg') }}" class="img-fluid w-100" style="margin-top: 12rem;margin-bottom: -5px;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(function() {
                $('#login-form').validate();
            });

        </script>

    @endsection
</x-layout>
