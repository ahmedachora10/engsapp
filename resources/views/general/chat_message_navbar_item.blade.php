@foreach ($ChatMessages as $ChatMessage)
    <li>
        <a href="{{ route('request.view', ['service_request' => $ChatMessage->request_id]) . '#chatMessages' }}">
            <p class="sender">
                رد من : {{ $ChatMessage->sender->name }}
            </p>
            <p class="message">
                {{ $ChatMessage->message }}
            </p>
            <div class="text-right">
                <div class="mt-3 mt-md-0 d-inline-block project-details-created_at">
                    @if (app()->getLocale() == 'ar')
                        {!! arabic_date_format($ChatMessage->created_at) !!}
                    @else
                        <span title="{{ $ChatMessage->created_at }}"
                            class="number">{{ english_date_format($ChatMessage->created_at) . ' ago' }}</span>
                    @endif
                </div>
            </div>
        </a>
    </li>
@endforeach
