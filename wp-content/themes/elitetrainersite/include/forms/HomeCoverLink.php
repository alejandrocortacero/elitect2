<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHomeCoverLinkForm' ) )
{

if( !class_exists( 'JLCLinkAbstractForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'LinkAbstract.php' ) ) );

class JLCHomeCoverLinkForm extends JLCLinkAbstractForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct(
			'homecover',
			$internal_id,
			$args,
			null,//form_title
			'Comienza ahora mismo y no lo dejes para mañana',//default_text
			null,//default_text_color
			null,//default_text_font_size
			null,//default_text_font_family
			null//default_bg
		);

		$this->button_selector = '.home-cover .home-cover-col .left .join-link-layer .join-link .inner-text';
	}
}

}
/*
if( !class_exists( 'JLCHomeCoverLinkForm' ) )
{

class JLCHomeCoverLinkForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_home_cover_link',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$this->add_heading( array( 'content' => __( 'Cover', $this->get_text_domain() ) ) );

		$text_field = $this->add_text_field(
			'text',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_button_text(),
				'label' => __( 'Text link', $this->get_text_domain() ),
				'required' => true
			)
		);
		$text_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_BUTTON_TEXT_KEY ) );

		$color_field = $this->add_color_field(
			'color',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_button_color(),
				'label' => __( 'Color de texto', $this->get_text_domain() ),
				'required' => true
			)
		);
		$color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_BUTTON_COLOR_KEY ) );

		$bg_color_field = $this->add_background_field(
			'bgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_button_color_bg(),
				'label' => __( 'Fondo', $this->get_text_domain() ),
				'required' => true
			)
		);
		//$bg_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_BUTTON_COLOR_BG_KEY ) );


		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();
	}

	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'elite-trainer-theme-update-home-cover-link',
			get_template_directory_uri() . '/js/readevents/home-cover-link.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
		$text = $this->get_field_by_name( 'text' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_button_text( $text );
		
		$color = $this->get_field_by_name( 'color' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_button_color( $color );
		
		$bgcolor = $this->get_field_by_name( 'bgcolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_button_color_bg( $bgcolor );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateStyle',
				'args' => array()
			) )
		) );
		$response->add( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateHomeCoverButton',
				'args' => array(
					'homeCoverButtonText' => EliteTrainerSiteThemeCustomizer::get_home_cover_button_text()
				)
			) )
		) );
		$response->send();

		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists
*/


