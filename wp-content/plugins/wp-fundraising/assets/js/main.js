(function($) {
    "use strict";


    // campaign-form js
    if (jQuery('#addMore-btn').length > 0) {
        jQuery('#addMore-btn').on('click', function(event) {
            event.preventDefault();
            jQuery(".xs-reward-input-filed:last").clone(true).insertBefore(this).addClass('clone');
            var lengt = jQuery('.xs-reward-input-filed').length;
            if (lengt > 1) {
                jQuery('.xs-reward-input-filed:first').addClass('clone');
            }
            jQuery('.xs-reward-input-filed:last input, .xs-reward-input-filed:last textarea').each(function(){
                if (jQuery(this).val().length > 0)
                    jQuery(this).val('');
            });
        });
    }

    if (jQuery('#remove-btn').length > 0) {
        jQuery('#remove-btn').on('click', function() {
            jQuery(this).closest('.xs-reward-input-filed').remove();
            var lengt = jQuery('.xs-reward-input-filed').length;
            if (lengt == '1'){
                jQuery('.xs-reward-input-filed').removeClass('clone');
            }
        });
    }

    if (jQuery('#customFile').length > 0) {
        jQuery('#customFile').on('change', function(e) {
            var getValue = jQuery(this).val(),
                fileName = getValue.replace(/C:\\fakepath\\/i, '');
            jQuery(this).closest('.custom-file').find('.file-name').html(fileName);
        });
    }

    // dashboard form
    if (jQuery('.formEdit').length > 0 && jQuery('.formCancel').length > 0) {
        jQuery('.formEdit').on('click', function(e) {
            e.preventDefault();
            jQuery(this).parent().parent().parent().addClass('isActive');
        });
        jQuery('.formCancel').on('click', function(e) {
            e.preventDefault();
            jQuery(this).parent().parent().parent().removeClass('isActive');
        });
    }

    // campaign form
    if(jQuery('#campaign_form').length > 0) {
        jQuery('#campaign_form').on('submit', function(e) {
            var error = false;
            jQuery('#campaign_goal, #campaign_date, #campaign_end_date, #campaign_title').each(function(index){
                var input = jQuery(this);
                if (input.val() === '') {
                    e.preventDefault();
                    input.addClass('error');

                    error = true;
                } else {
                    input.removeClass('error')

                }
            });

            jQuery('#customCheck3').each(function(index) {
                var input = jQuery(this);
                if (jQuery(this).is(':checked')){
                    input.removeClass('error');
                } else {
                    e.preventDefault();
                    input.addClass('error');
                    error = true;
                }
            });
        });
    }


    // Donation amount trigger

    jQuery("#xs-donate-charity").change(function(){
        var val = jQuery(this).val();

        if(val == 'custom'){
            jQuery("#xs-donate-name").val('');
        }else{
            jQuery("#xs-donate-name").val(val);
        }
    });

    jQuery( "#xs-donate-name" ).focus(function() {
        jQuery('#xs-donate-charity option[value=custom]').attr('selected','selected');
    });

    jQuery("#xs-donate-charity-amount").change(function(){
        var val = jQuery(this).val();
        if(val == 'custom'){
            jQuery("#xs-donate-name-modal").val('');
        }else{
            jQuery("#xs-donate-name-modal").val(val);
        }
    });


    jQuery("#xs-donate-charity-amount-form").change(function(){
        var val = jQuery(this).val();
        if(val == 'custom'){
            jQuery(".xs-donate-name-form").val('');
        }else{
            jQuery(".xs-donate-name-form").val(val);
        }
    });

    jQuery('.donation-from input[type="radio"]').on('change', function () {
		if (jQuery(this).is(':checked')) {
            let value = parseInt(jQuery(this).next().text(), 10);
			if (jQuery.type(value) === 'number') {
				jQuery('#inlineFormInputGroup').val(value).focus();
			} else {
				jQuery('#inlineFormInputGroup').val(' ')
			}
		}
	})

    jQuery( "#xs-donate-name-modal" ).focus(function() {
        jQuery('#xs-donate-charity-amount option[value=custom]').attr('selected','selected');
    });


    jQuery( ".xs-donate-name-form" ).focus(function() {
        jQuery('#xs-donate-charity-amount-form option[value=custom]').attr('selected','selected');
    });

    /*==========================================================
                easy pie chart init
    ======================================================================*/

    function pie_chart_init() {
        var chart = jQuery(".xs-pie-chart");
        if(chart.length > 0){
            chart.each(function () {
                jQuery(this).easyPieChart({
                    easing: 'easeOutBounce',
                    barColor:'#4CC899',
                    trackColor: '#E5E5E5',
                    lineWidth: 6,
                    scaleColor: 'transparent',
                    size: 120,
                    lineCap: 'round',
                    duration: 4500,
                    enabled: true,
                    onStep: function(from, to, percent) {
                        jQuery(this.el).find('.xs-pie-chart-percent').text(Math.round(percent));
                    }
                });
            });
        } // End exists

        var chart = jQuery(".xs-pie-chart-v2");
        if(chart.length > 0){
            chart.each(function () {
                jQuery(this).easyPieChart({
                    easing: 'easeOutBounce',
                    barColor:'#1B70F0',
                    trackColor: '#F4F4F4',
                    lineWidth: 6,
                    scaleColor: 'transparent',
                    size: 80,
                    lineCap: 'round',
                    duration: 5000,
                    enabled: true,
                    onStep: function(from, to, percent) {
                        jQuery(this.el).find('.xs-pie-chart-percent').text(Math.round(percent));
                    }
                });
            });
        } // End exists

        var chart = jQuery(".xs-pie-chart-v3");
        if(chart.length > 0){
            chart.each(function () {
                jQuery(this).easyPieChart({
                    easing: 'easeOutBounce',
                    barColor:'#011b58',
                    trackColor: '#F4F4F4',
                    lineWidth: 12,
                    scaleColor: 'transparent',
                    size: 120,
                    lineCap: 'square',
                    duration: 5000,
                    enabled: true,
                    onStep: function(from, to, percent) {
                        jQuery(this.el).find('.xs-pie-chart-percent').text(Math.round(percent));
                    }
                });
            });
        } // End exists

        jQuery(function () {
            jQuery('[data-toggle="tooltip"]').tooltip();
        })
    }
    jQuery(window).on('load', function() {

        setTimeout(function() {
            pie_chart_init();
        }, 500);

    });


    var number_percentage = jQuery(".number-percentage");
    function animateProgressBar(){
        number_percentage.each(function() {
            jQuery(this).animateNumbers(jQuery(this).attr("data-value"), true, parseInt(jQuery(this).attr("data-animation-duration"), 10));
            var value = jQuery(this).attr("data-value");
            var duration = jQuery(this).attr("data-animation-duration");
            jQuery(this).closest('.xs-skill-bar').find('.xs-skill-track').animate({
                width: value + '%'
            }, 4500);
        });
    }


    if (jQuery('.waypoint-tigger').length > 0) {
        var waypoint = new Waypoint({
            element: document.getElementsByClassName('waypoint-tigger'),
            handler: function(direction) {
                animateProgressBar();
            }
        });
    }



    /*==========================================================
            welcome skill bar
    =======================================================================*/
    if (jQuery('.xs-skill-bar-v2').length > 0) {
        jQuery('.xs-skill-bar-v2').each(function(){
            jQuery(this).find('.xs-skill-track').animate({
                width:jQuery(this).attr('data-percent')
            },4500);
        });
    }

    /*==========================================================
            cause matters skill bar
    =======================================================================*/
    if (jQuery('.xs-skill-bar-v3').length > 0) {
        jQuery('.xs-skill-bar-v3').each(function(){
            jQuery(this).find('.xs-skill-track').css({
                width:jQuery(this).attr('data-percent'),
            });
        });
    }
    /*==========================================================
            welcome number percentages
    =======================================================================*/
    if (jQuery('.number-percentages').length > 0) {
        jQuery('.number-percentages').each(function () {
            var $this = jQuery(this);

            jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
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

    jQuery.fn.animateNumbers = function(stop, commas, duration, ease) {
        return this.each(function() {
            var $this = jQuery(this);
            var start = parseInt($this.text().replace(/,/g, ""), 10);
            commas = (commas === undefined) ? true : commas;
            jQuery({
                value: start
            }).animate({
                value: stop
            }, {
                duration: duration == undefined ? 500 : duration,
                easing: ease == undefined ? "swing" : ease,
                step: function() {
                    $this.text(Math.floor(this.value));
                    if (commas) {
                        $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    }
                },
                complete: function() {
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
            countdown timer
    ======================================================================*/

    jQuery('.xs-countdown-timer[data-countdown]').each(function() {
        var $this = jQuery(this),
            finalDate = jQuery(this).data('countdown');

        $this.countdown(finalDate, function(event) {
            var $this = jQuery(this).html(event.strftime(' '
                + '<span class="timer-count">%-D <span class="timer-text">Days</span></span>  '
                + '<span class="timer-count">%H <span class="timer-text">Hours</span></span> '
                + '<span class="timer-count">%M <span class="timer-text">Minutes</span></span> '
                + '<span class="timer-count">%S <span class="timer-text">Seconds</span></span>'));
        });
    });

    jQuery('.xs-countdown-timer-v2[data-countdown]').each(function() {
        var $this = jQuery(this),
            finalDate = jQuery(this).data('countdown');

        $this.countdown(finalDate, function(event) {
            var $this = jQuery(this).html(event.strftime(' '
                + '<div class="xs-timer-container"><span class="timer-count">%-D </span><span class="timer-text">Days</span></div>'
                + '<div class="xs-timer-container"><span class="timer-count">%H </span><span class="timer-text">Hours</span></div>'
                + '<div class="xs-timer-container"><span class="timer-count">%M </span><span class="timer-text">Minutes</span></div>'
                + '<div class="xs-timer-container"><span class="timer-count">%S </span><span class="timer-text">Seconds</span></div>'));
        });
    });

    // product-thumbnail-lsit
	if (jQuery('.wf-product-thumbnail').length > 0) {
		let parent = jQuery('.wf-product-thumbnail'),
		$this = jQuery('.product-thumbnail-lsit'),
		child = $this.children(),
		length = child.length;
	
		if (child.length > 1) {
			child.css('max-width', (parent.outerWidth(true) / length));
		}
	}

	if (jQuery('.wf-product-preview').length > 0) {
		let parent = jQuery('.wf-product-preview'),
            $this = jQuery('.single-product-video'),
            child = jQuery('.single-product-video .woocommerce-product-gallery__image')
			childs = $this.children(),
			length = childs.length;
	
		if (child.length > 1) {
			child.css('max-width', (parent.outerWidth(true) / length));
        }
    }

})(jQuery);