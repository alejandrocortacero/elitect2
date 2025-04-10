<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPresencialPlanTitleForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCPresencialPlanTitleForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'presencialplantitle',
			$internal_id,
			$args,
			null,//form_title
			'Presencial',//default_text,
			EliteTrainerSiteThemeCustomizer::get_main_color(),//default_text_color
			30,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.plans-container > .row .col-xs-12.presencial-col .type .text';
	}
}

}

