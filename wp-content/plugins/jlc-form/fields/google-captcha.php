<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormGoogleCaptchaField' ) )
{

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'request-reader.php' );

if( !class_exists( 'JLCSelfSettingsForm', false ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'SelfSettings.php' ) ) ) );

class JLCCustomFormGoogleCaptchaField implements JLCCustomFormRequestReader
{

	public function __construct()
	{
	}
/*
	public function is_file_input()
	{
		return false;
	}
*/
	public function get_ajax_callable() { return null; }
	public function set_ajax_callable( $ajax_callable ) {}

	public function get_name()
	{
		return 'g-recaptcha-response';
	}

	public function get_type()
	{
		return 'google-captcha';
	}

	public function get_value()
	{
		return null;
	}

	public function read_values_from_request( $method )
	{
		if( $method == 'POST' )
			return isset( $_POST[ $this->get_name() ] ) ? $_POST[ $this->get_name() ] : null;
		else
			return isset( $_GET[ $this->get_name() ] ) ? $_GET[ $this->get_name() ] : null;
	}

	public function read_request( $val )
	{
		if( empty( $val ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => __( 'Humanity confirmation is required.', JLCCustomForm::TEXT_DOMAIN )
			);

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_USERAGENT => get_bloginfo( 'name' ),
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => array(
				'secret' => JLCSelfSettingsForm::get_google_recaptcha_secretkey(),
				'response' => $val
			)
		));
		$resp = curl_exec($curl);
		curl_close($curl);

		$resp = json_decode( $resp );
		if( !isset( $resp->success ) ||
			!$resp->success )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => __( 'Humanity confirmation is required.', JLCCustomForm::TEXT_DOMAIN )
			);
		
		return null;
	}

	public function print_admin( $wrapped = true )
	{
	//	include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}

	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );

		if( !wp_script_is( 'jlc-custom-form-google-captchas-js', 'queue' ) )
		{

			$external = JLCSelfSettingsForm::is_google_recaptcha_api_external();

			if( !$external )
			{
				wp_enqueue_script(
					'jlc-custom-form-google-captchas-js',
					plugins_url( 'templates/js/google-captchas.js', __FILE__ ),
					array( 'jquery' ),
					JLCCustomForm::VERSION,
					true
				);
				wp_enqueue_script(
					'google-recaptcha-api-js',
					'https://www.google.com/recaptcha/api.js?onload=jlcFormsRecaptchaCallback&render=explicit',
					array(),
					null,
					true
				);
			}
			else
			{
				wp_enqueue_script(
					'jlc-custom-form-google-captchas-js',
					plugins_url( 'templates/js/google-captchas-external.js', __FILE__ ),
					array( 'jquery' ),
					JLCCustomForm::VERSION,
					true
				);
			}

			wp_localize_script(
				'jlc-custom-form-google-captchas-js',
				'JLCCustomFormGoogleCaptchasNamespace',
				array(
					'sitekey' => JLCSelfSettingsForm::get_google_recaptcha_sitekey()
				)
			);
		}
	}

	protected function look_for_field( $filename )
	{
		$theme_file = implode(
			DIRECTORY_SEPARATOR,
			array(
				get_stylesheet_directory(),
				'jlc-form', 
				'fields',
				$filename
			)
		);

		if( is_readable( $theme_file ) && is_file( $theme_file ) )
			return $theme_file;

		return realpath( implode(
			DIRECTORY_SEPARATOR,
			array(
				__DIR__,
				'templates', 
				$filename
			)
		) );
	}
}

} //class_exists


