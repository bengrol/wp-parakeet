<?php
/**
 * Created by PhpStorm.
 * User: MacBoook
 * Date: 28/03/2017
 * Time: 22:48
 */

function scpi_animation_chart(){
    $datas = array(
        array('label'=>'RENTABILITE DE VOTRE EPARGNE', 'pourcent'=>'90'),
        array('label'=>'SECURITE DE VOTRE EPARGNE', 'pourcent'=>'95'),
        array('label'=>'ZERO DE SOUCIS DE GESTION LOCATIVE DE VOTRE EPARGNE', 'pourcent'=>'100'),
        array('label'=>'DISPONIBILITE DE VOTRE EPARGNE', 'pourcent'=>'70')
    );

    $title = "<h4>titre section chart</h4>";
    $html = "<section id='chart-animation'>".$title."<ul>";

    foreach ($datas as $data){
        $html .= "<li><span class='chart-title'>".$data['label']."</span ><span  class='chart-container'><span class='chart-amount' data-amount='".$data['pourcent']."'>".$data['pourcent']."%</span></span></li>";
    }

    return $html .= "</ul></section>";
}