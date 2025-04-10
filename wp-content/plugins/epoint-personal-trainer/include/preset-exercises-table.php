<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class PresetExercisesTable extends WP_List_Table
{
	const DELETE_NONCE = 'epoint_personal_trainer_exercises_table_delete_nonce';

	public function __construct()
	{
		parent::__construct( array(
			'singular' => __( 'Exercise', EpointPersonalTrainer::TEXT_DOMAIN ),
			'plural' => __( 'Exercises', EpointPersonalTrainer::TEXT_DOMAIN ),
			'ajax' => false
		) );
	}

	function get_columns()
	{
		return array(
			'cb' => '<input type="checkbox" />',
			'name' => __( 'Name', EpointPersonalTrainer::TEXT_DOMAIN ),
			'categories' => __( 'Categories', EpointPersonalTrainer::TEXT_DOMAIN ),
			'active' => __( 'Active', EpointPersonalTrainer::TEXT_DOMAIN )
		);
	}

	public function get_sortable_columns()
	{
		$sortable_columns = array(
			'name' => array( 'name', true )
		);

		return $sortable_columns;
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />',
			$item['ID']
		);
	}

	public function column_name( $item )
	{
		$delete_nonce = wp_create_nonce( self::DELETE_NONCE );

		$title = '<strong><a href="#">' . $item['name'] . '</a></strong>';
		$title = sprintf(
			'<strong><a href="?page=%s&action=%s&exercise=%s">%s</a></strong>',
			esc_attr( $_REQUEST['page'] ),
			'edit',
			absint( $item['ID'] ),
			$item['name']
		);


		$actions = array();

		$actions['edit'] = sprintf(
			'<a href="?page=%s&action=%s&exercise=%s">%s</a>',
			esc_attr( $_REQUEST['page'] ),
			'edit',
			absint( $item['ID'] ),
			__( 'Edit', EpointPersonalTrainer::TEXT_DOMAIN )
		);

		$actions['delete'] = sprintf(
			'<a href="?page=%s&action=%s&exercise=%s&_wpnonce=%s">%s</a>',
			esc_attr( $_REQUEST['page'] ),
			'delete',
			absint( $item['ID'] ),
			$delete_nonce,
			__( 'Delete', EpointPersonalTrainer::TEXT_DOMAIN )
		);

		return $title . $this->row_actions( $actions );
	}

	public function column_categories( $item )
	{
		return implode( ', ', $item['categories'] );
	}

	public function column_active( $item )
	{
		return $item['active'] ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>';
	}


	public function column_default( $item, $column_name )
	{
		switch ( $column_name ) {
			case 'subject':
				return $item[ $column_name ];
			default:
				return print_r( $item, true );
		}
	}

	public function prepare_items()
	{
		$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'exercises_per_page', 100 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$order_by = isset( $_GET['orderby'] ) ? $_GET['orderby'] : null;
		$order = isset( $_GET['order'] ) ? $_GET['order'] : null;

		$offset = $per_page * ($current_page - 1);

		$exercises = EpointPersonalTrainerMapper::get_preset_exercises( $per_page, $offset, $order_by, $order );

		$items = array();
		foreach( $exercises as $exercise )
			$items[] = array(
				'ID' => $exercise->ID,
				'name' => $exercise->name,
				'active' => $exercise->active,
				'categories' => EpointPersonalTrainerMapper::get_exercise_related_categories_names( $exercise->ID )
			);

		$this->items = $items;
	}

	public static function record_count()
	{
		return count( EpointPersonalTrainerMapper::get_preset_exercises() );
	}

	public function no_items()
	{
		_e( 'No exercise found.', EpointPersonalTrainer::TEXT_DOMAIN );
	}

	public static function delete_exercise( $exercise_id )
	{
		EpointPersonalTrainerMapper::delete_exercise( $exercise_id );
	}

	public function get_bulk_actions()
	{
		$actions = array(
			'bulk-delete' => __( 'Delete', EpointPersonalTrainer::TEXT_DOMAIN )
		);

		return $actions;
	}

	public function process_bulk_action()
	{
		//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() )
		{

			// In our file that handles the request, verify the nonce.
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );

			if ( ! wp_verify_nonce( $nonce, self::DELETE_NONCE ) )
			{
				die( 'There was an error.' );
			}
			else {
				self::delete_exercise( absint( $_GET['exercise'] ) );

				//wp_redirect( esc_url( add_query_arg() ) );
				//exit;
			}

		}

		// If the delete bulk action is triggered
		if( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' ) ||
			( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
		) {

			$delete_ids = esc_sql( $_POST['bulk-delete'] );

			// loop over the array of record IDs and delete them
			foreach ( $delete_ids as $id ) {
				self::delete_exercise( $id );
			}

			//wp_redirect( esc_url( add_query_arg() ) );
			//exit;
		}
	}

}

