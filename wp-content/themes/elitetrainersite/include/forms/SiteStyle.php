<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCSiteStyleForm' ) )
{

class JLCSiteStyleForm extends JLCCustomForm
{

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'trainer_site_site_style',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		//$this->add_honeypot();

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	// These getters are for form customization in themes


	protected function enqueue_scripts()
	{
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

		return __( 'Settings saved successfuly!', $this->get_text_domain() );
	}


}

} // class_exists
