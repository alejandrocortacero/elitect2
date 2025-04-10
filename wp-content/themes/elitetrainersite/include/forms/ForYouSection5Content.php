<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection5ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCForYouSection5ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection5content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Todas las semanas  cambiaremos parte del entrenamiento, para que así el organismo siempre tenga que luchar por adaptarse a algo nuevo y así evitar que caiga en rutina.</p><p>Una vez el músculo se adapta al ejercicio, éste deja de progresar. Así también evitaremos el aburrimiento que genera  entrenar siempre igual.</p><p>Todas las semanas necesitamos ver tu peso corporal en ayunas y sin ropa.</p><p>Cada 2 semanas necesitamos medidas corporales.</p><p>Cada mes, 3 fotografías (esto es opcional, pero nos es de gran ayuda, son fotografías totalmente privadas) y así poder comprobar la composición corporal.</p><p>Recordemos que el peso es importante, pero más aún lo es la composición de este. Un atleta puede pesar 85 kg con un 6% de grasa, mientras que una persona sedentaria con la misma altura y peso, puede estar en más de un 30% de grasa.</p>'//default_text,
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-section-5-col .section-text';
	}
}

}

