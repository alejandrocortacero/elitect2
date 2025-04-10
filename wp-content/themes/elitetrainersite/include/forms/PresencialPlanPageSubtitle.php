<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPresencialPlanPageSubtitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCPresencialPlanPageSubtitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'presencialplanpagesubtitle',
			$internal_id,
			$args,
			null,//form_title
			'Complementa tu entrenamiento presencialmente',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			26,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.page-header-video-container .title-row h2 .text';
	}
}

}


