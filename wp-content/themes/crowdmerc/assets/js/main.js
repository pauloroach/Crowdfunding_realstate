(function ($) {
    "use strict";

    /*------------------------------------------------------------------
    [Table of contents]

    XpeedStudio custom function
    prleoader
    isotope grid for 3 column
    isotope grid for 4 column for portfolio
    isotope grid for 1 column for faq section
    mega menu init
    number counter and skill bar animation
    welcome skill bar
    cause matters skill bar
    welcome number percentages
    skill bar and number counter
    countdown timer
    back to top init
    owl testimonial slider
    owl single content slider
    owl sync slider init
    video popup init
    image popup init
    parallax background init
    map window opener add class
    contact form init
    easy pie chart init
    input number increase
    insta feed
    wow animation init
    show last position back to top init
    fixed class add scroll and corrent section
    XpeedStudio multipile Maps
    XpeedStudio Maps

    -------------------------------------------------------------------*/

    /*==========================================================
                XpeedStudio custom function
    =======================================================================*/

    function xs_custom_function(argument) {

        var w_height = $(window),
            xs_welcome = $('.xs-screen-height .xs-welcome-content'),
            xs_welcome_wraper = $('.xs-welcome-wraper'),
            h_height = $('.xs-header-height'),
            xs_footer = $('.xs-fixed-footer'),
            footer_height = xs_footer.height(),
            xs_main_content_wraper = $('.xs-all-content-wrapper'),
            xs_main_content_height = xs_main_content_wraper.height(),
            sync_slider_img = $('.xs-sync-slider-preview-content img'),
            sync_slider_iframe = $('.xs-sync-slider-preview-content iframe');
        if (sync_slider_iframe.length > 0) {
            sync_slider_iframe.css('height', sync_slider_img.outerHeight());
        }

        xs_footer.css({
            width: '100%',
            left: '0',
            position: 'fixed',
            zIndex: '1',
        });

        xs_main_content_wraper.css({
            marginBottom: footer_height,
            zIndex: '100',
            position: 'relative',
            backgroundColor: '#fff',
        });

        xs_welcome_wraper.css('marginTop', h_height.height() + 'px');

        if (w_height.height() <= 600) {
            xs_welcome.css('height', '800' + 'px');
        } else {
            xs_welcome.css('height', w_height.height());
        }

        /*=============================================================
                            parallax title perfect center
        =========================================================================*/

        $('.parallax-title').each(function (index, el) {
            var parallax_title_width = $(this).innerWidth();
            $(this).css('marginLeft', -(parallax_title_width / 2) + 'px');
        });

    }


//  email patern
    function email_pattern(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        return regex.test(email);
    }

//  text parallax init 
    function initparallax() {
        var a = {
            Android: function () {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function () {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function () {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function () {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function () {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function () {
                return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
            }
        };
        var trueMobile = a.any();
        if (null == trueMobile) {
            var b = new Scrollax();
            b.reload();
            b.init();
        }
    }

    /*==========================================================
                easy pie chart init
    ======================================================================*/

    function pie_chart_init() {
        var chart = $(".xs-pie-chart");
        if (chart.length > 0) {
            chart.each(function () {
                $(this).easyPieChart({
                    easing: 'easeOutBounce',
                    barColor: '#4CC899',
                    trackColor: '#E5E5E5',
                    lineWidth: 6,
                    scaleColor: 'transparent',
                    size: 120,
                    lineCap: 'round',
                    duration: 4500,
                    enabled: true,
                    onStep: function (from, to, percent) {
                        $(this.el).find('.xs-pie-chart-percent').text(Math.round(percent));
                    }
                });
            });
        } // End exists

        var chart = $(".xs-pie-chart-v2");
        if (chart.length > 0) {
            chart.each(function () {
                $(this).easyPieChart({
                    easing: 'easeOutBounce',
                    barColor: '#1B70F0',
                    trackColor: '#F4F4F4',
                    lineWidth: 6,
                    scaleColor: 'transparent',
                    size: 80,
                    lineCap: 'round',
                    duration: 5000,
                    enabled: true,
                    onStep: function (from, to, percent) {
                        $(this.el).find('.xs-pie-chart-percent').text(Math.round(percent));
                    }
                });
            });
        } // End exists
    }

    $(window).on('load', function () {

        if ($('.ajax_add_to_cart').length > 0) {
            $(".ajax_add_to_cart").prepend('<i class="fa fa-shopping-cart"></i>');
        }

        // xs custom function
        xs_custom_function();

        // init text parallax
        initparallax();

        // prleoader
        setTimeout(function () {
            $("#preloader").addClass('loaded');
            $('.fundpress-animate').addClass('load');
            pie_chart_init();
        }, 500);


        /*==========================================================
                isotope grid for 3 column
        =======================================================================*/

        if ($('.xs-col-3-isotope-grid').length > 0) {
            var $container = $('.xs-col-3-isotope-grid'),
                colWidth = function () {
                    var w = $container.width(),
                        columnNum = 1,
                        columnWidth = 0;
                    if (w > 1200) {
                        columnNum = 3;
                    } else if (w > 900) {
                        columnNum = 3;
                    } else if (w > 600) {
                        columnNum = 2;
                    } else if (w > 450) {
                        columnNum = 2;
                    } else if (w > 385) {
                        columnNum = 1;
                    }
                    columnWidth = Math.floor(w / columnNum);
                    $container.find('.xs-col-3-isotope-grid-item').each(function () {
                        var $item = $(this),
                            multiplier_w = $item.attr('class').match(/xs-col-3-isotope-grid-item-w(\d)/),
                            multiplier_h = $item.attr('class').match(/xs-col-3-isotope-grid-item-h(\d)/),
                            width = multiplier_w ? columnWidth * multiplier_w[1] : columnWidth,
                            height = multiplier_h ? columnWidth * multiplier_h[1] * 0.4 - 12 : columnWidth * 0.5;
                        $item.css({
                            width: width
                            //height: height
                        });
                    });
                    return columnWidth;
                },
                isotope = function () {
                    $container.isotope({
                        resizable: false,
                        itemSelector: '.xs-col-3-isotope-grid-item',
                        masonry: {
                            columnWidth: colWidth(),
                            gutterWidth: 3
                        }
                    });
                };
            isotope();
            $(window).on('resize', isotope);
            var $optionSets = $('.xs-isotope-nav .option-set'),
                $optionLinks = $optionSets.find('a');
            $optionLinks.on('click', function () {
                var $this = $(this);
                var $optionSet = $this.parents('.option-set');
                $optionSet.find('.selected').removeClass('selected');
                $this.addClass('selected');

                // make option object dynamically, i.e. { filter: '.my-filter-class' }
                var options = {},
                    key = $optionSet.attr('data-option-key'),
                    value = $this.attr('data-option-value');
                // parse 'false' as false boolean
                value = value === 'false' ? false : value;
                options[key] = value;
                if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
                    // changes in layout modes need extra logic
                    changeLayoutMode($this, options)
                } else {
                    // creativewise, apply new options
                    $container.isotope(options);
                }
                return false;
            });
        }

        /*==========================================================
                isotope grid for 4 column for portfolio
        =======================================================================*/

        if ($('.xs-portfolio-isotope-grid').length > 0) {
            var $container = $('.xs-portfolio-isotope-grid'),
                colWidth = function () {
                    var w = $container.width(),
                        columnNum = 1,
                        columnWidth = 0;
                    if (w > 1200) {
                        columnNum = 3;
                    } else if (w > 900) {
                        columnNum = 3;
                    } else if (w > 600) {
                        columnNum = 1;
                    } else if (w > 450) {
                        columnNum = 1;
                    } else if (w > 385) {
                        columnNum = 1;
                    }
                    columnWidth = Math.floor(w / columnNum);
                    $container.find('.xs-portfolio-isotope-grid-item').each(function () {
                        var $item = $(this),
                            multiplier_w = $item.attr('class').match(/xs-portfolio-isotope-grid-item-w(\d)/),
                            multiplier_h = $item.attr('class').match(/xs-portfolio-isotope-grid-item-h(\d)/),
                            width = multiplier_w ? columnWidth * multiplier_w[1] : columnWidth,
                            height = multiplier_h ? columnWidth * multiplier_h[1] * 0.4 - 12 : columnWidth * 0.5;
                        $item.css({
                            width: width
                        });
                    });
                    return columnWidth;
                },
                isotope = function () {
                    $container.isotope({
                        resizable: false,
                        itemSelector: '.xs-portfolio-isotope-grid-item',
                        masonry: {
                            columnWidth: colWidth(),
                            gutterWidth: 3
                        }
                    });
                };
            isotope();
            $(window).on('resize', isotope);
        }

        /*==========================================================
                isotope grid for 1 column for faq section
        =======================================================================*/

        if ($('.xs-col-1-isotope-grid').length > 0) {

            var $container = $('.xs-col-1-isotope-grid'),
                $filterLinks = $('#filters li a');

            $container.isotope({
                itemSelector: '.xs-col-1-isotope-grid-item',
                filter: '.art'
            });

            $filterLinks.on('click', function (e) {
                e.preventDefault();
                var $this = $(this);

                // don't proceed if already selected
                if ($this.hasClass('selected')) {
                    return;
                }

                $filterLinks.filter('.selected').removeClass('selected');
                $this.addClass('selected');

                // get selector from data-filter attribute
                var selector = $this.data('filter');

                $container.isotope({
                    filter: selector
                });


            });


            var $clubxgallerycontainer = $('.xs-col-1-isotope-grid'),
                colWidth = function () {
                    var w = $clubxgallerycontainer.width(),
                        columnNum = 1,
                        columnWidth = 0;
                    if (w > 1200) {
                        columnNum = 1;
                    } else if (w > 900) {
                        columnNum = 1;
                    } else if (w > 600) {
                        columnNum = 1;
                    } else if (w > 450) {
                        columnNum = 1;
                    } else if (w > 385) {
                        columnNum = 1;
                    }
                    columnWidth = Math.floor(w / columnNum);
                    $clubxgallerycontainer.find('.xs-col-1-isotope-grid-item').each(function () {
                        var $item = $(this),
                            multiplier_w = $item.attr('class').match(/xs-col-1-isotope-grid-item-w(\d)/),
                            multiplier_h = $item.attr('class').match(/xs-col-1-isotope-grid-item-h(\d)/),
                            width = multiplier_w ? columnWidth * multiplier_w[1] : columnWidth,
                            height = multiplier_h ? columnWidth * multiplier_h[1] * 0.4 - 12 : columnWidth * 0.5;
                        $item.css({
                            width: width
                        });
                    });
                    return columnWidth;
                },
                isotope = function () {
                    $clubxgallerycontainer.isotope({
                        resizable: false,
                        itemSelector: '.xs-col-1-isotope-grid-item',
                        masonry: {
                            columnWidth: colWidth(),
                            gutterWidth: 3
                        }
                    });
                };
            isotope();
            $(window).on('resize', isotope);
        } // end clubx player list grid

    }); // end on.load event

    $(document).ready(function () {

        // xs custom function
        xs_custom_function();

        // init text parallax
        initparallax();


        /*==========================================================
                mega menu init
        =======================================================================*/

        if ($('.xs-menus').length > 0) {
            $('.xs-menus').xs_nav({
                mobileBreakpoint: 992,
            });
        }

        /*==========================================================
                number counter and skill bar animation
        =======================================================================*/

        var number_percentage = $(".number-percentage");

        function animateProgressBar() {
            number_percentage.each(function () {
                $(this).animateNumbers($(this).attr("data-value"), true, parseInt($(this).attr("data-animation-duration"), 10));
                var value = $(this).attr("data-value");
                var duration = $(this).attr("data-animation-duration");
                $(this).closest('.xs-skill-bar').find('.xs-skill-track').animate({
                    width: value + '%'
                }, 4500);
            });
        }


        if ($('.waypoint-tigger').length > 0) {
            var waypoint = new Waypoint({
                element: document.getElementsByClassName('waypoint-tigger'),
                handler: function (direction) {
                    animateProgressBar();
                }
            });
        }

        /*==========================================================
                welcome skill bar
        =======================================================================*/
        if ($('.xs-skill-bar-v2').length > 0) {
            $('.xs-skill-bar-v2').each(function () {
                $(this).find('.xs-skill-track').animate({
                    width: $(this).attr('data-percent')
                }, 4500);
            });
        }

        /*==========================================================
                cause matters skill bar
        =======================================================================*/
        if ($('.xs-skill-bar-v3').length > 0) {
            $('.xs-skill-bar-v3').each(function () {
                $(this).find('.xs-skill-track').css({
                    width: $(this).attr('data-percent'),
                });
            });
        }
        /*==========================================================
                welcome number percentages
        =======================================================================*/
        if ($('.number-percentages').length > 0) {
            $('.number-percentages').each(function () {
                var $this = $(this);

                $({Counter: 0}).animate({Counter: $this.text()}, {
                    duration: 4500,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            });
        }

        /*==========================================================
                skill bar and number counter
        =======================================================================*/

        $.fn.animateNumbers = function (stop, commas, duration, ease) {
            return this.each(function () {
                var $this = $(this);
                var start = parseInt($this.text().replace(/,/g, ""), 10);
                commas = (commas === undefined) ? true : commas;
                $({
                    value: start
                }).animate({
                    value: stop
                }, {
                    duration: duration == undefined ? 500 : duration,
                    easing: ease == undefined ? "swing" : ease,
                    step: function () {
                        $this.text(Math.floor(this.value));
                        if (commas) {
                            $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                        }
                    },
                    complete: function () {
                        if (parseInt($this.text(), 10) !== stop) {
                            $this.text(stop);
                            if (commas) {
                                $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                            }
                        }
                    }
                });
            });
        };

        /*==========================================================
                back to top init
        ======================================================================*/
        $(document).on('click', '.xs-back-to-top', function (event) {
            event.preventDefault();
            /* Act on the event */

            $('html, body').animate({
                scrollTop: 0,
            }, 1000)
        });


        /*==========================================================
                owl single content slider
        ======================================================================*/
        if ($('.xs-single-content-slider').length > 0) {
            var owl2 = $(".xs-single-content-slider");
            owl2.owlCarousel({
                items: 1,
                loop: true,
                mouseDrag: true,
                touchDrag: true,
                dots: false,
                nav: true,
                autoplay: true,
                navText: ["<i class='fa fa-angle-left xs-owl-round-nav'></i>", "<i class='fa fa-angle-right xs-owl-round-nav'></i>"],
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
            });
        }

        /*==========================================================
                owl sync slider init
        ======================================================================*/

        if (($('.xs-sync-slider-preview').length > 0) && ($('.xs-sync-slider-thumb').length > 0)) {

            var sync1 = $(".xs-sync-slider-preview"),
                sync2 = $(".xs-sync-slider-thumb"),
                slidesPerPage = 4,
                syncedSecondary = true;

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: false,
                autoplay: true,
                autoplayHoverPause: true,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [''],
            }).on('changed.owl.carousel', syncPosition);

            sync2
                .on('initialized.owl.carousel', function () {
                    sync2.find(".owl-item").eq(0).addClass("current");
                })
                .owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    nav: false,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                    responsiveRefreshRate: 100
                }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line

                //if you disable loop you have to comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                //end block

                sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });
        }

        /*==========================================================
                video popup init
        ======================================================================*/
        if ($('.xs-video-popup').length > 0) {
            $('.xs-video-popup').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,

                fixedContentPos: false
            });
        }

        /*==========================================================
                image popup init
        ======================================================================*/

        if ($('.xs-image-popup').length > 0) {
            $('.xs-image-popup').magnificPopup({
                type: 'image',
                removalDelay: 500, //delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function () {
                        // just a hack that adds mfp-anim class to markup
                        this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                        this.st.mainClass = 'mfp-zoom-in';
                    }
                },
                closeOnContentClick: true,
                midClick: true,
                gallery: {
                    enabled: true,
                },
            });
        }

        /*==========================================================
                parallax background init
        ======================================================================*/
        $('.parallax-window').parallax();


        /*==========================================================
                map window opener add class
        ======================================================================*/
        $(document).on('click', '.fundpress-window-opener', function () {
            // body...
            event.preventDefault();

            var main_wraper = $('.fundpress-widnow-wraper'),
                active_class = 'active';

            if ($(this).parent().parent().hasClass(active_class)) {
                $(this).parent().parent().removeClass(active_class);
            } else {
                $(this).parent().parent().addClass(active_class);
            }
        });

        /*=============================================================
                        wow animation init
        =========================================================================*/
        $(function () {
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: false,
                live: true,
                scrollContainer: null,
            });
            wow.init();
        });


    });

    $('.preloader-cancel-btn').on('click', function (event) {
        event.preventDefault();
        if (!$('#preloader').hasClass('loaded')) {
            $('#preloader').addClass('loaded');
        }

    });


    $(window).on('scroll', function () {

        /*==========================================================
                show last position back to top init
        ======================================================================*/

        if ($('.show-last-pos').length > 0) {
            var w_height = $(window).height(),
                d_height = $(document).height(),
                height_calc = d_height - w_height,
                last_pos = $('.show-last-pos');

            if ($(this).scrollTop() >= height_calc) {
                last_pos.addClass('active');
            } else {
                last_pos.removeClass('active');
            }
        }
        ;

        /*==========================================================
                fixed class add scroll and corrent section
        ======================================================================*/

        if ($('.xs-fixed-footer').length > 0) {
            var footer_content = $('.xs-fixed-footer'),
                xs_all_wrap_content = $('.xs-all-content-wrapper'),
                pos = footer_content.position(),
                windowpos = $(window).scrollTop();

            if (windowpos == pos.top && windowpos <= xs_all_wrap_content.height()) {
                footer_content.removeClass('xs_footer_sticky');
            } else {
                footer_content.addClass('xs_footer_sticky');
            }
        }
        ;

    }); // END Scroll Function

    $(window).on('resize', function () {

        // xs custom function
        xs_custom_function();

    }); // End Resize

    /*==========================================================
                XpeedStudio Maps
    ======================================================================*/

    if ($('#xs-maps').length > 0) {
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 11,
                scrollwheel: false,
                navigationControl: false,
                mapTypeControl: true,
                scaleControl: false,
                draggable: true,
                disableDefaultUI: true,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(40.6700, -73.9400), // New York

                // How you would like to style the map.
                // This is where you would paste any style found on Snazzy Maps.
                styles: [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{"color": "#a0d6d1"}, {"lightness": 17}]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 20}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#dedede"}, {"lightness": 17}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#dedede"}, {"lightness": 29}, {"weight": 0.2}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{"color": "#dedede"}, {"lightness": 18}]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{"color": "#ffffff"}, {"lightness": 16}]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f1f1f1"}, {"lightness": 21}]
                }, {
                    "elementType": "labels.text.stroke",
                    "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]
                }, {
                    "elementType": "labels.text.fill",
                    "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]
                }, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": "#fefefe"}, {"lightness": 20}]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]
                }]
            };

            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('xs-maps');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(40.6700, -73.9400),
                map: map,
                title: 'XspeedStudio',
                icon: 'assets/images/map-marker.png',
            });
        }
    }

    /*==========================================================
                Scroll To Comment Section When click comment (single blog page)
    ======================================================================*/
    var scrolltoo = $('.post-comment a');
    scrolltoo.on('click', function () {
        $('html, body').animate({scrollTop: $(this.hash).offset().top - 50}, 1000);
        return false;
    });


})(jQuery);