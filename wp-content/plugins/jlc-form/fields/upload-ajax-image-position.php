<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

//TODO: Solo esta hecho para public, hacer tambien para admin

if( !class_exists( 'JLCCustomFormUploadAjaxImagePositionField' ) )
{

if( !class_exists( 'JLCCustomFormUploadAjaxImageField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'upload-ajax-image.php' );

class JLCCustomFormUploadAjaxImagePositionField extends JLCCustomFormUploadAjaxImageField
{
	protected $for_portrait;

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
		AbstractJLCCustomFormField::__construct(
			$name,
			$value,
			$label,
			"upload-ajax-image-position",
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

		$this->for_portrait = false;
	}

	public function is_for_portrait()
	{
		return $this->for_portrait;
	}

	public function set_for_portrait( $for_portrait )
	{
		$this->for_portrait = $for_portrait;
	}

	public function print_public()
	{
		parent::print_public();

		if( !wp_script_is( 'jlc-custom-form-upload-ajax-position-js', 'enqueued' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-upload-ajax-position-js',
				plugins_url( '/templates/js/upload-ajax-position.js', __FILE__ ),
				array( 'jquery', 'jlc-custom-form-global-ajax-js', 'jlc-custom-form-upload-ajax-js' ),
				JLCCustomForm::VERSION,
				true
			);

			add_action( 'wp_footer', function(){
				include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'upload-ajax-image-position.php' ) ) );
			});
		}
/*
		parent::print_public();

		if( !wp_script_is( 'jlc-custom-form-upload-ajax-position-js', 'enqueued' ) )
		{
			//wp_enqueue_media();

			wp_enqueue_script(
				'jlc-custom-form-upload-ajax-position-js',
				plugins_url( '/templates/js/upload-ajax-position.js', __FILE__ ),
				array( 'jquery', 'jlc-custom-form-global-ajax-js' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_localize_script(
				'jlc-custom-form-upload-ajax-position-js',
				'JLCCustomFormUploadAjaxNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'action' => self::AJAX_UPLOAD_IMAGE_ACTION,
					'fieldName' => self::AJAX_UPLOAD_IMAGE_FIELD_NAME,
					'blankImageUrl' => apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this ),
					'selectImage' => __( 'Select image', JLCCustomForm::TEXT_DOMAIN ),
					'useImage' => __( 'Use selected image', JLCCustomForm::TEXT_DOMAIN )
				)
			);

			add_action( 'wp_footer', function(){
				include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'upload-ajax-image-position.php' ) ) );
			});
		}
*/
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

	public function read_values_from_request( $method )
	{
		$val = parent::read_values_from_request( $method );

		if( is_array( $val ) )
			return json_encode( $val );
		else
			return $val;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$this->set_value( $val );
		
		return null;
	}

	public function get_image_id()
	{
		$val = json_decode( $this->get_value() );
		return isset( $val->id ) ? $val->id : '';
	}

	public function get_image_x()
	{
		$val = json_decode( $this->get_value() );
		return isset( $val->x ) ? $val->x : 50;
	}

	public function get_image_y()
	{
		$val = json_decode( $this->get_value() );
		return isset( $val->y ) ? $val->y : 50;
	}

	public function get_selector_image_url()
	{
		$image_id = $this->get_image_id();
		//$url = wp_get_attachment_thumb_url( $image_id );
		$url = wp_get_attachment_url( $image_id );
		
		return $url ? $url : apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this );
	}

	public function get_selector_image_width()
	{
		$image_id = $this->get_image_id();
		$src = wp_get_attachment_image_src( $image_id, 'full' );
		
		return isset( $src[1] ) ? $src[1] : 0;
	}
	public function get_selector_image_height()
	{
		$image_id = $this->get_image_id();
		$src = wp_get_attachment_image_src( $image_id, 'full' );
		
		return isset( $src[2] ) ? $src[2] : 0;
	}
/*
	public function procces_ajax_upload_image()
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
}

/*
add_action( 'wp_ajax_' . JLCCustomFormUploadAjaxImageField::AJAX_UPLOAD_IMAGE_ACTION, array( 'JLCCustomFormUploadAjaxImageField', 'procces_ajax_upload_image' ) );
add_action( 'wp_ajax_nopriv_' . JLCCustomFormUploadAjaxImageField::AJAX_UPLOAD_IMAGE_ACTION, array( 'JLCCustomFormUploadAjaxImageField', 'procces_ajax_upload_image' ) );
*/

} //class_exists



