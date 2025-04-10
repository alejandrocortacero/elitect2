<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

if ( ! class_exists( 'JLCCustomFormRegisteredFormsTable', false ) )
{

class JLCCustomFormRegisteredFormsTable extends WP_List_Table
{
	const DELETE_NONCE = 'jlc_custom_form_registered_delete_nonce';

	public function __construct()
	{
		parent::__construct( array(
			'singular' => __( 'Form', JLCCustomForm::TEXT_DOMAIN ),
			'plural' => __( 'Forms', JLCCustomForm::TEXT_DOMAIN ),
			'ajax' => false
		) );

		$this->process_bulk_action();
	}

	function get_columns()
	{
		return array(
			'cb' => '<input type="checkbox" />',
			'internal_id' => __( 'Internal ID', JLCCustomForm::TEXT_DOMAIN ),
			'action' => __( 'Action', JLCCustomForm::TEXT_DOMAIN ),
			'dir' => __( 'Directory', JLCCustomForm::TEXT_DOMAIN ),
			'file' => __( 'File', JLCCustomForm::TEXT_DOMAIN ),
			'from' => __( 'From', JLCCustomForm::TEXT_DOMAIN ),
			'args' => __( 'Arguments', JLCCustomForm::TEXT_DOMAIN )
		);
	}

	public function get_sortable_columns()
	{
		$sortable_columns = array(
			'internal_id' => array( 'internal_id', true ),
			'action' => array( 'action', true ),
			'dir' => array( 'dir', true ),
			'from' => array( 'from', true )
		);

		return $sortable_columns;
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />',
			$item['internal_id']
		);
	}

	public function column_internal_id( $item )
	{
		$delete_nonce = wp_create_nonce( self::DELETE_NONCE );

		$title = '<strong><a href="#">' . $item['internal_id'] . '</a></strong>';
/*
		$title = sprintf(
			'<strong><a href="?page=%s&action=%s&student=%s">%s</a></strong>',
			esc_attr( $_REQUEST['page'] ),
			'view',
			absint( $item['ID'] ),
			$item['email']
		);
*/

		$actions = array();
/*
		$actions['view'] = sprintf(
			'<a href="?page=%s&action=%s&student=%s">%s</a>',
			esc_attr( $_REQUEST['page'] ),
			'view',
			absint( $item['ID'] ),
			__( 'View', JLCCustomForm::TEXT_DOMAIN )
		);
*/

		$actions['delete'] = sprintf(
			'<a href="?page=%s&action=%s&form=%s&_wpnonce=%s">%s</a>',
			esc_attr( $_REQUEST['page'] ),
			'delete',
			esc_attr( $item['internal_id'] ),
			$delete_nonce,
			__( 'Unregister', JLCCustomForm::TEXT_DOMAIN )
		);

		return $title . $this->row_actions( $actions );
	}

	public function column_action( $item )
	{
		if( !isset( $item['action'] ) )
			return esc_attr( __( 'Undefined', JLCCustomForm::TEXT_DOMAIN ) );

		return '<code>' . $item['action'] . '</code>';
	}

	public function column_dir( $item )
	{
		return ABSPATH . esc_attr( $item['dir'] );
	}

	public function column_file( $item )
	{
		return esc_attr( $item['file'] );
	}

	public function column_from( $item )
	{
		return esc_attr( $item['from'] );
	}

	public function column_args( $item )
	{
		if( !is_array( $item['args'] ) )
		{
			return esc_attr( $item['args'] );
		}
		else
		{
			$cads = array();
			foreach( $item['args'] as $key => $val )
				$cads[] = sprintf( "<li><strong>%s</strong>: %s</li>", $key, $val );
			return '<ul>' . implode( '', $cads ) . '</ul>';
		}
	}

	public function column_default( $item, $column_name )
	{
		switch ( $column_name ) {
			default:
				return print_r( $item, true );
		}
	}
/*
	protected function extra_tablenav( $which ) {
?>
		<div class="alignleft actions">
<?php
		if ( 'top' === $which && !is_singular() ) {
			$food_categories = JLCPersonalTrainingMapper::get_food_categories( null, null, 'name' );
			$selected = !empty( $_REQUEST['food_category'] ) ? (int)$_REQUEST['food_category'] : 0;

			ob_start();
?>
			<select name="food_category">
				<option value="0" <?php if( !$selected ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( __( 'All categories', JLCCustomForm::TEXT_DOMAIN ) ); ?></option>
			<?php foreach( $food_categories as $cat ) : ?>
				<option value="<?php echo esc_attr( $cat->ID ); ?>" <?php if( $selected == $cat->ID ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $cat->name ); ?></option>
			<?php endforeach; ?>
			</select>
<?php
			$output = ob_get_clean();

			if ( ! empty( $output ) ) {
				echo $output;
				submit_button( __( 'Filter' ), '', 'filter_action', false, array( 'id' => 'post-query-submit' ) );
			}
		}

?>
		</div>
<?php
	}
*/

	public function prepare_items()
	{
		//$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'forms_per_page', 20 );
		$current_page = $this->get_pagenum();
		$total_items  = $this->record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$order = isset( $_GET['order'] ) && $_GET['order'] == 'desc' ? SORT_DESC : SORT_ASC;
		$order_by = isset( $_GET['orderby'] ) ? $_GET['orderby'] : null;
		$offset = $current_page ? ( $current_page - 1 ) * $per_page : 0;

		$forms = get_option( JLCCustomForm::REGISTERED_FORMS_KEY, array() );

		foreach( $forms as &$f )
		{
			$name = $f['file'];
			$dir = $f['dir'];
			
			if( false !== strpos( $name, '.php' ) )
				$name = substr( $name, 0, strpos( $name, '.php' ) );

			if( !preg_match( '*^' . ABSPATH . '*', $dir ) )
				$dir = ABSPATH . $dir;

			$path = implode( DIRECTORY_SEPARATOR, array( $dir, $name . '.php' ) );

			if( is_readable( $path ) )
			{
				$form = JLCCustomForm::get_form( $f['internal_id'], $f['dir'], $f['file'], $f['args'] );
				if( $form )
					$f['action'] = $form->get_action();
			}
			else
			{
				$f['action'] = __( 'File not found', JLCCustomForm::TEXT_DOMAIN );
			}
		}

		if( in_array( $order_by, array_keys( $this->get_sortable_columns() ) ) )
		{
			$order_col = array_column( $forms, $order_by );

			array_multisort( $order_col, $order, $forms );
		}

		$this->items = array_slice( $forms, $offset, $per_page );
	}

	public function record_count()
	{
		$forms = get_option( JLCCustomForm::REGISTERED_FORMS_KEY, array() );
		return count( $forms );
	}

	public function no_items()
	{
		echo esc_html( __( 'No forms found.', JLCCustomForm::TEXT_DOMAIN ) );
	}

	public function delete_form( $form_id )
	{
		if( current_user_can( 'administrator' ) )
		{
			$registered_forms = get_option( JLCCustomForm::REGISTERED_FORMS_KEY, array() );

			foreach( $registered_forms as $form )
			{
				if( isset( $form['internal_id'] ) &&
					isset( $form['file'] ) &&
					isset( $form['dir'] ) &&
					$form_id == $form['internal_id']
				) {
					JLCCustomForm::unregister_form(
						$form['internal_id'],
						$form['dir'],
						$form['file']
					);

					break;
				}
			}
		}
	}

	public function get_bulk_actions()
	{
		$actions = array(
			'bulk-delete' => __( 'Unregister', JLCCustomForm::TEXT_DOMAIN )
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
				$this->delete_form( $_GET['form'] );

				wp_redirect( add_query_arg( array( 'form' => false, 'action' => false, '_wpnonce' => false ) ) );
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
				$this->delete_form( $id );
			}

			wp_redirect( add_query_arg( array( 'form' => false, 'action' => false, '_wpnonce' => false ) ) );
			exit;
		}
	}

}

} //class_exists
