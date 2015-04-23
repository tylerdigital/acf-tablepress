<?php
class acf_field_tablepress extends acf_field {
  
  function __construct() {
    $this->name = 'tablepress_field';
    $this->label = __('TablePress');
    $this->category = __("Relational",'acf');
    $this->defaults = array(
      'allow_null' => 0
    );

    parent::__construct();
  }
  
  function render_field_settings( $field ) {
    
    acf_render_field_setting( $field, array(
      'label' => 'Allow Null?',
      'type'  =>  'radio',
      'name'  =>  'allow_null',
      'choices' =>  array(
        1 =>  __("Yes",'acf'),
        0 =>  __("No",'acf'),
      ),
      'layout'  =>  'horizontal'
    ));

  }
  
  function render_field( $field ) {
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
    $choices = array();
    if ( !is_array( $tables ) || empty( $tables ) ) {
      echo sprintf( __('No TablePress tables found, once you <a href="%s">add some tables</a> they\'ll show up here.', 'advanced-custom-fields-tablepress' ), admin_url( 'admin.php?page=tablepress' ) );
      return;
    }
    
    foreach ($tables as $table_id => $post_id) {
      $post = get_post( $post_id );
      $choices[ $table_id ] = $post->post_title;
    }

    // override field settings and render
    $field['choices'] = $choices;
    $field['type']    = 'select';
    ?>
      <select id="<?php echo str_replace(array('[',']'), array('-',''), $field['name']);?>" name="<?php echo $field['name']; ?>">
        <?php
					if ( $field['allow_null'] ) echo '<option value="">- '. __('Select', 'advanced-custom-fields-tablepress') .' -</option>';
          foreach ($field['choices'] as $key => $value) : 
            $selected = '';
						
						if ( (is_array($field['value']) && in_array($key, $field['value'])) || $field['value'] == $key )
              $selected = ' selected="selected"';
            ?>
            <option value="<?php echo $key; ?>"<?php echo $selected;?>><?php echo $value; ?></option>
          <?php endforeach;
        ?>
      </select>
    <?php
  }
    
  function format_value( $value, $post_id, $field ) {
    return $value;
  }
}

new acf_field_tablepress();