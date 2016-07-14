=== ACF: TablePress ===
Contributors: tylerdigital, pwtyler, croixhaug 
Tags: advanced custom fields, acf, tablepress, tables, table, select table, embed table
Requires at least: 4.0
Tested up to: 4.5.2
Stable tag: 1.3.2

ACF field type to select a TablePress table

== Description ==
**This is an extension for the popular [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin and [TablePress](https://wordpress.org/plugins/tablepress/) plugin. By itself, this plugin does NOTHING.**

This add-on for Advanced Custom Fields creates a custom field type to select a TablePress table, providing a dropdown menu that lets you select from a list of available tables. The field can return the table ID for the table selected, or the full HTML of the table. 

**This plugin requires:**

  * Advanced Custom Fields version 4+ or 5+
  * TablePress version 1.5+

*Just to be sure there's no confusion...* **This plugin does nothing unless [ACF](https://wordpress.org/plugins/advanced-custom-fields/) (Or [ACF Pro](http://www.advancedcustomfields.com/pro/)) and [TablePress](https://wordpress.org/plugins/tablepress/) are both active on your site**

**Follow this plugin on [GitHub](https://github.com/tylerdigital/acf-tablepress)**

== Installation ==
1. Copy the `acf-tablepress` folder into your plugins folder
2. Activate the plugin via the Plugins admin page

== Using the Field ==
This field can return the table ID for the table selected, or the full HTML of the table (the same output as the rendered shortcode).

When returning the table ID, either of the following code snippets will output your table (replacing 'your_table_here' with the field name you defined in your ACF Field Group settings).
`
<?php 
    $tablepress_id = get_field( 'your_field_here' );
    echo do_shortcode( '[table id="'.$tablepress_id.'"]' ); 
?>
`
or, to avoid using `do_shortcode()`, use
`
<?php
    $tablepress_id = get_field( 'your_field_here' );
    $args = array(
      'id' => $tablepress_id,
    );
    if ( function_exists( 'tablepress_print_table' ) ) {
      tablepress_print_table( $args );
    }
?>
`

To simply display the chosen table on your page, choose the HTML output option in your field settings, and insert into your php with 
`
the_field( 'your_field_here' );
`

For a more detailed explanation, see our article, [Setting up an ACF field for TablePress](http://tylerdigital.com/document/setting-up-an-acf-field-for-tablepress/).

== Changelog ==

= 1.3.2 =
* Fix: Fixed bug that prevented non-administrator users from inserting tables.
* Fix: Fixed bug that failed to display the table while logged out and using "HTML Output"

= 1.3.1 =
* Fix: Fixed undefined variable notices introduced in 1.3.

= 1.3 =
* Update: Improved activation check: plugin now checks for Advanced Custom Fields as well as TablePress before activating.

= 1.2.2 =
* Update: Drop-down list sorts by table title instead of table ID.

= 1.2.1 =
* Fix: bug intoducted in last update displaying wrong version number.

= 1.2 =
* Update: Updated TGM-Plugin-Activation library to 2.5.2

= 1.1 =
* New: Added i18n support
* New: Added Portuguese translations (pt_PT, pt_BR)
* Update: Changed text domain to match the plugin slug ('acf-tablepress')
* Update: Removed hard-coded settings in rendered tables

= 1.0 =
* Initial Release