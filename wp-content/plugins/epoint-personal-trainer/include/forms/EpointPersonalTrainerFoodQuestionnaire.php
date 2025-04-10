<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerFoodQuestionnaireForm' ) )
{

class JLCEpointPersonalTrainerFoodQuestionnaireForm extends JLCCustomForm
{

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$member_id = isset( $args['member'] ) ? (int)$args['member'] : get_current_user_id();

		if( !empty( $_POST['member'] ) )
			$member_id = (int)$_POST['member'];

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_food_questionnaire',
			false,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		$this->class = 'food-questionnaire-form';

		$this->add_hidden_field(
			'member',
			array(
				'value' => $member_id,
				'required' => true
			)
		);

		//$this->add_honeypot();

		$cats = EpointPersonalTrainerMapper::get_food_items_grouped_by_category( null, $member_id, get_current_blog_id() );

		$total_food = 0;
		foreach( $cats as $cat )
		{
			$total_food += (count( $cat->food ) + 1);// +1 para el titulo de la categoria
		}

		$rows_per_col = $total_food % 3 != 0 ? (int)($total_food / 3) : (int)($total_food / 4 );

		$info = get_user_meta( $member_id, 'personal_trainer_food_questionnaire', true );

		$this->add_html( array(
			'content' => '<div class="form-inner-layer">',
			'html_wrapped' => false
		) );

		$i = 0;
		$j = 0;
		foreach( $cats as $cat )
		{
			$this->print_col( $i, $j, $rows_per_col, $total_food );

			$this->add_html( array(
				'content' => '<div class="cat-title">' . $cat->name . '</div>',
				'html_wrapped' => false
			) );

			$i++;

			$j = (int)($i / $rows_per_col) + 1;

			$this->print_col( $i, $j, $rows_per_col, $total_food );

			foreach( $cat->food as $f )
			{
				$this->print_col( $i, $j, $rows_per_col, $total_food );

				$this->add_html( array(
					'content' => '<div class="food-row"><span>' . $f->name . '</span>',
					'html_wrapped' => false
				) );

				$select_field = $this->add_select(
					'food_' . $f->ID . '_frequent',
					array(
						'required' => true,
					)
				);
				$select_field->add_option(
					'yes',
					'Sí',
					array(
						'selected' => isset( $info[$f->ID]['frequent'] ) && $info[$f->ID]['frequent'] == 'yes'
					)
				);
				$select_field->add_option(
					'no',
					'No',
					array(
						'selected' => isset( $info[$f->ID]['frequent'] ) && $info[$f->ID]['frequent'] != 'yes'
					)
				);

				$select_field = $this->add_select(
					'food_' . $f->ID . '_valuation',
					array(
						'required' => false,
					)
				);
				for( $k = 1; $k <= 10; $k++ )
					$select_field->add_option(
						$k,
						$k,
						array(
							'selected' => isset( $info[$f->ID]['valuation'] ) && $info[$f->ID]['valuation'] == $k
						)
					);
				
				
				$this->add_html( array(
					'content' => '</div>',
					'html_wrapped' => false
				) );

				$i++;

			}
		}

		$this->print_col( $i, $j, $rows_per_col, $total_food );

		$this->add_html( array(
			'content' => '</div>',
			'html_wrapped' => false
		) );

		$this->add_submit_button(
			'send',
			array(
				'label' => __( 'Save', $this->get_text_domain() )
			)
		);
	}

	protected function print_col( $i, $j, $rows_per_col, $total_items )
	{
		if( $i >= $total_items )
		{
			$this->add_html( array(
				'content' => '</div>',
				'html_wrapped' => false
			) );
		}
		elseif( $i % $rows_per_col == 0 )
		{
			if( $j == 0 )
			{
/*
				$this->add_html( array(
					'content' => '<p data-i="' . $i . '" data-j="' . $j .'" data-r="' . $rows_per_col . '">START</p>',
					'html_wrapped' => false
				) );
*/
				
				$this->add_html( array(
					'content' => '<div class="column" data-i="' . $i . '" data-j="' . $j .'" data-r="' . $rows_per_col . '">',
					'html_wrapped' => false
				) );
			}
			else
			{
				$this->add_html( array(
					'content' => '</div><div class="column" data-i="' . $i . '" data-j="' . $j .'" data-r="' . $rows_per_col . '">',
					'html_wrapped' => false
				) );
/*
				$this->add_html( array(
					'content' => '</div>',
					'html_wrapped' => false
				) );

				$this->add_html( array(
					'content' => '<p data-i="' . $i . '" data-j="' . $j .'" data-r="' . $rows_per_col . '">END</p>',
					'html_wrapped' => false
				) );
				$this->add_html( array(
					'content' => '<p data-i="' . $i . '" data-j="' . $j .'" data-r="' . $rows_per_col . '">START</p>',
					'html_wrapped' => false
				) );

				$this->add_html( array(
					'content' => '<div class="column" data-i="' . $i . '" data-j="' . $j .'" data-r="' . $rows_per_col . '">',
					'html_wrapped' => false
				) );
*/
			}
		}
	}

	protected function enqueue_scripts()
	{
/*
		wp_enqueue_script(
			'epoint-personal-trainer-select2-script',
			plugins_url( 'select2/js/select2.min.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
		wp_enqueue_style(
			'epoint-personal-trainer-select2-style',
			plugins_url( 'select2/css/select2.min.css', __FILE__ )
		);

		wp_enqueue_script(
			'epoint-personal-trainer-diet-intervals-script',
			plugins_url( 'js/diet-intervals.js', __FILE__ ),
			array( 'jquery', 'epoint-personal-trainer-select2-script' ),
			EpointPersonalTrainer::VERSION,
			true
		);
*/
		wp_enqueue_script(
			'epoint-personal-trainer-exit-script',
			plugins_url( 'js/exit.js', __FILE__ ),
			array( 'jquery' ),
			EpointPersonalTrainer::VERSION,
			true
		);
	}

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();

//		add_action( 'wp_footer', array( $this, 'print_exercise_selector' ) );
	}

	protected function process_form()
	{
		$member_id = (int)($this->get_field_by_name( 'member' )->get_value());

		$cats = EpointPersonalTrainerMapper::get_food_items_grouped_by_category( null, $member_id, get_current_blog_id() );

		$info = array();
		foreach( $cats as $cat )
		{
			foreach( $cat->food as $f )
			{
				if( !$this->get_field_by_name( 'food_' . $f->ID . '_frequent' ) ||
					!$this->get_field_by_name( 'food_' . $f->ID . '_valuation' ) )
				{
					return array(
						array( 'code' => self::FATAL_ERROR, 'text' => __( 'Invalid food data.', $this->get_text_domain() ) )
					);
				}

				$info[$f->ID] = array(
					'frequent' => $this->get_field_by_name( 'food_' . $f->ID . '_frequent' )->get_value(),
					'valuation' => $this->get_field_by_name( 'food_' . $f->ID . '_valuation' )->get_value()
				);
			}
		}

		update_user_meta( $member_id, 'personal_trainer_food_questionnaire', $info );
		update_user_meta( $member_id, 'personal_trainer_food_questionnaire_date', date( 'Y-m-d h:i:s' ) );

		return 'Hábitos actualizados satisfactoriamente.';

	}


}

} // class_exists



