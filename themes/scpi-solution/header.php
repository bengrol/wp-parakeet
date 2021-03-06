<?php
require_once ( get_template_directory()  . '/functions/theme-mailer.php' );

global $wpdb;
$theme_options = get_option('option_tree');?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N652KFX');</script>
<!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <title><?php
        // Detect Yoast SEO Plugin
        if (defined('WPSEO_VERSION')) {
            wp_title('');
        } else {
            /*
             * Print the <title> tag based on what is being viewed.
             */
            global $page, $paged;

            wp_title( '|', true, 'right' );

            // Add the blog name.
            bloginfo( 'name' );

            // Add the blog description for the home/front page.
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
                echo " | $site_description";

            // Add a page number if necessary:
            if ( $paged >= 2 || $page >= 2 )
                echo ' | ' . sprintf( __( 'Page %s', 'Nevada' ), max( $paged, $page ) );
        }
        ?>
    </title>


    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo THEME_WEB_ROOT; ?>/css/ie8.css" media="screen" />
    <![endif]-->

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->


    <!-- Mobile Specific Metas
    ================================================== -->

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Favicons
    ================================================== -->

    <link rel="shortcut icon" href="<?php echo get_option_tree('favicon'); ?>">

    <link rel="apple-touch-icon" href="<?php echo get_option_tree('apple_touch_icon_small'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_option_tree('apple_touch_icon_mid'); ?>" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_option_tree('apple_touch_icon'); ?>" />

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php

    // enqueue threaded comments support.
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Load head elements
    wp_head(); ?>

    <?php
    #-----------------------------------------------------------------
    # Dynamic CSS
    #-----------------------------------------------------------------
    ?>
    <style type="text/css">

        <?php customBackground(); 			// located in theme-layout-functions.php ?>
        <?php customSliderBackground(); 	// located in theme-layout-functions.php ?>
        <?php customWrap(); 				// located in theme-layout-functions.php ?>

    </style>

</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N652KFX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- to top button -->
<div id="toTop">Go to Top</div>
<!-- end to top button -->

<?php
#-----------------------------------------------------------------
# Supersized
#-----------------------------------------------------------------
$slides = lambda_return_meta('page');

//can be overwritten by metapanel
$default_bgslider = $theme_options['default_backgroundslider'];
$backgroundtype = $theme_options['background_type'];

//meta panel settings to overwrite default option tree settings
$sitelayout = get_option_tree('sitelayout');
$sitelayout = (isset($slides['sitelayout'])) ? $slides['sitelayout'] : $sitelayout;
$backgroundtype = (isset($slides['background_type'])) ? $slides['background_type'] : $backgroundtype;
$default_bgslider = (isset($slides['default_backgroundslider'])) ? $slides['default_backgroundslider'] : $default_bgslider;

if( isset($default_bgslider) ) {

    if( isset($default_bgslider) && ($backgroundtype == 'default_backgroundslider' ) && ($sitelayout == 'boxed') ) {

        $sliderinfo = explode('_', $default_bgslider);
        $slides['main_slider'] = $default_bgslider;

        $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";
        $supersized = $wpdb->get_var("SELECT slidertype FROM $table_lambda_sliders WHERE id = $sliderinfo[1]");

    }

    if(isset($supersized) && $supersized == 'supersized')
        lambda_main_slider($slides); // this function can be found in theme-functions.php around line 198

} ?>


<div id="wrap" class="container clearfix" data-role="page">

    <?php

    #-----------------------------------------------------------------
    # Plugin Notification
    #-----------------------------------------------------------------
    if(lambda_is_plugin_active('option-tree/index.php')) {
        echo '<div class="alert red">'.__('Option Tree Plugin has been detected! Please deactivate this Plugin to prevent themecrashes and failures!', 'Nevada' ).'</div>';
    }
    if(lambda_is_plugin_active('soundcloud-shortcode/soundcloud-shortcode.php')) {
        echo '<div class="alert red">'.__('Soundcloud Plugin has been detected! Please deactivate this Plugin to prevent themecrashes and failures!', 'Nevada' ).'</div>';
    }

    ?>


    <div class="container">
        <div id="nevada-small-cart">
            <?php
            if(lambda_is_plugin_active('woocommerce/woocommerce.php')) {
                woocommerce_get_template( 'cart/small-cart.php' );
            }
            ?>
        </div>
    </div>
    <div class="scpi-header">
        <header id="header" class="fluid clearfix " data-role="header">
            <div class="container">



                <?php
                // Build the logo or text
                if (get_option_tree('textorlogo') == 'Logo') {

                    $lambda_logo  = '<div id="logo">
								<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'"><img id="sitelogo" src="'.get_option_tree('header_logo').'"></a>
							</div>';
                } else {
                    $lambda_logo  = '<div id="logo"><h1>
								<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a>
							</h1></div>';
                }
                echo apply_filters ( 'child_logo' , $lambda_logo);
                ?>


                <?php $hrightmargin = (isset($theme_options['h_right_margin']) && !empty($theme_options['h_right_margin'])) ? $theme_options['h_right_margin'] : '0'; ?>

                <div class="h-right" style="margin-top:<?php echo $hrightmargin; ?>px">

                    <!-- Tagline -->
                    <?php if(isset($theme_options['top_header_tagline'])) : ?>

                        <span class="top-header-tagline">
                        <?php echo stripslashes($theme_options['top_header_tagline']); ?>
                    </span><!-- Top Header Tagline -->

                    <?php endif; ?>


                    <!-- Social Icons -->

                    <?php if (is_active_sidebar('header-widget-area')) :
                        dynamic_sidebar('header-widget-area');
                    endif;?>

                    <!-- /Social Icons -->




                </div>
                <div class="contact-us-wrapper">
			<span class="top-header-tagline">
				<a href="/nous-contacter"><img id="picto-phone" src="<?=STYLE_WEB_ROOT?>/assets/contact-mail.png" />Contacter nos experts</a>
			</span>
                    <span class="top-header-tagline">
				<a href="/simulation"><img id="picto-phone" src="<?=STYLE_WEB_ROOT?>/assets/activity-32.png" />Simulation</a>
			</span>
                </div>

            </div>

        </header><!--/#header-->

        <div class="clear"></div>

        <div class="nav-wrap">
            <div class="container">
                <?php
                //Navigation

                //main navigation
                wp_nav_menu( array( 'container' 		=> 'nav',
                        'container_id' 		=> 'navigation',
                        'theme_location' 	=> 'primary-menu',
                        'fallback_cb' 		=> 'default_menu',
                        'menu_class'      	=> 'menu clearfix',
                        'container_class' 	=> 'clearfix',
                        'walker' 			=> new lambda_walker())
                ); ?>

                <?php if ( has_nav_menu( 'mobile-menu' ) ) {

                    echo '<div class="mm-trigger">'.get_bloginfo('name').'<button class="mm-button"></button></div>';

                    wp_nav_menu( array( 'theme_location' => 'mobile-menu',
                        'container_id' => 'mobile-menu',
                        'container' => 'nav',
                        'menu_class' => 'mm-menu',
                        'depth' => 2 ) );

                } ?>


            </div>

        </div>
    </div>
    <div class="clear fix-menu-clear"></div>