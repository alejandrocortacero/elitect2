<?php defined( 'ABSPATH' ) or die ( 'Wrong Access' );

class JLCWeCallYouMapper
{
	const CONTACT_TABLE = 'jlc_we_call_you';

	public static function install()
	{
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . self::CONTACT_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`date` DATETIME NOT NULL,';
		$sql .= '`phone` VARCHAR(20) NOT NULL,';
		$sql .= '`answered` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );
	}

	public static function uninstall()
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;
		$sql = 'DROP TABLE IF EXISTS ' . $table_name;
		$wpdb->query( $sql );
	}

	public static function get_contacts_total()
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_contacts( $per_page = null, $current_page = 1, $order_by = null, $order = 'desc' )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;

		$order_str = $order ? "ORDER BY `$order_by` $order" : '';

		if( !is_int( $per_page ) || $per_page < 1 || !is_int( $current_page ) )
		{
			return $wpdb->get_results( "SELECT * FROM $table_name $order_str");
		}
		else
		{
			$offset = abs( $current_page - 1 ) * $per_page;
			return $wpdb->get_results( "SELECT * FROM $table_name $order_str LIMIT $per_page OFFSET $offset");
		}
	}

	public static function get_contact( $id )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function create_contact( $phone )
	{
		global $wpdb;

		$phone = preg_replace( '/[\s]/', '', $phone );

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'phone' => $phone,
				'date' => date( 'Y-m-d H:i:s' )
			),
			array( '%s', '%s' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function set_answered( $id, $value )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;
		return $wpdb->update(
			$table_name,
			array(
				'answered' => $value ? 1 : 0,
			),
			array(	
				'ID' => $id
			),
			array( '%d' ),
			array( '%d' )
		);
	}

	public static function is_call_pending( $phone )
	{
		global $wpdb;

		$phone = preg_replace( '/[\s]/', '', $phone );

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `phone` = %s AND `answered` = 0", $phone );

		$results = $wpdb->get_results( $sql );

		return !empty( $results );
	}

	public static function delete_contact( $contact_id )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;
		return $wpdb->delete(
			$table_name,
			array(
				'ID' => $contact_id,
			),
			array( '%d' )
		);
	}
 
}
