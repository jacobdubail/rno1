<?php get_header(); ?>

  <header class="figcaption">
    <h1 class="page_title">rno1 // brand beat.</h1>
    <p>Ideas + Insights // News + Noteworthy // Trends + Technology</p>
  </header> 
  <br />

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
    <article class="post col-1-3" id="post-<?php the_ID(); ?>">

      <?php 
        if ( get_the_post_thumbnail() ) :
          the_post_thumbnail('medium');
          $color = NULL;
        else :
          $color = get_field('color'); 
        endif;
      ?>

      <header class="figcaption">
        <h2 class="page_title">
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
        <?php get_template_part( 'inc/meta' ); ?>
        <?php if ( !empty($color) ) : ?>
          <span class="<?php echo $color; ?>"></span>
        <?php endif; ?>
      </header>

      <div class="entry">

        <?php echo rno1_get_excerpt($post->ID); ?>

        <p><a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read more</a></p>

      </div>

    </article>
    
    <?php endwhile; ?>

      <?php get_template_part( 'inc/nav' ); ?>

    <?php endif; ?>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
