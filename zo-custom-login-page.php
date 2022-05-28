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
define('CLP_ADMIN_VIEW', plugin_dir_path(__FILE__) . 'admin/views/');
define('CLP_INC', plugin_dir_path(__FILE__) . 'inc/');
define('CLP_ASSETS', plugin_dir_url(__FILE__) . 'assets/');

include(plugin_dir_path(__FILE__). 'base_functions.php' );
register_activation_hook( __FILE__, 'RAD_activate_function');
register_deactivation_hook( __FILE__, 'RAD_deactivate_function');

if (is_admin()) include(CLP_ADMIN . 'admin_proccess.php');


// functions
require_once CLP_INC . 'functions.php';