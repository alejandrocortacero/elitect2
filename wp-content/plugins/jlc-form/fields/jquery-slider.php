<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormJquerySliderField', false ) )
{

if( !class_exists( 'JLCCustomFormAbstractJquerySliderField', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-jquery-slider.php' );

class JLCCustomFormJquerySliderField extends JLCCustomFormAbstractJquerySliderField
{
	protected $step;

	public function __construct(
		$name,
		$value = 0,
		$min = null,
		$max = null,
		$step = 1,
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
			$value,
			$min,
			$max,
			$label,
			$help,
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->type = 'jquery-slider';

		$this->step = $step;
	}

	public function get_step()
	{
		return $this->step;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$val = trim( $val );

		if( !is_numeric( $val ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Invalid value provied in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
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

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists


