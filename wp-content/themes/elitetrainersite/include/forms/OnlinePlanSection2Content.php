<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanSection2ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCOnlinePlanSection2ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplanpagesection2content',
			$internal_id,
			$args,
			null,//form_title
			'<ul> <li>Según tus objetivos, tiempo disponible y equipo existente o no, será realizado el entrenamiento.</li> <li>Este entrenamiento será explicado por medio de fotografías, videos tutoriales y textos explicativos.</li> <li>Realizaremos cambios de forma quincenal.</li> </ul>'//default_text,
		);

		$this->text_selector = '.online-plan-content-container .row .online-plan-section-2-col .section-text';
	}
}

}

