<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormHiddenField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormHiddenField extends AbstractJLCCustomFormField
{
	public function __construct(
		$name,
		$value = "",
		$id = null,
		$class = null,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			$value,
			null,
			"hidden",
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

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists

