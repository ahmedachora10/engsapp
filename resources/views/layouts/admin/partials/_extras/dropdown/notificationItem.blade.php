@if ($notifications->count() == 0)
    <div class="d-flex flex-center text-center text-muted min-h-200px NoNotifications">لا يوجد
        <br />تنبيهات لعرضها
    </div>
@endif
<div class="notifications-content">
    @foreach ($notifications as $notification)
        <div class="mb-6 px-5">
            <!--begin::Content-->
            <div class="d-flex align-items-center {{ $notification->read_at ? '' : 'bg-light-warning' }} flex-grow-1">
                <!--begin::Checkbox-->
                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">

                </label>
                <!--end::Checkbox-->
                <!--begin::Section-->
                <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                    <!--begin::Info-->
                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                        <!--begin::Title-->
                        <a href="#"
                            class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{ $notification->data['title'] }}</a>
                        <!--end::Title-->
                        <span class="text-muted font-weight-bolder d-flex flex-row align-items-center"><i
                                class="icon-xl la la-clock"></i>
                            {{ $notification->created_at }}</span>
                        <!--begin::Data-->
                        <span class="text-muted font-weight-bold">
                            {{ $notification->data['message'] }}
                        </span>
                        <!--end::Data-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Label-->
                    <!--end::Label-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Content-->
        </div>
    @endforeach
</div>
