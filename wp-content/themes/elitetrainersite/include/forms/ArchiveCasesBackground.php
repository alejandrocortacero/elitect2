<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCArchiveCasesBackgroundForm' ) )
{

class JLCArchiveCasesBackgroundForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_archive_cases_background',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$bg_color_field = $this->add_background_field(
			'bgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_archive_cases_bg(),
				'label' => __( 'Fondo', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	protected function process_form()
	{
		$bgcolor = $this->get_field_by_name( 'bgcolor' )->get_value();

		EliteTrainerSiteThemeCustomizer::set_archive_cases_bg( $bgcolor );


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
