<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* WordPress action 'add_meta_boxes' tells WordPress to run the function 'wcphx2018_add_custom_box'
 * This function has specific instructions for WordPress to add a meta box.
 * The function specifies which post type(s) the meta box should appear on (sport-product)
 * as well as a unique ID for the meta box, a title that is displayed to the end user,
 * a function that will be run inside the meta box to output certain content (wcphx2018_custom_box_html)
 *
 * More info add_meta_boxes action: https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 * More info add_meta_box function: https://developer.wordpress.org/reference/functions/add_meta_box/
 */
add_action( 'add_meta_boxes', 'wcphx2018_add_custom_box' );

function wcphx2018_add_custom_box(){
	$screens = array( 'sport-product' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'amazon_link',					// Unique ID
			'Product Link',  				// Box title
			'wcphx2018_custom_box_html',	// Content callback, must be of type callable
			$screen							// Post type
		);
	}
}

/* This is the function that the 'add_meta_box' function told WordPress to run.
 * Whatever this function outputs will be displayed in the meta box.
 * This doesn't have to be a form. It can be text, an image, links to other pages.
 * Really anything you want can go here.
 */
function wcphx2018_custom_box_html( $post ){
	$value = get_post_meta( $post->ID, 'amazon_link', true ); 									// Retrieves the value of 'amazon_link' for this post
	?>
	<label for="amazon_link"><?php _e( 'Enter link for this product', 'wcphx2018' ); ?></label> <!-- Outputs a label for the user to read -->
	<input type="text" name="amazon_link" id="amazon_link" value="<?php echo $value; ?>" />		<!-- Outputs a text box for the user to enter the value of 'amazon_link' -->
	<?php
}

/* WordPress action 'save_post' runs whenever a post is saved or updated. Here we tell it to run the function 'wcphx2018_save_postdata'.
 * This function does a very basic check to see if 'amazon_link' is being passed along with the rest of the post's data.
 * If it is, the function runs the 'update_post_meta' function to save the 'amazon_link' value.
 * If it isn't, nothing happens.
 *
 * More info: https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
add_action( 'save_post', 'wcphx2018_save_postdata' );

function wcphx2018_save_postdata( $post_id ){
    if ( array_key_exists( 'amazon_link', $_POST ) ) {
        update_post_meta(
            $post_id,
            'amazon_link',
            $_POST['amazon_link']
        );
    }
}