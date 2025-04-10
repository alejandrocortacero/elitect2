<?php defined( 'ABSPATH' ) or die ( 'Wrong Access' );

if( !class_exists( 'EliteTrainerSiteThemeMapper', false ) )
{

class EliteTrainerSiteThemeMapper
{
	const HISTORICAL_OPTIONS_TABLE = 'elitethemeoptionsh';

	public static function install()
	{
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$charset_collate = $wpdb->get_charset_collate();

		$historical_table_name = $wpdb->prefix . self::HISTORICAL_OPTIONS_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $historical_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`option_name` VARCHAR(191) NOT NULL,';
		$sql .= '`option_value` longtext NOT NULL,';
		//$sql .= '`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,';
		$sql .= '`updated` DATETIME NOT NULL,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

	}

	public static function uninstall()
	{
		global $wpdb;
/*
		$training_exercise_table_name = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;
		$sql = 'DROP TABLE IF EXISTS ' . $training_exercise_table_name;
		$wpdb->query( $sql );
*/
/*
		$table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;
		$sql = 'DROP TABLE IF EXISTS ' . $table_name;
		$wpdb->query( $sql );

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$sql = 'DROP TABLE IF EXISTS ' . $table_name;
		$wpdb->query( $sql );

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$sql = 'DROP TABLE IF EXISTS ' . $table_name;
		$wpdb->query( $sql );
*/
	}

	public static function add_historical_option( $key, $value, $updated = null )
	{
		global $wpdb;

		$args = array(
			'option_name' => $key,
			'option_value' => $value
		);
		$args_format = array( '%s', '%s' );

		if( $updated )
		{
			$args['updated'] = $updated;
			$args_format[] = '%s';
		}
		else
		{
			$args['updated'] = date( 'Y-m-d h:i:s' );
			$args_format[] = '%s';
		}

		$table_name = $wpdb->prefix . self::HISTORICAL_OPTIONS_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			$args,
			$args_format
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function get_option_history( $key, $limit = 5 )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::HISTORICAL_OPTIONS_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `option_name` = %s ORDER BY `updated` DESC LIMIT %d", $key, $limit );

		return $wpdb->get_results( $sql );
	}

	public static function get_options_group_history( $options )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . self::HISTORICAL_OPTIONS_TABLE;
		$ret = array();

		$opt_str = '(' . implode( ',', array_map( function($a) { return '"' . $a . '"'; }, $options ) ) . ')';
		$dates = $wpdb->get_col( "SELECT DISTINCT `updated` FROM $table_name WHERE `option_name` IN $opt_str ORDER BY `updated` DESC LIMIT 10" );

		foreach( $dates as $date )
		{
			$ret[$date] = array();
			foreach( $options as $opt_name )
			{
				$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `option_name` = %s AND `updated` = %s ORDER BY `updated` DESC", $opt_name, $date );
				$ret[$date][$opt_name] = $wpdb->get_results( $sql );
			}
		}

		return $ret;
	}

	//////////////////////////////////////
	// EXERCISES
	//////////////////////////////////////
/*
	public static function get_exercise_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_exercise_search_results( $name, $category, $excluded )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;
		$cat_table = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;

		$where = 'WHERE `active` = 1';
		if( !empty( $name ) && is_string( $name ) )
		{
			if( mb_strlen( $name ) < 3 )
				$name = $name . '%';
			else
				$name = '%' . $name . '%';

			$where .= $wpdb->prepare( " AND `name` LIKE %s", $name );
		}

		if( !empty( $category ) && is_integer( $category ) )
			$where .= $wpdb->prepare( " AND `ID` IN ( SELECT DISTINCT `exercise_id` FROM $cat_table WHERE `cat_exercise_id` = %d)", $category );

		if( !empty( $excluded ) && is_array( $excluded ) )
		{
			$cad = '(' . implode( ',', $excluded ) . ')';
			$where .= " AND `ID` NOT IN $cad";
		}

		$sql = "SELECT * FROM $table_name $where ORDER BY position ASC";
//echo $sql;die();
		return $wpdb->get_results( $sql );
	}

	public static function get_exercises( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'strong' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY position ASC");
		}
	}

	public static function get_trainer_exercises( $trainer_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d", $trainer_id );

		return $wpdb->get_results( $sql );
	}

	public static function get_preset_exercises()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		$sql = "SELECT * FROM $table_name WHERE `trainer` IS NULL";

		return $wpdb->get_results( $sql );
	}

	public static function get_exercise( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_exercise_by_name( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `name` = %s", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_exercise()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";

		return $wpdb->get_row( $sql );
	}

	public static function create_exercise( $name, $position, $active, $description = null, $video = null, $image_start = null, $image_end = null, $categories = array(), $corrections = array(), $trainer = null )
	{
		global $wpdb;

		if( !is_array( $categories ) )
			return false;

		$cat_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;
		$categories_count = count( $categories );
		if( $categories_count )
		{
			$cat_string = '(' . implode( ',', $categories ) . ')';
			$sql = $wpdb->prepare( "SELECT count(distinct ID) = %d FROM $cat_table_name WHERE ID IN $cat_string", $categories_count );
			if( !$wpdb->get_var( $sql ) )
				return false;
		}

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'video' => $video,
				'image_start' => $image_start,
				'image_end' => $image_end,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%s', '%s', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		$exercise_id = $wpdb->insert_id;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;
		foreach( $categories as $category )
			if( false === $wpdb->insert(
				$table_name,
				array(
					'exercise_id' => $exercise_id,
					'cat_exercise_id' => $category
				),
				array( '%d', '%d' )
			) )
				return false;

		$table_name = $wpdb->base_prefix . self::EXERCISE_CORRECTION_TABLE;
		foreach( $corrections as $correction )
			if( false === $wpdb->insert(
				$table_name,
				array(
					'description' => $correction['description'],
					'position' => $correction['position'],
					'active' => $correction['active'],
					'image_well' => $correction['image_well'],
					'image_bad' => $correction['image_bad'],
					'exercise_id' => $exercise_id
				),
				array( '%s', '%d', '%d', '%d', '%d', '%d'  )
			) )
				return false;

		return $exercise_id;
	}

	public static function update_exercise( $id, $name, $position, $active, $description = null, $video = null, $image_start = null, $image_end = null, $categories = array(), $corrections = array() )
	{
		global $wpdb;

		$map_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;

		if( !empty( $categories ) )
		{
			$cat_string = '(' . implode( ',', $categories ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $map_table_name WHERE `exercise_id` = %d AND `cat_exercise_id` NOT IN $cat_string", $id );
			$wpdb->query( $sql );

			$pairs = array();
			foreach( $categories as $category )
				$pairs[] = "($id, $category)";
			$pairs_string = implode( ',', $pairs );
			$sql = "INSERT INTO $map_table_name (`exercise_id`,`cat_exercise_id`) VALUES $pairs_string ON DUPLICATE KEY UPDATE `exercise_id` = `exercise_id`, `cat_exercise_id` = `cat_exercise_id`";
			$wpdb->query( $sql );
		}
		else
		{
			$sql = $wpdb->prepare( "DELETE FROM $map_table_name WHERE `exercise_id` = %d", $id );
			$wpdb->query( $sql );
		}

		$corrections_table = $wpdb->base_prefix . self::EXERCISE_CORRECTION_TABLE;

		if( !empty( $corrections ) )
		{
			$id_corrections = array();
			$no_id_corrections = array();
			foreach( $corrections as $correction )
				if( !empty( $correction['ID'] ) && is_numeric( $correction['ID'] ) && (int)$correction['ID'] > 0 )
					$id_corrections[(int)$correction['ID']] = $correction;
				else
					$no_id_corrections[] = $correction;

			
			if( !empty( $id_corrections ) )
			{
				$ides_string = '(' . implode( ',', array_keys( $id_corrections ) ) . ')';
				$sql = $wpdb->prepare( "DELETE FROM $corrections_table WHERE `exercise_id` = %d AND `ID` NOT IN $ides_string", $id );
				$wpdb->query( $sql );

				foreach( $id_corrections as $correction_id => $correction )
				{
					if( false === $wpdb->update(
						$corrections_table,
						array(
							'description' => $correction['description'],
							'position' => $correction['position'],
							'active' => $correction['active'],
							'image_well' => $correction['image_well'],
							'image_bad' => $correction['image_bad'],
						),
						array(
							'ID' => (int)$correction_id,
							'exercise_id' => (int)$id,
						),
						array( '%s', '%d', '%d', '%d', '%d' ),
						array( '%d', '%d' )
					) )
						return false;
				}
			}

			if( !empty( $no_id_corrections ) )
			{
				foreach( $no_id_corrections as $correction )
					if( false === $wpdb->insert(
						$corrections_table,
						array(
							'description' => $correction['description'],
							'position' => $correction['position'],
							'active' => $correction['active'],
							'image_well' => $correction['image_well'],
							'image_bad' => $correction['image_bad'],
							'exercise_id' => (int)$id
						),
						array( '%s', '%d', '%d', '%d', '%d', '%d'  )
					) )
						return false;
			}
		}
		else
		{
			$sql = $wpdb->prepare( "DELETE FROM $corrections_table WHERE `exercise_id` = %d", $id );
			$wpdb->query( $sql );
		}

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'video' => $video,
				'image_start' => $image_start,
				'image_end' => $image_end
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d', '%s', '%s', '%d', '%d' ),
			array( '%d' )
		);

		return $result;
	}
 
	public static function delete_exercise( $exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$exercise_id ),
			array( '%d' )
		);
	}

	public static function get_exercise_related_categories( $exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT cat_exercise_id FROM $table_name WHERE exercise_id = %d", $exercise_id ) );
	}

	public static function get_exercise_related_categories_names( $exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT cf.name AS 'name' FROM $table_name cff INNER JOIN $cat_table_name cf ON cff.cat_exercise_id = cf.ID WHERE cff.exercise_id = %d", $exercise_id ) );
	}

	public static function get_exercise_corrections( $exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_CORRECTION_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE exercise_id = %d", $exercise_id ) );
	}


	//////////////////////////////////////
	// CAT EXERCISES
	//////////////////////////////////////

	public static function get_exercise_categories_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_exercise_categories( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'active' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY position ASC");
		}
	}

	public static function get_exercise_category( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_exercise_category_by_name( $name )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `name` = %s", $name );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_exercise_category()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";

		return $wpdb->get_row( $sql );
	}

	public static function create_exercise_category( $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0
			),
			array( '%s', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function update_exercise_category( $id, $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d' ),
			array( '%d' )
		);

		return $result;
	}
 
	public static function delete_exercise_category( $cat_exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$cat_exercise_id ),
			array( '%d' )
		);
	}
*/
}

} // class_exists


