<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection1TitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCForYouSection1TitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection1title',
			$internal_id,
			$args,
			null,//form_title
			'1 - A nivel entrenamiento',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			30,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-section-1-col h2.section-title .text';
	}
}

}
