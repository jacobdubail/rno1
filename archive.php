<?php get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
    <article class="post" id="post-<?php the_ID(); ?>">

      <h2><?php the_title(); ?></h2>

      <?php get_template_part( 'inc/meta' ); ?>

      <div class="entry">

        <?php the_excerpt(); ?>

      </div>

    </article>
    
    <?php endwhile; endif; ?>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
