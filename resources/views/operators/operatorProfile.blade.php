<x-layout>
    <x-slot name="linkselected">
        operatorProfile
    </x-slot>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('operator.profile') }}">
                البروفايل
            </a>
        </li>
    </x-breadcrumb>
    <div class="container">
        <div class="row mt-3 mb-3 mx-md-0">
            <div class="col-md-12 bg-white py-4 px-4">
                <div class="row">
                    <div class="col-md-12 bg-white freelancecompany-profile border-radius-5">
                        <p class="title mb-2">
                            @if (auth()->user()->user_type == 'company')
                                معلومات المكتب الهندسي
                            @else
                                بروفايل المستقل
                            @endif
                        </p>
                        <div class="offer-user-info d-flex flex-row">
                            <img class="size67"
                                src="{{ $userDetails->profile_img ? route('imagecache', ['filename' => $userDetails->profile_img, 'template' => 'profile']) : asset('images/company-logo-2.jpg') }}"
                                alt="">
                            <div class="d-flex flex-wrap align-items-center ml-3">
                                <div>
                                    <div class="offer-user-info-name ">
                                        {{ $userDetails->name }}
                                    </div>
                                    <div class="offer-user-info-join-date mt-2">تاريخ الانضمام <span class="date">
                                            {{ date('d-m-Y', strtotime($userDetails->created_at)) }}
                                        </span>
                                    </div>
                                    <div class="rating mt-2">
                                        <ul class="d-flex flex-row">
                                            @include('general.user_rates',['rate'=>auth()->user()->user_rates()])
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="freelancecompany-profile-bio mt-4 mb-3">
                            {!! str_replace(PHP_EOL,'<br>',$userDetails->operatorProfile->bio_text) !!}
                        </p>
                        <div class="border-custom"></div>
                        <p class="title mb-2 mt-3">
                            مجالات العمل
                        </p>

                        <ul class="freelancecompany-profile-fields d-flex flex-row flex-wrap col-md-8 p-0">
                            @foreach ($currentUserServices as $service)
                                <li class="mb-2 pr-2">
                                    <span class="px-3">{{@ $service->service_category->parent_service->name }} - {{@ $service->service_category->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 mx-md-0">
            <div class="account-info-tabs-header col-md-12 bg-white px-4">
                <ul class="d-flex flex-row justify-content-center">
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
            <div class="row mx-md-0 account-works mt-3">
                <div class="col-md-12 bg-white px-4 py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div>
                                <p class="text-center text-md-left title">اعمالك المضافة ( <span
                                        class="number">{{ $works->count() }}</span> )</p>
                                <small style="color: #e1bbbb">يسمح باضافة 7 اعمال فقط </small>
                            </div>
                        </div>
                        <div class="col-md-2 mt-3 mt-md-0">
                            @if($works->count() < 7)
                            <a href="#" data-panel-id="addWorkModel" class="btn btn-primary  btn-s-40  open-panel"
                                style="font-weight: 500;">+
                                إضافة</a>
                            @endif
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
                            @include('operators.operator_portfolio_item',['work'=>$work,'CanDelete'=>true])
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mx-md-0  mt-3" style="display: none;">
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
                                    <span class="label {{ $labelStatus }}">{{ $offer->offer_status->name }}</span>
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
            <div class="row mx-md-0 mt-3" style="display: none;">
                <div class="col-md-12 bg-white px-4 py-4">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <p class="title">تقييمات وأراء العملاء</p>
                        </div>
                    </div>
                    <div class="row no-gutters account-rates mt-4">
                        <div class="col-md-12 px-0 px-lg-5">
                            @if ($reviews->count() == 0)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-center">لا يوجد تقييمات لعرضها</h5>
                                    </div>
                                </div>
                            @endif
                            @foreach ($reviews as $review)
                                <div data-request-id="{{ $review->request->id }}"
                                    data-projectowner-email="{{ $review->rater->email }}"
                                    class="d-flex flex-column flex-md-row justify-content-between data-rater-content py-4 {{ $loop->even ? 'bg-even' : '' }}">
                                    <div class="d-flex flex-row raterData">
                                        <div class="profileImg ml-md-3 ml-0">
                                            <img src=" {{ $review->rater->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $review->rater->profile_img]) : asset('images/profile-img-2.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="users-rating-block">
                                                <p class="project-owner-rating-title">صاحب المشروع</p>
                                                <p class="font-weight-bold mb-2 project-owner-rating-name">{{ $review->rater->name }}</p>
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
                                                {{-- @if ($review->admin_isshown == true) --}}
                                                <p class="rating-comment mb-3">
                                                    {{ $review->review_msg }}
                                                </p>
                                                {{-- @endif --}}
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
                                    </div>
                                    <div class="col-12 col-lg-2 col-md-3 mt-4 mt-md-0">
                                        @if ($alreadyRatedUsers->where('request_id', $review->request->id)->first() == null)
                                            <a href="#" class="btn btn-primary btn-46 btn-rateUser"
                                                data-request-id="{{ $review->request->id }}"
                                                data-projectowner-email="{{ $review->rater->email }}">
                                                تقييم
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('panels')


        <div class="eg-dropdown" style="display: none;">
            <form action="{{ route('operator.DeleteWork') }}" id="deleteWorkForm" method="post">
                @method('delete');
                @csrf
                <input type="text" style="display:none" id="workId" name="workId">
                <div class="dropdownlist-content withActions p-4">
                    <p>سيتم الحذف بشكل نهائي ولا يمكن التراجع عن هذه الخطوة ، هل انت متاكد ؟</p>
                    <div class="d-flex flex-row mt-2">
                        <button type="submit" class="btn btn-primary btn-danger-color btn-30 mr-4">
                            <span class="text">نعم</span>
                            <div class="loading-animate">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </button>
                        <a href="#" class="btn btn-primary btn-gray-color btn-30 cancel-dropdown">لا</a>
                    </div>
                </div>
            </form>
        </div>

        <x-customPanel id="rateUserPanel">
            <div class="col-lg-12">
                <form id="rateUserForm" action="{{ route('operator.rateUser') }}" method="POST">
                    <input type="hidden" name="requestId" value="">
                    <input type="hidden" name="projectOwnerEmail" value="">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <h1>
                                تقييم المشروع
                            </h1>
                            <p class="mt-2">
                                ساعد الاخرين من خلال تقييمك
                            </p>
                        </div>
                    </div>
                    <div class="row mt-3 account-rates border-bottom-custom-1">
                        <div class="col-md-12">
                            <div class="d-flex flex-column flex-md-row popup-data-content justify-content-between py-4 ">
                                <div class="d-flex flex-row raterData w-100">
                                    <div class="profileImg ml-md-3 ml-0">
                                        <img src=" http://manasa.com/images/profile/khLpUVpvbA2gNRWYTsZUCqZlrTILQ6c7DwCEnSUU.jpg"
                                            alt="">
                                    </div>
                                    <div class="px-3 w-100">
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-between users-rating-block">
                                            <div class="project-owner-rating">
                                                <p class="project-owner-rating-title">صاحب المشروع</p>
                                                <p class="font-weight-bold mb-4 project-owner-rating-name">محمد احمد</p>
                                                <p class="title">123</p>
                                                <div class="mt-2 project-details-services ">
                                                    <ul class="d-flex flex-row flex-wrap pr-5">
                                                        <li class="small-footprint">
                                                            <span>زيارة موقع قيد الانشاء</span>
                                                        </li>
                                                        <li class="small-footprint">
                                                            <span>زيارة منزل ارضي</span>
                                                        </li>
                                                        <li class="small-footprint">
                                                            <span>زيارة محل تجاري</span>
                                                        </li>
                                                        <li class="small-footprint">
                                                            <span>زيارة لرفع مساحة ارض</span>
                                                        </li>
                                                        <li class="small-footprint">
                                                            <span>زيارة لعلاج خلل فني</span>
                                                        </li>
                                                        <li class="small-footprint date w-100">
                                                            <span>
                                                                23-03-2021</span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <p class="rating-comment mb-3">
                                                    كتابة تعليق كتابة تعليق كتابة تعليق كتابة تعليق كتابة تعليق كتابة
                                                    تعليق
                                                    كتابة تعليق كتابة تعليق كتابة تعل
                                                </p>

                                            </div>
                                            <div class="align-self-md-center project-owner-rates-list px-0 px-md-4">
                                                <ul class="rating-list">
                                                    <li class="d-flex flex-row align-items-center mb-2">
                                                        <div class="rating-list-title">سرعة الرد :</div>
                                                        <div class="rating">
                                                            <ul class="d-flex flex-row">
                                                                <li class="active">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex flex-row align-items-center mb-2">
                                                        <div class="rating-list-title">جودة العمل :</div>
                                                        <div class="rating">
                                                            <ul class="d-flex flex-row">
                                                                <li class="active">
                                                                    <span></span>
                                                                </li>
                                                                <li class="active">
                                                                    <span></span>
                                                                </li>
                                                                <li class="active">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex flex-row align-items-center">
                                                        <div class="rating-list-title">تكلفة العمل :</div>
                                                        <div class="rating">
                                                            <ul class="d-flex flex-row">
                                                                <li class="active">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                                <li class="">
                                                                    <span></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h1 class="mb-3">تقييمك للعميل</h1>
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
                                    <div class="rating-list-title">دفعة التكلفة :</div>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">كتابة تعليق</label>
                                <textarea id="message" name="message" class="form-control p-3" cols="30"
                                    rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="d-flex form-group justify-content-end">
                                <a href="#" class="btn btn-46 btn-step d-inline-block btn-prev shown mr-3 close-panel">
                                    الغاء</a>
                                <button type="submit" class="btn btn-primary has-shadow btn-46 btn-step d-inline-block ">
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

        <x-customPanel id="addWorkModel">
            <div class="col-lg-9 col-md-11">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <h1>
                            إضافة عمل إلى معرض اعمالك
                        </h1>
                        <p>يمكنك اضافة مجموعة من اعمال لتساعد الزبائن على التعرف
                            ليك ومستوى عملك</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="addNewWorkForm" action="{{ route('operator.addPortfolio') }}" method="POST">
                            <div class="form-group">
                                <label for="name">عنوان العمل</label>
                                <input type="text" class="form-control" id="workTitle" name="workTitle" required>
                            </div>
                            <div class="form-group mb-0">
                                <label for="message">صورة العمل</label>


                                <label for="arbitration"
                                    class="arbitration-file-upload d-flex flex-column justify-content-center align-items-center has-inner">
                                    <img id="previewImg" class="border-radius-5 mb-3" src=""
                                        style="width: 294px; height: 294px; object-fit: cover; display:none;" alt="">
                                    <div class="innerbox-container">
                                        <div class="innerbox d-flex flex-column justify-content-center align-items-center">
                                            <input type="file" id="arbitration" data-error="#errNm1" required
                                                style="display: none;" name="arbitration" accept="image/png, image/jpeg, pdf" />
                                            <img src="{{ asset('images/upload-icon.svg') }}" class="mb-4">
                                            <span class="title mb-2">يمكنك رفع صورة العمل</span>
                                            <span class="file-type font-Roboto">jpg - png - PDF</span>
                                            <div class="loading-animate">
                                                <div class="lds-ellipsis">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <span id="errNm1"></span>
                            </div>
                            <div class="d-flex form-group justify-content-center mt-5">
                                <a href="#" class="btn btn-46 btn-step d-inline-block btn-prev shown mr-3 close-panel">
                                    الغاء</a>
                                <button type="submit" class="btn btn-primary has-shadow btn-46 btn-step d-inline-block ">
                                    <span class="text">اضافة العمل</span>
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
                        </form>
                    </div>
                </div>
            </div>
        </x-customPanel>
    @endsection
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
                    var index = $(this).parent().index();
                    tabsHeader.find('a').removeClass('active');
                    $(this).addClass('active');
                    tabs.children().hide();
                    tabs.children().eq(index).show();
                    AOS.refresh();
                    return false;
                });


                var rateUserForm = $("#rateUserForm");
                var rateUserFormValidator = rateUserForm.validate();
                rateUserForm.submit(function() {
                    $('#rate-list-error').css('display', 'none');
                    if (
                        $("input[name='responseSpeed']:checked").length == 0 ||
                        $("input[name='Quality']:checked").length == 0 ||
                        $("input[name='Cost']:checked").length == 0
                    ) {
                        // console.log('tewst');
                        $('#rate-list-error').text('يرجى ادخال جميع البنودالخاصة بالتقييم');
                        $('#rate-list-error').css('display', 'block');
                        return false;
                    }
                    // return false;
                    if (rateUserForm.valid()) {
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);

                        $.ajax({
                            type: "POST",
                            url: rateUserForm.attr('action'),
                            data: rateUserForm.serialize(),
                            dataType: "json",
                            success: function(response) {
                                showAlertSuccessClass(response.message);
                                $('.btn-rateUser[data-request-id="' + response.requestId +
                                    '"]').parent().remove();
                                setTimeout(function() {
                                    rateUserForm.trigger('reset');
                                    rateUserFormValidator.resetForm();
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






                $('.btn-rateUser').on('click', function(e) {
                    var requestID = $(this).attr('data-request-id');
                    var userEmail = $(this).attr('data-projectowner-email');


                    var projectOwnerName = $('.data-rater-content[data-request-id="' + requestID +
                            '"] .raterData .project-owner-rating-name')
                        .text();
                    var projectTitle = $('.data-rater-content[data-request-id="' + requestID +
                            '"] .raterData .users-rating-block .title')
                        .text();
                    var profileImg = $('.data-rater-content[data-request-id="' + requestID +
                        '"] .raterData .profileImg').html();
                    var requestedServices = $('.data-rater-content[data-request-id="' + requestID +
                            '"] .raterData .project-details-services')
                        .html();
                    var reviewComment = $('.data-rater-content[data-request-id="' + requestID +
                        '"] .raterData .rating-comment').text();
                    var ratingList = $('.data-rater-content[data-request-id="' + requestID +
                        '"] .raterData .rating-list').html();




                    // console.log(projectOwnerName);
                    // console.log(requestedServices);
                    // console.log(reviewComment);
                    $('.popup-data-content .raterData .project-owner-rating-name')
                        .text(projectOwnerName);
                    $('.popup-data-content .raterData .profileImg').html(profileImg);
                    $('.popup-data-content .raterData .project-details-services').html(requestedServices);
                    $('.popup-data-content .raterData .rating-comment').text(reviewComment);
                    $('.popup-data-content .raterData .rating-list').html(ratingList);
                    $('.popup-data-content .raterData .project-owner-rating .title').text(projectTitle);
                    $('#rateUserForm input[name="requestId"]').val(requestID);
                    $('#rateUserForm input[name="projectOwnerEmail"]').val(userEmail);


                    openPanel('rateUserPanel');
                    e.preventDefault();
                });

                $(document).on("click", ".close-panel", function(e) {
                    rateUserForm.trigger("reset");
                    rateUserFormValidator.resetForm();
                    $('#rateUserForm input[name="requestId"]').val('');
                    $('#rateUserForm input[name="projectOwnerEmail"]').val('');
                    closePanel('rateUserPanel');

                    $('.rating-list.withActions .rating ul li').removeClass('active');
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

                function getExtension(filename) {
                    var parts = filename.split('.');
                    return parts[parts.length - 1];
                }

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        // console.log(input.files[0])
                        if(getExtension(input.files[0].name) === 'pdf'){
                            $('#previewImg').attr('src', "{{ asset('user_files/pdf2.png') }}");
                            return;
                        }
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#previewImg').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                var addNewWorkForm = $("#addNewWorkForm");
                var addNewWorkFormValidator = addNewWorkForm.validate({
                    ignore: [],
                    errorPlacement: function(error, element) {
                        var placement = $(element).data('error');
                        if (placement) {
                            $(placement).append(error)
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });

                $('[data-fancybox="gallery"]').fancybox();

                $(document).on("click", ".close-panel", function(e) {
                    addNewWorkForm.trigger("reset");
                    addNewWorkFormValidator.resetForm();
                    $('#previewImg').css('display', 'none');
                    $('.innerbox-container').css('display', 'block');
                    closePanel('addWorkModel');
                    // form.find('.btn-saveChanges').find('.text').html(
                    //     '{{ __('form.buttons.create_job') }}');
                    e.preventDefault();
                });

                addNewWorkForm.submit(function() {
                    if (addNewWorkForm.valid()) {
                        // console.log('asdasd');
                        var btn = $(this).find("button[type='submit']");

                        btn.addClass('loading').prop('disabled', true);

                        var formData = new FormData();
                        var workTitle = $('#workTitle');
                        var workFile = $('#arbitration');
                        var files = workFile[0].files;
                        formData.append('workFile', files[0]);
                        formData.append('workTitle', workTitle.val());

                        $.ajax({
                            type: "POST",
                            url: addNewWorkForm.attr('action'),
                            data: formData,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                // var response = $.parseJSON(response);
                                showAlertSuccessClass(response.message);
                                if ($('.NoWorks').length > 0) {
                                    $('.NoWorks').remove();
                                }
                                $('[data-fancybox="gallery"]').fancybox();
                                $('.portfolio-items').append(response.addedWork);

                                setTimeout(function() {
                                    addNewWorkForm.trigger("reset");
                                    addNewWorkFormValidator.resetForm();
                                    $('.close-panel').trigger("click");
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

                $("#arbitration").change(function() {
                    addNewWorkFormValidator.element("#arbitration");
                });

                $("#arbitration").change(function() {
                    if ($(this).val().length == 0) {
                        $('#previewImg').css('display', 'none');
                        $('.innerbox-container').css('display', 'block');

                    } else {
                        readURL(this);
                        $('#previewImg').css('display', 'block');
                        $('.innerbox-container').css('display', 'none');
                    }

                });




                function populate(frm, data) {
                    $.each(data, function(key, value) {
                        $('[name=' + key + ']', frm).val(value);
                    });
                }



                $(".cancel-dropdown").on('click', function(e) {
                    $('.btn-dropdown').trigger("click");
                    e.preventDefault();
                });



                $(document).on("click", ".btn-dropdown", function(e) {

                    e.preventDefault();
                    e.stopPropagation();
                    if ($('.eg-dropdown').css('display') == 'block') {

                        $('.dropdownlist-content').removeClass('showActions');

                        setTimeout(function() {
                            $('.eg-dropdown').css({
                                'display': 'none',
                            });
                            $('#deleteWorkForm').trigger('reset');
                        }, 250);

                        return false;
                    }

                    var workId = $(this).parents('.workCard').attr('data-work-id');

                    var data = {
                        'workId': workId,
                    };
                    populate($('#deleteWorkForm'), data);

                    var position_btn = $(this).offset();
                    var widthBtn = $(this).outerWidth();
                    var dropdownContentWidth = $('.dropdownlist-content').outerWidth();
                    var dropdownContentHeight = $('.dropdownlist-content').outerHeight();

                    var centerX = position_btn.left + widthBtn / 2;


                    $('.eg-dropdown').css({
                        'display': 'block',
                        'width': dropdownContentWidth,
                        'height': dropdownContentHeight
                    });
                    var leftside = position_btn.left;
                    if ($('html').is(':lang(ar)')) {
                        leftside = position_btn.left - $('.eg-dropdown').outerWidth() / 2;
                    }


                    $('.eg-dropdown').css({
                        'position': 'absolute',
                        'top': position_btn.top + $('.btn-dropdown').innerHeight(),
                        'left': leftside
                    });


                    $('.dropdownlist-content').addClass('showActions');


                });

                var formDelete = $('#deleteWorkForm');
                formDelete.submit(function() {
                    if (formDelete.valid()) {
                        var btn = $(this).find("button[type='submit']");
                        btn.addClass('loading').prop('disabled', true);
                        $.ajax({
                            type: "POST",
                            url: formDelete.attr('action'),
                            data: formDelete.serialize(),
                            dataType: "json",
                            success: function(response) {
                                $('.btn-dropdown').trigger("click");
                                $('.workCard[data-work-id="' + response.workId + '"]').fadeOut(
                                    "slow",
                                    function() {
                                        $(this).remove();
                                    });
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });


                        return false;
                    }
                    return false;
                });




            })

        </script>
    @endsection
</x-layout>
