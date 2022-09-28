
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img height="100" src="{{asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
            <h4>{{ config('app.name') }}</h4>
        @endcomponent
    @endslot

    تم تفعيل حسابك,
    لتسجيل الدخول قم باستخدام البيانات التالية .
@component('mail::table')
| الاسم       | الايميل         | الجوال  |
| ------------- |:-------------:| --------:|
| {{$user->name}}      | {{$user->email}}      | {{$user->phone_number}}      |
@endcomponent
        @component('mail::button', ['url' => route('auth.login')])
          تسجيل الدخول<br/>
        @endcomponent

    او قم بنسخ الرابط التالي:
         {{ route('auth.login') }}


    مع تحيات,
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
