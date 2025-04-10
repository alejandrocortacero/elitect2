<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanSection0AContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCOnlinePlanSection0AContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplanpagesection0acontent',
			$internal_id,
			$args,
			null,//form_title
			'<p>Entrenamientos 100% personalizados según tus horarios, objetivos, limitaciónes físicas, etc...</p> <p>Planes de alimentación realizados a medida (nos adaptamos a tus necesidades).</p> <p>Seguimientos de evolución/resultados semanales, realizaremos cambios en tu plan de alimentación y/o entrenamiento según tus necesidades, objetivos, horarios, etc...</p>'//default_text,
		);

		$this->text_selector = '.online-plan-content-container .row .online-col-0a .section-text';
	}
}

}
