<!--begin::Header-->
<div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top"
    style="background-image: url({{ asset('adminAssets/assets/media/misc/bg-1.jpg') }})">

    <!--begin::Title-->
    <h4 class="d-flex flex-center rounded-top">
        <span class="text-white">الاشعارات</span>
        {{-- <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span> --}}
    </h4>

    <!--end::Title-->

    <!--begin::Tabs-->
    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8"
        role="tablist">
        {{-- <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Alerts</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link active show" id="unreadNotificationHeader" data-toggle="tab"
                href="#topbar_notifications_events">تنبيهات جديدة
                ({{ auth()->user()->unreadNotifications->count() }})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs">التنبيهات</a>
        </li>
    </ul>

    <!--end::Tabs-->
</div>

<!--end::Header-->

<!--begin::Content-->
<div class="tab-content">

    <!--begin::Tabpane-->
    <div class="tab-pane active show" id="topbar_notifications_events" role="tabpanel">

        <!--begin::Nav-->
        <div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
            @include('layouts.admin.partials._extras.dropdown.unreadNotificationItem', ['unreadNotifications' =>
            auth()->user()->unreadNotifications])
        </div>
        <div class="d-flex flex-center mb-3">
            <button class="btn btn-light-primary font-weight-bold text-center " id="BtnNotificationMarked">تحويل
                المحدد الى مقروء</button>
            <button class="btn btn-secondary font-weight-bold text-center ml-3" id="BtnNotificationMarkAll">تحويل
                الكل </button>
        </div>
        <!--end::Nav-->
    </div>

    <!--end::Tabpane-->

    <!--begin::Tabpane-->
    <div class="tab-pane " id="topbar_notifications_logs" role="tabpanel">
        <!--begin::Nav-->
        <div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
            @include('layouts.admin.partials._extras.dropdown.notificationItem', ['notifications' =>
            auth()->user()->notifications ])
        </div>
        <!--end::Nav-->

    </div>

    <!--end::Tabpane-->
</div>

<!--end::Content-->

@push('scripts')
    <script>
        $(function() {
            // alert('test');
            $('#BtnNotificationMarked').on('click', function(e) {

                var adminNotification = $('#adminNotifications');

                var btn = KTUtil.getById($(this).attr('id'));
                KTUtil.btnWait(btn, "spinner spinner-left spinner-white", "يرجى الانتظار ...");

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.notifications.markSelected') }}",
                    data: adminNotification.serialize(),
                    dataType: "json",
                    success: function(response) {
                        renderNotificatins(response);

                    },
                    complete: function() {
                        KTUtil.btnRelease(btn);
                    }
                });
                e.preventDefault();

            });

            function renderNotificatins(data) {
                $('#topbar_notifications_events').find('.notifications-content').html(
                    data.unreadNotifications);
                if ($('.NoNewNotifications').length > 1) {
                    $('#topbar_notifications_events').find('.notifications-content').html('');
                }
                $('#unreadNotificationHeader').html(data.unreadCount);
                $('#topbar_notifications_logs').find('.notifications-content').html(data.notifications);
                if ($('.NoNotifications').length > 1) {
                    $('#topbar_notifications_logs').find('.notifications-content').html('');
                }
            }

            $('#BtnNotificationMarkAll').on('click', function(e) {
                // console.log(adminNotification);
                var btn = KTUtil.getById($(this).attr('id'));
                KTUtil.btnWait(btn, "spinner spinner-left spinner-dark", "يرجى الانتظار ...");

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.notifications.markAll') }}",
                    dataType: "json",
                    success: function(response) {
                        renderNotificatins(response);
                    },
                    complete: function() {
                        KTUtil.btnRelease(btn);
                    }
                });
                e.preventDefault();

            })
        });

    </script>
@endpush
