<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'add_meta_boxes', 'wcphx2018_add_custom_box' );

function wcphx2018_add_custom_box(){
	$screens = array( 'sport-product' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'amazon_link',				// Unique ID
			'Product Link',  			// Box title
			'wcphx2018_custom_box_html',	// Content callback, must be of type callable
			$screen						// Post type
		);
	}
}

function wcphx2018_custom_box_html( $post ){
	$value = get_post_meta( $post->ID, 'amazon_link', true );
	?>
	<label for="amazon_link"><?php _e( 'Enter link for this product', 'wcphx2018' ); ?></label>
	<input type="text" name="amazon_link" id="amazon_link" value="<?php echo $value; ?>" />
	<?php
}


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