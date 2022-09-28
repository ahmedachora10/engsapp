@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <form id="website_cms_main" method="POST"
                action="{{ route('admin.faq.update') }}">
                @csrf
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    <div class="card-header">

                        <div class="card-title">
                            <h3 class="card-label">الاسئلة الشائعة
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-primary font-weight-bolder">
                                <i class="ki ki-check icon-xs"></i>حفظ التعديلات</button>
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
                        <div class="con">
                            @foreach ($faqs as  $faq)

                                <div class="par">
                                    @if (!$loop->first)
                                        <div class="separator separator-dashed my-10"></div>
                                    @endif
                                    <div class="alert alert-custom alert-default" role="alert">
                                        <div class="alert-icon">
                                            <i class="icon-xl la la-angle-double-left"></i>
                                        </div>
                                        <div class="alert-text">{{ $faq->title_ar }}</div>
                                        <div class="alert-icon">
                                            <button class="btn btn-sm btn-danger btn-del" type="button">
                                                <i class="fa fa-trash icon-xl"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" name="title_ar[{{$faq->id}}]"
                                                           type="text" value="{{ $faq->title_ar }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="title_en[{{$faq->id}}]"
                                                           type="text" value="{{ $faq->title_en }}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة العربية</span>
                                                <textarea class="form-control autosise_textarea"
                                                          id="kt_autosize_{{ $loop->iteration }}" rows="3"
                                                          name="answer_ar[{{$faq->id}}]"
                                                          style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;">{{ $faq->answer_ar }}</textarea>
                                            </div>
                                            <div class="separator separator-dashed my-5"></div>
                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                                <textarea class="form-control autosise_textarea"
                                                          id="kt_autosize1_{{ $loop->iteration }}" rows="3"
                                                          name="answer_en[{{$faq->id}}]"
                                                          style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;">{{ $faq->answer_en }}</textarea>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            @endforeach
                        </div>


                            <button class="btn btn-success font-weight-bolder btn-add" type="button">
                                <i class="fa fa-plus"></i>
                                اضافة جديد
                            </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="template" style="display:none;">
        <div class="par">

            <div class="separator separator-dashed my-10"></div>
            <div class="alert alert-custom alert-default" role="alert">
                <div class="alert-icon">
                    <i class="icon-xl la la-angle-double-left"></i>
                </div>
                <div class="alert-text">جديد</div>
                <div class="alert-icon">
                    <button class="btn btn-sm btn-danger btn-del" type="button">
                        <i class="fa fa-trash icon-xl"></i>
                    </button>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12 col-sm-12">

                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" name="title_ar[]"
                                   type="text" value="" placeholder="العنوان بالعربية">
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" name="title_en[]"
                                   type="text" value="" placeholder="العنوان بالانجليزية">
                        </div>
                    </div>


                    <div class="form-group">
                        <span class="form-text text-muted">اللغة العربية</span>
                        <textarea class="form-control autosise_textarea"
                                   rows="3"
                                  name="answer_ar[]"
                                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;"></textarea>
                    </div>
                    <div class="separator separator-dashed my-5"></div>
                    <div class="form-group">
                        <span class="form-text text-muted">اللغة الانجليزية</span>
                        <textarea class="form-control autosise_textarea"
                                  rows="3"
                                  name="answer_en[]"
                                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;"></textarea>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script>
    <script>
        $(function() {

            var demo1 = $('.autosise_textarea');
            autosize(demo1);
            autosize.update(demo1);
            var validation = FormValidation.formValidation(
                document.getElementById('website_cms_main'), {
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        // Validate fields when clicking the Submit button
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    }
                }
            );

            $.each($('input[type=text], textarea'), function(key, ele) {
                validation.addField(ele.name, {
                    validators: {
                        notEmpty: {
                            message: 'الحقل الزامي'
                        }
                    }
                });
            });

            $('.btn-add').click(function (){
                $('.con').append($('.template').html())
            })
            $('body').on('click','.btn-del',function (){
                $(this).parents('.par').remove()
            })
        });

    </script>
@endpush
