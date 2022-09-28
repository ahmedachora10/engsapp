@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        سلايدر
                    </h3>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.slider.list') }}" class="btn btn-light-primary font-weight-bolder">قائمة
                            السلايدر</a>
                    </div>
                </div>
                <!--begin::Form-->
                <form id="addeditSlide" data-editMode="{{ isset($slide) ? 'enabled' : 'disabled' }}"
                    action="{{ route('admin.slider.addedit', ['id' => $id]) }}" enctype="multipart/form-data"
                    method="POST">
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
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">الحالة
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <span class="switch switch-icon">
                                    <label>
                                        <input type="checkbox"
                                            {{ isset($slide) ? ($slide->isenabled == true ? 'checked="checked"' : '') : '' }}
                                            name="isenabled" />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">الترتيب
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-1 col-md-1 col-4">
                                <input type="number" id="order" min="1" name="order" class="form-control" placeholder=""
                                    value="{{ isset($slide) ? $slide->order : '' }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">العنوان
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة العربية</span>
                                <input type="text" id="title_ar" name="title_ar" class="form-control" placeholder=""
                                    value="{{ isset($slide) ? $slide->title_ar : '' }}" />
                            </div>
                            <div class="col-lg-10 offset-lg-2 mt-4 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                <input type="text" id="title_en" name="title_en" class="form-control" placeholder=""
                                    value="{{ isset($slide) ? $slide->title_en : '' }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">الرابط التشعبي
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <input type="text" id="linkTo" name="linkTo" class="form-control" placeholder=""
                                    value="{{ isset($slide) ? $slide->linkTo : '' }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">عنوان الزر
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة العربية</span>
                                <input type="text" id="button_text_ar" name="button_text_ar" class="form-control"
                                    placeholder="" value="{{ isset($slide) ? $slide->button_text_ar : '' }}" />
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-4 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                <input type="text" id="button_text_en" name="button_text_en" class="form-control"
                                    placeholder="" value="{{ isset($slide) ? $slide->button_text_en : '' }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">وصف قصير
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة العربية</span>
                                <input type="text" id="small_desc_ar" name="small_desc_ar" class="form-control"
                                    placeholder="" value="{{ isset($slide) ? $slide->title_ar : '' }}" />
                            </div>
                            <div class="col-lg-10 offset-lg-2 mt-4 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                <input type="text" id="small_desc_en" name="small_desc_en" class="form-control"
                                    placeholder="" value="{{ isset($slide) ? $slide->title_en : '' }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">التفاصيل
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة العربية</span>
                                <textarea class="form-control autosise_textarea" id="desc_ar" rows="3" name="desc_ar"
                                    style="overflow: hidden; overflow-wrap: break-word; resize: none;">{{ isset($slide) ? $slide->desc_ar : '' }}</textarea>
                            </div>
                            <div class="col-lg-10 offset-lg-2 mt-4 col-md-12 col-sm-12">
                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                <textarea class="form-control autosise_textarea" id="desc_en" rows="3" name="desc_en"
                                    style="overflow: hidden; overflow-wrap: break-word; resize: none;">{{ isset($slide) ? $slide->desc_en : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">
                                الصورة
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10 col-md-12 col-sm-12">
                                <div class="image-input image-input-outline" id="kt_slide_image"
                                    style="background-image: url({{ asset('adminAssets/assets/media/users/blank.png') }})">
                                    @php
                                        $previous_Image = null;
                                        if (isset($slide)) {
                                            $previous_Image = 'style="background-image: url(' . asset('storage/' . $slide->image) . ')"';
                                        }
                                    @endphp
                                    <div class="image-input-wrapper" {!! isset($previous_Image) ? $previous_Image : '' !!}>
                                    </div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="اختيار صورة">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="slide_image" accept=".jpg, .jpeg" />
                                        <input type="hidden" name="slide_image_remove" />
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

@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script>
    <script>
        $(function() {
            var avatar = new KTImageInput('kt_slide_image');

            var demo1 = $('.autosise_textarea');
            autosize(demo1);
            autosize.update(demo1);

            var validation = FormValidation.formValidation(
                document.getElementById('addeditSlide'), {
                    fields: {

                        order: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        title_ar: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        title_en: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        linkTo: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        button_text_ar: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        button_text_en: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        small_desc_ar: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        small_desc_en: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        desc_ar: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        desc_en: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
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

            if ($('#addeditSlide').attr('data-editMode') == 'disabled') {
                validation.addField('slide_image', {
                    validators: {
                        notEmpty: {
                            message: 'الحقل الزامي'
                        }
                    }
                });
            }

            $("#kt_login_signin_submit").on("click", function(e) {
                // e.preventDefault();
                validation.validate().then(function(status) {
                    if (status == "Valid") {
                        var btn = KTUtil.getById("kt_login_signin_submit");
                        KTUtil.btnWait(btn, "spinner spinner-left spinner-white",
                            "يرجى الانتظار");
                        $("#addeditSlide").submit();

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

        });

    </script>
@endpush
