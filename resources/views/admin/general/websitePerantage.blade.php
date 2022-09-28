@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        نسبة خصم الموقع
                    </h3>
                </div>

                <!--begin::Form-->
                <form id="website_perc_form" method="POST" action="{{ route('admin.settings.perc') }}">
                    @csrf
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
                        <div class="form-group mb-8">
                            <div class="alert alert-custom alert-default" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                                <div class="alert-text">
                                    لا يوجد تراجع عن هذه الخطوة ، سيتم اعتماد النسبة بشكل نهائي عند الحفظ
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="separator separator-dashed my-10"></div>
                            <div class="form-group row mb-6">
                                <label class="col-form-label text-lg-right  col-lg-3 col-sm-12">نسبة الموقع</label>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="kt_nouislider_5_input"
                                                name="percentage" placeholder="نسبة الموقع" />
                                        </div>
                                        <div class="col-8">
                                            <div id="kt_nouislider_5"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <span class="form-text text-muted mt-6">اخر تحديث بتاريخ :
                                        {{ $website_per->updated_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                        <button type="reset" class="btn btn-secondary">الغاء الامر</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{-- <script src="{{ asset('adminAssets/assets/js/pages/crud/forms/widgets/nouislider.js') }}"></script> --}}
    <script>
        $(function() {
            // var demo5 = function() {
            // init slider
            var slider = document.getElementById('kt_nouislider_5');

            noUiSlider.create(slider, {
                start: {{ $website_per->percentage }},
                range: {
                    min: 0,
                    max: 100
                },
                format: wNumb({
                    decimals: 0
                }),
                pips: {
                    mode: 'values',
                    values: [0, 100],
                    density: 5
                }
            });

            var sliderInput = document.getElementById('kt_nouislider_5_input');

            slider.noUiSlider.on('update', function(values, handle) {
                sliderInput.value = values[handle];
            });

            sliderInput.addEventListener('change', function() {
                slider.noUiSlider.set(this.value);
            });

            FormValidation.formValidation(
                document.getElementById('website_perc_form'), {
                    fields: {
                        percentage: {
                            validators: {
                                notEmpty: {
                                    message: 'حقل نسبة الموقع مطلوب'
                                },
                                digits: {
                                    message: 'الرجاء ادخال قيمة رقمية'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        // Validate fields when clicking the Submit button
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    }
                }
            );

        });

    </script>
@endpush
