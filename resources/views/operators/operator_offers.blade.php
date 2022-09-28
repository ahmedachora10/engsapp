<x-layout>
    <x-slot name="linkselected">
        operatorMyOffers
    </x-slot>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <div class="col-lg-3 p-0">
                <div class="bg-white border-radius-8 pt-4 pb-5 px-3">
                    <form id="searchMyOffers" action="{{ route('operator.myoffers.search') }}" method="post"
                        class="searchProjects d-flex flex-column search-options-form">
                        <p class="options-title">بحث</p>
                        <div class="search-input-container mt-1">
                            <input class="search-input" type="text" id="searchValue" name="searchValue"
                                placeholder="اسم المشروع">
                            <a href="#" class="btn-search-explore">

                            </a>
                        </div>
                        <p class="options-title mt-3">حالة العرض</p>
                        <ul class="search-options-list mt-3">
                            <li>
                                <div class="checkbox-control">
                                    <input class="styled-checkbox" id="latest" type="checkbox" name="latest"
                                        value="latest">
                                    <label for="latest">الاحدث</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox-control">
                                    <input class="styled-checkbox" id="1" type="checkbox" name="selectedservices[]"
                                        value="1">
                                    <label for="1">في انتظار الرد</label>
                                </div>
                            </li>

                            <li>
                                <div class="checkbox-control">
                                    <input class="styled-checkbox" id="2" type="checkbox" name="selectedservices[]"
                                        value="2">
                                    <label for="2">مقبول</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox-control">
                                    <input class="styled-checkbox" id="3" type="checkbox" name="selectedservices[]"
                                        value="3">
                                    <label for="3">ملغي</label>
                                </div>
                            </li>
                        </ul>
                        <button type="submit" class="btn btn-primary has-shadow mt-4 btn-46">
                            <span class="text">عرض النتائج</span>
                            <div class="loading-animate">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </button>
                    </form>
                </div>
                <div class="bg-white border-radius-8 py-4 mt-3 px-3 text-center">
                    <p class="counter-block-title">عروضك المتبقية</p>
                    <p class="counter-block-number font-weight-bold font-Roboto mt-5 mb-4">28</p>
                    <p class="counter-block-desc mb-3">
                        عروض يمكنك تقديمها لمشاريع أخرى
                    </p>
                </div>
                <div class="bg-white border-radius-8 py-4 mt-2 px-3">
                    <p class="account-bar-title">معلومات ملفك الحالي</p>
                    <div class="progress-bar mb-4">
                        @php
                            $perc = auth()
                                ->user()
                                ->calculate_profile();
                        @endphp
                        <span id="accountProgress" class="bar perc-{{ $perc }}"></span>
                        <span id="accountProgressText" class="text">{{ $perc }}%</span>
                    </div>
                    <div class="border-sidebar-custom"></div>
                    <ul class="progress-bar-list mt-3">
                        <x-operator.progresschecklist></x-operator.progresschecklist>
                    </ul>
                </div>
            </div>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0">
                <div class="border-radius-5 bg-white d-flex flex-column p-md-5 py-4 px-3">
                    <div class="loading-items text-center w-100" style="display: none">
                        <img src="{{ asset('images/spinner.gif') }}" alt="">
                    </div>
                    <ul class="operator_offers_list w-100">
                        @include('operators.operator_offers_items',['previousProjects'=>$previousProjects])
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(function() {
                var form = $("#searchMyOffers");
                var btn = $("#searchMyOffers").find('button[type="submit"]');
                form.submit(function() {
                    form.addClass('loading');
                    btn.attr("disabled", "disabled");
                    $('.loading-items').css('display', 'block');
                    $('.operator_offers_list').css('display', 'none');
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        dataType: "json",
                        success: function(response) {
                            // showAlertSuccess(response.message);
                            $('.loading-items').css('display', 'none');
                            $('.operator_offers_list').html(response.data);
                            $('.operator_offers_list').css('display', 'block');
                            // console.log(response.data);
                            // var response = $.parseJSON(response);
                            // console.log(response.data);
                            // $('.bookmarksList').html(response.data);
                        },
                        complete: function() {
                            form.removeClass('loading');
                            btn.removeAttr("disabled");
                        }
                    });

                    return false;
                });
            })

        </script>
    @endsection
</x-layout>
