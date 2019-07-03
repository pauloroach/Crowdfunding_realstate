(function ($) {

    'use strict';

    $('.xs_reset_switch').on('click', function (e) {
        $('#wp_fundraising_reset_form').show('slow');
        $('#wp_fundraising_login_form').hide('slow');
        $('.xs_reset_switch').hide('slow');
        $('.xs_login_switch').show('slow');
    });
    $('.xs_login_switch').on('click', function (e) {
        $('#wp_fundraising_login_form').show('slow');
        $('#wp_fundraising_reset_form').hide('slow');
        $('.xs_reset_switch').show('slow');
        $('.xs_login_switch').hide('slow');
    });

    /**
     *
     * Create New User Ajax Call
     *
     */

    $('#wp_fundraising_register_form').on('submit', function (e) {
        e.preventDefault();

        var user_name = $("#xs_register_name").val();
        var user_email_address = $("#xs_register_email").val();
        var user_password = $("#xs_register_password").val();
        var required = 0;

        $(".fundpress-required", this).each(function () {
            if ($(this).val() === '') {
                $(this).addClass('reqError');
                required += 1;
            }
            else {
                if ($(this).hasClass('reqError')) {
                    $(this).removeClass('reqError');
                    if (required > 0) {
                        required -= 1;
                    }
                }
            }
        });

        if (required === 0) {
            $.ajax({
                url: wp_fundraising_check_obj.ajaxurl,
                type: 'post',
                dataType: 'Json',
                data: {
                    action: 'wp_fundraising_create_user',
                    user_name: user_name,
                    user_email_address: user_email_address,
                    user_password: user_password,
                    wp_fundraising_security: wp_fundraising_check_obj.ajax_nonce
                },
                success: function (response) {
                    var response = JSON.parse(JSON.stringify(response));
                    console.log(response);
                    if (response.status === 'success') {
                        $('#wp_fundraising_msg').show().text(response.msg).addClass('auth_success');
                        $('#wp_fundraising_register_form')[0].reset();
                    } else {
                        $('#wp_fundraising_msg').show().text(response.msg).addClass('auth_error');
                    }
                }
            });
        }
    });

    /**
     *
     * Check user login
     *
     */

    $('#wp_fundraising_login_form').on('submit', function (e) {
        e.preventDefault();

        var user_name = $("#login_user_name").val();
        var user_password = $("#login_user_pass").val();
        var required = 0;

        $(".fundpress-required", this).each(function () {
            if ($(this).val() === '') {
                $(this).addClass('reqError');
                required += 1;
            }
            else {
                if ($(this).hasClass('reqError')) {
                    $(this).removeClass('reqError');
                    if (required > 0) {
                        required -= 1;
                    }
                }
            }
        });

        if (required === 0) {
            $.ajax({
                url: wp_fundraising_check_obj.ajaxurl,
                type: 'post',
                dataType: 'Json',
                data: {
                    action: 'wp_fundraising_login',
                    user_name: user_name,
                    user_password: user_password,
                    wp_fundraising_security: wp_fundraising_check_obj.ajax_nonce
                },
                success: function (response) {
                    var response = JSON.parse(JSON.stringify(response));
                    console.log(response);
                    if (response.status === 'success') {
                        location.reload();
                    } else {
                        $('#wp_fundraising_msg').show().text(response.msg).addClass('auth_error');
                    }
                }
            });
        }
    });

    /**
     *
     * Reset Password
     *
     */

    $('#wp_fundraising_reset_form').on('submit', function (e) {
        e.preventDefault();

        var reset_username = $("#reset_username").val();
        var required = 0;

        $(".fundpress-required", this).each(function () {
            if ($(this).val() === '') {
                $(this).addClass('reqError');
                required += 1;
            }
            else {
                if ($(this).hasClass('reqError')) {
                    $(this).removeClass('reqError');
                    if (required > 0) {
                        required -= 1;
                    }
                }
            }
        });
        if (required === 0) {
            $("#ps_reset_submit").val('Processsing...');
            $.ajax({
                url: wp_fundraising_check_obj.ajaxurl,
                type: 'post',
                dataType: 'Json',
                data: {
                    action: 'wp_fundraising_resetpassword',
                    user_name: reset_username,
                    wp_fundraising_security: wp_fundraising_check_obj.ajax_nonce
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#wp_fundraising_msg').show().text(response.msg).addClass('auth_success');
                    } else {
                       // $('#wp_fundraising_msg').addClass('auth_error');
                        $('#wp_fundraising_msg').show().text(response.msg).addClass('auth_error');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });

})(jQuery);