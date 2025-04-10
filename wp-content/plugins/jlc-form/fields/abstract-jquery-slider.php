<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormAbstractJquerySliderField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

abstract class JLCCustomFormAbstractJquerySliderField extends JLCCustomFormTextField
{
	protected $max;
	protected $min;

	public function __construct(
		$name,
		$value = 0,
		$min = null,
		$max = null,
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
			$label,
			null,//placeholder
			$help,
			$id,
			$class,
			null,
			$required,
			$disabled,
			$readonly
		);

		$this->max = $max;
		$this->min = $min;
	}

	public function get_max()
	{
		return $this->max;
	}

	public function get_min()
	{
		return $this->min;
	}

	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );

		if( !wp_script_is( 'jlc-custom-form-jquery-ui-sliders-script', 'queue' ) )
		{
			wp_enqueue_script( 'jquery-ui-slider' );
			wp_enqueue_script(
				'jlc-custom-form-jquery-ui-sliders-script',
				plugins_url( '/templates/js/jquery-sliders.js', __FILE__ ),
				array( 'jquery', 'jquery-ui-slider' ),
				JLCCustomForm::VERSION,
				true
			);
		}
	}

}

} //class_exists


