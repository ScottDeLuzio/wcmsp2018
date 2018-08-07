<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/* WordPress action 'init' tells WordPress to run the function 'wcmsp2018_register_sport_products_cpt'.
 * This function will run the WordPress function 'register_post_type' with the args specified.
 *
 * More info: https://codex.wordpress.org/Function_Reference/register_post_type
 */
add_action( 'init', 'wcmsp2018_register_sport_products_cpt' );

function wcmsp2018_register_sport_products_cpt(){
	// Set labels for the CPT
	$labels = array(
		'name'					=> _x( 'Sport Products', 'post type general name', 'wcmsp2018' ),	//General name for the post type, usually plural.
		'singular_name'			=> _x( 'Sport Product', 'post type singular name', 'wcmsp2018' ),	//Name for one object of this post type.
		'add_new'				=> _x( 'Add New', 'sport product', 'wcmsp2018' ),					//Default is ‘Add New’ for both hierarchical and non-hierarchical types.
		'add_new_item'			=> __( 'Add New Sport Product', 'wcmsp2018' ),						//Label for adding a new singular item.
		'edit_item'				=> __( 'Edit Sport Product', 'wcmsp2018' ),							//Label for editing a singular item
		'new_item'				=> __( 'New Sport Product', 'wcmsp2018' ),							//Label for the new item page
		'view_item'				=> __( 'View Sport Product', 'wcmsp2018' ),							//Label for viewing a singular item
		'view_items'			=> __( 'View Sport Products', 'wcmsp2018' ),						//Label for viewing post type archives
		'search_items'			=> __( 'Search Sport Products', 'wcmsp2018' ),						//Label for searching plural items
		'not_found'				=> __( 'No sport products found.', 'wcmsp2018' ),					//Label used when no items are found
		'not_found_in_trash'	=> __( 'No sport products found in trash.', 'wcmsp2018' ),			//Label used when no items are in the trash
		'parent_item_colon'		=> __( 'Parent Sport Products:', 'wcmsp2018' ),						//Label used to prefix parents of hierarchial items
		'all_items'				=> __( 'All Sport Products', 'wcmsp2018' ),							//Label to signify all items in a submenu link
		'archives'				=> __( 'Sport Product Archives', 'wcmsp2018' ),						//Label for archives in nav menus
		'attributes'			=> __( 'Sport Product Attributes', 'wcmsp2018' ),					//Label for the attributes meta box
		'menu_name'				=> _x( 'Sport Products', 'admin menu', 'wcmsp2018' )				//Label for the menu name (defaults to same as 'name' value above)
	);

	// Set args for CPT
	$args = array(
		'labels'				=> $labels,								//An array of labels for this post type from above.
		'public'				=> true,								//Whether a post type is intended for use publicly either via the admin interface or by front-end users
		'hierarchical'			=> false,								//Whether the post type is hierarchical (e.g. page)
		'exclude_from_search'	=> false,								//Whether to exclude posts with this post type from front end search results
		'publicly_queryable'	=> true,								//Whether queries can be performed on the front end for the post type
		'show_ui'				=> true,								//Whether to generate and allow a UI for managing this post type in the admin
		'show_in_menu'			=> true,								//Where to show the post type in the admin menu (true = top level menu, false = no menu shown, string of existing menu = submenu of that menu)
		'menu_position'			=> null,								//The position in the menu order the post type should appear (null = appear at the bottom)
		'capability_type'		=> 'post',								//The string to use to build the read, edit, and delete capabilities
		'supports'				=> array( 'title', 'custom-fields' ),	//Core feature(s) the post type supports ('title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats')
		'has_archive'			=> true,								//Whether there should be post type archives
		'rewrite'				=> array( 'slug' => 'sport-product' ),	//Triggers the handling of rewrites for this post type
		'query_var'				=> true,								//Sets the query_var key for this post type
		'can_export'			=> true									//Whether to allow this post type to be exported
	);

	register_post_type( 'sport-product', $args );
	//register_post_type( $post_type, array( '' ) );
}