<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPresencialPlanPageTitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCPresencialPlanPageTitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'presencialplanpagetitle',
			$internal_id,
			$args,
			null,//form_title
			'Seguimientos presenciales',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			32,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.page-header-video-container .title-row h1 .text';
	}
}

}

