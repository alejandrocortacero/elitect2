<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerSearchTrainerForm' ) )
{

class JLCEpointPersonalTrainerSearchTrainerForm extends JLCCustomForm
{

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_search_trainer',
			false,
			true,//wordpress_method
			self::get_current_url(),
			false
		);

		//$user = is_user_logged_in() ? wp_get_current_user() : null;

		$this->add_honeypot();

		//$this->add_heading( array( 'content' => __( 'Personal data', $this->get_text_domain() ), 'size' => 3 ) );

		$this->add_text_field(
			'name',
			array(
				'value' => '',
				'label' => __( 'Nombre', $this->get_text_domain() ),
				'required' => true
			)
		);

		$this->add_submit_button(
			'send',
			array(
				'class' => 'btn btn-primary',
				'label' => 'Ir al espacio web'
			)
		);
	}

	public function process_form()
	{
		$name = $this->get_field_by_name( 'name' )->get_value();

		$sites = get_sites();
		if( empty( $sites ) )
		{
			return false;
		}

		foreach( $sites as $site )
		{
			$details = get_blog_details( $site->blog_id );
			$sitename = $details->blogname;

			if( mb_strtolower( $sitename ) == mb_strtolower( $name ) )
			{
				wp_redirect( get_site_url( $site->blog_id ) );
				exit;
			}
		}

		return array( array(
			'code' => self::FORM_DATA_ERROR,
			'text' => __( 'No se encontro el sitio indicado.', $this->get_text_domain() )
		) );

	}


}

} // class_exists


