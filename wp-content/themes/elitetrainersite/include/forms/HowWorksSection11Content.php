<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHowWorksSection11ContentForm' ) )
{

if( !class_exists( 'JLCHtmlAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'HtmlAbstract.php' ) ) );

class JLCHowWorksSection11ContentForm extends JLCHtmlAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'howworkspagesection11content',
			$internal_id,
			$args,
			null,//form_title
			'<h3>Todos éstos datos serán completamente privados.</h3><p>Gracias a todos éstos datos, podremos realizar y mantener tu plan de entrenamiento y alimentación totalmente personalizado según las necesidades de cada momento, evolución, objetivos, posibilidades, etc.</p>'//default_text,
		);

		$this->text_selector = '.how-works-container .row .col-xs-12.how-works-section-11-col .section-text';
	}
}

}

