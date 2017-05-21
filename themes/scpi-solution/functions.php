<?php

//define( 'STYLE_WEB_ROOT' , get_stylesheet_directory_uri() );
require_once ( 'widget/widget.php' );
require_once('scpi_functions/ajaxForm.php');
require_once('scpi_functions/certif.php');
require_once('scpi_functions/animation-chart.php');
require_once('scpi_functions/simulation.php');


#-----------------------------------------------------------------
# Header Core Scripts
#-----------------------------------------------------------------
	add_action('init',	function () {

    wp_enqueue_script('jquery-validation', STYLE_WEB_ROOT."/javascripts/jquery.validate.min.js",
      array('jquery' ),'1.16.0', true);
		wp_enqueue_script('scpi-custom', STYLE_WEB_ROOT."/javascripts/scpi.js",array('jquery','jquery-validation' ),null, true);
		wp_enqueue_script('ajax-form', STYLE_WEB_ROOT."/javascripts/ajaxForm.js",array('jquery','jquery-validation' ),'1.0', true);

// pass Ajax Url to script.js
    wp_localize_script('ajax-form', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

		wp_enqueue_style('jquery-style', "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
		wp_enqueue_style('bootstrap-style',
            STYLE_WEB_ROOT."/css/bootstrap.min.css");

	});




add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
    global $post;

    $text = "Cette partie du site est reserve aux membres du club scpi-solution. <br />
 pour obtenir votre mot de passe, veuillez remplir le formualuire de contact ";

    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">

    <label class="pass-label" for="' . $label . '">' . __( "Merci de rentrer le mot de passe:" ) . ' </label>
    <input name="post_password" id="' . $label . '" type="password" style="background: #ffffff; border:1px solid #999; color:#333333; padding:10px;" size="20" />
    <input type="submit" name="Submit" class="button" value="' . esc_attr__( "Valider" ) . '" />
    </form><p style="font-size:14px;margin:0px;">'.$text.'</p>
    ';
    return $o;
};





#-----------------------------------------------------------------
# Blog
#-----------------------------------------------------------------
if( !function_exists( 'scpi_render_lambda_blog' ) ) {
    function scpi_render_lambda_blog($metadata) {

        global $lambda_meta_data, $post, $paged;

        $theme_options = get_option('option_tree');

        $numberpost = ($metadata['blog_length']) ? $metadata['blog_length'] : 3;
        $blogcats = (isset($metadata['only_category']) && is_array($metadata['only_category'])) ? implode(",",$metadata['only_category']) : '';
        $post_not_in = (isset($metadata['post_not_in']) && is_array($metadata['post_not_in'])) ? $metadata['post_not_in'] : '';

        if ( get_query_var('paged') ) {	$paged = get_query_var('paged'); }
        elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
        else { $paged = 1; }

        $z = 1;
        $args = array(
            'posts_per_page' => $numberpost,
            'post__not_in' => $post_not_in,
            'cat' => $blogcats,
            'paged' => $paged
        );


        query_posts( $args );

        if (have_posts()) : while (have_posts()) : the_post(); $lambda_meta_data->the_meta();

            global $more;
            $more = ($metadata['activate_blog_excerpt'] == 'on') ? 1 : 0;
            $bloggrid = ( isset($metadata['blog_grid']) ) ? $metadata['blog_grid'] : 'one_third';


            $gridcount = array('full-width'	=> '1',
                'one_third' 	=> '3',
                'one_half'  	=> '2',
                'one_fourth'	=> '4');

            ?>

            <section class="post <?php echo $bloggrid; ?> <?php if($z%$gridcount[$bloggrid]==0) { echo 'last'; } ?>" id="post-<?php the_ID(); ?>">
                <article class="entry-post clearfix">

                    <header class="entry-header clearfix">

                        <?php

                        $pformat = get_post_format();
                        $postformat = (!empty( $pformat )) ? $pformat : 'standard';

                        ?>

                        <h1 class="entry-title <?php echo $postformat; ?>-post-title">
                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Nevada' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h1>

                        <div class="entry-meta  clearfix">

                            <div class="post-ut">
                                <?php echo lambda_posted_on(); ?>
                            </div> <!-- post date -->



                            <?php if(get_option_tree('activate_likes_in_blog') == "yes" && (isset($metadata['activate_blog_like']) && $metadata['activate_blog_like'] != 'off')) : ?>

                                <?php echo GetLambdaLikePost(); ?>

                            <?php endif; ?>

                        </div><!-- .entry-meta -->

                    </header>

                    <?php
                    $post_format = get_post_format();
                    $post_format = ( isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'image_portfolio') ? 'gallery' : $post_format;

                    if($metadata['activate_blog_images'] == 'on')
                        get_template_part( 'post-formats/' . $post_format );

                    ?>


                    <?php

                    if(has_post_thumbnail(get_the_ID()) && $metadata['activate_blog_images'] == 'on' && $post_format != 'video') :

                        $imgID = get_post_thumbnail_id($post->ID);
                        $url = wp_get_attachment_url( $imgID );
                        $alt = get_post_meta($imgID , '_wp_attachment_image_alt', true);

                        echo '<div class="thumb"><div class="post-image"><div class="overflow-hidden imagepost">';
                        echo '<img class="wp-post-image" alt="'.trim( strip_tags($alt) ).'" src="'.$url.'" />';
                        echo '<a title="'.get_the_title().'" href="'.get_permalink().'"><div class="hover-overlay"><span class="circle-hover"><img src="'.THEME_WEB_ROOT.'/images/circle-hover.png" /></span></div></a>';
                        echo '</div></div></div>';

                    endif;



                    ?>

                    <div class="entry-summary">

                        <?php

                        if($numberpost != 0) {

                            if ($metadata['activate_blog_excerpt'] == 'on') :

                                if ( $post->post_excerpt ){

                                    the_excerpt();

                                } else {

                                    $excerptlength = (!empty($metadata['blog_excerpt_length'])) ? $metadata['blog_excerpt_length'] : $theme_options['excerpt_blog_length'];
                                    echo excerpt_by_id($post->ID, $excerptlength, '', lambda_continue_reading_link());

                                }

                            else :

                                the_content( __( 'Read more <span class="meta-nav"></span>', 'Nevada' ) );

                            endif;



                        }
                        ?>

                    </div>

                </article>
            </section>

            <?php if(($z%$gridcount[$bloggrid]==0) && $bloggrid != 'full-width') { ?>
                <div class="clear"></div>
            <?php } ?>

            <?php $z++; endwhile; endif; ?>

        <?php if( !is_page_template('template-home.php') ) : ?>

            <div id="nav-below" class="navigation clearfix">
                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&#8656;</span> Older posts', 'Nevada' ) ); ?></div>
                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&#8658;</span>', 'Nevada' ) ); ?></div>
            </div><!-- #nav-below -->

        <?php endif; ?>

        <?php wp_reset_query(); ?>


        <?php
    }
}

