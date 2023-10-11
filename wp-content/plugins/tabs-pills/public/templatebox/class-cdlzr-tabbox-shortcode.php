<?php

defined( 'ABSPATH' ) or die();

if( !class_exists('CDLZR_TABBOX_Shortcode')){
	class CDLZR_TABBOX_Shortcode{

		public static function show_tabsbox($atts){

			wp_enqueue_style( 'bootstrap_css', CDLZR_TABS_URL . 'admin/assets/css/bootstrap.min.css'  );
			wp_enqueue_style( 'public_css', CDLZR_TABS_URL . 'public/assets/css/public-css.css'  );	 
			wp_enqueue_style( 'public_css', CDLZR_TABS_URL . 'public/assets/css/public-css.css'  );	 		 	
		 	wp_enqueue_style('cdlzr-skeletabs', CDLZR_TABS_URL . 'admin/assets/css/skeletabs.css', array(), true, 'all');
		 	wp_enqueue_style('cdlzr-fontawesome', CDLZR_TABS_URL . 'admin/assets/css/fontawesome/css/all.min.css', array(), true, 'all');
			wp_enqueue_script( 'jquery' );					
			wp_enqueue_script( 'bootstrap_js', CDLZR_TABS_URL . 'admin/assets/js/bootstrap.min.js', array( 'jquery' ), true, true );	
			wp_enqueue_script( 'skeletabs-js', CDLZR_TABS_URL . 'admin/assets/js/skeletabs.js' );
			wp_enqueue_script( 'public-custom-js', CDLZR_TABS_URL . 'public/assets/js/public-custom-js.js' );	
		    $post_id = $atts['id'];
		    $tabsbox_content_tools = get_post_meta($post_id, 'tabsbox_metabox_tools_'.$post_id, true);

			if($tabsbox_content_tools['style_tabsbox']!=""){
				$selected_theme = $tabsbox_content_tools['style_tabsbox'];
			}else{
				$selected_theme = 1;	
			}

			if($selected_theme==1){
				function style_1($post_id){
					return $post_id;
				}
				include( CDLZR_TABS_PLUGIN_DIR_PATH . 'public/templatebox/style/style-1.php' );

			}else if($selected_theme==2){
				function style_2($post_id){
					return $post_id;
				}
				include( CDLZR_TABS_PLUGIN_DIR_PATH . 'public/templatebox/style/style-2.php' );
			}else if($selected_theme==3){
				function style_3($post_id){
					return $post_id;
				}
				include( CDLZR_TABS_PLUGIN_DIR_PATH . 'public/templatebox/style/style-3.php' );
			}else if($selected_theme==4){
				function style_4($post_id){
					return $post_id;
				}
				include( CDLZR_TABS_PLUGIN_DIR_PATH . 'public/templatebox/style/style-4.php' );
			}else{
				/*If user forget to select theme setting and save then run theme template first*/
				function style_1($post_id){
					return $post_id;
				}
				include( CDLZR_TABS_PLUGIN_DIR_PATH . 'public/templatebox/style/style-1.php' );
			}			
		}
	}
}	
?>