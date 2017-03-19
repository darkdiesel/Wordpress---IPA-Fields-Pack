<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fields_Pack_Admin' ) ):
	class IPA_Fields_Pack_Admin {
		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );

			add_action( 'admin_notices', array(
				'IPA_Fields_Pack_Admin_Notices',
				'check_relation_plugin'
			) );
		}

		public function includes() {
			include_once( 'admin-menu.php' );
			include_once( 'admin-notices.php' );
		}
	}
endif;

return new IPA_Fields_Pack_Admin();