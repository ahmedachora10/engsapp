<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="symbol-label" {!! $profileImg !!}></div>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                        {{ $user->name }}
                    </a>
                    <div class="mt-2">
                        @if ($user->confirmed)
                            <span class="label label-light-success label-inline font-weight-bolder label-lg">
                                فعال
                            </span>
                        @else
                            <span class="label label-light-danger label-inline font-weight-bolder label-lg">غير
                                فعال</span>
                        @endif
                    </div>
                    <div class="mt-2">
                        <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1"
                            data-toggle="modal" data-target="#sendNotificationModel">ارسل
                            اشعار</a>
                        <!-- Button trigger modal-->
                        {{-- <button type="button" class="btn btn-primary">
                            Launch demo modal
                        </button> --}}

                    </div>
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bolder mr-2">الايميل:</span>
                    <a href="#" class="text-muted text-hover-primary">{{ $user->email }}</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bolder mr-2">رقم الجوال:</span>
                    <span class="text-muted "
                        style="direction: ltr;">+{{ $user->country_code_phone_number . $user->phone_number }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bolder mr-2">نوع الحساب:</span>
                    <span class="text-muted">
                        @if ($user->user_type == 'user')
                            مستخدم
                        @elseif($user->user_type == 'company')
                            مكتب هندسي
                        @else
                            مستقل
                        @endif

                    </span>
                </div>
            </div>
            <!--end::Contact-->
            <!--begin::Nav-->
            <div class="navi navi-bolder navi-hover navi-active navi-link-rounded">
                <div class="navi-item mb-2">
                    <a href="{{ route('admin.user.overview', ['userId' => $user->id]) }}"
                        class="navi-link py-4 {{ $currentPage == 'overview' ? 'active' : '' }}">
                        <span class="navi-icon mr-2">
                            <span class="svg-icon">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <path
                                            d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="navi-text font-size-lg">البيانات الأساسية</span>
                    </a>
                </div>
                <div class="navi-item mb-2">
                    <a href="{{ route('admin.user.details', ['userId' => $user->id]) }}"
                        class="navi-link py-4 {{ $currentPage == 'details' ? 'active' : '' }}">
                        <span class="navi-icon mr-2">
                            <span class="svg-icon">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="navi-text font-size-lg">البيانات التفصيلية</span>
                    </a>
                </div>
                @if ($user->user_type == 'freelancer')
                    <div class="navi-item mb-2">
                        <a href="{{ route('admin.freelancer.membership', ['userId' => $user->id]) }}"
                            class="navi-link py-4 {{ $currentPage == 'freelancerMemberShip' ? 'active' : '' }}">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-lg">عضوية الهيئة السعودية للمهندسين</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="{{ route('admin.company.arbitration', ['userId' => $user->id]) }}"
                           class="navi-link py-4 {{ $currentPage == 'companyarb' ? 'active' : '' }}">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                  rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                  rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-lg">تفعيل خدمة التحكيم </span>
                            @if (isset($user->operatorProfile->arbitrationcert_confirmed))
                                @if ($user->operatorProfile->arbitrationcert_confirmed == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-success label-rounded font-weight-bolder min-w-40px">
                                            مفعله
                                        </span>
                                    </span>
                                @endif
                            @endif
                            @if (isset($user->operatorProfile->arbitrationcert_request_status))
                                @if ($user->operatorProfile->arbitrationcert_request_status == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-danger label-rounded font-weight-bolder min-w-30px">
                                            طلب
                                        </span>
                                    </span>
                                @endif
                            @endif
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="{{ route('admin.company.testQuality', ['userId' => $user->id]) }}"
                           class="navi-link py-4 {{ $currentPage == 'testQuality' ? 'active' : '' }}">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                  rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                  rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-lg">تفعيل خدمات فحص الجودة </span>
                            @if (isset($user->operatorProfile->test_quality_confirmed))
                                @if ($user->operatorProfile->test_quality_confirmed == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-success label-rounded font-weight-bolder min-w-40px">
                                            مفعله
                                        </span>
                                    </span>
                                @endif
                            @endif
                            @if (isset($user->operatorProfile->test_quality_request_status))
                                @if ($user->operatorProfile->test_quality_request_status == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-danger label-rounded font-weight-bolder min-w-30px">
                                            طلب
                                        </span>
                                    </span>
                                @endif
                            @endif
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="{{ route('admin.company.testBuild', ['userId' => $user->id]) }}"
                           class="navi-link py-4 {{ $currentPage == 'testBuild' ? 'active' : '' }}">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                  rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                  rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-lg">تفعيل خدمة فحص المباني  الجاهزة </span>
                            @if (isset($user->operatorProfile->test_build_confirmed))
                                @if ($user->operatorProfile->test_build_confirmed == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-success label-rounded font-weight-bolder min-w-40px">
                                            مفعله
                                        </span>
                                    </span>
                                @endif
                            @endif
                            @if (isset($user->operatorProfile->test_build_request_status))
                                @if ($user->operatorProfile->test_build_request_status == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-danger label-rounded font-weight-bolder min-w-30px">
                                            طلب
                                        </span>
                                    </span>
                                @endif
                            @endif
                        </a>
                    </div>
                @endif
                @if ($user->user_type == 'company')
                    <div class="navi-item mb-2">
                        <a href="{{ route('admin.company.license', ['userId' => $user->id]) }}"
                            class="navi-link py-4 {{ $currentPage == 'companylic' ? 'active' : '' }}">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-lg">رخصة مزاولة المهنة الهندسية</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="{{ route('admin.company.arbitration', ['userId' => $user->id]) }}"
                            class="navi-link py-4 {{ $currentPage == 'companyarb' ? 'active' : '' }}">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                                rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                                rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-lg">تفعيل خدمة التحكيم </span>
                            @if (isset($user->operatorProfile->arbitrationcert_confirmed))
                                @if ($user->operatorProfile->arbitrationcert_confirmed == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-success label-rounded font-weight-bolder min-w-40px">
                                            مفعله
                                        </span>
                                    </span>
                                @endif
                            @endif
                            @if (isset($user->operatorProfile->arbitrationcert_request_status))
                                @if ($user->operatorProfile->arbitrationcert_request_status == 1)
                                    <span class="navi-label">
                                        <span
                                            class="label label-light-danger label-rounded font-weight-bolder min-w-30px">
                                            طلب
                                        </span>
                                    </span>
                                @endif
                            @endif
                        </a>
                    </div>
                @endif
                {{-- <div class="navi-item mb-2">
                        <a href="#" class="navi-link py-4">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"></rect>
                                            <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"></rect>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="navi-text font-size-lg">المشاريع</span>
                        </a>
                    </div> --}}
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>


@push('models')
    <!-- Modal-->
    <div class="modal fade" id="sendNotificationModel" tabindex="-1" role="dialog"
        aria-labelledby="sendNotificationModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="sendNotificationForm" method="POST">
                <input type="hidden" name="userId" value="{{ $user->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendNotificationModelLabel">ارسل إشعار</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row mb-2">
                        <label class="col-form-label text-lg-right col-lg-2 col-sm-12 font-weight-bolder">العنوان
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-10 col-md-12 col-sm-12">
                            <input type="text" id="NotificationTitle" name="NotificationTitle" class="form-control" placeholder="" value="" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-12 col-sm-12 font-weight-bolder">نص الاشعار
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <textarea class="form-control autosise_textarea" id="NotificationMessage" rows="3" name="NotificationMessage"
                                style="overflow: hidden; overflow-wrap: break-word; resize: none;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء
                        الامر</button>
                    <button type="submit" id="btnSendNotification" class="btn btn-primary font-weight-bold">إرسل إشعار</button>
                </div>
            </form>
        </div>
    </div>
@endpush
