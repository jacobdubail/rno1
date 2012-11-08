<?php get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post();

    $terms   = get_the_terms( $post->ID, 'type');
    $count   = count( $terms );
    $i       = 0;
    $active  = "active";
    $types   = '';
    $klasses = '';
    foreach( ( $terms ) as $cat ) { 
      $i++;
      $klasses   .= $cat->slug . ' ';
      if ( $cat->slug !== 'case-study' ) {
        $types   .= $cat->name;
        if ( $i   < $count ) {
          $types .= " + ";
        }
      } 
    }
  ?>

    <article <?php post_class() ?>>
      
      <?php
        if(get_field('slide')): 
      ?>

        <div class="carousel slide" id="project_carousel"> 
          <div class="carousel-inner">   
          <?php while ( the_repeater_field( 'slide' ) ): ?>
            <div class="item <?php echo $active; $active = ''; ?>">
              <figure>
                <img src="<?php the_sub_field('slide_image'); ?>" />
                <figcaption>
                  <p><?php the_sub_field('slide_title'); ?></p>
                </figcaption>
              </figure>
            </div>
          <?php endwhile; ?>
          </div>
          <a class="carousel-control left" href="#project_carousel" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#project_carousel" data-slide="next">&rsaquo;</a>
        </div>
       
      <?php endif; ?>
      
      <div class="entry" id="project_entry">
        <header class="figcaption">
            <h2><?php the_title(); ?></h2>
            <p><?php echo $types; ?></p>
          </header>
        <?php the_content(); ?>
      </div>
            
    </article>

  <?php endwhile; endif; ?>
  
<?php get_footer(); ?>