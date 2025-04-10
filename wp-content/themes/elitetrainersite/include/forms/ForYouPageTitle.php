<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouPageTitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCForYouPageTitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagetitle',
			$internal_id,
			$args,
			null,//form_title
			'¿Qué podemos hacer por ti?',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			36,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-title-col h1 .text';
	}
}

}

