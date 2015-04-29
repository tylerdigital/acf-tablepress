=== Advanced Custom Fields: TablePress ===
Contributors: tylerdigital, pwtyler, croixhaug 
Tags: advanced custom fields, acf, tablepress, tables, table, select table, embed table
Requires at least: 4.0
Tested up to: 4.2
Stable Tag: 1.0

== Description ==
** This is an extension for the popular [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin and [TablePress](https://wordpress.org/plugins/tablepress/) plugin. By itself, this plugin does NOTHING. **

This add-on for Advanced Custom Fields creates a custom field type to select a TablePress table, providing a dropdown menu that lets you select from a list of avaliable tables.  The field returns the table ID number. 

This plugin Requires:
    - Advanced Custom Fields version 4+ or 5+
    - TablePress version 1.5+

* I know it was already mentioned, but just to be sure there's no confusion... ** This plugin does nothing unless [ACF](https://wordpress.org/plugins/advanced-custom-fields/) and [TablePress](https://wordpress.org/plugins/tablepress/) are both active on your site **

== Installation ==
1. Copy the 'advanced-custom-fields-tablepress' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

== Using the field ==
This field can return the table ID for the table selected, or the HTML of the table itself.

When returning the table ID, either of the following code will output your table.
```
<?php 
    $tablepress_id = get_field( 'your_field_here' );
    echo do_shortcode( '[table id="'.$tablepress_id.'"]' ); 
?>
```
or, to avoid using `do_shortcode()`, use
```
<?php
    $tablepress_id = get_field( 'your_field_here' );
    $args = array(
      'id'                => $tablepress_id,
      'use_datatables'    => true,
      'print_name'        => false
    );
    if ( function_exists( 'tablepress_print_table' ) ) {
      tablepress_print_table( $args );
    }
?>
```

To simply display the chosen table on your page, choose the HTML output option, and insert into your php with `the_field( 'your_field_here' )`.

== Changelog ==
= v 1.0
* Initial Release