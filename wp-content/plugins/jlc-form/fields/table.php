<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormTableField' ) )
{

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'request-reader.php' );

class JLCCustomFormTableField implements JLCCustomFormRequestReader
{
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

	/**
	 * $cols	array of arrays containing field definitions.
	 *			array(
	 *				'type' (if empty => text)
	 *				'name' (if empty => current position)
	 *				... (specific field args)
	 * $rows	an integer (number of rows) or an indexes array
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
		$rows,
		$value = "",
		$label = "",
		$col_labels = null,
		$format = 'sheet',
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
		$this->initialize_cells( $rows, $cols, $value );

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
	}

	protected function initialize_cells( $rows, $cols, $value = null )
	{
		$this->rows = array();

		if( is_string( $value ) && is_readable( $value ) && ( $data = $this->read_csv( $value ) ) !== null )
		{
			$row_keys = range( 0, count( $data ) - 1 );
		}
		elseif( is_array( $rows ) )
		{
			$row_keys = $rows;
		}
		elseif( is_numeric( $rows ) && ( $rows = (int)$rows ) > 0 )
		{
			$row_keys = range( 0, $rows - 1 );
		}
		else
		{
			$row_keys = array();
		}

		foreach( $row_keys as $rk )
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

	public function get_name()
	{
		return $this->name;
	}

	public function get_type()
	{
		return 'table';
	}

	public function get_rows()
	{
		return $this->rows;
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

	public function get_value()
	{
		$ret = array();

		foreach( $this->rows as $rk => $row )
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
		$rows = $this->get_rows();
		if( empty( $rows ) && is_array( $val ) )
		{
			$this->initialize_cells( array_keys( $val ), $this->cols );
			$rows = $this->get_rows();
		}

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

	public function print_admin( $wrapped = true )
	{
		wp_enqueue_style(
			'jlc-custom-form-table-admin-css',
			plugins_url( '/templates/css/table-admin.css', __FILE__ ),
			array(),
			JLCCustomForm::VERSION
		);

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}
	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );
	}
}

} //class_exists



