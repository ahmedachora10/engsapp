<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.accountSettings') }}">
                {{ __('main.accountSettings') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.contactInfo') }}">
                معلومات التواصل
            </a>
        </li>
    </x-breadcrumb>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-operator.sidebar>
                <x-slot name="linkselected">
                    contact-info
                </x-slot>
            </x-operator.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0">
                <div class="border-radius-8 bg-white d-flex p-md-5 py-4 px-3">
                    <x-alert />
                    <form action="{{ route('operator.contactInfo') }}" class="mt-1" id="contactinfoForm"
                        method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="mb-4">معلومات التواصل</h1>
                            </div>
                            <div class="col-md-6 order-2 order-md-1">
                                <div class="form-group">
                                    <label for="email">{{ __('form.username') }}</label>
                                    <span class="has-icon email-icon">
                                        <input type="email" class="form-control" id="email" name="email"
                                            disabled="disabled" value="{{ $email }}">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                        for="operator_number">{{ __('form.mobilenumber') }}</label>
                                    <div class="has-icon has-dropdown-number phone-icon">
                                        <input type="text" class="form-control" id="operator_number"
                                            name="operator_number" required value="{{ $phone_number }}"
                                            data-rule-number="true" placeholder="{{ __('form.mobilenumber') }}">
                                        <div class="selector-container">
                                            <select class="custom-select" id="usermobilecountrycode"
                                                name="usermobilecountrycode">
                                                @foreach ($countriesCode as $country)
                                                    @if (isset($defaultCode) && $country->code == $defaultCode && $phone_number_country_code == null)
                                                        <option value="{{ $defaultCode }}" selected>
                                                            {{ $defaultCode }}</option>
                                                    @elseif ($phone_number_country_code == $country->code)
                                                        <option value="{{ $country->code }}" selected>
                                                            {{ $country->code }}</option>
                                                    @else
                                                        <option value="{{ $country->code }}">{{ $country->code }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label>مواقع التواصل الاجتماعي</label>
                                    <span class="has-icon instagram-icon">
                                        <input type="text" class="form-control font-Roboto" id="instagram_link"
                                            name="instagram_link" value="{{ $company_instagram }}">
                                    </span>
                                </div>
                                <div class="form-group mb-2">
                                    <span class="has-icon twitter-icon">
                                        <input type="text" class="form-control font-Roboto" id="twitter_link"
                                            name="twitter_link" value="{{ $company_twitter }}">
                                    </span>
                                </div>
                                <div class="form-group mb-5">
                                    <span class="has-icon facebook-icon">
                                        <input type="text" class="form-control font-Roboto" id="facebook_link"
                                            name="facebook_link" value="{{ $company_facebook }}">
                                    </span>
                                </div>
                            </div>
                            <div
                                class="col-md-5 mb-4 mb-md-0 offset-md-1 order-1 order-md-2 align-items-center d-flex text-center">
                                <img class="mt-4" src="{{ asset('images/card-info.svg') }}" alt="">
                            </div>
                            <div class="col-md-12 order-3 order-md-3 mt-4 mt-md-0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary has-shadow btn-46 d-inline-block">
                                            <span class="text">حفظ التعديلات</span>
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        {{-- <script src="{{ asset('js/bootstrap-select.min.js') }}"></script> --}}
        <script>
            $(function() {

                // $('.country-select').selectpicker();

                $.validator.addMethod("facebookUrl", function(value, element) {
                    if (value == "") {
                        return true;
                    }
                    var facebookRegx =
                        /(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/;
                    if (!(facebookRegx.test(value))) {
                        return false;
                    }
                    return true;

                }, '{{ __('form.validatemessages.facebookUrl') }}');
                //    ((https?://)?(www\.)?twitter\.com/)?(@|#!/)?([A-Za-z0-9_]{1,15})(/([-a-z]{1,20}))?
                //
                $.validator.addMethod("twitterUrl", function(value, element) {
                    if (value == "") {
                        return true;
                    }
                    let twitterRegex =
                        /(https:\/\/twitter.com\/(?![a-zA-Z0-9_]+\/)([a-zA-Z0-9_]+))/;
                    if (!(twitterRegex.test(value))) {
                        return false;
                    }
                    return true;

                }, '{{ __('form.validatemessages.twitterUrl') }}');

                $.validator.addMethod("instagramUrl", function(value, element) {
                    if (value == "") {
                        return true;
                    }
                    let instagramRegex =
                        /(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/([A-Za-z0-9-_]+)/;
                    if (!(instagramRegex.test(value))) {
                        return false;
                    }
                    return true;

                }, '{{ __('form.validatemessages.instagramUrl') }}');



                var form = $("#contactinfoForm");
                var validator = form.validate({
                    rules: {
                        facebook_link: {
                            required: false,
                            facebookUrl: true,
                        },
                        twitter_link: {
                            required: false,
                            twitterUrl: true,
                        },
                        instagram_link: {
                            required: false,
                            instagramUrl: true,
                        },
                    },
                });

                form.submit(function() {
                    if (form.valid()) {
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);

                        $.ajax({
                            type: "POST",
                            url: form.attr('action'),
                            data: form.serialize(),
                            dataType: "json",
                            success: function(response) {
                                showAlertSuccess(response.message);
                                updateAccountProgress(response.accountPerc);
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });

                        return false;
                    }
                    return false;
                });



            });

        </script>
    @endsection
</x-layout>
