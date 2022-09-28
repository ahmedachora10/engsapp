// const { default: axios } = require("axios");

window.initAlertbox = function () {
    var message = $("#alert-box");
    var messageClass = $(".alert-box-class");
    if (!message.parent().hasClass("alert-custom"))
        message.parent().addClass("alert-custom");
    $.each(messageClass, function (i, el) {
        if (!$(el).parent().hasClass("alert-custom")) {
            $(el).parent().addClass("alert-custom");
        }
    });
};

window.showAlertSuccess = function (text) {
    var message = $("#alert-box");
    message.find(".alert-msg").html(text);
    $(".alert-custom").addClass("alert-show");
    setTimeout(function () {
        $(".alert-custom").removeClass("alert-show");
    }, 2500);
};

window.showAlertSuccessClass = function (text) {
    var message = $(".alert-box-class");
    message.find(".alert-msg").html(text);
    $(".alert-custom").addClass("alert-show");
    setTimeout(function () {
        $(".alert-custom").removeClass("alert-show");
    }, 2500);
};

window.showAlertError = function (text) {
    var message = $("#alert-box");
    message.find(".alert-msg").html(text);
    $(".alert-custom").addClass("alert-error");
    setTimeout(function () {
        $(".alert-custom").removeClass("alert-error");
    }, 2500);
};

window.updateAccountProgress = function (perc) {
    var accountProgressBar = $("#accountProgress");
    var accountProgressText = $("#accountProgressText");
    accountProgressBar.addClass("perc-" + perc);
    accountProgressText.html(perc + "%");
};

window.updateBankInfoProgress = function (imgStatusUrl) {
    var bankInfoStatus = $("#bankInfoStatus");
    bankInfoStatus.attr("src", imgStatusUrl);
};

window.updateBioProgress = function (imgStatusUrl) {
    var BioProgressStatus = $("#BioProgressStatus");
    BioProgressStatus.attr("src", imgStatusUrl);
};

window.updateUserActiveStatus = function (imgStatusUrl) {
    var UserActiveStatus = $("#UserActiveStatus");
    UserActiveStatus.attr("src", imgStatusUrl);
};

window.openPanel = function (panelId) {
    $("#" + panelId).css("display", "block");
    setTimeout(function () {
        $("#" + panelId).addClass("show");
        $("body").addClass("disable-scroll");
    }, 50);
};

window.closePanel = function (panelId) {
    $("#" + panelId).removeClass("show");
    setTimeout(function () {
        $("#" + panelId).css("display", "none");
        $("body").removeClass("disable-scroll");
    }, 700);
};

$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    initAlertbox();
    // $(window).on("focus", function () {
    //     // Append this text to the `body` element.
    //     console.log(windowFocusedEvent);
    // });

    // $(window).bind("focus",function(event){
    //     focusFlag = 1;
    // })
    // window.addEventListener("load", AOS.refresh);

    bsCustomFileInput.init();
    $(".licence-services .tabs .tab").on("click", function (e) {
        e.preventDefault();
        $(".licence-services .tabs .tab").removeClass("selected");
        $(this).addClass("selected");
        console.log($(this).attr("id"));
        $(".tabs-content .tab").fadeOut();
        $(".tabs-content ." + $(this).attr("id")).fadeIn();
    });

    $('[dir="rtl"] .subs-slider').slick({
        rtl: true,
        infinite: false,
        arrows: false,
        swipe: false,
        // adaptiveHeight: true,
        centerMode: true,
        // centerPadding: "20px",
        slidesToShow: 1,
        variableWidth: true,
        initialSlide: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    swipe: true,
                },
            },
        ],
        // fade: true,
    });

    $("#searchValue").on("keypress", function (e) {
        var character = String.fromCharCode(event.keyCode).toLowerCase();
        return isLetter(character) == null ? false : true;
    });

    function isLetter(str) {
        return (
            (str.length === 1 && str.match(/[a-z]/i)) ||
            str.match(/[\u0600-\u06FF]/) ||
            str.match(
                /[\t\n\v\f\r \u00a0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000]/
            )
        );
    }

    $(".login-slider").on("init", function (event, slick) {
        AOS.refresh();
    });

    $('[dir="rtl"] .login-slider').slick({
        slidesToShow: 1,
        rtl: true,
        infinite: true,
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    $('[dir="ltr"] .login-slider').slick({
        slidesToShow: 1,
        rtl: false,
        infinite: true,
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    $('[dir="ltr"] .subs-slider').slick({
        rtl: false,
        infinite: false,
        arrows: false,
        swipe: false,
        // adaptiveHeight: true,
        centerMode: true,
        // centerPadding: "20px",
        slidesToShow: 1,
        variableWidth: true,
        initialSlide: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    swipe: true,
                },
            },
        ],
        // fade: true,
    });

    $(".open-panel").on("click", function (e) {
        var panelId = $(this).attr("data-panel-id");
        $("#" + panelId).css("display", "block");
        setTimeout(function () {
            $("#" + panelId).addClass("show");
            $("body").addClass("disable-scroll");
        }, 50);

        e.preventDefault();
    });

    // $(".close-panel").on("click", function (e) {
    //     var customPanelLayoutId = $(this).closest(".customPanel");
    //     $(customPanelLayoutId).removeClass("show");
    //     setTimeout(function () {
    //         customPanelLayoutId.css("display", "none");
    //         $("body").removeClass("disable-scroll");
    //     }, 700);
    //     e.preventDefault();
    // });

    $(".menu-hash-nav").on("click", function (e) {
        var dataId = $(this).attr("data-hash-id");

        if ($("#" + dataId).length) {
            e.preventDefault();
            console.log(dataId);
            $("html, body").animate(
                {
                    scrollTop: $("#" + dataId).offset().top - 50,
                },
                1200
            );
        }
    });
    $("#menuToggle").on("click", function (e) {
        $(this).toggleClass("active");
        $(".mobile-menu").toggleClass("active");
        $("body").toggleClass("disable-scroll");
        setTimeout(function () {
            AOS.refresh();
        }, 800);
    });
    // $(".mobile-menu ul li a").on("click", function (e) {
    //     $(".mobile-menu").toggleClass("active");
    //     $("body").toggleClass("disable-scroll");
    // });

    $(".go-top").on("click", function (e) {
        e.preventDefault();
        console.log("test");
        $("html, body").animate(
            {
                scrollTop: $("body").offset().top,
            },
            1200
        );
    });

    // $('.hero__scroll').on('click', function(e) {
    //     $('html, body').animate({
    //         scrollTop: $(window).height()
    //     }, 1200);
    // });

    $(".register-form").on("init", function (event, slick) {
        AOS.refresh();
    });

    $(".request-service-slider").on("init", function (event, slick) {
        AOS.refresh();
    });

    $('[dir="rtl"] .register-form').slick({
        rtl: true,
        infinite: false,
        arrows: false,
        swipe: false,
        adaptiveHeight: true,
        // fade: true,
    });

    $('[dir="rtl"] .request-service-slider').slick({
        rtl: true,
        infinite: false,
        arrows: false,
        swipe: false,
        adaptiveHeight: true,
        // initialSlide: 1,
        // fade: true,
    });
    $('[dir="ltr"] .request-service-slider').slick({
        rtl: false,
        infinite: false,
        arrows: false,
        swipe: false,
        adaptiveHeight: true,
        // fade: true,
    });

    $('[dir="ltr"] .register-form').slick({
        infinite: false,
        swipe: false,
        arrows: false,
        adaptiveHeight: true,
    });

    $('[dir="rtl"] .slider-imgs, [dir="rtl"] .slider-content').slick({
        rtl: true,
        // infinite: false,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        swipe: false,
        fade: true,
        adaptiveHeight: true,
        // fade: true,
    });

    $('[dir="ltr"] .slider-imgs, [dir="ltr"] .slider-content').slick({
        rtl: false,
        // infinite: false,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        swipe: false,
        fade: true,
        adaptiveHeight: true,
        // fade: true,
    });

    $(".slider-nav ul li a").on("click", function (e) {
        e.preventDefault();
        var tabHeader = $(this).parent();
        var slideIndex = tabHeader.index();
        $(".slider-nav ul").find("a").removeClass("active");
        $(this).addClass("active");

        $(".slider-imgs").slick("slickGoTo", parseInt(slideIndex));
        $(".slider-content").slick("slickGoTo", parseInt(slideIndex));
    });

    $(".slider-imgs").on(
        "afterChange",
        function (event, slick, currentSlide, nextSlide) {
            $(".slider-nav ul").find("a").removeClass("active");
            $(".slider-nav ul li")
                .eq(currentSlide)
                .find("a")
                .addClass("active");
            // console.log(currentSlide);
        }
    );

    $(".slider-nav .slide-next").on("click", function (e) {
        e.preventDefault();
        $(".slider-imgs").slick("slickNext");
        $(".slider-content").slick("slickNext");
    });

    $(".slider-nav .slide-prev").on("click", function (e) {
        e.preventDefault();
        $(".slider-imgs").slick("slickPrev");
        $(".slider-content").slick("slickPrev");
    });

    $(".register-form").on(
        "afterChange",
        function (event, slick, currentSlide, nextSlide) {
            // console.log(currentSlide);
            // $(this).addClass("active");
            var tabAnchor = $(".register-page .tabs-header a")
                .parent()
                .find("a");
            tabAnchor.removeClass("active");
            tabAnchor.eq(currentSlide).addClass("active");
            AOS.refresh();
        }
    );

    $(".register-page .tabs-header a").on("click", function (e) {
        e.preventDefault();
        // var tabId = $(this).attr("id");
        var tabHeader = $(this).parent();
        var tabAnchor = tabHeader.find("a");
        var slideIndex = $(this).index();
        // $(this).parent().find("a").removeClass("active");

        $(".register-form").slick("slickGoTo", parseInt(slideIndex));

        // console.log(tabId);
        // $(".tabs-content")
        //     .find(".active")
        //     .removeClass("active")
        //     .slideToggle("slow", function () {
        //         // Animation complete.
        //         $(".tabs-content #" + tabId).slideToggle("slow", function () {
        //             // Animation complete.
        //             $(this).addClass("active");
        //         });
        //     });

        // $(".tabs-content #" + tabId).animate({ width: "toggle" }, 350);
        // $(".tabs-content #" + tabId).slideToggle("slow", function () {
        //     // Animation complete.
        // });
    });

    $(document).on("click", function (e) {
        if ($(".profile-dropdown-list ul").hasClass("shown")) {
            $(".profile-dropdown-list ul").removeClass("shown");
        }
        if (
            $(".chat-dropdown-list .chat-dropdown-list-container").hasClass(
                "shown"
            )
        ) {
            $(".chat-dropdown-list .chat-dropdown-list-container").removeClass(
                "shown"
            );
        }
        if (
            $(
                ".notification-dropdown-list .notification-dropdown-list-container"
            ).hasClass("shown")
        ) {
            $(
                ".notification-dropdown-list .notification-dropdown-list-container"
            ).removeClass("shown");
        }

        if ($(".dropdownlist-content").hasClass("showActions")) {
            $(".btn-dropdown").trigger("click");
        }
        if ($(".dropdownlist-content").hasClass("show")) {
            $(".dropdownlist-content").removeClass("show");
        }
    });

    $(".account-sharing-input a").on("click", function (e) {
        e.preventDefault();
        var copyBtn = $(this);
        var copyText = document.getElementById("CopyURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        copyBtn.addClass("show-tooltip");
        setTimeout(function () {
            copyBtn.removeClass("show-tooltip");
        }, 2000);
    });

    $(".profile-dropdown-toggle").on("click", function (e) {
        e.preventDefault();
        $(this).parent().find("ul").toggleClass("shown");
    });

    $(".chat-dropdown-toggle").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .find(".chat-dropdown-list-container")
            .toggleClass("shown");
        // var dataContainer  =  $('.chat-dropdown-list-container');
        // dataContainer.find('ul .loading').addClass('show');
    });

    $(".notification-dropdown-toggle").on("click", function (e) {
        e.preventDefault();
        $(this)
            .parent()
            .find(".notification-dropdown-list-container")
            .toggleClass("shown");
        var url = $(this).attr("data-action-url");
        if (
            $(
                ".notification-dropdown-list .notification-dropdown-list-container"
            ).hasClass("shown")
        ) {
            viewUnreadNotifications(url);
        }
    });

    $(".btn-viewAllChatMessages").on("click", function (e) {
        e.preventDefault();
        var url = $(this).attr("data-action-url");
        var dataContainer = $(".chat-dropdown-list-container");
        var items = dataContainer.find("ul li:not(.loading)");
        items.remove();
        dataContainer.find("ul li.loading").addClass("show");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $(response.messages).insertAfter(
                    dataContainer.find("ul li.loading")
                );
                dataContainer.find("ul li.loading").removeClass("show");
                console.log(response);
            },
            complete: function () {
                dataContainer.find("ul li.loading").removeClass("show");
            },
        });
    });

    function viewUnreadNotifications(url) {
        // var url = url;
        var dataContainer = $(".notification-dropdown-list-container");
        var items = dataContainer.find("ul li:not(.loading)");
        items.remove();
        dataContainer.find("ul li.loading").addClass("show");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $(response.notifications).insertAfter(
                    dataContainer.find("ul li.loading")
                );
                dataContainer.find("ul li.loading").removeClass("show");
                console.log(response);
            },
            complete: function () {
                dataContainer.find("ul li.loading").removeClass("show");
            },
        });
    }

    $(".btn-viewAllNotifications").on("click", function (e) {
        e.preventDefault();
        var url = $(this).attr("data-action-url");
        var dataContainer = $(".notification-dropdown-list-container");
        var items = dataContainer.find("ul li:not(.loading)");
        items.remove();
        dataContainer.find("ul li.loading").addClass("show");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $(response.notifications).insertAfter(
                    dataContainer.find("ul li.loading")
                );
                dataContainer.find("ul li.loading").removeClass("show");
                console.log(response);
            },
            complete: function () {
                dataContainer.find("ul li.loading").removeClass("show");
            },
        });
    });

    $(".profile-dropdown-list").on("click", function (e) {
        // alert("clicked inside");
        if (
            $(".chat-dropdown-list .chat-dropdown-list-container").hasClass(
                "shown"
            )
        ) {
            $(".chat-dropdown-list .chat-dropdown-list-container").removeClass(
                "shown"
            );
        }
        if (
            $(
                ".notification-dropdown-list .notification-dropdown-list-container"
            ).hasClass("shown")
        ) {
            $(
                ".notification-dropdown-list .notification-dropdown-list-container"
            ).removeClass("shown");
        }
        e.stopPropagation();
    });
    $(".chat-dropdown-list").on("click", function (e) {
        // alert("clicked inside");
        if ($(".profile-dropdown-list ul").hasClass("shown")) {
            $(".profile-dropdown-list ul").removeClass("shown");
        }

        if (
            $(
                ".notification-dropdown-list .notification-dropdown-list-container"
            ).hasClass("shown")
        ) {
            $(
                ".notification-dropdown-list .notification-dropdown-list-container"
            ).removeClass("shown");
        }

        e.stopPropagation();
    });
    $(".notification-dropdown-list").on("click", function (e) {
        // alert("clicked inside");
        if ($(".profile-dropdown-list ul").hasClass("shown")) {
            $(".profile-dropdown-list ul").removeClass("shown");
        }
        if (
            $(".chat-dropdown-list .chat-dropdown-list-container").hasClass(
                "shown"
            )
        ) {
            $(".chat-dropdown-list .chat-dropdown-list-container").removeClass(
                "shown"
            );
        }

        e.stopPropagation();
    });
    $(".dropdownlist-content").on("click", function (e) {
        // alert("clicked inside");
        e.stopPropagation();
    });

    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest(".form-group").addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).closest(".form-group").removeClass("is-invalid");
        },
        errorElement: "div",
        errorClass: "invalid-feedback",
        errorPlacement: function (error, element) {
            // console.log("error", error);
            // console.log("element", element);
            if (element.parents(".licence-options-cards").length) {
                if ($("#" + error.attr("id")).length) {
                    $("#" + error.attr("id")).remove();
                }
                error.addClass("mt-4").insertAfter($(".licence-options-cards"));
            } else {
                if (element.parents(".subservices-checklist").length) {
                    error
                        .addClass("mt-4")
                        .appendTo($(".subservices-checklist"));
                } else {
                    if (element.parent(".has-icon-left").length) {
                        if ($("#" + error.attr("id")).length) {
                            $("#" + error.attr("id")).remove();
                        }
                        error.insertAfter(element.parent());
                    } else if (element.parent(".has-icon").length) {
                        console.log("element", element);
                        console.log("error", error);
                        if ($("#" + error.attr("id")).length) {
                            $("#" + error.attr("id")).remove();
                        }
                        error.insertAfter(element.parent());
                    } else {
                        if ($("#" + error.attr("id")).length) {
                            $("#" + error.attr("id")).remove();
                        }

                        if (element.is(":radio")) {
                            error.appendTo(element.parents(".form-group"));
                        } else {
                            error.insertAfter(element);
                        }
                    }
                }
            }
        },
    });
});
