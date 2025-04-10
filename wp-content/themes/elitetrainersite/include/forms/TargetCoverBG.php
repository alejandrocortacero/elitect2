<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCTargetCoverBGForm' ) )
{

class JLCTargetCoverBGForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_target_cover_bg',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

/*
		$cover_bg_field = $this->add_ajax_upload_image_position_field(
			'targetcoverbg',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_target_cover_bg(),
				'label' => __( 'Change background', $this->get_text_domain() ),
				'required' => false,
				'help' => 'Se recomienda usar una foto horizontal. ' . __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
		$cover_bg_field->set_selection_window( array( 'callback' => array( $this, 'get_images' ) ) );

		$cover_bg_v_field = $this->add_ajax_upload_image_position_field(
			'targetcoverbgv',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_target_cover_bg( false ),
				'label' => __( 'Change vertical background', $this->get_text_domain() ),
				'required' => false,
				'help' => 'Se recomienda usar una foto vertical. ' . __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
		$cover_bg_v_field->set_selection_window( array( 'callback' => array( $this, 'get_images' ) ) );
		$cover_bg_v_field->set_for_portrait(true);
*/
		$cover_bg_field = $this->add_ajax_upload_image_cropper_field(
			'targetcoverbg',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_target_cover_bg(),
				'label' => __( 'Change background', $this->get_text_domain() ),
				'required' => false,
				'help' => 'Se recomienda usar una foto horizontal. ' . __( '.jpg, or .png files (Max: 10MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152 * 5
			)
		);

		$cover_bg_v_field = $this->add_ajax_upload_image_cropper_field(
			'targetcoverbgv',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_target_cover_bg( false ),
				'label' => __( 'Change vertical background', $this->get_text_domain() ),
				'required' => false,
				'help' => 'Se recomienda usar una foto vertical. ' . __( '.jpg, or .png files (Max: 10MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152 * 5
			)
		);

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	public function get_images()
	{
		$posts = get_posts( array(
			'numberposts' => -1,
			'post_type' => 'attachment'
		) );

		$images = array();
		foreach( $posts as $p )
			$images[] = array( 'id' => $p->ID, 'url' => wp_get_attachment_url( $p->ID ) );

		$images = json_encode( $images );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'getImages',
			'id' => 1,
			'data' => $images
		) );
		$response->send();
	}

	protected function process_form()
	{
/*
		$bg_field = $this->get_field_by_name( 'coverbg' );
		if( $bg_field->is_file_for_upload() && $bg_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'coverbg', 0 );
			if( !is_int( $logo_id ) )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Background file could not be uploaded', $this->get_text_domain() )
				) );

			EliteTrainerSiteThemeCustomizer::set_target_cover_bg( $logo_id );
		}
*/
		$bg_field = $this->get_field_by_name( 'targetcoverbg' );
		EliteTrainerSiteThemeCustomizer::set_target_cover_bg( $bg_field->get_value() );

		$bg_v_field = $this->get_field_by_name( 'targetcoverbgv' );
		EliteTrainerSiteThemeCustomizer::set_target_cover_bg( $bg_v_field->get_value(), false );

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


