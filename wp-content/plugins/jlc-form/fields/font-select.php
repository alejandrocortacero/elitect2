<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormFontSelectField' ) )
{

if( !class_exists( 'JLCCustomFormSelectField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'select.php' );


class JLCCustomFormFontSelectField extends JLCCustomFormSelectField
{
	public function __construct(
		$name,
		$options = array(),
		$multiple = false,
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
			$options,
			$multiple,
			$label,
			$help,
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->type = 'fontselect';
	}

	public function add_font( $font, $args = array() )
	{
		$this->add_option( $font, $font, $args );
	}
}

} // class_exists

