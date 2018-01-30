<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'init', 'wcphx2018_register_sport_tax' );

function wcphx2018_register_sport_tax(){
	$labels = array(
		'name'				=> _x( 'Sports', 'taxonomy general name', 'wcphx2018' ),
		'singular_name'		=> _x( 'Sport', 'taxonomy singular name', 'wcphx2018' ),
		'search_items'		=> __( 'Search Sports', 'wcphx2018' ),
		'all_items'			=> __( 'All Sports', 'wcphx2018' ),
		'parent_item'		=> __( 'Parent Sport', 'wcphx2018' ),
		'parent_item_colon'	=> __( 'Parent Sport:', 'wcphx2018' ),
		'edit_item'			=> __( 'Edit Sport', 'wcphx2018' ),
		'update_item'		=> __( 'Update Sport', 'wcphx2018' ),
		'add_new_item'		=> __( 'Add New Sport', 'wcphx2018' ),
		'new_item_name'		=> __( 'New Sport Name', 'wcphx2018' ),
		'menu_name'			=> __( 'Sport', 'wcphx2018' ),
	);

	$args = array(
		'hierarchical'		=> true,
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'sport' ),
	);

	register_taxonomy( 'sports', array( 'sport-product' ), $args );
	//register_taxonomy( $taxonomy, $object_type, array( '' ) );
}