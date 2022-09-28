@extends('layouts.admin.index')



@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    مقدم الطلب
                </h3>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img alt="Pic"
                            src="{{ $request->service_request_owner->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $request->service_request_owner->profile_img]) : asset('adminAssets/assets/media/users/blank.png') }}" />
                    </div>
                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                        <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                    </div>
                </div>
                <!--end: Pic-->
                <!--begin: Info-->
                <div class="flex-grow-1">
                    <!--begin: Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-3">
                            <!--begin::Name-->
                            <a href="{{ route('admin.user.overview', ['userId' => $request->service_request_owner->id]) }}"
                                class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                {{ $request->service_request_owner->name }}
                                @if ($request->service_request_owner->confirmed == true)
                                    <i class="flaticon2-correct text-success icon-md ml-2"></i>
                                @endif
                            </a>
                            <!--end::Name-->
                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a href="#"
                                    class="text-muted text-hover-primary font-weight-bolder mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                    fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>{{ $request->service_request_owner->email }}
                                </a>
                                <a href="#" class="text-muted text-hover-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Star.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>التقييم
                                    :{{ number_format($request->service_request_owner->rates_avg_rating_value, 2, '.', '') }}
                                </a>
                            </div>
                            <!--end::Contacts-->
                        </div>
                        {{-- <div class="my-lg-0 my-1">
                            <a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">Reports</a>
                            <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">New Task</a>
                        </div> --}}
                    </div>
                    <!--end: Title-->
                    <!--begin: Content-->
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <div class="flex-grow-1 font-weight-bolder text-dark-50 py-5 py-lg-2 mr-5">
                            <span class="text-dark-75">العنوان :</span>
                            <p> {{ $request->title }}</p>
                            <span class="text-dark-75">تصنيف الخدمة :</span>
                            <p>{{ $request->service->name_ar }}</p>
                            <span class="text-dark-75">الخدمات المطلوبة : </span>
                            <p class="pt-3">
                                @foreach ($request->requested_services as $service)
                                    <span
                                        class="label label-xl label-light label-inline {{ $loop->first ? '' : 'ml-3' }}">
                                        {{ $service->name }}
                                    </span>
                                @endforeach
                            </p>
                            @if ($request->expected_period)
                                <span class="text-dark-75">الايام المتوقعه للتنفيذ : <span class="text-dark-50">
                                        {{ $request->expected_period }}</span>
                                </span>
                                <p></p>
                            @endif
                            @if ($request->description)
                                <span class="text-dark-75">الوصف :</span>
                                <p> {!!  str_replace(PHP_EOL,'<br>',$request->description)  !!}</p>
                            @endif
                            @if ($request->address)
                                <span class="text-dark-75">عنوان موقع الزيارة :</span>
                                <p> {{ $request->address }}</p>
                            @endif
                            @if ($request->attachments->count() != 0)
                                <span class="text-dark-75">المرفقات :</span>
                                @foreach ($request->attachments as $attachment)
                                    <br>
                                    <a href="{{ asset('request_files/' . $attachment->hashName) }}" target="_blank"
                                        data-container="body" data-toggle="popover" data-placement="left" title="تنبيه"
                                        data-html="true" data-content="سيتم فتح او تحميل الملف من خلال نافذة منبثقة"
                                        class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-warning font-weight-bold btn-hover-bg-light">
                                        <span class="svg-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z"
                                                        fill="#000000" opacity="0.3"
                                                        transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) " />
                                                    <path
                                                        d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z"
                                                        fill="#000000"
                                                        transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) " />
                                                </g>
                                            </svg>
                                        </span>{{ $attachment->filename }}</a>
                                @endforeach
                            @endif

                        </div>
                        <div class="d-flex flex-wrap align-items-center py-2">
                            <div class="d-flex align-items-center mr-10">
                                <div class="mr-6">
                                    <div class="font-weight-bolder mb-2">تاريخ الانشاء</div>
                                    <span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bolder">
                                        {{ date('d-m-Y', strtotime($request->created_at)) }}
                                    </span>
                                </div>
                                <div class="">
                                    <div class="font-weight-bolder mb-2">تاريخ انتهاء التقديم</div>
                                    <span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bolder">
                                        {{ date('d-m-Y', strtotime($request->deadline_date)) }}
                                    </span>
                                </div>
                            </div>


                                @if($request->service_request_stage_id)
                                <div class="flex-grow-1 flex-shrink-0 w-150px w-xl-300px mt-4 mt-sm-0">
                                    <span class="font-weight-bolder">مرحلة المشروع
                                </span>
                                <div class="progress progress-xs mt-2 mb-2">
                                    <div class="progress-bar {{ $request->service_request_stage_id == 6 ? 'bg-danger' : 'bg-success' }}"
                                        role="progressbar"
                                        style="width: {{ round(($request->service_stage->id / 5) * 100) }}%;"
                                        aria-valuenow="{{ round(($request->service_stage->id / 5) * 100) }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="font-weight-bolder text-dark">
                                    {{ $request->service_stage->name }}
                                </span>
                                </div>
                                @else
                                <div class="d-flex align-items-center mr-10">
                                    <div class="">
                                        <div class="font-weight-bolder btn-light-danger mb-2">الطلب غير مؤكد</div>
                                        <form action="" method="post">
                                            @csrf
                                            <button type="submit" name="action_type" value="accept" class="btn btn-sm btn-text btn-light-success text-uppercase font-weight-bolder">
                                                تأكيد الطلب
                                            </button>
                                            <button type="submit" name="action_type" value="cancel" class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bolder">
                                                الغاء الطلب
                                            </button>
                                            <button type="button"  data-toggle="modal" data-target="#EditRequest" class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bolder">
                                                تعديل الطلب
                                            </button>
                                        </form>



                                    </div>
                                </div>


                                @endif

                        </div>
                    </div>
                    <!--end: Content-->
                </div>
                <!--end: Info-->
            </div>
            @if ($request->service_id != 4)
                <div class="separator separator-solid my-7"></div>
                <!--begin: Items-->
                <div class="d-flex align-items-center flex-wrap">
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                        <span class="mr-4">
                            <i class="flaticon-price-tag icon-2x text-muted font-weight-bolder"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">الميزانية تبدأ</span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bolder"></span>{{ $request->budget_min }}
                                ر.س</span>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                        <span class="mr-4">
                            <i class="flaticon-price-tag icon-2x text-muted font-weight-bolder"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">الحد الاقصى للميزانية</span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bolder"></span>{{ $request->budget_max }}
                                ر.س</span>
                        </div>
                    </div>
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                        <span class="mr-4">
                            <i class="flaticon-chat-1 icon-2x text-muted font-weight-bolder"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">عدد العروض</span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bolder"></span>{{ $request->offers_count }}</span>
                        </div>
                    </div>

                </div>
            @endif
            <!--begin: Items-->
        </div>
    </div>

    @if ($request->service_id == 4)
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        الخريطة
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div id="mapid" class="w-100" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    @endif

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header card-header-tabs-line">
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                    <li class="nav-item mr-3">
                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_projects_view_tab_2">
                            <span class="nav-icon mr-2">
                                <span class="svg-icon mr-3">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-weight-bold">العروض</span>
                        </a>
                    </li>
                    {{-- @if ($request->operator_offer) --}}

                    <li class="nav-item mr-3">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_projects_view_tab_3">
                            <span class="nav-icon mr-2">
                                <span class="svg-icon mr-3">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-weight-bold">العرض المقبول</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_projects_view_tab_1">
                            <span class="nav-icon mr-2">
                                <span class="svg-icon mr-3">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-weight-bold">المحادثة</span>
                        </a>
                    </li>
                    {{-- @endif --}}

                </ul>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
            <div class="tab-content pt-5">
                <!--begin::Tab Content-->
                <div class="tab-pane active" id="kt_apps_projects_view_tab_2" role="tabpanel">
                    @if ($request->offers->count() == 0)
                        <h5 class="font-weight-bolder">لا يوجد عروض مقدمة</h5>
                    @endif
                    <form class="form">
                        @foreach ($request->offers as $offer)
                            @if (!$loop->first)
                                <div class="separator separator-dashed mb-10"></div>
                            @endif
                            <div class="form-group row">
                                <div class="offset-xl-3 offset-lg-3"></div>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="mb-10">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light mr-5">
                                                <span class="symbol-label">
                                                    <img src="{{ $offer->operator->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $offer->operator->profile_img]) : asset('adminAssets/assets/media/users/blank.png') }}"
                                                        class="h-100 align-self-center" alt="">
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a target="_blank"
                                                    href="{{ route('admin.user.overview', ['userId' => $offer->operator->id]) }}"
                                                    class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">{{ $offer->operator->name }}</a>
                                                <span class="text-muted font-weight-bolder"><span class="text-dark-50">تاريخ
                                                        التقديم :</span> {{ $offer->created_at }}</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Desc-->
                                        <p class="text-dark-75 font-weight-bolder mb-3"> حالة العرض : <span
                                                class="text-dark-50">
                                                @if ($offer->offer_status->id == 1)
                                                    <span class="label label-xl label-light label-inline ml-3">
                                                        {{ $offer->offer_status->name }}
                                                    </span>
                                                @elseif ($offer->offer_status->id == 2)
                                                    <span class="label label-xl label-light-primary label-inline ml-3">
                                                        {{ $offer->offer_status->name }}
                                                    </span>
                                                @elseif ($offer->offer_status->id == 3)
                                                    <span class="label label-xl label-light-danger label-inline ml-3">
                                                        {{ $offer->offer_status->name }}
                                                    </span>
                                                @elseif ($offer->offer_status->id == 4)
                                                    <span class="label label-xl label-light-success label-inline ml-3">
                                                        {{ $offer->offer_status->name }}
                                                    </span>
                                                @endif
                                            </span></p>
                                        <p class="text-dark-75 font-weight-bolder mb-3"> المبلغ : <span
                                                class="text-dark-50">{{ $offer->offer_price }}</span></p>
                                        <p class="text-dark-75 font-weight-bolder mb-3">مده التنفيذ : <span
                                                class="text-dark-50">{{ $offer->expected_period }}</span></p>
                                        @php
                                            $original = $offer->offer_price;
                                            $current = $offer->offer_price_total;
                                            $diff = $current - $original;
                                            $diff = abs($diff);
                                            $percentChange = ($diff / $original) * 100;
                                        @endphp
                                        <p class="text-dark-75 font-weight-bolder mb-3">المبلغ بعد خصم نسبه الموقع :
                                            {{ $percentChange }}% : {{ $offer->offer_price_total }}</p>
                                        <p class="text-dark-75 font-weight-bolder mb-3"> التفاصيل :</p>
                                        <p> {{ $offer->offer_desc }}</p>
                                        <p class="text-dark-75 font-weight-bolder mb-3">الملفات المرفقة :</p>
                                        {{-- <p> {{ $offer->title }}</p> --}}
                                        @foreach ($offer->offer_attachments as $attachment)
                                            <a href="{{ asset('request_files/' . $attachment->hashName) }}"
                                                target="_blank" data-container="body" data-toggle="popover"
                                                data-placement="left" title="تنبيه" data-html="true"
                                                data-content="سيتم فتح او تحميل الملف من خلال نافذة منبثقة"
                                                class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-warning font-weight-bold btn-hover-bg-light">
                                                <span class="svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z"
                                                                fill="#000000" opacity="0.3"
                                                                transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) " />
                                                            <path
                                                                d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z"
                                                                fill="#000000"
                                                                transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) " />
                                                        </g>
                                                    </svg>
                                                </span>{{ $attachment->filename }}</a>
                                        @endforeach

                                        <!--end::Desc-->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!--end::Tab Content-->
                <!--begin::Tab Content-->
                <div class="tab-pane" id="kt_apps_projects_view_tab_3" role="tabpanel">
                    <form class="form">
                        @if ($request->operator_offer)
                            <div class="form-group row">
                                <div class="offset-xl-3 offset-lg-3"></div>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="mb-10">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light mr-5">
                                                <span class="symbol-label">
                                                    <img src="{{ $request->operator_offer->operator->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $request->operator_offer->operator->profile_img]) : asset('adminAssets/assets/media/users/blank.png') }}"
                                                        class="h-100 align-self-center" alt="">
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a target="_blank"
                                                    href="{{ route('admin.user.overview', ['userId' => $request->operator_offer->operator->id]) }}"
                                                    class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">{{ $request->operator_offer->operator->name }}</a>
                                                <span class="text-muted font-weight-bolder"><span class="text-dark-50">تاريخ
                                                        التقديم :</span> {{ $request->operator_offer->created_at }}</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Desc-->
                                        <p class="text-dark-75 font-weight-bolder mb-3"> حالة العرض : <span
                                                class="text-dark-50">
                                                @if ($request->operator_offer->offer_status->id == 1)
                                                    <span class="label label-xl label-light label-inline ml-3">
                                                        {{ $request->operator_offer->offer_status->name }}
                                                    </span>
                                                @elseif ($request->operator_offer->offer_status->id == 2)
                                                    <span class="label label-xl label-light-primary label-inline ml-3">
                                                        {{ $request->operator_offer->offer_status->name }}
                                                    </span>
                                                @elseif ($request->operator_offer->offer_status->id == 3)
                                                    <span class="label label-xl label-light-danger label-inline ml-3">
                                                        {{ $request->operator_offer->offer_status->name }}
                                                    </span>
                                                @elseif ($request->operator_offer->offer_status->id == 4)
                                                    <span class="label label-xl label-light-success label-inline ml-3">
                                                        {{ $request->operator_offer->offer_status->name }}
                                                    </span>
                                                @endif
                                            </span></p>
                                        <p class="text-dark-75 font-weight-bolder mb-3"> المبلغ : <span
                                                class="text-dark-50">{{ $request->operator_offer->offer_price }}</span></p>
                                        <p class="text-dark-75 font-weight-bolder mb-3">مده التنفيذ : <span
                                                class="text-dark-50">{{ $request->operator_offer->expected_period }}</span></p>
                                        @php
                                            $original = $request->operator_offer->offer_price;
                                            $current = $request->operator_offer->offer_price_total;
                                            $diff = $current - $original;
                                            $diff = abs($diff);
                                            $percentChange = ($diff / $original) * 100;
                                        @endphp
                                        <p class="text-dark-75 font-weight-bolder mb-3">المبلغ بعد خصم نسبه الموقع :
                                            {{ $percentChange }}% : {{ $request->operator_offer->offer_price_total }}</p>
                                        <p class="text-dark-75 font-weight-bolder mb-3"> التفاصيل :</p>
                                        <p> {{ $request->operator_offer->offer_desc }}</p>
                                        <p class="text-dark-75 font-weight-bolder mb-3">الملفات المرفقة :</p>
                                        {{-- <p> {{ $request->operator_offer->title }}</p> --}}
                                        @foreach ($request->operator_offer->offer_attachments as $attachment)
                                            <a href="{{ asset('request_files/' . $attachment->hashName) }}"
                                                target="_blank" data-container="body" data-toggle="popover"
                                                data-placement="left" title="تنبيه" data-html="true"
                                                data-content="سيتم فتح او تحميل الملف من خلال نافذة منبثقة"
                                                class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-warning font-weight-bold btn-hover-bg-light">
                                                <span class="svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z"
                                                                fill="#000000" opacity="0.3"
                                                                transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) " />
                                                            <path
                                                                d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z"
                                                                fill="#000000"
                                                                transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) " />
                                                        </g>
                                                    </svg>
                                                </span>{{ $attachment->filename }}</a>
                                        @endforeach

                                        <!--end::Desc-->
                                    </div>
                                </div>
                            </div>
                        @elseif ($request->operator_offer == null)
                            <h5 class="font-weight-bolder">لا يوجد عرض مقبول</h5>
                        @endif
                    </form>
                </div>
                <!--end::Tab Content-->
                <!--begin::Tab Content-->
                <div class="tab-pane" id="kt_apps_projects_view_tab_1" role="tabpanel">
                    @if ($chatMessages->count() == 0)
                        <h5 class="font-weight-bolder">لا يوجد محادثات لعرضها</h5>
                    @endif
                    <div class="container">
                        <!--begin::Timeline-->
                        <div class="timeline timeline-3">
                            <div class="timeline-items">
                                @foreach ($chatMessages as $msg)
                                    <div class="timeline-item">
                                        <div class="timeline-media">
                                            <img alt="Pic"
                                                src="{{ $msg->sender->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $msg->sender->profile_img]) : asset('adminAssets/assets/media/users/blank.png') }}" />
                                        </div>
                                        <div class="timeline-content">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="mr-2">
                                                    <a href="#"
                                                        class="text-dark-75 text-hover-primary font-weight-bold"></a>
                                                    <span class="text-muted ml-2">{{ $msg->created_at }}</span>
                                                    @if (!$msg->isread)
                                                        <span
                                                            class="label label-light font-weight-bolder label-inline ml-2">
                                                            غير مقروءة
                                                        </span>
                                                    @else
                                                        <span
                                                            class="label label-light-warning font-weight-bolder label-inline ml-2">
                                                            مقروءة
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <p class="p-0">
                                                {{ $msg->message }}
                                                <br>
                                                @foreach ($msg->attachments as $attachment)
                                                    @if ($loop->first)
                                                        <p class="text-dark-75 font-weight-bolder">الملفات المرفقة</p>
                                                    @endif
                                                    <a href="{{ asset('request_files/' . $attachment->hashName) }}"
                                                        target="_blank" data-container="body" data-toggle="popover"
                                                        data-placement="left" title="تنبيه" data-html="true"
                                                        data-content="سيتم فتح او تحميل الملف من خلال نافذة منبثقة"
                                                        class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-warning font-weight-bold btn-hover-bg-light">
                                                        <span class="svg-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z"
                                                                        fill="#000000" opacity="0.3"
                                                                        transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) " />
                                                                    <path
                                                                        d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z"
                                                                        fill="#000000"
                                                                        transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) " />
                                                                </g>
                                                            </svg>
                                                        </span>{{ $attachment->filename }}</a>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--end::Timeline-->
                    </div>
                </div>
                <!--end::Tab Content-->
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->

    <div class="modal fade" id="EditRequest" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditReqTitle">تعديل بيانات الطلب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form  method="post">
                    @csrf
                    <div class="modal-body">
                        <!--begin::Group-->
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-form-label font-weight-bolder col-12">العنوان</label>
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="title" value="{{ $request->title }}" />
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-4">

                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label font-weight-bolder col-12">مدة التنفيذ المتوقعة بالأيام</label>
                                    <div class="col-12">
                                        <input class="form-control" type="text"
                                               name="expected_period" value="{{  $request->expected_period }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-form-label font-weight-bolder col-12">تاريخ انتهاء التقديم</label>
                                    <div class="col-12">
                                        <input class="form-control" type="text"
                                               name="deadline_date" value="{{ date('d-m-Y', strtotime($request->deadline_date)) }}" />
                                    </div>
                                </div>
                            </div>
                            @if($request->service_id != 4)
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label font-weight-bolder col-12">الميزانية من </label>
                                        <div class="col-12">
                                            <input class="form-control" type="text" value="{{$request->budget_min}}" name="budget_min" />

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label font-weight-bolder col-12">الميزانية الى </label>
                                        <div class="col-12">
                                            <input class="form-control" type="text" value="{{$request->budget_max}}" name="budget_max" />

                                        </div>
                                    </div>
                                </div>

                            @endif
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label class="col-form-label font-weight-bolder col-12">الوصف </label>
                                    <div class="col-12">
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10">
                                    {{$request->description}}
                                </textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="action_type" value="edit"  id="save" class="btn btn-primary font-weight-bold">حفظ</button>
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@if ($request->service_id == 4)
    @push('styles')
        <link href="{{ asset('adminAssets/assets/plugins/custom/leaflet/leaflet.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
    @endpush
    @push('scripts')
        <script src="{{ asset('adminAssets/assets/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
        <script>
            $(function() {


                var mymap = L.map('mapid').setView([{{ $request->xPoint }},
                    {{ $request->yPoint }}
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



                var marker = L.marker([{{ $request->xPoint }}, {{ $request->yPoint }}], {
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

                $.get('https://nominatim.openstreetmap.org/reverse?lat={{ $request->xPoint }}&lon={{ $request->yPoint }}&format=json&accept-language={{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}',
                    function(data) {
                        console.log(data);
                        var str = fixNumbers(data.display_name);
                        console.log(str);
                        marker.bindPopup("<p class='popUpLayout'>" + str + "</p>").openPopup();
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
    @endpush
@endif
