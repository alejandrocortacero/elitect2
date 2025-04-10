<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class EpointPersonalTrainerPublic
{
	// ACTIONS 
	const GET_TRAINING_EXERCISES_ACTION = 'epoint_personal_trainer_get_training_exercises';

	const GET_CLONE_EXERCISE_AND_ASSING_FORM_ACTION = 'epoint_personal_trainer_get_clone_exercise_and_assign_form';

	const CLEAR_EXERCISE_HISTORIAL_ACTION = 'epoint_personal_trainer_clear_exercise_historial';
	const DELETE_EXERCISE_HISTORIAL_ELEMENT_ACTION = 'epoint_personal_trainer_delete_exercise_historial_element';

	const DELETE_MEMBER_ACTION = 'epoint_personal_trainer_delete_member';
	const DEACTIVATE_MEMBER_ACTION = 'epoint_personal_trainer_deactivate_member';
	const REACTIVATE_MEMBER_ACTION = 'epoint_personal_trainer_reactivate_member';

	protected static $base_dir;

	public static function initialize()
	{
		self::$base_dir = realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' );

		add_shortcode( 'epoint_personal_trainer_register_trainer', array( get_class(), 'get_register_trainer_form' ) );
		add_shortcode( 'epoint_personal_trainer_already_trainer', array( get_class(), 'get_already_trainer_form' ) );
		add_shortcode( 'epoint_personal_trainer_client_already_trainer', array( get_class(), 'get_client_already_trainer_form' ) );
		add_shortcode( 'epoint_personal_trainer_client_search_trainer', array( get_class(), 'get_search_trainer_form' ) );

		add_action( 'wp_ajax_' . self::GET_TRAINING_EXERCISES_ACTION, array( get_class(), 'get_training_exercises_html' ) );

		add_action( 'wp_ajax_' . self::GET_CLONE_EXERCISE_AND_ASSING_FORM_ACTION, array( get_class(), 'get_clone_exercise_and_assign_form' ) );

		add_action( 'wp_ajax_' . self::CLEAR_EXERCISE_HISTORIAL_ACTION, array( get_class(), 'clear_exercise_historial' ) );
		add_action( 'wp_ajax_' . self::DELETE_EXERCISE_HISTORIAL_ELEMENT_ACTION, array( get_class(), 'delete_exercise_historial_element' ) );

		add_action( 'wp_ajax_' . self::DELETE_MEMBER_ACTION, array( get_class(), 'delete_member' ) );
		add_action( 'wp_ajax_' . self::DEACTIVATE_MEMBER_ACTION, array( get_class(), 'deactivate_member' ) );
		add_action( 'wp_ajax_' . self::REACTIVATE_MEMBER_ACTION, array( get_class(), 'reactivate_member' ) );
	}

	/////////////////////////////
	// FORMS
	/////////////////////////////

	public static function get_register_trainer_form()
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::REGISTER_TRAINER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_already_trainer_form()
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::ALREADY_TRAINER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_client_already_trainer_form()
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::ALREADY_TRAINER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_search_trainer_form()
	{
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::SEARCH_TRAINER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}


	public static function get_register_user_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::REGISTER_USER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_personal_questionnaire_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::PERSONAL_QUESTIONNAIRE_FORM_INTERNAL_ID;


		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_trainer_info_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::TRAINER_INFO_FORM_INTERNAL_ID;


		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_training_center_info_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::TRAINING_CENTER_FORM_INTERNAL_ID;


		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_member_form( $user_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_MEMBER_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['user_id'] = $user_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_member_full_form( $user_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_MEMBER_FULL_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['user_id'] = $user_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_members_filter_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::MEMBERS_FILTER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_delete_members_filter_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::DELETE_MEMBERS_FILTER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_exercise_form( $exercise_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_EXERCISE_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['exercise'] = $exercise_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_add_exercise_category_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::ADD_EXERCISE_CATEGORY_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_exercise_category_form( $cat_id )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_EXERCISE_CATEGORY_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['category'] = $cat_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_training_form( $training_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_TRAINING_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['training'] = $training_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_objective_form( $objective_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_OBJECTIVE_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['objective'] = $objective_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_environment_form( $environment_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_ENVIRONMENT_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['environment'] = $environment_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_loads_form( $training_id, $exercise_id )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::LOADS_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		$form->set_training_and_exercise( $training_id, $exercise_id );

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_food_form( $food_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_FOOD_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['food'] = $food_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_add_food_category_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::ADD_FOOD_CATEGORY_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_add_food_category_form_object()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::ADD_FOOD_CATEGORY_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		return $form;
	}

	public static function get_edit_food_category_form( $cat_id )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_FOOD_CATEGORY_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['category'] = $cat_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_food_category_form_object( $cat_id )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_FOOD_CATEGORY_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['category'] = $cat_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		return $form;
	}

	public static function get_edit_diet_objective_form( $objective_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_DIET_OBJECTIVE_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['objective'] = $objective_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_diet_restriction_form( $restriction_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_DIET_RESTRICTION_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['restriction'] = $restriction_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	protected static function create_attachment( $filename )
	{
		if( empty( $filename ) || !is_string( $filename ) || !is_readable( $filename ) )
			return null;
			
		$filetype = wp_check_filetype( basename( $filename ), null );
 
		$wp_upload_dir = wp_upload_dir();

		$extra = '';
		do
		{
			$new_filename = $wp_upload_dir['path'] . DIRECTORY_SEPARATOR . $extra . basename( $filename );
			if( !is_int( $extra ) )
				$extra = 0;

			$extra++;
		} while( file_exists( $new_filename ) );

		copy( $filename, $new_filename );
 
		// Prepare an array of post data for the attachment.
		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename( $new_filename ), 
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $new_filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);
		 
		// Insert the attachment.
		$attach_id = wp_insert_attachment( $attachment, $new_filename );
		if( !$attach_id )
			return null;
 
		// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		 
		// Generate the metadata for the attachment, and update the database record.
		$attach_data = wp_generate_attachment_metadata( $attach_id, $new_filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return $attach_id;
	}

	public static function get_clone_exercise_and_assign_form()
	{
		$exercise_id = !empty( $_REQUEST['exercise'] ) ? (int)$_REQUEST['exercise'] : null;
		$member_id = !empty( $_REQUEST['member'] ) ? (int)$_REQUEST['member'] : null;

		if( !$exercise_id )
		{
			echo 'ERROR: no exercise found';
			exit;
		}

		if( !empty( $_REQUEST['preclone'] ) && $_REQUEST['preclone'] == 'yes' )
		{
			$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );
			if( empty( $exercise ) )
			{
				echo 'ERROR: no exercise found';
				exit;
			}

			$start_photo_id = $exercise->image_start;
			$end_photo_id = $exercise->image_end;

			if( !$exercise->trainer && ( $start_photo_id || $end_photo_id ) )
			{
				switch_to_blog( 1 );

				$start_filename = $start_photo_id ? get_attached_file( $start_photo_id ) : null;
				$end_filename = $end_photo_id ? get_attached_file( $end_photo_id ) : null;

				restore_current_blog();

				if( $start_filename )
					$start_photo_id = self::create_attachment( $start_filename );

				if( $end_filename )
					$end_photo_id = self::create_attachment( $end_filename );

			}

			$exercise_id = EpointPersonalTrainerMapper::create_exercise(
				$exercise->name,
				1,//position
				1,//active
				$exercise->description,
				$exercise->video,
				!empty( $start_photo_id ) ? $start_photo_id : null,
				!empty( $end_photo_id ) ? $end_photo_id : null,
				EpointPersonalTrainerMapper::get_exercise_related_categories( $exercise_id, true ),
				array(),//corrections
				get_current_user_id(),
				$exercise->user
			);
		}
		
		$forms = EpointPersonalTrainer::get_forms();
		$form_id = EpointPersonalTrainer::CLONE_EXERCISE_AND_ASSING_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['exercise'] = $exercise_id;
		$forms[$form_id]['args']['member'] = $member_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		echo ob_get_clean();
		exit;
	}

	public static function get_edit_diet_form( $diet_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_DIET_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['diet'] = $diet_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_create_user_diet_form( $member_id, $print = true )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::CREATE_USER_DIET_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['member'] = $member_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		if( $print )
		{
			ob_start();
			$form->print_public_form();
			return ob_get_clean();
		}
		else
		{
			return $form;
		}
	}

	public static function get_food_questionnaire_form( $member_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::FOOD_QUESTIONNAIRE_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['member'] = $member_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_add_user_food_form( $member_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::ADD_USER_FOOD_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['member'] = $member_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_user_habits_form( $member_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::USER_HABITS_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['member'] = $member_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_edit_evolution_magnitude_form( $magnitude_id = null, $type = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::EDIT_EVOLUTION_MAGNITUDE_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['magnitude'] = $magnitude_id;
		$forms[$form_id]['args']['type'] = $type;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_member_corporal_measures_form( $member_id, $trainer_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::MEMBER_CORPORAL_MEASURES_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['member'] = $member_id;
		if( $trainer_id )
			$forms[$form_id]['args']['trainer'] = $trainer_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_member_physical_test_form( $member_id, $type, $trainer_id = null )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		switch( $type )
		{
			case 'strength':
				$form_id = EpointPersonalTrainer::MEMBER_PHYSICAL_TEST_STRENGTH_FORM_INTERNAL_ID;
				break;
			case 'speed':
				$form_id = EpointPersonalTrainer::MEMBER_PHYSICAL_TEST_SPEED_FORM_INTERNAL_ID;
				break;
			case 'distance':
				$form_id = EpointPersonalTrainer::MEMBER_PHYSICAL_TEST_DISTANCE_FORM_INTERNAL_ID;
				break;
			default:
				return null;
		}

		$forms[$form_id]['args']['member'] = $member_id;
		$forms[$form_id]['args']['type'] = $type;
		if( $trainer_id )
			$forms[$form_id]['args']['trainer'] = $trainer_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_member_evolution_photos_form( $member_id )
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::MEMBER_EVOLUTION_PHOTOS_FORM_INTERNAL_ID;

		$forms[$form_id]['args']['member'] = $member_id;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_trainer_valoration_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::TRAINER_VALORATION_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}
	
	/////////////////////////////////
	// ACTIONS
	/////////////////////////////////

	public static function get_training_exercises_html()
	{
		$exercises_input = $_POST['exercises'];
		if( is_array( $exercises_input ) )
		{
			$exercises = array();
			foreach( $exercises_input as $inp )
			{
				$exercise = EpointPersonalTrainerMapper::get_exercise( (int)$inp['exercise'] );
				if( $exercise )
				{
					$e = new stdClass();
					$e->ID = (int)$inp['exercise'];
					$e->name = $exercise->name;
					$e->position = $inp['position'];
					$e->series = $inp['series'];
					$e->repetitions = $inp['repetitions'];
					$e->loads = $inp['loads'];
					$e->extradescription = $inp['description'];

					$exercises[] = $e;
				}
			}
			usort( $exercises, function( $a, $b ){
				return (int)($a->position) - (int)($b->position );
			});

			$categories = array();
			foreach( $exercises as $e )
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
						$categories[$c]['exercises'][] = $e->ID;
						break;
					}
				}

			}


			$exercises_data = $exercises;
			include( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms', 'templates', 'training-exercise-list-content.php' ) ) );
/*
			foreach( $categories as $cat_id => $cat_info )
			{
				echo '<p>' . esc_html( $cat_info['name'] ) . '</p>';
				foreach( $exercises as $e )
					if( in_array( $e->ID, $cat_info['exercises'] ) )
						include( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms', 'templates', 'training-exercise-inputs.php' ) ) );
			}
*/
		}


		exit;
	}

	public static function clear_exercise_historial()
	{
		$training_id = !empty( $_POST['training'] ) ? (int)$_POST['training'] : null;
		$exercise_id = !empty( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;

		if( !$training_id || !$exercise_id )
			exit;

		$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );
		$training = EpointPersonalTrainerMapper::get_training( $training_id );

		if( !$exercise || !$training || $training->trainer != get_current_user_id() )
			exit;

		$res = EpointPersonalTrainerMapper::clear_training_exercises_historial( $training_id, $exercise_id );

		echo 'deleted';

		exit;
	}

	public static function delete_exercise_historial_element()
	{
		$training_id = !empty( $_POST['training'] ) ? (int)$_POST['training'] : null;
		$exercise_id = !empty( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;
		$saved = !empty( $_POST['saved'] ) ? sanitize_text_field( $_POST['saved'] ) : null;

		if( !$training_id || !$exercise_id )
			exit;

		$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );
		$training = EpointPersonalTrainerMapper::get_training( $training_id );

		if( !$exercise || !$training || $training->trainer != get_current_user_id() )
			exit;

		$res = EpointPersonalTrainerMapper::delete_training_exercises_historial_element( $training_id, $exercise_id, $saved );

		echo 'deleted';

		exit;
	}

	public static function delete_member()
	{
		$member_id = !empty( $_POST['member'] ) ? sanitize_text_field( $_POST['member'] ) : null;

		if( !$member_id )
			exit;

		$member = get_user_by( 'ID', $member_id );

		if( !$member )
			exit;

		wp_delete_user( $member_id );

		echo 'deleted';

		exit;
	}

	public static function deactivate_member()
	{
		$member_id = !empty( $_POST['member'] ) ? sanitize_text_field( $_POST['member'] ) : null;

		if( !$member_id )
			exit;

		$member = get_user_by( 'ID', $member_id );

		if( !$member )
			exit;

		//wp_delete_user( $member_id );
		update_user_meta( $member_id, 'is_deactivated', 'yes' );

		echo 'deactivated';

		exit;
	}

	public static function reactivate_member()
	{
		$member_id = !empty( $_POST['member'] ) ? sanitize_text_field( $_POST['member'] ) : null;

		if( !$member_id )
			exit;

		$member = get_user_by( 'ID', $member_id );

		if( !$member )
			exit;

		//wp_delete_user( $member_id );
		update_user_meta( $member_id, 'is_deactivated', 'no' );

		echo 'reactivated';

		exit;
	}
}

