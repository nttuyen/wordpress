<?php

class wpec_simple_product_options_walker extends Walker {

	var $tree_type = 'category';

	// Not sure what this is for. It was in the WordPress Walker_Category_Checklist class
	// with a note saying "TODO: decouple this", so I have left it in.
	var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

	// Don't need to output anything - if this was a nest list it would be a <ul>
	// It's here purely to override the default output with nothing.
	function start_lvl( &$output, $depth, $args ) {
	}

	// Same as above for the closing tag.
	function end_lvl( &$output, $depth, $args ) {
	}

	// Start variation set or variation
	function start_el( &$output, $category, $depth, $args ) {

		// Only show product option sets, and their immediate children:
		if ( $depth > 1 )
			return;

		extract( $args );

		if ( empty( $taxonomy ) )
			$taxonomy = 'wpsc-variation';

		if ( $depth == 0 ) {

			// Start variation set
			$output .= '<div class="product_option_set">';
			$output .= '<label class="set_label">
						<input class="wpec-spo-option-set-checkbox" type="checkbox"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) .'name="tax_input['.esc_attr($taxonomy).'][]" value="' . esc_attr($category->term_id) . '">' . esc_html( apply_filters( 'the_category', $category->name ) ) . '
						</label>';

		} else {

			// Start variation
			$output .= '<div class="product_option" style="margin-left: 1em;">
						<label>
						<input class="wpec-spo-option" type="checkbox"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . 'name="tax_input['.esc_attr($taxonomy).'][]" value="'.esc_attr($category->term_id).'">' . esc_html( apply_filters( 'the_category', $category->name ) ) . '
						</label>';

		}

	}

	// End variation set or variation
	function end_el( &$output, $category, $depth, $args ) {

		if ( $depth > 1 )
			return;

		$output .= '</div>';
	}

}



class wpec_simple_product_options_admin {



	function __construct() {
		add_action ( 'admin_init', array ( &$this, 'admin_init' ),11 );
	}



	function admin_init() {

		// Remove standard WP meta box for the taxonomy, and add our own
		remove_meta_box ( 'wpec_product_optiondiv', 'wpsc-product', 'side' ) ;

		if ( get_terms ( 'wpec_product_option', array ( 'fields' => 'count' ) ) ) {
			add_meta_box ( 'wpec-spo-product-options', __('Product Options', 'wpec_spo'), array(&$this, 'meta_box'), 'wpsc-product', 'normal', 'default' ) ;
			add_filter ( 'taxonomy_dropdown_args', array ( &$this, 'limit_taxonomy_parent_choices' ), 10, 2 );
			add_action ( 'wpec_product_option_pre_add_form', array ( &$this, 'show_taxonomy_hierarchy_warning' ) );
			wp_enqueue_script( 'simple-product-options', plugin_dir_url( __FILE__ ).'js/simple-product-options.js', array());
		}

	}



	function show_taxonomy_hierarchy_warning () {
		echo '<div class="error" class="updated">You should create &quot;<strong>Parent</strong>&quot; elements for each option type you want, and then &quot;<strong>child</strong>&quot; elements for each individual choice for that option. <strong>Do not</strong> create children of children as they won\'t show up</div>';
	}



	function limit_taxonomy_parent_choices ( $args, $taxonomy ) {

		if ( $taxonomy != 'wpec_product_option' )
			return $args;

		$args['depth'] = 1 ;

		return $args;
	}



	function meta_box() {

		global $post;

	    // Get variation data from WP Terms
	    $product_term_data = wp_get_object_terms( $post->ID, 'wpec_product_option' );

	    if ( !empty( $product_term_data ) ) {

	        foreach ( $product_term_data as $product_term )

	            $product_terms[] = $product_term->term_id;

	    } else {

	        $product_terms = array();

	    }

		?> <ul id="wpec_product_optionchecklist" class="list:wpec_product_option categorychecklist form-no-clear"> <?php
		wp_terms_checklist ( $post->ID, array (
		                                       'taxonomy' => 'wpec_product_option',
											   'selected_cats' => $product_terms,
											   'walker' => new wpec_simple_product_options_walker,
											   'checked_ontop' => false
											   )
		);
		?></ul> <?php

	}


}

$wpec_simple_product_options_admin = new wpec_simple_product_options_admin();



?>
