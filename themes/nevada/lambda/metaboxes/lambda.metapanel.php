<div class="bootstrap-wpadmin">

<?php 

/* Meta Page Panel
 * Update to Page Tool   
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
*/

global $wpalchemy_media_access, $wpdb, $wp_registered_sidebars, $theme_options;

$gridvalues = array('220' 	=>	'1/4',
					'300' 	=>	'1/3',
					'460'	=>	'1/2',
					'620'	=>	'2/3',
					'700'	=>	'3/4',
					'940'	=>	'Full Width');

$wp_registered_sidebars[UT_THEME_INITIAL.'sidebar_none'] = array('name' => __('No Sidebar', 'Nevada')); ?>


<div class="navbar">
	<div class="navbar-inner">
    	<div class="container">

		<button type="submit" class="btn btn-success save-meta right" name="update" id="update"><?php _e( 'Save', 'Nevada' ); ?></button>
		
		<ul class="options_tabs nav">
    			
				<li><a href="#lambdaeditor" class="lambdaeditor_menu" data-toggle="tab"><i class="icon-font icon-white"></i><?php _e( 'Editor', 'Nevada' ); ?></a></li>
				
				<?php if(get_post_type($post->ID) == 'post') { ?>
					<li><a href="#postformat-settings" data-toggle="tab"><i class="icon-file icon-white"></i><?php _e( 'Post Format Settings', 'Nevada' ); ?></a></li>
				<?php } ?>
				
				<?php if(get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') { ?>
					<li><a href="#pagetool-wrap" class="pagetool_menu" data-toggle="tab"><i class="icon-th icon-white"></i><?php _e( 'Page Creator', 'Nevada' ); ?></a></li>
				<?php } ?>
				
				<li><a href="#slider-settings" data-toggle="tab"><i class="icon-picture icon-white"></i><?php _e( 'Featured Header', 'Nevada' ); ?></a></li>
				
                <?php if(get_post_type($post->ID) != UT_PORTFOLIO_SLUG) { ?>
                <li><a href="#page-settings" class="page-settings_menu" data-toggle="tab"><i class="icon-wrench icon-white"></i><?php _e( 'Page Settings', 'Nevada' ); ?></a></li>
				<?php } ?>
                
                <li><a href="#style-settings" class="style-settings_menu" data-toggle="tab"><i class="icon-pencil icon-white"></i><?php _e( 'Style Settings', 'Nevada' ); ?></a></li>
			
				<?php if(get_post_type($post->ID) == 'page') { ?>
					<li><a href="#portfolio-settings" class="portfolio-settings_menu" data-toggle="tab"><i class="icon-camera icon-white"></i><?php _e( 'Portfolio Overview Settings', 'Nevada' ); ?></a></li>
				<?php } ?>
				
				<?php if(get_post_type($post->ID) == UT_PORTFOLIO_SLUG) { ?>
					<li><a href="#portfolio-items" class="portfolio-items_menu" data-toggle="tab"><i class="icon-folder-open icon-white"></i><?php _e( 'Portfolio Items', 'Nevada' ); ?></a></li>
				<?php } ?>
				
				<?php if(get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') { ?>
				
				<li><a href="#contact-settings" class="contact-settings_menu" data-toggle="tab"><i class="icon-envelope icon-white"></i><?php _e( 'Contact Form Builder', 'Nevada' ); ?></a></li>
				<li><a href="#home-settings" class="home-settings_menu" data-toggle="tab"><i class="icon-home icon-white"></i><?php _e( 'Home Settings', 'Nevada' ); ?></a></li>
				<li><a href="#team-settings" class="team-settings_menu" data-toggle="tab"><i class="icon-user icon-white"></i><?php _e( 'Team Settings', 'Nevada' ); ?></a></li>
				<li><a href="#faq-settings"  class="faq-settings_menu" data-toggle="tab"><i class="icon-question-sign icon-white"></i><?php _e( 'FAQ Settings', 'Nevada' ); ?></a></li>		
				<li><a href="#testimonials-settings"  class="testimonials-settings_menu" data-toggle="tab"><i class="icon-book icon-white"></i><?php _e( 'Testimonials', 'Nevada' ); ?></a></li>		
				<li><a href="#verticaltabs-settings"  class="verticaltabs-settings_menu" data-toggle="tab"><i class="icon-book icon-white"></i><?php _e( 'Service', 'Nevada' ); ?></a></li>		
				<li><a href="#client-settings"  class="client-settings_menu" data-toggle="tab"><i class="icon-book icon-white"></i><?php _e( 'Clients', 'Nevada' ); ?></a></li>		

				<?php } ?>
				
    	   </ul>
		   
		   
		</div>
	</div>
</div>


<?php
#-----------------------------------------------------------------
# Start Tabs
#-----------------------------------------------------------------
?>

<div class="tab-content">

<?php // Placeholder for Editor ?>
<div id="lambdaeditor" class="tab-pane active">

</div>

<?php // Placeholder for Slidetab ?>
<div id="slider-settings" class="tab-pane">

</div>


<?php if(get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') : ?>

<div id="pagetool-wrap" class="overflowx pagetool tab-pane">
<div id="pagetool">

<button type="button" class="btn btn-success openpc"><?php _e('Expand Page Creator', 'Nevada'); ?></button>
<button type="button" class="btn btn-warning closepc"><?php _e('Shrink Page Creator', 'Nevada'); ?></button>

<div class="lambda_overlay"></div>

<button type="button" class="btn btn-inverse addnew docopy-<?php echo 'lambda_page_item'; ?>"><i class="icon-share icon-white"></i><?php _e( 'Add New Box', 'Nevada' ); ?></button>

<div class="hr"></div>
<div id="pagetool-inner">

<?php while($mb->have_fields_and_multi('lambda_page_item')): ?>
<?php $mb->the_group_open(); ?>

<?php $grid = $mb->get_the_value('grid_size'); ?>
<?php $grid = empty($grid) ? '220' : $grid; ?>

<?php $boxname = $mb->get_the_value('boxname'); ?>
<?php $boxname = empty($boxname) ? __('New box', 'Nevada') : $boxname; ?>

<div class="grid_item" style="width:<?php echo $grid; ?>px;">
	
	<?php $mb->the_field('grid_size'); ?>
	<input class="grid" type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

	<div class="itemscale">
		<button type="button" class="btn btn-mini resizeup">+</button>
		<button type="button" class="btn btn-mini resizedown">-</button>
	</div>
	
	<span class="ui-widget-header"><?php echo $boxname; ?></span>
		
	<span class="currentgrid"><?php echo $gridvalues[$grid]; ?></span>
	
	<div class="itemedit">
		<button type="button" class="doedit btn btn-mini btn-success" href="#itemtools"><?php _e('edit', 'Nevada'); ?></button>
		<button type="button" class="dodelete btn btn-mini btn-danger">x</button>
	</div>

</div>


<?php
#-----------------------------------------------------------------
# Start Modal for Options
#-----------------------------------------------------------------
?>
<div class="itembox">
						
	<div class="modal-header" style="position:relative;">
		<h2><?php echo $boxname; ?></h2>
		<button type="button" class="doclose btn btn-mini btn-success right" style="position:absolute; right:0; top:0;"><i class="icon-ok icon-white"></i></button>	
	</div>
    	
	<div class="modal-body well">		
			
		<div class="one_half">
		
			<label><?php _e( 'Enter Boxname', 'Nevada' ); ?></label>
			<?php $mb->the_field('boxname'); ?>
			<input class="boxname" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info"><?php _e( 'only for internal use', 'Nevada' ); ?></span>
		
		</div>
				

		<div class="one_half last" style="margin-top:15px;">
			
			<?php if(isset($theme_options['responsive']) && $theme_options['responsive'] == 'on') { ?>
			
			<div class="one_third" style="margin-bottom:0px;">
			
				<img style="float:right;" src="<?php echo THEME_WEB_ROOT; ?>/lambda/assets/images/responsive.png"></span>
			
			</div>
			
			<div class="two_thirds last" style="margin-bottom:0px;">		
			
			<div class="btn-group">
						
				<label><?php _e( 'Hide on Desktop' , 'Nevada' ); ?></label>
				<?php $mb->the_field('activate_desktop'); ?>
								
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
				<button data-state="activate_desktop_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'yes', 'Nevada' ); ?></button>
				<input id="activate_desktop_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				
				<button data-state="activate_desktop_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'no', 'Nevada' ); ?></button>	
				<input id="activate_desktop_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
			</div>
				
			
			<div class="btn-group">
						
				<label><?php _e( 'Hide on Tablet' , 'Nevada' ); ?></label>
				<?php $mb->the_field('activate_landscape'); ?>
								
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
				<button data-state="activate_landscape_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'yes', 'Nevada' ); ?></button>
				<input id="activate_landscape_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				
				<button data-state="activate_landscape_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'no', 'Nevada' ); ?></button>	
				<input id="activate_landscape_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
			</div>
			
			
			<div class="btn-group">
						
				<label><?php _e( 'Hide on Mobile' , 'Nevada' ); ?></label>
				<?php $mb->the_field('activate_mobile'); ?>
								
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
				<button data-state="activate_mobile_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'yes', 'Nevada' ); ?></button>
				<input id="activate_mobile_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				
				<button data-state="activate_mobile_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'no', 'Nevada' ); ?></button>	
				<input id="activate_mobile_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
			</div>
			
			</div>
			
			<?php } ?>			
			
		</div>
		
        <div>
		
			<label><?php _e( 'Optional CSS Class', 'Nevada' ); ?></label>
			<?php $mb->the_field('boxclass'); ?>
			<input class="boxname" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
		
		</div>
        
		<hr />				

		<?php $mb->the_field('box_type'); ?>
		<label><?php _e( 'Choose Boxtype', 'Nevada' ); ?></label>
		<select name="<?php $mb->the_name(); ?>" id="box_type" class="box_type">
			<option value=""><?php _e( 'Choose Box Type', 'Nevada' ); ?></option>
			<option value="simple_textbox" <?php $mb->the_select_state('simple_textbox'); ?>> <?php _e( 'Textbox (with Editor)', 'Nevada' ); ?> </option>
			<option value="simple_quote" <?php $mb->the_select_state('simple_quote'); ?>> <?php _e( 'Quote', 'Nevada' ); ?> </option>
			<option value="rev_slider" <?php $mb->the_select_state('rev_slider'); ?>> <?php _e( 'Revolution Slider', 'Nevada' ); ?> </option>
			<option value="standard_slider" <?php $mb->the_select_state('standard_slider'); ?>> <?php _e( 'Standard Slider', 'Nevada' ); ?> </option>
			<option value="soundcloud" <?php $mb->the_select_state('soundcloud'); ?>> <?php _e( 'Soundcloud', 'Nevada' ); ?> </option>
			<option value="row" <?php $mb->the_select_state('row'); ?>> <?php _e( 'Horizontal Row', 'Nevada' ); ?> </option>
			<option value="simple_video" <?php $mb->the_select_state('simple_video'); ?>> <?php _e( 'Video', 'Nevada' ); ?> </option>
			<option value="service_column" <?php $mb->the_select_state('service_column'); ?>> <?php _e( 'Service Column', 'Nevada' ); ?> </option>
			<option value="testimonial" <?php $mb->the_select_state('testimonial'); ?>> <?php _e( 'Single Testimonial', 'Nevada' ); ?> </option>
			<option value="testimonialcarousel" <?php $mb->the_select_state('testimonialcarousel'); ?>> <?php _e( 'Testimonial Carousel', 'Nevada' ); ?> </option>
			<option value="pricing_table" <?php $mb->the_select_state('pricing_table'); ?>> <?php _e( 'Pricing Table', 'Nevada' ); ?> </option>
			<option value="portfolio_excerpt" <?php $mb->the_select_state('portfolio_excerpt'); ?>> <?php _e( 'Portfolio', 'Nevada' ); ?> </option>
			<option value="blog_excerpt" <?php $mb->the_select_state('blog_excerpt'); ?>> <?php _e( 'Blog', 'Nevada' ); ?> </option>
			<option value="google_map" <?php $mb->the_select_state('google_map'); ?>> <?php _e( 'Google Map', 'Nevada' ); ?> </option>
			<option value="call_to_action" <?php $mb->the_select_state('call_to_action'); ?>> <?php _e( 'Call to Action', 'Nevada' ); ?> </option>
			<option value="sidebarwidget" <?php $mb->the_select_state('sidebarwidget'); ?>> <?php _e( 'Sidebar', 'Nevada' ); ?> </option>
			<option value="clientbox" <?php $mb->the_select_state('clientbox'); ?>> <?php _e( 'Clients', 'Nevada' ); ?> </option>
		</select>						
				
		<hr />		
		
		<p><label><?php _e( 'Title', 'Nevada' ); ?></label>
		<?php $mb->the_field('box_title'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>		
		<br /><span class="info badge badge-info">(<?php _e('this will create a designed headline above the box, leave empty to hide', 'Nevada'); ?>)</span></p>	
		
		<hr />
		
		<?php
		#-----------------------------------------------------------------
		# Simple TextBox
		#-----------------------------------------------------------------
		?>		
		<div class="simple_textbox single_item">
							
			<div class="customEditor">
				<?php $mb->the_field('extra_content'); ?>
					
				<div class="wp-editor-tools">
					<div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action( 'media_buttons' ); ?></div>
				</div>
				<div class="clear"></div>
                
				<?php $editorcontent = $mb->get_the_value(); ?>				
				
				<textarea id="<?php $mb->the_name(); ?>" rows="10" cols="50" name="<?php $mb->the_name(); ?>" class="lambdatextarea"><?php echo wpautop( esc_html($mb->get_the_value()) ); ?></textarea>
                
			</div>
			
		</div>
		
		
		
		
		
		<?php
		#-----------------------------------------------------------------
		# Simple Quote
		#-----------------------------------------------------------------
		?>		
		<div class="simple_quote single_item">
		
			
			<p><label><?php _e( 'Quote!', 'Nevada' ); ?></label>
		  	<?php $mb->the_field('quote'); ?>
            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="85" class="lambdatextarea"><?php $mb->the_value(); ?></textarea></p>
			  
			
			<p><label><?php _e( 'Authorname', 'Nevada' ); ?></label>
			<?php $mb->the_field('quote_cite'); ?>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>			

					  
		</div>
		
		
		<?php
		#-----------------------------------------------------------------
		# Revolution Slider
		#-----------------------------------------------------------------
		?>
		<div class="rev_slider single_item">
			  

				<label><?php _e( 'Choose Revolution Slider', 'Nevada' ); ?></label>
				<?php $mb->the_field('rev_slider'); ?>
					<select name="<?php $mb->the_name(); ?>">
						<option value=""><?php _e( 'Choose Slider', 'Nevada' ); ?></option>
						<?php 
							
						global $wpdb;
						
						$table_name = $wpdb->base_prefix . "revslider_sliders";
						$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
						
							foreach ($slidedata as $singledata) { 
							   
								echo "<option value='".$singledata->alias."' name='".$singledata->title."' ".$mb->get_the_select_state($singledata->alias).">".$singledata->title."</option>";
						
							}
						
				?>
				</select>
					  
		</div>
		
		
		<?php
		#-----------------------------------------------------------------
		# Standard Slider
		#-----------------------------------------------------------------
		?>
		<div class="standard_slider single_item">
			
						
			<label><?php _e( 'Choose Slider', 'Nevada' ); ?></label>
            <?php $mb->the_field('standard_slider'); ?>
			  	<select name="<?php $mb->the_name(); ?>">
					<option value=""><?php _e( 'Choose Slider', 'Nevada' ); ?></option>
					<?php 
						
					global $wpdb;
					
					$table_name = $wpdb->base_prefix . "lambda_sliders";
					$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
					
					foreach ($slidedata as $singledata) { 
					   
					   if($singledata->slidertype != 'supersized')
					   echo "<option value='".$singledata->id."' name='".$singledata->option_name."' ".$mb->get_the_select_state($singledata->id).">".$singledata->option_name."</option>";
					   
					}
					
					?>
			</select>
			  
		</div>		
		
		
		<?php
		#-----------------------------------------------------------------
		# Soundcloud
		#-----------------------------------------------------------------
		?>
		<div class="soundcloud single_item">
						
			<p><label><?php _e( 'Soundcloud URL', 'Nevada' ); ?></label>
			<?php $mb->the_field('soundcloud_url'); ?>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" /></p>
				
		</div>			
		
		
		<?php
		#-----------------------------------------------------------------
		# Simple Video
		#-----------------------------------------------------------------
		?>
		<div class="simple_video single_item">
				
								
				<?php $mb->the_field('nonverbla_url'); ?>
				<?php $wpalchemy_media_access->setGroupName('nonverbla_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                <p>   
                    <label><?php _e( 'Upload Video', 'Nevada' ); ?></label>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'Nevada'); ?>)</span><br />
                    <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                           
                </p>
                
				<?php $mb->the_field('nonverbla_hd_url'); ?>
				<?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
				<p>   
                    <label><?php _e( 'Upload Video', 'Nevada' ); ?></label>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'Nevada'); ?>)</span><br />
                    <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                           
                </p>
				
				<?php $mb->the_field('poster_image'); ?>
				<?php $wpalchemy_media_access->setGroupName('poster_image'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
				<p>   
                    <label><?php _e( 'Poster Image', 'Nevada' ); ?></label>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'Nevada'); ?>)</span><br />
                    <?php echo wpa_media_button(__("Upload Poster" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Poster" , 'Nevada') , 'image'); ?>
                                           
                </p>		
				
				<?php $mb->the_field('mp4_url'); ?>
				<?php $wpalchemy_media_access->setGroupName('mp4_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
				<p>   
                    <label><?php _e( 'MP4 File URL', 'Nevada' ); ?></label>
                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                    <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'Nevada'); ?>)</span><br />
                    <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                           
                </p>
				
				<p><h4>or</h4></p>
				
				<p>
				<label class="metalabel"><?php _e( 'Embedded Code', 'Nevada' ); ?></label>
				<?php $mb->the_field('single_embedded_code'); ?>
				<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
				<br /><span class="info badge badge-info">(<?php _e( 'Embedded Code', 'Nevada' ); ?>)</span>
				</p>


		</div>
		
		
		
		<?php
		#-----------------------------------------------------------------
		# Design Element Row
		#-----------------------------------------------------------------
		?>
		<div class="hrow single_item">
		
            <p><?php _e('This is only a horizontal divider!', 'Nevada'); ?></p>		
		
		</div>
		
		
		
		
		<?php
		#-----------------------------------------------------------------
		# Service Column
		#-----------------------------------------------------------------
		?>	
		<div class="service_column single_item">
		
		<?php $mb->the_field('col_icon'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-ico'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
			
		<p>                            
            
            <img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 32, 32, true ); } ?>" />            
            
            <label><?php _e( 'Icon URL', 'Nevada' ); ?></label>
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <br /><span class="info badge badge-info">(<?php _e('Icon size should be 32x32', 'Nevada'); ?>)</span><br />
            <?php echo wpa_media_button(__("Upload Icon" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert icon" , 'Nevada') , 'image'); ?>
                                   
        </p>
                
        <p><?php $mb->the_field('col_alt'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Icon alt ( SEO )', 'Nevada' ); ?></label>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
	   
	   	<p><?php $mb->the_field('col_headline'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
	   
	   	<p><label><?php _e( 'Content', 'Nevada' ); ?></label>
		<?php $mb->the_field('col_content'); ?>
		<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
	   	<br /><span class="info badge badge-info">(<?php _e('This field accepts shortcodes', 'Nevada'); ?>)</span></p>
		
	   	<p><?php $mb->the_field('col_link'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Link', 'Nevada' ); ?></label>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
		
		<p><?php $mb->the_field('col_buttontext'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttontext', 'Nevada' ); ?></label>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
			
		</div>
		
		
		
		<?php
		#-----------------------------------------------------------------
		# Testimonial
		#-----------------------------------------------------------------
		?>	
		<div class="testimonial single_item">
				
		<?php $mb->the_field('author_image'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-auth'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
		
        <p>                            

            <img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 75, 75, true ); } ?>" />
            
            <label><?php _e( 'Author Image', 'Nevada' ); ?></label>
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <br /><span class="info badge badge-info">(<?php _e('Image size should be 200x200', 'Nevada'); ?>)</span><br />
            <?php echo wpa_media_button(__("Upload Avatar" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Avatar" , 'Nevada') , 'image'); ?>
                                   
        </p>       
					
		<p><?php $mb->the_field('author_name'); ?>
        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Author Name', 'Nevada' ); ?></label>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
		
		<p><label><?php _e( 'Comment', 'Nevada' ); ?></label>
		<?php $mb->the_field('author_comment'); ?>
		<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"><?php $mb->the_value(); ?></textarea>
	   	<br /><span class="info badge badge-info">(<?php _e('This field accepts shortcodes', 'Nevada'); ?>)</span></p>		
		
		<p><?php $mb->the_field('author_company'); ?>
		<label for="<?php $mb->the_name(); ?>"><?php _e( 'Testimonial Authors Company', 'Nevada' ); ?></label>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>		
		
		</div>
		
		
		
		<?php
		#-----------------------------------------------------------------
		# Testimonial Carousel
		#-----------------------------------------------------------------
		?>	
		<div class="testimonialcarousel single_item">
			
			<p><?php $mb->the_field('testimonial_color'); ?>
			<label><?php _e( 'Testimonial Color', 'Nevada' ); ?></label>
			<select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
				<option value=""><?php _e('Select color ...', 'Nevada'); ?></option>
				<option value="white"<?php $mb->the_select_state('white'); ?>><?php _e('white', 'Nevada'); ?></option>
				<option value="dark"<?php $mb->the_select_state('dark'); ?>><?php _e('darken', 'Nevada'); ?></option>
				<option value="alternate"<?php $mb->the_select_state('alternate'); ?>><?php _e('alternating colors', 'Nevada'); ?></option>
			</select></p>
			
			
			<p><label><?php _e( 'Choose Testimonials Page', 'Nevada' ); ?></label>
			<?php $mb->the_field('testimonialcarousel'); ?>
			<select name="<?php $mb->the_name(); ?>">		                
							
				<?php $pages = query_posts(array(
								'post_type' => 'page',
								'meta_key' => '_wp_page_template',
								'meta_value' => 'template-testimonials.php',
								'meta_compare' => '=='
								));
							
				if ($pages) {
								
					echo '<option value="">-- Choose One --</option>';
					foreach ( $pages as $page ) {
				
						//create option
						echo '<option value="'.$page->ID.'" '.$mb->get_the_select_state($page->ID).'>'.$page->post_title.'</option>';
								
					} 		
					
					} else {
								
						echo '<option value="0">'.__('No Pages Available', 'Nevada').'</option>';
								
					} ?>
			
			</select>
			<br /><span class="info badge badge-info"><?php _e('Choose Testimonials from an existing <br /> Testimonials Template Page', 'Nevada'); ?></span></p>
			
            <div class="btn-group">
						
				<label><?php _e( 'Autoplay Testimonials' , 'Nevada' ); ?></label>
				<?php $mb->the_field('testimonials_autoplay'); ?>
								
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
				<button data-state="testimonials_autoplay_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'yes', 'Nevada' ); ?></button>
				<input id="testimonials_autoplay_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				
				<button data-state="testimonials_autoplay_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'no', 'Nevada' ); ?></button>	
				<input id="testimonials_autoplay_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
			</div>
            
			<p><?php $mb->the_field('testimonial_time'); ?>
            <label for="<?php $mb->the_name(); ?>"><?php _e( 'Playtime in miliseconds', 'Nevada' ); ?></label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
            
		</div>
		
		
		
		<?php
		#-----------------------------------------------------------------
		# Pricing Table
		#-----------------------------------------------------------------
		?>	
		<div class="pricing_table single_item">
					
			<p><label><?php _e( 'Choose Pricing Table', 'Nevada' ); ?></label>
            
				<?php $mb->the_field('pricing_table'); ?>
			  	<select name="<?php $mb->the_name(); ?>">
					<option value=""><?php _e( 'Choose Pricing Table', 'Nevada' ); ?></option>
					<?php 
						
					global $wpdb;
					
					$table_name = $wpdb->base_prefix . "lambda_tables";
					$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
					
					foreach ($slidedata as $singledata) { 
					   
					   echo "<option value='".$singledata->id."' name='".$singledata->table_name."' ".$mb->get_the_select_state($singledata->id).">".$singledata->table_name."</option>";
					   
					}
					
			?>
			</select>
			</p>
		
		</div>
		
		
		<?php
		#-----------------------------------------------------------------
		# Portfolio Excerpt
		#-----------------------------------------------------------------
		?>	
		<div class="portfolio_excerpt single_item">		
		
			<p><?php $mb->the_field('portfolio_headline'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>	
				
			<p><?php $mb->the_field('portfolio_count'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Load the last x items out of the portfolio', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
			
			<p><?php $mb->the_field('portfolio_grid'); ?>
			<label><?php _e( 'Portfolio Column Layout', 'Nevada' ); ?></label>
			<select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
				
				<option value=""><?php _e('Select Column Layout ...', 'Nevada'); ?></option>
				<option value="one_half"<?php $mb->the_select_state('one_half'); ?>><?php _e('2 Columns', 'Nevada'); ?></option>
				<option value="one_third"<?php $mb->the_select_state('one_third'); ?>><?php _e('3 Columns', 'Nevada'); ?></option>
				<option value="one_fourth"<?php $mb->the_select_state('one_fourth'); ?>><?php _e('4 Columns', 'Nevada'); ?></option>
				
			</select></p>	
				
			<p><label for="<?php $mb->the_name(); ?>"><?php _e( 'Display items out of the following category', 'Nevada' ); ?></label>
			<?php 
			
			$taxonomys = get_terms('project-type', array(
				'hide_empty' => 0,
			));		
					
			if(is_array($taxonomys) && !empty($taxonomys)) {
			foreach ($taxonomys as $key => $item): ?>
				
				<?php $mb->the_field('project_type', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>	
				<input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?php echo $taxonomys[$key]->slug; ?>"<?php $mb->the_checkbox_state($taxonomys[$key]->slug); ?>/> 
				<?php echo $taxonomys[$key]->name; ?><br/>
						
			<?php endforeach; } else { echo '<div class="alert">'.__( 'No Portfolio Categories created yet!', 'Nevada' ).'</div>'; } ?></p>
			
			
			<div class="btn-group">
								
				<label><?php _e( 'Show Portfolio Item Title', 'Nevada' ); ?></label>
				<?php $mb->the_field('portfolio_item_title'); ?>
										
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
										
				<button data-state="portfolio_item_title_pb_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'on', 'Nevada' ); ?></button>
				<input id="portfolio_item_title_pb_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				<button data-state="portfolio_item_title_pb_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'off', 'Nevada' ); ?></button>	
				<input id="portfolio_item_title_pb_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
								
			</div>
		
		</div>
		
		
		<?php
		#-----------------------------------------------------------------
		# Blog
		#-----------------------------------------------------------------
		?>
		<div class="blog_excerpt single_item">	
			
			<div class="btn-group">
				
				<label><?php _e( 'Activate featured Images?', 'Nevada' ); ?></label>
				<?php $mb->the_field('activate_blog_images'); ?>
										
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
										
				<button data-state="activate_images_pb_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
				<input id="activate_images_pb_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				<button data-state="activate_images_pb_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
				<input id="activate_images_pb_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							
			</div>
							
			<hr />
							
			<div class="btn-group">
								
				<label><?php _e( 'Activate Blog Excerpt', 'Nevada' ); ?></label>
				<?php $mb->the_field('activate_blog_excerpt'); ?>
										
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
										
				<button data-state="activate_blog_excerpt_pb_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'on', 'Nevada' ); ?></button>
				<input id="activate_blog_excerpt_pb_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				<button data-state="activate_blog_excerpt_pb_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'off', 'Nevada' ); ?></button>	
				<input id="activate_blog_excerpt_pb_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
								
			</div>
			
			<hr  />
			
			<div class="btn-group">
								
				<label><?php _e( 'Activate "Like Voting"', 'Nevada' ); ?></label>
				<?php $mb->the_field('activate_blog_like'); ?>
										
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
										
				<button data-state="activate_blog_like_pb_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'on', 'Nevada' ); ?></button>
				<input id="activate_blog_like_pb_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				<button data-state="activate_blog_like_pb_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'off', 'Nevada' ); ?></button>	
				<input id="activate_blog_like_pb_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
								
			</div>
			
			<hr  />
			
			<p><?php $mb->the_field('blog_grid'); ?>
			<label><?php _e( 'Blog Column Layout', 'Nevada' ); ?></label>
			<select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
				
				<option value=""><?php _e('Select Column Layout ...', 'Nevada'); ?></option>
				<option value="full-width"<?php $mb->the_select_state('full-width'); ?>><?php _e('Full Width', 'Nevada'); ?></option>
				<option value="one_half"<?php $mb->the_select_state('one_half'); ?>><?php _e('2 Columns', 'Nevada'); ?></option>
				<option value="one_third"<?php $mb->the_select_state('one_third'); ?>><?php _e('3 Columns', 'Nevada'); ?></option>
				<option value="one_fourth"<?php $mb->the_select_state('one_fourth'); ?>><?php _e('4 Columns', 'Nevada'); ?></option>
				
			</select></p>
							
			<p><?php $mb->the_field('blog_excerpt_length'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Excerpt length', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('for example: 55', 'Nevada'); ?>)</span></p>
			
			<p><?php $mb->the_field('blog_length'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Blog length', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('how many items to display? for example: 6', 'Nevada'); ?>)</span></p>
			
			<hr />
			
			<p><?php $mb->the_field('post_not_in', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Exclude Post (optional)', 'Nevada' ); ?></label>
			<select name="<?php $mb->the_name(); ?>" class="select_post_not_in" multiple="multiple">
			
				<?php $pcposts = &get_posts( array( 'numberposts' => -1, 'orderby' => 'date' ) );
				
				if ( $pcposts ) {
					
					echo '<option value="">'.__('Choose posts to exclude', 'Nevada').'</option>';
					foreach ( $pcposts as $pcpost ) {
					
						echo '<option value="'.$pcpost->ID.'" '.$mb->get_the_select_state($pcpost->ID).'>'.$pcpost->post_title.'</option>';
	
					}
					
			  } else {
				  
				  echo '<option value="0">'.__('No Pages Available', 'Nevada').'</option>';
				  
			  } 
			  
			  ?>
			  
		  	</select>
		  	<br /><span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', 'Nevada'); ?>)</span></p>
		  
		  	<hr />
		  
			  <p><?php $mb->the_field('only_category', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
			  <label for="<?php $mb->the_name(); ?>"><?php _e( 'Show only Posts of this category (optional)', 'Nevada' ); ?></label>
			  <select name="<?php $mb->the_name(); ?>" class="select_only_category" multiple="multiple">
				
				<?php $categories = &get_categories( array( 'hide_empty' => false ) );
				
				if ( $categories ) {
					
					echo '<option value="">'.__('Choose', 'Nevada').'</option>';
					foreach ( $categories as $category ) {
					
						echo '<option value="'.$category->term_id.'" '.$mb->get_the_select_state($category->term_id).'>'.$category->name.'</option>';
	
					}
					
			  } else {
				  
				   echo '<option value="0">'.__('No Categories Available', 'Nevada').'</option>';
				  
			  } ?>
			  </select>
			  <br /><span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', 'Nevada'); ?>)</span></p>
		  
			
		</div>
		
		<?php
		#-----------------------------------------------------------------
		# Google Map
		#-----------------------------------------------------------------
		?>
		<div class="google_map single_item">
		
			<p><?php $mb->the_field('map_address'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Address to display', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('for example: 100 Biscayne Blvd. Florida 33148', 'Nevada'); ?>)</span></p>
			
			<p><?php $mb->the_field('map_zoom'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Zoom', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('for example: 14', 'Nevada'); ?>)</span></p>
			
			<p><?php $mb->the_field('map_height'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Map height', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('for example: 300', 'Nevada'); ?>)</span></p>				
				
		</div>
		
		<?php
		#-----------------------------------------------------------------
		# Call to Action
		#-----------------------------------------------------------------
		?>
		<div class="call_to_action single_item">
		
		
			<p><?php $mb->the_field('cta_headline'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'CTA Headline', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('Headline for CTA Field', 'Nevada'); ?>)</span></p>
					
			<p><?php $mb->the_field('cta_buttontext'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttontext', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('optional', 'Nevada'); ?>)</span></p>
					
			<p><?php $mb->the_field('cta_buttonlink'); ?>
			<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttonlink', 'Nevada' ); ?></label>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('optional', 'Nevada'); ?>)</span></p>
					
			<p><?php $mb->the_field('cta_content'); ?>
			<label><?php _e( 'Content', 'Nevada' ); ?></label>
			<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea></p>		
		
		
		</div>	
		
		<?php
		#-----------------------------------------------------------------
		# Sidebar Widget
		#-----------------------------------------------------------------
		?>
		<div class="sidebarwidget single_item">
		
				<label class="metalabel"><?php _e( 'Choose Sidebar to display', 'Nevada' ); ?></label>
				<p>
				<?php $mb->the_field('sidebar'); ?>
				<select name="<?php $mb->the_name(); ?>">
					<?php 				
					
					if(is_array($wp_registered_sidebars)) {
					foreach ( $wp_registered_sidebars as $sidebarkey => $sidebardetails ) { ?>						
						
						<option value="<?php echo $sidebarkey; ?>"<?php $mb->the_select_state($sidebarkey); ?>> <?php echo esc_html( $sidebardetails['name'] ); ?> </option>                
						
					<?php 					
					} //end foreach 
				} //endif is array ?>					
				</select>
				</p>
		
		</div>
		
		<?php
		#-----------------------------------------------------------------
		# Client Box
		#-----------------------------------------------------------------
		?>
		<div class="clientbox single_item">
		
				<p><?php $mb->the_field('client_load_last'); ?>
				<label for="<?php $mb->the_name(); ?>"><?php _e( 'Load last X client logos', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				</p>
							
							
				<p><label><?php _e( 'Choose Client Page', 'Nevada' ); ?></label>
				<?php $mb->the_field('home_client_page'); ?>
				<select name="<?php $mb->the_name(); ?>">		                
							
					<?php $pages = query_posts(array(
							'post_type' => 'page',
							'meta_key' => '_wp_page_template',
							'meta_value' => 'template-clients.php',
							'meta_compare' => '=='
						));
							
				if ($pages) {
								
					echo '<option value="">-- Choose One --</option>';
						foreach ( $pages as $page ) {
										
							//create option
							echo '<option value="'.$page->ID.'" '.$mb->get_the_select_state($page->ID).'>'.$page->post_title.'</option>';
									
						} 		
					} else {
								
						echo '<option value="0">No Pages Available</option>';
						
					} ?>
			
					</select>
					<br /><span class="info badge badge-info"><?php _e('Choose Services from an existing <br /> Service Template', 'Nevada'); ?></span></p>			
		
		</div>
		
			
	</div>
	
	<button type="button" class="doclose btn btn-mini btn-success right"><i class="icon-ok icon-white"></i></button>	
	
</div>	

<?php $mb->the_group_close(); ?>
<?php endwhile; ?>

<div class="clear"></div>
<div class="backdrop"></div>

</div>
</div><!-- /#pagetool -->
</div><!-- /#pagetoolwrap -->
<?php endif; //pagetool ?>



<?php 
#-----------------------------------------------------------------
# Page Settings
#----------------------------------------------------------------- 
?>
<div id="page-settings" class="page-settings tab-pane">
	<div class="ui-panelcontent">
    	
		<div class="container block">
					
			<div class="meta-headline">
			
				<h1><?php _e( 'Page Settings', 'Nevada' ); ?></h1>
				<div class="clear"></div>
				
			</div>
		
			<div class="sixteen columns">
				
			<?php if(get_post_type($post->ID) != UT_PORTFOLIO_SLUG) : ?>
			
			<div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Sidebar Settings', 'Nevada' ); ?>
				</div>
			</div>
			
			<div class="lambda-settings-pad">
				<label class="metalabel"><?php _e( 'Choose Main Sidebar', 'Nevada' ); ?></label>
				<p>
				<?php $mb->the_field('sidebar'); ?>
				<select name="<?php $mb->the_name(); ?>">
					<?php 				
					
					if(is_array($wp_registered_sidebars)) {
					foreach ( $wp_registered_sidebars as $sidebarkey => $sidebardetails ) { ?>						
						
						<option value="<?php echo $sidebarkey; ?>"<?php $mb->the_select_state($sidebarkey); ?>> <?php echo esc_html( $sidebardetails['name'] ); ?> </option>                
						
					<?php 					
					} //end foreach 
				} //endif is array ?>
					
				</select>
				<br /><span class="info badge badge-info">(<?php _e( 'overwrites the default sidebar', 'Nevada' ); ?>)</span>
				</p>
				
				
				<label class="metalabel"><?php _e( 'Choose Second Sidebar', 'Nevada' ); ?></label>
				<p>
				<?php $mb->the_field('sidebar_second'); ?>
				<select name="<?php $mb->the_name(); ?>">
					<?php 				
					
					if(is_array($wp_registered_sidebars)) {
					foreach ( $wp_registered_sidebars as $sidebarkey => $sidebardetails ) { ?>						
						
						<option value="<?php echo $sidebarkey; ?>"<?php $mb->the_select_state($sidebarkey); ?>> <?php echo esc_html( $sidebardetails['name'] ); ?> </option>                
						
					<?php 
					} //end foreach 
				} //endif is array ?>
					
				</select>
				<br /><span class="info badge badge-info">(<?php _e( 'only available when you choose <br /> Sidebar Alignment both', 'Nevada' ); ?>)</span>
				</p>
						
								
				<label class="metalabel"><?php _e( 'Sidebar Alignment', 'Nevada' ); ?></label>
				<p>
				<?php $mb->the_field('sidebar_align'); ?>
				<select name="<?php $mb->the_name(); ?>">
						<option value="right" <?php $mb->the_select_state('right'); ?>> <?php _e( 'right', 'Nevada' ); ?> </option>
						<option value="left" <?php $mb->the_select_state('left'); ?>> <?php _e( 'left', 'Nevada' ); ?> </option>
						<option value="both" <?php $mb->the_select_state('both'); ?>> <?php _e( 'both', 'Nevada' ); ?> </option>
				</select>
				<br /><span class="info badge badge-info">(<?php _e( 'optional - not available in all templates!', 'Nevada' ); ?>)</span>
				</p>
	
			</div>
			
			<?php endif; ?>
			
			
			<?php if(get_post_type($post->ID) == 'post') { ?>
			
			<div class="lambda-opttitle">
				  <div class="lambda-opttitle-pad">
				    <?php _e( 'Show Hide Author Box', 'Nevada' ); ?>
				  </div>
			</div>			
			
			<div class="lambda-settings-pad">
				<div class="btn-group">
						
					<?php $mb->the_field('hide_authorbox'); ?>
								
					<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
					<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
					<button data-state="hide_authorbox_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
					<input id="hide_authorbox_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
					<button data-state="hide_authorbox_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
					<input id="hide_authorbox_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
				</div>			
			</div>
			
			<?php } ?>
			
			</div>				
    	</div>
	</div>
</div>


<?php 
#-----------------------------------------------------------------
# Style Settings
#----------------------------------------------------------------- 
?>
<div id="style-settings" class="style-settings tab-pane">
	<div class="ui-panelcontent">
    	
		<div class="container block">
					
			<div class="meta-headline">
			
				<h1><?php _e( 'Style Settings', 'Nevada' ); ?></h1>
				<div class="clear"></div>
				
			</div>
		
			<div class="sixteen columns">
				
			<div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Main Background Settings', 'Nevada' ); ?>
				<span style="margin-left:15px;">(<?php _e('Please note: This option will only take effect on the boxed layout', 'Nevada'); ?>)</span>
				</div>
			</div>
				
			<div class="lambda-settings-pad">		
							
				<p>
				<?php $mb->the_field('background_type'); ?>
				<select name="<?php $mb->the_name(); ?>" id="bgstyle_type">
					 <option value="default_none"><?php _e( 'Choose Background Type', 'Nevada' ); ?></option>
					 <option value="default_backgroundcolor" <?php $mb->the_select_state('default_backgroundcolor'); ?>> <?php _e( 'Solid Color', 'Nevada' ); ?> </option>
					 <option value="default_backgroundpattern" <?php $mb->the_select_state('default_backgroundpattern'); ?>> <?php _e( 'Background Pattern', 'Nevada' ); ?> </option>
					 <option value="default_backgroundimage" <?php $mb->the_select_state('default_backgroundimage'); ?>> <?php _e( 'FullSize Image (upload)', 'Nevada' ); ?> </option>
					 <option value="default_backgroundtexture" <?php $mb->the_select_state('default_backgroundtexture'); ?>> <?php _e( 'Background Texture', 'Nevada' ); ?> </option>
					 <option value="default_backgroundslider" <?php $mb->the_select_state('default_backgroundslider'); ?>> <?php _e( 'Background Slider', 'Nevada' ); ?> </option>
				</select>
				</p>
				
				
				<div id="default_backgroundcolor" class="s_box">
				<script type="text/javascript">
					
					jQuery(document).ready(function($) {  
					  $('#solid_backgroundcolor').ColorPicker({
						onSubmit: function(hsb, hex, rgb) {
							$('#solid_backgroundcolor').val('#'+hex);
						},
						onBeforeShow: function () {
							$(this).ColorPickerSetColor(this.value);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							$('#solid_backgroundcolor').val('#'+hex);
							$('#cp_solid_backgroundcolor div').css({'backgroundColor':'#'+hex, 'borderColor':'#'+hex});
							$('#cp_solid_backgroundcolor').prev('input').attr('value', '#'+hex);
						}
					  })	
					  .bind('keyup', function(){
						$(this).ColorPickerSetColor(this.value);
					  });
					});
					
				</script>
				
				<?php $mb->the_field('default_backgroundcolor'); ?>
				<input class="left" id="solid_backgroundcolor" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
					<div id="cp_solid_backgroundcolor" class="cp_box">
						<div style="background-color:<?php echo ( !is_null ( $mb->get_the_value() ) ) ? $mb->get_the_value() : '#ffffff'; ?>;<?php if ( !is_null ( $mb->get_the_value() ) ) { echo 'border-color:' . $mb->get_the_value() . ';'; } ?>"> 
						</div>
					</div> 
					
					<div class="clear"></div>
					
					<span class="info badge badge-info">(<?php _e( 'a solid backgroundcolor', 'Nevada' ); ?>)</span>
				</div>
				
				
				<div id="default_backgroundpattern" class="s_box">			
				<?php $mb->the_field('default_backgroundpattern'); ?>			
				<fieldset id="choosepattern">
				
					<?php
					//First we need the absolute path to our theme directory to make readdir work
					$absolute_path = __FILE__;
					$path_to_file = explode( 'lambda', $absolute_path );
					$absolute_path_to_theme = $path_to_file[0];
					
					//lets search for pattern!
					if ($handle = opendir($absolute_path_to_theme.'/images/pattern/')) {
						
						$count = 0;
						while (false !== ($file = readdir($handle))) {
							if($file != '..' && $file != '.') {	
								echo '<div class="single_pattern">
									  <input class="check-with-label" name="'.$mb->get_the_name().'" id="'.$mb->get_the_name().'_'.$count.'" type="radio" value="'.trim( $file ).'"'.$mb->get_the_radio_state(trim( $file )).' />
									  <label class="label-for-check" for="'.$mb->get_the_name().'_'.$count.'"><div class="pattern" style="background: url('.THEME_WEB_ROOT.'/images/pattern/'.$file.');"></div></label></div>';
								$count++;
							}
						}
						
						//and we also do not forget to close ;)			
						closedir($handle);
					}	
					?>
					
				</fieldset>			
				</div>			
				
				
				<div id="default_backgroundimage" class="s_box">
				<?php $mb->the_field('default_backgroundimage'); ?>
						<?php $wpalchemy_media_access->setGroupName('img-x'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						
                        <p>                            

                            <img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
							else { echo aq_resize( $mb->get_the_value(), 140, 140, true ); } ?>" class="image_box slider-n<?php echo $mb->get_the_index(); ?>" />
                            
                            <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br><span class="desc alert alert-neutral"><?php _e('Image Size should be 1600x900', 'Nevada'); ?></span><br>
                            <?php echo wpa_media_button(__("Upload Image" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Image" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                       
				</div>
				
				
				<div id="default_backgroundtexture" class="s_box">
				<?php $mb->the_field('default_backgroundtexture'); ?>			
				<fieldset id="choosepattern">
				
					<?php
					//First we need the absolute path to our theme directory to make readdir work
					$absolute_path = __FILE__;
					$path_to_file = explode( 'lambda', $absolute_path );
					$absolute_path_to_theme = $path_to_file[0];
					
					//lets search for pattern!
					if ($handle = opendir($absolute_path_to_theme.'/images/bg-textured/prev/')) {
						
						$count = 0;
						while (false !== ($file = readdir($handle))) {
							if($file != '..' && $file != '.') {	
								
								$preview = THEME_WEB_ROOT.'/images/bg-textured/prev/'.$file;
								
								echo '<div class="single_pattern">
									  <input class="check-with-label" name="'.$mb->get_the_name().'" id="'.$mb->get_the_name().'_'.$count.'" type="radio" value="'.trim( $file ).'"'.$mb->get_the_radio_state(trim( $file )).' />
									  <label class="label-for-check" for="'.$mb->get_the_name().'_'.$count.'"><div class="pattern" style="background: url('.$preview.');"></div></label></div>';
								$count++;
							}
						}
						
						//and we also do not forget to close ;)			
						closedir($handle);
					}	
					?>
					
				</fieldset>			
				</div>			
				
				
				<div id="default_backgroundslider" class="s_box">
				<label class="metalabel"><?php _e( 'Choose Backgroundslider', 'Nevada' ); ?></label>
				<p>
				
				<?php $mb->the_field('default_backgroundslider'); ?>
				<select name="<?php $mb->the_name(); ?>">		                
				<?php 
				
				$table_name = $wpdb->base_prefix . "lambda_sliders";
				$slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
				
				if(is_array($slidedata)) {				
					foreach ($slidedata as $singledata) { 
										   
					   if($singledata->slidertype == 'supersized') {
							 ?>
								
								<option value="lambda_<?php echo $singledata->id;  ?>"<?php $mb->the_select_state('lambda_'.$singledata->id); ?>> <?php echo $singledata->option_name; ?> </option>
														
							<?php  
						}
					}
				}		
				?>
				</select>
				</p>			
				</div>
			</div>	
			</div>
		</div>	
    </div>
</div>




<?php if(get_post_type($post->ID) == 'page') { ?>
<?php 
#-----------------------------------------------------------------
# Portfolio Settings
#----------------------------------------------------------------- 
?>
<div id="portfolio-settings" class="portfolio-settings tab-pane">
	
	<div class="lambda_overlay"></div>
	
	<div class="ui-panelcontent">
	   	
		<div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Portfolio Settings', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">
					
			<div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Choose Project Types', 'Nevada' ); ?>
				</div>
			</div>
			<div class="lambda-settings-pad">
				<p>
				<?php 
				
				$taxonomys = get_terms('project-type', array(
					'hide_empty' => 0,
				));	
						
				if(is_array($taxonomys) && !empty($taxonomys)) {
				foreach ($taxonomys as $key => $item): ?>
			
					<?php $mb->the_field('cb_project_type', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>	
					<input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?php echo $taxonomys[$key]->slug; ?>"<?php $mb->the_checkbox_state($taxonomys[$key]->slug); ?>/> 
					<?php echo $taxonomys[$key]->name; ?><br/>
					
				<?php endforeach; } else { echo '<div class="alert">'.__( 'No Portfolio Categories created yet!', 'Nevada' ).'</div>'; } ?>
				
				</p>
				<small>(<?php _e( 'show only projects of the checked type in this portfolio page', 'Nevada' ); ?>)</small>
			</div>
        
		
			<div class="lambda-opttitle">
        		<div class="lambda-opttitle-pad">
            		<?php _e( 'Portfolio Column Layout', 'Nevada' ); ?>
           		</div>
        	</div>
       		
			<div class="lambda-settings-pad">
			<?php $c_layouts = array (  '2column' => array ( 	'name' 		=> __( 'Portfolio 2 Column', 'Nevada' ),
									 							'value' 	=> '2',
                                        						'id' 		=> 'portfolio_two_column'),
									 	'3column' => array ( 	'name' 		=> __( 'Portfolio 3 Column', 'Nevada' ),
 									 							'value' 	=> '3',
                                        						'id' 		=> 'portfolio_three_column'),						
										'4column' => array ( 	'name' 		=> __( 'Portfolio 4 Column', 'Nevada' ),
 									 							'value' 	=> '4',
                                        						'id'		=> 'portfolio_four_column')); ?>
            
			
			<p><ul class="c_layouts">                       
            <?php foreach ($c_layouts as $i => $c_layout): ?>
            	 <?php $mb->the_field(UT_THEME_INITIAL.'column_layout'); ?>
                <li>
					<label class="radioimage" for="<?php echo $c_layout['id']; ?>">
						<img src="<?php echo THEME_WEB_ROOT; ?>/lambda/assets/images/<?php echo $c_layout['id']; ?>.png" alt="<?php echo $c_layout['id']; ?>">
                	</label>
					<br />
                	<input style="margin-right:10px;" type="radio" name="<?php $mb->the_name(); ?>" id="<?php echo $c_layout['id']; ?>" value="<?php echo $c_layout['value']; ?>"<?php $mb->the_radio_state($c_layout['value']); ?>><?php echo $c_layout['name']; ?> 
				</li>
            <?php endforeach; ?>
            </ul></p>			
						
			<hr />
						
			<div class="btn-group">
		
			<label><?php _e( 'Show / Hide Filter', 'Nevada' ); ?></label>
			<?php $mb->the_field('activate_portfolio_filter'); ?>
				
			<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
			<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
				
			<button data-state="activate_portfolio_filter_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
			<input id="activate_portfolio_filter_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
			<button data-state="activate_portfolio_filter_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
			<input id="activate_portfolio_filter_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
		
			</div>						
			
			<p><label><?php _e( 'Portfolio Items per Page', 'Nevada' ); ?></label>
			<?php $mb->the_field('posts_per_page'); ?>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('default: 9', 'Nevada'); ?>)</span></p>
			
			
			<p><label><?php _e( 'Pagination: previous text', 'Nevada' ); ?></label>
			<?php $mb->the_field('portfolio_pre_text'); ?>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('Text for "prev works" link.', 'Nevada'); ?>)</span></p>
			
			
			<p><label><?php _e( 'Pagination: next text', 'Nevada' ); ?></label>
			<?php $mb->the_field('portfolio_next_text'); ?>
			<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<br /><span class="info badge badge-info">(<?php _e('Text for "next works" link.', 'Nevada'); ?>)</span></p>
						
			</div>
			
			<div class="lambda-opttitle">
        		<div class="lambda-opttitle-pad">
            		<?php _e( 'Portfolio Item Title', 'Nevada' ); ?>
           		</div>
        	</div>
       		
			<div class="lambda-settings-pad">		
			
			<div class="btn-group">
		
				<label><?php _e( 'Show Portfolio Item Title', 'Nevada' ); ?></label>
				<?php $mb->the_field('portfolio_item_title'); ?>
					
				<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
				<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
					
				<button data-state="portfolio_item_title_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
				<input id="portfolio_item_title_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
				<button data-state="portfolio_item_title_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
				<input id="portfolio_item_title_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
		
			</div>
			</div>	
		</div>
		</div>	 
	</div>
</div>
<?php } ?>


<?php 
#-----------------------------------------------------------------
# Post Format Settings
#----------------------------------------------------------------- 
?>

<?php if(get_post_type($post->ID) == 'post') { ?>
<div id="postformat-settings" class="postformat-settings tab-pane">

	<div class="lambda_overlay"></div>
	
	<div class="ui-panelcontent">
    	
		<div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Post Format Settings', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">		
				
				<div id="lambda-post-format-link" class="postf_box">
					<?php
					#-----------------------------------------------------------------
					# Post Format: Link
					#----------------------------------------------------------------- ?>
					<div class="post_format_link">
					<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Link', 'Nevada' ); ?>
						</div>
					</div>
					<div class="lambda-settings-pad">
					   
						<p><label><?php _e( 'Share a link!', 'Nevada' ); ?></label>
						<?php $mb->the_field('post_format_link'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p> 
						
						</div>
					</div>
					</div>
					
					<?php
					#-----------------------------------------------------------------
					# Post Format: Quote
					#----------------------------------------------------------------- ?>
					<div id="lambda-post-format-quote" class="postf_box">        
						<div class="post_format_quote">
							<div class="lambda-opttitle">
								<div class="lambda-opttitle-pad">
								<?php _e( 'Quote', 'Nevada' ); ?>
								</div>
							</div>
							<div class="lambda-settings-pad">
							   
								<p><label><?php _e( 'Share a Quote!', 'Nevada' ); ?></label>
								<?php $mb->the_field('post_format_quote'); ?>
								<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="85" class="lambdatextarea"><?php $mb->the_value(); ?></textarea></p> 
								
							</div>
						</div>
					</div>
				
					<?php
					#-----------------------------------------------------------------
					# Post Format: Video
					#----------------------------------------------------------------- ?>
					<div id="lambda-post-format-video" class="postf_box">        
					<div class="post_format_video">
					<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
						<?php _e( 'Video Details', 'Nevada' ); ?>
					 </div>
					</div>
					<div class="lambda-settings-pad">						
                        
                        <?php $mb->the_field('nonverbla_url'); ?>
                        <?php $wpalchemy_media_access->setGroupName('nonverbla_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'Upload Video', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                        
                        <?php $mb->the_field('nonverbla_hd_url'); ?>
                        <?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'Upload Video', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                        
                        <?php $mb->the_field('poster_image'); ?>
                        <?php $wpalchemy_media_access->setGroupName('poster_image'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'Poster Image', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Poster" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Poster" , 'Nevada') , 'image'); ?>
                                                   
                        </p>		
                        
                        <?php $mb->the_field('mp4_url'); ?>
                        <?php $wpalchemy_media_access->setGroupName('mp4_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'MP4 File URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                        
                        <p><h4>or</h4></p>
                        
                        <p>
                        <label class="metalabel"><?php _e( 'Embedded Code', 'Nevada' ); ?></label>
                        <?php $mb->the_field('embedded_code'); ?>
                        <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                        <br /><span class="info badge badge-info">(<?php _e( 'Embedded Code', 'Nevada' ); ?>)</span>
                        </p>
						 
					</div>
				  </div>
				</div>
						
				<?php
				#-----------------------------------------------------------------
				# Post Format: Audio
				#----------------------------------------------------------------- ?>
				<div id="lambda-post-format-audio" class="postf_box">        
				<div class="post_format_video">
					<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
						<?php _e( 'Audio Details', 'Nevada' ); ?>
					 </div>
					</div>
					<div class="lambda-settings-pad">
			
						<p><label class="metalabel"><?php _e( 'Soundcloud URL', 'Nevada' ); ?></label>
						<?php $mb->the_field('soundcloud_url'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e( 'The URL to Soundcloud', 'Nevada' ); ?>)</span></p>
						
						<h4 style="padding-bottom:20px;"><?php _e('or', 'Nevada')?></h4>
						
						<p><label class="metalabel"><?php _e( 'MP3 URL', 'Nevada' ); ?></label>
						<?php $mb->the_field('mp3_url'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e( 'URL to MP3 file', 'Nevada' ); ?>)</span></p>
						
						<p><label class="metalabel"><?php _e( 'OGG URL', 'Nevada' ); ?></label>
						<?php $mb->the_field('ogg_url'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e( 'URL to OGG file', 'Nevada' ); ?>)</span></p>	
													
					</div>
				</div>
				</div>
				<?php
				#-----------------------------------------------------------------
				# All other formats with no additional options
				#----------------------------------------------------------------- ?>
				<div id="lambda-post-format-0" class="postf_box no-post-format-options">
					<div class="no-post-format-options">
						<span class="info badge badge-info">
							<?php _e('No Post Settings available for this Format!', UT_THEME_INITIAL);?>
						</span>
					</div>
				</div>
				<div id="lambda-post-format-aside" class="postf_box no-post-format-options">
					<div class="no-post-format-options">
						<span class="info badge badge-info">
							<?php _e('No Post Settings available for this Format!', UT_THEME_INITIAL);?>
						</span>
					</div>
				</div>
				<div id="lambda-post-format-gallery" class="postf_box no-post-format-options">
					<div class="no-post-format-options">
						<span class="info badge badge-info">
							<?php _e('No Post Settings available for this Format!', UT_THEME_INITIAL);?>
						</span>
					</div>
				</div>
				<div id="lambda-post-format-image" class="postf_box no-post-format-options">
					<div class="no-post-format-options">
						<span class="info badge badge-info">
							<?php _e('No Post Settings available for this Format!', UT_THEME_INITIAL);?>
						</span>
					</div>
				</div>
           
        
        	</div>
    	</div>
    </div>
</div>
<?php } ?>

<?php if(get_post_type($post->ID) == UT_PORTFOLIO_SLUG ) { ?>

<?php 
#-----------------------------------------------------------------
# Portfolio Items
#----------------------------------------------------------------- 
?>
<div id="portfolio-items" class="portfolio-items tab-pane">
	
	<div class="lambda_overlay"></div>
	
	<div class="ui-panelcontent">
	   	
		
		<div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Project Items', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">
		
				<div class="lambda-opttitle">
					<div class="lambda-opttitle-pad">
						<?php _e( 'Project Type', 'Nevada' ); ?>
					</div>
				</div>
			 
				<div class="lambda-settings-pad">
				
				<p><label class="metalabel"><?php _e( 'Portfolio Description Title', 'Nevada' ); ?></label>
				<?php $mb->the_field('pcontent_title'); ?>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<br /><span class="info badge badge-info">(<?php _e( 'displayed above the portfolio description', 'Nevada' ); ?>)</span></p>
								
				
				<p>
				<?php $mb->the_field('portfolio_type'); ?>
				<select name="<?php $mb->the_name(); ?>" id="portfolio_type">
					 <option value=""><?php _e( 'Choose Portfolio Type', 'Nevada' ); ?></option>
					 <option value="audio_portfolio" <?php $mb->the_select_state('audio_portfolio'); ?>> <?php _e( 'Audio', 'Nevada' ); ?> </option>
					 <option value="video_portfolio" <?php $mb->the_select_state('video_portfolio'); ?>> <?php _e( 'Video', 'Nevada' ); ?> </option>
					 <option value="image_portfolio" <?php $mb->the_select_state('image_portfolio'); ?>> <?php _e( 'Slider', 'Nevada' ); ?> </option>
					 <option value="single_image_portfolio" <?php $mb->the_select_state('single_image_portfolio'); ?>> <?php _e( 'Single Image', 'Nevada' ); ?> </option>
				</select>
				</p>
				</div>			
				
				
				
				<?php
				#-----------------------------------------------------------------
				# Portfolio Audio
				#----------------------------------------------------------------- ?>
				<div id="audio_portfolio" class="p_box"><!--#audio-->
			 
				<div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
				<?php _e( 'Audio Details', 'Nevada' ); ?>
				</div>
				</div>
					<div class="lambda-settings-pad">                    
						
						<p><label class="metalabel"><?php _e( 'Soundcloud URL', 'Nevada' ); ?></label>
						<?php $mb->the_field('portfolio_soundcloud_url'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e( 'The URL to Soundcloud', 'Nevada' ); ?>)</span></p>
						
						<h4 style="padding-bottom:20px;"><?php _e('or', 'Nevada')?></h4>
					
						<p><label class="metalabel"><?php _e( 'MP3 URL', 'Nevada' ); ?></label>
						<?php $mb->the_field('portfolio_mp3_url'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e( 'URL to MP3 file', 'Nevada' ); ?>)</span></p>
						
						<p><label class="metalabel"><?php _e( 'OGG URL', 'Nevada' ); ?></label>
						<?php $mb->the_field('portfolio_ogg_url'); ?>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e( 'URL to OGG file', 'Nevada' ); ?>)</span></p>	
																
					</div>			
				</div><!--/#audio-->
				
				
				<?php
				#-----------------------------------------------------------------
				# Portfolio Video
				#----------------------------------------------------------------- ?>
				<div id="video_portfolio" class="p_box"><!--#video-->
				
				<div class="lambda-opttitle">
					<div class="lambda-opttitle-pad">
						<?php _e( 'Manage your Video', 'Nevada' ); ?><br />
						<span><?php _e( 'to build up a video on the project page!', 'Nevada' ); ?></span><div class="clear"></div>
					</div>
				</div>
			
				<div class="lambda-settings-pad">
								 
					<?php $mb->the_field('nonverbla_url'); ?>
                        <?php $wpalchemy_media_access->setGroupName('nonverbla_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'Upload Video', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                        
                        <?php $mb->the_field('nonverbla_hd_url'); ?>
                        <?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'Upload Video', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('can be .mov, .flv', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                        
                        <?php $mb->the_field('poster_image'); ?>
                        <?php $wpalchemy_media_access->setGroupName('poster_image'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'Poster Image', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Poster" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Poster" , 'Nevada') , 'image'); ?>
                                                   
                        </p>		
                        
                        <?php $mb->the_field('mp4_url'); ?>
                        <?php $wpalchemy_media_access->setGroupName('mp4_url_slider'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                        <p>   
                            <label><?php _e( 'MP4 File URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                            <br /><span class="info badge badge-info">(<?php _e('should be same size as Video', 'Nevada'); ?>)</span><br />
                            <?php echo wpa_media_button(__("Upload Video" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Video" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                        
                        <p><h4>or</h4></p>
                        
                        <p>
                        <label class="metalabel"><?php _e( 'Embedded Code', 'Nevada' ); ?></label>
                        <?php $mb->the_field('portfolio_embedded_code'); ?>
                        <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                        <br /><span class="info badge badge-info">(<?php _e( 'Embedded Code', 'Nevada' ); ?>)</span>
                        </p>
				
				</div><!--/#video-->
				</div>
				
				<?php
				#-----------------------------------------------------------------
				# Image Prasentation
				#----------------------------------------------------------------- ?>
				<div id="image_portfolio" class="p_box"><!--#image-->	
			  
				<div class="lambda-opttitle">
				
                <div class="lambda-opttitle-pad">
					<?php _e( 'Manage your Project Items', 'Nevada' ); ?><br />
					<span><?php _e( 'to build up a gallery /slider on the project page!', 'Nevada' ); ?></span><div class="clear"></div>
					</div>
				</div>
                
				<div class="lambda-settings-pad">
						<?php $z = 0;
						while($mb->have_fields_and_multi(UT_THEME_INITIAL.'portfolio_images')): ?>
						<?php $mb->the_group_open(); ?>  
		
							<?php $mb->the_field('imgurl'); ?>
							<?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
							
							<div class="slide_item_name">
								<?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new slide', 'Nevada' ); }; ?>
							</div>
							
							<div class="fancy_box slide_item">
								
                                <p>                            
                                    <img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
                                    else { echo aq_resize( $mb->get_the_value(), 220, 120, true ); } ?>" class="image_box slider-n<?php echo $z; ?>" />
                                    
                                    <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br><br>
                                    <?php echo wpa_media_button(__("Upload Picture" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Picture" , 'Nevada') , 'image'); ?>
                                                           
                                </p>
                                                                
								
								<p><?php $mb->the_field('title'); ?>
								<label for="<?php $mb->the_name(); ?>"><?php _e( 'Set "alt" (for SEO)', 'Nevada' ); ?> <span class="optional">(<?php _e( 'optional', 'Nevada' ); ?>)</span></label>
								<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
								
                                <a ref="#" class="dodelete btn btn-danger"><?php _e( 'Remove', 'Nevada' ); ?></a></p>
                                
							</div>
					
					<?php $mb->the_group_close(); ?>
					<?php $z++; endwhile; ?>
				
					<div class="clear"></div>
					<p style="margin-bottom:15px; padding-top:5px;">
					<a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'portfolio_images'; ?> btn btn-info" style="float:left;">
						<?php _e( 'Add New Item', 'Nevada' ); ?>
					</a>
					<a href="#" class="dodelete-<?php echo UT_THEME_INITIAL.'portfolio_images'; ?> btn btn-danger" style="float:right;">
						<?php _e( 'Remove All Items', 'Nevada' ); ?>
					</a>
					</p>
					<div class="clear"></div>
			 </div>
				
				</div><!--/#image-->
	
				
				<div class="lambda-opttitle">
					<div class="lambda-opttitle-pad">
						<?php _e( 'Work Description', 'Nevada' ); ?>
					</div>
				</div>
				<div class="lambda-settings-pad">
				
				<p><label class="metalabel"><?php _e( 'Work Description Title', 'Nevada' ); ?></label>
				<?php $mb->the_field('work_title'); ?>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<br /><span class="info badge badge-info">(<?php _e( 'displayed above the work description', 'Nevada' ); ?>)</span></p>
					
				
				<label><?php _e( 'Add Work Description', 'Nevada' ); ?></label>
	 
				<?php while($mb->have_fields_and_multi(UT_THEME_INITIAL.'project_atts')): ?>
				<?php $mb->the_group_open(); ?>
										
					<?php $mb->the_field('work_title'); ?>
					<div class="work_item_name">
						<?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new work description', 'Nevada' ); }; ?>
					</div>
					
					<div class="fancy_box work_item">	
									
						<?php $mb->the_field('work_title'); ?>
						<label><?php _e( 'Title and Name / Description', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
				 
						<?php $mb->the_field('work_desc'); ?>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
								
						<?php $mb->the_field('is_link'); ?>
						<p><input type="checkbox" name="<?php $mb->the_name(); ?>" value="disabled"<?php $mb->the_checkbox_state('disabled'); ?>/> <?php _e( 'Description is a link', 'Nevada' ); ?></p>
						<a href="#" class="dodelete btn btn-danger"><?php _e( 'Remove', 'Nevada' ); ?></a>
					
					</div>
			
				<?php $mb->the_group_close(); ?>
				<?php endwhile; ?>
			
				<div class="clear"></div>
				<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'project_atts'; ?> btn btn-inverse"><?php _e( 'Add Description', 'Nevada' ); ?></a></p>
	
			</div>        
			</div>
		</div>	
	 </div>
</div>

<?php } ?>

<?php if(get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') : ?>

<?php 
#-----------------------------------------------------------------
# Contact Form
#----------------------------------------------------------------- 
?>
<div id="contact-settings" class="contact-settings tab-pane">
	
	<div class="lambda_overlay"></div>
	
	<div class="ui-panelcontent">
       
	   <div class="container block">
					
			<div class="meta-headline">
			
				<h1><?php _e( 'Contact Form Settings & Builder', 'Nevada' ); ?></h1>
				<div class="clear"></div>
				
			</div>
		
			<div class="sixteen columns">
	   
		   <div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Google Maps', 'Nevada' ); ?>
				</div>
		   </div>
		   <div class="lambda-settings-pad">
				
				<?php $mb->the_field('show_map'); ?>
				<input type="checkbox" name="<?php $mb->the_name(); ?>" value="show_map"<?php $mb->the_checkbox_state('show_map'); ?>/> 
				<?php _e( 'show google map above contact form', 'Nevada' ); ?>
				
				<hr />
				
				<p><?php $mb->the_field('map_title'); ?>
				<label class="metalabel" for="<?php $mb->the_name(); ?>"><?php _e( 'Map Title', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<br /><span class="info badge badge-info"><?php _e( 'Insert title for Google Map', 'Nevada' ); ?></span>
				</p>
				
				<p><?php $mb->the_field('map_address'); ?>
				<label for="<?php $mb->the_name(); ?>"><?php _e( 'Address to display', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<br /><span class="info badge badge-info">(<?php _e('for example: 100 Biscayne Blvd. Florida 33148', 'Nevada'); ?>)</span></p>
				
				<p><?php $mb->the_field('map_zoom'); ?>
				<label for="<?php $mb->the_name(); ?>"><?php _e( 'Zoom', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<br /><span class="info badge badge-info">(<?php _e('for example: 14', 'Nevada'); ?>)</span></p>
				
				<p><?php $mb->the_field('map_height'); ?>
				<label for="<?php $mb->the_name(); ?>"><?php _e( 'Map height', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<br /><span class="info badge badge-info">(<?php _e('for example: 300', 'Nevada'); ?>)</span></p>	
				
		  </div>
		  <div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
				<?php _e( 'Email Settings', 'Nevada' ); ?>
				</div>
		   </div>
		   <div class="lambda-settings-pad">
			   
				<p>
				<?php $mb->the_field('email_to'); ?>
				<label class="metalabel" for="<?php $mb->the_name(); ?>"><?php _e( 'Email Recipient', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				<br /><span class="info badge badge-info"><?php _e( 'Send email to a specified email (leave empty to send an email to Admin)', 'Nevada' ); ?></span>
				</p>
				
				
				<p>
				<?php $mb->the_field('email_subject'); ?>
				<label class="metalabel" for="<?php $mb->the_name(); ?>"><?php _e( 'Email subject', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				</p>
				
				
				<p>
				<?php $mb->the_field('submit_text'); ?>
				<label class="metalabel" for="<?php $mb->the_name(); ?>"><?php _e( 'Text on submit button', 'Nevada' ); ?></label>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				</p>
				
				
		   </div>
		   <div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
				    <?php _e( 'Contact Form Builder', 'Nevada' ); ?><br />
					<span><?php _e( 'Drag and Drop Elements to change the order! Click on item to unroll', 'Nevada' ); ?></span><div class="clear"></div>
				</div>
		   </div>
		   <div class="lambda-settings-pad">
				
				<p>
					<?php $mb->the_field('contact_title'); ?>
					<label class="metalabel" for="<?php $mb->the_name(); ?>"><?php _e( 'Contact Form Title', 'Nevada' ); ?></label>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				</p>
				
				<hr />
				
				<h4><?php _e( 'Contact Form Builder', 'Nevada' ); ?></h4>
				<?php 
				while($mb->have_fields_and_multi(UT_THEME_INITIAL.'contact_form_fields')): ?>
				<?php $mb->the_group_open(); ?>
					
					<?php $mb->the_field('field_name'); ?>
					<div class="form_item_name">
					<?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new field', 'Nevada' ); }; ?>
					</div>
					
					<div class="fancy_box form_item">	
					<?php $mb->the_field('field_name'); ?>
					<label for="<?php $mb->the_name(); ?>"><?php _e( 'Field Name', 'Nevada' ); ?></label>
					<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
					<br /><span class="info badge badge-info"><?php _e( 'Choose a Fieldname, for example: Name, Website, Message etc.', 'Nevada' ); ?></span>
					</p>
					
					<hr />
					
					<?php $mb->the_field('field_type'); ?>
					<label><?php _e( 'Field Type', 'Nevada' ); ?></label>
					<select name="<?php $mb->the_name(); ?>" class="select_form_type">
						<option value="">Select field type ...</option>
						<option value="input"<?php $mb->the_select_state('input'); ?>>input</option>
						<option value="email"<?php $mb->the_select_state('email'); ?>>email input</option>
						<option value="textarea"<?php $mb->the_select_state('textarea'); ?>>textarea</option>
						<option value="checkbox"<?php $mb->the_select_state('checkbox'); ?>>checkbox</option>
						<option value="radio"<?php $mb->the_select_state('radio'); ?>>radio</option>
						<option value="select"<?php $mb->the_select_state('select'); ?>>select</option>
					</select>
					
					<div class="field_custom_values">
						<?php $mb->the_field('values'); ?>
						<label><?php _e( 'Enter Values', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info"><?php _e( 'semicolon delimited for example: Yes;No or Los Angels;San Francisco', 'Nevada' ); ?></span>
						</p>
					</div>
					
					<hr />
					<?php $mb->the_field('is_required'); ?>
					<input class="required" type="checkbox" name="<?php $mb->the_name(); ?>" value="required"<?php $mb->the_checkbox_state('required'); ?>/> 
						 <?php _e( 'this field is required', 'Nevada' ); ?>
			
					
					<div class="error_handling">
						<?php $mb->the_field('error_message'); ?>
						<label><?php _e( 'Error Message', 'Nevada' ); ?></label>
						<p>
							<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
							<br /><span class="info badge badge-info"><?php _e( 'Enter custom error message', 'Nevada' ); ?></span>
						</p>
						
						<?php $mb->the_field('min_length'); ?>
						<label><?php _e( 'min length', 'Nevada' ); ?></label>
						<p>
							<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
							<br /><span class="info badge badge-info"><?php _e( 'Min length of input (not available for radio / select or checkbox)', 'Nevada' ); ?></span>
						</p>
					</div>
						 
					<a href="#" class="dodelete btn btn-danger" style="float:right;"><?php _e( 'Delete Field', 'Nevada' ); ?></a>
					<div class="clear"></div>
					
					</div>
			
				<?php $mb->the_group_close(); ?>
				<?php endwhile; ?>
				
				<div class="clear"></div>
				<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'contact_form_fields'; ?> btn btn-success"><?php _e( 'add new field', 'Nevada' ); ?></a></p>
	
			</div>
			</div>
	 </div>		
	 </div>
</div>





<?php 
#-----------------------------------------------------------------
# Team
#----------------------------------------------------------------- 
?>
<div id="team-settings" class="team-settings tab-pane">

	<div class="lambda_overlay"></div>

	<div class="ui-panelcontent">
       
	   <div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Manage Template', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">
	   
	   
		   <div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Add Team Member', 'Nevada' ); ?>
				</div>
		   </div>
		   <div class="lambda-settings-pad">
		   
				<?php 
				while($mb->have_fields_and_multi(UT_THEME_INITIAL.'team_member')): ?>
				<?php $mb->the_group_open(); ?>
									
					<?php $mb->the_field('member_name'); ?>
					<div class="member_item_name"><?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new member', 'Nevada' ); }; ?></div>
					
					<div class="fancy_box member_item">	
								
						<?php $mb->the_field('member_name'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member Name', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<?php $mb->the_field('member_title'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member Title', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p> 
						
						<?php $mb->the_field('member_pic'); ?>
						<?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						
                        <p>                            
                            
                            <img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
                            else { echo aq_resize( $mb->get_the_value(), 140, 140, true ); } ?>" class="image_box slider-n<?php echo $z; ?>" />
                            
                            <span class="desc alert alert-neutral"><?php _e('Image Size should be 140x140', 'Nevada'); ?></span>
                             
                            <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br><br>
                            <?php echo wpa_media_button(__("Upload Picture" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Picture" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
                        
						<?php $mb->the_field('member_email'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member Email', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
											
						<?php $mb->the_field('member_website'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member Website', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<?php $mb->the_field('member_twitter'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member Twitter Account', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<?php $mb->the_field('member_facebook'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member Facebook Profile', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<?php $mb->the_field('member_google'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member GogolePlus Account', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
                        <?php $mb->the_field('member_linkedin'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Member LinkedIn Account', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<div class="customEditor">
						<?php $mb->the_field('member_text'); ?>
						
						<div class="wp-editor-tools">
							<div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action( 'media_buttons' ); ?></div>
						</div>
						<textarea id="<?php $mb->the_name(); ?>" cols="50" name="<?php $mb->the_name(); ?>" class="lambdatextarea"><?php echo wpautop( esc_html($mb->get_the_value()) ); ?></textarea>
						</div>
						
						<div class="clear"></div>						
											 
						<a href="#" class="dodelete btn btn-danger"><?php _e( 'Delete Member', 'Nevada' ); ?></a>
                        
					</div>
			
				<?php $mb->the_group_close(); ?>
				<?php endwhile; ?>
				
				<div class="clear"></div>
				<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'team_member'; ?> btn btn-success"><?php _e( 'add new member', 'Nevada' ); ?></a></p>
		   
		   		</div>
			</div>  
		</div>
	</div>
</div>   




<?php 
#-----------------------------------------------------------------
# FAQ
#----------------------------------------------------------------- 
?>
<div id="faq-settings" class="faq-settings tab-pane">
	
	<div class="lambda_overlay"></div>

	<div class="ui-panelcontent">
		
		 <div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Manage FAQ', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">
		
			   <div class="lambda-opttitle">
					<div class="lambda-opttitle-pad">
						<?php _e( 'Add FAQ Item', 'Nevada' ); ?>
					</div>
			   </div>
			   <div class="lambda-settings-pad">
		
					
					<?php while($mb->have_fields_and_multi(UT_THEME_INITIAL.'faq_items')): ?>
					<?php $mb->the_group_open(); ?>
				 
						<?php $mb->the_field('faq_question'); ?>
						<div class="faq_item_name"><?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new question', 'Nevada' ); }; ?></div>
						<div class="fancy_box faq_item">
						
						
						<?php $mb->the_field('faq_question'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Question', 'Nevada' ); ?></label>
						<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
							 
						<div class="customEditor">
							<?php $mb->the_field('faq_answer'); ?>
							
							<div class="wp-editor-tools">
								<div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action( 'media_buttons' ); ?></div>
							</div>
							<textarea id="<?php $mb->the_name(); ?>" rows="10" cols="50" name="<?php $mb->the_name(); ?>" class="lambdatextarea"><?php echo wpautop( esc_html($mb->get_the_value()) ); ?></textarea>
							<a href="#" class="dodelete btn btn-danger"><?php _e( 'Delete FAQ', 'Nevada' ); ?></a>
						</div>
						
						</div>
				
					<?php $mb->the_group_close(); ?>
					<?php endwhile; ?>
					
					<div class="clear"></div>
					<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'faq_items'; ?> btn btn-success"><?php _e( 'add new question', 'Nevada' ); ?></a></p>
					
					</div>
					
					<div class="lambda-opttitle">
					<div class="lambda-opttitle-pad">
						<?php _e( 'Additional Content to display beneath the FAQ', 'Nevada' ); ?>
					</div>
					</div>
					<div class="lambda-settings-pad">
					
					<?php $mb->the_field('faq_additional_content'); 
		
					$settings = array( 
						'textarea_rows' => '20',
						'media_buttons' => 'true',
						'tabindex' =>2,
						'wpautop' => "false" 
					);
			
					$val =  html_entity_decode($mb->get_the_value()); 
					$id = $mb->get_the_name();
					
					wp_editor($val,  $id , $settings );
					
					?>
					
				</div>		
			</div>
		</div>
	</div>
</div> 



<?php 
#-----------------------------------------------------------------
# Home
#----------------------------------------------------------------- 
?>
<div id="home-settings" class="home-settings tab-pane">
	
	<div class="lambda_overlay"></div>
	
	<div class="ui-panelcontent">
	
	<div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Manage Home Site', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="four columns">
				
				<script type="text/javascript">
		
				jQuery(document).ready(function($) {			
					
					var $items = $('#home-tabs-titles li a');
					$items.click(function() {
						
						$items.removeClass('selected');
					
						$(this).addClass('selected');
					 
						var index = $items.index($(this));
						$('#home-tabs-contents > div').hide().eq(index).fadeIn();
					
					}).eq(0).click();
								
				});
				
				</script>	
				
							
				<ul id="home-tabs-titles">
								
					<li><a><?php _e( 'Service Columns', 'Nevada' ); ?></a></li>
					<li><a><?php _e( 'Portfolio Items', 'Nevada' ); ?></a></li>
					<li><a><?php _e( 'Blog Excerpt', 'Nevada' ); ?></a></li>
					<li><a><?php _e( 'Toggles & Testimonials', 'Nevada' ); ?></a></li>
					<li><a><?php _e( 'Clients', 'Nevada' ); ?></a></li>
					<li><a><?php _e( 'Call to Action', 'Nevada' ); ?></a></li>
					<li><a><?php _e( 'Element Order', 'Nevada' ); ?></a></li>
						
				</ul>
				
			</div><!--Sidebar content-->
			
			
			
			<div id="home-tabs-contents" class="twelve columns">
						
				<?php 
				#-----------------------------------------------------------------
				# Service Columns
				#----------------------------------------------------------------- 
				?>	
				
				<div id="home-service-columns" class="home-service-columns tab-pane">
		
					<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Service Columns', 'Nevada' ); ?>
						</div>
					</div>
					<div class="lambda-settings-pad">
					
					<div class="btn-group">
					
						<label><?php _e( 'Activate Service Columns', 'Nevada' ); ?></label>
						<?php $mb->the_field('activate_service_columns'); ?>
							
						<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
						<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
							
						<button data-state="activate_service_columns_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
						<input id="activate_service_columns_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
						<button data-state="activate_service_columns_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
						<input id="activate_service_columns_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
					
					</div>
					
					<hr />						
					
					<?php 
					#-----------------------------------------------------------------
					# Service Column 1
					#----------------------------------------------------------------- 
					?>
					<div class="one_half">
					
						<div class="servicecolumn">
						<div class="btn-group">
							
							<label><?php _e( 'Activate Service Column 1', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_col_1'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_col_1_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_col_1_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_col_1_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_col_1_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
								
						</div>
						
						<?php $mb->the_field('col_1_icon'); ?>
						<?php $wpalchemy_media_access->setGroupName('img-ico-1'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						
						<div style="min-height:50px;">	
							<img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 32, 32, true ); } ?>" />           
						</div>
						
                        <p> 
                        
                            <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br>
                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', 'Nevada'); ?>)</span>
                            <?php echo wpa_media_button(__("Upload Icon" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Icon" , 'Nevada') , 'image'); ?>
                                                   
                        </p>	
                        
                        <p><?php $mb->the_field('col_1_icon_alt'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Icon alt ( SEO )', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                        
						<p><?php $mb->the_field('col_1_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						<p><label><?php _e( 'Content', 'Nevada' ); ?></label>
						<?php $mb->the_field('col_1_content'); ?>
						<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
						<br /><span class="info badge badge-info">(<?php _e('This field accepts shortcodes', 'Nevada'); ?>)</span></p>
						
						<p><?php $mb->the_field('col_1_link'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Link', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<p><?php $mb->the_field('col_1_buttontext'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttontext', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						</div>
				   	
					</div><!-- end one_half -->
				   
					<?php 
					#-----------------------------------------------------------------
					# Service Column 2
					#----------------------------------------------------------------- 
					?>
					<div class="one_half last">	
						
						<div class="servicecolumn">
						<div class="btn-group">
							
							<label><?php _e( 'Activate Service Column 2', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_col_2'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_col_2_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_col_2_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_col_1_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_col_2_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							
						</div>
						
						
						<?php $mb->the_field('col_2_icon'); ?>
						<?php $wpalchemy_media_access->setGroupName('img-ico-2'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						
						<div style="min-height:50px;">	
							<img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 32, 32, true ); } ?>" />           
						</div>
								
						<p> 
                        
                            <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br>
                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', 'Nevada'); ?>)</span>
                            <?php echo wpa_media_button(__("Upload Icon" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Icon" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
					    
                        <p><?php $mb->the_field('col_2_icon_alt'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Icon alt ( SEO )', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                        
						<p><?php $mb->the_field('col_2_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						<p><label><?php _e( 'Content', 'Nevada' ); ?></label>
						<?php $mb->the_field('col_2_content'); ?>
						<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
						<br /><span class="info badge badge-info">(<?php _e('This field accepts shortcodes', 'Nevada'); ?>)</span></p>
					   
						<p><?php $mb->the_field('col_2_link'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Link', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<p><?php $mb->the_field('col_2_buttontext'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttontext', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						</div>
					
					</div><!-- end one_half -->
					
					<?php 
					#-----------------------------------------------------------------
					# Service Column 3
					#----------------------------------------------------------------- 
					?>
					<div class="one_half">
					
						<div class="servicecolumn">
						<div class="btn-group">
							
							<label><?php _e( 'Activate Service Column 3', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_col_3'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_col_3_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_col_3_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_col_3_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_col_3_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							
						</div>
						
						<?php $mb->the_field('col_3_icon'); ?>
						<?php $wpalchemy_media_access->setGroupName('img-ico-3'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						
						<div style="min-height:50px;">	
							<img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 32, 32, true ); } ?>" />           
						</div>
								
						<p> 
                        
                            <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br>
                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', 'Nevada'); ?>)</span>
                            <?php echo wpa_media_button(__("Upload Icon" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Icon" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
					    
                        <p><?php $mb->the_field('col_3_icon_alt'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Icon alt ( SEO )', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                                                
						<p><?php $mb->the_field('col_3_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						<p><label><?php _e( 'Content', 'Nevada' ); ?></label>
						<?php $mb->the_field('col_3_content'); ?>
						<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
						<br /><span class="info badge badge-info">(<?php _e('This field accepts shortcodes', 'Nevada'); ?>)</span></p>
					   
						<p><?php $mb->the_field('col_3_link'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Link', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<p><?php $mb->the_field('col_3_buttontext'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttontext', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						</div>
					
					</div><!-- end one_half -->
					
					<?php 
					#-----------------------------------------------------------------
					# Service Column 4
					#----------------------------------------------------------------- 
					?>
					<div class="one_half last">
						
						<div class="servicecolumn">
						<div class="btn-group">
							
							<label><?php _e( 'Activate Service Column 4', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_col_4'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_col_4_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_col_4_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_col_4_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_col_4_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							
						</div>
						
						<?php $mb->the_field('col_4_icon'); ?>
						<?php $wpalchemy_media_access->setGroupName('img-ico-4'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						
						<div style="min-height:50px;">	
							<img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 32, 32, true ); } ?>" />           
						</div>
								
						<p> 
                        
                            <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br>
                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', 'Nevada'); ?>)</span>
                            <?php echo wpa_media_button(__("Upload Icon" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Icon" , 'Nevada') , 'image'); ?>
                                                   
                        </p>
					    
                        <p><?php $mb->the_field('col_4_icon_alt'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Icon alt ( SEO )', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                        
						<p><?php $mb->the_field('col_4_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						<p><label><?php _e( 'Content', 'Nevada' ); ?></label>
						<?php $mb->the_field('col_4_content'); ?>
						<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
						<br /><span class="info badge badge-info">(<?php _e('This field accepts shortcodes', 'Nevada'); ?>)</span></p>
					   
						<p><?php $mb->the_field('col_4_link'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Link', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<p><?php $mb->the_field('col_4_buttontext'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttontext', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
					   
						</div>
					
					</div><!-- end one_half -->
					
					<div class="clear"></div>
											
					</div><!-- end option pad --> 	
					
				</div><!-- end vertical tab service columns -->
				
				
				
				<?php 
				#-----------------------------------------------------------------
				# Portfolio Items
				#----------------------------------------------------------------- 
				?>	
				
				<div id="home-portfolio-items" class="home-portfolio-items tab-pane">
				
					<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Portfolio Items', 'Nevada' ); ?>
						</div>
					</div>
					<div class="lambda-settings-pad">
					
						<div class="btn-group">
						
							<label><?php _e( 'Activate Portfolio', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_portfolio'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_portfolio_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_portfolio_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_portfolio_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_portfolio_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
						</div>
					
					</div>	
					
					
					<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Portfolio Settings', 'Nevada' ); ?>
						</div>
					</div>
					<div class="lambda-settings-pad">
						
						<p><?php $mb->the_field('portfolio_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>	
						
						<p><?php $mb->the_field('portfolio_count'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Load the last x items out of the portfolio', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<p><?php $mb->the_field('portfolio_grid'); ?>
						<label><?php _e( 'Portfolio Column Layout', 'Nevada' ); ?></label>
						<select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
							
							<option value=""><?php _e('Select Column Layout ...', 'Nevada'); ?></option>
							<option value="one_half"<?php $mb->the_select_state('one_half'); ?>><?php _e('2 Columns', 'Nevada'); ?></option>
							<option value="one_third"<?php $mb->the_select_state('one_third'); ?>><?php _e('3 Columns', 'Nevada'); ?></option>
							<option value="one_fourth"<?php $mb->the_select_state('one_fourth'); ?>><?php _e('4 Columns', 'Nevada'); ?></option>
							
						</select></p>
						
						<p><label for="<?php $mb->the_name(); ?>"><?php _e( 'Display items out of the following category', 'Nevada' ); ?></label>
						<?php $taxonomys = get_terms('project-type', array(
								'hide_empty' => 0,
							));		
							if(is_array($taxonomys) && !empty($taxonomys)) {
							foreach ($taxonomys as $key => $item): ?>
						
								<?php $mb->the_field('project_type', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>	
								<input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?php echo $taxonomys[$key]->slug; ?>"<?php $mb->the_checkbox_state($taxonomys[$key]->slug); ?>/> 
								<?php echo $taxonomys[$key]->name; ?><br/>
								
						<?php endforeach; } else { echo '<div class="alert">'.__( 'No Portfolio Categories created yet!', 'Nevada' ).'</div>'; } ?></p>
						
						<div class="btn-group">
								
							<label><?php _e( 'Show Portfolio Item Title', 'Nevada' ); ?></label>
							<?php $mb->the_field('portfolio_item_title'); ?>
													
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
													
							<button data-state="portfolio_item_title_pb_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'on', 'Nevada' ); ?></button>
							<input id="portfolio_item_title_pb_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="portfolio_item_title_pb_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'off', 'Nevada' ); ?></button>	
							<input id="portfolio_item_title_pb_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
											
						</div>
									
					</div><!-- end opt pad -->
								
					</div><!-- end vertical tab portfolio items -->
					
					
					<?php 
					#-----------------------------------------------------------------
					# Blog Items
					#----------------------------------------------------------------- 
					?>
					
					<div id="home-blog-excerpt" class="home-blog-excerpt tab-pane">
		
						<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Blog Intro Box', 'Nevada' ); ?>
						</div>
						</div>
						<div class="lambda-settings-pad">		
						
						<div class="btn-group">
							
								<label><?php _e( 'Activate latest Blog?', 'Nevada' ); ?></label>
								<?php $mb->the_field('activate_latest_blog'); ?>
									
								<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
								<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
									
								<button data-state="activate_latest_blog_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
								<input id="activate_latest_blog_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
								<button data-state="activate_latest_blog_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
								<input id="activate_latest_blog_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							
						</div>
						
						<hr />
						
						<p><?php $mb->the_field('blog_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
						
						<hr />
						
						<div class="btn-group">
							
								<label><?php _e( 'Activate featured Images?', 'Nevada' ); ?></label>
								<?php $mb->the_field('activate_blog_images'); ?>
									
								<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
								<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
									
								<button data-state="activate_blog_images_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
								<input id="activate_blog_images_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
								<button data-state="activate_blog_images_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
								<input id="activate_blog_images_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							
						</div>
						
						<hr />
						
						<div class="btn-group">
							
								<label><?php _e( 'Activate Blog Excerpt', 'Nevada' ); ?></label>
								<?php $mb->the_field('activate_blog_excerpt'); ?>
									
								<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
								<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
									
								<button data-state="activate_blog_excerpt_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'on', 'Nevada' ); ?></button>
								<input id="activate_blog_excerpt_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
								<button data-state="activate_blog_excerpt_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'off', 'Nevada' ); ?></button>	
								<input id="activate_blog_excerpt_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
							
						</div>
						
						<hr />
						
						<div class="btn-group">
								
							<label><?php _e( 'Activate "Like Voting"', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_blog_like'); ?>
													
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
													
							<button data-state="activate_blog_like_pb_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'on', 'Nevada' ); ?></button>
							<input id="activate_blog_like_pb_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_blog_like_pb_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'off', 'Nevada' ); ?></button>	
							<input id="activate_blog_like_pb_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
											
						</div>
						
						<hr />
						
						<p><?php $mb->the_field('blog_excerpt_length'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Excerpt length', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e('for example: 55', 'Nevada'); ?>)</span></p>
						
						<p><?php $mb->the_field('blog_length'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Blog length', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e('how many items to display? for example: 6', 'Nevada'); ?>)</span></p>
						
						<p><?php $mb->the_field('post_not_in', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Exclude Post (optional)', 'Nevada' ); ?></label>
						<select name="<?php $mb->the_name(); ?>" class="select_post_not_in" multiple="multiple">
							<?php 
							
							$homeposts = &get_posts( array( 'numberposts' => -1, 'orderby' => 'date' ) );
							
							if ( $homeposts ) {
								
								echo '<option value="">'.__('Choose posts to exclude', 'Nevada').'</option>';
								foreach ( $homeposts as $homepost ) {
								
									echo '<option value="'.$homepost->ID.'" '.$mb->get_the_select_state($homepost->ID).'>'.$homepost->post_title.'</option>';
				
								}
								
						  } else {
							  
							  echo '<option value="0">'.__('No Pages Available', 'Nevada').'</option>';
							  
						  } ?>
						  </select>
					 	 <br /><span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', 'Nevada'); ?>)</span></p>
					  
					  	<hr />
					  
					 	<p><?php $mb->the_field('only_category', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Show only Posts of this category (optional)', 'Nevada' ); ?></label>
						<select name="<?php $mb->the_name(); ?>" class="select_only_category" multiple="multiple">
						<?php 
						
						$categories = &get_categories( array( 'hide_empty' => false ) );
						
						if ( $categories ) {
							
							echo '<option value="">'.__('Choose', 'Nevada').'</option>';
							foreach ( $categories as $category ) {
							
								echo '<option value="'.$category->term_id.'" '.$mb->get_the_select_state($category->term_id).'>'.$category->name.'</option>';
			
							}
							
					  	} else {
						  
						   echo '<option value="0">'.__('No Categories Available', 'Nevada').'</option>';
						  
					  	} ?>
					  	</select>
					  	<br /><span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', 'Nevada'); ?>)</span></p>
						
						</div><!-- end opt pad -->
				
					</div><!-- end vertical tab portfolio items -->
					
										
					<?php 
					#-----------------------------------------------------------------
					# Testimonials
					#----------------------------------------------------------------- 
					?>
					
					<div id="home-testimonials" class="home-testimonials tab-pane">
					
						<div class="lambda-opttitle">
							<div class="lambda-opttitle-pad">
								<?php _e( 'Toggles & Testimonials', 'Nevada' ); ?>
							</div>
						</div>
						<div class="lambda-settings-pad clearfix">
								
						<div class="btn-group">
						
							<label><?php _e( 'Activate Toggles & Testimonials', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_testimonials'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>

							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_testimonials_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_testimonials_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_testimonials_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_testimonials_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
						</div>
						
						<hr />						
												
						<p><?php $mb->the_field('service_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Service Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e('headline above service toggles', 'Nevada'); ?>)</span></p>
						
						<hr />										
						
						<p><?php $mb->the_field('toggle_type'); ?>
						<label><?php _e( 'Toggle Content Type', 'Nevada' ); ?></label>
						<select name="<?php $mb->the_name(); ?>" class="select_toggle_type">
							<option value=""><?php _e('Select content ...', 'Nevada'); ?></option>
							<option value="page"<?php $mb->the_select_state('page'); ?>><?php _e('from an existing page (Service Template)', 'Nevada'); ?></option>
							<option value="own"<?php $mb->the_select_state('own'); ?>><?php _e('create own toggles', 'Nevada'); ?></option>
						</select></p>
						
										
						<div class="well select_toggle_page s-toggle">
							
							<p><?php $mb->the_field('service_load_last'); ?>
							<label for="<?php $mb->the_name(); ?>"><?php _e( 'Load last X service elements', 'Nevada' ); ?></label>
							<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
							</p>
							
							
							<p><label><?php _e( 'Choose Service Page', 'Nevada' ); ?></label>
							<?php $mb->the_field('home_service_page'); ?>
							<select name="<?php $mb->the_name(); ?>">		                
							
							<?php $pages = query_posts(array(
										'post_type' => 'page',
										'meta_key' => '_wp_page_template',
										'meta_value' => 'template-service.php',
										'meta_compare' => '=='
										));
							
							if ($pages) {
								
								echo '<option value="">-- Choose One --</option>';
								foreach ( $pages as $page ) {
									
															
									//create option
									echo '<option value="'.$page->ID.'" '.$mb->get_the_select_state($page->ID).'>'.$page->post_title.'</option>';
								
								} 		
							} else {
								
								echo '<option value="0">No Pages Available</option>';
								
							} ?>
			
							</select>
							<br /><span class="info badge badge-info"><?php _e('Choose Services from an existing <br /> Service Template', 'Nevada'); ?></span></p>
						
						</div>
						
						<div class="well select_toggle_own s-toggle">
						
						<?php while($mb->have_fields_and_multi(UT_THEME_INITIAL.'home_verticaltabs')): ?>
						<?php $mb->the_group_open(); ?>
					 
								<?php $mb->the_field('tab_name'); ?>
								<div class="testimonial_item_name"><?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new tab', 'Nevada' ); }; ?></div>
												
								<div class="fancy_box testimonial_item">
								
								<p><?php $mb->the_field('tab_name'); ?>
								<label for="<?php $mb->the_name(); ?>"><?php _e( 'Tab Name', 'Nevada' ); ?></label>
								<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
								
								
								<div class="customEditor">
									<?php $mb->the_field('tab_content'); ?>					
									<div class="wp-editor-tools">
										<div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action( 'media_buttons' ); ?></div>
									</div>
									<textarea class="wysiwyg" rows="10" cols="50" name="<?php $mb->the_name(); ?>"><?php echo wpautop( esc_html($mb->get_the_value()) ); ?></textarea>
			
								</div>
								
								<a href="#" class="dodelete btn red"><?php _e( 'Delete', 'Nevada' ); ?></a>
														
								</div>
					
						<?php $mb->the_group_close(); ?>
						<?php endwhile; ?>
						
						<div class="clear"></div>
						<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'home_verticaltabs'; ?> btn btn-success"> <?php _e( 'add new tab', 'Nevada' ); ?></a></p>
						
						</div>
						
						<hr />
												
						<p><?php $mb->the_field('testimonial_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Testimonial Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e('headline above testimonials', 'Nevada'); ?>)</span></p>
						
						<hr />
						
						<?php $mb->the_field('testimonial_color'); ?>
						<label><?php _e( 'Testimonial Color', 'Nevada' ); ?></label>
						<select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
							<option value=""><?php _e('Select color ...', 'Nevada'); ?></option>
							<option value="white"<?php $mb->the_select_state('white'); ?>><?php _e('white', 'Nevada'); ?></option>
							<option value="dark"<?php $mb->the_select_state('dark'); ?>><?php _e('darken', 'Nevada'); ?></option>
							<option value="alternate"<?php $mb->the_select_state('alternate'); ?>><?php _e('alternating colors', 'Nevada'); ?></option>
						</select>
						
						<hr />
						
						<p><?php $mb->the_field('testimonial_type'); ?>
						<label><?php _e( 'Testimonial Type', 'Nevada' ); ?></label>
						<select name="<?php $mb->the_name(); ?>" class="select_testimonial_type">
							<option value=""><?php _e('Select testimonial type ...', 'Nevada'); ?></option>
							<option value="page"<?php $mb->the_select_state('page'); ?>><?php _e('from an existing page', 'Nevada'); ?></option>
							<option value="own"<?php $mb->the_select_state('own'); ?>><?php _e('create own testimonials', 'Nevada'); ?></option>
						</select></p>										
						
						<div class="well testimonial_type_page t-toggle">
						
							<p><label><?php _e( 'Choose Testimonial Page', 'Nevada' ); ?></label>
							<?php $mb->the_field('home_testimonial_page'); ?>
							<select name="<?php $mb->the_name(); ?>">		                
							
							<?php $pages = query_posts(array(
										'post_type' => 'page',
										'meta_key' => '_wp_page_template',
										'meta_value' => 'template-testimonials.php',
										'meta_compare' => '=='
										));
							
							if ($pages) {
								
								echo '<option value="">-- Choose One --</option>';
								foreach ( $pages as $page ) {
									
															
									//create option
									echo '<option value="'.$page->ID.'" '.$mb->get_the_select_state($page->ID).'>'.$page->post_title.'</option>';
								
								} 		
							} else {
								
								echo '<option value="0">No Pages Available</option>';
								
							} ?>
			
							</select>
							<br /><span class="info badge badge-info"><?php _e('Choose Testimonials from an existing Testimonial Template', 'Nevada'); ?></span></p>
							
                            <div class="btn-group">
						
                                <label><?php _e( 'Autoplay Testimonials' , 'Nevada' ); ?></label>
                                <?php $mb->the_field('testimonials_autoplay'); ?>
                                                
                                <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
                                                
                                <button data-state="testimonials_autoplay_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'yes', 'Nevada' ); ?></button>
                                <input id="testimonials_autoplay_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                
                                <button data-state="testimonials_autoplay_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'no', 'Nevada' ); ?></button>	
                                <input id="testimonials_autoplay_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
                                        
                            </div>
                            
                            <p><?php $mb->the_field('testimonial_time'); ?>
                            <label for="<?php $mb->the_name(); ?>"><?php _e( 'Playtime in miliseconds', 'Nevada' ); ?></label>
                            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                            
						</div>
											
						<div class="well testimonial_type_own t-toggle">			
						
							<?php while($mb->have_fields_and_multi(UT_THEME_INITIAL.'home_testimonials')): ?>
							<?php $mb->the_group_open(); ?>
							 
									<?php $mb->the_field('author'); ?>
									<div class="faq_item_name"><?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new testimonial', 'Nevada' ); }; ?></div>
									<div class="fancy_box faq_item">
																		
                                        <?php $mb->the_field('author_name'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Authorname', 'Nevada' ); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                                        
                                        <?php $mb->the_field('author_image'); ?>
                                        <?php $wpalchemy_media_access->setGroupName('img-auth-testimonial'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            
                                        <img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 75, 75, true ); } ?>" />           
                                        
                                        <p> 
                            
                                            <label><?php _e( 'Author Image', 'Nevada' ); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br>
                                            <span class="info badge badge-info">(<?php _e('Image size should be 50x50', 'Nevada'); ?>)</span>
                                            <?php echo wpa_media_button(__("Upload Avatar" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Avatar" , 'Nevada') , 'image'); ?>
                                                                   
                                        </p>
    
                                        
                                        <p><?php $mb->the_field('author_comment'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Testimonial', 'Nevada' ); ?></label>
                                        <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea></p>
                                        
                                        <p><?php $mb->the_field('author_company'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e( 'Testimonial Authors Company', 'Nevada' ); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                                        
                                        <a href="#" class="dodelete btn btn-danger" style="float:right;"><?php _e( 'Delete', 'Nevada' ); ?></a>
                                        
                                        <div class="clear"></div>
                                    
									</div>
							
							<?php $mb->the_group_close(); ?>
							<?php endwhile; ?>
								
							<div class="clear"></div>
							<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'home_testimonials'; ?> btn btn-success"><?php _e( 'Add new testimonial', 'Nevada' ); ?></a></p>
						
						</div>
													
						</div><!-- end opt pad -->
					
					</div><!-- end testimonial items -->
					
					
					<?php 
					#-----------------------------------------------------------------
					# Clients
					#----------------------------------------------------------------- 
					?>
					
					<div id="home-clients" class="home-clients tab-pane">
					
						<div class="lambda-opttitle">
							<div class="lambda-opttitle-pad">
								<?php _e( 'Client Section', 'Nevada' ); ?>
							</div>
						</div>
						<div class="lambda-settings-pad clearfix">
								
						<div class="btn-group">
						
							<label><?php _e( 'Activate Clients', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_clients'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>

							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_clients_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_clients_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_clients_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_clients_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
						</div>
						
						<hr />						
												
						<p><?php $mb->the_field('client_headline'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Client Headline', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
						<br /><span class="info badge badge-info">(<?php _e('headline above client section', 'Nevada'); ?>)</span></p>
						
						<hr />										
						
						
						<?php $c_layouts = array (  '2column' => array ( 	'name' 		=> __( 'Client - 4 Column', 'Nevada' ),
																'value' 	=> '4',
																'id' 		=> 'client_two_column'),
										'3column' => array ( 	'name' 		=> __( 'Client - 5 Column', 'Nevada' ),
																'value' 	=> '5',
																'id' 		=> 'client_three_column'),						
																); ?>
				
				
						<p><ul class="c_layouts">                       
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Client Column Layout', 'Nevada' ); ?></label>
						<?php foreach ($c_layouts as $i => $c_layout): ?>
							 <?php $mb->the_field(UT_THEME_INITIAL.'home_client_layout'); ?>
								<li>
									<label class="radioimage" for="<?php echo $c_layout['id']; ?>">
										<img src="<?php echo THEME_WEB_ROOT; ?>/lambda/assets/images/<?php echo $c_layout['id']; ?>.png" alt="<?php echo $c_layout['id']; ?>">
									</label>
									<br />
									<input style="margin-right:10px;" type="radio" name="<?php $mb->the_name(); ?>" id="<?php echo $c_layout['id']; ?>" value="<?php echo $c_layout['value']; ?>"<?php $mb->the_radio_state($c_layout['value']); ?>><?php echo $c_layout['name']; ?> 
								</li>
						<?php endforeach; ?>
						</ul></p>         
						
						<hr />
						
						<p><?php $mb->the_field('client_type'); ?>
						<label><?php _e( 'Client Content Type', 'Nevada' ); ?></label>
						<select name="<?php $mb->the_name(); ?>" class="select_client_type">
							<option value=""><?php _e('Select content ...', 'Nevada'); ?></option>
							<option value="page"<?php $mb->the_select_state('page'); ?>><?php _e('from an existing page (Client Template)', 'Nevada'); ?></option>
							<option value="own"<?php $mb->the_select_state('own'); ?>><?php _e('create own client list', 'Nevada'); ?></option>
						</select></p>
						
										
						<div class="well client_type_page c-toggle">
							
							
							<p><?php $mb->the_field('client_load_last'); ?>
							<label for="<?php $mb->the_name(); ?>"><?php _e( 'Load last X client logos', 'Nevada' ); ?></label>
							<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
							</p>
							
							
							<p><label><?php _e( 'Choose Client Page', 'Nevada' ); ?></label>
							<?php $mb->the_field('home_client_page'); ?>
							<select name="<?php $mb->the_name(); ?>">		                
							
							<?php $pages = query_posts(array(
										'post_type' => 'page',
										'meta_key' => '_wp_page_template',
										'meta_value' => 'template-clients.php',
										'meta_compare' => '=='
										));
							
							if ($pages) {
								
								echo '<option value="">-- Choose One --</option>';
								foreach ( $pages as $page ) {
									
															
									//create option
									echo '<option value="'.$page->ID.'" '.$mb->get_the_select_state($page->ID).'>'.$page->post_title.'</option>';
								
								} 		
							} else {
								
								echo '<option value="0">No Pages Available</option>';
								
							} ?>
			
							</select>
							<br /><span class="info badge badge-info"><?php _e('Choose Clients from an existing <br /> Client Template', 'Nevada'); ?></span></p>
						
						</div>
						
						<div class="well client_type_own c-toggle">
						
						<?php $z = 1; while($mb->have_fields_and_multi(UT_THEME_INITIAL.'home_clients')): ?>
						<?php $mb->the_group_open(); ?>
					 
							<?php $mb->the_field('imgurl'); ?>
							<?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
							<div class="one_half <?php echo ($z%2==0)?'last':'';?>">
							<div class="fancy_box image_item client_highlight">
							<p>
							
								<img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
								else { echo aq_resize( $mb->get_the_value(), 220, 120, true ); } ?>" class="slider-n<?php echo $z; ?>" />
								
                                <p> 
                        
                                    <label><?php _e( 'Logo', 'Nevada' ); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br>
                                    <span class="info badge badge-info">(<?php _e('Image size should be 50x50', 'Nevada'); ?>)</span>
                                    <?php echo wpa_media_button(__("Upload Logo" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Logo" , 'Nevada') , 'image'); ?>
                                                           
                                </p>
								
								<p><?php $mb->the_field('url'); ?>
								<label for="<?php $mb->the_name(); ?>"><?php _e( 'Client URL', 'Nevada' ); ?> <span class="optional">(<?php _e( 'optional', 'Nevada' ); ?>)</span></label>
								<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
														
								<p><?php $mb->the_field('title'); ?>
								<label for="<?php $mb->the_name(); ?>"><?php _e( 'Set "alt" (for SEO)', 'Nevada' ); ?> <span class="optional">(<?php _e( 'optional', 'Nevada' ); ?>)</span></label>
								<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
							    
                                <a ref="#" class="dodelete btn btn-danger"><?php _e( 'Remove', 'Nevada' ); ?></a></p>
                                
							</p>
							</div>
							</div>
					
						<?php $z++; $mb->the_group_close(); ?>
						<?php endwhile; ?>
						
						<div class="clear"></div>
						<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'home_clients'; ?> btn btn-success"><?php _e( 'add new tab', 'Nevada' ); ?></a></p>
												
						</div>
													
						</div><!-- end opt pad -->
					
					</div><!-- end client items -->
					
					
					<?php 
					#-----------------------------------------------------------------
					# CTA
					#----------------------------------------------------------------- 
					?>
					
					<div id="home-cta" class="home-cta tab-pane">
					
					<div class="btn-group">
						
							<label><?php _e( 'Activate Call to Action Box', 'Nevada' ); ?></label>
							<?php $mb->the_field('activate_cta'); ?>
								
							<?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>

							<?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>
								
							<button data-state="activate_cta_on" class="btn <?php echo $activestate; ?> radio_active" type="button" value="on"><?php _e( 'show', 'Nevada' ); ?></button>
							<input id="activate_cta_on" type="radio" value="on" name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
							<button data-state="activate_cta_off" class="btn <?php echo $deactivestate; ?> radio_inactive" type="button" value="off"><?php _e( 'hide', 'Nevada' ); ?></button>	
							<input id="activate_cta_off" type="radio" value="off"  name="<?php $mb->the_name(); ?>" style="display:none;" class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
						
					</div>
					
										
					<p><?php $mb->the_field('cta_headline'); ?>
					<label for="<?php $mb->the_name(); ?>"><?php _e( 'CTA Headline', 'Nevada' ); ?></label>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
					<br /><span class="info badge badge-info">(<?php _e('Headline for CTA Field', 'Nevada'); ?>)</span></p>
					
					<p><?php $mb->the_field('cta_buttontext'); ?>
					<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttontext', 'Nevada' ); ?></label>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
					<br /><span class="info badge badge-info">(<?php _e('optional', 'Nevada'); ?>)</span></p>
					
					<p><?php $mb->the_field('cta_buttonlink'); ?>
					<label for="<?php $mb->the_name(); ?>"><?php _e( 'Buttonlink', 'Nevada' ); ?></label>
					<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
					<br /><span class="info badge badge-info">(<?php _e('optional', 'Nevada'); ?>)</span></p>
					
					<p><?php $mb->the_field('cta_content'); ?>
					<label><?php _e( 'Content', 'Nevada' ); ?></label>
					<textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea></p>											
					
					</div>
					
								
					
					<?php 
					#-----------------------------------------------------------------
					# Order Items
					#----------------------------------------------------------------- 
					?>
					
					<div id="home-item-order" class="home-item-order tab-pane">
					
					<div class="lambda-opttitle">
						<div class="lambda-opttitle-pad">
							<?php _e( 'Order the Start Elements', 'Nevada' ); ?>
						</div>
					</div>
					
					<div class="lambda-settings-pad">		
									
						<div id="wpa_loop-nevada_home_items">
							
							<div class="home_item_order simple_ui_box">
								<?php echo(!empty($meta['home_item'][0])) ? $meta['home_item'][0] : 'service'; ?>
								<input type="hidden" name="<?php echo UT_THEME_INITIAL.'metapanel'; ?>[home_item][0]" value="<?php echo(!empty($meta['home_item'][0])) ? $meta['home_item'][0] : 'service'; ?>"/>
							</div>
										
							<div class="home_item_order simple_ui_box">
								<?php echo(!empty($meta['home_item'][1])) ? $meta['home_item'][1] : 'portfolio'; ?>
								<input type="hidden" name="<?php echo UT_THEME_INITIAL.'metapanel'; ?>[home_item][1]" value="<?php echo(!empty($meta['home_item'][1])) ? $meta['home_item'][1] : 'portfolio'; ?>"/>
							</div>
							
							<div class="home_item_order simple_ui_box">
								<?php echo(!empty($meta['home_item'][2])) ? $meta['home_item'][2] : 'blog'; ?>
								<input type="hidden" name="<?php echo UT_THEME_INITIAL.'metapanel'; ?>[home_item][2]" value="<?php echo(!empty($meta['home_item'][2])) ? $meta['home_item'][2] : 'blog'; ?>"/>
							</div>
							
							<div class="home_item_order simple_ui_box">
								<?php echo(!empty($meta['home_item'][3])) ? $meta['home_item'][3] : 'testimonials'; ?>
								<input type="hidden" name="<?php echo UT_THEME_INITIAL.'metapanel'; ?>[home_item][3]" value="<?php echo(!empty($meta['home_item'][3])) ? $meta['home_item'][3] : 'testimonials'; ?>"/>
							</div>
							
							<div class="home_item_order simple_ui_box">
								<?php echo(!empty($meta['home_item'][4])) ? $meta['home_item'][4] : 'clients'; ?>
								<input type="hidden" name="<?php echo UT_THEME_INITIAL.'metapanel'; ?>[home_item][4]" value="<?php echo(!empty($meta['home_item'][4])) ? $meta['home_item'][4] : 'clients'; ?>"/>
							</div>
							
							<div class="home_item_order simple_ui_box">
								<?php echo(!empty($meta['home_item'][5])) ? $meta['home_item'][5] : 'cta'; ?>
								<input type="hidden" name="<?php echo UT_THEME_INITIAL.'metapanel'; ?>[home_item][5]" value="<?php echo(!empty($meta['home_item'][5])) ? $meta['home_item'][5] : 'cta'; ?>"/>
							</div>
							
						</div>
					
					</div><!-- end opt pad -->
					
				</div><!-- vertical-tab-content -->
					
			</div>
		
    </div>
	
	</div><!--Panel content-->
	
</div>


<?php 
#-----------------------------------------------------------------
# Testimonials
#----------------------------------------------------------------- 
?>
<div id="testimonials-settings" class="testimonials-settings tab-pane">
	
	<div class="lambda_overlay"></div>

	<div class="ui-panelcontent">
       
	   <div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Manage Testimonial Template', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">
	   
			   <div class="lambda-opttitle">
					<div class="lambda-opttitle-pad">
						<?php _e( 'Manage Testimonial', 'Nevada' ); ?>
					</div>
			   </div>
			   <div class="lambda-settings-pad">
		
					
					<?php while($mb->have_fields_and_multi(UT_THEME_INITIAL.'testimonial_items')): ?>
					<?php $mb->the_group_open(); ?>
				 
							<?php $mb->the_field('author_name'); ?>
							
                            <div class="testimonial_item_name">
                                <?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new testimonial', 'Nevada' ); }; ?>
                            </div>
							
                            <div class="fancy_box testimonial_item">
							
                                <?php $mb->the_field('author_image'); ?>
                                <?php $wpalchemy_media_access->setGroupName('img-auth-testimonial'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                    
                                <img class="frame" src="<?php if($mb->get_the_value()){ echo aq_resize( $mb->get_the_value(), 75, 75, true ); } ?>" />           
                                
                                <p>                            
    
                                    <img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
                                    else { echo aq_resize( $mb->get_the_value(), 220, 120, true ); } ?>" class="image_box slider-n<?php echo $z; ?>" />
                                    
                                    <label><?php _e( 'Author URL', 'Nevada' ); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br><br>
                                    <?php echo wpa_media_button(__("Upload Avatar" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Avatar" , 'Nevada') , 'image'); ?>
                                                           
                                </p>
                                
                                <p><?php $mb->the_field('author_name'); ?>
                                <label for="<?php $mb->the_name(); ?>"><?php _e( 'Testimonial Author Name', 'Nevada' ); ?></label>
                                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                                
                                <p><label><?php _e( 'Testimonial Comment', 'Nevada' ); ?></label>
                                <?php $mb->the_field('author_comment'); ?>
                                <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75" class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                <br /><span class="info badge badge-info">(<?php _e('This field accepts shortcodes', 'Nevada'); ?>)</span></p>		
                                
                                <p><?php $mb->the_field('author_company'); ?>
                                <label for="<?php $mb->the_name(); ?>"><?php _e( 'Testimonial Authors Company', 'Nevada' ); ?></label>
                                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>	
                                
                                <a href="#" class="dodelete btn red"><?php _e( 'Remove', 'Nevada' ); ?></a>
								
						</div>
				
					<?php $mb->the_group_close(); ?>
					<?php endwhile; ?>
					
					<div class="clear"></div>
					<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'testimonial_items'; ?> btn btn-inverse"><?php _e( 'add new testimonial', 'Nevada' ); ?></a></p>
					
					</div>
					
					<div class="lambda-opttitle">
					<div class="lambda-opttitle-pad">
						<?php _e( 'Additional Content to display beneath the Testimonials', 'Nevada' ); ?>
					</div>
					</div>
					<div class="lambda-settings-pad">
					
					<?php $mb->the_field('testimonails_additional_content'); 
		
					$settings = array( 
						'textarea_rows' => '20',
						'media_buttons' => 'true',
						'tabindex' =>2
					);
			
					$val =  html_entity_decode($mb->get_the_value()); 
					$id = $mb->get_the_name();
					
					wp_editor($val,  $id , $settings );
					
					?>
			 </div>
		  </div>	
	   </div>
	</div>
</div> 



<?php 
#-----------------------------------------------------------------
# Vertical Tabs
#----------------------------------------------------------------- 
?>
<div id="verticaltabs-settings" class="verticaltabs-settings tab-pane">
	
	<div class="lambda_overlay"></div>

	<div class="ui-panelcontent">
	   
	    <div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Manage Service Template', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">
	   
	   
		   <div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Manage Tabs', 'Nevada' ); ?>
				</div>
		   </div>
		   <div class="lambda-settings-pad">
	
				
				<?php while($mb->have_fields_and_multi(UT_THEME_INITIAL.'verticaltabs')): ?>
				<?php $mb->the_group_open(); ?>
			 
						<?php $mb->the_field('tab_name'); ?>
						<div class="testimonial_item_name"><?php if($mb->get_the_value()) { $mb->the_value(); } else { _e( 'new tab', 'Nevada' ); }; ?></div>
										
						<div class="fancy_box testimonial_item">
						
						<p><?php $mb->the_field('tab_name'); ?>
						<label for="<?php $mb->the_name(); ?>"><?php _e( 'Tab Name', 'Nevada' ); ?></label>
						<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
										
						<div class="customEditor">
							<?php $mb->the_field('tab_content'); ?>					
							<div class="wp-editor-tools">
								<div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action( 'media_buttons' ); ?></div>
							</div>
							<textarea class="wysiwyg" rows="10" cols="50" name="<?php $mb->the_name(); ?>"><?php echo wpautop( esc_html($mb->get_the_value()) ); ?></textarea>
	
						</div>
						
						<a href="#" class="dodelete btn red"><?php _e( 'Delete', 'Nevada' ); ?></a>
												
						</div>
			
				<?php $mb->the_group_close(); ?>
				<?php endwhile; ?>
				
				<div class="clear"></div>
				<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'verticaltabs'; ?> btn btn-inverse"><?php _e( 'add new service tab', 'Nevada' ); ?></a></p>
				
			</div>
			</div>
		</div>				
	</div>
</div>    


<?php 
#-----------------------------------------------------------------
# Clients
#----------------------------------------------------------------- 
?>
<div id="client-settings" class="client-settings tab-pane">
	
	<div class="lambda_overlay"></div>

	<div class="ui-panelcontent">
	   
	   <div class="container block">
			
			
			<div class="meta-headline">
	  	
				<h1><?php _e( 'Manage Client Template', 'Nevada' ); ?></h1>
				<div class="clear"></div>
			
		 	</div>
			
					
			<div class="sixteen columns">	   
	   
			<div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Manage Layout', 'Nevada' ); ?>
				</div>
			</div>
			
			<div class="lambda-settings-pad">
			
			
			<?php $c_layouts = array (  '2column' => array ( 	'name' 		=> __( 'Client - 4 Column', 'Nevada' ),
																'value' 	=> '4',
																'id' 		=> 'client_two_column'),
										'3column' => array ( 	'name' 		=> __( 'Client - 5 Column', 'Nevada' ),
																'value' 	=> '5',
																'id' 		=> 'client_three_column')
																); ?>
				
				
			<p><ul class="c_layouts">                       
			<?php foreach ($c_layouts as $i => $c_layout): ?>
				 <?php $mb->the_field(UT_THEME_INITIAL.'client_layout'); ?>
					<li>
						<label class="radioimage" for="<?php echo $c_layout['id']; ?>">
							<img src="<?php echo THEME_WEB_ROOT; ?>/lambda/assets/images/<?php echo $c_layout['id']; ?>.png" alt="<?php echo $c_layout['id']; ?>">
						</label>
						<br />
						<input style="margin-right:10px;" type="radio" name="<?php $mb->the_name(); ?>" id="<?php echo $c_layout['id']; ?>" value="<?php echo $c_layout['value']; ?>"<?php $mb->the_radio_state($c_layout['value']); ?>><?php echo $c_layout['name']; ?> 
					</li>
			<?php endforeach; ?>
			</ul></p>         
			
			</div>
			
			
	
			
		   <div class="lambda-opttitle">
				<div class="lambda-opttitle-pad">
					<?php _e( 'Manage Clients', 'Nevada' ); ?>
				</div>
		   </div>
		   <div class="lambda-settings-pad">	
			
			<span class="info badge badge-info"><?php _e( 'We recommend to use identical logo sizes for each client', 'Nevada' ); ?></span>
			
			<hr />
			
			<?php $z = 1;
			while($mb->have_fields_and_multi(UT_THEME_INITIAL.'client_images')): ?>
			<?php $mb->the_group_open(); ?>  
				
				<?php $mb->the_field('imgurl'); ?>
				<?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						<div class="one_third <?php echo ($z%3==0)?'last':'';?>">
						<div class="fancy_box image_item client_highlight">
						<p>
							
							<img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
							else { echo aq_resize( $mb->get_the_value(), 220, 120, true ); } ?>" class="slider-n<?php echo $z; ?>" />
							
							<p>                            

                                <img src="<?php if(!$mb->get_the_value()){ echo THEME_WEB_ROOT.'/lambda/assets/images/nopic.jpg'; } 
                                else { echo aq_resize( $mb->get_the_value(), 220, 120, true ); } ?>" class="image_box slider-n<?php echo $z; ?>" />
                                
                                <label><?php _e( 'Image URL', 'Nevada' ); ?></label>
                                <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?><br><br>
                                <?php echo wpa_media_button(__("Upload Logo" , 'Nevada') , __("Nevada Files" , 'Nevada'), __("Insert Logo" , 'Nevada') , 'image'); ?>
                                                       
                            </p>
							
							<p><?php $mb->the_field('url'); ?>
							<label for="<?php $mb->the_name(); ?>"><?php _e( 'Client URL', 'Nevada' ); ?> <span class="optional">(<?php _e( 'optional', 'Nevada' ); ?>)</span></label>
							<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
													
							<p><?php $mb->the_field('title'); ?>
							<label for="<?php $mb->the_name(); ?>"><?php _e( 'Set "alt" (for SEO)', 'Nevada' ); ?> <span class="optional">(<?php _e( 'optional', 'Nevada' ); ?>)</span></label>
							<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
							
						</p>
						</div>
						</div>
				<?php $mb->the_group_close(); ?>
				<?php $z++; endwhile; ?>
				
				<div class="clear"></div>
				<p style="margin-bottom:15px; padding-top:5px;">
				<a href="#" class="docopy-<?php echo UT_THEME_INITIAL.'client_images'; ?> btn btn-info" style="float:left;">
					<?php _e( 'Add New Client', 'Nevada' ); ?>
				</a>
				<a href="#" class="dodelete-<?php echo UT_THEME_INITIAL.'client_images'; ?> btn btn-danger" style="float:right;">
					<?php _e( 'Remove All Clients', 'Nevada' ); ?>
				</a>
				</p>
				<div class="clear"></div>		
				
			</div>
		</div>
		</div>			
	</div>
</div>      

<?php endif; ?>
</div><!-- /.tabs -->
</div><!-- /#lambda -->