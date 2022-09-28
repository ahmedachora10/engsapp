@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">المشاريع</h3>
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
                                    <th class="min-w-265px">المشروع</th>
                                    <th>مرحلة المشروع</th>
                                    <th>صاحب طلب الخدمة</th>
                                    <th>تاريخ الانشاء</th>
                                    <th>تاريخ انتهاء التقديم</th>
                                    <th>عدد العروض</th>
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
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{-- <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script> --}}
    <script>
        $(function() {

            var table = $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('adminAssets/assets/plugins/custom/datatables/Arabic.json') }}"
                },
                ajax: {
                    url: "{{ route('admin.request.list') }}",
                    type: "POST",
                },
                // dom: '<"top"i>rt<"bottom"flp><"clear">',
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                // console.log(row);
                                var template =
                                    '<div class="ml-3">' +
                                    '<div class="text-dark-50 font-weight-bolder mb-0">' +
                                    row.service.name_ar + '</div>' +
                                    '<a href="' + row.viewRequestUrl +
                                    '" class="text-dark-75 font-weight-bolder text-hover-primary">' +
                                    data + '</a>' +
                                    '</div>';
                                return template;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'service_stage.id',
                        name: 'service_stage.id',
                        searchable: false,
                        render: function(data, type, row) {
                            // console.log(data, type, row);
                            if (type === 'display') {
                                var output = '';
                                var stageId = row.service_stage.id;

                                var status = {
                                    0: {
                                        'title': 'غير مؤكد',
                                        'class': ' label-light-danger'
                                    },
                                    1: {
                                        'title': row.service_stage.name,
                                        'class': ' label-light-warning'
                                    },
                                    2: {
                                        'title': row.service_stage.name,
                                        'class': ' label-light-primary'
                                    },
                                    3: {
                                        'title': row.service_stage.name,
                                        'class': ' label-light-dark'
                                    },
                                    4: {
                                        'title': row.service_stage.name,
                                        'class': ' label-light-info'
                                    },
                                    5: {
                                        'title': row.service_stage.name,
                                        'class': ' label-light-success'
                                    },
                                    6: {
                                        'title': row.service_stage.name,
                                        'class': ' label-light-danger'
                                    }
                                };

                                // output += '<div class="font-weight-bolder text-primary mb-0">' +
                                //     data + '</div>';
                                output += '<div class="font-weight-bolder label label-inline' +
                                    status[stageId].class + '">' +
                                    status[stageId].title +
                                    '</div>';

                                return output;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'service_request_owner.name',
                        name: 'service_request_owner.name',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                var tempalte =
                                    '<div class="d-flex flex-row align-items-center">' +
                                    '<div class="symbol symbol-40 symbol-light mr-5">' +
                                    '<span class="symbol-label">' +
                                    '<img src="' + row.service_request_owner.profile_img +
                                    '" class="h-100 rounded align-self-end" alt="">' +
                                    '</span>' +
                                    '</div><a href="' + row.serviceOwnerUrl + '">' + data +
                                    ' </a></div>';
                                return tempalte;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            // console.log(data, type, row);
                            if (type === 'display') {
                                var output = '';
                                output += '<div class="font-weight-bolder text-dark mb-0">' +
                                    data + '</div>';

                                return output;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'deadline_date',
                        name: 'deadline_date',
                        render: function(data, type, row) {
                            // console.log(data, type, row);
                            if (type === 'display') {
                                var output = '';
                                output += '<div class="font-weight-bolder text-danger mb-0">' +
                                    data + '</div>';

                                return output;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'offers_count',
                        name: 'offers_count',
                        searchable: false
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
            }).on('init.dt', function(e, settings) {
                $('.dataTables_filter').addClass('text-right');
            });


            // $('#myModal').modal('show');

            $(document).on('click', '.removeBtn', function(e) {
                e.preventDefault();
                var requestId = $(this).attr('data-id');
                Swal.fire({
                    title: "هل انت متاكد ؟",
                    text: "سيتم حذف بشكل نهائئ ولا يمكن التراجع عن هذه الخطوة",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "نعم",
                    cancelButtonText: "الغاء الامر",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.request.delete') }}",
                            data: {
                                requestId: requestId
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
