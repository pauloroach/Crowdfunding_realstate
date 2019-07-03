<?php
if ( ! defined( 'ABSPATH' ) ) exit;

    global $post;
    $reward_fields = get_post_meta($post->ID, 'repeatable_reward_fields', true);
    if($reward_fields) {
        foreach ($reward_fields as $field) {
            if (isset($field['_wf_pledge_amount']) && $field['_wf_pledge_amount'] != '') {
                $bg_style = 'background-color: ' . $field['_wf_reward_bg_color'] . ';';
            } else {
                $bg_style = '';
            }
            ?>
            <div class="xs-info-card xs-purple-bg fundpress-info-card xs-box-shadow xs-mb-30 color-white"
                 style="<?php echo $bg_style; ?>">
                <?php if (isset($field['_wf_pledge_amount']) && $field['_wf_pledge_amount'] != '') { ?>
                    <h3 class="xs-mb-30"><?php esc_html_e('Pledge ','wp-funsraising');?><?php echo wf_price($field['_wf_pledge_amount']); ?> <?php esc_html_e('or more','wp-funsraising');?></h3>
                <?php } ?>
                <?php if (isset($field['_wf_reward_title']) && $field['_wf_reward_title'] != '') { ?>
                    <h4 class="xs-mb-20"><?php echo $field['_wf_reward_title']; ?></h4>
                <?php } ?>

                <?php if (isset($field['_wf_reward_description']) && $field['_wf_reward_description'] != '') { ?>
                    <p class="xs-mb-20 xs-content-description fundpress-content-description"><?php echo $field['_wf_reward_description']; ?></p>
                <?php } ?>

                <?php if (isset($field['_wf_reward_offer']) && $field['_wf_reward_offer'] != '') { ?>
                    <span class="xs-mb-40"><?php echo $field['_wf_reward_offer']; ?></span>
                <?php } ?>

                <?php if (isset($field['_wf_reward_estimated_delivery_date']) || isset($field['_wf_reward_ships_to'])) { ?>
                    <div class="xs-spilit-container">

                        <?php if (isset($field['_wf_reward_estimated_delivery_date']) && $field['_wf_reward_estimated_delivery_date'] != '') { ?>
                            <div class="xs-info-card-times">
                                <?php echo wf_single_reward_estimated_delivery_text(); ?>
                                <h6><?php echo $field['_wf_reward_estimated_delivery_date']; ?></h6>
                            </div>
                        <?php } ?>
                        <?php if (isset($field['_wf_reward_ships_to']) && $field['_wf_reward_ships_to'] != '') { ?>
                            <div class="xs-info-card-times">
                                <?php echo wf_single_reward_ship_to_text(); ?>
                                <h6><?php echo $field['_wf_reward_ships_to']; ?></h6>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
    }
    ?>