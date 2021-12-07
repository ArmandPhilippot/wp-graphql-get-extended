<?php
/**
 * Define the core plugin class.
 *
 * @package WP_GraphQL_Get_Extended
 * @link    https://github.com/ArmandPhilippot/wp-graphql-get-extended
 * @since   0.1.0
 */

namespace WP_GraphQL_Get_Extended;

/**
 * The core plugin class.
 *
 * This class defines defines internationalization, admin hooks, and public
 * hooks.
 */
class WP_GraphQL_Get_Extended {

	/**
	 * The plugin name.
	 *
	 * @since 0.1.0
	 * @var string $plugin_name The plugin name.
	 */
	protected $plugin_name;

	/**
	 * The description of this plugin.
	 *
	 * @since  0.1.0
	 *
	 * @access protected
	 * @var    string The string used as description of this plugin.
	 */
	protected $plugin_description;

	/**
	 * The plugin version.
	 *
	 * @since 0.1.0
	 * @var string $plugin_version The current plugin version.
	 */
	protected $plugin_version;

	/**
	 * Define the plugin functionality.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->plugin_version     = defined( WP_GRAPHQL_GET_EXTENDED_VERSION ) ? WP_GRAPHQL_GET_EXTENDED_VERSION : '1.0.0';
		$this->plugin_name        = 'WP GraphQL Get Extended';
		$this->plugin_description = __( 'Adds a WP GraphQL field that replicate get_extended() function behavior.', 'wpg-get-extended' );

		$this->load_dependencies();
		$this->set_locale();
	}

	/**
	 * Loads the required dependencies for this plugin.
	 *
	 * @since  0.1.0
	 *
	 * @access private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for defining internationalization
		 * functionality of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-graphql-get-extended-i18n.php';
	}

	/**
	 * Define the locale used by the plugin.
	 *
	 * @since 0.1.0
	 */
	private function set_locale() {
		$translation = new WP_GraphQL_Get_Extended_I18n();
		$translation->init();
	}

	/**
	 * Execute the plugin.
	 *
	 * @since 0.1.0
	 */
	public function run() {
		$this->set_locale();
	}

	/**
	 * Retrieve the plugin name.
	 *
	 * @since 0.1.0
	 *
	 * @return string The plugin name.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieves the description of the plugin.
	 *
	 * @since 0.1.0
	 *
	 * @return string The description of the plugin.
	 */
	public function get_plugin_description() {
		return $this->plugin_description;
	}

	/**
	 * Retrieve the current plugin version.
	 *
	 * @since 0.1.0
	 *
	 * @return string The current version of the plugin.
	 */
	public function get_plugin_version() {
		return $this->plugin_version;
	}
}
