<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePageHeaderVideoForm' ) )
{

if( !class_exists( 'JLCPageHeaderVideoAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageHeaderVideoAbstract.php' ) ) );

class JLCOnlinePageHeaderVideoForm extends JLCPageHeaderVideoAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineheadervideo',
			$internal_id,
			$args,
			null//form_title
		);
	}
}

}


