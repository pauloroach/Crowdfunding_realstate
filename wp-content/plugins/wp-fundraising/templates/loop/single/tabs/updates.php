<?php
if ( ! defined( 'ABSPATH' ) ) exit;

    global $post;
    $update_fields = get_post_meta($post->ID, 'repeatable_update_fields', true);
    if($update_fields){
    ?><div class="xs-ul-list fundpress-content-text-list-wraper">
		<ul class="fundpress-content-text-list xs-content-text-list"><?php
    foreach($update_fields as $update){

        $update_date = $update['_wf_update_date'];
        $update_title = $update['_wf_update_title'];
        $update_description = $update['_wf_update_description'];
        $update_url = $update['_wf_update_url'];
        ?>
        <li>
            <?php if(isset($update_date) && $update_date != ''){ ?>
                <p class="xs-content-description fundpress-content-description color-navy-blue"><?php echo $update_date; ?></p>
            <?php } ?>
            <?php if(isset($update_title) && $update_title != ''){ ?>
                <div class="fundpress-title-text-content">
                    <h4 class="color-navy-blue medium margin-bottom-0"><?php echo $update_title; ?></h4>
                </div>
            <?php } ?>
            <?php if(isset($update_description) && $update_description != ''){ ?>
                <p class="xs-content-description fundpress-content-description xs-mb-30"><?php echo $update_description; ?></p>
            <?php } ?>
            <p class="xs-content-description fundpress-content-description color-navy-blue"><?php echo esc_html__('Here\'s the link:','wp-fundraising');?></p>
            <?php if(isset($update_url) && $update_url != ''){ ?>
                <a href="<?php echo $update_url; ?>" class="color-green">
                    <?php echo $update_url; ?>
                </a>
            <?php } ?>

        </li>


        <?php
    }
    ?>
        </ul>
    </div>
<?php } ?>