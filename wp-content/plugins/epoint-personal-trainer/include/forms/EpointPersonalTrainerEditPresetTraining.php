<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditPresetTrainingForm' ) )
{

class JLCEpointPersonalTrainerEditPresetTrainingForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$training_id = isset( $args['training'] ) ? $args['training'] : null;
		$training = $training_id ? EpointPersonalTrainerMapper::get_training( $training_id ) : null;
		$readonly = false;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_preset_training',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

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

		$this->add_heading(
			array(
				'content' => __( 'Entorno', $this->get_text_domain() )
			)
		);

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


		$this->add_textarea_field(
			'description',
			array(
				'value' => $training ? $training->description : '',
				'label' => __( 'Description', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false
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
	}

	protected function process_form()
	{
		$training_id = $this->get_field_by_name( 'training' )->get_value();
		$training_id = $training_id && is_numeric( $training_id ) ? (int)$training_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();
		$description = $this->get_field_by_name( 'description' )->get_value();

		$objective_volume = $this->get_field_by_name( 'objective_volume' )->is_checked();
		$objective_maintenance = $this->get_field_by_name( 'objective_maintenance' )->is_checked();
		$objective_definition = $this->get_field_by_name( 'objective_definition' )->is_checked();

		$environment_house = $this->get_field_by_name( 'environment_house' )->is_checked();
		$environment_outdoors = $this->get_field_by_name( 'environment_outdoors' )->is_checked();
		$environment_gym = $this->get_field_by_name( 'environment_gym' )->is_checked();


		if( !$training_id )
		{
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
				null,//$trainer
				array()//$exercises
			);

			if( !$training_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The training could not be created.', $this->get_text_domain() ) )
				);

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
				null,//$user
				null,//$trainer
				array()//$exercises
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The training could not be saved.', $this->get_text_domain() ) )
				);

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
				return 'Entrenamiento actualizado satisfactoriamente.';
			}
		}


		return __( 'There was an error.', $this->get_text_domain() );
	}


}

} // class_exists


