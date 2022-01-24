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
 * This class defines internationalization, admin hooks, and public hooks.
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
	 * Register a new contentPartsType type.
	 *
	 * @since 0.1.0
	 */
	public function register_content_parts_type_to_graphql() {
		$type_description        = __( 'The get_extended content parts.', 'wpg-get-extended' );
		$before_more_description = __( 'The get_extended content part before more tag.', 'wpg-get-extended' );
		$after_more_description  = __( 'The get_extended content part after more tag.', 'wpg-get-extended' );
		$format_description      = __( 'Format of the field output', 'wpg-get-extended' );

		register_graphql_object_type(
			'ContentPartsType',
			array(
				'description' => $type_description,
				'fields'      => array(
					'beforeMore' => array(
						'type'        => 'String',
						'description' => $before_more_description,
						'args'        => array(
							'format' => array(
								'type'        => 'PostObjectFieldFormatEnum',
								'description' => $format_description,
							),
						),
						'resolve'     => function( $source, $args ) {
							$content = $source['rendered']['before'];
							if ( isset( $args['format'] ) && 'raw' === $args['format'] ) {
								$content = $source['raw']['before'];
							}

							return $content;
						},
					),
					'afterMore' => array(
						'type'        => 'String',
						'description' => $after_more_description,
						'args'        => array(
							'format' => array(
								'type'        => 'PostObjectFieldFormatEnum',
								'description' => $format_description,
							),
						),
						'resolve'     => function( $source, $args ) {
							$content = $source['rendered']['after'];
							if ( isset( $args['format'] ) && 'raw' === $args['format'] ) {
								$content = $source['raw']['after'];
							}

							return $content;
						},
					),
				),
			)
		);
	}

	/**
	 * Register a new contentParts field for Post Type.
	 *
	 * @since 0.1.0
	 */
	public function add_content_parts_field_to_graphql() {
		$type        = 'ContentPartsType';
		$description = __( 'The content parts.', 'wpg-get-extended' );

		register_graphql_field(
			'ContentNode',
			'contentParts',
			array(
				'type'        => $type,
				'description' => $description,
				'resolve'     => function( \WPGraphQL\Model\Post $post_model ) {
					// phpcs:ignore WordPress.NamingConventions.ValidVariableName
					$raw_content = $post_model->contentRaw;
					$raw_content_parts = get_extended( $raw_content );

					// phpcs:ignore WordPress.NamingConventions.ValidVariableName
					$rendered_content = $post_model->contentRendered;
					$rendered_content_parts = get_extended( $rendered_content );

					return array(
						'raw'      => array(
							'before' => $raw_content_parts['main'],
							'after'  => $raw_content_parts['extended'],
						),
						'rendered' => array(
							'before' => $rendered_content_parts['main'],
							'after'  => $rendered_content_parts['extended'],
						),
					);
				},
			)
		);
	}

	/**
	 * Print an error notice during activation.
	 *
	 * @since 0.1.0
	 */
	public function print_plugin_activation_error() {
		include_once 'partials/wp-graphql-get-extended-error-notice.php';
	}

	/**
	 * Check if WPGraphQL is installed and activated.
	 *
	 * @since 0.1.0
	 */
	public function check_plugin_dependencies() {
		if ( ! class_exists( '\WPGraphQL' ) ) {
			add_action( 'admin_notices', array( $this, 'print_plugin_activation_error' ) );
		}
	}

	/**
	 * Execute the plugin.
	 *
	 * @since 0.1.0
	 */
	public function run() {
		$this->set_locale();
		add_action( 'plugins_loaded', array( $this, 'check_plugin_dependencies' ) );
		add_action( 'graphql_register_types', array( $this, 'register_content_parts_type_to_graphql' ) );
		add_action( 'graphql_register_types', array( $this, 'add_content_parts_field_to_graphql' ) );
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
