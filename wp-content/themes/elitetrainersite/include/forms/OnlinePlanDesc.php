<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanDescForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCOnlinePlanDescForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplandesc',
			$internal_id,
			$args,
			null,//form_title
			'Seguimiento a distancia personalizado dietetico-deportivo',//default_text,
			EliteTrainerSiteThemeCustomizer::get_text_color(),//default_text_color
			26,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.plans-container > .row .col-xs-12.online-col .desc .text';
	}
}

}
