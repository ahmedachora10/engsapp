<x-layout>
    <div class="register-page" data-aos="fade-down-menu">
        <div class="container">
            @if ($errors->user->any())
                <div class="d-none user-errors page-has-errors">
                    <ul>
                        @foreach ($errors->user->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($errors->company->any())
                <div class="d-none company-errors page-has-errors">
                    <ul>
                        @foreach ($errors->company->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($errors->freelancer->any())
                <div class="d-none freelancer-errors page-has-errors">
                    <ul>
                        @foreach ($errors->freelancer->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-xl-9 rounded-7 bg-white px-md-5 pb-5" style="margin-top: 12px">
                    <h5 class="font-weight-bold text-center mt-4">{{ __('form.createanaccount') }}</h5>
                    <a class="btn-back d-inline-block my-2 mb-lg-0 mb-4"
                        href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                    <div class="tabs-header mb-4">
                        <div class="d-flex justify-content-center flex-column flex-md-row">
                            <a href="#" id="company-tab"
                                class="active mr-0 mr-md-2 mb-3 mb-md-0">{{ __('form.engineeringoffice') }}</a>
                            <a href="#" id="freelancer-tab"
                                class="mr-0 mr-md-2 mb-3 mb-md-0">{{ __('form.freelancers') }}</a>
                            <a href="#" id="user-tab">{{ __('form.user') }}</a>
                        </div>
                    </div>
                    <div class="register-form tabs-content">
                        <div id="company-tab">
                            @include('auth.company')
                        </div>
                        <div id="freelancer-tab">
                            @include('auth.freelancer')
                        </div>
                        <div id="user-tab">
                            @include('auth.user')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(function() {

                if ($('.company-errors').length) {
                    $('.register-form').slick('slickGoTo', 0);
                }

                if ($('.freelancer-errors').length) {
                    $('.register-form').slick('slickGoTo', 1);
                }

                if ($('.user-errors').length) {
                    $('.register-form').slick('slickGoTo', 2);
                }



                var validatorCompany = $("#company-register").validate({
                    rules: {
                        companylicencefile: {
                            required: true,
                            accept: "image/jpeg,image/png,application/pdf"
                        },
                    },
                    messages: {
                        companylicencefile: {
                            accept: "{{ __('form.validatemessages.pdfjpg') }}"
                        }
                    },
                    showErrors: function(errorMap, errorList) {
                        this.defaultShowErrors();
                        var slideHeight = $('.register-form').find(".slick-list").find(
                            '.slick-active').height();
                        $('.register-form').find(".slick-list").animate({
                            height: slideHeight
                        });
                    },
                });


                $("#companylicencefile").change(function() {
                    validatorCompany.element("#companylicencefile");
                });




                var validatorFreelancer = $("#freelancer-register").validate({
                    rules: {
                        membershipattachment: {
                            required: true,
                            accept: "image/jpeg,image/png,application/pdf"
                        },
                        occupation: {
                            required: true
                        }
                    },
                    messages: {
                        membershipattachment: {
                            accept: "{{ __('form.validatemessages.pdfjpg') }}"
                        }
                    },
                    showErrors: function(errorMap, errorList) {
                        this.defaultShowErrors();
                        var slideHeight = $('.register-form').find(".slick-list").find(
                            '.slick-active').height();
                        $('.register-form').find(".slick-list").animate({
                            height: slideHeight
                        });
                    },
                });


                $("#membershipattachment").change(function() {
                    validatorFreelancer.element("#membershipattachment");
                });

                $("#user-register").validate({
                    showErrors: function(errorMap, errorList) {
                        this.defaultShowErrors();
                        var slideHeight = $('.register-form').find(".slick-list").find(
                            '.slick-active').height();
                        $('.register-form').find(".slick-list").animate({
                            height: slideHeight
                        });
                    },
                });

            });

        </script>
    @endsection

</x-layout>
