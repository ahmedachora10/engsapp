
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img height="100" src="{{asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
            <h4>{{ config('app.name') }}</h4>
        @endcomponent
    @endslot

    لقد تم تسجيل حساب جديد من نوع   {{$type}}.
@component('mail::table')
| الاسم       | الايميل         | الجوال  | الحساب  |
| ------------- |:-------------:| --------:| --------:|
| {{$user->name}}      | {{$user->email}}      | {{$user->phone_number}}      |{{$type}}      |
@endcomponent
        @component('mail::button', ['url' => route('admin.user.details',$user->id)])
          عرض بيانات الحساب<br/>
        @endcomponent

    او قم بنسخ الرابط التالي في المتصفح
         {{ route('admin.user.details',$user->id) }}


    مع تحيات
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
