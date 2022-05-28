<?php
/**
 * Plugin Name: Custom Login page
 * Plugin URI: https://sisoog.com/
 * Description: شخصی سازی صفحه ورود وردپرس
 * Version: 1.0
 * Author: Zero one
 * Author URI: https://sisoog.com/
 * Text Domain: custom_lp_lan
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
add_action('plugins_loaded', function(){
  load_plugin_textdomain('custom_lp_lan', false, basename(plugin_dir_path(__FILE__)) . '/languages/');
});

define('ROOT_DIR', plugin_dir_path(__FILE__) );
define('CLP_ADMIN', plugin_dir_path(__FILE__) . 'admin/');

include(plugin_dir_path(__FILE__). 'base_functions.php' );
register_activation_hook( __FILE__, 'RAD_activate_function');
register_deactivation_hook( __FILE__, 'RAD_deactivate_function');




function wpb_login_logo() { ?>
  <style type="text/css">
	body.login.wp-core-ui{
	  background-color: #f5f5f5;
	}
	#login h1 a, .login h1 a {
	  background-image: url(https://sisoog.com/wp-content/uploads/2017/04/logo.png);
	  height:100px;
	  width:auto;
	  background-size: 80px 100px;
	  background-repeat: no-repeat;
	  padding-bottom: 10px;
	}
  </style>

  <script src="//www.google.com/recaptcha/api.js"></script>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );


function wpb_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'wpb_login_logo_url' );

function wpb_login_logo_url_title() {
  return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'wpb_login_logo_url_title' );


add_filter( 'login_display_language_dropdown', '__return_false' );


add_action('login_form','my_added_login_field');
function my_added_login_field(){
  ?>
  <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
  <?php
}

add_filter( 'wp_authenticate_user', 'verify_recaptcha_on_login', 10, 3 );
function verify_recaptcha_on_login($user, $password) {
  $secretkey = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";

  if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
	$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response=' . $_POST['g-recaptcha-response'] );
	$response = json_decode($response['body'], true);


	if ($response['success']) return $user;
	else return new WP_Error( 'Captcha Invalid', __('<strong>خطا</strong>: کد کپچا را تایید کنید!') );

  }
  else return new WP_Error( 'Captcha Invalid', __('<strong>خطا</strong>: کد کپچا را تایید کنید!') );
}