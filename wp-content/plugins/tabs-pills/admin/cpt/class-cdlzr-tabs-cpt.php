<?php
defined('ABSPATH') or die();

if( ! class_exists('CDLZR_TABS_BOX_CPT') ) {
	class CDLZR_TABS_BOX_CPT {
		public static function create_tabsbox_cpt(){
			$labels = array(
		        'name'                => _x( 'Tabs & Pills', 'Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'singular_name'       => _x( 'Tabs & Pills', 'Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'menu_name'           => __( 'Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'parent_item_colon'   => __( 'Parent Item:', CDLZR_PLUG_TABS_DOM ),
		        'all_items'           => __( 'All Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'view_item'           => __( 'View Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'add_new_item'        => __( 'Add New Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'add_new'             => __( 'Add Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'edit_item'           => __( 'Edit Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
				'new_item' 			  => __( 'New Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'update_item'         => __( 'Update Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'search_items'        => __( 'Search Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'not_found'           => __( 'No Tabs & Pills Found', CDLZR_PLUG_TABS_DOM ),
		        'not_found_in_trash'  => __( 'No Tabs & Pills found in Trash', CDLZR_PLUG_TABS_DOM ),
		    );
		    $args = array(
		        'label'               => __( 'Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'description'         => __( 'Tabs & Pills', CDLZR_PLUG_TABS_DOM ),
		        'labels'              => $labels,
		        'supports'            => array( 'title', '', '', '', '', '', '', '', '', '', ),
		        'hierarchical'        => false,
		        'public'              => false,
		        'show_ui'             => true,
		        'show_in_menu'        => false,
		        'show_in_nav_menus'   => true,
		        'show_in_admin_bar'   => true,
		        'menu_position'       => 10,
		        'menu_icon'           => esc_url(CDLZR_TABS_URL.'assets/logo/tabsboxmenu.png'),
		        'can_export'          => true,
		        'has_archive'         => true,
		        'exclude_from_search' => false,
		        'publicly_queryable'  => false,
		        'capability_type'     => 'page',
		    );
			register_post_type( 'cdlzr_tabs_box', $args );
		}
	}
}