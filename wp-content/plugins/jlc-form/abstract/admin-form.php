<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCAdminForm' ) )
{

if( !class_exists( 'JLCCustomForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'form.php' ) ) ) );

abstract class JLCAdminForm extends JLCCustomForm
{
	public function __construct(
		$base_dir,
		$internal_id,
		$text_domain = null,
		$action = "",
		$ajax = true,
		$return_url = null,
		$enctype = null,
		$id = null,
		$class = null,
		$transient_time = 60
	) {
		parent::__construct(
			$base_dir,
			$internal_id,
			$text_domain,
			$action,
			$ajax,
			true,
			$return_url,
			true,
			$enctype,
			'POST',
			$id,
			$class,
			$transient_time
		);
	}

	protected function check_nonce()
	{
		return check_admin_referer( $this->get_nonce_action() );
	}
}

} // class_exists
