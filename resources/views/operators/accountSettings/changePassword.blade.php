<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.accountSettings') }}">
                {{ __('main.accountSettings') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.changePassword') }}">
                تعديل كلمة المرور
            </a>
        </li>
    </x-breadcrumb>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-operator.sidebar>
                <x-slot name="linkselected">
                    change-password
                </x-slot>
            </x-operator.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0">
                <div class="border-radius-8 bg-white d-flex justify-content-center p-md-5 p-3">
                    <x-alert />
                    <form action="{{ route('operator.changePassword') }}" class="mt-1" id="changePassword"
                        method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>تعديل كلمة المرور</h1>
                            </div>
                            <div class="col-md-6 order-2 order-md-1 mt-3 ">
                                <div class="form-group">
                                    <label for="password">{{ __('form.current_password') }}</label>
                                    <span class="has-icon lock-icon">
                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword"
                                            required placeholder="{{ __('form.current_password') }}">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('form.new_password') }}</label>
                                    <span class="has-icon lock-icon">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required placeholder="*********">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('form.confirm_new_password') }}</label>
                                    <span class="has-icon lock-icon">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required placeholder="*********">
                                    </span>
                                </div>

                            </div>
                            <div class="col-md-5 mb-4 mb-md-0 offset-md-1 order-1 order-md-2 text-center mt-3 ">
                                <img class="mt-4" src="{{ asset('images/change-password.svg') }}" alt="">
                                <p class="passwordresetwarning mt-2"> في حالة نسيان كلمة المرور الحالية يمكنك
                                    طلب ارسال كلمة المرور الي البريد الالكتروني
                                    المستخدم في عملية انشاء الحساب</p>
                            </div>
                            <div class="col-md-6 order-3 order-md-3 mt-4 mt-md-0">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
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
                                    <div class="col-md-5">
                                        <a href="#" class="UserforgetPassword">{{ __('form.forgotpassword') }}</a>
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


                var form = $("#changePassword");
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
                                form.trigger("reset");
                                validator.resetForm();
                            },
                            error: function(request, status, error) {
                                // console.log(status);
                                // if (request.status == 422) {
                                var errors = request.responseJSON;
                                var errorMessage = '';
                                $.each(errors.errors, function(key, value) {
                                    // console.log(key);
                                    errorMessage += value + "<br>";
                                });
                                showAlertError(errorMessage);
                                // }
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
