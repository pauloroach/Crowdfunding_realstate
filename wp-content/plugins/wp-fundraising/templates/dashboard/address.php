<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$id 		= get_current_user_id();
// Billing Data
$shipping_first_name 	= get_user_meta( $id,'shipping_first_name',true );
$shipping_last_name	= get_user_meta( $id,'shipping_last_name',true );
$shipping_company	= get_user_meta( $id,'shipping_company',true );
$shipping_address_1 	= get_user_meta( $id,'shipping_address_1',true );
$shipping_address_2	= get_user_meta( $id,'shipping_address_2',true );
$shipping_city	= get_user_meta( $id,'shipping_city',true );
$shipping_postcode 	= get_user_meta( $id,'shipping_postcode',true );
$shipping_country 	= get_user_meta( $id,'shipping_country',true );
$shipping_state 		= get_user_meta( $id,'shipping_state',true );

// Shipping Data
$billing_first_name       = get_user_meta( $id,'billing_first_name',true );
$billing_last_name       = get_user_meta( $id,'billing_last_name',true );
$billing_company      = get_user_meta( $id,'billing_company',true );
$billing_address_1     = get_user_meta( $id,'billing_address_1',true );
$billing_address_2     = get_user_meta( $id,'billing_address_2',true );
$billing_city       = get_user_meta( $id,'billing_city',true );
$billing_postcode     = get_user_meta( $id,'billing_postcode',true );
$billing_country    = get_user_meta( $id,'billing_country',true );
$billing_state      = get_user_meta( $id,'billing_state',true );
$billing_phone      = get_user_meta( $id,'billing_phone',true );
$billing_email       = get_user_meta( $id,'billing_email',true );


?>
<div class="tab-pane slideUp" id="address" role="tabpanel">
    <ul class="nav nav-tabs xs-nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="shippingAddress-tab" data-toggle="tab" href="#shippingAddress" role="tab" aria-controls="shippingAddress" aria-selected="true"><?php esc_html_e('Shipping Address','wp-fundraising');?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="billingAddress-tab" data-toggle="tab" href="#billingAddress" role="tab" aria-controls="billingAddress" aria-selected="false"><?php esc_html_e('Billing Address','wp-fundraising');?></a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane xs-dashboard fade show active" id="shippingAddress" role="tabpanel" aria-labelledby="shippingAddress-tab">
            <form action="#" method="POST" class="xs-campaign xs-dashboard-info">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('First Name','wp-fundraising');?></h3>
                            <input type="text" readonly="readonly" disabled value="<?php echo $shipping_first_name; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Last Name','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $shipping_last_name; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Company','wp-fundraising');?></h3>
                    <input type="text" disabled value="<?php echo $shipping_company; ?>" class="form-control">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 01','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" disabled rows="3"><?php echo $shipping_address_1; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 02','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" disabled rows="3"><?php echo $shipping_address_2; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('City','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $shipping_city; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Postal Code','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $shipping_postcode; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Country','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $shipping_country; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('State','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $shipping_state; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="xs-btn-wraper">
                    <a href="#" class="btn btn-outline-success formEdit"><?php esc_html_e('Edit','wp-fundraising');?></a>
                </div>
            </form>
            <form action="#" method="POST" id="myShippingAddress" class="xs-campaign xs-dashboard-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('First Name','wp-fundraising');?></h3>
                            <input type="text" name="shipping_first_name" value="<?php echo $shipping_first_name; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Last Name','wp-fundraising');?></h3>
                            <input type="text" name="shipping_last_name" value="<?php echo $shipping_last_name; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Company','wp-fundraising');?></h3>
                    <input type="text" name="shipping_company" value="<?php echo $shipping_company; ?>" class="form-control">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 01','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" rows="3" name="shipping_address_1"><?php echo $shipping_address_1; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 02','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" rows="3" name="shipping_address_2"><?php echo $shipping_address_2; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('City','wp-fundraising');?></h3>
                            <input type="text" name="shipping_city" value="<?php echo $shipping_city; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Postal Code','wp-fundraising');?></h3>
                            <input type="text" name="shipping_postcode" value="<?php echo $shipping_postcode; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Country','wp-fundraising');?></h3>
                            <input type="text" name="shipping_country" value="<?php echo $shipping_country; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('State','wp-fundraising');?></h3>
                            <input type="text" name="shipping_state" value="<?php echo $shipping_state; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="xs-btn-wraper">
                    <a href="#" class="btn btn-outline-danger formCancel"><?php esc_html_e('Cancel','wp-fundraising');?></a>
                    <input class="btn btn-success" type="submit" name="userShippingUpdate" value="<?php esc_html_e('Save','wp-fundraising');?>" />
                </div>
            </form><!-- #myShippingAddress END -->
        </div>


        <div class="tab-pane xs-dashboard fade" id="billingAddress" role="tabpanel" aria-labelledby="billingAddress-tab">
            <form action="#" method="POST" class="xs-campaign xs-dashboard-info">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('First Name','wp-fundraising');?></h3>
                            <input type="text" readonly="readonly" disabled value="<?php echo $billing_first_name; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Last Name','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $billing_last_name; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Company','wp-fundraising');?></h3>
                    <input type="text" disabled value="<?php echo $billing_company; ?>" class="form-control">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 01','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" disabled rows="3"><?php echo $billing_address_1; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 02','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" disabled rows="3"><?php echo $billing_address_2; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('City','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $billing_city; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Postal Code','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $billing_postcode; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Country','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $billing_country; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('State','wp-fundraising');?></h3>
                            <input type="text" disabled value="<?php echo $billing_state; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Phone','wp-fundraising');?></h3>
                            <input type="tel" disabled value="<?php echo $billing_phone; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Email','wp-fundraising');?></h3>
                            <input type="email" disabled value="<?php echo $billing_email; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="xs-btn-wraper">
                    <a href="#" class="btn btn-outline-success formEdit"><?php esc_html_e('Edit','wp-fundraising');?></a>
                </div>
            </form>

            <form action="#" method="POST" id="myBillingAddress" class="xs-campaign xs-dashboard-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('First Name','wp-fundraising');?></h3>
                            <input type="text" id="adressBillingFName" class="form-control" name="billing_first_name" value="<?php echo $billing_first_name; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Last Name','wp-fundraising');?></h3>
                            <input type="text" id="adressBillingLName" class="form-control" name="billing_last_name" value="<?php echo $billing_last_name; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="h3"><?php esc_html_e('Company','wp-fundraising');?></h3>
                    <input type="text" name="billing_company" value="<?php echo $billing_company; ?>" class="form-control">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 01','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" id="adress_billing_one" name="billing_address_1" rows="3"><?php echo $billing_address_1; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Address 02','wp-fundraising');?></h3>
                            <textarea class="form-control form-control-sm" id="adress_billing_two" name="billing_address_2" rows="3"><?php echo $billing_address_2; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('City','wp-fundraising');?></h3>
                            <input type="text" id="adressBillingCity" class="form-control" name="billing_city" value="<?php echo $billing_city; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Postal Code','wp-fundraising');?></h3>
                            <input type="text" id="adress_billing_postal" class="form-control" name="billing_postcode" value="<?php echo $billing_postcode; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Country','wp-fundraising');?></h3>
                            <input type="text" id="adress_billing_country" class="form-control" name="billing_country" value="<?php echo $billing_country; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('State','wp-fundraising');?></h3>
                            <input type="text" id="adress_billing_State" class="form-control" name="billing_state" value="<?php echo $billing_state; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Phone','wp-fundraising');?></h3>
                            <input type="tel" name="billing_phone" value="<?php echo $billing_phone; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h3 class="h3"><?php esc_html_e('Email','wp-fundraising');?></h3>
                            <input type="email" name="billing_email" value="<?php echo $billing_email; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="xs-btn-wraper">
                    <a href="#" class="btn btn-outline-danger formCancel"><?php esc_html_e('Cancel','wp-fundraising');?>Cancel</a>
                    <input class="btn btn-success" type="submit" name="userBillingUpdate" value="<?php esc_html_e('Save','wp-fundraising');?>" />
                </div>
            </form><!-- #myDashAddress END -->
        </div>
    </div>
</div><!-- #address END -->