<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormTextField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormTextField extends AbstractJLCCustomFormField
{
	protected $placeholder;
	protected $maxlength;
	protected $help;

	protected $datalist;

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
			"text",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->placeholder = $placeholder;

		$this->maxlength = $maxlength;

		$this->help = $help;

		$this->datalist = array();
	}

	public function get_placeholder()
	{
		return $this->placeholder;
	}

	public function get_maxlength()
	{
		return $this->maxlength;
	}

	public function get_help()
	{
		return $this->help;
	}

	public function get_datalist()
	{
		return $this->datalist;
	}

	public function set_datalist( $datalist )
	{
		if( is_array( $datalist ) )
			$this->datalist = $datalist;
	}

	public function add_datalist_option( $option )
	{
		$this->datalist[] = (string)$option;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( !is_string( $val ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Field %s contains invalid data.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);

		$val = trim( $val );
		$maxlength = $this->get_maxlength();
		if( is_integer( $maxlength ) &&
			mb_strlen( $val ) > $maxlength )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Field %s must be not greater than %d characters', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $maxlength )
			);

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists

