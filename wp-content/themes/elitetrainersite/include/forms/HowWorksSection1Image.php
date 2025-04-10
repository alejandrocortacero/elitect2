<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection1ImageForm' ) )
{

if( !class_exists( 'JLCPageImageAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'PageImageAbstract.php' ) ) );

class JLCHowWorksSection1ImageForm extends JLCPageImageAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkssection1image',
			$internal_id,
			$args,
			null//form_title
		);

		$this->image_selector = '.how-works-section-1-col .page-image-layer-' . $this->image_name . ' .image';

		$this->default_image_url = get_template_directory_uri() . '/img/howworks/picture1.jpg';
	}
}

}
