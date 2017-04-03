<?php
?>


<nav id="menu-responsive">
    <a href="<?php bloginfo( 'url'); ?>">
        <img src="<?php echo get_template_directory_uri()?>/images/logo-md.png" id="img-logo-resp">
    </a>
    <?php
    $args = array(
        'theme_location' => 'primary', 
        'menu_id'         => 'menu-responsive-wrap'
    );
    wp_nav_menu($args);

    $args = array(
        'theme_location' => 'lang',
        'menu_id'         => 'menu-lang-responsive-wrap'
    );
    wp_nav_menu($args);
?>
    
    
    
</nav>


            
            
            