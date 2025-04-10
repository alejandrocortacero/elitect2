<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditEvolutionMagnitudeForm' ) )
{

class JLCEpointPersonalTrainerEditEvolutionMagnitudeForm extends JLCCustomForm
{
	protected $is_editable_magnitude;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$type = isset( $args['type'] ) ? $args['type'] : 'corporal';
		$magnitude_id = isset( $args['magnitude'] ) ? $args['magnitude'] : null;
		$magnitude = $magnitude_id ? EpointPersonalTrainerMapper::get_evolution_magnitude( $magnitude_id ) : null;
		$readonly = $magnitude && ( !$magnitude->trainer || $magnitude->trainer != get_current_user_id() );
		$this->is_editable_magnitude = !$readonly;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_ev_magnitude',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'edit-evolution-magnitude-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'magnitude',
			array(
				'value' => $magnitude_id
			)
		);

		$this->add_hidden_field(
			'type',
			array(
				'value' => $type,
				'required' => true
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $magnitude ? $magnitude->name : '',
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
		$this->add_text_field(
			'unit',
			array(
				'value' => $magnitude ? $magnitude->unit : '',
				'label' => __( 'Unidad', $this->get_text_domain() ),
				'maxlength' => 20,
				'readonly' => $readonly,
				'required' => true
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

	protected function process_form()
	{
		if( !$this->is_editable_magnitude )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this magnitude.', $this->get_text_domain() ) )
			);

		$type = $this->get_field_by_name( 'type' )->get_value();

		$magnitude_id = $this->get_field_by_name( 'magnitude' )->get_value();
		$magnitude_id = $magnitude_id && is_numeric( $magnitude_id ) ? (int)$magnitude_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();
		$unit = $this->get_field_by_name( 'unit' )->get_value();

		if( !$magnitude_id )
		{
			$magnitude_id = EpointPersonalTrainerMapper::insert_evolution_magnitude(
				$name,
				$position,
				$active ? 1 : 0,
				$type,
				$unit,
				get_current_user_id()
			);

			if( !$magnitude_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The magnitude could not be created.', $this->get_text_domain() ) )
				);

			

			return 'Medida creada satisfactoriamente';
		}
		else
		{
			$magnitude = EpointPersonalTrainerMapper::get_evolution_magnitude( $magnitude_id );
			if( !$magnitude )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The magnitude can not be edited.', $this->get_text_domain() ) )
				);

			$updated = EpointPersonalTrainerMapper::update_evolution_magnitude(
				$magnitude_id,
				$name,
				$position,
				$active ? 1 : 0,
				$type,
				$unit
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The magnitude could not be saved.', $this->get_text_domain() ) )
				);

			return 'Medida actualizada satisfactoriamente.';
		}


		return __( 'Hubo un error.', $this->get_text_domain() );
	}


}

} // class_exists


