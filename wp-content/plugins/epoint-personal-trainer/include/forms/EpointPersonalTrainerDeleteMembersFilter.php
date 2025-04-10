<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerDeleteMembersFilterForm' ) )
{

EpointPersonalTrainer::load_personal_info_management();

require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'EpointPersonalTrainerMembersFilter.php' ) ) );

class JLCEpointPersonalTrainerDeleteMembersFilterForm extends JLCEpointPersonalTrainerMembersFilterForm
{
	protected function enqueue_scripts()
	{
		parent::enqueue_scripts();

		wp_enqueue_script(
			'epoint-personal-trainer-delete-members-filter-form-script',
			plugins_url( 'js/delete-members-filter.js', __FILE__ ),
			array( 'epoint-personal-trainer-members-filter-form-script' ),
			EpointPersonalTrainer::VERSION,
			true
		);

		wp_localize_script(
			'epoint-personal-trainer-delete-members-filter-form-script',
			'EpointPersonalTrainerDeleteMembersFilterNS',
			array(
				'deleteMemberAction' => EpointPersonalTrainerPublic::DELETE_MEMBER_ACTION,
				'deactivateMemberAction' => EpointPersonalTrainerPublic::DEACTIVATE_MEMBER_ACTION,
				'reactivateMemberAction' => EpointPersonalTrainerPublic::REACTIVATE_MEMBER_ACTION,
				'ajaxUrl' => admin_url( 'admin-ajax.php' )
			)
		);

	}

	protected function generate_table( $users )
	{
		$table_template = locate_template( implode( DIRECTORY_SEPARATOR, array( 'templates', 'members', 'delete-members-table.php' ) ) );

		if( !$table_template )
			$table_template = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'delete-members-table.php' ) );

		ob_start();
		include( $table_template );
		return ob_get_clean();
	}



}

} // class_exists




