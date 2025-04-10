<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormCheckableField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

abstract class JLCCustomFormCheckableField extends AbstractJLCCustomFormField
{
	protected $checked;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$checked = false,
		$type = "checkbox",
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
			$type,
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->checked = $checked;
	}

	public function is_file_input()
	{
		return false;
	}

	public function is_checked()
	{
		return $this->checked;
	}

	public function set_checked( $checked )
	{
		$this->checked = $checked;
	}
}

} //class_exists

