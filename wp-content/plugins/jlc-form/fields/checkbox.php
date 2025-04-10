<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormCheckboxField' ) )
{

if( !class_exists( 'JLCCustomFormCheckableField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-checkable-field.php' );

class JLCCustomFormCheckboxField extends JLCCustomFormCheckableField
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
			"checkbox",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);
	}

	public function read_request( $val )
	{
		if( $this->is_required() && $val === null )
			return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'You must check the checkbox %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );

		$this->set_checked( $val !== null );
		
		return null;
	}
}

} //class_exists
