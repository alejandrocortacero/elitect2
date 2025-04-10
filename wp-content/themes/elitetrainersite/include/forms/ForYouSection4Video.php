<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection4VideoForm' ) )
{

if( !class_exists( 'JLCPageVideoAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageVideoAbstract.php' ) ) );

class JLCForYouSection4VideoForm extends JLCPageVideoAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection4video',
			$internal_id,
			$args,
			null//form_title
		);
	}
}

}

