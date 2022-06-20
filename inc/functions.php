<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


add_action( 'login_enqueue_scripts', function (){
  //wp_enqueue_style ( 'clp-styles', CLP_ASSETS . 'css/styles.css' );
  ?><style type="text/css"> <?= get_option('CLP_login_page_styles') ?></style><?php
  ?><script async src="//www.google.com/recaptcha/api.js?hl=fa"></script><?php
});

add_filter( 'login_headerurl', function (){
  return home_url();
});

add_filter( 'login_headertitle', function (){
  return 'Sisoog';
});

add_filter( 'login_display_language_dropdown', '__return_false' );

