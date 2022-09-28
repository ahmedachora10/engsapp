<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    {{ $serviceName }}
                </x-slot>
            </x-user.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0  serviceListIndex">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5>طلبات {{ $serviceText }}</h5>
                    <a href="{{ $serviceRequestRoute }}" class="btn btn-primary">
                        {{ $btnText }}
                    </a>
                </div>
                <div class="bg-white flex-fill">
                    <div class="table-container">
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
                                @foreach ($requestsList as $requestedService)
                                    <tr>
                                        <td class="roboto">{{ sprintf('%02d', $loop->iteration) }}</td>
                                        <td class="font-weight-medium">{{ $requestedService->title }}</td>
                                        <td>
                                            @foreach ($requestedService->requested_services as $item)
                                              <span title="{{ $item->name }}">  {{ $loop->first ? '' : ', ' }}{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="roboto">
                                            {{ date('d-m-Y', strtotime($requestedService->created_at)) }}</td>
                                        <td class="roboto">
                                            {{ date('d-m-Y', strtotime($requestedService->deadline_date)) }}</td>
                                        <td class="roboto">
                                            {{ $requestedService->budget_max }}-{{ $requestedService->budget_min }}
                                        </td>
                                        <td class="roboto">
                                            {{ $requestedService->offers_count }}
                                        </td>
                                        @switch($requestedService->service_stage->id)
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
                                            <span>{{ $requestedService->service_stage->name }}</span>
                                        </td>
                                        <td class="font-weight-medium"><a
                                                href="{{ route('request.view', ['service_request' => $requestedService->id]) }}">تفاصيل</a>
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
