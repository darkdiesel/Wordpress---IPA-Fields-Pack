<?php
/**
 * Plugin Name: IPA Fields Pack
 * Plugin URI: https://plus.google.com/+IgorPeshkov
 * Description: Plugin provide functionality for creating custom post type, taxonomy and fields
 * Version: 0.0.1
 * Author: Igor Peshkov (dark_diesel)
 * Author URI: https://plus.google.com/+IgorPeshkov
 * Text Domain: ipa-fields-pack
 * Domain Path: /languages/
 * License: GPL2
 */
/*  Copyright 2015  PLUGIN_AUTHOR_NAME  (email : igor.peshkov@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fields_Pack' ) ) :
	class IPA_Fields_Pack {
		/**
		 * @var IPA_Fields_Pack The single instance of the class
		 */
		protected static $_instance = NULL;

		/**
		 * @var IPA_Fields_Pack_Plugin class instance
		 */
		public $plugin = NULL;

		/**
		 * Plugin settings
		 *
		 * @var array
		 */

		function __construct() {
			$this->load_constants();
			$this->add_includes();
			$this->init_plugin();
			$this->init_hooks();
		}

		/**
		 * Initialization function to hook into the WordPress init action
		 *
		 * Instantiates the class on a global variable and sets the class, actions
		 * etc. up for use.
		 */
		static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Hook into register_activation_hook action
		 */
		static function activate() {

		}

		/**
		 * Hook into register_deactivation_hook action
		 */
		static function deactivate() {

		}

		/**
		 * Load Constants
		 *
		 * Convenience function to load the constants files for
		 * the activation and construct
		 */
		function load_constants() {
			if ( ! defined( 'IPA_FIELDS_PACK_PATH' ) ) {
				define( 'IPA_FIELDS_PACK_PATH', dirname( __FILE__ ) );
			}

			if ( ! defined( 'IPA_FIELDS_PACK_URL' ) ) {
				define( 'IPA_FIELDS_PACK_URL', plugin_dir_url( __FILE__ ) );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		function add_includes() {
			require_once( IPA_FIELDS_PACK_PATH . '/includes/plugin.php' );

			if ( $this->is_request( 'admin' ) ) {
				require_once( 'includes/admin/admin.php' );
			}

//			if ( $this->is_request( 'ajax' ) ) {
//
//			}
//
//			if ( $this->is_request( 'frontend' ) ) {
//
//			}
//
//			if ( $this->is_request( 'cron' ) ) {
//
//			}

		}

		/**
		 * Init plugin structure
		 */
		function init_plugin() {
			$this->plugin = new IPA_Fields_Pack_Plugin();
		}

		/**
		 * Add in various hooks
		 *
		 * Place all add_action, add_filter, add_shortcode hook-ins here
		 */
		function init_hooks() {
			register_activation_hook( __FILE__, array(
				__CLASS__,
				'activate'
			) );

			register_deactivation_hook( __FILE__, array(
				__CLASS__,
				'deactivate'
			) );

			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array(
				__CLASS__,
				'plugin_action_links'
			) );

			add_filter( 'plugin_row_meta', array(
				__CLASS__,
				'plugin_row_meta'
			), 10, 4 );

			add_action( 'wp_enqueue_scripts', array(
				__CLASS__,
				'load_wp_scripts'
			) );
			add_action( 'admin_enqueue_scripts', array(
				__CLASS__,
				'load_admin_scripts'
			) );
		}

		/**
		 * Load admin styles and scripts
		 */
		static function load_admin_scripts() {

		}

		/**
		 * Load wp styles and scripts
		 */
		static function load_wp_scripts() {

		}

		/**
		 * What type of request is this?
		 * string $type ajax, frontend or admin
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin' :
					return is_admin();
				case 'ajax' :
					return defined( 'DOING_AJAX' );
				case 'cron' :
					return defined( 'DOING_CRON' );
				case 'frontend' :
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		static function plugin_action_links( $links ) {
			$links[] = sprintf( '<a href="%s"><span class="dashicons dashicons-admin-generic"></span>&nbsp;%s</a>', admin_url( 'admin.php?page=ipa-fields-pack-settings' ), __( 'Settings', IPA_Fields_Pack()->plugin->get_text_domain() ) );
			$links[] = sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( 'https://plus.google.com/+IgorPeshkov' ), __( 'Igor at Google Plus', IPA_Fields_Pack()->plugin->get_text_domain() ) );

			return $links;
		}

		static function plugin_row_meta( $links, $file ) {
			if ( plugin_basename( __FILE__ ) === $file ) {
				$links[] = sprintf( '<a target="_blank" href="%s">%s</a>', esc_url( 'http://www.donationalerts.ru/r/dark_diesel' ), __( 'Donate', IPA_Fields_Pack()->plugin->get_text_domain() ) );
			}

			return $links;
		}

	}

	add_action( 'plugins_loaded', array( 'IPA_Fields_Pack', 'instance' ), 15 );
endif;

/**
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return IPA_Fields_Pack
 */
function IPA_Fields_Pack() {
	return IPA_Fields_Pack::instance();
}

// Global for backwards compatibility.
$GLOBALS['ipa-fields-pack'] = IPA_Fields_Pack();