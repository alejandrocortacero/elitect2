<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCSelfSettingsForm' ) )
{

if( !class_exists( 'JLCAdminSettingsForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'abstract', 'admin-settings-form.php' ) ) ) );

class JLCSelfSettingsForm extends JLCAdminSettingsForm
{
	const GOOGLE_RECAPTCHA_EXTERNAL_SOURCE = 'jlc_custom_forms_google_external_captcha_api';
	const GOOGLE_RECAPTCHA_SITEKEY = 'jlc_custom_forms_google_captchas_sitekey';
	const GOOGLE_RECAPTCHA_SECRETKEY = 'jlc_custom_forms_google_captchas_secretkey';

	const HONEYPOT_REDIRECT_URL = 'jlc_custom_forms_honeypot_redirect_url';

	const TINYMCE_EXTERNAL_SOURCE = 'jlc_custom_forms_tinymce_external';

	const INSTALL_CITIES_IN_DDBB = 'jlc_custom_forms_install_cities_in_ddbb';

	public static function is_google_recaptcha_api_external()
	{
		return get_option( self::GOOGLE_RECAPTCHA_EXTERNAL_SOURCE ) == 'yes';
	}

	public static function get_google_recaptcha_sitekey()
	{
		return get_option( self::GOOGLE_RECAPTCHA_SITEKEY );
	}

	public static function get_google_recaptcha_secretkey()
	{
		return get_option( self::GOOGLE_RECAPTCHA_SECRETKEY );
	}

	public static function get_honeypot_redirect_url()
	{
		return get_option( self::HONEYPOT_REDIRECT_URL );
	}

	public static function is_tinymce_external()
	{
		return get_option( self::TINYMCE_EXTERNAL_SOURCE ) == 'yes';
	}

	public static function must_install_cities_in_ddbb()
	{
		return get_option( self::INSTALL_CITIES_IN_DDBB ) == 'yes';
	}

	public function __construct( $internal_id, $args )
	{
		$admin_page_slug = isset( $args['admin_page_slug'] ) ? $args['admin_page_slug'] : '';
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$admin_page_slug,
			$text_domain
		);

		$this->add_text_field(
			self::GOOGLE_RECAPTCHA_SITEKEY,
			array(
				'value' => self::get_google_recaptcha_sitekey(),
				'label' => __( 'Google Captchas Site Key', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			self::GOOGLE_RECAPTCHA_SECRETKEY,
			array(
				'value' => self::get_google_recaptcha_secretkey(),
				'label' => __( 'Google Captchas Secret Key', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_checkbox_field(
			self::GOOGLE_RECAPTCHA_EXTERNAL_SOURCE,
			array(
				'value' => 'yes',
				'label' => __( 'Another source is inserting Google recaptcha api.js', $this->get_text_domain() ),
				'checked' => self::is_google_recaptcha_api_external()
			)
		);

		$this->add_text_field(
			self::HONEYPOT_REDIRECT_URL,
			array(
				'value' => self::get_honeypot_redirect_url(),
				'label' => __( 'Honeypot redirect url', $this->get_text_domain() ),
				'help' => __( 'If blank, shows a default error message.', $this->get_text_domain() ),
				'placeholder' => __( 'http://127.0.0.1 recommended', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_checkbox_field(
			self::TINYMCE_EXTERNAL_SOURCE,
			array(
				'value' => 'yes',
				'label' => __( 'Another source is inserting TinyMCE script.', $this->get_text_domain() ),
				'checked' => self::is_tinymce_external()
			)
		);

		$this->add_checkbox_field(
			self::INSTALL_CITIES_IN_DDBB,
			array(
				'value' => 'yes',
				'label' => __( 'Install cities on DDBB.', $this->get_text_domain() ),
				'checked' => self::must_install_cities_in_ddbb()
			)
		);

		/**
		 *	This field name is not a class constant
		 *	to avoid load this class in every admin request
		 */
		$this->add_checkbox_field(
			'jlc_custom_forms_admin_enqueue_all_styles',
			array(
				'value' => 'yes',
				'label' => __( 'Enqueue all admin scripts', $this->get_text_domain() ),
				'checked' => get_option( 'jlc_custom_forms_admin_enqueue_all_styles' ) === 'yes'
			)
		);

		$this->add_submit_button(
			'save',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	public function process_form()
	{
		parent::process_form();

		if( self::must_install_cities_in_ddbb() )
		{
		}
	}
}

} //class_exists


