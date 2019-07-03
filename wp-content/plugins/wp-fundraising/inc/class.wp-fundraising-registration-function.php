<?php

class WP_Fundraising_Registration_Function{

    /**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
    public static $_instance;
    /**
     * Plugin Name
     *
     * @since 1.0
     *
     */
    public $plugin_name = 'WP Fundraising Login and Registration';

    /**
     * Plugin Version
     *
     * @since 1.0
     *
     */

    public $plugin_version = '1.0';

    /**
     * Plugin File
     *
     * @since 1.0
     *
     */

    public $file = __FILE__;

    /**
     *
     * Create New User registration.
     *
     */

    public function __construct(){
        add_action('wp_ajax_nopriv_wp_fundraising_create_user', array($this,'wp_fundraising_create_user'));
        add_action('wp_ajax_wp_fundraising_create_user',  array($this,'wp_fundraising_create_user'));

        add_action('wp_ajax_nopriv_wp_fundraising_login', array($this,'wp_fundraising_login'));
        add_action('wp_ajax_wp_fundraising_login',  array($this,'wp_fundraising_login'));

        add_action('wp_ajax_nopriv_wp_fundraising_resetpassword', array($this,'wp_fundraising_resetpassword'));
        add_action('wp_ajax_wp_fundraising_resetpassword',  array($this,'wp_fundraising_resetpassword'));
    }

    public function wp_fundraising_create_user() {

        check_ajax_referer('wp_fundraising_security_check', 'wp_fundraising_security');
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

            $data = array();
            $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
            $user_email_address = isset($_POST['user_email_address']) ? $_POST['user_email_address'] : '';
            $user_password = isset($_POST['user_password']) ? $_POST['user_password'] : '';
//            $captcha = isset($_POST['recaptcha']) ? $_POST['recaptcha'] : '';
//
//            if(!$captcha){
//                $data['captcha_error'] = 'Please check the captcha form.';
//            }
            if ( email_exists( $user_email_address ) ){
                $data['status'] = 'error';
                $data['msg'] = 'Email already exists!';
            }
            if ( username_exists( $user_name ) ){
                $data['status'] = 'error';
                $data['msg'] = 'User Name already exists!';
            }

            if(!isset($data['status']) && empty($msg['status'])){
                $userdata = array(
                    "user_pass"		=> $user_password,
                    "user_login"	=> $user_name,
                    "user_email"	=> sanitize_email($user_email_address),
                );

                $userid = wp_insert_user( $userdata );

                if (!is_wp_error( $userid ) ) {
                    $data['status'] = 'success';
                    $error_msg = 'Registration is completed but system could not send you email with login detail, please contact site admin';
                    $data['msg'] = $this->wp_fundraising_sendmail(sanitize_email($user_email_address),"New Registration", "Thanks For your registration",'register');
                }else{
                    $data['status'] = 'error';
                    $data['msg'] = $userid -> get_error_message();
                }

            }
            echo json_encode($data);
            wp_die();
        }
    }

    public function wp_fundraising_login(){
        check_ajax_referer('wp_fundraising_security_check', 'wp_fundraising_security');
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            $data = array();
            $user_name 		= sanitize_user($_POST['user_name']);
            $user_password 	= $_POST['user_password'];
            $user = get_user_by( 'login', $user_name );



            $captcha = isset($_POST['recaptcha']) ? $_POST['recaptcha'] : '';

            if(!$captcha){
                $data['captcha_error'] = 'Please check the captcha form.';
            }



            if ( ! $user && strpos( $user_name, '@' ) ) {
                $user = get_user_by( 'email', $user_name );
            }
            if($user){
                $userdata = array(
                    'user_login'    => $user->data->user_login,
                    'user_password' => $user_password,
                    'remember'      => false
                );

                $userid = wp_signon($userdata);

                if ( is_wp_error($userid) ){
                    $data['status'] = 'error';
                    $data['msg'] = 'Invalid username or password';
                }else{
                    $user_details	 = new WP_User($userid);
                    $data['name']	 = $user_details->display_name;
                    $data['status'] = esc_html__('success', 'wp-fundraising' );
                    //$data['msg'] 	 = esc_html__('Thank you for you login', 'wp-fundraising' );
                }
            }
            else{
                $data['status'] = 'error';
                $data['msg'] = "Invalid username or password";
            }
            echo json_encode($data);
            wp_die();
        }
    }

    /**
     *
     * Reset Password
     *
     */

    public function wp_fundraising_resetpassword(){
        check_ajax_referer('wp_fundraising_security_check', 'wp_fundraising_security');
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            $data = array();
            $user_name 		= sanitize_user($_POST['user_name']);
            $user = get_user_by( 'login', $user_name );

            if ( ! $user && strpos( $user_name, '@' ) ) {
                $user = get_user_by( 'email', $user_name );
            }

            if($user){
                $user_password = wp_generate_password( 12, true );
                $user_email_address =  $user->data->user_email;
                $user_name =  $user->data->user_login;
                wp_set_password( $user_password, $user->data->ID);
                $data['status'] = 'success';
                $error_msg = 'Password reset successfully but system could not send you email with login detail, please contact site admin';
                $data['msg'] = $this->wp_fundraising_sendmail(sanitize_email($user_email_address), "Password Reset", "your password reset successfully.your login details.<br> Username: {$user_name}<br> password: {$user_password}", 'reset');
            }
            else{
                $data['status'] = 'error';
                $data['msg'] = "Invalid username";
            }
            echo json_encode($data);
            wp_die();
        }
    }


    /**
     *
     * Mail function
     *
     */

    public function wp_fundraising_sendmail($email,$suject,$msg,$msg_status){

        $mail = array();
        $site_title = get_bloginfo();
        $admin_email = get_option('admin_email');

        $headers[] = "From: {$site_title} <{$admin_email}>";
        $headers[] = "Content-Type: text/html";
        $headers[] = "MIME-Version: 1.0\r\n";

        $suject    = sprintf(esc_html__('%s','wp-fundraising'),$suject);
        $msg 	   = sprintf(esc_html__('%s','wp-fundraising'),$msg);

        if(wp_mail($email, $suject, $msg, $headers)){
            if($msg_status == 'register'){
                return 'Thank you for your registration.you can login now';
            }else{
                return 'Your password reset successfully.Please check your mail with login details.';
            }
        }else{
            return "Your server not able to send mail";
        }

    }
    public static function wp_fundraising_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new WP_Fundraising_Registration_Function();
        }
        return self::$_instance;
    }

}
WP_Fundraising_Registration_Function::wp_fundraising_get_instance();