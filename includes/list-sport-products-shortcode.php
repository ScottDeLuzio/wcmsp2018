<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_shortcode( 'sport_products', 'wcphx2018_sport_products_list_shortcode' );
// Adds shortcode to load robots list in content
function wcphx2018_sport_products_list_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'sports' => '',
		),
		$atts,
		'sport_products'
	);

	ob_start(); //Start remembering what would be output, but don't do anything with it

	wcphx2018_sports_list( esc_html( $atts['sports'] ) );

	$sports_list = ob_get_clean(); //Get  what should be output and store it in a variable

	return $sports_list; //return the content that should be output
}

/* To load the products list, add this line to your page or post:
	[sport_products sports="golf"]
*/

function wcphx2018_sports_list( $sports ){
	$args = array(
		'post_type'			=> 'sport-product',
		'tax_query'			=> array(
			array(
				'taxonomy'	=> 'sports',
				'field'		=> 'slug',
				'terms'		=> $sports,
			),
		),
		'posts_per_page'	=> -1,
	);

	$query = new WP_Query( $args );

	// The Loop
	if( $query->have_posts() ){
		echo '<h4>' . __( 'Products You Might Be Interested In:', 'wcphx2018' ) . '</h4>';
		echo '<ul>';

		while( $query->have_posts() ){
			$query->the_post();
			$link	= get_post_meta( get_the_ID(), 'amazon_link', true );
			$title	= get_the_title();

			echo '<li><a href="' . $link . '">' . $title . '</a></li>';
		}
		echo '</ul>';
		wp_reset_postdata();
	} else {
		_e( 'No sport products found.', 'wcphx2018' );
	}
}