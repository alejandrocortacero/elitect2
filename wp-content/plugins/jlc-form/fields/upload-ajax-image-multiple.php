<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormUploadAjaxImageMultipleField' ) )
{

if( !class_exists( 'JLCCustomFormUploadAjaxImageField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'upload-ajax-image.php' );

class JLCCustomFormUploadAjaxImageMultipleField extends JLCCustomFormUploadAjaxImageField
{
	protected $total_max_size;
	protected $max_images_number;
	protected $min_images_number;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$help = null,
		$max_size = null,
		$allowed_extensions = null,
		$allowed_mime_types = null,
		$total_max_size = null,
		$max_images_number = null,
		$min_images_number = null,
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
			$help,
			$max_size,
			$allowed_extensions,
			$allowed_mime_types,
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->type = "upload-ajax-image-multiple";

		$this->total_max_size = $total_max_size;
		$this->max_images_number = $max_images_number;
		$this->min_images_number = $min_images_number;
	}

	public function get_total_max_size()
	{
		return $this->total_max_size;
	}

	public function get_max_images_number()
	{
		return $this->max_images_number;
	}

	public function get_min_images_number()
	{
		return $this->min_images_number;
	}


	public function print_public()
	{
		AbstractJLCCustomFormField::print_public();

		if( !wp_script_is( 'jlc-custom-form-upload-ajax-multiple-js', 'enqueued' ) )
		{
			//wp_enqueue_media();

			wp_enqueue_script(
				'jlc-custom-form-upload-ajax-multiple-js',
				plugins_url( '/templates/js/upload-ajax-multiple.js', __FILE__ ),
				array( 'jquery', 'jlc-custom-form-global-ajax-js' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_localize_script(
				'jlc-custom-form-upload-ajax-multiple-js',
				'JLCCustomFormUploadAjaxMultipleNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'action' => self::AJAX_UPLOAD_IMAGE_ACTION,
					'fieldName' => self::AJAX_UPLOAD_IMAGE_FIELD_NAME,
					'windowAction' => self::AJAX_IMAGE_SELECTION_WINDOW_GET_IMAGES,
					'blankImageUrl' => apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this ),
					'selectImage' => __( 'Select image', JLCCustomForm::TEXT_DOMAIN ),
					'useImage' => __( 'Use selected image', JLCCustomForm::TEXT_DOMAIN )
				)
			);

			add_action( 'wp_footer', function(){
				include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'upload-ajax-image-multiple.php' ) ) );
			});
		}

		if( $this->has_selection_window() )
		{
			if( !wp_script_is( 'jlc-custom-form-upload-ajax-multiple-selection-window-js', 'enqueued' ) )
			{
				wp_enqueue_script(
					'jlc-custom-form-upload-ajax-multiple-selection-window-js',
					plugins_url( '/templates/js/upload-ajax-multiple-selection-window.js', __FILE__ ),
					array( 'jlc-custom-form-upload-ajax-multiple-js' ),
					JLCCustomForm::VERSION,
					true
				);

				add_action( 'wp_footer', function(){
					include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'image-multiple-selection-window.php' ) ) );
					include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'image-multiple-selection-window-style.php' ) ) );
				});
			}

		}

	}

	// TODO: Este método no tiene ningún cambio respecto al padre
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

		// lee una cadena JSON
		$this->set_value( $val );
		
		return null;
	}

	public function get_selected_images( $as_object = true )
	{
		$val = $this->get_value();
		$val = json_decode( $val );

		if( !is_array( $val ) )
			return array( get_post( (int)$val ) );

		$val = array_map( function( $a ){ return (int)$a; } );

		return !$as_object ?
			$val :
			get_posts( array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'include' => $val
			) );	
	}

// hacer para varias imagenes
	public function get_selector_image_url()
	{
		$image_id = $this->get_value();
		//$url = wp_get_attachment_thumb_url( $image_id );
		$url = wp_get_attachment_url( $image_id );
		
		return $url ? $url : apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this );
	}


// hacer para varias imagenes
	public function procces_ajax_upload_image()
	{
		if( isset( $_FILES[self::AJAX_UPLOAD_IMAGE_FIELD_NAME] ) )
		{
			//TODO: check file extension and size

			do_action( 'jlc_custom_form_upload_ajax_image_pre_upload', $this );
			$image_id = media_handle_upload( self::AJAX_UPLOAD_IMAGE_FIELD_NAME, 0 );
			do_action( 'jlc_custom_form_upload_ajax_image_post_upload', $this );

			if( $image_id )
			{
				do_action( 'jlc_custom_form_upload_ajax_image_process_uploaded', $this, $image_id );

				//$image_data = json_encode( array( 'id' => $image_id, 'url' => wp_get_attachment_thumb_url( $image_id ) ) );
				$image_src = wp_get_attachment_image_src( $image_id, 'full' );
				$image_data = json_encode( array( 'id' => $image_id, 'url' => wp_get_attachment_url( $image_id ), 'width' => isset( $image_src[1] ) ? $image_src[1] : 0, 'height' => isset( $image_src[2] ) ? $image_src[2] : 0 ) );

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
}


} //class_exists
