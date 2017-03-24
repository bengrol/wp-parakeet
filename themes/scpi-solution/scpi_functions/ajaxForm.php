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
  $to = get_option('admin_email');
  $subject = "Un contact du formulaire rapide ".get_bloginfo('name');
  $headers = 'From: '. $data['mail'] . "\r\n" .
    'Reply-To: ' . $data['mail'] . "\r\n";

//  $sent = wp_mail($to, $subject, strip_tags($message), $headers);


//  if($sent){
//    return 'Votre mail a bien été envoyé';
//  }
  return 'un pb est survenu lors de l\'envoi de votre mail FAKE'.$data['mail'];
}

function scpi_form_content() {

  $champs = scpi_form_listinput();


  $html =" <form id='scpiajaxform'>";

  foreach ($champs as $champ){
    if('textarea' === $champ['type']){
      $html .= vsprintf("<label >%3\$s</label><textarea rows=\"4\" cols=\"10\" name='%2\$s'></textarea>", $champ );
    }
    else{
      $html .= vsprintf("<label >%3\$s</label><input name='%2\$s' type='%1\$s'  placeholder='%3\$s'/>", $champ );
    }

  }

  $html .= '<input id="scpiajaxformbutton" type="submit" value="Envoyer" /> </form>';

return $html;
}


function scpi_form_listinput(){
  return array(
    array('type'=>'text', 'name'=>'first_name', 'label'=>'Prenom', ),
    array('type'=>'text', 'name'=>'last_name', 'label'=>'Nom' ),
    array('type'=>'email', 'name'=>'mail', 'label'=>'mail' , 'option'=>'required'),
    array('type'=>'tel', 'name'=>'tel', 'label'=>'téléphone' ),
    array('type'=>'text', 'name'=>'zip_code', 'label'=>'code postal' ),
    array('type'=>'date', 'name'=>'date_naissance', 'label'=>'date de naissance' ),
    array('type'=>'text', 'name'=>'situation', 'label'=>'situation familiale' ),
    array('type'=>'text', 'name'=>'montant', 'label'=>'montant investissement' ),
    array('type'=>'text', 'name'=>'obj', 'label'=>'objectif' ),
    array('type'=>'textarea', 'name'=>'renom', 'label'=>'Comment nous avez vous connu ?' ),
  );

}