<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksPageTitle2Form' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCHowWorksPageTitle2Form extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagetitle',
			$internal_id,
			$args,
			null,//form_title
			'Así funciona Elite Club Training',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			32,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.page-header-video-container .title-row h1 .text';
	}
}

}
