<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanSection1ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCOnlinePlanSection1ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplanpagesection1content',
			$internal_id,
			$args,
			null,//form_title
			'<ul> <li>Las dietas serán preparadas según tus gustos. Puntuarás del 1 al 10 un listado con mas de 100 alimentos, pudiendo añadir los que no aparezcan en esta lista y quieras incluir como posible alimento.</li> <li>Se cambiará de forma quincenal, según los objetivos conseguidos.</li> <li>Se atenderán consultas y dudas por mediación de mensajes.</li> <li>Nunca utilizaremos alimentos que no t gusten.</li> <li>Adaptaremos los alimentos que te gusten a tu disponibilidad horaria</li> <li>Conseguiremos generar nuevas hábitos dieteticos, no realizaremos simplemente una dieta puntual.</li> </ul>'//default_text,
		);

		$this->text_selector = '.online-plan-content-container .row .online-plan-section-1-col .section-text';
	}
}

}


