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
