<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditExerciseForm' ) )
{

class JLCEpointPersonalTrainerEditExerciseForm extends JLCCustomForm
{
	protected $is_editable_exercise;
	protected $exercise_id;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$exercise_id = isset( $args['exercise'] ) ? $args['exercise'] : null;
		$this->exercise_id = $exercise_id;
		$exercise = $exercise_id ? EpointPersonalTrainerMapper::get_exercise( $exercise_id ) : null;
		$readonly = $exercise && ( !$exercise->trainer || $exercise->trainer != get_current_user_id() );
		$this->is_editable_exercise = !$readonly;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_exercise',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		//$this->add_honeypot();

		$this->add_hidden_field(
			'exercise',
			array(
				'value' => $exercise_id
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
				'readonly' => $readonly,
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
		

/*
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
				'help' => __( 'Pega aquí el enlace que aparece en "Compartir"', $this->get_text_domain() )
			)
		);

		$this->add_ajax_upload_image_cropper_field(
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
		//add_action( 'jlc_custom_form_upload_ajax_image_pre_upload', array( $this, 'pre_upload_image' ) );
		//add_action( 'jlc_custom_form_upload_ajax_image_post_upload', array( $this, 'post_upload_image' ) );

		$this->add_ajax_upload_image_cropper_field(
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


		$this->add_textarea_field(
			'description',
			array(
				'value' => $exercise ? $exercise->description : '',
				'label' => __( 'Description', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => false
			)
		);

/*
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
*/

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

			$this->add_submit_button(
				'saveandnew',
				array(
					'label' => __( 'Guardar y añadir nuevo', $this->get_text_domain() )
				)
			);
		}
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

			$this->enqueue_scripts();
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
		wp_enqueue_script(
			'epoint-personal-trainer-exit-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);

		wp_enqueue_script(
			'epoint-personal-trainer-exercise-edit-video-script',
			plugins_url( 'js/exercise-video.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
	}

	protected function process_form()
	{
		if( !$this->is_editable_exercise )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this exercise.', $this->get_text_domain() ) )
			);

		$exercise_id = $this->get_field_by_name( 'exercise' )->get_value();
		$exercise_id = $exercise_id && is_numeric( $exercise_id ) ? (int)$exercise_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();
		$video = $this->get_field_by_name( 'video' )->get_value();
		$start_photo = $this->get_field_by_name( 'image_start' );
		$end_photo = $this->get_field_by_name( 'image_end' );
		$description = stripslashes( $this->get_field_by_name( 'description' )->get_value() );

		$categories = $this->get_field_by_name( 'categories' )->get_value();

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
			$categories = array( $categories );

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

		if( !$exercise_id )
		{
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
				get_current_user_id()
			);

			if( !$exercise_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The exercise could not be created.', $this->get_text_domain() ) )
				);

			if( $this->ajax )
			{
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array( 'name' => 'addtraining', 'args' => array( 'exercise' => $exercise_id ) ) )
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
						setCookie( EliteTrainerSiteTheme::EXERCISE_TAB_COOKIE, '#my-exercises', time() + 24*60*60*1000, '/' );
						setCookie( EliteTrainerSiteTheme::EXERCISE_LAST_DUPLICATED_COOKIE, $exercise_id, time() + 24*60*60*1000, '/' );
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
			$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );
			if( !$exercise )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The exercise can not be edited.', $this->get_text_domain() ) )
				);

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

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The exercise could not be saved.', $this->get_text_domain() ) )
				);

			if( $this->ajax )
			{
				$response = new WP_Ajax_Response( array(
					'json' => 'html',
					'action' => 'event',
					'id' => 1,
					'data' => json_encode( array( 'name' => 'updateexercise', 'args' => array( 'exercise' => $exercise_id ) ) )
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
						setCookie( EliteTrainerSiteTheme::EXERCISE_TAB_COOKIE, '#my-exercises', time() + 24*60*60*1000, '/' );
						setCookie( EliteTrainerSiteTheme::EXERCISE_LAST_DUPLICATED_COOKIE, $exercise->ID, time() + 24*60*60*1000, '/' );
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
