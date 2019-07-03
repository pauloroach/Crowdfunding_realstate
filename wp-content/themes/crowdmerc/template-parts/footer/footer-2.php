<?php
$facebook = crowdmerc_option( 'facebook',crowdmerc_defaults('facebook') );
$twitter = crowdmerc_option( 'twitter',crowdmerc_defaults('twitter') );
$dribbble = crowdmerc_option( 'dribbble',crowdmerc_defaults('dribbble') );
$pinterest = crowdmerc_option( 'pinterest',crowdmerc_defaults('pinterest') );
$instagram = crowdmerc_option( 'instagram',crowdmerc_defaults('instagram') );
$footer_columns = crowdmerc_option( 'footer_widget_layout',crowdmerc_defaults('footer_widget_layout') );
$footer_style = crowdmerc_option( 'footer_style',crowdmerc_defaults('footer_style') );
if($footer_columns == 12 ) {
    $footer_column = 1;
}elseif($footer_columns == 6 ) {
    $footer_column = 2;
}elseif($footer_columns == 4 ) {
    $footer_column = 3;
}elseif($footer_columns == 3 ) {
    $footer_column = 4;
}
?>
<footer class="xs-footer-section fundpress-footer-version-2">
    <?php if(class_exists('Xs_Main')): ?>
        <div class="fundpress-footer-top-layer">
            <div class="container">
                <div class="row">
                    <?php for ($i = 1; $i <= $footer_column ;$i++): ?>
                        <?php
                        if($i == 1){
                            $xs_time = '1s';
                        }elseif ($i == 2){
                            $xs_time = '1.2s';
                        }elseif ($i == 3){
                            $xs_time = '1.4s';
                        }else {
                            $xs_time = '1.6s';
                        }
                        ?>
                        <div class="col-md-<?php echo esc_attr($footer_columns); ?>">
                            <div class="footer_widget_two wow fadeInUp" data-wow-duration="<?php echo esc_attr($xs_time); ?>">
                                <?php
                                if(is_active_sidebar('footer-widget-'.$i)):
                                    dynamic_sidebar('footer-widget-'.$i);
                                endif;
                                ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="fundpress-footer-bottom-v2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="fundpress-copyright-text-v2 wow fadeInUp" data-wow-duration="2s">
                        <p><?php echo crowdmerc_option('copyright_text',crowdmerc_defaults('copyright_text')); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="xs-footer-bottom-wraper text-right wow fadeInUp" data-wow-duration="2s">
                        <ul class="xs-social-list xs-social-list-v7">
                            <li class="xs-text-content"><?php echo esc_html__('Follow us','crowdmerc'); ?></li>
                            <?php if(!empty($facebook)): ?>
                                <li><a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php endif; ?>

                            <?php if(!empty($twitter)): ?>
                                <li><a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php endif; ?>

                            <?php if(!empty($dribbble)): ?>
                                <li><a href="<?php echo esc_url($dribbble); ?>"><i class="fa fa-dribbble"></i></a></li>
                            <?php endif; ?>

                            <?php if(!empty($pinterest)): ?>
                                <li><a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i></a></li>
                            <?php endif; ?>

                            <?php if(!empty($instagram)): ?>
                                <li><a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>