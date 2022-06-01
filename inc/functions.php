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

add_action('login_form', function () {
  ?>
    <div class="g-recaptcha" data-sitekey="<?= get_option('CLP_google_site_key') ?>"></div>
    <input type="hidden" name="is_wplogin_page" value="1">
  <?php
});

add_filter( 'wp_authenticate_user', function ($user, $password) {

  if (isset($_POST['is_wplogin_page']) ) {
	if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
	  $secretkey = get_option('CLP_google_secret_key');
	  $response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response=' . $_POST['g-recaptcha-response'] );
	  $response = json_decode($response['body'], true);

	  if ($response['success']) return $user;
	  else return new WP_Error( 'Captcha Invalid', __('<strong>Error</strong>Please Confirm Captcha Code!','custom_lp_lan') );
	}
	else return new WP_Error( 'Captcha Invalid', __('<strong>Error</strong>Please Confirm Captcha Code!','custom_lp_lan') );
  } else {
      if ( wp_check_password( $password, $user->user_pass, $user->ID )) {
          return $user;
      } else {
		return new WP_Error( 'invalid credentials', __('<strong>Error</strong>Invalid Credentials!','custom_lp_lan') );
      }
  }
}, 10, 2 );




add_filter('login_errors', function ($error) {
  global $errors;
  $err_codes = $errors->get_error_codes();
  if (in_array('invalid_username', $err_codes) || in_array('incorrect_password', $err_codes)) {
	$error = __('Invalid username or password.','custom_lp_lan');
  }

  return $error;
},11,1);