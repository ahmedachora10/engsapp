@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        وسائل التواصل
                    </h3>
                </div>
                <!--begin::Form-->
                <form id="website_links_form" method="POST" action="{{ route('admin.settings.links') }}">
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
                        <div class="form-group">
                            <label>فيسبوك</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fab la-instagram"></i></span></div>
                                <input type="text" name="facebook" class="form-control text-left" style="direction: ltr;"
                                    placeholder="رابط الفيسبوك" value="{{ $website_links->facebook }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>انستجرام</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fab la-facebook-f "></i></span></div>
                                <input type="text" name="instagram" class="form-control text-left" style="direction: ltr;"
                                    placeholder="رابط انستجرام" value="{{ $website_links->instagram }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>سناب شات</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fab la-snapchat"></i></span></div>
                                <input type="text" name="snapchat" class="form-control text-left" style="direction: ltr;"
                                    placeholder="رابط سناب شات" value="{{ $website_links->snapchat }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>تويتر</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fab la-twitter"></i></span></div>
                                <input type="text" name="twitter" class="form-control text-left" style="direction: ltr;"
                                    placeholder="رابط تويتر" value="{{ $website_links->twitter }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="separator separator-dashed my-10"></div>
                            <label>العنوان</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="la la-map-marked-alt"></i></span></div>
                                <input type="text" name="contactus_address" class="form-control" placeholder=""
                                    value="{{ $website_links->contactus_address }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>رقم الجوال</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="la la-volume-control-phone"></i></span></div>
                                <input type="text" name="contactus_phone" class="form-control text-left"
                                    style="direction: ltr;" placeholder=""
                                    value="{{ $website_links->contactus_phone }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>الايميل</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="la la-mail-bulk"></i></span></div>
                                <input type="text" name="contactus_email" class="form-control text-left"
                                    style="direction: ltr;" placeholder=""
                                    value="{{ $website_links->contactus_email }}" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{-- <script src="{{ asset('adminAssets/assets/js/pages/crud/forms/widgets/nouislider.js') }}"></script> --}}
    <script>
        $(function() {
            FormValidation.formValidation(
                document.getElementById('website_links_form'), {
                    fields: {

                        facebook: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        instagram: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        snapchat: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        twitter: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        contactus_address: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        contactus_phone: {
                            validators: {
                                notEmpty: {
                                    message: 'الحقل إلزامي'
                                },
                            }
                        },
                        contactus_email: {
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
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    }
                }
            );

        });

    </script>
@endpush
