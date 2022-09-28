<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.accountSettings') }}">
                {{ __('main.accountSettings') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('operator.judgeService')}}">
                خدمة فحص المباني الجاهزة
            </a>
        </li>
    </x-breadcrumb>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-operator.sidebar>
                <x-slot name="linkselected">
                    test-build
                </x-slot>
            </x-operator.sidebar>
            <div class="col-lg-9 pl-xl-3">
                <div class="border-radius-8 bg-white d-flex flex-column p-md-5 py-4 px-3">
                    <x-alert />
                    <form id="requestJudgeService"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row account-judge-service">
                            <div class="col-md-8">
                                <h1 class="mb-2">خدمة فحص المباني الجاهزة</h1>
                                <p class="account-judge-service-note mb-4">لتتمع بتقديم خدمة فحص المباني الجاهزة للعملاء يجب ارسال
                                    شهادة
                                    فحص المباني الجاهزة
                                    سيتم تفعيل الخدمة من قبل إدارة المنصة في حالة التأكد من الشهادة المرفقة
                                </p>
                                <div>
                                    @if ($status)
                                        <div>
                                            <p class="account-judge-service-title-status">
                                                حالة الخدمة
                                            </p>
                                            <p class="account-judge-service-service-status">
                                                تم التأكد من الشهادة الخدمة مفعلة حالياً
                                            </p>
                                            <img class="mt-2 ml-4" src="{{ asset('images/service-confirmed.svg') }}"
                                                alt="">
                                        </div>
                                    @else
                                        <p class="account-judge-service-title-status">
                                            حالة الخدمة
                                        </p>
                                        <p class="account-judge-service-service-status">
                                            الخدمة غير مفعله حالياً
                                        </p>
                                        <img class="mt-2 ml-4" src="{{ asset('images/service-unconfirmed.svg') }}"
                                            alt="">
                                    @endif
                                </div>
                            </div>
                            @if ($status == false && $request_status == false)
                                <div class="col-md-3 offset-md-1">
                                    <label for="arbitration"
                                        class="arbitration-file-upload d-flex flex-column justify-content-center align-items-center">
                                        <input type="file" id="arbitration" style="display: none;" name="arbitration"
                                            accept="application/pdf, image/jpeg" required data-error="#errorNum1" />
                                        <div class="text-center SelectPreviewBox">
                                            <img src="{{ asset('images/upload-icon.svg') }}" class="mb-4">
                                            <span class="title mb-2">شهادة فحص المباني الجاهزة</span>
                                            <span class="file-type font-Roboto">PDF-jpg</span>
                                        </div>
                                        <div class="FilePreview" style="display: none">
                                            <div class=" align-items-center d-flex flex-row px-3">
                                                <span class="mr-2 FilePreview-img">
                                                    <img src="http://manasa.test/images/jpg.png" alt="">
                                                </span>
                                                <span class="filename FilePreview-name">اسم الملف</span>
                                            </div>
                                        </div>
                                    </label>
                                    <p class="arbitration-attach-file-desc text-center mt-1">قم بارفاق شهادة فحص المباني الجاهزة</p>
                                    <span id="errorNum1"></span>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit"
                                                class="btn btn-primary has-shadow btn-46 d-inline-block">
                                                <span class="text">إرسال طلب التفعيل</span>
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
                            @endif
                            @if ($request_status && $status == false)
                                <div class="col-md-12 mt-4">
                                    <p class="account-judge-service-note text-danger">
                                        طلب تفعيل خدمة فحص المباني الجاهزة قيد المراجعة من قبل إدارة المنصة
                                    </p>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(function() {
                function openFile(file) {
                    var extension = file.substr((file.lastIndexOf('.') + 1));
                    switch (extension) {
                        case 'jpg':
                            return "<img src='{{ asset('images/jpg.png') }}' alt=''>";
                            break; // the alert ended with pdf instead of gif.
                        case 'pdf':
                            return "<img src='{{ asset('images/pdf.png') }}' >";
                            break;
                        default:
                            alert('FILE MISSTYPE');
                    }
                };

                $("#arbitration").change(function(e) {
                    // console.log($(this).val());
                    if ($(this).val().length == 0) {
                        $('.SelectPreviewBox').css('display', 'block');
                        $('.FilePreview').css('display', 'none');
                    } else {
                        var FileTypeImg = openFile($(this).val());
                        // console.log(FileTypeImg);
                        var filename = e.target.files[0].name.split('.').slice(0, -1).join('.')
                        console.log(filename);
                        $('.SelectPreviewBox').css('display', 'none');
                        $('.FilePreview').css('display', 'block');

                        $('.FilePreview .filename').text(filename);
                        $('.FilePreview .FilePreview-img').html(FileTypeImg);
                    }

                });

                var form = $("#requestJudgeService");
                var formValidator = form.validate({
                    ignore: [],
                    errorPlacement: function(error, element) {
                        var placement = $(element).data('error');
                        if (placement) {
                            $(placement).append(error)
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });

                form.submit(function() {
                    if (form.valid())
                        $(this).find("button[type='submit']").addClass('loading').prop('disabled', true);
                });

                $("#arbitration").change(function() {
                    formValidator.element("#arbitration");
                });

            });

        </script>
    @endsection
</x-layout>
