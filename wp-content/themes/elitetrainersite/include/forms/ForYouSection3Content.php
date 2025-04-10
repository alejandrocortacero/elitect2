<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection3ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCForYouSection3ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection3content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Por mediación de varios formularios muy detallados, fotografías y demás detalles personales que nos puedas facilitar.</p><p>Si tienes posibilidad y vives en Madrid o cercanías, podrías solicitar una clase con uno/a de nuestros entrenadores, en nuestras instalaciones en Alcalá de henares o en tu propia vivienda y realizar un test físico-articular, por el cual, conoceremos de forma exacta el nivel del que partimos.</p>'//default_text,
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-section-3-col .section-text';
	}
}

}

