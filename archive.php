<?php get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
    <article class="post col-1-3" id="post-<?php the_ID(); ?>">

      <?php $color = get_field('color'); ?>

      <header class="figcaption">
        <h2 class="page_title">
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?> - <?php echo $color; ?>
          </a>
        </h2>
        <?php get_template_part( 'inc/meta' ); ?>
        <span class="<?php echo $color; ?>"></span>
      </header>

      <div class="entry">

        <?php the_content('Read More'); ?>

      </div>

    </article>
    
    <?php endwhile; endif; ?>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
