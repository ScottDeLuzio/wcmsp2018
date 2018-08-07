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
 * Anything specified in this function will be output in the content where the shortcode was placed.
 * The function 'shortcode_atts' specifies default values for the shortcode's attributes in case the user does not specify them.
 * In this case we are specifying an attribute 'sports'. Other attributes can be added to this as well.
 * This function tells us to run our 'wcmsp2018_product_list' function and return the results.
 * To use this shortcode, add this to your page or post:
 * [sport_products sports="golf"]
 */
function wcmsp2018_sport_products_list_shortcode( $atts ) {
	/* Shortcode attributes are passed to the function in the variable $atts.
	 * We'll set default values for the attributes in the shortcode_atts function.
	 * This way if a user doesn't pass an expected attribute, the function won't generate an error.
	 * The shortcode_atts function takes several parameters:
	 *  - An array of supported attributes and their default values. In this example the only supported attribute is 'sports' with a blank default value.
	 *  - Attributes passed by the user of the shortcode to the function.
	 *  - The name of the shortcode this applies to.
	 * The shortcode_atts function will look at the $atts variable to see if the supported attributes are included by the user.
	 * If they are, the function will use that value. Otherwise it will use the default values defined below.
	 * Important: Use the same variable name ($atts) used above passed by the user to hold the output of the shortcode_atts function.
	 * Reference: https://core.trac.wordpress.org/browser/tags/4.9.8/src/wp-includes/shortcodes.php#L533
	 */
	$atts = shortcode_atts(
		array(
			'sport' => '',
		),
		$atts,
		'sport_products'
	);

	ob_start(); //Start remembering what would be output, but don't do anything with it yet

	wcmsp2018_product_list( esc_html( $atts['sport'] ) );

	$sports_list = ob_get_clean(); //Get what should be output and store it in a variable

	return $sports_list; //return the content that we stored in the variable
}

/* This is our function that will display a list of products based on the sport specified in the shortcode.
 * In the query, we specify the custom post type (sport-product), and that we want to query by taxonomy.
 * The taxonomy is 'sports', and we search by the slug of the taxonomy $sport, which is sent through our shortcode attributes.
 * If the query returns some results, the function will loop through each result and format it in an unordered (bulleted) list.
 * If the query does not return any results, it will return the text 'No sport products found'.
 */

function wcmsp2018_product_list( $sport ){
	/* $args is an array of values that are passed into WP_Query.
	 * This defines exactly what type of output we're looking for.
	 * WP_Query reference: https://developer.wordpress.org/reference/classes/WP_Query/
	 */
	$args = array(
		'post_type'			=> 'sport-product', // only look at our custom post type sport-product
		'tax_query'			=> array( // queries the taxonomy specified in the array
			array(
				'taxonomy'	=> 'sports', // look at the sports taxonomy
				'field'		=> 'slug', // we want to compare to the slug of the taxonomy
				'terms'		=> $sport, // the term passed to the function for the sports taxonomy should match the slug
			),
		),
		'posts_per_page'	=> 3, // limit the function to returning only three posts
		'orderby'			=> 'rand' // go nuts and get them at random
	);

	/* Create the variable $query, which holds the output of WP_Query using the $args defined above.*/
	$query = new WP_Query( $args );

	/* If $query has at least one result, let's loop through each result and format it in an unordered (bulleted) list. */
	if( $query->have_posts() ){
		echo '<h4>' . __( 'Products You Might Be Interested In:', 'wcmsp2018' ) . '</h4>'; // echo the heading that we want displayed if there are results
		echo '<ul>'; // echo the HTML to start the unordered list

		while( $query->have_posts() ){ // loop through each result that $query returned
			$query->the_post();
			$link	= get_post_meta( get_the_ID(), 'amazon_link', true ); // get the amazon_link from post meta
			$title	= get_the_title(); // get the title of the result

			echo '<li><a href="' . $link . '">' . $title . '</a></li>'; // echo the HTML to add an item to the unordered list
		}
		echo '</ul>'; // echo the HTML to close the unordered list
		wp_reset_postdata(); // ensures that the main query is restored to resume displaying any remaining post information correctly. Reference: https://codex.wordpress.org/Function_Reference/wp_reset_postdata
	} else {
		_e( 'No sport products found.', 'wcmsp2018' ); // $query did not return any results so we're going to echo "No sport products found".
	}
}