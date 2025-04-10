<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPresencialPlanFeaturesForm' ) )
{

class JLCPresencialPlanFeaturesForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_presencial_plan_features',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$this->add_tinymce_field(
			'presencialfeatures',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_presencial_plan_features(),
				'label' => __( 'Características', $this->get_text_domain() ),
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
			'elite-trainer-theme-update-presencial-plan-features',
			get_template_directory_uri() . '/js/readevents/presencial-plan-features.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
		$features = $this->get_field_by_name( 'presencialfeatures' )->get_value();

		EliteTrainerSiteThemeCustomizer::set_presencial_plan_features( $features );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdatePresencialFeaturesText',
				'args' => array(
					'presencialFeaturesText' => EliteTrainerSiteThemeCustomizer::get_presencial_plan_features()
				)
			) )
		) );
		$response->send();
		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}
}

} // class_exists


