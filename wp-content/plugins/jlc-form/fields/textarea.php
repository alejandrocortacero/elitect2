<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormTextareaField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormTextareaField extends JLCCustomFormTextField
{
	protected $rows;
	protected $cols;
	protected $wrap;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$placeholder = "",
		$help = null,
		$rows = null,
		$cols = null,
		$wrap = null,
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

		$this->type = 'textarea';

		$this->cols = $cols;
		$this->rows = $rows;

		$this->wrap = $wrap;
	}
}

}//class_exists
