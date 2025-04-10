<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditTrainingForm' ) )
{

class JLCEpointPersonalTrainerEditTrainingForm extends JLCCustomForm
{
	protected $is_editable_training;
	protected $training_id;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$training_id = isset( $args['training'] ) ? $args['training'] : null;
		if( !empty( $_POST['training'] ) )
			$training_id = (int)$_POST['training'];

		$this->training_id = $training_id;

		$training = $training_id ? EpointPersonalTrainerMapper::get_training( $training_id ) : null;
		$readonly = $training && ( !$training->trainer || $training->trainer != get_current_user_id() );
		$this->is_editable_training = !$readonly;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_training',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'edit-training-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'training',
			array(
				'value' => $training_id
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $training ? $training->name : '',
				'label' => __( 'Name', $this->get_text_domain() ),
				'maxlength' => 100,
				'readonly' => $readonly,
				'required' => true
			)
		);
/*
		$this->add_number_field(
			'position',
			array(
				'value' => 0,
				'label' => __( 'Position', $this->get_text_domain() ),
				'max' => 9999999999,
				'min' => 0,
				'required' => true
			)
		);
*/
/*
		$this->add_checkbox_field(
			'active',
			array(
				'value' => 'yes',
				'label' => __( 'Active', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $training && $training->active
			)
		);
*/
		$this->add_heading(
			array(
				'content' => __( 'Objetivos', $this->get_text_domain() )
			)
		);

		$objectives = EpointPersonalTrainerMapper::get_trainer_objectives( get_current_user_id() );
		foreach( $objectives as $objective )
			$this->add_checkbox_field(
				'objective_' . esc_attr( $objective->ID ),
				array(
					'value' => 'yes',
					'label' => $objective->name,
					'required' => false,
					'readonly' => $readonly,
					'checked' => $training && EpointPersonalTrainerMapper::is_training_objective( $training->ID, $objective->ID )
				)
			);
/*
		$this->add_checkbox_field(
			'objective_volume',
			array(
				'value' => 'yes',
				'label' => __( 'Volumen', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $training && $training->objective_volume
			)
		);
		$this->add_checkbox_field(
			'objective_maintenance',
			array(
				'value' => 'yes',
				'label' => __( 'Mantenimiento', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $training && $training->objective_maintenance
			)
		);
		$this->add_checkbox_field(
			'objective_definition',
			array(
				'value' => 'yes',
				'label' => __( 'Definición', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $training && $training->objective_definition
			)
		);
*/

		$this->add_heading(
			array(
				'content' => __( 'Entorno', $this->get_text_domain() )
			)
		);

		$environments = EpointPersonalTrainerMapper::get_trainer_environments( get_current_user_id() );
		foreach( $environments as $environment )
			$this->add_checkbox_field(
				'environment_' . esc_attr( $environment->ID ),
				array(
					'value' => 'yes',
					'label' => $environment->name,
					'required' => false,
					'readonly' => $readonly,
					'checked' => $training && EpointPersonalTrainerMapper::is_training_environment( $training->ID, $environment->ID )
				)
			);
/*
		$this->add_checkbox_field(
			'environment_house',
			array(
				'value' => 'yes',
				'label' => __( 'Casa', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $training && $training->environment_house
			)
		);
		$this->add_checkbox_field(
			'environment_outdoors',
			array(
				'value' => 'yes',
				'label' => __( 'Exterior', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $training && $training->environment_outdoors
			)
		);
		$this->add_checkbox_field(
			'environment_gym',
			array(
				'value' => 'yes',
				'label' => __( 'Gimnasio', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $training && $training->environment_gym
			)
		);
*/

		$this->add_textarea_field(
			'description',
			array(
				'value' => $training ? $training->description : '',
				'label' => __( 'Description', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false
			)
		);

		$this->add_html( array(
			'content' => '<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/vimeo.png" alt="vimeo" /></a></div>'
		) );
		$this->add_text_field(
			'video',
			array(
				'value' => $training ? $training->video : '',
				'label' => __( 'Video', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'help' => __( 'Pega aquí el enlace que aparece en "Compartir"', $this->get_text_domain() )
			)
		);


/*
		$this->add_upload_field(
			'profile_photo',
			array(
				'value' => '',
				'label' => __( 'Profile photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
*/
		$this->add_hidden_field(
			'exercises',
			array(
				'value' => json_encode( $this->get_current_exercises_data( $training_id ) )
			)
		);

		$this->add_html( array(
			'content' => $this->get_training_exercises_editor( $training_id ),
			'kses' => false
		) );

		if( !$readonly )
			$this->add_submit_button(
				'send',
				array(
					'label' => __( 'Save', $this->get_text_domain() )
				)
			);
	}

	protected static function get_current_exercises_data( $training_id )
	{
		$ret = array();
		$exercises = EpointPersonalTrainerMapper::get_training_exercises_data( $training_id );
		if( is_array( $exercises ) )
		{
			foreach( $exercises as $ex )
				$ret[] = array(
					'exercise' => $ex->exercise_id,
					'position' => $ex->position,
					'description' => $ex->description,
					'series' => $ex->series,
					'repetitions' => $ex->repetitions,
					'loads' => $ex->loads
				);
		}

		return $ret;
	}


	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'epoint-personal-trainer-exit-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);

		wp_enqueue_script(
			'epoint-personal-trainer-edit-training-form-script',
			plugins_url( 'js/edit-training.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);

		wp_localize_script(
			'epoint-personal-trainer-edit-training-form-script',
			'EpointPersonalTrainerEditTrainingNS',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'getTrainingExercisesAction' => EpointPersonalTrainerPublic::GET_TRAINING_EXERCISES_ACTION
			)
		);
	}

	public function print_public_form( $hide_messages = false )
	{
		if( $this->is_editable_training )
		{
			parent::print_public_form( $hide_messages );
			$this->enqueue_scripts();

			add_action( 'wp_footer', array( $this, 'print_exercise_selector' ) );
		}
		else
		{
			if( $this->training_id && ( $training = EpointPersonalTrainerMapper::get_training( $this->training_id ) ) )
			{
				$objectives_names = EpointPersonalTrainerMapper::get_training_objectives_names( $training->ID );
				$environments_names = EpointPersonalTrainerMapper::get_training_environments_names( $training->ID );
				$exercise_categories = EpointPersonalTrainer::get_training_exercises_categorized( $training->ID );

				$template = locate_template( 'epoint-personal-trainer/training-no-editable.php' );
				if( !$template )
					$template = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates/training-no-editable.php' ) );

				include( $template );
			}
		}
	}

	protected function get_training_exercises_editor( $training_id )
	{
		$exercises_data = EpointPersonalTrainerMapper::get_training_exercises( $training_id );
		$categories = array();
		foreach( $exercises_data as $e )
		{
			$cats = EpointPersonalTrainerMapper::get_exercise_related_categories( $e->ID, true );
			foreach( $cats as $c )
			{
				if( !array_key_exists( $c, $categories ) )
				{
					$cat = EpointPersonalTrainerMapper::get_exercise_category( $c );
					$categories[$c] = array(
						'name' => $cat->name,
						'exercises' => array()
					);
				}

				if( !in_array( $e->ID, $categories[$c] ) )
				{
					$categories[$c]['exercises'][] = $e->ID;
					break;
				}
			}
		}

/*
Quiza haya que acabar esto para ordenar las cosas
		uasort( $categories, function( $a, $b ) )
		{
			$max_a = 0;
			$max_b = 0;
			foreach( $a['exercises'] as $ex
		}
*/

		ob_start();
		include implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'training-exercises-editor.php' ) );
		return ob_get_clean();
	}

	public function print_exercise_selector()
	{
		$template = locate_template( implode( DIRECTORY_SEPARATOR, array( 'epoint-personal-trainer', 'exercise-selector.php' ) ) );

		if( !$template )
			$template = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-selector.php' ) );

		include( $template );
	}

	protected function get_exercise_image( $exercise, $image_type )
	{
		if( !$exercise )
			return null;

		if( is_int( $exercise ) )
			$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise );

		$image_id = null;
		switch( $image_type )
		{
			case 'start':
				$image_id = $exercise->image_start;
				break;
			case 'end':
				$image_id = $exercise->image_end;
				break;
			default:
		}

		if( !$exercise->trainer )
			switch_to_blog( 1 );

		$url = wp_get_attachment_url( $image_id );

		if( !$exercise->trainer )
			restore_current_blog();

		return !empty( $url ) ? $url : get_template_directory_uri() . '/img/buttons/exercises.svg';
	}

	protected function process_form()
	{
		if( !$this->is_editable_training )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this training.', $this->get_text_domain() ) )
			);

		$training_id = $this->get_field_by_name( 'training' )->get_value();
		$training_id = $training_id && is_numeric( $training_id ) ? (int)$training_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();
		$description = stripslashes( $this->get_field_by_name( 'description' )->get_value() );
		$video = $this->get_field_by_name( 'video' )->get_value();
/*
		$objective_volume = $this->get_field_by_name( 'objective_volume' )->is_checked();
		$objective_maintenance = $this->get_field_by_name( 'objective_maintenance' )->is_checked();
		$objective_definition = $this->get_field_by_name( 'objective_definition' )->is_checked();

		$environment_house = $this->get_field_by_name( 'environment_house' )->is_checked();
		$environment_outdoors = $this->get_field_by_name( 'environment_outdoors' )->is_checked();
		$environment_gym = $this->get_field_by_name( 'environment_gym' )->is_checked();
*/
		$objectives_arr = array();
		$objectives = EpointPersonalTrainerMapper::get_trainer_objectives( get_current_user_id() );
		foreach( $objectives as $objective )
		{
			$objective_field = $this->get_field_by_name( 'objective_' . esc_attr( $objective->ID ) );
			if( $objective_field && $objective_field->is_checked() )
				$objectives_arr[ $objective->ID ] = array(
					'objective' => $objective->ID
				);
		}

		$environments_arr = array();
		$environments = EpointPersonalTrainerMapper::get_trainer_environments( get_current_user_id() );
		foreach( $environments as $environment )
		{
			$environment_field = $this->get_field_by_name( 'environment_' . esc_attr( $environment->ID ) );
			if( $environment_field && $environment_field->is_checked() )
				$environments_arr[ $environment->ID ] = array(
					'environment' => $environment->ID
				);
		}

		$exercises = $this->get_field_by_name( 'exercises' )->get_value();
		$exercises = stripslashes( $exercises );
		$exercises = json_decode( $exercises, true );
		if( !is_array( $exercises ) )
			$exercises = array();
		$ex_arr = array();
		foreach( $exercises as $ex )
			if( !empty( $ex['exercise'] ) && isset( $ex['position'] ) && isset( $ex['description'] ) && isset( $ex['series'] ) && isset( $ex['repetitions'] ) && isset( $ex['loads'] ) )
				$ex_arr[(int)$ex['exercise']] = $ex;

		if( !$training_id )
		{
/*
			$training_id = EpointPersonalTrainerMapper::create_training(
				$name,
				$position,
				$active ? 1 : 0,
				$description,
				null,//$start
				null,//$end
				$objective_volume,
				$objective_maintenance,
				$objective_definition,
				$environment_house,
				$environment_outdoors,
				$environment_gym,
				null,//$user
				get_current_user_id(),
				$ex_arr//array()//$exercises
			);
*/
			$training_id = EpointPersonalTrainerMapper::create_training(
				$name,
				$position,
				$active ? 1 : 0,
				$description,
				null,//$start
				null,//$end
				null,//$user
				get_current_user_id(),
				$ex_arr,//array()//$exercises
				$objectives_arr,
				$environments_arr
			);

			if( !$training_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The training could not be created.', $this->get_text_domain() ) )
				);

			EpointPersonalTrainerMapper::set_training_video( $training_id, $video );
			

			// ajax no ha sido utilizado para nada (aun)
			if( $this->ajax )
			{
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array( 'name' => 'addtraining', 'args' => array( 'training' => $training_id ) ) )
				) );
				$response->send();
			}
			else
			{
				return 'Entrenamiento creado satisfactoriamente';
			}
		}
		else
		{
			$training = EpointPersonalTrainerMapper::get_training( $training_id );
			if( !$training )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The training can not be edited.', $this->get_text_domain() ) )
				);
/*
			$updated = EpointPersonalTrainerMapper::update_training(
				$training_id,
				$name,
				$position,
				$active ? 1 : 0,
				$description,
				null,//$start
				null,//$end
				$objective_volume,
				$objective_maintenance,
				$objective_definition,
				$environment_house,
				$environment_outdoors,
				$environment_gym,
				$training->user,//$user
				get_current_user_id(),
				$ex_arr//array()//$exercises
			);
*/
			$updated = EpointPersonalTrainerMapper::update_training(
				$training_id,
				$name,
				$position,
				$active ? 1 : 0,
				$description,
				$training->start,//$start
				$training->end,//$end
				$training->user,//$user
				get_current_user_id(),
				$ex_arr,//array()//$exercises
				$objectives_arr,
				$environments_arr
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The training could not be saved.', $this->get_text_domain() ) )
				);

			EpointPersonalTrainerMapper::set_training_video( $training_id, $video );

			$training = EpointPersonalTrainerMapper::get_training( $training_id );

			if( $training->user && ( $member = get_user_by( 'ID', $training->user ) ) && EpointPersonalTrainerAlerts::must_sent_member_new_training_alert() )
			{
				EpointPersonalTrainerAlerts::send_member_modified_training_alert( $member->user_email, $member->display_name, $training );
			}

			if( $this->ajax )
			{
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array( 'name' => 'updatetraining', 'args' => array( 'training' => $training_id ) ) )
				) );
				$response->send();
			}
			else
			{
				if( class_exists( 'EliteTrainerSiteTheme', false ) )
				{
					if( $training->user )
					{
						wp_redirect( EliteTrainerSiteTheme::get_view_member_training_url( $training->user ) );
						exit;
						
					}

					setCookie( EliteTrainerSiteTheme::TRAINING_TAB_COOKIE, $training->user ? '#user-training' : '#my-training-templates', time() + 24*60*60*1000, '/' );
					setCookie( EliteTrainerSiteTheme::TRAINING_LAST_DUPLICATED_COOKIE, $training->ID, time() + 24*60*60*1000, '/' );
					wp_redirect( EliteTrainerSiteTheme::get_training_list_url() );
					exit;
				}
				else
				{
					return 'Entrenamiento actualizado satisfactoriamente.';
				}
			}
		}


		return __( 'There was an error.', $this->get_text_domain() );
	}


}

} // class_exists

