<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPresencialPlanButtonForm' ) )
{

if( !class_exists( 'JLCLinkAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'LinkAbstract.php' ) ) );

class JLCPresencialPlanButtonForm extends JLCLinkAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'knowpresenciallink',
			$internal_id,
			$args,
			null,//form_title
			'Saber más',//default_text
			null,//default_text_color
			null,//default_text_font_size
			null,//default_text_font_family
			null//default_bg
		);

		$this->button_selector = '.plans-container .presencial-col .know-more-layer .know-more';
	}
}

}
