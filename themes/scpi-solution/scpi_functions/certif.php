<?php
/**
 * Created by PhpStorm.
 * User: MacBoook
 * Date: 23/03/2017
 * Time: 23:34
 */



function __scpi_get_certif(){
    $certif_list = ['amf.jpg','amlin.jpg','anacofi.jpg', 'anacofi-cif.jpg','cnil.jpg', 'orias.jpg'];
    $path = STYLE_WEB_ROOT.'/assets/logos-certif/';
    $html = '<ul>';
    foreach ($certif_list as $certif){
        $html .= '<li><img src="'.$path.$certif.'"></li>';
    }
    $html .= '</ul>';

    print $html;

}