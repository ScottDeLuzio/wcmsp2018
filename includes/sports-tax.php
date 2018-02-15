<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* WordPress action 'init' tells WordPress to run the function 'wcphx2018_register_sport_products_cpt'.
 * This function will run the WordPress function 'register_taxonomy' with the args specified.
 * What is a taxonomy?
 * Taxonomies are a way to group posts together. The names of the different groupings in a taxonomy are called terms.
 * A 'Sports' post can be grouped together by the type of sport it represents.
 * Some might be grouped as 'baseball', while others might be grouped as 'soccer'.
 * WordPress Categories and Tags are good examples of taxonomies.
 *
 * More info on init: https://codex.wordpress.org/Plugin_API/Action_Reference/init
 * More info on register_taxonomy: https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
add_action( 'init', 'wcphx2018_register_sport_tax' );

function wcphx2018_register_sport_tax(){
	$labels = array(
		'name'				=> _x( 'Sports', 'taxonomy general name', 'wcphx2018' ),	//General name for the taxonomy. Usually plural.
		'singular_name'		=> _x( 'Sport', 'taxonomy singular name', 'wcphx2018' ),	//Name for one post in this taxonomy.
		'search_items'		=> __( 'Search Sports', 'wcphx2018' ),						//The search items text.
		'all_items'			=> __( 'All Sports', 'wcphx2018' ),							//The all items text.
		'parent_item'		=> __( 'Parent Sport', 'wcphx2018' ),						//The parent item text, which is only used on hierarchial taxonomies.
		'parent_item_colon'	=> __( 'Parent Sport:', 'wcphx2018' ),						//Same as parent_item, but with a colon.
		'edit_item'			=> __( 'Edit Sport', 'wcphx2018' ),							//The Edit item text. Default is Edit Category or Edit Tag
		'update_item'		=> __( 'Update Sport', 'wcphx2018' ),						//THe Update item text. Default is Update Category or Update Tag
		'add_new_item'		=> __( 'Add New Sport', 'wcphx2018' ),						//The Add New Item text. Default is Add New Category or Add New Tag.
		'new_item_name'		=> __( 'New Sport Name', 'wcphx2018' ),						//The New Item Name text. Default is New Category Name, or New Tag Name.
		'menu_name'			=> __( 'Sport', 'wcphx2018' ),								//This is the name that will show in the menu. Defaults to value of 'name' label.
	);

	$args = array(
		'hierarchical'		=> true,													//Is the taxonomy hierarchial (true) like categories, or not (false) like tags. Default is false.
		'labels'			=> $labels,													//An array of labels for this post type from above.
		'show_ui'			=> true,													//Whether to generate a default UI for managing this taxonomy.
		'show_admin_column'	=> true,													//Whether to allow automatic creation of taxonomy columns on associated post-types table.
		'rewrite'			=> array( 'slug' => 'sport' ),								//Set to false to prevent "pretty permalinks". Array will override default URL settings.
	);

	register_taxonomy( 'sports', array( 'sport-product' ), $args );
	//register_taxonomy( $taxonomy, $object_type, array( '' ) );
}