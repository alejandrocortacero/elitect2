<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormRadiobuttonField' ) )
{

if( !class_exists( 'JLCCustomFormCheckableField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-checkable-field.php' );

class JLCCustomFormRadiobuttonField extends JLCCustomFormCheckableField
{
	public function __construct(
		$name,
		$value = "",
		$label = "",
		$checked = false,
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
			$checked,
			"radio",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;
		
		return null;
	}
}

} //class_exists

