<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


add_action( 'login_enqueue_scripts', function (){
  wp_enqueue_style ( 'clp-styles', CLP_ASSETS . 'css/styles.css' );
  ?><script async src="//www.google.com/recaptcha/api.js?hl=fa"></script><?php
});


add_filter( 'login_headerurl', function (){
  return home_url();

});

add_filter( 'login_headertitle', function (){
  return 'Sisoog';
});

add_filter( 'login_display_language_dropdown', '__return_false' );

add_action('login_form', function () {
  ?><div class="g-recaptcha" data-sitekey="<?= get_option('CLP_google_site_key') ?>"></div> <?php
});

add_filter( 'wp_authenticate_user', function ($user, $password) {
  $secretkey = get_option('CLP_google_secret_key');

  if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
	$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response=' . $_POST['g-recaptcha-response'] );
	$response = json_decode($response['body'], true);

	if ($response['success']) return $user;
	else return new WP_Error( 'Captcha Invalid', __('<strong>خطا</strong>: کد کپچا را تایید کنید!') );
  }
  else return new WP_Error( 'Captcha Invalid', __('<strong>خطا</strong>: کد کپچا را تایید کنید!') );
}, 10, 3 );
