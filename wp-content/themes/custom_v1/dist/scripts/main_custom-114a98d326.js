 (function () {
        $(window).on("load", function () {
            $(".loader").fadeOut(), $(".page-loader").delay(350).fadeOut("slow");
        }),
            $(document).ready(function () {
                function e(e) {
                    e.length > 0 && (e.hasClass("home-full-height") ? e.height($(window).height()) : e.height(1 * $(window).height()));
                }
                function t(e, t) {
                    if (e.length > 0) {
                        var a = e.height(),
                            o = $(document).scrollTop();
                        if ((e.hasClass("home-parallax") && $(t).scrollTop() <= a && e.css("top", 0.55 * o), e.hasClass("home-fade") && $(t).scrollTop() <= a)) {
                            $(".caption-content").css("opacity", 1 - (o / e.height()) * 1);
                        }
                    }
                }
                function a(e, t, a) {
                    var o = $(window).scrollTop();
                    e.length > 0 && t.length > 0 && (o >= a ? e.removeClass("navbar-transparent") : e.addClass("navbar-transparent"));
                }
                function o(e, t) {
                    if (!0 !== t) {
                        // $(".navbar-custom .navbar-nav > li.dropdown:not(:first-child), .navbar-custom li.dropdown:not(:first-child) > ul > li.dropdown").removeClass("open");
                        var a;
                        $(".navbar-custom .navbar-nav > li.dropdown:not(:first-child), .navbar-custom li.dropdown:not(:first-child) > ul > li.dropdown").hover(
                            function () {
                                var e = $(this);
                                a = setTimeout(function () {
                                    // e.addClass("open"), e.find(".dropdown-toggle").addClass("disabled");
                                }, 0);
                            },
                            function () {
                                // clearTimeout(a), $(this).removeClass("open"), $(this).find(".dropdown-toggle").removeClass("disabled");
                            }
                        );
                    } else
                        $(".navbar-custom .navbar-nav > li.dropdown:not(:first-child), .navbar-custom li.dropdown:not(:first-child) > ul > li.dropdown").unbind("mouseenter mouseleave"),
                            $(".navbar-custom [data-toggle=dropdown]")
                                .not(".binded")
                                .addClass("binded")
                                .on("click", function (e) {
                                    e.preventDefault(),
                                        e.stopPropagation(),
                                        $(this).parent().siblings().removeClass("open"),
                                        $(this).parent().siblings().find("[data-toggle=dropdown]").parent().removeClass("open"),
                                        $(this).parent().toggleClass("open");

                                        console.log($(this));
                                });
                }
                function n() {
                    var e = {
                            zoom: 11,
                            scrollwheel: !1,
                            center: m,
                            styles: [
                                { featureType: "all", elementType: "geometry.fill", stylers: [{ visibility: "on" }, { saturation: "-11" }] },
                                { featureType: "administrative", elementType: "geometry.fill", stylers: [{ saturation: "22" }] },
                                { featureType: "administrative", elementType: "geometry.stroke", stylers: [{ saturation: "-58" }, { color: "#cfcece" }] },
                                { featureType: "administrative", elementType: "labels.text", stylers: [{ color: "#f8f8f8" }] },
                                { featureType: "administrative", elementType: "labels.text.fill", stylers: [{ color: "#999999" }, { visibility: "on" }] },
                                { featureType: "administrative", elementType: "labels.text.stroke", stylers: [{ visibility: "on" }] },
                                { featureType: "administrative.country", elementType: "geometry.fill", stylers: [{ color: "#f9f9f9" }, { visibility: "simplified" }] },
                                { featureType: "landscape", elementType: "all", stylers: [{ color: "#f2f2f2" }] },
                                { featureType: "landscape", elementType: "geometry", stylers: [{ saturation: "-19" }, { lightness: "-2" }, { visibility: "on" }] },
                                { featureType: "poi", elementType: "all", stylers: [{ visibility: "off" }] },
                                { featureType: "road", elementType: "all", stylers: [{ saturation: -100 }, { lightness: 45 }] },
                                { featureType: "road.highway", elementType: "all", stylers: [{ visibility: "simplified" }] },
                                { featureType: "road.arterial", elementType: "labels.icon", stylers: [{ visibility: "off" }] },
                                { featureType: "transit", elementType: "all", stylers: [{ visibility: "off" }] },
                                { featureType: "water", elementType: "all", stylers: [{ color: "#d8e1e5" }, { visibility: "on" }] },
                                { featureType: "water", elementType: "geometry.fill", stylers: [{ color: "#dedede" }] },
                                { featureType: "water", elementType: "labels.text", stylers: [{ color: "#cbcbcb" }] },
                                { featureType: "water", elementType: "labels.text.fill", stylers: [{ color: "#9c9c9c" }] },
                                { featureType: "water", elementType: "labels.text.stroke", stylers: [{ visibility: "off" }] },
                            ],
                        },
                        t = document.getElementById("map"),
                        a = new google.maps.Map(t, e),
                        o = new google.maps.MarkerImage("assets/images/map-icon.png", new google.maps.Size(59, 65), new google.maps.Point(0, 0), new google.maps.Point(24, 42));
                    new google.maps.Marker({ position: c, icon: o, title: "Titan", infoWindow: { content: "<p><strong>Rival</strong><br/>121 Somewhere Ave, Suite 123<br/>P: (123) 456-7890<br/>Australia</p>" }, map: a });
                }
                (wow = new WOW({ mobile: !1 })),
                    wow.init(),
                    $(window).scroll(function () {
                        $(this).scrollTop() > 100 ? $(".scroll-up").fadeIn() : $(".scroll-up").fadeOut();
                        if($('body').hasClass('home')) {
                        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                                $('.navbar-toggler').addClass('rotated');
                            } else {
                            $('.navbar-toggler').removeClass('rotated');
                        }
                        }

                    }),
                    $('a[href="#totop"]').click(function () {
                        return $("html, body").animate({ scrollTop: 0 }, "slow"), !1;
                    });
                var i = $(".home-section"),
                    r = $(".navbar-custom"),
                    s = r.height(),
                    l = $("#works-grid"),
                    d = Math.max($(window).width(), window.innerWidth),
                    u = !1;
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && (u = !0),
                    e(i),
                    a(r, i, s),
                    (function (e) {
                        $(".navbar-custom .navbar-nav > li.dropdown").hover(function () {
                            var t = $(".dropdown-menu", $(this)).offset().left,
                                a = $(".dropdown-menu", $(this)).width();
                            if ((e - t < 2 * a ? $(this).children(".dropdown-menu").addClass("leftauto") : $(this).children(".dropdown-menu").removeClass("leftauto"), $(".dropdown", $(this)).length > 0)) {
                                var o = $(".dropdown-menu", $(this)).width();
                                e - t - a < o ? $(this).children(".dropdown-menu").addClass("left-side") : $(this).children(".dropdown-menu").removeClass("left-side");
                            }
                        });
                    })(d),
                    o(d, u),
                    $("#app").on('click', '.navbar-toggler', function () {
                        $('#navbarNavDropdown').toggleClass('active');
                        $(this).toggleClass('rotated');
                    });
                    $('a[data-rel^=lightcase]').lightcase(),
                    lightcase.resize({ width: 1200 }),
                    $('.grid').isotope({
                        itemSelector: '.grid-item',
                        layoutMode: 'masonry'
                    });
                    $('.filter_nav').on( 'click', '.nav-link', function() {
                        var filterValue = $(this).attr('data-filter');
                        $('.grid').isotope({ filter: filterValue });
                    });
                    $(".single-projects")
                        .on('click', '.post-image-section', function() {
                            let _this = $(this),
                                next = _this.next().attr('id');
                    $('html, body').animate({
                        scrollTop: $('#' + next).offset().top - 152
                    }, 1000);
                        }).on('click', '.carousel-image', function () {
                        $('html, body').animate({
                            scrollTop: $('#post_content').offset().top - 180
                        }, 1000);
                    });
                    if($('body').hasClass('home')){
                        $('body.home').addClass('fixed_bg');
                        setTimeout(function () {
                            $('#home .img_full').addClass('d-none');
                            $('#home .white_line').removeClass('d-none');
                            $('#home .img_btm').removeClass('position-absolute').addClass('position-relative');
                            setTimeout(function () {
                                $('#home .hovered_div').addClass('active');
                                $('.home .navbar-custom .navbar-toggler').removeClass('home-toggler');
                                setTimeout(function () {
                                    $('.home .navbar-custom .navbar-brand').slideDown(3000);
                                    // $('.home .hovered_div').fadeOut(2000);
                                    $('.home .hovered_div').hide();
                                    $('#home .slider_col').addClass('animated');
                                    $('body.home').removeClass('fixed_bg');
                                    setTimeout(function () {
                                        $('.home .carousel').attr('data-ride', 'carousel');
                                        $('.home .carousel').carousel('cycle');
                                    }, 3000);
                                }, 2000);
                            }, 2000);
                        }, 3000);
                    }
                    $('.navbar-section .nav-item .dropdown-toggle').on('mouseenter', function () {
                        let _this = $(this);
                        $('.navbar-section .nav-item').removeClass('hovered');
                        _this.closest('.nav-item').addClass('hovered');

                    });
                    $('.navbar-section .nav-item .dropdown-item').on('mouseleave', function () {
                        $(this).closest('.nav-item').removeClass('hovered');
                        // $('.navbar-section .nav-item:first-child').removeClass('hovered');
                    });
                    $(window).resize(function () {
                        var t = Math.max($(window).width(), window.innerWidth);
                        e(i), o(t, u);
                    }),
                    $(window).scroll(function () {
                        t(i, this), a(r, i, s);
                    }),
                    $(".home-section, .module, .module-small, .side-image").each(function (e) {
                        $(this).attr("data-background") && $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
                    }),
                $(".hero-slider").length > 0 &&
                $(".hero-slider").flexslider({
                    animation: "fade",
                    animationSpeed: 1e3,
                    animationLoop: !0,
                    prevText: "",
                    nextText: "",
                    before: function (e) {
                        $(".titan-caption").fadeOut().animate({ top: "-80px" }, { queue: !1, easing: "swing", duration: 700 }), e.slides.eq(e.currentSlide).delay(500), e.slides.eq(e.animatingTo).delay(500);
                    },
                    after: function (e) {
                        $(".titan-caption").fadeIn().animate({ top: "0" }, { queue: !1, easing: "swing", duration: 700 });
                    },
                    useCSS: !0,
                }),
                    $(".rotate").textrotator({ animation: "dissolve", separator: "|", speed: 3e3 }),
                    $(document).on("click", ".navbar-collapse.in", function (e) {
                        $(e.target).is("a") && "dropdown-toggle" != $(e.target).attr("class") && $(this).collapse("hide");
                    });
                var p,
                    l = $("#works-grid");
                if (
                    ((p = l.hasClass("works-grid-masonry") ? "masonry" : "fitRows"),
                        l.imagesLoaded(function () {
                            l.isotope({ layoutMode: p, itemSelector: ".work-item" });
                        }),
                        $("#filters a").click(function () {
                            $("#filters .current").removeClass("current"), $(this).addClass("current");
                            var e = $(this).attr("data-filter");
                            return l.isotope({ filter: e, animationOptions: { duration: 750, easing: "linear", queue: !1 } }), !1;
                        }),
                    $(".post-images-slider").length > 0 && $(".post-images-slider").flexslider({ animation: "slide", smoothHeight: !0 }),
                        $(".progress-bar").each(function (e) {
                            $(this).appear(function () {
                                var e = $(this).attr("aria-valuenow");
                                $(this).animate({ width: e + "%" }), $(this).find("span").animate({ opacity: 1 }, 900), $(this).find("span").countTo({ from: 0, to: e, speed: 900, refreshInterval: 30 });
                            });
                        }),
                        $(".count-item").each(function (e) {
                            $(this).appear(function () {
                                var e = $(this).find(".count-to").data("countto");
                                $(this).find(".count-to").countTo({ from: 0, to: e, speed: 1200, refreshInterval: 30 });
                            });
                        }),
                        $(function () {
                            $(".video-player").mb_YTPlayer();
                        }),
                        $("#video-play").click(function (e) {
                            return e.preventDefault(), $(this).hasClass("fa-play") ? $(".video-player").playYTP() : $(".video-player").pauseYTP(), $(this).toggleClass("fa-play fa-pause"), !1;
                        }),
                        $("#video-volume").click(function (e) {
                            return e.preventDefault(), $(this).hasClass("fa-volume-off") ? $(".video-player").YTPUnmute() : $(".video-player").YTPMute(), $(this).toggleClass("fa-volume-off fa-volume-up"), !1;
                        }),
                        $(".post-masonry").imagesLoaded(function () {
                            $(".post-masonry").masonry();
                        }),
                        $(".section-scroll").bind("click", function (e) {
                            var t = $(this);
                            $("html, body")
                                .stop()
                                .animate({ scrollTop: $(t.attr("href")).offset().top - 50 }, 1e3),
                                e.preventDefault();
                        }),
                        $("#contactForm").submit(function (e) {
                            e.preventDefault();
                            var t = jQuery,
                                a = t(this).serializeArray(),
                                o = t(this).attr("action"),
                                n = t("#contactFormResponse"),
                                i = t("#cfsubmit"),
                                r = i.text();
                            return (
                                i.text("Sending..."),
                                    t.ajax({
                                        url: o,
                                        type: "POST",
                                        data: a,
                                        success: function (e) {
                                            n.html(e), i.text(r), t("#contactForm input[name=name]").val(""), t("#contactForm input[name=email]").val(""), t("#contactForm textarea[name=message]").val("");
                                        },
                                        error: function (e) {
                                            alert("Error occurd! Please try again");
                                        },
                                    }),
                                    !1
                            );
                        }),
                        $("#requestACall").submit(function (e) {
                            e.preventDefault();
                            var t = jQuery,
                                a = t(this).serializeArray(),
                                o = t(this).attr("action"),
                                n = t("#requestFormResponse"),
                                i = t("#racSubmit"),
                                r = i.text();
                            return (
                                i.text("Sending..."),
                                    t.ajax({
                                        url: o,
                                        type: "POST",
                                        data: a,
                                        success: function (e) {
                                            n.html(e), i.text(r), t("#requestACall input[name=name]").val(""), t("#requestACall input[name=subject]").val(""), t("#requestACall textarea[name=phone]").val("");
                                        },
                                        error: function (e) {
                                            alert("Error occurd! Please try again");
                                        },
                                    }),
                                    !1
                            );
                        }),
                        $("#reservationForm").submit(function (e) {
                            e.preventDefault();
                            var t = jQuery,
                                a = t(this).serializeArray(),
                                o = t(this).attr("action"),
                                n = t("#reservationFormResponse"),
                                i = t("#rfsubmit"),
                                r = i.text();
                            return (
                                i.text("Sending..."),
                                    t.ajax({
                                        url: o,
                                        type: "POST",
                                        data: a,
                                        success: function (e) {
                                            n.html(e),
                                                i.text(r),
                                                t("#reservationForm input[name=date]").val(""),
                                                t("#reservationForm input[name=time]").val(""),
                                                t("#reservationForm textarea[name=people]").val(""),
                                                t("#reservationForm textarea[name=email]").val("");
                                        },
                                        error: function (e) {
                                            alert("Error occurd! Please try again");
                                        },
                                    }),
                                    !1
                            );
                        }),
                        $("#subscription-form").submit(function (e) {
                            e.preventDefault();
                            var t = $("#subscription-form"),
                                a = $("#subscription-form-submit"),
                                o = $("#subscription-response"),
                                n = $("input#semail").val();
                            $.ajax({
                                type: "POST",
                                url: "assets/php/subscribe.php",
                                dataType: "json",
                                data: { email: n },
                                cache: !1,
                                beforeSend: function (e) {
                                    a.empty(), a.append('<i class="fa fa-cog fa-spin"></i> Wait...');
                                },
                                success: function (e) {
                                    1 == e.sendstatus ? (o.html(e.message), t.fadeOut(500)) : o.html(e.message);
                                },
                            });
                        }),
                    0 != $("#map").length && "undefined" != typeof google)
                ) {
                    google.maps.event.addDomListener(window, "load", n);
                    var c = new google.maps.LatLng(40.67, -74.2),
                        m = u ? c : new google.maps.LatLng(40.67, -73.94);
                }
            });
    })(jQuery);
