<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormRadiobuttonsGroup', false ) )
{

if( !class_exists( 'JLCCustomFormFieldsGroup', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'group.php' );

if( !class_exists( 'JLCCustomFormRadiobuttonField', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'radiobutton.php' );

class JLCCustomFormRadiobuttonsGroup extends JLCCustomFormFieldsGroup
{
	public function __construct(
		$name,
		$label = "",
		$options = array(),
		$id = null,
		$class = null
	)
	{
		parent::__construct( $label, $options, $id, $class );
		
		$this->name = $name;
	}

	public function is_file_input()
	{
		return false;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_type()
	{
		return 'radio';
	}

	public function set_readonly( $readonly )
	{
		foreach( $this->get_options() as $option )
			$option->set_readonly( $readonly );
	}

	public function add_radiobutton( $args )
	{
		$this->add_option( new JLCCustomFormRadiobuttonField(
			$this->get_name(),
			isset( $args['value'] ) ? $args['value'] : '',
			isset( $args['label'] ) ? $args['label'] : '',
			isset( $args['checked'] ) ? $args['checked'] : false,
			isset( $args['id'] ) ? $args['id'] : $this->get_name() . '_' . count( $this->get_options() ),
			isset( $args['class'] ) ? $args['class'] : null,
			isset( $args['required'] ) ? $args['required'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false,
			isset( $args['readonly'] ) ? $args['readonly'] : false
		) );
	}

	public function print_admin( $wrapped = true )
	{
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', 'radio-group.php' ) ) );
	}
	public function print_public()
	{
		include( $this->look_for_field( 'radio-group.php' ) );
	}

	public function read_values_from_request( $method )
	{
		if( $method == 'POST' )
			return isset( $_POST[ $this->get_name() ] ) ? $_POST[ $this->get_name() ] : null;
		else
			return isset( $_GET[ $this->get_name() ] ) ? $_GET[ $this->get_name() ] : null;
	}

	public function read_request( $val )
	{
		foreach( $this->get_options() as $option )
			if( $option->is_required() && empty( $val ) )
				return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'An option in %s must be selected.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );

		foreach( $this->get_options() as $option )
			if( null !== ( $read = $option->read_request( $val ) ) )
				return $read;

		$this->select_value( $val );
	}

	public function get_value()
	{
		foreach( $this->options as $option )
			if( $option->is_checked() )
				return $option->get_value();

		return null;
	}

	public function set_value( $value )
	{
		$this->select_value( $value );
	}
	
	public function select_value( $value )
	{
		foreach( $this->options as $option )
			$option->set_checked( $option->get_value() == $value );
	}
	
	public function get_selected()
	{
		foreach( $this->options as $option )
			if( $option->is_checked() )
				return $option;
	}

}

} //class_exists

