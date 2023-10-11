<?php
defined( 'ABSPATH' ) or die();
global $wpdb;

$template_post_id = style_4($post_id);
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
?>
<h4 class="tabs_title">                 
    <?php if($tabsbox_tools['tabs_title'] == 1){ echo esc_html(get_the_title()); } ?>   
</h4>
<div class="skltbs-theme-dark" data-skeletabs>    
    <ul class="skltbs-tab-group">
     <?php 
        if (is_array($tabsbox_content) && count($tabsbox_content) > 0){
            foreach ($tabsbox_content as $key => $value) {
                 $tabs_title    = esc_attr($value['mytext']);
                 $tabs_fa       = esc_attr($value['myfontawe']); 
                 $active        = "skltbs-active";
      ?> 
          <li class="skltbs-tab-item <?php if($key == 0){ echo esc_html($active); } ?>">
            <button class="skltbs-tab <?php if($key == 0){ echo esc_html($active); } ?> tabspills_ttle4"><i class="<?php echo esc_html($tabs_fa); ?>"></i> <?php echo esc_html($tabs_title); ?></button>
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
       <div class="skltbs-panel <?php if($key == 0){ echo esc_html($active); } ?> tabspills_desc4">
        <p><?php echo html_entity_decode($tabs_desc); ?></p>
      </div>    
      <?php } } ?>  
    </div>
</div>       

<style type="text/css">
  <?php
    echo esc_html($tabs_cust_css);
  ?>
  .skltbs-theme-dark .skltbs-tab.skltbs-active {
    background: #e13140 !important;
}
<?php
 if(isset($tabsbox_tools['tabs_title_fontfamily'])){
      ?>
        .tabspills_ttle4{
          font-family: <?php echo $tabs_title_fontfamily; ?> !important;
        }        
      <?php
    }

    if(isset($tabsbox_tools['tabs_desc_fontfamily'])){
      ?>
        .tabspills_desc4 > * {
           font-family: <?php echo $tabs_desc_fontfamily; ?> !important;
        }       
      <?php
    }
?>
</style>