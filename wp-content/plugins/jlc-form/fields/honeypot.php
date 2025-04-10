<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormHoneypotField' ) )
{

if( !class_exists( 'JLCCustomFormHiddenField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'hidden.php' );

class JLCCustomFormHoneypotField extends JLCCustomFormHiddenField
{
	public function __construct( $name )
	{
		parent::__construct(
			$name,
			"",
			null,
			null,
			false,
			false,
			false
		);

	}

	public function read_request( $val )
	{
		if( !empty( $val ) || $val !== '' )
		{
			if( !class_exists( 'JLCSelfSettingsForm', false ) )
				require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'SelfSettings.php' ) ) ) );

			$redirect = JLCSelfSettingsForm::get_honeypot_redirect_url();
			if( empty( $redirect ) )
			{
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => __( 'There was an error. Try again later please.', JLCCustomForm::TEXT_DOMAIN )
				);
			}
			else
			{
				wp_redirect( $redirect, 302 );
				exit;
			}
		}
		
		return null;
	}
}

} //class_exists


