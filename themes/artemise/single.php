<?php

get_header(); ?>
<h1>the single</h1>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php 
                                
                                the_title();
                                echo '<div class="entry-content">';
                                the_content();
                                echo '</div>';
                                ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>