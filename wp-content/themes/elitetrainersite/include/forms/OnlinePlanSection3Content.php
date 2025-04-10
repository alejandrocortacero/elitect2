<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanSection3ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCOnlinePlanSection3ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplanpagesection3content',
			$internal_id,
			$args,
			null,//form_title
			'<ul> <li>Cada 2 semanas revisaremos tu evolución por medio de peso y medidas corporales, también por medio de las tres fotografías que te pedimos (son totalmente personales) en pantalón corto si eres hombre y top en caso de mujer.</li> <li>Esta evolución será contrastada y según tu evolución se realizará los cambios o modificaciones necesarios.</li> </ul>'//default_text,
		);

		$this->text_selector = '.online-plan-content-container .row .online-plan-section-3-col .section-text';
	}
}

}

