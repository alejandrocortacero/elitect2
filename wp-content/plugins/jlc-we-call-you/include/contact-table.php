<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class JLCWeCallYouTable extends WP_List_Table
{
	const DELETE_NONCE = 'jlc_we_call_you_table_delete_nonce';

	public function __construct()
	{
		parent::__construct( array(
			'singular' => __( 'Call Request', JLCWeCallYou::TEXT_DOMAIN ),
			'plural' => __( 'Call Requests', JLCWeCallYou::TEXT_DOMAIN ),
			'ajax' => false
		) );
	}

	function get_columns()
	{
		return array(
			'cb' => '<input type="checkbox" />',
			'phone' => __( 'Phone', JLCWeCallYou::TEXT_DOMAIN ),
			'answered' => __( 'Answered', JLCWeCallYou::TEXT_DOMAIN ),
			'date' => __( 'Date', JLCWeCallYou::TEXT_DOMAIN )
		);
	}

	public function get_sortable_columns()
	{
		$sortable_columns = array(
			'phone' => array( 'phone', true ),
			'date' => array( 'date', true )
		);

		return $sortable_columns;
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />',
			$item['ID']
		);
	}

	public function column_phone( $item )
	{
		$delete_nonce = wp_create_nonce( self::DELETE_NONCE );

		$title = sprintf(
			'<strong><a href="tel:%s" target="_blank">%s</a></strong>',
			$item['phone'],
			$item['phone']
		);


		$actions = array();

		if( !$item['answered'] )
		{
			$actions['mark'] = sprintf(
				'<a href="?page=%s&action=%s&contact=%s">%s</a>',
				esc_attr( $_REQUEST['page'] ),
				'mark',
				absint( $item['ID'] ),
				__( 'Mark as answered', JLCWeCallYou::TEXT_DOMAIN )
			);
		}
		else
		{
			$actions['mark'] = sprintf(
				'<a href="?page=%s&action=%s&contact=%s">%s</a>',
				esc_attr( $_REQUEST['page'] ),
				'unmark',
				absint( $item['ID'] ),
				__( 'Unmark as answered', JLCWeCallYou::TEXT_DOMAIN )
			);
		}

		$actions['delete'] = sprintf(
			'<a href="?page=%s&action=%s&contact=%s&_wpnonce=%s">%s</a>',
			esc_attr( $_REQUEST['page'] ),
			'delete',
			absint( $item['ID'] ),
			$delete_nonce,
			__( 'Delete', JLCWeCallYou::TEXT_DOMAIN )
		);

		return $title . $this->row_actions( $actions );
	}

	public function column_date( $item )
	{
		$date = date( JLCWeCallYou::get_public_datetime_format(), strtotime( $item['date'] ) );

		return $date;
	}

	public function column_answered( $item )
	{
		$answered = !empty( $item['answered'] );

		return $answered ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>';
	}

	public function column_default( $item, $column_name )
	{
		switch ( $column_name ) {
			default:
				return print_r( $item, true );
		}
	}

	public function prepare_items()
	{
		$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'contacts_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$order_by = isset( $_GET['orderby'] ) ? $_GET['orderby'] : 'date';
		$order = isset( $_GET['order'] ) ? $_GET['order'] : 'DESC';

		$contacts = JLCWeCallYouMapper::get_contacts( $per_page, $current_page, $order_by, $order );

		$items = array();
		foreach( $contacts as $contact )
			$items[] = array(
				'ID' => $contact->ID,
				'phone' => $contact->phone,
				'answered' => $contact->answered,
				'date' => $contact->date
			);

		$this->items = $items;
	}

	public static function record_count()
	{
		return JLCWeCallYouMapper::get_contacts_total();
	}

	public function no_items()
	{
		_e( 'No call requests found.', JLCWeCallYou::TEXT_DOMAIN );
	}

	public static function delete_contact( $contact_id )
	{
		JLCWeCallYouMapper::delete_contact( $contact_id );
	}

	public static function set_answered( $contact_id, $value )
	{
		JLCWeCallYouMapper::set_answered( $contact_id , $value );
	}

	public function get_bulk_actions()
	{
		$actions = array(
			'bulk-delete' => __( 'Delete', JLCWeCallYou::TEXT_DOMAIN )
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
				self::delete_contact( absint( $_GET['contact'] ) );

				//wp_redirect( esc_url( add_query_arg() ) );
				//exit;
			}
		}
		elseif ( 'mark' === $this->current_action() )
		{
			self::set_answered( absint( $_GET['contact'] ), true );
		}
		elseif ( 'unmark' === $this->current_action() )
		{
			self::set_answered( absint( $_GET['contact'] ), false );
		}

		// If the delete bulk action is triggered
		if( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' ) ||
			( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
		) {

			$delete_ids = esc_sql( $_POST['bulk-delete'] );

			// loop over the array of record IDs and delete them
			foreach ( $delete_ids as $id ) {
				self::delete_contact( $id );
			}

			//wp_redirect( esc_url( add_query_arg() ) );
			//exit;
		}
	}

}
