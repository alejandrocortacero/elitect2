<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerTrainerValorationForm' ) )
{

class JLCEpointPersonalTrainerTrainerValorationForm extends JLCCustomForm
{

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_trainer_valoration',
			true,//true,//ajax
			true,//wordpress_method
			self::get_current_url(),
			true
		);

		//$this->add_honeypot();

		$user_id = get_current_user_id();


		$this->add_stars_field(
			'valoration',
			array(
				'value' => get_user_meta( $user_id, 'trainer_valoration_' . get_current_blog_id(), true ),
				'label' => 'Valoración',
				'required' => true,
				'stars' => 5
			)
		);

		$this->add_textarea_field(
			'comment',
			array(
				'value' => get_user_meta( $user_id, 'trainer_valoration_comment_' . get_current_blog_id(), true ),
				'label' => 'Comentario',
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
		if( !is_user_logged_in()/* || !EpointPersonalTrainer::is_site_client()*/ )
			return array(
				array( 'code' => self::FATAL_ERROR, 'text' => __( 'There was an error.', $this->get_text_domain() ) )
			);

		$user_id = get_current_user_id();

		$valoration = $this->get_field_by_name( 'valoration' )->get_value();
		$comment = $this->get_field_by_name( 'comment' )->get_value();

		update_user_meta( $user_id, 'trainer_valoration_' . get_current_blog_id(), $valoration );
		update_user_meta( $user_id, 'trainer_valoration_comment_' . get_current_blog_id(), $comment );


		return __( 'Valoración guardada.', $this->get_text_domain() );
	}


}

} // class_exists

