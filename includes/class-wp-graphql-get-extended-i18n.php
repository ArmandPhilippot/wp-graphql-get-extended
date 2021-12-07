<?php
/**
 * Fired during plugin activation.
 *
 * @package WP_GraphQL_Get_Extended
 * @link    https://github.com/ArmandPhilippot/wp-graphql-get-extended
 * @since   0.1.0
 */

namespace WP_GraphQL_Get_Extended;

/**
 * The responsible class of plugin internationalization.
 *
 * This class defines and load all the files needed for translation.
 *
 * @since 0.1.0
 */
class WP_GraphQL_Get_Extended_I18n {
	/**
	 * Load textdomain once plugin is loaded.
	 *
	 * @since 0.1.0
	 */
	public function init() {
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Load the plugin text domain.
	 *
	 * @since 0.1.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'wpg-get-extended', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}
}
