<?php get_header(); ?>

  <header class="figcaption">
    <h1 class="page_title">rno1 // brand beat.</h1>
    <p class="meta">Ideas + Insights // News + Noteworthy // Trends + Technology</p>
  </header> 

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
    <article class="post col-1-3" id="post-<?php the_ID(); ?>">

      <?php $color = get_field('color'); ?>

      <header class="figcaption">
        <h2 class="page_title">
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
        <?php get_template_part( 'inc/meta' ); ?>
        <span class="<?php echo $color; ?>"></span>
      </header>

      <div class="entry">

        <?php echo substr(get_the_excerpt(), 0, 220); ?>

      </div>

    </article>
    
    <?php endwhile; ?>

      <?php get_template_part( 'inc/nav' ); ?>

    <?php endif; ?>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
