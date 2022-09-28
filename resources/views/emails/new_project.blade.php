
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img height="100" src="{{asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
            <h4>{{ config('app.name') }}</h4>
        @endcomponent
    @endslot

    تم اضافة {{$type}} ضمن اختصاصاتك   .

    العنوان
     {{ $project->title }}

{{--    تصنيف الخدمة--}}
{{--    {{ $project->service->name_ar }}--}}

    الخدمات المطلوبة
@foreach ($project->requested_services as $service)
{{ $service->name }}@if(!$loop->last) ، @endif
@endforeach

    @if ($project->description)
        الوصف
         {{ $project->description }}
    @endif


@component('mail::button', ['url' => route('request.view',$project->id)])
  عرض بيانات المشروع<br/>
@endcomponent

    او قم بنسخ الرابط التالي في المتصفح
         {{ route('request.view',$project->id) }}


    مع تحيات
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
        @endcomponent
    @endslot
@endcomponent
