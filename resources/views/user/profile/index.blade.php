<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    profile
                </x-slot>
            </x-user.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0  serviceListIndex">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5 class="main-text">الملف الشخصي</h5>
                </div>
                <div class="bg-white flex-fill">
                    <div class="px-4 profile-list">
                        <ul>
                            <li>
                                <a href="{{ route('user.profile.personal') }}">المعلومات الشخصية</a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile.contact') }}">معلومات الاتصال</a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile.bank') }}">بيانات الحساب البنكي</a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile.password') }}">كلمة المرور</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
