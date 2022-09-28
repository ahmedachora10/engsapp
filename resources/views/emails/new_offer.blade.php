
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img height="100" src="{{asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
            <h4>{{ config('app.name') }}</h4>
        @endcomponent
    @endslot

     عرض جديد

    عرض جديد من قبل {{$name}}
    على طلبك بعنوان
     {{ $service_request->title }}

{{--    تصنيف الخدمة--}}
{{--    {{ $project->service->name_ar }}--}}




@component('mail::button', ['url' => route('request.view', ['service_request' => $service_request->id])])
  عرض بيانات الطلب<br/>
@endcomponent

    او قم بنسخ الرابط التالي في المتصفح
         {{ route('request.view', ['service_request' => $service_request->id]) }}


    مع تحيات
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
        @endcomponent
    @endslot
@endcomponent
