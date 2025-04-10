<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanSection3VideoForm' ) )
{

if( !class_exists( 'JLCPageVideoAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageVideoAbstract.php' ) ) );

class JLCOnlinePlanSection3VideoForm extends JLCPageVideoAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplansection3video',
			$internal_id,
			$args,
			null//form_title
		);
	}
}

}

