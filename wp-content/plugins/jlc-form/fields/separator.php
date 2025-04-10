<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormSeparatorField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormDecorationField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'decoration-field.php' );

class JLCCustomFormSeparatorField extends AbstractJLCCustomFormDecorationField
{

	public function __construct(
		$id = null,
		$class = null
	) {
		parent::__construct(
			'separator',
			$id,
			$class
		);
	}
}

} //class_exists


