<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditEnvironmentForm' ) )
{

class JLCEpointPersonalTrainerEditEnvironmentForm extends JLCCustomForm
{
	protected $is_editable_environment;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$environment_id = isset( $args['environment'] ) ? $args['environment'] : null;
		$environment = $environment_id ? EpointPersonalTrainerMapper::get_environment( $environment_id ) : null;
		$readonly = $environment && ( !$environment->trainer || $environment->trainer != get_current_user_id() );
		$this->is_editable_environment = !$readonly;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_environment',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'edit-environment-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'environment',
			array(
				'value' => $environment_id
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $environment ? $environment->name : '',
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
		if( !$this->is_editable_environment )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this environment.', $this->get_text_domain() ) )
			);

		$environment_id = $this->get_field_by_name( 'environment' )->get_value();
		$environment_id = $environment_id && is_numeric( $environment_id ) ? (int)$environment_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();

		if( !$environment_id )
		{
			$environment_id = EpointPersonalTrainerMapper::create_environment(
				$name,
				$position,
				$active ? 1 : 0,
				get_current_user_id()
			);

			if( !$environment_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The environment could not be created.', $this->get_text_domain() ) )
				);

			

			return 'Entorno creado satisfactoriamente';
		}
		else
		{
			$environment = EpointPersonalTrainerMapper::get_environment( $environment_id );
			if( !$environment )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The environment can not be edited.', $this->get_text_domain() ) )
				);

			$updated = EpointPersonalTrainerMapper::update_environment(
				$environment_id,
				$name,
				$position,
				$active ? 1 : 0
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The environment could not be saved.', $this->get_text_domain() ) )
				);

			return 'Entorno actualizado satisfactoriamente.';
		}


		return __( 'Hubo un error.', $this->get_text_domain() );
	}


}

} // class_exists

