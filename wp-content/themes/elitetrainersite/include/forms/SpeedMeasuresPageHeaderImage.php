<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCSpeedMeasuresPageHeaderImageForm' ) )
{

if( !class_exists( 'JLCPageImageAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageImageAbstract.php' ) ) );

class JLCSpeedMeasuresPageHeaderImageForm extends JLCPageImageAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'speedmeasuresheaderimage',
			$internal_id,
			$args,
			null//form_title
		);

		$this->image_selector = '.speed-measures-row.row .col-xs-12 .page-image-layer .image';
	}
}

}

