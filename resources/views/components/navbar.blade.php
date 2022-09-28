<div class="{{ Route::currentRouteName() == 'home' ? 'menu-shadow menu-mainpage-shadow' : 'bg-white menu-shadow' }} ">
    <div class="container" style="z-index: 33; position: relative;">
        <div class="row">
            <div class="col-md-12">
                <div class="{{ Route::currentRouteName() == 'home' ? 'navbar-custom mainnav' : 'navbar-custom' }} ">
                    <div data-aos="fade-down-menu" id="menuToggle"
                        class="d-flex d-xl-none flex-column justify-content-center align-items-center">
                        {{-- <input type="checkbox"> --}}
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="logo ml-auto ml-xl-0 mr-xl-4">
                        <a href="{{ route('home') }}">
                            <img class="logo-colored" data-aos="fade-down-menu" src="{{ asset('images/logo.svg') }}"
                                alt="">
                            <img class="logo-white" data-aos="fade-down-menu"
                                src="{{ asset('images/logo-white.svg') }}" alt="">
                        </a>
                    </div>

                    <div
                        class="menu d-none d-xl-block {{ Route::currentRouteName() == 'home' ? 'ml-auto pr-5' : 'mr-auto' }}">
                        @auth
                            @php
                                $us=\App\Models\User::where('email',auth()->user()->email)->where('phone_number',auth()->user()->phone_number)->where('confirmed',1)->where('id','<>',auth()->user()->id)->first();
                            @endphp

                            @if (auth()->user()->user_type == 'user')
                                <ul>
                                    <li data-aos="fade-down-menu" data-aos-delay="150">
                                        <a class="{{ $activelink == 'home' ? 'active' : '' }}"
                                            href="{{ route('home') }}">{{ __('main.home') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="200">
                                        <a data-hash-id="_services"
                                            class="menu-hash-nav {{ $activelink == 'services' ? 'active' : '' }}"
                                            href="{{ route('home') . '#_services' }}">{{ __('main.services') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="250">
                                        <a class="{{ $activelink == 'blog' ? 'active' : '' }}"
                                            href="{{ route('blog.index') }}">{{ __('main.blog') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="300">
                                        <a data-hash-id="_howwework"
                                            class="menu-hash-nav {{ $activelink == 'howitwork' ? 'active' : '' }}"
                                            href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="350">
                                        <a data-hash-id="_pricing"
                                            class="menu-hash-nav {{ $activelink == 'pricing' ? 'active' : '' }}"
                                            href="{{ route('home') . '#_pricing' }}">{{ __('main.pricing') }}</a>
                                    </li>
{{--                                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                                        <a class="{{ $activelink == 'startproject' ? 'active' : '' }}"--}}
{{--                                            href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>--}}
{{--                                    </li>--}}
                                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                                        <a class="{{ $activelink == 'blog.blogjobs' ? 'active' : '' }}"
                                            href="{{ route('blog.blogjobs') }}">{{ __('main.jobs') }}</a>
                                    </li>
                                </ul>
                            @elseif (auth()->user()->user_type == 'company' || auth()->user()->user_type ==
                                'freelancer')

                                <ul class="ml-3">
                                    <li data-aos="fade-down-menu" data-aos-delay="150">
                                        <a class="{{ $activelink == 'operatorMyOffers' ? 'active' : '' }}"
                                            href="{{ route('operator.myoffers') }}">عروضي</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="200">
                                        <a data-hash-id="_services"
                                            class="menu-hash-nav {{ $activelink == 'operatorMyProjects' ? 'active' : '' }}"
                                            href="{{ route('operator.myprojects') }}">مشاريعي</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="250">
                                        <a class="{{ $activelink == 'operator-explore' ? 'active' : '' }}"
                                            href="{{ route('operator.explore') }}">تصفح المشاريع</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="300">
                                        <a class="menu-hash-nav {{ $activelink == 'operatorJobs' ? 'active' : '' }}"
                                            href="{{ auth()->user()->user_type == 'company' ? route('operator.jobs') : route('blog.blogjobs') }}">الوظائف</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="350">
                                        <a class="menu-hash-nav {{ $activelink == 'operatorProfile' ? 'active' : '' }}"
                                            href="{{ route('operator.profile') }}"> الملف الشخصي </a>
                                    </li>
                                </ul>
                            @else
                                <ul>
                                    <li data-aos="fade-down-menu" data-aos-delay="150">
                                        <a class="{{ $activelink == 'home' ? 'active' : '' }}"
                                            href="{{ route('home') }}">{{ __('main.home') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="200">
                                        <a data-hash-id="_services"
                                            class="menu-hash-nav {{ $activelink == 'services' ? 'active' : '' }}"
                                            href="{{ route('home') . '#_services' }}">{{ __('main.services') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="250">
                                        <a class="{{ $activelink == 'blog' ? 'active' : '' }}"
                                            href="{{ route('blog.index') }}">{{ __('main.blog') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="300">
                                        <a data-hash-id="_howwework"
                                            class="menu-hash-nav {{ $activelink == 'howitwork' ? 'active' : '' }}"
                                            href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                                    </li>
                                    <li data-aos="fade-down-menu" data-aos-delay="350">
                                        <a data-hash-id="_pricing"
                                            class="menu-hash-nav {{ $activelink == 'pricing' ? 'active' : '' }}"
                                            href="{{ route('home') . '#_pricing' }}">{{ __('main.pricing') }}</a>
                                    </li>
{{--                                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                                        <a class="{{ $activelink == 'startproject' ? 'active' : '' }}"--}}
{{--                                            href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>--}}
{{--                                    </li>--}}
                                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                                        <a class="{{ $activelink == 'blog.blogjobs' ? 'active' : '' }}"
                                           href="{{ route('blog.blogjobs') }}">{{ __('main.jobs') }}</a>
                                    </li>
                                </ul>
                            @endif
                        @endauth
                        @guest
                            <ul>
                                <li data-aos="fade-down-menu" data-aos-delay="150">
                                    <a class="{{ $activelink == 'home' ? 'active' : '' }}"
                                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                                </li>
                                <li data-aos="fade-down-menu" data-aos-delay="200">
                                    <a data-hash-id="_services"
                                        class="menu-hash-nav {{ $activelink == 'services' ? 'active' : '' }}"
                                        href="{{ route('home') . '#_services' }}">{{ __('main.services') }}</a>
                                </li>
                                <li data-aos="fade-down-menu" data-aos-delay="250">
                                    <a class="{{ $activelink == 'blog' ? 'active' : '' }}"
                                        href="{{ route('blog.index') }}">{{ __('main.blog') }}</a>
                                </li>
                                <li data-aos="fade-down-menu" data-aos-delay="300">
                                    <a data-hash-id="_howwework"
                                        class="menu-hash-nav {{ $activelink == 'howitwork' ? 'active' : '' }}"
                                        href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                                </li>
                                <li data-aos="fade-down-menu" data-aos-delay="350">
                                    <a data-hash-id="_pricing"
                                        class="menu-hash-nav {{ $activelink == 'pricing' ? 'active' : '' }}"
                                        href="{{ route('home') . '#_pricing' }}">{{ __('main.pricing') }}</a>
                                </li>
{{--                                <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                                    <a class="{{ $activelink == 'startproject' ? 'active' : '' }}"--}}
{{--                                        href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>--}}
{{--                                </li>--}}
                                <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                                    <a class="{{ $activelink == 'blog.blogjobs' ? 'active' : '' }}"
                                       href="{{ route('blog.blogjobs') }}">{{ __('main.jobs') }}</a>
                                </li>
                            </ul>
                        @endguest


                    </div>
                    <div class="toolbar d-none d-xl-flex flex-row user-menu">
                        @auth
                            @if (auth()->user()->user_type != 'admin')
                                <div class="chat-dropdown-list mr-3 align-self-center" data-aos="fade-down-menu"
                                    data-aos-delay="450">
                                    @php
                                        $newChatMessages = auth()
                                            ->user()
                                            ->chatMsgs()
                                            ->with('sender')
                                            ->where('isread', false)
                                            ->orderByDesc('created_at')
                                            ->limit(3)
                                            ->get();
                                    @endphp
                                    <a id="chat-dropdown-toggle" href="#"
                                        class="chat-dropdown-toggle button chat {{ $newChatMessages->count() > 0 ? 'new' : '' }}">
                                        <span>
                                            <span></span>
                                        </span>
                                    </a>
                                    <div class="chat-dropdown-list-container">
                                        <ul data-simplebar
                                            {{ app()->getLocale() == 'ar' ? 'data-simplebar-direction=rtl' : '' }}
                                            class="pt-3 ">
                                            <li class="loading">
                                                <img src="{{ asset('images/spinner.gif') }}" alt="">
                                            </li>
                                            @if ($newChatMessages->count() == 0)
                                                <li class="no-messages show">
                                                    <span>لا يوجد رسائل جديدة لعرضها</span>
                                                </li>
                                            @endif
                                            @foreach ($newChatMessages as $ChatMessage)
                                                @if($ChatMessage->sender)
                                                <li>
                                                    <a
                                                        href="{{ route('request.view', ['service_request' => $ChatMessage->request_id]) . '#chatMessages' }}">
                                                        <p class="sender">
                                                            رد من : {{ $ChatMessage->sender->name }}
                                                        </p>
                                                        <p class="message">
                                                            {{ $ChatMessage->message }}
                                                        </p>
                                                        <div class="text-right">
                                                            <div
                                                                class="mt-3 mt-md-0 d-inline-block project-details-created_at">
                                                                @if (app()->getLocale() == 'ar')
                                                                    {!! arabic_date_format($ChatMessage->created_at) !!}
                                                                @else
                                                                    <span title="{{ $ChatMessage->created_at }}"
                                                                        class="number">{{ english_date_format($ChatMessage->created_at) . ' ago' }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <a href="#" class="btn-viewAllChatMessages d-block py-3 text-center"
                                            data-action-url={{ route('get.user.messages') }}>
                                            عرض الكل
                                        </a>
                                    </div>
                                </div>
                                <div class="mr-3 notification-dropdown-list align-self-center" data-aos="fade-down-menu"
                                    data-aos-delay="500">
                                    <a id="notification-dropdown-toggle"
                                        data-action-url="{{ route('get.user.unreadNotifications') }}" href="#"
                                        class="notification-dropdown-toggle button notify {{ auth()->user()->unreadNotifications->count() > 0
    ? 'new'
    : '' }}">
                                        <span>
                                            <span></span>
                                        </span>
                                    </a>
                                    <div class="notification-dropdown-list-container">
                                        <ul data-simplebar
                                            {{ app()->getLocale() == 'ar' ? 'data-simplebar-direction=rtl' : '' }}
                                            class="pt-3 ">
                                            <li class="loading">
                                                <img src="{{ asset('images/spinner.gif') }}" alt="">
                                            </li>
                                            @if (auth()->user()->unreadNotifications->count() == 0)
                                                <li class="no-messages show">
                                                    <span>لا يوجد تنبيهات جديدة لعرضها</span>
                                                </li>
                                            @endif
                                            {{-- @foreach (auth()->user()->unreadNotifications as $notification)
                                                <li>
                                                    <a href="#">
                                                        <div class="d-flex flex-row">
                                                            <div class="notifciation-icon pr-3 align-self-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.277"
                                                                    height="26.073" viewBox="0 0 24.277 26.073">
                                                                    <g id="notification-new"
                                                                        transform="translate(-3.373 -1.125)">
                                                                        <path id="Path_5431" data-name="Path 5431"
                                                                            d="M24.053,16.05V13.712h-1.8v2.7a.818.818,0,0,0,.269.629l2.428,2.428V20.9H5.173V19.466L7.6,17.038a.818.818,0,0,0,.269-.629v-4.5a7.193,7.193,0,0,1,7.193-7.193,7.093,7.093,0,0,1,3.6.979V3.642a8.73,8.73,0,0,0-2.7-.719v-1.8h-1.8v1.8a9.126,9.126,0,0,0-8.092,8.991V16.05L3.644,18.478a.818.818,0,0,0-.269.629v2.7a.845.845,0,0,0,.9.9h6.294a4.5,4.5,0,0,0,8.991,0h6.294a.845.845,0,0,0,.9-.9v-2.7a.818.818,0,0,0-.269-.629ZM15.063,25.4a2.7,2.7,0,0,1-2.7-2.7H17.76A2.7,2.7,0,0,1,15.063,25.4Z"
                                                                            fill="#bbc8ce" />
                                                                        <path id="Path_5432" data-name="Path 5432"
                                                                            d="M31.943,8.1a3.6,3.6,0,1,1-3.6-3.6A3.6,3.6,0,0,1,31.943,8.1Z"
                                                                            transform="translate(-4.293 -0.678)"
                                                                            fill="#bbc8ce" />
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="flex-fill">
                                                                <div
                                                                    class="d-flex flex-row justify-content-between align-items-center">
                                                                    <p class="sender">
                                                                        {{ $notification->data['title'] }}
                                                                    </p>
                                                                    <div
                                                                        class="mt-3 mt-md-0 d-inline-block project-details-created_at notify-datetime flex-shrink-0">
                                                                        @if (app()->getLocale() == 'ar')
                                                                            {!! arabic_date_format($notification->created_at) !!}
                                                                        @else
                                                                            <span title="{{ $notification->created_at }}"
                                                                                class="number">{{ english_date_format($notification->created_at) . ' ago' }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <p class="message">
                                                                    {{ $notification->data['message'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach --}}
                                        </ul>
                                        <a href="#" class="btn-viewAllNotifications d-block py-3 text-center"
                                            data-action-url={{ route('get.user.notifications') }}>
                                            عرض الكل
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-dropdown-list align-self-center" data-aos="fade-down-menu"
                                    data-aos-delay="550">
                                    <a id="profile-dropdown-toggle" href="#" class="profile-dropdown-toggle profile-img-2">
                                        <img src="{{ auth()->user()->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => auth()->user()->profile_img]) : asset('images/logo.jpg') }}"
                                            alt="">
                                    </a>
                                    <ul>
                                        <li>
                                            <a
                                                href="{{ auth()->user()->user_type == 'user' ? route('user.userDashboard') : route('operator.profile') }}">
                                                لوحة التحكم</a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ auth()->user()->user_type == 'user' ? route('user.profile') : route('operator.accountSettings') }}">
                                                {{ auth()->user()->user_type == 'user' ? 'الملف الشخصي' : __('main.accountSettings') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('booksmarks.index') }}">المفضلة</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contactus') }}">اتصل بنا</a>
                                        </li>
                                        @if(isset($us)&&$us)
                                            <li data-aos="fade-down-menu" data-aos-delay="400">
                                                <a class="menu-hash-nav "  href="{{ route('auth.changeUser',$us->id) }}">
                                                    تحويل لحساب {{$us->user_type=='company'?'المكتب الهندسي':($us->user_type=='freelancer'?'المستقل':'المستخدم')}}

                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('auth.logout') }}"
                                                class="logout">{{ __('main.logout') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ route('auth.login') }}" data-aos="fade-down-menu" data-aos-delay="450"
                                class="btn btn-light btn-login btn-s-50">{{ __('main.signin') }}</a>
                            <a href="{{ route('auth.register') }}" data-aos="fade-down-menu" data-aos-delay="450"
                                class="btn btn-light btn-login mx-2 btn-s-50">انشاء حساب </a>
                        @endguest
                      <!--  @if (Route::currentRouteName() == 'home')
                            <a href="{{ changeLocaleInRoute(Route::current()) }}" data-aos="fade-down-menu"
                                data-aos-delay="{{ auth()->user() ? '600' : '450' }}"
                                class="lang-link ml-4 align-self-center">
                                {{ __('main.lang') }}</a>
                        @endif
                        !-->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="mobile-menu">
    <div class="container-fluid h-100">
        <div class="h-100 row text-white">
            <ul class="list">
                {{-- <li>
                    <a class="{{ $activelink == 'home' ? 'active' : '' }}"
                        href="{{ route('home') }}">{{ __('main.home') }}</a>
                </li>
                <li>
                    <a data-hash-id="_services" class="menu-hash-nav {{ $activelink == 'services' ? 'active' : '' }}"
                        href="{{ route('home') . '#_services' }}">{{ __('main.services') }}</a>
                </li>
                <li>
                    <a class="{{ $activelink == 'blog' ? 'active' : '' }}"
                        href="{{ route('blog.index') }}">{{ __('main.blog') }}</a>
                </li>
                <li>
                    <a data-hash-id="_howwework"
                        class="menu-hash-nav {{ $activelink == 'howitwork' ? 'active' : '' }}"
                        href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                </li>
                <li>
                    <a data-hash-id="_pricing" class="menu-hash-nav {{ $activelink == 'pricing' ? 'active' : '' }}"
                        href="{{ route('home') . '#_pricing' }}">{{ __('main.pricing') }}</a>
                </li>
                <li>
                    <a class="{{ $activelink == 'startproject' ? 'active' : '' }}"
                        href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>
                </li> --}}
                @auth
                    @if (auth()->user()->user_type != 'admin')
                        <li>
                            <div
                                class="toolbar d-flex justify-content-center flex-row user-menu user-menu-mobile pt-5 pb-4">
                                <div class="chat-dropdown-list mr-3 align-self-center" data-aos="fade-down-menu"
                                    data-aos-delay="450">
                                    {{-- @php
                                    $newChatMessages = auth()
                                        ->user()
                                        ->chatMsgs()
                                        ->with('sender')
                                        ->where('isread', false)
                                        ->orderByDesc('created_at')
                                        ->limit(3)
                                        ->get();
                                @endphp --}}
                                    <a id="chat-dropdown-toggle" href="#"
                                        class="chat-dropdown-toggle button chat {{ $newChatMessages->count() > 0 ? 'new' : '' }}">
                                        <span>
                                            <span></span>
                                        </span>
                                    </a>
                                    <div class="chat-dropdown-list-container">
                                        <ul data-simplebar
                                            {{ app()->getLocale() == 'ar' ? 'data-simplebar-direction=rtl' : '' }}
                                            class="pt-3 ">
                                            <li class="loading">
                                                <img src="{{ asset('images/spinner.gif') }}" alt="">
                                            </li>
                                            @if ($newChatMessages->count() == 0)
                                                <li class="no-messages show">
                                                    <span>لا يوجد رسائل جديدة لعرضها</span>
                                                </li>
                                            @endif
                                            @foreach ($newChatMessages as $ChatMessage)
                                                @if($ChatMessage->sender)
                                                <li>
                                                    <a
                                                        href="{{ route('request.view', ['service_request' => $ChatMessage->request_id]) . '#chatMessages' }}">
                                                        <p class="sender">
                                                            رد من : {{ $ChatMessage->sender->name }}
                                                        </p>
                                                        <p class="message">
                                                            {{ $ChatMessage->message }}
                                                        </p>
                                                        <div class="text-right">
                                                            <div
                                                                class="mt-3 mt-md-0 d-inline-block project-details-created_at">
                                                                @if (app()->getLocale() == 'ar')
                                                                    {!! arabic_date_format($ChatMessage->created_at) !!}
                                                                @else
                                                                    <span title="{{ $ChatMessage->created_at }}"
                                                                        class="number">{{ english_date_format($ChatMessage->created_at) . ' ago' }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <a href="#" class="btn-viewAllChatMessages d-block py-3 text-center"
                                            data-action-url={{ route('get.user.messages') }}>
                                            عرض الكل
                                        </a>
                                    </div>
                                </div>
                                <div class="mr-3 notification-dropdown-list align-self-center" data-aos="fade-down-menu"
                                    data-aos-delay="500">
                                    <a id="notification-dropdown-toggle"
                                        data-action-url="{{ route('get.user.unreadNotifications') }}" href="#"
                                        class="notification-dropdown-toggle button notify {{ auth()->user()->unreadNotifications->count() > 0
    ? 'new'
    : '' }}">
                                        <span>
                                            <span></span>
                                        </span>
                                    </a>
                                    <div class="notification-dropdown-list-container">
                                        <ul data-simplebar
                                            {{ app()->getLocale() == 'ar' ? 'data-simplebar-direction=rtl' : '' }}
                                            class="pt-3 ">
                                            <li class="loading">
                                                <img src="{{ asset('images/spinner.gif') }}" alt="">
                                            </li>
                                            @if (auth()->user()->unreadNotifications->count() == 0)
                                                <li class="no-messages show">
                                                    <span>لا يوجد تنبيهات جديدة لعرضها</span>
                                                </li>
                                            @endif
                                        </ul>
                                        <a href="#" class="btn-viewAllNotifications d-block py-3 text-center"
                                            data-action-url={{ route('get.user.notifications') }}>
                                            عرض الكل
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-dropdown-list align-self-center" data-aos="fade-down-menu"
                                    data-aos-delay="550">
                                    <a id="profile-dropdown-toggle" href="#" class="profile-dropdown-toggle profile-img-2">
                                        <img src="{{ auth()->user()->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => auth()->user()->profile_img]) : asset('images/logo.jpg') }}"
                                            alt="">
                                    </a>
                                    <ul>
                                        <li>
                                            <a
                                                href="{{ auth()->user()->user_type == 'user' ? route('user.userDashboard') : route('operator.profile') }}">
                                                لوحة التحكم</a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ auth()->user()->user_type == 'user' ? route('user.profile') : route('operator.accountSettings') }}">
                                                {{ auth()->user()->user_type == 'user' ? 'الملف الشخصي' : __('main.accountSettings') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('booksmarks.index') }}">المفضلة</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contactus') }}">اتصل بنا</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif
                    @if (auth()->user()->user_type == 'user')
                        <li data-aos="fade-down-menu" data-aos-delay="150">
                            <a class="{{ $activelink == 'home' ? 'active' : '' }}"
                                href="{{ route('home') }}">{{ __('main.home') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="200">
                            <a data-hash-id="_services"
                                class="menu-hash-nav {{ $activelink == 'services' ? 'active' : '' }}"
                                href="{{ route('home') . '#_services' }}">{{ __('main.services') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="250">
                            <a class="{{ $activelink == 'blog' ? 'active' : '' }}"
                                href="{{ route('blog.index') }}">{{ __('main.blog') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="300">
                            <a data-hash-id="_howwework"
                                class="menu-hash-nav {{ $activelink == 'howitwork' ? 'active' : '' }}"
                                href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="350">
                            <a data-hash-id="_pricing"
                                class="menu-hash-nav {{ $activelink == 'pricing' ? 'active' : '' }}"
                                href="{{ route('home') . '#_pricing' }}">{{ __('main.pricing') }}</a>
                        </li>
{{--                        <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                            <a class="{{ $activelink == 'startproject' ? 'active' : '' }}"--}}
{{--                                href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>--}}
{{--                        </li>--}}
                            <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                                <a class="{{ $activelink == 'blog.blogjobs' ? 'active' : '' }}"
                                   href="{{ route('blog.blogjobs') }}">{{ __('main.jobs') }}</a>
                            </li>
{{--                        <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                            <a href="{{ changeLocaleInRoute(Route::current()) }}" class="lang-link">--}}
{{--                                {{ __('main.lang') }}</a>--}}
{{--                        </li>--}}

                        <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                            <a href="{{ route('auth.logout') }}">{{ __('main.logout') }}</a>
                        </li>
                    @elseif (auth()->user()->user_type == 'company' || auth()->user()->user_type ==
                        'freelancer')
                        <li data-aos="fade-down-menu" data-aos-delay="150">
                            <a class="{{ $activelink == 'operatorMyOffers' ? 'active' : '' }}"
                                href="{{ route('operator.myoffers') }}">عروضي</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="200">
                            <a data-hash-id="_services"
                                class="menu-hash-nav {{ $activelink == 'operatorMyProjects' ? 'active' : '' }}"
                                href="{{ route('operator.myprojects') }}">مشاريعي</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="250">
                            <a class="{{ $activelink == 'operator-explore' ? 'active' : '' }}"
                                href="{{ route('operator.explore') }}">تصفح المشاريع</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="300">
                            <a class="menu-hash-nav {{ $activelink == 'operatorJobs' ? 'active' : '' }}"
                                href="{{ auth()->user()->user_type == 'company' ? route('operator.jobs') : route('blog.blogjobs') }}">الوظائف</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="350">
                            <a class="menu-hash-nav {{ $activelink == 'operatorProfile' ? 'active' : '' }}"
                                href="{{ route('operator.profile') }}">البروفايل</a>
                        </li>
{{--                        <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                            <a href="{{ changeLocaleInRoute(Route::current()) }}" class="lang-link">--}}
{{--                                {{ __('main.lang') }}</a>--}}
{{--                        </li>--}}
                            @if($us)
                                <li data-aos="fade-down-menu" data-aos-delay="400">
                                    <a class="menu-hash-nav "  href="{{ route('auth.changeUser',$us->id) }}">
                                        تحويل لحساب {{$us->user_type=='company'?'المكتب الهندسي':($us->user_type=='freelancer'?'المستقل':'المستخدم')}}

                                    </a>
                                </li>
                            @endif

                        <li data-aos="fade-down-menu" data-aos-delay="400">
                            <a class="menu-hash-nav " href="{{ route('auth.logout') }}">{{ __('main.logout') }}</a>
                        </li>
                    @else
                        <li data-aos="fade-down-menu" data-aos-delay="150">
                            <a class="{{ $activelink == 'home' ? 'active' : '' }}"
                                href="{{ route('home') }}">{{ __('main.home') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="200">
                            <a data-hash-id="_services"
                                class="menu-hash-nav {{ $activelink == 'services' ? 'active' : '' }}"
                                href="{{ route('home') . '#_services' }}">{{ __('main.services') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="250">
                            <a class="{{ $activelink == 'blog' ? 'active' : '' }}"
                                href="{{ route('blog.index') }}">{{ __('main.blog') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="300">
                            <a data-hash-id="_howwework"
                                class="menu-hash-nav {{ $activelink == 'howitwork' ? 'active' : '' }}"
                                href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                        </li>
                        <li data-aos="fade-down-menu" data-aos-delay="350">
                            <a data-hash-id="_pricing"
                                class="menu-hash-nav {{ $activelink == 'pricing' ? 'active' : '' }}"
                                href="{{ route('home') . '#_pricing' }}">{{ __('main.pricing') }}</a>
                        </li>
{{--                        <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                            <a class="{{ $activelink == 'startproject' ? 'active' : '' }}"--}}
{{--                                href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>--}}
{{--                        </li>--}}
                            <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                                <a class="{{ $activelink == 'blog.blogjobs' ? 'active' : '' }}"
                                   href="{{ route('blog.blogjobs') }}">{{ __('main.jobs') }}</a>
                            </li>
{{--                        <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                            <a href="{{ changeLocaleInRoute(Route::current()) }}" class="lang-link">--}}
{{--                                {{ __('main.lang') }}</a>--}}
{{--                        </li>--}}
                    @endif
                @endauth
                @guest
                    <li data-aos="fade-down-menu" data-aos-delay="150">
                        <a class="{{ $activelink == 'home' ? 'active' : '' }}"
                            href="{{ route('home') }}">{{ __('main.home') }}</a>
                    </li>
                    <li data-aos="fade-down-menu" data-aos-delay="200">
                        <a data-hash-id="_services"
                            class="menu-hash-nav {{ $activelink == 'services' ? 'active' : '' }}"
                            href="{{ route('home') . '#_services' }}">{{ __('main.services') }}</a>
                    </li>
                    <li data-aos="fade-down-menu" data-aos-delay="250">
                        <a class="{{ $activelink == 'blog' ? 'active' : '' }}"
                            href="{{ route('blog.index') }}">{{ __('main.blog') }}</a>
                    </li>
                    <li data-aos="fade-down-menu" data-aos-delay="300">
                        <a data-hash-id="_howwework"
                            class="menu-hash-nav {{ $activelink == 'howitwork' ? 'active' : '' }}"
                            href="{{ route('home') . '#_howwework' }}">{{ __('main.howitwork') }}</a>
                    </li>
                    <li data-aos="fade-down-menu" data-aos-delay="350">
                        <a data-hash-id="_pricing" class="menu-hash-nav {{ $activelink == 'pricing' ? 'active' : '' }}"
                            href="{{ route('home') . '#_pricing' }}">{{ __('main.pricing') }}</a>
                    </li>
{{--                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                        <a class="{{ $activelink == 'startproject' ? 'active' : '' }}"--}}
{{--                            href="{{ route('services.project') }}">{{ __('main.startproject') }}</a>--}}
{{--                    </li>--}}
                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                        <a class="{{ $activelink == 'blog.blogjobs' ? 'active' : '' }}"
                           href="{{ route('blog.blogjobs') }}">{{ __('main.jobs') }}</a>
                    </li>
{{--                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">--}}
{{--                        <a href="{{ changeLocaleInRoute(Route::current()) }}" class="lang-link">--}}
{{--                            {{ __('main.lang') }}</a>--}}
{{--                    </li>--}}
                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                        <a href="{{ route('auth.login') }}">{{ __('main.signin') }}</a>
                    </li>
                    <li id="last-menu-fade" data-aos="fade-down-menu" data-aos-delay="400">
                        <a href="{{ route('auth.register') }}">انشاء حساب </a>

                    </li>

                @endguest
            </ul>
            <div class="d-flex justify-content-center iconlist">
                <x-socialicons />
            </div>
        </div>
    </div>
</div>
