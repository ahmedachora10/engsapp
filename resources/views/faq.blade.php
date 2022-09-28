<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('faqcontent') }}">
                {{ __('main.faq') }}
            </a>
        </li>
    </x-breadcrumb>
    <div class="faq-page">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="bg-white px-4 py-5">
                        <ul>
                            @foreach ($FAQ as $item)
                                <li>
                                    <a href="#" class="px-4 px-md-3">
                                        {{ $item->title }}
                                        <span class="plus-icon">
                                            <span class="plus-icon-1"></span>
                                            <span class="plus-icon-2"></span>
                                        </span>
                                    </a>
                                    <div class="faq-answer-box">
                                        <div class="px-3 py-4">
                                            <p class="answer-title mb-3">الاجابة</p>
                                            <p class="answer">
                                                {{ $item->answer }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(function() {
                $('.faq-page ul li a').on('click', function(e) {
                    var index = $(this).parent().index();
                    var alreadyActiveIndex = $('.faq-page ul li a.active').parent().index();
                    if ($('.faq-page ul li a.active').length > 0 && index != alreadyActiveIndex) {
                        $('.faq-page ul li a.active').next().slideToggle();
                        $('.faq-page ul li a.active').toggleClass('active');
                    }
                    e.preventDefault();
                    $(this).next().slideToggle();
                    $(this).toggleClass('active');
                    AOS.refresh();
                });
            });

        </script>
    @endsection
</x-layout>
