<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



add_action('admin_menu', 'custom_lp_lan_creat_admin_menu');
function custom_lp_lan_creat_admin_menu(){
  global $custom_lp_lan_page_hook;

  $custom_lp_lan_page_hook = add_menu_page(
	  __('Custom Login', 'custom_lp_lan'),
	  __('Custom Login', 'custom_lp_lan'),
	  'administrator',
	  'custom_login',
	  function(){include(CLP_ADMIN_VIEW . 'settings.php');},
	  'dashicons-admin-network'
  );

}

/* Start Options */
add_action("admin_init", function(){
  add_settings_section('main_settings_options', __('General Settings', 'custom_lp_lan'), null, 'main_settings');
  add_settings_field('CLP_google_site_key', __('Site Key', 'custom_lp_lan'), 'CLP_google_site_key_callback'
	  , 'main_settings', 'main_settings_options');
  add_settings_field('CLP_google_secret_key', __('Secret Key', 'custom_lp_lan'), 'CLP_google_secret_key_callback'
	  , 'main_settings', 'main_settings_options');


 // register settings
  register_setting('main_settings_options', 'CLP_google_site_key', 'sanitize_text_field');
  register_setting('main_settings_options', 'CLP_google_secret_key', 'sanitize_text_field');
});


function CLP_google_site_key_callback() {
  echo '<input class="ltr left-align" type="text" name="CLP_google_site_key" id="CLP_google_site_key"
	value="' . get_option( 'CLP_google_site_key', '' ) . '"
	 style="max-width: 100%;min-width: 400px" required />';
}
function CLP_google_secret_key_callback(){
  echo '<input class="ltr left-align" type="text" name="CLP_google_secret_key" id="CLP_google_secret_key"
	value="' . get_option('CLP_google_secret_key','') . '"
	 style="max-width: 100%;min-width: 400px" required />';
}
/* End Options */






