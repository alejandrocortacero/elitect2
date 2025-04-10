<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditDietForm' ) )
{

class JLCEpointPersonalTrainerEditDietForm extends JLCCustomForm
{
	protected $is_editable_diet;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$diet_id = isset( $args['diet'] ) ? $args['diet'] : null;
		$diet = $diet_id ? EpointPersonalTrainerMapper::get_diet( $diet_id ) : null;
		$readonly = $diet && ( !$diet->trainer || $diet->trainer != get_current_user_id() );
		$this->is_editable_training = !$readonly;


		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_diet',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'edit-diet-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'diet',
			array(
				'value' => $diet_id
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $diet ? $diet->name : '',
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

		$objectives = EpointPersonalTrainerMapper::get_trainer_diet_objectives( get_current_user_id() );
		foreach( $objectives as $objective )
			$this->add_checkbox_field(
				'objective_' . esc_attr( $objective->ID ),
				array(
					'value' => 'yes',
					'label' => $objective->name,
					'required' => false,
					'readonly' => $readonly,
					'checked' => $diet && EpointPersonalTrainerMapper::is_diet_objective( $diet->ID, $objective->ID )
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
				'content' => __( 'Restricciones', $this->get_text_domain() )
			)
		);

		$restrictions = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( get_current_user_id() );
		foreach( $restrictions as $restriction )
			$this->add_checkbox_field(
				'restriction_' . esc_attr( $restriction->ID ),
				array(
					'value' => 'yes',
					'label' => $restriction->name,
					'required' => false,
					'readonly' => $readonly,
					'checked' => $diet && EpointPersonalTrainerMapper::is_diet_restriction( $diet->ID, $restriction->ID )
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
		
		$this->add_html( array(
			'content' => '<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/vimeo.png" alt="vimeo" /></a></div> <div class="personal-training-diet-video-preview" style="margin-left:auto;margin-right:auto;width:100%;max-width:640px;"></div>'
		) );
		$video_field = $this->add_text_field(
			'video',
			array(
				'value' => $diet ? $diet->video : '',
				'label' => __( 'Video', $this->get_text_domain() ),
				'maxlength' => 200,
				'readonly' => $readonly,
				'required' => false,
				'help' => 'Inserta el enlace del vídeo'
			)
		);
/*
		$this->add_textarea_field(
			'description',
			array(
				'value' => $diet ? $diet->description : '',
				'label' => __( 'Descripción', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false
			)
		);
*/

		$this->add_textarea_field(
			'observations',
			array(
				'value' => $diet ? $diet->observations : '',
				'label' => __( 'Observaciones', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false
			)
		);

		$this->add_html( array(
			'content' => '<h3>Horario</h3>'
		) );

		$food_items = EpointPersonalTrainerMapper::get_blog_food_items( get_current_blog_id() );

		$ii = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3);

		$intervals = $diet_id ? EpointPersonalTrainerMapper::get_diet_intervals( $diet_id ) : null;
//var_dump( $intervals );die();

		$food_info = $diet && $diet->user ? get_user_meta( $diet->user, 'personal_trainer_food_questionnaire', true ) : null;

		foreach( $ii as $i )
		{
			$this->add_html( array(
				'content' => '<h4>' . sprintf( '%02d:00', $i ) . '</h4>'
			) );
			$select_field = $this->add_select(
				'interval_' . $i,
				array(
					'class' => 'diet-interval-select',
					'label' => 'Elegir alimentos',
					'readonly' => $readonly,
					'multiple' => true,
					'required' => false,
					'help' => 'Selecciona los alimentos que se tomarán a esta hora'
				)
			);

			if( empty( $food_info ) )
			{
				foreach( $food_items as $item )
				{
					$select_field->add_option(
						$item->ID,
						$item->name,
						array( 'selected' => !empty( $intervals[$i] ) && in_array( $item->ID, $intervals[$i]->food ) )
					);
				}
			}
			else
			{

				for( $ll = 10; $ll >= 1; $ll-- )
				{
					foreach( $food_items as $item )
					{
						if( isset( $food_info[$item->ID]['valuation'] ) && $ll == $food_info[$item->ID]['valuation'] )
						{
							$select_field->add_option(
								$item->ID,
								$item->name . ( isset( $food_info[$item->ID]['valuation'] ) ? ' (' . $food_info[$item->ID]['valuation'] . ')' : '' ),
								array( 'selected' => !empty( $intervals[$i] ) && in_array( $item->ID, $intervals[$i]->food ) )
							);
						}
					}
				}
			}

			$this->add_text_field(
				'text_interval_' . $i,
				array(
					'value' => !empty( $intervals[$i]->description ) ? $intervals[$i]->description : '',
					'label' => __( 'Editar toma', $this->get_text_domain() ),
					'maxlength' => 100,
					'readonly' => $readonly,
					'required' => false,
					'help' => 'Edita libremente el texto para esta hora'
				)
			);
		}

		if( $diet || !empty( $_POST ) )
			$this->add_checkbox_field(
				'duplicate',
				array(
					'value' => 'yes',
					'label' => __( 'Si desea que se genere un duplicado de esta dieta y se archive en "Mis Plantillas" dentro de su galería de dietas para usar en otras ocasiones, marque el recuadro. Este duplicado podrá ser modificado desde su zona de creación sin que se vea afectada la dieta original.', $this->get_text_domain() ),
					'required' => false,
					//'readonly' => $readonly,
					'checked' => false
				)
			);

		if( !$readonly )
			$this->add_submit_button(
				'send',
				array(
					'label' => __( 'Save', $this->get_text_domain() )
				)
			);
	}


	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'epoint-personal-trainer-select2-script',
			plugins_url( 'select2/js/select2.min.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
		wp_enqueue_style(
			'epoint-personal-trainer-select2-style',
			plugins_url( 'select2/css/select2.min.css', __FILE__ )
		);

		wp_enqueue_script(
			'epoint-personal-trainer-diet-intervals-script',
			plugins_url( 'js/diet-intervals.js', __FILE__ ),
			array( 'jquery', 'epoint-personal-trainer-select2-script' ),
			EpointPersonalTrainer::VERSION,
			true
		);

		wp_enqueue_script(
			'epoint-personal-trainer-diet-edit-video-script',
			plugins_url( 'js/diet-video.js', __FILE__ ),
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
/*
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
*/
	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();

//		add_action( 'wp_footer', array( $this, 'print_exercise_selector' ) );
	}

	protected function process_form()
	{
		if( !$this->is_editable_training )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this diet.', $this->get_text_domain() ) )
			);

		$diet_id = $this->get_field_by_name( 'diet' )->get_value();
		$diet_id = $diet_id && is_numeric( $diet_id ) ? (int)$diet_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();

		$description = '';
		//$description = $this->get_field_by_name( 'description' )->get_value();

		$observations = stripslashes( $this->get_field_by_name( 'observations' )->get_value() );

		$video = $this->get_field_by_name( 'video' )->get_value();

		$objectives_arr = array();
		$objectives = EpointPersonalTrainerMapper::get_trainer_diet_objectives( get_current_user_id() );
		foreach( $objectives as $objective )
		{
			$objective_field = $this->get_field_by_name( 'objective_' . esc_attr( $objective->ID ) );
			if( $objective_field && $objective_field->is_checked() )
				$objectives_arr[ $objective->ID ] = array(
					'objective' => $objective->ID
				);
		}

		$restrictions_arr = array();
		$restrictions = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( get_current_user_id() );
		foreach( $restrictions as $restriction )
		{
			$restriction_field = $this->get_field_by_name( 'restriction_' . esc_attr( $restriction->ID ) );
			if( $restriction_field && $restriction_field->is_checked() )
				$restrictions_arr[ $restriction->ID ] = array(
					'restriction' => $restriction->ID
				);
		}

		$intervals = array();
		$ii = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3);
		foreach( $ii as $i )
		{
			$food = $this->get_field_by_name( 'interval_' . $i )->get_value();
			$text = $this->get_field_by_name( 'text_interval_' . $i )->get_value();

			$interval = array();
			$interval['description'] = $text;
			$interval['food'] = $food;
			$intervals[$i] = $interval;
		}

		$duplicate_field = $this->get_field_by_name( 'duplicate' );
		$duplicate = $duplicate_field && $duplicate_field->is_checked();

		if( !$diet_id )
		{
			$diet_id = EpointPersonalTrainerMapper::create_diet(
				$name,
				$position,
				$active ? 1 : 0,
				$description,
				null,//$start
				null,//$end
				null,//$user
				get_current_user_id(),
				$intervals,//$ex_arr,//array()//$exercises
				$objectives_arr,
				$restrictions_arr
			);

			if( !$diet_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The diet could not be created.', $this->get_text_domain() ) )
				);

			EpointPersonalTrainerMapper::set_diet_video( $diet_id, $video );
			EpointPersonalTrainerMapper::set_diet_observations( $diet_id, $observations );

			if( $duplicate )
			{
				EpointPersonalTrainerMapper::duplicate_diet( $diet_id, get_current_user_id(), null );
			}
			

			// ajax no ha sido utilizado para nada (aun)
			if( $this->ajax )
			{
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array( 'name' => 'adddiet', 'args' => array( 'diet' => $diet_id ) ) )
				) );
				$response->send();
			}
			else
			{
				if( class_exists( 'EliteTrainerSiteTheme', false ) )
				{
					$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );

					setCookie( EliteTrainerSiteTheme::DIET_TAB_COOKIE, $diet->user ? '#user-diets' : '#my-diets-templates', time() + 24*60*60*1000, '/' );
					setCookie( EliteTrainerSiteTheme::DIET_LAST_DUPLICATED_COOKIE, $diet->ID, time() + 24*60*60*1000, '/' );
					wp_redirect( EliteTrainerSiteTheme::get_diets_list_url() );
					exit;
				}
				else
				{
					return 'Dieta creada satisfactoriamente';
				}
			}
		}
		else
		{
			$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );
			if( !$diet )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The diet can not be edited.', $this->get_text_domain() ) )
				);

			$updated = EpointPersonalTrainerMapper::update_diet(
				$diet_id,
				$name,
				$position,
				$active ? 1 : 0,
				$description,
				$diet->start,//$start
				$diet->end,//$end
				$diet->user,//$user
				$intervals,//$ex_arr,//array()//$exercises
				$objectives_arr,
				$restrictions_arr
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The diet could not be saved.', $this->get_text_domain() ) )
				);

			EpointPersonalTrainerMapper::set_diet_video( $diet_id, $video );
			EpointPersonalTrainerMapper::set_diet_observations( $diet_id, $observations );

			$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );

			if( class_exists( 'EpointPersonalTrainerAlerts', false ) && $diet->user && ( $member = get_user_by( 'ID', $diet->user ) ) && EpointPersonalTrainerAlerts::must_sent_member_new_diet_alert() )
			{
				EpointPersonalTrainerAlerts::send_member_modified_diet_alert( $member->user_email, $member->display_name, $diet );
			}

			if( $duplicate )
			{
				EpointPersonalTrainerMapper::duplicate_diet( $diet_id, get_current_user_id(), null );
			}

			if( $this->ajax )
			{
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array( 'name' => 'updatediet', 'args' => array( 'diet' => $diet_id ) ) )
				) );
				$response->send();
			}
			else
			{
				if( class_exists( 'EliteTrainerSiteTheme', false ) )
				{
					if( $diet->user &&
						!empty( $_COOKIE[EliteTrainerSiteTheme::LAST_PAGE_COOKIE] ) &&
						$_COOKIE[EliteTrainerSiteTheme::LAST_PAGE_COOKIE] === 'view-member-diets'
					) {
						wp_redirect( EliteTrainerSiteTheme::get_user_diets_url( $diet->user ) );
						exit;
						
					}

					setCookie( EliteTrainerSiteTheme::DIET_TAB_COOKIE, $diet->user ? '#user-diets' : '#my-diets-templates', time() + 24*60*60*1000, '/' );
					setCookie( EliteTrainerSiteTheme::DIET_LAST_DUPLICATED_COOKIE, $diet->ID, time() + 24*60*60*1000, '/' );
					wp_redirect( EliteTrainerSiteTheme::get_diets_list_url() );
					exit;
				}
				else
				{
					return 'Dieta actualizada satisfactoriamente.';
				}
			}
		}


		return __( 'There was an error.', $this->get_text_domain() );
	}


}

} // class_exists


