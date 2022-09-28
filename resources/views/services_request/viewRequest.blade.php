<x-layout>
    <div class="mt-3 service-request-page">
        @if (isset($offerRejected))
            <div class="container">
                <div class="row no-gutters bg-white py-4 px-3 mt-3 mb-4 justify-content-center">
                    <h5>تم استبعادك عرضك المقدم</h5>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-0 px-xl-3">
                        <div class="d-flex dashboard-backbutton-container flex-column justify-content-center">
                            <a class="btn-back text-white"
                                href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                        </div>
                        <div class="row no-gutters bg-white py-4">
                            <div class="align-items-center col-lg-7 d-flex justify-content-center offset-lg-1 px-3">

                                @php
                                    $stage = $service_request->service_request_stage_id;
                                @endphp
                                @if ($stage == 6)
                                    <div class="row stages justify-content-center">
                                        <div class="col-3 stage-step unactive align-items-center d-flex flex-column">
                                            <div class="stage-step-icon">
                                                <span class="stage-step-icon-check">
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </div>
                                            <div class="stage-step-text">تم الغاء المشروع </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row stages">
                                        <div
                                            class="col-3 stage-step {{ $stage >= 1 && $stage <= 5 ? 'active' : '' }} align-items-center d-flex flex-column">
                                            <div class="stage-step-icon">
                                                <span class="stage-step-icon-check">
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </div>
                                            <div class="stage-step-text">مرحلة تلقي العروض</div>
                                        </div>
                                        <div
                                            class="col-3 stage-step {{ $stage >= 2 && $stage <= 5 ? 'active' : '' }}  align-items-center d-flex flex-column">
                                            <div class="stage-step-icon">
                                                <span class="stage-step-icon-check">
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </div>
                                            <div class="stage-step-text">مرحلة قبول العروض</div>
                                        </div>
                                        <div
                                            class="col-3 stage-step {{ $stage >= 3 && $stage <= 5 ? 'active' : '' }} align-items-center d-flex flex-column">
                                            <div class="stage-step-icon">
                                                <span class="stage-step-icon-check">
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </div>
                                            <div class="stage-step-text">مرحلة التنفيذ</div>
                                        </div>
                                        <div
                                            class="col-3 stage-step {{ $stage >= 4 && $stage <= 5 ? 'active' : '' }} align-items-center d-flex flex-column">
                                            <div class="stage-step-icon">
                                                <span class="stage-step-icon-check">
                                                    <span></span>
                                                    <span></span>
                                                </span>
                                            </div>
                                            <div class="stage-step-text">مرحلة التسليم</div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div
                                class="col-lg-3 offset-lg-1 mt-3 mt-lg-0 px-3 align-items-center d-flex justify-content-center flex-wrap">
                                <div class="dropdownlist" style="z-index: 15">
                                    <a href="#" class="btn btn-46 btn-serivce-options btn-dropdown">
                                        خيارات المشروع
                                    </a>
                                    <div class="dropdownlist-content max-width">
                                        <ul>
                                            <li>
                                                @php
                                                    $bookMarkStatus = $service_request->bookmarkStatus($service_request->id);
                                                @endphp
                                                <a href="#" data-method="{{ $bookMarkStatus ? 'remove' : 'add' }}"
                                                    data-bookmark-id="{{ $bookMarkStatus ? $bookMarkStatus->id : '' }}"
                                                    class="btn-addBookmark icon
                                                {{ $bookMarkStatus ? 'icon-fav-cancel' : 'icon-fav' }}">
                                                    <span class="bookmark-text">
                                                        @if ($bookMarkStatus)
                                                            ازالة من المفضلة
                                                        @else
                                                            إضافة للمفضلة
                                                        @endif
                                                    </span>
                                                    <div class="loading-animate-center border-radius-5">
                                                        <div class="lds-ellipsis">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            @if (auth()->user()->user_type == 'user')
                                                @if ($service_request->service_request_stage_id < 3)
                                                    <li>
                                                        <a href="{{ route('user.cancelProject', ['service_request' => $service_request->id]) }}"
                                                            class="icon icon-cancel">الغاء المشروع</a>
                                                    </li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @if ($service_request->service_request_stage_id == 3 && auth()->user()->user_type != 'user' && $service_request->service_id != 4)
                                    <div class="d-flex dropdownlist justify-content-center mt-3">
                                        <a href="#" class="btn btn-primary btn-46 btn-service-done btn-dropdown">
                                            تسليم المشروع
                                        </a>
                                        <div class="dropdownlist-content max-width">
                                            <ul>
                                                <li>
                                                    <a href="#" class="btn-DeliverProject">
                                                        <span class="bookmark-text">
                                                            تاكيد التسليم
                                                        </span>
                                                        <div class="loading-animate-center border-radius-5">
                                                            <div class="lds-ellipsis">
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row no-gutters bg-white project-card-container mt-2 mb-3 px-3">
                            <div class="border-left col-lg-8 pr-lg-3 py-4">
                                <h4 class="mb-3">بطاقة المشروع</h4>
                                @if ($service_request->service_id == 4)
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="project-card">
                                                <span class="project-card-text mb-2">عنوان الزيارة</span>
                                                <span class="project-card-value ">{{ $service_request->title }}
                                                </span>
                                            </div>
                                            <div class="project-card">
                                                <span class="project-card-text mb-2">نوع الزيارة</span>
                                                <div class="d-flex flex-wrap">
                                                    @foreach($service_request->requested_services as $a)
                                                        <span class="project-card-value ">{{ $a->name }}
                                                    </span>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="project-card">
                                                <span class="project-card-text mb-2">انتهاء استقبال العروض</span>
                                                <span
                                                    class="project-card-value icon icon-calendar">{{ date('d-m-Y', strtotime($service_request->deadline_date)) }} 11:59 م</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="project-card">
                                                <span class="project-card-text mb-2">الميزانية المتوقعة</span>
                                                <span
                                                    class="project-card-value icon icon-price price">{{ number_format($service_request->budget_min + 0) }}
                                                    - {{ number_format($service_request->budget_max + 0) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 my-3 my-lg-0 p-lg-0">
                                            <div class="project-card">
                                                <span class="project-card-text mb-2">مدة التنفيذ المتوقعة</span>
                                                <span
                                                    class="project-card-value icon icon-calendar">{{ $service_request->expected_period }}
                                                    <span class="ml-3 days">أيام</span></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="project-card">
                                                <span class="project-card-text mb-2">انتهاء استقبال العروض</span>
                                                <span
                                                    class="project-card-value icon icon-calendar">{{ date('d-m-Y', strtotime($service_request->deadline_date)) }}  11:59 م</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-4 py-4 px-4 d-flex flex-column justify-content-center">
                                @if ($userProfile == null)
                                    <h4 class="mb-4">الجهة المنفذه</h4>
                                    <p>لم تحدد بعد</p>
                                @else
                                    @if ($userProfile->user_type == 'company' || $userProfile->user_type == 'freelancer')
                                        <h4 class="mb-3">الجهة المنفذه</h4>
                                    @else
                                        <h4 class="mb-3">صاحب الطلب</h4>
                                    @endif
                                    <div class="offer-user-info d-flex flex-row">
                                        <img src="{{ $userProfile->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $userProfile->profile_img]) : asset('images/company-logo-2.jpg') }}"
                                            alt="">
                                        <div class="d-flex flex-wrap align-items-center ml-3">
                                            <div>
                                                @if ($userProfile->user_type == 'company' || $userProfile->user_type == 'freelancer')
                                                    <div class="offer-user-info-usertype">
                                                        @if ($userProfile->user_type == 'company')
                                                            مكتب هندسي
                                                        @else

                                                        @endif
                                                    </div>
                                                    <a href="{{ route('freelancecompanyprofile', ['user' => $userProfile->id]) }}"
                                                        class="d-block offer-user-info-name mt-2">
                                                        {{ $userProfile->name }}
                                                    </a>
                                                @else
                                                    <span class="d-block offer-user-info-name mt-2">
                                                        {{ $userProfile->name }}
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if ($service_request->service_request_stage_id >= 4 && $service_request->service_request_stage_id != 6 && $service_request->service_id == 4)
                @if ($service_request->visit_report->confirmed)
                    <div class="container photoPreviewVisitReportBar">
                        <div class="row no-gutters bg-white py-4 px-3 mt-3 mb-4">
                            <div class="col-lg-12">
                                <div class="row no-gutters">
                                    <div class="col-lg-4">
                                        <div class="d-flex flex-row">
                                            <div class="mr-3">
                                                <img src="{{ asset('images/pdf.png') }}" alt="">
                                            </div>
                                            <div>
                                                <p>تقرير نهائي حول الزيارة </p>
                                                <a href="{{ asset('request_files/' . $service_request->visit_report->hashName) }}"
                                                    class="mt-2 d-block">تحميل</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 photos">
                                        <p class="mb-2">صور مرفقة</p>
                                        <ul class="d-flex flex-wrap flex-row">
                                            @foreach ($service_request->visit_report->attachments as $attachment)
                                                <li class="mr-2">
                                                    <a href="{{ asset('request_files/' . $attachment->hashName) }}"
                                                        data-fancybox="gallery2">
                                                        <img src="{{ route('imagecache', ['filename' => $attachment->hashName, 'template' => 'profile']) }}"
                                                            alt="">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="align-items-center col-lg-4 justify-content-center row">
                                        <div class="align-items-center d-flex flex-row justify-content-center">
                                            <img class="mr-3" src="{{ asset('images/check-small.svg') }}"
                                                style="width: 37px; height: 37px;" alt="">
                                            <p>
                                                تم الموافقة علي التقرير من قبل الإدارة
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container photoPreviewVisitReportBar">
                        <div class="row no-gutters bg-white py-4 px-3 mt-3 mb-4">
                            <div class="col-lg-12">
                                <div class="row no-gutters">
                                    <div class="align-items-center col-lg-12 justify-content-center row">
                                        <div class="align-items-center d-flex flex-row justify-content-center">
                                            <img class="mr-3" src="{{ asset('images/empty-check.svg') }}"
                                                style="width: 37px; height: 37px;" alt="">
                                            <p>
                                                لم يتم قبول التقرير من قبل الإدارة بعد .
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @if ($service_request->service_request_stage_id == 4 && $service_request->user_id == auth()->user()->id)
                @if ($service_request->service_id == 4)
                    @if ($service_request->visit_report->confirmed == true)
                        <div class="container  ratOperatorContainer">
                            <div class="row no-gutters bg-white py-4 px-3 mt-3 mb-5">
                                <div class="col-lg-12">
                                    <div class="row no-gutters justify-content-center">
                                        <div class="col-lg-2">
                                            <a href="#" class="btn btn-primary btn-RateOperator btn-46">
                                                تقييم المشروع
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="container  ratOperatorContainer">
                        <div class="row no-gutters bg-white py-4 px-3 mt-3 mb-5">
                            <div class="col-lg-12">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-lg-2">
                                        <a href="#" class="btn btn-primary btn-RateOperator btn-46">
                                            تقييم المشروع
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @endif
            @if ($service_request->service_request_stage_id == 5)
                @include('services_request.viewRequest_completed')
            @endif
            @if ($service_request->service_request_stage_id >= 3 && $service_request->service_request_stage_id != 6)
                <x-blogHeader>
                    <span class="blog-header-text d-block d-lg-inline-block mr-lg-5 text-center">
                        التفاصيل
                    </span>
                    <div class="blog-header-list projectTabs flex-fill">
                        <ul class="d-flex">
                            <li class="mr-5">
                                <a href="#" data-tab-name="projectDetailsTab" class="active">تفاصيل المشروع</a>
                            </li>
                            <li class="ml-4">
                                <a href="#" class="countUnread" data-tab-name="chatTab">
                                    <span class="unread-messages text-center">
                                        {{ sprintf('%02d', $unreadMessagesCount) }}</span>
                                    المحادثة
                                </a>
                            </li>
                            @if ($service_request->service_request_stage_id >= 3 && $service_request->service_id == 4 && auth()->user()->user_type != 'user')
                                <li class="ml-4">
                                    <a href="#" data-tab-name="attachVisitReport" class="">
                                        ارفاق تقرير الزيارة
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </x-blogHeader>
            @endif
            <div class="tabsContainer">
                <div class="container projectDetailsTab ">
                    <div class="row">
                        <div class="col-lg-12 p-0 px-xl-3">
                            @if ($service_request->service_request_stage_id < 3 && $service_request->service_id != 4)
                                <div class="row no-gutters px-4 mb-3">
                                    <div class="col-lg-12">
                                        <p class="request-subtitle">تفاصيل المشروع</p>
                                    </div>
                                </div>
                            @endif
                            @if ($service_request->service_id == 4)
                                <div class="row no-gutters px-4 mb-3">
                                    <div class="col-lg-12">
                                        <p class="request-subtitle">عنوان الزيارة</p>
                                    </div>
                                </div>
                                <div class="row no-gutters viewRequestVisit justify bg-white py-4 mt-2 mb-3">
                                    <div class="col-lg-12 px-4">
                                        <p class=" mt-3 viewRequestVisit-address ">
                                            {{ $service_request->address }}
                                        <div class="mb-2 mt-3 project-details-services">
                                            <ul class="d-flex flex-row flex-wrap pr-5">
                                                @foreach ($service_request->requested_services as $item)
                                                    <li><span>{{ $item->name }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        </p>

                                    </div>
                                    <div class="col-lg-8 my-5 offset-lg-2 px-4">
                                        <p class="mb-2 viewRequestVisit-map-title"> احداثيات الموقع</p>
                                        <div id="mapid" class="w-100" style="height: 256px;"></div>
                                    </div>
                                </div>
                            @endif
                            @if ($service_request->service_id != 4)
                                <div class="row no-gutters bg-white py-4 mt-2 mb-3">
                                    <div class="col-lg-12 px-4 project-details">
                                        <div class="d-flex flex-lg-nowrap flex-row flex-wrap justify-content-between">
                                            <h1 class="project-details-title pr-3">{{ $service_request->title }}</h1>
                                            <div class="mt-3 mt-lg-0 project-details-created_at">
                                                @if (app()->getLocale() == 'ar')
                                                    {!! arabic_date_format($service_request->created_at) !!}
                                                @else
                                                    <span title="{{ $service_request->created_at }}"
                                                        class="number">{{ english_date_format($service_request->created_at) . ' ago' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-2 mt-3 project-details-services">
                                            <ul class="d-flex flex-row flex-wrap pr-5">
                                                @foreach ($service_request->requested_services as $item)
                                                    <li><span>{{ $item->name }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="project-details-desc pr-4">
                                            <p class="project-details-desc-title mb-2">
                                                تفاصيل المشروع
                                            </p>
                                            <p class="project-details-desc-text pr-5 pb-3">
{{--                                                {{ $service_request->description }}--}}
                                                {!! str_replace(PHP_EOL,'<br>',$service_request->description) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @include('services_request.viewRequest_attachments',['attachments'=>
                                $service_request->attachments])
                            @endif

                            @if ($service_request->service_request_stage_id >= 3 && $service_request->service_request_stage_id != 6)
                                <div class="row no-gutters px-4 mt-5 mb-3">
                                    <div class="col-lg-12">
                                        <p class="request-subtitle">العرض المقدم </p>
                                    </div>
                                </div>
                                <div class="row no-gutters bg-white py-5 mt-3 mb-3">
                                    <div class="col-lg-9 px-4">
                                        <div class="row operatorViewOffer">


                                                <div class="col-lg-6">
                                                            <div class="project-card">
                                                                <span class="project-card-text mb-2">المبلغ</span>
                                                                <span class="project-card-value icon icon-price price">
                                                        {{ $service_request->operator_offer->offer_price }}
                                                    </span>
                                                            </div>
                                                </div>


                                            @if ($service_request->service_id != 4)
                                                <div class="col-lg-3 my-3 my-lg-0 p-lg-0">
                                                    <div class="project-card">
                                                        <span class="project-card-text mb-2">مدة التنفيذ</span>
                                                        <span class="project-card-value icon icon-calendar">
                                                            {{ $service_request->operator_offer->expected_period }}
                                                            <span class="ml-3 days">أيام</span></span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(auth()->user()->user_type != 'user')
                                            <div class="col-lg-6">
                                                <div class="project-card">
                                                    <span class="project-card-text mb-2">المبلغ بعد خصم نسبة
                                                        الموقع
                                                        @php
                                                            $original = $service_request->operator_offer->offer_price;
                                                            $current = $service_request->operator_offer->offer_price_total;
                                                            $diff = $current - $original;
                                                            $diff = abs($diff);
                                                            $percentChange = ($diff / $original) * 100;
                                                        @endphp
                                                        <span
                                                            class="font-Roboto">{{ $percentChange }}%</span></label>
                                                    </span>
                                                    <span class="project-card-value icon icon-price price">
                                                        {{ $service_request->operator_offer->offer_price_total }}
                                                    </span>
                                                </div>
                                            </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters bg-white py-5 mt-3 mb-3">
                                    <div class="col-lg-11 px-4 operatorViewOffer">
                                        <p class="title mb-2">التفاصيل</p>
                                        <p class="desc">
                                            {!! str_replace(PHP_EOL,'<br>',$service_request->operator_offer->offer_desc)   !!}
                                        </p>
                                    </div>
                                </div>
                                @include('services_request.viewRequest_attachments',['attachments'=>
                                $service_request->operator_offer->offer_attachments])
                            @endif
                        </div>
                    </div>
                </div>
                @if ($service_request->service_request_stage_id >= 3 && $service_request->service_request_stage_id != 6)
                    @include('services_request.request_chats',['service_request_id'=> $service_request->id, 'offerId' =>
                    $service_request->operator_offer->id])
                @endif
                @if ($service_request->service_id == 4 && $service_request->service_request_stage_id >= 3 && $service_request->service_request_stage_id != 6 && auth()->user()->user_type != 'user')
                    <div class="container attachVisitReport" style="display: none">
                        <form class="row" id="visitReportForm" method="POST"
                            action="{{ route('operator.uploadvisitreport', ['service_request' => $service_request->id, 'offer' => $service_request->operator_offer->id]) }}">
                            <div class="col-lg-12 p-0 px-xl-3">
                                <div
                                    class="{{ auth()->user()->user_type == 'freelancer' ? 'justify-content-center' : '' }} row bg-white py-5 mx-0 px-3 mt-2 mb-3 {{ $service_request->visit_report ? 'justify-content-center' : '' }}">
                                    <div
                                        class=" {{ auth()->user()->user_type == 'company' ? 'col-lg-4' : 'col-lg-6' }} order-1">
                                        <label for="visitFinalReport" class="mb-3 report_title">ارفاق التقرير النهائي
                                            للزيارة</label>
                                        <div class="form-group row mx-0">
                                            <div class="custom-file has-icon attachment-icon">
                                                <input type="file" class="custom-file-input" accept=".pdf,.doc,.docx"
                                                    required id="visitFinalReport" name="visitFinalReport">
                                                <label class="custom-file-label" for="visitFinalReport">ارفاق
                                                    التقرير</label>
                                            </div>
                                            <p class="chat-msgs-file-upload mt-2 ml-2">
                                                <span>
                                                    ارفاق ملف
                                                </span>
                                                <span class="roboto"> (pdf - doc )</span>
                                            </p>
                                        </div>
                                    </div>
                                    @if (auth()->user()->user_type == 'company')
                                        <div class="col-lg-6 offset-lg-2 order-2">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <p class="report_title mt-3">ارفاق صور</p>
                                                    <p class="attachmentsNote mb-3 mb-lg-0">يمكنك ارفاق صور بحد اقصي 5
                                                        صور<span class="font-Roboto">(png-jpg)</span></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="arbitration" style="max-height: 112px;max-width: 112px;"
                                                        class="arbitration-file-upload border d-flex flex-column justify-content-center align-items-center m-lg-0 m-auto">
                                                        <input type="file" id="arbitration" style="display: none;"
                                                            multiple name="arbitration" accept=".jpg,.jpeg,.png"
                                                            data-error="#errorNum1" />
                                                        <div class="text-center SelectPreviewBox">
                                                            <img src="{{ asset('images/upload-icon.svg') }}"
                                                                class="mb-4">
                                                            <span class="title mb-2">رفع صورة</span>
                                                            <span class="file-type font-Roboto">png-jpg</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->user_type == 'freelancer')
                                        <div class="col-lg-12 order-2">

                                        </div>
                                    @endif
                                    <div class="col-lg-4 mt-5 order-4 order-lg-3">
                                        <div class="justify-content-center justify-content-lg-start row">
                                            <div class="col-lg-6 col-lg-12">
                                                @if (!$service_request->visit_report)
                                                    <div class="sentReportBtnContainer">
                                                        <button class="btn btn-primary has-shadow btncontactus btn-46"
                                                            type="submit">
                                                            <span class="text">ارسال التقرير</span>
                                                            <div class="loading-animate">
                                                                <div class="lds-ellipsis">
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                        <p class="admin-note mt-5">ارفاق التقرير النهائي يعني انتهاء
                                                            الخدمة
                                                        </p>
                                                    </div>
                                                @else
                                                    <div class="sentCompleted">
                                                        <div class=" text-center">
                                                            <img src="{{ asset('images/check-small.svg') }}"
                                                                width="47" height="47" alt="">
                                                            <h5>تم ارسال التقرير النهائي للعميل</h5>
                                                        </div>
                                                        <p class="admin-note mt-3">ارفاق التقرير النهائي يعني انتهاء
                                                            الخدمة
                                                        </p>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    @if (auth()->user()->user_type == 'company')
                                        <div class="col-lg-6 mt-4 offset-lg-2 order-3 ">
                                            <div class="selectedImages">
                                                <ul class="d-flex flex-row flex-wrap">
                                                    @if ($service_request->visit_report)
                                                        @foreach ($service_request->visit_report->attachments as $attachmentFile)
                                                            <li class="mr-3 mb-3">
                                                                <a href="{{ asset('request_files/' . $attachmentFile->hashName) }}"
                                                                    data-fancybox="gallery" style="display: block;">
                                                                    <img src="{{ route('imagecache', ['filename' => $attachmentFile->hashName, 'template' => 'profile']) }}"
                                                                        alt="">
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->user_type == 'freelancer')
                                        <div class="col-lg-6 mt-4 offset-lg-2 order-3 freelancer-report-notes ">
                                            <ul>
                                                <li>
                                                    ارفاق التقرير النهائي يعني انتهاء الخدمة
                                                </li>
                                               <!-- <li>
                                                    التقرير النهائي يتم ارساله للعميل بعد مراجعته من قبل إدارة المنصة
                                                </li> !-->
                                                 <li>
                                                    التقرير النهائي يتم ارساله للعميل
                                                </li>
                                            </ul>
                                            <!-- <p class="mt-3">التقرير النهائي قيد المراجعة من قبل إدارة المنصة ليتم
                                                اعتماده
                                                وارساله للعميل</p> !-->
                                                <p class="mt-3">  تعتبر المنصة وسيلة ربط بين طالب ومقدم الخدمة فقظ</p>


                                        </div>
                                    @endif

                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-0 px-xl-3">
                        @if ($service_request->service_request_stage_id == 1 || $service_request->service_request_stage_id == 2)
                            @include('services_request.viewRequest_offers' , ['offers' => $service_request->offers,
                            'service_request_id'=>$service_request->id,
                            'service_request_stage'=>$service_request->service_request_stage_id,
                            'service_id'=> $service_request->service_id,
                            'percentage'=> $percentage,
                            ])
                        @endif
                        {{-- @endif --}}
                        {{-- {{$service_request->operator_offer}} --}}
                        @if (auth()->user()->user_type != 'user' && $service_request->service_request_stage_id == 1 && $service_request->deadline_date->gte(today()) && $service_request->currentUser_offer == null)
                            <div class="row no-gutters px-4 mb-3">
                                <div class="col-lg-12">
                                    <p class="request-subtitle">إضافة عرض </p>
                                </div>
                            </div>
                            <form id="offerForm" action="{{ route('operator.applyoffer') }}" method="POST"
                                enctype="multipart/form-data">
                                <input type="hidden" name="request_id" value="{{ $service_request->id }}">
                                <x-alert />
                                <div class="row no-gutters justify-content-center bg-white py-4 mt-3 mb-3">
                                    <div class="col-lg-9 px-4">
                                        <div class="row">
                                            @php
                                                $statusIsVisit = null;
                                                if ($service_request->service_id == 4) {
                                                    $statusIsVisit = $service_request->service_id == 4 && auth()->user()->user_type == 'freelancer' ? 'col-lg-6' : 'col-lg-12';
                                                }
                                            @endphp
                                            <div class="{{ $statusIsVisit ?: 'col-lg-6' }}">
                                                <div class="form-group">
                                                    <label class="form-label" for="text">
                                                        {{ $service_request->service_id == 4 ? 'تكلفة الزيارة' : ' مبلغ العرض' }}
                                                    </label>
                                                    <span class="price-tag">
                                                        <input type="text" class="form-control" id="offerCost"
                                                            name="offerCost" required autocomplete="off"
                                                            placeholder="{{ __('form.placeholders.request.budget_min') }}">
                                                        <span class="price-curr">{{ __('form.curr') }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                            @if ($service_request->service_id != 4)
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="text">مدة التنفيذ</label>
                                                        <span class="has-icon date-right-icon">
                                                            <input type="text" class="form-control rule-number"
                                                                id="workingDays" name="workingDays" required
                                                                data-rule-number="true"
                                                                placeholder="{{ __('form.placeholders.request.expected_period') }}">
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($service_request->service_id == 4 && auth()->user()->user_type == 'company')

                                            @else
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="text">  المبلغ بعد خصم نسبة المنصة
                                                            <span
                                                                class="font-Roboto">{{ $percentage }}%</span></label>
                                                        <span class="price-tag">
                                                            <input type="text" class="form-control" id="websitePerc"
                                                                name="websitePerc" data-webperc="{{ $percentage }}"
                                                                readonly required autocomplete="off" value="0"
                                                                placeholder="{{ __('form.placeholders.request.budget_min') }}">
                                                            <span class="price-curr">{{ __('form.curr') }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="message">تفاصيل العرض</label>
                                                    <textarea id="message" name="message" class="form-control p-3"
                                                        cols="30" rows="8" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters justify-content-center bg-white py-4 mt-3 mb-3">
                                    <div class="col-lg-9 px-4">
                                        <div class="form-group">
                                            <h5 class="font-weight-bold mb-1">ارفق ملف</h5>
                                            <div class="custom-file has-icon attachment-icon">
                                                <input type="file" class="custom-file-input" id="offerFiles" multiple
                                                    accept=".png,.jpeg,.jpg,.pdf,.doc,.docx,.dwg" name="offerFiles[]">
                                                <label class="custom-file-label"
                                                    for="offerFiles">{{ __('form.request.request_attachemnts') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-lg-10 px-4">
                                        <h5 class="font-weight-bold mb-1">الملفات المرفقة </h5>
                                        <div class="project-attachments offerFiles">
                                            <ul>
                                                {{-- <x-service-requests.offerFile></x-service-requests.offerFile> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters justify-content-center bg-white py-4 mt-3 mb-3">
                                    <div class="col-lg-8 py-4 px-4">
                                        <div class="row justify-content-center">
                                            <div class="col-6 col-lg-4">
                                                <a href="#"
                                                    class="btn btn-46 d-inline-block btn-prev shown btn-canceloffer">
                                                    الغاء</a>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <button type="submit"
                                                    class="btn btn-primary has-shadow btn-46 d-inline-block">
                                                    <span class="text">إرسال العرض</span>
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
                                    </div>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        @endif
        @if ($service_request->service_request_stage_id >= 3)
            <div class="container">
                <x-service-requests.customerwarning></x-service-requests.customerwarning>
            </div>
        @endif
    </div>
    @if ($service_request->service_request_stage_id == 4)


        @section('panels')
            <x-customPanel id="rateOperatorPanel">
                <div class="col-lg-12">
                    <form id="rateOperatorForm"
                        action="{{ route('user.rateOperator', ['service_request' => $service_request->id]) }}"
                        method="POST">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 text-center">
                                <h1>
                                    تقييم المشروع
                                </h1>
                                <p class="mt-2">
                                    ساعد الاخرين من خلال تقييمك
                                </p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <h4 class="mb-4">الجهة المنفذه</h4>
                                <div class="offer-user-info d-flex flex-row">
                                    <img src="{{ $userProfile->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $userProfile->profile_img]) : asset('images/company-logo-2.jpg') }}"
                                        alt="">
                                    <div class="d-flex flex-wrap align-items-center ml-3">
                                        <div>
                                            @if ($userProfile->user_type == 'company' || $userProfile->user_type == 'freelancer')
                                                <div class="offer-user-info-usertype">
                                                    @if ($userProfile->user_type == 'company')
                                                        مكتب هندسي
                                                    @else
                                                    @endif
                                                </div>
                                                <a href="{{ route('freelancecompanyprofile', ['user' => $userProfile->id]) }}"
                                                    class="d-block offer-user-info-name mt-2">
                                                    {{ $userProfile->name }}
                                                </a>
                                            @else
                                                <span class="d-block offer-user-info-name mt-2">
                                                    {{ $userProfile->name }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <h1 class="mb-3">تقييمك للجهة المنفذة</h1>
                                <ul class="rating-list withActions">
                                    <li class="d-flex flex-row align-items-center justify-content-between mb-2">
                                        <div class="rating-list-title">سرعة الرد :</div>
                                        <div class="rating">
                                            <ul class="d-flex flex-row">
                                                <li>
                                                    <span></span>
                                                    <label for="responseSpeed1"></label>
                                                    <input type="radio" id="responseSpeed1" name="responseSpeed" required
                                                        value="1">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="responseSpeed2"></label>
                                                    <input type="radio" id="responseSpeed2" name="responseSpeed" value="2">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="responseSpeed3"></label>
                                                    <input type="radio" id="responseSpeed3" name="responseSpeed" value="3">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="responseSpeed4"></label>
                                                    <input type="radio" id="responseSpeed4" name="responseSpeed" value="4">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="responseSpeed5"></label>
                                                    <input type="radio" id="responseSpeed5" name="responseSpeed" value="5">
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-between mb-2">
                                        <div class="rating-list-title">جودة العمل :</div>
                                        <div class="rating">
                                            <ul class="d-flex flex-row">
                                                <li>
                                                    <span></span>
                                                    <label for="Quality1"></label>
                                                    <input type="radio" id="Quality1" name="Quality" value="1">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Quality2"></label>
                                                    <input type="radio" id="Quality2" name="Quality" value="2">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Quality3"></label>
                                                    <input type="radio" id="Quality3" name="Quality" value="3">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Quality4"></label>
                                                    <input type="radio" id="Quality4" name="Quality" value="4">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Quality5"></label>
                                                    <input type="radio" id="Quality5" name="Quality" value="5">
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-between">
                                        <div class="rating-list-title">تكلفة العمل :</div>
                                        <div class="rating">
                                            <ul class="d-flex flex-row">
                                                <li>
                                                    <span></span>
                                                    <label for="Cost1"></label>
                                                    <input type="radio" id="Cost1" name="Cost" value="1">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Cost2"></label>
                                                    <input type="radio" id="Cost2" name="Cost" value="2">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Cost3"></label>
                                                    <input type="radio" id="Cost3" name="Cost" value="3">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Cost4"></label>
                                                    <input type="radio" id="Cost4" name="Cost" value="4">
                                                </li>
                                                <li>
                                                    <span></span>
                                                    <label for="Cost5"></label>
                                                    <input type="radio" id="Cost5" name="Cost" value="5">
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                                <div id="rate-list-error" class="invalid-feedback" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="message">كتابة تعليق</label>
                                    <textarea id="message" name="message" class="form-control p-3" cols="30"
                                        rows="8"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="d-flex form-group justify-content-end">
                                    <a href="#" class="btn btn-46 btn-step d-inline-block btn-prev shown mr-3 close-panel">
                                        الغاء</a>
                                    <button type="submit"
                                        class="btn btn-primary has-shadow btn-46 btn-step d-inline-block ">
                                        <span class="text">اضافة تعليق</span>
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
                        </div>
                    </form>
                </div>
            </x-customPanel>
        @endsection
    @endif


    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/placeholder-loading.min.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin="" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    @endsection

    @section('scripts')
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script id="fileRowTemplate" type="text/template">
            <x-service-requests.offerfile></x-service-requests.offerfile></script>
        <script id="rowsLoadingTemplate" type="text/template">@include('services_request.request_chat_item_loading')


                                                            </script>
        <script>
            $(function() {

                $('[data-fancybox="gallery2"]').fancybox({
                    buttons: [
                        "zoom",
                        "download",
                        "thumbs",
                        "close"
                    ],
                });


                $('.btn-dropdown').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if ($(this).parent().hasClass('dropdownlist')) {
                        $(this).parent().find('.dropdownlist-content').toggleClass('show');
                    }

                });

                $('.btn-RateOperator').on('click', function(e) {
                    openPanel('rateOperatorPanel');
                    e.preventDefault();
                });


                var rateOperatorForm = $("#rateOperatorForm");
                var rateOperatorvalidator = rateOperatorForm.validate();
                rateOperatorForm.submit(function() {
                    $('#rate-list-error').css('display', 'none');
                    if (
                        $("input[name='responseSpeed']:checked").length == 0 ||
                        $("input[name='Quality']:checked").length == 0 ||
                        $("input[name='Cost']:checked").length == 0
                    ) {
                        console.log('tewst');
                        $('#rate-list-error').text('يرجى ادخال جميع البنودالخاصة بالتقييم');
                        $('#rate-list-error').css('display', 'block');
                        return false;
                    }
                    // return false;
                    if (rateOperatorForm.valid()) {
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);

                        $.ajax({
                            type: "POST",
                            url: rateOperatorForm.attr('action'),
                            data: rateOperatorForm.serialize(),
                            dataType: "json",
                            success: function(response) {
                                showAlertSuccess(response.message);
                                setTimeout(function() {
                                    rateOperatorForm.trigger('reset');
                                    rateOperatorvalidator.resetForm();
                                    $('.close-panel').trigger("click");
                                    $('.ratOperatorContainer').replaceWith(response
                                        .completedView);
                                }, 2600);
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });

                        return false;
                    }
                    return false;
                });


                $(document).on("click", ".close-panel", function(e) {
                    rateOperatorForm.trigger("reset");
                    rateOperatorvalidator.resetForm();
                    closePanel('rateOperatorPanel');
                    // form.find('.btn-saveChanges').find('.text').html(
                    //     '{{ __('form.buttons.create_job') }}');
                    // e.preventDefault();
                });

                $(document).on('click', '.rating-list.withActions .rating ul li label', function(e) {
                    var ul = $(this).closest('ul');
                    var currentLiIndex = $(this).parent().index();
                    $(ul).find('li').removeClass('active');
                    $.each($(ul).find('li'), function(index, element) {
                        if (index <= currentLiIndex) {
                            $(element).addClass('active');
                        }
                    });
                });


                var filesCollection = [];

                $('#offerFiles').on('change', function(e) {
                    var files = e.target.files;
                    console.log(files);
                    var files = e.target.files;
                    $.each(files, function(i, file) {
                        var fileExtension = file.name.split('.').pop();
                        var filename = file.name.split('.').slice(0, -1).join('.')

                        var fileData = {
                            filename: filename,
                            fileObject: file,
                            fileStatus: 'waiting'
                        };
                        filesCollection.push(fileData);

                        var templateHtml = $('#fileRowTemplate').html();
                        // var templateHtml = template.html();
                        // console.log(templateHtml);
                        var rowHtml = templateHtml.replace(/%filename%/g, filename)
                            .replace(/%filetype%/g, fileExtension + '.png')
                            .replace(/%number%/g, String(++i).padStart(2, '0'));
                        $('.offerFiles ul').append(rowHtml);
                        // var filename = file.val().split('\\').pop();
                        // console.log(filename);
                    })
                    // debugger

                    // console.log(filesCollection);
                    reOrderFilesIndex();
                    $('#offerFiles').val('');
                    $(this).next('label').html("{{ __('form.request.request_attachemnts') }}");
                });

                function reOrderFilesIndex() {
                    var files = $('.offerFiles ul').find('li');
                    console.log(files);
                    $.each(files, function(key, value) {
                        // console.log(key);
                        $(this).find('.number').html(String(++key).padStart(2, '0'));
                    });
                    // files.forEach(element => {
                    //     console.log(element);
                    // });
                }

                $(document).on('click', '.btnDeleteOfferAttach', function(e) {
                    var filename = $(this).attr('data-filename');
                    filesCollection = $.grep(filesCollection, function(value) {
                        return value.filename != filename;
                    });
                    // console.log(filesCollection);
                    $(this).parents('li').fadeOut("normal", function() {
                        $(this).remove();
                        reOrderFilesIndex();
                    });
                    e.preventDefault();
                });


                function ApplyOffer(form) {

                    var btn = form.find("button[type='submit']");
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            showAlertSuccess(response.message);
                            // form.trigger("reset");
                            validator.resetForm();
                            $('#offerFiles').val('');
                            $('input[name="uploaded_files[]"]').remove();
                            // setTimeout(function() {
                                window.location.replace(response.redirectTo);
                            // }, 2600);

                        },
                        complete: function() {
                            btn.removeAttr("disabled").removeClass('loading');
                        }
                    });
                }

                var form = $('#offerForm');
                var validator = form.validate();
                form.submit(function() {
                    if (form.valid()) {
                        // console.log(filesCollection[0].fileObject )
                        // return false;
                        // console.log(form.serializeArray());
                        for (let index = 0; index < filesCollection.length; index++) {
                            uploadajax(filesCollection.length - 1, index);
                        }

                        var btn = $(this).find("button[type='submit']");
                        btn.addClass('loading').prop('disabled', true);

                        if (filesCollection.length == 0) {
                            ApplyOffer(form);
                        }
                        return false;
                    }
                    return false;
                });

                function UploadCompleted() {
                    // var status = false;
                    // $.each(filesCollection, function(key, value) {
                    //     if (value.fileStatus == 'done') {
                    //         status = true;
                    //     }
                    // });
                    var waiting = filesCollection.filter(function(file) {
                        return file.fileStatus == "waiting"
                    });

                    if (waiting.length == 0) {
                        var error = filesCollection.filter(function(file) {
                            return file.fileStatus == "error"
                        });

                        if (error.length > 0) {
                            form.find("button[type='submit']").removeAttr("disabled").removeClass('loading');
                            showAlertError('errorMessage');
                        } else {
                            ApplyOffer(form);
                            filesCollection = [];
                        }
                    }
                    // console.log(values);
                }


                function uploadajax(ttl, cl) {

                    // var fileList = $('#multiupload').prop("files");
                    // $('#prog' + cl).removeClass('loading-prep').addClass('upload-image');
                    // console.log(cl);

                    var form_data = "";

                    form_data = new FormData();
                    form_data.append("request_id", {{ $service_request->id }});
                    form_data.append("file_offer", filesCollection[cl].fileObject);


                    var request = $.ajax({
                        url: "{{ route('operator.uploadofferfiles') }}",
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: true,
                        data: form_data,
                        type: 'POST',
                        xhr: function() {
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(event.loaded / event.total * 100);
                                    }
                                    var li = $('.offerFiles ul li').eq(cl);
                                    if (li.find('.uploadingFile').css('display') == 'none') {
                                        li.find('.uploadingCompleted').css('display', 'none');
                                        li.find('.uploadingError').css('display', 'none');
                                        li.find('.uploadingFile').css('display', 'block');
                                    }
                                    li.find('.percentage').text(percent + '%')
                                    // console.log(cl + " " + percent + '%');
                                }, false);
                            }
                            return xhr;
                        },
                        success: function(res, status) {
                            // console.log(res, status);
                            if (res.status == true) {
                                percent = 0;
                                // $('#prog' + cl).text('');
                                // $('#prog' + cl).text('--Success: ');
                                var li = $('.offerFiles ul li').eq(cl);

                                $('<input>').attr({
                                    type: 'hidden',
                                    id: 'uploaded_file_' + cl,
                                    name: 'uploaded_files[]',
                                    value: res.filename + "|" + res.hashName
                                }).appendTo(li);

                                li.find('.uploadingFile').css('display', 'none');
                                li.find('.uploadingCompleted').css('display', 'block');

                                // if (cl < ttl) {
                                //     // uploadajax(ttl, cl + 1);
                                // } else {
                                //     // alert('Done');
                                //     // ApplyOffer(form);
                                // }
                                filesCollection[cl].fileStatus = 'done';
                                // console.log(UploadCompleted());
                                // UploadCompleted();

                            } else {
                                var li = $('.offerFiles ul li').eq(cl);
                                li.find('.uploadingError').css('display', 'block');
                            }

                        },
                        error: function(res, status) {
                            // console.log(res, status);
                            var li = $('.offerFiles ul li').eq(cl);
                            li.find('.uploadingFile').css('display', 'none');
                            li.find('.uploadingError').css('display', 'block');
                            // if (cl < ttl) {
                            //     // uploadajax(ttl, cl + 1);
                            // } else {
                            //     // alert('Done');
                            //     // ApplyOffer(form);
                            //     // form.find("button[type='submit']").removeAttr("disabled").removeClass(
                            //     // 'loading');
                            // }
                            filesCollection[cl].fileStatus = 'error';
                            // UploadCompleted();
                        },
                        fail: function(res) {
                            alert('Failed');
                        },
                        complete: function() {
                            UploadCompleted();
                        }
                    })
                }


                $('.btn-canceloffer').on('click', function(e) {
                    filesCollection = [];
                    form.trigger("reset");
                    validator.resetForm();
                    $('#offerFiles').val('');
                    $('.offerFiles ul').find('li').remove();
                    $('input[name="uploaded_files[]"]').remove();
                    e.preventDefault();

                });



                $('.btn-DeliverProject').on('click', function(e) {
                    e.preventDefault();
                    var btn = $(this);

                    if (btn.hasClass('loading'))
                        return false;
                    btn.addClass('loading');
                    var urlAction =
                        "{{ route('operator.deliverproject', ['service_request' => $service_request->id]) }}";

                    $.ajax({
                        type: "POST",
                        url: urlAction,
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            window.location.replace(response.redirectTo);
                            $('.btn-service-done').trigger("click");
                        },
                        complete: function() {
                            btn.removeClass('loading');
                        }
                    });
                });


                $('.btn-addBookmark').on('click', function(e) {
                    var btn = $(this);
                    var method = '';
                    var parameter = '';
                    if (btn.attr('data-method') == 'add') {
                        method = "{{ route('booksmarks.addbookmark') }}"
                        parameter = {
                            request_id: {{ $service_request->id }}
                        };
                    } else {
                        method = "{{ route('booksmarks.removebookmark') }}";
                        parameter = {
                            bookmark_id: btn.attr('data-bookmark-id')
                        }
                    }
                    // console.log('method', method);
                    // console.log('parameter', parameter);
                    // return false;
                    e.preventDefault();
                    btn.addClass('loading');


                    $.ajax({
                        type: "POST",
                        url: method,
                        data: parameter,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (btn.attr('data-method') == 'add') {
                                btn.attr('data-method', 'remove');
                                btn.attr('data-bookmark-id', response.bookmark_id)
                                btn.find('.bookmark-text').html('ازلة من المفضلة');
                                btn.removeClass('icon-fav').addClass('icon-fav-cancel');
                            } else {
                                btn.attr('data-method', 'add');
                                btn.attr('data-bookmark-id', '')
                                btn.find('.bookmark-text').html('اضافة للمفضلة');
                                btn.removeClass('icon-fav-cancel').addClass('icon-fav');
                            }
                        },
                        complete: function() {
                            btn.removeClass('loading');
                        }
                    });

                });



                /**
                 *
                 *  chat MSGS
                 *
                 * */


                $('.projectTabs ul li a').on('click', function(e) {
                    var tabIndex = $(this).parent().index();
                    $(this).parents('ul').find('a').removeClass('active');
                    $(this).addClass('active');
                    if (tabIndex == 1) {
                        $("html, body").animate({
                                scrollTop: $(".chatList").offset().top - 50,
                            },
                            400
                        );

                    }

                    if (tabIndex == 2) {
                        $(".projectDetailsTab").css('display', 'none');
                        $(".chatTab").css('display', 'none');
                        $(".attachVisitReport").css('display', 'block');
                    } else {
                        $('.tabsContainer').children().css('display', 'block');
                        $(".attachVisitReport").css('display', 'none');
                    }
                    AOS.refresh();
                    e.preventDefault();
                });

                var chatMsgForm = $('#sendMsgForm');
                var validatorChatMsgs = chatMsgForm.validate({
                    rules: {
                        chat_attachment: {
                            extension: "jpg|png|pdf|dwg|jpeg|doc|docx"
                        }
                    }
                });

                function getChatMsgs() {
                    var template = $('#rowsLoadingTemplate').html();
                    $('.chatList').html(template);
                    $.ajax({
                        type: "GET",
                        url: "{{ route('request.chatmsgs', ['service_request' => $service_request->id]) }}",
                        dataType: "json",
                        success: function(response) {
                            // showAlertSuccess(response.message);
                            // console.log(response);
                            console.log(response);
                            $('.chatList').html(response.messages);
                            AOS.refresh();
                        },
                        complete: function() {}
                    });
                }


                $("#chat_attachment").change(function() {
                    validatorChatMsgs.element("#chat_attachment");
                });

                chatMsgForm.submit(function() {
                    if (chatMsgForm.valid()) {
                        var formData = new FormData();
                        console.log(chatMsgForm.serializeArray());
                        var formSubmittedData = chatMsgForm.serializeArray();

                        $.each(formSubmittedData, function(index, element) {
                            formData.append(element.name, element.value);
                        });

                        var chatMsgInputFile = $('#chat_attachment');
                        var files = chatMsgInputFile[0].files;
                        if (files.length > 0) {
                            formData.append('chat_attachment', files[0]);
                        }
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);
                        $.ajax({
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            // async: true,
                            url: chatMsgForm.attr('action'),
                            data: formData,
                            // dataType: "json",
                            success: function(response) {
                                console.log(response);

                                showAlertSuccess(response.message);
                                getChatMsgs();
                                chatMsgForm.trigger('reset');
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });

                        return false;
                    }
                    return false;
                });




                var reportFilesCollection = [];


                function readURL(input) {
                    // console.log(reportFilesCollection.length > 4);

                    if (input.files) {
                        // var reader = new FileReader();

                        // reader.onload = function(e) {
                        //     $('#previewImg').attr('src', e.target.result);
                        //     var template = '<li class="mr-3 mb-3"> \
                        //                                                     <div> \
                        //                                                         <img src="' + e.target.result + '" alt=""> \
                        //                                                         <a href="#"> \
                        //                                                         </a> \
                        //                                                     </div></li>';
                        //     $('.selectedImages ul').append(template);
                        // }
                        // $.each(input.files, function(i, file) {
                        //     reader.readAsDataURL(file);
                        // });

                        var files = input.files;
                        var reader;
                        var file;
                        var i;
                        // if (reportFilesCollection.length < 4) {
                        //     return false;
                        // }

                        for (i = 0; i < files.length; i++) {

                            file = files[i];
                            reader = new FileReader();
                            reader.onload = (function(file) {
                                return function(e) {
                                    var template =
                                        '<li class="mr-3 mb-3"><div><img src="' + e.target.result +
                                        '" alt=""><a href="#" class="remove"></a></div></li>';
                                    $('.selectedImages ul').append(template);
                                };
                            })(file);
                            if (reportFilesCollection.length <= 4) {
                                reader.readAsDataURL(file);
                                reportFilesCollection.push(file);
                            }
                        }

                    }
                }


                $("#arbitration").change(function() {
                    if ($(this).val().length != 0) {
                        readURL(this);
                    }
                });



                var visitReportForm = $("#visitReportForm");
                var visitReportFormValidator = visitReportForm.validate({
                    rules: {
                        visitFinalReport: {
                            required: true,
                            accept: "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        }
                    }
                });
                visitReportForm.submit(function() {

                    if (visitReportForm.valid()) {

                        var formData = new FormData();

                        var reportFile = $('#visitFinalReport')[0].files[0];
                        formData.append('reportFile', reportFile);
                        $.each(reportFilesCollection, function(index, file) {
                            formData.append('reportPhotos[]', file);
                        })
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);

                        $.ajax({
                            type: "POST",
                            url: visitReportForm.attr('action'),
                            data: formData,
                            dataType: "json",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                // showAlertSuccessClass(response.message);
                                // $('.btn-rateUser[data-request-id="' + response.requestId +
                                //     '"]').parent().remove();
                                // setTimeout(function() {
                                //     visitReportForm.trigger('reset');
                                //     visitReportFormValidator.resetForm();
                                //     $('.close-panel').trigger("click");
                                //     $('.ratOperatorContainer').replaceWith(response
                                //         .completedView);
                                // }, 2600);
                                if (response.status == true) {
                                    $('.sentReportBtnContainer').replaceWith(response.success);
                                    setTimeout(function() {
                                        window.location.replace(response.redirectTo);
                                    }, 1000);
                                }
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });
                        return false;
                    }
                    return false;
                });



                $(document).on('click', '.selectedImages a.remove', function(e) {
                    var index = $(this).parents('li');
                    $(this).parents('li').remove();
                    reportFilesCollection.splice(index, 1);
                    e.preventDefault();
                });

                function percentage(num, per) {
                    return (num / 100) * per;
                }

                $('#offerCost').on('keyup', function(e) {
                    if ($('#websitePerc').length) {
                        //percentage($(this).val(), 10)
                        var currentPrice = $(this).val();
                        var percent={{ $percentage }};
                        if($(this).data('percent')!= undefined){
                            percent=$(this).data('percent');
                        }
                        var perc = percentage($(this).val(), percent);
                        var total = currentPrice - perc;
                        $('#websitePerc').val(total);
                    }
                });

                $('#offerCost').trigger('keyup')
            });


        </script>
        @if ($service_request->service_id == 4)
            <script>
                $(function() {


                    var mymap = L.map('mapid').setView([{{ $service_request->xPoint }},
                        {{ $service_request->yPoint }}
                    ], 18);
                    L.tileLayer(
                        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            // maxZoom: 18,
                            // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                            //     'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                            // id: 'mapbox/streets-v11',
                            // tileSize: 512,
                            // zoomOffset: -1
                            maxNativeZoom: 19,
                            maxZoom: 25
                        }).addTo(mymap);

                    var markers = L.layerGroup();
                    // var myIcon = L.divIcon({
                    //     className: 'my-div-icon'
                    // });
                    var myIcon = L.icon({
                        iconUrl: "{{ asset('images/marker-2.png') }}",
                        iconSize: [38, 38],
                        // iconAnchor: [22, 94],
                        // popupAnchor: [-3, -76],
                        // shadowUrl: 'my-icon-shadow.png',
                        // shadowSize: [68, 95],
                        // shadowAnchor: [22, 94]
                    });



                    var marker = L.marker([{{ $service_request->xPoint }}, {{ $service_request->yPoint }}], {
                        icon: myIcon
                    });

                    var
                        persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
                        arabicNumbers = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g],
                        fixNumbers = function(str) {
                            if (typeof str === 'string') {
                                for (var i = 0; i < 10; i++) {
                                    str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
                                }
                            }
                            return str;
                        };

                    $.get('https://nominatim.openstreetmap.org/reverse?lat={{ $service_request->xPoint }}&lon={{ $service_request->yPoint }}&format=json&accept-language={{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}',
                        function(data) {
                            console.log(data);
                            var str = fixNumbers(data.display_name);
                            console.log(str);
                            marker.bindPopup("<p class='popUpLayout'>" + str + "</p>");
                        });

                    var txtLocation = $(".viewRequestVisit-address").text();
                    marker.bindPopup(txtLocation);
                    mymap.addLayer(marker);
                    // var myIcon = L.divIcon({
                    //     iconSize: null,
                    //     html: '<div class="markerIcon"></div>'
                    // });

                    // function onMapClick(e) {
                    //     // alert("You clicked the map at " + e.latlng);
                    //     markers.clearLayers();

                    //     console.log(e.latlng);
                    //     var marker = L.marker([e.latlng.lat, e.latlng.lng], {
                    //         icon: myIcon
                    //     });
                    //     var latlngInput = document.getElementById('latlng');
                    //     latlngInput.value = e.latlng.lat + "," + e.latlng.lng;
                    //     markers.addLayer(marker);
                    //     mymap.addLayer(markers);
                    //     validator.element("#latlng");
                    //     // mymap.removeLayer(marker);
                    // }

                    // mymap.on('click', onMapClick);
                    mymap.zoomControl.setPosition('bottomleft');
                });

            </script>
        @endif

    @endsection
</x-layout>
