<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCSiteStyleForm' ) )
{

class JLCSiteStyleForm extends JLCCustomForm
{
	protected $big_logo_image;
	protected $small_logo_image;
	protected $logo_heading;
	protected $colors_heading;

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

		$this->logo_heading = $this->add_heading( array( 'content' => __( 'Logo', $this->get_text_domain() ) ) );

		$this->big_logo_image = $this->add_html( array( 'content' => '<div class="current-big-logo-image current-image"><img src="' . TrainerSiteTheme::get_big_logo_url() . '" alt="Background" /></div>' ) );

		$this->add_upload_field(
			'big_logo',
			array(
				'value' => '',
				'label' => __( 'Big logo', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);

		$this->small_logo_image = $this->add_html( array( 'content' => '<div class="current-small-logo-image current-image"><img src="' . TrainerSiteTheme::get_small_logo_url() . '" alt="Background" /></div>' ) );

		$this->add_upload_field(
			'small_logo',
			array(
				'value' => '',
				'label' => __( 'Small logo', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 0.5MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 524288
			)
		);

		$this->colors_heading = $this->add_heading( array( 'content' => __( 'Colors', $this->get_text_domain() ) ) );

		$this->add_color_field(
			'main_color',
			array(
				'value' => TrainerSiteTheme::get_main_color(),
				'label' => __( 'Main color', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_color_field(
			'secondary_color',
			array(
				'value' => TrainerSiteTheme::get_secondary_color(),
				'label' => __( 'Secondary color', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_color_field(
			'background_color',
			array(
				'value' => TrainerSiteTheme::get_background_color(),
				'label' => __( 'Background color', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_color_field(
			'text_color',
			array(
				'value' => TrainerSiteTheme::get_text_color(),
				'label' => __( 'Text color', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_color_field(
			'heading_color',
			array(
				'value' => TrainerSiteTheme::get_heading_color(),
				'label' => __( 'Heading color', $this->get_text_domain() ),
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
		$big_logo_field = $this->get_field_by_name( 'big_logo' );
		$small_logo_field = $this->get_field_by_name( 'small_logo' );

		if( $big_logo_field->is_file_for_upload() && $big_logo_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'big_logo', 0 );
			if( !is_int( $logo_id ) )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Big logo file could not be uploaded', $this->get_text_domain() )
				) );

			update_blog_option( get_current_blog_id(), TrainerSiteTheme::SITE_BIG_LOGO_KEY, $logo_id );
		}

		if( $small_logo_field->is_file_for_upload() && $small_logo_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'small_logo', 0 );
			if( !is_int( $logo_id ) )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Small logo file could not be uploaded', $this->get_text_domain() )
				) );

			update_blog_option( get_current_blog_id(), TrainerSiteTheme::SITE_SMALL_LOGO_KEY, $logo_id );
		}

		$main_color = $this->get_field_by_name( 'main_color' )->get_value();
		$secondary_color = $this->get_field_by_name( 'secondary_color' )->get_value();
		$background_color = $this->get_field_by_name( 'background_color' )->get_value();
		$text_color = $this->get_field_by_name( 'text_color' )->get_value();
		$heading_color = $this->get_field_by_name( 'heading_color' )->get_value();

		
		update_blog_option( get_current_blog_id(), TrainerSiteTheme::MAIN_COLOR_KEY, $main_color );
		update_blog_option( get_current_blog_id(), TrainerSiteTheme::SECONDARY_COLOR_KEY, $secondary_color );
		update_blog_option( get_current_blog_id(), TrainerSiteTheme::BACKGROUND_COLOR_KEY, $background_color );
		update_blog_option( get_current_blog_id(), TrainerSiteTheme::TEXT_COLOR_KEY, $text_color );
		update_blog_option( get_current_blog_id(), TrainerSiteTheme::HEADING_COLOR_KEY, $heading_color );

		return __( 'Settings saved successfuly!', $this->get_text_domain() );
	}


}

} // class_exists
