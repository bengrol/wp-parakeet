<?php
/**

 */

get_header(); ?>

<div class="container-fluid" >
    <div class="row">
        <section id="bandeau" class="bd-ch">

        </section>
    </div>
<h1>arch ...</h1>
    <div class="row" id="content">
            <section class="chambre-list col-lg-offset-3 col-lg-8">
                <div>
                    <h3>Archives de ... </h3>

                </div>

    <?php if ( have_posts() ) : ?>
            <header class="archive-header">
                <h1 class="archive-title"><?php ?></h1>
            </header><!-- .archive-header -->

            <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
            
                <article>
                    <header> 
                        <h1><?php the_title(); ?></h1>
                        <div>
                            <span>34 &euro;/ jour - pdj inclus</span>
                        </div>

                    </header>
                    <section>
                        <div>
                            <span>surface :  - </span>
                            <span>taxe sejour :  &euro; - </span>
                            <span>Desc :   - </span>

                        </div>
                    </section>
                </article>
            
             <?php endwhile; ?>
		

    <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

    </div><!-- #content -->
</div><!-- #primary -->


<?php get_footer(); ?>

        
