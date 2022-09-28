<x-layout>
    <div class="mt-3 offer-request-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-0 px-xl-3">
                    <div class="d-flex dashboard-backbutton-container flex-column justify-content-center">
                        <a class="btn-back text-white"
                            href="{{ url()->previous() }}">{{ __('form.buttons.back') }}</a>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <x-alert />
                            <div class="bg-white justify-content-between row no-gutters pt-4 pb-3">
                                <div class="col-lg-8 col-md-12 px-4">
                                    <h1 class="font-weight-normal">{{ $service_request->title }}</h1>
                                    <div class="project-details-services mt-3">
                                        <ul class="d-flex flex-row flex-wrap ">
                                            @foreach ($service_request->requested_services as $item)
                                                <li><span>{{ $item->name }}</span></li>
                                            @endforeach
                                            <li class="date w-100">
                                                <span>{{ date('d-m-Y', strtotime($service_request->created_at)) }}</span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                @if ($service_request->service_request_stage_id == 2 && auth()->user()->user_type == 'user')
                                    <form id="acceptOfferForm"
                                        action="{{ route('user.acceptoffer', ['offer' => $offer->id, 'service_request' => $service_request->id]) }}"
                                        method="post"
                                        class="align-items-center col-lg-3 col-md-12 d-flex justify-content-center justify-content-lg-end  px-4">
                                        {{-- <input type="hidden" name="offerId" id="offerId" value="{{ $offer->id }}"> --}}
                                        <button type="submit"
                                            class="btn btn-primary btn-46 btn-accept-offer overflow-hidden">
                                            <span class="text">
                                                قبـول العرض
                                            </span>
                                            <div class="loading-animate-center border-radius-5">
                                                <div class="lds-ellipsis">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="row bg-white px-4 no-gutters">
                                <div class="col-md-12">
                                    <h1>مقدم العرض</h1>
                                </div>
                            </div>
                            <div class="row bg-white no-gutters px-4 pb-5 pt-3 mb-3">

                                <div class="col-lg-6 col-md-12">
                                    <div class="offer-user-info d-flex flex-row">
                                        <img src="{{ $offer->operator->profile_img ? route('imagecache', ['filename' => $offer->operator->profile_img, 'template' => 'profile']) : asset('images/company-logo-2.jpg') }}"
                                            alt="">
                                        <div class="d-flex flex-wrap align-items-center ml-3">
                                            <div>
                                                <div class="offer-user-info-usertype mt-1">
                                                    @if ($offer->operator->user_type == 'company')
                                                        مكتب هندسي
                                                    @else

                                                    @endif
                                                </div>
                                                <div class="offer-user-info-name mt-2">
                                                    <a
                                                        href="{{ route('freelancecompanyprofile', ['user' => $offer->operator->id]) }}">
                                                        {{ $offer->operator->name }}
                                                    </a>
                                                </div>
                                                <div class="project-details-created_at mt-3">
                                                    @if (app()->getLocale() == 'ar')
                                                        {!! arabic_date_format($offer->created_at) !!}
                                                    @else
                                                        <span title="{{ $offer->created_at }}"
                                                            class="number">{{ english_date_format($offer->created_at) . ' ago' }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-md-6 my-3 my-lg-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="project-card">
                                                <span class="project-card-text mb-2">قيمة العرض</span>
                                                <span class="project-card-value icon icon-price price">
                                                    {{ $offer->offer_price }}
                                                </span>
                                            </div>
                                        </div>
                                        @if ($service_request->service_id != 4)
                                            <div class="col-md-6">
                                                <div class="project-card">
                                                    <span class="project-card-text mb-2">مدة التنفيذ</span>
                                                    <span class="project-card-value icon icon-calendar">
                                                        {{ $offer->expected_period }}
                                                        <span class="ml-3 days">أيام</span></span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 offer-details">
                                    <p class="title">التفاصيل</p>
                                    <p class="pr-5 mt-2">
                                        {{ $offer->offer_desc }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('services_request.viewRequest_attachments',['attachments'=>
                    $offer->offer_attachments])
                    <x-service-requests.customerwarning></x-service-requests.customerwarning>
                </div>
            </div>
        </div>
    </div>
    </div>
    @section('scripts')
        <script>
            $(function() {

                var form = $("#acceptOfferForm");
                var validator = form.validate();
                form.submit(function() {
                    if (form.valid()) {
                        var btn = $(this).find("button[type='submit']");
                        btn.addClass('loading').prop('disabled', true);
                        $.ajax({
                            type: "POST",
                            url: form.attr('action'),
                            data: form.serialize(),
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.status == true) {
                                    showAlertSuccess(response.message);
                                    btn.fadeOut('normal', function() {
                                        $(this).remove();
                                    });
                                    setTimeout(function() {
                                        window.location.replace(response.redirectTo);
                                    }, 2600);
                                }
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });
                        return false;
                    }
                    return false;
                });


            });

        </script>
    @endsection
</x-layout>
