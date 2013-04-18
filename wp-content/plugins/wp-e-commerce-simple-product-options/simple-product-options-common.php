<?php

class wpec_simple_product_options_common {



	function __construct() {
		add_action ( 'init', array ( &$this, 'register_product_option_taxonomy' ) );
	}



	function register_product_option_taxonomy() {

		$labels = Array (
			'name' => _x( 'Product Options', 'taxonomy general name', 'wpec_spo' ),
			'singular_name' => _x( 'Product Option', 'taxonomy singular name', 'wpec_spo' ),
			'search_items' => __( 'Search Product Options', 'wpec_spo' ),
			'all_items' => __( 'All Product Options' , 'wpec_spo'),
			'edit_item' => __( 'Edit Product Option', 'wpec_spo' ),
			'update_item' => __( 'Update Product Option', 'wpec_spo' ),
			'add_new_item' => __( 'Add new Product Option', 'wpec_spo' ),
			'new_item_name' => __( 'New Product Option Name', 'wpec_spo' )
		);

		register_taxonomy( 'wpec_product_option', 'wpsc-product', array(
			'hierarchical' => true,
			'labels' => $labels,
			'rewrite' => false,
			'show_tagcloud' => false
			)
		);

	}



}

$wpec_simple_product_options_common = new wpec_simple_product_options_common();



?>
