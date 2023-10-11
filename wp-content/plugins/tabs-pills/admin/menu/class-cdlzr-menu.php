<?php
defined( 'ABSPATH' ) or die();

if( !class_exists('CDLZR_TABSPILLS_BOX_MENU')){
	class CDLZR_TABSPILLS_BOX_MENU{

		public static function cdlzr_tabspillsbox_create_menu(){
			/* Create Menu */
			global $submenu;
	 		add_menu_page( __('Tabs & Pills', CDLZR_PLUG_TABS_DOM ), __('Tabs & Pills', CDLZR_PLUG_TABS_DOM ), 'manage_options', 'cdlzr_tabspills_box', array( 'CDLZR_TABSPILLS_BOX_MENU', 'tabspillsbox_cpt' ), esc_url(CDLZR_TABS_URL.'assets/logo/tabsboxmenu.png'), '10'); 

	 		add_submenu_page( 'cdlzr_tabspills_box', __('Add Tabs & Pills', CDLZR_PLUG_TABS_DOM ) , __('Add Tabs & Pills', CDLZR_PLUG_TABS_DOM ), 'manage_options', 'post-new.php?post_type=cdlzr_tabs_box',null );

	 		$submenu['cdlzr_tabspills_box'][0][0] = "All Tabs & Pills";

	 		$go_pro = add_submenu_page( 'cdlzr_tabspills_box', __('Upgrade To Pro', CDLZR_PLUG_TABS_DOM ) , __('Upgrade To Pro', CDLZR_PLUG_TABS_DOM ), 'manage_options', 'accbox_upgpro', array( 'CDLZR_TABSPILLS_BOX_MENU', 'upgtopro_submenu' )   );
	 		add_action( 'admin_print_styles-' . $go_pro, array( 'CDLZR_TABSPILLS_BOX_MENU', 'enqcssjs' ) );	

	 		$submenu['cdlzr_tabspills_box'][0][0] = "All Tabs & Pills";
			
		}

		public static function tabspillsbox_cpt(){
			$cpt_url = home_url()."/wp-admin/edit.php?post_type=cdlzr_tabs_box";
			?>
			<script type="text/javascript">
				window.location.replace('<?php echo $cpt_url; ?>');
			</script>
			<?php
		}

		public static function upgtopro_submenu(){
			require_once( CDLZR_TABS_PLUGIN_DIR_PATH . 'admin/upg_to_pro.php' );			
		}

		public static function enqcssjs(){
			wp_enqueue_style( 'bootstrap_css', CDLZR_TABS_URL . 'admin/assets/css/bootstrap.min.css'  );
			wp_enqueue_style('fontawesome_css', CDLZR_TABS_URL . 'admin/assets/css/fontawesome/css/all.min.css');			
		}
	}
}
