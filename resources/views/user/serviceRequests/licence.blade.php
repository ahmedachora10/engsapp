<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    {{ $serviceName }}
                </x-slot>
            </x-user.sidebar>

            <form id="request-service" action="{{ route('user.serviceResults') }}" method="POST"
                class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0 licence-request step-1">
                {{-- <input type="hidden" name="projectType" id="projectType" value="none"> --}}
                <input type="hidden" id="service_type" name="service_type" value="{{ $service_id }}">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5>{{ $serviceText }}</h5>
                </div>
                <div class="bg-white d-flex flex-column flex-fill">
                    <div class="service-request-header-block">
                        <div class="d-flex justify-content-between pt-5 px-4 pb-3">
                            <div class="text-content">
                                <h1>اختر نوع الترخيص ونوع المشروع</h1>
                                <p class="mt-2">حدد نوع الترخيص ومن ثم قم بتحديد نوع المشروع الذي ترغب بصدار شهادة ترخيص
                                    له</p>
                            </div>
                            <div class="steps-container align-self-center">
                                <ul class="steps-counting d-flex align-items-center">
                                    <li class="step active" data-number="01"></li>
                                    <li class="step" data-number="02"></li>
                                    <li class="step" data-number="03"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="request-service-slider ">
                            <div class="pt-4 px-4">
                                <div class="d-flex flex-row mb-3">
                                    @foreach ($services as $service)
                                        <div class="custom-control custom-radio {{ $loop->first ? 'mr-4' : '' }}">
                                            <input type="radio" class="custom-control-input"
                                                id="LicenseId{{ $service->id }}" name="lienceType"
                                                {{ $loop->first ? 'checked' : '' }} value="{{ $service->id }}">
                                            <label class="custom-control-label"
                                                for="LicenseId{{ $service->id }}">{{ $service->name }}</label>
                                        </div>
                                    @endforeach

                                    {{-- <div class="custom-control custom-radio mr-4">
                                        <input type="radio" class="custom-control-input" id="ConstructionLicense"
                                            name="lienceType" checked value="ConstructionLicense">
                                        <label class="custom-control-label" for="ConstructionLicense">ترخيص
                                            انشاء</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="OperatingLicense"
                                            name="lienceType" value="OperatingLicense">
                                        <label class="custom-control-label" for="OperatingLicense">ترخيص تشغيل</label>
                                    </div> --}}
                                </div>
                                <div class="licence-options-cards options-cards">
                                    @foreach ($subservices as $subservice)
                                        <div class="d-flex flex-md-row flex-column subServices"
                                            style="{{ $loop->first ? '' : 'display: none !important' }}"
                                            data-subservice-id="{{ $subservice['serviceParentId'] }}">
                                            @foreach ($subservice['subservices'] as $service)
                                                <div class="flex-fill mb-3 mb-md-0">
                                                    <input type="radio" id="subservice{{ $service->id }}"
                                                        value="{{ $service->id }}" name="projectType"
                                                        class="projectTypeInput">
                                                    <label for="subservice{{ $service->id }}"
                                                        class="card m-auto text-center">
                                                        <div class="icon">
                                                            @if ($service->name == 'مشاريع سكنية' || $service->name == 'Residential Projects')
                                                                @include('svgIcons.homeprojects')
                                                            @elseif ($service->name == 'مشاريع تجارية' ||
                                                                $service->name == 'Commercial Projects')
                                                                @include('svgIcons.marketprojects')
                                                            @elseif ($service->name == 'مشاريع كبرى' ||
                                                                $service->name == 'Large Projects')
                                                                @include('svgIcons.largeprojects')
                                                            @endif
                                                        </div>
                                                        <h3 class="title">{{ $service->name }}</h3>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="subservices-checklist licence-subservices-list pt-4 px-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="title mb-3">المشاريع الكبرى تتطلب اصدار تراخيص</p>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="checklist-updated">

                                        </ul>
                                    </div>
                                    <div class="col-md-5 mt-4 mt-md-0">
                                        <p class="note">ملاحظة</p>
                                        <p class="note-desc pr-4">يمكن ان تقوم بطلب اكثر من نوع من أنواع التراخيص لان
                                            جميع
                                            التراخيص تتطلب فقط
                                            مخططات بلدية قبل البدء بها
                                            <br>
                                            <br>
                                            لكل ترخيص من التراخيص متطلبات ليتم استخراجها وهناك متطلبات تكون في مرحلة
                                            التنفيذ وهناك متطلبات في مرحلة التشغيل
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row mt-auto justify-content-end mb-4 px-md-5 px-3 text-right">
                        <a href="#" class="btn btn-46 btn-step d-inline-block btn-prev mr-3">
                            رجوع</a>
                        <button type="submit"
                            class="btn btn-primary has-shadow btn-46 btn-step  d-inline-block btn-next">
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
    @section('scripts')
        <script>
            $(function() {
                $.validator.addMethod("selectnic", function(value, element) {
                    return $(".styled-checkbox:checkbox:checked").length > 0;
                }, '{{ __('form.validatemessages.minlength_services') }}');



                $('input[name="lienceType"]').on('change', function(e) {
                    $('.subServices').attr('style', 'display: none !important');
                    $('.subServices[data-subservice-id="' + $(this).val() + '"]').removeAttr('style');
                    $('input[name="projectType"]').prop('checked', false);
                    var slideHeight = $('.request-service-slider').find(".slick-list").find(
                            '.slick-active').outerHeight();
                        $('.request-service-slider').find('.slick-list').height(slideHeight);
                        $('.request-service-slider').slick("setOption", null, null, true);
                        AOS.refresh();
                });


                var form = $("#request-service");
                var validator = form.validate({
                    rules: {
                        lienceType: {
                            required: true,
                        },
                        projectType: {
                            required: true,
                        },
                    },
                    messages: {
                        projectType: {
                            required: "{{ __('form.validatemessages.licence_services_required') }}",
                        },
                    },
                    showErrors: function(errorMap, errorList) {
                        this.defaultShowErrors();

                        var slideHeight = $('.request-service-slider').find(".slick-list").find(
                            '.slick-active').outerHeight();
                        $('.request-service-slider').find('.slick-list').height(slideHeight);
                        $('.request-service-slider').slick("setOption", null, null, true);
                        AOS.refresh();
                    },
                });
                // validator.element( "#myselect" );
                $('.btn-next').on('click', function(e) {
                    // validator.valid();
                    // console.log(form.valid());
                    // console.log(validator.errorList);
                    // console.log();
                    if (form.hasClass('step-1')) {
                        if (validator.element(".projectTypeInput") == false) {
                            return false;
                        } else {

                            var btn = $(this);
                            btn.addClass('loading');
                            btn.attr("disabled", "disabled");
                            $.ajax({
                                type: "POST",
                                url: "{{ route('get.license.services') }}",
                                data: form.serialize(),
                                dataType: "html",
                                success: function(response) {
                                    $('.checklist-updated').html('').append(response);
                                    // 
                                    form.removeClass('step-1').addClass('step-2');
                                    $('.steps-counting li').eq(0).addClass('filled');
                                    $('.steps-counting li').eq(1).addClass('active');
                                    $(".btn-prev").addClass("shown");
                                    $(".request-service-slider").slick("slickNext");
                                    $("input[name='selectedservices[]']").rules("add",
                                        "selectnic");
                                    // return false;
                                    console.log(response);
                                    AOS.refresh();
                                },
                                complete: function() {
                                    btn.removeAttr("disabled").removeClass('loading');
                                }
                            });
                            // return false;
                            return false;
                        }
                    }
              
                });


                $('.btn-prev').on('click', function(e) {

                    form.removeClass('step-2').addClass('step-1');
                    $('.steps-counting li').eq(0).removeClass('filled');
                    $('.steps-counting li').eq(1).removeClass('active');
                    $(".request-service-slider").slick("slickPrev");
                    $(this).removeClass('shown');
                    return false;
                });



                $(".projectTypeInput").change(function() {
                    validator.element(".projectTypeInput");
                });


                // $('#request-service').validate({ // initialize the plugin
                //     rules: {
                //         lienceType: {
                //             required: true,
                //         },
                //         projectType: {
                //             required: true,
                //         },
                //     },
                //     errorPlacement: function(error, element) {
                //         error.insertAfter($('.steps-container'));
                //     }
                // });
            });

        </script>
    @endsection
</x-layout>
