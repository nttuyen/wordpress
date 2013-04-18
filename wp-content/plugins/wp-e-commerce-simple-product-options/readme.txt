=== Plugin Name ===
Contributors: leewillis77
Donate link: http://www.leewillis.co.uk/wordpress-plugins/?utm_source=wordpress&utm_medium=www&utm_campaign=wpec-simple-product-options
Tags: e-commerce, wp e-commerce, wpec
Requires at least: 3.2
Tested up to: 3.4.1
Stable tag: 1.6

== Description ==

WP e-Commerce extension that allows you to add simple "product options" to products without having to create or manage variations.

== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create your product options under the "Products" menu
4. Assign product options to your products
5. The WP e-Commerce stable release doesn't yet contain the hooks you need. You'll need to make the required changes to your theme file - see here for details: http://getshopped.org/forums/topic/simple-product-options/#post-221481

== Frequently Asked Questions ==

= The options chosen are supposed to be displayed during checkout - where are they? =
The current stable release of WP e-Commerce doesn't have the hooks to allow external plugins to display info like this during checkout. They're coming in a future version - watch this space

= Can I change the price charged according to the option chosen? =
No, if you want the product options to affect stock, or pricing then you should use WP e-Commerce's built in "Variations" functionality

= Where can I see which product options have been chosen =
Product options are shown against the sale under Store Sales in your WordPress Dashboard menu

= Can I order the options as they're shown to the customer? =
Yes, install a taxonomy ordering plugin - I recommend http://wordpress.org/extend/plugins/taxonomy-terms-order/ Once you've set an order in the admin area, that will be honoured on the front end.

== Screenshots ==

1. Product Options Menu
2. Product Options Setup
3. Adding Product Options to a Product
4. Product Option choices recorded against a sale
5. Product Options on the frontend

== Changelog ==

= 1.6 =
Allow option sets to be ordered

= 1.5 =
Allow options to be ordered using taxonomy ordering plugins such as http://wordpress.org/extend/plugins/taxonomy-terms-order/
Development kindly sponsored by Adam at Bauserman Group.

= 1.4 =
Minor tweaks.

= 1.3 =
Work alongside personalisable products

= 1.2 =
Added more flexible filters

= 1.1 =
Add some filters to allow layout customisation

= 1.0 =
Minor tweaks. Also hook into proposed checkout / cart hooks for future WP e-Commerce version to display choices during checkout

= 0.3 =
Avoid PHP warnings on products with no options

= 0.2 =
Compatability with official hooks added in next WP e-Commerce release

= 0.1 =
First release
