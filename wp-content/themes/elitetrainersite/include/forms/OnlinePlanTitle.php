<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanTitleForm' ) )
{

class JLCOnlinePlanTitleForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_online_plan_title',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();


		$title_field = $this->add_text_field(
			'title',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_title(),
				'label' => __( 'Texto', $this->get_text_domain() ),
				'required' => true
			)
		);
		$title_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_TITLE_KEY ) );

		$title_color_field = $this->add_color_field(
			'color',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_title_color(),
				'label' => __( 'Color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$title_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_TITLE_COLOR_KEY ) );

		$title_font = EliteTrainerSiteThemeCustomizer::get_online_plan_title_font_family();
		$title_font_select = $this->add_font_select(
			'fontfamily',
			array(
				'label' => 'Tipografía'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$title_font_select->add_option(
				$key,
				sprintf( "%s (%s)", mb_substr( EliteTrainerSiteThemeCustomizer::get_online_plan_title(), 0, 20 ), $label ),
				array( 'selected' => $key == $title_font )
			);

		$font_size_field = $this->add_number_field(
			'fontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_title_font_size(),
				'label' => __( 'Tamaño del texto', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 50
			)
		);
		$font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_TITLE_FONT_SIZE_KEY ) );


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
			'elite-trainer-theme-update-online-plan-title',
			get_template_directory_uri() . '/js/readevents/online-plan-title.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
		$title = $this->get_field_by_name( 'title' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_title( $title );

		$color = $this->get_field_by_name( 'color' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_title_color( $color );

		$font = $this->get_field_by_name( 'fontfamily' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_title_font_family( $font );

		$size = $this->get_field_by_name( 'fontsize' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_title_font_size( $size );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateOnlinePlanTitle',
				'args' => array(
					'onlinePlanTitle' => EliteTrainerSiteThemeCustomizer::get_online_plan_title()
				)
			) )
		) );
		$response->add( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateStyle',
				'args' => array()
			) )
		) );
		$response->send();


//		return __( 'Settings saved successfully', $this->get_text_domain() );
	}
}

} // class_exists

