<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormCalendarField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormCalendarField extends JLCCustomFormTextField
{
	protected $calendar_args;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$placeholder = "",
		$help = null,
		$id = null,
		$class = null,
		$calendar_args = null,
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

		$this->type = 'calendar';

		$this->calendar_args = $calendar_args;
	}

	public function get_calendar_args()
	{
		return $this->calendar_args;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$val = trim( $val );
		$val = json_decode( preg_replace( '/\\\\"/', '"', $val ) );

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

	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );

		if( !wp_script_is( 'jlc-custom-form-jlc-calendar-script', 'queue' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-jlc-calendar-script',
				plugins_url( '/templates/js/jlc-calendar.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_enqueue_style(
				'jlc-custom-form-jlc-calendar-style',
				plugins_url( '/templates/css/jlc-calendar.css', __FILE__ ),
				array(),
				JLCCustomForm::VERSION
			);
		}
	}

	public function print_admin( $wrapped = true )
	{
		parent::print_admin( $wrapped );

		if( !wp_script_is( 'jlc-custom-form-jlc-calendar-script', 'queue' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-jlc-calendar-script',
				plugins_url( '/templates/js/jlc-calendar.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_enqueue_style(
				'jlc-custom-form-jlc-calendar-style',
				plugins_url( '/templates/css/jlc-calendar.css', __FILE__ ),
				array(),
				JLCCustomForm::VERSION
			);
		}
	}
}

} //class_exists


