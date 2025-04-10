<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEditPresencialPlanForm' ) )
{

class JLCEditPresencialPlanForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_edit_presencial_plan',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->class = 'edit-presencial-plan-form';

		$this->add_honeypot();

		$this->add_hidden_field(
			'plan',
			array(
				'value' => ''
			)
		);

		$this->add_tinymce_field(
			'presencialplantitle',
			array(
				'value' => '',
				'label' => __( 'Tipo', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_number_field(
			'valoration',
			array(
				'value' => '',
				'label' => __( 'Valoración', $this->get_text_domain() ),
				'required' => true,
				'min' => 1,
				'max' => 5,
				'step' => 1
			)
		);

		$this->add_tinymce_field(
			'presencialplandesc',
			array(
				'value' => '',
				'label' => __( 'Incluye', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_tinymce_field(
			'presencialplantimes',
			array(
				'value' => '',
				'label' => __( 'Clases', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_tinymce_field(
			'presencialplanprices',
			array(
				'value' => '',
				'label' => __( 'Precios', $this->get_text_domain() ),
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

	public function print_public_form( $hide_messages = false )
	{
		parent::print_public_form( $hide_messages );
		$this->enqueue_scripts();
	}

	protected function enqueue_scripts()
	{
		wp_enqueue_script(
			'elitetrainertheme-edit-presencial-plan',
			get_template_directory_uri() . '/js/edit-presencial-plan.js',
			array(),
			'1.0.1',
			true
		);
	}

	protected function process_form()
	{
		if( !class_exists( 'EpointPresencialPlans', false ) )
			return false;

		$plan = $this->get_field_by_name( 'plan' )->get_value();

		$title = $this->get_field_by_name( 'presencialplantitle' )->get_value();
		$desc = $this->get_field_by_name( 'presencialplandesc' )->get_value();
		$prices = $this->get_field_by_name( 'presencialplanprices' )->get_value();
		$times = $this->get_field_by_name( 'presencialplantimes' )->get_value();
		$valoration = $this->get_field_by_name( 'valoration' )->get_value();

		$arr = array(
			'post_title' => strip_tags( $title ),
			'post_content' => $desc,
			'post_type' => EpointPresencialPlans::POST_TYPE,
			'post_status' => 'publish'
		);
		if( is_numeric( $plan ) )
			$arr['ID'] = $plan;

		//$c = wp_update_post( $arr, true );
		$c = wp_insert_post( $arr, true );
		if( is_wp_error( $c ) )
		{
			return array( array(
				'code' => self::FATAL_ERROR,
				'text' => __( $c->get_error_message(), $this->get_text_domain() )
			) );
		}
		
		EpointPresencialPlans::set_type( $c, $title );
		EpointPresencialPlans::set_times( $c, $times );
		EpointPresencialPlans::set_valoration( $c, $valoration );
		EpointPresencialPlans::set_prices( $c, $prices );


		return __( 'Plan guardado satisfactoriamente', $this->get_text_domain() );
	}
}

} // class_exists


