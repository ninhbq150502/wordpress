<?php
defined( 'ABSPATH' ) or die();

if( !class_exists('CDLZR_TABS_BOX')){
	class CDLZR_TABS_BOX{
		function __construct(){
			require_once( CDLZR_TABS_PLUGIN_DIR_PATH . 'admin/cpt/class-cdlzr-tabs-cpt.php' );
			require_once( CDLZR_TABS_PLUGIN_DIR_PATH . 'admin/mbox/class-cdlzr-tabs-metaboxes.php' );
			require_once( CDLZR_TABS_PLUGIN_DIR_PATH . 'admin/menu/class-cdlzr-menu.php' );

			 add_action('init', array('CDLZR_TABS_BOX_CPT', 'create_tabsbox_cpt'), 1);
			 add_action( 'admin_menu', array( 'CDLZR_TABSPILLS_BOX_MENU', 'cdlzr_tabspillsbox_create_menu' ) );	
			 add_action('add_meta_boxes', array('CDLZR_TABS_BOX_METABOXES', 'metabox_group'));
			 add_action('admin_init', array('CDLZR_TABS_BOX_METABOXES', 'metabox_group'), 1);

			 add_action( 'wp_ajax_tabs_wpeditor', array( 'CDLZR_TABS_BOX_METABOXES', 'tabs_wpeditor' ) );

			/* Save post meta on the 'save_post' hook. */
			add_action( 'save_post', array('CDLZR_TABS_BOX_METABOXES','tabsbox_save_metabox'), 10, 2);
			/*Save Metabox settings*/
			add_action( 'save_post', array('CDLZR_TABS_BOX_METABOXES','tabsbox_save_metabox_tools'), 10, 2);
			/* Set Testimonial columns */
			add_filter( 'manage_cdlzr_tabs_box_posts_columns', array( 'CDLZR_TABS_BOX_METABOXES', 'set_columns' ) );
			add_action( 'manage_cdlzr_tabs_box_posts_custom_column', array( 'CDLZR_TABS_BOX_METABOXES', 'manage_col' ), 10, 2 );	
			add_filter( 'plugin_action_links_' . plugin_basename(CDLZR_TABS_FILE), array( 'CDLZR_TABS_BOX_METABOXES', 'tabspills_plugin_actions_links' ) );				
		}
	}
}