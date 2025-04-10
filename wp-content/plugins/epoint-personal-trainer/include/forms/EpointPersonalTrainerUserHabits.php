<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerUserHabitsForm' ) )
{

class JLCEpointPersonalTrainerUserHabitsForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$member_id = isset( $args['member'] ) ? (int)$args['member'] : get_current_user_id();

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_user_habits',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'user-habits-form';

		$this->add_hidden_field(
			'member',
			array(
				'value' => $member_id,
				'required' => true
			)
		);

		$habits = get_user_meta( $member_id, 'personal_trainer_user_habits', true );
		$habits_observations = get_user_meta( $member_id, 'personal_trainer_user_habits_observations', true );

		$ii = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3);

		foreach( $ii as $i )
		{
			$this->add_text_field(
				'text_interval_' . $i,
				array(
					'value' => !empty( $habits[$i]['text'] ) ? $habits[$i]['text'] : '',
					'label' => sprintf( '%02d:00', $i ),
					'maxlength' => 100,
					'required' => false
				)
			);
		}

		$this->add_textarea_field(
			'description',
			array(
				'value' => $habits_observations,
				'label' => __( 'Observaciones', $this->get_text_domain() ),
				'required' => false
			)
		);

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
			'epoint-personal-trainer-exit-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();

//		add_action( 'wp_footer', array( $this, 'print_exercise_selector' ) );
	}

	protected function process_form()
	{
		$member_id = (int)($this->get_field_by_name( 'member' )->get_value());

		$intervals = array();
		$ii = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3);
		foreach( $ii as $i )
		{
			//$food = $this->get_field_by_name( 'interval_' . $i )->get_value();
			$text = $this->get_field_by_name( 'text_interval_' . $i )->get_value();

			$interval = array();
			$interval['text'] = $text;
			$intervals[$i] = $interval;
		}

		$observations = stripslashes( $this->get_field_by_name( 'description' )->get_value() );

		update_user_meta( $member_id, 'personal_trainer_user_habits', $intervals );
		update_user_meta( $member_id, 'personal_trainer_user_habits_observations',  $observations );

		return 'Hábitos actualizados satisfactoriamente.';
	}


}

} // class_exists



