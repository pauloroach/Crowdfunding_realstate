<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
$footer_style = crowdmerc_option( 'footer_style',crowdmerc_defaults('footer_style') );
?>
<?php get_template_part( 'template-parts/footer/footer', $footer_style ); ?>
<?php wp_footer(); ?>
</body>
</html>