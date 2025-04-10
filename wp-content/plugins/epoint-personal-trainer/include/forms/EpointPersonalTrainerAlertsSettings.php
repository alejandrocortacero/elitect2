<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerAlertsSettingsForm' ) )
{

class JLCEpointPersonalTrainerAlertsSettingsForm extends JLCCustomForm
{

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_alerts_settings',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		//$this->add_honeypot();

		$user_id = get_current_user_id();

		$this->add_heading(
			array(
				'content' => __( 'Alertas hacia el entrenador', $this->get_text_domain() )
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_ALERT,
			array(
				'value' => 'yes',
				'label' => 'El entrenamiento de tu cliente X ha caducado.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_ALERT, true ) == 'yes'
			)
		);//->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_DAYS );
/*
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_DAYS
			)
		);
*/

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_ALERT,
			array(
				'value' => 'yes',
				'label' => 'La dieta de tu cliente X ha caducado',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_ALERT, true ) == 'yes'
			)
		);//->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_DAYS );
/*
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_DAYS
			)
		);
*/
		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Ha llegado el momento de revisar el peso corporal de tu cliente X.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Ha llegado el momento de revisar las medidas corporales de tu cliente X.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Ha llegado el momento de revisar las pruebas de fuerza de tu cliente X.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Ha llegado el momento de revisar las pruebas de velocidad de tu cliente X.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Ha llegado el momento de revisar las pruebas de distancia de tu cliente X.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Hoy, el cliente X que diste de alta manualmente, debería renovar la subscripción.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_DAYS, true ) ) ? $val : 10,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 15,
				'id' => EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_DAYS
			)
		);

		$this->add_heading(
			array(
				'content' => __( 'Alertas hacia el cliente', $this->get_text_domain() )
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_TRAINING_CHANGED_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tu entrenamiento ha caducado.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TRAINING_CHANGED_ALERT, true ) == 'yes'
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_DIET_CHANGED_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tu dieta ha caducado.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_DIET_CHANGED_ALERT, true ) == 'yes'
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tienes que actualizar tu peso corporal.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tienes que actualizar tus medidas corporales.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tienes que actualizar tus pruebas de fuerza.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_DAYS

			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tienes que actualizar tus pruebas de velocidad.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tienes que actualizar tus pruebas de distancia.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_DAYS, true ) ) ? $val : 30,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 100,
				'id' => EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_DAYS
			)
		);

		$this->add_checkbox_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_ALERT,
			array(
				'value' => 'yes',
				'label' => 'Tu suscripción está a punto de caducar.',
				'required' => false,
				'checked' => get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_ALERT, true ) == 'yes'
			)
		)->add_attribute( 'data-days-field', EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_DAYS );
		$this->add_number_field(
			EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_DAYS,
			array(
				'value' => !empty( $val = (int)get_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_DAYS, true ) ) ? $val : 10,
				'label' => 'Días para enviar la alerta',
				'required' => false,
				'min' => 1,
				'max' => 15,
				'id' => EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_DAYS
			)
		);


		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );

		$this->enqueue_scripts();
	}

	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'epoint-personal-trainer-alerts-settings-script',
			plugins_url( 'js/alerts-settings.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);

	}

	protected function process_form()
	{
		if( !is_user_logged_in() )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'There was an error.', $this->get_text_domain() ) )
			);

		$user_id = get_current_user_id();

		$arr = array(
/*
			array(
				'alert' => EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_ALERT,
				'days' => EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Cambiar entrenamiento del cliente".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_ALERT,
				'days' => EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Cambiar dieta del cliente".'
			),
*/
			array(
				'alert' => EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_ALERT,
				'days' => EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Tomar medidas del cliente".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_ALERT,
				'days' => EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Revisar pruebas de fuerza".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_ALERT,
				'days' => EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Revisar pruebas de velocidad".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_ALERT,
				'days' => EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Revisar pruebas de distancia".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_ALERT,
				'days' => EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Renovación de pago del socio".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_ALERT,
				'days' => EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Pesarse".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_ALERT,
				'days' => EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Tomar medidas corporales".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_ALERT,
				'days' => EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Tomar medidas de pruebas de fuerza".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_ALERT,
				'days' => EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Tomar medidas de pruebas de velocidad".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_ALERT,
				'days' => EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Tomar medidas de pruebas de distancia".'
			),
			array(
				'alert' => EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_ALERT,
				'days' => EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_DAYS,
				'error' => 'Debe especificar un número de días para la alerta "Renovación de pago".'
			)
		);

		foreach( $arr as $elem )
		{
			if( $this->get_field_by_name( $elem['alert'] )->is_checked() &&
				empty( $this->get_field_by_name( $elem['days'] )->get_value() ) )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => $elem['error'] )
				);
		}


		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_ALERT )->is_checked() ? 'yes' : 'no' );
		//update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_CHANGE_TRAINING_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_ALERT )->is_checked() ? 'yes' : 'no' );
		//update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_CHANGE_DIET_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_WEIGHT_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_CORPORAL_MEASURES_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_STRENGTH_TEST_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_SPEED_TEST_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_DISTANCE_TEST_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::TRAINER_TAKE_RENOVAL_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TRAINING_CHANGED_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TRAINING_CHANGED_ALERT )->is_checked() ? 'yes' : 'no' );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_DIET_CHANGED_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_DIET_CHANGED_ALERT )->is_checked() ? 'yes' : 'no' );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_WEIGHT_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_CORPORAL_MEASURES_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_STRENGTH_TEST_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_SPEED_TEST_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_DISTANCE_TEST_DAYS )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_ALERT, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_ALERT )->is_checked() ? 'yes' : 'no' );
		update_user_meta( $user_id, EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_DAYS, $this->get_field_by_name( EpointPersonalTrainerAlerts::MEMBER_TAKE_RENOVAL_DAYS )->get_value() );

		return __( 'Cambios guardados satisfactoriamente.', $this->get_text_domain() );
	}


}

} // class_exists



