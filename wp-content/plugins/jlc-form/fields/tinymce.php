<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormTinymceField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

if( !class_exists( 'JLCSelfSettingsForm', false ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'SelfSettings.php' ) ) ) );

class JLCCustomFormTinymceField extends AbstractJLCCustomFormField
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
			"tinymce",
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

	public function print_admin( $wrapped = true )
	{
	//	include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}

	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );

		if( !wp_script_is( 'jlc-custom-form-tinymce-js', 'queue' ) )
		{
			$external = JLCSelfSettingsForm::is_tinymce_external();

			if( !$external )
			{
				wp_enqueue_script(
					'tinymce-api-js',
				plugins_url( 'templates/js/tinymce/tinymce.min.js', __FILE__ ),
					array(),
					null,
					true
				);
				wp_enqueue_script(
					'jlc-custom-form-tinymce-js',
					plugins_url( 'templates/js/tinymce.js', __FILE__ ),
					array( 'jquery', 'tinymce-api-js' ),
					JLCCustomForm::VERSION,
					true
			);
                wp_enqueue_script(
                    'jlc-custom-form-tinymce-js',
                    plugins_url( 'templates/js/tinymce/tinymce-external.js', __FILE__ ),
                    array( 'jquery' ),
                    JLCCustomForm::VERSION,
                    true
                );
			}
			else
			{
				wp_enqueue_script(
					'jlc-custom-form-tinymce-js',
					plugins_url( 'templates/js/tinymce/tinymce-external.js', __FILE__ ),
					array( 'jquery' ),
					JLCCustomForm::VERSION,
					true
				);
			}

			wp_localize_script(
				'jlc-custom-form-tinymce-js',
				'JLCCustomFormTinymceNamespace',
				array(
					'tinymceDefaultArgs' => apply_filters( 'jlccustomform_tinymce_field_init_args', array(
						'language' => 'es',
						'mode' => "exact",
						'skin' => 'oxide-dark',
						'selector' => '.jlc-custom-form-tinymce',
						'menubar' => false,
						'statusbar' => false,
						'toolbar' => array( 
							"bold italic underline strikethrough | fontselect fontsizeselect formatselect | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | alignleft aligncenter alignright | bullist numlist outdent indent | undo redo"
						),
						'plugins' => array("paste","code"),
						'paste_auto_cleanup_on_paste' => true/*,
						'paste_postprocess' => function( pl, o ) {
							o.node.innerHTML = o.node.innerHTML.replace( /&nbsp;+/ig, " " );
						}*/
					) )
				)
			);
/*
			wp_localize_script(
				'jlc-custom-form-google-captchas-js',
				'JLCCustomFormTinymceNamespace',
				array(
					'borrar' => 'BORRAR'
				)
			);
*/
		}
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

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists
