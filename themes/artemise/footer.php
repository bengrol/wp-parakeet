</div><!-- #main -->
</div>

    <footer  class="civilite-footer row" role="contentinfo" id="footer-sec">
        
        <div id="footer-row" class="">
            
                <div class="col-md-3 col-sm-3 hidden-xs">
                    <img src="<?php echo get_template_directory_uri()?>/images/logo-sm.png" class="img-pt-logo">
                    <a target="_blank" href="http://www.chateauxhotels.com/L-Artemise-3448"> 
                        <img class="img-pt-logo" src="<?php echo get_template_directory_uri()?>/images/logohotels.png" >
                    </a> 
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <p>Chemin de la Lauze - 30700 Uzès</p>    
                    <p>Hebergement - Tél : +33 (0)4 66 03 13 81</p>    
                    <p>Restaurant - Tél : +33 (0)4 66 63 94 14</p>    
                    <p><a href="http://www.lartemise.com" target="_blank">www.lartemise.com</a>  --  <a href="https://www.facebook.com/leschambresdelartemise"><i class="fa fa-facebook-official fa-2x"></i></a></p>       
                    
                    
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    
                        <?php
                        $args = array(
                            'theme_location' => 'footer',
                            'container' => false,
                            'menu_class'      => 'link-footer',
                            
                        );
                        wp_nav_menu($args);
                        ?>
                    
                </div>
                
                
            
        </div>
        
        
        
    </footer> 


<?php wp_footer(); ?>

 
  
  

</body>
</html>