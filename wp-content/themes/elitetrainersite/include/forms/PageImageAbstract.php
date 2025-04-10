<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPageImageAbstractForm' ) )
{

abstract class JLCPageImageAbstractForm extends JLCCustomForm
{
	protected $image_name;
	protected $image_selector;

	protected $form_title;

	protected $default_image_url;

	public function __construct(
		$image_name,
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
			'elite_trainer_site_' . $image_name . '_page_image',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->image_name = $image_name;
		$this->image_selector = '.page-image-layer-' . $image_name . ' .image';

		$this->default_image_url = null;

		$this->add_honeypot();

		if( !empty( $this->form_title ) )
			$this->add_heading( array( 'content' => $this->form_title ) );

		$this->add_checkbox_field(
			'pageimageenabled_' . $image_name,
			array(
				'value' => 'yes',
				'checked' => EliteTrainerSiteThemeCustomizer::is_page_image_enabled( $image_name ),
				'label' => __( 'Habilitar imagen', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_ajax_upload_image_cropper_field(
			'image',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_image_id( $image_name ),
				'label' => __( 'Imagen', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 3 * 2097152
			)
		);


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
			'elite-trainer-theme-update-custom-image',
			get_template_directory_uri() . '/js/readevents/custom-image.js',
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
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_IMAGE_ID_PREFIX . $this->image_name );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::PAGE_IMAGE_ENABLED_PREFIX . $this->image_name );
		}
		else
		{
			$image_id = $this->get_field_by_name( 'image' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_image_id( $this->image_name, $image_id );
			
			$enabled = $this->get_field_by_name( 'pageimageenabled_' . $this->image_name )->is_checked();
			EliteTrainerSiteThemeCustomizer::set_page_image_enabled( $this->image_name, $enabled );
		}

		$is_image = !empty( EliteTrainerSiteThemeCustomizer::get_image_id( $this->image_name ) ) && EliteTrainerSiteThemeCustomizer::is_page_image_enabled( $this->image_name );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateCustomImage',
				'args' => array(
					'customImageSelector' => $this->image_selector,
					'customImageEnabled' => $is_image,
					'customImageTag' => $is_image ? '<img src="' . EliteTrainerSiteThemeCustomizer::get_image_url( $this->image_name ) . '?azar=' . time() . '" alt="Imagen" />' : ( $this->default_image_url ? '<img src="' . $this->default_image_url . '" class="sample-picture" alt="Muestra" />' : '<p class="text-center"><code>Puede incluir uns imagen aquí</code></p>' )
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
								'fieldName' => 'image',
								'fieldType' => 'ajax_upload_image',
								'fieldValue' => ''
							),
							array(
								'fieldName' => 'pageimageenabled_' . $this->image_name,
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


