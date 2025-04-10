<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerMemberCorporalMeasuresForm' ) )
{

class JLCEpointPersonalTrainerMemberCorporalMeasuresForm extends JLCCustomForm
{
	protected $member_id;
	protected $trainer_id;

	protected $magnitudes;
	protected $graphics;
	protected $magnitude_fields;

	public $skip_button;

	public function __construct( $internal_id, $args )
	{
		$this->magnitudes = array();
		$this->graphics = array();
		$this->magnitude_fields = array();

		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$member_id = isset( $args['member'] ) ? (int)$args['member'] : get_current_user_id();
		$this->member_id = $member_id;
		$trainer_id = isset( $args['trainer'] ) ? (int)$args['trainer'] : null;

if( !$trainer_id )
{
	$admin_users = get_users( array( 'role' => EpointPersonalTrainer::TRAINER_ROLE ) );
	$trainer_id = null;
	if( is_array( $admin_users ) && !empty( $admin_users ) )
	{
		$trainer_obj = current( $admin_users );
		$trainer_id = $trainer_obj->ID;
	}
}
		$this->trainer_id = $trainer_id;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_member_corporal',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'member-corporal-measures-form';

		$this->add_hidden_field(
			'member',
			array(
				'value' => $member_id,
				'required' => true
			)
		);

		$this->add_hidden_field(
			'trainer',
			array(
				'value' => $trainer_id,
				'required' => true
			)
		);

		$this->add_date_field(
			'when',
			array(
				'label' => 'Fecha',
				'value' => date( 'Y-m-d' ),
				'required' => true
			)
		);


		if( $trainer_id )
		{
			$magnitudes = EpointPersonalTrainerMapper::get_evolution_magnitudes_by_type( 'corporal', $trainer_id );

			$last_values = EpointPersonalTrainerMapper::get_last_user_evolution_values_by_type( $member_id, 'corporal' );
			foreach( $magnitudes as $magnitude )
			{
				$this->magnitudes[] = $magnitude->ID;

				$last_value = $this->get_last_magnitude_value( $magnitude->ID, $last_values );

				$this->magnitude_fields[$magnitude->ID] = $this->add_text_field(
					'magnitude_' . $magnitude->ID,
					array(
						'value' => $last_value ? $last_value : '',
						'label' => $magnitude->name,
						'placeholder' => 'En ' . $magnitude->unit,
						'maxlength' => 100,
						'required' => true
					)
				);

				$this->graphics[$magnitude->ID] = $this->add_html( array(
					'content' => '<div id="part-' . $magnitude->ID . '" style="width:600px; height:400px;max-width:100%;"></div>'
				) );
				
			}
		}

		$this->add_textarea_field(
			'observations',
			array(
				'value' => '',
				'label' => 'Observaciones',
				'required' => false
			)
		);


		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);

		if( get_user_meta( $member_id, 'personal_trainer_corporal_measures_set', true ) !== 'yes' && class_exists( 'EliteTrainerSiteTheme', false ) )
		{
			$this->skip_button = $this->add_html(
				array(
					'html_wrapped' => false,
					'content' => '<a class="btn btn-primary" href="' . admin_url( 'admin-post.php?action=' . EliteTrainerSiteTheme::SKIP_CORPORAL_MEASURES_FORM_ACTION ) . '">' . __( 'Skip', $this->get_text_domain() ) . '</a>'
				)
			);
		}
		else
		{
			$this->skip_button = null;
		}
	}

	public function get_magnitudes()
	{
		return $this->magnitudes;
	}

	public function get_magnitude_field( $magnitude_id )
	{
		$arr = $this->magnitude_fields;
		return array_key_exists( $magnitude_id, $arr ) ? $arr[$magnitude_id] : null;
	}

	public function get_graphic( $magnitude_id )
	{
		$arr = $this->graphics;
		return array_key_exists( $magnitude_id, $arr ) ? $arr[$magnitude_id] : null;
	}

	protected function get_last_magnitude_value( $magnitude_id, $last_values )
	{
		foreach( $last_values as $last_value )
		{
			if( $last_value->magnitude == $magnitude_id )
				return $last_value->value;
		}

		return null;
	}

	protected function enqueue_scripts()
	{
		if( !$this->member_id )
			return;

		$ev_values = EpointPersonalTrainerMapper::get_user_evolution_values_by_type( $this->member_id, 'corporal' );
		$magnitudes = EpointPersonalTrainerMapper::get_evolution_magnitudes_by_type( 'corporal', $this->trainer_id );

		$parts = array();
		$parts_names = array();
		$data = array();

		foreach( $magnitudes as $m )
		{
			$parts[] = (int)$m->ID;
			$parts_names[(int)$m->ID] = $m->name;

			$values = array();
			foreach( $ev_values as $ev_value )
			{
				if( $ev_value->magnitude == $m->ID )
				{
					$dt = date_create( $ev_value->when );

					if( $dt )
					{
						$values[] = array(
							'day' => (int)$dt->format( 'd' ),
							'month' => (int)$dt->format( 'm' ) - 1,
							'year' => (int)$dt->format( 'Y' ),
							'value' => (float)$ev_value->value
						);
					}
				}
			}

			$data[(int)$m->ID] = array(
				'unit' => $m->unit,
				'name' => $m->name,
				'values' => $values
			);
		}


//		var_dump( $data );

		wp_enqueue_script(
			'google-chart-script',
			'https://www.gstatic.com/charts/loader.js',
			array(  ),
			EpointPersonalTrainer::VERSION,
			true
		);
		wp_enqueue_script(
			'epoint-personal-trainer-graph-script',
			plugins_url( '/js/tracking-graph.js', __FILE__ ),
			array( 'google-chart-script','jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
/*
		if( count( $rows ) < EpointPersonalTraining::MIN_USER_TRACKING_ROWS )
		{
			wp_localize_script(
				'epoint-personal-trainer-graph-script',
				'EpointPersonalTrainingGraphNS',
				array(
					'minResults' => false,
					'minResultsMessage' => esc_html( sprintf( __( 'Graphs will be available when you have introduced your tracking data %d times or more.', EpointPersonalTraining::TEXT_DOMAIN ), EpointPersonalTraining::MIN_USER_TRACKING_ROWS ) )
				)
			);

			include( $file );
			return ob_get_clean();
		}
*/
		wp_localize_script(
			'epoint-personal-trainer-graph-script',
			'EpointPersonalTrainerGraphNS',
			array(
				'xAxisName' => __( 'Date', EpointPersonalTrainer::TEXT_DOMAIN ),
				'minResults' => true,
				'parts' => $parts,
				'rowsData' => $data
			)
		);

		wp_enqueue_script(
			'epoint-personal-trainer-exit-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);

		wp_enqueue_script(
			'epoint-personal-trainer-skip-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
		//include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'user-tracking-graph.php' ) ) );
	}


	public function print_public_form( $hide_messages = false )
	{
//die( $this->look_for_file( 'default-public-form.php' ) );
/*
		$ev_values = EpointPersonalTrainerMapper::get_user_evolution_values_by_type( $this->member_id, 'corporal' );
		$magnitudes = EpointPersonalTrainerMapper::get_evolution_magnitudes_by_type( 'corporal', $this->trainer_id );
var_dump( $ev_values );
*/
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();

	}

	protected function process_form()
	{
		$member_id = (int)($this->get_field_by_name( 'member' )->get_value());
		$trainer_id = (int)($this->get_field_by_name( 'trainer' )->get_value());

		$magnitudes = EpointPersonalTrainerMapper::get_evolution_magnitudes_by_type( 'corporal', $trainer_id );

		$date = $this->get_field_by_name( 'when' )->get_value();

		$observations = stripslashes( $this->get_field_by_name( 'observations' )->get_value() );

		$values = array();
		foreach( $magnitudes as $magnitude )
		{
			$v = $this->get_field_by_name( 'magnitude_' . $magnitude->ID )->get_value();

			$r = array(
				'magnitude' => $magnitude->ID,
				'when' => $date,
				'value' => $v
			);

			$values[] = $r;
		}

		EpointPersonalTrainerMapper::insert_user_evolution_values( $member_id, $values );
		EpointPersonalTrainerMapper::insert_user_evolution_observations(
			$member_id,
			array(
				array( 'magnitude' => null, 'when' => $date, 'observations' => $observations )
			)
		);

		if( class_exists( 'EpointPersonalTrainerAlerts', false ) )
		{
			$member = get_user_by( 'ID', $member_id );
			$trainer = get_user_by( 'ID', $trainer_id );

			if( !$member || !$trainer )
				return;

			EpointPersonalTrainerAlerts::send_trainer_corporal_measures_changed_alert( $member, $trainer );
		}

		update_user_meta( $member_id, 'personal_trainer_corporal_measures_set', 'yes' );

		return 'Medidas actualizadas satisfactoriamente.';
	}


}

} // class_exists




