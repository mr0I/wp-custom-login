<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wrap">
  <h2><?php echo __('Plugin Settings', 'custom_lp_lan') ; ?></h2>
  <?php if( !isset($_GET['tab']) ) $_GET['tab'] = 'main_page';?>
  <h2 class="nav-tab-wrapper">
	<a href="?page=custom_login&tab=main_page" class="nav-tab<?php if( $_GET['tab'] == 'main_page'){echo ' nav-tab-active';};?>"><?php echo __('Main Settings', 'custom_lp_lan'); ?></a>
  </h2>

  <?php settings_errors();?>
  <form method="post" action="options.php">
	<?php
	if ( $_GET['tab'] == 'main_page' ){
	  settings_fields("main_settings_options");
	  do_settings_sections("main_settings");
	}

	submit_button();
	?>
  </form>
</div>

