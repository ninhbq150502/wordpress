jQuery(document).ready( function () {
  jQuery(".linedtabs").linedtextarea({
	    selectedLine: 10
	  });
  jQuery('.my-color-field').wpColorPicker();

  jQuery('.cdlzr_sel_post').on('click', function(e){
  	e.preventDefault();
    var get_tabval   = jQuery(".cdlzr_sel_post").children("option:selected").val();
    jQuery('#exampleModalCenter').modal('show');
  	//var go_pro_url = "https://codelizar.com/product/tabs-pills-pro/";
  	//setTimeout(function(){ window.open(go_pro_url, '_blank'); }, 2000);
  });
  

});