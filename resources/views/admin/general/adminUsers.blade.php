@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">مستخدمي لوحة التحكم</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a id="AddNewUser" href="#" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>مستخدم جديد</a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="table-responsive">
                        <table class="table table-separate table-head-custom table-hover table-checkable" id="kt_datatable"
                            style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th class="min-w-120px">اسم المستخدم</th>
                                    <th>الايميل</th>
                                    <th class="min-w-125px">الصلاحيات</th>
                                    <th class="min-w-60px">تاريخ الانشاء</th>
                                    <th class="min-w-60px">الحالة</th>
                                    <th class="min-w-100px">الاجراءات</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="showModel" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModel">تفاصيل الوظيفة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- @include('admin.templates.addNewUser') --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnAddEditUser" class="btn btn-primary font-weight-bold">حفظ</button>
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script>
    <script>
        $(function() {

            var table = $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('adminAssets/assets/plugins/custom/datatables/Arabic.json') }}"
                },
                ajax: {
                    url: "{{ route('admin.adminusers.controlUsers') }}",
                    type: "POST",
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email',

                    },
                    {
                        data: 'user_permissions',
                        name: 'user_permissions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                var template = '';
                                $.each(data, function(key, value) {
                                    template +=
                                        '<span class="label label-lg font-weight-bolder text-dark-50 label-light label-inline h-auto mb-3 mr-3">' +
                                        value.name + '</span>';
                                });
                                return template;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'active',
                        name: 'active',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                var active =
                                    '<span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>';
                                var unactive =
                                    '<span class="label label-lg font-weight-bold label-light-danger label-inline">غير مفعل</span>';
                                var template = data == false ? unactive : active;

                                return template;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [4, "desc"]
                ]
            });


            // $('#myModal').modal('show');

            // Demo 2
            // var btn = KTUtil.getById("test");
            // console.log(btn);
            var validation;
            var btn;
            $(document).on('click', '#AddNewUser', function(e) {

                btn = KTUtil.getById($(this).attr('id'));

                KTUtil.btnWait(btn, "spinner spinner-white spinner-left", "يرجى الانتظار ...");
                AddEditAdminUserForm(null);
                // $.ajax({
                //     type: "GET",
                //     url: "{{ route('admin.adminusers.addedituser') }}",
                //     dataType: "html",
                //     success: function(response) {
                //         // console.log(response);
                //         $('#showModel').find('.modal-body').html(response);
                //         $('#showModel').modal('show');
                //         dualList();
                //         validation = FormValidation.formValidation(
                //             KTUtil.getById("AddEditUserForm"), {
                //                 fields: {
                //                     name: {
                //                         validators: {
                //                             notEmpty: {
                //                                 message: "كلمة المرور مطلوبة",
                //                             },
                //                         },
                //                     },
                //                     email: {
                //                         validators: {
                //                             notEmpty: {
                //                                 message: "حقل الايميل مطلوب",
                //                             },
                //                             emailAddress: {
                //                                 message: "الرجاء ادخال ايميل بشكل صحيح",
                //                             },
                //                         },
                //                     },
                //                     password: {
                //                         validators: {
                //                             notEmpty: {
                //                                 message: "كلمة المرور ",
                //                             },
                //                         },
                //                     },

                //                 },
                //                 plugins: {
                //                     trigger: new FormValidation.plugins.Trigger(),
                //                     bootstrap: new FormValidation.plugins.Bootstrap(),
                //                     autoFocus: new FormValidation.plugins.AutoFocus(),
                //                     submitButton: new FormValidation.plugins.SubmitButton(),
                //                     // defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                //                 },
                //             }
                //         );

                //     },
                //     complete: function() {
                //         KTUtil.btnRelease(btn);
                //     }
                // });

            });

            function AddEditAdminUserForm(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.adminusers.addedituser') }}",
                    data: {
                        user_id: id
                    },
                    dataType: "html",
                    success: function(response) {
                        // console.log(response);
                        $('#showModel').find('.modal-body').html(response);
                        $('#showModel').modal('show');
                        dualList();
                        validation = FormValidation.formValidation(
                            KTUtil.getById("AddEditUserForm"), {
                                fields: {
                                    name: {
                                        validators: {
                                            notEmpty: {
                                                message: "كلمة المرور مطلوبة",
                                            },
                                        },
                                    },
                                    email: {
                                        validators: {
                                            notEmpty: {
                                                message: "حقل الايميل مطلوب",
                                            },
                                            emailAddress: {
                                                message: "الرجاء ادخال ايميل بشكل صحيح",
                                            },
                                        },
                                    },

                                },
                                plugins: {
                                    trigger: new FormValidation.plugins.Trigger(),
                                    bootstrap: new FormValidation.plugins.Bootstrap(),
                                    autoFocus: new FormValidation.plugins.AutoFocus(),
                                    submitButton: new FormValidation.plugins.SubmitButton(),
                                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                                },
                            }
                        );

                        if (id == null) {
                            validation.addField('password', {
                                validators: {
                                    notEmpty: {
                                        message: 'الحقل الزامي'
                                    }
                                }
                            });
                        }

                    },
                    complete: function() {
                        KTUtil.btnRelease(btn);
                    }
                });
            }

            $(document).on('click', '.btnEditUser', function(e) {
                btn = KTUtil.getById($(this).attr('id'));
                var user_id = $(this).attr('data-id');
                KTUtil.btnWait(btn, "spinner spinner-dark spinner-right", " ");
                // setTimeout(function() {
                AddEditAdminUserForm(user_id);
                // }, 1000);

                // $.ajax({
                //     type: "GET",
                //     url: jobUrl,
                //     dataType: "json",
                //     success: function(response) {
                //         // console.log(response);
                //         $('#showModel').find('.modal-body').html(response
                //             .jobDetails);
                //         $('#showModel').modal('show');

                //     },
                //     complete: function() {
                //         KTUtil.btnRelease(btn);
                //     }
                // });

            });





            $('#showModel').on('hidden.bs.modal', function(event) {
                $(this).find('.modal-body').html('');
                $("#AddEditUserForm").trigger("reset");
                validation.resetForm();
            })



            $(document).on('click', '.removeBtn', function(e) {
                e.preventDefault();
                var userId = $(this).attr('data-id');
                var row = $(this).parents('tr');
                Swal.fire({
                    title: "هل انت متاكد ؟",
                    text: "سيتم حذف الوظيفة بشكل نهائئ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "نعم",
                    cancelButtonText: "الغاء الامر",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.adminusers.delete') }}",
                            data: {
                                userId: userId
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                Swal.fire({
                                    title: "تم عملية الحذف بنجاح!",
                                    icon: "success",
                                    timer: 2500,
                                    onOpen: function() {
                                        Swal.showLoading()
                                    }
                                });
                            },
                            complete: function() {
                                table.ajax.reload(null, false);
                            }
                        });
                        // result.dismiss can be "cancel", "overlay",
                        // "close", and "timer"
                    } else if (result.dismiss === "cancel") {

                    }
                });
            });



            $('#btnAddEditUser').on('click', function(e) {
                var form = $("#AddEditUserForm");
                validation.validate().then(function(status) {
                    if (status == "Valid") {
                        var btn = KTUtil.getById("btnAddEditUser");
                        KTUtil.btnWait(btn, "spinner spinner-left spinner-white",
                            "جاري الحفظ ..");
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url: form.attr('action'),
                            data: form.serialize(),
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                Swal.fire({
                                    title: "تم عملية الحفظ بنجاح!",
                                    icon: "success",
                                    timer: 2500,
                                    onOpen: function() {
                                        Swal.showLoading()
                                    }
                                });
                                $('#showModel').modal('hide');
                                table.ajax.reload(null, false);
                            },
                            error: function(response) {
                                var text = '';

                                $.each(response.responseJSON.errors,
                                    function(key, value) {
                                        text += value + "<br>";
                                    });

                                swal.fire({
                                    title: 'يرجى التاكد من البيانات المدخلة',
                                    html: text,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "موافق",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary",
                                    },
                                }).then(function() {
                                    // KTUtil.scrollTop();
                                });
                            },
                            complete: function() {
                                KTUtil.btnRelease(btn);
                            }
                        });
                        return false;
                        // e.preventDefault();

                    }
                });
            });


            function dualList() {
                // Dual Listbox
                var permissions = document.getElementById('kt_dual_listbox_2');

                // init dual listbox
                var dualListBox = new DualListbox(permissions, {
                    // addEvent: function(value) {
                    //     console.log(value);
                    // },
                    // removeEvent: function(value) {
                    //     console.log(value);
                    // },
                    availableTitle: "الصلاحيات",
                    selectedTitle: "الصلاحيات الممنوحة",
                    addButtonText: "<i class='flaticon2-back'></i>",
                    removeButtonText: "<i class='flaticon2-next'></i>",
                    addAllButtonText: "<i class='flaticon2-fast-back'></i>",
                    removeAllButtonText: "<i class='flaticon2-fast-next'></i>"
                });

                dualListBox.search.classList.add('dual-listbox__search--hidden');
            }

        });

    </script>
@endpush
@push('styles')
    <style>
        .dual-listbox .dual-listbox__available,
        .dual-listbox .dual-listbox__selected {
            height: 240px !important;
        }

        .dual-listbox .dual-listbox__container .dual-listbox__title {
            font-weight: bold !important;
        }

    </style>
@endpush
