@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">الوظائف المعلنة</h3>
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
                                    <th>الوظيفة</th>
                                    <th>المعلن</th>
                                    <th>تاريخ الانشاء</th>
                                    <th>تاريخ انتهاء التقديم</th>
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
                    url: "{{ route('admin.jobs.listData') }}",
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
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'company.name',
                        name: 'company.name',
                        render: function(data, type, row) {
                            // console.log(data, type, row);
                            if (type === 'display') {
                                var tempalte =
                                    '<div class="d-flex flex-row align-items-center">' +
                                    '<div class="symbol symbol-40 symbol-light mr-5">' +
                                    '<span class="symbol-label">' +
                                    '<img src="' + row.company.profile_img +
                                    '" class="h-100 rounded align-self-end" alt="">' +
                                    '</span>' +
                                    '</div>' + data + '</div>';
                                return tempalte;
                            }
                            return data;
                        },
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'deadline',
                        name: 'deadline'
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


            // $('#myModal').modal('show');

            // Demo 2
            // var btn = KTUtil.getById("test");
            // console.log(btn);
            $(document).on('click', '.btnViewJob', function(e) {
                var btn = KTUtil.getById($(this).attr('id'));
                var jobUrl = $(this).attr('data-url');
                KTUtil.btnWait(btn, "spinner spinner-dark spinner-right pr-15", " ");
                // setTimeout(function() {

                // }, 1000);

                $.ajax({
                    type: "GET",
                    url: jobUrl,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#showModel').find('.modal-body').html(response
                            .jobDetails);
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
                var jobId = $(this).attr('data-id');
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
                            url: "{{ route('admin.jobs.delete') }}",
                            data: {
                                jobId: jobId
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
