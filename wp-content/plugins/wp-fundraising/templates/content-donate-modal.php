<?php
    global $post;
?>
<div class="modal xs-modal fade <?php echo wf_donate_modal_class();?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="xs-donation-form-wraper" >
                <?php echo wf_donate_modal_heading();?>
                <form enctype="multipart/form-data" method="post" class="cart xs-donation-form" >
                    <div class="xs-input-group">
                        <label for="xs-donate-name-modal"><?php esc_html_e('Donation Amount','wp-fundraising');?> <span class="color-light-red">**</span></label>
                        <input type="text" name="wp_donate_amount_field" id="xs-donate-name-modal" class="form-control" placeholder="<?php esc_attr_e('Enter Amount','wp-fundraising');?>">
                    </div>
                    <?php echo wp_fundraising_output_donation_level(); ?>
                    <?php do_action('after_wf_donate_field'); ?>
                    <input type="hidden"  name="add-to-cart" value="<?php echo wf_get_option('_wf_feature_campaign_id', 'wf_donation'); ?>"/>
                    <button type="submit" class="btn btn-primary"><span class="badge"><i class="fa fa-heart"></i></span> <?php echo wf_donate_now_button_text(); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>