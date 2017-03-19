<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fields_Pack_Admin_Menu_Settings' ) ):
	class IPA_Fields_Pack_Admin_Menu_Settings {

		public static function admin_menu_output() {
			$settings = IPA_Fields_Pack()->plugin->get_settings();

			?>
            <div class="wrap">
                <div class="wrap-header">
                    <h1><?php echo __( 'IPA Fields Pack - Settings' ); ?></h1>
                </div>

                <form id="ipa-fields-pack-settings-form"
                      novalidate="novalidate" action="" method="post">
                    <input
                            class="button button-primary button-large button-submit ipa-fields-pack-settings-submit"
                            type="submit"
                            name="ipa-fields-pack-settings-submit"
                            value="<?php echo __( 'Save settings' ) ?>"/>
                    <span class="ajax-process">
                     <img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt="">
                    </span>

                    <div class="ipa-postbox">
                        <h2 class="ipa-hndle">
                            <span><?php echo __( 'Settings' ); ?></span></h2>
                        <div class="ipa-inside">
                            <table class="form-table">
                                <tbody>
								<?php
								if ( function_exists( 'IPA_PostMeta' ) ) {
									$fields = IPA_Fields_Pack()->plugin->get_settings_fields_arr();

									foreach ( $fields as $field ) {
										if ( isset( $settings[ $field['name'] ] ) ) {
											$value = $settings[ $field['name'] ];
										} else {
											$value = FALSE;
										}

										echo IPA_PostMeta()->field->build( $field, $value );
									}
								} else { ?>
                                    <div class="notice notice-error">
										<?php echo _( 'For printing fields you need install and activate IPA_PostMeta Plugin' ); ?>
                                    </div>
								<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <input
                            class="button button-primary button-large button-submit ipa-fields-pack-settings-submit"
                            type="submit"
                            name="ipa-fields-pack-settings-submit"
                            value="<?php echo __( 'Save settings' ) ?>"/>
                    <span class="ajax-process">
				<img src="<?php echo admin_url( 'images/spinner.gif' ) ?>"
                     alt="">
		  </span>
                </form>
            </div>
			<?php
		}

		public static function plugin_settings_ajax_save() {
			if ( ! isset( $_POST['ipa_fields_pack_menu_settings_wpnonce'] ) || ! wp_verify_nonce( $_POST['ipa_fields_pack_menu_settings_wpnonce'], 'ipa_fields_pack_menu_settings_wpnonce' ) ) {
				die( _( 'Permission check failed' ) );
			}

			//build setting array
			$settings = array();

			if ( isset( $_POST['form'] ) ) {
				foreach ( $_POST['form'] as $option ) {
					if ( strpos( $option['name'], '[]' ) ) {
						$settings[ substr( $option['name'], 0, strpos( $option['name'], '[]' ) ) ][] = $option['value'];
					} else {
						$settings[ $option['name'] ] = $option['value'];
					}
				}
			}

			//save plugin settings
			update_option( IPA_Fields_Pack()->plugin->plugin_settings_option, wp_slash( json_encode( $settings ) ) );

			//create response
			$response = array();

			$response['ajax']    = 'success';
			$response['message'] = sprintf( '<strong>%s</strong>', _( 'Settings successfully saved!' ) );
			$response['fields']  = $settings;

			//return json
			echo json_encode( $response );

			die();
		}

		public static function admin_menu_scripts( $plugin_data ) {
			wp_deregister_script( 'ipa-fields-pack-menu-settings-script' );
			wp_register_script( 'ipa-fields-pack-menu-settings-script', IPA_FIELDS_PACK_URL . '/assets/js/settings.js', array( 'jquery' ), $plugin_data['Version'] );
			wp_enqueue_script( 'ipa-fields-pack-menu-settings-script' );

			wp_localize_script(
				'ipa-fields-pack-menu-settings-script', 'ipa_fields_pack_menu_settings_vars', array( 'ipa_fields_pack_menu_settings_wpnonce' => wp_create_nonce( 'ipa_fields_pack_menu_settings_wpnonce' ) )
			);
		}
	}
endif;

// class actions
add_action( "wp_ajax_ipa_fields_pack_settings_save", array(
	'IPA_Fields_Pack_Admin_Menu_Settings',
	'plugin_settings_ajax_save'
) );