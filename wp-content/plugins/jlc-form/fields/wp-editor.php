<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormWPEditorField', false ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormWPEditorField extends AbstractJLCCustomFormField
{
	protected $editor_args;
	protected $help;

	public function __construct(
		$name,
		$editor_args = array(),
		$value = "",
		$label = "",
		$help = null,
		$id = null,
		$class = null,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			$value,
			$label,
			'wp_editor',
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->editor_args = is_array( $editor_args ) ? $editor_args : array();
		$this->editor_args['textarea_name'] = $name;
		if( is_string( $class ) )
			$this->editor_args['editor_class'] = $class;

		$this->help = $help;
	}

	public function get_help()
	{
		return $this->help;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$this->set_value( $val );

		return null;
	}
}

} // class_exists
