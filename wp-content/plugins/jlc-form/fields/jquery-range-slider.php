<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormJqueryRangeSliderField', false ) )
{

if( !class_exists( 'JLCCustomFormAbstractJquerySliderField', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-jquery-slider.php' );

class JLCCustomFormJqueryRangeSliderField extends JLCCustomFormAbstractJquerySliderField
{
	protected $max_value;
	protected $min_value;

	public function __construct(
		$name,
		$min_value = 0,
		$max_value = 0,
		$label = "",
		$help = null,
		$id = null,
		$class = null,
		$max = null,
		$min = null,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			0,
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

		$this->type = 'jquery-range-slider';

		$this->max_value = $max_value;
		$this->min_value = $min_value;
	}

	public function get_max_value()
	{
		return $this->max_value;
	}

	public function set_max_value( $max_value )
	{
		$this->max_value = $max_value;
	}

	public function get_min_value()
	{
		return $this->min_value;
	}

	public function set_min_value( $min_value )
	{
		$this->min_value = $min_value;
	}

	public function get_value()
	{
		return json_encode( array( $this->get_min_value(), $this->get_max_value() ) );
	}


	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$val = trim( $val );
		$arr = json_decode( $val );
		if( !is_array( $arr ) || count( $arr ) != 2 )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Invalid range provied in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);

		$min_value = $arr[0];
		$max_value = $arr[1];

		if( !is_numeric( $min_value ) || !is_numeric( $max_value ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Invalid range provied in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);

		$min_value = $min_value + 0;
		$max_value = $max_value + 0;

		if( is_numeric( $this->get_max() ) &&
			$max_value > $this->get_max() )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Field %s must not be greater than %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $this->get_max() )
			);
			
		if( is_numeric( $this->get_min() ) &&
			$min_value < $this->get_min() )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Field %s must not be smaller than %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $this->get_max() )
			);

		$this->set_min_value( $min_value );
		$this->set_max_value( $max_value );
		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists

