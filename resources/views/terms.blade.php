<x-layout>
    <x-breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{route('terms')}}">
                {{ __('main.termsconditions') }}
            </a>
        </li>
    </x-breadcrumb>
    <div class="terms-page" data-aos="fade-down-menu">
        @php $page=\App\Models\PageModel::find(1);@endphp
        <div class="container bg-white">
            <div class="col-lg-12 mb-5 p-3 p-md-5">
                <h1>{{app()->getLocale()=='ar'?$page->title_ar:$page->title_en}}</h1>
               {!! app()->getLocale()=='ar'?$page->text_ar:$page->text_en !!}
            </div>
        </div>
    </div>
</x-layout>
