<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCDistanceMeasuresPageHeaderImageForm' ) )
{

if( !class_exists( 'JLCPageImageAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageImageAbstract.php' ) ) );

class JLCDistanceMeasuresPageHeaderImageForm extends JLCPageImageAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'distancemeasuresheaderimage',
			$internal_id,
			$args,
			null//form_title
		);

		$this->image_selector = '.distance-measures-row.row .col-xs-12 .page-image-layer .image';
	}
}

}


