<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHtmlAbstractForm' ) )
{

abstract class JLCHtmlAbstractForm extends JLCCustomForm
{
	protected $text_name;
	protected $text_selector;

	protected $form_title;
	protected $default_text;
	//protected $default_text_color;
	//protected $default_text_font_size;
	//protected $default_text_font_family;

	public function __construct(
		$text_name,
		$internal_id,
		$args,
		$form_title = null,
		$default_text = null//,
		//$default_text_color = null,
		//$default_text_font_size = null,
		//$default_text_font_family = null
	) {
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		$this->form_title = $form_title;
		$this->default_text = $default_text;
		//$this->default_text_color = $default_text_color;
		//$this->default_text_font_size = $default_text_font_size;
		//$this->default_text_font_family = $default_text_font_family;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_' . $text_name . '_html',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->class = 'elitetrainersite-html-form';

		$this->text_name = $text_name;
		$this->text_selector = null;

		$this->add_honeypot();

		if( !empty( $this->form_title ) )
			$this->add_heading( array( 'content' => $this->form_title ) );

		$text_field = $this->add_tinymce_field(
			EliteTrainerSiteThemeCustomizer::CUSTOM_HTML_CONTENT_PREFIX . $this->text_name,
			array(
				'value' => wp_kses_post( EliteTrainerSiteThemeCustomizer::get_html_content( $this->text_name, $this->default_text ) ),
				'label' => __( 'Contenido', $this->get_text_domain() ),
				'required' => false
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
			'elite-trainer-theme-update-custom-html',
			get_template_directory_uri() . '/js/readevents/custom-html.js',
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
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_HTML_CONTENT_PREFIX . $this->text_name );
		}
		else
		{
			$text = $this->get_field_by_name( EliteTrainerSiteThemeCustomizer::CUSTOM_HTML_CONTENT_PREFIX . $this->text_name )->get_value();
			EliteTrainerSiteThemeCustomizer::set_html_content( $this->text_name, $text );
		}

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateCustomHtml',
				'args' => array(
					'customHtmlSelector' => $this->text_selector,
					'customHtmlContent' => wp_kses_post( EliteTrainerSiteThemeCustomizer::get_html_content( $this->text_name, $this->default_text ) )
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
								'fieldName' => EliteTrainerSiteThemeCustomizer::CUSTOM_HTML_CONTENT_PREFIX . $this->text_name,
								'fieldValue' => wp_kses_post( EliteTrainerSiteThemeCustomizer::get_html_content( $this->text_name, $this->default_text ) )
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
