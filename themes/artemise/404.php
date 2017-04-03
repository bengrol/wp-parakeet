<?php get_header();

$img = get_template_directory_uri();
$img .= '/images/img-bandeau-ch.jpg';

?>

<div class="container-fluid">
    
    <div class="row">
        <section id="bandeau" class="bd-404" 
                 style="background-image: url('<?= getImageBandeau() ?>')">

        </section>
    </div>
    <div class="row content-area">
     <article class="">
        <section class="col-lg-offset-3 col-lg-8"> 
            <h1 class="titre-page">404</h1>


            <p><?php _e('Mauvaise direction', 'artemise'); ?></p>
        </section>
    </article>
    </div>
<?php get_footer(); ?>

