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
    </x-breadcrumb>
    <x-blogHeader>
        <span class="blog-header-text d-block d-md-inline-block mr-md-5 text-center">
            {{ __('main.blogNav') }}
        </span>
        <div class="blog-header-list  flex-fill">
            <ul class="d-flex p-md-0 py-4">
                <li class="mr-4">
                    <a href="{{ route('blog.list', ['list_type' => 'news']) }}"
                        class="">{{ __('main.latestnews') }}</a>
                </li>
                <li class="mr-4">
                    <a href="{{ route('blog.list', ['list_type' => 'articles']) }}" class="">
                        {{ __('main.articles') }}</a>
                </li>
                <li class="mr-4">
                    <a href="{{ route('blog.blogjobs') }}" class="">
                        {{ __('main.jobs') }}</a>
                </li>
            </ul>
        </div>
    </x-blogHeader>
    <div class="blog">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-8 bg-white">
                    <h5 class="mt-md-5 mt-4 mb-3">{{ __('main.latestnews') }}</h5>
                    <div class="row">
                        @foreach ($lastTwoNews as $post)
                            <div class="col-md-6 flex-fill mb-4 mb-md-0">
                                <a href="{{ route('blog.post', ['postId' => $post->id]) }}">
                                    <img class="img-fluid w-100 BigNewsImageSize"
                                        src="{{ route('imagecache', ['template' => 'medium', 'filename' => $post->image]) }}"
                                        alt="">
                                    <span class="d-block mb-1">{{ substrwords($post->title, 160) }}</span>
                                </a>
                                <p class="date py-2">{{ date('d-m-Y', strtotime($post->post_date)) }}</p>
                                <p class="pr-3">{{ substrwords($post->small_desc, 260) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <h5 class="mt-md-5 mt-4 mb-3">
                        {{ __('main.latestarticles') }}
                    </h5>
                    <div class="row">

                        @foreach ($lastThreeArticles as $post)
                            <div class="col-md-4 flex-fill mb-4 mb-md-0">
                                <a href="{{ route('blog.post', ['postId' => $post->id]) }}">
                                    <img class="img-fluid w-100 ArticlesThumbSize"
                                        src="{{ route('imagecache', ['template' => 'medium', 'filename' => $post->image]) }}"
                                        alt="">
                                    <span class="d-block mb-1">{{ substrwords($post->title, 160) }}</span>
                                </a>
                                <p class="date py-2">{{ date('d-m-Y', strtotime($post->post_date)) }}</p>
                                <p class="pr-3">{{ substrwords($post->small_desc, 260) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <h5 class="mt-md-5 mt-4 mb-3">
                        {{ __('main.mostviewed') }}
                    </h5>
                    <div class="row most-viewed">
                        @foreach ($MostViewsPosts as $post)
                            <div class="col-lg-3 col-md-4 col-6 flex-fill mb-4 mb-lg-0">
                                <a href="{{ route('blog.post', ['postId' => $post->id]) }}">
                                    <img class="img-fluid w-100"
                                        src="{{ route('imagecache', ['template' => 'medium', 'filename' => $post->image]) }}"
                                        alt="">
                                    <span class="d-block mt-1">{{ substrwords($post->title, 100) }}</span>
                                </a>
                                <p class="date py-2">{{ date('d-m-Y', strtotime($post->post_date)) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 blog-sidebar">
                    <div class="blog-sidebar-jobs bg-white ml-lg-4 mx-n3">
                        <h5 class="sidebar-title">أحدث الوظائف</h5>
                        <ul class="d-flex flex-lg-column flex-md-row flex-wrap row-cols-md-2 row-cols-lg-1">
                            @foreach ($latestJobs as $job)
                                <li class="d-flex align-items-center p-3 flex-grow-1">
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="company-logo flex-shrink-0">
                                            <img src="{{ $job->company->profile_img ? route('imagecache', ['template' => 'profile', 'filename' => $job->company->profile_img]) : asset('images/company-logo.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="flex-fill pl-4 d-flex flex-column">
                                            <span class="job-title mb-2">{{ $job->title }}</span>
                                            <span class="company-name mb-3">{{ $job->company->name }}</span>
                                            <span
                                                class="date">{{ date('d-m-Y', strtotime($job->created_at)) }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="social-list-rounded bg-white ml-lg-4 mx-n3 mt-2">
                        <p>{{ __('main.followus') }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="icon d-flex align-items-center justify-content-center gmail mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19.35" height="14.741"
                                    viewBox="0 0 19.35 14.741">
                                    <g id="gmail" transform="translate(0.001 0)">
                                        <g id="Group_15028" data-name="Group 15028" transform="translate(1.261 0)">
                                            <path id="Path_7206" data-name="Path 7206"
                                                d="M50.446,122.808l-1.235,12.4H34.374l-1-12.164,8.414,4.711Z"
                                                transform="translate(-33.379 -120.471)" fill="#fff" />
                                            <path id="Path_7207" data-name="Path 7207"
                                                d="M54.583,60.983l-8.235,7.735-8.235-7.735H54.583Z"
                                                transform="translate(-37.935 -60.983)" fill="#fff" />
                                        </g>
                                        <path id="Path_7208" data-name="Path 7208"
                                            d="M2.257,113.612v11.169H.912A.912.912,0,0,1,0,123.869v-11.9l1.474.04Z"
                                            transform="translate(-0.001 -110.04)" fill="#f14336" />
                                        <path id="Path_7209" data-name="Path 7209"
                                            d="M454.545,109.081v11.9a.913.913,0,0,1-.913.912h-1.344V110.726l.744-1.758Z"
                                            transform="translate(-435.195 -107.154)" fill="#d32e2a" />
                                        <path id="Path_7210" data-name="Path 7210"
                                            d="M19.35,61.9V62.91l-2.257,1.645L9.675,69.962,2.257,64.555,0,62.91V61.9a.913.913,0,0,1,.912-.912H1.44l8.235,6,8.235-6h.528A.913.913,0,0,1,19.35,61.9Z"
                                            transform="translate(-0.001 -60.983)" fill="#f14336" />
                                        <path id="Path_7211" data-name="Path 7211" d="M2.257,113.612,0,113.262v-1.3Z"
                                            transform="translate(-0.001 -110.04)" fill="#d32e2a" />
                                    </g>
                                </svg>
                            </a>
                            <a href="{{ $website_links->twitter }}"
                                class="icon d-flex align-items-center justify-content-center twitter mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31.58" height="31.58"
                                    viewBox="0 0 31.58 31.58">
                                    <g id="twitter" transform="translate(0 0)">
                                        <path id="Path_7204" data-name="Path 7204"
                                            d="M15.79,0A15.79,15.79,0,1,1,0,15.79,15.79,15.79,0,0,1,15.79,0Z"
                                            transform="translate(0 0)" fill="#26a6d1" />
                                        <path id="Path_7205" data-name="Path 7205"
                                            d="M82.463,83.738a7.862,7.862,0,0,1-2.211.589,3.765,3.765,0,0,0,1.692-2.067,7.8,7.8,0,0,1-2.444.907,3.9,3.9,0,0,0-2.809-1.178,3.791,3.791,0,0,0-3.847,3.733,3.624,3.624,0,0,0,.1.852,11.037,11.037,0,0,1-7.93-3.9,3.627,3.627,0,0,0-.521,1.877A3.7,3.7,0,0,0,66.2,87.656a3.912,3.912,0,0,1-1.744-.468v.047A3.767,3.767,0,0,0,67.548,90.9a3.979,3.979,0,0,1-1.014.131,3.88,3.88,0,0,1-.723-.067,3.838,3.838,0,0,0,3.6,2.594,7.867,7.867,0,0,1-4.779,1.6,8.09,8.09,0,0,1-.919-.052,11.135,11.135,0,0,0,5.9,1.679A10.707,10.707,0,0,0,80.556,86.154l-.011-.484A7.678,7.678,0,0,0,82.463,83.738Z"
                                            transform="translate(-56.802 -73.1)" fill="#fff" />
                                    </g>
                                </svg>
                            </a>
                            <a href="{{ $website_links->facebook }}"
                                class="icon d-flex align-items-center justify-content-center facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31.58" height="31.58"
                                    viewBox="0 0 31.58 31.58">
                                    <g id="facebook_3_" data-name="facebook (3)" transform="translate(0 0)">
                                        <circle id="Ellipse_200" data-name="Ellipse 200" cx="15.79" cy="15.79" r="15.79"
                                            transform="translate(0 0)" fill="#3b5998" />
                                        <path id="Path_7203" data-name="Path 7203"
                                            d="M46.929,32.045H44.111V42.367H39.842V32.045h-2.03V28.418h2.03V26.07a4,4,0,0,1,4.307-4.307l3.162.013V25.3H45.017a.869.869,0,0,0-.905.989v2.135H47.3Z"
                                            transform="translate(-27.169 -15.637)" fill="#fff" />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
