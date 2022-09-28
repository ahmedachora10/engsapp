<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('contactus') }}">
                {{ __('main.contactus') }}
            </a>
        </li>
    </x-breadcrumb>
    <div class="contact-page">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12 bg-white py-5 formcontainer" data-aos="fade-down-menu">
                    <x-alert />
                    <div class="row justify-content-center">
                        <div class="col-lg-5 form">
                            <h1 class="text-center"> {{ __('main.contactus') }}</h1>
                            <form id="contactus-form">
                                <div class="form-group">
                                    <label for="name">{{ __('form.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('form.username') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">{{ __('form.message') }}</label>
                                    <textarea id="message" name="message" class="form-control p-3" cols="30" rows="8"
                                        required></textarea>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-10 mt-2">
                                        <button
                                            class="btn btn-primary has-shadow btncontactus btn-s-50 font-weight-bold"
                                            type="submit">
                                            <span class="text">{{ __('form.buttons.login') }}</span>
                                            <div class="loading-animate">
                                                <div class="lds-ellipsis">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 desc offset-1 mt-5 mt-lg-0">
                            <div class="contactus-img">
                                <div class="">
                                    @include('svgImages.contactus-img')
                                </div>
                                <p class="head mb-3 mt-5">للتواصل المباشر</p>
                                <div class="d-flex flex-row">
                                    <span class="title">
                                        السعودية
                                    </span>
                                    <span class="email">
                                        {{ $website_links->contactus_email }}
                                        <br>
                                        {{ $website_links->contactus_phone }}
                                    </span>
                                </div>
                                <div class="d-flex flex-row mt-3">
                                    <span class="title">
                                        العنوان
                                    </span>
                                    <span class="mail">
                                        {{ $website_links->contactus_address }}
                                    </span>
                                </div>
                                <p class="head mt-5 mb-2">مواقع التواصل الاجتماعي</p>
                                <x-socialicons />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(function() {
                var form = $("#contactus-form");
                var validator = form.validate();
                $('.btncontactus').on('click', function(e) {

                    if (form.valid()) {
                        var btn = $(this);
                        btn.addClass('loading');
                        btn.attr("disabled", "disabled");
                        $.ajax({
                            type: "POST",
                            url: "{{ route('contactus_send') }}",
                            data: form.serialize(),
                            dataType: "json",
                            success: function(response) {
                                showAlertSuccess(response.message);
                                form.trigger("reset");
                                validator.resetForm();
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });
                        e.preventDefault();
                    }
                });


            });

        </script>
    @endsection
</x-layout>
