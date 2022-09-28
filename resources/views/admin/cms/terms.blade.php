@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <form id="website_cms_main" method="POST"
                action="{{ route('admin.terms.update') }}">
                @csrf
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    <div class="card-header">

                        <div class="card-title">
                            <h3 class="card-label">{{$page->title}}
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

                                <div class="par">

                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" name="title_ar"
                                                           type="text" value="{{ $page->title_ar }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="title_en"
                                                           type="text" value="{{ $page->title_en }}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة العربية</span>
                                                <textarea class="summernote" id="kt_summernote_1"
                                                          name="text_ar">{{ $page->text_ar }}</textarea>

                                            </div>
                                            <div class="separator separator-dashed my-5"></div>
                                            <div class="form-group">
                                                <span class="form-text text-muted">اللغة الانجليزية</span>
                                                <textarea class="summernote" id="kt_summernote_2"
                                                          name="text_en">{{ $page->text_en }}</textarea>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                        </div>


                    </div>

                </div>
            </form>
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
            $('.summernote').summernote({
                height: 400,
                tabsize: 2,
                callbacks: {
                    onImageUpload: function(files) {
                        console.log(files);
                        sendFile(files[0]);
                    }
                    // onImageUpload: function(files) {
                    //     // upload image to server and create imgNode...
                    //     $summernote.summernote('insertNode', imgNode);
                    // }
                }

            }).on('summernote.change', function(customEvent, contents, $editable) {
                // Revalidate the content when its value is changed by Summernote
                validation.revalidateField('content');
            });
            $.each($('input[type=text], textarea'), function(key, ele) {
                validation.addField(ele.name, {
                    validators: {
                        notEmpty: {
                            message: 'الحقل الزامي'
                        }
                    }
                });
            });

            // send the file

            function sendFile(file) {
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    type: 'POST',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) myXhr.upload.addEventListener('progress',
                            progressHandlingFunction, false);
                        return myXhr;
                    },
                    url: "{{ route('admin.post.uploadImage') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.progressbar-row').css('display', 'flex');
                    },
                    success: function(response) {
                        // editor.insertImage(welEditable, url);
                        var image = $('<img>').attr('src', response.url);
                        $('.summernote').summernote("insertNode", image[0]);
                        $('.progressbar-row').css('display', 'none');
                        $('.progress-bar').css('width', '0%');
                    },
                    error: function(xhr) {
                        $('.progressbar-row').css('display', 'none');
                    }
                });
            }



            // update progress bar

            function progressHandlingFunction(e) {
                if (e.lengthComputable) {
                    console.log(e.loaded, e.total);
                    var percent = (e.loaded / e.total) * 100;
                    // console.log(perc);

                    $('.progress-bar').css('width', percent + '%');
                    // $('progress').attr({
                    //     value: e.loaded,
                    //     max: e.total
                    // });
                    // // // reset progress on complete
                    // if (e.loaded == e.total) {
                    //     $('.progress-bar').animate({
                    //         width: '0%'
                    //     }, 100);
                    // }
                }
            }

            $('.btn-add').click(function (){
                $('.con').append($('.template').html())
            })
            $('body').on('click','.btn-del',function (){
                $(this).parents('.par').remove()
            })
        });

    </script>
@endpush
