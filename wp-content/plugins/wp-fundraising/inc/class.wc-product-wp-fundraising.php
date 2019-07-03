<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function wf_product_type_register() {

    /**
     * This should be in its own separate file.
     */
    class WC_Product_WP_Fundraising extends WC_Product
    {

        public function __construct($product)
        {

            $this->product_type = 'wp_fundraising';

            parent::__construct($product);

        }

    }

}