<?php get_header(); ?>

<?php get_sidebar(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="post col-2-3" id="post-<?php the_ID(); ?>">

			<header class="figcaption">
				<h1 class="page_title"><?php the_title(); ?></h1>
			</header>

			<div class="entry">

				<?php the_content(); ?>

			</div>

		</article>
		
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
