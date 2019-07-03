<?php
$footer_columns = crowdmerc_option( 'footer_widget_layout',crowdmerc_defaults('footer_widget_layout') );
$show_fixed_footer = crowdmerc_option( 'show_fixed_footer',crowdmerc_defaults('show_fixed_footer') );
if($footer_columns == 12 ) {
    $footer_column = 1;
}elseif($footer_columns == 6 ) {
    $footer_column = 2;
}elseif($footer_columns == 4 ) {
    $footer_column = 3;
}elseif($footer_columns == 3 ) {
    $footer_column = 4;
}
$fixed_footer = '';
if($show_fixed_footer){
    $fixed_footer = 'xs-fixed-footer';
}
?>
<footer class="xs-footer-section fundpress-footer-section <?php echo esc_attr($fixed_footer); ?>">
    <?php if(class_exists('Xs_Main')): ?>
        <div class="fundpress-footer-top-layer">
            <div class="container">
                <div class="row">
                    <?php for ($i = 1; $i <= $footer_column ;$i++): ?>
                        <div class="col-md-<?php echo esc_attr($footer_columns); ?>">
                            <?php
                            if(is_active_sidebar('footer-widget-'.$i)):
                                dynamic_sidebar('footer-widget-'.$i);
                            endif;
                            ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="xs-footer-bottom-layer fundpress-footer-bottom">
        <div class="container">
            <div class="xs-footer-bottom-wraper">
                <div class="xs-copyright-text fundpress-copyright-text">
                    <p><?php echo crowdmerc_option('copyright_text',crowdmerc_defaults('copyright_text')); ?></p>
                </div>
                <div class="xs-back-to-top-wraper">
                    <a href="#" class="xs-back-to-top full-round green-btn xs-back-to-top-btn show-last-pos">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div><!-- .xs-back-to-top-wraper END -->
            </div>
        </div>
    </div><!-- .xs-footer-bottom-layer .fundpress-footer-bottom END -->
</footer>