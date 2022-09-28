<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar />
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-xl-3">
                <div class="d-flex flex-row flex-wrap mt-3 mt-lg-0 user-statistics">
                    {{-- <div class="d-flex flex-row user-statistics"> --}}
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-1 d-flex flex-column justify-content-center p-2 text-white yellow">
                            <div class="icon">
                                <img src="{{ asset('images/timer.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1">مشاريع مضافة في مرحلة استقبال العروض</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">05</span>
                                    <br>
                                    <span class="stat-text">
                                        انتظار
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-2 d-flex flex-column justify-content-center p-2 white">
                            <div class="icon">
                                <img src="{{ asset('images/gear.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1">مشاريع مضافة في مرحلة استقبال العروض</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">05</span>
                                    <br>
                                    <span class="stat-text">
                                        قيد الانجاز
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-3 d-flex flex-column justify-content-center p-2 text-white green">
                            <div class="icon">
                                <img src="{{ asset('images/check.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1"> مشاريع مكتلة تم تسلميها
                                    من قبل الجهة المنفذه</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">05</span>
                                    <br>
                                    <span class="stat-text">
                                        مكتمل
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 my-lg-0 px-1">
                        <div class="card card-4 d-flex flex-column justify-content-center p-2 text-white yellow">
                            <div class="icon">
                                <img src="{{ asset('images/close-outline.svg') }}" alt="">
                            </div>
                            <div class="content d-flex justify-content-between">
                                <p class="text mt-1">مشاريع تم الغائها
                                    من قبلك</p>
                                <div class="stat text-center flex-shrink-0 flex-grow-0">
                                    <span class="number">05</span>
                                    <br>
                                    <span class="stat-text">
                                        ملغية
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
                <h2 class="latest-projects-title">
                    احدث المشاريع
                </h2>
                <div class="latest-projects bg-white flex-fill">
                    <div class="table-container">
                        <table class="table table8th" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>العنوان</th>
                                    <th>الخدمة</th>
                                    <th>التاريخ</th>
                                    <th>انتهاء العروض</th>
                                    <th>الميزانية ر.س</th>
                                    <th>العروض المقدمة</th>
                                    <th>الحالة</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="roboto">01</td>
                                    <td class="font-weight-medium"> زياة فيلا سكنية زياة فيلا سكنيةزياة فيلا سكنيةزياة فيلا
                                        سكنيةرفع مخططات منزل</td>
                                    <td>تنفيذ مشروع</td>
                                    <td class="roboto">31-12-2021</td>
                                    <td class="roboto">15-01-2021</td>
                                    <td class="roboto">500-2500</td>
                                    <td class="roboto">05</td>
                                    <td class="text-left status waiting"><span>استقبال العروض</span></td>
                                    <td class="font-weight-medium"><a href="#">تفاصيل</a></td>
                                </tr>
                                <tr>
                                    <td class="roboto">01</td>
                                    <td class="font-weight-medium">رفع مخططات منزل</td>
                                    <td>طلب تحكيم</td>
                                    <td class="roboto">31-12-2021</td>
                                    <td class="roboto">15-01-2021</td>
                                    <td class="roboto">500-2500</td>
                                    <td class="roboto">05</td>
                                    <td class="text-left status canceled"><span>تم الالغاء</span></td>
                                    <td class="font-weight-medium"><a href="#">تفاصيل</a></td>
                                </tr>
                                <tr>
                                    <td class="roboto">01</td>
                                    <td class="font-weight-medium"> زياة فيلا سكنية زياة فيلا سكنيةزياة فيلا سكنيةزياة فيلا
                                        سكنيةرفع مخططات منزل</td>
                                    <td>تنفيذ مشروع</td>
                                    <td class="roboto">31-12-2021</td>
                                    <td class="roboto">15-01-2021</td>
                                    <td class="roboto">500-2500</td>
                                    <td class="roboto">05</td>
                                    <td class="text-left status working"><span>قيد الانجاز</span></td>
                                    <td class="font-weight-medium"><a href="#">تفاصيل</a></td>
                                </tr>
                                <tr>
                                    <td class="roboto">01</td>
                                    <td class="font-weight-medium"> زياة فيلا سكنية زياة فيلا سكنيةزياة فيلا سكنيةزياة فيلا
                                        سكنيةرفع مخططات منزل</td>
                                    <td>تنفيذ مشروع</td>
                                    <td class="roboto">31-12-2021</td>
                                    <td class="roboto">15-01-2021</td>
                                    <td class="roboto">500-2500</td>
                                    <td class="roboto">05</td>
                                    <td class="text-left status completed"><span>مكتمل</span></td>
                                    <td class="font-weight-medium"><a href="#">تفاصيل</a></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
