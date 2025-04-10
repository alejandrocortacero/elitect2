<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormSaveAndAddButtons' ) )
{

if( !class_exists( 'JLCCustomFormSubmitButton' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'submit_button.php' );

class JLCCustomFormSaveAndAddButtons extends JLCCustomFormSubmitButton
{
	public function __construct(
		$name = 'save',
		$id = null,
		$class = null,
		$required = false,
		$disabled = false
	) {
		parent::__construct(
			$name,
			"",//label
			$id,
			$class,
			$required,
			$disabled
		);

		$this->type = "save-and-add-buttons";
	}
}

} //class_exists



