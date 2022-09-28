@if ($service_requests->count() == 0)
    <div class="bg-white border-radius-8 pt-4 pb-4 px-3">
        <h5 class="text-center">
            لا يوجد نتائج لعرضها
        </h5>
    </div>
@endif
@foreach ($service_requests as $service_request)
    <div class="bg-white border-radius-8 pt-4 pb-4 px-3 {{ $loop->first ? '' : 'mt-3' }}">
        <div class="project-details small">
            <div class="d-flex flex-row justify-content-between flex-wrap flex-md-nowrap">
                <a href="{{ route('request.view', ['service_request' => $service_request->id]) }}"
                    class="project-details-title pr-3">{{ $service_request->title }}</a>
                <div class="flex-shrink-0 h-100 project-details-created_at mt-2 mt-md-0">
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
            <div class="project-details-desc ">
                <p class="project-details-desc-title mb-2">
                    تفاصيل المشروع
                </p>
                <p class="project-details-desc-text pb-3">
                    {!! str_replace(PHP_EOL,'<br>',$service_request->description) !!}
                </p>
            </div>
            <div class="border-sidebar-custom"></div>
            <div class="d-flex flex-row mt-3">
                <span class="project-details-client-rating mr-3">
                    تقييم العميل
                </span>
                <div class="rating">
                    <ul class="d-flex flex-row">
                        @include('general.user_rates',['rate'=>
                        intval(round($service_request->service_request_owner->rates_avg_rating_value))])
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach
