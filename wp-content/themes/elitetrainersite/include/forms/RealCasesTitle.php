<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCRealCasesTitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCRealCasesTitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'realcasestitle',
			$internal_id,
			$args,
			null,//form_title
			'Casos reales',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			32,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.cases-container .title-row h2 .text';
	}
}

}
