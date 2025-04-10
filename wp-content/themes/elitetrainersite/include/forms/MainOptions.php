<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCMainOptionsForm' ) )
{

class JLCMainOptionsForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_main_options',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		//$this->add_heading( array( 'content' => __( 'Cover', $this->get_text_domain() ) ) );

		$global_font = EliteTrainerSiteThemeCustomizer::get_global_font();
		$font_select = $this->add_font_select(
			'font',
			array(
				'label' => 'Fuente'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$font_select->add_option(
				$key,
				$label,
				array( 'selected' => $key == $global_font )
			);

		$main_color_field = $this->add_color_field(
			'maincolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_main_color(),
				'label' => __( 'Main color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$main_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::MAIN_COLOR_KEY ) );

		$secondary_color_field = $this->add_color_field(
			'secondarycolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_secondary_color(),
				'label' => __( 'Secondary color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$secondary_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::SECONDARY_COLOR_KEY ) );

/*
		$body_bg_field = $this->add_color_field(
			'bodybgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_body_bg_color(),
				'label' => __( 'Body background color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$body_bg_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::BODY_BG_COLOR_KEY ) );
*/
		$body_bg_field = $this->add_background_field(
			'bodybgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_body_bg(),
				'label' => __( 'Body background color', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);

		$text_color_field = $this->add_color_field(
			'textcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_text_color(),
				'label' => __( 'Text color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$text_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::TEXT_COLOR_KEY ) );


		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	protected function process_form()
	{
		$font = $this->get_field_by_name( 'font' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_global_font( $font );

		$main_color = $this->get_field_by_name( 'maincolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_main_color( $main_color );

		$secondary_color = $this->get_field_by_name( 'secondarycolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_secondary_color( $secondary_color );

		$body_bg_color = $this->get_field_by_name( 'bodybgcolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_body_bg_color( $body_bg_color );

		$text_color = $this->get_field_by_name( 'textcolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_text_color( $text_color );
		
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateStyle',
				'args' => array()
			) )
		) );
		$response->send();

		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists

