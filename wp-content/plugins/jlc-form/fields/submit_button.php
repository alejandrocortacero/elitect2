<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormSubmitButton' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormSubmitButton extends AbstractJLCCustomFormField
{
	public function __construct(
		$name,
		$label = "",
		$id = null,
		$class = null,
		$required = false,
		$disabled = false
	) {
		parent::__construct(
			$name,
			'',
			$label,
			"submit_button",
			$id,
			$class,
			$required,
			$disabled,
			true
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


