<?php

//define( 'STYLE_WEB_ROOT' , get_stylesheet_directory_uri() );
require_once ( 'widget/widget.php' );


#-----------------------------------------------------------------
# Header Core Scripts
#-----------------------------------------------------------------
	add_action('init',	function () {

		wp_enqueue_script('jquery-ui', "https://code.jquery.com/ui/1.12.1/jquery-ui.js",array('jquery' ),'1.12.1', true);
		wp_enqueue_script('jquery-validation', STYLE_WEB_ROOT."/javascripts/jquery.validate.min.js",array('jquery' ),'1.16.0', true);
		wp_enqueue_script('scpi-custom', STYLE_WEB_ROOT."/javascripts/scpi.js",array('jquery', ),null, true);
		wp_enqueue_style('jquery-style', "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");

	});




add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});