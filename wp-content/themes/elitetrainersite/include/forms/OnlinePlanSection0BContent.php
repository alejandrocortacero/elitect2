<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanSection0BContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCOnlinePlanSection0BContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'onlineplanpagesection0bcontent',
			$internal_id,
			$args,
			null,//form_title
			'<p>Éste precio abarca todo el seguimiento dietético deportivo a distancia durante 1 mes.</p> <p>Si le interesa conocer los diferentes seguimientos presenciales pinche </p>'//default_text,
		);

		$this->text_selector = '.online-plan-content-container .row .online-col-0b .section-text';
	}
}

}
