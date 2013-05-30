<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow" />
  <?php } ?>

  <title><?php wp_title('|'); ?></title>
  <meta name="google-site-verification" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <link rel="shortcut icon" href="<?php home_url(); ?>/favicon.png">
  <link rel="shortcut icon" href="<?php home_url(); ?>/favicon.ico">

  <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.min.js"></script>

  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

  <script src="//use.typekit.net/zwq0cfa.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>

  <?php wp_head(); ?>

  <!--[if (lt IE 9) & (!IEMobile)]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>js/selectivizr.min.js"></script>
  <![endif]-->


  <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/no_mq.css"> -->

</head>

<body <?php body_class(); ?>>
  <!--[if lt IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
  <![endif]-->

<div class="page-wrap">

  <header class="header cf">
    <h1><a id="logo" href="<?php home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
  </header>
  <nav class="main-nav cf">
    <?php wp_nav_menu( array( 'theme_location' => 'main-nav', 'container' => '' ) ); ?>
    <?php if ( is_front_page() ) : ?>
      <ul class="menu filters cf" id="filters">
        <li><a href="#" data-filter="*" class="active">Our Work</a></li>
        <li><a href="#" data-filter=".case-study">Case Studies</a></li>
        <li><a href="#" data-filter=".branding">Branding</a></li>
        <li><a href="#" data-filter=".website">Websites</a></li>
      </ul>
    <?php else : ?>
      <ul class="menu filters cf">
        <li><a href="/">Back to Projects</a></li>
      </ul>
    <?php endif; ?>
  </nav>

  <section class="main-content cf grid">
