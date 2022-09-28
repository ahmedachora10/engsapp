<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    {{ $serviceName }}
                </x-slot>
            </x-user.sidebar>

            <form id="request-service" action="{{ route('user.request.project') }}" enctype="multipart/form-data"
                method="POST"
                class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0 licence-request step-1">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5>{{ $serviceText }}</h5>
                </div>
                <div class="bg-white d-flex flex-column flex-fill">
                    <div class="service-request-header-block">
                        <div class="d-flex justify-content-between pt-5 px-4 pb-3">
                            <div class="text-content">
                                <h1>الرجاء تحديد نوع الخدمة</h1>
                                <p class="mt-2"> يتم كتابة عنوان المشروع بعد اختيار نوع الخدمة  </p>
                            </div>
                            <div class="steps-container align-self-center">
                                <ul class="steps-counting d-flex align-items-center">
                                    <li class="step active" data-number="01"></li>
                                    <li class="step" data-number="02"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="request-service-slider ">

                            <div class="subservices-checklist pt-4 px-4">
                                <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1">
                                    @foreach ($services as $service)
                                        <li>
                                            <div class="checkbox-control">
                                                <input class="styled-checkbox" id="service{{ $service->id }}"
                                                    type="checkbox" name="selectedservices[]"
                                                    value="{{ $service->id }}">
                                                <label for="service{{ $service->id }}">
                                                    <span>{{ $service->name }}</span>
                                                    <br>
                                                    <small style="color: #565050;font-size: 0.7rem;padding: 0 42px;display: block;">{{$service->decription}}</small>
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="pt-4 px-4">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label"
                                            for="text">{{ __('form.request.project_name') }}</label>
                                        <input type="text" class="form-control" id="title" name="title" required
                                            placeholder="{{ __('form.placeholders.request.project_name') }}">
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-md-0">
                                        <label class="form-label"
                                            for="text">{{ __('form.request.expected_period') }}</label>
                                        <input type="text" class="form-control rule-number" id="expectedDate"
                                            name="expectedDate" required data-rule-number="true"
                                            placeholder="{{ __('form.placeholders.request.expected_period') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label"
                                            for="text">{{ __('form.request.budget_min') }}</label>
                                        <span class="price-tag">
                                            <input type="text" class="form-control" id="budgetMin" name="budgetMin"
                                                required autocomplete="off"
                                                placeholder="{{ __('form.placeholders.request.budget_min') }}">
                                            <span class="price-curr">{{ __('form.curr') }}</span>
                                        </span>
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-md-0">
                                        <label class="form-label"
                                            for="text">{{ __('form.request.budget_max') }}</label>
                                        <span class="price-tag">
                                            <input type="text" class="form-control" id="budgetMax" name="budgetMax"
                                                required autocomplete="off"
                                                placeholder="{{ __('form.placeholders.request.budget_max') }}">
                                            <span class="price-curr">{{ __('form.curr') }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label"
                                            for="text">{{ __('form.request.offers_deadline') }}</label>
                                        <span class="has-icon-left date-left-icon">
                                            <input type="text" class="form-control date-picker" id="deadlineDate"
                                                name="deadlineDate" required autocomplete="off"
                                                placeholder="{{ date('d-m-Y') }}">
                                        </span>
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-md-0">
                                        <label class="form-label"
                                            for="text">{{ __('form.request.request_attachemnts') }}</label>
                                        <div class="custom-file has-icon attachment-icon">
                                            <input type="file" class="custom-file-input" id="projectFiles" multiple
                                                name="projectFiles[]">
                                            <label class="custom-file-label"
                                                for="projectFiles">{{ __('form.placeholders.request.request_attachemnts') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="form-label"
                                            for="message">{{ __('form.request.details') }}</label>
                                        <textarea id="description" name="description" class="form-control p-3" cols="30"
                                            rows="8" placeholder="{{ __('form.placeholders.request.details') }}"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center mb-4 mt-auto px-md-5 px-3 text-center">
                        <a href="#" class="btn btn-46 btn-step d-inline-block btn-prev mr-3">
                            رجوع</a>
                        <button type="submit"
                            class="btn btn-primary has-shadow btn-46 btn-step d-inline-block btn-next">
                            <span class="text">التالي</span>
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
            </form>

        </div>
    </div>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.standalone.css') }}">
    @endsection
    @section('scripts')
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.ar.min.js') }}"></script>
        <script>
            $(function() {

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

                $.validator.addMethod("selectnic", function(value, element) {
                    return $(".styled-checkbox:checkbox:checked").length > 0;
                }, '{{ __('form.validatemessages.minlength_services') }}');

                // jQuery.validator.addMethod("filesize_max", function(value, element, param) {
                //     var isOptional = this.optional(element),
                //         file;

                //     if (isOptional) {
                //         return isOptional;
                //     }

                //     if ($(element).attr("type") === "file") {
                //         if (element.files && element.files.length) {

                //             // file = element.files[0] / 1024 / 1024;
                //             file = element.files[0];
                //             console.log('file.size', (file.size / 1024 / 1024));
                //             console.log('param', param);
                //             return (file.size && file.size <= param);
                //         }
                //     }
                //     return false;
                // }, "File size is too large.");


                $.validator.addMethod("dateFormat", function(value, element) {
                    var date_regex = /^(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-](19|20)\d\d$/;
                    console.log(value);
                    if (!(date_regex.test(value))) {
                        return false;
                    }
                    return true;
                }, '{{ __('form.validatemessages.dateFormat') }}');

                var form = $("#request-service");



                var validator = form.validate({
                    rules: {
                        'selectedservices[]': {
                            selectnic: true,
                        },
                        'projectFiles[]': {
                            extension: "jpg|pdf|png|dwg|jpeg|doc|docx"
                            // filesize_max: 12
                        },
                        budgetMin: {
                            min: 0,
                            required: true,
                            number: true

                        },
                        deadlineDate: {
                            dateFormat: true,
                        },
                        budgetMax: {
                            min: function() {
                                return $("#budgetMin").val() * 1;
                            },
                            required: true,
                            number: true

                        }
                    },
                    showErrors: function(errorMap, errorList) {
                        this.defaultShowErrors();

                        var slideHeight = $('.request-service-slider').find(".slick-list").find(
                            '.slick-active').outerHeight();
                        $('.request-service-slider').find('.slick-list').height(slideHeight);
                        $('.request-service-slider').slick("setOption", null, null, true);
                    },
                });
                // validator.element( "#myselect" );

                $('.btn-next').on('click', function(e) {
                    // validator.valid();
                    // console.log(form.valid());
                    if (form.hasClass('step-1')) {
                        console.log(validator.element(".styled-checkbox"));
                        if (validator.element(".styled-checkbox") == false) {
                            return false;
                        } else {
                            form.removeClass('step-1').addClass('step-2');
                            $('.steps-counting li').eq(0).addClass('filled');
                            $('.steps-counting li').eq(1).addClass('active');
                            $(".btn-prev").addClass("shown");
                            $(".request-service-slider").slick("slickNext");
                            return false;
                        }
                    }
                    //

                });

                form.submit(function() {
                    if (form.valid())
                        $(this).find("button[type='submit']").addClass('loading').prop('disabled', true);
                });

                $('.btn-prev').on('click', function(e) {

                    form.removeClass('step-2').addClass('step-1');
                    $('.steps-counting li').eq(0).removeClass('filled');
                    $('.steps-counting li').eq(1).removeClass('active');
                    $(".request-service-slider").slick("slickPrev");
                    $(this).removeClass('shown');
                    return false;
                });


                $("#deadlineDate").change(function() {
                    validator.element("#deadlineDate");
                });


                $("#projectFiles").change(function() {
                    validator.element("#projectFiles");
                });

            });

        </script>
    @endsection
</x-layout>
