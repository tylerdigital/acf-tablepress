<?php
/*
Plugin Name: Advanced Custom Fields: TablePress
Description: ACF field to select one or many TablePress tables
Version: 1.2.2
Author: Tyler Digital
Author URI: http://tylerdigital.com
Author Email: support@tylerdigital.com
Text Domain: acf-tablepress
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

function acftp_init() {
    if ( current_user_can( 'activate_plugins' ) && (!class_exists( 'acf' ) || !class_exists( 'TablePress' ) ) ) {
        add_action( 'admin_init', 'my_plugin_deactivate' );
        add_action( 'admin_notices', 'my_plugin_admin_notice' );
        function my_plugin_deactivate() {
          deactivate_plugins( plugin_basename( __FILE__ ) );
        }
        function my_plugin_admin_notice() {
            echo "<div class=\"error\"><p><strong>" . __( '"ACF: TablePress"</strong> requires <strong>TablePress</strong> and <strong>Advanced Custom Fields</strong> to function correctly. Please ensure both plugins are active before activating <strong>ACF: TablePress</strong>. For now, the plugin has been deactivated.', 'acf-tablepress' ) . "</p></div>";

           if ( isset( $_GET['activate'] ) )
                unset( $_GET['activate'] );
        }
    } else {
    	/* For ACF 5  */
    	// $version = 5 and can be ignored until ACF6 exists
    	function include_field_types_tablepress( $version ) {
    		include_once 'tablepress-v5.php';
    	}

    	add_action( 'acf/include_field_types', 'include_field_types_tablepress' );

    	/* For ACF 4  */
    	function register_fields_tablepress() {
    	  include_once('tablepress-v4.php');
    	}

    	add_action('acf/register_fields', 'register_fields_tablepress');

		add_action( 'init', 'acftp_load_plugin_textdomain' );
		function acftp_load_plugin_textdomain() {
		    $domain = 'acf-tablepress';
		    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR . '/' .$domain. '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
    }
}

add_action( 'plugins_loaded', 'acftp_init' );
