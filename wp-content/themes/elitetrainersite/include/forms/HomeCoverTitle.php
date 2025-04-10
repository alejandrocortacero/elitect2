<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHomeCoverTitleForm' ) )
{

class JLCHomeCoverTitleForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_home_cover_title',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$this->add_heading( array( 'content' => __( 'Cover title', $this->get_text_domain() ) ) );

		$header_title = EliteTrainerSiteThemeCustomizer::get_home_cover_title();
		$title_field = $this->add_text_field(
			'title',
			array(
				'value' => $header_title,
				'label' => __( 'Title', $this->get_text_domain() ),
				'required' => true
			)
		);
		$title_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_TITLE_KEY ) );

		$title_color_field = $this->add_color_field(
			'color',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_title_color(),
				'label' => __( 'Color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$title_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_TITLE_COLOR_KEY ) );

		$bg_color_field = $this->add_background_field(
			'bgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_title_bg(),
				'label' => __( 'Fondo', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);


		$title_font = EliteTrainerSiteThemeCustomizer::get_home_cover_title_font_family();
		$title_font_select = $this->add_font_select(
			'fontfamily',
			array(
				'label' => 'Fuente del título'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$title_font_select->add_option(
				$key,
				sprintf( "%s (%s)", mb_substr( $header_title, 0, 10 ), $label ),
				array( 'selected' => $key == $title_font )
			);

		$font_size_field = $this->add_number_field(
			'fontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_title_font_size(),
				'label' => __( 'Tamaño del título', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 50
			)
		);
		$font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_TITLE_FONT_SIZE_KEY ) );

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
			'elite-trainer-theme-update-home-cover-title',
			get_template_directory_uri() . '/js/readevents/home-cover-title.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
		$title = $this->get_field_by_name( 'title' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_title( $title );

		$title_color = $this->get_field_by_name( 'color' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_title_color( $title_color );

		$title_font = $this->get_field_by_name( 'fontfamily' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_title_font_family( $title_font );

		$title_size = $this->get_field_by_name( 'fontsize' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_title_font_size( $title_size );

		$bgcolor = $this->get_field_by_name( 'bgcolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_title_bg( $bgcolor );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateHomeCoverTitle',
				'args' => array(
					'homeCoverTitle' => EliteTrainerSiteThemeCustomizer::get_home_cover_title()
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

	//	return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists


