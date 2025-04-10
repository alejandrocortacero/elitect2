<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'AbstractJLCCustomFormDecorationField', false ) )
{

if( !interface_exists( 'JLCCustomFormElement', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'element.php' );

abstract class AbstractJLCCustomFormDecorationField implements JLCCustomFormElement
{
	protected $type;

	protected $id;
	protected $class;

	protected $attributes;

	public function __construct(
		$type,
		$id = null,
		$class = null
	) {
		$this->type = $type;

		$this->id = $id;
		$this->class = $class;

		$this->attributes = array();
	}

	//public function get_ajax_callable() { return null; }
	//public function set_ajax_callable( $ajax_callable ) {}

	public function print_admin( $wrapped = true )
	{
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}
	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );
	}

	/**
	 * If an error occurs, returns a message.
	 * Else return null;
	 *
	 * To preserve read chain, child method
	 * must return message if exists.
	 */
	/*
	public function read_request( $val )
	{
		return null;
	}
*/

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

	public function get_type()
	{
		return $this->type;
	}
/*
	public function get_value()
	{
		return null;
	}
*/
	public function get_class()
	{
		return $this->class;
	}

	public function get_id()
	{
		return $this->id;
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
}

} //class_exists

