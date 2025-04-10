<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPageVideoAbstractForm' ) )
{

abstract class JLCPageVideoAbstractForm extends JLCCustomForm
{
	protected $video_name;
	protected $video_selector;

	protected $form_title;

	public function __construct(
		$video_name,
		$internal_id,
		$args,
		$form_title = null
	) {
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		$this->form_title = $form_title;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_' . $video_name . '_page_video',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->video_name = $video_name;
		$this->video_selector = '.page-video-layer-' . $video_name . ' .video';

		$this->add_honeypot();

		if( !empty( $this->form_title ) )
			$this->add_heading( array( 'content' => $this->form_title ) );

		$this->add_checkbox_field(
			'pagevideoenabled_' . $video_name,
			array(
				'value' => 'yes',
				'checked' => EliteTrainerSiteThemeCustomizer::is_page_video_enabled( $video_name ),
				'label' => __( 'Habilitar vídeo', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_html( array(
			'content' => '<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/vimeo.png" alt="vimeo" /></a></div>'
		) );

		$text_field = $this->add_text_field(
			'videolink',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_video_link( $video_name ),
				'label' => __( 'Video link', $this->get_text_domain() ),
				'help' => __( 'Pega aquí el enlace que aparece en "Compartir"', $this->get_text_domain() ),
				'required' => false
			)
		);
		$text_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::CUSTOM_VIDEO_LINK_PREFIX . $video_name ) );


		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);

		$this->add_hidden_field(
			'restore_val',
			array(
				'value' => '0'
			)
		);

		$this->add_submit_button(
			'restore',
			array(
				'label' => __( 'Reestablecer', $this->get_text_domain() )
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
			'elite-trainer-theme-update-custom-video',
			get_template_directory_uri() . '/js/readevents/custom-video.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
		$restore_val = $this->get_field_by_name( 'restore_val' )->get_value();
		if( $restore_val )
		{
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_VIDEO_LINK_PREFIX . $this->video_name );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::PAGE_VIDEO_ENABLED_PREFIX . $this->video_name );
		}
		else
		{
			$videolink = $this->get_field_by_name( 'videolink' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_video_link( $this->video_name, $videolink );
			
			$enabled = $this->get_field_by_name( 'pagevideoenabled_' . $this->video_name )->is_checked();
			EliteTrainerSiteThemeCustomizer::set_page_video_enabled( $this->video_name, $enabled );
		}

		$is_video = !empty( EliteTrainerSiteThemeCustomizer::get_video_link( $this->video_name ) ) && EliteTrainerSiteThemeCustomizer::is_page_video_enabled( $this->video_name );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateCustomVideo',
				'args' => array(
					'customVideoSelector' => $this->video_selector,
					'customVideoEnabled' => $is_video,
					'customVideoIframe' => $is_video ? EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( EliteTrainerSiteThemeCustomizer::get_video_link( $this->video_name ) ) : '<p class="text-center"><code>Puede incluir un video aquí</code></p>'
				)
			) )
		) );
		if( $restore_val )
			$response->add( array(
				'what' => 'json',
				'action' => 'event',
				'id' => 1,
				'data' => json_encode( array(
					'name' => 'eliteTrainerThemeRestoreForm',
					'args' => array(
						'formId' => $this->internal_id,
						'fields' => array(
							array(
								'fieldName' => 'videolink',
								'fieldValue' => ''
							),
							array(
								'fieldName' => 'pagevideoenabled_' . $this->video_name,
								'fieldType' => 'checkbox',
								'fieldValue' => false 
							)
						)
					)
				) )
			) );
	
		$response->send();

		//return __( 'Settings saved successfully', $this->get_text_domain() );
	}


}

} // class_exists

