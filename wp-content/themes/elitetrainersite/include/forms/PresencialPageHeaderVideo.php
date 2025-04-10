<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPresencialPageHeaderVideoForm' ) )
{

if( !class_exists( 'JLCPageHeaderVideoAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageHeaderVideoAbstract.php' ) ) );

class JLCPresencialPageHeaderVideoForm extends JLCPageHeaderVideoAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'presencialheadervideo',
			$internal_id,
			$args,
			null//form_title
		);
	}
}

}



