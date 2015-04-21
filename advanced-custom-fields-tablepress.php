<?php
/*
Plugin Name: Advanced Custom Fields: TablePress
Description: ACF field to select one or many TablePress Tables
Version: 1.0.0
Author: @pwtyler of @tylerdigital
*/

// $version = 5 and can be ignored until ACF6 exists
function include_field_types_TablePress( $version ) {
	include_once 'tablepress-v5.php';
}

add_action( 'acf/include_field_types', 'include_field_types_tablepress' );

/* Added to check if TablePress is installed on activation. */
function tp_activate() {

	if ( defined( 'TABLEPRESS_ABSPATH' ) ) {
		return true;
	}

	$html = '<div class="error">';
	$html .= '<p>';
	$html .= _e( 'Warning: TablePress is not installed or activated. This plugin does not function without TablePress!' );
	$html .= '</p>';
	$html .= '</div>';
	echo $html;
}
register_activation_hook( __FILE__, 'tp_activate' );
