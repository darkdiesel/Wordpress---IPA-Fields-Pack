<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fields_Pack_Admin_Menu_Taxonomy_Add' ) ):
	class IPA_Fields_Pack_Admin_Menu_Taxonomy_Add {

		public static function admin_menu_output() {
			?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php echo __( 'IPA Fields Pack - Add New Taxonomy' ); ?></h1>
				<?php
				printf(
					'<a class="page-title-action" href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => 'ipa-fields-pack-taxonomy-list',
							),
							admin_url( 'admin.php' )
						)
					),
					__( 'Taxonomies List', IPA_Fields_Pack()->plugin->get_text_domain() )
				);
				?>

                <hr class="wp-header-end">

                <form action="">
                    <div id="poststuff">
                        <div class="post-body">
                            <div class="postbox-container">
                                <div class="postbox">
                                    <h2 class="hndle">
                                        <span><?php esc_html_e( 'Taxonomy Settings', IPA_Fields_Pack()->plugin->get_text_domain() ); ?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

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
