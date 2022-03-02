<?php
/**
 * WP GraphQL Get Extended
 *
 * Plugin definition.
 *
 * @package   WP_GraphQL_Get_Extended
 * @link      https://github.com/ArmandPhilippot/wp-graphql-get-extended
 * @author    Armand Philippot <contact@armandphilippot.com>
 *
 * @copyright 2021 Armand Philippot
 * @license   GPL-2.0-or-later
 * @since     0.1.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP GraphQL Get Extended
 * Plugin URI:        https://github.com/ArmandPhilippot/wp-graphql-get-extended#readme
 * Description:       Adds a WP GraphQL field that replicate get_extended() function behavior.
 * Author:            Armand Philippot
 * Author URI:        https://www.armandphilippot.com
 * Text Domain:       wpg-get-extended
 * Domain Path:       /languages
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.3
 */

use WP_GraphQL_Get_Extended\WP_GraphQL_Get_Extended;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Currently plugin version.
 */
define( 'WP_GRAPHQL_GET_EXTENDED_VERSION', '1.0.1' );

/**
 * Initialize the plugin.
 *
 * @since 0.1.0
 */
function wp_graphql_get_extended_init() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-graphql-get-extended.php';

	$plugin = new WP_GraphQL_Get_Extended();
	$plugin->run();
}

wp_graphql_get_extended_init();
