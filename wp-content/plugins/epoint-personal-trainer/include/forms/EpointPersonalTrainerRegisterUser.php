<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerRegisterUserForm' ) )
{

class JLCEpointPersonalTrainerRegisterUserForm extends JLCCustomForm
{
	protected $success_page_id;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$this->success_page_id = isset( $args['success_page_id'] ) ? $args['success_page_id'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_register_user',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			false
		);

		//$this->add_honeypot();

		$this->add_heading( array( 'content' => __( 'Personal Data', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_text_field(
			'firstname',
			array(
				'value' => '',
				'label' => __( 'First name', $this->get_text_domain() ),
				'maxlength' => 30,
				'required' => true
			)
		);

		$this->add_text_field(
			'lastname',
			array(
				'value' => '',
				'label' => __( 'Last name', $this->get_text_domain() ),
				'maxlength' => 30,
				'required' => true
			)
		);

		$this->add_text_field(
			'email',
			array(
				'value' => '',
				'label' => __( 'Email', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_text_field(
			'phone',
			array(
				'value' => '',
				'label' => __( 'Phone', $this->get_text_domain() ),
				'maxlength' => 10,
				'required' => true
			)
		);

		$this->add_date_field(
			'birthday',
			array(
				'value' => '',
				'label' => __( 'Fecha de nacimiento', $this->get_text_domain() ),
				'required' => true
			)
		);

		$sex_field = $this->add_select(
			'sex',
			array(
				'label' => __( 'Sexo', $this->get_text_domain() ),
				'required' => true
			)
		);
		$sex_field->add_option(
			'm',
			__( 'Mujer', $this->get_text_domain() )
		);
		$sex_field->add_option(
			'v',
			__( 'Varón', $this->get_text_domain() )
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

/*		
		$this->add_heading( array( 'content' => __( 'Photos', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_upload_field(
			'front_photo',
			array(
				'value' => '',
				'label' => __( 'Front photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 10MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 5 * 2097152
			)
		);

		$this->add_upload_field(
			'profile_photo',
			array(
				'value' => '',
				'label' => __( 'Profile photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 10MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 5 * 2097152
			)
		);
*/
		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Register', $this->get_text_domain() )
			)
		);
	}

	protected function enqueue_scripts()
	{
/*
		$freelancer_code = BubbleFishScoringFirm::FREELANCER_CODE;

		$plugin_path = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', '..', 'bubblefish-scoring-firm.php' ) ) );
		wp_enqueue_script(
			'bubblefish-solicitude-form-script',
			plugins_url( 'js/solicitude.js', $plugin_path ),
			array( 'jquery' ),
			BubbleFishScoringFirm::VERSION,
			true
		);

		wp_localize_script(
			'bubblefish-solicitude-form-script',
			'BubbleFishSolicitudeNS',
			array(
				'freelancerCode' => $freelancer_code
			)
		);
*/
	}

	protected function process_form()
	{
		$user_email = $this->get_field_by_name( 'email' )->get_value();
		$user_name = $this->get_field_by_name( 'username' )->get_value();
		$password = $this->get_field_by_name( 'pito' )->get_value();
		$password2 = $this->get_field_by_name( 'flauta' )->get_value();

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

		add_user_to_blog( get_current_blog_id(), $user->ID, EpointPersonalTrainer::SPORTSMAN_ROLE );
/*
		$front_photo_field = $this->get_field_by_name( 'front_photo' );
		$profile_photo_field = $this->get_field_by_name( 'profile_photo' );

		if( $front_photo_field->is_file_for_upload() && $front_photo_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'front_photo', 0 );
			if( is_int( $logo_id ) )
				update_user_meta( $user->ID, 'front_photo', $logo_id );
		}

		if( $profile_photo_field->is_file_for_upload() && $profile_photo_field->is_upload_ok() )
		{
			$logo_id = media_handle_upload( 'profile_photo', 0 );
			if( is_int( $logo_id ) )
				update_user_meta( $user->ID, 'profile_photo', $logo_id );

		}
*/
		$first_name = $this->get_field_by_name( 'firstname' )->get_value();
		$last_name = $this->get_field_by_name( 'firstname' )->get_value();
		$user_id = wp_update_user( array( 'ID' => $user->ID, 'display_name' => $first_name, 'first_name' => $first_name, 'last_name' => $last_name ) );

		$phone = $this->get_field_by_name( 'phone' )->get_value();
		update_user_meta( $user->ID, 'phone', $phone );

		$birthday = $this->get_field_by_name( 'birthday' )->get_value();
		$sex = $this->get_field_by_name( 'sex' )->get_value();
		update_user_meta( $user->ID, 'elite_birthday', $birthday );
		update_user_meta( $user->ID, 'elite_sex', $sex );

		wp_logout();

		wp_set_current_user( $user->ID, $user->user_login );
		wp_set_auth_cookie( $user->ID );
		do_action( 'wp_login', $user->user_login, $user );

		EpointPersonalTrainer::send_new_user_notification( $user_email, $sitename, $domain );

		wp_redirect( get_blogaddress_by_id( get_current_blog_id() ) );
		exit;
/*
		if( $this->success_page_id )
		{
			$url = get_permalink( $this->success_page_id );
			wp_redirect( $url );
			exit;
		}
		else
		{
			return __( 'User created successfully', $this->get_text_domain() );
		}
*/
	}

}

} // class_exists

