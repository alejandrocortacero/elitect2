<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

/**
 * This field, after read an array (id,x,y,w,h), stores only id in value.
 * See read_request to view this.
 */

// TODO: add admin template
if( !class_exists( 'JLCCustomFormUploadAjaxImageCropperField' ) )
{

if( !class_exists( 'JLCCustomFormUploadAjaxImageField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'upload-ajax-image.php' );

class JLCCustomFormUploadAjaxImageCropperField extends JLCCustomFormUploadAjaxImageField
{

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

		$this->type = "upload-ajax-image-cropper";
	}

	public function get_selector_image_url()
	{
		//$image_id = $this->get_value();
		$image_id = $this->get_image_id();

		//$url = wp_get_attachment_image_url( $image_id, apply_filters( 'jlc_custom_form_upload_ajax_image_preview_size', 'full', $this ) );
		$url = wp_get_attachment_image_url( $image_id, 'full' );

		if( $url )
			$url = add_query_arg( array( 'jlccustomformrndts' => time() ), $url );
		
		$url = $url ? $url : apply_filters( 'jlc_custom_form_blank_image_url', plugins_url( '/templates/img/blank-image.png', __FILE__ ), $this );

		return apply_filters( 'jlc_custom_form_upload_ajax_image_field_url', $url, $this, $image_id );
	}

	public function check_image_exists()
	{
		$image_id = !empty( $_POST[self::AJAX_CHECK_IMAGE_EXISTS_FIELD_NAME] ) ? (int)$_POST[self::AJAX_CHECK_IMAGE_EXISTS_FIELD_NAME] : null;

		$data = $image_id && ( $url = wp_get_attachment_image_url( $image_id, 'full' ) ) ? add_query_arg( array( 'jlccustomformrndts' => time() ), $url ) : null;

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'getAjaxImageUploadFieldUrl',
			'id' => 0,
			'data' => json_encode( array( 'exists' => !empty( $data ), 'url' => $data ) )
		) );
		$response->send();
	}

	public function print_public()
	{
		parent::print_public();

		if( !wp_script_is( 'jlc-custom-form-upload-ajax-cropper-js', 'enqueued' ) )
		{
			//wp_enqueue_media();
			wp_enqueue_script( 'jcrop' );
			wp_enqueue_style( 'jcrop' );

			wp_enqueue_script(
				'jlc-custom-form-upload-ajax-cropper-js',
				plugins_url( '/templates/js/upload-ajax-cropper.js', __FILE__ ),
				array( 'jquery', 'jcrop', 'jlc-custom-form-global-ajax-js' ),
				JLCCustomForm::VERSION,
				true
			);
			wp_localize_script(
				'jlc-custom-form-upload-ajax-cropper-js',
				'JLCCustomFormUploadAjaxCropperNS',
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
				include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'css', 'upload-ajax-image-cropper.php' ) ) );
			});
		}


	}

	public function get_image_id()
	{
		$val = $this->get_value();

		return isset( $val['id'] ) ? $val['id'] : $val;
	}
	public function get_image_x()
	{
		$val = $this->get_value();

		return isset( $val['x'] ) ? $val['x'] : '';
	}
	public function get_image_y()
	{
		$val = $this->get_value();

		return isset( $val['y'] ) ? $val['y'] : '';
	}
	public function get_image_w()
	{
		$val = $this->get_value();

		return isset( $val['w'] ) ? $val['w'] : '';
	}
	public function get_image_h()
	{
		$val = $this->get_value();

		return isset( $val['h'] ) ? $val['h'] : '';
	}

	public function read_values_from_request( $method )
	{
		$val = parent::read_values_from_request( $method );

		return $val;
/*
		if( is_array( $val ) )
			return $val['id'];//return json_encode( $val );
		else
			return $val;
*/
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		// ??!!?? lee una cadena JSON
		$this->set_value( $val );

		$image_id = $this->get_image_id();
		if( !$image_id )
			return null;

		$x = $this->get_image_x();
		$y = $this->get_image_y();
		$w = $this->get_image_w();
		$h = $this->get_image_h();

		$this->set_value( $image_id );

		if( $x !== '' && $y !== '' && $w !== '' && $h !== '' )
		{
			$path = get_attached_file( $image_id );

/*
			$x = (int)$x;
			$y = (int)$y;
			$w = (int)$w;
			$h = (int)$h;
*/
			$x = (float)$x;
			$y = (float)$y;
			$w = (float)$w;
			$h = (float)$h;
			if(empty( $w ) || empty( $h ) )
				return null;

			$img_src = wp_get_attachment_image_src( $image_id, 'full' );
			$img_w = $img_src[1];
			$img_h = $img_src[2];
			$x = $x * $img_w;
			$w = $w * $img_w;
			$y = $y * $img_h;
			$h = $h * $img_h;

			$ret = wp_crop_image(
				$image_id, 
				$x,
				$y,
				$w,
				$h,
				$w,
				$h,
				false,
				$path
			);

			$copied = copy( $ret, $path );


			wp_create_image_subsizes( $path, $image_id );
		}
		
		return null;
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

