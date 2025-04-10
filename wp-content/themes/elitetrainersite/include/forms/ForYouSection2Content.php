<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection2ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCForYouSection2ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection2content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Por mediación de fotografías, textos y vídeos tutoriales.</p>'//default_text,
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-section-2-col .section-text';
	}
}

}

