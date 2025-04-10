<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCLinkAbstractForm' ) )
{

abstract class JLCLinkAbstractForm extends JLCCustomForm
{
	protected $button;
	protected $button_selector;

	protected $form_title;
	protected $default_text;
	protected $default_text_color;
	protected $default_text_font_size;
	protected $default_text_font_family;
	protected $default_bg;

	public function __construct(
		$button,
		$internal_id,
		$args,
		$form_title = null,
		$default_text = null,
		$default_text_color = null,
		$default_text_font_size = null,
		$default_text_font_family = null,
		$default_bg = null
	) {
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		$this->form_title = $form_title;
		$this->default_text = $default_text;
		$this->default_text_color = $default_text_color;
		$this->default_text_font_size = $default_text_font_size;
		$this->default_text_font_family = $default_text_font_family;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_' . $button . '_link',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->button = $button;
		$this->button_selector = null;

		$this->add_honeypot();

		if( !empty( $this->form_title ) )
			$this->add_heading( array( 'content' => $this->form_title ) );

		$text_field = $this->add_text_field(
			'text',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_button_text( $button, $this->default_text ),
				'label' => __( 'Text link', $this->get_text_domain() ),
				'required' => true
			)
		);
		$text_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_TEXT_PREFIX . $button ) );

		$color_field = $this->add_color_field(
			'color',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_button_color( $button, $this->default_text_color ),
				'label' => __( 'Color de texto', $this->get_text_domain() ),
				'required' => true
			)
		);
		$color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_TEXT_COLOR_PREFIX . $button ) );

		$bg_color_field = $this->add_background_field(
			'bgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_button_bg( $button, $this->default_bg ),
				'label' => __( 'Fondo', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);
		//$bg_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HOME_COVER_BUTTON_COLOR_BG_KEY ) );

		$font_size_field = $this->add_number_field(
			'fontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_button_font_size( $button, $this->default_text_font_size ),
				'label' => __( 'Tamaño de texto', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 30
			)
		);
		$font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_FONT_SIZE_PREFIX . $button ) );

		$font_family = EliteTrainerSiteThemeCustomizer::get_button_font_family( $button, $this->default_text_font_family );
		$font_family_select = $this->add_font_select(
			'fontfamily',
			array(
				'label' => 'Fuente'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$font_family_select->add_option(
				$key,
				sprintf( "%s (%s)", 'abcdefABCDEF', $label ),
				array( 'selected' => $key == $font_family )
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
			'elite-trainer-theme-update-custom-button',
			get_template_directory_uri() . '/js/readevents/custom-button.js',
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
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_TEXT_PREFIX . $this->button );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_TEXT_COLOR_PREFIX . $this->button );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_BG_PREFIX . $this->button );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_FONT_SIZE_PREFIX . $this->button );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::CUSTOM_BUTTON_FONT_FAMILY_PREFIX . $this->button );
		}
		else
		{
	/*
			$title = $this->get_field_by_name( 'title' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_home_cover_title( $title );
	*/
			$text = $this->get_field_by_name( 'text' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_button_text( $this->button, $text );
			
			$color = $this->get_field_by_name( 'color' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_button_color( $this->button, $color );
			
			$bgcolor = $this->get_field_by_name( 'bgcolor' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_button_bg( $this->button, $bgcolor );
			
			$fontsize = $this->get_field_by_name( 'fontsize' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_button_font_size( $this->button, $fontsize );

			$fontfamily = $this->get_field_by_name( 'fontfamily' )->get_value();
			EliteTrainerSiteThemeCustomizer::set_button_font_family( $this->button, $fontfamily );

		}

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateStyle',
				'args' => array()
			) )
		) );
		$response->add( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateCustomButton',
				'args' => array(
					'customButtonSelector' => $this->button_selector,
					'customButtonText' => EliteTrainerSiteThemeCustomizer::get_button_text( $this->button, $this->default_text )
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
								'fieldName' => 'text',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_button_text( $this->button, $this->default_text )
							),
							array(
								'fieldName' => 'color',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_button_color( $this->button, $this->default_text_color )
							),
							array(
								'fieldType' => 'background_field',
								'fieldName' => 'bgcolor',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_button_bg( $this->button, $this->default_text_color )
							),
							array(
								'fieldName' => 'fontsize',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_button_font_size( $this->button, $this->default_text_font_size )
							),
							array(
								'fieldName' => 'fontfamily',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_button_font_family( $this->button, $this->default_text_font_family )
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


