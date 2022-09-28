<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{route('operator.accountSettings')}}">
                {{ __('main.accountSettings') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('operator.accountSettings')}}">
                {{ __('main.accountSettings') }}
            </a>
        </li>
    </x-breadcrumb>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-operator.sidebar>
                <x-slot name="linkselected">
                    account-settings
                </x-slot>
            </x-operator.sidebar>
            <div class="col-lg-9 pl-xl-3">
                <div class="border-radius-8 bg-white d-flex flex-column p-md-5 py-4 px-3">
                    <x-alert />
                    <form id="operatorSettings" action="{{ route('operator.accountSettings') }}" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="mb-4">
                                    معلومات الحساب
                                </h1>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center align-items-center">
                                <div class="user-img text-center">
                                    <label for="avatar" class="image-container">
                                        <input type="file" id="avatar" style="display: none;" name="avatar"
                                            accept="image/png, image/jpeg" />
                                        <img id="account-img"
                                            src="{{ auth()->user()->profile_img ? route('imagecache', ['filename' => auth()->user()->profile_img, 'template' => 'profile']) : asset('images/logo.jpg') }}"
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
                                    <p>صورة الشخصية</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="account-confirmation-status text-center px-3 py-4">
                                    @if ($confirmed)
                                        <img src="{{ asset('images/check-small.svg') }}" alt="">
                                        <h3 class="mt-2">الحساب مؤكد</h3>

                                    @else
                                        <img src="{{ asset('images/empty-check.svg') }}" alt="">
                                        <h3 class="mt-2">الحساب غير مؤكد</h3>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            @if (auth()->user()->user_type == 'company')
                                @include('operators.accountSettings.companyInfoForm',['companyAdmissions'=>$companyAdmissions])
                            @else
                                {{-- {{auth()->user()->user_type}} --}}
                                @include('operators.accountSettings.freelancerInfoForm')
                            @endif

                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <label for="bio_text">السيرة الذاتية</label>
                                    <textarea id="bio_text" name="bio_text" class="form-control p-3" cols="30" rows="6"
                                        required>{{ $bio_text }}</textarea>
                                    <p style="color:#858585;">
                                          ملاحظة : السيرة الذاتية بحد اقصى 100 كلمة <span id="count_cont" style="color: #cc7b7b;display: none"> -- عدد الكلمات <span id="words_count"></span> كلمة --</span>
                                    </p>
                                    <p style="color: #d30000">تنبيه : الرجاء عدم كتابة رقم جوال او بريد إلكتروني</p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
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
        <script>
            function check_words(e) {
                var BACKSPACE  = 8;
                var DELETE     = 46;
                var MAX_WORDS  = 100;
                var valid_keys = [BACKSPACE, DELETE];
                var words      = this.value.split(' ');

                if(words.length){
                    $('#count_cont').show();
                    document.getElementById('words_count').innerText=words.length;
                }else{
                    $('#count_cont').hide();
                }
                if (words.length >= MAX_WORDS && valid_keys.indexOf(e.keyCode) == -1) {
                    e.preventDefault();
                    words.length = MAX_WORDS;
                    this.value = words.join(' ');
                }
            }

            var textarea = document.getElementById('bio_text');
            textarea.addEventListener('keydown', check_words);
            textarea.addEventListener('keyup', check_words);
            $(function() {


                var form = $("#operatorSettings");
                var validator;
                if ($('#companylicencefile').length > 0) {
                    validator = form.validate({
                        rules: {
                            companylicencefile: {
                                accept: "image/jpeg,application/pdf"
                            },

                        },
                        messages: {
                            companylicencefile: {
                                accept: "{{ __('form.validatemessages.pdfjpg') }}"
                            },

                        },
                    });
                } else {
                    validator = form.validate({
                        rules: {

                            membershipattachment: {
                                accept: "image/jpeg,application/pdf"
                            },
                        },
                        messages: {
                            membershipattachment: {
                                accept: "{{ __('form.validatemessages.pdfjpg') }}"
                            }
                        },
                    });
                }


                form.submit(function() {
                    if (form.valid()) {
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);

                        var formData = new FormData();
                        var licenceFile;
                        if ($('#companylicencefile').length > 0)
                            var licenceFile = $('#companylicencefile');
                        else
                            var licenceFile = $('#membershipattachment');


                        var files = licenceFile[0].files;

                        var values = form.serializeArray();
                        $.each(values, function(index, element) {
                            console.log(element);
                            formData.append(element.name, element.value);
                        });

                        if (files.length > 0) {
                            formData.append('licenceFile', files[0]);
                        }
                        // return false;

                        $.ajax({
                            type: "POST",
                            url: form.attr('action'),
                            data: formData,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                showAlertSuccess(response.message);
                                updateAccountProgress(response.accountPerc);
                                updateBioProgress("{{ asset('images/check-small.svg') }}")
                                updateUserActiveStatus(
                                    "{{ asset('images/empty-check.svg') }}");
                                if (response.fileTemplate) {
                                    // console.log(response.fileTemplate);
                                    $('.file-uploaded').html(response.fileTemplate);
                                    $('.file-status').html(
                                        '<img class="mr-2" src="{{ asset('images/empty-check.svg') }}" alt=""><span>غير معتمد</span>'
                                    );
                                }

                                {{--$('.account-confirmation-status').html(--}}
                                {{--    "<img src='{{ asset('images/empty-check.svg') }}'> <h3 class='mt-2'>الحساب غير مؤكد</h3>"--}}
                                {{--);--}}

                                if ($('#companylicencefile').length > 0) {
                                    $('#companylicencefile').val('');
                                    $('#companylicencefile').next('label').html(
                                        "{{ __('form.placeholders.attachmentjpgpdf') }}");
                                } else {
                                    $('#membershipattachment').val('');
                                    $('#membershipattachment').next('label').html(
                                        "{{ __('form.placeholders.attachmentjpgpdf') }}");
                                }
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
