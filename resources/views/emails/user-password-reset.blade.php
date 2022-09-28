
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img height="100" src="{{asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
            <h4>{{ config('app.name') }}</h4>
        @endcomponent
    @endslot

    لقد تلقيت هذا البريد الإلكتروني بناءً على طلب نسيت كلمة المرور ، إذا كان هذا الطلب منك ، فيرجى استخدام الرابط التالي لإعادة تعيين كلمة المرور الخاصة بك .
        @component('mail::button', ['url' => route($url,['token'=>$code])])
          تغيير كلمة المرور<br/>
        @endcomponent

    او قم بنسخ الرابط التالي:
         {{ route($url,['token'=>$code]) }}

    يرجى ملاحظة أن الرابط ستنتهي صلاحيته خلال 12 ساعة من الآن.
    شكرا,
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
