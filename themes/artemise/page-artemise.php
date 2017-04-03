<?php
/*
  Template Name: Page Artemise - full page
 */

get_header(); ?>

<div class="container-fluid">

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
    
        <div class="row">
            <section id="bandeau" class="" style="background-image: url('<?= getImageBandeau() ?>')">

            </section>
        </div>
        <div class="row content-area" id="content">
            
<!--            <h1>temp : page-artemise</h1>-->
            <article class="">
                <section class="site-content col-md-offset-3 col-md-8"> 
                    <h1 class="titre-page"><?php the_title(); ?><span></span></h1>


                    <p><?php the_content(); ?></p>
                </section>
            </article>
        <?php endwhile;
    endif; ?>
        </div>
    
    <?php get_footer(); ?>

