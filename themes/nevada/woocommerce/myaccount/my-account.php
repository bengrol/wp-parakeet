<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices(); ?>

<div class="full-width last entry-content clearfix">
    <p class="myaccount_user">
        <?php
        printf(
            __( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
            $current_user->display_name,
            wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )
        );
    
        printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
            wc_customer_edit_account_url()
        );
        ?>
    </p>
</div>

<?php do_action('woocommerce_before_my_account'); ?>

<?php if ( $downloads = WC()->customer->get_downloadable_products() ) : ?>
<div class="full-width last entry-content clearfix">
    <h3 class="home-title"><span><?php _e('My Downloads', 'woocommerce'); ?></span></h3>
    <?php wc_get_template( 'myaccount/my-downloads.php' ); ?>
</div>
<?php endif; ?>

<div class="full-width last entry-content clearfix">
    <h3 class="home-title"><span><?php _e('Recent Orders', 'woocommerce'); ?></span></h3>
    <?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
</div>

<div class="full-width last entry-content clearfix">
    <h3 class="home-title"><span><?php _e('My Address', 'woocommerce'); ?></span></h3>
    <p class="myaccount_address"><?php _e('The following addresses will be used on the checkout page by default.', 'woocommerce'); ?></p>
    <?php wc_get_template( 'myaccount/my-address.php' ); ?>
</div>

<?php do_action('woocommerce_after_my_account');