<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function wf_donation_product_type_register() {

    /**
     * This should be in its own separate file.
     */
    class WC_Product_WF_Donation extends WC_Product
    {

        public function __construct($product)
        {

            $this->product_type = 'wf_donation';

            parent::__construct($product);

        }

    }

}