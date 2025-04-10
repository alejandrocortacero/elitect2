<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditExerciseCategoryForm' ) )
{

class JLCEpointPersonalTrainerEditExerciseCategoryForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$category_id = isset( $args['category'] ) ? $args['category'] : null;
		$category = $category_id ? EpointPersonalTrainerMapper::get_exercise_category( $category_id ) : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_exercise_category',
			true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		//$this->add_honeypot();
		$this->add_hidden_field(
			'category',
			array(
				'value' => $category ? $category->ID : ''
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $category ? $category->name : '',
				'label' => __( 'Name', $this->get_text_domain() ),
				'maxlength' => 100,
				'required' => true
			)
		);

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);

	}

	protected function process_form()
	{
		$cat_id = (int)$this->get_field_by_name( 'category' )->get_value();
		$name = $this->get_field_by_name( 'name' )->get_value();

		if( empty( $cat_id ) || !( $category = EpointPersonalTrainerMapper::get_exercise_category( $cat_id ) ) )
			return array(
				array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'Category does not exists.', $this->get_text_domain() ) )
			);

		if( $name != $category->name )
		{
			if( !EpointPersonalTrainerMapper::is_valid_name_for_new_exercise_category( $name, get_current_user_id() ) )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'Another category is using this name.', $this->get_text_domain() ) )
				);
		}

		$res = EpointPersonalTrainerMapper::update_exercise_category( $cat_id, $name, 1, true );

		if( $res !== false )
		{
			setCookie( 'exercises_gallery_message', 'Categoría actualizada satisfactoriamente', time() + 24*60*60*1000, '/' );
			$response = new WP_Ajax_Response( array(
				'what' => 'json',
				'action' => 'redirect',
				'id' => 1,
				'data' => json_encode( array( 'url' => $_POST['return_url'] ) )
			) );
			$response->send();
		}
		else
		{
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'There was an error creating the category.', $this->get_text_domain() ) )
			);
		}

	}


}

} // class_exists


