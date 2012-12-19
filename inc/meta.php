<div class="meta">
	<time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('n.j.y') ?></time>
	&mdash;
  <?php swift_list_cats(4); ?>
  <?php if ( is_single() ) : ?>
    <div class="sharing">
      <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false" data-font="arial"></div>
      <div class="g-plusone" data-size="small"></div>
      <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="livethebrand">Tweet</a>
    </div>
  <?php endif; ?>
</div>