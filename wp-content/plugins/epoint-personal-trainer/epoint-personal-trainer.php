<?php
/**
 * Plugin Name: Epoint Personal Trainer
 * Plugin URI:
 * Description: Online training management
 * Version: 1.11
 * Author: Epoint
 * AUthor URI: https://epoint.es/
 * Text Domain: epoint-personal-trainer-textdomain
 * License: EULA
 */

defined( 'ABSPATH' ) or die( 'Wrong Access' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'jlc-form/jlc-form.php' ) ) {

if( !class_exists( 'JLCCustomForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'jlc-form.php' ) ) );

if( !class_exists( 'EpointPersonalTrainerMapper' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'mapper.php' ) ) );

if( !class_exists( 'EpointPersonalTrainerAdmin' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'epoint-personal-trainer-admin.php' ) ) );

if( !class_exists( 'EpointPersonalTrainerPublic' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'epoint-personal-trainer-public.php' ) ) );

if( !class_exists( 'EpointPersonalTrainerAlerts' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'epoint-personal-trainer-alerts.php' ) ) );

class EpointPersonalTrainer
{
	const TEXT_DOMAIN = 'epoint-personal-trainer-textdomain';
	const VERSION = '1.11';

	// FORMS

	const ADMIN_SETTINGS_FORM_INTERNAL_ID = 'epoint_personal_trainer_settings_form';
	const REGISTER_TRAINER_FORM_INTERNAL_ID = 'epoint_personal_trainer_register_trainer_form';
	const REGISTER_USER_FORM_INTERNAL_ID = 'epoint_personal_trainer_register_user_form';
	const ALREADY_TRAINER_FORM_INTERNAL_ID = 'epoint_personal_trainer_already_trainer_form';
	const SEARCH_TRAINER_FORM_INTERNAL_ID = 'epoint_personal_trainer_search_trainer_form';

	const ALERTS_SETTINGS_FORM_INTERNAL_ID = 'epoint_personal_trainer_alert_settings_form';

	const TRAINER_INFO_FORM_INTERNAL_ID = 'epoint_personal_trainer_trainer_info_form';
	const TRAINING_CENTER_FORM_INTERNAL_ID = 'epoint_personal_trainer_training_center_info_form';
	const PERSONAL_QUESTIONNAIRE_FORM_INTERNAL_ID = 'epoint_personal_trainer_personal_questionnaire_form';
	const EDIT_MEMBER_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_member';
	const EDIT_MEMBER_FULL_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_member_full';
	const MEMBERS_FILTER_FORM_INTERNAL_ID = 'epoint_personal_trainer_members_filter_form';
	const DELETE_MEMBERS_FILTER_FORM_INTERNAL_ID = 'epoint_personal_trainer_delete_members_filter_form';

	const EDIT_EXERCISE_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_exercise_form';
	const EDIT_PRESET_EXERCISE_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_preset_exercise_form';
	const CLONE_EXERCISE_AND_ASSING_FORM_INTERNAL_ID = 'epoint_personal_trainer_clone_exercise_and_assing_form';

	const ADD_EXERCISE_CATEGORY_FORM_INTERNAL_ID = 'epoint_personal_trainer_add_exercise_category_form';
	const EDIT_EXERCISE_CATEGORY_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_exercise_category_form';

	const EDIT_TRAINING_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_training_form';
	const EDIT_PRESET_TRAINING_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_preset_training_form';

	const EDIT_OBJECTIVE_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_objective_form';
	const EDIT_ENVIRONMENT_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_environment_form';

	const LOADS_FORM_INTERNAL_ID = 'epoint_personal_trainer_loads_form';

	const EDIT_FOOD_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_food_form';
	const ADD_USER_FOOD_FORM_INTERNAL_ID = 'epoint_personal_trainer_add_user_food_form';

	const ADD_FOOD_CATEGORY_FORM_INTERNAL_ID = 'epoint_personal_trainer_add_food_category_form';
	const EDIT_FOOD_CATEGORY_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_food_category_form';

	const EDIT_DIET_OBJECTIVE_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_diet_objective_form';
	const EDIT_DIET_RESTRICTION_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_diet_restriction_form';

	const EDIT_DIET_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_diet_form';
	const CREATE_USER_DIET_FORM_INTERNAL_ID = 'epoint_personal_trainer_create_user_diet_form';

	const FOOD_QUESTIONNAIRE_FORM_INTERNAL_ID = 'epoint_personal_trainer_food_questionnaire_form';

	const USER_HABITS_FORM_INTERNAL_ID = 'epoint_personal_trainer_user_habits_form';


	const EDIT_EVOLUTION_MAGNITUDE_FORM_INTERNAL_ID = 'epoint_personal_trainer_edit_evolution_magnitude_form';

	const MEMBER_CORPORAL_MEASURES_FORM_INTERNAL_ID = 'epoint_personal_trainer_member_corporal_measures_form';
	const MEMBER_PHYSICAL_TEST_STRENGTH_FORM_INTERNAL_ID = 'epoint_personal_trainer_member_physical_test_strength_form';
	const MEMBER_PHYSICAL_TEST_SPEED_FORM_INTERNAL_ID = 'epoint_personal_trainer_member_physical_test_speed_form';
	const MEMBER_PHYSICAL_TEST_DISTANCE_FORM_INTERNAL_ID = 'epoint_personal_trainer_member_physical_test_distance_form';
	const MEMBER_EVOLUTION_PHOTOS_FORM_INTERNAL_ID = 'epoint_personal_trainer_member_evolution_photos_form';

	const TRAINER_VALORATION_FORM_INTERNAL_ID = 'epoint_personal_trainer_trainer_valoration_form';

	// OPTIONS

	const NOTIFICATION_ADDR_KEY = 'epoint_personal_trainer_notification_addr';
	const CONTACT_EMAIL_KEY = 'epoint_personal_trainer_contact_email';
/*
	const REDSYS_API_VERSION_KEY = 'epoint_personal_trainer_redsys_api_version';
	const REDSYS_MODE_KEY = 'epoint_personal_trainer_redsys_mode';
	const REDSYS_TEST_URL_KEY = 'epoint_personal_trainer_redsys_test_url';
	const REDSYS_PRODUCTION_URL_KEY = 'epoint_personal_trainer_redsys_production_url';
	const REDSYS_TEST_URL_DEFAULT = 'https://sis-t.redsys.es:25443/sis/realizarPago';
	const REDSYS_PRODUCTION_URL_DEFAULT = 'https://sis.redsys.es/sis/realizarPago';

	const REDSYS_MERCHANT_CODE_KEY = 'epoint_personal_trainer_redsys_merchant_code';
	const REDSYS_TERMINAL_KEY = 'epoint_personal_trainer_redsys_terminal';
	//const REDSYS_TRANSACTION_TYPE_KEY = 'epoint_personal_trainer_redsys_transaction_type';
	const REDSYS_CURRENCY_KEY = 'epoint_personal_trainer_redsys_currency';
	const REDSYS_MERCHANT_PAGE_KEY = 'epoint_personal_trainer_redsys_merchant_page';
	const REDSYS_MERCHANT_PAGE_OK_KEY = 'epoint_personal_trainer_redsys_merchant_page_ok';
	const REDSYS_MERCHANT_PAGE_KO_KEY = 'epoint_personal_trainer_redsys_merchant_page_ko';
	const REDSYS_MERCHANT_NAME_KEY = 'epoint_personal_trainer_redsys_merchant_name';
	const REDSYS_SECRET_ENCRIPTION_KEY_KEY = 'epoint_personal_trainer_redsys_secret_encription_key';
*/

	// ROLES

	const TRAINER_ROLE = 'epoint_personal_trainer_trainer';
	const SPORTSMAN_ROLE = 'epoint_personal_trainer_sportsman';


	// ACTIONS
	const NEW_TRAINER_SITE_ACTION = 'epoint_personal_trainer_new_trainer_site_created';

	public static function load_personal_info_management()
	{
		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'data', 'personal-info.php' ) ) );
	}
	public static function get_user_personal_info( $user_id = null )
	{
		self::load_personal_info_management();

		return new EpointPersonalTrainerPersonalInfo( $user_id );
	}

	public static function load_trainer_info_management()
	{
		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'data', 'trainer-info.php' ) ) );
	}
	public static function get_user_trainer_info( $user_id = null )
	{
		self::load_trainer_info_management();

		return new EpointPersonalTrainerTrainerInfo( $user_id );
	}

	public static function get_trainer_valoration( $blog_id )
	{
		global $wpdb;

		$sql = 'SELECT meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key = %s';

		$vals = $wpdb->get_col( $wpdb->prepare( $sql, 'trainer_valoration_' . $blog_id ) );
	
		if( !count( $vals ) )
			return null;

		$ret = 0;
		foreach( $vals as $val )
			$ret += (int)$val;

		return $ret / count( $vals );
	}

	public static function get_trainer_valoration_comments( $blog_id )
	{
		global $wpdb;

		$sql = 'SELECT meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key = %s';

		$vals = $wpdb->get_col( $wpdb->prepare( $sql, 'trainer_valoration_comment_' . $blog_id ) );
	
		if( !count( $vals ) )
			return array();

		return $vals;
	}


	public static function initialize()
	{
		// INSTALLATION
		register_activation_hook(
			__FILE__,
			array(
				get_class(),
				'install'
			)
		);
		register_deactivation_hook(
			__FILE__,
			array(
				get_class(),
				'uninstall'
			)
		);

		add_action(
			'plugins_loaded',
			function(){
				$plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages';
				load_plugin_textdomain( self::TEXT_DOMAIN, false, $plugin_rel_path );
			}
		);

		EpointPersonalTrainerAdmin::initialize();
		EpointPersonalTrainerPublic::initialize();
		EpointPersonalTrainerAlerts::initialize();
/*
		add_action( 'init', array( get_class(), 'redsys_merchanturl_endpoint' ) );
		add_action( 'wp', array( get_class(), 'redsys_read_merchanturl_data' ) );
		add_action( 'template_redirect', array( get_class(), 'redsys_validate_return_page' ) );
*/

		add_action( self::NEW_TRAINER_SITE_ACTION, array( get_class(), 'create_default_objectives' ), 10, 2 );
		add_action( self::NEW_TRAINER_SITE_ACTION, array( get_class(), 'create_default_environments' ), 10, 2 );
		add_action( self::NEW_TRAINER_SITE_ACTION, array( get_class(), 'create_default_food' ), 10, 2 );
		add_action( self::NEW_TRAINER_SITE_ACTION, array( get_class(), 'create_default_diet_objectives' ), 10, 2 );
		add_action( self::NEW_TRAINER_SITE_ACTION, array( get_class(), 'create_default_diet_restrictions' ), 10, 2 );
		add_action( self::NEW_TRAINER_SITE_ACTION, array( get_class(), 'create_default_evolution_magnitudes' ), 10, 2 );

		add_action( 'network_admin_menu', array( get_class(), 'network_admin_menu' ) );

		foreach( self::get_forms() as $form_id => $form )
			JLCCustomForm::register_form(
				$form_id,
				$form['dir'],
				$form['file'],
				$form['args'],
				__FILE__
			);

	}

	public static function network_admin_menu()
	{
		$title = __( 'Master', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_menu_page(
			$title,
			$title,
			'administrator',
			'epoint-personal-trainer-master-page',
			array(
				get_class(),
				'print_master_admin_page'
			),
			'dashicons-id-alt',
			40
		);
		//add_action( "load-$hook", array( get_class(), 'screen_option' ) );

		$title = __( 'Ajustes de precios', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_submenu_page(
			'epoint-personal-trainer-master-page',
			$title,
			$title,
			'administrator',
			'epoint-personal-trainer-commercial-settings-page',
			array(
				get_class(),
				'print_commercial_settings_admin_page',
			)
		);

		$title = __( 'Exportar datos comerciales', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_submenu_page(
			'epoint-personal-trainer-master-page',
			$title,
			$title,
			'administrator',
			'epoint-personal-trainer-export-commercial-data-page',
			array(
				get_class(),
				'print_export_commercial_data_admin_page',
			)
		);
	}

	public static function print_master_admin_page()
	{
	}

	public static function print_commercial_settings_admin_page()
	{
	}

	public static function print_export_commercial_data_admin_page()
	{
	}

	public static function get_forms()
	{
		$dir = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) );

		return array(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID => array(
				'ID' => self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerSettings.php',
				'dir' => $dir,
				'args' => array(
					'admin_page_slug' => EpointPersonalTrainerAdmin::ADMIN_SETTINGS_PAGE_SLUG,
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::REGISTER_TRAINER_FORM_INTERNAL_ID => array(
				'ID' => self::REGISTER_TRAINER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerRegisterTrainer.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ALREADY_TRAINER_FORM_INTERNAL_ID => array(
				'ID' => self::ALREADY_TRAINER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerAlreadyTrainer.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::SEARCH_TRAINER_FORM_INTERNAL_ID => array(
				'ID' => self::SEARCH_TRAINER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerSearchTrainer.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_PRESET_EXERCISE_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_PRESET_EXERCISE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditPresetExercise.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::CLONE_EXERCISE_AND_ASSING_FORM_INTERNAL_ID => array(
				'ID' => self::CLONE_EXERCISE_AND_ASSING_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerCloneExerciseAndAssign.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_PRESET_TRAINING_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_PRESET_TRAINING_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditPresetTraining.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			)
		);
	}

	public static function get_subsites_forms()
	{
		$dir = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) );

		return array(

			self::ALERTS_SETTINGS_FORM_INTERNAL_ID => array(
				'ID' => self::ALERTS_SETTINGS_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerAlertsSettings.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::REGISTER_USER_FORM_INTERNAL_ID => array(
				'ID' => self::REGISTER_USER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerRegisterUser.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::TRAINER_INFO_FORM_INTERNAL_ID => array(
				'ID' => self::TRAINER_INFO_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerTrainerInfo.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::TRAINING_CENTER_FORM_INTERNAL_ID => array(
				'ID' => self::TRAINING_CENTER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerTrainingCenterInfo.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::PERSONAL_QUESTIONNAIRE_FORM_INTERNAL_ID => array(
				'ID' => self::PERSONAL_QUESTIONNAIRE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerPersonalQuestionnaire.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_MEMBER_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_MEMBER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditMember.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_MEMBER_FULL_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_MEMBER_FULL_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditMemberFull.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::MEMBERS_FILTER_FORM_INTERNAL_ID => array(
				'ID' => self::MEMBERS_FILTER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerMembersFilter.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::DELETE_MEMBERS_FILTER_FORM_INTERNAL_ID => array(
				'ID' => self::DELETE_MEMBERS_FILTER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerDeleteMembersFilter.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_EXERCISE_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_EXERCISE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditExercise.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ADD_EXERCISE_CATEGORY_FORM_INTERNAL_ID => array(
				'ID' => self::ADD_EXERCISE_CATEGORY_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerAddExerciseCategory.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_EXERCISE_CATEGORY_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_EXERCISE_CATEGORY_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditExerciseCategory.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_TRAINING_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_TRAINING_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditTraining.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_OBJECTIVE_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_OBJECTIVE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditObjective.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_ENVIRONMENT_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_ENVIRONMENT_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditEnvironment.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::LOADS_FORM_INTERNAL_ID => array(
				'ID' => self::LOADS_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerLoads.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_FOOD_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_FOOD_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditFood.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ADD_USER_FOOD_FORM_INTERNAL_ID => array(
				'ID' => self::ADD_USER_FOOD_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerAddUserFood.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::ADD_FOOD_CATEGORY_FORM_INTERNAL_ID => array(
				'ID' => self::ADD_FOOD_CATEGORY_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerAddFoodCategory.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_FOOD_CATEGORY_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_FOOD_CATEGORY_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditFoodCategory.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_DIET_OBJECTIVE_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_DIET_OBJECTIVE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditDietObjective.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_DIET_RESTRICTION_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_DIET_RESTRICTION_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditDietRestriction.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_DIET_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_DIET_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditDiet.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::CREATE_USER_DIET_FORM_INTERNAL_ID => array(
				'ID' => self::CREATE_USER_DIET_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerCreateUserDiet.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::FOOD_QUESTIONNAIRE_FORM_INTERNAL_ID => array(
				'ID' => self::FOOD_QUESTIONNAIRE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerFoodQuestionnaire.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::USER_HABITS_FORM_INTERNAL_ID => array(
				'ID' => self::USER_HABITS_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerUserHabits.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_EVOLUTION_MAGNITUDE_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_EVOLUTION_MAGNITUDE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditEvolutionMagnitude.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::MEMBER_CORPORAL_MEASURES_FORM_INTERNAL_ID => array(
				'ID' => self::MEMBER_CORPORAL_MEASURES_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerMemberCorporalMeasures.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::MEMBER_PHYSICAL_TEST_STRENGTH_FORM_INTERNAL_ID => array(
				'ID' => self::MEMBER_PHYSICAL_TEST_STRENGTH_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerMemberPhysicalTestStrength.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN,
					'type' => 'strength'
				)
			),
			self::MEMBER_PHYSICAL_TEST_SPEED_FORM_INTERNAL_ID => array(
				'ID' => self::MEMBER_PHYSICAL_TEST_SPEED_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerMemberPhysicalTestSpeed.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN,
					'type' => 'speed'
				)
			),
			self::MEMBER_PHYSICAL_TEST_DISTANCE_FORM_INTERNAL_ID => array(
				'ID' => self::MEMBER_PHYSICAL_TEST_DISTANCE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerMemberPhysicalTestDistance.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN,
					'type' => 'distance'
				)
			),
			self::MEMBER_EVOLUTION_PHOTOS_FORM_INTERNAL_ID => array(
				'ID' => self::MEMBER_EVOLUTION_PHOTOS_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerMemberEvolutionPhotos.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::TRAINER_VALORATION_FORM_INTERNAL_ID => array(
				'ID' => self::TRAINER_VALORATION_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerTrainerValoration.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
		);
	}

	public static function install()
	{
		add_role( self::TRAINER_ROLE, __( 'Trainer', self::TEXT_DOMAIN ), array( 'read' => true ) );
		add_role( self::SPORTSMAN_ROLE, __( 'Sportsman', self::TEXT_DOMAIN ), array( 'read' => true ) );

		EpointPersonalTrainerMapper::install();

		foreach( self::get_forms() as $form_id => $form )
			JLCCustomForm::register_form(
				$form_id,
				$form['dir'],
				$form['file'],
				$form['args'],
				__FILE__
			);

		if ( ! wp_next_scheduled( 'epoint_personal_trainer_send_alerts' ) ) {
			wp_schedule_event( time(), 'daily', 'epoint_personal_trainer_send_alerts' );
		}

		//self::redsys_merchanturl_endpoint();
		//self::signaturit_eventsurl_endpoint();
		//flush_rewrite_rules();
	}

	public static function uninstall()
	{
		$timestamp = wp_next_scheduled( 'epoint_personal_trainer_send_alerts' );
		wp_unschedule_event( $timestamp, 'epoint_personal_trainer_send_alerts' );

		$dir = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) );

		foreach( self::get_forms() as $form_id => $form )
			JLCCustomForm::unregister_form(
				$form_id,
				$form['dir'],
				$form['file']
			);

		EpointPersonalTrainerMapper::uninstall();

		remove_role( 'epoint_personal_trainer_trainer' );
		remove_role( 'epoint_personal_trainer_sportsman' );

		//flush_rewrite_rules();
	}

/*
	public static function load_redsys_client()
	{
		if( !class_exists( 'RedsysClient' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'redsys-client.php' ) ) );
	}

	public static function redsys_merchanturl_endpoint()
	{
		add_rewrite_endpoint( 'update_deposit', EP_PAGES );
	}

	protected static function redsys_process_merchanturl_data( $signature_version, $merchant_parameters, $signature )
	{
		self::load_redsys_client();

		if( !RedsysClient::validate_response_parameters(
			sanitize_text_field( $signature_version ),
			sanitize_text_field( $merchant_parameters ),
			sanitize_text_field( $signature )
		) ) {
			error_log( 'Invalid Redsys Parameters' );
			return false;
		}

		$params = RedsysClient::get_response_parameters( sanitize_text_field( $merchant_parameters ) );

		$response = $params['Ds_Response'];
		if( !is_numeric( $response ) )
		{
			error_log( 'Invalid Redsys Response' );
			return false;
		}


		$reponse = (int)$response;
		if( $response < 0 || $response > 99 )
		{
			// PAGO FALLIDO
			error_log( 'Failed Redsys Payment' );
		}
		else
		{
			$token = $params['Ds_MerchantData'];
			$solicitude = EpointPersonalTrainerMapper::get_solicitude_by_token( $token );
			if( !$solicitude ||
				$solicitude->deposit )
			{
				error_log( var_export( $params, true ) );
				error_log( 'Redsys Payment ignored due to solicitude' );
				self::send_deposit_ignored_notification();
				return false;
			}

			$deposit_id = EpointPersonalTrainerMapper::create_deposit(
				$params['Ds_Date'],
				$params['Ds_Hour'],
				$params['Ds_Amount'],
				$params['Ds_Currency'],
				$params['Ds_Order'],
				$params['Ds_MerchantCode'],
				$params['Ds_Terminal'],
				$params['Ds_Response'],
				$params['Ds_MerchantData'],
				$params['Ds_SecurePayment'],
				$params['Ds_TransactionType']
			);

			if( !$deposit_id )
			{
				error_log( 'Redsys Payment can not be stored' );
				self::send_deposit_fail_notification( $solicitude->ID );
				return false;
			}

			if( false !== EpointPersonalTrainerMapper::set_solicitude_deposit( $solicitude->ID, $deposit_id ) )
			{
				self::send_deposit_paid_confirmation( $solicitude->ID );
			}
			else
			{
				error_log( 'Redsys Payment can not be linked' );
				self::send_deposit_fail_notification( $solicitude->ID );
			}
		}

		return true;
	}

	public static function redsys_read_merchanturl_data()
	{
		global $wp_query;


		if( isset( $wp_query->query_vars['update_deposit'] ) && get_option( self::REDSYS_MERCHANT_PAGE_KEY ) && is_page( get_option( self::REDSYS_MERCHANT_PAGE_KEY ) ) )
		{
error_log( 'Redsys called' );
			if( empty( $_POST['Ds_SignatureVersion'] ) ||
				empty( $_POST['Ds_MerchantParameters'] ) ||
				empty( $_POST['Ds_Signature'] )
			) {
				error_log( 'Empty Redsys Parameters' );
				die;
			}

			self::redsys_process_merchanturl_data(
				$_POST['Ds_SignatureVersion'],
				$_POST['Ds_MerchantParameters'],
				$_POST['Ds_Signature']
			);

			exit;
			
		}
	}

	public static function redsys_validate_return_page()
	{
		if( ( get_option( self::REDSYS_MERCHANT_PAGE_OK_KEY ) && is_page( get_option( self::REDSYS_MERCHANT_PAGE_OK_KEY ) ) ) ||
			( get_option( self::REDSYS_MERCHANT_PAGE_OK_KEY ) && is_page( get_option( self::REDSYS_MERCHANT_PAGE_KO_KEY ) ) )
		) {
			if( empty( $_GET['Ds_SignatureVersion'] ) ||
				empty( $_GET['Ds_MerchantParameters'] ) ||
				empty( $_GET['Ds_Signature'] ) )
			{
				wp_redirect( get_home_url() );
				die;
			}

			self::load_redsys_client();

			if( !RedsysClient::validate_response_parameters(
				sanitize_text_field( $_GET['Ds_SignatureVersion'] ),
				sanitize_text_field( $_GET['Ds_MerchantParameters'] ),
				sanitize_text_field( $_GET['Ds_Signature'] )
			) ) {
				wp_redirect( get_home_url() );
				die;
			}

			
			if( get_option( self::REDSYS_MERCHANT_PAGE_OK_KEY ) && is_page( get_option( self::REDSYS_MERCHANT_PAGE_OK_KEY ) ) )
			{
				$params = RedsysClient::get_response_parameters(sanitize_text_field( $_GET['Ds_MerchantParameters'] ) );
				$response = $params['Ds_Response'];
				if( !is_numeric( $response ) )
				{
					wp_redirect( get_home_url() );
					die;
				}

				$reponse = (int)$response;
				if( $response < 0 || $response > 99 )
				{
					$url = get_permalink( get_option( self::REDSYS_MERCHANT_PAGE_KO_KEY ) );
					$url .= '?' . implode( '&', array(
						'Ds_SignatureVersion=' . $_GET['Ds_SignatureVersion'],
						'Ds_MerchantParameters=' . $_GET['Ds_MerchantParameters'],
						'Ds_Signature=' . $_GET['Ds_Signature']
					) );

					wp_redirect( $url );
					die;
				}
				else
				{
					if( !self::redsys_process_merchanturl_data(
						$_GET['Ds_SignatureVersion'],
						$_GET['Ds_MerchantParameters'],
						$_GET['Ds_Signature']
					) )
					{
						$url = get_permalink( get_option( self::REDSYS_MERCHANT_PAGE_KO_KEY ) );
						$url .= '?' . implode( '&', array(
							'Ds_SignatureVersion=' . $_GET['Ds_SignatureVersion'],
							'Ds_MerchantParameters=' . $_GET['Ds_MerchantParameters'],
							'Ds_Signature=' . $_GET['Ds_Signature']
						) );

						wp_redirect( $url );
						die;
					}
				}
			}
		}
	}

*/



	/////////////////////////////////
	// ACTIONS
	/////////////////////////////////

	public static function create_default_objectives( $blog_id, $user )
	{
		$default = EpointPersonalTrainerMapper::get_trainer_objectives( null );

		foreach( $default as $d )
			EpointPersonalTrainerMapper::create_objective(
				$d->name,
				$d->position,
				$d->active,
				$user->ID
			);
	}

	public static function create_default_environments( $blog_id, $user )
	{
		$default = EpointPersonalTrainerMapper::get_trainer_environments( null );

		foreach( $default as $d )
			EpointPersonalTrainerMapper::create_environment(
				$d->name,
				$d->position,
				$d->active,
				$user->ID
			);
	}

	public static function create_default_food( $blog_id, $user )
	{
		//$default_cats = EpointPersonalTrainerMapper::get_food_categories();
		$default_cats = EpointPersonalTrainerMapper::get_food_items_grouped_by_category();

		foreach( $default_cats as $d )
		{
			$nd_id = EpointPersonalTrainerMapper::create_food_category(
				$d->name,
				$d->position,
				$d->active,
				$user->ID,
				$blog_id
			);

			foreach( $d->food as $f )
			{
				$nf_id = EpointPersonalTrainerMapper::create_food(
					$f->name,
					$f->position,
					$f->active,
					array( $nd_id ),
					null, //user
					$user->ID
				);
			}
		}
		
	}

	public static function create_default_diet_objectives( $blog_id, $user )
	{
		$default = EpointPersonalTrainerMapper::get_trainer_diet_objectives( null );

		foreach( $default as $d )
			EpointPersonalTrainerMapper::create_diet_objective(
				$d->name,
				$d->position,
				$d->active,
				$user->ID
			);
	}

	public static function create_default_diet_restrictions( $blog_id, $user )
	{
		$default = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( null );

		foreach( $default as $d )
			EpointPersonalTrainerMapper::create_diet_restriction(
				$d->name,
				$d->position,
				$d->active,
				$user->ID
			);
	}

	public static function create_default_evolution_magnitudes( $blog_id, $user )
	{
		$default = EpointPersonalTrainerMapper::get_trainer_evolution_magnitudes( null );

		foreach( $default as $d )
			EpointPersonalTrainerMapper::insert_evolution_magnitude(
				$d->name,
				$d->position,
				$d->active,
				$d->type,
				$d->unit,
				$user->ID
			);
	}


	/////////////////////////////////
	// MAIL
	/////////////////////////////////

	public static function get_contact_email()
	{
		return get_option( self::CONTACT_EMAIL_KEY );
	}

	public static function get_notification_addresses()
	{
		$val = get_option( self::NOTIFICATION_ADDR_KEY );
		if( !is_string( $val ) )
			return array();

		$ret = array();
		$aux = explode( ',', $val );
		foreach( $aux as $addr )
		{
			$addr = trim( $addr );
			if( filter_var( $addr, FILTER_VALIDATE_EMAIL ) )
				$ret[] = $addr;
		}

		return $ret;
	}

	public static function get_mail_headers( $reply_to = null )
	{
		$ret = array( 'Content-type: text/html; charset=utf-8' );

		$contact_addr = self::get_contact_email();
		if( !empty( $contact_addr ) && filter_var( $contact_addr, FILTER_VALIDATE_EMAIL ) )
		{
			$site = get_bloginfo( 'name' );

			$reply_to_addr = $reply_to !== null ? $reply_to : $contact_addr;

			$ret[] = "From: $site <$contact_addr>";
			$ret[] = "Reply-to: $reply_to_addr";
		}
	
		return $ret;
	}

	public static function wrap_mail( $email_heading, $message )
	{
		if( function_exists( 'WC' ) )
		{
			$mailer = WC()->mailer();
			$email_obj = new WC_Email();
			$message = apply_filters( 'woocommerce_mail_content', $email_obj->style_inline( $mailer->wrap_message( $email_heading, $message ) ) );
		}
		else
		{
			ob_start();
			include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'wrap.php' ) ) );
			$message = ob_get_clean();
		}

		return $message;
	}

	public static function send_new_site_notification( $email, $site_name, $site_url )
	{
		$mail_heading = __( 'Site created', self::TEXT_DOMAIN );
		// TODO: send admin url
		$mail_message = sprintf(
			__( 'Your site %s (%s) has been created successfully. \n\nNow you can configure it. Just go to "My Account" to log in and a new link "Settings" will appear. Here you can manage the site style and the sport data.', self::TEXT_DOMAIN ),
			$site_name,
			sprintf( '<a href="%s">%s</a>', $site_url, $site_url )
		);

		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		//$to = self::get_notification_addresses();
		$to = $email;

		wp_mail(
			$to,
			__( 'Site created', self::TEXT_DOMAIN ),
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_new_user_notification( $blog_id, $user )
	{
		$mail_heading = __( 'New user registered', self::TEXT_DOMAIN );

		$trainers = get_users( array(
			'blog_id' => $blog_id,
			'role' => self::TRAINER_ROLE
		) );
		if( empty( $trainers ) )
			return false;

		$trainer = current( $trainers );

		$blog_details = get_blog_details( $blog_id );
		$site_name = $blog_details->blogname;
		$site_url = get_site_url( $blog_id );

		$mail_message = sprintf(
			__( 'A new user ( %s - %s ) has been registered in your site %s (%s)', self::TEXT_DOMAIN ),
			$user->display_name,
			$user->user_email,
			$site_name,
			sprintf( '<a href="%s">%s</a>', $site_url, $site_url )
		);

		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		//$to = self::get_notification_addresses();
		$to = $trainer->user_email;

		return wp_mail(
			$to,
			__( 'New user registered', self::TEXT_DOMAIN ),
			$mail_message,
			self::get_mail_headers()
		);
	}

	///////////////////////////////////////
	// USERS
	///////////////////////////////////////

	public static function is_site_trainer( $user_id = null, $blog_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		if( !$user_id )
			return false;

		if( $blog_id === null )
			$blog_id = get_current_blog_id();

		return
			is_user_member_of_blog( $user_id, $blog_id ) &&
			( $user = get_user_by( 'ID', $user_id ) ) &&
			in_array( self::TRAINER_ROLE, (array)$user->roles );
			
	}

	public static function is_site_client( $user_id = null, $blog_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		if( !$user_id )
			return false;

		if( $blog_id === null )
			$blog_id = get_current_blog_id();

		return
			is_user_member_of_blog( $user_id, $blog_id ) &&
			( $user = get_user_by( 'ID', $user_id ) ) &&
			in_array( self::SPORTSMAN_ROLE, (array)$user->roles );
			
	}

	///////////////////////////////////////
	// UTILS
	///////////////////////////////////////

	public static function get_exercise_image( $exercise, $image_type )
	{
		if( !$exercise )
			return null;

		if( is_int( $exercise ) )
			$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise );

		$image_id = null;
		switch( $image_type )
		{
			case 'start':
				$image_id = $exercise->image_start;
				break;
			case 'end':
				$image_id = $exercise->image_end;
				break;
			default:
		}

		if( !$exercise->trainer )
			switch_to_blog( 1 );

		$url = wp_get_attachment_url( $image_id );

		if( !$exercise->trainer )
			restore_current_blog();

		return !empty( $url ) ? $url : plugins_url( '/img/exercises.svg', __FILE__ );
	}

	public static function get_exercise_correction_image( $correction, $image_type )
	{
		if( is_int( $correction ) )
			$correction = EpointPersonalTrainerMapper::get_exercise_correction( $correction );

		if( !$correction )
			return null;

		$exercise = EpointPersonalTrainerMapper::get_exercise( $correction->exercise_id );

		if( !$exercise )
			return null;

		$image_id = null;
		switch( $image_type )
		{
			case 'image_well':
				$image_id = $correction->image_well;
				break;
			case 'image_bad':
				$image_id = $correction->image_bad;
				break;
			default:
		}

		if( !$exercise->trainer )
			switch_to_blog( 1 );

		$url = wp_get_attachment_url( $image_id );

		if( !$exercise->trainer )
			restore_current_blog();

		return !empty( $url ) ? $url : plugins_url( '/img/exercises.svg', __FILE__ );
	}

	public static function get_video_iframe_from_link( $link )
	{
		$matches = array();
		if( preg_match( '/^https:\/\/youtu\.be\/(.*)$/', $link, $matches ) )
		{
			$video_id = $matches[1];

			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		elseif( preg_match( '/^https:\/\/vimeo\.com\/(.*)$/', $link, $matches ) )
		{
			$video_id = $matches[1];

			return '<iframe src="https://player.vimeo.com/video/' . $video_id . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
		}
		else
		{
			return esc_html( $link );
		}
	}

	public static function get_training_exercises_categorized( $training_id )
	{
		$exercises_data = EpointPersonalTrainerMapper::get_training_exercises( $training_id );
		$categories = array();
		foreach( $exercises_data as $e )
		{
			$cats = EpointPersonalTrainerMapper::get_exercise_related_categories( $e->ID, true );
			foreach( $cats as $c )
			{
				if( !array_key_exists( $c, $categories ) )
				{
					$cat = EpointPersonalTrainerMapper::get_exercise_category( $c );
					$categories[$c] = array(
						'name' => $cat->name,
						'exercises' => array()
					);
				}

				if( !in_array( $e->ID, $categories[$c] ) )
				{
					$exercise_id = (int)$e->ID;
					$categories[$c]['exercises'][$exercise_id] = array(
						'exercise' => EpointPersonalTrainerMapper::get_exercise( $exercise_id ),
						'current' => EpointPersonalTrainerMapper::get_training_exercise_data( $training_id, $exercise_id ),
						'historial' => EpointPersonalTrainerMapper::get_training_exercises_historial( $training_id, $exercise_id )
					);
					break;
				}
			}
		}

		return $categories;
	}

	///////////////////////////////////////
	// DATE AND TIME
	///////////////////////////////////////

	public static function get_public_datetime_format()
	{
		return __( "Y/m/d H:i:s", self::TEXT_DOMAIN );
	}
}

EpointPersonalTrainer::initialize();

}
