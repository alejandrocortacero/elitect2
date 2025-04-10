<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCForYouSection4ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCForYouSection4ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'foryoupagesection4content',
			$internal_id,
			$args,
			null,//form_title
			'<p>Ya habrás oído en repetidas ocasiones que la alimentación es lo más importante. Pues sí, es muy cierto, pero para poder cumplir (con éxito) un plan de alimentación deportivo , hay que tener algo muy muy en cuenta: NUESTROS GUSTOS POR LOS ALIMENTOS, DISPONIBILIDAD ECONÓMICA, NUESTROS HORARIOS Y TIPO DE TRABAJO.</p><p>Cada uno de nosotros tenemos unos gustos, una cierta disponibilidad horaria y depende del tipo de trabajo que tengamos (podemos comer tranquilamente o solo podemos ingerir líquidos, tiene q ser algo rápido o sobre la marcha etc).</p><p>Si alguno de estos factores no se tiene en cuenta, no estamos cambiando hábitos dietéticos, si no realizando una dieta puntual a la que le pondremos fecha de inicio y final.</p><p>Durante este tiempo nos esforzaremos para adaptarnos a esa fantástica dieta, que promete resultados casi mágicos, pero... ¿cuánto tiempo podemos comer alimentos que no nos gustan, no se adapten a nuestros horarios, incómodos de tomar según nuestro puesto de trabajo o demasiado caros?. Lo mejor para no hacer ni dejar una dieta, es aprender alimentarte de forma adaptada a tus necesidades en todos los sentidos.</p><p>Con nuestros tutoriales aprenderás día a día a utilizar los alimentos en función de sus componentes nutricionales (y por supuesto su sabor) y elegir los que mejor te convengan según el momento, precio, objetivos, etc.</p><p>Aprenderás a leer las etiquetas de los alimentos y la industria alimentaria, no podrá utilizar tu desconocimiento, para que con la simple palabra light, pienses que lo que tomas es saludable.</p><p>Por supuesto que este aprendizaje es voluntario y si lo que prefieres es que nosotros te preparemos tu plan de alimentación a medida, según lo descrito anteriormente y realicemos las modificaciones necesarias de los alimentos o cantidades de estos, según tus gustos, objetivos y necesidades en general, así será por supuesto.</p>'//default_text,
		);

		$this->text_selector = '.for-you-container .row .col-xs-12.for-you-section-4-col .section-text';
	}
}

}

