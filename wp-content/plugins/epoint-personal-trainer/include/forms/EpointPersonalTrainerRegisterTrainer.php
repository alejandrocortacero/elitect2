<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerRegisterTrainerForm' ) )
{

class JLCEpointPersonalTrainerRegisterTrainerForm extends JLCCustomForm
{

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_register_trainer',
			false,
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		//$user = is_user_logged_in() ? wp_get_current_user() : null;

		$this->add_honeypot();

		$this->add_heading( array( 'content' => __( 'Personal data', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_text_field(
			'name',
			array(
				'value' => '',
				'label' => __( 'Name', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 20 
			)
		);

		$this->add_text_field(
			'surname1',
			array(
				'value' => '',
				'label' => __( 'First surname', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 20 
			)
		);

		$this->add_text_field(
			'surname2',
			array(
				'value' => '',
				'label' => __( 'Last surname', $this->get_text_domain() ),
				'required' => false,
				'maxlength' => 20 
			)
		);

		$this->add_nif_field(
			'dni',
			array(
				'value' => '',
				'label' => __( 'NIF', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_text_field(
			'phone',
			array(
				'value' => '',
				'label' => __( 'Mobile', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 10
			)
		);

		$this->add_email_field(
			'email',
			array(
				'value' => '',
				'label' => __( 'Email', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_heading( array( 'content' => __( 'Site data', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_text_field(
			'subdomain',
			array(
				'value' => '',
				'label' => __( 'Site domain name', $this->get_text_domain() ),
				'help' => __( 'Utilice solo letras minúsculas', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 20 
			)
		);

		$this->add_text_field(
			'sitename',
			array(
				'value' => '',
				'label' => __( 'Site name', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 60 
			)
		);

		$this->add_text_field(
			'username',
			array(
				'value' => '',
				'label' => __( 'User name', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 60 
			)
		);

		$this->add_password_field(
			'pito',
			array(
				'value' => '',
				'label' => __( 'Password', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_password_field(
			'flauta',
			array(
				'value' => '',
				'label' => __( 'Confirm password', $this->get_text_domain() ),
				'required' => true
			)
		);


		if( ( $page_id = (int)get_option( 'wp_page_for_privacy_policy' ) ) &&
			$page = get_post( $page_id ) )
		{
			$this->add_checkbox_field(
				'accept_terms',
				array(
					'value' => 'yes',
					'label' => sprintf( __( 'I have read the %s and I give my consent for the automatic processing of my data.', $this->get_text_domain() ), sprintf( '<a href="%s" rel="bookmark" target="_blank">%s</a>', esc_attr( get_permalink( $page_id ) ), $page->post_title ) ),
					'checked' => false,
					'required' => true
				)
			);
		}

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Send', $this->get_text_domain() )
			)
		);
	}
/*
	public function print_public_form( $hide_messages = false )
	{
		

		//var_dump( get_sites( array( 'number' => null ) ) );

		//var_dump( domain_exists( 'localhost', '/sitio1' ) );
		//var_dump( domain_exists( 'localhost', '/sitio46' ) );
	}
*/
	public function process_form()
	{
		$subdomain = $this->get_field_by_name( 'subdomain' )->get_value();
		$sitename = $this->get_field_by_name( 'sitename' )->get_value();

		$user_email = $this->get_field_by_name( 'email' )->get_value();
		$user_name = $this->get_field_by_name( 'username' )->get_value();
		$password = $this->get_field_by_name( 'pito' )->get_value();
		$password2 = $this->get_field_by_name( 'flauta' )->get_value();

		$name = $this->get_field_by_name( 'name' )->get_value();
		$surname1 = $this->get_field_by_name( 'surname1' )->get_value();
		$surname2 = $this->get_field_by_name( 'surname2' )->get_value();

		$phone = $this->get_field_by_name( 'phone' )->get_value();
		$nif = $this->get_field_by_name( 'dni' )->get_value();

		if( !preg_match( '/^[a-z]+$/', $subdomain ) )
		{
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'Invalid site domain name.', $this->get_text_domain() )
			) );
				
		}

		if( $password != $password2 )
		{
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'Password does not match password confirmation.', $this->get_text_domain() )
			) );
				
		}

		if( !( $user = get_user_by( 'email', $user_email ) ) )
		{
			if( !username_exists( $user_name ) )
			{
				if( !( $user_id = wpmu_create_user( $user_name, $password, $user_email ) ) )
				{
					return array( array(
						'code' => self::FATAL_ERROR,
						'text' => __( 'There was an error creating your user account. Contact us please.', $this->get_text_domain() )
					) );
				}

				$user = get_user_by( 'ID', $user_id );
			}
			else
			{
				return array( array(
					'code' => self::FORM_DATA_ERROR,
					'text' => __( 'Given user name is already in use.', $this->get_text_domain() )
				) );
			}
		}
		else
		{
			if( $user->user_login != $user_name )
			{
				return array( array(
					'code' => self::FORM_DATA_ERROR,
					'text' => __( 'This account has a different user name.', $this->get_text_domain() )
				) );
			}
		}

		// select meta_value from wp_sitemeta where meta_key = subdomain_install
		$subdomain_install = true;
		if( $subdomain_install )
		{
			$domain = $subdomain . preg_replace( '/^www\./', '.', $_SERVER['HTTP_HOST'] );
			$path = '/';
		}
		else
		{
			$domain = $_SERVER['HTTP_HOST'];
			$path = '/' . $subdomain . '/';
		}
		
		if( domain_exists( $domain, $path ) )
		{
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'This site domain name already exists. Chose another name please.', $this->get_text_domain() )
			) );
				
		}

		$sites = get_sites();
		foreach( $sites as $site )
		{
			$blog_details = get_blog_details( $site->blog_id );
			if( mb_strtolower( $sitename ) === mb_strtolower( $blog_details->blogname ) )
			{
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'This site name already exists. Chose another name please.', $this->get_text_domain() )
				) );
			}
		}
		

		if( !( $blog_id = wpmu_create_blog( $domain, $path, $sitename, $user->ID ) ) )
		{
			return array( array(
				'code' => self::FATAL_ERROR,
				'text' => __( 'There was an error creating your site. Contact us please.', $this->get_text_domain() )
			) );
		}

		add_user_to_blog( $blog_id, $user->ID, EpointPersonalTrainer::TRAINER_ROLE );

		$last_name = $surname1;
		if( !empty( $surname2 ) ) $last_name .= ' ' . $surname2;
		update_user_meta( $user->ID, 'first_name', $name );
		update_user_meta( $user->ID, 'last_name', $last_name );

		update_user_meta( $user->ID, 'epoint_personal_trainer_tinfo_phone', $phone );
		update_user_meta( $user->ID, 'epoint_personal_trainer_tinfo_nif', $nif );

		wp_logout();

		wp_set_current_user( $user->ID, $user->user_login );
		wp_set_auth_cookie( $user->ID );
		do_action( 'wp_login', $user->user_login, $user );

		do_action( EpointPersonalTrainer::NEW_TRAINER_SITE_ACTION, $blog_id, $user );

		EpointPersonalTrainer::send_new_site_notification( $user_email, $sitename, $domain );

		wp_redirect( get_blogaddress_by_id( $blog_id ) );
		exit;
	}


}

} // class_exists
