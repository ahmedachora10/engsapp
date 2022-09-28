<x-layout>
    <x-slot name="linkselected">
        operatorJobs
    </x-slot>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.jobs') }}">
                {{ __('main.jobs') }}
            </a>
        </li>
    </x-breadcrumb>
    <div class="container">
        <div class="row mt-3 mb-3 mx-md-0">
            <div class="col-md-12 bg-white border-radius-5 py-5 px-md-5 px-4">
                <div class="row d-flex flex-row align-items-center">
                    <div class="col-md-8">
                        <h1>
                            الوظائف المضافة
                        </h1>
                        <p>تمت إضافة هذه الوظائف من قبل المكتب الهندسي للإعلان علنها للباحثن عن الوظائف</p>
                    </div>
                    <div class="col-md-3 offset-1">
                        <a href="#" data-panel-id="addNewJob" class="btn btn-primary btn-46 open-panel">
                            + إضافة وظيفة
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row jobs">
            @include('operators.operatorJobs_items' , ['jobs' => $jobs])
            @if ($jobs->count() == 0)
                <div class="col-md-12 mb-4 emptyList">
                    <div class="bg-white text-center px-3 py-5">
                        <h5>لا يوجد وظائف مدخلة</h5>
                    </div>
                </div>
            @endif
        </div>
        @if ($jobs->total() > 12)
            <div class="row">
                <div class="col-lg-12 mb-5 ">
                    <div class="bg-white d-flex p-2 justify-content-center ">
                        {{ $jobs->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

    @section('panels')

        <div class="eg-dropdown" style="display: none;">
            <form action="{{ route('operator.deletejobs') }}" id="deleteJobForm" method="post">
                @method('delete');
                @csrf
                <input type="text" style="display:none" id="JobId" name="JobId">
                <div class="dropdownlist-content withActions p-4">
                    <p>سيتم الحذف بشكل نهائي ولا يمكن التراجع عن هذه الخطوة ، هل انت متاكد ؟</p>
                    <div class="d-flex flex-row mt-2">
                        <button type="submit" class="btn btn-primary btn-danger-color btn-30 mr-4">
                            <span class="text">نعم</span>
                            <div class="loading-animate">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </button>
                        <a href="#" class="btn btn-primary btn-gray-color btn-30 cancel-dropdown">لا</a>
                    </div>
                </div>
            </form>
        </div>


        <x-customPanel id="addNewJob">
            <div class="col-lg-6 col-md-8">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <h1>
                            إضافة طلب وظيفة
                        </h1>
                        <p class="mt-2">يمكنك الإعلان عن وظيفة مطلوبة لديك من خلال ادخال البيانات التالية</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <form id="addNewJob_form" action="{{ route('operator.createjobs') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="text" style="display:none" name="jobId" value="">
                            <div class="form-group">
                                <label for="title">عنوان الوظيفة</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-md-6">
                                    <label class="form-label" for="text">ادخل تاريخ انتهاء اعلان التوظيف</label>
                                </div>
                                <div class="col-md-6">
                                    <span class="has-icon-left date-left-icon">
                                        <input type="text" class="form-control date-picker" id="deadline" name="deadline"
                                            required autocomplete="off" placeholder="{{ date('d-m-Y') }}">
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="align-items-center d-flex form-group justify-content-between">


                            </div> --}}
                            <div class="form-group">
                                <label for="desc">وصف الوظيفة</label>
                                <textarea id="desc" name="desc" class="form-control p-3" cols="30" rows="4"
                                    required></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label" for="recruiter_phone">رقم الجوال</label>
                                    <input type="text" class="form-control font-Roboto" id="recruiter_phone"
                                        name="recruiter_phone">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="recruiter_email">البريد الالكتروني</label>
                                    <input type="email" class="form-control" id="recruiter_email" name="recruiter_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">صورة الاعلان</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <small id="EditNote" style="display: none;font-size: 12px;padding: 10px 22px;">اختر صورة جديدة لتعديل صورة الاعلان  ، اذا لم تختر صورة لن يتم تغيير صورة الاعلان القديمة</small>

                            </div>
                            <div class="form-group row justify-content-center mt-5">
                                <div class="col-md-4 col-6">
                                    <a href="#" class="btn btn-46 d-inline-block btn-prev shown mr-3 close-panel">
                                        الغاء</a>
                                </div>
                                <div class="col-md-4 col-6">
                                    <button type="submit"
                                        class="btn btn-primary has-shadow btn-46 d-inline-block btn-saveChanges">
                                        <span class="text">{{ __('form.buttons.create_job') }}</span>
                                        <div class="loading-animate">
                                            <div class="lds-ellipsis">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            {{-- <div class="d-flex form-group justify-content-center mb-3">


                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </x-customPanel>
    @endsection
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.standalone.css') }}">
    @endsection
    @section('scripts')
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.ar.min.js') }}"></script>
        <script>
            $(function() {

                var form = $("#addNewJob_form");
                var validator = form.validate();


                $(".cancel-dropdown").on('click', function(e) {
                    $('.btn-dropdown').trigger("click");
                    e.preventDefault();
                });

                function populate(frm, data) {
                    $.each(data, function(key, value) {
                        $('[name=' + key + ']', frm).val(value);
                    });
                }


                $(document).on("click", ".btn-EditJob", function(e) {
                    var jobId = $(this).attr('data-job-id');
                    var jobTitle = $(this).parents('.jobcard').find('.jobTitle').html().trim();
                    var deadline = $(this).parents('.jobcard').find('.jobDeadline').html().trim();
                    var jobDesc = $(this).parents('.jobcard').find('.jobDesc').html().trim();
                    var jobEmail = $(this).parents('.jobcard').find('.jobEmail')?.html()?.trim()||'';
                    var jobPhone = $(this).parents('.jobcard').find('.jobPhone')?.html()?.trim()||'';

                    $('#EditNote').show();
                    var data = {
                        'jobId': jobId,
                        'title': jobTitle,
                        'deadline': deadline,
                        'desc': jobDesc,
                        'recruiter_phone': jobPhone,
                        'recruiter_email': jobEmail,
                    };
                    populate(form, data);
                    $('.date-picker').datepicker('update');
                    form.find('.btn-saveChanges').find('.text').html(
                        '{{ __('form.buttons.saveChanges') }}');
                    openPanel('addNewJob');

                    e.preventDefault();
                });

                $(document).on("click", ".close-panel", function(e) {
                    form.trigger("reset");
                    validator.resetForm();
                    closePanel('addNewJob');
                    form.find('.btn-saveChanges').find('.text').html(
                        '{{ __('form.buttons.create_job') }}');
                    e.preventDefault();
                });


                $(document).on("click", ".btn-dropdown", function(e) {

                    e.preventDefault();
                    e.stopPropagation();
                    if ($('.eg-dropdown').css('display') == 'block') {

                        $('.dropdownlist-content').removeClass('showActions');

                        setTimeout(function() {
                            $('.eg-dropdown').css({
                                'display': 'none',
                            });
                            $('#deleteJobForm').trigger('reset');
                        }, 250);

                        return false;
                    }

                    var JobId = $(this).parents('.jobcard').attr('data-job-id');

                    var data = {
                        'JobId': JobId,
                    };
                    populate($('#deleteJobForm'), data);

                    var position_btn = $(this).offset();
                    var widthBtn = $(this).outerWidth();
                    var dropdownContentWidth = $('.dropdownlist-content').outerWidth();
                    var dropdownContentHeight = $('.dropdownlist-content').outerHeight();

                    var centerX = position_btn.left + widthBtn / 2;


                    $('.eg-dropdown').css({
                        'display': 'block',
                        'width': dropdownContentWidth,
                        'height': dropdownContentHeight
                    });
                    var leftside = position_btn.left - $('.eg-dropdown').outerWidth() / 2
                    if ($('html').is(':lang(ar)')) {
                        leftside = position_btn.left;
                    }


                    $('.eg-dropdown').css({
                        'position': 'absolute',
                        'top': position_btn.top + $('.btn-dropdown').innerHeight() + 5,
                        'left': leftside
                    });

                    // var elem = document.querySelector('#some-element');
                    // var bounding = elem.getBoundingClientRect();
                    // console.log(bounding);
                    // if (document.documentElement.clientWidth < 1200) {
                    //     $('.eg-dropdown').css({
                    //         'position': 'absolute',
                    //         'top': position_btn.top + $('.btn-dropdown').innerHeight() + 5,
                    //         'left': position_btn.left - $('.eg-dropdown').outerWidth() / 2,
                    //     });
                    // }
                    // if (bounding.right > (window.innerWidth || document.documentElement.clientWidth)) {

                    // Right side is out of viewport
                    // }

                    // jQuery.expr.filters.offscreen = function(el) {
                    //     var rect = el.getBoundingClientRect();
                    //     return (
                    //         (rect.x + rect.width) < 0 ||
                    //         (rect.y + rect.height) < 0 ||
                    //         (rect.x > window.innerWidth || rect.y > window.innerHeight)
                    //     );
                    // };

                    // console.log($('.eg-dropdown').is(':offscreen'));

                    $('.dropdownlist-content').addClass('showActions');


                });






                $('[dir="rtl"] .date-picker').datepicker({
                    rtl: true,
                    format: "dd-mm-yyyy",
                    startDate: "{{ date('d-m-Y') }}",
                    language: "ar",
                    orientation: "bottom auto",
                    autoclose: true,
                    todayHighlight: true
                });
                $('[dir="ltr"] .date-picker').datepicker({
                    format: "dd-mm-yyyy",
                    orientation: "bottom auto",
                    startDate: "{{ date('d-m-Y') }}",
                    autoclose: true,
                    todayHighlight: true
                });



                form.submit(function(e) {
                    e.preventDefault();
                    if (form.valid()) {
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);
                        // form.submit();
                        // return ;
                        var fd = new FormData(form.formData);
                        // console.log(form.formData,form.serializeArray());
                        // return ;
                        let items=form.serializeArray();
                        for (var i = 0; i < items.length; ++i) {
                            fd.append(items[i].name, items[i].value);
                        }
                        let file=document.getElementById('image').files[0];
                        if(file)
                        fd.append("image", file);
                        $.ajax({
                            type: "POST",
                            url: form.attr('action'),
                            data: fd,
                            cache: true,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(response) {
                                // var response = $.parseJSON(response);
                                showAlertSuccess(response.message);

                                setTimeout(function() {
                                    if ($('.emptyList').length) {
                                        $('.emptyList').remove();
                                    }
                                    $('.close-panel').trigger("click");
                                    if (response.type == 'update') {
                                        $('.jobcard[data-job-id="' + response.jobId +
                                            '"]').replaceWith(response
                                            .newJobTemplate);
                                    } else {
                                        if ($('.jobs').children().length < 12)
                                            $('.jobs').append(response.newJobTemplate);
                                    }
                                    form.trigger("reset");
                                    validator.resetForm();
                                }, 2600);

                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });


                        return false;
                    }
                    return false;
                });

                $("#deadline").change(function() {
                    validator.element("#deadline");
                });


                var formDelete = $('#deleteJobForm');
                formDelete.submit(function() {
                    if (formDelete.valid()) {
                        var btn = $(this).find("button[type='submit']");
                        var jobCard =
                            btn.addClass('loading').prop('disabled', true);

                        $.ajax({
                            type: "POST",
                            url: formDelete.attr('action'),
                            data: formDelete.serialize(),
                            dataType: "json",
                            success: function(response) {
                                $('.btn-dropdown').trigger("click");
                                $('.jobcard[data-job-id="' + response.jobId + '"]').fadeOut(
                                    "slow",
                                    function() {
                                        // Animation complete.
                                        $(this).remove();
                                    });
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });


                        return false;
                    }
                    return false;
                });





            })

        </script>
    @endsection
</x-layout>
