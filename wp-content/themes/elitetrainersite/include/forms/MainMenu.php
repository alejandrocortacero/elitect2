<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCMainMenuForm' ) )
{

class JLCMainMenuForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_main_menu',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$hide_desktop_field = $this->add_checkbox_field(
			'hidedesktop',
			array(
				'value' => 'yes',
				'label' => __( 'Ocultar en escritorio', $this->get_text_domain() ),
				'checked' => EliteTrainerSiteThemeCustomizer::must_hide_main_menu_on_desktop(),
				'required' => false
			)
		);
		

		$color_field = $this->add_color_field(
			'color',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_main_menu_text_color(),
				'label' => __( 'Color de texto', $this->get_text_domain() ),
				'required' => true
			)
		);
		$color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::MAIN_MENU_TEXT_COLOR_KEY ) );

		$bg_color_field = $this->add_background_field(
			'bgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_main_menu_bg(),
				'label' => __( 'Fondo', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);
		//$bg_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_BUTTON_COLOR_BG_KEY ) );

		$font_size_field = $this->add_number_field(
			'fontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_main_menu_font_size(),
				'label' => __( 'Tamaño de texto', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 30
			)
		);
		$font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::MAIN_MENU_FONT_SIZE_KEY ) );

		$font_family = EliteTrainerSiteThemeCustomizer::get_main_menu_font_family();
		$font_family_select = $this->add_font_select(
			'fontfamily',
			array(
				'label' => 'Fuente'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$font_family_select->add_option(
				$key,
				sprintf( "%s (%s)", 'abcdefABCDEF', $label ),
				array( 'selected' => $key == $font_family )
			);

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}
/*
	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();
	}

	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'elite-trainer-theme-update-custom-button',
			get_template_directory_uri() . '/js/readevents/custom-button.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}
*/
	protected function process_form()
	{
		$hide = $this->get_field_by_name( 'hidedesktop' )->is_checked();
		EliteTrainerSiteThemeCustomizer::set_hide_main_menu_on_desktop( $hide );
		
		$color = $this->get_field_by_name( 'color' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_main_menu_text_color( $color );
		
		$bgcolor = $this->get_field_by_name( 'bgcolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_main_menu_bg( $bgcolor );
		
		$fontsize = $this->get_field_by_name( 'fontsize' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_main_menu_font_size( $fontsize );

		$fontfamily = $this->get_field_by_name( 'fontfamily' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_main_menu_font_family( $fontfamily );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateStyle',
				'args' => array()
			) )
		) );
/*
		$response->add( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateCustomButton',
				'args' => array(
					'customButtonSelector' => $this->button_selector,
					'customButtonText' => EliteTrainerSiteThemeCustomizer::get_button_text( $this->button )
				)
			) )
		) );
*/
		$response->send();

		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists



