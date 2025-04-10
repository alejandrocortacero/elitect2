<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCRealCasesVideoTextForm' ) )
{

if( !class_exists( 'JLCTextAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'TextAbstract.php' ) ) );

class JLCRealCasesVideoTextForm extends JLCTextAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'realcasesvideotext',
			$internal_id,
			$args,
			'Título del vídeo',//form_title
			'Casos reales',//default_text,
			null,//default_text_color
			20,//default_font_size
			null//default_font_family
		);

		$this->text_selector = '.home-cover .home-cover-col .right .video-title h3';
	}
}

}

