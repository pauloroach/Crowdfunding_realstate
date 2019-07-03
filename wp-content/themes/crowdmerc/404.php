<?php
/**
 * 404.php
 *
 * The template for displaying 404 page (Not Found).
 */
?>

<?php get_header(); ?>
<?php get_template_part('template-parts/header/content', 'blog-header')?>
<div class="xs-content-padding error-content xs-all-content-wrapper" role="main">
    <div class="main-content blog-wrap error-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1 class="404-title"><?php echo esc_html__('404','crowdmerc') ?></h1>
                        <h2 class="404-subtitle"><?php echo esc_html__('Page not found','crowdmerc') ?></h2>
                        <p class="404-intro"><?php echo esc_html__('Oops!!! The page you are looking for does not exist. It might have been moved or deleted.','crowdmerc') ?></p>
                    </div>
                    <div class="page-content errorpage">
                        <a class="xs-btn round-btn navy-blue-btn" href="<?php echo esc_url(home_url('/')) ?>" rel="home"><?php echo esc_html__( 'Back To Home', 'crowdmerc' ) ?></a>
                        
                    </div>
                    <?php get_search_form(); ?>
                </div>
            </div> 
        </div> 
    </div> <!-- end main-content -->
</div>
<?php get_footer(); ?>