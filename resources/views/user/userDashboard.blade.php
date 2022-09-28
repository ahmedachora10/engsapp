<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    control-panel
                </x-slot>
            </x-user.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0">
                <div class="d-flex flex-row flex-wrap mt-3 mt-lg-0 user-statistics">
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-1 d-flex flex-column justify-content-center p-2 text-white yellow">
                            <div class="icon">
                                <img src="{{ asset('images/timer.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1">مشاريع مضافة في مرحلة استقبال العروض</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">{{ $totalRequests->Waiting }}</span>
                                    <br>
                                    <span class="stat-text">
                                        انتظار
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-2 d-flex flex-column justify-content-center p-2 white">
                            <div class="icon">
                                <img src="{{ asset('images/gear.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1">مشاريع مضافة في مرحلة استقبال العروض</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">{{ $totalRequests->Implementation }}</span>
                                    <br>
                                    <span class="stat-text">
                                        قيد الانجاز
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-3 d-flex flex-column justify-content-center p-2 text-white green">
                            <div class="icon">
                                <img src="{{ asset('images/check.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1"> مشاريع مكتلة تم تسلميها
                                    من قبل الجهة المنفذه</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">
                                        {{ $totalRequests->Completed }}
                                    </span>
                                    <br>
                                    <span class="stat-text">
                                        مكتمل
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-4 d-flex flex-column justify-content-center p-2 text-white yellow">
                            <div class="icon">
                                <img src="{{ asset('images/close-outline.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1">مشاريع تم الغائها
                                    من قبلك</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">
                                        {{ $totalRequests->Canceled }}
                                    </span>
                                    <br>
                                    <span class="stat-text">
                                        ملغية
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
                <h2 class="latest-projects-title">
                    احدث المشاريع
                </h2>
                <div class="latest-projects bg-white flex-fill">
                    <div class="table-container pb-3 pb-md-0">
                        <table class="table table8th" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>العنوان</th>
                                    <th>الخدمة</th>
                                    <th>التاريخ</th>
                                    <th>انتهاء العروض</th>
                                    <th>الميزانية ر.س</th>
                                    <th>العروض المقدمة</th>
                                    <th>الحالة</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestRequests as $request)
                                    <tr>
                                        <td class="roboto">{{ sprintf('%02d', $loop->iteration) }}</td>
                                        <td class="font-weight-medium">{{ $request->title }}</td>
                                        <td>
                                            {{ $request->service->name_ar }}
                                        </td>
                                        <td class="roboto">
                                            {{ date('d-m-Y', strtotime($request->created_at)) }}</td>
                                        <td class="roboto">
                                            {{ date('d-m-Y', strtotime($request->deadline_date)) }}</td>
                                        <td class="roboto">
                                            {{ $request->budget_max }}-{{ $request->budget_min }}
                                        </td>
                                        <td class="roboto">
                                            {{ $request->offers_count }}
                                        </td>
                                        @switch($request->service_stage->id)
                                            @case(1)
                                            <td class="text-left status waiting">
                                                @break
                                                @case(2)
                                            <td class="text-left status waiting">
                                                @break
                                                @case(3)
                                            <td class="text-left status working">
                                                @break
                                                @case(4)
                                            <td class="text-left status working">
                                                @break
                                                @case(5)
                                            <td class="text-left status completed">
                                                @break
                                                @case(6)
                                            <td class="text-left status canceled">
                                                @break
                                                @default
                                            <td class="text-left status ">
                                            @endswitch
                                            <span>{{ $request->service_stage->name }}</span>
                                        </td>
                                        <td class="font-weight-medium"><a
                                                href="{{ route('request.view', ['service_request' => $request->id]) }}">تفاصيل</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
