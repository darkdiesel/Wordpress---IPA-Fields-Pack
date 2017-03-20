<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fields_Pack_Admin_Menu_Taxonomy_List' ) ):
	class IPA_Fields_Pack_Admin_Menu_Taxonomy_List {

		public static function admin_menu_output() {
			?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php echo __( 'IPA Fields Pack - Taxonomies List' ); ?></h1>
				<?php
				printf(
					'<a class="button-primary page-title-action" href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => 'ipa-fields-pack-taxonomy-add',
							),
							admin_url( 'admin.php' )
						)
					),
					__( 'Add New Taxonomy', IPA_Fields_Pack()->plugin->get_text_domain() )
				);
				?>

                <hr class="wp-header-end">

                <div class="ajax-process">
                    <img src="<?php echo admin_url( 'images/spinner.gif' ) ?>"
                         alt="<?php echo __( 'Loading', IPA_Fields_Pack()->plugin->get_text_domain() ); ?>">
                </div>

                <div class="ajax-process">
                    <img src="<?php echo admin_url( 'images/spinner.gif' ) ?>"
                         alt="<?php echo __( 'Loading', IPA_Fields_Pack()->plugin->get_text_domain() ); ?>">
                </div>
            </div>
			<?php
		}


		public
		static function admin_menu_scripts(
			$plugin_data
		) {

		}
	}
endif;
