<?php
defined( 'ABSPATH' ) or die();

if( !class_exists('CDLZR_TABS_BOX_PUBLIC')){
	class CDLZR_TABS_BOX_PUBLIC{
		function __construct(){
			require_once( CDLZR_TABS_PLUGIN_DIR_PATH.'public/templatebox/class-cdlzr-tabbox-shortcode.php' );	
			add_shortcode( 'CDLZR_TAB_PILLS', array( 'CDLZR_TABBOX_Shortcode', 'show_tabsbox' ) );
			add_filter('wp_enqueue_scripts',['CDLZR_TABS_BOX_PUBLIC','enqjs'],1);

		}


		public static function enqjs(){
			wp_enqueue_script( 'jquery',false, array(), false, false );
		}
	}
}