<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.accountSettings') }}">
                {{ __('main.accountSettings') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('operator.workFields')}}">
                مجالات العمل
            </a>
        </li>
    </x-breadcrumb>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-operator.sidebar>
                <x-slot name="linkselected">
                    work-fields
                </x-slot>
            </x-operator.sidebar>
            <div class="col-lg-9 pl-xl-3">
                <div class="border-radius-8 bg-white d-flex flex-column p-md-5 py-4 px-3">
                    <x-alert />
                    <form id="save_user_services" action="{{ route('operator.workFields') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="mb-">مجالات العمل</h1>
                                <p class="mb-4">يمكنك تحديد مجموعة من مجالات العمل حسب تنصيف شركة من قبل إدارة المنصة
                                </p>
                            </div>
                        </div>
                        <div class="row work-fields-links-header">
                            <div class="col-md-12">
                                <ul class="d-flex justify-content-around">
                                    @foreach ($service_types as $service)


                                        <li>
                                            <a href="#" class={{ $loop->first ? 'active' : '' }}>
                                                {{ $service->name }}
                                            </a>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 work-fields-tabs">
                                <div class="tab-1">
                                    <div class="subservices-checklist ">
                                        <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1">
                                            @foreach ($services_projects as $service)
                                                @if($service->id == 75)
                                                    @if(auth()->user()->operatorProfile->arbitrationcert_confirmed == 1)
                                                        <li>
                                                            <div class="checkbox-control">
                                                                <input class="styled-checkbox" id="service{{ $service->id }}"
                                                                       type="checkbox" name="selectedservices[]"
                                                                       {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                                       value="{{ $service->id }}">
                                                                <label
                                                                    for="service{{ $service->id }}">{{ $service->name }}</label>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @continue
                                                @endif
                                                <li>
                                                    <div class="checkbox-control">
                                                        <input class="styled-checkbox" id="service{{ $service->id }}"
                                                            type="checkbox" name="selectedservices[]"
                                                            {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                            value="{{ $service->id }}">
                                                        <label
                                                            for="service{{ $service->id }}">{{ $service->name }}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @if (auth()->user()->user_type == 'company')
                                <div class="tab-2" style="display:none;">
                                    <div class="subservices-checklist ">
                                        <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1">
                                            @foreach ($services_consult as $service)
                                                <li>
                                                    <div class="checkbox-control">
                                                        <input class="styled-checkbox" id="service{{ $service->id }}"
                                                            type="checkbox" name="selectedservices[]"
                                                            {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                            value="{{ $service->id }}">
                                                        <label
                                                            for="service{{ $service->id }}">{{ $service->name }}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <div class="tab-3" style="display:none;">
                                    <div class="subservices-checklist ">
                                        <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1">
                                            @foreach ($services_judge as $service)

                                                @if (auth()->user()->user_type == 'company' && $service->decription=='IN_OFFICE')
                                                <li>
                                                    <div class="checkbox-control">
                                                        <input class="styled-checkbox" id="service{{ $service->id }}"
                                                            type="checkbox" name="selectedservices[]"
                                                            {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                            value="{{ $service->id }}">
                                                        <label
                                                            for="service{{ $service->id }}">{{ $service->name }}</label>
                                                    </div>
                                                </li>
                                                @elseif (auth()->user()->user_type == 'company' && auth()->user()->operatorProfile->arbitrationcert_confirmed ==1 && $service->decription == 'IN_OFFICE_CON')
                                                    <li>
                                                        <div class="checkbox-control">
                                                            <input class="styled-checkbox" id="service{{ $service->id }}"
                                                                   type="checkbox" name="selectedservices[]"
                                                                   {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                                   value="{{ $service->id }}">
                                                            <label
                                                                for="service{{ $service->id }}">{{ $service->name }}</label>
                                                        </div>
                                                    </li>
                                                @elseif (auth()->user()->user_type != 'company' && $service->decription!='IN_OFFICE' && $service->decription != 'IN_OFFICE_CON')
                                                    <li>
                                                        <div class="checkbox-control">
                                                            <input class="styled-checkbox" id="service{{ $service->id }}"
                                                                   type="checkbox" name="selectedservices[]"
                                                                   {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                                   value="{{ $service->id }}">
                                                            <label
                                                                for="service{{ $service->id }}">{{ $service->name }}</label>
                                                        </div>
                                                    </li>

                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-4" style="display:none;">
                                    <div class="subservices-checklist ">
                                        <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1">
                                            @foreach ($services_visit as $service)
                                                @if($service->id == 72 && auth()->user()->user_type == 'freelancer')
                                                    @if(auth()->user()->operatorProfile->test_quality_confirmed == 1)
                                                        <li>
                                                            <div class="checkbox-control">
                                                                <input class="styled-checkbox" id="service{{ $service->id }}"
                                                                       type="checkbox" name="selectedservices[]"
                                                                       {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                                       value="{{ $service->id }}">
                                                                <label
                                                                    for="service{{ $service->id }}">{{ $service->name }}</label>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @continue
                                                @endif
                                                @if($service->id == 74 && auth()->user()->user_type == 'freelancer')
                                                    @if(auth()->user()->operatorProfile->test_quality_confirmed == 1)
                                                        <li>
                                                            <div class="checkbox-control">
                                                                <input class="styled-checkbox" id="service{{ $service->id }}"
                                                                       type="checkbox" name="selectedservices[]"
                                                                       {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                                       value="{{ $service->id }}">
                                                                <label
                                                                    for="service{{ $service->id }}">{{ $service->name }}</label>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @continue
                                                @endif
                                                @if($service->id == 73 && auth()->user()->user_type == 'freelancer')
                                                    @if(auth()->user()->operatorProfile->test_build_confirmed == 1)
                                                        <li>
                                                            <div class="checkbox-control">
                                                                <input class="styled-checkbox" id="service{{ $service->id }}"
                                                                       type="checkbox" name="selectedservices[]"
                                                                       {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                                       value="{{ $service->id }}">
                                                                <label
                                                                    for="service{{ $service->id }}">{{ $service->name }}</label>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @continue
                                                @endif
                                                <li>
                                                    <div class="checkbox-control">
                                                        <input class="styled-checkbox" id="service{{ $service->id }}"
                                                            type="checkbox" name="selectedservices[]"
                                                            {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                            value="{{ $service->id }}">
                                                        <label
                                                            for="service{{ $service->id }}">{{ $service->name }}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @if (auth()->user()->user_type == 'company')
                                    <div class="tab-5" style="display:none;">
                                        <div class="d-flex flex-row mb-3">
                                            @foreach ($services_licence as $service)
                                                <div
                                                    class="custom-control custom-radio {{ $loop->first ? 'mr-4' : '' }}">
                                                    <input type="radio" class="custom-control-input"
                                                        id="LicenseId{{ $service->id }}" name="lienceType"
                                                        {{ $loop->first ? 'checked' : '' }}
                                                        value="{{ $service->id }}">
                                                    <label class="custom-control-label"
                                                        for="LicenseId{{ $service->id }}">{{ $service->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="licence-options-cards options-cards">
                                            @foreach ($subservices as $subservice)
                                                <div class="d-flex flex-row subServices"
                                                    style="{{ $loop->first ? '' : 'display: none !important' }}"
                                                    data-subservice-id="{{ $subservice['serviceParentId'] }}">
                                                    @foreach ($subservice['subservices'] as $service)
                                                        <div class="flex-fill">
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
                                        <div class="subservices-custom-container mt-3">
                                            @foreach ($licence_subCategories as $licence_subCategory)
                                                <div style="display: none;" class="data-licence-services"
                                                    data-licence-service-id="{{ $licence_subCategory['serviceParentId'] }}">
                                                    <div class="subservices-checklist ">
                                                        <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1">
                                                            @foreach ($licence_subCategory['subservices'] as $service)
                                                                <li>
                                                                    <div class="checkbox-control">
                                                                        <input class="styled-checkbox"
                                                                            id="service{{ $service->id }}"
                                                                            type="checkbox" name="selectedservices[]"
                                                                            {{ in_array($service->id, $currentUserServices) ? 'checked' : '' }}
                                                                            value="{{ $service->id }}">
                                                                        <label
                                                                            for="service{{ $service->id }}">{{ $service->name }}</label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary has-shadow btn-46 d-inline-block">
                                    <span class="text">حفظ التعديلات</span>
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
        </div>
    </div>
    @section('scripts')
        <script>
            $(function() {

                $('input[name="lienceType"]').on('change', function(e) {
                    $('.subServices').attr('style', 'display: none !important');
                    $('.data-licence-services').attr('style', 'display: none !important');
                    $('.subServices[data-subservice-id="' + $(this).val() + '"]').removeAttr('style');
                    $('input[name="projectType"]').prop('checked', false);
                });
                var tabsHeader = $('.work-fields-links-header');
                var tabs = $('.work-fields-tabs');


                $('.work-fields-links-header a').on('click', function(e) {
                    e.preventDefault();
                    var index = $(this).parent().index();
                    tabsHeader.find('a').removeClass('active');
                    $(this).addClass('active');
                    tabs.children().hide();
                    tabs.children().eq(index).show();
                    AOS.refresh();
                });

                $('input[name="projectType"]').on('click', function(e) {
                    $('.data-licence-services').attr('style', 'display: none !important');
                    $('.data-licence-services[data-licence-service-id="' + $(this).val() + '"]').show();
                });


                var form = $("#save_user_services");

                form.submit(function() {
                    var btn = $(this).find("button[type='submit']");

                    btn.addClass('loading').prop('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        // processData: false,
                        data: form.serialize(),
                        dataType: "json",
                        success: function(response) {
                            showAlertSuccess(response.message);
                            // updateAccountProgress(response.accountPerc);
                        },
                        complete: function() {
                            btn.removeAttr("disabled").removeClass('loading');
                        }
                    });


                    return false;
                });






            })

        </script>

    @endsection
</x-layout>
