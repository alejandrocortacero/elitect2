<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanSection2VideoForm' ) )
{

if( !class_exists( 'JLCPageVideoAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageVideoAbstract.php' ) ) );

class JLCOnlinePlanSection2VideoForm extends JLCPageVideoAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplansection2video',
			$internal_id,
			$args,
			null//form_title
		);
	}
}

}
