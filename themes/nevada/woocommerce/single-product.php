<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
get_header('shop');

do_action('woocommerce_before_main_content');

while ( have_posts() ) : the_post(); 
		
	woocommerce_get_template_part( 'content', 'single-product' );

endwhile; 

do_action('woocommerce_after_main_content');

do_action('woocommerce_sidebar');
	
get_footer('shop'); 

?>