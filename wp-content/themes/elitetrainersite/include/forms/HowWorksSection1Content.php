<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection1ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCHowWorksSection1ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection1content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Está claro que cualquier tipo de curso, oposición, estudio y como no,  el deporte, exige una disciplina y motivación constantes. Es por ello, que si se tiene posibilidad de hacerlo de forma presencial, nos aseguramos que en esos momento de flaqueza, duda o desmotivación, tengamos ahí, a un profesional que tire de nosotros y nos haga superarnos día a día.</p><p>No obstante, hay muchas personas que por diferentes motivos no pueden realizarlo así y tienen que hacerlo a distancia. Es aquí donde entra en juego nuestra web ELITECLUBTRAINING. Dijo un sabio, todo lo que podamos y queramos cambiar, cámbialo y lo que no, déjalo fluir.</p><p>No pierdas tu tiempo en intentar controlar cosas que no están en tu mano. Si eres una de esas personas que no pueden contar con un entrenador personal de forma presencial, no te preocupes, déjalo pasar y céntrate en todo que podemos hacer por ti por mediación de esta gran web. Más adelante explicamos de forma resumida las diferentes partes que la componen.</p><p>En ésta plataforma web se compone de 3  importantes partes que resumimos a continuación.</p>'//default_text,
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-1-col .section-text';
	}
}

}


