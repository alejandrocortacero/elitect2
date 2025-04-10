<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection1ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCForYouSection1ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection1content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Todos y cada uno de nuestros entrenamientos son HECHOS A MEDIDA , según tus objetivos, tiempo disponible, limitaciones físicas, trayectoria deportiva, equipo deportivo disponible y lugar de entrenamiento.</p><p>Es muy importante que el entrenamiento se adapte a ti y no a la inversa.</p>'//default_text,
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-section-1-col .section-text';
	}
}

}

