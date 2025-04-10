<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditDietRestrictionForm' ) )
{

class JLCEpointPersonalTrainerEditDietRestrictionForm extends JLCCustomForm
{
	protected $is_editable_restriction;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$restriction_id = isset( $args['restriction'] ) ? $args['restriction'] : null;
		$restriction = $restriction_id ? EpointPersonalTrainerMapper::get_diet_restriction( $restriction_id ) : null;
		$readonly = $restriction && ( !$restriction->trainer || $restriction->trainer != get_current_user_id() );
		$this->is_editable_restriction = !$readonly;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_diet_restriction',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'edit-diet-restriction-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'restriction',
			array(
				'value' => $restriction_id
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $restriction ? $restriction->name : '',
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
		if( !$this->is_editable_restriction )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this restriction.', $this->get_text_domain() ) )
			);

		$restriction_id = $this->get_field_by_name( 'restriction' )->get_value();
		$restriction_id = $restriction_id && is_numeric( $restriction_id ) ? (int)$restriction_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();

		if( !$restriction_id )
		{
			$restriction_id = EpointPersonalTrainerMapper::create_diet_restriction(
				$name,
				$position,
				$active ? 1 : 0,
				get_current_user_id()
			);

			if( !$restriction_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The restriction could not be created.', $this->get_text_domain() ) )
				);

			

			return 'Entorno creado satisfactoriamente';
		}
		else
		{
			$restriction = EpointPersonalTrainerMapper::get_diet_restriction( $restriction_id );
			if( !$restriction )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The restriction can not be edited.', $this->get_text_domain() ) )
				);

			$updated = EpointPersonalTrainerMapper::update_diet_restriction(
				$restriction_id,
				$name,
				$position,
				$active ? 1 : 0
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The restriction could not be saved.', $this->get_text_domain() ) )
				);

			return 'Entorno actualizado satisfactoriamente.';
		}


		return __( 'Hubo un error.', $this->get_text_domain() );
	}


}

} // class_exists


