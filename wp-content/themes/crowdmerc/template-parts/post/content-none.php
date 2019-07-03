<?php
/**
 * content-none.php
 */
?>

<section class="no-results not-found">
	<div class="not-found">
	    <h1><?php esc_html_e( 'Nothing found!', 'crowdmerc' ); ?></h1>
	    <p><?php esc_html_e( 'It looks like nothing was found here. Maybe try a search?', 'crowdmerc' ) ?></p>
	    <div class="search-forms"> <?php get_search_form(); ?></div>
	</div>
</section>
