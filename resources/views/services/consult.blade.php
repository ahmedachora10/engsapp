<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('services.consult') }}">
                خدمة طلب استشارة
            </a>
        </li>
    </x-breadcrumb>
    <div class="consult-page">
        <div class="consult-page-head ">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="services-page-head text-center">
                            <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="250">
                                {{ __('main.consult_head') }}
                            </h5>
                            <h1 data-aos="fade-down">
                                {{ viewContent($content, 'paragraph_name', 'heading_title') }}
                            </h1>
                        </div>
                        <div class="row paragraph">
                            <div class="col-lg-6 order-lg-1 order-2">
                                <div class="icon d-flex justify-content-center align-items-center" data-aos-delay="300"
                                    data-aos="fade-down">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.098" height="28.732"
                                        viewBox="0 0 24.098 28.732">
                                        <path id="engineer"
                                            d="M28.707,9.8h-.927a1.392,1.392,0,0,0-1.39,1.39v.079a1.393,1.393,0,0,0-.927,1.311v.543a1.382,1.382,0,0,0,.407.983l.5.5-.5,4.246A9.716,9.716,0,0,0,19.8,14.5l-.207-.622a2.318,2.318,0,0,0,1.508-1.3h.2a1.856,1.856,0,0,0,1.854-1.854V8.415a.928.928,0,0,0,.927-.927V6.561a.928.928,0,0,0-.927-.927h-.081a5.558,5.558,0,0,0-10.961,0h-.081a.928.928,0,0,0-.927.927v.927a.928.928,0,0,0,.927.927v2.317a1.856,1.856,0,0,0,1.854,1.854h.2a2.319,2.319,0,0,0,1.508,1.3l-.208.622A8.533,8.533,0,0,0,12.446,15.8l-.913-2.835c0-.015,0-.031-.006-.046-.233-.976-1.614-1.487-3.153-1.161A3.34,3.34,0,0,0,6.24,13.044a1.367,1.367,0,0,0-.206,1.062,1.271,1.271,0,0,0,.283.539L9.492,19.4a8.416,8.416,0,0,0-.712,3.379,5.1,5.1,0,0,0,2.781,4.535v.563a1.856,1.856,0,0,0,1.854,1.854h10.2V23.664a3.609,3.609,0,0,0,6.488-2.18V11.2a1.392,1.392,0,0,0-1.39-1.39ZM26.39,12.585a.464.464,0,0,1,.463-.463h.463V11.2a.464.464,0,0,1,.463-.463h.927a.464.464,0,0,1,.463.463v2.781H27.046l-.519-.519a.461.461,0,0,1-.136-.328ZM18.976,27.878v.927H17.791a1.835,1.835,0,0,0,.258-.927Zm.463-.927H16.659V24.826l.519-.519a.468.468,0,0,1,.328-.136h.543a.464.464,0,0,1,.463.463V25.1h.927a.464.464,0,0,1,.463.463v.927a.464.464,0,0,1-.463.463Zm-.8-12.976.278.834-1.334,1.668-1.335-1.668.278-.834h2.113ZM16.255,16.3c-.02,0-.04-.006-.06-.006H13.4a7.577,7.577,0,0,1,2.154-.871Zm-2.841.921H14.59a1.84,1.84,0,0,0-.249.927v.463h.927v-.463a.927.927,0,1,1,.927.927H13.415a.927.927,0,0,1,0-1.854Zm-.927,2.523a1.835,1.835,0,0,0,.927.258H16.2a1.835,1.835,0,0,0,.927-.258V23.3a1.376,1.376,0,0,0-.6.347L16,24.171H14.341a4.174,4.174,0,0,1-1.854-.438ZM18.976,23.6a1.382,1.382,0,0,0-.927-.359v-5.1a1.832,1.832,0,0,0-.115-.621l1.042-1.3Zm2.317-11.945V9.8a.927.927,0,1,1,0,1.854Zm.927-2.523a1.835,1.835,0,0,0-.927-.258V8.415h.927Zm-.095-3.5H18.976v-3.5A4.594,4.594,0,0,1,22.125,5.634ZM18.049,1.95V5.634h-.927V1.95c.152-.015.307-.023.463-.023S17.9,1.935,18.049,1.95ZM16.2,2.139v3.5H13.046A4.594,4.594,0,0,1,16.2,2.139ZM12.024,6.561H23.146v.927H12.024Zm1.854,1.854v.463a1.835,1.835,0,0,0-.927.258V8.415Zm-.927,2.317a.928.928,0,0,1,.927-.927v1.854A.928.928,0,0,1,12.951,10.732Zm1.854.927V8.415h5.561v3.244a1.392,1.392,0,0,1-1.39,1.39H16.2A1.392,1.392,0,0,1,14.8,11.659ZM7.023,13.54a2.5,2.5,0,0,1,1.545-.876,3.566,3.566,0,0,1,.737-.081,1.563,1.563,0,0,1,1.275.445l.045.141a.481.481,0,0,1-.087.316,2.5,2.5,0,0,1-1.545.876,2.221,2.221,0,0,1-1.947-.291l-.091-.136a.419.419,0,0,1-.02-.041.468.468,0,0,1,.088-.353Zm1.25,1.825a4.4,4.4,0,0,0,.913-.1,3.726,3.726,0,0,0,1.822-.909L11.89,17.1a1.839,1.839,0,0,0-.329,1.05v2.685L7.9,15.346c.122.012.247.02.375.02Zm1.434,7.415a7.509,7.509,0,0,1,.406-2.448L11.561,22.5v.6A4.144,4.144,0,0,1,11,22.5l-.741.556A5.122,5.122,0,0,0,14.341,25.1h1.39v1.854H13.878a4.176,4.176,0,0,1-4.171-4.171Zm5.1,6.024h-1.39a.928.928,0,0,1-.927-.927v-.2a5.082,5.082,0,0,0,1.39.2h3.244a.928.928,0,0,1-.927.927Zm11.679-4.634a2.673,2.673,0,0,1-2.4-1.485l-.47-.941V20h-.927v8.8H19.9V27.793a1.388,1.388,0,0,0,.927-1.3v-.927a1.388,1.388,0,0,0-.927-1.3V15.488a8.788,8.788,0,0,1,5.7,4.836l.07.153-.21,1.786.92.108.878-7.469h1.905v6.581a2.69,2.69,0,0,1-2.687,2.687Z"
                                            transform="translate(-6 -1)" fill="#f7a51a" />
                                    </svg>

                                </div>
                                <h1 data-aos-delay="250" data-aos="fade-down">
                                    {{ viewContent($content, 'paragraph_name', 'heading_title2') }}
                                </h1>
                              <!--  <p class="pb-4 pb-xl-0" data-aos="fade-down" data-aos-delay="100">
                                    {{ viewContent($content, 'paragraph_name', 'welcome_para') }}
                                </p> !-->
                            </div>
                            <div class="col-lg-6 order-lg-2 order-1 d-flex justify-content-center" data-aos="fade-down"
                                data-aos-delay="100">
                                @include('svgImages.consult-head-img')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="consult-features">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="consult-feature-bg text-center">
                        <img src="{{ asset('images/consult-feature-bg.svg') }}" data-aos="flip-right" alt="">
                    </div>
                    <div class="col-lg-11">
                        <div class="cf-container">
                            <h5 id="whyAnchor" class="text-yellow-color" data-aos="fade-down" data-aos-delay="250">
                                لماذا الخدمة
                            </h5>
                            <h1 data-aos="fade-down" data-aos-delay="100" data-aos-anchor="#whyAnchor">
                                دعنا نخبرك كيف تستفيد من الخدمة
                            </h1>
                            <ul class="dashed-lines">
                                @php
                                    $delayCounter = 150;
                                @endphp
                                @foreach (viewContent($content, 'paragraph_name', 'why', 'array') as $item)
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
        <div class="consult-services">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-xl-11 col-12 fill-col-width">
                        <div class="d-flex flex-column flex-xl-row">
                            <div class="img flex-shrink-0">
                                <img class="img-fluid" src="{{ asset('images/consult.jpg') }}" data-aos="flip-left"
                                    alt="">
                            </div>
                            <div class="paragraph d-flex flex-fill align-items-center">
                                <img src="{{ asset(app()->getLocale() == 'ar' ? 'images/consult-services-bg.svg' : 'images/consult-services-bg_en.svg') }}"
                                    alt="">
                                <div class="text-container flex-fill pt-5 px-5 px-xl-0 pl-xl-5">
                                    <!--<h5 class="text-white" data-aos="fade-down">
                                        مميزات الخدمة
                                    </h5> !--> 
                                    <h1 class="text-white" data-aos="fade-down">
                                     لما تحتاج إلى طلب استشارة؟
                                    </h1>
                                    <ul class="dashed-lines text-white">
                                        @php
                                            $delayCounter = 150;
                                        @endphp
                                        @foreach (viewContent($content, 'paragraph_name', 'service_features', 'array') as $item)
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
            </div>
        </div>
        <div class="consult-steps">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11 ">
                        <h5 class="text-yellow-color text-center text-md-left">
                            طلب الخدمة
                        </h5>
                        <h1 class="text-center text-md-left">
                            دعنا نوضح لك الية طلب الخدمة
                        </h1>
                        <div class="steps d-flex justify-content-center text-center flex-md-row flex-column">
                            <img src="{{ asset('images/consult-steps.svg') }}" alt="">
                            <div class="step step-1 flex-fill">
                                <div class="step-number d-flex justify-content-center align-items-center m-auto">
                                    <span>01</span>
                                </div>
                                <p class="step-title">الاشتراك</p>
                                <p class="step-desc m-auto">
                                    {{ viewContent($content, 'paragraph_name', 'steps_1') }}
                                </p>

                            </div>
                            <div class="step step-2 flex-fill">
                                <div class="step-number d-flex justify-content-center align-items-center m-auto">
                                    <span>02</span>
                                </div>
                                <p class="step-title">إضافة الطلب</p>
                                <p class="step-desc m-auto">
                                    {{ viewContent($content, 'paragraph_name', 'steps_2') }}
                                </p>
                            </div>
                            <div class="step step-3 flex-fill">
                                <div class="step-number d-flex justify-content-center align-items-center m-auto">
                                    <span>03</span>
                                </div>
                                <p class="step-title">استقبال العروض</p>
                                <p class="step-desc m-auto">
                                    {{ viewContent($content, 'paragraph_name', 'steps_3') }}
                                </p>
                            </div>
                            <div class="step step-4 flex-fill">
                                <div class="step-number d-flex justify-content-center align-items-center m-auto">
                                    <span>04</span>
                                </div>
                                <p class="step-title">قبول عرض</p>
                                <p class="step-desc m-auto">
                                    {{ viewContent($content, 'paragraph_name', 'steps_4') }}
                                </p>

                            </div>
                            <div class="step step-5 flex-fill">
                                <div class="step-number d-flex justify-content-center align-items-center m-auto">
                                    <span>05</span>
                                </div>
                                <p class="step-title">بدء التواصل</p>
                                <p class="step-desc m-auto">
                                    {{ viewContent($content, 'paragraph_name', 'steps_5') }}
                                </p>
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
                كيف تختار مستشار جيد؟
            </x-slot>
            <ul class="dashed-lines">
                @foreach (viewContent($content, 'paragraph_name', 'warning_message', 'array') as $item)
                    <li data-aos="fade-down">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        </x-service-warning>
        <x-request-service link="{{ route('user.request.consult') }}" class="container bg-white" />
    </div>
</x-layout>
