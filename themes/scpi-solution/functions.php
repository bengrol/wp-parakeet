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



wp_dequeue_script( 'swfobject' );



		wp_enqueue_style('jquery-style', "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
		wp_enqueue_style('bootstrap-style',
            STYLE_WEB_ROOT."/css/bootstrap.min.css");

	});




add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});


function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "To view this protected post, enter the password below:" ) . '
    <label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

function mailchimp_subsribe(){

    $html= '<link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">';
    $html .='<style type="text/css">#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }</style>';
    $html .='<div id="mc_embed_signup">';
    $html .='<form action="//scpi-solution.us15.list-manage.com/subscribe/post?u=c05a14ddbde79a918a8c80712&amp;id=a5bce16df1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>';
    $html .='<div id="mc_embed_signup_scroll">';
    $html .='<label for="mce-EMAIL">Restez connecté à notre newsletter mensuelle </label>';
    $html .='<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>';
    $html .='<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c05a14ddbde79a918a8c80712_a5bce16df1" tabindex="-1" value=""></div>';
    $html .='<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>';
    $html .='</div></form></div>';

    return $html;


}