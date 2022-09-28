<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    profile
                </x-slot>
            </x-user.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0">
                <div class="mb-3 mt-1">
                    <h5 class="main-text">الملف الشخصي</h5>
                </div>
                <div class="d-flex dashboard-backbutton-container flex-column justify-content-center">
                    <a class="btn-back text-white" href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                </div>
                <div class="bg-white flex-fill d-flex justify-content-center alert-custom">
                    <x-alert />
                    <div class="col-md-10 d-flex flex-column justify-content-center">
                        <div class="align-items-center d-flex flex-column flex-md-row justify-content-between">
                            <div class="text">
                                <h1>معلومات الاتصال</h1>
                                <p>معلومات التواصل الخاصه بك</p>
                            </div>
                        </div>
                        <form action="{{ route('user.profile.contact') }}" class="mt-3 " id="contactinfoForm"
                            method="POST">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="email">{{ __('form.username') }}</label>
                                    <span class="has-icon email-icon">
                                        <input type="email" class="form-control" id="email" name="email" required
                                            value="{{ $email }}"
                                            placeholder="{{ __('form.placeholders.email') }}">
                                    </span>

                                </div>
                                <div class="col-sm-6 mt-3 mt-md-0">
                                    <label class="form-label"
                                        for="userphone_number">{{ __('form.mobilenumber') }}</label>
                                    <div class="has-icon has-dropdown-number phone-icon">
                                        <input type="text" class="form-control" id="userphone_number"
                                            name="userphone_number" required value="{{ $phone_number }}"
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
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-sm-6 mt-3 mt-md-0">
                                    <label class="form-label"
                                        for="userwhatsapp_number">{{ __('form.whatsapp_number') }}</label>
                                    <div class="has-icon has-dropdown-number phone-icon">
                                        <input type="text" class="form-control" id="userwhatsapp_number"
                                            name="userwhatsapp_number"  value="{{ $whatsapp_number }}"
                                            data-rule-number="true" placeholder="{{ __('form.whatsapp_number') }}">
                                        <div class="selector-container">
                                            <select class="custom-select" id="whatsapp_number_country_code"
                                                name="whatsapp_number_country_code">
                                                @foreach ($countriesCode as $country)
                                                    @if (isset($defaultCode) && $country->code == $defaultCode && $whatsapp_number_country_code == null)
                                                        <option value="{{ $defaultCode }}" selected>
                                                            {{ $defaultCode }}</option>
                                                    @elseif ($whatsapp_number_country_code == $country->code)
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
                            </div>
                            <div class="row ">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('styles')
        {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}"> --}}
    @endsection
    @section('scripts')
        {{-- <script src="{{ asset('js/bootstrap-select.min.js') }}"></script> --}}
        <script>
            $(function() {

                // $('.country-select').selectpicker();


                var form = $("#contactinfoForm");
                var validator = form.validate();

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
