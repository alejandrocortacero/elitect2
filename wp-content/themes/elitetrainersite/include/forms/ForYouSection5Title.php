<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection5TitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCForYouSection5TitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection5title',
			$internal_id,
			$args,
			null,//form_title
			'5 - Motivación',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			30,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-section-5-col h2.section-title .text';
	}
}

}

