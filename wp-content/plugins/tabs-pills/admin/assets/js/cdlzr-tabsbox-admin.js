(function($) {
"use strict";
jQuery(document).ready(function() {
		$(document).on('click', '.cdlzr_tabsbox_remove_label', function() {
			if (  $('.divcontrolboxtabs').length > 1 ) {
				$(this).parent().parent().parent().parent().fadeOut(300, function() { $(this).remove(); });
			}
		});

	jQuery(document).on('click', '#create_tabs_btn', function() {
		//  $('.divcontrolboxtabs').first().clone().find('input').attr({ value: '' }).end().find('textarea').val('').end()
		// .fadeIn(100, function() { $(this).appendTo('#divcontrolbox_tabs_rows'); });
		//  $('.divcontrolboxtabs').first().clone().find('input').attr({ value: '' }).end().find('textarea').val('').end()
		// .fadeIn(100, function() { $(this).appendTo('#divcontrolbox_tabs_rows'); });
		jQuery.ajax({
			type: 'post',
			dataType:'html',
			url: ajaxurl,
			data:{
				action:"tabs_wpeditor",				
			},
			success: function(response){
				jQuery('#divcontrolbox_tabs_rows').append(response);		
				
			}
		});
	});


	$(document).on('click', '#delete_tabs_element_btn', function() {
		var conf_tabs = confirm("If you want to delete all Tabs!");
		if (conf_tabs == true) {
		  $('.divcontrolboxtabs').remove();
		} 
		
	});
});		
})(jQuery);