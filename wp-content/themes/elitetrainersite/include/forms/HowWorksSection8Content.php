<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection8ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCHowWorksSection8ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection8content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Aquí archivaremos tu peso y medidas corporales (brazos, piernas, hombros, cintura, etc). Estos datos podrán verse en forma de gráficas evolutivas. Junto a estos datos podrás comunicarnos alguna observación en base a los resultados obtenidos.</p>'//default_text,
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-8-col .section-text';
	}
}

}

