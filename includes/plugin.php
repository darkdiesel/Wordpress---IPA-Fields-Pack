<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fields_Pack_Plugin' ) ):
	class IPA_Fields_Pack_Plugin {
		public $plugin_settings_option = 'ipa-fields-pack';

		public $plugin_data;
		public $plugin_settings;

		function __construct() {

		}

		/**
		 *
		 * Function return plugin data
		 *
		 * @return array
		 */
		public function get_data() {
			if ( ! $this->plugin_data ) {
				$this->plugin_data = get_plugin_data( IPA_FIELDS_PACK_PATH . '/ipa-fields-pack.php' );
			}

			return $this->plugin_data;
		}

		/**
		 * Return plugin text domain
		 *
		 * @return string
		 */
		public function get_text_domain() {
			return 'ipa-fields-pack';
		}

		public function get_settings() {
			if ( ! $this->plugin_settings ) {
				//$this->plugin_settings = IPA_PostMeta()->get_option_arr( $this->plugin_settings_option );
			}

			return $this->plugin_settings;
		}
	}
endif;