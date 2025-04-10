<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'AbstractJLCCustomFormField', false ) )
{

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'request-reader.php' );

abstract class AbstractJLCCustomFormField implements JLCCustomFormRequestReader
{
	protected $name;

	protected $value;
	protected $type;

	protected $label;

	protected $id;
	protected $class;

	protected $required;
	protected $disabled;
	protected $readonly;

	protected $attributes;

	protected $ajax_callable;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$type = "text",
		$id = null,
		$class = null,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		$this->name = $name;

		$this->value = $value;
		$this->label = $label;

		$this->type = $type;

		$this->id = $id;
		$this->class = $class;

		$this->required = $required;
		$this->disabled = $disabled;
		$this->readonly = $readonly;

		$this->attributes = array();

		$this->callable = null;
	}
/*
	public function is_file_input()
	{
		return false;
	}
*/

	public function get_ajax_callable() { return $this->ajax_callable; }
	public function set_ajax_callable( $ajax_callable ) { $this->ajax_callable = $ajax_callable; }

	public function print_admin( $wrapped = true )
	{
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}
	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );
	}

	public function read_values_from_request( $method )
	{
		if( $method == 'POST' )
			return isset( $_POST[ $this->get_name() ] ) ? $_POST[ $this->get_name() ] : null;
		else
			return isset( $_GET[ $this->get_name() ] ) ? $_GET[ $this->get_name() ] : null;
	}

	/**
	 * If an error occurs, returns a message.
	 * Else return null;
	 *
	 * To preserve read chain, child method
	 * must return message if exists.
	 */
	public function read_request( $val )
	{
		if( $this->is_required() && empty( $val ) )
			return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Field %s is required.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );

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

		if( $form &&
			( $form_dir = JLCCustomForm::get_registered_form_dir( $form ) )
		) {

			//$form_dir = $this->base_dir;
			if( mb_strpos( $form_dir, ABSPATH ) === 0 )
				$form_dir = mb_substr( $form_dir, mb_strlen( ABSPATH ) );

			// Files for this form located at its directory
			$custom_file = realpath( implode(
				DIRECTORY_SEPARATOR,
				array(
					ABSPATH,
					$form_dir,
					$form,
					'templates', 
					$filename
				)
			) );

			if( is_readable( $custom_file ) && is_file( $custom_file ) )
				return $custom_file;

			// Common files for all forms in directory
			$custom_file = realpath( implode(
				DIRECTORY_SEPARATOR,
				array(
					ABSPATH,
					$form_dir,
					'templates', 
					$filename
				)
			) );

			if( is_readable( $custom_file ) && is_file( $custom_file ) )
				return $custom_file;
		}

		return realpath( implode(
			DIRECTORY_SEPARATOR,
			array(
				__DIR__,
				'templates', 
				$filename
			)
		) );
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_value()
	{
		return $this->value;
	}

	public function set_value( $value )
	{
		$this->value = $value;
	}

	public function get_type()
	{
		return $this->type;
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

	public function is_required()
	{
		return $this->required;
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
}

} //class_exists
