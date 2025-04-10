<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCContactDataForm' ) )
{

class JLCContactDataForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_contact_data',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$phone_field = $this->add_text_field(
			'phone',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_contact_phone(),
				'label' => __( 'Teléfono', $this->get_text_domain() ),
				'required' => true
			)
		);
		$phone_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::CONTACT_PHONE_KEY ) );
		

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
			'elite-trainer-theme-update-contact-data',
			get_template_directory_uri() . '/js/readevents/contact-data.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
/*
		$freelancer_code = BubbleFishScoringFirm::FREELANCER_CODE;

		$plugin_path = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', '..', 'bubblefish-scoring-firm.php' ) ) );
		wp_enqueue_script(
			'bubblefish-solicitude-form-script',
			plugins_url( 'js/solicitude.js', $plugin_path ),
			array( 'jquery' ),
			BubbleFishScoringFirm::VERSION,
			true
		);

		wp_localize_script(
			'bubblefish-solicitude-form-script',
			'BubbleFishSolicitudeNS',
			array(
				'freelancerCode' => $freelancer_code
			)
		);
*/
	}

	protected function process_form()
	{
		$phone = $this->get_field_by_name( 'phone' )->get_value();

		EliteTrainerSiteThemeCustomizer::set_contact_phone( $phone );

		
		//return __( 'Settings saved successfully', $this->get_text_domain() );
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateContactData',
				'args' => array(
					'tel' => $phone,
					'telcode' => preg_replace( '/\D/', '', $phone )
				)
			) )
		) );
		$response->send();
	}
}

} // class_exists



