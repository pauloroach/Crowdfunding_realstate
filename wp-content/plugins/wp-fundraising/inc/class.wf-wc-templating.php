<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (! class_exists('WF_WC_Templating')) {

    class WF_WC_Templating{

        /**
         * @var mixed|void
         *
         * Get selected theme name
         */
        public $_theme;

        /**
         * @var string
         * Return theme path in wp theme
         */
        public $_theme_in_themes_path;

        /**
         * @var string
         * Return theme in WP Fundraising directory
         */
        public $_theme_in_plugin_path;

        /**
         * @var string
         *
         * Return selected theme directory, whaterver it is plugin or theme directory
         */
        public $_selected_theme_path;

        /**
         * @var string
         *
         * Return selected theme file, whaterver it is plugin or theme directory
         */
        public $_selected_theme;

        public $_selected_theme_uri;


        public $_vendor;


        /**
         * @var
         * Get vendor path in plugin directory
         */
        public $_vendor_path;


        protected static $_instance;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct() {

            add_filter( 'template_include', array( $this, 'wf_wc_template_chooser' ), 99);

        }

        public function wf_wc_template_chooser($template){
            //Set Theme
            $this->_theme_in_themes_path = get_stylesheet_directory()."/templates/{$this->_vendor}/{$this->_theme}/";
            $this->_theme_in_plugin_path = WP_FUNDRAISING_DIR_PATH."templates/{$this->_vendor}/{$this->_theme}/";
            $this->_vendor_path = WP_FUNDRAISING_DIR_PATH."templates/{$this->_vendor}/";

            $single_template_path = $this->_theme_in_themes_path."single-campaign.php";
            $single_plugin_path = $this->_theme_in_plugin_path."single-campaign.php";

            if (file_exists($single_template_path)){
                $this->_selected_theme_path = $this->_theme_in_themes_path;
                $this->_selected_theme = $single_template_path;

                $this->_selected_theme_uri = get_stylesheet_directory_uri()."/templates/{$this->_vendor}/{$this->_theme}/";
            } elseif(file_exists($single_plugin_path)) {

                $this->_selected_theme_path = $this->_theme_in_plugin_path;
                $this->_selected_theme = $single_plugin_path;

                $this->_selected_theme_uri = WP_FUNDRAISING_DIR_PATH."/templates/{$this->_vendor}/{$this->_theme}/";

            }

            $post_id = get_the_ID();
            $post_type = get_post_type($post_id);

            //Check is single page
            if (is_single()) {
                //Check is woocommerce activate
                if (function_exists('wc_get_product')) {
                    $product = wc_get_product($post_id);
                    if ($post_type === 'product') {
                        if (($product->get_type() === 'wp_fundraising') || ($product->get_type() === 'wf_donation')) {
                            if (file_exists($this->_selected_theme)) {
                                $template = $this->_selected_theme;
                            }
                        }
                    }
                }
            }
            return $template;
        }
    }
}
WF_WC_Templating::instance();