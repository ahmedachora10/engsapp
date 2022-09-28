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
                            <p class="text-center mb-5">{{ __('main.forgotpassword_done') }}</p>

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
