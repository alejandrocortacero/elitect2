<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerEditFoodForm' ) )
{

class JLCEpointPersonalTrainerEditFoodForm extends JLCCustomForm
{
	protected $is_editable_food;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$food_id = isset( $args['food'] ) ? $args['food'] : null;
		$food = $food_id ? EpointPersonalTrainerMapper::get_food( $food_id ) : null;
		//$readonly = $food && ( !$food->trainer || $food->trainer != get_current_user_id() );
		$readonly = false;
		$this->is_editable_food = !$readonly;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_edit_food',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'edit-food-form';

		//$this->add_honeypot();

		$this->add_hidden_field(
			'food',
			array(
				'value' => $food_id
			)
		);

		$this->add_text_field(
			'name',
			array(
				'value' => $food ? $food->name : '',
				'label' => __( 'Name', $this->get_text_domain() ),
				'maxlength' => 100,
				'readonly' => $readonly,
				'required' => true
			)
		);


		$food_categories = $food_id ? EpointPersonalTrainerMapper::get_food_related_categories( $food_id ) : null;
		$food_category = is_array( $food_categories ) && !empty( $food_categories ) ? current( $food_categories ) : null;
		$categories_field = $this->add_select(
			'category',
			array(
				'label' => __( 'Category', $this->get_text_domain() ),
				'readonly' => $readonly,
				'required' => true
			)
		);
		$blog_categories = EpointPersonalTrainerMapper::get_blog_food_categories( get_current_blog_id() );
		foreach( $blog_categories as $cat )
		{
			$categories_field->add_option(
				$cat->ID,
				$cat->name,
				array(
					'selected' => $food_category && $food_category->cat_food_id == $cat->ID
				)
			);
		}
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
				'checked' => $training && $training->active
			)
		);
*/

		if( !$readonly )
			$this->add_submit_button(
				'send',
				array(
					'label' => __( 'Save', $this->get_text_domain() )
				)
			);
	}

	protected function process_form()
	{
		if( !$this->is_editable_food )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'You can not edit this food.', $this->get_text_domain() ) )
			);

		$food_id = $this->get_field_by_name( 'food' )->get_value();
		$food_id = $food_id && is_numeric( $food_id ) ? (int)$food_id : null;

		$name = $this->get_field_by_name( 'name' )->get_value();
		$position = 1;//$this->get_field_by_name( 'position' )->get_value();
		$active = true;//$this->get_field_by_name( 'active' )->is_checked();

		$category = $this->get_field_by_name( 'category' )->get_value();

		if( !$food_id )
		{
			$food_id = EpointPersonalTrainerMapper::create_food(
				$name,
				$position,
				$active ? 1 : 0,
				array( (int)$category ),
				null,
				get_current_user_id()
			);

			if( !$food_id )
				return array(
					array( 'code' => self::FATAL_ERROR, 'text' => __( 'The food could not be created.', $this->get_text_domain() ) )
				);

			if( class_exists( 'EliteTrainerSiteTheme', false ) )
			{
				setCookie( EliteTrainerSiteTheme::LAST_FOOD_COOKIE, $food_id, time() + 24*60*60*1000, '/' );
				wp_redirect( EliteTrainerSiteTheme::get_food_list_url() );
				exit;
			}
			else
			{
				return 'Alimento creado satisfactoriamente';
			}
		}
		else
		{
			$food = EpointPersonalTrainerMapper::get_food( $food_id );
			if( !$food )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The food can not be edited.', $this->get_text_domain() ) )
				);

			$updated = EpointPersonalTrainerMapper::update_food(
				$food_id,
				$name,
				$position,
				$active ? 1 : 0,
				array( (int)$category )
			);

			if( $updated === false )
				return array(
					array( 'code' => self::FORM_DATA_ERROR, 'text' => __( 'The food could not be saved.', $this->get_text_domain() ) )
				);

			if( class_exists( 'EliteTrainerSiteTheme', false ) )
			{
				setCookie( EliteTrainerSiteTheme::LAST_FOOD_COOKIE, $food_id, time() + 24*60*60*1000, '/' );
				wp_redirect( EliteTrainerSiteTheme::get_food_list_url() );
				exit;
			}
			else
			{
				return 'Alimento actualizado satisfactoriamente.';
			}
		}


		return __( 'Hubo un error.', $this->get_text_domain() );
	}


}

} // class_exists


