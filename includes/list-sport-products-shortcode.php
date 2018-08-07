<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/* WordPress function 'add_shortcode' is specifying a new shortcode called 'sport_products'.
 * The 'add_shortcode' function also specifies that the function 'wcmsp2018_sport_products_list_shortcode'
 * should be run any time the shortcode [sport_products] is found in the content of a page, post, etc.
 *
 * More info: https://codex.wordpress.org/Function_Reference/add_shortcode
 */
add_shortcode( 'sport_products', 'wcmsp2018_sport_products_list_shortcode' );

/* This is the function that 'add_shortcode' told WordPress to run whenever [sport_products] is found in the content.
 * Anything specified in this funciton will be output in the content where the shortcode was placed.
 * The function 'shortcode_atts' specifies default values for the shortcode's attributes in case the user does not specify them.
 * In this case we are specifying an attribute 'sports'. Other attributes can be added to this as well.
 * This function tells us to run our 'wcmsp2018_sports_list' function and return the results.
 * To use this shortcode, add this to your page or post:
 * [sport_products sports="golf"]
 */
function wcmsp2018_sport_products_list_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'sports' => '',
		),
		$atts,
		'sport_products'
	);

	ob_start(); //Start remembering what would be output, but don't do anything with it yet

	wcmsp2018_sports_list( esc_html( $atts['sports'] ) );

	$sports_list = ob_get_clean(); //Get what should be output and store it in a variable

	return $sports_list; //return the content that should be output
}

/* This is our function that will display a list of products based on the sport specified in the shortcode.
 * In the query, we specify the custom post type (sport-product), and that we want to query by taxonomy.
 * The taxonomy is 'sports', and we search by the slug of the taxonomy $sports, which is sent through our shortcode attributes.
 * If the query retuns some results, the function will loop through each result and format it in an unordered (bulleted) list.
 * If the query does not return any results, it will return the text 'No sport products found'.
 */

function wcmsp2018_sports_list( $sports ){
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
		echo '<h4>' . __( 'Products You Might Be Interested In:', 'wcmsp2018' ) . '</h4>';
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
		_e( 'No sport products found.', 'wcmsp2018' );
	}
}