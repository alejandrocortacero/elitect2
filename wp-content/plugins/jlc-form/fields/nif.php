<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormNIFField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormNIFField extends JLCCustomFormTextField
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

	public static function validate_nie( $str )
	{
		if( !is_string( $str ) )
			return false;

		$str = strtolower( $str );

		$matches = array();
		if( !preg_match( '/^([xyz]{1})\d{7}[abcdefghjklmnpqrstvwxyz]{1}$/', $str, $matches ) )
			return false;

		$first_letter = $matches[1];
		$rel = array( 'x' => '0', 'y' => 1, 'z' => 2 );

		$str = $rel[$first_letter] . substr( $str, 1 );

		return self::validate_dni( $str );
	}

	public static function validate_cif( $str )
	{
		if( !is_string( $str ) )
			return false;

		$str = strtoupper( $str );
		$matches = array();

		if( preg_match( '/^([ABCDEFGHQS]{1})(\d{7})(\d{1})$/', $str, $matches ) ||
			preg_match( '/^(P)(\d{7})([A-J]{1})$/', $str, $matches ) )
		{
			$number = $matches[2];
			$ciphers = str_split( $number );
			$sum = 0;
			$i = 1;
			foreach( $ciphers as $cipher )
			{
				$num = (int)$cipher;
				if( $i % 2 )
				{
					$sum += array_sum( str_split( (string)($num * 2) ) );
				}
				else
				{
					$sum += $num;
				}

				$i++;
			}

			$control = 10 - (int)( substr( (string)$sum, -1 ) );
			if( $matches[1] == 'P' )
				return $matches[3] == chr( 64 + $control );
			else
				return (int)$matches[3] == $control;
		}
		else
		{
			return false;
		}
	}

	public function validate_nif( $str )
	{
		return self::validate_dni( $str ) || self::validate_nie( $str ) || self::validate_cif( $str );
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$val = trim( $val );

		if( !self::validate_nif( $val ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Invalid NIF provided in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists


