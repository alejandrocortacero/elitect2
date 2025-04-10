<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHomeCoverVideoForm' ) )
{

class JLCHomeCoverVideoForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_home_cover_video',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		//$this->add_heading( array( 'content' => __( 'Cover', $this->get_text_domain() ) ) );
/*
		$this->add_html( array(
			'content' => '<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/vimeo.png" alt="vimeo" /></a><a target="_blank" href="https://www.tiktok.com/es" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/tiktok.png" alt="tiktok" /></a></div>'
		) );
*/
		$this->add_html( array(
			'content' => '<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/vimeo.png" alt="vimeo" /></a></div>'
		) );

/*
		$this->add_textarea_field(
			'video',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_video(),
				'label' => __( 'Video iframe', $this->get_text_domain() ),
				'required' => false
			)
		);
*/
		$this->add_text_field(
			'videolink',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_home_cover_video_link(),
				'label' => __( 'Video link', $this->get_text_domain() ),
				'help' => __( 'Pega aquí el enlace que aparece en "Compartir"', $this->get_text_domain() ),
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
			'elite-trainer-theme-update-home-cover-video',
			get_template_directory_uri() . '/js/readevents/home-cover-video.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
/*
		$video = $this->get_field_by_name( 'video' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_video( $video );
		
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateHomeCoverVideo',
				'args' => array(
					'homeCoverVideo' => EliteTrainerSiteThemeCustomizer::get_home_cover_video()
				)
			) )
		) );
		$response->send();
*/
		$videolink = $this->get_field_by_name( 'videolink' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_home_cover_video_link( $videolink );
		
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateHomeCoverVideo',
				'args' => array(
					'homeCoverVideo' => EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( EliteTrainerSiteThemeCustomizer::get_home_cover_video_link() )
				)
			) )
		) );
		$response->send();

		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists

