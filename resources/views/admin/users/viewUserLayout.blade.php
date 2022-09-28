@extends('layouts.admin.index')

@section('subHeaderClasses', 'subheader-enabled subheader-fixed subheader-mobile-fixed')


@section('content')
    <div class="d-flex flex-row">
        @yield('aside')
        @yield('UserContent')
    </div>
@endsection

@push('subHeader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-right mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bolder my-1 mr-5">عرض حساب : {{ $user->name }}</h5>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endpush


@push('scripts')
    <script src="{{ asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('adminAssets/assets/plugins/custom/formvalidation/AutoFocus.js') }}"></script>
    <script>
        $(function() {

            KTLayoutSubheader.init('kt_subheader');

            // Mobile offcanvas for mobile mode
            var offcanvas = new KTOffcanvas('kt_profile_aside', {
                overlay: true,
                baseClass: 'offcanvas-mobile',
                //closeBy: 'kt_user_profile_aside_close',
                toggleBy: 'kt_subheader_mobile_toggle'
            });

            var notificationForm = $('#sendNotificationForm');
            if (notificationForm.length > 0) {
                // alert('test)');
                // var form = $("#contactus-form");

                var validation = FormValidation.formValidation(
                    document.getElementById('sendNotificationForm'), {
                        fields: {
                            NotificationTitle: {
                                validators: {
                                    notEmpty: {
                                        message: 'الحقل إلزامي'
                                    },
                                }
                            },
                            NotificationMessage: {
                                validators: {
                                    notEmpty: {
                                        message: 'الحقل إلزامي'
                                    },
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            // Bootstrap Framework Integration
                            bootstrap: new FormValidation.plugins.Bootstrap(),
                            // Validate fields when clicking the Submit button
                            autoFocus: new FormValidation.plugins.AutoFocus(),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            // Submit the form when all fields are valid
                            // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        }
                    }
                );



                $('#btnSendNotification').on('click', function(e) {
                    validation.validate().then(function(status) {
                        if (status == "Valid") {
                            var btn = KTUtil.getById("btnSendNotification");
                            KTUtil.btnWait(btn, "spinner spinner-left spinner-white",
                                "جاري الارسال ...");
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.user.sendNotify') }}",
                                data: notificationForm.serialize(),
                                dataType: "json",
                                success: function(response) {
                                    $('#sendNotificationModel').modal('hide');
                                    Swal.fire({
                                        title: "تم ارسال الاشعار بنجاح!",
                                        icon: "success",
                                        confirmButtonText: "موافق",
                                    });
                                },
                                complete: function() {
                                    KTUtil.btnRelease(btn);
                                }
                            });
                            return false;
                        }
                    });
                    e.preventDefault();
                });

                $('#sendNotificationModel').on('hidden.bs.modal', function(
                    event) {
                    notificationForm.trigger("reset");
                    validation.resetForm();
                })

            }


            var _initMixedWidget14 = function() {
                var element = document.getElementById("kt_mixed_widget_14_chart");
                var height = parseInt(KTUtil.css(element, 'height'));

                if (!element) {
                    return;
                }

                var rateNumber = {{ $user->rates_avg_rating_value ? $user->rates_avg_rating_value : 0 }};
                var textNumber = rateNumber.toFixed(2);
                rateNumber = Math.round(rateNumber / 5 * 100);
                // console.log(rateNumber);
                var ColorLight = '';
                var Color = '';
                if (rateNumber >= 0 && rateNumber <= 45) {
                    ColorLight = KTApp.getSettings()['colors']['theme']['light']['danger'];
                    Color = KTApp.getSettings()['colors']['theme']['base']['danger'];
                } else if (rateNumber >= 46 && rateNumber <= 70) {
                    ColorLight = KTApp.getSettings()['colors']['theme']['light']['warning'];
                    Color = KTApp.getSettings()['colors']['theme']['base']['warning'];
                } else {
                    ColorLight = KTApp.getSettings()['colors']['theme']['light']['success'];
                    Color = KTApp.getSettings()['colors']['theme']['base']['success'];
                }

                var options = {
                    series: [rateNumber],
                    chart: {
                        height: height,
                        type: 'radialBar',
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: "65%"
                            },
                            dataLabels: {
                                showOn: "always",
                                name: {
                                    show: false,
                                    fontWeight: '700'
                                },
                                value: {
                                    color: KTApp.getSettings()['colors']['gray']['gray-700'],
                                    fontSize: "30px",
                                    fontWeight: '700',
                                    offsetY: 12,
                                    show: true,
                                    formatter: function(val) {
                                        return textNumber;
                                    }
                                }
                            },
                            track: {
                                background: ColorLight,
                                strokeWidth: '100%'
                            }
                        }
                    },
                    colors: [Color],
                    stroke: {
                        lineCap: "round",
                    },
                    labels: ["Progress"]
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            }


            _initMixedWidget14();

            $(document).on('click', '.btnSubmitUserDetailsForm', function(e) {
                $('#userDetailsForm').submit();
            });

            var demo1 = $('.autosise_textarea');
            autosize(demo1);
            autosize.update(demo1);




        });

    </script>
@endpush
