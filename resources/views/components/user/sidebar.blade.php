<div class="col-lg-3 p-0">
    <div class="bg-white px-3 user-profile-box">
        <div class="d-flex flex-row">
            <div class="profile-img">
                <img src="{{ auth()->user()->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => auth()->user()->profile_img]) : asset('images/profile-img.jpg') }}"
                    alt="">
            </div>
            <div class="name-rating pl-2">
                <p class="name">{{ auth()->user()->name }}</p>
                <div class="rating mt-1">
                    <ul class="d-flex flex-row">
                        @include('general.user_rates',['rate'=> auth()->user()->user_rates()])
                    </ul>
                </div>
            </div>
        </div>
        <p class="progress-bar-title">الملف الشخصي</p>
        <div class="progress-bar">
            @php
                $perc = auth()
                    ->user()
                    ->calculate_profile();
            @endphp
            <span id="accountProgress" class="bar perc-{{ $perc }}"></span>
            <span id="accountProgressText" class="text">{{ $perc }}%</span>
        </div>
    </div>
    <div class="bg-white p-3 user-sidebar-menu">
        <ul>
            <li>
                <a href="{{ route('user.userDashboard') }}"
                    class="{{ $linkselected == 'control-panel' ? 'active' : '' }} align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.dashboard',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        لوحة التحكم
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.services', ['serviceName' => 'project']) }}"
                    class="{{ $linkselected == 'project' ? 'active' : '' }} align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.project',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        تنفيذ مشروع / استشارة هندسية
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.services', ['serviceName' => 'consult']) }}"
                    class="{{ $linkselected == 'consult' ? 'active' : '' }} align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.consult',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        خدمات المكاتب الهندسية
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.request.judge') }}"
                    class=" {{ $linkselected == 'judge' ? 'active' : '' }} align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.judge',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        الدليل الهندسي
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.services', ['serviceName' => 'visit']) }}"
                    class="{{ $linkselected == 'visit' ? 'active' : '' }} align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.visit',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        طلب زيارة موقع
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.request.licence') }}"
                    class="{{ $linkselected == 'licence' ? 'active' : '' }} align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.licence',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        طلبات ترخيص
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.profile') }}"
                    class="{{ $linkselected == 'profile' ? 'active' : '' }} align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.profile',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        الملف الشخصي
                    </span>
                </a>
            </li>
            @php
            $us=\App\Models\User::where('email',auth()->user()->email)->where('phone_number',auth()->user()->phone_number)->where('confirmed',1)->where('id','<>',auth()->user()->id)->first();
            @endphp
            @if($us)
                <li>
                    <a href="{{ route('auth.changeUser',$us->id) }}" class="align-content-center d-flex flex-wrap">
                   <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.profile',['class' => 'm-auto'])
                    </span>
                        <span class="title">
                        تحويل لحساب {{$us->user_type=='company'?'المكتب الهندسي':'المستقل'}}
                    </span>
                    </a>
                </li>
            @endif

                <li>
                <a href="{{ route('auth.logout') }}" class="align-content-center d-flex flex-wrap">
                    <span class="icon dashboard d-flex flex-column justify-content-center">
                        @include('svgIcons.logout',['class' => 'm-auto'])
                    </span>
                    <span class="title">
                        {{__('main.logout')}}
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
