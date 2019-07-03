<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if (!class_exists('WP_FundRaising_Donation')) {
    class WP_FundRaising_Donation{
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
        public $plugin_name = 'WP Fundraising';

        /**
         * Plugin Version
         *
         * @since 1.0
         *
         */

        public $plugin_version = '1.0.0';

        /**
         * Plugin File
         *
         * @since 1.0
         *
         */

        public $file = __FILE__;


        public $base;


        /**
         * Load Construct
         * @since 1.0
         *
         */

        public function __construct()
        {
            $this->wp_donation_plugin_init();
        }

        /**
         * Plugin Initialization
         * @since 1.0
         *
         */

        public function wp_donation_plugin_init()
        {
            add_filter( 'product_type_selector', array(&$this, 'wf_donation_add_product' ));
            add_action( 'admin_footer', array(&$this, 'wf_donation_custom_js' ));
            add_filter( 'woocommerce_product_data_tabs', array(&$this, 'wf_donation_product_tabs' ));
            add_action( 'woocommerce_product_data_panels', array(&$this, 'wf_donation_options_product_tab_content' ));
            add_action( 'woocommerce_product_data_panels', array(&$this, 'wf_options_product_donation_level_tab_content' ));
            add_action( 'woocommerce_process_product_meta_wf_donation', array(&$this, 'wf_save_donation_option_field'  ));
            add_action( 'woocommerce_process_product_meta_wf_donation', array(&$this, 'wf_save_donation_level_option_field'  ));
            add_filter( 'woocommerce_product_data_tabs', array(&$this, 'wf_hide_donation_tab_panel' ));

        }


        /**
         * Add to product type drop down.
         */
        public function wf_donation_add_product( $types ){

            // Key should be exactly the same as in the class
            $types[ 'wf_donation' ] = esc_html__( 'WP Fundraising Donation' );

            return $types;

        }

        /**
         * Show pricing fields for simple_rental product.
         */
        public function wf_donation_custom_js() {

            if ( 'product' != get_post_type() ) :
                return;
            endif;

            ?><script type='text/javascript'>
                jQuery( document ).ready( function() {
                    jQuery( '.options_group.pricing' ).addClass( 'show_if_wf_donation' ).show();
                });

            </script><?php

        }

        /**
         * Add a custom product tab.
         */
        function wf_donation_product_tabs( $original_prodata_tabs) {

            $fundraising_tab = array(
                'donation' => array( 'label' => esc_html__( 'Donation', 'wp-fundraising' ), 'target' => 'wf_donation_options', 'class' => array( 'show_if_wf_donation' ), ),
                'donation_level' => array( 'label' => esc_html__( 'Donation Level', 'wp-fundraising' ), 'target' => 'wf_donation_level_options', 'class' => array( 'show_if_wf_donation' ), ),
            );
            $insert_at_position = 2; // Change this for desire position
            $tabs = array_slice( $original_prodata_tabs, 0, $insert_at_position, true ); // First part of original tabs
            $tabs = array_merge( $tabs, $fundraising_tab ); // Add new
            $tabs = array_merge( $tabs, array_slice( $original_prodata_tabs, $insert_at_position, null, true ) ); // Glue the second part of original
            return $tabs;
        }


        /**
         * Contents of the WP_FundRaising_Donation options product tab.
         */
        public function wf_donation_options_product_tab_content() {

            global $post;

            ?><div id='wf_donation_options' class='panel woocommerce_options_panel'><?php

            ?><div class='donation_options_group'><?php


            woocommerce_wp_text_input(
                array(
                    'id'            => '_wfd_funding_goal',
                    'label'         => esc_html__( 'Donation Goal ('.get_woocommerce_currency_symbol().')', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Donation goal','wp-fundraising' ),
                    'description'   => esc_html__('Enter the funding goal', 'wp-fundraising' ),
                    'desc_tip'      => true,
                    'type' 			=> 'text',
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id'            => '_wfd_duration_start',
                    'label'         => esc_html__( 'Start date- mm/dd/yyyy or dd-mm-yyyy', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Start time of this campaign', 'wp-fundraising' ),
                    'description'   => esc_html__( 'Enter start of this campaign', 'wp-fundraising' ),
                    'desc_tip'      => true,
                    'type' 			=> 'text',
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id'            => '_wfd_duration_end',
                    'label'         => esc_html__( 'End date- mm/dd/yyyy or dd-mm-yyyy', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'End time of this campaign', 'wp-fundraising' ),
                    'description'   => esc_html__( 'Enter end time of this campaign', 'wp-fundraising' ),
                    'desc_tip'      => true,
                    'type' 			=> 'text',
                )
            );

            woocommerce_wp_text_input(
                array(
                    'id'            => '_wfd_funding_video',
                    'label'         => esc_html__( 'Video Url', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Video url', 'wp-fundraising' ),
                    'desc_tip'      => true,
                    'description'   => esc_html__( 'Enter a video url to show your video in campaign details page', 'wp-fundraising' )
                )
            );


            echo '<div class="options_group"></div>';


            //Get country select
            $countries_obj      = new WC_Countries();
            $countries          = $countries_obj->__get('countries');
            array_unshift($countries, 'Select a country');

            //Country list
            woocommerce_wp_select(
                array(
                    'id'            => '_wfd_country',
                    'label'         => esc_html__( 'Country', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Country', 'wp-fundraising' ),
                    'class'         => 'select2 _wf_country',
                    'options'       => $countries
                )
            );

            // Location of this campaign
            woocommerce_wp_text_input(
                array(
                    'id'            => '_wfd_location',
                    'label'         => esc_html__( 'Location', 'wp-fundraising' ),
                    'placeholder'   => esc_attr__( 'Location', 'wp-fundraising' ),
                    'description'   => esc_html__( 'Location of this campaign','wp-fundraising' ),
                    'desc_tip'      => true,
                    'type'          => 'text'
                )
            );
            do_action( 'new_donation_campaign_option' );


            echo '</div>';

            ?></div><?php


        }

        /**
         * Save the custom fields.
         */
        public function wf_save_donation_option_field( $post_id ) {

            if (isset($_POST['_wfd_funding_goal'])) :
                update_post_meta($post_id, '_wfd_funding_goal', sanitize_text_field($_POST['_wfd_funding_goal']));
            endif;

            if (isset($_POST['_wfd_duration_start'])) :
                update_post_meta($post_id, '_wfd_duration_start', sanitize_text_field($_POST['_wfd_duration_start']));
            endif;

            if (isset($_POST['_wfd_duration_end'])) :
                update_post_meta($post_id, '_wfd_duration_end', sanitize_text_field($_POST['_wfd_duration_end']));
            endif;

            if (isset($_POST['_wfd_funding_video'])) :
                update_post_meta($post_id, '_wfd_funding_video', sanitize_text_field($_POST['_wfd_funding_video']));
            endif;

            if (isset($_POST['_wfd_country'])) :
                update_post_meta($post_id, '_wfd_country', sanitize_text_field($_POST['_wfd_country']));
            endif;

            if (isset($_POST['_wfd_location'])) :
                update_post_meta($post_id, '_wfd_location', sanitize_text_field($_POST['_wfd_location']));
            endif;
            update_post_meta( $post_id, '_sale_price', '0' );
            update_post_meta( $post_id, '_price', '0' );
        }




        /**
         * Contents of the wp_fundraising options product donation_level tab.
         */
        public function wf_options_product_donation_level_tab_content() {

            ?><div id='wf_donation_level_options' class='panel woocommerce_options_panel'><?php

            global $post;

            $donation_level_fields = get_post_meta($post->ID, 'repeatable_donation_level_fields', true);

            ?>
            <script type="text/javascript">
                jQuery(document).ready(function( $ ){
                    $( '#add-donation-level-row' ).on('click', function() {
                        var row = $( '.empty-donation-level-row.screen-reader-text' ).clone(true);
                        row.removeClass( 'empty-donation-level-row screen-reader-text' );
                        row.insertBefore( '#repeatable-donation-fieldset > div.donation_level-item:last' );
                        return false;
                    });

                    $( '.remove-donation-level-row' ).on('click', function() {
                        $(this).parents('.donation_level-item').remove();
                        return false;
                    });
                });
            </script>

            <div id="repeatable-donation-fieldset">
                <?php

                if ( $donation_level_fields ) :

                    foreach ( $donation_level_fields as $field ) {

                        ?>
                        <div class="options_group donation_level-item">
                            <p class="form-field _wf_donation_level_amount_field ">
                                <label for="_wf_donation_level_amount"><?php esc_html_e('Pledge Amount','wp-fundraising');?></label>
                                <input type="text" class="short" name="_wf_donation_level_amount[]" value="<?php if(isset($field['_wf_donation_level_amount']) && $field['_wf_donation_level_amount'] != '') echo sanitize_text_field( $field['_wf_donation_level_amount'] ); ?>" />
                            </p>
                            <p class="form-field _wf_donation_level_title_field ">
                                <label for="_wf_donation_level_title"><?php esc_html_e('Donation Level Title','wp-fundraising');?></label>
                                <input type="text" class="short" name="_wf_donation_level_title[]" value="<?php if(isset($field['_wf_donation_level_title']) && $field['_wf_donation_level_title'] != '') echo sanitize_text_field( $field['_wf_donation_level_title'] ); ?>" />
                            </p>
                            <p class="form-field _wf_donation_level_description_field ">
                                <label for="_wf_donation_level_description"><?php esc_html_e('Donation Level Description','wp-fundraising');?></label>
                                <textarea name="_wf_donation_level_description[]"><?php if(isset($field['_wf_donation_level_description']) && $field['_wf_donation_level_description'] != '') echo sanitize_textarea_field( $field['_wf_donation_level_description'] ); ?></textarea>
                            </p>
                            <p class="form-field "><a class="button remove-donation-level-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>

                        </div><?php
                    }

                else:
                ?><div class="options_group donation_level-item"><?php
                    ?>
                    <p class="form-field _wf_donation_level_amount_field ">
                        <label for="_wf_donation_level_amount"><?php esc_html_e('Pledge Amount','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_donation_level_amount[]" />
                    </p>
                    <p class="form-field _wf_donation_level_title_field ">
                        <label for="_wf_donation_level_title"><?php esc_html_e('Donation Level Title','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_donation_level_title[]" />
                    </p>
                    <p class="form-field _wf_donation_level_description_field ">
                        <label for="_wf_donation_level_description"><?php esc_html_e('Donation Level Description','wp-fundraising');?></label>
                        <textarea name="_wf_donation_level_description[]"></textarea>
                    </p>
                    <p class="form-field "><a class="button remove-donation-level-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>


                    </div><?php
                endif; ?>

                <div class="options_group donation_level-item empty-donation-level-row screen-reader-text">
                    <p class="form-field _wf_donation_level_amount_field ">
                        <label for="_wf_donation_level_amount"><?php esc_html_e('Pledge Amount','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_donation_level_amount[]" />
                    </p>
                    <p class="form-field _wf_donation_level_title_field ">
                        <label for="_wf_donation_level_title"><?php esc_html_e('Donation Level Title','wp-fundraising');?></label>
                        <input type="text" class="short" name="_wf_donation_level_title[]" />
                    </p>
                    <p class="form-field _wf_donation_level_description_field ">
                        <label for="_wf_donation_level_description"><?php esc_html_e('Donation Level Description','wp-fundraising');?></label>
                        <textarea name="_wf_donation_level_description[]"></textarea>
                    </p>
                    <p class="form-field "><a class="button remove-donation-level-row" href="#"><?php esc_html_e('Remove','wp-fundraising');?></a></p>

                </div>
            </div>

            <p><a id="add-donation-level-row" class="button" href="#"><?php esc_html_e('Add another','wp-fundraising');?></a></p>

            <?php

            ?></div><?php


        }

        /**
         * Save the custom fields.
         */
        public function wf_save_donation_level_option_field( $post_id ) {

            $old = get_post_meta($post_id, 'repeatable_donation_level_fields', true);
            $new = array();

            $names = $_POST['_wf_donation_level_amount'];
            $title = $_POST['_wf_donation_level_title'];
            $description = $_POST['_wf_donation_level_description'];

            $count = count( $names );

            for ( $i = 0; $i < $count; $i++ ) {
                if ( $names[$i] != '' ) :
                    $new[$i]['_wf_donation_level_amount'] = stripslashes( strip_tags( $names[$i] ) );
                    $new[$i]['_wf_donation_level_title'] = stripslashes( strip_tags( $title[$i] ) );
                    $new[$i]['_wf_donation_level_description'] = stripslashes( strip_tags( $description[$i] ) );
                endif;
            }

            if ( !empty( $new ) && $new != $old )
                update_post_meta( $post_id, 'repeatable_donation_level_fields', $new );
            elseif ( empty($new) && $old )
                delete_post_meta( $post_id, 'repeatable_donation_level_fields', $old );

        }




        /**
         * Hide Attributes data panel.
         */
        public function wf_hide_donation_tab_panel( $tabs) {

            $tabs['general']['class'] = array( 'hide_if_wf_fundraising','hide_if_wf_donation','hide_if_external', 'hide_if_grouped', 'hide_if_variable' );
            $tabs['fundraising']['class'] = array( 'show_if_wf_fundraising','hide_if_wf_donation','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );
            $tabs['donation']['class'] = array( 'show_if_wf_donation','hide_if_wf_fundraising','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );
            $tabs['donation_level']['class'] = array( 'show_if_wf_donation','hide_if_wf_fundraising','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );
            $tabs['reward']['class'] = array( 'show_if_wf_fundraising','hide_if_wf_donation','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );
            $tabs['update']['class'] = array( 'show_if_wf_fundraising','hide_if_wf_donation','hide_if_external', 'hide_if_grouped', 'hide_if_simple', 'hide_if_variable' );

            return $tabs;

        } 

        public static function wf_donation_get_instance()
        {
            if (!isset(self::$_instance)) {
                self::$_instance = new WP_FundRaising_Donation();
            }
            return self::$_instance;
        }


    }

}