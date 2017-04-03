<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<title><?php  wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
   
<!--   facebook open graph-->
    <meta property="og:url" content="http://beta-site-3.fr/artemise/">
    <meta property="og:title" content="<?php  wp_title( '|', true, 'right' ); bloginfo('name'); ?>">
    <meta property="og:description" content="<?= bloginfo('description');?>">
    <meta property="og:site_name" content="<?= bloginfo('name');?>">

    <meta property="og:image" content="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); 
    echo $img[0]; ?>">
    <meta property="og:type" content="hotel">
      	<?php wp_head(); ?>
   
</head>

<body <?php body_class(); ?> id="content">
	
    <div id="loaderDiv" class="ijn" ></div>
    <header id="main-header">
        <div id="logo-container">
            <a href="<?php bloginfo('url'); ?>">
                <img src="<?php echo get_template_directory_uri() ?>/images/logo-md.png" id="img-logo">
            </a>
        </div>

        <div id="menu-header" class="">
            <span class="glyphicon glyphicon-chevron-up icon-rotating" aria-hidden="true"></span>
            <span id="menu-header-sp">MENU</span>

        </div>

        <div class="btn-group-vertical btn-group-lg" role="group" id="main-nav-container" style='display:block'>
            <nav id="main-nav">
                <?php
                $args = array(
                    'theme_location' => 'primary'
                );
                wp_nav_menu($args);
                ?>

                
            </nav>

        </div>
        
                <?php
                $args = array(
                    'theme_location' => 'lang'
                );
                wp_nav_menu($args);
                ?>
        
        <div class="btn-grp-offres" >
            
         <a href="<?=get_permalink( 604); ?>" class="btn-offre border-bottom-radius">
            <i class="fa fa-bookmark-o"></i><?php _e('visite 360', 'artemise'); ?></a>   
        </div>
                    
         
        <button class="btn-resa  resa-toogle" id="resa-responsive" style=""><i class="fa fa-calendar "></i><span><?php _e('Reserver', 'artemise'); ?></span></button>
    </header>
                
            

    <aside>

        <div class="btn-grp-offres" role="group" >
                <a href="<?= esc_url( home_url( '/nos-offres/' ) ) ?>" class="btn-offre border-top-radius"><i class="fa fa-heart "></i><?php _e('offres Speciales', 'artemise'); ?></a>
                <a href="<?=get_permalink( 563); ?>" class="btn-event"><i class="fa fa-star "></i><?php _e('Actualités', 'artemise'); ?></a>
                <button id="bt-resa-aside"  class="btn-resa border-bottom-radius resa-toogle"><i class="fa fa-calendar "></i><?php _e('Reserver', 'artemise'); ?></button>

        </div>

        <?php  get_template_part('partial', 'reservation'); ?>
    </aside>

     

<div id="main" class="site-main ">

    