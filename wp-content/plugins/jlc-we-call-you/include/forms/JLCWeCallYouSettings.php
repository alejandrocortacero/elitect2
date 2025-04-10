<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCJLCWeCallYouSettingsForm' ) )
{

if( !class_exists( 'JLCAdminSettingsForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'abstract', 'admin-settings-form.php' ) ) ) );

class JLCJLCWeCallYouSettingsForm extends JLCAdminSettingsForm
{
	public function __construct( $internal_id, $args )
	{
		$admin_page_slug = isset( $args['admin_page_slug'] ) ? $args['admin_page_slug'] : '';
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$admin_page_slug,
			$text_domain
		);

		$this->add_email_field(
			JLCWeCallYou::NOTIFICATION_ADDR_KEY,
			array(
				'value' => get_option( JLCWeCallYou::NOTIFICATION_ADDR_KEY ),
				'label' => __( 'Notification addresses', $this->get_text_domain() ),
				'separator' => ',',
				'required' => true
			)
		);

		$this->add_wp_editor_field(
			JLCWeCallYou::INFO_TEXT_KEY,
			array(
				'value' => get_option( JLCWeCallYou::INFO_TEXT_KEY ),
				'label' => __( 'Privacy policy short', $this->get_text_domain() ),
				'required' => false,
				'help' => __( 'This text will appear below the contact form.', $this->get_text_domain() )
			)
		);

		$this->add_checkbox_field(
			JLCWeCallYou::USE_AJAX_FORM_KEY,
			array(
				'value' => 'yes',
				'label' => __( 'Use AJAX form', $this->get_text_domain() ),
				'checked' => get_option( JLCWeCallYou::USE_AJAX_FORM_KEY ) === 'yes'
			)
		);

		$this->add_post_select(
			JLCWeCallYou::THANKS_PAGE_KEY,
			array(
				'preselected' => get_option( JLCWeCallYou::THANKS_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Thanks page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			JLCWeCallYou::GTAG_EVENT_CONVERSION_KEY,
			array(
				'value' => get_option( JLCWeCallYou::GTAG_EVENT_CONVERSION_KEY ),
				'label' => __( 'GTAG event conversion', $this->get_text_domain() ),
				'required' => false
			)
		);


		$this->add_submit_button(
			'save',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}
}

} //class_exists

