<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCUserTrainingStyleForm' ) )
{

class JLCUserTrainingStyleForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_user_training_style',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		//$this->add_heading( array( 'content' => __( 'Cover', $this->get_text_domain() ) ) );

		$font = EliteTrainerSiteThemeCustomizer::get_user_training_font_family();
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
				array( 'selected' => $key == $font )
			);

		$bg_color_field = $this->add_background_field(
			'bg1',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_user_training_bg_1(),
				'label' => __( 'Fondo 1', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);
		$bg_color_field = $this->add_background_field(
			'bg2',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_user_training_bg_2(),
				'label' => __( 'Fondo 2', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);

		$color1_field = $this->add_color_field(
			'color1',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_user_training_color_1(),
				'label' => __( 'Color 1', $this->get_text_domain() ),
				'required' => true
			)
		);
		$color1_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::USER_TRAINING_COLOR_1_KEY ) );

		$color2_field = $this->add_color_field(
			'color2',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_user_training_color_2(),
				'label' => __( 'Color 2', $this->get_text_domain() ),
				'required' => true
			)
		);
		$color2_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::USER_TRAINING_COLOR_2_KEY ) );

		$color3_field = $this->add_color_field(
			'color3',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_user_training_color_3(),
				'label' => __( 'Color 3', $this->get_text_domain() ),
				'required' => true
			)
		);
		$color3_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::USER_TRAINING_COLOR_3_KEY ) );

		$color4_field = $this->add_color_field(
			'color4',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_user_training_color_4(),
				'label' => __( 'Color 4', $this->get_text_domain() ),
				'required' => true
			)
		);
		$color4_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::USER_TRAINING_COLOR_4_KEY ) );


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
		EliteTrainerSiteThemeCustomizer::set_user_training_font_family( $font );

		$bg1 = $this->get_field_by_name( 'bg1' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_user_training_bg_1( $bg1 );
		$bg2 = $this->get_field_by_name( 'bg2' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_user_training_bg_2( $bg2 );

		$color1 = $this->get_field_by_name( 'color1' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_user_training_color_1( $color1 );

		$color2 = $this->get_field_by_name( 'color2' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_user_training_color_2( $color2 );

		$color3 = $this->get_field_by_name( 'color3' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_user_training_color_3( $color3 );

		$color4 = $this->get_field_by_name( 'color4' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_user_training_color_4( $color4 );

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



