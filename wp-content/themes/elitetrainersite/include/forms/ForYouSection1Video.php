<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection1VideoForm' ) )
{

if( !class_exists( 'JLCPageVideoAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageVideoAbstract.php' ) ) );

class JLCForYouSection1VideoForm extends JLCPageVideoAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection1video',
			$internal_id,
			$args,
			null//form_title
		);
	}
}

}

