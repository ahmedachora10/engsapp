<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ route('blog.index') }}">
                {{ __('main.blogNav') }}
            </a>
        </li>
        <li class="breadcrumb-item">
            {{ $post_type == 'news' ? 'اخر الاخبار' : 'المقالات' }}
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
                        class="{{ $post_type == 'news' ? 'active' : '' }}">{{ __('main.latestnews') }}</a>
                </li>
                <li class="mr-4">
                    <a href="{{ route('blog.list', ['list_type' => 'articles']) }}" class="
                        {{ $post_type == 'articles' ? 'active' : '' }}">
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
            <div class="blog-list row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1">
                @foreach ($posts as $post)
                    <div class="col mb-4">
                        <div class="card bg-white">
                            <img class="img-fluid w-100"
                                src="{{ route('imagecache', ['template' => 'medium', 'filename' => $post->image]) }}"
                                alt="">
                            <div class="card-info d-flex flex-column justify-content-between pb-3 pt-2 px-3">
                                <div>
                                    <h5>{{ substrwords($post->title, 120) }}</h5>
                                    <span
                                        class="date mt-2 d-block">{{ date('d-m-Y', strtotime($post->post_date)) }}</span>
                                    <p class="mt-3">{{ substrwords($post->small_desc, 190) }} </p>
                                </div>
                                <a href="{{ route('blog.post', ['postId' => $post->id]) }}"
                                    class="text-right mb-2 mt-3 pr-2">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($posts->count() == 0)
                <div class="row">
                    <div class="col-lg-12 mb-5 ">
                        <div class="bg-white d-flex p-2 justify-content-center ">
                            <h5>لا يوجد بيانات لعرضها</h5>
                        </div>
                    </div>
                </div>
            @endif
            @if ($posts->total() > 12)
                <div class="row">
                    <div class="col-lg-12 mb-5 ">
                        <div class="bg-white d-flex p-2 justify-content-center ">
                            {{ $posts->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>
