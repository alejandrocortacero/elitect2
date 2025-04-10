<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormTimeField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormTimeField extends JLCCustomFormTextField
{
	protected $max;
	protected $min;
	protected $step;

	protected $compatible;
	// TODO: make compatible (two text fields instead of one time field

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
		$compatible = false,
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

		$this->type = 'time';

		$this->max = $max;
		$this->min = $min;
		$this->step = $step;

		$this->compatible = $compatible;
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
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$val = trim( $val );

		if( !empty( $val ) || $this->is_required() )
		{
/*
			if( !preg_match( '/^' . self::PATTERN . '$/', $val ) )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Invalid date provied in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);

			$time_obj = date_create_from_format( self::FORMAT, $val );

			if( is_string( $this->get_max() ) &&
				preg_match( '/^' . self::PATTERN . '$/', $this->get_max() ) &&
				( $max_time = date_create_from_format( self::FORMAT, $this->get_max() ) ) &&
				$time_obj->getTimestamp() > $max_time->getTimestamp() )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Field %s must not be greater than %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $this->get_max() )
				);

				
			if( is_string( $this->get_min() ) &&
				preg_match( '/^' . self::PATTERN . '$/', $this->get_min() ) &&
				( $min_time = date_create_from_format( self::FORMAT, $this->get_min() ) ) &&
				$time_obj->getTimestamp() < $min_time->getTimestamp() )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Field %s must not be smaller than %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $this->get_max() )
				);
*/
			
		}

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists


