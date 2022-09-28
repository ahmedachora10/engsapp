<x-layout>
    <x-slot name="linkselected">
        operator-explore
    </x-slot>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 col-md-12 px-xl-4">
                <h5 class="font-weight-bold">العديد من المشاريع الجديد في انتظار </h5>
                <form id="exploreSearchForm" action={{ route('operator.exploresearch') }} method="post"
                    class="input-explore d-flex flex-row mt-3">
                    <div class="dropdownlist">
                        <a href="#"
                            class="btn btn-select- btn-dropdown d-flex h-100 justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8.919" height="5.52"
                                viewBox="0 0 8.919 5.52">
                                <path id="Path_16" data-name="Path 16" d="M8043.73-137l-3.929,3.929L8035.872-137"
                                    transform="translate(-8035.341 137.53)" fill="none" stroke="#020621"
                                    stroke-width="1.5" />
                            </svg>
                        </a>
                        <div class="dropdownlist-content max-width">
                            <ul class="pl-4">
                                <li class="py-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="searchFreelancers"
                                            name="searchType" value="freelancers">
                                        <label class="custom-control-label" for="searchFreelancers">البحث عن
                                            مستقلين</label>
                                    </div>
                                </li>
                                <li class="py-3">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" checked id="searchProjects"
                                            name="searchType" value="projects">
                                        <label class="custom-control-label" for="searchProjects">البحث عن مشروع</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input class="search-input flex-grow-1 px-3" type="text" id="searchValue" name="searchValue"
                        autocomplete="off" placeholder="يمكنك البحث عن مشروع عن اسم مستقل ">
                    <button type="submit" class="btn-search-explore m-1">
                        بحث
                    </button>
                    <div class="loading-animate-center border-radius-5">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4 mb-3 mx-md-0">
            <div class="col-lg-3 mt-3 mt-lg-0 order-2 order-lg-1 p-0">
                <div class="bg-white border-radius-8 pt-4 pb-5 px-3">
                    <p class="operator-card-title mb-2">
                          @if (auth()->user()->user_type == 'company')
                                    معلومات المكتب الهندسي
                                @else
                                    معلومات المستقل
                                @endif
                    </p>
                    <div class="offer-user-info d-flex flex-row">
                        <img class="size67"
                            src="{{ auth()->user()->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => auth()->user()->profile_img]) : asset('images/logo.jpg') }}"
                            alt="">
                        <div class="d-flex flex-wrap align-items-center ml-3">
                            <div>
                                <div class="offer-user-info-name"
                                    style="font-size: 16px; font-weight: normal; line-height: 17px;">
                                    {{ auth()->user()->name }}
                                </div>

                                <div class="rating mt-2">
                                    <ul class="d-flex flex-row">
                                        @include('general.user_rates',['rate'=> auth()->user()->user_rates()])
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="freelancecompany-profile-bio mt-4 mb-3">
                        {{ auth()->user()->operatorProfile->bio_text }}
                    </p>
                    <div class="border-sidebar-custom"></div>
                    @php
                        $perc = auth()
                            ->user()
                            ->calculate_profile();
                    @endphp
                    <div class="progress-bar mt-4 mb-3">
                        <span id="accountProgress" class="bar perc-{{ $perc }}"></span>
                        <span id="accountProgressText" class="text">{{ $perc }}%</span>
                    </div>
                    <a href="{{ route('operator.accountSettings') }}" class="d-block mb-4">
                        الملف الشخصي
                    </a>
                    <div class="border-sidebar-custom"></div>
                    <p class="operator-card-title mt-3">
                        معلومات الشركة
                    </p>
                    <ul class="progress-bar-list mt-3">
                        <x-operator.progresschecklist></x-operator.progresschecklist>
                    </ul>
                </div>
                <div class="bg-white border-radius-8 py-4 mt-3 px-3 text-center counter-block">
                    <p class="counter-block-title">الرسائل الجديدة</p>
                    <p class="counter-block-number  font-weight-bold font-Roboto my-5">
                        {{ sprintf('%02d', $chatMsgs->unread_count) }}
                    </p>
                    <div class="border-sidebar-custom"></div>
                    <div class="d-flex flex-row justify-content-between mt-4">
                        <div class="counter-block-hint">
                            الرسائل الواردة
                        </div>
                        <div class="counter-block-hint-number font-Roboto">
                            {{ sprintf('%02d', $chatMsgs->total) }}
                        </div>
                    </div>
                </div>

                <div class="bg-white border-radius-8 py-4 mt-3 px-3 text-center">
                    <p class="counter-block-title">أعمالي</p>
                    <p class="counter-block-number font-weight-bold font-Roboto mt-5 mb-4">
                        {{ sprintf(
    '%02d',
    auth()->user()->user_portfolio->count(),
) }}
                    </p>
                    <p class="counter-block-desc mb-3">
                        يمكنك إضافة المزيد الي معرض الاعمال
                    </p>
                    <div class="border-sidebar-custom"></div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('operator.profile') }}" class="counter-block-hint-link"><span
                                class="font-weight-500">+</span> إضافة عمل</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 p-0 px-lg-3 requestRowsContainer">
                @include('operators.service_request_item', ['service_requests' => $service_requests])
            </div>
            <div class="col-lg-3 order-3 order-lg-3 p-0 mt-lg-0 mt-3">
                <div class="bg-white border-radius-8 py-4 px-3">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <p class="operator-card-title mb-2">
                            مجالات العمل الخاص بك
                        </p>
                        <a href="{{ route('operator.workFields') }}">
                            <img src="{{ asset('images/edit.svg') }}" alt="">
                        </a>
                    </div>
                    <ul class="freelancecompany-profile-fields d-flex flex-wrap row-cols-2 align-items-center">
                        @foreach ($currentUserServices as $user_service)
                            <li class="mb-2 {{ $loop->odd ? 'pr-2' : '' }}">
                                <span class="px-3">{{@ $user_service->service_category->parent_service->name }} <br> {{ @ $user_service->service_category->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                    @if ($currentUserServices->count() == 0)
                        <p class="text-center">لا يوجد مجالات عمل خاص بك ، يرجى متابعة الملف الشخصي الخاص بك</p>
                    @endif

                </div>
                <div class="bg-white border-radius-8 py-4 mt-3 px-3 text-center">
                    <p class="counter-block-title">عروضك المتبقية</p>
                    <p class="counter-block-number font-weight-bold font-Roboto mt-5 mb-4">28</p>
                    <p class="counter-block-desc mb-3">
                        عروض يمكنك تقديمها لمشاريع أخرى
                    </p>
                </div>
                <div class="bg-white border-radius-8 mt-3 py-4 px-3 account-sharing">
                    <p class="">مشاركة الحساب</p>
                    <div class="account-sharing-input  mt-3">
                        <input type="text" id="CopyURL"
                            value="{{ route('freelancecompanyprofile', ['user' => auth()->user()->id]) }}">
                        <a href="#" data-copying-info="تم نسخ الرابط!">
                            نسخ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/placeholder-loading.min.css') }}">
    @endsection
    @section('scripts')
        <script id="rowsLoadingTemplate" type="text/template">@include('operators.service_request_item_loading')</script>
        <script>
            $(function() {
                $('.btn-dropdown').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if ($(this).parent().hasClass('dropdownlist')) {
                        $(this).parent().find('.dropdownlist-content').toggleClass('show');
                    }

                });

                var form = $("#exploreSearchForm");
                var btn = $("#exploreSearchForm").find('button[type="submit"]');
                var rowsContainer = $('.requestRowsContainer');
                form.submit(function() {
                    // form.addClass('loading');
                    btn.attr("disabled", "disabled");
                    var template = $('#rowsLoadingTemplate').html();
                    rowsContainer.html(template);
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        dataType: "html",
                        success: function(response) {
                            // showAlertSuccess(response.message);

                            var response = $.parseJSON(response);
                            rowsContainer.html(response.data);
                            // console.log(response);
                            // console.log(response.data);
                            // $('.bookmarksList').html(response.data);
                        },
                        complete: function() {
                            // form.removeClass('loading');
                            btn.removeAttr("disabled");
                        }
                    });

                    return false;
                });



            })

        </script>
    @endsection
</x-layout>
