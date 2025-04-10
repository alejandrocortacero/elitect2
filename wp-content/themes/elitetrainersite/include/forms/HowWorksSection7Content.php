<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection7ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCHowWorksSection7ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection7content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Éstos ejercicios serán explicados con fotografías, textos y vídeos tutoriales.</p>'//default_text,
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-7-col .section-text';
	}
}

}

