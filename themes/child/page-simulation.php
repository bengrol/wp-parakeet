<?php

//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){

  global $response;

  if($type == "success") $response = "<div class='success'>{$message}</div>";
  else $response = "<div class='error'>{$message}</div>";

}
?>

<?php get_header(); ?>

  <div id="primary" class="site-content">
    <div id="content" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>

          <div class="entry-content">
            <?php the_content(); ?>

            <style type="text/css">
              .error{
                padding: 5px 9px;
                border: 1px solid red;
                color: red;
                border-radius: 3px;
              }

              .success{
                padding: 5px 9px;
                border: 1px solid green;
                color: green;
                border-radius: 3px;
              }

              form span{
                color: red;
              }
            </style>

            <div id="respond">
              <?php echo $response; ?>
              <form action="<?php the_permalink(); ?>" method="post">
                <p><label for="name">Name: <span>*</span> <br><input type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>"></label></p>
                <p><label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></label></p>
                <p><label for="message_text">Message: <span>*</span> <br><textarea type="text" name="message_text"><?php echo esc_textarea($_POST['message_text']); ?></textarea></label></p>
                <p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
                <input type="hidden" name="submitted" value="1">
                <p><input type="submit"></p>
              </form>
            </div>

          </div><!-- .entry-content -->

        </article><!-- #post -->

      <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>