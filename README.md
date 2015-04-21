Advanced Custom Fields: Tablepress
=======================

This is an Advanced Custom Field custom field to select a Tablepress table,
providing a field that lets you select from a list of tables.

Compatibility
============

This add-on will work with:

* version 5 and up

Installation
============

This add-on can be treated as both a WP plugin and a theme include.

*Plugin*
1. Copy the 'advanced-custom-fields-tablepress' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

*Include*
1.  Copy the 'advanced-custom-fields-tablepress' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.  Edit your functions.php file and add the code below (Make sure the path is correct to include the advanced-custom-fields-tablepress.php file)

```
  include_once('advanced-custom-fields-tablepress.php');
```

Using the field
===============

This field returns the table ID for the table selected.

To display the chosen table on your page, simply use

```
<?php 
    $tablepress_id = get_field( 'your_field_here' );
    echo do_shortcode( '[table id='.$tablepress_id.' /]' ); 
?>
```



About
=====

Version: 1.0

Written by Phil Tyler for Tyler Digital - <http://tylerdigital.com>

Credits
=======

This plugin is based on Gravity-Forms-ACF-Field by Adam Pope of Storm Consultancy - https://github.com/stormuk/Gravity-Forms-ACF-Field

His plugin was in turn based on Lewis Mcarey's Users Field ACF add-on - https://github.com/lewismcarey/User-Field-ACF-Add-on

