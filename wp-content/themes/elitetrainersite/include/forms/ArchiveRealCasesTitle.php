<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCArchiveRealCasesTitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCArchiveRealCasesTitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'archiverealcasestitle',
			$internal_id,
			$args,
			null,//form_title
			'Fotos y vídeos de cambios reales',//default_text,
			EliteTrainerSiteThemeCustomizer::get_main_color(),//default_text_color
			36,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.archive-cases-container .title-row h1 .text';
	}
}

}
