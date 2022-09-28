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
                        <form action="{{ route('user.profile.bank') }}" class="mt-1" id="bankinfoForm" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>بينات الحساب البنكي</h1>
                                </div>
                                <div class="col-md-6 order-2 order-md-1">
                                    <div class="text bankinfo">
                                        <p class="mt-4 text-1">بيانات الحساب البنكي</p>
                                        <p class="text-2">سيتم تحويل المبلغ الى الحساب البنكي المدخل</p>
                                    </div>
                                    <div class="form-group ">
                                        <select class="custom-select" required id="bank_id" name="bank_id">
                                            @foreach ($banks as $bank)
                                                @if ($loop->first)
                                                    @if (!isset($userBank))
                                                        <option value="" disabled selected>اختر البنك</option>
                                                    @endif
                                                @else
                                                    @if (isset($userBank) && $userBank == $bank->id)
                                                        <option selected value="{{ $bank->id }}">
                                                            {{ $bank->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $bank->id }}">
                                                            {{ $bank->name }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="form-label" for="email">
                                            رقم الحساب البنكي الخاص بك
                                            <span>IBAN</span>
                                        </label>
                                        <span class="has-icon card-icon">
                                            <input type="text" class="form-control font-Roboto" id="iban_code"
                                                name="iban_code" required value="{{ $iban_code }}" placeholder="">
                                        </span>
                                    </div>

                                </div>
                                <div class="col-md-5 mb-4 mb-md-0 offset-md-1 order-1 order-md-2 text-center">
                                    <img class="mt-4" src="{{ asset('images/bank-card.svg') }}" alt="">
                                </div>
                                <div class="col-md-12 order-3 order-md-3 mt-4 mt-md-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit"
                                                class="btn btn-primary has-shadow btn-46 d-inline-block">
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
    </div>
    @section('styles')
        {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}"> --}}
    @endsection
    @section('scripts')
        {{-- <script src="{{ asset('js/bootstrap-select.min.js') }}"></script> --}}
        <script>
            $(function() {

                // $('.country-select').selectpicker();


                var form = $("#bankinfoForm");
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
                                updateBankInfoProgress(
                                "{{ asset('images/check-small.svg') }}");
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
