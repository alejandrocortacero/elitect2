<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormDNIField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormDNIField extends JLCCustomFormTextField
{
	public function __construct(
		$name,
		$value = "",
		$label = "",
		$placeholder = "",
		$help = null, // set to "" for empty help, else auto help will be added if separator exists
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
			9,
			$required,
			$disabled,
			$readonly
		);

		$this->type = 'text';
	}

	public static function validate_dni( $str )
	{
		if( !is_string( $str ) )
			return false;

		$str = strtolower( $str );

		$matches = array();
		if( !preg_match( '/^(\d{8})([abcdefghjklmnpqrstvwxyz]{1})$/', $str, $matches ) )
			return false;

		$number = (int)$matches[1];
		$letter = $matches[2];

		$rel = array( 't', 'r', 'w', 'a', 'g', 'm', 'y', 'f', 'p', 'd', 'x', 'b', 'n', 'j', 'z', 's', 'q', 'v', 'h', 'l', 'c', 'k', 'e' );

		return $rel[ $number % 23 ] == $letter;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$val = trim( $val );

		if( !self::validate_dni( $val ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Invalid DNI provided in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists

