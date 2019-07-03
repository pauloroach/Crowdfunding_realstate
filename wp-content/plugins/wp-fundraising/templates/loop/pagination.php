<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $wp_query;
$big = 999999;
$page_numb = max( 1, get_query_var('paged') );


$max_page = $wp_query->max_num_pages;
?>
<div class="post-pagination xs-pagination-wraper text-center">
    <ul class="xs-pagination fundpress-pagination">
    <?php
        echo paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => $page_numb,
            'total'     => $max_page,
            'type'      => 'list',
            'prev_text' => esc_html__('<span class="pagination-next"><i class="fa fa-angle-left"></i></span>', 'wp-fundraising'),
            'next_text' => esc_html__('<span class="pagination-next"><i class="fa fa-angle-right"></i></span>', 'wp-fundraising'),
        ) );
    ?>

    </ul>
</div>