<x-layout>
    <x-slot name="linkselected">
        startproject
    </x-slot>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('services.project') }}">
                {{ __('main.startproject') }}
            </a>
        </li>
    </x-breadcrumb>
    <div class="project-page">
        <div class="project-page-head">
            <div class="container bg-white">
                <img src="{{ asset('images/project-head.svg') }}" alt="">
                <div class="row ">
                    <div class="col-12">
                        <div class="project-welcome">
                            <h5 data-aos="fade-down" data-aos-delay="250">
                                {{ __('main.welcomingmsg') }}
                            </h5>
                            <h1 data-aos="fade-down">{{ viewContent($content, 'paragraph_name', 'heading_title') }}
                            </h1>
                        </div>
                        <div class="project-welcome-msg row justify-content-center">
                            <div class="col-lg-11">
                                <div class="row">
                                    <div class="col-xl-7 col-12 order-2 order-xl-1">
                                        <div class="text-content">
                                            <div class="hint-icon" data-aos-delay="300" data-aos="fade-down">
                                                <svg id="lamp" xmlns="http://www.w3.org/2000/svg" width="27.168"
                                                    height="27.168" viewBox="0 0 27.168 27.168">
                                                    <g id="Group_14623" data-name="Group 14623"
                                                        transform="translate(5.66 5.66)">
                                                        <path id="Path_5648" data-name="Path 5648"
                                                            d="M14.622,26.508h-3.4a1.838,1.838,0,0,1-1.7-2.038V22.093A3.931,3.931,0,0,0,8.056,19.15,7.825,7.825,0,0,1,5,12.811,8.056,8.056,0,0,1,12.811,5a7.956,7.956,0,0,1,5.66,2.264,8.059,8.059,0,0,1,2.377,5.66A7.613,7.613,0,0,1,17.9,19.037a4.133,4.133,0,0,0-1.585,3.17v2.6a1.741,1.741,0,0,1-1.7,1.7Zm-1.7-20.376a6.943,6.943,0,0,0-6.792,6.679,6.654,6.654,0,0,0,2.6,5.434,4.933,4.933,0,0,1,1.924,3.849V24.47c0,.226,0,.906.566.906h3.4a.535.535,0,0,0,.566-.566v-2.6a5.5,5.5,0,0,1,2.038-4.075,6.6,6.6,0,0,0,2.49-5.207,6.767,6.767,0,0,0-2.038-4.868,6.673,6.673,0,0,0-4.754-1.924Z"
                                                            transform="translate(-5 -5)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14624" data-name="Group 14624"
                                                        transform="translate(10.188 22.64)">
                                                        <path id="Path_5649" data-name="Path 5649"
                                                            d="M15.226,21.132H9.566a.566.566,0,0,1,0-1.132h5.66a.566.566,0,0,1,0,1.132Z"
                                                            transform="translate(-9 -20)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14625" data-name="Group 14625"
                                                        transform="translate(13.018)">
                                                        <path id="Path_5650" data-name="Path 5650"
                                                            d="M12.066,3.4A.535.535,0,0,1,11.5,2.83V.566a.566.566,0,0,1,1.132,0V2.83A.535.535,0,0,1,12.066,3.4Z"
                                                            transform="translate(-11.5)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14626" data-name="Group 14626"
                                                        transform="translate(20.546 3.905)">
                                                        <path id="Path_5651" data-name="Path 5651"
                                                            d="M18.773,6.11A.681.681,0,0,1,18.32,6a.547.547,0,0,1,0-.792L19.9,3.62a.56.56,0,0,1,.792.792L19.112,6a1.14,1.14,0,0,1-.34.113Z"
                                                            transform="translate(-18.15 -3.45)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14627" data-name="Group 14627"
                                                        transform="translate(23.772 13.018)">
                                                        <path id="Path_5652" data-name="Path 5652"
                                                            d="M23.83,12.632H21.566a.566.566,0,0,1,0-1.132H23.83a.566.566,0,1,1,0,1.132Z"
                                                            transform="translate(-21 -11.5)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14628" data-name="Group 14628"
                                                        transform="translate(20.546 20.659)">
                                                        <path id="Path_5653" data-name="Path 5653"
                                                            d="M20.357,20.91A.681.681,0,0,1,19.9,20.8L18.32,19.212a.56.56,0,0,1,.792-.792L20.7,20a.547.547,0,0,1,0,.792c0,.113-.113.113-.34.113Z"
                                                            transform="translate(-18.15 -18.25)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14629" data-name="Group 14629"
                                                        transform="translate(3.792 20.659)">
                                                        <path id="Path_5654" data-name="Path 5654"
                                                            d="M3.973,20.91A.681.681,0,0,1,3.52,20.8a.547.547,0,0,1,0-.792L5.1,18.42a.56.56,0,1,1,.792.792L4.312,20.8a.416.416,0,0,1-.34.113Z"
                                                            transform="translate(-3.35 -18.25)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14630" data-name="Group 14630"
                                                        transform="translate(0 13.018)">
                                                        <path id="Path_5655" data-name="Path 5655"
                                                            d="M2.83,12.632H.566a.566.566,0,0,1,0-1.132H2.83a.566.566,0,1,1,0,1.132Z"
                                                            transform="translate(0 -11.5)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14631" data-name="Group 14631"
                                                        transform="translate(3.792 3.792)">
                                                        <path id="Path_5656" data-name="Path 5656"
                                                            d="M5.557,6.123A.681.681,0,0,1,5.1,6.01L3.52,4.312a.56.56,0,0,1,.792-.792L5.9,5.1a.547.547,0,0,1,0,.792c-.113.113-.226.226-.34.226Z"
                                                            transform="translate(-3.35 -3.35)" fill="#fff" />
                                                    </g>
                                                    <g id="Group_14632" data-name="Group 14632"
                                                        transform="translate(13.018 8.49)">
                                                        <path id="Path_5657" data-name="Path 5657"
                                                            d="M16.594,13.16a.535.535,0,0,1-.566-.566,4.011,4.011,0,0,0-3.962-3.962.566.566,0,1,1,0-1.132,5.073,5.073,0,0,1,5.094,5.094A.535.535,0,0,1,16.594,13.16Z"
                                                            transform="translate(-11.5 -7.5)" fill="#fff" />
                                                    </g>
                                                </svg>
                                            </div>
                                            <h1 class="text-white " data-aos-delay="250" data-aos="fade-down">
                                                {{ viewContent($content, 'paragraph_name', 'heading_title2') }}</h1>
                                            <p data-aos="fade-down" data-aos-delay="200">
                                                {{ viewContent($content, 'paragraph_name', 'welcome_para') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-12 order-1 order-xl-2 d-flex justify-content-center">
                                        <div class="project-welcome-image" data-aos="fade-down">
                                            @include('svgImages.project-page-head-image')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container bg-white">
            <div class="row ">
                <div class="col-md-12">
                    <div class="project-types">
                        <h5 class="text-center" data-aos="fade-down" data-aos-delay="250">
                            أنواع المشاريع
                        </h5>
                        <h1 class="text-center" data-aos="fade-down">
                            أطلع على أنواع المشاريع التي يمكنك تنفيذها
                        </h1>
                        <div class="container px-0">
                            <div class="row project-types-list justify-content-center">
                                {{-- {{ dd(viewContentArray($content, 'section_name', 'section_types')) }} --}}
                                @php
                                    $delayCounter = 200;
                                @endphp
                                @foreach (viewContentArray($content, 'section_name', 'section_types') as $item)
                                    @if($item->is_active)
                                    <div class="col-lg-2 col-6" data-aos="fade-down"
                                        data-aos-delay="{{ $delayCounter = $delayCounter + 50 }}">
                                        <div class="project-type-box ">
                                            <div class="icon">
                                                @include($item->icon_name)
                                            </div>
                                            <span class="text">
                                                {{ app()->getLocale() == 'ar' ? $item->content_ar : $item->content_en }}
                                            </span>
                                        </div>
                                    </div>
                                    @if ($loop->iteration == 5)
                                        <div class="w-100 d-lg-block d-none"></div>
                                        @php
                                            $delayCounter = 200;
                                        @endphp
                                    @endif
                                    @endif
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="project-stakeholders">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="project-stakeholder-header">
                            <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="200">
                                الجهة المنفذة
                            </h5>
                            <h1 class="" data-aos="fade-down" data-aos="fade-down" data-aos-delay="100">
                                يمكنك اختيار الجهة المنفذة لمشروعك
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row stakeholders justify-content-center">
                    <div class="col-lg-11">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12" data-aos="fade-down">
                                <img class="img-fluid" src="{{ asset('images/freelancers.jpg') }}" alt="">
                                <h5 class="text-center">
                                    {{ viewContent($content, 'paragraph_name', 'user_type_freelancer') }}
                                </h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12" data-aos="fade-down">
                                <img class="img-fluid" src="{{ asset('images/companies.jpg') }}" alt="">
                                <h5 class="text-center">
                                    {{ viewContent($content, 'paragraph_name', 'user_type_companies') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-features">
            <div class="container bg-white">
                <div class="row no-gutters justify-content-center">
                    <div class="col-lg-11">
                        <div class="features-box">
                            <div class="row no-gutters flex-column flex-lg-row">
                                <div class="featuers-text order-2 order-lg-1">
                                    <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="200">
                                        ممزيات الخدمة
                                    </h5>
                                    <h1 data-aos="fade-down" data-aos-delay="100">
                                        بعض مميزات تنفيذ المشروع لدينا
                                    </h1>

                                    <ul>
                                        @php
                                            $delayCounter = 0;
                                        @endphp
                                        @foreach (viewContent($content, 'paragraph_name', 'features', 'array') as $item)
                                            <li data-aos="fade-down"
                                                data-aos-delay="{{ $delayCounter = $delayCounter + 50 }}">
                                                {{ $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="features-img order-1 order-lg-2">
                                    <img data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}"
                                        data-aos-delay="400"
                                        src="{{ asset(app()->getLocale() == 'ar' ? 'images/feature-img.png' : 'images/feature-img_en.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="howwework">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="howwework-header">
                            <h5 class="text-center text-md-left text-yellow-color" data-aos="fade-down"
                                data-aos-delay="200">
                                كيف نعمل
                            </h5>
                            <h1 class="text-center text-md-left" data-aos="fade-down" data-aos-delay="100">
                                تعرف على خطواتنا في العمل علي المشاريع
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-11">
                        <div class="row steps">
                            <img src="{{ asset(app()->getLocale() == 'ar' ? 'images/project-steps-bg.svg' : 'images/project-steps-bg_en.svg') }}"
                                alt="">
                            <span class="animate-bg-white" data-aos="animatebgwhite-toLeft" data-aos-duration="5500"
                                data-aos-anchor="#last-step" data-aos-delay="400" data-aos-easing="ease-in"></span>
                            <div class="col-12 col-md-4 col-lg-2 " data-aos="fade-down" data-aos-delay="250">
                                <div class="step step-1">
                                    <div class="step-number  m-auto"><span>01</span> </div>
                                    <p class="step-title">الاشتراك</p>
                                    <p class="step-desc"> {{ viewContent($content, 'paragraph_name', 'steps_1') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-2 " data-aos="fade-down" data-aos-delay="300">
                                <div class="step step-2">
                                    <div class="step-number  m-auto"><span>02</span> </div>
                                    <p class="step-title">إضافة الطلب</p>
                                    <p class="step-desc"> {{ viewContent($content, 'paragraph_name', 'steps_2') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-2 " data-aos="fade-down" data-aos-delay="400">
                                <div class="step step-3">
                                    <div class="step-number  m-auto"><span>03</span> </div>
                                    <p class="step-title">استقبال العروض</p>
                                    <p class="step-desc"> {{ viewContent($content, 'paragraph_name', 'steps_3') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-2 " data-aos="fade-down" data-aos-delay="500">
                                <div class="step step-4">
                                    <div class="step-number  m-auto"><span>04</span> </div>
                                    <p class="step-title">قبول عرض</p>
                                    <p class="step-desc"> {{ viewContent($content, 'paragraph_name', 'steps_4') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-2 " data-aos="fade-down" data-aos-delay="600">
                                <div class="step step-5">
                                    <div class="step-number  m-auto"><span>05</span> </div>
                                    <p class="step-title">بدء التنفيذ</p>
                                    <p class="step-desc"> {{ viewContent($content, 'paragraph_name', 'steps_5') }}
                                    </p>
                                </div>
                            </div>
                            <div id="last-step" class="col-12 col-md-4 col-lg-2 " data-aos="fade-down"
                                data-aos-delay="700">
                                <div class="step step-6">
                                    <div class="step-number  m-auto"><span>06</span> </div>
                                    <p class="step-title">استلام المشروع</p>
                                    <p class="step-desc"> {{ viewContent($content, 'paragraph_name', 'steps_6') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-service-warning class="container bg-white">
            <x-slot name="title">
                تنبيه
            </x-slot>
            <x-slot name="subtitle">
                سنخبرك ماذا يجب ان توفر قبل طلب المشروع
            </x-slot>
            <ul class="dashed-lines">
                @foreach (viewContent($content, 'paragraph_name', 'warning_message', 'array') as $item)
                    <li data-aos="fade-down">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        </x-service-warning>
        <x-request-service link="{{ route('user.request.project') }}" class="container bg-white" />
    </div>
</x-layout>
