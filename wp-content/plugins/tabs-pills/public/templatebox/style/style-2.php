<?php
defined( 'ABSPATH' ) or die();
global $wpdb;

$template_post_id = style_2($post_id);
$tabsbox_content = get_post_meta($template_post_id, 'tabsbox_metabox_'.$template_post_id, true);
$tabsbox_tools = get_post_meta($template_post_id, 'tabsbox_metabox_tools_'.$template_post_id, true);
if($tabsbox_tools['tabs_cust_css']!=""){
  $tabs_cust_css        = $tabsbox_tools['tabs_cust_css'];  
}else{
  $tabs_cust_css        = ""; 
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
    $cdlzr_tabs_inact_ttle_clr  = "#000000";
}

if(isset($tabsbox_tools['cdlzr_tabs_desc_clr'])){
    $cdlzr_tabs_desc_clr  = $tabsbox_tools['cdlzr_tabs_desc_clr'];
}else{
    $cdlzr_tabs_desc_clr  = "#000000";
}

if(isset($tabsbox_tools['cdlzr_active_tabs_bg_clr'])){
    $cdlzr_active_tabs_bg_clr  = $tabsbox_tools['cdlzr_active_tabs_bg_clr'];
}else{
    $cdlzr_active_tabs_bg_clr  = "#2b8ff5";
}

if(isset($tabsbox_tools['cdlzr_inactive_tabs_bg_clr'])){
    $cdlzr_inactive_tabs_bg_clr  = $tabsbox_tools['cdlzr_inactive_tabs_bg_clr'];
}else{
    $cdlzr_inactive_tabs_bg_clr  = "#f6f6f8";
}

if(isset($tabsbox_tools['cdlzr_tabs_container_bg_clr'])){
    $cdlzr_tabs_container_bg_clr  = $tabsbox_tools['cdlzr_tabs_container_bg_clr'];
}else{
    $cdlzr_tabs_container_bg_clr  = "#ffffff";
}
?>
<h4 class="tabs_title">                 
    <?php if($tabsbox_tools['tabs_title'] == 1){ echo esc_html(get_the_title()); } ?>   
</h4>
<div class="skltbs-theme-light" data-skeletabs>    
    <ul class="skltbs-tab-group">
     <?php 
        if (is_array($tabsbox_content) && count($tabsbox_content) > 0){
            foreach ($tabsbox_content as $key => $value) {
                 $tabs_title    = esc_attr($value['mytext']);
                 $tabs_fa       = esc_attr($value['myfontawe']); 
                 $active        = "skltbs-active";
      ?> 
          <li class="skltbs-tab-item <?php if($key == 0){ echo esc_html($active); } ?>">
            <button class="skltbs-tab <?php if($key == 0){ echo esc_html($active); } ?> tabspills_ttle2"><i class="<?php echo esc_html($tabs_fa); ?>"></i> <?php echo esc_html($tabs_title); ?></button>
          </li>        
    <?php } } ?>           
    </ul>
    <div class="skltbs-panel-group">
        <?php 
            if (is_array($tabsbox_content) && count($tabsbox_content) > 0){
                foreach ($tabsbox_content as $key => $value) {
                     $tabs_desc     = esc_attr($value['mydesc']);                          
                     $active        = "skltbs-active";
        ?>  
       <div class="skltbs-panel <?php if($key == 0){ echo esc_html($active); } ?> tabspills_desc2">
        <p><?php echo html_entity_decode($tabs_desc); ?></p>
      </div>    
      <?php } } ?>  
    </div>
</div>       

<style type="text/css">
  <?php
    echo esc_html($tabs_cust_css);

    if(isset($tabsbox_tools['tabs_title_fontfamily'])){
      ?>
        .tabspills_ttle2{
          font-family: <?php echo $tabs_title_fontfamily; ?> !important;
        }        
      <?php
    }

    if(isset($tabsbox_tools['tabs_desc_fontfamily'])){
      ?>
        .tabspills_desc2 > * {
           font-family: <?php echo $tabs_desc_fontfamily; ?> !important;
        }       
      <?php
    }

  ?>

  .skltbs-theme-light .skltbs-panel{
    color: <?php echo $cdlzr_tabs_desc_clr; ?> !important;
    background-color: <?php echo $cdlzr_tabs_container_bg_clr; ?> !important;
  }

  .skltbs-theme-light .skltbs-tab.skltbs-active {
        color: <?php echo $cdlzr_tabs_ttle_clr; ?> !important;
        background: <?php echo $cdlzr_active_tabs_bg_clr; ?> !important;
    }

    .skltbs-theme-light .skltbs-tab{
        color: <?php echo $cdlzr_tabs_inact_ttle_clr; ?> !important;
        background: <?php echo $cdlzr_inactive_tabs_bg_clr; ?> !important;
    }
</style>