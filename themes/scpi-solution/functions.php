<?php

//define( 'STYLE_WEB_ROOT' , get_stylesheet_directory_uri() );
require_once ( 'widget/widget.php' );
require_once('scpi_functions/ajaxForm.php');


#-----------------------------------------------------------------
# Header Core Scripts
#-----------------------------------------------------------------
	add_action('init',	function () {


		wp_enqueue_script('scpi-custom', STYLE_WEB_ROOT."/javascripts/scpi.js",array('jquery', ),null, true);
		wp_enqueue_script('ajax-form', STYLE_WEB_ROOT."/javascripts/ajaxForm.js",array('jquery', ),'1.0', true);

// pass Ajax Url to script.js
    wp_localize_script('ajax-form', 'ajaxurl', admin_url( 'admin-ajax.php' ) );


		wp_enqueue_script('jquery-validation', STYLE_WEB_ROOT."/javascripts/jquery.validate.min.js",
            array('jquery' ),'1.16.0', true);
		wp_enqueue_script('scpi-custom', STYLE_WEB_ROOT."/javascripts/scpi.js",
            array('jquery', ),null, true);



		wp_enqueue_style('jquery-style', "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
		wp_enqueue_style('bootstrap-style',
            STYLE_WEB_ROOT."/css/bootstrap.min.css");

	});




add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});


