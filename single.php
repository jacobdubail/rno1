<?php get_header(); ?>

<?php get_sidebar(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php $thumbs = ( get_the_post_thumbnail() ) ? 'has_thumbnail' : 'no_thumbnail'; ?>
      
    <article class="post col-2-3" id="post-<?php the_ID(); ?>">

      <header class="figcaption <?php echo $thumbs; ?>">
        <h2 class="page_title"><?php the_title(); ?></h2>
        <?php get_template_part( 'inc/meta' ); ?>
        
        <?php if ( get_the_post_thumbnail() ) : ?>
          </header>
          <?php the_post_thumbnail('full'); ?>
        <?php else : ?>
          <?php $color = get_field('color'); ?>
          <span class="<?php echo $color; ?>"></span>
          </header>
        <?php endif; ?>
        
      
      <div class="entry">

        <?php the_content(); ?>

      </div>

    </article>
    
    <?php endwhile; endif; ?>

<?php get_footer(); ?>
