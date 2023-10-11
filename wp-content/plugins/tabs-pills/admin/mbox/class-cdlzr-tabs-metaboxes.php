<?php
defined('ABSPATH') or die();

if( ! class_exists('CDLZR_TABS_BOX_METABOXES') ) {
	class CDLZR_TABS_BOX_METABOXES {

		public static function metabox_group(){

			add_action( 'admin_enqueue_scripts', array( 'CDLZR_TABS_BOX_METABOXES', 'cdlzr_tabsbox_admin_print_scripts' ) );				

			 /* Add meta boxes on the 'add_meta_boxes' hook. */
			  add_action( 'add_meta_boxes', array('CDLZR_TABS_BOX_METABOXES','cdlzr_tabsbox_metaboxes' ));
		}

		/* Create one or more meta boxes to be displayed on the post editor screen. */
		public static function cdlzr_tabsbox_metaboxes() {

			add_meta_box(
			    'cdlzr-tabs-box',      // Unique ID
			    esc_html__( 'Add Tabs & Pills', 'CDLZR_PLUG_TABS_DOM' ),    // Title
			    array('CDLZR_TABS_BOX_METABOXES','cdlzr_add_tabsbox_metabox'),   // Callback function
			    'cdlzr_tabs_box',         // Admin page (or post type)
			    'normal',         // Context
			    'default'         // Priority
			  );

			add_meta_box(
			    'cdlzr-tabs-scode',      // Unique ID
			    esc_html__( 'Tabs & Pills Shorcode', 'CDLZR_PLUG_TABS_DOM' ),    // Title
			    array('CDLZR_TABS_BOX_METABOXES','cdlzr_add_tabsbox_shortcode'),   // Callback function
			    'cdlzr_tabs_box',         // Admin page (or post type)
			    'side',         // Context
			    'low'         // Priority
			  );	

			  add_meta_box(
			    'cdlzr-tabs-settings',      // Unique ID
			    esc_html__( 'Tabs & Pills Title', 'CDLZR_PLUG_TABS_DOM' ),    // Title
			    array('CDLZR_TABS_BOX_METABOXES','cdlzr_tabsbox_title'),   // Callback function
			    'cdlzr_tabs_box',         // Admin page (or post type)
			    'side',         // Context
			    'low'         // Priority
			  );

			  add_meta_box(
			    'cdlzr-tabs-template-setting',      // Unique ID
			    esc_html__( 'Template Layout', 'CDLZR_PLUG_TABS_DOM' ),    // Title
			    array('CDLZR_TABS_BOX_METABOXES','cdlzr_select_template_tabs_metabox'),   // Callback function
			    'cdlzr_tabs_box',         // Admin page (or post type)
			    'side',         // Context
			    'low'         // Priority
			  );

			  add_meta_box(
			    'cdlzr-tabs-box-settings',      // Unique ID
			    esc_html__( 'Tabs & Pills Settings', 'CDLZR_PLUG_TABS_DOM' ),    // Title
			    array('CDLZR_TABS_BOX_METABOXES','cdlzr_tabsbox_metabox_settings'),   // Callback function
			    'cdlzr_tabs_box',         // Admin page (or post type)
			    'normal',         // Context
			    'default'         // Priority
			  );	

			  add_meta_box(
			    'cdlzr-tabs-box-rating',      // Unique ID
			    esc_html__( 'Show Us Some Love', 'CDLZR_PLUG_TABS_DOM' ),    // Title
			    array('CDLZR_TABS_BOX_METABOXES','cdlzr_tabsbox_rating_metabox'),   // Callback function
			    'cdlzr_tabs_box',         // Admin page (or post type)
			    'side',         // Context
			    'low'         // Priority
			  );			
		}

		public static function cdlzr_tabsbox_admin_print_scripts( $hook_suffix ) {
		    if ( in_array( $hook_suffix, array('post.php', 'post-new.php') ) ) {
		        $screen = get_current_screen();	
		        wp_enqueue_script( 'jquery' ); //mother js library		        
		        // here 'cdlzr_tabs_box' is cptname
		        if ( is_object( $screen ) && 'cdlzr_tabs_box' === $screen->post_type ) {
		        	wp_enqueue_editor();
		        	wp_enqueue_script('wltp-tabs-admin', CDLZR_TABS_URL . 'admin/assets/js/cdlzr-tabsbox-admin.js', array('jquery'), true, true);
		        	 wp_enqueue_style( 'cdlzr-tabs-bootstrap', CDLZR_TABS_URL . 'admin/assets/css/bootstrap.min.css'  );
				    wp_enqueue_style('cdlzr-tabs-admin-css', CDLZR_TABS_URL . 'admin/assets/css/admin-tabs-css.css', array(), true, 'all');
					wp_enqueue_style('cdlzr-tabs-fontawesome', CDLZR_TABS_URL . 'admin/assets/css/fontawesome/css/all.min.css', array(), true, 'all');
					wp_enqueue_script('cdlzr-tabs-custom-js', CDLZR_TABS_URL . 'admin/assets/js/custom-js.js', array('jquery'), true, true);
					wp_enqueue_script('cdlzr-tabs-bootstrap-js', CDLZR_TABS_URL . 'admin/assets/js/bootstrap.min.js', array('jquery'), true, true);
					wp_enqueue_style( 'sidebar-tabs-bootstrap', CDLZR_TABS_URL . 'admin/assets/css/bootstrap-side-modals.css'  );
					wp_enqueue_style( 'jquery-tabs-linedtextarea-css', CDLZR_TABS_URL . 'admin/assets/css/jquery-linedtextarea.css'  );
					wp_enqueue_script('jquery-tabs-linedtextarea-js', CDLZR_TABS_URL . 'admin/assets/js/jquery-linedtextarea.js', array('jquery'), true, true);
					wp_enqueue_style( 'wp-color-picker' ); 	
        			wp_enqueue_script('wp-color-picker', plugins_url('admin/assets/js/custom-js.js', __FILE__ ), array( 'wpcolorpicker' ), false, true );
		        }
		    }		   
		} 
		
		public static function cdlzr_add_tabsbox_metabox( $post ){			
				$post_id      = $post->ID;
				$dynamic_data = get_post_meta($post_id, 'tabsbox_metabox_'.$post_id, true);
				wp_nonce_field( basename( __FILE__ ), 'tabsbox_post_class_nonce' );				
			?>	
				<div id="divcontrolbox_tabs_rows" class="row">					
					<?php						
						if (is_array($dynamic_data) && count($dynamic_data) > 0){
							$k=3;
							foreach ($dynamic_data as $key => $value) {
								 $mytext 		= $value['mytext'];
								 $mydesc 		= $value['mydesc'];
								 $myfontawe     = $value['myfontawe'];
								?>	
									<div class="col-md-6 divcontrolboxtabs">
										<div class="div_inner">
											<div class=" form-group div_inner_tabsbox">
												<small class="d-block float-right">
													<button type="button" class="cdlzr_tabsbox_remove_label btn btn-sm btn-warning cdlzr_remove_label mb-1"><i class="fas fa-times"></i></button>
												</small>
												<label><?php esc_html_e( 'My Title', CDLZR_PLUG_TABS_DOM ); ?></label>
												<input type="text" name="mytext[]" class="form-control" value="<?php echo esc_attr($mytext); ?>">
												<label class="mt-3"><?php esc_html_e( 'My Description', CDLZR_PLUG_TABS_DOM ); ?></label>
												<!-- <textarea  id="mydesc<?php //echo $k; ?>" name="mydesc[]" class="form-control" rows='4'><?php //echo esc_attr($mydesc); ?></textarea> -->
												<?php
													 wp_editor( $mydesc, "mydesc".$k, $settings = array(
													 	'drag_drop_upload'    => false,
													 	'media_buttons' 	  => true,
											            'textarea_name'       => "mydesc[]",
											            'textarea_rows'       => 5,
											            'tabindex'            => '',
											            'tabfocus_elements'   => ':prev,:next',
											            'editor_css'          => '',
											            'editor_class'        => '',
											            'teeny'               => false,
											            '_content_editor_dfw' => false,
											            'tinymce' => array(	   	
											            // Items for the Visual Tab
											            'plugins'=>"textcolor,link",
											            'toolbar1'=> 'bold,italic,link',
											        ),
											            'quicktags'           => true,) );													
												?>	
												<label class="mt-3"><?php esc_html_e( 'Font-Awesome Icon', CDLZR_PLUG_TABS_DOM ); ?></label>
												<input type="text" name="myfontawe[]" class="form-control" value="<?php echo esc_attr($myfontawe); ?>">	
												<label class="mt-3"><?php esc_html_e( 'Select Post -- For display post in tabs', CDLZR_PLUG_TABS_DOM ); ?></label>
												<select class="form-control cdlzr_sel_post">
													<option> -- Select Post -- </option>
													<option>Go Premium</option>
												</select>												
											</div>						
										</div>					
									</div>
								<?php
								$k++;
							}

						}else{
							?>
								<div class="col-md-6 divcontrolboxtabs">
									<div class="div_inner">
										<div class="form-group div_inner_tabsbox">
											<small class="d-block float-right">
												<button type="button" class="cdlzr_tabsbox_remove_label btn btn-sm btn-warning cdlzr_remove_label mb-1"><i class="fas fa-times"></i></button>
											</small>
											<label><?php esc_html_e( 'My Title', CDLZR_PLUG_TABS_DOM ); ?></label>
											<input type="text" name="mytext[]" class="form-control">
											<label class="mt-3"><?php esc_html_e( 'My Description', CDLZR_PLUG_TABS_DOM ); ?></label>	
											<!-- <textarea id="mydesc1" name="mydesc[]" class="form-control" rows='4'></textarea>	 -->
											<?php
												wp_editor( "", "mydesc1", $settings = array(
													 	'drag_drop_upload'    => false,
													 	'media_buttons' 	  => true,
											            'textarea_name'       => "mydesc[]",
											            'textarea_rows'       => 5,
											            'tabindex'            => '',
											            'tabfocus_elements'   => ':prev,:next',
											            'editor_css'          => '',
											            'editor_class'        => '',
											            'teeny'               => false,
											            '_content_editor_dfw' => false,
											            'tinymce' => array(	  
											            // Items for the Visual Tab
											            'plugins'=>"textcolor,link",	
											            // Items for the Visual Tab
											            'toolbar1'=> 'bold,italic,link',
											        ),
											            'quicktags'           => true,) );
											?>
											<label class="mt-3"><?php esc_html_e( 'Font-Awesome Icon', CDLZR_PLUG_TABS_DOM ); ?></label>
											<input type="text" name="myfontawe[]" class="form-control" value="<?php if(isset($myfontawe)){ echo esc_attr($myfontawe); } ?>">
											<label class="mt-3"><?php esc_html_e( 'Select Post -- For display post in tabs', CDLZR_PLUG_TABS_DOM ); ?></label>
											<select class="form-control cdlzr_sel_post">
												<option> -- Select Post -- </option>
												<option>Go Premium</option>
											</select>											
										</div>															
									</div>					
								</div>
								<div class="col-md-6 divcontrolboxtabs">
									<div class="div_inner">
										<div class="form-group div_inner_tabsbox">
											<small class="d-block float-right">
												<button type="button" class="cdlzr_tabsbox_remove_label btn btn-sm btn-warning cdlzr_remove_label mb-1"><i class="fas fa-times"></i></button>
											</small>
											<label><?php esc_html_e( 'My Title', CDLZR_PLUG_TABS_DOM ); ?></label>
											<input type="text" name="mytext[]" class="form-control">
											<label class="mt-3"><?php esc_html_e( 'My Description', CDLZR_PLUG_TABS_DOM ); ?></label>	
											<!-- <textarea id="mydesc2" name="mydesc[]" class="form-control" rows='4'></textarea> -->
											<?php
												wp_editor( "", "mydesc2", $settings = array(
													 	'drag_drop_upload'    => false,
													 	'media_buttons' 	  => true,
											            'textarea_name'       => "mydesc2",
											            'textarea_rows'       => 5,
											            'tabindex'            => '',
											            'tabfocus_elements'   => ':prev,:next',
											            'editor_css'          => '',
											            'editor_class'        => '',
											            'teeny'               => false,
											            '_content_editor_dfw' => false,
											            'tinymce' => array(				            	
											            // Items for the Visual Tab
											            'plugins'=>"textcolor,link",	
											            // Items for the Visual Tab
											            'toolbar1'=> 'bold,italic,link',
											        ),
											            'quicktags'           => true,) );
											?>
											<label class="mt-3"><?php esc_html_e( 'Font-Awesome Icon', CDLZR_PLUG_TABS_DOM ); ?></label>
											<input type="text" name="myfontawe[]" class="form-control" value="<?php if(isset($myfontawe)){ echo esc_attr($myfontawe); } ?>">	
											<label class="mt-3"><?php esc_html_e( 'Select Post -- For display post in tabs', CDLZR_PLUG_TABS_DOM ); ?></label>
											<select class="form-control cdlzr_sel_post">
												<option> -- Select Post -- </option>
												<option>Go Premium</option>
											</select>		
										</div>																
									</div>					
								</div>
							<?php
						}
					?>
				</div>					

				<!-- Modal -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h6 class="modal-title" id="exampleModalLongTitle"><img src="<?php echo esc_url(CDLZR_TABS_URL.'assets/logo/tabsboxmenu.png'); ?>"/> Tabs & Pills</h6>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <h6 class="text-danger text-center">For apply this feature checkout our premium version.</h6>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <a target="_blank" href="https://codelizar.com/product/tabs-pills-pro/" class="btn btn-warning">Go Pro</a>
				      </div>
				    </div>
				  </div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<button id="create_tabs_btn" type="button" class="btn btn-dark float-right"><?php esc_html_e( 'More Tabs & Pills', CDLZR_PLUG_TABS_DOM ); ?> <img src="<?php echo
						esc_url(CDLZR_TABS_URL.'assets/logo/tabsboxmenu.png'); ?>"/></button>
						<button id="delete_tabs_element_btn" type="button" class="btn btn-danger float-right mr-2"><?php esc_html_e( 'Delete All', CDLZR_PLUG_TABS_DOM ); ?> <i class="fa fa-trash"></i></button>
					</div>	
					<div class="col-md-12">							
						<p><b style="color:red;">Note :</b> Font Awesome Icon is available only in Template B, C & D | Get More Font-Awesome Icon <a target="_blank" href="https://fontawesome.com/icons?d=gallery"><b>Click Here</b></a></p>
					</div>					
				</div>
			<?php
		}

		public static function cdlzr_tabsbox_title($post){		
			$post_id        = $post->ID;
			$dynamic_data   = get_post_meta($post_id, 'tabsbox_metabox_tools_'.$post_id, true);				
			if($dynamic_data['tabs_title']!=""){
				$selected_title = $dynamic_data['tabs_title'];
			}else{
				$selected_title = 1;
			}		
			?>
				<div class="row">
					<div class="col-md-12">
						<label><?php esc_html_e( 'Title Show On/Off', CDLZR_PLUG_TABS_DOM ); ?></label>
						<select name="tabs_title" class="form-control">
							<option <?php if($selected_title == 1){ echo esc_html("selected=selected"); } ?> value="1"><?php esc_html_e( 'On', CDLZR_PLUG_TABS_DOM ); ?></option>
							<option <?php if($selected_title == 0){ echo esc_html("selected=selected"); } ?> value="0"><?php esc_html_e( 'Off', CDLZR_PLUG_TABS_DOM ); ?></option>
						</select>
					</div>					
				</div>
			<?php
		}

		public static function tabsbox_save_metabox($post_id, $post){

			/* Verify the nonce before proceeding. */
			if ( !isset( $_POST['tabsbox_post_class_nonce'] ) || !wp_verify_nonce( $_POST['tabsbox_post_class_nonce'], basename( __FILE__ ) ) )
			return $post_id;			
			
			$tabs_title_arr  		= (isset($_POST['mytext']) && is_array($_POST['mytext'])) ? $_POST['mytext'] : array();

			$tabs_desc_arr  		=  (isset($_POST['mydesc']) && is_array($_POST['mydesc'])) ? $_POST['mydesc'] : array();

			$tabs_fnte_arr  			=  (isset($_POST['myfontawe']) && is_array($_POST['myfontawe'])) ? array_map('sanitize_text_field', $_POST['myfontawe']) : array();			
			$tabs_data_arr = array();

			foreach ($tabs_title_arr as $key => $tabs_title ) {
				array_push($tabs_data_arr, array(					
					'mytext'		=>	isset($tabs_title) ? $tabs_title : null,
					'mydesc'		=>	isset($tabs_desc_arr[$key]) ? $tabs_desc_arr[$key] : null,
					'myfontawe'		=>	isset($tabs_fnte_arr[$key]) ? sanitize_text_field($tabs_fnte_arr[$key]) : null				
				)
			  );
			}

			$data_metakey = "tabsbox_metabox_".$post_id;
			update_post_meta($post_id,$data_metakey, $tabs_data_arr);
		}

		public static function tabsbox_save_metabox_tools($post_id, $post){

			$tabs_head_title	 		=  (isset($_POST['tabs_title'])) ? sanitize_text_field($_POST['tabs_title']) : '';
			$style_tabsbox 			= (isset($_POST['style_tabsbox'])) ? sanitize_text_field($_POST['style_tabsbox']) : '';	
			$tabs_cust_css		    = (isset($_POST['tabs_cust_css'])) ? $_POST['tabs_cust_css'] : '';
			$cdlzr_tabs_ttle_clr 	= (isset($_POST['cdlzr_tabs_ttle_clr'])) ? $_POST['cdlzr_tabs_ttle_clr'] : '';
			$cdlzr_tabs_inact_ttle_clr = (isset($_POST['cdlzr_tabs_inact_ttle_clr'])) ? $_POST['cdlzr_tabs_inact_ttle_clr'] : '';
			$cdlzr_tabs_desc_clr 	= (isset($_POST['cdlzr_tabs_desc_clr'])) ? $_POST['cdlzr_tabs_desc_clr'] : '';
			$cdlzr_active_tabs_bg_clr 	= (isset($_POST['cdlzr_active_tabs_bg_clr'])) ? $_POST['cdlzr_active_tabs_bg_clr'] : '';
			$cdlzr_inactive_tabs_bg_clr 	= (isset($_POST['cdlzr_inactive_tabs_bg_clr'])) ? $_POST['cdlzr_inactive_tabs_bg_clr'] : '';
			$cdlzr_tabs_container_bg_clr 	= (isset($_POST['cdlzr_tabs_container_bg_clr'])) ? $_POST['cdlzr_tabs_container_bg_clr'] : '';			

			$tabs_data_tools_arr = array(
				'tabs_title'    =>	isset($tabs_head_title) ? sanitize_text_field($tabs_head_title) : null,	
				'style_tabsbox'	=>	isset($style_tabsbox) ? sanitize_text_field($style_tabsbox) : null,	
				'tabs_cust_css'	=>  isset($tabs_cust_css) ? $tabs_cust_css : null,	
				'tabs_title_fontfamily'	=>  isset($tabs_title_fontfamily) ? $tabs_title_fontfamily : null,	
				'tabs_desc_fontfamily'	=>  isset($tabs_desc_fontfamily) ? $tabs_desc_fontfamily : null,	
				'cdlzr_tabs_ttle_clr'	=>	isset($cdlzr_tabs_ttle_clr) ? sanitize_text_field($cdlzr_tabs_ttle_clr) : null,	
			    'cdlzr_tabs_inact_ttle_clr'	=>	isset($cdlzr_tabs_inact_ttle_clr) ? sanitize_text_field($cdlzr_tabs_inact_ttle_clr) : null,	
				'cdlzr_tabs_desc_clr'	=>	isset($cdlzr_tabs_desc_clr) ? sanitize_text_field($cdlzr_tabs_desc_clr) : null,	
				'cdlzr_active_tabs_bg_clr'	=>	isset($cdlzr_active_tabs_bg_clr) ? sanitize_text_field($cdlzr_active_tabs_bg_clr) : null,	
				'cdlzr_inactive_tabs_bg_clr'	=>	isset($cdlzr_inactive_tabs_bg_clr) ? sanitize_text_field($cdlzr_inactive_tabs_bg_clr) : null,	
				'cdlzr_tabs_container_bg_clr'	=>	isset($cdlzr_tabs_container_bg_clr) ? sanitize_text_field($cdlzr_tabs_container_bg_clr) : null,	
			);

			$data_metakey_tools = "tabsbox_metabox_tools_".$post_id;
			update_post_meta($post_id,$data_metakey_tools, $tabs_data_tools_arr);
		}

		public static function cdlzr_add_tabsbox_shortcode($post){
			$post_id      = $post->ID;
			$tabsbox_scode = "[CDLZR_TAB_PILLS id=".$post_id."]";
			?>			
			<p><?php esc_html_e( 'Copy and paste this shortcode at page/post for display', CDLZR_PLUG_TABS_DOM ); ?> <b><?php esc_html_e( 'Tabs & Pills', CDLZR_PLUG_TABS_DOM ); ?></b></p>
			<p>
				<input type="text" value="<?php echo esc_attr($tabsbox_scode); ?>" readonly class="form-control">
			</p>
			<?php
		}

		public static function cdlzr_select_template_tabs_metabox($post){			
			$post_id      = $post->ID;
			$dynamic_data = get_post_meta($post_id, 'tabsbox_metabox_tools_'.$post_id, true);			
			if($dynamic_data['style_tabsbox']!=""){
				$selected_theme = $dynamic_data['style_tabsbox'];
			}else{
				$selected_theme = 1;
			}	
			?>
				<div class="row">					
					<div class="col-md-12">
						<button type="button" class="btn btn-primary btn-block" name="btn_accbox_template" id="btn_tabsbox_template" data-toggle="modal" data-target="#cdlzr_theme_modal_lg"><?php esc_html_e( 'Select Template', CDLZR_PLUG_TABS_DOM ); ?>&nbsp;<i class="fas fa-palette"></i></button>
					</div>
					<div class="modal right fade" id="cdlzr_theme_modal_lg" tabindex="-1" role="dialog" aria-labelledby="cdlzr_theme_modal_lg">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header mt-3">
									<h5 class="modal-title"><?php esc_html_e( 'Select Template For Tabs & Pills', CDLZR_PLUG_TABS_DOM ); ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<div class="modal-body">
									<div class="row">										
										<div class="col-md-12 cap-style1">
											<h5><?php esc_html_e( 'Template - A', CDLZR_PLUG_TABS_DOM ); ?> <input <?php if($selected_theme==1){ echo esc_html("checked"); } ?> type="radio" name="style_tabsbox" class="form-control float-right chk_style" value="1"></h5>
											
										</div>
										<div class="col-md-12 style1">
											<img class="img-responsive" src="<?php echo esc_url(CDLZR_TABS_URL.'admin/assets/images/style1.PNG'); ?>" style="width:100%;height:500px;"/>
										</div>
										
										<div class="col-md-12 cap-style1">
											<h5><?php esc_html_e( 'Template - B', CDLZR_PLUG_TABS_DOM ); ?> <input <?php if($selected_theme==2){ echo esc_html("checked"); } ?> type="radio" name="style_tabsbox" class="form-control float-right chk_style" value="2"></h5>
										</div>
										<div class="col-md-12 style1">
											<img class="img-responsive" src="<?php echo esc_url(CDLZR_TABS_URL.'admin/assets/images/style2.PNG'); ?>" style="width:100%;height:500px;"/>
										</div>
										
										<div class="col-md-12 cap-style1">
											<h5><?php esc_html_e( 'Template - C', CDLZR_PLUG_TABS_DOM ); ?> <input <?php if($selected_theme==3){ echo esc_html("checked"); } ?> type="radio" name="style_tabsbox" class="form-control float-right chk_style" value="3"></h5>
										</div>
										<div class="col-md-12 style1">
											<img class="img-responsive" src="<?php echo esc_url(CDLZR_TABS_URL.'admin/assets/images/style3.PNG'); ?>" style="width:100%;height:500px;"/>
										</div>

										<div class="col-md-12 cap-style1">
											<h5><?php esc_html_e( 'Template - D', CDLZR_PLUG_TABS_DOM ); ?> <input <?php if($selected_theme==4){ echo esc_html("checked"); } ?> type="radio" name="style_tabsbox" class="form-control float-right chk_style" value="4"></h5>
										</div>
										<div class="col-md-12 style1">
											<img class="img-responsive" src="<?php echo esc_url(CDLZR_TABS_URL.'admin/assets/images/style4.PNG'); ?>" style="width:100%;height:500px;"/>
										</div>
										
									</div>								
								</div>
							</div>	
						</div>	
					</div>					
				</div>
			<?php
		}

	public static function cdlzr_tabsbox_rating_metabox(){
		?>
		<div class="row">
			<div class="col-md-12 text-center">
				<a href="https://wordpress.org/plugins/tabs-pills/#reviews" target="_blank"><i style="color:red;" class="fas fa-star fa-2x"></i></a>
				<a href="https://wordpress.org/plugins/tabs-pills/#reviews" target="_blank"><i style="color:red;" class="fas fa-star fa-2x"></i></a>
				<a href="https://wordpress.org/plugins/tabs-pills/#reviews" target="_blank"><i style="color:red;" class="fas fa-star fa-2x"></i></a>
				<a href="https://wordpress.org/plugins/tabs-pills/#reviews" target="_blank"><i style="color:red;" class="fas fa-star fa-2x"></i></a>
				<a href="https://wordpress.org/plugins/tabs-pills/#reviews" target="_blank"><i style="color:red;" class="fas fa-star fa-2x"></i></a>
			</div>			
		</div>
		<?php
	}	

	/**
	 * Set Tabs & Pills columns
	 *
	 * @param array $columns The columns object.
	 * @return array
	 */
		public static function set_columns($columns) {
			unset($columns['author'],
			$columns['Date']);
			$new_cols = array(
				'title'        => esc_html__('Tabs & Pills', 'CDLZR_PLUG_TABS_DOM'),
				'date'         => esc_html__('Date', 'CDLZR_PLUG_TABS_DOM'),
				'shortcode'    => esc_html__('Tabs & Pills Shortcode', 'CDLZR_PLUG_TABS_DOM'),
				'do_shortcode' => esc_html__('Do Shortcode', 'CDLZR_PLUG_TABS_DOM'),
				'author'       => esc_html__('Author', 'CDLZR_PLUG_TABS_DOM'),
			);
			return array_merge($columns, $new_cols);
		}

		/**
		 * Manage Tabs & Pills columns
		 *
		 * @param string  $column The column object.
		 * @param  WP_Post $post_id The post_id object.
		 * @return void
		 */
		public static function manage_col($column, $post_id) {
			global $post;
			switch ($column) {
				case 'shortcode':
					echo '<input type="text" value="[CDLZR_TAB_PILLS id=' . esc_attr($post_id) . ']" readonly="readonly" />';
					break;
				case 'do_shortcode':
					echo '<input type="text" value="<?php echo do_shortcode( \'[CDLZR_TAB_PILLS id=' . esc_attr($post_id) . ']\' ); ?>" readonly="readonly" />';
					break;
				default:
					break;
			}
		}

		public static function cdlzr_tabsbox_metabox_settings( $post ){
			$post_id        = $post->ID;
			$dynamic_data   = get_post_meta($post_id, 'tabsbox_metabox_tools_'.$post_id, true);

			$tabs_cust_css  = $dynamic_data['tabs_cust_css'];

			if(isset($dynamic_data['tabs_title_fontfamily'])){
				$tabs_title_fontfamily  = $dynamic_data['tabs_title_fontfamily'];
			}else{
				$tabs_title_fontfamily  = "Arial, sans-serif";
			}

			if(isset($dynamic_data['tabs_desc_fontfamily'])){
				$tabs_desc_fontfamily  = $dynamic_data['tabs_desc_fontfamily'];
			}else{
				$tabs_desc_fontfamily  = "Arial, sans-serif";
			}

			if(isset($dynamic_data['cdlzr_tabs_ttle_clr'])){
				$cdlzr_tabs_ttle_clr  = $dynamic_data['cdlzr_tabs_ttle_clr'];
			}else{
				$cdlzr_tabs_ttle_clr  = "#000000";
			}

			if(isset($dynamic_data['cdlzr_tabs_inact_ttle_clr'])){
				$cdlzr_tabs_inact_ttle_clr  = $dynamic_data['cdlzr_tabs_inact_ttle_clr'];
			}else{
				$cdlzr_tabs_inact_ttle_clr  = "#fff";
			}			

			if(isset($dynamic_data['cdlzr_tabs_desc_clr'])){
				$cdlzr_tabs_desc_clr  = $dynamic_data['cdlzr_tabs_desc_clr'];
			}else{
				$cdlzr_tabs_desc_clr  = "#000000";
			}

			if(isset($dynamic_data['cdlzr_active_tabs_bg_clr'])){
				$cdlzr_active_tabs_bg_clr  = $dynamic_data['cdlzr_active_tabs_bg_clr'];
			}else{
				$cdlzr_active_tabs_bg_clr  = "#ff8b38";
			}	

			if(isset($dynamic_data['cdlzr_inactive_tabs_bg_clr'])){
				$cdlzr_inactive_tabs_bg_clr  = $dynamic_data['cdlzr_inactive_tabs_bg_clr'];
			}else{
				$cdlzr_inactive_tabs_bg_clr  = "#333";
			}	

			if(isset($dynamic_data['cdlzr_tabs_container_bg_clr'])){
				$cdlzr_tabs_container_bg_clr  = $dynamic_data['cdlzr_tabs_container_bg_clr'];
			}else{
				$cdlzr_tabs_container_bg_clr  = "#f5f5f5";
			}	
		
			?>
			<div class="row">
				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'Active Tabs Font Color', CDLZR_PLUG_TABS_DOM ); ?></label><br>
					<input type="text" name="cdlzr_tabs_ttle_clr" id="cdlzr_tabs_ttle_clr" class="my-color-field" value="<?php echo esc_attr($cdlzr_tabs_ttle_clr); ?>" data-default-color="#ff0000">
				</div>

				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'Inactive Tabs Font Color', CDLZR_PLUG_TABS_DOM ); ?></label><br>
					<input type="text" name="cdlzr_tabs_inact_ttle_clr" id="cdlzr_tabs_inact_ttle_clr" class="my-color-field" value="<?php echo esc_attr($cdlzr_tabs_inact_ttle_clr); ?>" data-default-color="#fff">
				</div>

				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'Tabs Font Description Color', CDLZR_PLUG_TABS_DOM ); ?></label><br>
					<input type="text" name="cdlzr_tabs_desc_clr" id="cdlzr_tabs_desc_clr" class="my-color-field" value="<?php echo esc_attr($cdlzr_tabs_desc_clr); ?>" data-default-color="#ff0000">
				</div>

				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'Active Tabs Background Color', CDLZR_PLUG_TABS_DOM ); ?></label><br>
					<input type="text" name="cdlzr_active_tabs_bg_clr" id="cdlzr_active_tabs_bg_clr" class="my-color-field" value="<?php echo esc_attr($cdlzr_active_tabs_bg_clr); ?>" data-default-color="#ff8b38">
				</div>

				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'InActive Tabs Background Color', CDLZR_PLUG_TABS_DOM ); ?></label><br>
					<input type="text" name="cdlzr_inactive_tabs_bg_clr" id="cdlzr_inactive_tabs_bg_clr" class="my-color-field" value="<?php echo esc_attr($cdlzr_inactive_tabs_bg_clr); ?>" data-default-color="#ff8b38">
				</div>

				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'Tabs Container Background Color', CDLZR_PLUG_TABS_DOM ); ?></label><br>
					<input type="text" name="cdlzr_tabs_container_bg_clr" id="cdlzr_tabs_container_bg_clr" class="my-color-field" value="<?php echo esc_attr($cdlzr_tabs_container_bg_clr); ?>" data-default-color="#f5f5f5">
				</div>

				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'Tabs title font family', CDLZR_PLUG_TABS_DOM ); ?></label>
					<select class="form-control" id="tabs_title_fontfamily" name="tabs_title_fontfamily">
						<option <?php if($tabs_title_fontfamily=="Arial, sans-serif"){ echo "selected=selected"; } ?> value="Arial, sans-serif">Arial</option>
						<option <?php if($tabs_title_fontfamily=="Verdana, sans-serif"){ echo "selected=selected"; } ?> value="Verdana, sans-serif">Verdana</option>
						<option <?php if($tabs_title_fontfamily=="Helvetica, sans-serif"){ echo "selected=selected"; } ?> value="Helvetica, sans-serif">Helvetica</option>
						<option <?php if($tabs_title_fontfamily=="Tahoma, sans-serif"){ echo "selected=selected"; } ?> value="Tahoma, sans-serif">Tahoma</option>
						<option <?php if($tabs_title_fontfamily=="Trebuchet, sans-serif"){ echo "selected=selected"; } ?> value="Trebuchet, sans-serif">Trebuchet</option>
						<option <?php if($tabs_title_fontfamily=="Times New Roman, serif"){ echo "selected=selected"; } ?> value="Times New Roman, serif">Times New Roman</option>
						<option <?php if($tabs_title_fontfamily=="Georgia, serif"){ echo "selected=selected"; } ?> value="Georgia, serif">Georgia</option>
						<option <?php if($tabs_title_fontfamily=="Garamond, serif"){ echo "selected=selected"; } ?> value="Garamond, serif">Garamond</option>
						<option <?php if($tabs_title_fontfamily=="Courier New, monospace"){ echo "selected=selected"; } ?> value="Courier New, monospace">Courier New</option>
						<option <?php if($tabs_title_fontfamily=="Lucida Console, monospace"){ echo "selected=selected"; } ?> value="Lucida Console, monospace">Lucida Console</option>
						<option <?php if($tabs_title_fontfamily=="Monaco, monospace"){ echo "selected=selected"; } ?> value="Monaco, monospace">Monaco</option>
						<option <?php if($tabs_title_fontfamily=="Brush Script MT, cursive"){ echo "selected=selected"; } ?> value="Brush Script MT, cursive">Brush Script MT</option>
						<option <?php if($tabs_title_fontfamily=="Lucida Handwriting, cursive"){ echo "selected=selected"; } ?> value="Lucida Handwriting, cursive">Lucida Handwriting</option>
						<option <?php if($tabs_title_fontfamily=="Copperplate, fantasy"){ echo "selected=selected"; } ?> value="Copperplate, fantasy">Copperplate</option>
						<option <?php if($tabs_title_fontfamily=="Papyrus, fantasy"){ echo "selected=selected"; } ?> value="Papyrus, fantasy">Papyrus</option>
					</select>
				</div>				
				<div class="col-md-3 mt-4">
					<label><?php esc_html_e( 'Tabs description font family', CDLZR_PLUG_TABS_DOM ); ?></label>
					<select class="form-control" id="tabs_desc_fontfamily" name="tabs_desc_fontfamily">
						<option <?php if($tabs_desc_fontfamily=="Arial, sans-serif"){ echo "selected=selected"; } ?> value="Arial, sans-serif">Arial</option>
						<option <?php if($tabs_desc_fontfamily=="Verdana, sans-serif"){ echo "selected=selected"; } ?> value="Verdana, sans-serif">Verdana</option>
						<option <?php if($tabs_desc_fontfamily=="Helvetica, sans-serif"){ echo "selected=selected"; } ?> value="Helvetica, sans-serif">Helvetica</option>
						<option <?php if($tabs_desc_fontfamily=="Tahoma, sans-serif"){ echo "selected=selected"; } ?> value="Tahoma, sans-serif">Tahoma</option>
						<option <?php if($tabs_desc_fontfamily=="Trebuchet, sans-serif"){ echo "selected=selected"; } ?> value="Trebuchet, sans-serif">Trebuchet</option>
						<option <?php if($tabs_desc_fontfamily=="Times New Roman, serif"){ echo "selected=selected"; } ?> value="Times New Roman, serif">Times New Roman</option>
						<option <?php if($tabs_desc_fontfamily=="Georgia, serif"){ echo "selected=selected"; } ?> value="Georgia, serif">Georgia</option>
						<option <?php if($tabs_desc_fontfamily=="Garamond, serif"){ echo "selected=selected"; } ?> value="Garamond, serif">Garamond</option>
						<option <?php if($tabs_desc_fontfamily=="Courier New, monospace"){ echo "selected=selected"; } ?> value="Courier New, monospace">Courier New</option>
						<option <?php if($tabs_desc_fontfamily=="Lucida Console, monospace"){ echo "selected=selected"; } ?> value="Lucida Console, monospace">Lucida Console</option>
						<option <?php if($tabs_desc_fontfamily=="Monaco, monospace"){ echo "selected=selected"; } ?> value="Monaco, monospace">Monaco</option>
						<option <?php if($tabs_desc_fontfamily=="Brush Script MT, cursive"){ echo "selected=selected"; } ?> value="Brush Script MT, cursive">Brush Script MT</option>
						<option <?php if($tabs_desc_fontfamily=="Lucida Handwriting, cursive"){ echo "selected=selected"; } ?> value="Lucida Handwriting, cursive">Lucida Handwriting</option>
						<option <?php if($tabs_desc_fontfamily=="Copperplate, fantasy"){ echo "selected=selected"; } ?> value="Copperplate, fantasy">Copperplate</option>
						<option <?php if($tabs_desc_fontfamily=="Papyrus, fantasy"){ echo "selected=selected"; } ?> value="Papyrus, fantasy">Papyrus</option>
					</select>					
				</div>

				<div class="col-md-12 mt-4">
					<p><b>Note : </b>Color setting applicable only on Template A,B & C</p>
					<label><?php esc_html_e( 'Custom CSS', CDLZR_PLUG_TABS_DOM ); ?></label>
					<textarea name="tabs_cust_css" id="tabs_cust_css" class="linedtabs" rows="9" cols="162"><?php echo $tabs_cust_css;  ?></textarea>
				</div>
			</div>
			<?php
		}	

		/**
	     * Add Custom Links to All Plugins list page for this plugin
	     * @param $tabspillsgopro_links
	     * @return mixed
	     */
		public static function tabspills_plugin_actions_links($tabspillsgopro_links){
			  $tabspillsgopro_links['go_pro'] = sprintf( '<a href="%1$s" style="color:#e12f2f;font-weight:800;" target="_blank">%2$s</a>', esc_url('https://codelizar.com/product/tabs-pills-pro/'), esc_html__( 'Upgrade To Pro', 'CDLZR_PLUG_TABS_DOM' ) );        
	        	        
	        return $tabspillsgopro_links;
		}

		public static function tabs_wpeditor(){
			?>
			<div class="col-md-6 divcontrolboxtabs">
				<div class="div_inner">
					<div class="form-group div_inner_tabsbox">
						<small class="d-block float-right">
							<button type="button" class="cdlzr_tabsbox_remove_label btn btn-sm btn-warning cdlzr_remove_label mb-1"><i class="fas fa-times"></i></button>
						</small>
						<label><?php esc_html_e( 'My Title', CDLZR_PLUG_TABS_DOM ); ?></label>
						<input type="text" name="mytext[]" class="form-control">
						<label class="mt-3"><?php esc_html_e( 'My Description', CDLZR_PLUG_TABS_DOM ); ?></label>	
						<!-- <textarea id="mydesc1" name="mydesc[]" class="form-control" rows='4'></textarea>	 -->
						<?php
							$setting_arr = array(
									'drag_drop_upload'    => false,
									'media_buttons' 	  => true,
									'textarea_name'       => "mydesc[]",
									'textarea_rows'       => 5,
									'tabindex'            => '',
									'tabfocus_elements'   => ':prev,:next',
									'editor_css'          => '',
									'editor_class'        => '',
									'teeny'               => false,
									'_content_editor_dfw' => false,
									'tinymce' => array(	  
										// Items for the Visual Tab
										'plugins'	=> 'textcolor,link',	
										// Items for the Visual Tab
										'toolbar1'	=> 'bold,italic,link',
										'quicktags' => true )
									);
							wp_editor( "", "mydesc1", $setting_arr);
						?>
						<label class="mt-3"><?php esc_html_e( 'Font-Awesome Icon', CDLZR_PLUG_TABS_DOM ); ?></label>
						<input type="text" name="myfontawe[]" class="form-control" value="">
						<label class="mt-3"><?php esc_html_e( 'Select Post -- For display post in tabs', CDLZR_PLUG_TABS_DOM ); ?></label>
						<select class="form-control cdlzr_sel_post">
							<option> -- Select Post -- </option>
							<option>Go Premium</option>
						</select>											
					</div>															
				</div>					
			</div>
			<?php

			wp_die();
		}
	}
}