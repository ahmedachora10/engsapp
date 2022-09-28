<div class="service-warning">
    <div {{ $attributes }}>
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row service-warningTopPadding">
                    <div class="col-lg-5 col-md-12 d-flex justify-content-center" data-aos="fade-down">
                        @include('svgImages.service-warning')
                    </div>
                    <div class="col-lg-7 col-md-12 mt-4 mt-lg-0">
                        <h5 class="text-yellow-color" data-aos="fade-down" data-aos-delay="250">
                            {{ $title }}
                        </h5>
                        <h1 data-aos="fade-down" data-aos-delay="100">
                            {{ $subtitle }}
                        </h1>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
