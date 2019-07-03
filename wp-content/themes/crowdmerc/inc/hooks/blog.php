<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function crowdmerc_excerpt( $num = 20 ) {

	$excerpt		 = get_the_excerpt();
	$trimmed_content = wp_trim_words( $excerpt, $num_words		 = $num, $more			 = null );

	echo crowdmerc_kses( $trimmed_content );
}

function crowdmerc_content_read_more( $num = 20 ) {

	$excerpt		 = get_the_excerpt();
	$trimmed_content = wp_trim_words( $excerpt, $num_words = $num, $more = null );

	echo crowdmerc_kses( $trimmed_content );
}


//Comment form textarea position change

function crowdmerc_move_comment_field_to_bottom( $fields ) {
	$comment_field		 = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'crowdmerc_move_comment_field_to_bottom' );




// Displsys search form.

function crowdmerc_search_form( $form ) {
	$form = '
        <form class="search-form xs-serachForm xs-font-alt" method="get" action="' . esc_url( home_url( '/' ) ) . '" id="search">
                <input type="text" name="s" class="xs-serach-filed search-field"  placeholder="' .esc_attr__( 'Search..', 'crowdmerc' ) . '" value="' . get_search_query() . '">
					<input type="submit" class="search-submit" value="">
                        </span>
        </form>';
	return $form;
}

add_filter( 'get_search_form', 'crowdmerc_search_form' );