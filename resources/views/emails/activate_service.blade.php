
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img height="100" src="{{asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
            <h4>{{ config('app.name') }}</h4>
        @endcomponent
    @endslot

    تم تفعيل الخدمة,
    تم قبول طلبك لتفعيل خدمة {{$service_name}} .

        @component('mail::button', ['url' => route('operator.profile')])
          ذهاب للموقع<br/>
        @endcomponent

    او قم بنسخ الرابط التالي:
         {{ route('operator.profile') }}


    مع تحيات,
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
