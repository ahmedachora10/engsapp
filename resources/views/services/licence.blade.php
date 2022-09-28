<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('services.licence') }}">
                {{ __('main.license_header') }}
            </a>
        </li>
    </x-breadcrumb>
    <div class="licence-page">
        <div class="licence-page-head ">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="services-page-head text-center">
                            <h5 class="text-yellow-color">
                                {{ __('main.welcomingmsg') }}
                            </h5>
                            <h1>
                                {{ viewContent($content, 'paragraph_name', 'heading_title') }}
                            </h1>
                            <img src="{{ asset('images/licence-confused.jpg') }}" alt="">
                            <h1>
                                {{ viewContent($content, 'paragraph_name', 'heading_title2') }}
                            </h1>
                            <h1 class="text-yellow-color">
                                 {{ __('main.license_sutitle') }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="licence-offer">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="d-flex align-items-center licence-offer-block flex-column flex-md-row">
                            <div class="text-padding order-2 order-md-1">
                                <h5 class="text-yellow-color">
                                     {{ __('main.license_what_offer') }}
                                </h5>
                                <h1>
                                    {{ viewContent($content, 'paragraph_name', 'what_it_offers_title') }}
                                </h1>
                                <p class="text-ebonyclay">
                                    {{ viewContent($content, 'paragraph_name', 'what_it_offers_paragraph') }}
                                </p>
                            </div>
                            <img class="ml-auto order-1 order-md-2 img-fluid" src="{{ asset('images/loffer-1.jpg') }}"
                                alt="">
                        </div>
                    </div>
                    <div class="col-lg-11 mt-2">
                        <div class="d-flex align-items-center licence-offer-block flex-column flex-md-row">
                            <img class="ml-auto img-fluid" src="{{ asset('images/loffer-2.jpg') }}" alt="">
                            <div class="text-padding">
                                <h5 class="text-yellow-color">
                                     {{ __('main.license_who_offer') }}    
                                </h5>
                                <h1>
                                    {{ viewContent($content, 'paragraph_name', 'exec_agencies_title') }}
                                </h1>
                                <p class="text-ebonyclay">
                                    {{ viewContent($content, 'paragraph_name', 'exec_agencies_paragraph') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="licence-services-head">
            <div class="container bg-white">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="text-center">
                            <h1>
                                {{ __('main.license_types_title') }}  
                            </h1>
                            <p class="text-ebonyclay">
                               {{ __('main.license_types_subtitle') }}      
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="licence-services">
            <div class="container bg-white">
                <div class="row justfiy-content-center">
                    <div class="col-lg-12 p-0">
                        <div class="tabs d-flex justify-content-center">
                            <a href="#" id="tab-1" class="btn-light tab tab-1 selected flex-fill">{{ __('main.construct_license') }}</a>
                            <a href="#" id="tab-2" class="btn-light tab tab-2 flex-fill">{{ __('main.operation_license') }}</a>
                        </div>
                        <div class="tabs-content">
                            <div class="tab-1 tab row m-0 justify-content-center">
                                <div class="col-lg-11">
                                    <div class="steps row justify-content-center">
                                        <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                                            <div class="step">
                                                <span class="step-number">01</span>
                                                <h5 class="text-yellow-color mb-2">{{ __('main.license_type') }}</h5>
                                                <h5> {{ __('main.select_license_types') }}   </h5>
                                                <p class="text-ebonyclay">
                                                    {{ viewContent($content, 'paragraph_name', 'cons_licence1') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                                            <div class="step">
                                                <span class="step-number">02</span>
                                                <h5 class="text-yellow-color mb-2">{{ __('main.project_type') }}</h5>
                                                <h5> {{ __('main.select_project_type') }} </h5>
                                                <p class="text-ebonyclay">
                                                    {{ viewContent($content, 'paragraph_name', 'cons_licence2') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="step">
                                                <span class="step-number">03</span>
                                                <h5 class="text-yellow-color mb-2">{{ __('main.licenses') }}</h5>
                                                <h5>{{ __('main.select_required_license') }} </h5>
                                                <p class="text-ebonyclay">
                                                    {{ viewContent($content, 'paragraph_name', 'cons_licence3') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="requirements-head text-center">
                                        <h5 class="text-yellow-color">
                                             {{ __('main.license_requirments_title') }} 
                                        </h5>
                                        <h1>
                                            {{ __('main.license_requirments_subtitle') }} 
                                        </h1>
                                    </div>
                                    <div class="requirements row justify-content-start justify-content-lg-center">
                                        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-0 d-flex flex-column">
                                            <div class="requirment-block flex-fill">
                                                <div class="req-img">
                                                    <img class="img-fluid"
                                                        src="{{ asset('images/ResidentialProjects.jpg') }}" alt="">
                                                </div>
                                                <h3 class="req-name text-white">{{ __('main.residential_projects') }}</h3>
                                                <div class="req-desc">
                                                    <p class="req-note text-ebonyclay"> {{ __('main.required_study') }}  </p>
                                                    <ul class="dashed-lines">
                                                        <li>
                                                              {{ __('main.soil_study') }} 
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-0 d-flex flex-column">
                                            <div class="requirment-block flex-fill">
                                                <div class="req-img">
                                                    <img class="img-fluid"
                                                        src="{{ asset('images/CommercialProjects.jpg') }}" alt="">
                                                </div>
                                                <h3 class="req-name text-white">{{ __('main.commercial_projects') }}</h3>
                                                <div class="req-desc">
                                                    <p class="req-note text-ebonyclay">{{ __('main.required_study') }}</p>
                                                    <ul class="dashed-lines">
                                                        <li>
                                                              {{ __('main.soil_study') }}   
                                                        </li>
                                                        <li>
                                                              {{ __('main.trafic_study') }}  
                                                        </li>
                                                         <li>
                                                             {{ __('main.torrent_study') }}          
                                                        </li>
                                                        <li>
                                                                  {{ __('main.enviroment_study') }}  
                                                        </li>
                                                         <li>
                                                              {{ __('main.safty_study') }}      
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-0 d-flex flex-column">
                                            <div class="requirment-block flex-fill">
                                                <div class="req-img">
                                                    <img class="img-fluid"
                                                        src="{{ asset('images/MajorProjects.jpg') }}" alt="">
                                                </div>
                                                <h3 class="req-name text-white">{{ __('main.big_projects') }}</h3>
                                                <div class="req-desc">
                                                    <p class="req-note text-ebonyclay">{{ __('main.required_study') }}
                                                    </p>
                                                    <ul class="dashed-lines">
                                                         <li>
                                                                {{ __('main.soil_study') }}  
                                                        </li>
                                                        <li>
                                                              {{ __('main.trafic_study') }}  
                                                        </li>
                                                         <li>
                                                             {{ __('main.torrent_study') }}          
                                                        </li>
                                                        <li>
                                                                  {{ __('main.enviroment_study') }}  
                                                        </li>
                                                         <li>
                                                              {{ __('main.safty_study') }}      
                                                        </li>

                                                    </ul>
                                                </div>
                                                </>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-2 tab row m-0 justify-content-center" style="display: none;">
                                <div class="col-lg-11">
                                    <div class="steps row justify-content-center">
                                        <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                                            <div class="step">
                                                <span class="step-number">01</span>
                                                <h5 class="text-yellow-color mb-2">   {{ __('main.license_type') }} </h5>
                                                <h5>عليك تحديد نوع الترخيص</h5>
                                                <p class="text-ebonyclay">
                                                    {{ viewContent($content, 'paragraph_name', 'oper_licence1') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                                            <div class="step">
                                                <span class="step-number">02</span>
                                                <h5 class="text-yellow-color mb-2">  {{ __('main.project_type') }} </h5>
                                                <h5>{{ __('main.select_project_type') }}  </h5>
                                                <p class="text-ebonyclay">
                                                    {{ viewContent($content, 'paragraph_name', 'oper_licence2') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="step">
                                                <span class="step-number">03</span>
                                                <h5 class="text-yellow-color mb-2">{{ __('main.licenses') }}</h5>
                                                <h5> {{ __('main.select_required_license') }}  </h5>
                                                <p class="text-ebonyclay">
                                                    {{ viewContent($content, 'paragraph_name', 'oper_licence3') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="requirements-head text-center">
                                        <h5 class="text-yellow-color">
                                             {{ __('main.license_requirments_title') }} 
                                        </h5>
                                        <h1>
                                            {{ __('main.license_requirments_subtitle') }} 
                                        </h1>
                                    </div>
                                    <div class="requirements row justify-content-start justify-content-lg-center">
                                        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-0 d-flex flex-column">
                                            <div class="requirment-block flex-fill">
                                                <div class="req-img">
                                                    <img class="img-fluid"
                                                        src="{{ asset('images/CommercialProjects.jpg') }}" alt="">
                                                </div>
                                                <h3 class="req-name text-white">{{ __('main.commercial_projects') }}</h3>
                                                <div class="req-desc">
                                                    <p class="req-note text-ebonyclay">{{ __('main.license_required_operations') }} 
                                                         </p>
                                                    <ul class="dashed-lines">
                                                        <li>
                                                            {{ __('main.enviroment_protection') }} 
                                                        </li>
                                                        <li>
                                                            {{ __('main.operation_license') }} 
                                                        </li>
                                                        <li>
                                                           {{ __('main.complate_license') }}   
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-lg-0 d-flex flex-column">
                                            <div class="requirment-block flex-fill">
                                                <div class="req-img">
                                                    <img class="img-fluid"
                                                        src="{{ asset('images/MajorProjects.jpg') }}" alt="">
                                                </div>
                                                <h3 class="req-name text-white">{{ __('main.big_projects') }}</h3>
                                                <div class="req-desc">
                                                    <p class="req-note text-ebonyclay">{{ __('main.license_required_operations') }}
                                                         
                                                    </p>
                                                    <ul class="dashed-lines">
                                                        <li>
                                                            {{ __('main.enviroment_protection') }} 
                                                        </li>
                                                        <li>
                                                            {{ __('main.operation_license') }} 
                                                        </li>
                                                        <li>
                                                           {{ __('main.complate_license') }}   
                                                        </li>
                                                    </ul>
                                                </div>
                                                </>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-service-warning class="container bg-white">
                <x-slot name="title">
                     {{ __('main.license_attention') }} 
                </x-slot>
                <x-slot name="subtitle">
                    {{ __('main.license_attention_title') }} 
                </x-slot>
                <ul class="dashed-lines">
                    @foreach (viewContent($content, 'paragraph_name', 'warning_message', 'array') as $item)
                        <li data-aos="fade-down">
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </x-service-warning>
            <x-request-service link="{{ route('user.request.licence') }}" class="container bg-white" />
        </div>
</x-layout>
