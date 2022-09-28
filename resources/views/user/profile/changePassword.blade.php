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
                <div class="bg-white flex-fill d-flex justify-content-center">
                    <x-alert />
                    <div class="col-md-10 d-flex flex-column justify-content-center">
                        <form action="{{ route('user.profile.password') }}" class="mt-1" id="changePassword"
                            method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>تعديل كلمة المرور</h1>
                                </div>
                                <div class="col-md-6 order-2 order-md-1 mt-3 ">
                                    <div class="form-group">
                                        <label for="password">{{ __('form.current_password') }}</label>
                                        <span class="has-icon lock-icon">
                                            <input type="password" class="form-control" id="oldPassword"
                                                name="oldPassword" required
                                                placeholder="{{ __('form.current_password') }}">
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
    </div>
    @section('styles')
        {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}"> --}}
    @endsection
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
