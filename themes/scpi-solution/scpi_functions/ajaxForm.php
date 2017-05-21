<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 24/03/17
 * Time: 10:33
 */

add_action( 'wp_ajax_scpi_action', 'scpi_ajax_function' );
add_action( 'wp_ajax_nopriv_scpi_action', 'scpi_ajax_function' );

function scpi_ajax_function() {
  $submitted_input = ( json_decode(str_replace("\\","",$_POST['ajax_param']),true));
  echo scpi_ajax_sendmail($submitted_input);
  die();
}



function scpi_ajax_sendmail($data){

    $Bcc = get_option('admin_email');
    $user_info = get_userdata(3);
    $to = $user_info->user_email;


  $subject = "Un contact du formulaire rapide ".get_bloginfo('name');
  $data['mail'] = str_replace("%40","@",$data['mail']);

  $messageRetour = "";


    if(filter_var($data['mail'], FILTER_VALIDATE_EMAIL)){

        $headers = 'From: '. $data['mail'] . "\r\n" .
            'Bcc:'.$Bcc."\r\n" .
            'Reply-To: ' . $data['mail'] . "\r\n";


        $message = scpi_create_body($data);
        $sent = wp_mail($to, $subject, strip_tags($message), $headers);
        $messageRetour = 'un pb est survenu lors de l\'envoi de votre mail';

        if($sent){
            $messageRetour = 'Votre mail a bien été envoyé';
        }
    }
    return $messageRetour;
}

function scpi_form_content($title_content = false) {

    if(!$title_content ){
        $title_content_list = array('contactez nos experts',
            'besoin d’un conseil, plus d’informations ? contactez nous',
            'vous souhaitez souscrire', 'profitez de notre offre');
        $title_content = $title_content_list[rand(0,3)];
    }

    $champs = scpi_form_listinput();
    $title = "<h3 class='scpiajaxformwidget'>".$title_content."</h3>";

  $html =  $title."<div id=\"messageBox\"></div><form id='scpiajaxform'>";

  foreach ($champs as $champ){
    if('textarea' === $champ['type']){
      $html .= vsprintf("<label >%3\$s</label><textarea rows=\"4\" cols=\"10\" name='%2\$s'></textarea>", $champ );
    }elseif ('select'=== $champ['type']){

        $options="";
        foreach ($champ['options'] as $option){
            $options .= vsprintf("<option value='%1\$s' >%1\$s</option>", $option );
        }

        $html .= "<div ><label >".$champ['label']."</label><select >".$options."</select></div>";

    }
    else{
      $html .= vsprintf("<label >%3\$s</label><input name='%2\$s' type='%1\$s'  placeholder='%4\$s'/>", $champ );
    }

  }

  $html .= '<input id="scpiajaxformbutton" type="submit" value="Envoyer" /> </form>';

return $html;
}


function scpi_form_listinput(){
  return array(
    array('type'=>'text', 'name'=>'first_name', 'label'=>'Prenom',  'placeholder'=>'Prenom'),
    array('type'=>'text', 'name'=>'last_name', 'label'=>'Nom',  'placeholder'=>'Nom' ),
    array('type'=>'email', 'name'=>'mail', 'label'=>'mail' , 'placeholder'=>'mail'),
    array('type'=>'tel', 'name'=>'tel', 'label'=>'téléphone',  'placeholder'=>'téléphone' ),
    array('type'=>'text', 'name'=>'zip_code', 'label'=>'code postal' ,  'placeholder'=>'code postal'),
    array('type'=>'text', 'name'=>'date_naissance', 'label'=>'date de naissance',  'placeholder'=>'jour/mois/année' ),
    array('type'=>'select', 'name'=>'situation', 'label'=>'situation familiale',
        'options'=>array("célibataire","concubinage","divorcé","veuf", "marié", "pacs") ),
    array('type'=>'select', 'name'=>'montant', 'label'=>'montant investissement',
      'options'=>array("inférieur à 50 000", "50 000 à 100 000 euros", "100 000 à 150 000 euros", "plus de 150 000 euros") ),
    array('type'=>'select', 'name'=>'obj', 'label'=>'objectif',
        'options'=>array("optimiser ma fiscalité", "création de revenu", "préparer ma retraite", "préparer ma succession") ),
    array('type'=>'select', 'name'=>'renom', 'label'=>'Comment nous avez-vous connu ?',
        'options'=>array('...','moteur de recherche', 'article de presse', 'télévision', 'recommandation', 'autres')),
    array('type'=>'textarea', 'name'=>'message', 'label'=>'Message' ),
  );

}

function scpi_create_body($data){
    $body = " Prise de contact formulaire rapide \n\n ";

    $list_input = array(
        'first_name'=>'Prenom',
        'last_name' =>'Nom',
        'mail'=>'mail',
        'tel'=>'téléphone',
        'zip_code'=>'code postal',
        'date_naissance'=>'date de naissance',
        'situation'=>'situation familiale',
        'montant'=>'montant investissement',
        'obj'=>'objectif',
        'renom'=>'Comment nous avez-vous connu ?',
        'message'=>'Message'
        );


    foreach ($data as $k => $row){
        $label =  $list_input[$k];
        $row = str_replace(' ', '', $row);
        $row = urldecode( $row);

        $body .= "- ".$label." :  ".html_entity_decode($row)."\n";
    }


    return $body;

}

function scpi_form_shortcode( $arg ){
    $title_content = shortcode_atts( array(
        'title' => false
    ), $arg );
    return scpi_form_content($title_content['title']);
}
add_shortcode( 'scpi_ajax_form', 'scpi_form_shortcode' );
