<li class="align-items-center d-flex flex-row justify-content-between">
    <span>السيرة الذاتية</span>
    <img id="BioProgressStatus"
        src="{{ auth()->user()->operator_bio()
? asset('images/check-small.svg')
: asset('images/empty-check.svg') }}"
        alt="">
</li>
<li class="align-items-center d-flex flex-row justify-content-between">
    <span>معرض الاعمال</span>
    <img src="{{ auth()->user()->user_portfolio->count() > 0
? asset('images/check-small.svg')
: asset('images/empty-check.svg') }}"
        alt="">
</li>
<li class="align-items-center d-flex flex-row justify-content-between">
    <span>سعر ساعة العمل</span>
    <img src="{{ asset('images/check-small.svg') }}" alt="">
</li>
<li class="align-items-center d-flex flex-row justify-content-between">
    <span>تأكيد الحساب</span>
    <img id="UserActiveStatus"
        src="{{ auth()->user()->active_status()
? asset('images/check-small.svg')
: asset('images/empty-check.svg') }}"
        alt="">
</li>
<li class="align-items-center d-flex flex-row justify-content-between">
    <span>وسائل الدفع</span>
    <img id="bankInfoStatus" src="
    {{ auth()->user()->billing_status()
? asset('images/check-small.svg')
: asset('images/empty-check.svg') }}
        " alt="">
</li>