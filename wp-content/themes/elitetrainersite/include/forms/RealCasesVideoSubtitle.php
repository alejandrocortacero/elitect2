<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCRealCasesVideoSubtitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCRealCasesVideoSubtitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'realcasesvideosubtitle',
			$internal_id,
			$args,
			null,//form_title
			'Míralo tu mismo',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			30,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.archive-cases-container .title-row h2 .text';
	}
}

}

