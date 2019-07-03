<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $post;

// Get current page URL 
$wfSocialURL = urlencode(get_permalink());

// Get current page title
$wfSocialTitle = str_replace( ' ', '%20', get_the_title());

// Get Post Thumbnail for pinterest
$wfSocialThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

// Construct sharing URL without using any script
$twitterURL = 'https://twitter.com/intent/tweet?text='.$wfSocialTitle.'&amp;url='.$wfSocialURL.'&amp;via=wfSocial';
$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$wfSocialURL;
$googleURL = 'https://plus.google.com/share?url='.$wfSocialURL;
$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$wfSocialURL.'&amp;title='.$wfSocialTitle;

// Based on popular demand added Pinterest too
$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$wfSocialURL.'&amp;media='.$wfSocialThumbnail[0].'&amp;description='.$wfSocialTitle;



?>
<div class="xs-single-sidebar xs-mb-50">
    <div class="xs-social-list-wraper">
        <ul class="xs-social-list xs-social-list-v3 fundpress-social-list">
            <?php if (wf_get_option('_wf_enable_facebook', 'wf_social_share')=='on') { ?>
                <li><a href="<?php echo $facebookURL;?>" class="color-facebook xs-box-shadow full-round"><img src="<?php echo WP_FUNDRAISING_DIR_URL.'/assets/images/svg/facebook-f.svg';?>"></a></li>
            <?php } ?>
            <?php if (wf_get_option('_wf_enable_googleplus', 'wf_social_share')=='on') { ?>
                <li><a href="<?php echo $googleURL;?>" class="xs-box-shadow color-google-plus full-round"><img src="<?php echo WP_FUNDRAISING_DIR_URL.'/assets/images/svg/google-plus-g.svg';?>"></a></li>
            <?php } ?>
            <?php if (wf_get_option('_wf_enable_twitter', 'wf_social_share')=='on') { ?>
                <li><a href="<?php echo $twitterURL;?>" class="xs-box-shadow color-twitter full-round"><img src="<?php echo WP_FUNDRAISING_DIR_URL.'/assets/images/svg/twitter.svg';?>"></a></li>
            <?php } ?>
            <?php if (wf_get_option('_wf_enable_pinterest', 'wf_social_share')=='on') { ?>
                <li><a href="<?php echo $pinterestURL;?>" class="xs-box-shadow color-navy-blue full-round"><img src="<?php echo WP_FUNDRAISING_DIR_URL.'/assets/images/svg/pinterest-p.svg';?>"></a></li>
            <?php } ?>
            <?php if (wf_get_option('_wf_enable_linkedin', 'wf_social_share')=='on') { ?>
                <li><a href="<?php echo $linkedInURL;?>" class="xs-box-shadow color-linkedin full-round"><img src="<?php echo WP_FUNDRAISING_DIR_URL.'/assets/images/svg/linkedin-in.svg';?>"></a></li>
            <?php } ?>
        </ul>
    </div>
</div>