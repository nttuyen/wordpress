<?php
/*
Plugin Name: WP e-Commerce Simple Product Options
Plugin URI: http://www.leewillis.co.uk/wordpress-plugins/?utm_source=wordpress&utm_medium=www&utm_campaign=wpec-simple-product-options
Description: WP e-Commerce extension that allows you to add simple "product options" to products without having to create or manage variations
Author: Lee Willis
Version: 1.6
Author URI: http://www.leewillis.co.uk/
License: GPLv3
*/

if ( ! is_admin() ) {
	require_once ( 'simple-product-options-frontend.php' );
} else {
	require_once ( 'simple-product-options-admin.php' );
}
require_once ( 'simple-product-options-common.php' );

?>
