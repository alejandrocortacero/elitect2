<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormUploadPrivateImageField' ) )
{

if( !class_exists( 'JLCCustomFormFileField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'file.php' );

class JLCCustomFormUploadPrivateImageField extends JLCCustomFormFileField
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

		$this->type = 'upload-private-image';
	}

	public static function path_to_src( $path )
	{
		if( !is_readable( $path ) )
			return null;

		$type = pathinfo( $path, PATHINFO_EXTENSION );
		$data = file_get_contents( $path );
		$src = 'data:image/' . $type . ';base64,' . base64_encode( $data );

		return $src;
	}

	public function get_blank_image_src()
	{
		$path = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'img', 'blank-image.png' ) );
		$src = self::path_to_src( $path );

		return apply_filters( 'jlc_custom_form_blank_image_src', $src, $this );
	}

	public function get_preview_image_src()
	{
		$file_path = $this->get_value();

		$src = is_readable( $file_path ) ? self::path_to_src( $file_path ) : $this->get_blank_image_src();

		return apply_filters( 'jlc_custom_form_upload_private_image_field_src', $src, $this, $file_path );
	}

	public function read_request( $val )
	{
		$is_required = $this->is_required();
		$old_value = $this->get_value();
		$has_value = !empty( $old_value ) && is_readable( $old_value );
		$this->required = $is_required && !$has_value;

		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$this->required = $is_required;

		$this->set_value( $this->is_file_for_upload() ? $this->get_tmp_file() : $old_value );

		return null;
	}

	public function print_admin( $wrapped = true )
	{
		if( !wp_script_is( 'jlc-custom-form-upload-private-image-admin-css', 'enqueued' ) )
		{
			wp_enqueue_style(
				'jlc-custom-form-upload-private-image-admin-css',
				plugins_url( '/templates/css/upload-private-image-admin.css', __FILE__ ),
				array(),
				JLCCustomForm::VERSION
			);

			wp_enqueue_script(
				'jlc-custom-form-upload-private-image-js',
				plugins_url( '/templates/js/upload-private-image.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);

		}

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}
	public function print_public()
	{
		if( !wp_script_is( 'jlc-custom-form-table-variable-js', 'enqueued' ) )
		{
			wp_enqueue_style(
				'jlc-custom-form-upload-private-image-public-css',
				plugins_url( '/templates/css/upload-private-image-public.css', __FILE__ ),
				array(),
				JLCCustomForm::VERSION
			);

			wp_enqueue_script(
				'jlc-custom-form-upload-private-image-js',
				plugins_url( '/templates/js/upload-private-image.js', __FILE__ ),
				array( 'jquery' ),
				JLCCustomForm::VERSION,
				true
			);

		}
		include( $this->look_for_field( $this->get_type() . '.php' ) );
	}
}

} //class_exists
