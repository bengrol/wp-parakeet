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
$to = get_option('admin_email');
$subject = "Vous avez recu une demande de simulatin de  ".get_bloginfo('name');
$headers = 'From: '. $simulationValues['message_email'] . "\r\n" .
    'Reply-To: ' . $simulationValues['message_email'] . "\r\n";


if(!$simulationValues['message_human'] == 0){
    if($simulationValues['message_human'] != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {

        //validate email
        if(!filter_var($simulationValues['message_email'], FILTER_VALIDATE_EMAIL))
            my_contact_form_generate_response("error", $email_invalid);
        else //email is valid
        {
            //validate presence of name and message
            if(empty($simulationValues['message_name']) || empty($simulationValues['message_text'])){
                my_contact_form_generate_response("error", $missing_content);
            }
            else
            {
                $sent = wp_mail($to, $subject, strip_tags($simulationValues['message_text']), $headers);
                if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
                else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent

            }
        }


    }
}
else if (isset($_POST['submitted'])  && $_POST['submitted']) my_contact_form_generate_response("error", $missing_content);


?>

<?php get_header(); ?>

    <div id="primary" class="site-content container">
        <div id="content" role="main" class="fluid">

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php //the_content(); ?>

                            <?php echo $response; ?>

                            <form action="<?php the_permalink(); ?>" method="post" id="simulation-form">
                                <div id="respond">

                                    <div class="panel-wrapper active panel-1">
                                        <h3 class="question-panel-header">Vos informations</h3>
                                        <div class="question-panel ">
                                            <div class="col-md-6 form-group">
                                                <label for="simualtion[message_name]">Nom <span>*</span> </label>
                                                <input type="text" name="simualtion[message_name]" required
                                                       minlength="3"
                                                       value="<?= $simulationValues['message_name'] ?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="simualtion[message_firstname]">Prenom</label>
                                                <input type="text" name="simualtion[message_firstname]" minlength="3"
                                                       value="<?= $simulationValues['message_firstname'] ?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="simualtion[message_phone]">Téléphone <span>*</span></label>
                                                <input type="text" name="simualtion[message_phone]" required
                                                       minlength="10"
                                                       value="<?= $simulationValues['message_phone'] ?>">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="simualtion[message_email]">Email <span>*</span></label>
                                                <input type="email" required name="simualtion[message_email]"
                                                       value="<?= $simulationValues['message_email']; ?>">
                                            </div>

                                                <button class="valider btn btn-default" disabled="true" data-target="2">
                                                    valider
                                                </button>

                                        </div>
                                    </div>

                                    <div class="panel-wrapper active panel-2">
                                        <h3 class="question-panel-header">Montant & moyen </h3>
                                        <div class="question-panel ">

                                            <div class="col-md-12">
                                                <h5 for="simualtion[montant]">Montant ou effort d'épargne mensuel <span>*</span></h5>
                                                    <input required type="number" min="10000" value="<?= $simulationValues['montant'] ?>"
                                                        name="simualtion[montant]" />

                                            </div>
                                            <div class="col-md-12 ">
                                                <h5> Moyen d'investissement </h5>
                                                <div class="form-group">
                                                    <div>
                                                        <label for="simualtion[moyen_cash]">cash <span>*</span></label>
                                                        <input required type="radio" name="simualtion[moyen_cash]" />
                                                    </div>
                                                    <div>
                                                        <label for="simualtion[moyen_credit]">credit <span>*</span></label>
                                                        <input required type="radio" name="simualtion[moyen_credit]" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12  ">
                                                <label for="simualtion[duree]">durée <span>*</span></label><br>
                                                <input required type="number" value="<?= $simulationValues['duree'] ?>" name="simualtion[duree]" />
                                            </div>

                                            <button class="valider  btn btn-default" disabled="true" data-target="3">valider</button>
                                        </div>
                                    </div>

                                    <div class="panel-wrapper active panel-3">
                                        <h3 class="question-panel-header">Votre situation</h3>
                                        <div class="question-panel">
                                            <div class="col-md-6">
                                                <label>célibataire <input type="radio" required name="simualtion[situation_celib]" ></label><br>
                                                <label>marié-pacsé  <input type="radio" required name="simualtion[situation_marie]" ></label><br>
                                            </div>

                                            <div class="col-md-6"><label for="message_human">nombre de parts fiscales <span>*</span></label><br>
                                                <input type="number" name="simualtion[nb_part_fiscales]"></div>

                                            <div class="col-md-6"><label for="message_human">revenus du foyer <span>*</span></label><br>
                                                <input  type="number"  name="simualtion[revenu_foyer]"></div>

                                            <div class="col-md-12"><input type="submit"/></div>

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