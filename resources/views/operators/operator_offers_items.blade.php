@if ($previousProjects->count() == 0)
    <li class="my-4 text-center">
        <h5>لا يوجد عروض لعرضها</h5>
    </li>
@endif
@foreach ($previousProjects as $offer)

    <li class="mb-4">
        <div class="align-items-center d-flex flex-row justify-content-between ">
            <div>
                <a href="{{ route('request.view', ['service_request' => $offer->request->id]) }}"
                    class="project-title d-block font-weight-bold">
                    {{ $offer->request->title }}
                </a>
                <div class="project-details-services mt-3">
                    <ul class="d-flex flex-row flex-wrap pr-5">
                        @foreach ($offer->request->requested_services as $requested_service)
                            <li class="small-footprint">
                                <span>{{ $requested_service->name }}</span>
                            </li>
                        @endforeach
                        <li class="small-footprint date w-100 mb-0">
                            <span class="date-format">
                                {{ date('d-m-Y - h:i A', strtotime($offer->request->created_at)) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="align-self-end">
                <div class="operator_offers_status {{ $offer->offer_status_id == 2 ? 'success' : 'warning' }}">
                    {{ $offer->offer_status->name }}
                </div>
            </div>
            {{-- <div
                                    class="align-self-baseline d-inline-block mt-3 mt-md-0 project-details-created_at">
                                    @if (app()->getLocale() == 'ar')
                                        {!! arabic_date_format($offer->request->created_at) !!}
                                    @else
                                        <span title="{{ $offer->request->created_at }}"
                                            class="number">{{ english_date_format($offer->request->created_at) . ' ago' }}</span>
                                    @endif
                                </div> --}}
        </div>
    </li>
@endforeach
