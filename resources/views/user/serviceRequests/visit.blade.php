<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    {{ $serviceName }}
                </x-slot>
            </x-user.sidebar>

            <form id="request-service" action="{{ route('user.request.visit') }}" enctype="multipart/form-data"
                method="POST"
                class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0 licence-request step-1">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5>{{ $serviceText }}</h5>
                </div>
                <div class="bg-white d-flex flex-column flex-fill">
                    <div class="service-request-header-block">
                        <div class="d-flex justify-content-between pt-5 px-4 pb-3">
                            <div class="text-content">
                                <h1>الرجاء تحديد نوع الخدمة</h1>
                                <p class="mt-2">خدمة الاستلام هي خدمة استرشادية لاتتضمن تقارير معتمدة وانما مجرد استلام من الموقع من قبل مهندس مختص</p>
                            </div>
                            <div class="steps-container align-self-center">
                                <ul class="steps-counting d-flex align-items-center">
                                    <li class="step active" data-number="01"></li>
                                    <li class="step" data-number="02"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="request-service-slider ">

                            <div class="subservices-checklist pt-4 px-4">
                                <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1 mb-4">
                                    @foreach ($services as $service)
                                        <li>
                                            <div class="checkbox-control">
                                                <input class="styled-checkbox" id="service{{ $service->id }}"
                                                    type="checkbox" data-error="#errNm2" name="selectedservices[]"
                                                    value="{{ $service->id }}">
                                                <label for="service{{ $service->id }}">
                                                    <span>{{ $service->name }}</span>
                                                    <br>
                                                    <small style="color: #565050;font-size: 0.7rem;padding: 0 42px;display: block;">{{$service->decription}}</small>
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <span id="errNm2"></span>
                            </div>
                            <div class="pt-4 px-4">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="text">عنوان الزيارة</label>
                                        <input type="text" class="form-control" id="title" name="title" required
                                            placeholder="{{ __('form.placeholders.request.project_name') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label"
                                            for="text">{{ __('form.request.offers_deadline') }}</label>
                                        <span class="has-icon-left date-left-icon">
                                            <input type="text" class="form-control date-picker" id="deadlineDate"
                                                name="deadlineDate" required autocomplete="off"
                                                placeholder="{{ date('d-m-Y') }}">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">عنوان موقع الزيارة</label>
                                    <textarea id="address" name="address" class="form-control p-3" cols="30" rows="8"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="text">{{ __('form.request.request_attachemnts') }}</label>
                                    <div class="custom-file has-icon attachment-icon">
                                        <input type="file" class="custom-file-input" id="projectFiles" multiple
                                               name="projectFiles[]">
                                        <label class="custom-file-label"
                                               for="projectFiles">{{ __('form.placeholders.request.request_attachemnts') }}</label>
                                    </div>
                                </div>
                                <div class="form-group mb-5">
                                    <label for="location">تحديد احداثيات الموقع
                                        <span class="locationPosition">قم بالسماح للمتصفح من تحديد موقع ثم <a
                                                href="#">اضغط هنا </a></span>
                                    </label>
                                    <input type="hidden" name="location" id="latlng" required data-error="#errNm1">
                                    <div id="mapid" class="w-100" style="height: 256px;"></div>
                                    <span id="errNm1"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center mb-4 mt-auto px-5 text-center">
                        <a href="#" class="btn btn-46 btn-step d-inline-block btn-prev mr-3">
                            رجوع</a>
                        <button type="submit"
                            class="btn btn-primary has-shadow btn-46 btn-step d-inline-block btn-next">
                            <span class="text">التالي</span>
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

        </div>
    </div>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.standalone.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin="" />
    @endsection
    @section('scripts')
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.ar.min.js') }}"></script>
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
        <script>


        </script>
        <script>
            $(function() {





                $('[dir="rtl"] .date-picker').datepicker({
                    rtl: true,
                    format: "dd-mm-yyyy",
                    startDate: "{{ date('d-m-Y') }}",
                    language: "ar",
                    orientation: "bottom auto",
                    autoclose: true,
                    todayHighlight: true
                });
                $('[dir="ltr"] .date-picker').datepicker({
                    format: "dd-mm-yyyy",
                    orientation: "bottom auto",
                    startDate: "{{ date('d-m-Y') }}",
                    autoclose: true,
                    todayHighlight: true
                });

                $.validator.addMethod("selectnic", function(value, element) {
                    return $(".styled-checkbox:checkbox:checked").length > 0;
                }, '{{ __('form.validatemessages.minlength_services') }}');

                // jQuery.validator.addMethod("filesize_max", function(value, element, param) {
                //     var isOptional = this.optional(element),
                //         file;

                //     if (isOptional) {
                //         return isOptional;
                //     }

                //     if ($(element).attr("type") === "file") {
                //         if (element.files && element.files.length) {

                //             // file = element.files[0] / 1024 / 1024;
                //             file = element.files[0];
                //             console.log('file.size', (file.size / 1024 / 1024));
                //             console.log('param', param);
                //             return (file.size && file.size <= param);
                //         }
                //     }
                //     return false;
                // }, "File size is too large.");


                $.validator.addMethod("dateFormat", function(value, element) {
                    var date_regex = /^(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-](19|20)\d\d$/;
                    console.log(value);
                    if (!(date_regex.test(value))) {
                        return false;
                    }
                    return true;
                }, '{{ __('form.validatemessages.dateFormat') }}');

                var form = $("#request-service");



                var validator = form.validate({
                    ignore: [],
                    rules: {
                        'selectedservices[]': {
                            selectnic: true,
                        },
                        'projectFiles[]': {
                            extension: "jpg|pdf|png|dwg|jpeg|doc|docx"
                            // filesize_max: 12
                        },
                        // budgetMin: {
                        //     min: 0
                        // },
                        deadlineDate: {
                            dateFormat: true,
                        },
                        // budgetMax: {
                        //     min: function() {
                        //         return $("#budgetMin").val();
                        //     }
                        // }
                    },
                    messages: {
                        location: "{{ __('form.validatemessages.setlocation') }}",
                    },
                    showErrors: function(errorMap, errorList) {
                        this.defaultShowErrors();

                        var slideHeight = $('.request-service-slider').find(".slick-list").find(
                            '.slick-active').outerHeight();
                        $('.request-service-slider').find('.slick-list').height(slideHeight);
                        $('.request-service-slider').slick("setOption", null, null, true);
                    },
                    errorPlacement: function(error, element) {
                        console.log(element, error);
                        var placement = $(element).data('error');
                        if (placement) {
                            $(placement).append(error)
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
                // validator.element( "#myselect" );

                $('.btn-next').on('click', function(e) {
                    // validator.valid();
                    // console.log(form.valid());
                    if (form.hasClass('step-1')) {
                        console.log(validator.element(".styled-checkbox"));
                        if (validator.element(".styled-checkbox") == false) {
                            return false;
                        } else {
                            form.removeClass('step-1').addClass('step-2');
                            $('.steps-counting li').eq(0).addClass('filled');
                            $('.steps-counting li').eq(1).addClass('active');
                            $(".btn-prev").addClass("shown");
                            $(".request-service-slider").slick("slickNext");
                            return false;
                        }
                    }
                    //

                });

                form.submit(function() {
                    if (form.valid())
                        $(this).find("button[type='submit']").addClass('loading').prop('disabled', true);
                });

                $('.btn-prev').on('click', function(e) {

                    form.removeClass('step-2').addClass('step-1');
                    $('.steps-counting li').eq(0).removeClass('filled');
                    $('.steps-counting li').eq(1).removeClass('active');
                    $(".request-service-slider").slick("slickPrev");
                    $(this).removeClass('shown');
                    return false;
                });


                $("#deadlineDate").change(function() {
                    validator.element("#deadlineDate");
                });


                $("#projectFiles").change(function() {
                    validator.element("#projectFiles");
                });

                var mymap = L.map('mapid').fitBounds([
                    [28.63274679922588, 36.29882812500001],
                    [21.14599216495789, 58.09570312500001]
                ])

                L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        // maxZoom: 18,
                        // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                        //     'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        // id: 'mapbox/streets-v11',
                        // tileSize: 512,
                        // zoomOffset: -1
                        maxNativeZoom: 19,
                        maxZoom: 25
                    }).addTo(mymap);

                var markers = L.layerGroup();
                // var myIcon = L.divIcon({
                //     className: 'my-div-icon'
                // });
                var myIcon = L.icon({
                    iconUrl: "{{ asset('images/marker-2.png') }}",
                    iconSize: [38, 38],
                    // iconAnchor: [22, 94],
                    // popupAnchor: [-3, -76],
                    // shadowUrl: 'my-icon-shadow.png',
                    // shadowSize: [68, 95],
                    // shadowAnchor: [22, 94]
                });

                // var myIcon = L.divIcon({
                //     iconSize: null,
                //     html: '<div class="markerIcon"></div>'
                // });

                function onLocationFound(e) {
                    var radius = e.accuracy / 2;

                    var marker2 = L.marker(e.latlng, {
                        icon: myIcon
                    });
                    var latlngInput = document.getElementById('latlng');
                    latlngInput.value = e.latlng.lat + "," + e.latlng.lng;
                    // .bindPopup("You are within " + radius + " meters from this point");
                    markers.addLayer(marker2);
                    mymap.addLayer(markers);
                    marker2.openPopup();
                    $('.locationPosition').css('display', 'none');
                }

                function onLocationError(e) {
                    console.log(e.message);
                    $('.locationPosition').css('display', 'block');
                }

                mymap.on('locationfound', onLocationFound);
                mymap.on('locationerror', onLocationError);

                mymap.locate({
                    setView: true,
                    // maxZoom: 25
                });

                $('.locationPosition a').on('click', function(e) {
                    e.preventDefault();
                    mymap.locate({
                        setView: true,
                    });
                });




                function onMapClick(e) {
                    // alert("You clicked the map at " + e.latlng);
                    // markers.eachLayer(function(layer) {
                    //     console.log(layer);
                    // });
                    markers.clearLayers();

                    console.log(e.latlng);
                    var marker = L.marker([e.latlng.lat, e.latlng.lng], {
                        icon: myIcon
                    });
                    var latlngInput = document.getElementById('latlng');
                    latlngInput.value = e.latlng.lat + "," + e.latlng.lng;
                    markers.addLayer(marker);
                    mymap.addLayer(markers);
                    validator.element("#latlng");
                    // mymap.removeLayer(marker);
                }

                mymap.on('click', onMapClick);
                mymap.zoomControl.setPosition('bottomleft');

            });

        </script>
    @endsection
</x-layout>
