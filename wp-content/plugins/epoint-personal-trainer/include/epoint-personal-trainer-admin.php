<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class EpointPersonalTrainerAdmin
{
	// ADMIN PAGES

	const ADMIN_PAGE_SLUG = 'epoint_personal_trainer-scoring-firm-admin-page';
	const ADMIN_SETTINGS_PAGE_SLUG = 'epoint_personal_trainer-scoring-firm-settings';
	const ADMIN_EXERCISES_PAGE_SLUG = 'epoint_personal_trainer-admin-exercises';
	const ADMIN_EXERCISE_CATEGORIES_PAGE_SLUG = 'epoint_personal_trainer-admin-exercise_categories';
	const ADMIN_TRAINING_PAGE_SLUG = 'epoint_personal_trainer-admin-training';

	const ADMIN_IMPORT_PAGE_SLUG = 'epoint_personal_trainer-import-admin-page';

	protected static $base_dir;

	protected static $exercises_table;
	protected static $exercise_categories_table;
	protected static $training_table;

	public static function initialize()
	{
		self::$base_dir = realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' );

		add_action( 'admin_menu', array( get_class(), 'register_admin_pages' ) );
		add_filter( 'set-screen-option', array( get_class(), 'set_screen' ), 10, 3 );
	}

	public static function get_import_joomla_instance()
	{
		if( !class_exists( 'EpointPersonalTrainerImportJoomlaObject' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'admin-import-joomla.php' ) ) );

		return EpointPersonalTrainerImportJoomlaObject::get_instance();
	}

	///////////////////////////////
	// ADMIN PAGES
	///////////////////////////////
	
	public static function set_screen( $status, $option, $value )
	{
		return $value;
	}

	public static function screen_option() {

/*
		if( empty( $_GET['action'] ) ||
			empty( $_GET['solicitude'] ) ||
			$_GET['action'] !== 'edit' ||
			!is_numeric( $_GET['solicitude'] )
		) {

			$option = 'per_page';
			$args   = [
				'label'   => __( 'Solicitudes', EpointPersonalTrainer::TEXT_DOMAIN ),
				'default' => 999,
				'option'  => 'solicitudes_per_page'
			];

			add_screen_option( $option, $args );
			if ( ! class_exists( 'BubbleFishSolicitudeTable' ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'solicitudes-table.php' ) ) );


			self::$solicitude_table = new BubbleFishSolicitudeTable();
		}
*/
	}

	public static function register_admin_pages()
	{
		$title = __( 'Personal Training', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_menu_page(
			$title,
			$title,
			'admin_solicitudes',
			self::ADMIN_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_page'
			),
			'dashicons-id-alt',
			40
		);
		add_action( "load-$hook", array( get_class(), 'screen_option' ) );

		$title = __( 'Exercises', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_submenu_page(
			self::ADMIN_PAGE_SLUG,
			$title,
			$title,
			'administrator',
			self::ADMIN_EXERCISES_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_exercises_page',
			)
		);
		add_action( "load-$hook", array( get_class(), 'exercises_screen_option' ) );

		$title = __( 'Exercise categories', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_submenu_page(
			self::ADMIN_PAGE_SLUG,
			$title,
			$title,
			'administrator',
			self::ADMIN_EXERCISE_CATEGORIES_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_exercise_categories_page',
			)
		);
		add_action( "load-$hook", array( get_class(), 'exercise_categories_screen_option' ) );

		$title = __( 'Training', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_submenu_page(
			self::ADMIN_PAGE_SLUG,
			$title,
			$title,
			'administrator',
			self::ADMIN_TRAINING_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_training_page',
			)
		);
		add_action( "load-$hook", array( get_class(), 'training_screen_option' ) );

		$title = __( 'Settings', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_submenu_page(
			self::ADMIN_PAGE_SLUG,
			$title,
			$title,
			'administrator',
			self::ADMIN_SETTINGS_PAGE_SLUG,
			array(
				get_class(),
				'print_settings_page',
			)
		);

		$title = __( 'Import', EpointPersonalTrainer::TEXT_DOMAIN );
		$hook = add_submenu_page(
			self::ADMIN_PAGE_SLUG,
			$title,
			$title,
			'administrator',
			self::ADMIN_IMPORT_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_import_page',
			)
		);
		add_action(
			'admin_print_styles-' . $hook,
			function(){
/*
				wp_enqueue_style(
					'epoint-personal-trainer-admin-import-style',
					plugins_url( '/css/admin-import.css', __FILE__ ),
					array(),
					EpointPersonalTrainer::VERSION
				);
*/
				wp_enqueue_script(
					'epoint-personal-trainer-admin-import-script',
					plugins_url( '/js/admin-import.js', __DIR__ ),
					array( 'jquery' ),
					EpointPersonalTrainer::VERSION,
					true
				);
			}
		);
	}

	public static function print_admin_page()
	{
	}

	public static function print_settings_page()
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::ADMIN_SETTINGS_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		include( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'templates', 'admin', 'settings.php' ) ) );
	}

	public static function print_admin_exercises_page()
	{
		if( !empty( $_GET['action'] ) &&
			!empty( $_GET['exercise'] ) &&
			$_GET['action'] === 'edit' &&
			( is_numeric( $_GET['exercise'] ) || $_GET['exercise'] == 'new' )
		) {
			$file = self::$base_dir . '/templates/admin/edit-exercise.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
				return;
			}

			$exercise = EpointPersonalTrainerMapper::get_exercise( is_numeric( $_GET['exercise'] ) ? (int)$_GET['exercise'] : null );

			include( $file );
		}
		else
		{
			$file = self::$base_dir . '/templates/admin/exercises.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
				return;
			}

			$list_table = self::$exercises_table;

			include( $file );
		}
	}

	public static function exercises_screen_option() {

		if( empty( $_GET['action'] ) ||
			empty( $_GET['exercise'] ) ||
			$_GET['action'] !== 'edit' ||
			!is_numeric( $_GET['exercise'] )
		) {

			$option = 'per_page';
			$args   = [
				'label'   => __( 'Exercise', EpointPersonalTrainer::TEXT_DOMAIN ),
				'default' => 20,
				'option'  => 'exercises_per_page'
			];

			add_screen_option( $option, $args );

			if ( ! class_exists( 'PresetExercisesTable' ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'preset-exercises-table.php' ) ) );

			self::$exercises_table = new PresetExercisesTable();
		}
	}

	public static function print_admin_exercise_categories_page()
	{
		if( !empty( $_GET['action'] ) &&
			!empty( $_GET['category'] ) &&
			$_GET['action'] === 'edit' &&
			( is_numeric( $_GET['category'] ) || $_GET['category'] == 'new' )
		) {
			$file = self::$base_dir . '/templates/admin/edit-exercise-category.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
				return;
			}

			$category = EpointPersonalTrainerMapper::get_exercise_category( is_numeric( $_GET['category'] ) ? (int)$_GET['category'] : null );

			include( $file );
		}
		else
		{
			$file = self::$base_dir . '/templates/admin/exercise-categories.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
				return;
			}

			$list_table = self::$exercise_categories_table;

			include( $file );
		}
	}

	public static function exercise_categories_screen_option() {

		if( empty( $_GET['action'] ) ||
			empty( $_GET['category'] ) ||
			$_GET['action'] !== 'edit' ||
			!is_numeric( $_GET['category'] )
		) {

			$option = 'per_page';
			$args   = [
				'label'   => __( 'Exercise category', EpointPersonalTrainer::TEXT_DOMAIN ),
				'default' => 20,
				'option'  => 'exercise_categories_per_page'
			];

			add_screen_option( $option, $args );

			if ( ! class_exists( 'PresetExerciseCategoriesTable' ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'preset-exercise-categories-table.php' ) ) );

			self::$exercise_categories_table = new PresetExerciseCategoriesTable();
		}
	}


	public static function print_admin_training_page()
	{
		if( !empty( $_GET['action'] ) &&
			!empty( $_GET['training'] ) &&
			$_GET['action'] === 'edit' &&
			( is_numeric( $_GET['training'] ) || $_GET['training'] == 'new' )
		) {
			$file = self::$base_dir . '/templates/admin/edit-training.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
				return;
			}

			$training = EpointPersonalTrainerMapper::get_training( is_numeric( $_GET['training'] ) ? (int)$_GET['training'] : null );

			include( $file );
		}
		else
		{
			$file = self::$base_dir . '/templates/admin/training-templates.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', EpointPersonalTrainer::TEXT_DOMAIN );
				return;
			}

			$list_table = self::$training_table;

			include( $file );
		}
	}

	public static function training_screen_option() {

		if( empty( $_GET['action'] ) ||
			empty( $_GET['training'] ) ||
			$_GET['action'] !== 'edit' ||
			!is_numeric( $_GET['training'] )
		) {

			$option = 'per_page';
			$args   = [
				'label'   => __( 'Training', EpointPersonalTrainer::TEXT_DOMAIN ),
				'default' => 20,
				'option'  => 'training_per_page'
			];

			add_screen_option( $option, $args );

			if ( ! class_exists( 'PresetTrainingTable' ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'preset-training-table.php' ) ) );

			self::$training_table = new PresetTrainingTable();
		}
	}

	public static function print_admin_import_page()
	{
		$instance = self::get_import_joomla_instance();
		if( $instance )
		{
			$instance->print_admin_page();
			//$exercises = $instance->get_exercises();
			//foreach( $exercises as $exercise )
			//{
				//echo var_dump( unserialize( base64_decode( $exercise->correcciones ) ) );
				//echo '<hr />';
			//}
			//$diets = $instance->get_diets();
			//foreach( $diets as $diet )
			//{
				//echo var_export( unserialize( base64_decode( $diet->indicaciones ) ), true );
				//echo '<hr />';
			//}
			//$user_habits = $instance->get_user_habits();
			//foreach( $user_habits as $habit )
			//{
				//echo var_export( unserialize( base64_decode( $habit->habitos ) ), true );
				//echo '<hr />';
			//}
			//$user_food = $instance->get_user_food();
			//foreach( $user_food as $food )
			//{
			//	echo var_export( unserialize( base64_decode( $food->habitos ) ), true );
			//	echo '<hr />';
			//}
		}
	}

	/////////////////////////////
	// FORMS
	/////////////////////////////

	public static function get_settings_form()
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::ADMIN_SETTINGS_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_admin_form();
		return ob_get_clean();
	}

	public static function get_edit_preset_exercise_form( $exercise_id = null )
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::EDIT_PRESET_EXERCISE_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['exercise'] = $exercise_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);


		ob_start();
		$form->print_admin_form();
		return ob_get_clean();
	}

	public static function get_edit_preset_training_form( $training_id = null )
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::EDIT_PRESET_TRAINING_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['training'] = $training_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);


		ob_start();
		$form->print_admin_form();
		return ob_get_clean();
	}
}
