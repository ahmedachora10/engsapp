<x-layout>
    <x-slot name="linkselected">
        blog
    </x-slot>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('blog.index') }}">
                {{ __('main.blogNav') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('blog.list', ['list_type' => $post->post_type]) }}">
                {{ $post->post_type == 'news' ? 'اخر الاخبار' : 'مقالات' }}
            </a>
        </li>
        <li class="breadcrumb-item">
            التفاصيل
        </li>
    </x-breadcrumb>
    <div class="blog">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-8 p-0 post">
                    <div class="bg-white px-4">
                        <h1 class="mb-3 post-title pt-4 pt-md-5">{{ $post->title }}</h1>
                        <span class="post-date d-block mb-3">{{ date('d-m-Y', strtotime($post->post_date)) }}</span>
                        <div class="post-content pb-5">
                            {!! str_replace(PHP_EOL,'<br>',$post->content) !!}
                        </div>
                    </div>
                    <x-share :url="urlencode(\Illuminate\Support\Facades\URL::current())"/>
                    <div class="bg-white p-4 mt-4 mb-5">
                        <h1 class="">أترك تعليقك </h1>
                        <div class="pt-5 pb-5">
                            <x-alert />
                            <div class="col-12 col-md-9 m-auto">
                                <form id="comment-form" method="post"
                                    action="{{ route('blog.post.comment', ['postId' => $post->id]) }}">

                                    <div class="form-group">
                                        <label for="name">{{ __('form.name') }}</label>
                                        <span class="has-icon person-icon">
                                            <input type="text" class="form-control" id="name" name="name" required
                                                placeholder="{{ __('form.name') }}">
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('form.username') }}</label>
                                        <span class="has-icon email-icon">
                                            <input type="email" class="form-control" id="email" name="email" required
                                                placeholder="{{ __('form.placeholders.email') }}">
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">{{ __('form.message') }}</label>
                                        <textarea id="comment" name="comment" class="form-control p-3" cols="30"
                                            rows="8" placeholder="نص التعليق هنا" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button
                                            class="btn btn-primary has-shadow btnSendComment btn-s-50 font-weight-bold"
                                            type="submit">
                                            <span class="text"> {{ __('form.buttons.sendcomment') }}</span>
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
                                </form>
                            </div>
                        </div>
                        <h1 class="">التعليقات</h1>
                        <div class="comments">
                            <ul class="pt-5">
                                @if ($post->comments->count() == 0)
                                    <li class="empty-comments">
                                        <p class="name">لا يوجد تعليقات</p>
                                    </li>
                                @endif
                                @foreach ($post->comments as $comment)
                                    @include('blog.postcomment', ['comment'=> $comment] )
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 blog-sidebar">
                    <div class="blog-sidebar-news bg-white ml-lg-4 mx-n3">
                        <h5 class="sidebar-title">أحدث الوظائف</h5>
                        <ul class="d-flex flex-lg-column flex-md-row flex-wrap row-cols-md-2 row-cols-lg-1">
                            @foreach ($latestJobs as $job)
                                <li class="d-flex align-items-center p-3 flex-grow-1">
                                    <a href="{{route('job.details',$job->id)}}" class="d-flex align-items-center">
                                        <div class="post-img flex-shrink-0">
                                            <img src="{{ $job->company->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $job->company->profile_img]) : asset('images/company-logo.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="flex-fill pl-4 d-flex flex-column">
                                            <span class="post-title mb-2">{{ $job->title }}</span>
                                            <p class="date">{{ date('d-m-Y', strtotime($job->created_at)) }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="social-list-counters bg-white ml-lg-4 mx-n3 mt-2 p-3 py-5">
                        <p class="mb-3">{{ __('main.followus') }}</p>
                        <div class="d-flex justify-content-center">
                            <div class="box-container pr-1">
                                <a href="{{ $website_links->instagram }}"
                                    class="box insta-box align-items-center d-flex  justify-content-center">
                                    <svg id="Group_15053" data-name="Group 15053" xmlns="http://www.w3.org/2000/svg"
                                        width="31.639" height="31.639" viewBox="0 0 31.639 31.639">
                                        <ellipse id="Ellipse_149" data-name="Ellipse 149" cx="12.876" cy="14.047"
                                            rx="12.876" ry="14.047" transform="translate(2.796 1.575)" fill="#224d5c" />
                                        <g id="instagram_1_" data-name="instagram (1)" transform="translate(0 0)">
                                            <path id="Path_908" data-name="Path 908"
                                                d="M213.056,210.028A3.028,3.028,0,1,1,210.028,207,3.028,3.028,0,0,1,213.056,210.028Zm0,0"
                                                transform="translate(-194.209 -194.209)" fill="#fff" />
                                            <path id="Path_909" data-name="Path 909"
                                                d="M150.013,137.578a3.009,3.009,0,0,0-1.724-1.724,5.027,5.027,0,0,0-1.687-.313c-.958-.044-1.245-.053-3.671-.053s-2.713.009-3.671.053a5.03,5.03,0,0,0-1.687.313,3.01,3.01,0,0,0-1.724,1.724,5.029,5.029,0,0,0-.313,1.687c-.044.958-.053,1.245-.053,3.671s.009,2.713.053,3.671a5.028,5.028,0,0,0,.313,1.687,3.008,3.008,0,0,0,1.724,1.724,5.02,5.02,0,0,0,1.687.313c.958.044,1.245.053,3.67.053s2.713-.009,3.671-.053a5.021,5.021,0,0,0,1.687-.313,3.009,3.009,0,0,0,1.724-1.724,5.033,5.033,0,0,0,.313-1.687c.044-.958.053-1.245.053-3.671s-.009-2.713-.053-3.671A5.021,5.021,0,0,0,150.013,137.578ZM142.932,147.6a4.665,4.665,0,1,1,4.665-4.665A4.664,4.664,0,0,1,142.932,147.6Zm4.849-8.423a1.09,1.09,0,1,1,1.09-1.09A1.09,1.09,0,0,1,147.781,139.177Zm0,0"
                                                transform="translate(-127.113 -127.116)" fill="#fff" />
                                            <path id="Path_910" data-name="Path 910"
                                                d="M15.819,0A15.819,15.819,0,1,0,31.639,15.819,15.821,15.821,0,0,0,15.819,0Zm9.029,19.564a6.665,6.665,0,0,1-.422,2.205,4.645,4.645,0,0,1-2.657,2.657,6.669,6.669,0,0,1-2.2.422c-.969.044-1.278.055-3.745.055s-2.776-.011-3.745-.055a6.669,6.669,0,0,1-2.2-.422,4.645,4.645,0,0,1-2.657-2.657,6.663,6.663,0,0,1-.422-2.2c-.045-.969-.055-1.278-.055-3.745s.01-2.776.055-3.745a6.665,6.665,0,0,1,.422-2.205A4.648,4.648,0,0,1,9.869,7.213a6.671,6.671,0,0,1,2.205-.422c.969-.044,1.278-.055,3.745-.055s2.776.011,3.745.055a6.672,6.672,0,0,1,2.205.422,4.646,4.646,0,0,1,2.657,2.657,6.664,6.664,0,0,1,.422,2.205c.044.969.055,1.278.055,3.745S24.893,18.6,24.848,19.564Zm0,0"
                                                fill="#fff" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div class="box-container pr-1">
                                <a href="{{ $website_links->twitter }}"
                                    class="box twitter-box align-items-center d-flex  justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="41.386" height="41.386"
                                        viewBox="0 0 41.386 41.386">
                                        <g id="twitter" transform="translate(0 0)">
                                            <path id="Path_7204" data-name="Path 7204"
                                                d="M20.693,0A20.693,20.693,0,1,1,0,20.693,20.693,20.693,0,0,1,20.693,0Z"
                                                transform="translate(0 0)" fill="#26a6d1" />
                                            <path id="Path_7205" data-name="Path 7205"
                                                d="M88.287,84.281a10.3,10.3,0,0,1-2.9.772,4.934,4.934,0,0,0,2.218-2.709,10.223,10.223,0,0,1-3.2,1.188,5.108,5.108,0,0,0-3.681-1.544,4.969,4.969,0,0,0-5.041,4.893A4.749,4.749,0,0,0,75.813,88,14.465,14.465,0,0,1,65.42,82.883a4.753,4.753,0,0,0-.683,2.46,4.853,4.853,0,0,0,2.243,4.073,5.127,5.127,0,0,1-2.285-.613v.062a4.937,4.937,0,0,0,4.045,4.8,5.215,5.215,0,0,1-1.328.172,5.084,5.084,0,0,1-.948-.088,5.029,5.029,0,0,0,4.712,3.4,10.309,10.309,0,0,1-6.263,2.1,10.6,10.6,0,0,1-1.2-.068,14.593,14.593,0,0,0,7.731,2.2A14.032,14.032,0,0,0,85.787,87.447l-.014-.634A10.063,10.063,0,0,0,88.287,84.281Z"
                                                transform="translate(-54.658 -70.34)" fill="#fff" />
                                        </g>
                                    </svg>

                                </a>
                            </div>
                            <div class="box-container pr-1">
                                <a href="{{ $website_links->facebook }}"
                                    class="box facebook-box align-items-center d-flex  justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.728" height="25.765"
                                        viewBox="0 0 13.728 25.765">
                                        <g id="facebook-logo_1_copy_5" data-name="facebook-logo (1) copy 5"
                                            transform="translate(-0.02)">
                                            <path id="Path"
                                                d="M13.211.005,9.918,0c-3.7,0-6.09,2.489-6.09,6.341V9.264H.518A.522.522,0,0,0,0,9.79v4.236a.522.522,0,0,0,.518.525H3.828V25.24a.521.521,0,0,0,.518.525H8.665a.522.522,0,0,0,.518-.525V14.551h3.871a.521.521,0,0,0,.518-.525l0-4.236a.53.53,0,0,0-.152-.372.514.514,0,0,0-.366-.154H9.183V6.786c0-1.191.28-1.8,1.809-1.8H13.21a.522.522,0,0,0,.517-.525V.531A.522.522,0,0,0,13.211.005Z"
                                                transform="translate(0.02)" fill="#fff" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            // $(function() {
            //     $('#comment-form').validate();
            // });

            $(function() {
                var form = $("#comment-form");
                var validator = form.validate();
                $('.btnSendComment').on('click', function(e) {

                    if (form.valid()) {
                        var btn = $(this);
                        btn.addClass('loading');
                        btn.attr("disabled", "disabled");
                        $.ajax({
                            type: "POST",
                            url: form.attr('action'),
                            data: form.serialize(),
                            dataType: "json",
                            success: function(response) {
                                showAlertSuccess(response.message);
                                form.trigger("reset");
                                validator.resetForm();
                            },
                            complete: function() {
                                btn.removeAttr("disabled").removeClass('loading');
                            }
                        });
                        e.preventDefault();
                    }
                });


            });

        </script>
    @endsection
</x-layout>
