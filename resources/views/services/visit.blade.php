<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('services.visit') }}">
                خدمة طلب زيارة موقع
            </a>
        </li>
    </x-breadcrumb>
    <div class="visit-page">
        <div class="visit-page-head">
            <div class="container bg-white">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xl-7 col-lg-10 ml-auto vph-pr">
                                <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="150">
                                    {{ __('main.welcomingmsg') }}
                                </h5>
                                <div class="para-container">
                                    <h1 class="paragraph" data-aos="fade-down">
                                        @foreach (viewContent($content, 'paragraph_name', 'heading_title', 'array') as $item)
                                            {!! !$loop->last ? $item . '<br />' : $item !!}
                                        @endforeach
                                    </h1>
                                    <h1 class="text-yellow-color right-location" data-aos="fade-down">
                                        {{ viewContent($content, 'paragraph_name', 'heading_title2') }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="visit-service">
            <div class="container bg-white p-0">
                <div class="row no-gutters">
                    <div class="col-lg-12">
                        <div class="visit-service-container d-flex flex-xl-row flex-column">
                            <div class="right order-2 order-xl-1">
                                <div class="icon d-flex justify-content-center align-items-center" data-aos-delay="200"
                                    data-aos="fade-down">
                                    @include('svgImages.visit-why-icon')
                                </div>
                                <h1 class="text-white" data-aos="fade-down" data-aos-delay="150">
                                    {{ viewContent($content, 'paragraph_name', 'heading_title3') }}
                                </h1>
                                <p class="text-white" data-aos="fade-down">
                                    {{ viewContent($content, 'paragraph_name', 'welcome_para') }}
                                </p>
                            </div>
                            <div class="left order-1 order-xl-2 d-flex justify-content-center" data-aos="fade-up">
                                @if (app()->getLocale() == 'ar')
                                    @include('svgImages.visit-service-img')
                                @else
                                    @include('svgImages.visit-service-img_en')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="visit-features">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="visit-feature-bg text-center">
                        <img src="{{ asset(app()->getLocale() == 'ar' ? 'images/visit-features-bg.svg' : 'images/visit-features-bg_en.svg') }}"
                            data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}" alt="">
                    </div>
                    <div class="col-lg-11">
                        <div class="vf-container">
                            <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="150">
                                مميزة الخدمة
                            </h5>
                            <h1 data-aos="fade-down">
                                كيف تساعدك خدمة طلب موقع
                            </h1>
                            <ul class="dashed-lines">
                                @php
                                    $delayCounter = 100;
                                @endphp
                                @foreach (viewContent($content, 'paragraph_name', 'features', 'array') as $item)
                                    <li data-aos="fade-down"
                                        data-aos-delay="{{ $delayCounter = $delayCounter + 50 }}">
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="visit-steps">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="150">
                            طلب الخدمة
                        </h5>
                        <h1 data-aos="fade-down">
                            خطوات بسيطه لطلب الخدمة
                        </h1>
                        <div class="steps">
                            <div class="row">
                                <div class="dashed-lines"></div>
                                <span class="animate-bg-white" data-aos="animatebgwhite-toLeft" data-aos-duration="3000"
                                    data-aos-anchor="#last-step" data-aos-delay="400" data-aos-easing="ease-in"></span>
                                <div class="col-xl-3 col-lg-6 mb-xl-0 mb-3" data-aos="fade-down" data-aos-delay="300">
                                    <div class="step first">
                                        <div class="number">
                                            01
                                        </div>
                                        <div class="step-name">
                                            الاشتراك
                                        </div>
                                        <p class="step-desc m-auto">
                                            {{ viewContent($content, 'paragraph_name', 'steps_1') }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 mb-xl-0 mb-3" data-aos="fade-down" data-aos-delay="400">
                                    <div class="step second">
                                        <div class="number">
                                            02
                                        </div>
                                        <div class="step-name">
                                            اختيار الخدمة
                                        </div>
                                        <p class="step-desc m-auto">
                                            {{ viewContent($content, 'paragraph_name', 'steps_2') }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 mb-xl-0 mb-3" data-aos="fade-down" data-aos-delay="500">
                                    <div class="step third">
                                        <div class="number">
                                            03
                                        </div>
                                        <div class="step-name">
                                            قبول العرض
                                        </div>
                                        <p class="step-desc m-auto">
                                            {{ viewContent($content, 'paragraph_name', 'steps_3') }}</p>
                                    </div>
                                </div>
                                <div id="last-step" class="col-xl-3 col-lg-6" data-aos="fade-down" data-aos-delay="600">
                                    <div class="step fourth">
                                        <div class="number">
                                            04
                                        </div>
                                        <div class="step-name">
                                            تواصل مع المهندس المستقل/ المكتب الهندسي
                                        </div>
                                        <p class="step-desc m-auto">
                                            {{ viewContent($content, 'paragraph_name', 'steps_4') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-service-warning class="container bg-white noTopPadding">
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
        <x-request-service link="{{ route('user.request.visit') }}" class="container bg-white" />
    </div>
</x-layout>
