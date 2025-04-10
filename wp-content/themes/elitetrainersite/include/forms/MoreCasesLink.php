<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCMoreCasesLinkForm' ) )
{

if( !class_exists( 'JLCLinkAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'LinkAbstract.php' ) ) );

class JLCMoreCasesLinkForm extends JLCLinkAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'morecaseslink',
			$internal_id,
			$args,
			null,//form_title
			'Ver más casos',//default_text
			null,//default_text_color
			null,//default_text_font_size
			null,//default_text_font_family
			null//default_bg
		);

		$this->button_selector = '.more-cases-container .more-cases-link .inner-text';
	}
}

}

