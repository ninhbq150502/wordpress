<?php
defined( 'ABSPATH' ) or die();
global $wpdb;
	
$template_post_id = style_1($post_id);
$tabsbox_content = get_post_meta($template_post_id, 'tabsbox_metabox_'.$template_post_id, true);
$tabsbox_tools = get_post_meta($template_post_id, 'tabsbox_metabox_tools_'.$template_post_id, true);
if($tabsbox_tools['tabs_cust_css']!=""){
  $tabs_cust_css   			= $tabsbox_tools['tabs_cust_css'];  
}else{
  $tabs_cust_css   		  = "";  
}

if(isset($tabsbox_tools['tabs_title_fontfamily'])){
	$tabs_title_fontfamily  = $tabsbox_tools['tabs_title_fontfamily'];
}else{
	$tabs_title_fontfamily  = "Arial, sans-serif";
}

if(isset($tabsbox_tools['tabs_desc_fontfamily'])){
	$tabs_desc_fontfamily  = $tabsbox_tools['tabs_desc_fontfamily'];
}else{
	$tabs_desc_fontfamily  = "Arial, sans-serif";
}

if(isset($tabsbox_tools['cdlzr_tabs_ttle_clr'])){
	$cdlzr_tabs_ttle_clr  = $tabsbox_tools['cdlzr_tabs_ttle_clr'];
}else{
	$cdlzr_tabs_ttle_clr  = "#ffffff";
}

if(isset($tabsbox_tools['cdlzr_tabs_inact_ttle_clr'])){
	$cdlzr_tabs_inact_ttle_clr  = $tabsbox_tools['cdlzr_tabs_inact_ttle_clr'];
}else{
	$cdlzr_tabs_inact_ttle_clr  = "#ffffff";
}

if(isset($tabsbox_tools['cdlzr_tabs_desc_clr'])){
	$cdlzr_tabs_desc_clr  = $tabsbox_tools['cdlzr_tabs_desc_clr'];
}else{
	$cdlzr_tabs_desc_clr  = "#000000";
}

if(isset($tabsbox_tools['cdlzr_active_tabs_bg_clr'])){
	$cdlzr_active_tabs_bg_clr  = $tabsbox_tools['cdlzr_active_tabs_bg_clr'];
}else{
	$cdlzr_active_tabs_bg_clr  = "#ff8b38";
}

if(isset($tabsbox_tools['cdlzr_inactive_tabs_bg_clr'])){
	$cdlzr_inactive_tabs_bg_clr  = $tabsbox_tools['cdlzr_inactive_tabs_bg_clr'];
}else{
	$cdlzr_inactive_tabs_bg_clr  = "#333";
}

if(isset($tabsbox_tools['cdlzr_tabs_container_bg_clr'])){
	$cdlzr_tabs_container_bg_clr  = $tabsbox_tools['cdlzr_tabs_container_bg_clr'];
}else{
	$cdlzr_tabs_container_bg_clr  = "#f5f5f5";
}
?>
<h4 class="tabs_title">		  			
	<?php if($tabsbox_tools['tabs_title'] == 1){ echo esc_html(get_the_title()); } ?>	
</h4>
<div class="tabs">	
	<div class="container">		
		<div class="row">			
			<div class="col-xl-3">
				<ul class="nav nav-pills nav-stacked flex-column">
					<?php 
				  		if (is_array($tabsbox_content) && count($tabsbox_content) > 0){
							foreach ($tabsbox_content as $key => $value) {
								 $tabs_title 	= esc_attr($value['mytext']);
				 				 $active 		= "active";
					?>	
						<li data-id="<?php echo $key; ?>" class="<?php if($key == 0){ echo esc_html($active); } ?> li_tab"><?php echo esc_html($tabs_title); ?></li>
					<?php } } ?>	
				</ul>
			</div>
			<div class="col-xl-9">
				<div class="tab-content">
					<?php 
				  		if (is_array($tabsbox_content) && count($tabsbox_content) > 0){
							foreach ($tabsbox_content as $key => $value) {
				 				 $tabs_desc		= esc_attr($value['mydesc']);		 				
				 				 $active 		= "active";
					?>	
					<div class="tab-pane temp1_desc_pills <?php if($key == 0){ echo esc_html($active); } ?>" id="tab_<?php echo $key; ?>">
						<p><?php echo html_entity_decode($tabs_desc); ?></p>						
					</div>
					<?php } } ?>	
				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.tabs{
	  background-color: <?php echo $cdlzr_tabs_container_bg_clr; ?>;
	  padding-top:30px;
	  padding-bottom:30px;
	}

	.tabs .tab-pane{
	  margin-left:20px;
	}

	.tabs h3{
	  font-size:20px;
	  margin-top:10px;
	  margin-bottom:60px;
	}

	.tabs p{
	  font-size:14px;
	  color: <?php echo $cdlzr_tabs_desc_clr; ?>;	
	}

	.tabs a{
	  font-size:15px;
	  font-family:OpenSans,sans-serif;
	  font-weight:700;
	  color:#fff;
	  padding:2px;
	}

	.tabs li{
	  background-color: <?php echo $cdlzr_inactive_tabs_bg_clr; ?>;	  
	  margin-top:1px;
	  text-align:center;
	  height:110px;
	  width:110px;
	  padding-top:45px;
	  -webkit-border-radius:3px;
	  border-radius:3px;
	}

	.tabs li.active{
	  background-color: <?php echo $cdlzr_active_tabs_bg_clr; ?>;
	  color: <?php echo $cdlzr_tabs_ttle_clr; ?>;
	}

	.nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
	    color: #fff;
	    background-color: #ff8b38 !important;
	}
	<?php
		if(isset($tabsbox_tools['tabs_title_fontfamily'])){
			?>
				a.temp1_title_pills{
					font-family: <?php echo $tabs_title_fontfamily; ?>;
				}
			<?php
		}

		if(isset($tabsbox_tools['tabs_desc_fontfamily'])){
			?>
				.temp1_desc_pills > * {
					font-family: <?php echo $tabs_desc_fontfamily; ?>;
				}
			<?php
		}

		echo esc_html($tabs_cust_css);
	?>

	li.li_tab {
	    cursor: pointer;
	    color: <?php echo $cdlzr_tabs_inact_ttle_clr; ?>;
	}

/*	@media only screen 
    and (device-width : 375px) 
    and (device-height : 812px) 
    and (-webkit-device-pixel-ratio : 3) { 
    	li.li_tab {
	    	width: 100%;	
	    }
    }

    @media only screen 
	    and (device-width : 736px) 
	    and (device-height : 414px) 
	    and (-webkit-device-pixel-ratio : 3) { 
	    	li.li_tab {
		    	width: 100%;	
		    }
	    }*/

		
	  /*iPhone6/7/8*/
	  @media only screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) {
	    	li.li_tab {
		    	width: 100%;	
		    }
	  }
	  /*iPhone6/7/8 Plus*/
	  @media only screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) {
	        li.li_tab {
		    	width: 100%;	
		    }
	  }
	  /*iPhone X*/
	  @media only screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) {
	         li.li_tab {
		    	width: 100%;	
		    }
	    }


</style>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("li").click(function () {
		    jQuery("li").removeClass("active");
		    jQuery(".temp1_desc_pills").removeClass("active");
		    
		    // $(".tab").addClass("active"); // instead of this do the below 
		    

		    jQuery(this).addClass("active");   
		    //jQuery(this).addClass("active");


		    var tabval = jQuery(this).data("id");
		    jQuery(".temp1_desc_pills").removeClass("active");
		    jQuery("#tab_"+tabval).addClass("active"); 
		});
	});
</script>