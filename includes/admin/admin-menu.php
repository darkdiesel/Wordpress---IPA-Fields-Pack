<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fields_Pack_Admin_Menu' ) ):
	class IPA_Fields_Pack_Admin_Menu {
		public $pages_hooks = array();

		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
			add_action( 'admin_enqueue_scripts', array(
				$this,
				'admin_menu_settings_scripts'
			) );

			include_once( 'admin-menu-settings.php' );
			include_once( 'admin-menu-taxonomy-list.php' );
			include_once( 'admin-menu-taxonomy-add.php' );
		}

		public function admin_menu() {
			add_menu_page( __( 'IPA Fields Pack' ), __( 'IPA Fields Pack' ), 'manage_options', 'ipa-fields-pack', NULL, 'dashicons-admin-tools', '103.5' );

			$this->pages_hooks['taxonomy_list_page_hook'] = add_submenu_page( 'ipa-fields-pack', __( 'Taxonomies', IPA_Fields_Pack()->plugin->get_text_domain() ), __( 'Taxonomies', IPA_Fields_Pack()->plugin->get_text_domain() ), 'manage_options', 'ipa-fields-pack-taxonomy-list', array(
				'IPA_Fields_Pack_Admin_Menu_Taxonomy_List',
				'admin_menu_output'
			) );

			$this->pages_hooks['taxonomy_add_page_hook'] = add_submenu_page( 'ipa-fields-pack', __( 'Add Taxonomy', IPA_Fields_Pack()->plugin->get_text_domain() ), __( 'Add Taxonomy', IPA_Fields_Pack()->plugin->get_text_domain() ), 'manage_options', 'ipa-fields-pack-taxonomy-add', array(
				'IPA_Fields_Pack_Admin_Menu_Taxonomy_Add',
				'admin_menu_output'
			) );

			$this->pages_hooks['settings_page_hook'] = add_submenu_page( 'ipa-fields-pack', __( 'Settings', IPA_Fields_Pack()->plugin->get_text_domain() ), __( 'Settings', IPA_Fields_Pack()->plugin->get_text_domain() ), 'manage_options', 'ipa-fields-pack-settings', array(
				'IPA_Fields_Pack_Admin_Menu_Settings',
				'admin_menu_output'
			) );
		}

		public function admin_menu_settings_scripts( $hook ) {
			if ( ! in_array( $hook, $this->pages_hooks ) ) {
				return;
			}

			$plugin_data = IPA_Fields_Pack()->plugin->get_data();

			wp_register_style( 'ipa-fields-pack-admin-style', IPA_FIELDS_PACK_URL . '/assets/css/admin.css', FALSE, $plugin_data['Version'] );
			wp_enqueue_style( 'ipa-fields-pack-admin-style' );

			if ( $this->pages_hooks['settings_page_hook'] == $hook ) {
				IPA_Fields_Pack_Admin_Menu_Settings::admin_menu_scripts( $plugin_data );
			}
		}

	}
endif;

return new IPA_Fields_Pack_Admin_Menu();