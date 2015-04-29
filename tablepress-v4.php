<?php
class acf_field_tablepress extends acf_field {
	
	var $settings,
		  $defaults; 

	function __construct() {
		$this->name = 'tablepress_field';
		$this->label = __('TablePress', 'advanced-custom-fields-tablepress' );
		$this->category = __("Relational",'acf');
		$this->defaults = array(
			'allow_null' => 0,
	    	'return_format' => 'table_id'
		);

	    parent::__construct();
	}

	function create_options( $field ) {
		
		$field = array_merge($this->defaults, $field);

		
		$key = $field['name'];

		/* Create Field Options HTML */
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Allow Null?",'acf'); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'  =>  'radio',
					'name'  =>  'fields['.$key.'][allow_null]',
					'value' =>  $field['allow_null'],
					'choices' =>  array(
						1 =>  __("Yes",'acf'),
						0 =>  __("No",'acf'),
					),
					'layout'  =>  'horizontal',
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Return Format?",'advanced-custom-fields-tablepress'); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'  =>  'radio',
					'name'  =>  'fields['.$key.'][return_format]',
					'value' =>  $field['return_format'],
					'choices' =>  array(
						'table_id' => __("Table ID - Output only the Table ID Number",'advanced-custom-fields-tablepress'),
						'rendered_html' => __("HTML - Output the rendered HTML of the table itself. Equivalent to do_shortcode(), but does not use that function.",'advanced-custom-fields-tablepress'),
					),
					'layout'  =>  'vertical',
				));
				?>
			</td>
		</tr>
	<?php
	}

	function create_field( $field ) {
		$field = array_merge($this->defaults, $field);
		$choices = array();

		/* Exits function if TablePress not active */
		if ( !defined( 'TABLEPRESS_ABSPATH' ) ) {
		  echo __('TablePress must be activated for this ACF field to work', 'advanced-custom-fields-tablepress');
		  return;
		}

		/* get list of table ID and post ID pairs */
		$table_json = get_option( 'tablepress_tables' );
		$json_dec = json_decode( $table_json, true );
		$tables = $json_dec['table_post'];

		/* Get table titles for list of choices */
		if ( !is_array( $tables ) || empty( $tables ) ) {
		  echo sprintf( __('No TablePress tables found, once you <a href="%s">add some tables</a> they\'ll show up here.', 'advanced-custom-fields-tablepress' ), admin_url( 'admin.php?page=tablepress' ) );
		  return;
		}
		
		foreach ($tables as $table_id => $post_id) {
		  $post = get_post( $post_id );
		  $choices[ $table_id ] = $post->post_title;
		}

	    $field['choices'] = $choices;
	    $field['type']    = 'select';

		do_action('acf/create_field', $field);
	}

	function format_value_for_api( $value, $post_id, $field ) {
		$field = array_merge($this->defaults, $field);

	    if ( $field['return_format'] == 'table_id' ) return $value;
	    if ( $field['return_format'] == 'rendered_html' ) {
	      if ( !function_exists( 'tablepress_get_table' ) ) {
	        return 'TablePress must be enabled';
	      }
	      $value = tablepress_get_table( array(
	        'id' => $value,
	        'use_datatables' => true,
	        'print_name' => false
	      ) );
	      return $value;
	    }
    }
}

new acf_field_tablepress();