@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        اضافة خبر
                    </h3>
                </div>
                <!--begin::Form-->
                <form id="addeditNewsArticles" data-editMode="{{ isset($post) ? 'enabled' : 'disabled' }}"
                    action="{{ $post_type == 'news' ? route('admin.news.addedit', ['id' => $id]) : route('admin.articles.addedit', ['id' => $id]) }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
                                <div class="alert-icon">
                                    <i class="flaticon-success"></i>
                                </div>
                                <div class="alert-text"> {{ session()->get('success') }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="ki ki-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">اللغة
                            </label>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <select id="lang" name="lang" class="form-control selectpicker">
                                    <option value="ar" {{ isset($post) && $post->lang == 'ar' ? 'selected' : '' }}>العربية
                                    </option>
                                    <option value="en" {{ isset($post) && $post->lang == 'en' ? 'selected' : '' }}>
                                        الانجليزية</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">التاريخ
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <input type="text" class="form-control" id="post_date" name="post_date" readonly="readonly"
                                    placeholder=""
                                    value="{{ isset($post) ? date('d-m-Y', strtotime($post->post_date)) : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">العنوان
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <input type="text" id="title" name="title" class="form-control" placeholder="العنوان"
                                    value="{{ isset($post) ? $post->title : '' }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">وصف قصير
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <textarea class="form-control" id="small_desc" name="small_desc"
                                    rows="3">{{ isset($post) ? $post->small_desc : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row progressbar-row" style="display: none">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <span class="form-text text-muted mb-3">جاري رفع الصورة</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">المحتوى
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <textarea class="summernote" id="kt_summernote_1"
                                    name="content">{{ isset($post) ? $post->content : '' }}</textarea>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">
                                الصورة
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                {{-- <div class="image-input image-input-outline" id="kt_profile_avatar"
                                    style="background-image: url({{ asset('adminAssets/assets/media/users/blank.png') }})">
                                    <div class="image-input-wrapper"
                                        style="background-image: url({{ asset('adminAssets/assets/media/users/300_21.jpg') }})">
                                    </div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="profile_avatar" accept=".jpg, .jpeg" />
                                        <input type="hidden" name="profile_avatar_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div> --}}
                                <div class="image-input image-input-outline" id="kt_post_image"
                                    style="background-image: url({{ asset('adminAssets/assets/media/users/blank.png') }})">
                                    @php
                                        $previous_Image = null;
                                        if (isset($post)) {
                                            $previous_Image = 'style="background-image: url(' . asset('storage/' . $post->image) . ')"';
                                        }
                                    @endphp
                                    <div class="image-input-wrapper" {!! isset($previous_Image) ? $previous_Image : '' !!}>
                                    </div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="اختيار صورة">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="post_image" accept=".jpg, .jpeg" />
                                        <input type="hidden" name="post_image_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="الغاء">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                <span class="form-text text-muted mt-5">الملفات المسموحة: jpg, jpeg.</span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2" id="kt_login_signin_submit">حفظ</button>
                        <button type="reset" class="btn btn-secondary">الغاء الامر</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .note-editor .note-toolbar .note-btn-group {
            height: 30px !important;
        }

        .bootstrap-select .dropdown-toggle .filter-option {
            text-align: right !important;
        }

    </style>
@endpush

@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script>
    <script>
        $(function() {
            var avatar = new KTImageInput('kt_post_image');



            var validation = FormValidation.formValidation(
                document.getElementById('addeditNewsArticles'), {
                    fields: {
                        post_date: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        lang: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        title: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 255,
                                    message: 'الرجاء ادخال نص بطول من 6 الى 100 حرف'
                                },
                            }
                        },
                        small_desc: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 255,
                                    message: 'الرجاء ادخال نص بطول من 6 الى 255 حرف'
                                },
                            }
                        },
                        content: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        // post_image: {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'الحقل إلزامي'
                        //         },
                        //     }
                        // },

                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        // Validate fields when clicking the Submit button
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    }
                }
            );



            $('.summernote').summernote({
                height: 400,
                tabsize: 2,
                callbacks: {
                    onImageUpload: function(files) {
                        console.log(files);
                        sendFile(files[0]);
                    }
                    // onImageUpload: function(files) {
                    //     // upload image to server and create imgNode...
                    //     $summernote.summernote('insertNode', imgNode);
                    // }
                }

            }).on('summernote.change', function(customEvent, contents, $editable) {
                // Revalidate the content when its value is changed by Summernote
                validation.revalidateField('content');
            });

            if ($('#addeditNewsArticles').attr('data-editMode') == 'disabled') {
                validation.addField('post_image', {
                    validators: {
                        notEmpty: {
                            message: 'الحقل الزامي'
                        }
                    }
                });
            }

            // send the file

            function sendFile(file) {
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    type: 'POST',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) myXhr.upload.addEventListener('progress',
                            progressHandlingFunction, false);
                        return myXhr;
                    },
                    url: "{{ route('admin.post.uploadImage') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.progressbar-row').css('display', 'flex');
                    },
                    success: function(response) {
                        // editor.insertImage(welEditable, url);
                        var image = $('<img>').attr('src', response.url);
                        $('.summernote').summernote("insertNode", image[0]);
                        $('.progressbar-row').css('display', 'none');
                        $('.progress-bar').css('width', '0%');
                    },
                    error: function(xhr) {
                        $('.progressbar-row').css('display', 'none');
                    }
                });
            }



            // update progress bar

            function progressHandlingFunction(e) {
                if (e.lengthComputable) {
                    console.log(e.loaded, e.total);
                    var percent = (e.loaded / e.total) * 100;
                    // console.log(perc);

                    $('.progress-bar').css('width', percent + '%');
                    // $('progress').attr({
                    //     value: e.loaded,
                    //     max: e.total
                    // });
                    // // // reset progress on complete
                    // if (e.loaded == e.total) {
                    //     $('.progress-bar').animate({
                    //         width: '0%'
                    //     }, 100);
                    // }
                }
            }

            $("#addeditNewsArticles").on('reset', function(event) {
                $('.summernote').summernote('reset');
            });

            $("#kt_login_signin_submit").on("click", function(e) {
                // e.preventDefault();

                validation.validate().then(function(status) {
                    if (status == "Valid") {
                        console.log('test');
                        var btn = KTUtil.getById("kt_login_signin_submit");
                        KTUtil.btnWait(btn, "spinner spinner-left spinner-white",
                            "يرجى الانتظار");
                        $("#addeditNewsArticles").submit();

                    } else {
                        swal.fire({
                            text: "يرجى التاكد من البيانات المدخلة",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "موافق",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary",
                            },
                        }).then(function() {
                            // KTUtil.scrollTop();
                        });
                    }
                });
            });

            var arrows;
            if (KTUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }

            $('#post_date').datepicker({
                rtl: true,
                format: "dd-mm-yyyy",
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows
            }).on('changeDate', function(e) {
                // Revalidate the date field
                validation.revalidateField('post_date');
            });

        });

    </script>
@endpush
