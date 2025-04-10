<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerPersonalQuestionnaireForm' ) )
{

EpointPersonalTrainer::load_personal_info_management();

class JLCEpointPersonalTrainerPersonalQuestionnaireForm extends JLCCustomForm
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
			'epoint_personal_trainer_personal_questionnaire',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$personal_info = new EpointPersonalTrainerPersonalInfo( get_current_user_id() );
		$personal_info_attr = $personal_info->get_attributes();

		$this->add_ajax_upload_image_cropper_field(
			'front_photo',
			array(
				'value' => get_user_meta( get_current_user_id(), 'front_photo', true ),
				'label' => __( 'Front photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 12 * 524288
			)
		);

		$this->add_ajax_upload_image_cropper_field(
			'profile_photo',
			array(
				'value' => get_user_meta( get_current_user_id(), 'profile_photo', true ),
				'label' => __( 'Profile photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 12 * 524288
			)
		);

		//$this->add_honeypot();
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
				'label' => $label,
				'checked' => isset( $personal_info_attr['objectives'] ) && is_array( $personal_info_attr['objectives'] ) && in_array( $key, $personal_info_attr['objectives'] )
			) );
			

/*
		$objective_group->add_checkbox( array(
			'value' => 'health',
			'label' => __( 'Salud', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'lose_fat',
			'label' => __( 'Perder grasa corporal', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'remove_tension',
			'label' => __( 'Eliminar tensiones', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'postural_improvement',
			'label' => __( 'Mejoramiento postural', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'physical_improvement',
			'label' => __( 'Mejorar físicamente', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'gain_muscle',
			'label' => __( 'Aumentar masa muscular', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'strength_or_power',
			'label' => __( 'Fuerza o potencia', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'lose_volume',
			'label' => __( 'Reducir volumen', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'injury_recovery',
			'label' => __( 'Recuperación de lesión', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'physical_resistance',
			'label' => __( 'Resistencia física', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'oppositions',
			'label' => __( 'Oposiciones', $this->get_text_domain() )
		) );
		$objective_group->add_checkbox( array(
			'value' => 'other',
			'label' => __( 'Otro', $this->get_text_domain() )
		) );
*/

		$this->add_yes_no_radio_group(
			'injured',
			array(
				'required' => true,
				'label' => __( '¿Has tenido alguna lesión?', $this->get_text_domain() ),
				'value' => isset( $personal_info_attr['injured'] ) && $personal_info_attr['injured'] == 'yes'
			)
		);
		$this->add_text_field(
			'injuries',
			array(
				'value' => isset( $personal_info_attr['injuries'] ) ? $personal_info_attr['injuries'] : '',
				'label' => __( '¿Qué lesiones has tenido?', $this->get_text_domain() ),
				'class' => 'form-control injuries-field',
				'maxlength' => 200,
				'required' => false
			)
		);

		$this->add_yes_no_radio_group(
			'illness',
			array(
				'label' => __( '¿Tienes alguna patología o enfermedad?', $this->get_text_domain() ),
				'required' => true,
				'value' => isset( $personal_info_attr['illness'] ) && $personal_info_attr['illness'] == 'yes'
			)
		);
		$this->add_text_field(
			'illness_list',
			array(
				'value' => isset( $personal_info_attr['illness_list'] ) ? $personal_info_attr['illness_list'] : '',
				'label' => __( '¿Qué enfermedades tienes?', $this->get_text_domain() ),
				'class' => 'form-control illness-list-field',
				'maxlength' => 100,
				'required' => false
			)
		);

		$this->add_yes_no_radio_group(
			'medication',
			array(
				'label' => __( '¿Estás tomando alguna mediación?', $this->get_text_domain() ),
				'required' => true,
				'value' => isset( $personal_info_attr['medication'] ) && $personal_info_attr['medication'] == 'yes'
			)
		);
		$this->add_text_field(
			'medication_list',
			array(
				'value' => isset( $personal_info_attr['medication_list'] ) ? $personal_info_attr['medication_list'] : '',
				'label' => __( '¿Qué medicaciones tomas y para qué?', $this->get_text_domain() ),
				'maxlength' => 100,
				'required' => false
			)
		);

		$this->add_yes_no_radio_group(
			'suplements_use',
			array(
				'required' => true,
				'label' => __( '¿Tomas suplementos alimenticios?', $this->get_text_domain() ),
				'value' => isset( $personal_info_attr['suplements_use'] ) && $personal_info_attr['suplements_use'] == 'yes'
			)
		);

		$suplements_field = $this->add_select(
			'suplements',
			array(
				'label' => __( '¿Que suplementos tomas?', $this->get_text_domain() ),
				'required' => false
			)
		);
		//$suplements_field->add_option( 'none', 'Ninguno' );
		foreach( EpointPersonalTrainerPersonalInfo::get_available_suplements() as $key => $label )
			$suplements_field->add_option( $key, $label, array( 'selected' => isset( $personal_info_attr['suplements'] ) && $personal_info_attr['suplements'] == $key ) );


		$this->add_text_field(
			'other_suplement',
			array(
				'value' => isset( $personal_info_attr['other_suplement'] ) ? $personal_info_attr['other_suplement'] : '',
				'label' => __( 'Concreta que suplemento', $this->get_text_domain() ),
				'class' => 'form-control other-suplement-field',
				'maxlength' => 100,
				'required' => false
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
			'label' => __( 'Baja', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['tension'] ) && $personal_info_attr['tension'] == 'low'
		) );
		$tension_field->add_radiobutton( array(
			'value' => 'medium',
			'label' => __( 'Media', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['tension'] ) && $personal_info_attr['tension'] == 'medium'
		) );
		$tension_field->add_radiobutton( array(
			'value' => 'high',
			'label' => __( 'Alta', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['tension'] ) && $personal_info_attr['tension'] == 'high'
		) );


		$this->add_yes_no_radio_group(
			'do_sport',
			array(
				'required' => true,
				'label' => __( '¿Prácticas deporte actualmente?', $this->get_text_domain() ),
				'value' => isset( $personal_info_attr['do_sport'] ) && $personal_info_attr['do_sport'] == 'yes'
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
		$sport_field->add_option( 'athletics', 'Atletismo', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'athletics' ) );
		$sport_field->add_option( 'swimming', 'Natación', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'swimming' ) );
		$sport_field->add_option( 'footbal', 'Fútbol', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'footbal' ) );
		$sport_field->add_option( 'gymnastics', 'Gimnasia', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'gymnastics' ) );
		$sport_field->add_option( 'tennis', 'Tenis', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'tennis' ) );
		$sport_field->add_option( 'padel', 'Padel', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'padel' ) );
		$sport_field->add_option( 'contact', 'De contacto', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'contact' ) );
		$sport_field->add_option( 'golf', 'Golf', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'golf' ) );
		$sport_field->add_option( 'climb', 'Escalada', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'climb' ) );
		$sport_field->add_option( 'trekking', 'Senderismo', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'trekking' ) );
		$sport_field->add_option( 'other', 'Otro', array( 'selected' => isset( $personal_info_attr['sport'] ) && $personal_info_attr['sport'] == 'other' ) );

		$this->add_text_field(
			'other_sport',
			array(
				'value' => isset( $personal_info_attr['other_sport'] ) ? $personal_info_attr['other_sport'] : '',
				'label' => __( 'Concreta el deporte', $this->get_text_domain() ),
				'class' => 'form-control other-sport-field',
				'maxlength' => 100,
				'required' => false
			)
		);

		$this->add_text_field(
			'when_sport',
			array(
				'value' => isset( $personal_info_attr['when_sport'] ) ? $personal_info_attr['when_sport'] : '',
				'label' => __( '¿Cuánto tiempo llevas practicándolo?', $this->get_text_domain() ),
				'maxlength' => 100,
				'required' => false//true
			)
		);

		$this->add_text_field(
			'frequency_sport',
			array(
				'value' => isset( $personal_info_attr['frequency_sport'] ) ? $personal_info_attr['frequency_sport'] : '',
				'label' => __( '¿Con qué frecuencia?', $this->get_text_domain() ),
				'maxlength' => 100,
				'required' => false//true
			)
		);

		$this->add_number_field(
			'frequency_training',
			array(
				'value' => isset( $personal_info_attr['frequency_training'] ) ? (int)$personal_info_attr['frequency_training'] : 1,
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
				'value' => isset( $personal_info_attr['available_hours'] ) ? (int)$personal_info_attr['available_hours'] : 1,
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
			'label' => __( 'Trabajo', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['occupation'] ) && $personal_info_attr['occupation'] == 'work'
		) );
		$occupation_field->add_radiobutton( array(
			'value' => 'study',
			'label' => __( 'Estudio', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['occupation'] ) && $personal_info_attr['occupation'] == 'study'
		) );
		$occupation_field->add_radiobutton( array(
			'value' => 'both',
			'label' => __( 'Ambas', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['occupation'] ) && $personal_info_attr['occupation'] == 'both'
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
			'label' => __( 'Activo', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['occupation_type'] ) && $personal_info_attr['occupation_type'] == 'active'
		) );
		$occupation_type_field->add_radiobutton( array(
			'value' => 'sedentary',
			'label' => __( 'Sedentario', $this->get_text_domain() ),
			'checked' => isset( $personal_info_attr['occupation_type'] ) && $personal_info_attr['occupation_type'] == 'sedentary'
		) );

		$this->add_number_field(
			'sleep_hours',
			array(
				'value' => isset( $personal_info_attr['sleep_hours'] ) ? (int)$personal_info_attr['sleep_hours'] : 8,
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
				'label' => __( '¿Llevas una buena alimentación?', $this->get_text_domain() ),
				'value' => isset( $personal_info_attr['feed'] ) && $personal_info_attr['feed'] == 'yes'
			)
		);

		$this->add_number_field(
			'feed_frequency',
			array(
				'value' => isset( $personal_info_attr['feed_frequency'] ) ? (int)$personal_info_attr['feed_frequency'] : 3,
				'label' => __( '¿Cuántas veces comes al día?', $this->get_text_domain() ),
				'required' => true,
				'min' => 1,
				'max' => 10,
				'step' => 1
			)
		);
			
		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Send', $this->get_text_domain() )
			)
		);
	}

	protected function enqueue_custom_public_scripts()
	{
		// Este script fue creado y es utilizado originalmente por el formulario EditMemberFull
		wp_enqueue_script(
			'epoint-personal-trainer-edit-member-full-form-script',
			plugins_url( 'js/edit-member-full.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);

		wp_enqueue_script(
			'epoint-personal-trainer-exit-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
	}

	protected function process_form()
	{
		if( !is_user_logged_in() || !is_user_member_of_blog() )
			return array( array(
				'code' => self::FATAL_ERROR,
				'text' => __( 'You are not member of this site.', $this->get_text_domain() )
			) );

		$user_id = get_current_user_id();

		$front_photo_field = $this->get_field_by_name( 'front_photo' );
		$profile_photo_field = $this->get_field_by_name( 'profile_photo' );
		update_user_meta( $user_id, 'front_photo', $front_photo_field->get_value() );
		update_user_meta( $user_id, 'profile_photo', $profile_photo_field->get_value() );

		if( $this->get_field_by_name( 'sport' )->get_value() != 'none' )
		{
			if( $this->get_field_by_name( 'when_sport' )->get_value() == '' )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Debes especificar cuando practicas deporte.', $this->get_text_domain() )
				) );

			if( $this->get_field_by_name( 'frequency_sport' )->get_value() == '' )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Debes especificar con que frecuencia practicas deporte.', $this->get_text_domain() )
				) );
		}

		if( $this->get_field_by_name( 'illness' )->get_value() === 'yes' )
		{
			if( $this->get_field_by_name( 'illness_list' )->get_value() == '' )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Debes especificar que enfermedades tienes.', $this->get_text_domain() )
				) );
		}

		if( $this->get_field_by_name( 'medication' )->get_value() === 'yes' )
		{
			if( $this->get_field_by_name( 'medication_list' )->get_value() == '' )
				return array( array(
					'code' => self::FATAL_ERROR,
					'text' => __( 'Debes especificar que medicamentos tomas.', $this->get_text_domain() )
				) );
		}

		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'objectives', $this->get_field_by_name( 'objectives' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'injured', $this->get_field_by_name( 'injured' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'injuries', $this->get_field_by_name( 'injuries' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'illness', $this->get_field_by_name( 'illness' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'illness_list', $this->get_field_by_name( 'illness_list' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'medication', $this->get_field_by_name( 'medication' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'medication_list', $this->get_field_by_name( 'medication_list' )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'suplements_use', $this->get_field_by_name( 'suplements_use' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'suplements', $this->get_field_by_name( 'suplements' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'other_suplement', $this->get_field_by_name( 'other_suplement' )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'tension', $this->get_field_by_name( 'tension' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'do_sport', $this->get_field_by_name( 'do_sport' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerPersonalInfo::PERSONAL_QUESTIONNAIRE_PREFIX . 'sport', $this->get_field_by_name( 'sport' )->get_value() );
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


		if( $this->success_page_id )
		{
			$url = get_permalink( $this->success_page_id );
			wp_redirect( $url );
			exit;
		}
		else
		{
			return __( 'Saved successfully', $this->get_text_domain() );
		}
	}


}

} // class_exists


