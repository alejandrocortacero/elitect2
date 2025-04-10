<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCJLCWeCallYouContactForm' ) )
{

class JLCJLCWeCallYouContactForm extends JLCCustomForm
{
	protected $thanks_url;

	protected $from_page;
	protected $from_url;

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
			'jlc-we-call-youcontact-form',//action
			JLCWeCallYou::is_using_ajax_form(),//ajax
			true,//wordpress_method
			!empty( $_REQUEST['return_url'] ) ? $_REQUEST['return_url'] : site_url( add_query_arg( array() ) ),
			false //private
		);

		if( !empty( $_POST['jlc_custom_form'] ) && $_POST['jlc_custom_form'] == $internal_id )
		{
			$this->from_page = sanitize_text_field( $_POST['from_page'] );
			$this->from_url = sanitize_text_field( $_POST['from_url'] );
		}
		elseif( function_exists( 'is_page' ) && is_page() )
		{
			global $post;
			$this->from_page = $post->ID;
			$this->from_url = get_permalink( $post->ID );
		}
		else
		{
			$this->from_page = '';
			$this->from_url = self::get_current_url();
		}

		$this->thanks_url = $thanks_url;

		$user = is_user_logged_in() ? wp_get_current_user() : null;

		$this->add_hidden_field(
			'from_page',
			array(
				'value' => $this->from_page,
				'required' => false
			)
		);
		$this->add_hidden_field(
			'from_url',
			array(
				'value' => $this->from_url,
				'required' => false
			)
		);

		$this->add_honeypot();

		$this->add_text_field(
			'name',
			array(
				'value' => $user ? $user->display_name : '',
				'label' => __( 'Nombre y apellidos', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 60
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

		$this->add_email_field(
			'email',
			array(
				'value' => $user ? $user->user_email : '',
				'label' => __( 'Email', $this->get_text_domain() ),
				'required' => true
			)
		);

		$hours_field = $this->add_select(
			'hours',
			array(
				'label' => __( 'Mejor momento para localizarte', $this->get_text_domain() ),
				'required' => true
			)
		);
		$hours_field->add_option( '9_13', 'Mañana (9 - 13)' );
		$hours_field->add_option( '13_19', 'Tarde (13 - 19)' );
		$hours_field->add_option( '19_22', 'Noche (19 - 22)' );

		$this->add_textarea_field(
			'desc',
			array(
				'value' => '',
				'label' => __( 'Breve descripción de tus objetivos', $this->get_text_domain() ),
				'required' => true
			)
		);

		if( JLCWeCallYou::privacy_policy_exists() )
			$this->add_checkbox_field(
				'privacy',
				array(
					'value' => 'yes',
					'id' => 'privacy-we-call-you',
					'label' => JLCWeCallYou::privacy_policy_exists() ?
						sprintf(
							__( 'I have read and accept the <a href="%s" rel="bookmark" target="_blank">Privacy Policy</a>', $this->get_text_domain() ),
							JLCWeCallYou::get_privacy_policy_url()
						)
						:
						__( 'I have read and accept the Privacy Policy', JLCWeCallYou::TEXT_DOMAIN )
					,
					'checked' => false,
					'required' => true
				)
			);

//		$this->add_google_captcha( 'we-call-you-google-captcha' );

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
		if( !class_exists( 'JLCWeCallYouMapper', false ) )
			require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'mapper.php' ) ) ) );

		$phone = $this->get_field_by_name( 'phone', false )->get_value();

		if( JLCWeCallYouMapper::is_call_pending( $phone ) )
			return __( 'Your call request has been sent successfully. We will call you as soon as possible.', $this->text_domain );

		$contact_id = JLCWeCallYouMapper::create_contact(
			$phone
		);

		if( $contact_id )
		{
			JLCWeCallYou::send_contact_notification( $contact_id, $phone, $this->from_page, $this->from_url );

			return __( 'Your call request has been sent successfully. We will call you as soon as possible.', $this->text_domain );
		}
		else
		{
			return false;
		}
	}


    public function print_public_form_closing()
    {
        $info_text = JLCWeCallYou::get_privacy_policy_short();
        $file_path = $this->look_for_file( 'contact-form-closing.php' );

        if ( $file_path && file_exists( $file_path ) ) {
            include( $file_path );
        } else {
            error_log( 'contact-form-closing.php file not found or invalid path in ' . __METHOD__ );
            // Optional: Provide a fallback output or return an error message to the user
            echo '<p>' . esc_html__( 'Unable to load the contact form closing content.', $this->get_text_domain() ) . '</p>';
        }
    }

}

} // class_exists


