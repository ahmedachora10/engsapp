@if ($notifications->count() == 0)
    <li class="no-messages show">
        <span>لا يوجد تنبيهات جديدة لعرضها</span>
    </li>
@endif
@foreach ($notifications as $notification)
    <li>
        <a href="{{ isset($notification->data['link']) ? $notification->data['link'] : '#' }}">
            <div class="d-flex flex-row">
                <div class="notifciation-icon pr-3 align-self-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24.277" height="26.073" viewBox="0 0 24.277 26.073">
                        <g id="notification-new" transform="translate(-3.373 -1.125)">
                            <path id="Path_5431" data-name="Path 5431"
                                d="M24.053,16.05V13.712h-1.8v2.7a.818.818,0,0,0,.269.629l2.428,2.428V20.9H5.173V19.466L7.6,17.038a.818.818,0,0,0,.269-.629v-4.5a7.193,7.193,0,0,1,7.193-7.193,7.093,7.093,0,0,1,3.6.979V3.642a8.73,8.73,0,0,0-2.7-.719v-1.8h-1.8v1.8a9.126,9.126,0,0,0-8.092,8.991V16.05L3.644,18.478a.818.818,0,0,0-.269.629v2.7a.845.845,0,0,0,.9.9h6.294a4.5,4.5,0,0,0,8.991,0h6.294a.845.845,0,0,0,.9-.9v-2.7a.818.818,0,0,0-.269-.629ZM15.063,25.4a2.7,2.7,0,0,1-2.7-2.7H17.76A2.7,2.7,0,0,1,15.063,25.4Z"
                                fill="#bbc8ce" />
                            <path id="Path_5432" data-name="Path 5432"
                                d="M31.943,8.1a3.6,3.6,0,1,1-3.6-3.6A3.6,3.6,0,0,1,31.943,8.1Z"
                                transform="translate(-4.293 -0.678)" fill="#bbc8ce" />
                        </g>
                    </svg>
                </div>
                <div class="flex-fill">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <p class="sender">
                            {{ $notification->data['title'] }}
                        </p>
                        <div
                            class="mt-3 mt-md-0 d-inline-block project-details-created_at notify-datetime flex-shrink-0">
                            @if (app()->getLocale() == 'ar')
                                {!! arabic_date_format($notification->created_at) !!}
                            @else
                                <span title="{{ $notification->created_at }}"
                                    class="number">{{ english_date_format($notification->created_at) . ' ago' }}</span>
                            @endif
                        </div>
                    </div>
                    <p class="message">
                        {{ $notification->data['message'] }}
                    </p>
                </div>
            </div>
        </a>
    </li>
@endforeach
