<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormAudioRecorderField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormAudioRecorderField extends AbstractJLCCustomFormField
{
	protected $help;

	public function __construct(
		$name,
		$value = "",
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
			"audio-recorder",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);


		$this->help = $help;
	}

	public function get_help()
	{
		return $this->help;
	}

	public function print_public()
	{
		parent::print_public();

		if( !wp_script_is( 'jlc-custom-form-audio-recorder-js', 'enqueued' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-audio-recorder-js',
				plugins_url( '/templates/js/audio-recorder.js', __FILE__ ),
				array( 'jquery' ),// review dependences
				JLCCustomForm::VERSION,
				true
			);
			wp_localize_script(
				'jlc-custom-form-audio-recorder-js',
				'JLCCustomFormAudioRecorderNS',
				array(
/*
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'action' => self::AJAX_UPLOAD_IMAGE_ACTION,
					'fieldName' => self::AJAX_UPLOAD_IMAGE_FIELD_NAME,
					'windowAction' => self::AJAX_IMAGE_SELECTION_WINDOW_GET_IMAGES,
					'checkImageExistsAction' => self::AJAX_CHECK_IMAGE_EXISTS_ACTION,
					'checkImageExistsFieldName' => self::AJAX_CHECK_IMAGE_EXISTS_FIELD_NAME,
					'blankImageUrl' => apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this ),
					'selectImage' => __( 'Select image', JLCCustomForm::TEXT_DOMAIN ),
					'useImage' => __( 'Use selected image', JLCCustomForm::TEXT_DOMAIN )
*/
				)
			);

			add_action( 'wp_footer', function(){
				//include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'audio-recorder.php' ) ) );
			});
		}
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

/*
		if( !is_string( $val ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Field %s contains invalid data.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);
*/

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists


