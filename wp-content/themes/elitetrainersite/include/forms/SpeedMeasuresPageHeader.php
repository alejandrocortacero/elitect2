<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCSpeedMeasuresPageHeaderForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCSpeedMeasuresPageHeaderForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'speedmeasuresheadertext',
			$internal_id,
			$args,
			null,//form_title
			'<p>En esta hoja apuntaremos de forma semanal pesos y medidas corporales.</p><p>De forma personalizada nos podremos en contacto contigo y juntos plantearemos la perdida o aumento de peso corporal, como también el tiempo para lograr estos objetivos de semana en semana.</p>'//default_text,
		);

		$this->text_selector = '.speed-measures-row.row .col-xs-12 .section-text';
	}
}

}

