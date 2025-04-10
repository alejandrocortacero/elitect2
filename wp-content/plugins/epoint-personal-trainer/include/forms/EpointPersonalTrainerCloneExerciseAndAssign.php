<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerCloneExerciseAndAssignForm' ) )
{

class JLCEpointPersonalTrainerCloneExerciseAndAssignForm extends JLCCustomForm
{
	protected $exercise;

	protected $with_cropper;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$exercise_id = isset( $args['exercise'] ) ? $args['exercise'] : null;
		$member_id = isset( $args['member'] ) ? $args['member'] : null;
		$this->exercise_id = $exercise_id;
		$exercise = $exercise_id ? EpointPersonalTrainerMapper::get_exercise( $exercise_id ) : null;
		$readonly = false;//$exercise && ( !$exercise->trainer || $exercise->trainer != get_current_user_id() );
		$this->is_editable_exercise = true;//!$readonly;

		$this->exercise = $exercise;

		$this->storable = false;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_clone_exercise_and_assign',
			true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->with_cropper = false;

		//$this->add_honeypot();

		$this->add_hidden_field(
			'exercise',
			array(
				'value' => $exercise_id
			)
		);

		$this->add_hidden_field(
			'member',
			array(
				'value' => $member_id
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $exercise ? $exercise->name : '',
				'label' => __( 'Name', $this->get_text_domain() ),
				'maxlength' => 100,
				'readonly' => $readonly,
				'required' => true
			)
		);
/*
		$this->add_number_field(
			'position',
			array(
				'value' => 0,
				'label' => __( 'Position', $this->get_text_domain() ),
				'max' => 9999999999,
				'min' => 0,
				'required' => true
			)
		);
*/

/*
		$this->add_checkbox_field(
			'active',
			array(
				'value' => 'yes',
				'label' => __( 'Active', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'checked' => $exercise && $exercise->active
			)
		);
*/

		$categories_field = $this->add_select(
			'categories',
			array(
				'label' => __( 'Categories', $this->get_text_domain() ),
				'required' => false,
				'readonly' => true,//$readonly,
				'disabled' => true,
				'multiple' => false//true
			)
		);
//EpointPersonalTrainerMapper::create_exercise_category( 'Brazos', 1, 1, get_current_user_id() );
		$ex_cats = EpointPersonalTrainerMapper::get_exercise_related_categories( $exercise_id, true );

		foreach( EpointPersonalTrainerMapper::get_available_exercise_categories( get_current_user_id() ) as $cat )
			$categories_field->add_option(
				$cat->ID,
				$cat->name,
				array(
					'selected' => in_array( $cat->ID, $ex_cats )
				)
			);
/*
		$this->add_text_field(
			'newcategories',
			array(
				'value' => '',
				'label' => __( 'New categories', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'help' => __( 'Separate category names with commas (,)', $this->get_text_domain() )
			)
		);
*/
		


		$this->add_html( array(
			'content' => '<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="' . get_template_directory_uri() . '/img/icons/vimeo.png" alt="vimeo" /></a></div><div class="personal-training-exercise-video-preview" style="margin-left:auto;margin-right:auto;width:100%;max-width:640px;"></div>'
		) );
		$this->add_text_field(
			'video',
			array(
				'value' => $exercise ? $exercise->video : '',
				'label' => __( 'Video', $this->get_text_domain() ),
				'required' => false,
				'readonly' => $readonly,
				'help' => __( 'Enter a YouTube ID', $this->get_text_domain() )
			)
		);

		add_filter( 'jlc_custom_form_upload_ajax_image_preview_size', array( $this, 'filter_exercise_preview_size' ), 10, 2 );
		add_filter( 'jlc_custom_form_upload_ajax_image_field_url', array( $this, 'filter_exercise_image_url' ), 10, 3 );
		add_filter( 'jlc_custom_form_update_ajax_image_upload_response', array( $this, 'filter_upload_response'), 10, 3 );

		$this->add_hidden_field(
			'image_start_changed',
			array(
				'value' => '0'
			)
		);
		$this->add_hidden_field(
			'image_end_changed',
			array(
				'value' => '0'
			)
		);

if( $with_cropper )
{
		$start_field = $this->add_ajax_upload_image_cropper_field(
			'image_start',
			array(
				'value' => $exercise ? $exercise->image_start : '',
				'label' => __( 'Start photo', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 12 * 524288
			)
		);
}
else
{
		$start_field = $this->add_ajax_upload_image_field(
			'image_start',
			array(
				'value' => $exercise ? $exercise->image_start : '',
				'label' => __( 'Start photo', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 12 * 524288
			)
		);
}
		$start_field->exercise = $exercise;
		//add_action( 'jlc_custom_form_upload_ajax_image_pre_upload', array( $this, 'pre_upload_image' ) );
		//add_action( 'jlc_custom_form_upload_ajax_image_post_upload', array( $this, 'post_upload_image' ) );

if( $with_cropper )
{
		$end_field = $this->add_ajax_upload_image_cropper_field(
			'image_end',
			array(
				'value' => $exercise ? $exercise->image_end : '',
				'label' => __( 'End photo', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 12 * 524288
			)
		);
}
else
{
		$end_field = $this->add_ajax_upload_image_field(
			'image_end',
			array(
				'value' => $exercise ? $exercise->image_end : '',
				'label' => __( 'End photo', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false,
				'help' => __( '.jpg, or .png files (Max: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 12 * 524288
			)
		);
}
		$end_field->exercise = $exercise;

		add_filter( 'jlc_custom_form_upload_ajax_image_field_url', function( $url, $field, $image_id ) {
			if( empty( $field->exercise ) )
				return $url;

			if( !$field->exercise->trainer && $image_id )
			{
				switch_to_blog( 1 );

				$url = get_attached_file( $image_id );

				restore_current_blog();
			}

			return $url;
		}, 10, 3 );
		add_filter( 'jlc_custom_form_upload_ajax_image_field_check_exists_url', function( $url, $field, $image_id ) {

			if( empty( $field->exercise ) )
				return $url;

			if( !$field->exercise->trainer && $image_id )
			{
				switch_to_blog( 1 );

				$url = get_attached_file( $image_id );

				restore_current_blog();
			}

			return $url;
		}, 10, 3 );


		$this->add_textarea_field(
			'description',
			array(
				'value' => $exercise ? $exercise->description : '',
				'label' => __( 'Description', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false
			)
		);

if( false ) 
{
		$this->add_hidden_field(
			'corrections',
			array(
				'value' => json_encode( $this->get_current_corrections_data( $exercise_id ) )
			)
		);

		$this->add_html( array(
			'content' => $this->get_exercise_corrections_editor( $exercise_id ),
			'kses' => false
		) );
}

/*
		$this->add_upload_field(
			'profile_photo',
			array(
				'value' => '',
				'label' => __( 'Profile photo', $this->get_text_domain() ),
				'required' => true,
				'help' => __( '.jpg, or .png files (Max: 2MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 2097152
			)
		);
*/
		if( !$readonly )
		{
			$this->add_submit_button(
				'send',
				array(
					'label' => __( 'Save', $this->get_text_domain() )
				)
			);
/*
			$this->add_submit_button(
				'saveandnew',
				array(
					'label' => __( 'Save and add new', $this->get_text_domain() )
				)
			);
*/
		}
	}

	public function filter_exercise_preview_size( $size, $field )
	{
		return 'full';
	}

	public function filter_exercise_image_url( $url, $field, $image_id )
	{
		if( $this->exercise &&
			!$this->exercise->trainer &&
			( $field === $this->get_field_by_name( 'image_start' ) ||
			  $field === $this->get_field_by_name( 'image_end' ) )
		) {
			$url = EpointPersonalTrainer::get_exercise_image( $this->exercise, $field === $this->get_field_by_name( 'image_start' ) ? 'start' : 'end' );
			//$url = EpointPersonalTrainer::get_exercise_image( $this->exercise, 'start' );
			
			return $url;
		}

		return $url;
	}

	public function filter_upload_response( $response, $field, $image_id )
	{
		if( ( $field === $this->get_field_by_name( 'image_start' ) ||
			  $field === $this->get_field_by_name( 'image_end' ) )
		) {
			$response->add( array(
				'what' => 'json',
				'action' => 'event',
				'id' => 2,
				'data' => json_encode( array( 'name' => 'cloneAndAssingFormImageChanged', 'args' => array( 'field' => $field->get_name(), 'image' => $image_id ) ) )
			) );
			
			return $response;
		}

		return $response;
	}


	protected static function get_current_corrections_data( $exercise_id )
	{
		$ret = array();
		$corrections = EpointPersonalTrainerMapper::get_exercise_corrections( $exercise_id );
		if( is_array( $corrections ) )
		{
			foreach( $corrections as $cor )
				$ret[] = array(
					'correction' => $cor->ID,
					'position' => $cor->position,
					'description' => $cor->description,
					'image_well' => $cor->image_well,
					'image_bad' => $cor->image_bad
				);
		}

		return $ret;
	}

	protected function get_exercise_corrections_editor( $exercise_id )
	{
		$corrections = EpointPersonalTrainerMapper::get_exercise_corrections( $exercise_id );

		ob_start();
		include implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-corrections-editor.php' ) );
		return ob_get_clean();
	}
/*
	public function pre_upload_image( $field )
	{
		if( is_super_admin() && ( $field === $this->get_field_by_name( 'image_start' ) || $field === $this->get_field_by_name( 'image_end' ) ) )
		{
			switch_to_blog( 1 );
		}
	}

	public function post_upload_image( $field )
	{
		if( is_super_admin() && ( $field === $this->get_field_by_name( 'image_start' ) || $field === $this->get_field_by_name( 'image_end' ) ) )
		{
			restore_current_blog();
		}
	}
*/
	public function print_public_form( $hide_messages = false )
	{
		if( $this->is_editable_exercise )
		{
			parent::print_public_form( $hide_messages );
		}
		else
		{
			if( $this->exercise_id && ( $exercise = EpointPersonalTrainerMapper::get_exercise( $this->exercise_id ) ) )
			{
				$category_names = EpointPersonalTrainerMapper::get_exercise_related_categories_names( $exercise->ID );
				$corrections = EpointPersonalTrainerMapper::get_exercise_corrections( $exercise->ID );

				$template = locate_template( 'epoint-personal-trainer/exercise-no-editable.php' );
				if( !$template )
					$template = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates/exercise-no-editable.php' ) );

				include( $template );
			}
		}
	}


	protected function enqueue_scripts()
	{
		// Script for this form is in elitetrainersitetheme/js/old-style-training-editor.js
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

	protected function process_form()
	{
		if( !$this->is_editable_exercise )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this exercise.', $this->get_text_domain() ) )
			);

		$member_id = $this->get_field_by_name( 'member' )->get_value();

		$exercise_id = $this->get_field_by_name( 'exercise' )->get_value();
		$exercise_id = $exercise_id && is_numeric( $exercise_id ) ? (int)$exercise_id : null;

		$exercise = $exercise_id ? EpointPersonalTrainerMapper::get_exercise( $exercise_id ) : null;
		if( !$exercise )
			return array(
				array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'Previous exercise does not exist.', $this->get_text_domain() ) )
			);

		$old_exercise_id = $exercise_id;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();
		$video = $this->get_field_by_name( 'video' )->get_value();
		$start_photo = $this->get_field_by_name( 'image_start' );
		$end_photo = $this->get_field_by_name( 'image_end' );
		$description = stripslashes( $this->get_field_by_name( 'description' )->get_value() );

		//$categories = $this->get_field_by_name( 'categories' )->get_value();
		$categories = EpointPersonalTrainerMapper::get_exercise_related_categories( $exercise_id, true );

/*
		$new_categories_names = $this->get_field_by_name( 'newcategories' )->get_value();
		$new_categories_names = explode( ',', $new_categories_names );

		$new_cats = array();
		foreach( $new_categories_names as $n )
		{
			$cat_name = sanitize_text_field( $n );
			if( !empty( $cat_name ) )
			{
				$new_id = EpointPersonalTrainerMapper::create_exercise_category( $cat_name, 1, true, get_current_user_id() );

				if( $new_id )
					$new_cats[] = $new_id;
			}

		}
		
		$categories = array_merge( $categories, $new_cats );
*/

		if( !is_array( $categories ) )
			$categories = !empty( $categories ) ? array( $categories ) : array();

		if( empty( $categories ) )
		{
			return array(
				array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'You must assing one category at least.', $this->get_text_domain() ) )
			);
		}
/*
		$start_photo_id = null;
		if( $start_photo->is_file_for_upload() && $start_photo->is_upload_ok() )
		{
			$start_photo_id = media_handle_upload( 'image_start', 0, array( 'post_author' => get_current_user_id() ) );
		}
*/
		$start_photo_id = $start_photo->get_value();

/*
		$end_photo_id = null;
		if( $end_photo->is_file_for_upload() && $end_photo->is_upload_ok() )
		{
			$end_photo_id = media_handle_upload( 'image_end', 0, array( 'post_author' => get_current_user_id() ) );
		}
*/
		$end_photo_id = $end_photo->get_value();


		if( !$exercise->trainer || !$exercise->user  )
		{
			if( !$exercise->trainer && ( $start_photo_id || $end_photo_id ) )
			{
				switch_to_blog( 1 );

				$start_filename = $start_photo_id && !$this->get_field_by_name( 'image_start_changed' )->get_value() ? get_attached_file( $start_photo_id ) : null;
				$end_filename = $end_photo_id && !$this->get_field_by_name( 'image_end_changed' )->get_value() ? get_attached_file( $end_photo_id ) : null;

				restore_current_blog();

				if( $start_filename )
					$start_photo_id = self::create_attachment( $start_filename );

				if( $end_filename )
					$end_photo_id = self::create_attachment( $end_filename );

			}

			$exercise_id = EpointPersonalTrainerMapper::create_exercise(
				$name,
				1,//position
				$active ? 1 : 0,
				$description,
				$video,
				!empty( $start_photo_id ) ? $start_photo_id : null,
				!empty( $end_photo_id ) ? $end_photo_id : null,
				$categories,//array(),//categories
				array(),//corrections
				get_current_user_id(),
				!empty( $member_id ) ? $member_id : null
			);

			if( !$exercise_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The exercise could not be created.', $this->get_text_domain() ) )
				);

			if( $this->ajax )
			{
				$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );

				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array(
						'name' => 'assignexercisetocategory',
						'args' => array(
							'oldExerciseId' => $old_exercise_id,
							'exerciseId' => $exercise->ID,
							'exerciseName' => $exercise->name,
							'exerciseCategory' => current( $categories )
						)
					) )
				) );
				$response->send();
			}
			else
			{
				if( class_exists( 'EliteTrainerSiteTheme', false ) )
				{
					if( isset( $_POST['saveandnew'] ) )
					{
						wp_redirect( EliteTrainerSiteTheme::get_edit_exercise_url() );
						exit;
					}
					else
					{
						wp_redirect( EliteTrainerSiteTheme::get_exercises_list_url() );
						exit;
					}
				}
				else
				{
					return 'Ejercicio creado satisfactoriamente';
				}
			}
		}
		else
		{
			$updated = EpointPersonalTrainerMapper::update_exercise(
				$exercise_id,
				$name,
				1,//position
				$active ? 1 : 0,
				$description,
				$video,
				//$start_photo->is_file_for_upload() ? $start_photo_id : $exercise->image_start,
				//$end_photo->is_file_for_upload() ? $end_photo_id : $exercise->image_end,
				$start_photo_id,
				$end_photo_id,
				$categories,//array(),//categories
				array()//corrections
			);
/*
			$exercise_id = EpointPersonalTrainerMapper::create_exercise(
				$name,
				1,//position
				$active ? 1 : 0,
				$description,
				$video,
				$start_photo_id,
				$end_photo_id,
				$categories,//array(),//categories
				array(),//corrections
				get_current_user_id(),
				$member_id
			);
*/

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The exercise could not be saved.', $this->get_text_domain() ) )
				);

			$exercise = $exercise_id ? EpointPersonalTrainerMapper::get_exercise( $exercise_id ) : null;

			if( $this->ajax )
			{
/*
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array( 'name' => 'updateexercise', 'args' => array( 'exercise' => $exercise_id ) ) )
				) );
				$response->send();
*/
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array(
						'name' => 'assignexercisetocategory',
						'args' => array(
							'oldExerciseId' => $old_exercise_id,
							'exerciseId' => $exercise->ID,
							'exerciseName' => $exercise->name,
							'exerciseCategory' => current( $categories )
						)
					) )
				) );
				$response->send();
			}
			else
			{
				if( class_exists( 'EliteTrainerSiteTheme', false ) )
				{
					if( isset( $_POST['saveandnew'] ) )
					{
						wp_redirect( EliteTrainerSiteTheme::get_edit_exercise_url() );
						exit;
					}
					else
					{
						wp_redirect( EliteTrainerSiteTheme::get_exercises_list_url() );
						exit;
					}
				}
				else
				{
					return 'Ejercicio actualizado satisfactoriamente.';
				}
			}
		}


		return __( 'There was an error.', $this->get_text_domain() );
	}


}

} // class_exists

