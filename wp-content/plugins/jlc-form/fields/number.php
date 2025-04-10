<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormNumberField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormNumberField extends JLCCustomFormTextField
{
	protected $max;
	protected $min;
	protected $step;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$placeholder = "",
		$help = null,
		$id = null,
		$class = null,
		$max = null,
		$min = null,
		$step = null,
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

		$this->type = 'number';

		$this->max = $max;
		$this->min = $min;
		$this->step = $step;
	}

	public function get_max()
	{
		return $this->max;
	}

	public function get_min()
	{
		return $this->min;
	}

	public function get_step()
	{
		return $this->step;
	}

	public function read_request( $val )
	{
/*
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;
*/
		if( $this->is_required() && ( $val === null || trim( $val ) === '' ) )
			return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Field %s is required.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );

		$val = trim( $val );

		if( ( $val !== null && $val != '' ) || $this->is_required() )
		{
			if( !is_numeric( $val ) )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Invalid number provied in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);

			$val = $val + 0;

			if( is_numeric( $this->get_max() ) &&
				$val > $this->get_max() )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Field %s must not be greater than %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $this->get_max() )
				);
				
			if( is_numeric( $this->get_min() ) &&
				$val < $this->get_min() )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Field %s must not be smaller than %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $this->get_max() )
				);
		}

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists

