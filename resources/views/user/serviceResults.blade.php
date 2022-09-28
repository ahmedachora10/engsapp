<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            {{ __('main.requestthisservice') }}
        </li>
        <li class="breadcrumb-item">
            {{ $currentRequestServiceText }}
        </li>
    </x-breadcrumb>

    @push('css')

    <style>
        .service-result-cards .service-result-card .card-contact-box .text {
            font-family: Roboto;
            font-weight: 400;
            font-size: 15px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }
        .service-result-cards .service-result-card .card-name {
            font-weight: 400;
            font-size: 15px;
            line-height: 16px;
            height: 35px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    @endpush

    <div class="service-results">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="bg-white pb-2 pt-4 px-4 service-result-header">
                        <div class="d-flex justify-content-between">
                            @if ($projectType)
                                <h1>مكاتب هندسية تقدم خدمة طلب ترخيص</h1>
                            @else
                                <h1>مقدمي الخدمات</h1>
                            @endif


                            <a class="align-self-center btn-back"
                                href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                        </div>
                        @if ($projectType)
                            <div class="d-block icon-selectedservices">
                                @if ($projectType->name == 'مشاريع سكنية' || $projectType->name == 'Residential Projects')
                                    @include('svgIcons.homeprojects')
                                @elseif ($projectType->name == 'مشاريع تجارية' ||
                                    $projectType->name == 'Commercial Projects')
                                    @include('svgIcons.marketprojects')
                                @elseif ($projectType->name == 'مشاريع كبرى' ||
                                    $projectType->name == 'Large Projects')
                                    @include('svgIcons.largeprojects')
                                @endif
                                {{ $projectType->name }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mt-3">
                            <div class="d-flex flex-row selected-subservices">
                                @if ($projectType)
                                    <p class="requestedLicence flex-shrink-0 mr-3 mt-2">التراخيص المطلوبة</p>
                                @endif
                                <div class="d-flex flex-wrap">
                                    @foreach ($selectedservices as $service)
                                        <span class="subservice mr-2 mb-2">{{ $service->name }}</span>
                                    @endforeach

                                </div>
                            </div>
                            <div class="steps-container">
                                <ul class="steps-counting d-flex align-items-center">
                                    @for ($i = 1; $i <= $steps; $i++)
                                        <li class="step active filled" data-number="  {{ sprintf('%02d', $i) }}"></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 service-result-cards">
                        @if ($operators->count() == 0)
                            <div class="col-md-12">
                                <div class="bg-white text-center p-4 mb-5">
                                    <h5>لا يوجد نتائج لعرضها</h5>
                                </div>
                            </div>
                        @endif
                        @foreach ($operators as $operator)
                            <div class="col-lg-3 col-md-4">
                                <a href="{{route('freelancecompanyprofile',$operator->id)}}" target="_blank" style="color: #000 !important;">
                                <div class="service-result-card">
                                    <img class="card-img"
                                        src="{{ $operator->profile_img ? route('imagecache', ['filename' => $operator->profile_img, 'template' => 'profile']) : asset('images/search-result.jpg') }}" alt="">
                                    <p class=" card-name">{{ $operator->name }}</p>
                                    <p class="card-desc mb-4 mt-4">{{@$operator->operatorProfile->bio_text}}
                                    </p>
                                    <div class="card-contact-box">
                                        <div class="d-flex pt-3">
                                            <div class="icon">
                                                <svg id="Group_15027" data-name="Group 15027"
                                                    xmlns="http://www.w3.org/2000/svg" width="15.825" height="10.842"
                                                    viewBox="0 0 15.825 10.842">
                                                    <path id="Path_7198" data-name="Path 7198"
                                                        d="M14.434,80.609H1.391A1.392,1.392,0,0,0,0,82v8.06a1.392,1.392,0,0,0,1.391,1.391H14.434a1.392,1.392,0,0,0,1.391-1.391V82A1.392,1.392,0,0,0,14.434,80.609Zm-.182.927-.186.155-5.6,4.665a.862.862,0,0,1-1.1,0l-5.6-4.665-.186-.155ZM.927,82.206l4.565,3.8L.927,89.045Zm13.507,8.318H1.391a.464.464,0,0,1-.454-.371l5.3-3.527.532.443a1.79,1.79,0,0,0,2.29,0l.532-.443,5.3,3.527A.464.464,0,0,1,14.434,90.524Zm.464-1.479-4.565-3.038,4.565-3.8Z"
                                                        transform="translate(0 -80.609)" fill="#626577" />
                                                </svg>
                                            </div>
                                            <div class="pl-3 text">{{ $operator->email }}</div>
                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13.993" height="13.964"
                                                    viewBox="0 0 13.993 13.964">
                                                    <path id="call-outline"
                                                        d="M15.985,13.576A11.477,11.477,0,0,0,13.7,12.051c-.761-.383-.823-.414-1.421.03-.4.3-.664.561-1.13.461A6.052,6.052,0,0,1,8.782,11,6.254,6.254,0,0,1,7.2,8.6c-.1-.465.169-.727.463-1.126.414-.563.382-.657.029-1.417a10.4,10.4,0,0,0-1.53-2.278c-.538-.531-.538-.437-.884-.293a5.011,5.011,0,0,0-.808.431A2.425,2.425,0,0,0,3.5,4.943c-.194.415-.282,1.388.722,3.212a15.907,15.907,0,0,0,3.165,4.208A17.311,17.311,0,0,0,11.6,15.516c2.026,1.135,2.8.914,3.22.72a2.412,2.412,0,0,0,1.027-.97,4.978,4.978,0,0,0,.432-.807C16.423,14.113,16.517,14.113,15.985,13.576Z"
                                                        transform="translate(-2.863 -2.911)" fill="none"
                                                        stroke="#626577" stroke-miterlimit="10" stroke-width="1" />
                                                </svg>
                                            </div>
                                            <div class="pl-3 text" style="direction: ltr;">
                                                +{{ $operator->country_code_phone_number }}{{ $operator->phone_number }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    @if ($operators->total() != $operators->count())
                        <div class="mt-n4 row mb-5 buttonContainer">
                            <div class="col-lg-12">
                                <form id="loadMoreForm" action="{{ $operators->nextPageUrl() }}"
                                    class="d-flex justify-content-center">
                                    @foreach ($selectedservices as $selectedService)
                                        <input type="hidden" id="service{{ $selectedService->id }}"
                                            name="selectedservices[]" value="{{ $selectedService->id }}">
                                    @endforeach
                                    <input type="hidden" name="service_type" value="{{ $service_type }}">
                                    <button type="submit" class="btn-load-more btn btn-white btn-s-50 fs-16"
                                        data-totalResult="{{ $operators->total() }}">
                                        <span class="text">عرض المزيد</span>
                                        <div class="loading-animate body-color-loading">
                                            <div class="lds-ellipsis">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    <div class="d-none">
                        {{ $operators->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script id="companyCardTemplate" type="text/template">@include('components.service-requests.companycard')</script>
        <script>
            $(function() {

                var form = $("#loadMoreForm");
                form.submit(function() {
                    var btn = $(this).find("button[type='submit']");
                    var $ul = $("ul.pagination");
                    // console.log($ul);
                    var url = $ul.find("a[rel='next']").attr("href");
                    // console.log(url);
                    // return false;
                    btn.addClass('loading').prop('disabled', true);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(),
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $.each(response.data, function(index, element) {

                                var templateHtml = $('#companyCardTemplate').html();
                                // var templateHtml = template.html();
                                // console.log(templateHtml);
                                if (!element.profile_img) {
                                    element.profile_img =
                                        "{{ asset('images/search-result.jpg') }}";
                                }else{
                                    element.profile_img =
                                        "https://engsapp.net/images/profile/"+element.profile_img;
                                }
                                var rowHtml = templateHtml.replace(/%operatorname%/g,
                                        element.name)
                                    .replace(/%desc%/g,
                                        element.operator_profile.bio_text||''
                                    )
                                    .replace(/%url%/g, "https://engsapp.net/me/"+element.id)
                                    .replace(/%email%/g, element.email)
                                    .replace(/%profile_img%/g, element.profile_img)
                                    .replace(/%phonenumber%/g, element
                                        .country_code_phone_number + element
                                        .phone_number);
                                $('.service-result-cards').append(rowHtml);
                            });
                            $ul.find("a[rel='next']").attr("href", response.next_page_url);
                            if (response.next_page_url == null) {
                                $('.buttonContainer').remove();
                            }

                            // $(response.messages).insertAfter(
                            //     dataContainer.find("ul li.loading")
                            // );
                            // dataContainer.find("ul li.loading").removeClass("show");
                            // console.log(response);
                        },
                        complete: function() {
                            // dataContainer.find("ul li.loading").removeClass("show");
                            btn.removeAttr("disabled").removeClass('loading');
                        },
                    });

                    return false;

                });


            });

        </script>
    @endsection
</x-layout>
