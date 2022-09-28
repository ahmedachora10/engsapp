<x-layout>
    <x-slot name="linkselected">
        home
    </x-slot>
    <div class="main-slider">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 slider-right-side">
                            <div class="slider-imgs">
                                @foreach ($sliderContent->pluck('image') as $image)
                                    <div class="slide-img">
                                        <img class="img-fluid w-100"
                                            src="{{ route('imagecache', ['template' => 'slider', 'filename' => $image]) }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="slider-nav d-flex justify-content-center" data-aos="fade-up"
                                data-aos-delay="200">
                                <div class="slider-nav-container d-flex flex-row justify-content-between">
                                    <a href="#" class="slide-prev d-flex flex-column justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7.746" height="12.666"
                                            viewBox="0 0 7.746 12.666">
                                            <path id="Path_136" data-name="Path 136"
                                                d="M11286.095,398.137l5.625,5.626-5.625,5.626"
                                                transform="translate(-11285.388 -397.43)" fill="none" stroke="#fff"
                                                stroke-width="2" />
                                        </svg>
                                    </a>
                                    <ul class="d-flex flex-row justify-content-center">
                                        @for ($i = 0; $i < $sliderContent->count(); $i++)
                                            <li class="">
                                                <a href="#" class="{{ $i == 0 ? 'active' : '' }}"></a>
                                            </li>
                                        @endfor
                                    </ul>
                                    <a href="#" class="slide-next d-flex flex-column justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7.746" height="12.665"
                                            viewBox="0 0 7.746 12.665">
                                            <path id="Path_136" data-name="Path 136"
                                                d="M11291.72,398.137l-5.625,5.625,5.625,5.625"
                                                transform="translate(-11284.681 -397.43)" fill="none" stroke="#fff"
                                                stroke-width="2" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <div class="slider-content d-flex">
                                @foreach ($sliderContent as $slide)
                                    <div class="slide">
                                        <h1 class="mb-3">
                                            {{ app()->getLocale() == 'ar' ? $slide->title_ar : $slide->title_en }}
                                        </h1>
                                        <p class="mb-4 small-para">
                                            {{ app()->getLocale() == 'ar' ? $slide->small_desc_ar : $slide->small_desc_en }}
                                        </p>
                                        <ul class="recList">
                                            @foreach (explode(PHP_EOL, app()->getLocale() == 'ar' ? $slide->desc_ar : $slide->desc_en) as $item)
                                                <li><span>{{ $item }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ $slide->linkTo }}"
                                            class="btn btn-s-50 btn-primary ml-1">{{ app()->getLocale() == 'ar' ? $slide->button_text_ar : $slide->button_text_en }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="whyus">
        <div class="container">
            <div class="row topMargin">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <h1 data-aos="fade-down" data-aos-offset="-50" data-aos-delay="100">
                                {{ __('main.why') }}
                            </h1>
                            <p data-aos="fade-down">

                            </p>
                            <ul class="recList">
                                @php
                                    $delayCounter = 150;
                                @endphp
                                @foreach (viewContent($content, 'paragraph_name', 'why_us', 'array') as $item)
                                    <li data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                                        data-aos-delay="{{ $delayCounter = $delayCounter + 50 }}">
                                        <span> {{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('user.request.project') }}" data-aos="fade-down" data-aos-delay="150"
                                class="btn btn-s-50 btn-primary mt-5 mt-md-4">نفذ مشروعك الأن</a>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="d-flex flex-column imgs" data-aos="fade-down" data-aos-delay="150">
                                <img class="shapes" src="{{ asset('images/whyus-shapes.svg') }}" alt="">
                                <img class="m-auto w-100 whyus" src="{{ asset('images/whyusimg.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="servicesBlock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="_services" class="text-center" data-aos="fade-down"> {{ __('main.services_title') }}   </h1>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-lg-3 serviceCards">
                {{-- <div class="col-lg-12"> --}}
                <div class="service-block col col-12 col-lg-4 service1 d-flex justify-content-center"
                    data-aos="fade-down">
                    <a href="{{ route('services.project') }}" class="service-card">
                        <div class="text-center service-icon">
                            @include('svgImages.service-icon1')
                        </div>
                        <h5 class="text-center service-name">
                            {{ __('main.execute_service_title') }}
                        </h5>
                        <p class="text-center service-desc">
                            {{ viewContent($content, 'paragraph_name', 'main_services_project') }}
                        </p>
                    </a>
                </div>
                <div class="service-block col service2 d-flex justify-content-center" data-aos="fade-down"
                    data-aos-delay="150">
                    <a href="{{ route('services.consult') }}" class="service-card">
                        <div class="text-center service-icon">
                            @include('svgImages.service-icon2')
                        </div>
                        <h5 class="text-center service-name">
                             {{ __('main.consult_service_title') }}
                        </h5>
                        <p class="text-center service-desc">
                            {{ viewContent($content, 'paragraph_name', 'main_services_consult') }}
                        </p>
                    </a>
                </div>
                <div class="service-block col service3 d-flex justify-content-center" data-aos="fade-down"
                    data-aos-delay="200">
                    <a href="{{ route('services.judge') }}" class="service-card">
                        <div class="text-center service-icon">
                            @include('svgImages.service-icon3')
                        </div>
                        <h5 class="text-center service-name">
                              {{ __('main.judjment_service_title') }}
                        </h5>
                        <p class="text-center service-desc">
                            {{ viewContent($content, 'paragraph_name', 'main_services_judge') }}
                        </p>
                    </a>
                </div>
                <div class="service-block col service4 d-flex justify-content-center" data-aos="fade-down"
                    data-aos-delay="250">
                    <a href="{{ route('services.visit') }}" class="service-card">
                        <div class="text-center service-icon">
                            @include('svgImages.service-icon4')
                        </div>
                        <h5 class="text-center service-name">
                           {{ __('main.vist_service_title') }}
                        </h5>
                        <p class="text-center service-desc">
                            {{ viewContent($content, 'paragraph_name', 'main_services_visit') }}
                        </p>
                    </a>
                </div>
                <div class="service-block col service5 d-flex justify-content-center" data-aos="fade-down"
                    data-aos-delay="300">
                    <a href="{{ route('services.licence') }}" class="service-card">
                        <div class="text-center service-icon">
                            @include('svgImages.service-icon5')
                        </div>
                        <h5 class="text-center service-name">
                           {{ __('main.license_service_title') }}
                        </h5>
                        <p class="text-center service-desc">
                            {{ viewContent($content, 'paragraph_name', 'main_services_licence') }}
                        </p>
                    </a>
                </div>
                {{-- <div class="d-flex flex-column">

                </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <div class="howwework-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="_howwework" class="text-center" data-aos="fade-down">دعنا نخبرك كيف نعمل</h1>
                </div>
            </div>
        </div>
        <div class="howwework-bg howwework-steps">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="steps d-flex flex-column flex-lg-row">
                            <span class="line" data-aos="steps-line-toleft" data-aos-duration="2000"
                                data-aos-delay="500" data-aos-anchor="#last-step"></span>
                            <div class="step flex-fill mb-lg-3 mb-5"
                                data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}">
                                <div class="number d-flex m-auto justify-content-center align-items-center">01</div>
                                <div class="step-name">الاشتراك</div>
                                <p class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'step_1') }}</p>
                            </div>
                            <div class="step flex-fill mb-lg-3 mb-5"
                                data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                                data-aos-delay="200">
                                <div class="number d-flex m-auto justify-content-center align-items-center">02</div>
                                <div class="step-name">إضافة طلب</div>
                                <p class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'step_2') }}</p>
                            </div>
                            <div class="step flex-fill mb-lg-3 mb-5"
                                data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                                data-aos-delay="250">
                                <div class="number d-flex m-auto justify-content-center align-items-center">03</div>
                                <div class="step-name">تقديم العروض</div>
                                <p class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'step_3') }}</p>
                            </div>
                            <div class="step flex-fill mb-lg-3 mb-5"
                                data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                                data-aos-delay="300">
                                <div class="number d-flex m-auto justify-content-center align-items-center">04</div>
                                <div class="step-name">تنفيذ مشروع</div>
                                <p class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'step_4') }}</p>
                            </div>
                            <div id="last-step" class="step flex-fill mb-lg-3 mb-5"
                                data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                                data-aos-delay="350">
                                <div class="number d-flex m-auto justify-content-center align-items-center">05</div>
                                <div class="step-name">تسليم المشروع</div>
                                <p class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'step_5') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blogBlock">
        <div class="container">
            <div class="row custom-padding">
                <div class="col-md-7 order-2 order-md-1 col-md-7 d-flex flex-column justify-content-center pl-5"
                    data-aos="fade-down-menu">
                    <h1>كن علي اطلاع دائم بأحدث المقالات والاخبار</h1>
                    <p>من خلال المدونة الهندسية</p>
                </div>
                <div class="col-md-5 order-1 order-md-2 text-center">
                    <img src="{{ asset('images/Newsletter-amico.svg') }}" data-aos="fade-down-menu"
                        data-aos-delay="250" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="statistics">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="header-text text-center">
                        <h1 data-aos="fade-down-menu" data-aos-delay="200">الإحصائيات</h1>
                        <p data-aos="fade-down-menu">مجموعة من الاشتراكات المميزة والخدمات لاصحاب الشركات والمهندسين
                            والمستخدمين </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap stats-block" data-aos="fade">
                        <div class="stat stat-1 d-flex flex-column justify-content-center"
                            data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}">
                            <h3 class="text-center">احصائيات</h3>
                        </div>
                        <div class="stat d-flex flex-column justify-content-center text-center stat-2"
                            data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                            data-aos-delay="200">
                            <span class="number">
                                {{ viewContent($content, 'paragraph_name', 'count_consults') }}
                            </span>
                            <span class="text">
                                استشارة
                            </span>
                        </div>
                        <div class="stat d-flex flex-column justify-content-center text-center stat-3"
                            data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                            data-aos-delay="300">
                            <span class="number">
                                {{ viewContent($content, 'paragraph_name', 'count_freelancers') }}
                            </span>
                            <span class="text">
                                المستقلين
                            </span>
                        </div>
                        <div class="stat d-flex flex-column justify-content-center text-center stat-4"
                            data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                            data-aos-delay="400">
                            <span class="number">
                                {{ viewContent($content, 'paragraph_name', 'count_companies') }}
                            </span>
                            <span class="text">
                                شركة هندسية
                            </span>
                        </div>
                        <div class="stat d-flex flex-column justify-content-center text-center stat-5"
                            data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                            data-aos-delay="500">
                            <span class="number">
                                {{ viewContent($content, 'paragraph_name', 'count_projectsdone') }}
                            </span>
                            <span class="text">
                                مشروع
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @unless(!$subsEnabled)
        <div class="subsBlock">
            <div class="container p-0">
                <img src="{{ asset('images/subs-bg.svg') }}" alt="">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-text text-center">
                            <h1 id="_pricing" data-aos="fade-down-menu" data-aos-delay="100">  أنظمة الاشتراكات </h1>
                            <p data-aos="fade-down-menu" data-aos-delay="200">
                                {{ viewContent($content, 'paragraph_name', 'subsBlock_text') }}


                            </p>
                        </div>
                    </div>
                </div>
                <div class="row bottomPadding mx-n4">
                    <div class="col-lg-12 p-0">
                        <div class="subs-slider" data-aos="fade-down" data-aos-delay="100">
                            <div class="card card-1 mx-1 mx-lg-0" data-aos="fade-down" data-aos-delay="400"
                                data-aos-anchor="#card-1">
                                <div class="subs-header d-flex flex-column text-center justify-content-center text-white">
                                    <span class="subs-title "> المهندسون المستقلون</span>
                                    <span
                                        class="subs-price ">{{ viewContent($subsContent, 'paragraph_name', 'freelancer_subs_price') }}</span>
                                    <span
                                        class="subs-curr ">{{ viewContent($subsContent, 'paragraph_name', 'freelancer_subs_curr') }}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-between subs-content">
                                    <ul>
                                        @foreach (viewContent($subsContent, 'paragraph_name', 'freelancer_subs_terms', 'array') as $item)
                                            <li>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('auth.register') }}"
                                            class="btn btn-primary btn-s-50 subs-btn">اشترك الأن</a>
                                    </div>
                                </div>
                            </div>
                            <div id="card-1" class="card card-2 mx-1 mx-lg-0" data-aos="fade-down" data-aos-delay="100">
                                <div class="subs-header d-flex flex-column text-center justify-content-center text-white">
                                    <span class="subs-title "> المكاتب الهندسية</span>
                                    <span
                                        class="subs-price ">{{ viewContent($subsContent, 'paragraph_name', 'company_subs_price') }}</span>
                                    <span
                                        class="subs-curr ">{{ viewContent($subsContent, 'paragraph_name', 'company_subs_curr') }}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-between subs-content">
                                    <ul>
                                        @foreach (viewContent($subsContent, 'paragraph_name', 'company_subs_terms', 'array') as $item)
                                            <li>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('auth.register') }}"
                                            class="btn btn-primary btn-s-50 subs-btn">اشترك الأن</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-3 mx-1 mx-lg-0" data-aos="fade-down" data-aos-delay="400"
                                data-aos-anchor="#card-1">
                                <div class="subs-header d-flex flex-column text-center justify-content-center ">
                                    <span class="subs-title ">مستخدم عادي</span>
                                    <span
                                        class="subs-price ">{{ viewContent($subsContent, 'paragraph_name', 'user_subs_price') }}</span>
                                    <span class="subs-curr ">
                                        {{ viewContent($subsContent, 'paragraph_name', 'user_subs_curr') == '0' ? '' : viewContent($subsContent, 'paragraph_name', 'user_subs_curr') }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column justify-content-between subs-content">
                                    <ul>
                                        @foreach (viewContent($subsContent, 'paragraph_name', 'user_subs_terms', 'array') as $item)
                                            <li>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('auth.register') }}"
                                            class="btn btn-primary btn-s-50 subs-btn">اشترك الأن</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endunless
    <div class="contactus alert-custom">
        <x-alert />
        <div class="container">
            <div class="row" data-aos="fade-down">
                <div class="col-lg-12 contactus-header">
                    <h1 class="text-center text-white">اتصل بنا</h1>
                    <p class="text-center text-white">لا تترد في التواصل معنا ، فريقنا الفني في انتظاركم</p>
                </div>
            </div>
            <div class="row justify-content-center" data-aos="fade-down">
                <div class="col-lg-8">
                    <form id="contactus-form">
                        <div class="d-flex flex-row flex-wrap">
                            <div class="flex-fill mb-2 mb-md-0 mr-0 mr-md-2 textfield">
                                <div class="form-group mb-0">
                                    <input type="text" placeholder="الاسم" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="textfield flex-fill">
                                <div class="form-group mb-0">
                                    <input type="email" placeholder="البريد الالكتروني" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="textfield w-100 mt-2">
                                <div class="form-group mb-0">
                                    <textarea name="message" id="message" placeholder="نص الرسالة" cols="30" rows="10"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row flex-row justify-content-between mt-3">
                            <div class="address order-2 order-md-1">
                                <ul class="text-white">
                                    <li>
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10.724" height="15.252"
                                                viewBox="0 0 10.724 15.252">
                                                <g id="placeholder_2_" data-name="placeholder (2)"
                                                    transform="translate(-76)">
                                                    <g id="Group_14497" data-name="Group 14497"
                                                        transform="translate(76)">
                                                        <g id="Group_14496" data-name="Group 14496">
                                                            <path id="Path_912" data-name="Path 912"
                                                                d="M81.362,0A5.363,5.363,0,0,0,76.8,8.182l4.257,6.859a.447.447,0,0,0,.38.211h0a.447.447,0,0,0,.38-.217l4.148-6.926A5.363,5.363,0,0,0,81.362,0ZM85.2,7.651l-3.771,6.3L77.56,7.711a4.471,4.471,0,1,1,7.641-.06Z"
                                                                transform="translate(-76)" fill="#fff" />
                                                        </g>
                                                    </g>
                                                    <g id="Group_14499" data-name="Group 14499"
                                                        transform="translate(78.681 2.681)">
                                                        <g id="Group_14498" data-name="Group 14498">
                                                            <path id="Path_913" data-name="Path 913"
                                                                d="M168.681,90a2.681,2.681,0,1,0,2.681,2.681A2.684,2.684,0,0,0,168.681,90Zm0,4.474a1.793,1.793,0,1,1,1.79-1.793A1.795,1.795,0,0,1,168.681,94.474Z"
                                                                transform="translate(-166 -90)" fill="#fff" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                        <p>
                                            المملكة العربية السعودية ،  {{ $website_links->contactus_address }}
                                        </p>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10.258" height="10.423"
                                                viewBox="0 0 10.258 10.423">
                                                <path id="Path_10370" data-name="Path 10370"
                                                    d="M-5.027-2.666h-.032A1.828,1.828,0,0,1-6.881-1.155a1.726,1.726,0,0,1-1.4-.641,2.626,2.626,0,0,1-.53-1.727,3.783,3.783,0,0,1,.733-2.384,2.318,2.318,0,0,1,1.927-.949,1.456,1.456,0,0,1,.816.235,1.045,1.045,0,0,1,.46.59h.025q.013-.178.063-.73h.793q-.3,3.5-.3,3.561,0,1.314.755,1.314A1.323,1.323,0,0,0-2.4-2.628a3.645,3.645,0,0,0,.454-1.923,3.857,3.857,0,0,0-1.1-2.85,4.135,4.135,0,0,0-3.06-1.1,4.078,4.078,0,0,0-3.117,1.32,4.652,4.652,0,0,0-1.231,3.3A4.3,4.3,0,0,0-9.283-.74,4.217,4.217,0,0,0-6.125.457,6.275,6.275,0,0,0-3.447-.063V.724a6.994,6.994,0,0,1-2.742.47A5.071,5.071,0,0,1-9.912-.2a4.9,4.9,0,0,1-1.412-3.647A5.314,5.314,0,0,1-9.842-7.7a5.044,5.044,0,0,1,3.786-1.53A5.121,5.121,0,0,1-2.482-7.947,4.3,4.3,0,0,1-1.066-4.6a3.944,3.944,0,0,1-.746,2.479,2.228,2.228,0,0,1-1.819.968Q-5.021-1.155-5.027-2.666ZM-6.164-6.119a1.464,1.464,0,0,0-1.273.749,3.351,3.351,0,0,0-.486,1.86A1.913,1.913,0,0,0-7.595-2.33a1.04,1.04,0,0,0,.873.432,1.4,1.4,0,0,0,1.247-.784,4.085,4.085,0,0,0,.46-2.079Q-5.015-6.119-6.164-6.119Z"
                                                    transform="translate(11.324 9.229)" fill="#fff" />
                                            </svg>
                                        </span>
                                        <p class="email">
                                            {{ $website_links->contactus_email }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <button type="submit"
                                class="btn btn-s-50 btn-primary ml-1 btncontactus order-1 order-md-2 mb-4 mb-md-0 align-self-center ">
                                <span class="text">إرســــــال</span>
                                <div class="loading-animate">
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(function() {
                var form = $("#contactus-form");
                var validator = form.validate();
                $('.btncontactus').on('click', function(e) {

                    if (form.valid()) {
                        var btn = $(this);
                        btn.addClass('loading');
                        btn.attr("disabled", "disabled");
                        $.ajax({
                            type: "POST",
                            url: "{{ route('contactus_send') }}",
                            data: form.serialize(),
                            dataType: "json",
                            success: function(response) {
                                showAlertSuccess(response.message);
                                form.trigger("reset");
                                validator.resetForm();
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });
                        e.preventDefault();
                    }
                });


            });

        </script>
    @endsection

</x-layout>
