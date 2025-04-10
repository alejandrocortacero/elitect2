<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerMemberPhysicalTestStrengthForm' ) )
{

if( !class_exists( 'JLCEpointPersonalTrainerMemberPhysicalTestForm' ) )
	require_once( 'EpointPersonalTrainerMemberPhysicalTest.php' );

class JLCEpointPersonalTrainerMemberPhysicalTestStrengthForm extends JLCEpointPersonalTrainerMemberPhysicalTestForm
{
	public function __construct( $internal_id, $args )
	{
		parent::__construct( $internal_id, $args );
	}

	public function send_alerts( $member_id, $trainer_id )
	{
		$member = get_user_by( 'ID', $member_id );
		$trainer = get_user_by( 'ID', $trainer_id );

		if( !$member || !$trainer )
			return;

		EpointPersonalTrainerAlerts::send_trainer_strength_measures_changed_alert( $member, $trainer );
	}
}

} // class_exists

