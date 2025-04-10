<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormColorField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormColorField extends JLCCustomFormTextField
{
	public function __construct(
		$name,
		$value = "",
		$label = "",
		$placeholder = "",
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
			$placeholder,
			$help,
			$id,
			$class,
			null,
			$required,
			$disabled,
			$readonly
		);

		$this->type = 'color';
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


