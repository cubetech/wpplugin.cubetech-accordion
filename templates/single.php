<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

				?>
        			<article <?php post_class(); ?>>
                			<header class="entry-header">
                        			<h1 class="entry-title"><?php the_title(); ?></h1>
                			</header>
                			<div class="entry-content">
                        			<?php the_content(); ?>
                			</div>
                			<footer>
                        			<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
                			</footer>
        			</article>

				<?php

				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
