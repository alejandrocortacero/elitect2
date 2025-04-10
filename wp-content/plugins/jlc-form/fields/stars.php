<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormStarsField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormStarsField extends AbstractJLCCustomFormField
{
	protected $help;
	protected $stars;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$help = null,
		$id = null,
		$class = null,
		$stars = 5,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			$value,
			$label,
			"stars",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->help = $help;

		$this->stars = (int)$stars;
	}

	public function get_stars()
	{
		return $this->stars;
	}

	public function get_help()
	{
		return $this->help;
	}

	protected function enqueue_scripts()
	{
		if( !wp_script_is( 'jlc-custom-form-stars-js', 'enqueued' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-stars-js',
				plugins_url( '/templates/js/stars.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_enqueue_style(
				'jlc-custom-form-stars-css',
				plugins_url( '/templates/css/stars.css', __FILE__ ),
				array(),
				JLCCustomForm::VERSION
			);
		}
	}

	public function print_admin( $wrapped = true )
	{
		parent::print_admin( $wrapped );

		$this->enqueue_scripts();
	}

	public function print_public()
	{
		parent::print_public();

		$this->enqueue_scripts();
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( !empty( $val ) )
		{
			if( !is_numeric( $val ) )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Field %s contains invalid data.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);

			$val = trim( $val );
			if( $val > $this->get_stars() || $val < 0 )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Field %s contains invalid data.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);
		}

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists

