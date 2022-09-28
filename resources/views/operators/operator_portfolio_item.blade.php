<div class="col-md-4 text-center d-flex flex-wrap justify-content-center mb-4 workCard" data-work-id="{{ $work->id }}">
    <div class="portfolio-card">
        @isset($CanDelete)
            <a href="" class="BtnDelete btn-dropdown"></a>
        @endisset
        @if(!ends_with($work->hashName,'.pdf'))

                <a href="{{ asset('user_files/' . $work->hashName) }}" data-caption="{{ $work->title }}"
                   data-fancybox="gallery">
                    <img src="{{ route('imagecache', ['template' => 'work', 'filename' => $work->hashName]) }}" alt="">
                </a>
        @else
                <a href="{{ asset('user_files/' . $work->hashName) }}" data-caption="{{ $work->title }}"
                   data-fancybox="gallery">
                    <img data-pdf-thumbnail-file="{{ asset('user_files/' . $work->hashName) }}" class="pdf-img" src="{{ asset('user_files/pdf2.png') }}">
                </a>

        @endif

    </div>
    <p class="title-works px-3 px-lg-5">
        {{ $work->title }}
    </p>
</div>
