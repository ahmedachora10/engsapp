<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('services.judge') }}">
                خدمة تحكيم بين طرفين
            </a>
        </li>
    </x-breadcrumb>
    <div class="judge-page">
        <div class="judge-page-head ">
            <div class="container bg-white">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-12 ">
                        <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="100">
                            {{ __('main.welcomingmsg') }}
                        </h5>
                        <h1 data-aos="fade-down">
                            {{ viewContent($content, 'paragraph_name', 'heading_title') }}
                        </h1>
                        <div class="judge-head-img" data-aos="fade-down">
                            <img class="img-fluid" src="{{ asset('images/judge.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="judge-paragraph">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-11 d-md-flex justify-content-center">
                        <div class="icon flex-shrink-0" data-aos="fade-down">
                            <svg xmlns="http://www.w3.org/2000/svg" width="61.047" height="61.15"
                                viewBox="0 0 61.047 61.15">
                                <path id="justice-scale"
                                    d="M65.647,33.736a.874.874,0,0,0-.051-.36l-11.1-26a.9.9,0,0,0-.822-.565A15.335,15.335,0,0,0,45.2,9.173,13.868,13.868,0,0,1,38,11.9V7.478a2.878,2.878,0,1,0-5.755,0v4.471a14.359,14.359,0,0,1-7.194-2.723,15.335,15.335,0,0,0-8.479-2.364.965.965,0,0,0-.822.565l-11.1,25.95a.874.874,0,0,0-.051.36,11.973,11.973,0,1,0,23.946,0,.874.874,0,0,0-.051-.36L17.96,8.66a12.409,12.409,0,0,1,6.115,2.055,15.85,15.85,0,0,0,8.17,3.032V49.614H29.06a3.985,3.985,0,0,0-3.494,2.107l-2.723,5.036H19.759a.921.921,0,0,0-.925.925v7.143a.921.921,0,0,0,.925.925H50.591a.921.921,0,0,0,.925-.925V57.682a.921.921,0,0,0-.925-.925H47.507l-2.723-5.036a4.047,4.047,0,0,0-3.494-2.107H38.1V13.7a16.087,16.087,0,0,0,8.17-3.032,13.137,13.137,0,0,1,6.115-2.055L41.752,33.376a.874.874,0,0,0-.051.36,11.973,11.973,0,0,0,23.946,0Zm-55.137,8.17V38.72a2.423,2.423,0,0,1,1.7-2.261l2.107-.617a4.812,4.812,0,0,0,4.573,0l2.107.617a2.358,2.358,0,0,1,1.7,2.261v3.186a10.253,10.253,0,0,1-12.179,0Zm6.064-7.245a3.083,3.083,0,1,1,3.083-3.083A3.126,3.126,0,0,1,16.573,34.661Zm7.862,5.55V38.72a4.241,4.241,0,0,0-2.98-4.008l-.976-.257A4.882,4.882,0,1,0,12.668,28.6a4.934,4.934,0,0,0,0,5.858l-.976.257a4.194,4.194,0,0,0-2.98,4.008v1.439A10.337,10.337,0,0,1,6.4,33.89L16.573,10,26.747,33.89a9.876,9.876,0,0,1-2.312,6.32ZM49.614,63.848H20.632V58.5H49.666Zm-6.475-11.3L45.4,56.706H24.846l2.261-4.162a2.124,2.124,0,0,1,1.9-1.13H41.187a2.146,2.146,0,0,1,1.953,1.13Zm-9.1-2.929V7.478a1.079,1.079,0,1,1,2.158,0V49.614ZM43.5,33.89,53.674,10,63.848,33.89a10.22,10.22,0,0,1-2.312,6.269V38.72a4.241,4.241,0,0,0-2.98-4.008l-.976-.257A4.882,4.882,0,0,0,49.768,28.6a4.934,4.934,0,0,0,0,5.858l-.976.257a4.194,4.194,0,0,0-2.98,4.008v1.439A9.637,9.637,0,0,1,43.5,33.89Zm7.091-2.364a3.083,3.083,0,1,1,3.083,3.083A3.06,3.06,0,0,1,50.591,31.526Zm-2.98,10.38V38.72a2.423,2.423,0,0,1,1.7-2.261l2.107-.617a4.812,4.812,0,0,0,4.573,0l2.107.617a2.358,2.358,0,0,1,1.7,2.261v3.186a10.253,10.253,0,0,1-12.179,0Z"
                                    transform="translate(-4.6 -4.6)" fill="#224d5c" />
                            </svg>
                        </div>
                        <div class="j-paragraph">
                            <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="100">
                                خدمة التحكيم الهندسي
                            </h5>
                            <h1 data-aos="fade-down">
                                @foreach (viewContent($content, 'paragraph_name', 'heading_title2', 'array') as $item)
                                    {!! !$loop->last ? $item . '<br />' : $item !!}
                                @endforeach
                            </h1>
                            <p data-aos="fade-down">
                                {{ viewContent($content, 'paragraph_name', 'welcome_para') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="judge-services">
            <div class="container bg-white">
                <img src="{{ asset('images/js-bg.svg') }}" alt="">
                <div class="row no-gutters justify-content-center">
                    <div class="col-lg-10 col-md-11">
                        <div class="row no-gutters">
                            <div class="col-lg-7 order-2 order-lg-1">
                                <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="200">
                                    ما هي الخدمات التي يقدمها مركز التحكيم الهندسي؟
                                </h5>
                                <h1 data-aos="fade-down">
                                 يقدم مركز التحكيم الهندسي مجموعة واسعة من الخدمات التي تصب في مصلحة التحكيم الهندسي في المملكة العربية السعودية، منها ما يلي
                                 </h1>
                                <ul class="dashed-lines">
                                    @foreach (viewContent($content, 'paragraph_name', 'why', 'array') as $item)
                                        <li data-aos="fade-down">
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-5  d-flex justify-content-center order-1 order-lg-2"
                                data-aos="fade-right">
                                @include('svgImages.judge-services')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(false)
        <div class="judge-steps">
            <div class="container bg-white">
                <div class="row no-gutters justify-content-center">
                    <div class="col-lg-10 col-md-11">
                        <h1 class="text-lg-left text-md-center" data-aos="fade-down">
                            دعنا نوضح لك الية طلب الخدمة
                        </h1>
                        <div class="steps d-flex flex-column flex-lg-row">
                            <span class="line" data-aos="steps-line-toleft" data-aos-duration="2000"
                                data-aos-delay="700" data-aos-anchor="#last-step"></span>
                            <div class="step flex-fill mb-lg-3 mb-5" data-aos="fade-down" data-aos-delay="250">
                                <div class="number d-flex m-auto justify-content-center align-items-center">01</div>
                                <div class="step-name">الاشتراك</div>
                                <div class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'steps_1') }}</div>
                            </div>
                            <div class="step flex-fill mb-lg-3 mb-5" data-aos="fade-down" data-aos-delay="300">
                                <div class="number d-flex m-auto justify-content-center align-items-center">02</div>
                                <div class="step-name">إضافة الطلب</div>
                                <div class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'steps_2') }}</div>
                            </div>
                            <div class="step flex-fill mb-lg-3 mb-5" data-aos="fade-down" data-aos-delay="350">
                                <div class="number d-flex m-auto justify-content-center align-items-center">03</div>
                                <div class="step-name">استقبال العروض</div>
                                <div class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'steps_3') }}</div>
                            </div>
                            <div class="step flex-fill mb-lg-3 mb-5" data-aos="fade-down" data-aos-delay="400">
                                <div class="number d-flex m-auto justify-content-center align-items-center">04</div>
                                <div class="step-name">تواصل مع المحكم</div>
                                <div class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'steps_4') }}</div>
                            </div>
                            <div id="last-step" class="step flex-fill mb-lg-3 mb-5" data-aos="fade-down"
                                data-aos-delay="450">
                                <div class="number d-flex m-auto justify-content-center align-items-center">05</div>
                                <div class="step-name">انتهاء المشروع</div>
                                <div class="step-desc text-center">
                                    {{ viewContent($content, 'paragraph_name', 'steps_5') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <x-service-warning class="container bg-white">
            <x-slot name="title">
                تنبيه
            </x-slot>
            <x-slot name="subtitle">
                ما الذي يجب أن توفره لطلب التحكيم
            </x-slot>
            <ul class="dashed-lines">
                @foreach (viewContent($content, 'paragraph_name', 'warning_message', 'array') as $item)
                    <li data-aos="fade-down">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        </x-service-warning>
        <x-request-service link="{{ route('user.request.judge') }}" class="container bg-white" />
    </div>
</x-layout>
