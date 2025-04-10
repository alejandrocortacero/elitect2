<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditMemberForm' ) )
{

class JLCEpointPersonalTrainerEditMemberForm extends JLCCustomForm
{
	protected $success_page_id;

	protected $user_id;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$this->success_page_id = null;//isset( $args['success_page_id'] ) ? $args['success_page_id'] : null;

		$this->user_id = isset( $args['user_id'] ) ? (int)$args['user_id'] : null;

		$user = $this->user_id ? get_user_by( 'id', $this->user_id ) : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_member',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		//$this->add_honeypot();
		$this->add_hidden_field(
			'member_id',
			array(
				'value' => $this->user_id
			)
		);

		$this->add_heading( array( 'content' => __( 'Personal Data', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_text_field(
			'firstname',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'first_name', true ) : '',
				'label' => __( 'First name', $this->get_text_domain() ),
				'maxlength' => 30,
				'required' => true
			)
		);

		$this->add_text_field(
			'lastname',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'last_name', true ) : '',
				'label' => __( 'Last name', $this->get_text_domain() ),
				'maxlength' => 30,
				'required' => true
			)
		);

		$this->add_email_field(
			'email',
			array(
				'value' => $user ? $user->user_email : '',
				'label' => __( 'Email', $this->get_text_domain() ),
				'required' => true,
				'readonly' => !empty( $this->user_id )
			)
		);

		$this->add_text_field(
			'userp',
			array(
				'value' => '',
				'label' => __( 'Contraseña', $this->get_text_domain() ),
				'help' => 'Dejar en blanco para generar una nueva o mantener la antigua',
				'required' => false
			)
		);

		$this->add_text_field(
			'phone',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'phone', true ) : '',
				'label' => __( 'Phone', $this->get_text_domain() ),
				'maxlength' => 10,
				'required' => true
			)
		);

		$this->add_text_field(
			'username',
			array(
				'value' => $user ? $user->user_login : '',
				'label' => __( 'User name', $this->get_text_domain() ),
				'required' => true,
				'maxlength' => 60,
				'readonly' => !empty( $this->user_id )
			)
		);

		$this->add_date_field(
			'birthday',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'elite_birthday', true ) : '',
				'label' => __( 'Fecha de nacimiento', $this->get_text_domain() ),
				'required' => true
			)
		);

		$sex = $this->user_id ? get_user_meta( $this->user_id, 'elite_sex', true ) : '';
		$sex_field = $this->add_select(
			'sex',
			array(
				'label' => __( 'Sexo', $this->get_text_domain() ),
				'required' => true
			)
		);
		$sex_field->add_option(
			'm',
			__( 'Mujer', $this->get_text_domain() ),
			array(
				'selected' => $sex == 'm'
			)
		);
		$sex_field->add_option(
			'v',
			__( 'Varón', $this->get_text_domain() ),
			array(
				'selected' => $sex == 'v'
			)
		);

		$this->add_heading( array( 'content' => __( 'Photos', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_ajax_upload_image_cropper_field(
			'front_photo',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'front_photo', true ) : '',
				'label' => __( 'Front photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 3 * 2097152
			)
		);

		$this->add_ajax_upload_image_cropper_field(
			'profile_photo',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'profile_photo', true ) : '',
				'label' => __( 'Profile photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 3 * 2097152
			)
		);

		if( !$this->user_id && empty( $_POST['member_id'] ) )
		{
			EpointPersonalTrainer::load_personal_info_management();

			$this->add_heading( array(
				'content' => 'Cuestionario personal'
			) );
			$objective_group = $this->add_checkbox_group(
				'objectives',
				array(
					'label' => __( '¿Objetivos por los cuales decides hacer deporte?', $this->get_text_domain() ),
					'required' => true
				)
			);

			$objectives = EpointPersonalTrainerPersonalInfo::get_available_objectives();
			foreach( $objectives as $key => $label )
				$objective_group->add_checkbox( array(
					'value' => $key,
					'label' => $label
				) );
				

			$this->add_yes_no_radio_group(
				'injured',
				array(
					'required' => true,
					'label' => __( '¿Has tenido alguna lesión?', $this->get_text_domain() )
				)
			);

			$this->add_text_field(
				'illness',
				array(
					'value' => '',
					'label' => __( '¿Tienes alguna patología o enfermedad?', $this->get_text_domain() ),
					'maxlength' => 100,
					'required' => true
				)
			);

			$this->add_text_field(
				'medication',
				array(
					'value' => '',
					'label' => __( '¿Estás tomando alguna mediación y para qué?', $this->get_text_domain() ),
					'maxlength' => 100,
					'required' => true
				)
			);

			$tension_field = $this->add_radio_group(
				'tension',
				array(
					'required' => true,
					'label' => __( '¿Tu tesión es...?', $this->get_text_domain() )
				)
			);
			$tension_field->add_radiobutton( array(
				'value' => 'low',
				'label' => __( 'Baja', $this->get_text_domain() )
			) );
			$tension_field->add_radiobutton( array(
				'value' => 'medium',
				'label' => __( 'Media', $this->get_text_domain() )
			) );
			$tension_field->add_radiobutton( array(
				'value' => 'high',
				'label' => __( 'Alta', $this->get_text_domain() )
			) );


			$this->add_yes_no_radio_group(
				'do_sport',
				array(
					'required' => true,
					'label' => __( '¿Prácticas deporte actualmente?', $this->get_text_domain() )
				)
			);

			$sport_field = $this->add_select(
				'sport',
				array(
					'label' => __( '¿Que deporte practicas?', $this->get_text_domain() ),
					'required' => false
				)
			);
			$sport_field->add_option( 'none', 'Ninguno' );
			$sport_field->add_option( 'athletics', 'Atletismo' );
			$sport_field->add_option( 'swimming', 'Natación' );
			$sport_field->add_option( 'footbal', 'Fútbol' );
			$sport_field->add_option( 'gymnastics', 'Gimnasia' );
			$sport_field->add_option( 'tennis', 'Tenis' );
			$sport_field->add_option( 'padel', 'Padel' );
			$sport_field->add_option( 'contact', 'De contacto' );
			$sport_field->add_option( 'golf', 'Golf' );
			$sport_field->add_option( 'climb', 'Escalada' );
			$sport_field->add_option( 'trekking', 'Senderismo' );
			$sport_field->add_option( 'other', 'Otro' );

			$this->add_text_field(
				'other_sport',
				array(
					'value' => '',
					'label' => __( 'Concreta el deporte', $this->get_text_domain() ),
					'class' => 'form-control other-sport-field',
					'maxlength' => 100,
					'required' => false
				)
			);

			$this->add_text_field(
				'when_sport',
				array(
					'value' => '',
					'label' => __( '¿Cuánto tiempo llevas practicándolo?', $this->get_text_domain() ),
					'maxlength' => 100,
					'required' => true
				)
			);

			$this->add_text_field(
				'frequency_sport',
				array(
					'value' => '',
					'label' => __( '¿Con qué frecuencia?', $this->get_text_domain() ),
					'maxlength' => 100,
					'required' => true
				)
			);

			$this->add_number_field(
				'frequency_training',
				array(
					'value' => 1,
					'label' => __( '¿Cuántos días podrías entrenar a la semana?', $this->get_text_domain() ),
					'required' => true,
					'min' => 1,
					'max' => 7,
					'step' => 1
				)
			);

			$this->add_number_field(
				'available_hours',
				array(
					'value' => 1,
					'label' => __( '¿De cuántas horas dispones al día?', $this->get_text_domain() ),
					'required' => true,
					'min' => 1,
					'max' => 24,
					'step' => 1
				)
			);

			$occupation_field = $this->add_radio_group(
				'occupation',
				array(
					'required' => true,
					'label' => __( '¿Actualmente trabajas o estudias?', $this->get_text_domain() )
				)
			);
			$occupation_field->add_radiobutton( array(
				'value' => 'work',
				'label' => __( 'Trabajo', $this->get_text_domain() )
			) );
			$occupation_field->add_radiobutton( array(
				'value' => 'study',
				'label' => __( 'Estudio', $this->get_text_domain() )
			) );

			$occupation_type_field = $this->add_radio_group(
				'occupation_type',
				array(
					'required' => true,
					'label' => __( '¿Tu trabajo es activo o sedentario?', $this->get_text_domain() )
				)
			);
			$occupation_type_field->add_radiobutton( array(
				'value' => 'active',
				'label' => __( 'Activo', $this->get_text_domain() )
			) );
			$occupation_type_field->add_radiobutton( array(
				'value' => 'sedentary',
				'label' => __( 'Sedentario', $this->get_text_domain() )
			) );

			$this->add_number_field(
				'sleep_hours',
				array(
					'value' => 8,
					'label' => __( '¿Cuántas horas duermes al día?', $this->get_text_domain() ),
					'required' => true,
					'min' => 1,
					'max' => 24,
					'step' => 1
				)
			);

			$this->add_yes_no_radio_group(
				'feed',
				array(
					'required' => true,
					'label' => __( '¿Llevas una buena alimentación?', $this->get_text_domain() )
				)
			);

			$this->add_number_field(
				'feed_frequency',
				array(
					'value' => 3,
					'label' => __( '¿Cuántas veces comes al día?', $this->get_text_domain() ),
					'required' => true,
					'min' => 1,
					'max' => 10,
					'step' => 1
				)
			);
		}

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);

		$this->add_submit_button(
			'saveandnew',
			array(
				'label' => __( 'Save and add new', $this->get_text_domain() )
			)
		);
	}

	protected function enqueue_custom_public_scripts()
	{
		wp_enqueue_script(
			'epoint-personal-trainer-edit-member-full-form-script',
			plugins_url( 'js/edit-member-full.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
	}

	protected function process_personal_questionnaire( $user )
	{
		$user_id = $user->ID;

		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'objectives', $this->get_field_by_name( 'objectives' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'injured', $this->get_field_by_name( 'injured' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'illness', $this->get_field_by_name( 'illness' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'medication', $this->get_field_by_name( 'medication' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'tension', $this->get_field_by_name( 'tension' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'do_sport', $this->get_field_by_name( 'do_sport' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'sport', $this->get_field_by_name( 'sport' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'other_sport', $this->get_field_by_name( 'other_sport' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'when_sport', $this->get_field_by_name( 'when_sport' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'frequency_sport', $this->get_field_by_name( 'frequency_sport' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'frequency_training', $this->get_field_by_name( 'frequency_training' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'available_hours', $this->get_field_by_name( 'available_hours' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'occupation', $this->get_field_by_name( 'occupation' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'occupation_type', $this->get_field_by_name( 'occupation_type' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'sleep_hours', $this->get_field_by_name( 'sleep_hours' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'feed', $this->get_field_by_name( 'feed' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'feed_frequency', $this->get_field_by_name( 'feed_frequency' )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'filled', 'yes' );
	}

	protected function process_form()
	{
		$user_id = $this->get_field_by_name( 'member_id' )->get_value();

		if( is_numeric( $user_id ) )
			return $this->process_old_user( (int)$user_id );
		else
			return $this->process_new_user();

	}

	protected function process_new_user()
	{
		$user_email = $this->get_field_by_name( 'email' )->get_value();
		$user_name = $this->get_field_by_name( 'username' )->get_value();

		$user_password = $this->get_field_by_name( 'userp' )->get_value();

		if( !( $user = get_user_by( 'email', $user_email ) ) )
		{
			if( !username_exists( $user_name ) )
			{
				$password = !empty( $user_password ) ? $user_password : wp_generate_password();
				if( !( $user_id = wpmu_create_user( $user_name, $password, $user_email ) ) )
				{
					return array( array(
						'code' => self::FATAL_ERROR,
						'text' => __( 'There was an error creating the user account.', $this->get_text_domain() )
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
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'Given user email is already in use.', $this->get_text_domain() )
			) );
		}

		add_user_to_blog( get_current_blog_id(), $user->ID, EpointPersonalTrainer::SPORTSMAN_ROLE );

		$front_photo_field = $this->get_field_by_name( 'front_photo' );
		$profile_photo_field = $this->get_field_by_name( 'profile_photo' );
		update_user_meta( $user->ID, 'front_photo', $front_photo_field->get_value() );
		update_user_meta( $user->ID, 'profile_photo', $profile_photo_field->get_value() );

		$first_name = $this->get_field_by_name( 'firstname' )->get_value();
		$last_name = $this->get_field_by_name( 'lastname' )->get_value();
		$phone = $this->get_field_by_name( 'phone' )->get_value();
		update_user_meta( $user->ID, 'first_name', $first_name );
		update_user_meta( $user->ID, 'last_name', $last_name );

		wp_update_user( array( 'ID' => $user->ID, 'display_name' => $first_name . ' ' . $last_name ) );

		update_user_meta( $user->ID, 'phone', $phone );

		$birthday = $this->get_field_by_name( 'birthday' )->get_value();
		$sex = $this->get_field_by_name( 'sex' )->get_value();
		update_user_meta( $user->ID, 'elite_birthday', $birthday );
		update_user_meta( $user->ID, 'elite_sex', $sex );
		
		$this->process_personal_questionnaire( $user );
/*
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
		if( class_exists( 'EliteTrainerSiteTheme', false ) )
		{
			if( isset( $_POST['saveandnew'] ) )
			{
				wp_redirect( EliteTrainerSiteTheme::get_edit_member_url() );
				exit;
			}
			else
			{
				wp_redirect( EliteTrainerSiteTheme::get_members_list_url() );
				exit;
			}
		}
		else
		{
			return 'Miembro actualizado satisfactoriamente.';
		}

/*
		return __( 'Member created successfully', $this->get_text_domain() );

		if( $this->success_page_id )
		{
			$url = get_permalink( $this->success_page_id );
			wp_redirect( $url );
			exit;
		}
		else
		{
			return __( 'Member created successfully', $this->get_text_domain() );
		}
*/
	}

	protected function process_old_user( $user_id )
	{
		if( !( $user = get_user_by( 'ID', $user_id ) ) )
			return array( array(
				'code' => self::FORM_DATA_ERROR,
				'text' => __( 'The user does not exists.', $this->get_text_domain() )
			) );

		$front_photo_field = $this->get_field_by_name( 'front_photo' );
		$profile_photo_field = $this->get_field_by_name( 'profile_photo' );
		update_user_meta( $user->ID, 'front_photo', $front_photo_field->get_value() );
		update_user_meta( $user->ID, 'profile_photo', $profile_photo_field->get_value() );

		$first_name = $this->get_field_by_name( 'firstname' )->get_value();
		$last_name = $this->get_field_by_name( 'lastname' )->get_value();
		$phone = $this->get_field_by_name( 'phone' )->get_value();
		update_user_meta( $user->ID, 'first_name', $first_name );
		update_user_meta( $user->ID, 'last_name', $last_name );

		$update_args = array( 'ID' => $user->ID, 'display_name' => $first_name . ' ' . $last_name );
		
		$password = $this->get_field_by_name( 'userp' )->get_value();
		if( !empty( $password ) )
			$update_args['user_pass'] = $password;

		wp_update_user( $update_args );

		update_user_meta( $user->ID, 'phone', $phone );

		$birthday = $this->get_field_by_name( 'birthday' )->get_value();
		$sex = $this->get_field_by_name( 'sex' )->get_value();
		update_user_meta( $user->ID, 'elite_birthday', $birthday );
		update_user_meta( $user->ID, 'elite_sex', $sex );

		if( class_exists( 'EliteTrainerSiteTheme', false ) )
		{
			if( isset( $_POST['saveandnew'] ) )
			{
				wp_redirect( EliteTrainerSiteTheme::get_edit_member_url() );
				exit;
			}
			else
			{
				wp_redirect( EliteTrainerSiteTheme::get_members_list_url() );
				exit;
			}
		}
		else
		{
			return 'Miembro actualizado satisfactoriamente.';
		}
/*
		if( $this->success_page_id )
		{
			$url = get_permalink( $this->success_page_id );
			wp_redirect( $url );
			exit;
		}
		else
		{
			return __( 'Member updated successfully', $this->get_text_domain() );
		}
*/
	}

}

} // class_exists


