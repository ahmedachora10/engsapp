@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ $cardTitle }}</h3>
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
                                    <th>{{ $columnTitle }}</th>
                                    <th>التاريخ</th>
                                    <th>اللغة</th>
                                    <th>عدد المشاهدات</th>
                                    <th>التعلقيات</th>
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
    <div class="modal fade" id="CommentsModel" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CommentsModel">الردود</h5>
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
                    url: "{{ $dataURL }}",
                    type: "POST",
                },
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
                            console.log(row);
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
                        data: 'post_date',
                        name: 'post_date',
                    },
                    {
                        data: 'lang',
                        name: 'lang'
                    },
                    {
                        data: 'views',
                        name: 'views'
                    },
                    {
                        data: 'totalComments',
                        name: 'totalComments',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                console.log(row);
                                var tempalte =
                                    '<span class="label label-info label-inline">' +
                                    row.totalComments +
                                    ' تعليق </span>';
                                if (row.totalUnreadedComments > 0) {
                                    tempalte += '<br><span class="label pulse pulse-warning">' +
                                        '<span class="position-relative">' + row
                                        .totalUnreadedComments + '</span>' +
                                        '<span class="pulse-ring"></span>' +
                                        '</span> <a href="#" data-post-id="' + row.id +
                                        '" class="font-weight-bolder newCommentsModel">جديد</a>';
                                }
                                return tempalte;
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
                    [2, "desc"]
                ]
            });


            $(document).on('click', '.removeBtn', function(e) {
                e.preventDefault();
                var postId = $(this).attr('data-id');
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
                            url: "{{ route('admin.post.delete') }}",
                            data: {
                                postId: postId
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
