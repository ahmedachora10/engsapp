<div class="container my-3">
    <div class="row align-items-center">
        <div class="{{ isset($bookmarkStyling) ? 'col-md-5' : 'col-md-12 my-2' }}">
            <div class="breadcrumb">
                <ul class="breadcrumb" data-aos="{{ app()->getLocale() == 'ar' ? 'fade-left' : 'fade-right' }}">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <span style="width: 30px; display: inline-block;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.311" height="14.027"
                                    viewBox="0 0 18.311 14.027">
                                    <g id="computer-line" transform="translate(-1 -5)">
                                        <path id="Path_5440" data-name="Path 5440"
                                            d="M8.863,16.488V9.863h7.985L17.7,9H8v7.488h.863Z"
                                            transform="translate(-3.223 -1.842)" fill="#020621" />
                                        <path id="Path_5441" data-name="Path 5441"
                                            d="M5.079,6.079H18.027v8.632h1.079v-8.9A.809.809,0,0,0,18.3,5H4.809A.809.809,0,0,0,4,5.809v8.9H5.079Z"
                                            transform="translate(-1.381)" fill="#020621" />
                                        <path id="Path_5442" data-name="Path 5442"
                                            d="M1,25v1.834a1.4,1.4,0,0,0,1.4,1.4H17.908a1.4,1.4,0,0,0,1.4-1.4V25Zm17.264,1.834a.324.324,0,0,1-.324.324H2.381a.324.324,0,0,1-.324-.324V25.825H7.426a.885.885,0,0,0,.809.54h3.847a.885.885,0,0,0,.809-.54h5.374Z"
                                            transform="translate(0 -9.21)" fill="#020621" />
                                    </g>
                                </svg>
                            </span>
                            {{ __('main.home') }}
                        </a>
                    </li>
                    {{ $slot }}
                </ul>
            </div>
        </div>
        @isset($bookmarkStyling)
            <div class="col-md-7">
                <div class="row justify-content-end">
                    <div class="col-md-9">
                        <form id="searchBookmarkForm" action="{{ route('booksmarks.searchbookmarks') }}" method="post"
                            class="input-explore d-flex flex-row overflow-hidden" data-aos="fade-down-menu">
                            <input class="search-input flex-grow-1 px-3 ml-3" type="text" id="searchValue"
                                name="searchValue" placeholder="يمكنك البحث عن مشروع">
                            <button type="submit" class="btn-search-explore m-1">
                                بحث
                            </button>
                            <div class="loading-animate-center border-radius-5">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endisset
    </div>
</div>
