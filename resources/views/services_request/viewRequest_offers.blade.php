@if (auth()->user()->user_type == 'user')
    <div class="row no-gutters px-4 mb-4">
        <div class="col-lg-12">
            <p class="request-subtitle">العروض المقدمة
                <span class="totalOffers ml-2">عدد
                    <span class="font-Roboto">
                        {{ sprintf('%02d', $offers->count()) }}
                    </span>
                </span>
            </p>
        </div>
    </div>
    @if ($offers->count() == 0 && ($service_request_stage == 1 || $service_request_stage == 2))
        <div class="row no-gutters bg-white py-4 mt-3 mb-4 offer">
            <div class="col-lg-12 text-center px-4">
                @if (auth()->user()->user_type == 'user')
                    <h5>لا يوجد عروض مقدمة </h5>
                @else
                    <h5>لا يوجد عروض مقدمة <br> قم بتقديم عرض الان!</h5>
                @endif
            </div>
        </div>
    @endif
    @foreach ($offers as $offer)
        <div class="row no-gutters bg-white py-4 mt-3 mb-4 offer">
            <div class="col-lg-12 px-4">
                <div class="d-flex flex-row justify-content-between">
                    <div class="offer-user-info d-flex flex-row">
                        <img src="{{ $offer->operator->profile_img ? route('imagecache', ['filename' => $offer->operator->profile_img, 'template' => 'profile']) : asset('images/company-logo-2.jpg') }}"
                            alt="">
                        <div class="d-flex flex-wrap align-items-center ml-3">
                            <div>
                                <div class="offer-user-info-usertype">
                                    @if ($offer->operator->user_type == 'company')
                                        مكتب هندسي
                                    @else

                                    @endif
                                </div>
                                <a href="{{ route('freelancecompanyprofile', ['user' => $offer->operator->id]) }}"
                                    class="d-block offer-user-info-name mt-2">
                                    {{ $offer->operator->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="align-self-center project-details-created_at">
                        @if (app()->getLocale() == 'ar')
                            {!! arabic_date_format($offer->created_at) !!}
                        @else
                            <span title="{{ $offer->created_at }}"
                                class="number">{{ english_date_format($offer->created_at) . ' ago' }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <div class="project-card">
                            <span class="project-card-text mb-2">قيمة العرض</span>
                            <span class="project-card-value icon icon-price price">
                                {{ $offer->offer_price }}
                            </span>
                        </div>
                    </div>
                    @if ($service_id != 4)
                        <div class="col-3">
                            <div class="project-card">
                                <span class="project-card-text mb-2">مدة التنفيذ</span>
                                <span class="project-card-value icon icon-calendar">
                                    {{ $offer->expected_period }}
                                    <span class="ml-3 days">أيام</span>
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row offer-details">
                    <div class="col-lg-10">
                        <p class="mt-4">
                            {!! str_replace(PHP_EOL,'<br>',$offer->offer_desc) !!}
                        </p>
                    </div>
                    <div class="col-lg-2 d-flex align-items-end">
                        <a href="{{ route('request.offer', ['service_request' => $service_request_id, 'offer' => $offer->id]) }}"
                            class="btn btn-details">
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@elseif (isset($offerApplied))
    <div class="row no-gutters px-4 mt-5 mb-3">
        <div class="col-lg-12">
            <p class="request-subtitle">العرض المقدم </p>
        </div>
    </div>
    <div class="row no-gutters bg-white py-5 mt-3 mb-3">
        <div class="col-lg-9 px-4">
            <div class="row operatorViewOffer">
                @if (auth()->user()->user_type != 'user' && $service_request->service_request_stage_id == 1 && $service_request->deadline_date->gte(today()))
                    <form id="offerForm" action="{{ route('operator.editoffer') }}" method="POST"
                          enctype="multipart/form-data">
                        <input type="hidden" name="request_id" value="{{ $service_request->id }}">
                        <div class="row">
                            @php
                                $statusIsVisit = null;
                                if ($service_request->service_id == 4) {
                                    $statusIsVisit = $service_request->service_id == 4 && auth()->user()->user_type == 'freelancer' ? 'col-lg-6' : 'col-lg-6';
                                }
                            @endphp
                            @php
                                $original = $offerApplied->offer_price;
                                $current = $offerApplied->offer_price_total;
                                $diff = $current - $original;
                                $diff = abs($diff);
                                $percentage = ($diff / $original) * 100;
                            @endphp

                            <div class="{{ $statusIsVisit ?: 'col-lg-6' }}">
                                <div class="form-group">
                                    <label class="form-label" for="text">
                                        {{ $service_request->service_id == 4 ? 'تكلفة الزيارة' : ' مبلغ العرض' }}
                                    </label>
                                    <span class="price-tag">
                                                        <input type="text" class="form-control" id="offerCost" data-percent="{{$percentage}}"
                                                               name="offerCost" required autocomplete="off" value="{{ $offerApplied->offer_price }}"
                                                               placeholder="{{ __('form.placeholders.request.budget_min') }}">
                                                        <span class="price-curr">{{ __('form.curr') }}</span>
                                                    </span>
                                </div>
                            </div>
                            @if ($service_request->service_id != 4)
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label" for="text">مدة التنفيذ</label>
                                        <span class="has-icon date-right-icon">
                                                            <input type="text" class="form-control rule-number"
                                                                   id="workingDays" name="workingDays" required
                                                                   data-rule-number="true" value="{{ $offerApplied->expected_period }}"
                                                                   placeholder="{{ __('form.placeholders.request.expected_period') }}">
                                                        </span>
                                    </div>
                                </div>
                            @endif


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="text">  المبلغ بعد خصم نسبة المنصة
                                            <span
                                                class="font-Roboto">{{ $percentage }}%</span></label>
                                        <span class="price-tag">
                                                            <input type="text" class="form-control" id="websitePerc"
                                                                   name="websitePerc" data-webperc="{{ $percentage }}"
                                                                   readonly required autocomplete="off" value="0"
                                                                   placeholder="{{ __('form.placeholders.request.budget_min') }}">
                                                            <span class="price-curr">{{ __('form.curr') }}</span>
                                                        </span>
                                    </div>
                                </div>
                            <div class="col-6 col-lg-4">
                                <button type="submit"
                                        class="btn btn-primary has-shadow btn-46 d-inline-block">
                                    <span class="text">تعديل العرض</span>
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
                        </div>
                    </form>
                @else
                    <div class="col-lg-3">
                        <div class="project-card">
                            <span class="project-card-text mb-2">المبلغ</span>
                            <span class="project-card-value icon icon-price price">
                            {{ $offerApplied->offer_price }}
                        </span>
                        </div>
                    </div>
                    @if ($service_request->service_id != 4)
                        <div class="col-lg-3 my-3 my-lg-0 p-lg-0">
                            <div class="project-card">
                                <span class="project-card-text mb-2">مدة التنفيذ</span>
                                <span class="project-card-value icon icon-calendar">
                                {{ $offerApplied->expected_period }}
                                <span class="ml-3 days">أيام</span></span>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="project-card">
                        <span class="project-card-text mb-2">المبلغ بعد خصم نسبة
                            الموقع
                            @php
                                $original = $offerApplied->offer_price;
                                $current = $offerApplied->offer_price_total;
                                $diff = $current - $original;
                                $diff = abs($diff);
                                $percentChange = ($diff / $original) * 100;
                            @endphp
                            <span class="font-Roboto">{{ $percentChange }}%</span></label>
                        </span>
                            <span class="project-card-value icon icon-price price">
                            {{ $offerApplied->offer_price_total }}
                        </span>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="row no-gutters bg-white py-5 mt-3 mb-3">
        <div class="col-lg-11 px-4 operatorViewOffer">
            <p class="title mb-2">التفاصيل</p>
            <p class="desc">
                {!! str_replace(PHP_EOL,'<br>',$offerApplied->offer_desc) !!}

            </p>
        </div>
    </div>
    @include('services_request.viewRequest_attachments',['attachments'=>
    $offerApplied->offer_attachments])
@endif
