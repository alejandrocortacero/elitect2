<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormPasswordField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormPasswordField extends JLCCustomFormTextField
{
	public function __construct(
		$name,
		$value = "",
		$label = "",
		$placeholder = "",
		$help = null,
		$id = null,
		$class = null,
		$maxlength = null,
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
			$maxlength,
			$required,
			$disabled,
			$readonly
		);

		$this->type = 'password';
	}

	public function print_admin( $wrapped = true )
	{
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', 'text.php' ) ) );
	}
	public function print_public()
	{
		$password_field = $this->look_for_field( $this->get_type() . '.php' );

		if( $password_field )
			include( $password_field );
		else
			include( $this->look_for_field( 'text.php' ) );
	}
}

} //class_exists

