<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class JLCContactTable extends WP_List_Table
{
	const DELETE_NONCE = 'jlc_contact_table_delete_nonce';

	public function __construct()
	{
		parent::__construct( array(
			'singular' => __( 'Contact', JLCContact::TEXT_DOMAIN ),
			'plural' => __( 'Contacts', JLCContact::TEXT_DOMAIN ),
			'ajax' => false
		) );
	}

	function get_columns()
	{
		return array(
			'cb' => '<input type="checkbox" />',
			'user_email' => __( 'Email', JLCContact::TEXT_DOMAIN ),
			'subject' => __( 'Subject', JLCContact::TEXT_DOMAIN ),
			'date' => __( 'Date', JLCContact::TEXT_DOMAIN )
		);
	}

	public function get_sortable_columns()
	{
		$sortable_columns = array(
			'user_email' => array( 'user_email', true ),
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

	public function column_user_email( $item )
	{
		$delete_nonce = wp_create_nonce( self::DELETE_NONCE );

		$title = '<strong><a href="#">' . $item['user_email'] . '</a></strong>';
		$title = sprintf(
			'<strong><a href="?page=%s&action=%s&contact=%s">%s</a></strong>',
			esc_attr( $_REQUEST['page'] ),
			'edit',
			absint( $item['ID'] ),
			$item['user_email']
		);


		$actions = array();

		$actions['edit'] = sprintf(
			'<a href="?page=%s&action=%s&contact=%s">%s</a>',
			esc_attr( $_REQUEST['page'] ),
			'edit',
			absint( $item['ID'] ),
			__( 'Edit', JLCContact::TEXT_DOMAIN )
		);

		$actions['delete'] = sprintf(
			'<a href="?page=%s&action=%s&contact=%s&_wpnonce=%s">%s</a>',
			esc_attr( $_REQUEST['page'] ),
			'delete',
			absint( $item['ID'] ),
			$delete_nonce,
			__( 'Delete', JLCContact::TEXT_DOMAIN )
		);

		return $title . $this->row_actions( $actions );
	}

	public function column_date( $item )
	{
		$date = date( JLCContact::get_public_datetime_format(), strtotime( $item['date'] ) );

		return $date;
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

		$per_page     = $this->get_items_per_page( 'contacts_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$order_by = isset( $_GET['orderby'] ) ? $_GET['orderby'] : null;
		$order = isset( $_GET['order'] ) ? $_GET['order'] : null;

		$contacts = JLCContactMapper::get_contacts( $per_page, $current_page, $order_by, $order );

		$items = array();
		foreach( $contacts as $contact )
			$items[] = array(
				'ID' => $contact->ID,
				'user_email' => $contact->user_email,
				'subject' => $contact->subject,
				'date' => $contact->date
			);

		$this->items = $items;
	}

	public static function record_count()
	{
		return JLCContactMapper::get_contacts_total();
	}

	public function no_items()
	{
		_e( 'No contacts found.', JLCContact::TEXT_DOMAIN );
	}

	public static function delete_contact( $contact_id )
	{
		JLCContactMapper::delete_contact( $contact_id );
	}

	public function get_bulk_actions()
	{
		$actions = array(
			'bulk-delete' => __( 'Delete', JLCContact::TEXT_DOMAIN )
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

				wp_redirect( esc_url( add_query_arg() ) );
				exit;
			}

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

			wp_redirect( esc_url( add_query_arg() ) );
			exit;
		}
	}

}
