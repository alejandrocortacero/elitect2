<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormTableVariableField' ) )
{

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'request-reader.php' );

class JLCCustomFormTableVariableField implements JLCCustomFormRequestReader
{
	protected static $blank_rows = array();

	protected $name;

	protected $rows;
	protected $cols;

	protected $value;
	protected $label;

	protected $id;
	protected $class;

	protected $disabled;
	protected $readonly;

	protected $attributes;

	protected $help;

	protected $col_labels;

	protected $format;

	protected $add_row_text;
	protected $remove_row_text;

	/**
	 * $cols	array of arrays containing field definitions.
	 *			array(
	 *				'type' (if empty => text)
	 *				'name' (if empty => current position)
	 *				... (specific field args)
	 * $value	multidimentsional array
	 *
	 * NOTE:
	 *			If $rows is a fixed value, the field will show 
	 *			these rows and read data for this rows too.
	 *			If rows is variable (i.e: suppose $rows has been
	 *			passed from form constructor arguments at printing
	 *			time but these values has not been set at processing
	 *			time), then rows will be generated from submitted value.
	 */
	public function __construct(
		$name,
		$cols,
		$value = "",
		$label = "",
		$col_labels = null,
		$format = 'sheet',
		$add_row_text = null,
		$remove_row_text = null,
		$help = null,
		$id = null,
		$class = null,
		$disabled = null,
		$readonly = null,
		$attributes = array()
	) {
		$this->name = $name;

		$this->cols = $cols;
		$this->rows = array();
		$this->initialize_cells( $cols, $value );

		//$this->value = $value;
		if( is_string( $value ) )
			$this->set_value_from_csv( $value );
		else
			$this->set_value( $value );

		$this->label = $label;

		$this->id = $id;
		$this->class = $class;

		$this->disabled = $disabled;
		$this->readonly = $readonly;

		$this->attributes = array();

		$this->help = $help;

		$this->col_labels = $col_labels;

		$this->format = $format;

		$this->add_row_text = $add_row_text;
		$this->remove_row_text = $remove_row_text;
	}

	protected function initialize_cells( $cols, $value = null )
	{
		$this->rows = array();

		if( is_array( $value ) )
		{
			foreach( $value as $rk => $rv )
			{
				$row = array();

				$current_col = 0;
				foreach( $cols as $c )
				{
					$type = !empty( $c['type'] ) && is_string( $c['type'] ) ? $c['type'] : 'text';
					$name = !empty( $c['name'] ) && is_string( $c['name'] ) ? $c['name'] : $current_col;

					if( is_array( $c ) &&
						( $method_name = 'get_' . $type ) &&
						method_exists( 'JLCCustomFormFieldLoader', $method_name )
					) {
						$field_name = sprintf( '%s[%s][%s]', $this->get_name(), $rk, $name );
						$field = JLCCustomFormFieldLoader::$method_name( $field_name, $c );

						if( is_a( $field, 'JLCCustomFormRequestReader' ) )
						{
							$row[$name] = $field;
						}
					}

					$current_col++;
				}

				$this->rows[$rk] = $row;
			}
		}
	}

	protected function store_blank_row( $is_admin )
	{
		$form_id = JLCCustomForm::get_current_printing_form();

		if( !$is_admin )
		{
			if( $this->get_format() === 'sheet' )
			{
				$file = $this->look_for_field( $this->get_type() . '-row-sheet.php' );
			}
			else
			{
				$file = $this->look_for_field( $this->get_type() . '-row.php' );
			}
		}
		else
		{
			if( $this->get_format() === 'sheet' )
			{
				$file = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '-row-sheet.php' ) );
			}
			else
			{
				$file = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '-row.php' ) );
			}
		}

		ob_start();
		include( $file );
		$code = ob_get_clean();

		self::$blank_rows[] = array(
			'form' => $form_id,
			'field' => !empty( $this->get_id() ) ? $this->get_id() : $this->get_name(),
			'code' => $code
			
		);
	}

	protected function get_blank_field( $c )
	{
		$type = !empty( $c['type'] ) && is_string( $c['type'] ) ? $c['type'] : 'text';
		$name = !empty( $c['name'] ) && is_string( $c['name'] ) ? $c['name'] : '{{ck}}';

		if( is_array( $c ) &&
			( $method_name = 'get_' . $type ) &&
			method_exists( 'JLCCustomFormFieldLoader', $method_name )
		) {

			$field_name = sprintf( '%s[%s][%s]', $this->get_name(), '{{rk}}', $name );
			$field = JLCCustomFormFieldLoader::$method_name( $field_name, $c );

			if( is_a( $field, 'JLCCustomFormRequestReader' ) )
				return $field;
		}
		
		return null;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_type()
	{
		return 'table_variable';
	}

	public function get_rows()
	{
		return $this->rows;
	}

	public function get_cols()
	{
		return $this->cols;
	}

	public function get_label()
	{
		return $this->label;
	}

	public function get_class()
	{
		return $this->class;
	}

	public function add_class( $class )
	{
		$this->class .= ' ' . $class;
	}

	public function get_id()
	{
		return $this->id;
	}

	public function is_disabled()
	{
		return $this->disabled;
	}

	public function is_readonly()
	{
		return $this->readonly;
	}

	public function set_readonly( $readonly )
	{
		$this->readonly = $readonly;
	}
	
	public function get_attributes()
	{
		return $this->attributes;
	}

	public function set_attributes( $attributes )
	{
		if( is_array( $attributes ) )
			$this->attributes = $attributes;
	}

	public function add_attribute( $key, $value )
	{
		$this->attributes[$key] = $value;
	}

	public function get_help()
	{
		return $this->help;
	}

	public function get_col_labels()
	{
		return $this->col_labels;
	}

	public function get_format()
	{
		return $this->format;
	}

	public function get_add_row_text()
	{
		$text = $this->add_row_text !== null ? $this->add_row_text : __( 'Add row', JLCCustomForm::TEXT_DOMAIN );

		return apply_filters( 'jlc_custom_form_table_variable_add_row_text', $text, $this ); 
	}

	public function get_remove_row_text()
	{
		$text = $this->remove_row_text !== null ? $this->remove_row_text : __( 'Remove row', JLCCustomForm::TEXT_DOMAIN );

		return apply_filters( 'jlc_custom_form_table_variable_remove_row_text', $text, $this ); 
	}

	public function get_value()
	{
		$ret = array();

		foreach( $this->get_rows() as $rk => $row )
		{
			$r = array();
			foreach( $row as $ck => $field )
			{
				$r[$ck] = method_exists( $field, 'is_checked' ) ? $field->is_checked() : $field->get_value();
			}

			$ret[$rk] = $r;
		}

		return $ret;
	}

	public function set_value( $val )
	{
		foreach( $this->get_rows() as $rk => $row )
		{
			foreach( $row as $ck => $field )
			{
				if( method_exists( $field, 'set_checked' ) )
					$field->set_checked( isset( $val[$rk][$ck] ) && $val[$rk][$ck] );
				else
					$field->set_value( isset( $val[$rk][$ck] ) ? $val[$rk][$ck] : null );
			}
		}
	}

	protected function read_csv( $path )
	{
		if( !is_readable( $path ) )
			return null;

		$f = fopen( $path, 'r' );
		if( $f === false )
			return null;

		$data = array();

		while ( ($row = fgetcsv($f) ) !== false ) {
			$data[] = $row;
		}

		fclose($f);

		return $data;
	}

	public function set_value_from_csv( $path )
	{
		$data = $this->read_csv( $path );
		
		$i = 0;
		foreach( $this->get_rows() as $rk => $row )
		{
			$j = 0;
			foreach( $row as $ck => $field )
			{
				if( method_exists( $field, 'set_checked' ) )
					$field->set_checked( isset( $data[$i][$j] ) && $data[$i][$j] );
				else
					$field->set_value( isset( $data[$i][$j] ) ? $data[$i][$j] : null );

				$j++;
			}

			$i++;
		}
	}

	public function get_ajax_callable() { return null; }//{ return $this->ajax_callable; }
	public function set_ajax_callable( $ajax_callable ) {}//{ $this->ajax_callable = $ajax_callable; }

	public function read_values_from_request( $method )
	{
		if( $method == 'POST' )
			$input = isset( $_POST[ $this->get_name() ] ) ? $_POST[ $this->get_name() ] : null;
		else
			$input = isset( $_GET[ $this->get_name() ] ) ? $_GET[ $this->get_name() ] : null;

		return is_array( $input ) ? $input : array();
	}

	public function read_request( $val )
	{
		$this->initialize_cells( $this->cols, $val );
		$rows = $this->get_rows();

		foreach( $rows as $rk => $row )
			foreach( $row as $ck => $field )
			if( null !== ( $ret = $field->read_request( array_key_exists( $rk, $val ) && array_key_exists( $ck, $val[$rk] ) ? $val[$rk][$ck] : null ) ) )
				return $ret;

		return null;
	}

	protected function look_for_field( $filename )
	{
		$form = JLCCustomForm::get_current_printing_form();

		if( $form )
		{
			$theme_file = implode(
				DIRECTORY_SEPARATOR,
				array(
					get_stylesheet_directory(),
					'jlc-form', 
					$form,
					'fields',
					$filename
				)
			);

			if( is_readable( $theme_file ) && is_file( $theme_file ) )
				return $theme_file;
		}

		$theme_file = implode(
			DIRECTORY_SEPARATOR,
			array(
				get_stylesheet_directory(),
				'jlc-form', 
				'fields',
				$filename
			)
		);

		if( is_readable( $theme_file ) && is_file( $theme_file ) )
			return $theme_file;

		return realpath( implode(
			DIRECTORY_SEPARATOR,
			array(
				__DIR__,
				'templates', 
				$filename
			)
		) );
	}

	public static function print_blank_rows()
	{
?>
<script type="text/javascript">
	if( typeof( JLCCustomFormVariableTableFieldBlankRows ) === 'undefined' )
	{
		var JLCCustomFormVariableTableFieldBlankRows = {};
	}
	<?php foreach( self::$blank_rows as $row ) : ?>
		if( typeof JLCCustomFormVariableTableFieldBlankRows['<?php echo $row['form']; ?>'] === 'undefined' )
			JLCCustomFormVariableTableFieldBlankRows['<?php echo $row['form']; ?>'] = {};

		if( typeof JLCCustomFormVariableTableFieldBlankRows['<?php echo $row['form']; ?>']['<?php echo $row['field']; ?>'] === 'undefined' )
			JLCCustomFormVariableTableFieldBlankRows['<?php echo $row['form']; ?>']['<?php echo $row['field']; ?>'] = '<?php echo base64_encode( $row['code'] ); ?>';
	<?php endforeach; ?>
</script>
<?php
	}

	public function print_admin( $wrapped = true )
	{
		$this->store_blank_row( true );

		if( !wp_script_is( 'jlc-custom-form-table-variable-js', 'enqueued' ) )
		{
			wp_enqueue_style(
				'jlc-custom-form-table-variable-admin-css',
				plugins_url( '/templates/css/table-variable-admin.css', __FILE__ ),
				array(),
				JLCCustomForm::VERSION
			);

			wp_enqueue_script(
				'jlc-custom-form-table-variable-js',
				plugins_url( '/templates/js/table-variable.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);

			add_action( 'admin_footer', array( get_class(), 'print_blank_rows' ) );
		}

		// $form_id is included to add it as data attribute in .jlc-custom-form-table-variable-wrapper
		// At the beggining, in table-variable.js, this value was extracted from ["jlc_custom_field"] form field,
		// but this method did not work in JLCPostMetaBoxForm, because Wordpress post does not include this field.
		$form_id = JLCCustomForm::get_current_printing_form();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}

	public function print_public()
	{
		$this->store_blank_row( false );

		if( !wp_script_is( 'jlc-custom-form-table-variable-js', 'enqueued' ) )
		{
			wp_enqueue_style(
				'jlc-custom-form-table-variable-admin-css',
				plugins_url( '/templates/css/table-variable.css', __FILE__ ),
				array(),
				JLCCustomForm::VERSION
			);

			wp_enqueue_script(
				'jlc-custom-form-table-variable-js',
				plugins_url( '/templates/js/table-variable.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);

			add_action( 'wp_footer', array( get_class(), 'print_blank_rows' ) );
		}

		// Read print_admin() comments
		$form_id = JLCCustomForm::get_current_printing_form();
		include( $this->look_for_field( $this->get_type() . '.php' ) );
	}
}

} //class_exists
