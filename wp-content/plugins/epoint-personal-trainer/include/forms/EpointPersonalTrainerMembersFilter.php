<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerMembersFilterForm' ) )
{

EpointPersonalTrainer::load_personal_info_management();

class JLCEpointPersonalTrainerMembersFilterForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_members_filter',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->class = 'search-members-form';

		//$this->add_honeypot();

		$this->add_text_field(
			'firstname',
			array(
				'value' => '',
				'label' => __( 'First name', $this->get_text_domain() ),
				'maxlength' => 30,
				'required' => false
			)
		);

		$this->add_text_field(
			'lastname',
			array(
				'value' => '',
				'label' => __( 'Last name', $this->get_text_domain() ),
				'maxlength' => 30,
				'required' => false
			)
		);

		$this->add_email_field(
			'email',
			array(
				'value' => '',
				'label' => __( 'Email', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_text_field(
			'phone',
			array(
				'value' => '',
				'label' => __( 'Phone', $this->get_text_domain() ),
				'maxlength' => 10,
				'required' => false
			)
		);

		$sex_field = $this->add_select(
			'sex',
			array(
				'label' => __( 'Sexo', $this->get_text_domain() ),
				'required' => false
			)
		);
		$sex_field->add_option(
			'',
			__( 'Cualquiera', $this->get_text_domain() )
		);
		$sex_field->add_option(
			'm',
			__( 'Mujer', $this->get_text_domain() )
		);
		$sex_field->add_option(
			'v',
			__( 'Varón', $this->get_text_domain() )
		);

		$this->add_date_field(
			'from',
			array(
				'value' => '',
				'label' => __( 'Fecha de nacimiento (desde)', $this->get_text_domain() ),
				'required' => false
			)
		);
		$this->add_date_field(
			'to',
			array(
				'value' => '',
				'label' => __( 'Fecha de nacimiento (hasta)', $this->get_text_domain() ),
				'required' => false
			)
		);

		$objective_group = $this->add_checkbox_group(
			'objectives',
			array(
				'label' => __( '¿Objetivos por los cuales hace deporte?', $this->get_text_domain() ),
				'required' => false
			)
		);
		$objectives = EpointPersonalTrainerPersonalInfo::get_available_objectives();
		foreach( $objectives as $key => $label )
			$objective_group->add_checkbox( array(
				'value' => $key,
				'label' => $label
			) );

		$sport_field = $this->add_select(
			'sport',
			array(
				'label' => __( 'Deporte practicado', $this->get_text_domain() ),
				'required' => false
			)
		);
		$sport_field->add_option( '', 'Cualquiera' );
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

		$occupation_type_field = $this->add_radio_group(
			'occupation_type',
			array(
				'required' => false,
				'label' => __( 'Tipo de ocupación', $this->get_text_domain() )
			)
		);
		$occupation_type_field->add_radiobutton( array(
			'value' => '',
			'label' => __( 'Cualquiera', $this->get_text_domain() ),
			'checked' => true
		) );
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
				//'value' => isset( $personal_info_attr['sleep_hours'] ) ? (int)$personal_info_attr['sleep_hours'] : 8,
				'label' => __( 'Horas de sueño diarias', $this->get_text_domain() ),
				'required' => false,
				'min' => 1,
				'max' => 24,
				'step' => 1
			)
		);

		$feed_field = $this->add_yes_no_radio_group(
			'feed',
			array(
				'required' => false,
				'label' => __( '¿Lleva una buena alimentación?', $this->get_text_domain() ),
				//'value' => isset( $personal_info_attr['feed'] ) && $personal_info_attr['feed'] == 'yes'
			)
		);
		$feed_field->add_radiobutton( array(
			'value' => '',
			'label' => 'Cualquiera',
			'checked' => true
		) );

		$this->add_number_field(
			'feed_frequency',
			array(
				//'value' => isset( $personal_info_attr['feed_frequency'] ) ? (int)$personal_info_attr['feed_frequency'] : 3,
				'label' => __( 'Número de comidas diarias', $this->get_text_domain() ),
				'required' => false,
				'min' => 1,
				'max' => 10,
				'step' => 1
			)
		);

		$suplements_use_field = $this->add_yes_no_radio_group(
			'suplements_use',
			array(
				'required' => false,
				'label' => __( '¿Toma suplementos alimenticios?', $this->get_text_domain() ),
				//'value' => isset( $personal_info_attr['suplements_use'] ) && $personal_info_attr['suplements_use'] == 'yes'
			)
		);
		$suplements_use_field->add_radiobutton( array(
			'value' => '',
			'label' => 'Cualquiera',
			'checked' => true
		) );
		
		$suplements_field = $this->add_select(
			'suplements',
			array(
				'label' => __( '¿Qué suplementos toma?', $this->get_text_domain() ),
				'required' => false
			)
		);
		$suplements_field->add_option( '', 'Ninguno' );
		foreach( EpointPersonalTrainerPersonalInfo::get_available_suplements() as $key => $label )
			$suplements_field->add_option( $key, $label, array( 'selected' => isset( $personal_info_attr['suplements'] ) && $personal_info_attr['suplements'] == $key ) );
/*
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


		$this->add_heading( array( 'content' => __( 'Photos', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_ajax_upload_image_field(
			'front_photo',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'front_photo', true ) : '',
				'label' => __( 'Front photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);

		$this->add_ajax_upload_image_field(
			'profile_photo',
			array(
				'value' => $this->user_id ? get_user_meta( $this->user_id, 'profile_photo', true ) : '',
				'label' => __( 'Profile photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
*/
		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Filter', $this->get_text_domain() )
			)
		);

		$this->add_html( array(
			'content' => '<input class="btn btn-primary" type="reset" />',
			'kses' => false,
			'html_wrapped' => false
		) );

	}

	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'epoint-personal-trainer-members-filter-form-script',
			plugins_url( 'js/members-filter.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);

	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();
	}

	protected function generate_table( $users )
	{
		$table_template = locate_template( implode( DIRECTORY_SEPARATOR, array( 'templates', 'members', 'members-table.php' ) ) );

		if( !$table_template )
			$table_template = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'members-table.php' ) );

		ob_start();
		include( $table_template );
		return ob_get_clean();
	}

	protected function process_form()
	{
		$first_name = $this->get_field_by_name( 'firstname' )->get_value();
		$last_name = $this->get_field_by_name( 'lastname' )->get_value();
		$email = $this->get_field_by_name( 'email' )->get_value();
		$phone = $this->get_field_by_name( 'phone' )->get_value();
		$sex = $this->get_field_by_name( 'sex' )->get_value();

		$from = $this->get_field_by_name( 'from' )->get_value();
		$to = $this->get_field_by_name( 'to' )->get_value();

		$sport = $this->get_field_by_name( 'sport' )->get_value();
		$objectives = $this->get_field_by_name( 'objectives' )->get_value();
		$occupation_type = $this->get_field_by_name( 'occupation_type' )->get_value();

		$feed = $this->get_field_by_name( 'feed' )->get_value();
		$feed_frequency = $this->get_field_by_name( 'feed_frequency' )->get_value();

		$suplements_use = $this->get_field_by_name( 'suplements_use' )->get_value();
		$suplements = $this->get_field_by_name( 'suplements' )->get_value();
		
		$personal_questionnaire_params = array();
		if( !empty( $sport ) )
			$personal_questionnaire_params[EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'sport'] = $sport;
		if( !empty( $objectives ) )
			$personal_questionnaire_params[EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'objectives'] = $objectives;
		if( !empty( $occupation_type ) )
			$personal_questionnaire_params[EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'occupation_type'] = $occupation_type;
		if( !empty( $feed ) )
			$personal_questionnaire_params[EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'feed'] = $feed;
		if( !empty( $feed_frequency ) )
			$personal_questionnaire_params[EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'feed_frequency'] = $feed_frequency;
		if( !empty( $suplements_use ) )
			$personal_questionnaire_params[EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'suplements_use'] = $suplements_use;
		if( !empty( $suplements ) )
			$personal_questionnaire_params[EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'suplements'] = $suplements;
			

		$members = EpointPersonalTrainerMapper::search_members(
			$first_name,
			$last_name,
			$email,
			$phone,
			$sex,
			$from,
			$to,
			$personal_questionnaire_params
		);

		$table = $this->generate_table( $members );

		if( $this->ajax )
		{
			$response = new WP_Ajax_Response( array(
				'what' => 'html',
				'action' => 'refreshMembersTable',
				'id' => 1,
				'data' => $table
			) );
			$response->send();
		}
		else
		{
			if( class_exists( 'EliteTrainerSiteTheme', false ) )
			{
				wp_redirect( EliteTrainerSiteTheme::get_members_list_url() );
			}
			else
			{
				return 'Lista actualizada.';
			}
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


}

} // class_exists



