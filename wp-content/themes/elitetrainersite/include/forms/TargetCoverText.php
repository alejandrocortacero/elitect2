<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCTargetCoverTextForm' ) )
{

class JLCTargetCoverTextForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_target_cover_text',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

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
			'textin',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_target_cover_text(),
				'label' => __( 'Text', $this->get_text_domain() ),
				'editor_args' => array( 'quicktags' => 'visual', 'media_buttons' => true ),
				'required' => false
			)
		);
*/
		$this->add_tinymce_field(
			'textin',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_target_cover_text(),
				'label' => __( 'Text', $this->get_text_domain() ),
				//'editor_args' => array( 'quicktags' => 'visual', 'media_buttons' => true ),
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
			'elite-trainer-theme-update-target-cover-text',
			get_template_directory_uri() . '/js/readevents/target-cover-text.js',
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
		$text = $this->get_field_by_name( 'textin' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_target_cover_text( $text );
		
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateTargetCoverText',
				'args' => array(
					'targetCoverText' => EliteTrainerSiteThemeCustomizer::get_target_cover_text()
				)
			) )
		) );
		$response->send();

		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists


