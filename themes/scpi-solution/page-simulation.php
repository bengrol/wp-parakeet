<?php

//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

}


//response messages
$not_human       = "Human verification incorrect.";
$missing_content = "Please supply all information.";
$email_invalid   = "Email Address Invalid.";
$message_unsent  = "Message was not sent. Try Again.";
$message_sent    = "Thanks! Your message has been sent.";

//user posted variables




$name     = isset($_POST['message_name'] ) ? esc_attr($_POST['message_name']) : null;
$email    = isset($_POST['message_email']) ? esc_attr($_POST['message_email']) : null;
$message  = isset($_POST['message_text'] ) ? esc_attr($_POST['message_text']) : null;
$human    = isset($_POST['message_human']) ? esc_attr($_POST['message_human']) : null;

//php mailer variables
$to = get_option('admin_email');
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";



if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {

        //validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            my_contact_form_generate_response("error", $email_invalid);
        else //email is valid
        {
            //validate presence of name and message
            if(empty($name) || empty($message)){
                my_contact_form_generate_response("error", $missing_content);
            }
            else //ready to go!
            {
                $sent = wp_mail($to, $subject, strip_tags($message), $headers);
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

                                    <div class="panel-wrapper active">
                                        <h3 class="question-panel-header">info perso</h3>
                                        <div class="question-panel panel-1">
                                            <p><label for="name">Name: <span>*</span> <br>
                                                    <input type="text" name="message_name" required minlength="3"
                                                           value="<?= $name ?>"></label>
                                            </p>
                                            <p><label for="message_email">Email: <span>*</span>
                                                    <input type="email" required
                                                           name="message_email"
                                                           value="<?= $email; ?>"></label>
                                            </p>
                                            <button class="valider panel-1" disabled="true" data-panel="1">valider</button>
                                        </div>
                                    </div>
                                    <div class="panel-wrapper not-active">
                                        <h3 class="question-panel-header">autres infos </h3>
                                        <div class="question-panel panel-2">
                                            <p><label for="message_text">Message: <span>*</span><br>
                                                    <textarea
                                                        type="text"
                                                        name="message_text"><?= $message ; ?></textarea>
                                                </label>
                                            </p>
                                            <button class="valider panel-2" disabled="true" data-panel="2">valider</button>
                                        </div>
                                    </div>
                                    <div class="panel-wrapper not-active">
                                        <h3 class="question-panel-header">encore d'autres infos </h3>
                                        <div class="question-panel panel-3">
                                            <p><label for="message_human">Human Verification: <span>*</span><br><input
                                                        type="text" style="width: 60px;" name="message_human"> + 3 =
                                                    5</label></p>
                                            <p><input type="submit"/></p>
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