<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditDietObjectiveForm' ) )
{

class JLCEpointPersonalTrainerEditDietObjectiveForm extends JLCCustomForm
{
	protected $is_editable_objective;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$objective_id = isset( $args['objective'] ) ? $args['objective'] : null;
		$objective = $objective_id ? EpointPersonalTrainerMapper::get_diet_objective( $objective_id ) : null;
		$readonly = $objective && ( !$objective->trainer || $objective->trainer != get_current_user_id() );
		$this->is_editable_objective = !$readonly;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_diet_objective',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'edit-diet-objective-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'objective',
			array(
				'value' => $objective_id
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $objective ? $objective->name : '',
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

		if( !$readonly )
			$this->add_submit_button(
				'send',
				array(
					'label' => __( 'Save', $this->get_text_domain() )
				)
			);
	}

	protected function process_form()
	{
		if( !$this->is_editable_objective )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this objective.', $this->get_text_domain() ) )
			);

		$objective_id = $this->get_field_by_name( 'objective' )->get_value();
		$objective_id = $objective_id && is_numeric( $objective_id ) ? (int)$objective_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();

		if( !$objective_id )
		{
			$objective_id = EpointPersonalTrainerMapper::create_diet_objective(
				$name,
				$position,
				$active ? 1 : 0,
				get_current_user_id()
			);

			if( !$objective_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The objective could not be created.', $this->get_text_domain() ) )
				);

			

			return 'Objetivo creado satisfactoriamente';
		}
		else
		{
			$objective = EpointPersonalTrainerMapper::get_diet_objective( $objective_id );
			if( !$objective )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The objective can not be edited.', $this->get_text_domain() ) )
				);

			$updated = EpointPersonalTrainerMapper::update_diet_objective(
				$objective_id,
				$name,
				$position,
				$active ? 1 : 0
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The objective could not be saved.', $this->get_text_domain() ) )
				);

			return 'Objetivo actualizado satisfactoriamente.';
		}


		return __( 'Hubo un error.', $this->get_text_domain() );
	}


}

} // class_exists

