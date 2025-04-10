<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCHeaderNavbarForm' ) )
{

class JLCHeaderNavbarForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_header_navbar',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$this->add_heading( array( 'content' => __( 'Logo', $this->get_text_domain() ) ) );

/*
		$this->add_html( array( 'content' => '<div class="header-logo"><img src="' . EliteTrainerSiteThemeCustomizer::get_header_logo_url() . '" alt="Logo" class="img-responsive" /></div>' ) );

		$this->add_upload_field(
			'header_logo',
			array(
				'value' => '',
				'label' => __( 'Change logo', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
*/
		$logo_pos = EliteTrainerSiteThemeCustomizer::get_header_logo_position();
		$logo_pos_field = $this->add_select(
			'logo_pos',
			array(
				'label' => 'Posición del logo',
				'required' => true
			)
		);
		$logo_pos_field->add_option(
			'left',
			'Logo a la izquierda',
			array(
				'selected' => $logo_pos == 'left'
			)
		);
		$logo_pos_field->add_option(
			'center',
			'Logo centrado',
			array(
				'selected' => $logo_pos == 'center'
			)
		);
		$logo_pos_field->add_option(
			'right',
			'Logo a la derecha',
			array(
				'selected' => $logo_pos == 'right'
			)
		);

		$logo_size = EliteTrainerSiteThemeCustomizer::get_header_logo_size();
		$logo_size_field = $this->add_select(
			'logo_size',
			array(
				'label' => 'Tamaño del logo',
				'required' => true
			)
		);
		$logo_size_field->add_option(
			'small',
			'Pequeño',
			array(
				'selected' => $logo_size == 'small'
			)
		);
		$logo_size_field->add_option(
			'normal',
			'Normal',
			array(
				'selected' => $logo_size == 'normal'
			)
		);
		$logo_size_field->add_option(
			'big',
			'Grande',
			array(
				'selected' => $logo_size == 'big'
			)
		);
		

		//$this->add_ajax_upload_image_field(
		$this->add_ajax_upload_image_cropper_field(
			'header_logo',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_logo(),
				'label' => __( 'Change logo', $this->get_text_domain() ),
				'required' => false,
				'help' => __( 'Suba un logo con fondo transparente para unficarlo con la cabecera. .jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);

/*
		$this->add_color_field(
			'bgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_bg_color(),
				'label' => __( 'Color de fondo', $this->get_text_domain() ),
				'required' => true
			)
		);
*/
		$bg_color_field = $this->add_background_field(
			'bgcolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_bg(),
				'label' => __( 'Fondo', $this->get_text_domain() ),
				'opacity_field_type' => 'slider',
				'required' => true
			)
		);

		$this->add_heading( array( 'content' => __( 'Text', $this->get_text_domain() ) ) );

		$header_title = EliteTrainerSiteThemeCustomizer::get_header_title();
		$title_field = $this->add_text_field(
			'title',
			array(
				'value' => $header_title,
				'label' => __( 'Título', $this->get_text_domain() ),
				'required' => true
			)
		);
		$title_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HEADER_TITLE_KEY ) );

		$title_font = EliteTrainerSiteThemeCustomizer::get_header_title_font();
		$title_font_select = $this->add_font_select(
			'titlefont',
			array(
				'label' => 'Fuente del título'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$title_font_select->add_option(
				$key,
				sprintf( "%s (%s)", $header_title, $label ),
				array( 'selected' => $key == $title_font )
			);

		$font_size_field = $this->add_number_field(
			'titlefontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_title_font_size(),
				'label' => __( 'Tamaño del título', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 99
			)
		);
		$font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HEADER_TITLE_FONT_SIZE_KEY ) );
		$this->add_color_field(
			'titlecolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_title_color(),
				'label' => __( 'Color del título', $this->get_text_domain() ),
				'required' => true
			)
		);

		$subtitle_field = $this->add_text_field(
			'subtitle',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_subtitle(),
				'label' => __( 'Subtítulo', $this->get_text_domain() ),
				'required' => true
			)
		);
		$subtitle_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_KEY ) );

		$subtitle_font = EliteTrainerSiteThemeCustomizer::get_header_subtitle_font();
		$subtitle_font_select = $this->add_font_select(
			'subtitlefont',
			array(
				'label' => 'Fuente del subtítulo'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$subtitle_font_select->add_option(
				$key,
				sprintf( "%s (%s)", $header_title, $label ),
				array( 'selected' => $key == $subtitle_font )
			);

		$font_size_field = $this->add_number_field(
			'subtitlefontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_subtitle_font_size(),
				'label' => __( 'Tamaño del subtítulo', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 99
			)
		);
		$font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_FONT_SIZE_KEY ) );
		$this->add_color_field(
			'subtitlecolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_header_subtitle_color(),
				'label' => __( 'Color del subtítulo', $this->get_text_domain() ),
				'required' => true
			)
		);
/*
		$this->add_heading( array( 'content' => __( 'Contact', $this->get_text_domain() ) ) );

		$this->add_text_field(
			'phone',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_contact_phone(),
				'label' => __( 'Teléfono', $this->get_text_domain() ),
				'required' => true
			)
		);
*/
		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);

		$this->add_submit_button(
			'history',
			array(
				'class' => 'btn btn-primary open-history',
				'label' => __( 'Historial', $this->get_text_domain() )
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

	public static function get_form_options()
	{
		return array(
			'bgcolor' => EliteTrainerSiteThemeCustomizer::HEADER_BG_COLOR_KEY,
			'header_logo' => EliteTrainerSiteThemeCustomizer::HEADER_LOGO_KEY,
			'logo_pos' => EliteTrainerSiteThemeCustomizer::HEADER_LOGO_POS_KEY,
			'logo_size' => EliteTrainerSiteThemeCustomizer::HEADER_LOGO_SIZE_KEY,
			'title' => EliteTrainerSiteThemeCustomizer::HEADER_TITLE_KEY,
			'titlecolor' => EliteTrainerSiteThemeCustomizer::HEADER_TITLE_COLOR_KEY,
			'titlefont' => EliteTrainerSiteThemeCustomizer::HEADER_TITLE_FONT_KEY,
			'titlefontsize' => EliteTrainerSiteThemeCustomizer::HEADER_TITLE_FONT_SIZE_KEY,
			'subtitle' => EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_KEY,
			'subtitlecolor' => EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_COLOR_KEY,
			'subtitlefont' => EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_FONT_KEY,
			'subtitlefontsize' => EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_FONT_SIZE_KEY
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
			'elite-trainer-theme-update-header-navbar',
			get_template_directory_uri() . '/js/readevents/header-navbar.js',
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
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_BG_COLOR_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_LOGO_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_LOGO_POS_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_LOGO_SIZE_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_TITLE_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_TITLE_COLOR_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_TITLE_FONT_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_TITLE_FONT_SIZE_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_COLOR_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_FONT_KEY );
			delete_blog_option( null, EliteTrainerSiteThemeCustomizer::HEADER_SUBTITLE_FONT_SIZE_KEY );
		}
		else
		{


		$header_logo_field = $this->get_field_by_name( 'header_logo' );
		$header_logo_pos_field = $this->get_field_by_name( 'logo_pos' );
		$header_logo_size_field = $this->get_field_by_name( 'logo_size' );
/*
		if( $header_logo_field->is_file_for_upload() && $header_logo_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'header_logo', 0 );
			if( !is_int( $logo_id ) )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Header logo file could not be uploaded', $this->get_text_domain() )
				) );

			EliteTrainerSiteThemeCustomizer::set_header_logo( $logo_id );
		}
*/
		EliteTrainerSiteThemeCustomizer::set_header_logo( $header_logo_field->get_value() );
		EliteTrainerSiteThemeCustomizer::set_header_logo_position( $header_logo_pos_field->get_value() );
		EliteTrainerSiteThemeCustomizer::set_header_logo_size( $header_logo_size_field->get_value() );

		$title = $this->get_field_by_name( 'title' )->get_value();
		$subtitle = $this->get_field_by_name( 'subtitle' )->get_value();
//		$phone = $this->get_field_by_name( 'phone' )->get_value();

		EliteTrainerSiteThemeCustomizer::set_header_title( $title );
		EliteTrainerSiteThemeCustomizer::set_header_subtitle( $subtitle );

//		EliteTrainerSiteThemeCustomizer::set_contact_phone( $phone );

		$titlecolor = $this->get_field_by_name( 'titlecolor' )->get_value();
		$titlefont = $this->get_field_by_name( 'titlefont' )->get_value();
		$titlesize = $this->get_field_by_name( 'titlefontsize' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_header_title_color( $titlecolor );
		EliteTrainerSiteThemeCustomizer::set_header_title_font( $titlefont );
		EliteTrainerSiteThemeCustomizer::set_header_title_font_size( $titlesize );

		$subtitlecolor = $this->get_field_by_name( 'subtitlecolor' )->get_value();
		$subtitlefont = $this->get_field_by_name( 'subtitlefont' )->get_value();
		$subtitlesize = $this->get_field_by_name( 'subtitlefontsize' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_header_subtitle_color( $subtitlecolor );
		EliteTrainerSiteThemeCustomizer::set_header_subtitle_font( $subtitlefont );
		EliteTrainerSiteThemeCustomizer::set_header_subtitle_font_size( $subtitlesize );


		$bg_color = $this->get_field_by_name( 'bgcolor' )->get_value();
		//EliteTrainerSiteThemeCustomizer::set_header_bg_color( $bg_color );
		EliteTrainerSiteThemeCustomizer::set_header_bg( $bg_color );

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
				'name' => 'eliteTrainerThemeUpdateHeaderNavbar',
				'args' => array(
					'headerLogoUrl' => EliteTrainerSiteThemeCustomizer::get_header_logo_url(),
					'siteTitle' => EliteTrainerSiteThemeCustomizer::get_header_title(),
					'siteSubtitle' => EliteTrainerSiteThemeCustomizer::get_header_subtitle()
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
								'fieldName' => 'logo_pos',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_logo_position()
							),
							array(
								'fieldName' => 'logo_size',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_logo_size()
							),
							array(
								'fieldName' => 'header_logo',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_logo()
							),
							array(
								'fieldType' => 'background_field',
								'fieldName' => 'bgcolor',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_bg()
							),
							array(
								'fieldName' => 'title',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_title()
							),
							array(
								'fieldName' => 'titlefont',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_title_font()
							),
							array(
								'fieldName' => 'titlefontsize',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_title_font_size()
							),
							array(
								'fieldName' => 'titlecolor',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_title_color()
							),
							array(
								'fieldName' => 'subtitle',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_subtitle()
							),
							array(
								'fieldName' => 'subtitlefont',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_subtitle_font()
							),
							array(
								'fieldName' => 'subtitlefontsize',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_subtitle_font_size()
							),
							array(
								'fieldName' => 'subtitlecolor',
								'fieldValue' => EliteTrainerSiteThemeCustomizer::get_header_subtitle_color()
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


