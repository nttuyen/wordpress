jQuery(document).ready(function() {
	jQuery(".product_option_set .set_label input").click(function() {
		var checked = jQuery(this).is(':checked');
		jQuery(this).parents(".product_option_set").each(function(){ 
				jQuery(this).find(".wpec-spo-option").each(function() {
					jQuery(this).attr ('checked', checked );
					});
			});
	});
});
