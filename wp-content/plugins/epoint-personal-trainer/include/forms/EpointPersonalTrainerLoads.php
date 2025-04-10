<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerLoadsForm' ) )
{

class JLCEpointPersonalTrainerLoadsForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_loads',
			true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'assign-loads-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'training',
			array(
				'required' => true,
				'value' => ''
			)
		);
		$this->add_hidden_field(
			'exercise',
			array(
				'required' => true,
				'value' => ''
			)
		);

		$this->add_text_field(
			'loads',
			array(
				'value' => '',
				'label' => '',
				'maxlength' => 10000,
				'required' => true
			)
		);

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	public function set_training_and_exercise( $training_id, $exercise_id )
	{
		$data = EpointPersonalTrainerMapper::get_last_training_exercise_data( $training_id, $exercise_id );

		$this->get_field_by_name( 'exercise' )->set_value( $exercise_id );
		$this->get_field_by_name( 'training' )->set_value( $training_id );
		$this->get_field_by_name( 'loads' )->set_value( $data->loads );
	}

	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'epoint-personal-trainer-loads-form-script',
			plugins_url( 'js/loads.js', __FILE__ ),
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

	protected function process_form()
	{
		$training_id = $this->get_field_by_name( 'training' )->get_value();
		$exercise_id = $this->get_field_by_name( 'exercise' )->get_value();
		$loads = $this->get_field_by_name( 'loads' )->get_value();

		$training = EpointPersonalTrainerMapper::get_training( $training_id, $exercise_id );

		$error = false;
		if( EpointPersonalTrainer::is_site_trainer() )
		{
			if( $training->trainer != get_current_user_id() )
			{
				$error = true;
			}
		}
		elseif( EpointPersonalTrainer::is_site_client() )
		{
			if( $training->user != get_current_user_id() )
			{
				$error = true;
			}
		}

		if( $error )
		{
			$response = new WP_Ajax_Response( array(
				'what' => 'json',
				'action' => 'exercise_training_loads_error',
				'id' => 1,
				'data' => json_encode( array( 'exercise' => $exercise_id, 'training' =>  $training_id ) )
			) );
			$response->send();
			
		}

		$data = EpointPersonalTrainerMapper::get_last_training_exercise_data( $training_id, $exercise_id );

		EpointPersonalTrainerMapper::update_training_exercise_data( $training_id, $exercise_id, $data->position, $data->description, $data->repetitions, $data->series, $loads );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'exercise_training_loads_updated',
			'id' => 1,
			'data' => json_encode( array( 'exercise' => $exercise_id, 'training' =>  $training_id ) )
		) );
		$response->send();


		return __( 'Hubo un error.', $this->get_text_domain() );
	}


}

} // class_exists


