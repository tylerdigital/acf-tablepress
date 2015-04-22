=== Advanced Custom Fields: TablePress ===
Contributors: tylerdigital, croixhaug, pwtyler
Tags: acf, tablepress, tables, advanced, custom, fields, table
Requires at least: 4.0
Tested up to: 4.2
Stable Tag: 1.0

== Description ==
This add-on for Advanced Custom Fields creates a custom field type to select a TablePress table, providing a field that lets you select from a list of tables.  The field returns the table ID number. 

This plugin requires:
    - Advanced Custom Fields version 5+ (ACF Pro)
    - TablePress version 1.5+

* This plugin does nothing unless ACF and TablePress are both active on your site *

== Installation ==
1. Copy the 'advanced-custom-fields-tablepress' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

== Using the field ==
This field returns the table ID for the table selected.

To display the chosen table on your page, simply use

```
<?php 
    $tablepress_id = get_field( 'your_field_here' );
    echo do_shortcode( '[table id="'.$tablepress_id.'"]' ); 
?>
```


== Changelog ==
= v 1.0
* Initial Release

== About ==
Written by Phil Tyler for Tyler Digital - <http://tylerdigital.com>