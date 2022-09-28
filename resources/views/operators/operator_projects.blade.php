<x-layout>
    <x-slot name="linkselected">
        operatorMyProjects
    </x-slot>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <div class="col-lg-3 p-0">
                <div class="bg-white border-radius-8 pt-4 pb-5 px-3">
                    <form id="searchMyOffers" action="{{ route('operator.myprojects.search') }}" method="post"
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
                                    <input class="styled-checkbox" id="viewall" type="checkbox"
                                        name="all" value="all">
                                    <label for="viewall">الكل</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox-control">
                                    <input class="styled-checkbox" id="latest" type="checkbox" name="selectedservices[]"
                                        value="latest">
                                    <label for="latest">الاحدث</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox-control">
                                    <input class="styled-checkbox" id="ongoing" type="checkbox"
                                        name="selectedservices[]" value="ongoing">
                                    <label for="ongoing">قيد التنفيذ</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox-control">
                                    <input class="styled-checkbox" id="completed" type="checkbox"
                                        name="selectedservices[]" value="completed">
                                    <label for="completed">تم التسليم</label>
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
                    <p class="counter-block-title">المشاريع المكتملة</p>
                    <p class="counter-block-number font-weight-bold font-Roboto mt-5 mb-4">
                        {{ sprintf('%02d', $previousProjects->where('offer_status_id', 4)->count()) }}
                    </p>
                    <p class="counter-block-desc mb-3">
                        مشاريع قمت بتسليمها
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
                <div class="border-radius-5 bg-white d-flex p-md-5 py-4 px-3">
                    <div class="loading-items text-center w-100" style="display: none">
                        <img src="{{ asset('images/spinner.gif') }}" alt="">
                    </div>
                    <ul class="account-doneprojects w-100">
                        @include('operators.operator_projects_items',['previousProjects'=>$previousProjects])
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
                    $('.account-doneprojects').css('display', 'none');
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        dataType: "json",
                        success: function(response) {
                            // showAlertSuccess(response.message);
                            $('.loading-items').css('display', 'none');
                            $('.account-doneprojects').html(response.data);
                            $('.account-doneprojects').css('display', 'block');
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
