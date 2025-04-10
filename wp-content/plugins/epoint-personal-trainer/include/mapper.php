<?php defined( 'ABSPATH' ) or die ( 'Wrong Access' );

class EpointPersonalTrainerMapper
{
	const OBJECTIVE_TABLE = 'epoint_personal_trainer_objective';
	const ENVIRONMENT_TABLE = 'epoint_personal_trainer_environment';

	const CAT_EXERCISE_TABLE = 'epoint_personal_trainer_cat_exercise';
	const EXERCISE_TABLE = 'epoint_personal_trainer_exercise';
	const EXERCISE_CORRECTION_TABLE = 'epoint_personal_trainer_exercise_correction';
	const CAT_EXERCISE_EXERCISE_TABLE = 'epoint_personal_trainer_cat_exercise_exercise';

	const TRAINING_TABLE = 'epoint_personal_trainer_training';
	const TRAINING_EXERCISE_TABLE = 'epoint_personal_trainer_training_exercise';

	const TRAINING_OBJECTIVE_TABLE = 'epoint_personal_trainer_training_objective';
	const TRAINING_ENVIRONMENT_TABLE = 'epoint_personal_trainer_training_environment';

	const FOOD_TABLE = 'epoint_personal_trainer_food';
	const CAT_FOOD_TABLE = 'epoint_personal_trainer_cat_food';
	const CAT_FOOD_FOOD_TABLE = 'epoint_personal_trainer_cat_food_food';

	const DIET_OBJECTIVE_TABLE = 'epoint_personal_trainer_diet_objective';
	const DIET_RESTRICTION_TABLE = 'epoint_personal_trainer_diet_restriction';

	const DIET_TABLE = 'epoint_personal_training_diet';
	const DIET_INTERVAL_TABLE = 'epoint_personal_training_diet_interval';
	const DIET_INTERVAL_FOOD_TABLE = 'epoint_personal_training_diet_interval_food';

	const DIET_DIET_OBJECTIVE_TABLE = 'epoint_personal_trainer_diet_diet_objective';
	const DIET_DIET_RESTRICTION_TABLE = 'epoint_personal_trainer_diet_diet_restriction';

	const EVOLUTION_MAGNITUDE_TABLE = 'epoint_personal_trainer_evolution_magnitude';
	const USER_EVOLUTION_MAGNITUDE_TABLE = 'epoint_personal_trainer_user_evolution_magnitude';
	const USER_EVOLUTION_PHOTOS_TABLE = 'epoint_personal_trainer_user_evolution_photos';
	const USER_EVOLUTION_OBSERVATIONS_TABLE = 'epoint_personal_trainer_user_evolution_observations';

	public static function install()
	{
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$charset_collate = $wpdb->get_charset_collate();

		$objective_table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $objective_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$environment_table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $environment_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		// EXERCISE

		$cat_exercise_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_exercise_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$exercise_table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $exercise_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`video` VARCHAR(200) DEFAULT NULL,';
		$sql .= '`image_start` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= '`image_end` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= '`user` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$exercise_correction_table_name = $wpdb->base_prefix . self::EXERCISE_CORRECTION_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $exercise_correction_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`description` TEXT NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`image_well` BIGINT(20) UNSIGNED,';
		$sql .= '`image_bad` BIGINT(20) UNSIGNED,';
		$sql .= '`exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'FOREIGN KEY (`exercise_id`) REFERENCES ' . $exercise_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$cat_exercise_exercise_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_exercise_exercise_table_name . ' (';
		$sql .= '`exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`cat_exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`exercise_id`,`cat_exercise_id`),';
		$sql .= 'FOREIGN KEY (`exercise_id`) REFERENCES ' . $exercise_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`cat_exercise_id`) REFERENCES ' . $cat_exercise_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		// TRAINING

		$training_table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $training_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= '`video` VARCHAR(200) DEFAULT NULL,';
		$sql .= '`start` DATE DEFAULT NULL,';
		$sql .= '`end` DATE DEFAULT NULL,';
		$sql .= '`observations` TEXT DEFAULT NULL,';
		//$sql .= '`objective_volume` TINYINT(1) NOT NULL DEFAULT 0,';
		//$sql .= '`objective_maintenance` TINYINT(1) NOT NULL DEFAULT 0,';
		//$sql .= '`objective_definition` TINYINT(1) NOT NULL DEFAULT 0,';
		//$sql .= '`environment_house` TINYINT(1) NOT NULL DEFAULT 0,';
		//$sql .= '`environment_outdoors` TINYINT(1) NOT NULL DEFAULT 0,';
		//$sql .= '`environment_gym` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= '`user` bigint(20) unsigned,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$training_exercise_table_name = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $training_exercise_table_name . ' (';
		$sql .= '`training_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`position` int(11) NOT NULL DEFAULT 0,';
		$sql .= '`saved` DATETIME NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= '`series` VARCHAR(100) NOT NULL,';
		$sql .= '`repetitions` VARCHAR(100) NOT NULL,';
		//$sql .= '`loads` VARCHAR(100) NOT NULL,';
		$sql .= '`loads` TEXT NOT NULL,';
		$sql .= 'PRIMARY KEY (`training_id`,`exercise_id`,`saved`),';
		$sql .= 'FOREIGN KEY (`training_id`) REFERENCES ' . $training_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`exercise_id`) REFERENCES ' . $exercise_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$training_objective_table_name = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $training_objective_table_name . ' (';
		$sql .= '`training_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`objective_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`training_id`,`objective_id`),';
		$sql .= 'FOREIGN KEY (`training_id`) REFERENCES ' . $training_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`objective_id`) REFERENCES ' . $objective_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$training_environment_table_name = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $training_environment_table_name . ' (';
		$sql .= '`training_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`environment_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`training_id`,`environment_id`),';
		$sql .= 'FOREIGN KEY (`training_id`) REFERENCES ' . $training_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`environment_id`) REFERENCES ' . $environment_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		// FOOD

		$cat_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_food_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= '`blog` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`)';
		//$sql .= 'FOREIGN KEY (`blog`) REFERENCES ' . $wpdb->blogs . ' (`blog_id`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$food_table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $food_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`user` bigint(20) unsigned DEFAULT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$cat_food_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_food_food_table_name . ' (';
		$sql .= '`food_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`cat_food_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`food_id`,`cat_food_id`),';
		$sql .= 'FOREIGN KEY (`food_id`) REFERENCES ' . $food_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`cat_food_id`) REFERENCES ' . $cat_food_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		// DIET
		$diet_objective_table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diet_objective_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diet_restriction_table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diet_restriction_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );


		$diets_table_name = $wpdb->base_prefix . self::DIET_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diets_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= '`observations` TEXT DEFAULT NULL,';
		$sql .= '`video` VARCHAR(200) DEFAULT NULL,';
		$sql .= '`start` DATE DEFAULT NULL,';
		$sql .= '`end` DATE DEFAULT NULL,';
		$sql .= '`user` bigint(20) UNSIGNED DEFAULT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diets_intervals_table_name = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diets_intervals_table_name . ' (';
		$sql .= '`diet_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`interval` int(2) unsigned NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`diet_id`,`interval`),';
		$sql .= 'FOREIGN KEY (`diet_id`) REFERENCES ' . $diets_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diet_interval_food_table_name = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diet_interval_food_table_name . ' (';
		$sql .= '`diet_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`interval` int(2) unsigned NOT NULL,';
		$sql .= '`food_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`diet_id`,`interval`,`food_id`),';
		$sql .= 'FOREIGN KEY (`diet_id`,`interval`) REFERENCES ' . $diets_intervals_table_name . ' (`diet_id`,`interval`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`food_id`) REFERENCES ' . $food_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diet_diet_objective_table_name = $wpdb->base_prefix . self::DIET_DIET_OBJECTIVE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diet_diet_objective_table_name . ' (';
		$sql .= '`diet_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`objective_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`diet_id`,`objective_id`),';
		$sql .= 'FOREIGN KEY (`diet_id`) REFERENCES ' . $diets_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`objective_id`) REFERENCES ' . $diet_objective_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diet_diet_restriction_table_name = $wpdb->base_prefix . self::DIET_DIET_RESTRICTION_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diet_diet_restriction_table_name . ' (';
		$sql .= '`diet_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`restriction_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`diet_id`,`restriction_id`),';
		$sql .= 'FOREIGN KEY (`diet_id`) REFERENCES ' . $diets_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`restriction_id`) REFERENCES ' . $diet_restriction_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		// EVOLUTION MAGNITUDE
		$evolution_magnitude_table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $evolution_magnitude_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`type` VARCHAR(100) NOT NULL,';
		$sql .= '`unit` VARCHAR(20) NOT NULL,';
		$sql .= '`trainer` BIGINT(20) UNSIGNED DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`trainer`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$user_evolution_magnitude_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_MAGNITUDE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $user_evolution_magnitude_table_name . ' (';
		$sql .= '`user` bigint(20) unsigned NOT NULL,';
		$sql .= '`magnitude` bigint(20) unsigned NOT NULL,';
		$sql .= '`when` DATE NOT NULL,';
		$sql .= '`value` VARCHAR(100) NOT NULL,';
		$sql .= 'PRIMARY KEY (`user`,`magnitude`,`when`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`magnitude`) REFERENCES ' . $evolution_magnitude_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$user_evolution_photos_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_PHOTOS_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $user_evolution_photos_table_name . ' (';
		$sql .= '`user` bigint(20) unsigned NOT NULL,';
		$sql .= '`when` DATE NOT NULL,';
		$sql .= '`front` BIGINT(20) UNSIGNED NOT NULL,';
		$sql .= '`profile` BIGINT(20) UNSIGNED NOT NULL,';
		$sql .= '`back` BIGINT(20) UNSIGNED NOT NULL,';
		$sql .= 'PRIMARY KEY (`user`,`when`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$user_evolution_observations_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_OBSERVATIONS_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $user_evolution_observations_table_name . ' (';
		$sql .= '`user` bigint(20) unsigned NOT NULL,';
		$sql .= '`magnitude` bigint(20) unsigned DEFAULT NULL,';
		$sql .= '`when` DATE NOT NULL,';
		$sql .= '`observations` TEXT NOT NULL,';
		$sql .= 'PRIMARY KEY (`user`,`when`,`magnitude`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
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

	public static function search_members( $first_name, $last_name, $email, $phone, $sex, $from, $to, $personal_questionnaire_params )
	{
		$args = array(
			'role' => EpointPersonalTrainer::SPORTSMAN_ROLE
		);

		if( !empty( $email ) )
		{
			$args['search'] = $email;
		}

		$meta_args = array();

		if( !empty( $first_name ) )
		{
			$meta_args[] = array(
				'key' => 'first_name',
				'value' => $first_name ,
				'compare' => 'LIKE',
				'type' => 'CHAR'
			);
		}
		if( !empty( $last_name ) )
		{
			$meta_args[] = array(
				'key' => 'last_name',
				'value' => $last_name ,
				'compare' => 'LIKE',
				'type' => 'CHAR'
			);
		}
		if( !empty( $phone ) )
		{
			$meta_args[] = array(
				'key' => 'phone',
				'value' => $phone ,
				'compare' => 'LIKE',
				'type' => 'CHAR'
			);
		}
		if( !empty( $sex ) )
		{
			$meta_args[] = array(
				'key' => 'elite_sex',
				'value' => $sex ,
				'compare' => '=',
				'type' => 'CHAR'
			);
		}
		if( !empty( $from ) )
		{
			$meta_args[] = array(
				'key' => 'elite_birthday',
				'value' => $from,
				'compare' => '>=',
				'type' => 'DATE'
			);
		}
		if( !empty( $to ) )
		{
			$meta_args[] = array(
				'key' => 'elite_birthday',
				'value' => $to,
				'compare' => '<=',
				'type' => 'DATE'
			);
		}

		if( !empty( $personal_questionnaire_params ) )
		{
			foreach( $personal_questionnaire_params as $key => $val )
			{
				if( is_array( $val ) )
				{
					$arr = array( 'relation' => 'OR' );

					foreach( $val as $v )
						$arr[] = array(
							'key' => $key,
							'value' => $v,
							'compare' => 'LIKE',
							'type' => 'CHAR'
						);

					$meta_args[] = $arr;
				}
				else
				{
					$meta_args[] = array(
						'key' => $key,
						'value' => $val,
						'compare' => 'LIKE',
						'type' => 'CHAR'
					);
				}
			}	
		}
		

		if( !empty( $meta_args ) )
		{
			$meta_args['relation'] = 'AND';
			$args['meta_query'] = $meta_args;
		}

		$users = get_users( $args );

		return $users;
	}

	//////////////////////////////////////
	// EXERCISES
	//////////////////////////////////////

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

	public static function get_preset_exercises( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			$sql = "SELECT * FROM $table_name WHERE `trainer` IS NULL";
			return $wpdb->get_results( $sql );
		}
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

	public static function create_exercise( $name, $position, $active, $description = null, $video = null, $image_start = null, $image_end = null, $categories = array(), $corrections = array(), $trainer = null, $user = null )
	{
		global $wpdb;

		if( !is_array( $categories ) )
			return false;

		$cat_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;
		$categories_count = count( $categories );
		if( $categories_count )
		{
			$cat_string = '(' . implode( ',', $categories ) . ')';
			$sql = $wpdb->prepare( "SELECT count(ID) = %d FROM $cat_table_name WHERE ID IN $cat_string", $categories_count );
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
				'trainer' => $trainer,
				'user' => $user
			),
			array( '%s', '%d', '%d', '%s', '%s', '%d', '%d', '%d', '%d' )
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

	public static function get_exercise_related_categories( $exercise_id, $int_array = false )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;

		if( !$int_array )
			return $wpdb->get_results( $wpdb->prepare( "SELECT cat_exercise_id FROM $table_name WHERE exercise_id = %d", $exercise_id ) );
		else
			return $wpdb->get_col( $wpdb->prepare( "SELECT cat_exercise_id FROM $table_name WHERE exercise_id = %d", $exercise_id ) );
	}

	public static function get_exercise_related_categories_names( $exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		return $wpdb->get_col( $wpdb->prepare( "SELECT cf.name AS 'name' FROM $table_name cff INNER JOIN $cat_table_name cf ON cff.cat_exercise_id = cf.ID WHERE cff.exercise_id = %d", $exercise_id ) );
	}

	public static function get_exercise_correction( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_CORRECTION_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_exercise_corrections( $exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_CORRECTION_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE exercise_id = %d ORDER BY `position` ASC", $exercise_id ) );
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

	public static function get_preset_exercise_categories_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name WHERE `trainer` IS NULL");
	}

	public static function get_preset_exercise_categories( $results = null, $offset = null, $order_by = null, $order = null )
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
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL  ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY position ASC");
		}
	}

	public static function get_available_exercise_categories( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$trainer_id = (int)$trainer_id;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'active' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL OR `trainer` = $trainer_id ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL OR `trainer` = $trainer_id ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` IS NULL OR `trainer` = $trainer_id ORDER BY position ASC");
		}
	}

	public static function get_trainer_exercise_categories( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$trainer_id = (int)$trainer_id;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'active' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` = $trainer_id ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` = $trainer_id ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `trainer` = $trainer_id ORDER BY position ASC");
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

	public static function is_valid_name_for_new_exercise_category( $name, $trainer )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `name` = %s AND ( `trainer` = %d OR `trainer` IS NULL)", $name, $trainer );

		$results = $wpdb->get_results( $sql );

		return empty( $results );
	}

	public static function get_last_exercise_category()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";

		return $wpdb->get_row( $sql );
	}

	public static function create_exercise_category( $name, $position, $active, $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%d' )
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
 
	public static function delete_exercise_category( $cat_exercise_id, $delete_linked_exercises = false )
	{
		global $wpdb;

		$exercises = $delete_linked_exercises ? self::get_exercises_in_category( $cat_exercise_id, true ) : array();

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$del = $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$cat_exercise_id ),
			array( '%d' )
		);
		if( $del === false )
			return $del;

		if( !$delete_linked_exercises )
		{
			return $del;
		}
		else
		{
			foreach( $exercises as $ex )
				self::delete_exercise( $ex );

			return $del;
		}
	}

	public static function get_exercises_in_category( $cat_id, $int_array = false )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;

		if( !$int_array )
			return $wpdb->get_results( $wpdb->prepare( "SELECT exercise_id FROM $table_name WHERE cat_exercise_id = %d", $cat_id ) );
		else
			return $wpdb->get_col( $wpdb->prepare( "SELECT exercise_id FROM $table_name WHERE cat_exercise_id = %d", $cat_id ) );
	}

	public static function get_exercises_in_category_objects( $cat_id, $trainer = null, $user = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;
		$rel_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;
		if( $trainer === null && $user === null )
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN ( SELECT exercise_id FROM $rel_name WHERE cat_exercise_id = %d ) ORDER BY `trainer` DESC", $cat_id ) );
		elseif( $trainer !== null && $user === null )
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN ( SELECT exercise_id FROM $rel_name WHERE cat_exercise_id = %d ) AND (`trainer` = %d  OR `trainer` IS NULL ) ORDER BY `trainer` DESC", $cat_id, $trainer) );
		elseif( $trainer === null && $user !== null )
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN ( SELECT exercise_id FROM $rel_name WHERE cat_exercise_id = %d ) AND (`user` = %d  OR `user` IS NULL ) ORDER BY `trainer` DESC", $cat_id, $user) );
		else
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN ( SELECT exercise_id FROM $rel_name WHERE cat_exercise_id = %d ) AND (`user` = %d  OR `user` IS NULL ) AND (`trainer` = %d  OR `trainer` IS NULL ) ORDER BY `trainer` DESC", $cat_id, $user, $trainer ) );

	}

	//////////////////////////////////////
	// OBJECTIVE
	//////////////////////////////////////

	public static function get_objective( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_objectives_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_objectives( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_trainer_objectives( $trainer_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;

		$query = $trainer_id !== null ? 
			$wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d ORDER BY position ASC", $trainer_id ) :
			"SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY position ASC";

		return $wpdb->get_results( $query );
	}

	public static function create_objective( $name, $position, $active, $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function update_objective( $id, $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;
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
 
	public static function delete_objective( $objective_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$objective_id ),
			array( '%d' )
		);
	}

	//////////////////////////////////////
	// ENVIRONMENT
	//////////////////////////////////////

	public static function get_environment( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_environments_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_environments( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_trainer_environments( $trainer_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;

		$query = $trainer_id !== null ? 
			$wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d ORDER BY position ASC", $trainer_id ) :
			"SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY position ASC";

		return $wpdb->get_results( $query );
	}

	public static function create_environment( $name, $position, $active, $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function update_environment( $id, $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;
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
 
	public static function delete_environment( $environment_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$environment_id ),
			array( '%d' )
		);
	}

	//////////////////////////////////////
	// TRAINING
	//////////////////////////////////////

	public static function get_preset_training_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name WHERE `user` IS NULL AND `trainer` IS NULL");
	}

	public static function get_training_items( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_preset_training_items( $results = null, $offset = null, $order_by = null, $order = null, $volume = false, $maintenance = false, $definition = false, $house = false, $outdoors = false, $gym = false )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$conds = '';
		if( $volume || $maintenance || $definition || $house || $outdoors || $gym )
		{
			$conds = array();
			if( $volume ) $conds[] = ' `objective_volume` = 1 ';
			if( $maintenance ) $conds[] = ' `objective_maintenance` = 1 ';
			if( $definition ) $conds[] = ' `objective_definition` = 1 ';
			if( $house ) $conds[] = ' `environment_house` = 1 ';
			if( $outdoors ) $conds[] = ' `environment_outdoors` = 1 ';
			if( $gym ) $conds[] = ' `environment_gym` = 1 ';

			$conds = implode( 'AND', $conds );
		}

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !empty( $conds ) )
				$conds = ' AND ' . $conds;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` IS NULL $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` IS NULL $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` IS NULL $conds $order ORDER BY position ASC");
		}
	}

	public static function get_trainer_training_templates( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null, $volume = false, $maintenance = false, $definition = false, $house = false, $outdoors = false, $gym = false )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$conds = '';
		if( $volume || $maintenance || $definition || $house || $outdoors || $gym )
		{
			$conds = array();
			if( $volume ) $conds[] = ' `objective_volume` = 1 ';
			if( $maintenance ) $conds[] = ' `objective_maintenance` = 1 ';
			if( $definition ) $conds[] = ' `objective_definition` = 1 ';
			if( $house ) $conds[] = ' `environment_house` = 1 ';
			if( $outdoors ) $conds[] = ' `environment_outdoors` = 1 ';
			if( $gym ) $conds[] = ' `environment_gym` = 1 ';

			$conds = implode( 'AND', $conds );
		}

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !empty( $conds ) )
				$conds = ' AND ' . $conds;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` = $trainer_id $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` = $trainer_id $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` = $trainer_id $conds $order ORDER BY position ASC");
		}
	}

	public static function get_trainer_assigned_training( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null, $volume = false, $maintenance = false, $definition = false, $house = false, $outdoors = false, $gym = false )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$conds = '';
		if( $volume || $maintenance || $definition || $house || $outdoors || $gym )
		{
			$conds = array();
			if( $volume ) $conds[] = ' `objective_volume` = 1 ';
			if( $maintenance ) $conds[] = ' `objective_maintenance` = 1 ';
			if( $definition ) $conds[] = ' `objective_definition` = 1 ';
			if( $house ) $conds[] = ' `environment_house` = 1 ';
			if( $outdoors ) $conds[] = ' `environment_outdoors` = 1 ';
			if( $gym ) $conds[] = ' `environment_gym` = 1 ';

			$conds = implode( 'AND', $conds );
		}

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !empty( $conds ) )
				$conds = ' AND ' . $conds;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NOT NULL AND `trainer` = $trainer_id $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NOT NULL AND `trainer` = $trainer_id $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NOT NULL AND `trainer` = $trainer_id $conds $order ORDER BY position ASC");
		}
	}

	public static function get_trainer_available_training_items( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null, $objective = null, $environment = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$objective_table = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;
		$environment_table = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;

		$conds = array();
		if( !empty( $objective ) )
		{
			$conds[] = " `ID` IN (SELECT `training_id` FROM $objective_table WHERE `training_id` = `ID` AND `objective_id` = " . (int)$objective . ") ";
		}
		if( !empty( $environment ) )
		{
			$conds[] = " `ID` IN (SELECT `training_id` FROM $environment_table WHERE `training_id` = `ID` AND `environment_id` = " . (int)$environment . ") ";
		}
		$conds = empty( $conds ) ? '' : implode( ' AND ', $conds );
//var_dump( $conds );die();

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !empty( $conds ) )
				$conds = ' AND ' . $conds;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds $order ORDER BY position ASC");
		}
	}

	public static function get_unassigned_trainer_available_training_items( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null, $objective = null, $environment = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$objective_table = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;
		$environment_table = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;

		$conds = array();
		if( !empty( $objective ) )
		{
			$conds[] = " `ID` IN (SELECT `training_id` FROM $objective_table WHERE `training_id` = `ID` AND `objective_id` = " . (int)$objective . ") ";
		}
		if( !empty( $environment ) )
		{
			$conds[] = " `ID` IN (SELECT `training_id` FROM $environment_table WHERE `training_id` = `ID` AND `environment_id` = " . (int)$environment . ") ";
		}
		$conds = empty( $conds ) ? '' : implode( ' AND ', $conds );
//var_dump( $conds );die();

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !empty( $conds ) )
				$conds = ' AND ' . $conds;

/*
			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
*/
			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND (  `trainer` = $trainer_id ) $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND ( `trainer` = $trainer_id ) $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			//return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds $order ORDER BY position ASC");
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND ( `trainer` = $trainer_id ) $conds $order ORDER BY position ASC");
		}
	}

	public static function get_user_training_count( $user_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		return $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $table_name WHERE `user` = %d", $user_id ) );
	}

	public static function get_user_training_items( $user_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'start', 'end' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order", $user_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order LIMIT $results OFFSET $offset", $user_id ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY position ASC", $user_id ) );
		}
	}

	public static function get_training_search_results( $user, $name, $preset = true )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$where = 'WHERE `active` = 1';

		if( $preset )
			$where .= " AND `user` IS NULL";
		else
			$where .= " AND `user` IS NOT NULL";

		if( !empty( $name ) && is_string( $name ) )
		{
			if( mb_strlen( $name ) < 3 )
				$name = $name . '%';
			else
				$name = '%' . $name . '%';

			$where .= $wpdb->prepare( " AND `name` LIKE %s", $name );
		}

		$sql = "SELECT `ID`, `name` FROM $table_name $where ORDER BY position ASC";

		return $wpdb->get_results( $sql );
	}

	public static function get_training( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_training( $user_id = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		if( $user_id === null )
			$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";
		else
			$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `user`= %d ORDER BY `start` DESC, ID DESC LIMIT 1", $user_id );

		return $wpdb->get_row( $sql );
	}

	public static function get_training_items_ending_in_date( $date )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` IS NOT NULL AND `end` = %s", $date );

		return $wpdb->get_results( $sql );
	}
/*
	public static function create_training(
		$name,
		$position,
		$active,
		$description = null,
		$start = null,
		$end = null,
		$objective_volume = 0,
		$objective_maintenance = 0,
		$objective_definition = 0,
		$environment_house = 0,
		$environment_outdoors = 0,
		$environment_gym = 0,
		$user = null,
		$trainer = null,
		$exercises = array()
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'objective_volume' => $objective_volume,
				'objective_maintenance' => $objective_maintenance,
				'objective_definition' => $objective_definition,
				'environment_house' => $environment_house,
				'environment_outdoors' => $environment_outdoors,
				'environment_gym' => $environment_gym,
				'user' => $user,
				'trainer' => $trainer
			), 
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		$training_id = $wpdb->insert_id;

		if( !empty( $exercises ) )
		{
			$training_exercise_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;
			foreach( $exercises as $exercise_id => $exercise )
			{
				$saved = date( 'Y-m-d H:i:s' );
				if( false === $wpdb->insert(
					$training_exercise_table,
					array(
						'training_id' => $training_id,
						'exercise_id' => $exercise_id,
						'position' => isset( $exercise['position'] ) ? (int)$exercise['position'] : 0,
						'saved' => $saved,
						'description' => $exercise['description'],
						'series' => $exercise['series'],
						'repetitions' => $exercise['repetitions'],
						'loads' => $exercise['loads']
					),
					array( '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s' )
				) )
					return false;

			}
		}

		return $training_id;
	}

	public static function update_training(
		$id,
		$name,
		$position,
		$active,
		$description = null,
		$start = null,
		$end = null,
		$objective_volume = 0,
		$objective_maintenance = 0,
		$objective_definition = 0,
		$environment_house = 0,
		$environment_outdoors = 0,
		$environment_gym = 0,
		$user = null,
		$trainer = null,
		$exercises = array()
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'objective_volume' => $objective_volume,
				'objective_maintenance' => $objective_maintenance,
				'objective_definition' => $objective_definition,
				'environment_house' => $environment_house,
				'environment_outdoors' => $environment_outdoors,
				'environment_gym' => $environment_gym,
				'user' => $user,
				'trainer' => $trainer
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		$training_exercises_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;
		if( empty( $exercises ) )
		{
			if( false === $wpdb->delete(
				$training_exercises_table,
				array( 'training_id' => (int)$id ),
				array( '%d' )
			) )
				return false;
		}
		else
		{
			$ides_string = '(' . implode( ',', array_keys( $exercises ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $training_exercises_table WHERE `training_id` = %d AND `exercise_id` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			$saved = date( 'Y-m-d H:i:s' );
			foreach( $exercises as $exercise_id => $exercise )
				$cads[] = '(' . implode( ',', array( $id, $exercise_id, isset( $exercise['position'] ) ? (int)$exercise['position'] : 0,"'" . $saved . "'", "'" . $exercise['description'] . "'", "'" . $exercise['series'] . "'", "'" . $exercise['repetitions'] . "'", "'" . $exercise['loads'] . "'" ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $training_exercises_table (`training_id`, `exercise_id`, `position`, `saved`,`description`, `series`, `repetitions`, `loads` ) VALUES $values_string ON DUPLICATE KEY UPDATE `training_id` = VALUES(`training_id`), `exercise_id` = VALUES(`exercise_id`), `position` = VALUES(`position`), `saved` = VALUES(`saved`), `description` = VALUES(`description`), `series` = VALUES(`series`), `repetitions` = VALUES(`repetitions`), `loads` = VALUES(`loads`)";
			if( false === $wpdb->query( $sql ) )
				return false;
		}


		return true;
	}
*/ 

	protected static function insert_exercises_in_training( $training_id, $exercises )
	{
		global $wpdb;

		$training_exercise_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;
		foreach( $exercises as $exercise_id => $exercise )
		{
			$saved = date( 'Y-m-d H:i:s' );
			if( false === $wpdb->insert(
				$training_exercise_table,
				array(
					'training_id' => $training_id,
					'exercise_id' => $exercise_id,
					'position' => isset( $exercise['position'] ) ? (int)$exercise['position'] : 0,
					'saved' => $saved,
					'description' => $exercise['description'],
					'series' => $exercise['series'],
					'repetitions' => $exercise['repetitions'],
					'loads' => $exercise['loads']
				),
				array( '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s' )
			) )
				return false;
		}

		return true;
	}

	/**
	 * $objectives = array( $objective_id => array( 'objective' => $objective_id, ... )
	 */
	protected static function insert_objectives_in_training( $training_id, $objectives )
	{
		global $wpdb;

		$training_objective_table = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;
		// $ojbective ahora mismo es un array vacio, pero sera util si se le añaden columnas a esta tabla
		foreach( $objectives as $objective_id => $objective )
		{
			if( false === $wpdb->insert(
				$training_objective_table,
				array(
					'training_id' => $training_id,
					'objective_id' => $objective_id,
				),
				array( '%d', '%d' )
			) )
				return false;
		}

		return true;
	}

	/**
	 * $environments = array( $environment_id => array( 'environment' => $environment_id, ... )
	 */
	protected static function insert_environments_in_training( $training_id, $environments )
	{
		global $wpdb;

		$training_environment_table = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;
		// $environment ahora mismo es un array vacio, pero sera util si se le añaden columnas a esta tabla
		foreach( $environments as $environment_id => $environment )
		{
			if( false === $wpdb->insert(
				$training_environment_table,
				array(
					'training_id' => $training_id,
					'environment_id' => $environment_id,
				),
				array( '%d', '%d' )
			) )
				return false;

		}

		return true;
	}

	public static function create_training(
		$name,
		$position,
		$active,
		$description = null,
		$start = null,
		$end = null,
		$user = null,
		$trainer = null,
		$exercises = array(),
		$objectives = array(),
		$environments = array(),
		$observations = null
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'observations' => $observations,
				'user' => $user,
				'trainer' => $trainer
			), 
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%s', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		$training_id = $wpdb->insert_id;

		if( !empty( $exercises ) )
		{
			if( !self::insert_exercises_in_training( $training_id, $exercises ) )
				return false;
		}

		if( !empty( $objectives ) )
		{
			if( !self::insert_objectives_in_training( $training_id, $objectives ) )
				return false;
		}

		if( !empty( $environments ) )
		{
			if( !self::insert_environments_in_training( $training_id, $environments ) )
				return false;
		}

		return $training_id;
	}

	public static function duplicate_training(
		$training_id,
		$assign_trainer = false,
		$assign_user = false,
		$assign_start_date = false,
		$assign_end_date = false
	) {
		global $wpdb;

		$training = self::get_training( $training_id );
		if( !$training )
			return false;

		$ex_arr = array();
		$exercises = self::get_training_exercises_data( $training_id );
		foreach( $exercises as $exercise )
		{
			$ex_arr[$exercise->exercise_id] = array(
				'exercise' => $exercise->exercise_id,
				'position' => $exercise->position,
				'description' => $exercise->description,
				'series' => $exercise->series,
				'repetitions' => $exercise->repetitions,
				'loads' => $exercise->loads
			);
		}

		$obj_arr = array();
		$objectives = EpointPersonalTrainerMapper::get_training_objectives( $training_id );
		foreach( $objectives as $objective )
		{
			$obj_arr[$objective->objective_id] = array(
				'objective' => $objective->objective_id
			);
		}

		$env_arr = array();
		$environments = EpointPersonalTrainerMapper::get_training_environments( $training_id );
		foreach( $environments as $environment )
		{
			$env_arr[$environment->environment_id] = array(
				'environment' => $environment->environment_id
			);
		}

		return self::create_training(
			$training->name,
			$training->position,
			$training->active,
			$training->description,
			$assign_start_date !== false ? $assign_start_date : $training->start,
			$assign_end_date !== false ? $assign_end_date : $training->end,
			$assign_user !== false ? $assign_user : $training->user,
			$assign_trainer !== false ? $assign_trainer : $training->trainer,
			$ex_arr,
			$obj_arr,
			$env_arr
		);
	}

	public static function update_training(
		$id,
		$name,
		$position,
		$active,
		$description = null,
		$start = null,
		$end = null,
		$user = null,
		$trainer = null,
		$exercises = array(),
		$objectives = array(),
		$environments = array()
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'user' => $user,
				'trainer' => $trainer
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d', '%d' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		$training_exercises_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;
		if( empty( $exercises ) )
		{
			if( false === $wpdb->delete(
				$training_exercises_table,
				array( 'training_id' => (int)$id ),
				array( '%d' )
			) )
				return false;
		}
		else
		{
			$ides_string = '(' . implode( ',', array_keys( $exercises ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $training_exercises_table WHERE `training_id` = %d AND `exercise_id` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			$saved = date( 'Y-m-d H:i:s' );
			foreach( $exercises as $exercise_id => $exercise )
				$cads[] = '(' . implode( ',', array( $id, $exercise_id, isset( $exercise['position'] ) ? (int)$exercise['position'] : 0,"'" . $saved . "'", "'" . $exercise['description'] . "'", "'" . $exercise['series'] . "'", "'" . $exercise['repetitions'] . "'", "'" . $exercise['loads'] . "'" ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $training_exercises_table (`training_id`, `exercise_id`, `position`, `saved`,`description`, `series`, `repetitions`, `loads` ) VALUES $values_string ON DUPLICATE KEY UPDATE `training_id` = VALUES(`training_id`), `exercise_id` = VALUES(`exercise_id`), `position` = VALUES(`position`), `saved` = VALUES(`saved`), `description` = VALUES(`description`), `series` = VALUES(`series`), `repetitions` = VALUES(`repetitions`), `loads` = VALUES(`loads`)";
			if( false === $wpdb->query( $sql ) )
				return false;
		}

		$training_objective_table = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;
		if( empty( $objectives ) )
		{
			if( false === $wpdb->delete(
				$training_objective_table,
				array( 'training_id' => (int)$id ),
				array( '%d' )
			) )
				return false;
		}
		else
		{
			$ides_string = '(' . implode( ',', array_keys( $objectives ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $training_objective_table WHERE `training_id` = %d AND `objective_id` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			foreach( $objectives as $objective_id => $objective )
				$cads[] = '(' . implode( ',', array( $id, $objective_id ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $training_objective_table (`training_id`, `objective_id` ) VALUES $values_string ON DUPLICATE KEY UPDATE `training_id` = VALUES(`training_id`), `objective_id` = VALUES(`objective_id`)";
			if( false === $wpdb->query( $sql ) )
				return false;
		}

		$training_environment_table = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;
		if( empty( $environments ) )
		{
			if( false === $wpdb->delete(
				$training_environment_table,
				array( 'training_id' => (int)$id ),
				array( '%d' )
			) )
				return false;
		}
		else
		{
			$ides_string = '(' . implode( ',', array_keys( $environments ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $training_environment_table WHERE `training_id` = %d AND `environment_id` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			foreach( $environments as $environment_id => $environment )
				$cads[] = '(' . implode( ',', array( $id, $environment_id ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $training_environment_table (`training_id`, `environment_id` ) VALUES $values_string ON DUPLICATE KEY UPDATE `training_id` = VALUES(`training_id`), `environment_id` = VALUES(`environment_id`)";
			if( false === $wpdb->query( $sql ) )
				return false;
		}

		return true;
	}

	public static function set_training_video( $id, $video )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'video' => $video
			),
			array(
				'ID' => (int)$id
			),
			array( '%s' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		return true;
	}

	public static function is_training_active( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$res = $wpdb->get_var( $wpdb->prepare( "SELECT `active` FROM $table_name WHERE `ID` = %d", $training_id ) );

		return !empty( $res );
	}

	public static function set_training_active( $id, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'active' => $active ? 1 : 0
			),
			array(
				'ID' => (int)$id
			),
			array( '%d' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		return true;
	}

	public static function set_training_observations( $id, $observations )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'observations' => $observations
			),
			array(
				'ID' => (int)$id
			),
			array( '%s' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		return true;
	}

	public static function delete_training( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$training_id ),
			array( '%d' )
		);
	}

	public static function get_training_exercises( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;
		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT e.ID as 'ID', e.`name` AS 'name', e.`image_start` AS 'image_start', e.`image_end` AS 'image_end', e.`trainer` AS 'trainer', e.`description` AS  'description', te.`description` AS 'extradescription', e.`video` AS 'video', te.`position` AS 'position', te.`series` AS 'series', te.`repetitions` AS 'repetitions', te.`loads` AS 'loads' FROM $table_name e INNER JOIN $rel_table te ON e.ID = te.`exercise_id` WHERE te.`training_id` = %d AND te.`saved` = (SELECT tee.`saved` FROM $rel_table tee WHERE tee.`training_id` = te.`training_id` AND tee.`exercise_id` = te.`exercise_id` ORDER BY tee.`saved` DESC LIMIT 1) GROUP BY te.`training_id`, te.`exercise_id` ORDER BY te.`position` ASC", $training_id );

		return $wpdb->get_results( $sql );
	}

	public static function get_training_exercises_data( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name te WHERE `training_id` = %d AND `saved` = (SELECT tee.`saved` FROM $table_name tee WHERE tee.`training_id` = te.`training_id` AND tee.`exercise_id` = te.`exercise_id` ORDER BY tee.`saved` DESC LIMIT 1)", $training_id );

		return $wpdb->get_results( $sql );
	}

	public static function get_training_exercise_data( $training_id, $exercise_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name te WHERE `training_id` = %d AND `exercise_id` = %d AND `saved` = (SELECT tee.`saved` FROM $table_name tee WHERE tee.`training_id` = te.`training_id` AND tee.`exercise_id` = te.`exercise_id` ORDER BY tee.`saved` DESC LIMIT 1)", $training_id, $exercise_id );

		return $wpdb->get_row( $sql );
	}


	public static function get_training_exercises_historial( $training_id, $exercise_id )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT DISTINCT te.`series` AS 'series', te.`repetitions` AS 'repetitions', te.`loads` AS 'loads', te.`saved` AS `saved` FROM $rel_table te WHERE te.`training_id` = %d AND te.`exercise_id` = %d ORDER BY te.`saved` DESC", $training_id, $exercise_id );

		return $wpdb->get_results( $sql );
	}

	public static function clear_training_exercises_historial( $training_id, $exercise_id )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "DELETE FROM $rel_table WHERE `training_id` = %d AND `exercise_id` = %d AND `saved` <> ( SELECT s FROM ( SELECT MAX(`saved`) AS s FROM $rel_table WHERE `training_id` = %d AND `exercise_id` = %d ) AS maxdate )", $training_id, $exercise_id, $training_id, $exercise_id );

		return $wpdb->query( $sql );
	}

	public static function delete_training_exercises_historial_element( $training_id, $exercise_id, $saved )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "DELETE FROM $rel_table WHERE `training_id` = %d AND `exercise_id` = %d AND `saved` = %s", $training_id, $exercise_id, $saved );

		return $wpdb->query( $sql );
	}

	public static function exercise_belongs_to_training( $training_id, $exercise_id )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT te.`exercise_id` AS 'exercise' FROM $rel_table te WHERE te.`training_id` = %d AND te.`exercise_id` = %d", $training_id, $exercise_id );

		return $wpdb->get_var( $sql );
	}

	public static function get_last_training_exercise_data( $training_id, $exercise_id )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		//$sql = $wpdb->prepare( "SELECT * FROM wp_epoint_personal_training_training_exercise WHERE `training_id` = %d AND `exercise_id` = %d ORDER BY `saved` DESC LIMIT 1", $training_id, $exercise_id );
		$sql = $wpdb->prepare( "SELECT * FROM $rel_table WHERE `training_id` = %d AND `exercise_id` = %d ORDER BY `saved` DESC LIMIT 1", $training_id, $exercise_id );

		return $wpdb->get_row( $sql );
	}
	
	public static function update_training_exercise_data( $training_id, $exercise_id, $position, $description, $repetitions, $series, $loads )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$saved = date( 'Y-m-d H:i:s' );

		$sql = $wpdb->prepare("INSERT INTO $rel_table (`training_id`, `exercise_id`, `position`, `saved`,`description`, `series`, `repetitions`, `loads` ) VALUES ( %d , %d , %d, %s , %s , %s , %s , %s ) ON DUPLICATE KEY UPDATE `training_id` = VALUES(`training_id`), `exercise_id` = VALUES(`exercise_id`), `position` = VALUES(`position`), `saved` = VALUES(`saved`), `description` = VALUES(`description`), `series` = VALUES(`series`), `repetitions` = VALUES(`repetitions`), `loads` = VALUES(`loads`)", $training_id, $exercise_id, $position, $saved, $description, $series, $repetitions, $loads );

		return $wpdb->query( $sql );
	}

	public static function get_training_objectives( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `training_id` = %d", $training_id );

		return $wpdb->get_results( $query );
	}

	public static function get_training_objectives_names( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::OBJECTIVE_TABLE;
		$rel_table = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;

		$query = $wpdb->prepare( "SELECT o.name FROM $rel_table ot INNER JOIN $table_name o ON ot.objective_id = o.ID  WHERE ot.`training_id` = %d", $training_id );

		return $wpdb->get_col( $query );
	}

	public static function is_training_objective( $training_id, $objective_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_OBJECTIVE_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `training_id` = %d AND `objective_id` = %d", $training_id, $objective_id );

		$res = $wpdb->get_results( $query );

		return !empty( $res );
	}

	public static function get_training_environments( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `training_id` = %d", $training_id );

		return $wpdb->get_results( $query );
	}

	public static function get_training_environments_names( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::ENVIRONMENT_TABLE;
		$rel_table = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;

		$query = $wpdb->prepare( "SELECT e.name FROM $rel_table et INNER JOIN $table_name e ON et.environment_id = e.ID  WHERE et.`training_id` = %d", $training_id );

		return $wpdb->get_col( $query );
	}

	public static function is_training_environment( $training_id, $environment_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_ENVIRONMENT_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `training_id` = %d AND `environment_id` = %d", $training_id, $environment_id );

		$res = $wpdb->get_results( $query );

		return !empty( $res );
	}

	//////////////////////////////////////
	// CAT FOOD
	//////////////////////////////////////

	public static function get_food_categories_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_food_categories( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'active' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `blog` IS NULL ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `blog` IS NULL ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE `blog`IS NULL ORDER BY position ASC");
		}
	}

	public static function get_blog_food_categories( $blog, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'active' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `blog`= %d ORDER BY $order_by $order", $blog ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `blog`= %d ORDER BY $order_by $order LIMIT $results OFFSET $offset", $blog ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `blog` = %d ORDER BY position ASC", $blog ) );
		}
	}

	public static function get_food_category( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_food_category_by_name( $name )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `name` = %s", $name );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_food_category()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";

		return $wpdb->get_row( $sql );
	}

	public static function is_valid_name_for_new_food_category( $name, $blog )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		//$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `name` = %s AND ( `blog` = %d OR `blog` IS NULL)", $name, $trainer );
		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `name` = %s AND `blog` = %d", $name, $blog );

		$results = $wpdb->get_results( $sql );

		return empty( $results );
	}

	public static function create_food_category( $name, $position, $active, $trainer = null, $blog = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'trainer' => $trainer,
				'blog' => $blog
			),
			array( '%s', '%d', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function update_food_category( $id, $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
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
 
	public static function delete_food_category( $cat_food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$cat_food_id ),
			array( '%d' )
		);
	}


	//////////////////////////////////////
	// FOOD
	//////////////////////////////////////

	public static function get_food_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_food_items( $results = null, $offset = null, $order_by = null, $order = null, $food_category = null, $user = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$cat_table = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		$cat_cond = '';
		if( is_numeric( $food_category ) )
			$cat_cond = " WHERE `ID` IN ( SELECT DISTINCT `food_id` FROM $cat_table WHERE `cat_food_id` = " . (int)$food_category . " ) ";

		if( $user )
		{
			if( empty( $cat_cond ) )
				$cat_cond = " WHERE `user` IS NULL OR `user` = $user ";
			else
				$cat_cond .= " AND ( `user` IS NULL OR `user` = $user ) ";
		}

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name $cat_cond ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name $cat_cond ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name $cat_cond ORDER BY position ASC");
		}
	}

	public static function get_food_items_grouped_by_category( $active = null, $user = null, $blog = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$cat_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		if( $active !== null )
		{
			if( $blog )
				$sql = $wpdb->prepare( "SELECT * FROM $cat_table_name WHERE `active` = %d AND `blog` = %d ORDER BY `position` ASC", $active ? 1 : 0, $blog );
			else
				$sql = $wpdb->prepare( "SELECT * FROM $cat_table_name WHERE `active` = %d AND `blog` IS NULL ORDER BY `position` ASC", $active ? 1 : 0 );
		}
		else
		{
			if( $blog )
				$sql = $wpdb->prepare( "SELECT * FROM $cat_table_name WHERE `blog` = %d ORDER BY `position` ASC", $blog );
			else
				$sql = "SELECT * FROM $cat_table_name WHERE `blog` IS NULL ORDER BY `position` ASC";
		}

		$categories = $wpdb->get_results( $sql );
		if( !is_array( $categories ) )
			return false;

		foreach( $categories as $category )
		{
			if( !$user )
				$category->food = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` = %d ) ORDER BY `name` ASC", $category->ID ) );  
			else
				$category->food = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE ( `user` IS NULL OR `user` = %d ) AND `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` = %d ) ORDER BY `name` ASC", $user, $category->ID ) );  

		}

		return $categories;
	}

	public static function get_blog_food_items( $blog )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$cat_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT `ID` FROM $cat_table_name WHERE `blog` = %d ORDER BY `position` ASC", $blog );
		$categories = $wpdb->get_col( $sql );
		$categories_str = '(' . implode( ',', $categories ) . ')';
		$food = $wpdb->get_results( "SELECT * FROM $table_name WHERE `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` IN " . $categories_str . " ) ORDER BY `name` ASC" );  

		return $food;
/*
////
		if( $active !== null )
		{
			if( $blog )
				$sql = $wpdb->prepare( "SELECT * FROM $cat_table_name WHERE `active` = %d AND `blog` = %d ORDER BY `position` ASC", $active ? 1 : 0, $blog );
			else
				$sql = $wpdb->prepare( "SELECT * FROM $cat_table_name WHERE `active` = %d AND `blog` IS NULL ORDER BY `position` ASC", $active ? 1 : 0 );
		}
		else
		{
			if( $blog )
				$sql = $wpdb->prepare( "SELECT * FROM $cat_table_name WHERE `blog` = %d ORDER BY `position` ASC", $blog );
			else
				$sql = "SELECT * FROM $cat_table_name WHERE `blog` IS NULL ORDER BY `position` ASC";
		}

		$categories = $wpdb->get_results( $sql );
		if( !is_array( $categories ) )
			return false;

		foreach( $categories as $category )
		{
			if( !$user )
				$category->food = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` = %d ) ORDER BY `position` ASC", $category->ID ) );  
			else
				$category->food = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE ( `user` IS NULL OR `user` = %d ) AND `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` = %d ) ORDER BY `position` ASC", $user, $category->ID ) );  

		}

		return $categories;
*/
	}

	public static function get_blog_food_items_for_user( $blog, $user_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$cat_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT `ID` FROM $cat_table_name WHERE `blog` = %d ORDER BY `position` ASC", $blog );
		$categories = $wpdb->get_col( $sql );
		$categories_str = '(' . implode( ',', $categories ) . ')';
		$food = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` IN " . $categories_str . " ) AND ( `user` IS NULL OR `user` = %d ) ORDER BY `name` ASC", $user_id ) );  

		return $food;
	}


	public static function get_food_items_count_in_category( $category_id )
	{
		global $wpdb;

		$cat_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		return $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $cat_food_table_name WHERE `cat_food_id` = %d", $category_id ) );  

	}

	public static function get_food( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_food()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";

		return $wpdb->get_row( $sql );
	}

	public static function create_food( $name, $position, $active, $categories = array(), $user = null, $trainer = null )
	{
		global $wpdb;

		if( !is_array( $categories ) )
			return false;

		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$categories_count = count( $categories );
		if( $categories_count )
		{
			$cat_string = '(' . implode( ',', $categories ) . ')';
			$sql = "SELECT count(ID) = $categories_count FROM $cat_table_name WHERE ID IN $cat_string";
			if( !$wpdb->get_var( $sql ) )
				return false;
		}

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'user' => $user,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		$food_id = $wpdb->insert_id;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;
		foreach( $categories as $category )
			if( false === $wpdb->insert(
				$table_name,
				array(
					'food_id' => $food_id,
					'cat_food_id' => $category
				),
				array( '%d', '%d' )
			) )
				return false;

		return $food_id;
	}

	public static function update_food( $id, $name, $position, $active, $categories = array() )
	{
		global $wpdb;

		$map_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		if( !empty( $categories ) )
		{
			$cat_string = '(' . implode( ',', $categories ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $map_table_name WHERE `food_id` = %d AND `cat_food_id` NOT IN $cat_string", $id );
			$wpdb->query( $sql );

			$pairs = array();
			foreach( $categories as $category )
				$pairs[] = "($id, $category)";
			$pairs_string = implode( ',', $pairs );
			$sql = "INSERT INTO $map_table_name (`food_id`,`cat_food_id`) VALUES $pairs_string ON DUPLICATE KEY UPDATE `food_id` = `food_id`, `cat_food_id` = `cat_food_id`";
			$wpdb->query( $sql );
		}
		else
		{
			$sql = $wpdb->prepare( "DELETE FROM $map_table_name WHERE `food_id` = %d", $id );
			$wpdb->query( $sql );
		}

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
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
 
	public static function delete_food( $food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$food_id ),
			array( '%d' )
		);
	}

	public static function get_food_related_categories( $food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT cat_food_id FROM $table_name WHERE food_id = %d", $food_id ) );
	}

	public static function get_food_related_categories_names( $food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT cf.name AS 'name' FROM $table_name cff INNER JOIN $cat_table_name cf ON cff.cat_food_id = cf.ID WHERE cff.food_id = %d", $food_id ) );
	}

	//////////////////////////////////////
	// DIET OBJECTIVE
	//////////////////////////////////////

	public static function get_diet_objective( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_diet_objectives_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_diet_objectives( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_trainer_diet_objectives( $trainer_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;

		$query = $trainer_id !== null ? 
			$wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d ORDER BY position ASC", $trainer_id ) :
			"SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY position ASC";

		return $wpdb->get_results( $query );
	}

	public static function is_diet_objective( $diet_id, $objective_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_DIET_OBJECTIVE_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `diet_id` = %d AND `objective_id` = %d", $diet_id, $objective_id );

		$res = $wpdb->get_results( $query );

		return !empty( $res );
	}

	public static function get_diet_objectives_names( $diet_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;
		$rel_table = $wpdb->base_prefix . self::DIET_DIET_OBJECTIVE_TABLE;

		$query = $wpdb->prepare( "SELECT o.name FROM $rel_table ot INNER JOIN $table_name o ON ot.objective_id = o.ID  WHERE ot.`diet_id` = %d", $diet_id );

		return $wpdb->get_col( $query );
	}

	public static function get_diet_related_objectives( $diet_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;
		$rel_table = $wpdb->base_prefix . self::DIET_DIET_OBJECTIVE_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN ( SELECT `objective_id` FROM $rel_table WHERE `diet_id` = %d)", $diet_id );

		return $wpdb->get_results( $query );
	}

	public static function create_diet_objective( $name, $position, $active, $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function update_diet_objective( $id, $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;
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
 
	public static function delete_diet_objective( $objective_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_OBJECTIVE_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$objective_id ),
			array( '%d' )
		);
	}

	//////////////////////////////////////
	// DIET RESTRICTIONS
	//////////////////////////////////////

	public static function get_diet_restriction( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_diet_restrictions_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_diet_restrictions( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_trainer_diet_restrictions( $trainer_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;

		$query = $trainer_id !== null ? 
			$wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d ORDER BY position ASC", $trainer_id ) :
			"SELECT * FROM $table_name WHERE `trainer` IS NULL ORDER BY position ASC";

		return $wpdb->get_results( $query );
	}

	public static function is_diet_restriction( $diet_id, $restriction_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_DIET_RESTRICTION_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `diet_id` = %d AND `restriction_id` = %d", $diet_id, $restriction_id );

		$res = $wpdb->get_results( $query );

		return !empty( $res );
	}

	public static function get_diet_restrictions_names( $diet_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;
		$rel_table = $wpdb->base_prefix . self::DIET_DIET_RESTRICTION_TABLE;

		$query = $wpdb->prepare( "SELECT o.name FROM $rel_table ot INNER JOIN $table_name o ON ot.restriction_id = o.ID  WHERE ot.`diet_id` = %d", $diet_id );

		return $wpdb->get_col( $query );
	}

	public static function get_diet_related_restrictions( $diet_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;
		$rel_table = $wpdb->base_prefix . self::DIET_DIET_RESTRICTION_TABLE;

		$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN ( SELECT `restriction_id` FROM $rel_table WHERE `diet_id` = %d)", $diet_id );

		return $wpdb->get_results( $query );
	}

	public static function create_diet_restriction( $name, $position, $active, $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function update_diet_restriction( $id, $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;
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
 
	public static function delete_diet_restriction( $diet_restriction_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_RESTRICTION_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$diet_restriction_id ),
			array( '%d' )
		);
	}

	//////////////////////////////////////
	// DIETS
	//////////////////////////////////////

	public static function get_preset_diets_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name WHERE `user` IS NULL AND `trainer` IS NULL");
	}

	public static function get_diets( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_preset_diets( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` IS NULL ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL AND `trainer` IS NULL ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name `user` IS NULL AND `trainer` IS NULL ORDER BY position ASC");
		}
	}

	public static function get_user_diets_count( $user_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		return $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $table_name WHERE `user` = %d", $user_id ) );
	}

	public static function get_user_diets( $user_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'start', 'end' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order", $user_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order LIMIT $results OFFSET $offset", $user_id ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY position ASC", $user_id ) );
		}
	}

	public static function get_trainer_diets( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'start', 'end' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d ORDER BY $order_by $order", $trainer_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d ORDER BY $order_by $order LIMIT $results OFFSET $offset", $trainer_id ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d ORDER BY ID DESC", $trainer_id ) );
		}
	}

	public static function get_unassigned_trainer_diets( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'start', 'end' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d AND `user` IS NULL ORDER BY $order_by $order", $trainer_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d AND `user` IS NULL ORDER BY $order_by $order LIMIT $results OFFSET $offset", $trainer_id ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d AND `user` IS NULL ORDER BY ID DESC", $trainer_id ) );
		}
	}

	public static function get_trainer_available_diet_items( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null, $objective = null, $restriction = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$objective_table = $wpdb->base_prefix . self::DIET_DIET_OBJECTIVE_TABLE;
		$restriction_table = $wpdb->base_prefix . self::DIET_DIET_RESTRICTION_TABLE;

		$conds = array();
		if( !empty( $objective ) )
		{
			$conds[] = " `ID` IN (SELECT `diet_id` FROM $objective_table WHERE `diet_id` = `ID` AND `objective_id` = " . (int)$objective . ") ";
		}
		if( !empty( $restriction ) )
		{
			$conds[] = " `ID` IN (SELECT `diet_id` FROM $restriction_table WHERE `diet_id` = `ID` AND `restriction_id` = " . (int)$restriction . ") ";
		}
		$conds = empty( $conds ) ? '' : implode( ' AND ', $conds );
//var_dump( $conds );die();

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !empty( $conds ) )
				$conds = ' AND ' . $conds;

/*
			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
*/
			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` = $trainer_id ) $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` = $trainer_id ) $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
/*
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` IS NULL OR `trainer` = $trainer_id ) $conds $order ORDER BY position ASC");
*/
			return $wpdb->get_results( "SELECT * FROM $table_name WHERE ( `trainer` = $trainer_id ) $conds $order ORDER BY position ASC");
		}
	}

	public static function get_trainer_assigned_diets( $trainer_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'start', 'end' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d AND `user` IS NOT NULL ORDER BY $order_by $order", $trainer_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d AND `user` IS NOT NULL ORDER BY $order_by $order LIMIT $results OFFSET $offset", $trainer_id ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d AND `user` IS NOT NULL ORDER BY ID DESC", $trainer_id ) );
		}
	}

	public static function get_diet_search_results( $user, $name, $preset = true )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$diet_food_table = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;
		$student_food_table = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		$where = 'WHERE `active` = 1';

		if( $preset )
			$where .= " AND `user` IS NULL";
		else
			$where .= " AND `user` IS NOT NULL";

		if( !empty( $name ) && is_string( $name ) )
		{
			if( mb_strlen( $name ) < 3 )
				$name = $name . '%';
			else
				$name = '%' . $name . '%';

			$where .= $wpdb->prepare( " AND `name` LIKE %s", $name );
		}

		$sql = "SELECT `ID`, `name` FROM $table_name $where ORDER BY position ASC";

		$diets = $wpdb->get_results( $sql );
		if( !is_array( $diets ) )
			return false;

		for( $i = 1; $i < 11; $i++ )
		{
			$sql = $wpdb->prepare( "SELECT d.`ID`, count(sf.`valuation`) AS 'total' FROM ( $table_name d INNER JOIN $diet_food_table dif ON d.`ID` IN ( SELECT `ID` FROM $table_name $where ORDER BY position ASC ) AND d.`ID` = dif.`diet_id` ) LEFT JOIN $student_food_table sf ON sf.`student_id` = %d AND dif.`food_id` = sf.`food_id` AND sf.`saved` = ( SELECT MAX(`saved`) FROM $student_food_table WHERE `student_id` = %d ) AND sf.`valuation` = %d GROUP BY d.`ID`", $user, $user, $i );

			$results = $wpdb->get_results( $sql );
			foreach( $results as $result )
			{
				foreach( $diets as $diet )
				{
					if( $diet->ID == $result->ID )
					{
						$key = 'valuation_' . $i;
						$diet->$key = $result->total;
					}
				}
			}
		}

		return $diets;
//SELECT d.`ID`, d.`name`, sf.`valuation` FROM ( wp_epoint_personal_training_diet d INNER JOIN wp_epoint_personal_training_diet_interval_food dif ON d.`ID` = dif.`diet_id` ) LEFT JOIN wp_epoint_personal_training_student_food sf ON sf.`student_id` = 1 AND dif.`food_id` = sf.`food_id`;
//SELECT d.`ID`, d.`name`, count(sf.`valuation`) AS "COUNT" FROM ( wp_epoint_personal_training_diet d INNER JOIN wp_epoint_personal_training_diet_interval_food dif ON d.`ID` = dif.`diet_id` ) LEFT JOIN wp_epoint_personal_training_student_food sf ON sf.`student_id` = 1 AND dif.`food_id` = sf.`food_id` AND sf.`saved` = ( SELECT MAX(`saved`) FROM wp_epoint_personal_training_student_food WHERE `student_id` = 1 ) AND sf.`valuation` = 10 GROUP BY d.`ID`;
	}

	public static function get_diets_ending_in_date( $date )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` IS NOT NULL AND `end` = %s", $date );

		return $wpdb->get_results( $sql );
	}

	public static function get_diet( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_diet( $user_id = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $user_id === null )
			$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";
		else
			$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `user`= %d ORDER BY `start` DESC, ID DESC LIMIT 1", $user_id );

		return $wpdb->get_row( $sql );
	}

	/**
	 * $objectives = array( $objective_id => array( 'objective' => $objective_id, ... )
	 */
	protected static function insert_objectives_in_diet( $diet_id, $objectives )
	{
		global $wpdb;

		$diet_objective_table = $wpdb->base_prefix . self::DIET_DIET_OBJECTIVE_TABLE;
		// $ojbective ahora mismo es un array vacio, pero sera util si se le añaden columnas a esta tabla
		foreach( $objectives as $objective_id => $objective )
		{
			if( false === $wpdb->insert(
				$diet_objective_table,
				array(
					'diet_id' => $diet_id,
					'objective_id' => $objective_id,
				),
				array( '%d', '%d' )
			) )
				return false;
		}

		return true;
	}

	/**
	 * $restrictions = array( $restriction_id => array( 'restriction' => $restriction_id, ... )
	 */
	protected static function insert_restrictions_in_diet( $diet_id, $restrictions )
	{
		global $wpdb;

		$diet_restriction_table = $wpdb->base_prefix . self::DIET_DIET_RESTRICTION_TABLE;
		// $environment ahora mismo es un array vacio, pero sera util si se le añaden columnas a esta tabla
		foreach( $restrictions as $restriction_id => $restriction )
		{
			if( false === $wpdb->insert(
				$diet_restriction_table,
				array(
					'diet_id' => $diet_id,
					'restriction_id' => $restriction_id,
				),
				array( '%d', '%d' )
			) )
				return false;

		}

		return true;
	}

	public static function create_diet( $name, $position, $active, $description = null, $start = null, $end = null, $user = null, $trainer = null, $intervals = array(), $objectives = array(), $restrictions = array() )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'user' => $user,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		$diet_id = $wpdb->insert_id;

		if( !empty( $intervals ) )
		{
			$intervals_table = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;
			$interval_food_table = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;
			foreach( $intervals as $interval_id => $interval )
			{
				if( false === $wpdb->insert(
					$intervals_table,
					array(
						'diet_id' => (int)$diet_id,
						'interval' => (int)$interval_id,
						'description' => $interval['description']
					),
					array( '%d', '%d', '%s' )
				) )
					return false;

				if( !empty( $interval['food'] ) && is_array( $interval['food'] ) )
					foreach( $interval['food'] as $food_id )
						if( false === $wpdb->insert(
							$interval_food_table,
							array(
								'diet_id' => (int)$diet_id,
								'interval' => (int)$interval_id,
								'food_id' => (int)$food_id
							),
							array( '%d', '%d', '%d' )
						) )
							return false;
			}
		}

		if( !empty( $objectives ) )
		{
			if( !self::insert_objectives_in_diet( $diet_id, $objectives ) )
				return false;
		}

		if( !empty( $restrictions ) )
		{
			if( !self::insert_restrictions_in_diet( $diet_id, $restrictions ) )
				return false;
		}

		return $diet_id;
	}

	public static function update_diet( $id, $name, $position, $active, $description = null, $start = null, $end = null, $user = null, $intervals = array(), $objectives = array(), $restrictions = array() )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'user' => $user
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		$intervals_table = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;
		$interval_food_table = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;
		if( !empty( $intervals ) )
		{
			$ides_string = '(' . implode( ',', array_keys( $intervals ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $intervals_table WHERE `diet_id` = %d AND `interval` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			foreach( $intervals as $interval_id => $interval )
				$cads[] = '(' . implode( ',', array( $id, $interval_id, "'" . $interval['description'] . "'" ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $intervals_table (`diet_id`,`interval`, `description`) VALUES $values_string ON DUPLICATE KEY UPDATE `diet_id` = `diet_id`, `interval` = `interval`, `description` = VALUES(`description`)";
			if( false === $wpdb->query( $sql ) )
				return false;

			foreach( $intervals as $interval_id => $interval )
			{
				if( empty( $interval['food'] ) || !is_array( $interval['food'] ) )
				{
					$sql = $wpdb->prepare( "DELETE FROM $interval_food_table WHERE `diet_id` = %d AND `interval` = %d", $id, $interval_id );
					if( false === $wpdb->query( $sql ) )
						return false;
				}
				else
				{
					$ides_string = '(' . implode( ',', $interval['food'] ) . ')';
					$sql = $wpdb->prepare( "DELETE FROM $interval_food_table WHERE `diet_id` = %d AND `interval` = %d AND `food_id` NOT IN $ides_string", $id, $interval_id );
					if( false === $wpdb->query( $sql ) )
						return false;
				}
			}

			$cads = array();
			foreach( $intervals as $interval_id => $interval )
				if( !empty( $interval['food'] ) && is_array( $interval['food'] ) )
					foreach( $interval['food'] as $food_id )
						$cads[] = '(' . implode( ',', array( $id, $interval_id, $food_id ) ) . ')';

			if( !empty( $cads ) )
			{
				$values_string = implode( ',', $cads );
				$sql = "INSERT INTO $interval_food_table (`diet_id`,`interval`, `food_id`) VALUES $values_string ON DUPLICATE KEY UPDATE `diet_id` = `diet_id`, `interval` = `interval`, `food_id` = `food_id`";
	//error_log( "SQLLLLLLLLLLLLLLLLLLLLLL:" . $sql );
				if( false === $wpdb->query( $sql ) )
					return false;
			}

		}
		else
		{
			$sql = $wpdb->prepare( "DELETE FROM $intervals_table WHERE `diet_id` = %d", $id );
			$wpdb->query( $sql );
		}


		$diet_objective_table = $wpdb->base_prefix . self::DIET_DIET_OBJECTIVE_TABLE;

		if( empty( $objectives ) )
		{
			if( false === $wpdb->delete(
				$diet_objective_table,
				array( 'diet_id' => (int)$id ),
				array( '%d' )
			) )
				return false;
		}
		else
		{
			$ides_string = '(' . implode( ',', array_keys( $objectives ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $diet_objective_table WHERE `diet_id` = %d AND `objective_id` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			foreach( $objectives as $objective_id => $objective )
				$cads[] = '(' . implode( ',', array( $id, $objective_id ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $diet_objective_table (`diet_id`, `objective_id` ) VALUES $values_string ON DUPLICATE KEY UPDATE `diet_id` = VALUES(`diet_id`), `objective_id` = VALUES(`objective_id`)";
			if( false === $wpdb->query( $sql ) )
				return false;
		}

		$diet_restriction_table = $wpdb->base_prefix . self::DIET_DIET_RESTRICTION_TABLE;
		if( empty( $restrictions ) )
		{
			if( false === $wpdb->delete(
				$diet_restriction_table,
				array( 'diet_id' => (int)$id ),
				array( '%d' )
			) )
				return false;
		}
		else
		{
			$ides_string = '(' . implode( ',', array_keys( $restrictions ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $diet_restriction_table WHERE `diet_id` = %d AND `restriction_id` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			foreach( $restrictions as $restriction_id => $restriction )
				$cads[] = '(' . implode( ',', array( $id, $restriction_id ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $diet_restriction_table (`diet_id`, `restriction_id` ) VALUES $values_string ON DUPLICATE KEY UPDATE `diet_id` = VALUES(`diet_id`), `restriction_id` = VALUES(`restriction_id`)";
			if( false === $wpdb->query( $sql ) )
				return false;
		}

		return true;
	}

	public static function set_diet_observations( $id, $observations )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'observations' => $observations
			),
			array(
				'ID' => (int)$id
			),
			array( '%s' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		return true;
	}

	public static function set_diet_video( $id, $video )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'video' => $video
			),
			array(
				'ID' => (int)$id
			),
			array( '%s' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		return true;
	}

	public static function set_diet_active( $id, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'active' => $active ? 1 : 0
			),
			array(
				'ID' => (int)$id
			),
			array( '%d' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		return true;
	}
 
	public static function delete_diet( $diet_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$diet_id ),
			array( '%d' )
		);
	}

	public static function get_diet_intervals( $diet_id )
	{
		global $wpdb;

		$diet_interval_name = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;
		$diet_interval_food_name = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $diet_interval_name WHERE `diet_id` = %d", $diet_id );
		$intervals = $wpdb->get_results( $sql );

		if( !is_array( $intervals ) )
			return array();

		$ret = array();
		foreach( $intervals as $interval )
		{
			$sql = $wpdb->prepare( "SELECT * FROM $diet_interval_food_name WHERE `diet_id` = %d AND `interval` = %d", $diet_id, $interval->interval );
			$food_intervals = $wpdb->get_results( $sql );
			$interval->food = array();
			foreach( $food_intervals as $food_interval )
				$interval->food[] = $food_interval->food_id;

			$ret[$interval->interval] = $interval;
		}

		return $ret;
	}

	public static function duplicate_diet(
		$diet_id,
		$assign_trainer = false,
		$assign_user = false,
		$assign_start_date = false,
		$assign_end_date = false
	) {
		global $wpdb;

		$diet = self::get_diet( $diet_id );
		if( !$diet )
			return false;
/*
		$ex_arr = array();
		$exercises = self::get_training_exercises_data( $training_id );
		foreach( $exercises as $exercise )
		{
			$ex_arr[$exercise->exercise_id] = array(
				'exercise' => $exercise->exercise_id,
				'position' => $exercise->position,
				'description' => $exercise->description,
				'series' => $exercise->series,
				'repetitions' => $exercise->repetitions,
				'loads' => $exercise->loads
			);
		}

		$obj_arr = array();
		$objectives = EpointPersonalTrainerMapper::get_training_objectives( $training_id );
		foreach( $objectives as $objective )
		{
			$obj_arr[$objective->objective_id] = array(
				'objective' => $objective->objective_id
			);
		}

		$env_arr = array();
		$environments = EpointPersonalTrainerMapper::get_training_environments( $training_id );
		foreach( $environments as $environment )
		{
			$env_arr[$environment->environment_id] = array(
				'environment' => $environment->environment_id
			);
		}
*/
		$objectives = array();
		$restrictions = array();
		$intervals = array();

		$intervals_objs = self::get_diet_intervals( $diet_id );
		if( is_array( $intervals_objs ) ) 
		{
			foreach( $intervals_objs as $interval_id => $interval )
			{
				$intervals[$interval_id] = array(
					'description' => $interval->description,
					'food' => $interval->food
				);
			}
		}

		$objectives_objs = self::get_diet_related_objectives( $diet_id );
		if( is_array( $objectives_objs ) )
		{
			foreach( $objectives_objs as $objective )
			{
				$objectives[$objective->ID] = array( 'objective' => $objective->ID );
			}
		}

		$restrictions_objs = self::get_diet_related_restrictions( $diet_id );
		if( is_array( $restrictions_objs ) )
		{
			foreach( $restrictions_objs as $restriction )
			{
				$restrictions[$restriction->ID] = array( 'restriction' => $restriction->ID );
			}
		}

		$new_diet_id = self::create_diet(
			$diet->name,
			$diet->position,
			$diet->active,
			$diet->description,
			$assign_start_date !== false ? $assign_start_date : $diet->start,
			$assign_end_date !== false ? $assign_end_date : $diet->end,
			$assign_user !== false ? $assign_user : $diet->user,
			$assign_trainer !== false ? $assign_trainer : $diet->trainer,
			$intervals,
			$objectives,
			$restrictions
		);

		if( !empty( $diet->video ) )
			self::set_diet_video( $new_diet_id, $diet->video );

		return $new_diet_id;
	}

	// EVOLUTION MAGNITUDE

	public static function get_evolution_magnitude( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_trainer_evolution_magnitudes( $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;

		if( $trainer )
			$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `trainer` = %d", $trainer );
		else
			$sql = "SELECT * FROM $table_name WHERE `trainer` IS NULL";

		return $wpdb->get_results( $sql );
	}

	public static function get_evolution_magnitudes_by_type( $type, $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;

		if( $trainer )
			$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `type` = %s AND `trainer` = %d", $type, $trainer );
		else
			$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `type` = %s AND `trainer` IS NULL", $type );

		return $wpdb->get_results( $sql );
	}

	public static function insert_evolution_magnitude( $name, $position, $active, $type, $unit, $trainer = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'type' => $type,
				'unit' => $unit,
				'trainer' => $trainer
			),
			array( '%s', '%d', '%d', '%s', '%s', '%d' )
		);

		if( false === $insertion )
			return false;

		return $wpdb->insert_id;
	}

	public static function update_evolution_magnitude( $id, $name, $position, $active, $type, $unit )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'type' => $type,
				'unit' => $unit
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d', '%s', '%s' ),
			array( '%d' )
		);

		return $result;
	}
 
	public static function delete_evolution_magnitude( $magnitude_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$magnitude_id ),
			array( '%d' )
		);
	}

	// USER EVOLUTON VALUES

	public static function get_user_evolution_values( $user )
	{
		global $wpdb;

		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_MAGNITUDE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $user_table_name WHERE `user` = %d", $user );

		return $wpdb->get_results( $sql );
	}

	public static function get_user_evolution_values_by_type( $user, $type )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;
		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_MAGNITUDE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $user_table_name WHERE `user` = %d AND `magnitude` IN ( SELECT `ID` FROM $table_name WHERE `type` = %s )", $user, $type );

		return $wpdb->get_results( $sql );
	}

	public static function get_last_user_evolution_values_by_type( $user, $type )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;
		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_MAGNITUDE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $user_table_name WHERE `user` = %d AND `magnitude` IN ( SELECT `ID` FROM $table_name WHERE `type` = %s ) AND `when` = ( SELECT max(`when`) FROM $user_table_name WHERE `user` = %d AND `magnitude` IN ( SELECT `ID` FROM $table_name WHERE `type` = %s ) )", $user, $type, $user, $type );

		return $wpdb->get_results( $sql );
	}

	public static function get_users_with_measures_in_date( $date, $type )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;
		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_MAGNITUDE_TABLE;

		$sql = $wpdb->prepare( "SELECT DISTINCT t.`user` FROM $user_table_name t WHERE t.`magnitude` IN ( SELECT `ID` FROM $table_name WHERE `type` = %s ) AND t.`when` = ( SELECT max(tt.`when`) FROM $user_table_name tt WHERE tt.`user` = t.`user` AND `magnitude` IN ( SELECT `ID` FROM $table_name WHERE `type` = %s ) ) AND t.`when` = %s", $type,  $type, $date );

		return $wpdb->get_col( $sql );
	}

	/**
	 * values is array( array( 'magnitude' => $magnitude_id, 'when' => $date, 'value' => $value ) ... )
	 */
	public static function insert_user_evolution_values( $user_id, $values )
	{
		global $wpdb;
		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_MAGNITUDE_TABLE;

		$values_arr = array();
		foreach( $values as $value )
		{
			$values_arr[] = sprintf( '(%d,%d,"%s","%s")', $user_id, $value['magnitude'], $value['when'], $value['value'] );
		}
		$values_string =  implode( ',', $values_arr );

		$sql = "INSERT INTO $user_table_name (`user`,`magnitude`,`when`,`value`) VALUES $values_string ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)";

		return $wpdb->query( $sql );
	}

	public static function get_user_evolution_photos( $user_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::USER_EVOLUTION_PHOTOS_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY `when` DESC", $user_id );

		return $wpdb->get_results( $sql );
	}

	public static function insert_user_evolution_photos( $user_id, $when, $front, $profile, $back )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::USER_EVOLUTION_PHOTOS_TABLE;

		$values_string = sprintf( '(%d,"%s",%d,%d,%d)', $user_id, $when, $front, $profile, $back );

		$sql = "INSERT INTO $table_name (`user`,`when`,`front`,`profile`,`back`) VALUES $values_string ON DUPLICATE KEY UPDATE `front` = VALUES(`front`), `profile` = VALUES(`profile`), `back` = VALUES(`back`)";

		return $wpdb->query( $sql );
	}

	/**
	 * values is array( array( 'magnitude' => $magnitude_id, 'when' => $date, 'observations' => $observations ) ... )
	 * Use magnitude = null for corporal observations
	 */
	public static function insert_user_evolution_observations( $user_id, $values )
	{
		global $wpdb;
		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_OBSERVATIONS_TABLE;

		$values_arr = array();
		foreach( $values as $value )
		{
			$values_arr[] = sprintf( '(%d,%d,"%s","%s")', $user_id, $value['magnitude'], $value['when'], $value['observations'] );
		}
		$values_string =  implode( ',', $values_arr );

		$sql = "INSERT INTO $user_table_name (`user`,`magnitude`,`when`,`observations`) VALUES $values_string ON DUPLICATE KEY UPDATE `observations` = VALUES(`observations`)";

		return $wpdb->query( $sql );
	}

	public static function get_user_corporal_evolution_observations( $user )
	{
		global $wpdb;

		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_OBSERVATIONS_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $user_table_name WHERE `user` = %d AND `magnitude` = 0", $user );

		return $wpdb->get_results( $sql );
	}

	public static function get_user_evolution_observations_by_type( $user, $type )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EVOLUTION_MAGNITUDE_TABLE;
		$user_table_name = $wpdb->base_prefix . self::USER_EVOLUTION_OBSERVATIONS_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $user_table_name WHERE `user` = %d AND `magnitude`  IN ( SELECT `ID` FROM $table_name WHERE `type` = %s )", $user, $type );

		return $wpdb->get_results( $sql );
	}
}

if(false)
{
class EpointPersonalTrainerMapper
{
	const FOOD_TABLE = 'epoint_personal_training_food';
	const CAT_FOOD_TABLE = 'epoint_personal_training_cat_food';
	const CAT_FOOD_FOOD_TABLE = 'epoint_personal_training_cat_food_food';

	const CAT_EXERCISE_TABLE = 'epoint_personal_training_cat_exercise';
	const EXERCISE_TABLE = 'epoint_personal_training_exercise';
	const EXERCISE_CORRECTION_TABLE = 'epoint_personal_training_exercise_correction';
	const CAT_EXERCISE_EXERCISE_TABLE = 'epoint_personal_training_cat_exercise_exercise';

	const DIET_TABLE = 'epoint_personal_training_diet';
	const DIET_INTERVAL_TABLE = 'epoint_personal_training_diet_interval';
	const DIET_INTERVAL_FOOD_TABLE = 'epoint_personal_training_diet_interval_food';

	const TRAINING_TABLE = 'epoint_personal_training_training';
	const TRAINING_EXERCISE_TABLE = 'epoint_personal_training_training_exercise';

	const STUDENTS_TABLE = 'epoint_personal_training_students';
	const STUDENT_INFO_TABLE = 'epoint_personal_training_student_info';
	const STUDENT_FOOD_TABLE = 'epoint_personal_training_student_food';
	const STUDENT_MEALS_TABLE = 'epoint_personal_training_student_meals';
	const STUDENT_MEAL_INTERVALS_TABLE = 'epoint_personal_training_student_meal_intervals';
	const STUDENT_TRACKING_TABLE = 'epoint_personal_training_student_tracking';

	const TRAINERS_TABLE = 'epoint_personal_training_trainers';

	const MAILING_TABLE = 'epoint_personal_training_mailing';

	const USER_UPDATE_MAX_DAYS = 30;

	public static function install()
	{
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$charset_collate = $wpdb->get_charset_collate();

		$cat_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_food_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$food_table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $food_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`user` bigint(20) unsigned DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$cat_food_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_food_food_table_name . ' (';
		$sql .= '`food_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`cat_food_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`food_id`,`cat_food_id`),';
		$sql .= 'FOREIGN KEY (`food_id`) REFERENCES ' . $food_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`cat_food_id`) REFERENCES ' . $cat_food_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$cat_exercise_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_exercise_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$exercise_table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $exercise_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`video` VARCHAR(200),';
		$sql .= '`image_start` BIGINT(20) UNSIGNED,';
		$sql .= '`image_end` BIGINT(20) UNSIGNED,';
		$sql .= '`description` TEXT,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$exercise_correction_table_name = $wpdb->base_prefix . self::EXERCISE_CORRECTION_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $exercise_correction_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`description` TEXT NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`image_well` BIGINT(20) UNSIGNED,';
		$sql .= '`image_bad` BIGINT(20) UNSIGNED,';
		$sql .= '`exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'FOREIGN KEY (`exercise_id`) REFERENCES ' . $exercise_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'PRIMARY KEY (`ID`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$cat_exercise_exercise_table_name = $wpdb->base_prefix . self::CAT_EXERCISE_EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $cat_exercise_exercise_table_name . ' (';
		$sql .= '`exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`cat_exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`exercise_id`,`cat_exercise_id`),';
		$sql .= 'FOREIGN KEY (`exercise_id`) REFERENCES ' . $exercise_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`cat_exercise_id`) REFERENCES ' . $cat_exercise_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diets_table_name = $wpdb->base_prefix . self::DIET_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diets_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= '`start` DATE DEFAULT NULL,';
		$sql .= '`end` DATE DEFAULT NULL,';
		$sql .= '`user` bigint(20) unsigned,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diets_intervals_table_name = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diets_intervals_table_name . ' (';
		$sql .= '`diet_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`interval` int(2) unsigned NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`diet_id`,`interval`),';
		$sql .= 'FOREIGN KEY (`diet_id`) REFERENCES ' . $diets_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$diet_interval_food_table_name = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $diet_interval_food_table_name . ' (';
		$sql .= '`diet_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`interval` int(2) unsigned NOT NULL,';
		$sql .= '`food_id` bigint(20) unsigned NOT NULL,';
		$sql .= 'PRIMARY KEY (`diet_id`,`interval`,`food_id`),';
		$sql .= 'FOREIGN KEY (`diet_id`,`interval`) REFERENCES ' . $diets_intervals_table_name . ' (`diet_id`,`interval`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`food_id`) REFERENCES ' . $food_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$training_table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $training_table_name . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`name` VARCHAR(100) NOT NULL,';
		$sql .= '`position` int(11) NOT NULL,';
		$sql .= '`active` tinyint(1) NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= '`start` DATE DEFAULT NULL,';
		$sql .= '`end` DATE DEFAULT NULL,';
		$sql .= '`objective_volume` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= '`objective_maintenance` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= '`objective_definition` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= '`environment_house` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= '`environment_outdoors` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= '`environment_gym` TINYINT(1) NOT NULL DEFAULT 0,';
		$sql .= '`user` bigint(20) unsigned,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$training_exercise_table_name = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $training_exercise_table_name . ' (';
		$sql .= '`training_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`exercise_id` bigint(20) unsigned NOT NULL,';
		$sql .= '`saved` DATETIME NOT NULL,';
		$sql .= '`description` TEXT DEFAULT NULL,';
		$sql .= '`series` VARCHAR(100) NOT NULL,';
		$sql .= '`repetitions` VARCHAR(100) NOT NULL,';
		$sql .= '`loads` VARCHAR(100) NOT NULL,';
		$sql .= 'PRIMARY KEY (`training_id`,`exercise_id`,`saved`),';
		$sql .= 'FOREIGN KEY (`training_id`) REFERENCES ' . $training_table_name . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`exercise_id`) REFERENCES ' . $exercise_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$trainers_table = $wpdb->base_prefix . self::TRAINERS_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $trainers_table . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`user` BIGINT(20) UNSIGNED NOT NULL,';
		$sql .= '`slug` VARCHAR(100) NOT NULL,';
		$sql .= '`requested` DATETIME NOT NULL,';
		$sql .= '`registered` DATETIME,';
		$sql .= '`active` TINYINT(1) NOT NULL DEFAULT 1,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'UNIQUE (`slug`),';
		$sql .= 'FOREIGN KEY (`user`) REFERENCES ' . $wpdb->users . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$students_table = $wpdb->base_prefix . self::STUDENTS_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $students_table . ' (';
		$sql .= '`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,';
		$sql .= '`email` VARCHAR(100) NOT NULL,';
		$sql .= '`order` bigint(20) unsigned NOT NULL,';
		$sql .= '`product` bigint(20) unsigned NOT NULL,';
		$sql .= '`registered` DATETIME NOT NULL,';
		$sql .= '`renewed` DATETIME DEFAULT NULL,';
		$sql .= '`active` TINYINT(1) NOT NULL DEFAULT 1,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'UNIQUE (`email`,`order`)';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$student_info_table = $wpdb->base_prefix . self::STUDENT_INFO_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $student_info_table . ' (';
		$sql .= '`student_id`  bigint(20) UNSIGNED NOT NULL,';
		$sql .= '`saved` DATETIME NOT NULL,';
		$sql .= '`weight` DECIMAL(5,2) NOT NULL,';
		$sql .= '`male` TINYINT(1) unsigned NOT NULL,';
		$sql .= '`birthday` DATE NOT NULL,';
		$sql .= '`obj_health` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_remove_stress` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_improve_physically` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_strength` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_injury_recover` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_examination` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_loss_fat` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_improve_postural` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_gain_mass` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_loss_volume` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_improve_resistance` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`obj_other` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= '`injuries` VARCHAR(300) NOT NULL,';
		$sql .= '`diseases` VARCHAR(300) NOT NULL,';
		$sql .= '`medications` VARCHAR(300) NOT NULL,';
		$sql .= '`blood_preasure` TINYINT(1) NOT NULL,';
		$sql .= '`sport_currently` TINYINT(1) NOT NULL,';
		$sql .= '`sport` VARCHAR(100) DEFAULT NULL,';
		$sql .= '`sport_frequency` TINYINT(1) NOT NULL,';
		$sql .= '`sport_days` TINYINT(1) DEFAULT NULL,';
		$sql .= '`training_days` TINYINT(1) NOT NULL,';
		$sql .= '`work` TINYINT(1) NOT NULL,';
		$sql .= '`active_work` TINYINT(1) NOT NULL,';
		$sql .= '`sleep_hours` TINYINT(2) UNSIGNED NOT NULL,';
		$sql .= '`diet` VARCHAR(300) NOT NULL,';
		$sql .= '`meals` TINYINT(1) UNSIGNED NOT NULL,';
		$sql .= 'PRIMARY KEY (`student_id`,`saved`),';
		$sql .= 'FOREIGN KEY (`student_id`) REFERENCES ' . $students_table . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$student_food_table_name = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $student_food_table_name . ' (';
		$sql .= '`student_id`  bigint(20) UNSIGNED NOT NULL,';
		$sql .= '`food_id`  bigint(20) UNSIGNED NOT NULL,';
		$sql .= '`saved` DATETIME NOT NULL,';
		$sql .= '`frequent` TINYINT(1) unsigned NOT NULL,';
		$sql .= '`valuation` TINYINT(2) UNSIGNED NOT NULL,';
		$sql .= 'PRIMARY KEY (`student_id`,`food_id`,`saved`),';
		$sql .= 'FOREIGN KEY (`student_id`) REFERENCES ' . $students_table . ' (`ID`) ON DELETE CASCADE,';
		$sql .= 'FOREIGN KEY (`food_id`) REFERENCES ' . $food_table_name . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$student_meals_table_name = $wpdb->base_prefix . self::STUDENT_MEALS_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $student_meals_table_name . ' (';
		$sql .= '`student_id`  bigint(20) UNSIGNED NOT NULL,';
		$sql .= '`saved` DATETIME NOT NULL,';
		$sql .= '`observations` TEXT DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`student_id`,`saved`),';
		$sql .= 'FOREIGN KEY (`student_id`) REFERENCES ' . $students_table . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$student_meal_intervals_table_name = $wpdb->base_prefix . self::STUDENT_MEAL_INTERVALS_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $student_meal_intervals_table_name . ' (';
		$sql .= '`student_id`  bigint(20) UNSIGNED NOT NULL,';
		$sql .= '`saved` DATETIME NOT NULL,';
		$sql .= '`interval` int(2) unsigned NOT NULL,';
		$sql .= '`tasks` VARCHAR(300) DEFAULT NULL,';
		$sql .= 'PRIMARY KEY (`student_id`,`saved`,`interval`),';
		$sql .= 'FOREIGN KEY (`student_id`,`saved`) REFERENCES ' . $student_meals_table_name . ' (`student_id`,`saved`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$student_evolution_table_name = $wpdb->base_prefix . self::STUDENT_TRACKING_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $student_evolution_table_name . ' (';
		$sql .= '`student_id`  bigint(20) UNSIGNED NOT NULL,';
		$sql .= '`saved` DATETIME NOT NULL,';
		$sql .= '`weight` DECIMAL(5,2) UNSIGNED NOT NULL,';
		$sql .= '`biceps` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`shoulder` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`chest` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`waist` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`hip` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`thigh` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`leg` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`calf` TINYINT(3) UNSIGNED NOT NULL,';
		$sql .= '`observations` TEXT NOT NULL,';
		$sql .= 'PRIMARY KEY (`student_id`,`saved`),';
		$sql .= 'FOREIGN KEY (`student_id`) REFERENCES ' . $students_table . ' (`ID`) ON DELETE CASCADE';
		$sql .= ') ' . $charset_collate;

		dbDelta( $sql );

		$alerts_table = $wpdb->base_prefix . self::MAILING_TABLE;

		$sql = 'CREATE TABLE IF NOT EXISTS ' . $student_meal_intervals_table_name . ' (';
		$sql .= '`ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,';
		$sql .= '`student_id`  bigint(20) UNSIGNED NOT NULL,';
		$sql .= '`data` VARCHAR(100) NOT NULL,';
		$sql .= '`sent` DATETIME NOT NULL,';
		$sql .= 'PRIMARY KEY (`ID`),';
		$sql .= 'FOREIGN KEY (`student_id`) REFERENCES ' . $students_table . ' (`ID`) ON DELETE CASCADE';
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

	//////////////////////////////////////
	// CAT FOOD
	//////////////////////////////////////

	public static function get_food_categories_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_food_categories( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

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

	public static function get_food_category( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_food_category_by_name( $name )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `name` = %s", $name );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_food_category()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";

		return $wpdb->get_row( $sql );
	}

	public static function create_food_category( $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
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

	public static function update_food_category( $id, $name, $position, $active )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
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
 
	public static function delete_food_category( $cat_food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$cat_food_id ),
			array( '%d' )
		);
	}


	//////////////////////////////////////
	// FOOD
	//////////////////////////////////////

	public static function get_food_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_food_items( $results = null, $offset = null, $order_by = null, $order = null, $food_category = null, $user = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$cat_table = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		$cat_cond = '';
		if( is_numeric( $food_category ) )
			$cat_cond = " WHERE `ID` IN ( SELECT DISTINCT `food_id` FROM $cat_table WHERE `cat_food_id` = " . (int)$food_category . " ) ";

		if( $user )
		{
			if( empty( $cat_cond ) )
				$cat_cond = " WHERE `user` IS NULL OR `user` = $user ";
			else
				$cat_cond .= " AND ( `user` IS NULL OR `user` = $user ) ";
		}

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name $cat_cond ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name $cat_cond ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name $cat_cond ORDER BY position ASC");
		}
	}

	public static function get_food_items_grouped_by_category( $active = null, $user = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$cat_food_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		if( $active !== null )
			$sql = $wpdb->prepare( "SELECT * FROM $cat_table_name WHERE `active` = %d ORDER BY `position` ASC", $active ? 1 : 0 );
		else
			$sql = "SELECT * FROM $cat_table_name ORDER BY `position` ASC";

		$categories = $wpdb->get_results( $sql );
		if( !is_array( $categories ) )
			return false;

		foreach( $categories as $category )
		{
			if( !$user )
				$category->food = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` = %d ) ORDER BY `position` ASC", $category->ID ) );  
			else
				$category->food = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE ( `user` IS NULL OR `user` = %d ) AND `ID` IN (SELECT `food_id` FROM $cat_food_table_name WHERE `cat_food_id` = %d ) ORDER BY `position` ASC", $user, $category->ID ) );  
		}

		return $categories;
	}

	public static function get_food( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_food()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";

		return $wpdb->get_row( $sql );
	}

	public static function create_food( $name, $position, $active, $categories = array(), $user = null )
	{
		global $wpdb;

		if( !is_array( $categories ) )
			return false;

		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;
		$categories_count = count( $categories );
		if( $categories_count )
		{
			$cat_string = '(' . implode( ',', $categories ) . ')';
			$sql = "SELECT count(distinct ID) = $categories_count FROM $cat_table_name WHERE ID IN $cat_string";
			if( !$wpdb->get_var( $sql ) )
				return false;
		}

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'user' => $user
			),
			array( '%s', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		$food_id = $wpdb->insert_id;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;
		foreach( $categories as $category )
			if( false === $wpdb->insert(
				$table_name,
				array(
					'food_id' => $food_id,
					'cat_food_id' => $category
				),
				array( '%d', '%d' )
			) )
				return false;

		return $food_id;
	}

	public static function update_food( $id, $name, $position, $active, $categories = array() )
	{
		global $wpdb;

		$map_table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		if( !empty( $categories ) )
		{
			$cat_string = '(' . implode( ',', $categories ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $map_table_name WHERE `food_id` = %d AND `cat_food_id` NOT IN $cat_string", $id );
			$wpdb->query( $sql );

			$pairs = array();
			foreach( $categories as $category )
				$pairs[] = "($id, $category)";
			$pairs_string = implode( ',', $pairs );
			$sql = "INSERT INTO $map_table_name (`food_id`,`cat_food_id`) VALUES $pairs_string ON DUPLICATE KEY UPDATE `food_id` = `food_id`, `cat_food_id` = `cat_food_id`";
			$wpdb->query( $sql );
		}
		else
		{
			$sql = $wpdb->prepare( "DELETE FROM $map_table_name WHERE `food_id` = %d", $id );
			$wpdb->query( $sql );
		}

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;
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
 
	public static function delete_food( $food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::FOOD_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$food_id ),
			array( '%d' )
		);
	}

	public static function get_food_related_categories( $food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT cat_food_id FROM $table_name WHERE food_id = %d", $food_id ) );
	}

	public static function get_food_related_categories_names( $food_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::CAT_FOOD_FOOD_TABLE;
		$cat_table_name = $wpdb->base_prefix . self::CAT_FOOD_TABLE;

		return $wpdb->get_results( $wpdb->prepare( "SELECT cf.name AS 'name' FROM $table_name cff INNER JOIN $cat_table_name cf ON cff.cat_food_id = cf.ID WHERE cff.food_id = %d", $food_id ) );
	}

	//////////////////////////////////////
	// EXERCISES
	//////////////////////////////////////

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

	//////////////////////////////////////
	// DIETS
	//////////////////////////////////////

	public static function get_preset_diets_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name WHERE `user` IS NULL");
	}

	public static function get_diets( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_preset_diets( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT * FROM $table_name ORDER BY position ASC");
		}
	}

	public static function get_user_diets_count( $user_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		return $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $table_name WHERE `user` = %d", $user_id ) );
	}

	public static function get_user_diets( $user_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'start', 'end' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order", $user_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order LIMIT $results OFFSET $offset", $user_id ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY position ASC", $user_id ) );
		}
	}

	public static function get_diet_search_results( $user, $name, $preset = true )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$diet_food_table = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;
		$student_food_table = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		$where = 'WHERE `active` = 1';

		if( $preset )
			$where .= " AND `user` IS NULL";
		else
			$where .= " AND `user` IS NOT NULL";

		if( !empty( $name ) && is_string( $name ) )
		{
			if( mb_strlen( $name ) < 3 )
				$name = $name . '%';
			else
				$name = '%' . $name . '%';

			$where .= $wpdb->prepare( " AND `name` LIKE %s", $name );
		}

		$sql = "SELECT `ID`, `name` FROM $table_name $where ORDER BY position ASC";

		$diets = $wpdb->get_results( $sql );
		if( !is_array( $diets ) )
			return false;

		for( $i = 1; $i < 11; $i++ )
		{
			$sql = $wpdb->prepare( "SELECT d.`ID`, count(sf.`valuation`) AS 'total' FROM ( $table_name d INNER JOIN $diet_food_table dif ON d.`ID` IN ( SELECT `ID` FROM $table_name $where ORDER BY position ASC ) AND d.`ID` = dif.`diet_id` ) LEFT JOIN $student_food_table sf ON sf.`student_id` = %d AND dif.`food_id` = sf.`food_id` AND sf.`saved` = ( SELECT MAX(`saved`) FROM $student_food_table WHERE `student_id` = %d ) AND sf.`valuation` = %d GROUP BY d.`ID`", $user, $user, $i );

			$results = $wpdb->get_results( $sql );
			foreach( $results as $result )
			{
				foreach( $diets as $diet )
				{
					if( $diet->ID == $result->ID )
					{
						$key = 'valuation_' . $i;
						$diet->$key = $result->total;
					}
				}
			}
		}

		return $diets;
//SELECT d.`ID`, d.`name`, sf.`valuation` FROM ( wp_epoint_personal_training_diet d INNER JOIN wp_epoint_personal_training_diet_interval_food dif ON d.`ID` = dif.`diet_id` ) LEFT JOIN wp_epoint_personal_training_student_food sf ON sf.`student_id` = 1 AND dif.`food_id` = sf.`food_id`;
//SELECT d.`ID`, d.`name`, count(sf.`valuation`) AS "COUNT" FROM ( wp_epoint_personal_training_diet d INNER JOIN wp_epoint_personal_training_diet_interval_food dif ON d.`ID` = dif.`diet_id` ) LEFT JOIN wp_epoint_personal_training_student_food sf ON sf.`student_id` = 1 AND dif.`food_id` = sf.`food_id` AND sf.`saved` = ( SELECT MAX(`saved`) FROM wp_epoint_personal_training_student_food WHERE `student_id` = 1 ) AND sf.`valuation` = 10 GROUP BY d.`ID`;
	}

	public static function get_diet( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_diet( $user_id = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		if( $user_id === null )
			$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";
		else
			$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `user`= %d ORDER BY `start` DESC, ID DESC LIMIT 1", $user_id );

		return $wpdb->get_row( $sql );
	}

	public static function create_diet( $name, $position, $active, $description = null, $start = null, $end = null, $user = null, $intervals = array() )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'user' => $user
			),
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d' )
		);

		if( false === $insertion )
			return false;

		$diet_id = $wpdb->insert_id;

		if( !empty( $intervals ) )
		{
			$intervals_table = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;
			$interval_food_table = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;
			foreach( $intervals as $interval_id => $interval )
			{
				if( false === $wpdb->insert(
					$intervals_table,
					array(
						'diet_id' => (int)$diet_id,
						'interval' => (int)$interval_id,
						'description' => $interval['description']
					),
					array( '%d', '%d', '%s' )
				) )
					return false;

				if( !empty( $interval['food'] ) && is_array( $interval['food'] ) )
					foreach( $interval['food'] as $food_id )
						if( false === $wpdb->insert(
							$interval_food_table,
							array(
								'diet_id' => (int)$diet_id,
								'interval' => (int)$interval_id,
								'food_id' => (int)$food_id
							),
							array( '%d', '%d', '%s' )
						) )
							return false;
			}
		}

		return $diet_id;
	}

	public static function update_diet( $id, $name, $position, $active, $description = null, $start = null, $end = null, $user = null, $intervals = array() )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'user' => $user
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		$intervals_table = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;
		$interval_food_table = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;
		if( !empty( $intervals ) )
		{
			$ides_string = '(' . implode( ',', array_keys( $intervals ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $intervals_table WHERE `diet_id` = %d AND `interval` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			foreach( $intervals as $interval_id => $interval )
				$cads[] = '(' . implode( ',', array( $id, $interval_id, "'" . $interval['description'] . "'" ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $intervals_table (`diet_id`,`interval`, `description`) VALUES $values_string ON DUPLICATE KEY UPDATE `diet_id` = `diet_id`, `interval` = `interval`, `description` = VALUES(`description`)";
			if( false === $wpdb->query( $sql ) )
				return false;

			foreach( $intervals as $interval_id => $interval )
			{
				if( empty( $interval['food'] ) || !is_array( $interval['food'] ) )
				{
					$sql = $wpdb->prepare( "DELETE FROM $interval_food_table WHERE `diet_id` = %d AND `interval` = %d", $id, $interval_id );
					if( false === $wpdb->query( $sql ) )
						return false;
				}
				else
				{
					$ides_string = '(' . implode( ',', $interval['food'] ) . ')';
					$sql = $wpdb->prepare( "DELETE FROM $interval_food_table WHERE `diet_id` = %d AND `interval` = %d AND `food_id` NOT IN $ides_string", $id, $interval_id );
					if( false === $wpdb->query( $sql ) )
						return false;
				}
			}

			$cads = array();
			foreach( $intervals as $interval_id => $interval )
				if( !empty( $interval['food'] ) && is_array( $interval['food'] ) )
					foreach( $interval['food'] as $food_id )
						$cads[] = '(' . implode( ',', array( $id, $interval_id, $food_id ) ) . ')';

			if( !empty( $cads ) )
			{
				$values_string = implode( ',', $cads );
				$sql = "INSERT INTO $interval_food_table (`diet_id`,`interval`, `food_id`) VALUES $values_string ON DUPLICATE KEY UPDATE `diet_id` = `diet_id`, `interval` = `interval`, `food_id` = `food_id`";
	//error_log( "SQLLLLLLLLLLLLLLLLLLLLLL:" . $sql );
				if( false === $wpdb->query( $sql ) )
					return false;
			}

		}
		else
		{
			$sql = $wpdb->prepare( "DELETE FROM $intervals_table WHERE `diet_id` = %d", $id );
			$wpdb->query( $sql );
		}

		return true;
	}
 
	public static function delete_diet( $diet_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::DIET_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$diet_id ),
			array( '%d' )
		);
	}

	public static function get_diet_intervals( $diet_id )
	{
		global $wpdb;

		$diet_interval_name = $wpdb->base_prefix . self::DIET_INTERVAL_TABLE;
		$diet_interval_food_name = $wpdb->base_prefix . self::DIET_INTERVAL_FOOD_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $diet_interval_name WHERE `diet_id` = %d", $diet_id );
		$intervals = $wpdb->get_results( $sql );

		if( !is_array( $intervals ) )
			return array();

		$ret = array();
		foreach( $intervals as $interval )
		{
			$sql = $wpdb->prepare( "SELECT * FROM $diet_interval_food_name WHERE `diet_id` = %d AND `interval` = %d", $diet_id, $interval->interval );
			$food_intervals = $wpdb->get_results( $sql );
			$interval->food = array();
			foreach( $food_intervals as $food_interval )
				$interval->food[] = $food_interval->food_id;

			$ret[$interval->interval] = $interval;
		}

		return $ret;
	}

	//////////////////////////////////////
	// TRAINING
	//////////////////////////////////////

	public static function get_preset_training_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name WHERE `user` IS NULL");
	}

	public static function get_training_items( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
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

	public static function get_preset_training_items( $results = null, $offset = null, $order_by = null, $order = null, $volume = false, $maintenance = false, $definition = false, $house = false, $outdoors = false, $gym = false )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$conds = '';
		if( $volume || $maintenance || $definition || $house || $outdoors || $gym )
		{
			$conds = array();
			if( $volume ) $conds[] = ' `objective_volume` = 1 ';
			if( $maintenance ) $conds[] = ' `objective_maintenance` = 1 ';
			if( $definition ) $conds[] = ' `objective_definition` = 1 ';
			if( $house ) $conds[] = ' `environment_house` = 1 ';
			if( $outdoors ) $conds[] = ' `environment_outdoors` = 1 ';
			if( $gym ) $conds[] = ' `environment_gym` = 1 ';

			$conds = implode( 'AND', $conds );
		}

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !empty( $conds ) )
				$conds = ' AND ' . $conds;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL $conds ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT * FROM $table_name WHERE `user` IS NULL $conds ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			if( !empty( $conds ) )
				$conds = ' WHERE ' . $conds;
			return $wpdb->get_results( "SELECT * FROM $table_name $conds $ORDER BY position ASC");
		}
	}

	public static function get_user_training_count( $user_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		return $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $table_name WHERE `user` = %d", $user_id ) );
	}

	public static function get_user_training_items( $user_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'name', 'position', 'start', 'end' ), true ) )
				$order_by = 'ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order", $user_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY $order_by $order LIMIT $results OFFSET $offset", $user_id ) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `user` = %d ORDER BY position ASC", $user_id ) );
		}
	}

	public static function get_training_search_results( $user, $name, $preset = true )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$where = 'WHERE `active` = 1';

		if( $preset )
			$where .= " AND `user` IS NULL";
		else
			$where .= " AND `user` IS NOT NULL";

		if( !empty( $name ) && is_string( $name ) )
		{
			if( mb_strlen( $name ) < 3 )
				$name = $name . '%';
			else
				$name = '%' . $name . '%';

			$where .= $wpdb->prepare( " AND `name` LIKE %s", $name );
		}

		$sql = "SELECT `ID`, `name` FROM $table_name $where ORDER BY position ASC";

		return $wpdb->get_results( $sql );
	}

	public static function get_training( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_last_training( $user_id = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		if( $user_id === null )
			$sql = "SELECT * FROM $table_name ORDER BY position DESC, ID DESC LIMIT 1";
		else
			$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `user`= %d ORDER BY `start` DESC, ID DESC LIMIT 1", $user_id );

		return $wpdb->get_row( $sql );
	}

	public static function create_training(
		$name,
		$position,
		$active,
		$description = null,
		$start = null,
		$end = null,
		$objective_volume = 0,
		$objective_maintenance = 0,
		$objective_definition = 0,
		$environment_house = 0,
		$environment_outdoors = 0,
		$environment_gym = 0,
		$user = null,
		$exercises = array()
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$insertion = $wpdb->insert(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'objective_volume' => $objective_volume,
				'objective_maintenance' => $objective_maintenance,
				'objective_definition' => $objective_definition,
				'environment_house' => $environment_house,
				'environment_outdoors' => $environment_outdoors,
				'environment_gym' => $environment_gym,
				'user' => $user
			), 
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d' )
		);

		if( false === $insertion )
			return false;

		$training_id = $wpdb->insert_id;

		if( !empty( $exercises ) )
		{
			$training_exercise_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;
			foreach( $exercises as $exercise_id => $exercise )
			{
				$saved = date( 'Y-m-d H:i:s' );
				if( false === $wpdb->insert(
					$training_exercise_table,
					array(
						'training_id' => $training_id,
						'exercise_id' => $exercise_id,
						'saved' => $saved,
						'description' => $exercise['description'],
						'series' => $exercise['series'],
						'repetitions' => $exercise['repetitions'],
						'loads' => $exercise['loads']
					),
					array( '%d', '%d', '%s', '%s', '%s', '%s' )
				) )
					return false;

			}
		}

		return $training_id;
	}

	public static function update_training(
		$id,
		$name,
		$position,
		$active,
		$description = null,
		$start = null,
		$end = null,
		$objective_volume = 0,
		$objective_maintenance = 0,
		$objective_definition = 0,
		$environment_house = 0,
		$environment_outdoors = 0,
		$environment_gym = 0,
		$user = null,
		$exercises = array()
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'name' => $name,
				'position' => (int)$position,
				'active' => $active ? 1 : 0,
				'description' => $description,
				'start' => $start,
				'end' => $end,
				'objective_volume' => $objective_volume,
				'objective_maintenance' => $objective_maintenance,
				'objective_definition' => $objective_definition,
				'environment_house' => $environment_house,
				'environment_outdoors' => $environment_outdoors,
				'environment_gym' => $environment_gym,
				'user' => $user
			),
			array(
				'ID' => (int)$id
			),
			array( '%s', '%d', '%d', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d' ),
			array( '%d' )
		);

		if( $result === false )
			return false;

		$training_exercises_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;
		if( empty( $exercises ) )
		{
			if( false === $wpdb->delete(
				$training_exercises_table,
				array( 'training_id' => (int)$id ),
				array( '%d' )
			) )
				return false;
		}
		else
		{
			$ides_string = '(' . implode( ',', array_keys( $exercises ) ) . ')';
			$sql = $wpdb->prepare( "DELETE FROM $training_exercises_table WHERE `training_id` = %d AND `exercise_id` NOT IN $ides_string", $id );
			if( false === $wpdb->query( $sql ) )
				return false;

			$cads = array();
			$saved = date( 'Y-m-d H:i:s' );
			foreach( $exercises as $exercise_id => $exercise )
				$cads[] = '(' . implode( ',', array( $id, $exercise_id, "'" . $saved . "'", "'" . $exercise['description'] . "'", "'" . $exercise['series'] . "'", "'" . $exercise['repetitions'] . "'", "'" . $exercise['loads'] . "'" ) ) . ')';
			$values_string = implode( ',', $cads );
			$sql = "INSERT INTO $training_exercises_table (`training_id`, `exercise_id`,`saved`,`description`, `series`, `repetitions`, `loads` ) VALUES $values_string ON DUPLICATE KEY UPDATE `training_id` = VALUES(`training_id`), `exercise_id` = VALUES(`exercise_id`), `saved` = VALUES(`saved`), `description` = VALUES(`description`), `series` = VALUES(`series`), `repetitions` = VALUES(`repetitions`), `loads` = VALUES(`loads`)";
			if( false === $wpdb->query( $sql ) )
				return false;
		}


		return true;
	}
 
	public static function delete_training( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINING_TABLE;

		return $wpdb->delete(
			$table_name,
			array( 'ID' => (int)$training_id ),
			array( '%d' )
		);
	}

	public static function get_training_exercises( $training_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::EXERCISE_TABLE;
		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT e.ID as 'ID', e.`name` AS 'name', e.`image_start` AS 'image_start', e.`image_end` AS 'image_end', e.`description` AS  'description', te.`description` AS 'extradescription', e.`video` AS 'video', te.`series` AS 'series', te.`repetitions` AS 'repetitions', te.`loads` AS 'loads' FROM $table_name e INNER JOIN $rel_table te ON e.ID = te.`exercise_id` WHERE te.`training_id` = %d AND te.`saved` = (SELECT tee.`saved` FROM $rel_table tee WHERE tee.`training_id` = te.`training_id` AND tee.`exercise_id` = te.`exercise_id` ORDER BY tee.`saved` DESC LIMIT 1) GROUP BY te.`training_id`, te.`exercise_id`", $training_id );

		return $wpdb->get_results( $sql );
	}


	public static function get_training_exercises_historial( $training_id, $exercise_id )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT DISTINCT te.`series` AS 'series', te.`repetitions` AS 'repetitions', te.`loads` AS 'loads' FROM $rel_table te WHERE te.`training_id` = %d AND te.`exercise_id` = %d", $training_id, $exercise_id );

		return $wpdb->get_results( $sql );
	}

	public static function exercise_belongs_to_training( $training_id, $exercise_id )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT te.`exercise_id` AS 'exercise' FROM $rel_table te WHERE te.`training_id` = %d AND te.`exercise_id` = %d", $training_id, $exercise_id );

		return $wpdb->get_var( $sql );
	}

	public static function get_last_training_exercise_data( $training_id, $exercise_id )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM wp_epoint_personal_training_training_exercise WHERE `training_id` = %d AND `exercise_id` = %d ORDER BY `saved` DESC LIMIT 1", $training_id, $exercise_id );

		return $wpdb->get_row( $sql );
	}
	
	public static function update_training_exercise_data( $training_id, $exercise_id, $description, $repetitions, $series, $loads )
	{
		global $wpdb;

		$rel_table = $wpdb->base_prefix . self::TRAINING_EXERCISE_TABLE;

		$saved = date( 'Y-m-d H:i:s' );

		$sql = $wpdb->prepare("INSERT INTO $rel_table (`training_id`, `exercise_id`,`saved`,`description`, `series`, `repetitions`, `loads` ) VALUES ( %d , %d , %s , %s , %s , %s , %s ) ON DUPLICATE KEY UPDATE `training_id` = VALUES(`training_id`), `exercise_id` = VALUES(`exercise_id`), `saved` = VALUES(`saved`), `description` = VALUES(`description`), `series` = VALUES(`series`), `repetitions` = VALUES(`repetitions`), `loads` = VALUES(`loads`)", $training_id, $exercise_id, $saved, $description, $series, $repetitions, $loads );

		return $wpdb->query( $sql );
	}
	
	//////////////////////////////////////
	// TRAINERS
	//////////////////////////////////////

	public static function get_trainers_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_trainers_table( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;
		$users_table = $wpdb->users;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 't.slug', 't.requested', 't.registered', 't.active' ), true ) )
				$order_by = 't.ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT t.`ID` AS 'ID', u.`display_name` AS 'display_name', u.`user_email` AS 'email', t.`slug` AS 'slug', t.`requested` AS 'requested', t.`registered` AS 'registered', t.`active` AS 'active' FROM $table_name t INNER JOIN $users_table u ON t.`user` = u.`ID` ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT t.`ID` AS 'ID', u.`display_name` AS 'display_name', u.`user_email` AS 'email', t.`slug` AS 'slug', t.`requested` AS 'requested', t.`registered` AS 'registered', t.`active` AS 'active' FROM $table_name t INNER JOIN $users_table u ON t.`user` = u.`ID` ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT t.`ID` AS 'ID', u.`display_name` AS 'display_name', u.`user_email` AS 'email', t.`slug` AS 'slug', t.`requested` AS 'requested', t.`registered` AS 'registered', t.`active` AS 'active' FROM $table_name t INNER JOIN $users_table u ON t.`user` = u.`ID` ORDER BY registered ASC");
		}
	}

	public static function get_trainer( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function get_trainer_by_slug( $slug )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `slug` = %s", $slug );

		return $wpdb->get_row( $sql );
	}

	public static function get_available_trainers()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;

		return $wpdb->get_results( "SELECT * FROM $table_name WHERE active = 1 AND registered IS NOT NULL");
	}

	public static function get_available_trainer_slugs()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;

		return $wpdb->get_col( "SELECT slug FROM $table_name WHERE active = 1 AND registered IS NOT NULL");
	}

	public static function insert_trainer( $user, $slug, $requested = null, $registered = null, $active = 0 )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;

		return $wpdb->insert(
			$table_name,
			array(
				'requested' => !is_null( $requested ) ? $requested : date( 'Y-m-d H:i:s' ),
				'registered' => $registered,
				'user' => $user,
				'slug' => $slug,
				'active' => $active
			),
			array(
				'%s', '%s', '%d', '%s', '%d'
			)
		);
	}

	public static function register_trainer( $trainer_id, $register_date = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'registered' => is_string( $register_date ) ? $register_date :date( 'Y-m-d H:i:s' ),
				'active' => 1
			),
			array(
				'ID' => (int)$trainer_id
			),
			array( '%s', '%d' ),
			array( '%d' )
		);
	}

	public static function activate_trainer( $trainer_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'active' => 1
			),
			array(
				'ID' => (int)$trainer_id
			),
			array( '%d' ),
			array( '%d' )
		);
	}

	public static function deactivate_trainer( $trainer_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::TRAINERS_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'active' => 0
			),
			array(
				'ID' => (int)$trainer_id
			),
			array( '%d' ),
			array( '%d' )
		);
	}

	//////////////////////////////////////
	// PURCHASE
	//////////////////////////////////////

	public static function get_students_count()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;

		return $wpdb->get_var( "SELECT count(*) FROM $table_name");
	}

	public static function get_students_table( $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;
		$users_table = $wpdb->users;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 's.email', 's.registered', 's.renewed', 's.active' ), true ) )
				$order_by = 's.ID';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( "SELECT s.`ID` AS 'ID', u.`display_name` AS 'display_name', s.`email` AS 'email', s.`registered` AS 'registered', s.`renewed` AS 'renewed', s.`active` AS 'active' FROM $table_name s INNER JOIN $users_table u ON s.`email` = u.`user_email` ORDER BY $order_by $order" );
			else
				return $wpdb->get_results( "SELECT s.`ID` AS 'ID', u.`display_name` AS 'display_name', s.`email` AS 'email', s.`registered` AS 'registered', s.`renewed` AS 'renewed', s.`active` AS 'active' FROM $table_name s INNER JOIN $users_table u ON s.`email` = u.`user_email` ORDER BY $order_by $order LIMIT $results OFFSET $offset" );
		}
		else
		{
			return $wpdb->get_results( "SELECT s.`ID` AS 'ID', u.`display_name` AS 'display_name', s.`email` AS 'email', s.`registered` AS 'registered', s.`renewed` AS 'renewed', s.`active` AS 'active' FROM $table_name s INNER JOIN $users_table u ON s.`email` = u.`user_email` ORDER BY registered ASC");
		}
	}

	public static function get_student( $id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `ID` = %d", $id );

		return $wpdb->get_row( $sql );
	}

	public static function is_order_registered( $order_id, $email )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `order` = %d AND `email` = %s",
				$order_id,
				$email
			)
		);

		return $row !== null;
	}

	public static function get_last_user_register( $email )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `email` = %s ORDER BY `registered` DESC LIMIT 1",
				$email
			)
		);

		return $row;
	}

	public static function is_register_active( $student_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `active` = 1 AND `ID` = %d",
				(int)$student_id
			)
		);

		return $row !== null;
	}

	public static function is_user_registered_and_active( $email )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `active` = 1 AND `email` = %s ORDER BY `ID` DESC LIMIT 1",
				$email
			)
		);

		return $row !== null;
	}

	public static function insert_student( $email, $order_id, $product_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;

		return $wpdb->insert(
			$table_name,
			array(
				'registered' => date( 'Y-m-d H:i:s' ),
				'email' => $email,
				'order' => $order_id,
				'product' => $product_id,
				'active' => 1
			),
			array(
				'%s', '%s', '%d', '%s', '%d'
			)
		);
	}

	public static function activate_student( $student_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'active' => 1
			),
			array(
				'ID' => (int)$student_id
			),
			array( '%d' ),
			array( '%d' )
		);
	}

	public static function deactivate_student( $student_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;
		$result = $wpdb->update(
			$table_name,
			array(
				'active' => 0
			),
			array(
				'ID' => (int)$student_id
			),
			array( '%d' ),
			array( '%d' )
		);
	}

	public static function get_no_training_users()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;
		$training_table_name = $wpdb->base_prefix . self::TRAINING_TABLE;
		
		return $wpdb->get_results( "SELECT * FROM $table_name WHERE `active` = 1 AND `ID` NOT IN (SELECT DISTINCT `user` FROM $training_table_name WHERE `start` <= NOW() AND `end` >= NOW() )" );
	}

	public static function get_no_diet_users()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;
		$diet_table_name = $wpdb->base_prefix . self::DIET_TABLE;
		
		return $wpdb->get_results( "SELECT * FROM $table_name WHERE `active` = 1 AND `ID` NOT IN (SELECT DISTINCT `user` FROM $diet_table_name WHERE `start` <= NOW() AND `end` >= NOW() )" );
	}

	public static function get_no_updated_tracking_users()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;
		$tracking_table = $wpdb->base_prefix . self::STUDENT_TRACKING_TABLE;

		$days = self::USER_UPDATE_MAX_DAYS;
		
		return $wpdb->get_results( "SELECT * FROM $table_name WHERE `active` = 1 AND `ID` NOT IN (SELECT DISTINCT `student_id` FROM $tracking_table WHERE `saved` >= DATE_ADD(NOW(), INTERVAL -$days DAY) )" );
	}

	public static function get_no_updated_image_tracking_users()
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENTS_TABLE;
		$users = $wpdb->get_results( "SELECT * FROM $table_name WHERE `active` = 1" );
		if( empty( $users ) )
			return array();

		$days = self::USER_UPDATE_MAX_DAYS;

		$upload_dir = wp_upload_dir();
		if( empty( $upload_dir ) )
			return $users;

		$upload_base = $upload_dir['basedir'];
		$target_dir_base = $upload_base . DIRECTORY_SEPARATOR . 'image-tracking' . DIRECTORY_SEPARATOR . 'u_';

		$time = time();
		$no_updated = array();

		foreach( $users as $user )
		{
			$include = true;
			$target_dir = $target_dir_base . $user->ID;
			
			if( is_readable( $target_dir ) )
			{
				$dir_files = scandir( $target_dir );

				foreach( $dir_files as $dir_file )
				{
					if( ( $time - filemtime( $target_dir . DIRECTORY_SEPARATOR . $dir_file ) ) < ( $days * 86400 ) )
					{
						$include = false;
						break;			
					}
				}
			}

			if( $include )
				$no_updated[] = $user;
		}
		
		return $no_updated;
	}

	// PERSONAL INFO

	public static function has_personal_info( $register_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_INFO_TABLE;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `student_id` = %d",
				$register_id
			)
		);

		return $row !== null;
	}

	public static function insert_personal_info(
		$student_id,
		$weight,
		$male,
		$birthday,
		$obj_health,
		$obj_remove_stress,
		$obj_improve_physically,
		$obj_strength,
		$obj_injury_recover,
		$obj_examination,
		$obj_loss_fat,
		$obj_improve_postural,
		$obj_gain_mass,
		$obj_loss_volume,
		$obj_improve_resistance,
		$obj_other,
		$injuries,
		$diseases,
		$medications,
		$blood_preasure,
		$sport_currently,
		$sport,
		$sport_frequency,
		$sport_days,
		$training_days,
		$work,
		$active_work,
		$sleep_hours,
		$diet,
		$meals
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_INFO_TABLE;
		$result = $wpdb->insert(
			$table_name,
			array(
				'student_id' => $student_id,
				'saved' => date( 'Y-m-d h:i:s' ),
				'weight' => $weight,
				'male' => $male,
				'birthday' => $birthday,
				'obj_health' => $obj_health,
				'obj_remove_stress' => $obj_remove_stress,
				'obj_improve_physically' => $obj_improve_physically,
				'obj_strength' => $obj_strength,
				'obj_injury_recover' => $obj_injury_recover,
				'obj_examination' => $obj_examination,
				'obj_loss_fat' => $obj_loss_fat,
				'obj_improve_postural' => $obj_improve_postural,
				'obj_gain_mass' => $obj_gain_mass,
				'obj_loss_volume' => $obj_loss_volume,
				'obj_improve_resistance' => $obj_improve_resistance,
				'obj_other' => $obj_other,
				'injuries' => $injuries,
				'diseases' => $diseases,
				'medications' => $medications,
				'blood_preasure' => $blood_preasure,
				'sport_currently' => $sport_currently,
				'sport' => $sport,
				'sport_frequency' => $sport_frequency,
				'sport_days' => $sport_days,
				'training_days' => $training_days,
				'work' => $work,
				'active_work' => $active_work,
				'sleep_hours' => $sleep_hours,
				'diet' => $diet,
				'meals' => $meals
			),
			array(
				'%d',
				'%s',
				'%f',
				'%d',
				'%s',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%s',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%s',
				'%d'
			)
		);

		return $result;
	}

	public static function get_last_personal_info( $student_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_INFO_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY `saved` DESC LIMIT 1", $student_id );
		return $wpdb->get_row( $sql );
	}

	public static function get_personal_info( $student_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_INFO_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY `saved` DESC", $student_id );
		return $wpdb->get_results( $sql );
	}

	// STUDENT FOOD

	public static function has_food_info( $register_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `student_id` = %d LIMIT 1",
				$register_id
			)
		);

		return $row !== null;
	}

	public static function get_food_info_dates( $register_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT DISTINCT( `saved` ) FROM $table_name WHERE `student_id` = %d ORDER BY `saved` DESC",
				$register_id
			)
		);
	}

	public static function get_food_info_last_date( $register_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT MAX( `saved` ) AS 'saved' FROM $table_name WHERE `student_id` = %d",
				$register_id
			)
		);
	}

	public static function get_food_info( $register_id, $saved )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `student_id` = %d AND `saved` = %s",
				$register_id,
				$saved
			)
		);
	}

	public static function insert_student_food_info( $student_id, $food_data )
	{
		if( !is_array( $food_data ) )
			return false;

		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_FOOD_TABLE;

		$saved = date( 'Y-m-d h:i:s' );

		foreach( $food_data as $food )
			if( false === $wpdb->insert(
				$table_name,
				array(
					'student_id' => $student_id,
					'food_id' => $food['ID'],
					'saved' => $saved,
					'frequent' => $food['frequent'],
					'valuation' => $food['valuation'],
				),
				array(
					'%d', '%d', '%s', '%d', '%d'
				)
			) )
			return false;

		return true;
	}

	// MEAL HABITS

	public static function has_meal_habits( $register_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_MEALS_TABLE;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `student_id` = %d LIMIT 1",
				$register_id
			)
		);

		return $row !== null;
	}

	public static function get_meal_habits( $register_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_MEALS_TABLE;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY `saved` DESC",
				$register_id
			)
		);
	}

	public static function get_meal_habit_intervals( $register_id, $saved )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_MEAL_INTERVALS_TABLE;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `student_id` = %d AND `saved` = %s",
				$register_id,
				$saved
			)
		);
	}

	public static function get_last_meal_habit( $register_id )
	{
		global $wpdb;
		$table_name = $wpdb->base_prefix . self::STUDENT_MEALS_TABLE;

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY `saved` DESC LIMIT 1",
				$register_id
			)
		);
	}

	public static function insert_meal_habits( $student_id, $meals_data, $observations )
	{
		if( !is_array( $meals_data ) )
			return false;

		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_MEALS_TABLE;
		$interval_table_name = $wpdb->base_prefix . self::STUDENT_MEAL_INTERVALS_TABLE;

		$saved = date( 'Y-m-d h:i:s' );

		if( false === $wpdb->insert(
			$table_name,
			array(
				'student_id' => $student_id,
				'saved' => $saved,
				'observations' => $observations
			),
			array(
				'%d', '%s', '%s'
			)
		) )
			return false;

		foreach( $meals_data as $interval => $tasks )
			if( false === $wpdb->insert(
				$interval_table_name,
				array(
					'student_id' => $student_id,
					'saved' => $saved,
					'interval' => $interval,
					'tasks' => $tasks
				),
				array(
					'%d', '%s', '%d', '%s'
				)
			) )
				return false;

		return true;
	}

	// TRACKING

	public static function get_user_tracking_count( $student_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_TRACKING_TABLE;

		return $wpdb->get_var( $wpdb->prepare( "SELECT count(*) FROM $table_name WHERE `student_id` = %d", $student_id ) );
	}

	public static function get_user_tracking_items( $student_id, $results = null, $offset = null, $order_by = null, $order = null )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_TRACKING_TABLE;

		if( $order || $order_by || $results || $offset !== null )
		{
			if( $order !== 'desc' ) $order = 'asc';

			if( !in_array( $order_by, array( 'saved' ), true ) )
				$order_by = 'saved';

			if( !is_integer( $offset ) )
				$offset = 0;

			if( !is_integer( $results ) )
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY $order_by $order", $student_id ) );
			else
				return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY $order_by $order LIMIT $results OFFSET $offset", $student_id) );
		}
		else
		{
			return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY `saved` ASC", $student_id ) );
		}
	}

	public static function get_last_user_tracking( $student_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_TRACKING_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY `saved` DESC LIMIT 1", $student_id );

		return $wpdb->get_row( $sql );
	}

	public static function get_user_tracking( $student_id )
	{
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_TRACKING_TABLE;

		$sql = $wpdb->prepare( "SELECT * FROM $table_name WHERE `student_id` = %d ORDER BY `saved` DESC", $student_id );

		return $wpdb->get_results( $sql );
	}

	public static function insert_user_tracking(
		$student_id,
		$weight,
		$biceps,
		$shoulder,
		$chest,
		$waist,
		$hip,
		$thigh,
		$leg,
		$calf,
		$observations
	) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . self::STUDENT_TRACKING_TABLE;

		$saved = date( 'Y-m-d h:i:s' );

		if( false === $wpdb->insert(
			$table_name,
			array(
				'student_id' => $student_id,
				'saved' => $saved,
				'weight' => $weight,
				'biceps' => $biceps,
				'shoulder' => $shoulder,
				'chest' => $chest,
				'waist' => $waist,
				'hip' => $hip,
				'thigh' => $thigh,
				'leg' => $leg,
				'calf' => $calf,
				'observations' => $observations
			),
			array(
				'%d', '%s', '%f', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%s'
			)
		) )
			return false;

		return true;
	}

}

} //false
