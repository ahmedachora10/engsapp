@if ($bookmarks->count() == 0)
    <div class="row mt-3 mb-3 mx-md-0 bookmarks-styling">
        <div class="col-md-12 bg-white py-4 px-4">
            <div class="text-center">
                <h5 class="font-weight-500">
                    {{ $bookmarks_empty_msg }}
                </h5>
            </div>
        </div>
    </div>
@endif
@foreach ($bookmarks as $bookmark)
    <div class="row mt-3 mb-3 mx-md-0 bookmarks-styling bookmark-card" data-bookmark-id="{{ $bookmark->id }}">
        <div class="col-md-12 bg-white py-4 px-4">
            <div class="row">
                <div class="col-md-10">
                    <a href="{{ route('request.view', ['service_request' => $bookmark->request_data->id]) }}"
                        class="requestTitle d-block">
                        {{ $bookmark->request_data->title }}
                    </a>
                    <div class="project-details-services mt-3">
                        <ul class="d-flex flex-row flex-wrap pr-5">
                            @foreach ($bookmark->request_data->requested_services as $item)
                                <li><span>{{ $item->name }}</span></li>
                            @endforeach
                            <li class="date w-100">
                                <span>{{ date('d-m-Y - h:i A', strtotime($bookmark->created_at)) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 align-self-center">
                    <a href="#" class="btn btn-primary btn-30 btn-danger-color2 btn-dropdown">
                        حذف
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
