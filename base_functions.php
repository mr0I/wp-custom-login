<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function RAD_activate_function(){
  flush_rewrite_rules();
}

function RAD_deactivate_function(){
  flush_rewrite_rules();
}

