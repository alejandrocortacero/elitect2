<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCAdminSettingsForm' ) )
{

if( !class_exists( 'JLCAdminForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'admin-form.php' ) ) );

abstract class JLCAdminSettingsForm extends JLCAdminForm
{
	public function __construct(
		$base_dir,
		$internal_id,
		$admin_page_slug,
		$text_domain = null,
		$enctype = null,
		$id = null,
		$class = null,
		$transient_time = 60
	) {
		parent::__construct(
			$base_dir,
			$internal_id,
			$text_domain,
			$internal_id . '_save_settings',
			false,
			preg_match( '/\.php\?page=/', $admin_page_slug ) ? admin_url( $admin_page_slug ) : admin_url( 'admin.php?page=' . $admin_page_slug ),
			$enctype,
			$id,
			$class,
			$transient_time
		);
	}

	public function process_form()
	{
		foreach( $this->get_fields() as $field )
		{
			if( method_exists( $field, 'get_name' ) )
			{
				switch( $field->get_type() )
				{
					case 'checkbox':
						update_option( $field->get_name(), $field->is_checked() ? 'yes' : 'no' );
						break;
					case 'number':
						update_option( $field->get_name(), $field->get_value() );
						break;
					case 'integer':// this case exists before the previous one, but I do not know if is used by anything.
						update_option( $field->get_name(), $field->get_value() );
						break;
					case 'textarea':
						update_option( $field->get_name(), sanitize_textarea_field( $field->get_value() ) );
						break;
					case 'wp_editor':
					case 'tinymce':
						update_option( $field->get_name(), preg_replace( '/\\\\"/', '"', $field->get_value() ) );
						break;
					case 'email':
						update_option( $field->get_name(), $field->get_value() );
						break;
					case 'select':
						if( $field->is_multiple() )
							update_option( $field->get_name(), array_map( 'sanitize_text_field', $field->get_value() ) );
						else
							update_option( $field->get_name(), sanitize_text_field( $field->get_value() ) );
						break;
					case 'radio':
					case 'text':
						update_option( $field->get_name(), sanitize_text_field( $field->get_value() ) );
						break;
					default:
						update_option( $field->get_name(), $field->get_value() );
				}
			}
		}

		return true;
	}
}

} // class_exists

