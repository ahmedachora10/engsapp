<div class="customPanel" {{ $attributes }}>
    <div class="customPanel-layout d-flex flex-column flex-fill h-100 bg-white">
        <x-alert />
        <div class="align-items-end d-flex customPanel-backbutton flex-column justify-content-center">
            <a class="btn-back text-white close-panel" href="#">{{ __('form.buttons.back') }}</a>
        </div>
        <div class="d-flex flex-fill overflowifneeded" data-simplebar   {{ app()->getLocale() == 'ar' ? 'data-simplebar-direction=rtl' : '' }}>
            <div class="container">
                <div class="row justify-content-center mt-5">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
