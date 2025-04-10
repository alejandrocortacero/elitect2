<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksHeaderVideoForm' ) )
{

if( !class_exists( 'JLCPageHeaderVideoAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageHeaderVideoAbstract.php' ) ) );

class JLCHowWorksHeaderVideoForm extends JLCPageHeaderVideoAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworksheadervideo',
			$internal_id,
			$args,
			null//form_title
		);
	}
}

}


