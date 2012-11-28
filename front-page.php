<?php get_header(); ?>



  <secion id="blocks">

    <div id="vimeo" class="project figure_block project-double">
      <iframe src="http://player.vimeo.com/video/49452532?title=0&amp;byline=0&amp;portrait=0&amp;color=00BDF2" width="1024" height="576" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </div>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <a class="project figure_block intro" href="<?php the_field('link'); ?>" title="<?php the_field('link_text'); ?>">
      <div>
        <p><?php the_field('text'); ?></p>
        <div class="figcaption">
          <p><?php the_field('link_text'); ?></p>
        </div>
      </div>
    </a>
  <?php endwhile; endif; wp_reset_query(); ?>


  <?php
    $args = array(
      'post_type'      => 'projects',
      'posts_per_page' => -1,
      'post_status'    => 'publish',
      'orderby'        => 'rand'
    );

    $projects = new WP_Query( $args );
    while( $projects->have_posts() ) : $projects->the_post();
  ?>

  <?php
    $thumb   = get_field('thumbnail');
    $overlay = get_field('overlay');

    $date    = get_the_date();
    $month   = 60 * 60 * 24 * 30;

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
        <figure class="<?php echo ( $cs ) ? 'case_study' : ''; ?>">
          <img src="<?php echo $overlay['url']; ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
          <figcaption>
            <h2><?php the_title(); ?></h2>
            <p><?php echo $types; ?></p>
            <p>
              <?php
              if ( ( strtotime( $date ) - strtotime("now") ) > $month ) {
                echo "Add a tag<br/>";
                echo strtotime( $date ) - strtotime("now");
                echo '<br />' . $month;
              } else {
                echo "Don't a tag<br/>";
                echo strtotime( $date ) - strtotime("now");
                echo '<br />' . $month;
              }
              ?>
            </p>
            <img class="overlay" src="<?php echo $thumb['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
          </figcaption>
        </figure>
      </a>

  <?php
      endwhile;
  ?>
      </section>


<?php get_footer(); ?>