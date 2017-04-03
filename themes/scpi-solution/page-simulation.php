<?php
//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){
    global $response;
    if($type == "success") {
        $response = "<div class='success'>{$message}</div>";

    }
    else {
        $response = "<div class='error'>{$message}</div>";
    }

}


if (isset($_POST['submitted'])  && $_POST['submitted']){

    //response messages
    $not_human       = "Human verification incorrect.";
    $missing_content = "Please supply all information.";
    $email_invalid   = "Adresse mail invalide.";
    $message_unsent  = "Le message n'a pas été envoyé, merci de réessayer.";
    $message_sent    = "Merci ! Votre message a bien été envoyé.";

//user posted variables
    $simulationValues = [];
    if(isset($_POST) && $_POST['simualtion']){
        foreach($_POST['simualtion'] as $k => $v){
            $simulationValues[$k] = esc_attr($v);
        }
    }



//php mailer variables
    $Bcc = get_option('admin_email');
    $user_info = get_userdata(3);
    $to = $user_info->user_email;

    $subject = "Demande de simulation de  ".get_bloginfo('name');
    $headers = 'From: '. $simulationValues['message_email'] . "\r\n" .
        'Bcc:'.$Bcc."\r\n" .
        'Reply-To: ' . $simulationValues['message_email'] . "\r\n";

    $corp_du_message = "Mr/Mm ".$simulationValues['message_name']." ".$simulationValues['message_firstname']."\n".
        "souhaite etre recontacté(e) pour une simulation sur la base des éléments suivant : \n".
        "\n\n".
        "Investissement : \n".
        "Montant : ".$simulationValues['montant']." euros \n".
        "Moyen   : ".$simulationValues['moyen_invest']." \n".
        "Durée   : ".$simulationValues['duree']." an(s) \n".
        "\n\n".
        "Sa situtation est la suivante : \n".
        "Relation : ".$simulationValues['situation_fam']." \n".
        "Nombre de part fiscales : ".$simulationValues['nb_part_fiscales']." \n".
        "Revenu annuel: ".$simulationValues['revenu_foyer']. " euros/an".
        "\n\n".
        "Ses coordonnées : \n".
        " Telephone : ".$simulationValues['message_phone'].
        " Mail : ".$simulationValues['message_email'];

    //validate email
    if(!filter_var($simulationValues['message_email'], FILTER_VALIDATE_EMAIL)){
        my_contact_form_generate_response("error", $email_invalid);
    } else {
        //validate presence of name and message
        if(empty($simulationValues['message_name']) ){
            my_contact_form_generate_response("error", $missing_content);
        }
        else {
            $sent = wp_mail($to, $subject, strip_tags($corp_du_message), $headers);
            if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
            else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
        }
    }



}






?>

<?php get_header(); ?>

    <div id="primary" class="site-content container">
        <div id="content" role="main" class="fluid">

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="entry-header">
                        <h1 class="entry-title"><?php //the_title(); ?> Votre Simulation gratuite</h1>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>

                            <?php echo $response; ?>

                            <form action="<?php the_permalink(); ?>" method="post" id="simulation-form">
                                <div id="respond">

                                    <div class="panel-wrapper active panel-1">
                                        <h3 class="question-panel-header">Vos informations</h3>
                                        <div class="question-panel ">

                                            <?php print scpi_third_panel_content($simulationValues); ?>


                                                <button class="valider btn btn-default" disabled="true" data-target="2">
                                                    valider
                                                </button>

                                        </div>
                                    </div>

                                    <div class="panel-wrapper not-active panel-2">
                                        <h3 class="question-panel-header">Montant & moyen </h3>
                                        <div class="question-panel ">

                                            <?php print scpi_second_panel_content($simulationValues); ?>

                                            <button class="valider  btn btn-default" disabled="true" data-target="3">valider</button>
                                        </div>
                                    </div>

                                    <div class="panel-wrapper not-active panel-3">
                                        <h3 class="question-panel-header">Votre situation</h3>
                                        <div class="question-panel">

                                            <?php print  scpi_first_panel_content($simulationValues); ?>


                                            <div class="col-md-12 ligne-form-simulation">
                                                <button class="btn btn-default btn-lg send-simul" form="simulation-form" type="submit">
                                                    Recevoir Ma Simulation GRATUITE</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                    </div><!-- .entry-content -->

                </article><!-- #post -->

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>