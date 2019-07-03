<?php
if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );
/**
 * Helper functions used all over the theme
 */

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package xs
 */
/*
  Return
 *
 *  */

// simply echos the variable
function crowdmerc_return( $s ) {
	return $s;
}

/*
 * FOR ONE PAGE Section
 * since 1.0
 */

function crowdmerc_editor_data( $value ) {
	return wp_kses_post( $value );
}

// Gets unyson option data in safe mode
// since 1.0

function crowdmerc_get_option( $k, $v = '', $m = 'theme-settings' ) {
	if ( defined( 'FW' ) ) {
		switch ( $m ) {
			case 'theme-settings':
				$v = fw_get_db_settings_option( $k );
				break;

			default:
				$v = '';
				break;
		}
	}
	return $v;
}

if ( !function_exists( 'xs_resize' ) ) {
	function xs_resize( $url, $width = false, $height = false, $crop = false ) {
		if(function_exists('fw_resize')){
				$fw_resize = FW_Resize::getInstance();
				$response  = $fw_resize->process( $url, $width, $height, $crop );
				return ( ! is_wp_error( $response ) && ! empty( $response['src'] ) ) ? $response['src'] : $url;
		}else{
			$response = wp_get_attachment_image_src( $url, array($width,$height));
			if(!empty($response)){
				return $response[0];
			}
		}
		
	}
}
// Gets unyson image url from option data in a much simple way
// sience 1.0

function crowdmerc_get_image( $k, $v = '', $d = false ) {

	if ( $d == true ) {
		$attachment = $k;
	} else {
		$attachment = crowdmerc_get_option( $k );
	}

	if ( isset( $attachment[ 'url' ] ) && !empty( $attachment ) ) {
		$v = $attachment[ 'url' ];
	}

	return $v;
}

/* Gets unyson image url from variable
 * sience 1.0
 * crowdmerc_image($img, $alt )
 */

function crowdmerc_image( $img, $alt, $v = '' ) {

	if ( isset( $img[ 'url' ] ) && !empty( $img ) ) {
		$i	 = $img[ 'url' ];
		$v	 = "<img src=" . $i . " alt=" . $alt . " />";
	}

	return $v;
}

// Gets original page ID/ Slug
// since 1.0

function crowdmerc_main( $id, $name = true ) {
	if ( function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, 'page', true, 'en' );
	}

	if ( $name === true ) {
		$post = get_post( $id );
		return $post->post_name;
	} else {
		return $id;
	}
}



// Gets post's meta data in a much simplier way.
// since 1.0

function crowdmerc_get_post_meta( $id, $needle ) {
	$data = get_post_meta( $id, 'fw_options' );
	if ( is_array( $data ) && isset( $data[ 0 ][ 'page_sections' ] ) ) {
		$data = $data[ 0 ][ 'page_sections' ];

		if ( is_array( $data ) ) {
			return crowdmerc_seekKey( $data, $needle );
		}
	}
}



/*
 * btn Function
 * since 1.0
 */
//btn function

if ( !function_exists( 'crowdmerc_theme_button_class' ) ) :

	function crowdmerc_theme_button_class( $style ) {
		/**
		 * Display specific class for buttons - depends on theme
		 */
		if ( $style == 'default' ) {
			echo 'btn btn-border';
		} elseif ( $style == 'primary' ) {
			echo 'btn btn-primary';
		} else {
			echo 'default';
		}
	}

endif;





/*
 * This fucntion for recent post shortcode.
 * people can select show from one category or from all category
 * since 1.0
 */

// term
if ( !function_exists( 'crowdmerc_get_category_term_list' ) ) :

	function crowdmerc_get_category_term_list() {
		/**
		 * Return array of categories
		 */
		$taxonomy	 = 'category';
		$args		 = array(
			'hide_empty' => true,
		);

		$terms		 = get_terms( $taxonomy, $args );
		$result		 = array();
		$result[ 0 ]	 = esc_html__( 'All Categories', 'crowdmerc' );

		if ( !empty( $terms ) )
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		return $result;
	}

endif;



/*
 * Function for color RGB
 */

function crowdmerc_color_rgb( $hex ) {
	$hex		 = preg_replace( "/^#(.*)$/", "$1", $hex );
	$rgb		 = array();
	$rgb[ 'r' ]	 = hexdec( substr( $hex, 0, 2 ) );
	$rgb[ 'g' ]	 = hexdec( substr( $hex, 2, 2 ) );
	$rgb[ 'b' ]	 = hexdec( substr( $hex, 4, 2 ) );

	$color_hex = $rgb[ "r" ] . ", " . $rgb[ "g" ] . ", " . $rgb[ "b" ];

	return $color_hex;
}

/*
 * Section Edit option
 *
 * This function for show section edit option in every section in one page
 *
 * Since 1.0
 *  */

function crowdmerc_edit_section() {
	?>
	<div class="section-edit">
		<div class="container relative">
	<?php
	if ( is_user_logged_in() ) {
		edit_post_link( esc_html__( 'Edit', 'crowdmerc' ), '', '' );
	}
	?>
			<span class="section-abc"><?php echo esc_html( get_the_title() ); ?></span>
		</div>
	</div>
	<?php
}




// breadcrumbs

if ( !function_exists( 'crowdmerc_get_breadcrumbs' ) ) {

    function crowdmerc_get_breadcrumbs( $seperator = '' ) {
        echo '<ol class="xs-breadcumb fundpress-breadcumb">';
        if ( !is_home() ) {
            echo '<li><a href="';
            echo esc_url( get_home_url( '/' ) );
            echo '">';
            echo esc_html__( 'Home', 'crowdmerc' );
            echo "</a></li> " . esc_attr( $seperator );
            if ( is_category() || is_single() ) {
                echo '<li>';
                $category	 = get_the_category();
                $post		 = get_queried_object();
                $postType	 = get_post_type_object( get_post_type( $post ) );
                if ( !empty( $category ) ) {
                    echo esc_html( $category[ 0 ]->cat_name ) . '</li>';
                } else if ( $postType ) {
                    echo esc_html( $postType->labels->singular_name ) . '</li>';
                }

                if ( is_single() ) {
                    echo esc_attr( $seperator ) . "  <li>";
                    echo wp_trim_words( get_the_title(), 3 );
                    echo '</li>';
                }
            } elseif ( is_page() ) {
                echo '<li>';
                echo wp_trim_words( get_the_title(), 3 );
                echo '</li>';
            }
        }
        if ( is_tag() ) {
            single_tag_title();
        } elseif ( is_day() ) {
            echo"<li>" . esc_html__( 'Blogs for', 'crowdmerc' ) . " ";
            the_time( 'F jS, Y' );
            echo'</li>';
        } elseif ( is_month() ) {
            echo"<li>" . esc_html__( 'Blogs for', 'crowdmerc' ) . " ";
            the_time( 'F, Y' );
            echo'</li>';
        } elseif ( is_year() ) {
            echo"<li>" . esc_html__( 'Blogs for', 'crowdmerc' ) . " ";
            the_time( 'Y' );
            echo'</li>';
        } elseif ( is_author() ) {
            echo"<li>" . esc_html__( 'Author Blogs', 'crowdmerc' );
            echo'</li>';
        } elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
            echo "<li>" . esc_html__( 'Blogs', 'crowdmerc' );
            echo'</li>';
        } elseif ( is_search() ) {
            echo"<li>" . esc_html__( 'Search Result', 'crowdmerc' );
            echo'</li>';
        } elseif ( is_404() ) {
            echo"<li>" . esc_html__( '404 Not Found', 'crowdmerc' );
            echo'</li>';
        }
        echo '</ol>';
    }

}
/* 
* Elementor ID 
*/
 if ( !defined( 'ELEMENTOR_PARTNER_ID' ) ) { 
define( 'ELEMENTOR_PARTNER_ID', 2144 ); 
}



/*
 * WP Kses Allowed HTML Tags Array in function
 * @Since Version 0.1
 * @param ar
 * Use: crowdmerc_kses($raw_string);
 * */

function crowdmerc_kses( $raw ) {

	$allowed_tags = array(
		'a'								 => array(
			'class'	 => array(),
			'href'	 => array(),
			'rel'	 => array(),
			'title'	 => array(),
		),
		'abbr'							 => array(
			'title' => array(),
		),
		'b'								 => array(),
		'blockquote'					 => array(
			'cite' => array(),
		),
		'cite'							 => array(
			'title' => array(),
		),
		'code'							 => array(),
		'del'							 => array(
			'datetime'	 => array(),
			'title'		 => array(),
		),
		'dd'							 => array(),
		'div'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'dl'							 => array(),
		'dt'							 => array(),
		'em'							 => array(),
		'h1'							 => array(),
		'h2'							 => array(),
		'h3'							 => array(),
		'h4'							 => array(),
		'h5'							 => array(),
		'h6'							 => array(),
		'i'								 => array(
			'class' => array(),
		),
		'img'							 => array(
			'alt'	 => array(),
			'class'	 => array(),
			'height' => array(),
			'src'	 => array(),
			'width'	 => array(),
		),
		'li'							 => array(
			'class' => array(),
		),
		'ol'							 => array(
			'class' => array(),
		),
		'p'								 => array(
			'class' => array(),
		),
		'q'								 => array(
			'cite'	 => array(),
			'title'	 => array(),
		),
		'span'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'strike'						 => array(),
		'br'							 => array(),
		'strong'						 => array(),
		'data-wow-duration'				 => array(),
		'data-wow-delay'				 => array(),
		'data-wallpaper-options'		 => array(),
		'data-stellar-background-ratio'	 => array(),
		'ul'							 => array(
			'class' => array(),
		),
	);

	if ( function_exists( 'wp_kses' ) ) { // WP is here
		$allowed = wp_kses( $raw, $allowed_tags );
	} else {
		$allowed = $raw;
	}


	return $allowed;
}


/**
 *
 * Load Goggle Font
 * @since 1.0.0
 *
 */

function crowdmerc_google_fonts_url()
{
    $fonts_url = '';
    $font_families = array();
    //Body Font
    $body_font = crowdmerc_option('body_font', crowdmerc_defaults('body_font'));
    if(!empty($body_font)){
    	$body_families = isset($body_font['font-family']) ? $body_font['font-family'] : '';
	    $body_variant = isset($body_font['variant']) ? $body_font['variant'] : '';
	    $font_families[] = $body_families.":".$body_variant;
    }
    
    //Heading font
    $head_font = crowdmerc_option('heading_font', crowdmerc_defaults('heading_font'));
    if(!empty($head_font)){
    	$head_families = isset($head_font['font-family']) ? $head_font['font-family'] : '';
	    $head_variant = isset($head_font['variant']) ? $head_font['variant'] : '';
	    $font_families[] = $head_families.":".$head_variant;
    }
    
    $font_families[] = 'Open+Sans:300,400|Playfair+Display:400,700i|Poppins:200,400,500,600,700';

    if ($font_families) {
        $query_args = array(
            'family' => urlencode(implode('|', $font_families))
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 * 
 */

function xs_category_list( $cat ){
    $query_args = array(
        'orderby'       => 'ID',
        'order'         => 'DESC',
        'hide_empty'    => 1,
        'taxonomy'      => $cat
    );
    
    $categories = get_categories( $query_args );
    $options = array( esc_html__('0', 'crowdmerc') => 'All Category');
    if(is_array($categories) && count($categories) > 0){
        foreach ($categories as $cat){
            $options[$cat->term_id] = $cat->name;
        }
        return $options;
    }
}

/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 * 
 */

function xs_category_list_slug( $cat ){
    $query_args = array(
        'orderby'       => 'ID',
        'order'         => 'DESC',
        'hide_empty'    => 1,
        'taxonomy'      => $cat
    );
    
    $categories = get_categories( $query_args );
    $options = array( esc_html__('0', 'crowdmerc') => 'All Category');
    if(is_array($categories) && count($categories) > 0){
        return $categories;
    }
}

/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 * 
 */

function xs_featured_product(){
	$query_args = array(
        'post_type'     => 'product',
        'tax_query'     => array(
            'relation'  => 'AND',
            array(
                'taxonomy'  => 'product_type',
                'field'     => 'slug',
                'terms'     => 'wp_fundraising',
            ),
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ),
        ),
        'posts_per_page' => -1,
    );
	$xs_query = new WP_Query($query_args);
	$options = array( esc_html__('0', 'crowdmerc') => 'Select Product');
    if($xs_query->have_posts()):
        while ($xs_query->have_posts()) {
            $xs_query->the_post();
            $options[get_the_ID()] = get_the_title();
        }
        wp_reset_postdata();
        return $options;
    endif;
    
}

function marketpress_product_cats(){
    $cats = array();
    $query_args = array(
        'post_type'     => 'product',
        'tax_query'     => array(
            array(
                'taxonomy'  => 'product_type',
                'field'     => 'slug',
                'terms'     => 'wp_fundraising',
            ),
        ),
        'posts_per_page' => -1,
    );
    query_posts($query_args);
    while (have_posts()) : the_post();
        $id = get_the_ID();
        $categories = get_the_terms( $id, 'product_cat' );
        foreach($categories as $cat){
            if(!in_array($cat->term_id, $cats)){
                array_push($cats, $cat->term_id);
            }
        }
    endwhile;
    wp_reset_postdata();
    return $cats;
}
function marketpress_page_list(){
	$xs_pagess = array();
	$xs_pages = get_pages();
    foreach($xs_pages as $xs_page){
        if(!in_array($xs_page->ID, $xs_pagess)){
            array_push($xs_pagess, $xs_page->post_title);
        }
    }
	return $xs_pagess;
}
function crowdmerc_option($option) {
	// Get options
	return get_theme_mod( $option, crowdmerc_defaults($option) );
}

function crowdmerc_defaults($options){

	$default = array(
        'body_font' => array(),
        'heading_font' => array(),
        'header_style'  => 'nav',
		 'show_login' => '',
		 'crowdmerc_dashbord' => '',
		 'show_header_cta' => '',
		 'cta_btn_label' => esc_html__( 'start a campaign', 'crowdmerc' ),
		 'cta_btn_link' => esc_html__( '#', 'crowdmerc' ),
		 'show_border' => '',
		 'page_sidebar' => 3,
		 'show_breadcrumb' => '',
		 'blog_sidebar' => 3,
		 'blog_show_breadcrumb' => '',
		 'blog_heading_title' => '',
		 'blog_style' => 'style1',
		 'blog_grid_column' => '4',
		 'blog_single_sidebar' => 3,
		 'blog_author'	=>	'',
		 'show_author' => '',
		 'show_social'	=> '',
		 'show_category'=> 1,
		 'show_comment'=> 1,
		 'show_preloader' => '',
		 'show_social'	=> '',
		 'shop_heading_title' => esc_html__('Shopping Now','crowdmerc'),
		 'shop_grid_column' => 4,
         'shop_sidebar' =>1,
         'shop_show_breadcrumb' =>'',
         'footer_style' =>1,
		 'facebook' => '#',
		 'instagram' => '#',
		 'twitter' => '#',
		 'dribbble' => '#',
		 'pinterest' => '#',
		 'footer_widget_layout' => 4,
		 'show_fixed_footer' => '',
         'copyright_text' => esc_html__( 'Copyrights By Xpeedstudio - 2018', 'crowdmerc' ),
         'map_api' => '',
	);

	if(!empty($default[$options])) return $default[$options];
}