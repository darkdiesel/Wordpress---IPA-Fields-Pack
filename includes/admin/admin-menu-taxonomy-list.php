<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!class_exists('IPA_Fields_Pack_Admin_Menu_User_Coupons')):
  class IPA_Fields_Pack_Admin_Menu_User_Coupons {

	public static function admin_menu_output() {
	  ?>
	  <div class="wrap ipa-wrap">
		<div class="wrap-header">
		  <h1><?php echo __( 'IPA Fields Pack - Taxonomies List' ); ?></h1>
		</div>

		<div class="ajax-process">
		  	<img src="<?php echo admin_url('images/spinner.gif') ?>" alt="<?php echo __('Loading'); ?>">
		  </div>

		<div class="ajax-process">
		  	<img src="<?php echo admin_url('images/spinner.gif') ?>" alt="<?php echo __('Loading'); ?>">
		  </div>
	  </div>
	  <?php
	}


	public static function admin_menu_scripts($plugin_data) {

	}
  }
endif;
