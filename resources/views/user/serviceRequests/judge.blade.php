<x-layout>
    <div class="container">
        <div class="row mt-3 mb-5 mx-md-0">
            <x-user.sidebar>
                <x-slot name="linkselected">
                    {{ $serviceName }}
                </x-slot>
            </x-user.sidebar>

            <form id="request-service" action="{{ route('user.serviceResults') }}" method="POST"
                class="align-items-stretch col-lg-9 d-flex flex-column p-0 pl-lg-3 mt-3 mt-lg-0">
                <input type="hidden" id="service_type" name="service_type" value="{{ $service_id }}">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <h5>{{ $serviceText }}</h5>
                </div>
                <div class="bg-white d-flex flex-column flex-fill">
                    <div class="service-request-header-block">
                        <div class="d-flex justify-content-between pt-5 px-4 pb-3">
                            <div class="text-content">
                                <h1>الرجاء تحديد البيانات المطلوب عرضها</h1>
                                <p class="mt-2">يمكنك تحديد نوع الدليل الهندسي المراد عرضه</p>
                            </div>
                            <div class="steps-container align-self-center">
                                <ul class="steps-counting d-flex align-items-center">
                                    <li class="step active" data-number="01"></li>
                                    <li class="step" data-number="02"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="checklist-step">
                        <div class="judge-service-request">
                            <div class="subservices-checklist pt-4 px-4">
                                <ul class="d-flex flex-wrap row-cols-md-2 row-cols-1">
                                    @foreach ($services as $service)
                                        <li>
                                            <div class="checkbox-control">
                                                <input class="styled-checkbox" id="service{{ $service->id }}"
                                                    type="checkbox" name="selectedservices[]"
                                                    value="{{ $service->id }}">
                                                <label for="service{{ $service->id }}">{{ $service->name }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto mb-5 px-5">
                        <button type="submit"
                            class="btn btn-primary has-shadow btn-s-50 btn-step ml-auto d-block btn-next">
                            التالي</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @section('scripts')
        <script>
            $(function() {
                $('#request-service').validate({ // initialize the plugin
                    rules: {
                        'selectedservices[]': {
                            required: true,
                        }
                    },
                    messages: {
                        'selectedservices[]': {
                            required: '{{ __('form.validatemessages.minlength_services') }}',
                        }
                    },
                    errorPlacement: function(error, element) {
                        error.addClass('mt-4').appendTo($(".subservices-checklist"));
                    }
                });
            });

        </script>
    @endsection
</x-layout>
