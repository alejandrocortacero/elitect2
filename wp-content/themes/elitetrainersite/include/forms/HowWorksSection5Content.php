<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection5ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCHowWorksSection5ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection5content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Aquí archivaremos todos tus entrenamientos, con fechas de inicio y fin. Todos los entrenamientos tendrán un nombre asignado que los identifique fácilmente y puedas ver cuándo quieras.</p>'//default_text,
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-5-col .section-text';
	}
}

}

