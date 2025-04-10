<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
//TODO: add image methods like other image fields
//TODO: add selection window for admin
if( !class_exists( 'JLCCustomFormUploadAjaxImageField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormUploadAjaxImageField extends AbstractJLCCustomFormField
{
	const AJAX_CHECK_IMAGE_EXISTS_ACTION = 'jlc_custom_form_%s_process_ajax_%s_check_image_exists';
	const AJAX_CHECK_IMAGE_EXISTS_FIELD_NAME = 'jlc_custom_form_ajax_check_image_exists_field';

	const AJAX_UPLOAD_IMAGE_ACTION = 'jlc_custom_form_%s_process_ajax_%s_upload_image';
	const AJAX_UPLOAD_IMAGE_FIELD_NAME = 'jlc_custom_form_process_ajax_upload_image_field_name';

	const AJAX_IMAGE_SELECTION_WINDOW_GET_IMAGES = 'jlc_custom_form_%s_selection_window_%s_get_images';

	protected $max_size;
	protected $allowed_extensions;
	protected $allowed_mime_types;

	protected $help;

	protected $selection_window;

/*
	public static function procces_ajax_upload_image()
	{
		if( isset( $_FILES[self::AJAX_UPLOAD_IMAGE_FIELD_NAME] ) )
		{
			//TODO: check file extension and size

			$image_id = media_handle_upload( self::AJAX_UPLOAD_IMAGE_FIELD_NAME, 0 );

			if( $image_id )
			{
				$image_data = json_encode( array( 'id' => $image_id, 'url' => wp_get_attachment_thumb_url( $image_id ) ) );

				$response = new WP_Ajax_Response( array(
					'what' => 'json',
					'action' => 'updateAjaxImageUploadField',
					'id' => 1,
					'data' => $image_data
				) );
				$response->send();
			}
		}

		$response = new WP_Ajax_Response( array(
			'what' => 'html',
			'action' => 'prepend',
			'id' => 0,
			'data' => 'Error'
		) );
		$response->send();
	}
*/

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$help = null,
		$max_size = null,
		$allowed_extensions = null,
		$allowed_mime_types = null,
		$id = null,
		$class = null,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			$value,
			$label,
			"upload-ajax-image",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->max_size = $max_size;
		$this->allowed_extensions = $allowed_extensions;
		$this->allowed_mime_types = $allowed_mime_types;

		$this->help = $help;

		$this->selection_window = null;
	}

	public function get_selection_window()
	{
		return $this->selection_window;
	}

	public function has_selection_window()
	{
		// callback must return an array of ides

		$w = $this->get_selection_window();
		return
			!empty( $w ) &&
			!empty( $w['callback'] );
	}

	public function set_selection_window( $args )
	{
		$this->selection_window = $args;
	}


	public function get_max_size()
	{
		return $this->max_size;
	}

	public function get_allowed_extensions()
	{
		return $this->allowed_extensions;
	}

	public function get_allowed_mime_types()
	{
		return $this->allowed_mime_types;
	}

	public function get_help()
	{
		return $this->help;
	}

	public function print_public()
	{
		parent::print_public();

		if( !wp_script_is( 'jlc-custom-form-upload-ajax-js', 'enqueued' ) )
		{
			//wp_enqueue_media();

			wp_enqueue_script(
				'jlc-custom-form-upload-ajax-js',
				plugins_url( '/templates/js/upload-ajax.js', __FILE__ ),
				array( 'jquery', 'jlc-custom-form-global-ajax-js' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_localize_script(
				'jlc-custom-form-upload-ajax-js',
				'JLCCustomFormUploadAjaxNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'action' => self::AJAX_UPLOAD_IMAGE_ACTION,
					'fieldName' => self::AJAX_UPLOAD_IMAGE_FIELD_NAME,
					'windowAction' => self::AJAX_IMAGE_SELECTION_WINDOW_GET_IMAGES,
					'checkImageExistsAction' => self::AJAX_CHECK_IMAGE_EXISTS_ACTION,
					'checkImageExistsFieldName' => self::AJAX_CHECK_IMAGE_EXISTS_FIELD_NAME,
					'blankImageUrl' => apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this ),
					'selectImage' => __( 'Select image', JLCCustomForm::TEXT_DOMAIN ),
					'useImage' => __( 'Use selected image', JLCCustomForm::TEXT_DOMAIN )
				)
			);

			add_action( 'wp_footer', function(){
				include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'upload-ajax-image.php' ) ) );
			});
		}

		if( $this->has_selection_window() )
		{
			if( !wp_script_is( 'jlc-custom-form-upload-ajax-selection-window-js', 'enqueued' ) )
			{
				wp_enqueue_script(
					'jlc-custom-form-upload-ajax-selection-window-js',
					plugins_url( '/templates/js/upload-ajax-selection-window.js', __FILE__ ),
					array( 'jlc-custom-form-upload-ajax-js' ),
					JLCCustomForm::VERSION,
					true
				);

				add_action( 'wp_footer', function(){
					include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'image-selection-window.php' ) ) );
					include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'image-selection-window-style.php' ) ) );
				});
			}

		}

	}

	// TODO: revisa si hay que hacer esto tambien para public
	public function print_admin( $wrapped = true )
	{
		parent::print_admin( $wrapped );

		if( !wp_script_is( 'jlc-custom-form-admin-upload-ajax-js', 'enqueued' ) )
		{
			wp_enqueue_media();

			wp_enqueue_script(
				'jlc-custom-form-admin-upload-ajax-js',
				plugins_url( '/templates/js/admin-upload-ajax.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_localize_script(
				'jlc-custom-form-admin-upload-ajax-js',
				'JLCCustomFormUploadAjaxNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'blankImageUrl' => apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this ),
					'selectImage' => __( 'Select image', JLCCustomForm::TEXT_DOMAIN ),
					'useImage' => __( 'Use selected image', JLCCustomForm::TEXT_DOMAIN )
				)
			);

			add_action( 'admin_footer', function(){
				include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'admin-upload-ajax-image.php' ) ) );
			});
		}
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$this->set_value( $val );
		
		return null;
	}

	public function get_selector_image_url()
	{
		$image_id = $this->get_value();

		//$url = wp_get_attachment_thumb_url( $image_id );
		$url = wp_get_attachment_image_url( $image_id, apply_filters( 'jlc_custom_form_upload_ajax_image_preview_size', 'thumbnail', $this ) );
		
		$url = $url ? $url : apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this );

		return apply_filters( 'jlc_custom_form_upload_ajax_image_field_url', $url, $this, $image_id );
	}

	protected function check_uploaded_file( $key )
	{
		if( !isset( $_FILES[$key] ) && $_FILES[$key]['error'] != UPLOAD_ERR_OK )
			return false;

		$max_size = $this->get_max_size();
		$file_size = isset( $_FILES[$key]['size'] ) ? $_FILES[$key]['size'] : 0;
		if( $max_size !== null && $file_size > $max_size )
			return false;

		$allowed_extensions = $this->get_allowed_extensions();
		$file_extension = isset( $_FILES[$key]['name'] ) ? mb_strtolower( pathinfo( $_FILES[$key]['name'], PATHINFO_EXTENSION ) ) : null;
		if( !empty( $allowed_extensions ) )
		{
			if( ( is_array( $allowed_extensions ) && !in_array( $file_extension, $allowed_extensions ) ) ||
				( is_string( $allowed_extensions ) && $allowed_extensions != $file_extension ) )
				return false;
		}

		$allowed_mime_types = $this->get_allowed_mime_types();
		$mime_type = isset( $_FILES[$key]['tmp_name'] ) ? mime_content_type( $_FILES[$key]['tmp_name'] ) : null;
		if( !empty( $allowed_mime_types ) )
		{
			if( ( is_array( $allowed_mime_types ) && !in_array( $mime_type, $allowed_mime_types ) ) ||
				( is_string( $allowed_mime_types ) && $allowed_mime_types != $mime_type ) )
				return false;
		}

		return true;
	}

	public function check_image_exists()
	{
		$image_id = !empty( $_POST[self::AJAX_CHECK_IMAGE_EXISTS_FIELD_NAME] ) ? (int)$_POST[self::AJAX_CHECK_IMAGE_EXISTS_FIELD_NAME] : null;

		$data = $image_id && ( $url = wp_get_attachment_image_url( $image_id, 'thumbnail' ) ) ? $url : null;

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'getAjaxImageUploadFieldUrl',
			'id' => 0,
			'data' => json_encode( array( 'exists' => !empty( $data ), 'url' => $data ) )
		) );
		$response->send();
	}

	public function procces_ajax_upload_image()
	{
		if( isset( $_FILES[self::AJAX_UPLOAD_IMAGE_FIELD_NAME] ) )
		{
			if( !$this->check_uploaded_file( self::AJAX_UPLOAD_IMAGE_FIELD_NAME ) )
			{
				$response = new WP_Ajax_Response( array(
					'what' => 'html',
					'action' => 'prepend',
					'id' => 0,
					'data' => '<p class="alert alert-danger">' . esc_html( __( 'Invalid file', JLCCustomForm::TEXT_DOMAIN ) ) . '</p>'
				) );
				$response->send();
			}
			

			do_action( 'jlc_custom_form_upload_ajax_image_pre_upload', $this );
			$image_id = media_handle_upload( self::AJAX_UPLOAD_IMAGE_FIELD_NAME, 0 );
			do_action( 'jlc_custom_form_upload_ajax_image_post_upload', $this );

			if( $image_id )
			{
				do_action( 'jlc_custom_form_upload_ajax_image_process_uploaded', $this, $image_id );

				//$image_data = json_encode( array( 'id' => $image_id, 'url' => wp_get_attachment_thumb_url( $image_id ) ) );
				$image_src = wp_get_attachment_image_src( $image_id, apply_filters( 'jlc_custom_form_upload_ajax_image_preview_size', 'thumbnail', $this ) );
				$image_data = json_encode( array( 'id' => $image_id, 'url' => $image_src[0], 'width' => isset( $image_src[1] ) ? $image_src[1] : 0, 'height' => isset( $image_src[2] ) ? $image_src[2] : 0 ) );

				$response = apply_filters(
					'jlc_custom_form_update_ajax_image_upload_response',
					new WP_Ajax_Response( array(
						'what' => 'json',
						'action' => 'updateAjaxImageUploadField',
						'id' => 1,
						'data' => $image_data
					) ),
					$this,
					$image_id
				);
				$response->send();
			}
		}

		$response = new WP_Ajax_Response( array(
			'what' => 'html',
			'action' => 'prepend',
			'id' => 0,
			'data' => 'Error'
		) );
		$response->send();
	}
}

/*
add_action( 'wp_ajax_' . JLCCustomFormUploadAjaxImageField::AJAX_UPLOAD_IMAGE_ACTION, array( 'JLCCustomFormUploadAjaxImageField', 'procces_ajax_upload_image' ) );
add_action( 'wp_ajax_nopriv_' . JLCCustomFormUploadAjaxImageField::AJAX_UPLOAD_IMAGE_ACTION, array( 'JLCCustomFormUploadAjaxImageField', 'procces_ajax_upload_image' ) );
*/

} //class_exists


