<div class="xs-water-heading" data-scrollax-parent="true">
    <div class="fundpress-heading-title-v3 text-center">
        <div class="fundpress-heading-title-content">
            <?php if(!empty($title)): ?>
                <?php $span = "<span>";$end_span = "</span>"; ?>
                <h2><?php echo sprintf($title,$span,$end_span); ?></h2>
            <?php endif; ?>

            <?php if(!empty($sub_title)): ?>
                <p><?php echo wp_kses($sub_title,array('br'=>array())); ?></p>
            <?php endif; ?>
        </div>
        <?php if(!empty($water_title)): ?>
            <span class="parallax-title" data-scrollax="properties: { translateY: '-250px' }"><?php echo esc_html( $water_title ); ?></span>
        <?php endif; ?>
    </div>
</div>
