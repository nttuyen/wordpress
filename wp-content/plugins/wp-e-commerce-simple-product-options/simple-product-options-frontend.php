<?php



class wpec_simple_product_options_frontend {



	function __construct() {

		// Original version
		add_action ( 'wpsc_product_form_fields', array ( &$this, 'display_product_options' ) );
		// Actual hook added to WPEC
		add_action ( 'wpsc_product_form_fields_begin', array ( &$this, 'display_product_options' ) );

		add_filter ( 'wpsc_add_to_cart_product_id', array ( &$this, 'parse_product_options' ) );

		// Show the personlisation information during checkout
		add_action ( 'wpsc_after_checkout_cart_item_name', array ( &$this, 'checkout_personalisation_information' ) );
		add_action ( 'wpsc_after_cart_widget_item_name', array ( &$this, 'cart_widget_personalisation_information' ) );

	}



	public function checkout_personalisation_information() {
		$this->show_personalisation_information ( 'checkout' );
	}



	public function cart_widget_personalisation_information() {
		$this->show_personalisation_information ( 'cart_widget' );
	}




	public function show_personalisation_information($context) {

		global $wpsc_cart; 

		// Seperate out the options into individual items
		$options = explode ( apply_filters ( 'wpec_spo_between_options_db', '; ' ), $wpsc_cart->cart_item->custom_message );

		echo apply_filters ( 'wpec_spo_before_options', '<br/><span class="wpec_product_option_'.esc_attr ( $context ).'_text">', $context );

		$cnt = 0 ;
		foreach ( $options as $option ) {

			if ( $cnt )
				echo nl2br ( esc_html ( apply_filters ( 'wpec_spo_between_options', '; ', $context ) ) );

			echo nl2br ( esc_html ( $option ) );
			$cnt++;
		}

		echo apply_filters ( 'wpec_spo_after_options', '</span>', $context );

	}



	function parse_product_options( $product_id ) {

		if ( isset ( $_POST['wpec-product-option'] ) && count ( $_POST['wpec-product-option'] ) ) {

			// Flag the product as personalisable
			$_POST['is_customisable'] = 'true';

			// Construct the options into a string
			$cnt = 0;
			$custom_text = isset ( $_POST['custom_text'] ) ? $_POST['custom_text']."\n" : '';

			foreach ( $_POST['wpec-product-option'] as $parent_term => $term ) {

				$parent = get_term_by ( 'id', $parent_term, 'wpec_product_option' );
				$child = get_term_by ( 'id', $term, 'wpec_product_option' );

				/* Filter wpec_spo_between_options_db allows you to change the separator used between options when
				 * storing the data in the database. DO NOT use this to change how the information is displayed in 
				 * the cart or during checkout. Only use this if your options, or values contain the default
				 * separator ";"
				 */
				if ( $cnt )
					$custom_text .= apply_filters ( 'wpec_spo_between_options_db', '; ' );

				$custom_text .= $parent->name . ': ' . $child->name;

				$cnt++;
			}

			$_POST['custom_text'] = $custom_text;

		}

		return $product_id;
	}



	function sort_product_option_sets ( $a, $b ) {

		if ( $a['option_set_info']->term_order == $b['option_set_info']->term_order)
			return 0;

		if ( $a['option_set_info']->term_order > $b['option_set_info']->term_order)
			return 1;

		return -1;

	}



	function sort_product_options( $a, $b ) {

		if ( $a->term_order == $b->term_order)
			return 0;

		if ( $a->term_order > $b->term_order)
			return 1;

		return -1;

	}



	function display_product_options() {

		// Retrieve the product options for this product
		$product_id = wpsc_the_product_id();
		
		$options = wp_get_object_terms ( $product_id, 'wpec_product_option', array ( 'orderby' => 'parent', 'order' => 'asc' ) );
        $options = apply_filters ( 'wpec_spo_product_options', $options, $product_id );

		if ( ! count ( $options ) )
			return;

		// Re-arrange to an array structure suitable for output
		foreach ($options as $option) {

			if ( $option->parent == 0 )
				continue;

			// Add to array
			if ( isset ( $output_array[$option->parent] ) ) {

				// Already have the parent info - just add the child
				$output_array[$option->parent]['options'][] = $option; 

			} else {

				// Grab the parent info AND add this as a child
				$parent = get_term_by ( 'id', $option->parent, 'wpec_product_option' );

				// No sensible way to structure multi-level options
				if ( $parent->parent != 0 )
					continue;

				$output_array[$parent->term_id] = Array ( 'option_set_info' => $parent,
				                                          'options' => Array ( $option )
														  );
			}
		
		}

		if ( ! isset ( $output_array) || ! count ( $output_array ) )
			return;

		usort ( $output_array, array ( &$this, 'sort_product_option_sets' ) );

		$output_array = apply_filters ( 'wpec_spo_product_options_output_array', $output_array, $product_id);

		foreach ( $output_array as $option_set ) {

			if ( ! empty ( $option_set['options'] ) ) {

				// Sort by term order
				usort ( $option_set['options'], array ( &$this, 'sort_product_options' ) );

				$option_set_info = &$option_set['option_set_info'];

				echo "<span class=\"wpec-product-option-title\">".esc_html($option_set_info->name).": </span>";
				echo "<select class=\"wpec-product-option-select\" name=\"wpec-product-option[".esc_attr($option_set_info->term_id)."]\">";

				foreach ( $option_set['options'] as $option ) {

					echo "<option value=\"".esc_attr($option->term_id)."\">".esc_html($option->name)."</option>";

				}

				echo "</select><br/>";
			}
		}

	}


}

$wpec_simple_product_options_frontend = new wpec_simple_product_options_frontend();

?>
