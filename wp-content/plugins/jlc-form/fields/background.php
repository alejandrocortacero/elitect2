<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

//TODO: make field for admin

if( !class_exists( 'JLCCustomFormBackgroundField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormBackgroundField extends AbstractJLCCustomFormField
{
	protected $help;

	protected $opacity_fields;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$help = null,
		$opacity_field_type = null,
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
			"background",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->help = $help;

		$this->opacity_fields = array();

		if( $opacity_field_type == 'slider' )
		{
			for( $i = 0; $i < 2; $i++ )
				$this->opacity_fields[$i] = JLCCustomFormFieldLoader::get_jquery_slider( $name . '[color_' . $i . '_opacity]', array(
				'value' => $this->get_color_opacity( $i ),
				'min' => 0,
				'max' => 1,
				'step' => 0.01,
				'class' => 'jlc-custom-form-background-color-opacity-selector jlc-custom-form-background-color-' . $i . '-opacity',
				'id' => $name . '_color_' . $i . '_opacity',
				'label' => __( 'Opacity', JLCCustomForm::TEXT_DOMAIN )
				) );
		}
		else
		{
			for( $i = 0; $i < 2; $i++ )
				$this->opacity_fields[$i] = JLCCustomFormFieldLoader::get_number_field( $name . '[color_' . $i . '_opacity]', array(
				'value' => $this->get_color_opacity( $i ),
				'min' => 0,
				'max' => 1,
				'step' => 0.01,
				'class' => 'jlc-custom-form-background-color-opacity-selector jlc-custom-form-background-color-' . $i . '-opacity',
				'label' => __( 'Opacity', JLCCustomForm::TEXT_DOMAIN )
				) );
		}
	}

	public function get_help()
	{
		return $this->help;
	}

	public function get_background_type()
	{
		$val = json_decode( $this->get_value() );
		return isset( $val->type ) ? $val->type : 'solid';
	}

	public function get_color( $index )
	{
		$val = json_decode( $this->get_value() );
		$color = 'color_' . $index;
		return isset( $val->$color ) ? $val->$color : '#FFFFFF';
	}

	public function get_color_opacity( $index )
	{
		$val = json_decode( $this->get_value() );
		$color = 'color_' . $index . '_opacity';
		return isset( $val->$color ) ? $val->$color : 1;
	}

	public function print_public()
	{
		parent::print_public();

		if( !wp_script_is( 'jlc-custom-form-background-field-js', 'enqueued' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-background-field-js',
				plugins_url( '/templates/js/background.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);

			add_action( 'wp_footer', function(){
				include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'background.php' ) ) );
			});
		}
	}

	public function read_values_from_request( $method )
	{
		$val = parent::read_values_from_request( $method );

		if( is_array( $val ) )
			return json_encode( $val );
		else
			return $val;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists



