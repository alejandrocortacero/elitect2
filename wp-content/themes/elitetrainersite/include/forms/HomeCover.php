<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHomeCoverForm' ) )
{

class JLCHomeCoverForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_home_cover',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$this->add_heading( array( 'content' => __( 'Cover', $this->get_text_domain() ) ) );
/*
		$this->add_text_field(
			'title',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_title(),
				'label' => __( 'Title', $this->get_text_domain() ),
				'required' => true
			)
		);
*/
/*
		$this->add_wp_editor_field(
			'text',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_text(),
				'label' => __( 'Text', $this->get_text_domain() ),
				'editor_args' => array( 'quicktags' => 'visual', 'media_buttons' => true ),
				'required' => false
			)
		);
*/
		$text_field = $this->add_tinymce_field(
			'homecovertext',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_text(),
				'label' => __( 'Text', $this->get_text_domain() ),
				'required' => false
			)
		);


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
			'elite-trainer-theme-update-home-cover-text',
			get_template_directory_uri() . '/js/readevents/home-cover-text.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
/*
		$title = $this->get_field_by_name( 'title' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_title( $title );
*/
		$text = $this->get_field_by_name( 'homecovertext' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_text( $text );
		
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateHomeCoverText',
				'args' => array(
					'homeCoverText' => EliteTrainerSiteThemeCustomizer::get_home_cover_text()
				)
			) )
		) );
		$response->send();

		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists

