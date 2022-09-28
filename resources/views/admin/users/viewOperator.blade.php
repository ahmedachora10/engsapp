@extends('admin.users.viewUserLayout')

@section('aside')
    <!--begin::Aside-->
    @include('admin.users.viewUserSidebar',['user'=> $user, 'profileImg'=>$profileImg, 'currentPage' => $currentPage])
    <!--end::Aside-->
@endsection
@section('UserContent')
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-6">
                <!--begin::Mixed Widget 14-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title font-weight-bolder">تقييم المستخدم</h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <div class="flex-grow-1">
                            <div id="kt_mixed_widget_14_chart" style="height: 200px"></div>
                        </div>
                        <div class="pt-5">
                            <p class="text-center font-weight-normal font-size-lg pb-7">
                                اجمالي عدد التقييمات هي : {{ $user->rates_count }}
                            </p>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 14-->
            </div>
            <div class="col-xl-6">
                <!--begin::List Widget 10-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-3">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">الاشعارات</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm">الاشعارات الخاصة بالمستخدم</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0">
                        <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true"
                            style="height: 283px">
                            @if ($user->notifications->count() > 0)
                                @foreach ($user->notifications as $notification)
                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <!--begin::Content-->
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <!--begin::Section-->
                                            <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                    <!--begin::Title-->
                                                    <p href="#" class="text-dark-75 font-weight-bolder font-size-lg mb-1">
                                                        {{ $notification->data['title'] }}</p>
                                                    <!--end::Title-->
                                                    <!--begin::Data-->
                                                    <span
                                                        class="text-muted font-weight-bolder d-flex flex-row align-items-center"><i
                                                            class="icon-xl la la-clock"></i>
                                                        {{ $notification->created_at }}</span>
                                                    <span
                                                        class="text-muted font-weight-bold">{{ $notification->data['message'] }}</span>

                                                    <!--end::Data-->
                                                </div>
                                                <!--end::Info-->
                                                @if ($notification->read_at)
                                                    <!--begin::Label-->
                                                    <span
                                                        class="label label-lg label-light-primary label-inline font-weight-bold py-4">مقروءة</span>
                                                    <!--end::Label-->
                                                @else
                                                    <!--begin::Label-->
                                                    <span
                                                        class="label label-lg label-light-warning label-inline font-weight-bold py-4">غير
                                                        مقروءة</span>
                                                    <!--end::Label-->
                                                @endif
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                @endforeach
                            @else
                                <div class="mb-6">
                                    <!--begin::Content-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Section-->
                                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                <span class="text-muted font-weight-bolder">لا يوجد اشعارات</span>
                                                <!--end::Data-->
                                            </div>
                                            <!--end::Info-->

                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                            @endif

                        </div>
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end: Card-->
                <!--end: List Widget 10-->
            </div>
        </div>
        <!--end::Row-->

        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">العروض المقدمة</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">اخر عروض المضافة</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 pb-0 mt-n3">
                <!--begin::Table-->
                @if ($userOffers->count() == 0)
                    <div class="alert alert-custom alert-light-warning fade show my-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">لا يوجد عروض مدخلة</div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-borderless table-vertical-center">
                        <thead>
                            <tr>
                                <th class="p-0 min-w-300px"></th>
                                <th class="p-0 min-w-160px"></th>
                                <th class="p-0 min-w-160px"></th>
                                <th class="p-0 min-w-160px"></th>
                                <th class="p-0 min-w-50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userOffers as $offer)
                                {{-- {{ dd($offer) }} --}}
                                <tr>
                                    <td class="pl-0">
                                        <a href="{{ route('admin.request.view', ['requestId' => $offer->request->id]) }}"
                                            class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                            المشروع : {{ $offer->request->title }}
                                        </a>
                                        <span class="text-muted font-weight-bolder d-block">
                                            تاريخ الاضافة : {{ $offer->request->created_at }}
                                        </span>
                                    </td>
                                    <td class=" pr-0">
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">حالة
                                            المشروع</span>
                                        <span class="text-muted font-weight-bolder">
                                            {{ $offer->request->service_stage->name ?? '' }}
                                        </span>
                                    </td>
                                    <td class="">
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">تاريخ
                                            التقديم</span>
                                        <span class="text-muted font-weight-bolder">
                                            {{ date('d-m-Y', strtotime($offer->created_at)) }}</span>
                                    </td>
                                    <td class="">
                                        @switch($offer->offer_status->id)
                                            @case(1)
                                                <span class="label label-lg label-light-warning label-inline">
                                                    {{ $offer->offer_status->name }}</span>
                                            @break
                                            @case(2)
                                                <span class="label label-lg label-light label-inline">
                                                    {{ $offer->offer_status->name }}</span>
                                            @break
                                            @case(3)
                                                <span class="label label-lg label-light-danger label-inline">
                                                    {{ $offer->offer_status->name }}</span>
                                            @break
                                            @case(4)
                                                <span class="label label-lg label-light-success label-inline">
                                                    {{ $offer->offer_status->name }}</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td class="pr-0 ">
                                        <a href="{{ route('admin.request.view', ['requestId' => $offer->request->id]) }}"
                                            class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                            fill="#000000" opacity="0.3" />
                                                        <path
                                                            d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                            fill="#000000" />
                                                        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2"
                                                            rx="1" />
                                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2"
                                                            rx="1" />
                                                        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2"
                                                            rx="1" />
                                                        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7"
                                                            height="2" rx="1" />
                                                        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2"
                                                            rx="1" />
                                                        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7"
                                                            height="2" rx="1" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 7-->
    </div>
    <!--end::Content-->
@endsection