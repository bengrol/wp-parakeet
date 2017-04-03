<?php


/**
 *  crée la visite virtuelle HD Media
 *  1er parametre -> url de la visite
 *  2em style de rendu
 * 
 *  1- link
 *  2- Iframe
 *  3- Panoramique cliquable
 *  4- Miniature Cliquable
 */
add_shortcode('hdMediaGallery', function ($param) {
    extract(
        shortcode_atts(
            array(
                'url' => '', 
                'style' => 1, 
                'id'=> rand(1, 1000)),
            $param
        )
    );
    
    $rtn ;
    switch ($style) {
        case 1:
            $rtn = hdMediaGetLink($url);
            break;
        case 2:
            $rtn = hdMediaGetIFrame($url);
            break;
        
//        case 3:
//            $rtn = hdMediaGetPanoramique($url, $id);
//            break;
//        case 4:
//            $rtn = hdMediaGetMini($url);
//            break;
        
        default:
            $rtn = hdMediaGetLink($url);
            break;
    }
    
    
    return $rtn;
}

);



function hdMediaGetLink($param){
    return  "<a target='_blank' class='linkvisite360' href='$param' > visite-virtuelle </a>";
}
function hdMediaGetIFrame($param){
    
    return "<div class='embed-responsive embed-responsive-16by9'><iframe src='$param' class='embed-responsive-item' scrolling=no frameborder=0> </iframe><br/></div>";
}


//
//function hdMediaGetPanoramique($param, $id){// not used
//    return "<div class='visite360HD' data-url='$param' data-visiteid='$id' "
//            . "style='background-image:url(http://fr-olivier-gros.hdmedia.fr/360/cbpLcpFBh/prints/photo97586_crop_800.jpg);background-repeat:no- repeat;'>"
//            . "<img class='logoload360' style='position:relative;min-left:240px;top:-10px;cursor:pointer' src='http://www.hdmedia.fr/images/visites/bouton_chargevisite.png'/>"
//            . "</div>";
//}
//function hdMediaGetMini($param){
//    return "";
//}

?>









