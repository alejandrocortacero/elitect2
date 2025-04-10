<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormFieldsArray' ) )
{

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'request-reader.php' );

class JLCCustomFormFieldsArray implements JLCCustomFormRequestReader
{
	protected $name;

	protected $fields;

	protected $printable;

	// TODO: pensar en si quitar este soporte porque no tiene sentido
	//		 o si hay que hacer algo con los campos conteidos
	protected $ajax_callable;

	public function __construct(
		$name,
		$printable = true
	) {
		$this->name = $name;

		$this->fields = array();

		$this->printable = $printable;

		$this->ajax_callable = null;
	}

	public function get_type()
	{
		return 'array';
	}

	public function get_fields()
	{
		return $this->fields;
	}

	public function add_field( $type, $args, $index = null )
	{
		if( is_string( $type ) &&
			is_array( $args ) &&
			( $method_name = 'get_' . $type ) &&
			method_exists( 'JLCCustomFormFieldLoader', $method_name )
		) {

			$field_name = sprintf( '%s[%s]', $this->get_name(), $index );
			$field = JLCCustomFormFieldLoader::$method_name( $field_name, $args );

			if( is_a( $field, 'JLCCustomFormRequestReader' ) )
			{
				if( $index === null )
					$this->fields[] = $field;
				else
					$this->fields[$index] = $field;

				return $field;
			}
		}

		return null;
	}

	/**
	 * REMEMBER: $field name must be '$parent_field_name[$index]'
	 */
	public function add_field_object( $field, $index = null )
	{
		if( is_a( $field, 'JLCCustomFormRequestReader' )
		) {
			if( $index === null )
				$this->fields[] = $field;
			else
				$this->fields[$index] = $field;

			return $field;
		}

		return null;
	}

	public function get_field( $index )
	{
		$fields = $this->get_fields();
		return array_key_exists( $index, $fields ) ? $fields[$index] : null;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_value()
	{
		$ret = array();
		foreach( $this->get_fields() as $ind => $field )
			$ret[$ind] = $field->get_value();

		return $ret;
	}

	public function set_value( $val )
	{
		foreach( $this->get_fields() as $ind => $field )
			if( isset( $val[ $ind ] ) )
				$field->set_value( $val[$ind] );
	}

	public function is_printable()
	{
		return $this->printable;
	}

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
		foreach( $this->get_fields() as $ind => $field )
			if( null !== ( $ret = $field->read_request( array_key_exists( $ind, $val ) ? $val[$ind] : null ) ) )
				return $ret;

		return null;
	}

	public function get_ajax_callable() { return $this->ajax_callable; }
	public function set_ajax_callable( $ajax_callable ) { $this->ajax_callable = $ajax_callable; }

	public function print_admin( $wrapped = true )
	{
		if( $this->is_printable() )
			foreach( $this->get_fields() as $field )
				$field->print_admin( $wrapped );
	}
	public function print_public()
	{
		if( $this->is_printable() )
			foreach( $this->get_fields() as $field )
				$field->print_public();
	}
}

} //class_exists


