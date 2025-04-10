<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( defined( 'JLC_CUSTOM_FORM_ALLOW_DOWNLOADS' ) && JLC_CUSTOM_FORM_ALLOW_DOWNLOADS && !class_exists( 'JLCDownloadFilesForm' ) )
{

class JLCDownloadFilesForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'jlc_custom_form_download_file',
			false,//ajax
			true,//wordpress_method
			null,//return url
			true,//private
			null,//enctype
			'GET'
		);

		$this->add_text_field(
			'file',
			array(
				'value' => '',
				'label' => __( 'File', $this->get_text_domain() ),
				'required' => true
			)
		);
	}

	public function print_public_form( $hide_messages = false ) {}
	public function print_admin_form( $readonly_form = false ) {}

	public function process_form()
	{
		if( !defined( 'JLC_CUSTOM_FORM_ALLOW_DOWNLOADS' ) || !JLC_CUSTOM_FORM_ALLOW_DOWNLOADS )
			die();

		if( !function_exists( 'current_user_can' ) || !current_user_can( 'administrator' ) )
			die();

		$file_path = $this->get_field_by_name( 'file' )->get_value();

		if( is_readable( $file_path ) )
		{
			$ext = pathinfo( $file_path, PATHINFO_EXTENSION );
			if( !in_array( $ext, array( 'jpg', 'jpeg', 'png', 'pdf' ) ) )
				die();

			$filename = basename( $file_path );
			$document_type = mime_content_type( $file_path );

			header('Content-type: ' . $document_type );
			header('Content-Disposition: inline; filename="' . $filename . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($file_path));
			header('Accept-Ranges: bytes');

			@readfile($file_path);
			exit;
		}

		die();
	}
}

} //class_exists


