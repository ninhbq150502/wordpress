<?php
/**
 * Plugin Name: Tabs & Pills
 * Plugin URI: https://wordpress.org/plugins/tabs-pills/
 * Description: Tabs & Pills is responsive & the most easiest Tabs builder for WordPress. You can create unlimited tabs with unlimited color Scheme. It is simplest way to awesome WordPress Responsive Tabs Plugin with many features.
 * Version: 1.6
 * Author: Codelizar
 * Author URI: https://codelizar.com
 * Text Domain: CDLZR_PLUG_TABS_DOM
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die();

if ( ! defined( 'CDLZR_TABS_URL' ) ) {
	define( "CDLZR_TABS_URL", plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'CDLZR_TABS_PLUGIN_DIR_PATH' ) ) {
	define( 'CDLZR_TABS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'CDLZR_PLUG_TABS_DOM' ) ) {
	define( 'CDLZR_PLUG_TABS_DOM', 'CDLZR_PLUG_TABS_DOM' );
}

if ( ! defined( 'CDLZR_TABS_FILE' ) ) {
	define( 'CDLZR_TABS_FILE', __FILE__ );
}


if ( ! class_exists( 'CDLZR_TABS_CLS' ) ) {
	final class CDLZR_TABS_CLS
	{
		private static $instance = null;

		private function __construct()
		{
			$this->initialize_hooks();
			add_action( 'admin_notices', array('CDLZR_TABS_CLS','cdlzrtabsbox_display_admin_notice' ));		
			add_action( 'admin_init', array('CDLZR_TABS_CLS','cdlzrtabsbox_spare'), 5 );					
		}

		private function initialize_hooks() {
			if ( is_admin() ) {
				require_once( 'admin/class-tabsbox-admin.php' );
				new CDLZR_TABS_BOX;
			}
			require_once( 'public/class-tabsbox-public.php' );
			new CDLZR_TABS_BOX_PUBLIC;
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public static function cdlzrtabsbox_display_admin_notice() {
			$dont_disturb = esc_url( get_admin_url() . '?cdlzrtabsbox_spare_me=1' );
			$plugin_info = get_plugin_data( __FILE__ , true, true );       
			$reviewurl = esc_url( 'https://wordpress.org/support/plugin/tabs-pills/reviews/' );
			if( !get_option('cdlzrtabsbox_spare') ){
				printf(__('<div class="notice notice-success" style="padding: 10px;">You have been using <b> %s </b> for a while. We hope you liked it! Please give us a quick rating, it works as a boost for us to keep working on the plugin!<br><div class="void-review-btn"><a href="%s" style="margin-top: 10px; display: inline-block; margin-right: 5px;" class="button button-primary" target=
				"_blank">Rate Now!</a><a href="%s" style="margin-top: 10px; display: inline-block; margin-right: 5px;" class="button button-secondary">Already Done !</a></div></div>', $plugin_info['TextDomain']), $plugin_info['Name'], $reviewurl, $dont_disturb );
			}
		}

		// remove the notice for the user if review already done or if the user does not want to
		public static function cdlzrtabsbox_spare(){    
		    if( isset( $_GET['cdlzrtabsbox_spare_me'] ) && !empty( $_GET['cdlzrtabsbox_spare_me'] ) ){
		        $cdlzrtabsbox_spare_me = $_GET['cdlzrtabsbox_spare_me'];
		        if( $cdlzrtabsbox_spare_me == 1 ){
		            add_option( 'cdlzrtabsbox_spare' , TRUE );
		        }
		    }
		}		
	}
}
CDLZR_TABS_CLS::get_instance();