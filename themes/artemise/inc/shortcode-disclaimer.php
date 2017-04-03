<?php

add_shortcode('artemise_disclaimer', 'artemise_disclaimer_shortcode');
 
function artemise_disclaimer_shortcode($param, $content = "") {
    extract(
        shortcode_atts(
            array(
                'backgroundImage' => get_template_directory_uri() . '/images/img-bandeau-ch.jpg',
                'titre'=> 'default',
                'contenu' =>''),
            $param
        )
    );
    //$style = "background-image: url(".$param['url']."\")";
    $style = "style = 'background-image: url(\" $backgroundImage \")'";
    
   
    $l1 = "<section id='bandeau-bg-fixe'  $style >  <div class='col-lg-offset-3 col-lg-8'>";
    $l1 .= $content."</div></section>";
    
    return $l1;
}