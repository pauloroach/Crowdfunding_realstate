( function( $, elementor ) {
    "use strict";

    var Crowdmerc = {

        init: function() {

            var widgets = {
                'xs-maps.default' : Crowdmerc.Map,
                'xs-testimonial.default' : Crowdmerc.Testimonial,
                'xs-contact-info.default' : Crowdmerc.ContactInfo,
                'xs-featured-crowdfunding.default' : Crowdmerc.BannerSlider,
            };

            $.each( widgets, function( widget, callback ) {
                elementor.hooks.addAction( 'frontend/element_ready/' + widget, callback );
            });

        },

        Map: function( $scope ) {

            var $container = $scope.find( '.fundpress-maps' ),
                map,
                init,
                pins;
            if ( ! window.google ) {
                return;
            }

            init = $container.data( 'init' );
            pins = $container.data( 'pins' );
            map  = new google.maps.Map( $container[0], init );

            if ( pins ) {
                $.each( pins, function( index, pin ) {

                    var marker,
                        infowindow,
                        pinData = {
                            position: pin.position,
                            map: map
                        };

                    if ( '' !== pin.image ) {
                        pinData.icon = pin.image;
                    }

                    marker = new google.maps.Marker( pinData );

                    if ( '' !== pin.desc ) {
                        infowindow = new google.maps.InfoWindow({
                            content: pin.desc
                        });
                    }

                    marker.addListener( 'click', function() {
                        infowindow.open( map, marker );
                    });

                    if ( 'visible' === pin.state && '' !== pin.desc ) {
                        infowindow.open( map, marker );
                    }

                });
            }
        },
        ContactInfo: function( $scope ) {
                var $container = $scope.find( '.xs-contactmap' );

                if ( ! window.google ) {
                    return;
                }

                var data = $container.data('map');
                var latitude = data.latitude;
                var longitude = data.longitude;
                var latlng = new google.maps.LatLng(latitude,longitude);


                var myOptions = {
                    zoom: 3,
                    center: latlng,
                    scrollwheel: false,
                    navigationControl: false,
                    mapTypeControl: true,
                    scaleControl: false,
                    draggable: true,
                    disableDefaultUI: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                };
                var map = new google.maps.Map($container[0], myOptions);

                var myMarker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title:"Barnett Park"
                });
        },
        Testimonial:function ( $scope ){
            var carousel = $scope.find( '.xs-testimonial-slider.slider-double-item' );
            if ( ! carousel.length ) {
                return;
            }
            carousel.owlCarousel({
                    items: 2,
                    loop: true,
                    mouseDrag: true,
                    touchDrag: true,
                    dots: true,
                    nav: false,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    responsive : {
                        // breakpoint from 0 up
                        0 : {
                            items: 1,
                        },
                        // breakpoint from 480 up
                        480 : {
                            items: 1,
                        },
                        // breakpoint from 768 up
                        768 : {
                            items: 2,
                        }
                    }
                });
        },
        BannerSlider:function ( $scope ){
            var carousel = $scope.find( '.xs-banner-slider' );
            if ( ! carousel.length ) {
                return;
            }
            carousel.owlCarousel({
                items: 1,
                loop: true,
                mouseDrag: true,
                touchDrag: true,
                dots: false,
                nav: true,
                autoplay: true,
                navText: ["<i class='fa fa-angle-left xs-owl-round-nav v2'></i>","<i class='fa fa-angle-right xs-owl-round-nav v2'></i>"],
                autoplayTimeout:5000,
                autoplaySpeed: true,
                autoplayHoverPause: true,
                responsive : {
                    // breakpoint from 0 up
                    0 : {
                        nav: false,
                    },
                    // breakpoint from 480 up
                    480 : {
                        nav: false,
                    },
                    // breakpoint from 768 up
                    768 : {
                        nav: true,
                    }
                }
            });
        },
    };

    $( window ).on( 'elementor/frontend/init', Crowdmerc.init );

}( jQuery, window.elementorFrontend ) );