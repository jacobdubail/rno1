<?php

register_sidebar( array(
    'name' => 'Sidebar Widgets',
    'id'   => 'sidebar-widgets',
    'description'   => 'These are widgets for the sidebar.',
    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget_title">',
    'after_title'   => '</h4>'
  ) );

register_sidebar( array(
    'name' => 'Footer Widgets',
    'id'   => 'footer-widgets',
    'description'   => 'These are widgets for the footer.',
    'before_widget' => '<div id="%1$s" class="widget %2$s cf col-1-3">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ) );

register_sidebar( array(
    'name' => 'Home Blocks',
    'id'   => 'home-blocks',
    'description'   => 'These are blocks for the homepage.',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ) );

add_theme_support( 'nav-menus' );
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'main-nav', __( 'Main Nav' ) );
}

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic_feed_links' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );


add_filter( 'widget_text', 'do_shortcode' );

function category_id_class( $classes ) {
  global $post;
  foreach ( ( get_the_category( $post->ID ) ) as $category )
    $classes [] = 'cat-' . $category->cat_ID . '-id';
  return $classes;
}
add_filter( 'post_class', 'category_id_class' );
add_filter( 'body_class', 'category_id_class' );

add_action( 'wp_enqueue_scripts', 'rno1_register_scripts' );
function rno1_register_scripts() {
  wp_deregister_script( 'jquery' );
  wp_deregister_script( 'l10n' );

  $jQuery = "http" . ( $_SERVER['SERVER_PORT'] == 443 ? "s" : "" ) . "://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js";
  $test   = @fopen( $jQuery, 'r' );
  if ( $test === false ) {
    $jQuery = get_template_directory_uri() . '/js/jquery.min.js';
  }

  wp_register_script( 'jquery', $jQuery, false, '1.8.2', true );
  wp_enqueue_script( 'jquery' );

  wp_register_script( 'rno1_plugins', '/wp-content/themes/rno1/js/plugins.min.js', array( 'jquery' ), '1', true );
  wp_enqueue_script( 'rno1_plugins' );

  wp_register_script( 'rno1_functions', '/wp-content/themes/rno1/js/script.min.js', array( 'jquery', 'rno1_plugins' ), '1', true );
  wp_enqueue_script( 'rno1_functions' );

  wp_register_style( 'rno1_styles', '/wp-content/themes/rno1/css/style.css', '', '1.2', 'screen and (min-width: 100px)' );
  wp_enqueue_style( 'rno1_styles' );

}

function complete_version_removal() { return ''; }
add_filter( 'the_generator', 'complete_version_removal' );
remove_filter( 'pre_user_description',    'wp_filter_kses' );
remove_filter( 'pre_comment_content',     'wp_rel_nofollow' );
add_filter   ( 'get_comment_author_link', 'xwp_dofollow' );
add_filter   ( 'post_comments_link',      'xwp_dofollow' );
add_filter   ( 'comment_reply_link',      'xwp_dofollow' );
add_filter   ( 'comment_text',            'xwp_dofollow' );

function jtd_allow_rel() {
  global $allowedtags;
  $allowedtags['a']['rel'] = array ();
}
add_action( 'wp_loaded', 'jtd_allow_rel' );

function jtd_add_google_profile( $contactmethods ) {
  // Add Google Profiles
  $contactmethods['google_profile'] = 'Google Profile URL';
  $contactmethods['facebook']       = 'Facebook';
  $contactmethods['twitter']        = 'Twitter';
  unset( $contactmethods['aim'] );
  unset( $contactmethods['yim'] );
  unset( $contactmethods['jabber'] );
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'jtd_add_google_profile', 10, 1 );




//Custom Post Type for Slides
function rno1_projects() {

  register_post_type(
    'projects',
    array(
      'label' => __( 'Projects' ),
      'description' => __( 'Create a Project' ),
      'public' => true,
      'query_var' => 'project',
      'show_ui' => true,
      'supports' => array (
        'title',
        'editor',
        'thumbnail',
        'excerpt',
        'custom-fields',
        'page-attributes'
      )
    )
  );

}
add_action( 'init', 'rno1_projects' );



// register custom taxonomy for slide categorization
add_action( 'init', 'rno1_register_tax' );
function rno1_register_tax() {
  $tax_args             = array(
    'hierarchical'    => true,
    'query_var'       => 'platform',
    'labels'          => array(
      'name'         => 'Project Platform',
      'edit_item'    => 'Edit Platform',
      'add_new_item' => 'Add New Platform',
      'all_items'    => 'All Platforms'
    )
  );
  register_taxonomy( 'platforms', array( 'projects' ), $tax_args );

  $tax2_args             = array(
    'hierarchical'    => true,
    'query_var'       => 'type',
    'labels'          => array(
      'name'         => 'Project Type',
      'edit_item'    => 'Edit Type',
      'add_new_item' => 'Add New Type',
      'all_items'    => 'All Types'
    )
  );
  register_taxonomy( 'type', array( 'projects' ), $tax2_args );
}






function rno1_get_blocks( $query ) {
  if ( $query->is_main_query() && $query->is_home() ) {
    $query->set( 'post_type',    'page' );
//    $query->set( 'meta_key',     'text' );
//    $query->set( 'meta_value',   '' );
//    $query->set( 'meta_compare', '!=' );
//    $query->set( 'orderby',      'meta_value' );
    $metaq = array(
        array(
          'key'     => 'text',
          'value'   => '',
          'type'    => 'string',
          'compare' => '!='
        )
      );
    $query->set('meta_query', $metaq );

  }
}
//add_action( 'pre_get_posts', 'rno1_get_blocks' );


function rno1_get_projects( $query ) {
  if ( $query->is_main_query() && $query->is_home() ) {
    $query->set( 'post_type',      'projects' );
    $query->set( 'posts_per_page', -1 );
    $query->set( 'orderby',        'rand' );
  }
}
add_action( 'pre_get_posts', 'rno1_get_projects' );






/*
//
// Get and Cache Twitter Status
//
*/
function jtd_twitter_status( $username = 'jacobdubail', $maxTweets = 3 ) {

  $url    = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $maxTweets;
  $tweets = get_transient( 'jdtweets'.$username );
  //  $tweets = false;

  if ( false   === $tweets ) {
    $response   = wp_remote_retrieve_body( wp_remote_get( $url ) );

    if ( is_wp_error( $response ) ) {
      $tweets  = 'Something went wrong!';
    } else {
      $tweets = $response;
    }

    set_transient( 'jdtweets'.$username, $tweets, 60*60 );
  }

  $tweets = json_decode( $tweets );
  if ( count( $tweets ) ) {
    foreach ( $tweets as $tweet ) {
      echo '<li>' . clean_tweet( $tweet->text ) . '</li>';
    }
  } else {
    echo '<li><strong>No tweets found</strong></li>';
  }


}



/*
//
// TWEETIFY CLASS
//
*/

/*
 * tweetify.inc
 *
 * Ported from Remy Sharp's 'ify' javascript function; see:
 * http://code.google.com/p/twitterjs/source/browse/trunk/src/ify.js
 *
 * Based on revision 46:
 * http://code.google.com/p/twitterjs/source/detail?spec=svn46&r=46
 */


/*
 * Clean a tweet: translate links, usernames beginning '@', and hashtags
 */
function clean_tweet( $tweet ) {
  $regexps = array
  (
    "link"  => '/[a-z]+:\/\/[a-z0-9-_]+\.[a-z0-9-_:~%&\?\+#\/.=]+[^:\.,\)\s*$]/i',
    "at"    => '/(^|[^\w]+)\@([a-zA-Z0-9_]{1,15}(\/[a-zA-Z0-9-_]+)*)/',
    "hash"  => "/(^|[^&\w'\"]+)\#([a-zA-Z0-9_]+)/"
  );

  foreach ( $regexps as $name => $re ) {
    $tweet = preg_replace_callback( $re, 'parse_tweet_'.$name, $tweet );
  }

  return $tweet;
}

/*
 * Wrap a link element around URLs matched via preg_replace()
 */
function parse_tweet_link( $m ) {
  return '<a href="'.$m[0].'">'.( ( strlen( $m[0] ) > 25 ) ? substr( $m[0], 0, 24 ).'...' : $m[0] ).'</a>';
}

/*
 * Wrap a link element around usernames matched via preg_replace()
 */
function parse_tweet_at( $m ) {
  return $m[1].'@<a href="http://twitter.com/'.$m[2].'">'.$m[2].'</a>';
}

/*
 * Wrap a link element around hashtags matched via preg_replace()
 */
function parse_tweet_hash( $m ) {
  return $m[1].'#<a href="http://search.twitter.com/search?q=%23'.$m[2].'">'.$m[2].'</a>';
}







/**
 * Title   : Aqua Resizer
 * Description : Resizes WordPress images on the fly
 * Version : 1.1.5
 * Author  : Syamil MJ
 * Author URI  : http://aquagraphite.com
 * License : WTFPL - http://sam.zoy.org/wtfpl/
 * Documentation : https://github.com/sy4mil/Aqua-Resizer/
 *
 * @param string  $url    - (required) must be uploaded using wp media uploader
 * @param int     $width  - (required)
 * @param int     $height - (optional)
 * @param bool    $crop   - (optional) default to soft crop
 * @param bool    $single - (optional) returns an array if false
 * @uses wp_upload_dir()
 * @uses image_resize_dimensions()
 * @uses image_resize()
 *
 * @return str|array
 */

function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {

  //validate inputs
  if ( !$url or !$width ) return false;

  //define upload path & dir
  $upload_info = wp_upload_dir();
  $upload_dir = $upload_info['basedir'];
  $upload_url = $upload_info['baseurl'];

  //check if $img_url is local
  if ( strpos( $url, $upload_url ) === false ) return false;

  //define path of image
  $rel_path = str_replace( $upload_url, '', $url );
  $img_path = $upload_dir . $rel_path;

  //check if img path exists, and is an image indeed
  if ( !file_exists( $img_path ) or !getimagesize( $img_path ) ) return false;

  //get image info
  $info = pathinfo( $img_path );
  $ext = $info['extension'];
  list( $orig_w, $orig_h ) = getimagesize( $img_path );

  //get image size after cropping
  $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
  $dst_w = $dims[4];
  $dst_h = $dims[5];

  //use this to check if cropped image already exists, so we can return that instead
  $suffix = "{$dst_w}x{$dst_h}";
  $dst_rel_path = str_replace( '.'.$ext, '', $rel_path );
  $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

  if ( !$dst_h ) {
    //can't resize, so return original url
    $img_url = $url;
    $dst_w = $orig_w;
    $dst_h = $orig_h;
  }
  //else check if cache exists
  elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
    $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
  }
  //else, we resize the image and return the new resized image url
  else {
    $resized_img_path = image_resize( $img_path, $width, $height, $crop );
    if ( !is_wp_error( $resized_img_path ) ) {
      $resized_rel_path = str_replace( $upload_dir, '', $resized_img_path );
      $img_url = $upload_url . $resized_rel_path;
    } else {
      return false;
    }
  }

  //return the output
  if ( $single ) {
    //str return
    $image = $img_url;
  } else {
    //array return
    $image = array (
      0 => $img_url,
      1 => $dst_w,
      2 => $dst_h
    );
  }

  return $image;
}





function swift_list_cats( $num = 4 ) {
  $temp       = get_the_category();
  $count      = count( $temp );// Getting the total number of categories the post is filed in.
  $cat_string = NULL;
  for ( $i = 0; $i < $num && $i < $count; $i++ ) {

    if ( strtolower( $temp[$i]->cat_name ) != "blog" ) :

      $cat_string .= '<a href="'.get_category_link( $temp[$i]->cat_ID  ).'">'.$temp[$i]->cat_name.'</a>';
      if ( $i != $num-1 && $i+1 < $count )
        $cat_string.=', ';

    endif;

  } // end for
  echo $cat_string;
}





function rno1_get_excerpt($pid){
  $excerpt  = get_the_content($pid);
  $excerpt  = preg_replace(" (\[.*?\])",'',$excerpt);
  $excerpt  = strip_shortcodes($excerpt);
  $excerpt  = strip_tags($excerpt);
  $excerpt  = substr($excerpt, 0, 220);
  $excerpt  = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt  = trim(preg_replace( '/\s+/', ' ', $excerpt));
  $excerpt .= "...";
//  $excerpt = $excerpt.'... <a href="'.$permalink.'">more</a>';
  return $excerpt;
}



// custom excerpt length
function custom_excerpt_length($length) {
  return 60;
}
add_filter('excerpt_length', 'custom_excerpt_length');



  // custom excerpt ellipses for 2.9+
function custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');




add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
  global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

  if($is_lynx) $classes[] = 'lynx';
  elseif($is_gecko) $classes[] = 'gecko';
  elseif($is_opera) $classes[] = 'opera';
  elseif($is_NS4) $classes[] = 'ns4';
  elseif($is_safari) $classes[] = 'safari';
  elseif($is_chrome) $classes[] = 'chrome';
  elseif($is_IE) $classes[] = 'ie';
  else $classes[] = 'unknown';

  if($is_iphone) $classes[] = 'iphone';
  return $classes;
}