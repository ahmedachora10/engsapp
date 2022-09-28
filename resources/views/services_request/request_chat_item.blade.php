@foreach ($chatMsgs as $chatMsg)
    <div class="col-md-12 pt-2 px-3 pb-5 {{ $loop->even ? 'chat-msgs-odd' : '' }}">
        <div class="d-flex flex-row justify-content-between">
            <div class="offer-user-info d-flex flex-row">
                <img src="{{ $chatMsg->sender->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $chatMsg->sender->profile_img]) : asset('images/profile-img.jpg') }}"
                    alt="">
                <div class="d-flex flex-wrap align-items-center ml-3">
                    <div>
                        <div class="offer-user-info-name mt-2">
                            {{ $chatMsg->sender->name }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="align-self-center project-details-created_at">
                @if (app()->getLocale() == 'ar')
                    {!! arabic_date_format($chatMsg->created_at) !!}
                @else
                    <span title="{{ $chatMsg->created_at }}"
                        class="number">{{ english_date_format($chatMsg->created_at) . ' ago' }}</span>
                @endif
            </div>
        </div>
        <p class="chat-msgs-msg mt-3">
            {{ $chatMsg->message }}
        </p>
        @if ($chatMsg->attachments->count() > 0)
            <div class="project-attachments chat-msgs-msg mt-4">
                <p class="font-weight-500 mb-3 text-body" style="font-size: 18px;">ملفات مرفقه</p>
                <ul>
                    @foreach ($chatMsg->attachments as $attachment)
                        @include('services_request.viewRequest_attachments_item',['attachment'=>$attachment])
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
@endforeach
