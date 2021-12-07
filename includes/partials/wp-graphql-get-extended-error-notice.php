<?php
/**
 * Provide an error notice view during plugin activation.
 *
 * This file is used to markup the error notice during activation.
 *
 * @package WP_GraphQL_Get_Extended
 * @link    https://github.com/ArmandPhilippot/wp-graphql-get-extended
 * @since   0.1.0
 */

?>
<div class="notice notice-error">
	<p><?php esc_html_e( 'WPGraphQL plugin need to be installed and activated in order for WP GraphQL Get Extended to work.', 'wpg-get-extended' ); ?></p>
</div>
