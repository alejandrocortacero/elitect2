<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormFileField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormFileField extends AbstractJLCCustomFormField
{
	protected $max_size;
	protected $allowed_extensions;
	protected $allowed_mime_types;

	protected $help;

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
			"file",
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
	}

	public function is_file_input()
	{
		return true;
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

	public function read_values_from_request( $method )
	{
		return isset( $_FILES[ $this->get_name() ] ) ? $_FILES[ $this->get_name() ] : null;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

// TODO: gestionar errores de file, o dejarlo para process_form() o permitar la opción de elegir un chequeado automático (O PIENSA DETENIDAMENTE)
// TODO: UPDATED de momento he dejado el chequeado automático
		if( $this->is_required() && empty( $_FILES[$this->get_name()]['name'] ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'You must upload a file in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);

		if( !empty( $_FILES[$this->get_name()]['name'] ) )
		{
			if( !$this->is_upload_ok() )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Can not upload file in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);

			$max_size = $this->get_max_size();
			if( $max_size !== null && $this->get_file_size() > $max_size )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'File in field %s exceeds the size limit.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);

			$allowed_extensions = $this->get_allowed_extensions();
			if( !empty( $allowed_extensions ) )
			{
				if( ( is_array( $allowed_extensions ) && !in_array( $this->get_file_extension(), $allowed_extensions ) ) ||
					( is_string( $allowed_extensions ) && $allowed_extensions != $this->get_file_extension() ) )
					return array(
						'code' => JLCCustomForm::FORM_DATA_ERROR,
						'text' => sprintf( __( 'File in field %s has not allowed extension.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
					);

			}

			$allowed_mime_types = $this->get_allowed_mime_types();
			if( !empty( $allowed_mime_types ) )
			{
				if( ( is_array( $allowed_mime_types ) && !in_array( $this->get_file_mime_content_type(), $allowed_mime_types ) ) ||
					( is_string( $allowed_mime_types ) && $allowed_mime_types != $this->get_file_mime_content_type() ) )
					return array(
						'code' => JLCCustomForm::FORM_DATA_ERROR,
						'text' => sprintf( __( 'File in field %s has not allowed MIME type.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
					);

			}
		}

		$this->set_value( $val );
		
		return null;
	}

	public function is_file_for_upload()
	{
		return isset( $_FILES[$this->get_name()] ) && $_FILES[$this->get_name()]['error'] != UPLOAD_ERR_NO_FILE;
	}

	public function is_upload_ok()
	{
		return isset( $_FILES[$this->get_name()] ) && $_FILES[$this->get_name()]['error'] == UPLOAD_ERR_OK;
	}

	public function get_file_size()
	{
		return isset( $_FILES[$this->get_name()]['size'] ) ? $_FILES[$this->get_name()]['size'] : 0;
	}

	public function get_file_extension()
	{
		return isset( $_FILES[$this->get_name()]['name'] ) ? pathinfo( $_FILES[$this->get_name()]['name'], PATHINFO_EXTENSION ) : null;
	}

	public function get_file_mime_content_type()
	{
		return isset( $_FILES[$this->get_name()]['tmp_name'] ) ? mime_content_type( $_FILES[$this->get_name()]['tmp_name'] ) : null;
	}

	public function get_tmp_file()
	{
		return isset( $_FILES[$this->get_name()]['tmp_name'] ) ? $_FILES[$this->get_name()]['tmp_name'] : null;
	}

	public function save_file( $dir, $filename )
	{
		if( !$this->is_upload_ok() )
			return false;

		$target_file = implode( DIRECTORY_SEPARATOR, array( $dir, $filename ) );

		return move_uploaded_file( $_FILES[$this->get_name()]["tmp_name"], $target_file );
	}
}

} //class_exists



