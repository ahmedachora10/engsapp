<div class="col-lg-3 p-0">
    <div class="bg-white border-radius-8 pt-4 pb-5 px-3">
        <div class="account-settings">
            <span class="pr-3">{{ __('main.accountSettings') }}</span>
        </div>
        <ul class="account-sidebar-list mt-4 mx-n3">
            <li>
                <a class="{{ $linkselected == 'account-settings' ? 'active' : '' }} px-3"
                    href="{{ route('operator.accountSettings') }}">
                    معلومات الحساب
                </a>
            </li>
            <li>
                <a class="{{ $linkselected == 'change-password' ? 'active' : '' }} px-3"
                    href="{{ route('operator.changePassword') }}">
                    تعديل كلمة المرور
                </a>
            </li>
            <li>
                <a class="{{ $linkselected == 'work-fields' ? 'active' : '' }} px-3"
                    href="{{ route('operator.workFields') }}">
                    مجالات العمل
                </a>
            </li>
            @if (auth()->user()->user_type == 'company')
                <li>
                    <a class="{{ $linkselected == 'judge-service' ? 'active' : '' }} px-3"
                        href="{{ route('operator.judgeService') }}">
                        تفعيل خدمة التحكيم
                    </a>
                </li>
            @endif
            @if (auth()->user()->user_type == 'freelancer')
                <li>
                    <a class="{{ $linkselected == 'judge-service' ? 'active' : '' }} px-3"
                        href="{{ route('operator.judgeService') }}">
                        تفعيل خدمة التحكيم
                    </a>
                </li>
                <li>
                    <a class="{{ $linkselected == 'test-quality' ? 'active' : '' }} px-3"
                        href="{{ route('operator.testQualityService') }}">
                        تفعيل خدمات فحص الجودة
                    </a>
                </li>
                <li>
                    <a class="{{ $linkselected == 'test-build' ? 'active' : '' }} px-3"
                        href="{{ route('operator.testBuildService') }}">
                        تفعيل خدمة فحص المباني الجاهزة
                    </a>
                </li>
            @endif
            <li>
                <a class="{{ $linkselected == 'bank-info' ? 'active' : '' }} px-3"
                    href="{{ route('operator.bankInfo') }}">
                    تأكيد الحساب البنكي
                </a>
            </li>
            <li>
                <a class="{{ $linkselected == 'contact-info' ? 'active' : '' }} px-3"
                    href="{{ route('operator.contactInfo') }}">
                    معلومات التواصل
                </a>
            </li>
        </ul>
    </div>
    <div class="bg-white border-radius-8 py-4 mt-2 px-3">
        <p class="account-bar-title">معلومات ملفك الحالي</p>
        <div class="progress-bar mb-4">
            @php
                $perc = auth()
                    ->user()
                    ->calculate_profile();
            @endphp
            <span id="accountProgress" class="bar perc-{{ $perc }}"></span>
            <span id="accountProgressText" class="text">{{ $perc }}%</span>
        </div>
        <div class="border-sidebar-custom"></div>
        <ul class="progress-bar-list mt-3">
            <x-operator.progresschecklist></x-operator.progresschecklist>
        </ul>
    </div>
</div>
