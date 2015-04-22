<?php
/*
Plugin Name: Advanced Custom Fields: TablePress
Description: ACF field to select one or many TablePress Tables
Version: 1.0
Author: Tyler Digital
Author URI: http://tylerdigital.com
Author Email: support@tylerdigital.com
Text Domain: advanced-custom-fields-tablepress
License:
  Copyright 2015 Tyler Digital

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 3, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

// $version = 5 and can be ignored until ACF6 exists
function include_field_types_TablePress( $version ) {
	include_once 'tablepress-v5.php';
}

add_action( 'acf/include_field_types', 'include_field_types_tablepress' );

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'acftp_register_required_plugins' );
function acftp_register_required_plugins() {

	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Tablepress',
			'slug'      => 'tablepress',
			'required'  => true,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins for ACF TablePress Add-On', 'advanced-custom-fields-tablepress' ),
			'menu_title'                      => __( 'Install ACF TablePress Plugins', 'advanced-custom-fields-tablepress' ),
			'installing'                      => __( 'Installing Plugin: %s', 'advanced-custom-fields-tablepress' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'advanced-custom-fields-tablepress' ),
			'notice_can_install_required'     => _n_noop( 'The ACF: TablePress add-on requires the following plugin: %1$s.', 'The ACF: TablePress add-on requires the following plugins: %1$s.', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'The ACF: TablePress add-on recommends the following plugin: %1$s.', 'The ACF: TablePress add-on recommends the following plugins: %1$s.', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The ACF: TablePress add-on requires the plugin %1$s to be active.', 'The ACF: TablePress add-on requires the plugins %1$s to be active', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The ACF: TablePress add-on recommends the plugin %1$s to be active.', 'The following recommended plugins are currently inactive: %1$s.', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this plugin: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this plugin: %1$s.', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'advanced-custom-fields-tablepress' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'advanced-custom-fields-tablepress' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'advanced-custom-fields-tablepress' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'advanced-custom-fields-tablepress' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'advanced-custom-fields-tablepress' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'advanced-custom-fields-tablepress' ), // %s = dashboard link.
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );
}

add_filter( 'tgmpa_admin_menu_args', 'acftp_tgmpa_admin_menu_args', 10, 1 );
function acftp_tgmpa_admin_menu_args( $args ) {
	$args['parent_slug'] = 'plugins.php';
	return $args;
}
add_filter('tgmpa_admin_menu_use_add_theme_page', '__return_false' );