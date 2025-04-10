<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection10ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCHowWorksSection10ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection10content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Archivaremos tus fotografías mes a mes y así podremos comprobar tu evolución. </p>'//default_text,
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-10-col .section-text';
	}
}

}

