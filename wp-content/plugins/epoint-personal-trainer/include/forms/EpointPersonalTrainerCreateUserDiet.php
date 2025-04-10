<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerCreateUserDietForm' ) )
{

class JLCEpointPersonalTrainerCreateUserDietForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$member_id = isset( $args['member'] ) ? $args['member'] : null;
		if( empty( $member_id ) && !empty( $_POST['member'] ) )
			$member_id = sanitize_text_field( $_POST['member'] );

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_create_user_diet',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'create-user-diet-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'member',
			array(
				'value' => $member_id,
				'required' => true
			)
		);

		$this->add_hidden_field(
			'start',
			array(
				'value' => '',
				'required' => true
			)
		);

		$this->add_hidden_field(
			'end',
			array(
				'value' => '',
				'required' => true
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => '',
				'label' => __( 'Name', $this->get_text_domain() ),
				'maxlength' => 100,
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
					'checked' => false
				)
			);

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
					'checked' => false
				)
			);


		$this->add_html( array(
			'content' => '<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/vimeo.png" alt="vimeo" /></a></div>'
		) );
		$this->add_text_field(
			'video',
			array(
				'value' => '',
				'label' => __( 'Video', $this->get_text_domain() ),
				'required' => false,
				'help' => __( 'Pega aquí el enlace que aparece en "Compartir"', $this->get_text_domain() )
			)
		);
/*
		$this->add_textarea_field(
			'description',
			array(
				'value' => '',
				'label' => __( 'Observaciones', $this->get_text_domain() ),
				'required' => false
			)
		);
*/
		$this->add_textarea_field(
			'observations',
			array(
				'value' => '',
				'label' => __( 'Observaciones', $this->get_text_domain() ),
				'required' => false
			)
		);

		$this->add_html( array(
			'content' => '<h3>Horario</h3>'
		) );

		$food_items = EpointPersonalTrainerMapper::get_blog_food_items_for_user( get_current_blog_id(), (int)$member_id );

		$ii = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3);

		//$intervals = $diet_id ? EpointPersonalTrainerMapper::get_diet_intervals( $diet_id ) : null;
//var_dump( $intervals );die();

		$food_info = get_user_meta( $member_id, 'personal_trainer_food_questionnaire', true );

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
					'multiple' => true,
					'required' => false
				)
			);

			for( $ll = 10; $ll >= 1; $ll-- )
			{
				foreach( $food_items as $item )
				{
					if( isset( $food_info[$item->ID]['valuation'] ) && $ll == $food_info[$item->ID]['valuation'] )
					{
						$select_field->add_option(
							$item->ID,
							$item->name . ( isset( $food_info[$item->ID]['valuation'] ) ? ' (' . $food_info[$item->ID]['valuation'] . ')' : '' )//,
							//array( 'selected' => !empty( $intervals[$i] ) && in_array( $item->ID, $intervals[$i]->food ) )
						);
					}
				}
			}

			// para alimentos sin valorar
			foreach( $food_items as $item )
			{
				if( !isset( $food_info[$item->ID]['valuation'] ) )
				{
					$select_field->add_option(
						$item->ID,
						$item->name //,
						//array( 'selected' => !empty( $intervals[$i] ) && in_array( $item->ID, $intervals[$i]->food ) )
					);
				}
			}

			$this->add_text_field(
				'text_interval_' . $i,
				array(
					'value' => '',//!empty( $intervals[$i]->description ) ? $intervals[$i]->description : '',
					'label' => __( 'Editar toma', $this->get_text_domain() ),
					'maxlength' => 1000,
					//'readonly' => $readonly,
					'required' => false
				)
			);
		}

		$this->add_checkbox_field(
			'duplicate',
			array(
				'value' => 'yes',
				'label' => __( 'Si desea que se genere un duplicado de esta dieta y se archive en "Mis Plantillas" dentro de su galería de dietas para usar en otras ocasiones, marque el recuadro. Este duplicado podrá ser modificado desde su zona de creación sin que se vea afectada la dieta original.', $this->get_text_domain() ),
				'required' => false,
				'checked' => false
			)
		);

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Asignar', $this->get_text_domain() )
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
			'epoint-personal-trainer-diet-date-watcher-script',
			plugins_url( 'js/diet-date-watcher.js', __FILE__ ),
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
		$user_id = $this->get_field_by_name( 'member' )->get_value();

		$start = $this->get_field_by_name( 'start' )->get_value();
		$end = $this->get_field_by_name( 'end' )->get_value();

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();

		//$description = $this->get_field_by_name( 'description' )->get_value();
		$description = '';

		$observations = stripslashes( $this->get_field_by_name( 'observations' )->get_value() );

		$video = $this->get_field_by_name( 'video' )->get_value();

		$duplicate = $this->get_field_by_name( 'duplicate' )->is_checked();

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

		$diet_id = EpointPersonalTrainerMapper::create_diet(
			$name,
			$position,
			$active ? 1 : 0,
			$description,
			$start,//$start
			$end,//$end
			$user_id,//$user
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

		$new_diet = EpointPersonalTrainerMapper::get_diet( $diet_id );
		if( class_exists( 'EpointPersonalTrainerAlerts', false ) && $new_diet->user && ( $member = get_user_by( 'ID', $new_diet->user ) ) && EpointPersonalTrainerAlerts::must_sent_member_new_diet_alert() )
		{
			EpointPersonalTrainerAlerts::send_member_new_diet_alert( $member->user_email, $member->display_name, $new_diet );
		}

		if( $duplicate )
		{
			$duplicate_id = EpointPersonalTrainerMapper::create_diet(
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

			EpointPersonalTrainerMapper::set_diet_video( $duplicate_id, $video );
			EpointPersonalTrainerMapper::set_diet_observations( $duplicate_id, $observations );
		}


		if( $duplicate )
			return 'Dieta asignada satisfactoriamente y almacenada en la galería.';
		else
			return 'Dieta asignada satisfactoriamente.';
	}


}

} // class_exists



