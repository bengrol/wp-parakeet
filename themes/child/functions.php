<?php
include_once ('widget/widget.php');


add_action( 'widgets_init', function(){
  register_widget( 'My_Widget' );
});


add_action( 'admin_enqueue_scripts', function () {
  wp_enqueue_script('custom_widget_js', get_stylesheet_directory_uri().'/widget/js/js_widget.js', ['jquery'],null, true);
} );

