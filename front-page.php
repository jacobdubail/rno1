<?php get_header(); ?>



  <secion id="blocks">

    <div id="vimeo" class="project figure_block project-double">
      <iframe src="http://player.vimeo.com/video/49452532?title=0&amp;byline=0&amp;portrait=0&amp;color=00BDF2" width="1024" height="576" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </div>

    <a class="project figure_block intro" href="/about/bioticbrands/" title="+ LEARN MORE ABOUT RNO1">
      <div>
        <p><?php bloginfo('description'); ?></p>
        <div class="figcaption">
          <p>+ LEARN MORE ABOUT RNO1</p>
        </div>
      </div>
    </a>

    <?php get_sidebar('home'); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php
    $thumb   = get_field('thumbnail');
    $overlay = get_field('overlay');

    $date    = get_the_date();
    $month   = 60 * 60 * 24 * 30;
    $new     = NULL;

    if ( ( strtotime("now") - strtotime( $date ) ) < $month ) {
      $new   = "new_project";
    } else {
      $new   = false;
    }

    $terms   = get_the_terms( $post->ID, 'type');
    $count   = count( $terms );
    $i       = 0;
    $types   = '';
    $klasses = '';
    $cs      = false;
    if ( $terms ) :
      foreach( $terms as $cat ) {
        $i++;
        $klasses   .= $cat->slug . ' ';
        if ( $cat->slug !== 'case-study' ) {
          $types   .= $cat->name;
          if ( $i   < $count ) {
            $types .= " + ";
          }
        } else {
          $cs = true;
        }
      }
    endif; // if terms
  ?>
      <a class="project figure_block <?php echo $klasses; ?>" href="<?php the_permalink(); ?>">
        <figure class="<?php echo ( $cs ) ? 'case_study' : ''; echo $new; ?>">
          <img src="<?php echo $overlay['url']; ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
          <figcaption>
            <h2><?php the_title(); ?></h2>
            <p><?php echo $types; ?></p>
            <img class="overlay" src="<?php echo $thumb['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
          </figcaption>
        </figure>
      </a>

  <?php
      endwhile; endif;
  ?>

      </section>

<?php get_footer(); ?>