<x-layout>
    <x-breadcrumb>
        <x-slot name="bookmarkStyling">
            bookmark-styling
        </x-slot>
        <li class="breadcrumb-item">
            <a href="{{ route('booksmarks.index') }}">
                المفضلة
            </a>
        </li>
    </x-breadcrumb>
    <div class="container bookmarksList">
        @include('general.bookmark_items', ['bookmarks'=> $bookmarks, 'bookmarks_empty_msg' => $bookmarks_empty_msg])
    </div>
    @section('panels')
        <div class="eg-dropdown" style="display: none;">
            <form action="{{ route('booksmarks.removebookmark') }}" id="deleteBookmark" method="post">
                @csrf
                <input type="text" style="display:none" id="bookmark_id" name="bookmark_id">
                <div class="dropdownlist-content withActions p-4">
                    <p class="text-center">إزل من المفضلة ؟</p>
                    <div class="d-flex flex-row mt-2">
                        <button type="submit" class="btn btn-primary btn-danger-color btn-30 mr-4">
                            <span class="text">نعم</span>
                            <div class="loading-animate">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </button>
                        <a href="#" class="btn btn-primary btn-gray-color btn-30 cancel-dropdown">الغاء الامر</a>
                    </div>
                </div>
            </form>
        </div>
    @endsection
    @section('scripts')
        <script>
            function populate(frm, data) {
                $.each(data, function(key, value) {
                    $('[name=' + key + ']', frm).val(value);
                });
            }



            $(document).on("click", ".btn-dropdown", function(e) {

                e.preventDefault();
                e.stopPropagation();
                if ($('.eg-dropdown').css('display') == 'block') {

                    $('.dropdownlist-content').removeClass('showActions');

                    setTimeout(function() {
                        $('.eg-dropdown').css({
                            'display': 'none',
                        });
                        $('#deleteBookmark').trigger('reset');
                    }, 250);

                    return false;
                }

                var bookmarkId = $(this).parents('.bookmark-card').attr('data-bookmark-id');

                var data = {
                    'bookmark_id': bookmarkId,
                };
                populate($('#deleteBookmark'), data);

                var position_btn = $(this).offset();
                var widthBtn = $(this).outerWidth();
                var dropdownContentWidth = $('.dropdownlist-content').outerWidth();
                var dropdownContentHeight = $('.dropdownlist-content').outerHeight();

                var centerX = position_btn.left + widthBtn / 2;


                $('.eg-dropdown').css({
                    'display': 'block',
                    'width': dropdownContentWidth,
                    'height': dropdownContentHeight
                });
                var leftside = position_btn.left - $(this).width();
                if ($('html').is(':lang(ar)')) {
                    leftside = position_btn.left;
                }


                $('.eg-dropdown').css({
                    'position': 'absolute',
                    'top': position_btn.top + $('.btn-dropdown').innerHeight() + 5,
                    'left': leftside
                });


                $('.dropdownlist-content').addClass('showActions');


            });



            $(".cancel-dropdown").on('click', function(e) {
                $('.btn-dropdown').trigger("click");
                e.preventDefault();
            });


            var formDelete = $('#deleteBookmark');
            formDelete.submit(function() {
                if (formDelete.valid()) {
                    var btn = $(this).find("button[type='submit']");
                    btn.addClass('loading').prop('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: formDelete.attr('action'),
                        data: formDelete.serialize(),
                        dataType: "json",
                        success: function(response) {
                            $('.btn-dropdown').trigger("click");
                            $('.bookmark-card[data-bookmark-id="' + response.bookmarkid + '"]').fadeOut(
                                "slow",
                                function() {
                                    $(this).remove();
                                });
                        },
                        complete: function() {
                            btn.removeAttr("disabled").removeClass('loading');
                        }
                    });

                    return false;
                }
                return false;
            });





            $(function() {
                var form = $("#searchBookmarkForm");
                var btn = $("#searchBookmarkForm").find('button[type="submit"]');
                form.submit(function() {
                    form.addClass('loading');
                    btn.attr("disabled", "disabled");
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        dataType: "html",
                        success: function(response) {
                            // showAlertSuccess(response.message);
                            // console.log(response.data);
                            var response = $.parseJSON(response);
                            // console.log(response.data);
                            $('.bookmarksList').html(response.data);
                        },
                        complete: function() {
                            form.removeClass('loading');
                            btn.removeAttr("disabled");
                        }
                    });

                    return false;
                });
            })

        </script>
    @endsection
</x-layout>
