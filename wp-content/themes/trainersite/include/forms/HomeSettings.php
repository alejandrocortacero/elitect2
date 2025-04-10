<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHomeSettingsForm' ) )
{

class JLCHomeSettingsForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'trainer_site_home_settings',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$this->add_heading( array( 'content' => __( 'Cover', $this->get_text_domain() ) ) );

		$this->add_html( array( 'content' => '<div class="current-background-image"><img src="' . TrainerSiteTheme::get_home_cover_background_url() . '" alt="Background" /></div>' ) );

		$this->add_upload_field(
			'cover_background',
			array(
				'value' => '',
				'label' => __( 'Change background', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);

		$this->add_text_field(
			'cover_subtitle',
			array(
				'value' => get_blog_option( get_current_blog_id(), TrainerSiteTheme::HOME_SUBTITLE_KEY ),
				'label' => __( 'Subtitle', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_heading( array( 'content' => __( 'Content', $this->get_text_domain() ) ) );

		$home = get_post( get_blog_option( get_current_blog_id(), TrainerSiteTheme::HOME_PAGE_KEY ) );
		$this->add_wp_editor_field(
			'home_content',
			array(
				'value' => $home ? $home->post_content : '',
				'label' => __( 'Home content', $this->get_text_domain() ),
				'editor_args' => array( 'quicktags' => 'visual', 'media_buttons' => true ),
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
		$cover_background_field = $this->get_field_by_name( 'cover_background' );

		if( $cover_background_field->is_file_for_upload() && $cover_background_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'cover_background', 0 );
			if( !is_int( $logo_id ) )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Cover background file could not be uploaded', $this->get_text_domain() )
				) );

			update_blog_option( get_current_blog_id(), TrainerSiteTheme::COVER_BACKGROUND_KEY, $logo_id );
		}

		$cover_subtitle = $this->get_field_by_name( 'cover_subtitle' )->get_value();
		update_blog_option( get_current_blog_id(), TrainerSiteTheme::HOME_SUBTITLE_KEY, $cover_subtitle );

		$home_content = $this->get_field_by_name( 'home_content' )->get_value();
		$home_id = get_blog_option( get_current_blog_id(), TrainerSiteTheme::HOME_PAGE_KEY );
		wp_update_post( array(
			'ID' => $home_id,
			'post_content' => $home_content
		) );
		

		return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists

