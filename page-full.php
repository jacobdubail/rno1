<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="post" id="page-<?php the_ID(); ?>">

			<header class="figcaption">
				<h1 class="page_title"><?php the_title(); ?></h1>
			</header>

			<div class="entry cf">

				<?php the_content(); ?>

			</div>

		</article>
		
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
