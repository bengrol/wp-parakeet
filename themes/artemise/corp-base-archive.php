<?php get_header(); ?>

    <?php  if (have_posts()) : ?>
        <?php  while (have_posts()) : ?>
        <?php the_post(); ?>
        <div class="row">
            <section id="bandeau" class="bd-<?php echo( basename(get_permalink()) );?>" style="background-image: url('<?= getImageBandeau(); ?>')"></section>
        </div>
        <div class="row" id="content">
            
            <div class="site-content container col-md-offset-3 col-md-8">
            <section class="chambre-list ">
                <div>
                    <h1 class="titre-page"><?php the_title(); ?></h1>
                    
                    <p><?php the_content(); ?></p>
                </div>


        <?php endwhile; 
    endif; ?>

                
   
    <?php /* archive de page */
    $meta_key = "chambres";
    $order = "ASC";
 switch ($temp) {
     case "chambres":
         $meta_key = "_prix-chambre";
         $order = "ASC";
         break;
     case "offres":
         $meta_key = "_id-offre";
         $order = "DESC";
         break;

     default:
             $meta_key = "chambres";
    $order = "ASC";
         break;
 } 
    
 
    $args = array( 
        'post_type' => $temp,
        'posts_per_page' => -1,
        'meta_key'   => $meta_key,
        'orderby'    => 'meta_value_num',
	'order'      => $order
        );
    
    
    $loop = new WP_Query( $args );

  
        

     while ( $loop->have_posts() ) : $loop->the_post(); 

     get_template_part( 'content', $temp );

     endwhile; wp_reset_query();       
     ?>
        
    </div></div>
    <?php get_footer(); ?>