<?php 
$campaign_id = wf_get_option('_wf_feature_campaign_id', 'wf_donation'); 
if(!isset($campaign_id)){
    $campaign_id = wf_get_option('_wf_feature_campaign_id', 'wf_donation');
}
$donation_level_fields = get_post_meta($campaign_id, 'repeatable_donation_level_fields', true);

?>
<?php if($args['style'] == "1"){ ?>
<form enctype="multipart/form-data" method="post" class="cart xs-donation-form" >
    <div class="xs-input-group">
        <label for="xs-donate-name"><?php esc_html_e('Donation Amount ','wp-fundraising');?><span class="color-light-red">**</span></label>
        <input type="text" name="wp_donate_amount_field" id="xs-donate-name-form" class="form-control xs-donate-name-form" placeholder="<?php esc_attr_e('Enter Amount','wp-fundraising');?>">
    </div>
    <?php

    
    ?>
    <?php if ( $donation_level_fields ) : ?>
        <div class="xs-input-group">
            <label for="xs-donate-charity-amount-form"><?php esc_html_e('List of Donation Level','wp-fundraising');?> <span class="color-light-red" >**</span></label>
            <select id="xs-donate-charity-amount-form" class="form-control">
                <option value=""><?php esc_html_e('Select Amount','wp-fundraising');?></option>
                <?php foreach ( $donation_level_fields as $field ) { ?>
                    <option value="<?php echo esc_attr( $field['_wf_donation_level_amount'] ); ?>"><?php echo wf_price(esc_attr( $field['_wf_donation_level_amount'] )); ?></option>
                <?php } ?>
                <option value="custom"><?php esc_html_e('Give a Custom Amount','wp-fundraising');?></option>
            </select>
        </div>
    <?php endif; ?>

    <?php do_action('after_wf_donate_field'); ?>
    <input type="hidden" value="<?php echo esc_attr($campaign_id); ?>" name="add-to-cart">
    <button type="submit" class="btn btn-primary"><span class="badge"><i class="fa fa-heart"></i></span> <?php echo wf_donate_now_button_text(); ?></button>
</form>
<?php }else{ ?>
    <div class="donation-form-content text-center">
        <form enctype="multipart/form-data" class="donation-from" method="post">
            <div class="form-inline">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="wp_donate_amount_field" min="1" class="form-control" id="inlineFormInputGroup" placeholder="Amount">
                </div>
                <div class="select-amaunt-group">
                    <span><?php esc_html_e('Select Amount:','wp-fundraising');?></span>
                    <?php $i = 1; foreach ( $donation_level_fields as $field ) { ?>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="amaunt-<?php echo esc_attr($i);?>" name="amaunt" class="custom-control-input">
                        <label class="custom-control-label" for="amaunt-<?php echo esc_attr($i);?>"><?php echo esc_attr( $field['_wf_donation_level_amount'] ); ?></label>
                    </div>
                    <?php $i++; } ?>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="amaunt-other" name="amaunt" class="custom-control-input">
                        <label class="custom-control-label" for="amaunt-other"><?php esc_html_e('Other','wp-fundraising');?></label>
                    </div>
                </div>
            </div>
            <div class="xs-btn-wraper">
                <?php do_action('after_wf_donate_field'); ?>
                <input type="hidden" value="<?php echo esc_attr($campaign_id); ?>" name="add-to-cart">
                <button type="submit" class="donation-btn"><span class="badge"><i class="fa fa-heart"></i></span> <?php echo wf_donate_now_button_text(); ?></button>
            </div>
        </form>
    </div>
<?php } ?>
