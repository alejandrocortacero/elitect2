<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerAddFoodCategoryForm' ) )
{

class JLCEpointPersonalTrainerAddFoodCategoryForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_add_food_category',
			true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		//$this->add_honeypot();

		$this->add_text_field(
			'name',
			array(
				'value' => '',
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
		$name = $this->get_field_by_name( 'name' )->get_value();

		if( !EpointPersonalTrainerMapper::is_valid_name_for_new_food_category( $name, get_current_blog_id() ) )
			return array(
				array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'Category name already exists.', $this->get_text_domain() ) )
			);

		$new_id = EpointPersonalTrainerMapper::create_food_category( $name, 1, true, get_current_user_id(), get_current_blog_id() );

		if( $new_id )
		{
			$this->store_response( 'Categoría &quot;' . $name . '&quot; creada satisfactoriamente.' );

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


