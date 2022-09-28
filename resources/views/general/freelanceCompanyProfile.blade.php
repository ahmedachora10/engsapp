<x-layout>
    <div class="mt-3 offer-request-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-0 px-xl-3">
                    <div class="d-flex dashboard-backbutton-container flex-column justify-content-center">
                        <a class="btn-back text-white"
                            href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                    </div>
                    <div class="row no-gutters pt-2 pb-3">
                        <div class="col-md-8 bg-white freelancecompany-profile border-radius-5 py-4 px-4">
                            <p class="title mb-2">
                                @if ($operator->user_type == 'company')
                                    معلومات المكتب الهندسي
                                @else
                                    معلومات المستقل
                                @endif
                            </p>
                            <div class="offer-user-info d-flex flex-row">
                                <img class="size67"
                                    src="{{ $operator->profile_img ? route('imagecache', ['filename' => $operator->profile_img, 'template' => 'profile']) : asset('images/logo.jpg') }}"
                                    alt="">
                                <div class="d-flex flex-wrap align-items-center ml-3">
                                    <div>
                                        <div class="offer-user-info-name ">
                                            {{ $operator->name }}
                                        </div>
                                        <div class="offer-user-info-join-date mt-2">تاريخ الانضمام
                                            <span class="date">
                                                {{ date('d-m-Y', strtotime($operator->created_at)) }}
                                            </span>
                                        </div>
                                        <div class="rating mt-2">
                                            <ul class="d-flex flex-row">
                                                @include('general.user_rates',['rate'=>$operator->user_rates()])
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="freelancecompany-profile-bio mt-4 mb-3">
                                {!! str_replace(PHP_EOL,'<br>',$operator->operatorProfile->bio_text) !!}
                            </p>
                            <div class="border-custom"></div>
                            <p class="title mb-2 mt-3">
                                مجالات العمل
                            </p>
                            <ul class="freelancecompany-profile-fields d-flex flex-row flex-wrap">
                                @foreach ($operator->user_services as $service)
                                    <li class="mb-2 pr-2">
                                        <span class="px-3">{{ $service->service_category->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4 pl-3">
                            <div class="bg-white border-radius-5 py-4 px-3">
                                <ul class="user-status-list">
                                    <li class="d-flex flex-row justify-content-between align-items-center px-4">
                                        <span class="title">تأكيد الحساب</span>
                                        <div class="confirmed d-flex align-items-center">
                                            @if ($operator->confirmed)
                                                <span class="mr-2">مؤكد</span>
                                                <img src="{{ asset('images/check-small.svg') }}" alt="">
                                            @else
                                                <span class="mr-2">غير مؤكد</span>
                                                <img src="{{ asset('images/empty-check.svg') }}" alt="">
                                            @endif
                                        </div>
                                    </li>
                                    <li class="d-flex flex-row justify-content-between align-items-center px-4">
                                        <span class="title">مشاريع مكتملة</span>
                                        <span class="number">
                                            {{ sprintf('%02d', $totalCompletedOffers) }}
                                        </span>
                                    </li>
                                    <li class="d-flex flex-row justify-content-between align-items-center px-4">
                                        <span class="title">اوسمة المنصة</span>
                                        <span>
                                            <img src="{{ asset('images/silver-medal.svg') }}" alt="">
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="bg-white border-radius-5 mt-3 py-4 px-4 account-sharing">
                                <p class="">مشاركة الحساب</p>
                                <div class="account-sharing-input  mt-3">
                                    <input type="text" id="CopyURL"
                                        value="{{ route('freelancecompanyprofile', ['user' => $operator->id]) }}">
                                    <a href="#" data-copying-info="تم نسخ الرابط!">
                                        نسخ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="account-info-tabs-header col-md-12 bg-white px-4">
                            <ul class="d-flex flex-row justify-content-center justify-content-lg-start">

                                @if(false)
                                <li class="mr-3 mr-md-5">
                                    <a href="#" class="active">معلومات التواصل</a>
                                </li>
                                @endif
                                <li class="mr-3 mr-md-5">
                                    <a href="#" class="active">معرض الاعمال</a>
                                </li>
                                <li class="mr-3 mr-md-5">
                                    <a href="#">مشاريع سابقة</a>
                                </li>
                                <li>
                                    <a href="#">التقييم</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="account-info-tabs">

                         @if(false)
                        <div class="row no-gutters account-info-tab mt-3">


                            <div class="col-md-12 bg-white px-4 py-4">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <p class="title">معلومات التواصل</p>
                                    </div>
                                </div>
                                <div class="row no-gutters mt-4">
                                    <div class="col-md-4 d-flex flex-column justify-content-center px-3">
                                        <div class="form-group">
                                            <label for="useremail">{{ __('form.username') }}</label>
                                            <a href="mailto:Info@selsela.net">
                                                <span class="has-icon email-icon">
                                                    <input type="email" class="form-control bg-white" disabled disabled
                                                        id="useremail" name="useremail"
                                                        value="{{ $operator->email }}">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <label for="usermobilenumber">{{ __('form.mobilenumber') }}</label>
                                            <a href="tel:+9665912465789">
                                                <span class="has-icon phone-icon">
                                                    <input type="text"
                                                        class="form-control text-left rule-number bg-white"
                                                        style="direction: ltr;" id="usermobilenumber"
                                                        name="usermobilenumber" disabled disabled
                                                        value="+{{ $operator->country_code_phone_number . $operator->phone_number }}">
                                                </span>
                                            </a>
                                        </div>
                                        <p class="mt-2 mb-3">مواقع التواصل الاجتماعي</p>
                                        <ul class="d-flex flex-row">
                                            <li class="mr-2">
                                                <a href="{{ $operator->user_type == 'company' ? $operator->operatorProfile->company_instagram : $operator->operatorProfile->freelancer_instagram }}"
                                                    target="_blank">
                                                    @include('svgIcons.insta-block')
                                                </a>
                                            </li>
                                            <li class="mr-2">
                                                <a href="{{ $operator->user_type == 'company' ? $operator->operatorProfile->company_twitter : $operator->operatorProfile->freelancer_twitter }}"
                                                    target="_blank">
                                                    @include('svgIcons.twitter-block')
                                                </a>
                                            </li>
                                            <li class="mr-2">
                                                <a href="{{ $operator->user_type == 'company' ? $operator->operatorProfile->company_facebook : $operator->operatorProfile->freelancer_facebook }}"
                                                    target="_blank">
                                                    @include('svgIcons.facebook-block')
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-7 d-flex justify-content-end px-3">
                                        <img src="{{ asset('images/info-card.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif
                        <div class="row no-gutters account-works mt-3">
                            <div class="col-md-12 bg-white px-4 py-4">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <p class="title">اعمال المضافة ( <span
                                                class="number">{{ $works->count() }}</span> )</p>
                                    </div>
                                </div>
                                <div class="border-custom mt-4"></div>
                                <div class="row mt-4 portfolio-items">
                                    @if ($works->count() == 0)
                                        <div class="col-md-12 text-center my-5 NoWorks">
                                            <h5> لا يوجد اعمال مضافة </h5>
                                        </div>
                                    @endif
                                    @foreach ($works as $work)
                                        @include('operators.operator_portfolio_item',['work'=>$work])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters  mt-3" style="display: none;">
                            <div class="col-md-12 bg-white px-4 py-4">
                                <div class="row no-gutters">
                                    <ul class="account-doneprojects w-100">
                                        @if ($previousProjects->count() == 0)
                                            <li class="my-4 text-center">
                                                <h5>لا يوجد مشاريع سابقه</h5>
                                            </li>
                                        @endif
                                        @foreach ($previousProjects as $offer)
                                            @php
                                                $labelStatus = 'label-new';
                                                switch ($offer->offer_status_id) {
                                                    case '1':
                                                        $labelStatus = 'label-new';
                                                        break;
                                                    case '2':
                                                        $labelStatus = 'label-new';
                                                        break;
                                                    case '3':
                                                        $labelStatus = 'label-warning';
                                                        break;
                                                    case '4':
                                                        $labelStatus = 'label-success';
                                                        break;
                                                    default:
                                                        $labelStatus = 'label-new';
                                                        break;
                                                }
                                            @endphp
                                            <li class="mb-4">
                                                <span
                                                    class="label {{ $labelStatus }}">{{ $offer->offer_status->name }}</span>
                                                <a href="{{ route('request.view', ['service_request' => $offer->request->id]) }}"
                                                    class="project-title d-block mt-2">
                                                    {{ $offer->request->title }}
                                                </a>
                                                <div class="mb-2 mt-2 project-details-services ">
                                                    <ul class="d-flex flex-row flex-wrap pr-5">
                                                        @foreach ($offer->request->requested_services as $requested_service)
                                                            <li class="small-footprint">
                                                                <span>{{ $requested_service->name }}</span>
                                                            </li>
                                                        @endforeach
                                                        <li class="small-footprint date">
                                                            <span>
                                                                {{ date('d-m-Y', strtotime($offer->request->created_at)) }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters mt-3" style="display: none;">
                            <div class="col-md-12 bg-white px-4 py-4">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <p class="title">تقييمات وأراء العملاء</p>
                                    </div>
                                </div>
                                <div class="row no-gutters account-rates mt-4">
                                    <div class="col-md-12 px-5">
                                        @if ($reviews->count() == 0)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="text-center">لا يوجد تقييمات لعرضها</h5>
                                                </div>
                                            </div>
                                        @endif
                                        @foreach ($reviews as $review)
                                            <div class="d-flex flex-row py-4 {{ $loop->even ? 'bg-even' : '' }}">
                                                {{-- <div class="col-md-1"></div> --}}
                                                <div class="col-md-8">
                                                    <div class="users-rating-block">
                                                        <a href="{{ route('request.view', ['service_request' => $review->request->id]) }}"
                                                            class="title">{{ $review->request->title }}</a>
                                                        <div class="mt-2 project-details-services ">
                                                            <ul class="d-flex flex-row flex-wrap pr-5">
                                                                @foreach ($review->request->requested_services as $requested_service)
                                                                    <li class="small-footprint">
                                                                        <span>{{ $requested_service->name }}</span>
                                                                    </li>
                                                                @endforeach
                                                                <li class="small-footprint date w-100">
                                                                    <span>
                                                                        {{ date('d-m-Y', strtotime($review->request->created_at)) }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        @if ($review->admin_isshown == true)
                                                            <p class="rating-comment mb-3">
                                                                {{ $review->review_msg }}
                                                            </p>
                                                        @endif
                                                        <ul class="rating-list">
                                                            <li class="d-flex flex-row align-items-center mb-2">
                                                                <div class="rating-list-title">سرعة الرد :</div>
                                                                <div class="rating">
                                                                    <ul class="d-flex flex-row">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <li
                                                                                class="{{ $i <= $review->rate_speed ? 'active' : '' }}">
                                                                                <span></span>
                                                                            </li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li class="d-flex flex-row align-items-center mb-2">
                                                                <div class="rating-list-title">جودة العمل :</div>
                                                                <div class="rating">
                                                                    <ul class="d-flex flex-row">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <li
                                                                                class="{{ $i <= $review->rate_quality ? 'active' : '' }}">
                                                                                <span></span>
                                                                            </li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li class="d-flex flex-row align-items-center">
                                                                <div class="rating-list-title">تكلفة العمل :</div>
                                                                <div class="rating">
                                                                    <ul class="d-flex flex-row">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <li
                                                                                class="{{ $i <= $review->rate_cost ? 'active' : '' }}">
                                                                                <span></span>
                                                                            </li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    @endsection
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script src="{{asset('pdf/pdfThumbnails.js')}}" data-pdfjs-src="{{asset('pdf/pdfjs/pdf.js')}}"></script>
        <script>
            $(function() {

                var tabsHeader = $('.account-info-tabs-header');
                var tabs = $('.account-info-tabs');

                $('.account-info-tabs-header a').on('click', function(e) {
                    e.preventDefault();
                    var index = $(this).parent().index();
                    tabsHeader.find('a').removeClass('active');
                    $(this).addClass('active');
                    tabs.children().hide();
                    tabs.children().eq(index).show();
                    AOS.refresh();
                });


            });

        </script>
    @endsection
</x-layout>
