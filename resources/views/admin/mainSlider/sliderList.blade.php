@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">السلايدر</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.slider.addedit') }}" class="btn btn-primary font-weight-bolder">
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
                            </span>اضافة سلايد</a>
                        <!--end::Button-->
                    </div>
                </div>
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
                    <!--begin: Datatable-->
                    <div class="table-responsive">
                        <table class="table table-separate table-head-custom table-hover table-checkable" id="kt_datatable"
                            style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>العنوان</th>
                                    <th>الرابط التشعبي</th>
                                    <th>الترتيب</th>
                                    <th>الحالة</th>
                                    <th>الاجراءات</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModel">تفاصيل العنصر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {

            var table = $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('adminAssets/assets/plugins/custom/datatables/Arabic.json') }}"
                },
                ajax: {
                    url: "{{ route('admin.slider.list') }}",
                    type: "POST",
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false,
                        searchable: false
                    },
                    // {
                    //     data: 'title_ar',
                    //     name: 'title_ar'
                    // },
                    {
                        data: 'title_ar',
                        name: 'title_ar',
                        render: function(data, type, row) {
                            // console.log(data, type, row);
                            if (type === 'display') {
                                var tempalte =
                                    '<div class="d-flex flex-row align-items-center">' +
                                    '<div class="symbol symbol-40 symbol-light mr-5">' +
                                    '<span class="symbol-label">' +
                                    '<img src="' + row.image +
                                    '" class="h-100 rounded align-self-end" alt="">' +
                                    '</span>' +
                                    '</div>' + data + '</div>';
                                return tempalte;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'linkTo',
                        name: 'linkTo',
                        orderable: false,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                var template = '<a class="font-weight-bold" href="' + data +
                                    '" target="_blank">اضغط هنـا</a>'
                                return template;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'order',
                        name: 'order',
                    },
                    {
                        data: 'isenabled',
                        name: 'isenabled',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                var disabled =
                                    '<span class="label label-lg font-weight-boldlabel-light-primary label-inline">غير فعال</span>';
                                var enabled =
                                    '<span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>';
                                var template = data == true ? enabled : disabled;
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
                    [3, "asc"]
                ]
            });

            // $('#myModal').modal('show');
            // Demo 2
            // var btn = KTUtil.getById("test");
            // console.log(btn);
            $(document).on('click', '.btnViewJob', function(e) {
                var btn = KTUtil.getById($(this).attr('id'));
                var slideURL = $(this).attr('data-url');
                KTUtil.btnWait(btn, "spinner spinner-dark spinner-right", " ");
                $.ajax({
                    type: "GET",
                    url: slideURL,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#showModel').find('.modal-body').html(response
                            .slideDetails);
                        $('#showModel').modal('show');
                    },
                    complete: function() {
                        KTUtil.btnRelease(btn);
                    }
                });

            });



            $('#showModel').on('hidden.bs.modal', function(event) {
                $(this).find('.modal-body').html('');
            })

            $(document).on('click', '.removeBtn', function(e) {
                e.preventDefault();
                var slideId = $(this).attr('data-id');
                var row = $(this).parents('tr');
                Swal.fire({
                    title: "هل انت متاكد ؟",
                    text: "سيتم حذف العنصر بشكل نهائئ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "نعم",
                    cancelButtonText: "الغاء الامر",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.slider.delete') }}",
                            data: {
                                slideId: slideId
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



        });

    </script>
@endpush
