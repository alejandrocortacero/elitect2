<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormFieldsGroup' ) )
{

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'request-reader.php' );

abstract class JLCCustomFormFieldsGroup implements JLCCustomFormRequestReader
{
	protected $label;

	protected $options;

	protected $id;

	protected $class;

	protected $ajax_callable;

	public function __construct(
		$label = "",
		$options = array(),
		$id = null,
		$class = null
	) {
		$this->label = $label;

		$this->options = $options;

		$this->id = $id;
		$this->class = $class;

		$this->ajax_callable = null;
	}

	public abstract function read_request( $val );
	public abstract function read_values_from_request( $method );

	public function get_ajax_callable() { return $this->ajax_callable; }
	public function set_ajax_callable( $ajax_callable ) { $this->ajax_callable = $ajax_callable; }

	public function get_class()
	{
		return $this->class;
	}

	public function get_id()
	{
		return $this->ID;
	}

	public function get_label()
	{
		return $this->label;
	}

	public function get_options()
	{
		return $this->options;
	}

	public function add_option( JLCCustomFormCheckableField $option )
	{
		$this->options[] = $option;

		return $option;
	}

	protected function look_for_field( $filename )
	{
		$theme_file = implode(
			DIRECTORY_SEPARATOR,
			array(
				get_stylesheet_directory(),
				'jlc-custom-forms', 
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

	public abstract function get_type();

	public abstract function print_admin( $wrapped = true );
	public abstract function print_public();
}

} //class_exists

