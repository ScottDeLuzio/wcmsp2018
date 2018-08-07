<?php
/*
Plugin Name: WCMSP2018 Plugin Demo
Plugin URI: https://github.com/ScottDeLuzio/wcmsp2018
Description: Create custom post type and shortcode
Version: 1.0.0
Author: Scott DeLuzio
Author URI: https://scottdeluzio.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wcmsp2018
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Add Custom Post Type
include( 'includes/sport-products-cpt.php' );

// Add custom taxonomy 'sports' to the sport products CPT
include( 'includes/sports-tax.php' );

// Add shortcode to list sport products in post content
include( 'includes/list-sport-products-shortcode.php' );

// Add metabox to products
include( 'includes/products-meta-box.php' );
