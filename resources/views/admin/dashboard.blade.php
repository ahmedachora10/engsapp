@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label font-weight-bolder">
                            الرسائل
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 25-->
                            <div class="card card-custom bg-light-success card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-success">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                                <path
                                                    d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z"
                                                    fill="#000000"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $totalContactNewMsgs }}</span>
                                    <span class="font-weight-bold text-muted font-size-sm">رسائل جديدة - اتصل بنا</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 25-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label font-weight-bolder">
                            المستخدمين
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 26-->
                            <div class="card card-custom bg-dark card-stretch gutter-b">
                                <!--begin::ody-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path
                                                    d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path
                                                    d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $totalUsers->total }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">عدد المستخدمين الكلي</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 26-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 26-->
                            <div class="card card-custom bg-dark card-stretch gutter-b">
                                <!--begin::ody-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path
                                                    d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path
                                                    d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $totalUsers->users }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">مستخدم</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 26-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 30-->
                            <div class="card card-custom bg-dark card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path
                                                    d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path
                                                    d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $totalUsers->companies }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">شركة هندسية</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 30-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Stats Widget 32-->
                            <div class="card card-custom bg-dark card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path
                                                    d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path
                                                    d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 text-hover-primary d-block">{{ $totalUsers->freelancers }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">مستقل</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 32-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label font-weight-bolder">
                            احصائيات
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 29-->
                            <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
                                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('adminAssets/assets/media/svg/shapes/abstract-1.svg') }})">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-info">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.17" height="19.158"
                                            viewBox="0 0 19.17 19.158" class="m-auto">
                                            <g id="sketch" transform="translate(0 -0.153)">
                                                <g id="Group_23" data-name="Group 23" transform="translate(1.597 3.336)">
                                                    <g id="Group_22" data-name="Group 22">
                                                        <path id="Path_20" data-name="Path 20"
                                                            d="M43.862,85.179a1.2,1.2,0,0,0-1.2,1.2v3.195h.8V86.377a.4.4,0,0,1,.4-.4h9.585v-.8Z"
                                                            transform="translate(-42.664 -85.179)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_25" data-name="Group 25" transform="translate(1.597 10.924)">
                                                    <g id="Group_24" data-name="Group 24">
                                                        <path id="Path_21" data-name="Path 21"
                                                            d="M43.862,292.238a.4.4,0,0,1-.4-.4v-3.994h-.8v3.994a1.2,1.2,0,0,0,1.2,1.2h3.994v-.8Z"
                                                            transform="translate(-42.664 -287.845)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_27" data-name="Group 27" transform="translate(0 6.531)">
                                                    <g id="Group_26" data-name="Group 26" transform="translate(0)">
                                                        <path id="Path_22" data-name="Path 22"
                                                            d="M12.663,180.33l-9.7-9.7a.4.4,0,0,0-.565,0L.117,172.913a.4.4,0,0,0,0,.565l9.7,9.7a.4.4,0,0,0,.565,0l2.282-2.282A.4.4,0,0,0,12.663,180.33Zm-2.564,2L.964,173.2l1.717-1.717,9.134,9.134Z"
                                                            transform="translate(0 -170.514)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_29" data-name="Group 29" transform="translate(11.582 15.317)">
                                                    <g id="Group_28" data-name="Group 28">
                                                        <path id="Path_23" data-name="Path 23"
                                                            d="M315.322,405.179h-5.991v.8h4.393v2a.4.4,0,0,0,.4.4h1.2a1.6,1.6,0,1,0,0-3.195Zm0,2.4h-.8v-1.6h.8a.8.8,0,1,1,0,1.6Z"
                                                            transform="translate(-309.331 -405.179)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_31" data-name="Group 31" transform="translate(15.575 3.336)">
                                                    <g id="Group_30" data-name="Group 30">
                                                        <path id="Path_24" data-name="Path 24"
                                                            d="M417.995,85.179h-2v.8h2a.8.8,0,0,1,.8.8V98.757h.8V86.776A1.6,1.6,0,0,0,417.995,85.179Z"
                                                            transform="translate(-415.998 -85.179)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_33" data-name="Group 33" transform="translate(6.107 11.44)">
                                                    <g id="Group_32" data-name="Group 32" transform="translate(0 0)">
                                                        <rect id="Rectangle_124" data-name="Rectangle 124" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_35" data-name="Group 35" transform="translate(4.51 9.843)">
                                                    <g id="Group_34" data-name="Group 34" transform="translate(0 0)">
                                                        <rect id="Rectangle_125" data-name="Rectangle 125" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_37" data-name="Group 37" transform="translate(7.704 13.038)">
                                                    <g id="Group_36" data-name="Group 36" transform="translate(0 0)">
                                                        <rect id="Rectangle_126" data-name="Rectangle 126" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_39" data-name="Group 39" transform="translate(9.302 14.636)">
                                                    <g id="Group_38" data-name="Group 38" transform="translate(0 0)">
                                                        <rect id="Rectangle_127" data-name="Rectangle 127" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_41" data-name="Group 41" transform="translate(2.911 8.246)">
                                                    <g id="Group_40" data-name="Group 40" transform="translate(0 0)">
                                                        <rect id="Rectangle_128" data-name="Rectangle 128" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_43" data-name="Group 43" transform="translate(8.816 0.153)">
                                                    <g id="Group_42" data-name="Group 42" transform="translate(0 0)">
                                                        <path id="Path_25" data-name="Path 25"
                                                            d="M243.867,1.039l-.552-.552a1.209,1.209,0,0,0-1.669,0L235.573,6.56a.4.4,0,0,0,0,.565l1.656,1.656a.4.4,0,0,0,.565,0l6.073-6.073h0A1.18,1.18,0,0,0,243.867,1.039Zm-.564,1.1-5.791,5.791L236.42,6.842l5.791-5.79a.39.39,0,0,1,.539,0l.552.552h0A.381.381,0,0,1,243.3,2.143Z"
                                                            transform="translate(-235.456 -0.153)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_45" data-name="Group 45" transform="translate(7.987 6.716)">
                                                    <g id="Group_44" data-name="Group 44">
                                                        <path id="Path_26" data-name="Path 26"
                                                            d="M216.084,176.855l-1.724.576.576-1.726-.759-.253-.828,2.484a.4.4,0,0,0,.379.526.405.405,0,0,0,.125-.019l2.484-.828Z"
                                                            transform="translate(-213.328 -175.451)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_47" data-name="Group 47" transform="translate(13.901 1.591)">
                                                    <g id="Group_46" data-name="Group 46">
                                                        <rect id="Rectangle_129" data-name="Rectangle 129" width="0.799"
                                                            height="2.342" transform="translate(0 0.565) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_49" data-name="Group 49" transform="translate(8.387 8.927)">
                                                    <g id="Group_48" data-name="Group 48">
                                                        <rect id="Rectangle_130" data-name="Rectangle 130" width="5.991"
                                                            height="0.799" fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_51" data-name="Group 51" transform="translate(15.176 8.927)">
                                                    <g id="Group_50" data-name="Group 50">
                                                        <rect id="Rectangle_131" data-name="Rectangle 131" width="0.799"
                                                            height="0.799" fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_53" data-name="Group 53" transform="translate(16.773 8.927)">
                                                    <g id="Group_52" data-name="Group 52">
                                                        <rect id="Rectangle_132" data-name="Rectangle 132" width="0.799"
                                                            height="0.799" fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->total }}</span>
                                    <span class="font-weight-bold text-muted font-size-sm">عدد المشاريع</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 29-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 29-->
                            <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
                                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('adminAssets/assets/media/svg/shapes/abstract-1.svg') }})">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-info">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.374" height="15.945"
                                            viewBox="0 0 13.374 15.945" class="m-auto">
                                            <path id="engineer"
                                                d="M18.6,5.886h-.514a.772.772,0,0,0-.772.772V6.7a.773.773,0,0,0-.514.728v.3a.767.767,0,0,0,.226.546l.275.275-.277,2.357a5.392,5.392,0,0,0-3.37-2.414l-.115-.345a1.286,1.286,0,0,0,.837-.72h.109A1.03,1.03,0,0,0,15.516,6.4V5.115A.515.515,0,0,0,16.03,4.6V4.086a.515.515,0,0,0-.514-.514h-.045a3.084,3.084,0,0,0-6.083,0H9.343a.515.515,0,0,0-.514.514V4.6a.515.515,0,0,0,.514.514V6.4A1.03,1.03,0,0,0,10.372,7.43h.109a1.287,1.287,0,0,0,.837.72L11.2,8.5a4.735,4.735,0,0,0-1.626.718L9.071,7.639c0-.008,0-.017,0-.025-.129-.542-.9-.825-1.75-.644a1.854,1.854,0,0,0-1.185.714.759.759,0,0,0-.114.589.705.705,0,0,0,.157.3l1.762,2.639a4.671,4.671,0,0,0-.4,1.875A2.83,2.83,0,0,0,9.086,15.6v.312a1.03,1.03,0,0,0,1.029,1.029h5.658V13.578a2,2,0,0,0,3.6-1.21V6.658a.772.772,0,0,0-.772-.772ZM17.316,7.43a.257.257,0,0,1,.257-.257h.257V6.658a.257.257,0,0,1,.257-.257H18.6a.257.257,0,0,1,.257.257V8.2H17.68l-.288-.288a.256.256,0,0,1-.075-.182ZM13.2,15.917v.514h-.657a1.018,1.018,0,0,0,.143-.514Zm.257-.514H11.915V14.223l.288-.288a.26.26,0,0,1,.182-.075h.3a.257.257,0,0,1,.257.257v.257h.514a.257.257,0,0,1,.257.257v.514a.257.257,0,0,1-.257.257Zm-.443-7.2.154.463-.74.926-.741-.926.154-.463h1.172ZM11.691,9.49c-.011,0-.022,0-.033,0H10.107A4.205,4.205,0,0,1,11.3,9ZM10.115,10h.652a1.021,1.021,0,0,0-.138.514v.257h.514v-.257a.514.514,0,1,1,.514.514H10.115a.514.514,0,0,1,0-1.029ZM9.6,11.4a1.018,1.018,0,0,0,.514.143h1.543a1.018,1.018,0,0,0,.514-.143v1.977a.764.764,0,0,0-.333.193l-.288.288h-.922A2.317,2.317,0,0,1,9.6,13.616Zm3.6,2.143a.767.767,0,0,0-.514-.2V10.516a1.017,1.017,0,0,0-.064-.345l.578-.722Zm1.286-6.629V5.886a.514.514,0,1,1,0,1.029ZM15,5.515a1.018,1.018,0,0,0-.514-.143V5.115H15Zm-.052-1.943H13.2V1.632A2.549,2.549,0,0,1,14.949,3.572ZM12.687,1.527V3.572h-.514V1.527c.085-.008.17-.013.257-.013S12.6,1.519,12.687,1.527Zm-1.029.1v1.94H9.91A2.549,2.549,0,0,1,11.658,1.632ZM9.343,4.086h6.173V4.6H9.343Zm1.029,1.029v.257a1.018,1.018,0,0,0-.514.143v-.4ZM9.858,6.4a.515.515,0,0,1,.514-.514V6.915A.515.515,0,0,1,9.858,6.4Zm1.029.514v-1.8h3.086v1.8a.772.772,0,0,1-.772.772H11.658A.772.772,0,0,1,10.886,6.915ZM6.568,7.959a1.389,1.389,0,0,1,.857-.486,1.979,1.979,0,0,1,.409-.045.867.867,0,0,1,.708.247l.025.078a.267.267,0,0,1-.048.175,1.389,1.389,0,0,1-.857.486A1.233,1.233,0,0,1,6.58,8.253l-.05-.076a.232.232,0,0,1-.011-.023.26.26,0,0,1,.049-.2Zm.694,1.013a2.442,2.442,0,0,0,.507-.055,2.068,2.068,0,0,0,1.011-.5l.489,1.52a1.021,1.021,0,0,0-.183.583v1.49L7.053,8.961c.068.007.137.011.208.011Zm.8,4.115a4.167,4.167,0,0,1,.225-1.358l.8,1.2v.332a2.3,2.3,0,0,1-.309-.331l-.411.309a2.842,2.842,0,0,0,2.263,1.132H11.4V15.4H10.372a2.317,2.317,0,0,1-2.315-2.315Zm2.829,3.343h-.772a.515.515,0,0,1-.514-.514v-.11a2.82,2.82,0,0,0,.772.11h1.8a.515.515,0,0,1-.514.514Zm6.481-2.572a1.483,1.483,0,0,1-1.334-.824l-.261-.522v-.968h-.514v4.886H13.715v-.562a.771.771,0,0,0,.514-.724v-.514a.771.771,0,0,0-.514-.724V9.041a4.877,4.877,0,0,1,3.166,2.684l.039.085L16.8,12.8l.511.06L17.8,8.715h1.057v3.653a1.493,1.493,0,0,1-1.491,1.491Z"
                                                transform="translate(-6 -1)" fill="#224d5c"></path>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->consult }}</span>
                                    <span class="font-weight-bold text-muted font-size-sm">استشارة</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 29-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Stats Widget 29-->
                            <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
                                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('adminAssets/assets/media/svg/shapes/abstract-1.svg') }})">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-info">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.17" height="19.158"
                                            viewBox="0 0 19.17 19.158" class="m-auto">
                                            <g id="sketch" transform="translate(0 -0.153)">
                                                <g id="Group_23" data-name="Group 23" transform="translate(1.597 3.336)">
                                                    <g id="Group_22" data-name="Group 22">
                                                        <path id="Path_20" data-name="Path 20"
                                                            d="M43.862,85.179a1.2,1.2,0,0,0-1.2,1.2v3.195h.8V86.377a.4.4,0,0,1,.4-.4h9.585v-.8Z"
                                                            transform="translate(-42.664 -85.179)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_25" data-name="Group 25" transform="translate(1.597 10.924)">
                                                    <g id="Group_24" data-name="Group 24">
                                                        <path id="Path_21" data-name="Path 21"
                                                            d="M43.862,292.238a.4.4,0,0,1-.4-.4v-3.994h-.8v3.994a1.2,1.2,0,0,0,1.2,1.2h3.994v-.8Z"
                                                            transform="translate(-42.664 -287.845)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_27" data-name="Group 27" transform="translate(0 6.531)">
                                                    <g id="Group_26" data-name="Group 26" transform="translate(0)">
                                                        <path id="Path_22" data-name="Path 22"
                                                            d="M12.663,180.33l-9.7-9.7a.4.4,0,0,0-.565,0L.117,172.913a.4.4,0,0,0,0,.565l9.7,9.7a.4.4,0,0,0,.565,0l2.282-2.282A.4.4,0,0,0,12.663,180.33Zm-2.564,2L.964,173.2l1.717-1.717,9.134,9.134Z"
                                                            transform="translate(0 -170.514)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_29" data-name="Group 29" transform="translate(11.582 15.317)">
                                                    <g id="Group_28" data-name="Group 28">
                                                        <path id="Path_23" data-name="Path 23"
                                                            d="M315.322,405.179h-5.991v.8h4.393v2a.4.4,0,0,0,.4.4h1.2a1.6,1.6,0,1,0,0-3.195Zm0,2.4h-.8v-1.6h.8a.8.8,0,1,1,0,1.6Z"
                                                            transform="translate(-309.331 -405.179)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_31" data-name="Group 31" transform="translate(15.575 3.336)">
                                                    <g id="Group_30" data-name="Group 30">
                                                        <path id="Path_24" data-name="Path 24"
                                                            d="M417.995,85.179h-2v.8h2a.8.8,0,0,1,.8.8V98.757h.8V86.776A1.6,1.6,0,0,0,417.995,85.179Z"
                                                            transform="translate(-415.998 -85.179)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_33" data-name="Group 33" transform="translate(6.107 11.44)">
                                                    <g id="Group_32" data-name="Group 32" transform="translate(0 0)">
                                                        <rect id="Rectangle_124" data-name="Rectangle 124" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_35" data-name="Group 35" transform="translate(4.51 9.843)">
                                                    <g id="Group_34" data-name="Group 34" transform="translate(0 0)">
                                                        <rect id="Rectangle_125" data-name="Rectangle 125" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_37" data-name="Group 37" transform="translate(7.704 13.038)">
                                                    <g id="Group_36" data-name="Group 36" transform="translate(0 0)">
                                                        <rect id="Rectangle_126" data-name="Rectangle 126" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_39" data-name="Group 39" transform="translate(9.302 14.636)">
                                                    <g id="Group_38" data-name="Group 38" transform="translate(0 0)">
                                                        <rect id="Rectangle_127" data-name="Rectangle 127" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_41" data-name="Group 41" transform="translate(2.911 8.246)">
                                                    <g id="Group_40" data-name="Group 40" transform="translate(0 0)">
                                                        <rect id="Rectangle_128" data-name="Rectangle 128" width="1.695"
                                                            height="0.799" transform="translate(0 1.198) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_43" data-name="Group 43" transform="translate(8.816 0.153)">
                                                    <g id="Group_42" data-name="Group 42" transform="translate(0 0)">
                                                        <path id="Path_25" data-name="Path 25"
                                                            d="M243.867,1.039l-.552-.552a1.209,1.209,0,0,0-1.669,0L235.573,6.56a.4.4,0,0,0,0,.565l1.656,1.656a.4.4,0,0,0,.565,0l6.073-6.073h0A1.18,1.18,0,0,0,243.867,1.039Zm-.564,1.1-5.791,5.791L236.42,6.842l5.791-5.79a.39.39,0,0,1,.539,0l.552.552h0A.381.381,0,0,1,243.3,2.143Z"
                                                            transform="translate(-235.456 -0.153)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_45" data-name="Group 45" transform="translate(7.987 6.716)">
                                                    <g id="Group_44" data-name="Group 44">
                                                        <path id="Path_26" data-name="Path 26"
                                                            d="M216.084,176.855l-1.724.576.576-1.726-.759-.253-.828,2.484a.4.4,0,0,0,.379.526.405.405,0,0,0,.125-.019l2.484-.828Z"
                                                            transform="translate(-213.328 -175.451)" fill="#224d5c"></path>
                                                    </g>
                                                </g>
                                                <g id="Group_47" data-name="Group 47" transform="translate(13.901 1.591)">
                                                    <g id="Group_46" data-name="Group 46">
                                                        <rect id="Rectangle_129" data-name="Rectangle 129" width="0.799"
                                                            height="2.342" transform="translate(0 0.565) rotate(-45)"
                                                            fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_49" data-name="Group 49" transform="translate(8.387 8.927)">
                                                    <g id="Group_48" data-name="Group 48">
                                                        <rect id="Rectangle_130" data-name="Rectangle 130" width="5.991"
                                                            height="0.799" fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_51" data-name="Group 51" transform="translate(15.176 8.927)">
                                                    <g id="Group_50" data-name="Group 50">
                                                        <rect id="Rectangle_131" data-name="Rectangle 131" width="0.799"
                                                            height="0.799" fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                                <g id="Group_53" data-name="Group 53" transform="translate(16.773 8.927)">
                                                    <g id="Group_52" data-name="Group 52">
                                                        <rect id="Rectangle_132" data-name="Rectangle 132" width="0.799"
                                                            height="0.799" fill="#224d5c"></rect>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->projects }}</span>
                                    <span class="font-weight-bold text-muted font-size-sm">تنفيذ مشاريع</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 29-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Stats Widget 29-->
                            <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
                                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('adminAssets/assets/media/svg/shapes/abstract-1.svg') }})">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-info">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.991" height="18.403"
                                            viewBox="0 0 10.991 18.403" class="m-auto">
                                            <g id="Group_15055" data-name="Group 15055"
                                                transform="translate(-163.519 -195.805)">
                                                <path id="Path_6557" data-name="Path 6557"
                                                    d="M165.011,271.218c-.249,0-.466,0-.684,0a.764.764,0,0,1-.808-.809c0-.8.017-1.594.018-2.391,0-.517-.019-1.034-.018-1.552a2.212,2.212,0,0,1,2.286-2.28c.811,0,1.621,0,2.432,0a.322.322,0,0,1,.338.176.294.294,0,0,1-.288.419c-.374.008-.749,0-1.124,0-.463,0-.926,0-1.39,0a1.628,1.628,0,0,0-1.656,1.659c0,.722-.013,1.444-.014,2.167,0,.586.011,1.171.013,1.757,0,.17.065.253.242.248.209-.006.419,0,.652,0,0-.093,0-.165,0-.238q0-1.665,0-3.331a.9.9,0,0,1,.009-.2.3.3,0,0,1,.584-.008.926.926,0,0,1,.011.224q0,4.815,0,9.629v.3h1.449v-.241q0-2.32,0-4.641a1.17,1.17,0,0,1,.009-.224.3.3,0,0,1,.592.027,1.736,1.736,0,0,1,0,.184q0,2.32,0,4.641V277c.258,0,.5.008.741-.008.044,0,.1-.1.12-.16q.634-1.747,1.26-3.5.352-.98.7-1.96c.023-.063.043-.127.068-.2a.94.94,0,0,1-.46-.958c.013-.216,0-.434,0-.646-.363-.1-.388-.142-.38-.523,0-.229,0-.458,0-.681-.6-.1-.6-.1-.6-.694q0-1.452,0-2.9a1.829,1.829,0,0,1,1.439-1.9c.026-.007.051-.019.085-.032v-.308a1.159,1.159,0,0,1-.164-.022.286.286,0,0,1-.232-.3.278.278,0,0,1,.262-.291,2.182,2.182,0,0,1,.489,0,.287.287,0,0,1,.26.315c0,.2,0,.394,0,.6a1.982,1.982,0,0,1,1.535,2.385c.158,0,.286,0,.413,0a.879.879,0,0,1,.877.869c.007.293.007.586,0,.879a.876.876,0,0,1-.883.883c-.127,0-.255,0-.41,0,.077.487-.23.517-.59.481,0,.281,0,.53,0,.78,0,.315-.051.377-.381.45,0,.243,0,.493,0,.742a.941.941,0,0,1-.375.82.249.249,0,0,0-.03.22c.355,1.008.718,2.013,1.079,3.019.295.82.593,1.639.881,2.461a.222.222,0,0,0,.262.182c.169-.013.34-.005.511,0,.223,0,.357.123.353.309s-.133.293-.345.293q-4.4,0-8.808,0c-.249,0-.346-.115-.346-.4q0-2.586,0-5.172Zm7.189-6.543a1.237,1.237,0,1,0-1.239,1.232A1.243,1.243,0,0,0,172.2,264.675Zm-2.462,1.384v1.67H172.2v-1.673A1.92,1.92,0,0,1,169.738,266.059Zm3.07,10.934-1.505-4.188-.027.008v4.18Zm-2.159-4.156-.033-.008-1.495,4.159h1.528Zm2.165-5.584c.141,0,.262.005.382,0a.283.283,0,0,0,.3-.3,6.254,6.254,0,0,0-.008-.834.391.391,0,0,0-.212-.275,1.473,1.473,0,0,0-.457-.012Zm-2.488,1.673h1.268c.008-.167.023-.322.018-.477,0-.041-.062-.114-.1-.115-.392-.008-.784-.005-1.189-.005Zm.385.628c0,.307-.011.6,0,.9a.206.206,0,0,0,.254.2c.093-.023.229-.122.236-.2.027-.3.011-.6.011-.9Z"
                                                    transform="translate(0 -63.401)" fill="#224d5c"></path>
                                                <path id="Path_6558" data-name="Path 6558"
                                                    d="M200.52,198.635a1.947,1.947,0,0,1-3.839,0c-.059,0-.125-.008-.19-.009-.325,0-.423-.109-.408-.438a2.519,2.519,0,0,1,5.028-.046c.023.4-.052.478-.459.483C200.612,198.63,200.571,198.632,200.52,198.635Zm-3.782-.626h3.741a1.9,1.9,0,0,0-2.059-1.59A1.857,1.857,0,0,0,196.738,198.008Zm.6.629a1.283,1.283,0,0,0,1.344,1.013,1.256,1.256,0,0,0,1.181-1.013Z"
                                                    transform="translate(-31.232 0)" fill="#224d5c"></path>
                                                <path id="Path_6568" data-name="Path 6568"
                                                    d="M329.221,312.328a.277.277,0,0,1-.228.277c-.113.024-.171.061-.195.187a.277.277,0,0,1-.329.234.306.306,0,0,1-.262-.333.723.723,0,0,1,.667-.675A.309.309,0,0,1,329.221,312.328Z"
                                                    transform="translate(-157.958 -111.462)" fill="#224d5c"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->visit }}</span>
                                    <span class="font-weight-bold text-muted font-size-sm">طلب زيارة موقع</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 29-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label font-weight-bolder">
                            المشاريع
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 31-->
                            <div class="card card-custom bg-gray-800 card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                    rx="1.5">
                                                </rect>
                                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->completed }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">عدد المشاريع المكتملة</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 31-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 31-->
                            <div class="card card-custom bg-gray-800 card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                    rx="1.5">
                                                </rect>
                                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->waiting }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">عدد المشاريع قيد الانتظار ( تلقي
                                        العروض)</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 31-->
                        </div>

                        <div class="col-xl-3">
                            <!--begin::Stats Widget 31-->
                            <div class="card card-custom bg-gray-800 card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                    rx="1.5">
                                                </rect>
                                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->implementation + $totalRequests->delivering }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">عدد المشاريع قيد الانجاز</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 31-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Stats Widget 31-->
                            <div class="card card-custom bg-gray-800 card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x svg-icon-white">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                    rx="1.5">
                                                </rect>
                                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span
                                        class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ $totalRequests->canceled }}</span>
                                    <span class="font-weight-bold text-white font-size-sm">عدد المشاريع ملغية</span>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Stats Widget 31-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @can('super-admin')
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label font-weight-bolder">
                                مالية
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3">
                                <!--begin::Stats Widget 27-->
                                <div class="card card-custom bg-light card-stretch gutter-b">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-2x svg-icon-info">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                        rx="1.5">
                                                    </rect>
                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span
                                            class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $totalOffers->total }}</span>
                                        <span class="font-weight-bold text-muted font-size-sm">عدد العروض المقدمة</span>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Stats Widget 27-->
                            </div>

                            <div class="col-xl-3">
                                <!--begin::Stats Widget 27-->
                                <div class="card card-custom bg-light card-stretch gutter-b">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-2x svg-icon-info">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                        rx="1.5">
                                                    </rect>
                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span
                                            class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ number_format($totalOffers->waiting) }}
                                            ر.س</span>
                                        <span class="font-weight-bold text-muted font-size-sm">اجمالي مبالغ العروض
                                            المقدمة</span>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Stats Widget 27-->
                            </div>
                            <div class="col-xl-3">
                                <!--begin::Stats Widget 31-->
                                <div class="card card-custom bg-light card-stretch gutter-b">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-2x svg-icon-info">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                        rx="1.5">
                                                    </rect>
                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span
                                            class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ number_format($totalOffers->accepted) }}
                                            ر.س</span>
                                        <span class="font-weight-bold text-muted font-size-sm">اجمالي العروض المقبولة</span>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Stats Widget 31-->
                            </div>
                            <div class="col-xl-3">
                                <!--begin::Stats Widget 31-->
                                <div class="card card-custom bg-danger card-stretch gutter-b">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-2x svg-icon-white">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                                        rx="1.5">
                                                    </rect>
                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span
                                            class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{ number_format($totalOffers->completed) }}
                                            ر.س</span>
                                        <span class="font-weight-bold text-white font-size-sm">اجمالي المشاريع المكتملة</span>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Stats Widget 31-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
