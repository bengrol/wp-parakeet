<?php

//define( 'STYLE_WEB_ROOT' , get_stylesheet_directory_uri() );
require_once ( 'widget/widget.php' );
require_once('scpi_functions/ajaxForm.php');
require_once('scpi_functions/certif.php');
require_once('scpi_functions/animation-chart.php');
require_once('scpi_functions/simulation.php');


#-----------------------------------------------------------------
# Header Core Scripts
#-----------------------------------------------------------------
	add_action('init',	function () {

    wp_enqueue_script('jquery-validation', STYLE_WEB_ROOT."/javascripts/jquery.validate.min.js",
      array('jquery' ),'1.16.0', true);
		wp_enqueue_script('scpi-custom', STYLE_WEB_ROOT."/javascripts/scpi.js",array('jquery','jquery-validation' ),null, true);
		wp_enqueue_script('ajax-form', STYLE_WEB_ROOT."/javascripts/ajaxForm.js",array('jquery','jquery-validation' ),'1.0', true);

// pass Ajax Url to script.js
    wp_localize_script('ajax-form', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

		wp_enqueue_style('jquery-style', "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
		wp_enqueue_style('bootstrap-style',
            STYLE_WEB_ROOT."/css/bootstrap.min.css");

	});




add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
    global $post;

    $text = "Cette partie du site est reserve aux membres du club scpi-solution. <br />
 pour obtenir votre mot de passe, veuillez remplir le formualuire de contact ";

    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">

    <label class="pass-label" for="' . $label . '">' . __( "Merci de rentrer le mot de passe:" ) . ' </label>
    <input name="post_password" id="' . $label . '" type="password" style="background: #ffffff; border:1px solid #999; color:#333333; padding:10px;" size="20" />
    <input type="submit" name="Submit" class="button" value="' . esc_attr__( "Valider" ) . '" />
    </form><p style="font-size:14px;margin:0px;">'.$text.'</p>
    ';
    return $o;
}