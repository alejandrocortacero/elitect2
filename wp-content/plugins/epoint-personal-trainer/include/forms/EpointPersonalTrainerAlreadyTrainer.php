<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerAlreadyTrainerForm' ) )
{

class JLCEpointPersonalTrainerAlreadyTrainerForm extends JLCCustomForm
{

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_already_trainer',
			false,
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		//$user = is_user_logged_in() ? wp_get_current_user() : null;

		$this->add_honeypot();

		//$this->add_heading( array( 'content' => __( 'Personal data', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_email_field(
			'email',
			array(
				'value' => '',
				'label' => __( 'Email', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_password_field(
			'flauta',
			array(
				'value' => '',
				'label' => __( 'Password', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_submit_button(
			'send',
			array(
				'class' => 'btn btn-primary',
				'label' => __( 'Log in', $this->get_text_domain() )
			)
		);
	}

	public function process_form()
	{
		$user_email = $this->get_field_by_name( 'email' )->get_value();
		$password = $this->get_field_by_name( 'flauta' )->get_value();


		if( !( $user = get_user_by( 'email', $user_email ) ) )
		{
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'You are not registered yet.', $this->get_text_domain() )
			) );
		}

		if ( !$user || !wp_check_password( $password, $user->data->user_pass, $user->ID ) )
		{
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'Invalid user or pasword.', $this->get_text_domain() )
			) );
		}

		//$blog = get_active_blog_for_user( $user->ID );
		$blogs = get_blogs_of_user( $user->ID );
		if( empty( $blogs ) )
		{
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'You have not a website registered.', $this->get_text_domain() )
			) );
		}
		$blog = current( $blogs );


		// select meta_value from wp_sitemeta where meta_key = subdomain_install
/*
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

		if( !( $blog_id = wpmu_create_blog( $domain, $path, $sitename, $user->ID ) ) )
		{
			return array( array(
				'code' => self::FATAL_ERROR,
				'text' => __( 'There was an error creating your site. Contact us please.', $this->get_text_domain() )
			) );
		}

		add_user_to_blog( $blog_id, $user->ID, EpointPersonalTrainer::TRAINER_ROLE );
*/
		wp_logout();

		wp_set_current_user( $user->ID, $user->user_login );
		wp_set_auth_cookie( $user->ID );
		do_action( 'wp_login', $user->user_login, $user );

		//wp_redirect( get_blogaddress_by_id( $blog_id ) );
		wp_redirect( $blog->siteurl );
		exit;
	}


}

} // class_exists

