@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">اتصل بنا</h3>
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
                                    <th>الحالة</th>
                                    <th>تاريخ الارسال</th>
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
                    <h5 class="modal-title" id="showModel">تفاصيل الرسالة</h5>
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
                    url: "{{ route('admin.contactusData') }}",
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
                        name: 'email'
                    },
                    {
                        data: 'isread',
                        name: 'isread',
                        render: function(data, type, row) {
                            // console.log(data, type, row);
                            if (type === 'display') {
                                // console.log(data);
                                return (data == false) ?
                                    '<span class="label label-lg font-weight-bold label-light-warning label-inline">غير مقروءة</span>' :
                                    '<span class="label label-lg font-weight-bold label-light-success label-inline">مقروءة</span>';
                                // return data;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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

            $(document).on('click', '.btnViewJob', function(e) {
                var btn = KTUtil.getById($(this).attr('id'));
                var messageUrl = $(this).attr('data-url');
                KTUtil.btnWait(btn, "spinner spinner-dark spinner-right pr-15", " ");

                $.ajax({
                    type: "GET",
                    url: messageUrl,
                    dataType: "json",
                    success: function(response) {
                        $('#showModel').find('.modal-body').html(response
                            .messageDetails);
                        $('#showModel').modal('show');
                        $('.totalContactNewMsgs').html(response.totalContactNewMsgs);
                    },
                    complete: function() {
                        KTUtil.btnRelease(btn);
                        table.ajax.reload(null, false);
                    }
                });

            });

            $('#showModel').on('hidden.bs.modal', function(event) {
                $(this).find('.modal-body').html('');
            })


            $(document).on('click', '.removeBtn', function(e) {
                e.preventDefault();
                var messageId = $(this).attr('data-id');
                var row = $(this).parents('tr');
                Swal.fire({
                    title: "هل انت متاكد ؟",
                    text: "سيتم حذف الرسالة بشكل نهائئ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "نعم",
                    cancelButtonText: "الغاء الامر",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.contactusData.delete') }}",
                            data: {
                                messageId: messageId
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                $('.totalContactNewMsgs').html(response
                                    .totalContactNewMsgs);
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
