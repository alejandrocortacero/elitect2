<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCJLCContactContactForm' ) )
{

class JLCJLCContactContactForm extends JLCCustomForm
{
	protected $thanks_url;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$thanks_page_option = isset( $args['thanks_page_option'] ) ? $args['thanks_page_option'] : null;

		$page_id = !empty( $thanks_page_option ) ? get_option( $thanks_page_option ) : null;
		$thanks_url = !empty( $page_id ) ? get_permalink( $page_id ) : home_url();

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'jlc-contact-form',//action
			JLCContact::is_using_ajax_form(),//ajax
			true,//wordpress_method
			!empty( $_REQUEST['return_url'] ) ? $_REQUEST['return_url'] : site_url( add_query_arg( array() ) ),
			false //private
		);

		$this->thanks_url = $thanks_url;

		$user = is_user_logged_in() ? wp_get_current_user() : null;

		$this->add_hidden_field(
			'from_url',
			array(
				'value' => $this->return_url,
				'required' => true
			)
		);

		$this->add_honeypot();

		$this->add_text_field(
			'name',
			array(
				'value' => $user ? $user->display_name : '',
				'label' => __( 'Name', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 100
			)
		);

		$this->add_email_field(
			'email',
			array(
				'value' => $user ? $user->user_email : '',
				'label' => __( 'Email', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_text_field(
			'phone',
			array(
				'value' => $user ? get_user_meta( $user->ID, 'billing_phone', true ) : '',
				'label' => __( 'Phone', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 20
			)
		);
/*
		$this->add_text_field(
			'postcode',
			array(
				'value' => $user ? get_user_meta( $user->ID, 'billing_postcode', true ) : '',
				'label' => __( 'Post code', $this->get_text_domain() ),
				'id' => 'postcode',
				'required' => true
			)
		);
*/
		$this->add_text_field(
			'subject',
			array(
				'label' => __( 'Subject', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_textarea_field(
			'message',
			array(
				'label' => __( 'Message', $this->get_text_domain() ),
				'required' => true
			)
		);

		if( JLCContact::privacy_policy_exists() )
			$this->add_checkbox_field(
				'privacy',
				array(
					'value' => 'yes',
					'label' => JLCContact::privacy_policy_exists() ?
						sprintf(
							__( 'I have read and accept the <a href="%s" rel="bookmark" target="_blank">Privacy Policy</a>', $this->get_text_domain() ),
							JLCContact::get_privacy_policy_url()
						)
						:
						__( 'I have read and accept the Privacy Policy', JLCContact::TEXT_DOMAIN )
					,
					'checked' => false,
					'required' => true
				)
			);

		//$this->add_google_captcha( 'contact-google-captcha' );

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Send', $this->get_text_domain() )
			)
		);
	}

	//public function process_public_form()
	public function process_form()
	{
		if( !class_exists( 'JLCContactMapper', false ) )
			require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'mapper.php' ) ) ) );

		$email = $this->get_field_by_name( 'email', false )->get_value();
		$subject = $this->get_field_by_name( 'subject', false )->get_value();
		$message = $this->get_field_by_name( 'message', false )->get_value();
		$name = $this->get_field_by_name( 'name', false )->get_value();
		$phone = $this->get_field_by_name( 'phone', false )->get_value();

		$contact_id = JLCContactMapper::create_contact(
			$name,
			$email,
			$phone,
			$subject,
			$message
		);

		if( $contact_id )
		{
			JLCContact::send_contact_notification( $contact_id, $name, $email, $phone, $subject, $message );

			return __( 'Your message has been sent successfully. We will contact you as soon as possible.', $this->text_domain );
		}
		else
		{
			return false;
		}
	}


	public function print_public_form_closing()
	{
		$info_text = JLCContact::get_privacy_policy_short();
		include( $this->look_for_file( 'contact-form-closing.php' ) );
	}
}

} // class_exists


