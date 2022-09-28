<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    {{ $serviceName }}
                </x-slot>
            </x-user.sidebar>
            <div class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0 request-success">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5>{{ $serviceText }}</h5>
                </div>
                <div class="align-items-center bg-white d-flex flex-fill justify-content-center">
                    <div class="text-center p-3">
                        <img src="{{ asset('images/request-success.svg') }}" alt="">
                        <h1 class="mt-4">تم الإضافة بنجاح</h1>
                        <p class="mt-2">طلبك قيد المراجعة من ادارة المنصة</p>
                        <p class="mt-2">سيتم تقديم عروض من قبل المهندسين والشركات الهندسية
                            على طلبك بعد تأكيد الطلب من الادارة</p>
                        <a href="{{ $redirectTo }}" class="mt-4 mb-3 btn btn-primary has-shadow btn-46 btn-step">اغلاق</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
