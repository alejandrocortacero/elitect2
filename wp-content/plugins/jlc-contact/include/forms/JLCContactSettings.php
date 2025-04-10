<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCJLCContactSettingsForm' ) )
{

if( !class_exists( 'JLCAdminSettingsForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'abstract', 'admin-settings-form.php' ) ) ) );

class JLCJLCContactSettingsForm extends JLCAdminSettingsForm
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
			JLCContact::NOTIFICATION_ADDR_KEY,
			array(
				'value' => get_option( JLCContact::NOTIFICATION_ADDR_KEY ),
				'label' => __( 'Notification addresses', $this->get_text_domain() ),
				'separator' => ',',
				'required' => true
			)
		);

		$this->add_email_field(
			JLCContact::CONTACT_EMAIL_KEY,
			array(
				'value' => get_option( JLCContact::CONTACT_EMAIL_KEY ),
				'label' => __( 'Contact address', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_post_select(
			JLCContact::CONTACT_PAGE_KEY,
			array(
				'preselected' => get_option( JLCContact::CONTACT_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Main contact page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			JLCContact::CONTACT_PHONE_KEY,
			array(
				'value' => get_option( JLCContact::CONTACT_PHONE_KEY ),
				'label' => __( 'Contact phone', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			JLCContact::CONTACT_MOBILE_KEY,
			array(
				'value' => get_option( JLCContact::CONTACT_MOBILE_KEY ),
				'label' => __( 'Contact mobile', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			JLCContact::CONTACT_WHATSAPP_KEY,
			array(
				'value' => get_option( JLCContact::CONTACT_WHATSAPP_KEY ),
				'label' => __( 'Contact whatsapp', $this->get_text_domain() ),
				'help' => __( 'Include country prefix Eg: (+34) 666 666 666', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_wp_editor_field(
			JLCContact::INFO_TEXT_KEY,
			array(
				'value' => get_option( JLCContact::INFO_TEXT_KEY ),
				'label' => __( 'Privacy policy short', $this->get_text_domain() ),
				'required' => false,
				'help' => __( 'This text will appear below the contact form.', $this->get_text_domain() )
			)
		);

		$this->add_checkbox_field(
			JLCContact::USE_AJAX_FORM_KEY,
			array(
				'value' => 'yes',
				'label' => __( 'Use AJAX form', $this->get_text_domain() ),
				'checked' => get_option( JLCContact::USE_AJAX_FORM_KEY ) === 'yes'
			)
		);

		$this->add_post_select(
			JLCContact::THANKS_PAGE_KEY,
			array(
				'preselected' => get_option( JLCContact::THANKS_PAGE_KEY, array() ),
				'query_args' => array(
					'numberposts' => -1,
					'post_type' => 'page',
					'post_status' => 'publish'
				),
				'label' => __( 'Thanks page', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_multi_contact_field(
			JLCContact::CONTACT_ADDRESSES_LIST_KEY,
			array(
				'value' => get_option( JLCContact::CONTACT_ADDRESSES_LIST_KEY ),
				'label' => __( 'Contact Addresses', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			JLCContact::GTAG_EVENT_CONVERSION_KEY,
			array(
				'value' => get_option( JLCContact::GTAG_EVENT_CONVERSION_KEY ),
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

