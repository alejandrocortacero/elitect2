<?php defined( 'ABSPATH' ) or die ( 'Wrong Access' );

class JLCContactMapper
{
	const CONTACT_TABLE = 'jlc_contact';

	public static function install()
	{
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . self::CONTACT_TABLE;

		ob_start();

		$sql = 'ALTER TABLE ' . $table_name . ' ';
		$sql .= 'ADD COLUMN `name` VARCHAR(100) NOT NULL AFTER `date`;';
		$wpdb->query( $sql );

		$sql = 'ALTER TABLE ' . $table_name . ' ';
		$sql .= 'ADD COLUMN `phone` VARCHAR(20) NOT NULL AFTER `name`;';
		$wpdb->query( $sql );

		ob_get_clean();

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`user_email` VARCHAR(100) NOT NULL,';
		$sql .= '`subject` VARCHAR(100) NOT NULL,';
		$sql .= '`message` TEXT NOT NULL,';
		$sql .= '`date` DATETIME NOT NULL,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`phone` VARCHAR(20) NOT NULL,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );
	}

	public static function uninstall()
	{
		global $wpdb;
/*
		$table_name = $wpdb->prefix . self::CONTACT_TABLE;
		$sql = 'DROP TABLE IF EXISTS ' . $table_name;
		$wpdb->query( $sql );
*/
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

	public static function create_contact( $name, $email, $phone, $subject, $message )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::CONTACT_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'subject' => $subject,
				'name' => $name,
				'phone' => $phone,
				'user_email' => $email,
				'message' => $message,
				'date' => date( 'Y-m-d H:i:s' )
			),
			array( '%s', '%s', '%s', '%s', '%s', '%s' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
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
