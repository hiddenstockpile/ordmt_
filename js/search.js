jQuery(document).ready(function(){
	jQuery(".input-daterange input").each(function() {
		jQuery(this).datepicker();
	});
	
	jQuery("select").on("change", function(){
		
		setTimeout(function(){
			jQuery("#frmSearchBox").submit();
		}, 200);
	});
	
});