<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection8TitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCHowWorksSection8TitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection8title',
			$internal_id,
			$args,
			null,//form_title
			'Zona de evolución',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			30,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-8-col h2.section-title .text';
	}
}

}



