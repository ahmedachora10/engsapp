@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{ $cardTitle }}
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{route($export_url)}}" class="btn btn-primary font-weight-bolder" target="_blank">
                            <i class="fa fa-file-export"></i>
                            <span>تصدير اكسل</span>
                        </a>

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
                                    <th>الاسم</th>
                                    <th>الايميل</th>
                                    <th>تاريخ الانظمام</th>
                                    <th>التقييم</th>
                                    <th>حالة الحساب</th>
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

    {{-- <!-- Modal-->
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection


@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{-- <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script> --}}
    <script>
        $(function() {
            $(document).on('click.bs.dropdown.data-api', '.keep-open', function(e) {
                e.stopPropagation();
            });





            var table = $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('adminAssets/assets/plugins/custom/datatables/Arabic.json') }}"
                },
                ajax: {
                    url: "{{ $dataURL }}",
                    type: "POST",
                    // headers: {
                    //     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    // },
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            // console.log(data, type, row);
                            if (type === 'display') {
                                var tempalte =
                                    '<div class="d-flex flex-row align-items-center">' +
                                    '<div class="symbol symbol-40 symbol-light mr-5">' +
                                    '<span class="symbol-label">' +
                                    '<img src="' + row.profile_img +
                                    '" class="h-100 rounded align-self-end" alt="">' +
                                    '</span>' +
                                    '</div>' + data + '</div>';
                                return tempalte;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'rates_avg_rating_value',
                        name: 'rates_avg_rating_value',
                        // orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                var template;
                                if (data == null) {
                                    template =
                                        '<div class="mr-6">' +
                                        '<i class="fa fa-star-half-alt mr-1 text-warning font-size-lg"></i>' +
                                        '<span class="text-dark-75 font-weight-bolder">0</span>' +
                                        '</div>';
                                } else if (data < 2.5) {
                                    template =
                                        '<div class="mr-6">' +
                                        '<i class="fa fa-star-half-alt mr-1 text-warning font-size-lg"></i>' +
                                        '<span class="text-dark-75 font-weight-bolder">' + data +
                                        '</span>' +
                                        '</div>';
                                } else {
                                    template =
                                        '<div class="mr-6">' +
                                        '<i class="fa fa-star mr-1 text-warning font-size-lg"></i>' +
                                        '<span class="text-dark-75 font-weight-bolder">' + data
                                        .toFixed(2) +
                                        '</span>' +
                                        '</div>';
                                }

                                return template;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'confirmed',
                        name: 'confirmed',
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
                    [3, "desc"]
                ]
            });


            // $(document).on('click', '.btnActiveUserFromList', function(e) {

            //     var url = $(this).attr('action');

            //     KTApp.block('#kt_datatable', {
            //         overlayColor: '#000000',
            //         state: 'primary',
            //         message: 'جاري تعديل حالة الحساب ...'
            //     });

            //     $.ajax({
            //         type: "POST",
            //         url: url,
            //         data: $(this).serialize(),
            //         dataType: "json",
            //         success: function(response) {
            //             console.log(response);
            //         },
            //         complete: function() {
            //             KTApp.unblock('#kt_datatable');
            //             table.ajax.reload(null, false);
            //         }
            //     });

            // });

            $(document).on('click', '.removeBtn', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var row = $(this).parents('tr');
                Swal.fire({
                    title: "هل انت متاكد ؟",
                    text: "سيتم حذف العنصر وجميع طلباته بشكل نهائئ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "نعم",
                    cancelButtonText: "الغاء الامر",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.users.delete') }}",
                            data: {
                                requestId: id
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
