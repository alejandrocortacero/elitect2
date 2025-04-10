<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection4ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCHowWorksSection4ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection4content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Archivaremos todos los planes de alimentación que te creemos, todos con fechas de inicio y fin. Todas las dietas tendrán un nombre que las identifique fácilmente y puedas ver cuando quieras.</p>'//default_text,
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-4-col .section-text';
	}
}

}

