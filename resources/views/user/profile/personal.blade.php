<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    profile
                </x-slot>
            </x-user.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5>الملف الشخصي</h5>
                </div>
                <div class="d-flex dashboard-backbutton-container flex-column justify-content-center">
                    <a class="btn-back text-white" href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                </div>
                <div class="bg-white flex-fill d-flex justify-content-center">
                    <x-alert />
                    <div class="col-md-10 d-flex flex-column justify-content-center">
                        <div class="align-items-center d-flex flex-column flex-md-row justify-content-between">
                            <div class="text">
                                <h1>المعلومات الشخصية</h1>
                                <p>الرجاء اكمال معلومات الشخصية</p>
                            </div>
                            <div class="user-img text-center">
                                <label for="avatar" class="image-container">
                                    <input type="file" id="avatar" style="display: none;" name="avatar"
                                        accept="image/png, image/jpeg" />
                                    <img id="account-img"
                                        src="{{ route('imagecache', ['filename' => $avatar ? $avatar : asset('images/profile-img.jpg'), 'template' => 'profile']) }}"
                                        alt="">
                                    <span
                                        class="align-items-center camera-container d-flex flex-column justify-content-center">
                                        <img src="{{ asset('images/camera.svg') }}" alt="">
                                    </span>
                                    <div class="loading-animate">
                                        <div class="lds-ellipsis">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                </label>
                                <p>صورة المستخدم</p>
                            </div>
                        </div>
                        <form action="{{ route('user.profile.personal') }}" class="mt-3 message-feedback"
                            id="personalDataForm" method="POST">

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nameforuser">{{ __('form.nameforuser') }}</label>
                                    <span class="has-icon person-icon">
                                        <input type="text" class="form-control" id="nameforuser" name="nameforuser"
                                            required value="{{ $name }}"
                                            placeholder="{{ __('form.nameforuser') }}">
                                    </span>
                                </div>
                                <div class="col-sm-6 mt-3 mt-md-0">
                                    <label class="form-label" for="text">نوع الحساب</label>
                                    <input type="text" class="form-control" disabled id="userType" name="userType"
                                        value="{{ $userType }}">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="typeofcompany">الدولة</label>
                                        {{-- <div class="has-icon card-icon"> --}}
                                        <select class="custom-select" required id="usercountry" name="usercountry">
                                            @foreach ($countries as $country)
                                                @if ($loop->first)
                                                    @if (!isset($userCountry))
                                                        <option value="" disabled selected>اختر الدولة</option>
                                                    @endif
                                                @else
                                                    @if (isset($userCountry) && $userCountry == $country->id)
                                                        <option selected value="{{ $country->id }}">
                                                            {{ $country->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $country->id }}">
                                                            {{ $country->name }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3 mt-md-0">
                                    <label class="form-label" for="text">الجنسية</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality" required
                                        placeholder="ادخل الجنسية" value="{{ $nationality }}">
                                </div>
                            </div>
                            <div class="mx-auto col-md-6">
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


                var form = $("#personalDataForm");
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





                $('#avatar').on("change", function(e) {

                    var formData = new FormData();
                    var avatarInputFile = $('#avatar');
                    var files = avatarInputFile[0].files;
                    var imgContainer = $('.image-container');

                    if (files.length > 0) {
                        formData.append('avatarFile', files[0]);
                        imgContainer.addClass('loading');
                        avatarInputFile.attr("disabled", "disabled");
                        $.ajax({
                            type: "POST",
                            url: "{{ route('user.profile.img') }}",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                if (response.status == true) {
                                    $('#account-img').attr('src', response.imageUrl);
                                    updateAccountProgress(response.accountPerc);
                                }
                            },
                            complete: function() {
                                imgContainer.removeClass('loading');
                                avatarInputFile.removeAttr("disabled");
                            }
                        });
                    }
                });
            });

        </script>
    @endsection
</x-layout>
