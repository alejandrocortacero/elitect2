<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEditRealCaseForm' ) )
{

class JLCEditRealCaseForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_edit_real_case',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->class = 'edit-real-case-form';

		$this->add_honeypot();

		$this->add_hidden_field(
			'case',
			array(
				'value' => ''
			)
		);

		$this->add_text_field(
			'title',
			array(
				'value' => '',
				'label' => __( 'Nombre', $this->get_text_domain() ),
				'required' => true
			)
		);

/*
		$this->add_wp_editor_field(
			'casedesc',
			array(
				'value' => '',
				'label' => __( 'Comentario', $this->get_text_domain() ),
				'editor_args' => array( 'quicktags' => true, 'default_editor' => 'visual', 'media_buttons' => false ),
				'required' => true
			)
		);
*/
		$this->add_tinymce_field(
			'casedesc',
			array(
				'value' => '',
				'label' => __( 'Comentario', $this->get_text_domain() ),
				'required' => true
			)
		);
/*
		$this->add_upload_field(
			'photo',
			array(
				'value' => '',
				'label' => __( 'Antes', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
*/
		$this->add_ajax_upload_image_cropper_field(
			'photo',
			array(
				'value' => '',
				'label' => __( 'Antes', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 20MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152 * 10
			)
		);
/*
		$this->add_upload_field(
			'after',
			array(
				'value' => '',
				'label' => __( 'Después', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
*/
		$this->add_ajax_upload_image_cropper_field(
			'after',
			array(
				'value' => '',
				'label' => __( 'Después', $this->get_text_domain() ),
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 20MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152 * 10
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
	}

	protected function process_form()
	{
		$case = $this->get_field_by_name( 'case' )->get_value();

		$title = $this->get_field_by_name( 'title' )->get_value();
		$desc = $this->get_field_by_name( 'casedesc' )->get_value();

		$arr = array(
			'post_title' => $title,
			'post_content' => $desc,
			'post_type' => 'epoint_realcase',
			'post_status' => 'publish'
		);
		if( is_numeric( $case ) )
			$arr['ID'] = $case;

		//$c = wp_update_post( $arr, true );
		$c = wp_insert_post( $arr, true );
		if( is_wp_error( $c ) )
		{
			return array( array(
				'code' => self::FATAL_ERROR,
				'text' => __( $c->get_error_message(), $this->get_text_domain() )
			) );
		}
		

		$photo_field = $this->get_field_by_name( 'photo' );
/*
		if( $photo_field->is_file_for_upload() && $photo_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'photo', $c );
			if( !is_int( $logo_id ) )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Photo could not be uploaded', $this->get_text_domain() )
				) );

			//set_post_thumbnail( $c, $logo_id );
			EpointRealCases::set_before_photo( $c, $logo_id );
		}
*/
		EpointRealCases::set_before_photo( $c, $photo_field->get_value() );

		$after_field = $this->get_field_by_name( 'after' );
/*
		if( $after_field->is_file_for_upload() && $after_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'after', $c );
			if( !is_int( $logo_id ) )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Photo could not be uploaded', $this->get_text_domain() )
				) );

			EpointRealCases::set_after_photo( $c, $logo_id );
		}
*/
		EpointRealCases::set_after_photo( $c, $after_field->get_value() );

		return __( 'Caso guardado satisfactoriamente', $this->get_text_domain() );
	}
}

} // class_exists

