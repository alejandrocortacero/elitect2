<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCAdminSettingsTabbedForm' ) )
{

if( !class_exists( 'JLCAdminSettingsForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'admin-settings-form.php' ) ) );

/**
 * Construct the form as any other and organizate the fields in tabs at the end.
 *
 * Use $_GET['jlccustomformactivetab'] to set active tab on page loading.
 */
abstract class JLCAdminSettingsTabbedForm extends JLCAdminSettingsForm
{
	protected $tabs;

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
			$admin_page_slug,
			$text_domain,
			$enctype,
			$id,
			$class,
			$transient_time
		);

		$this->tabs = array();
	}

	protected function add_tab( $tab_key, $tab_label )
	{
		$tabs = $this->tabs;
		$tabs[$tab_key] = array( 'label' => $tab_label, 'fields' => array() );
		$this->tabs = $tabs;
	}

	protected function add_field_to_tab( $tab_key, JLCCustomFormElement $field )
	{
		$tabs = $this->tabs;

		if( array_key_exists( $tab_key, $tabs ) )
			$tabs[$tab_key]['fields'][] = $field;

		$this->tabs = $tabs;
	}

	protected function get_tabs()
	{
		return $this->tabs;
	}

	protected function get_untabbed_fields()
	{
		$untabbed = array();
		foreach( $this->get_fields() as $field )
		{
			$included = false;
			foreach( $this->get_tabs() as $tab_key => $tab )
			{
				if( in_array( $field, $tab['fields'] ) )
				{
					$included = true;
					break;
				}
			}

			if( !$included )
				$untabbed[] = $field;
		}

		return $untabbed;
	}

	protected function is_active_tab( $tab_key )
	{
		$tabs = $this->get_tabs();

		if( array_key_exists( $tab_key, $tabs ) &&
			isset( $_GET['jlccustomformactivetab'] ) &&
			$_GET['jlccustomformactivetab'] == $tab_key )
			return true;

		$first_tab = current( array_keys( $tabs ) );

		return $first_tab == $tab_key;
	}

	public function print_admin_form_opening()
	{
		wp_enqueue_script(
			'jlc-custom-form-tabbed-admin-form-script',
			plugins_url( 'templates/admin/js/tabbed-form.js', realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'jlc-form.php' ) ) ) ),
			array( 'jquery' ),
			JLCCustomForm::VERSION,
			true
		);
		wp_enqueue_style(
			'jlc-custom-form-tabbed-admin-form-style',
			plugins_url( 'templates/admin/css/tabbed-form.css', realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'jlc-form.php' ) ) ) ),
			array(),
			JLCCustomForm::VERSION
		);

		include( $this->look_for_file( 'admin-settings-tabbed-form-opening.php' ) );
	}

	public function print_admin_form_body()
	{
		include( $this->look_for_file( 'admin-settings-tabbed-form.php' ) );
	}
	
	public function print_admin_form_closing()
	{
		include( $this->look_for_file( 'admin-settings-tabbed-form-closing.php' ) );
	}
}

} // class_exists

