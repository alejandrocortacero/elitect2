<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCOnlinePlanForm' ) )
{

class JLCOnlinePlanForm extends JLCCustomForm
{
	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;

		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'elite_trainer_site_online_plan',
			true,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$this->add_honeypot();

		$this->add_checkbox_field(
			'onlineplanenabled',
			array(
				'value' => 'yes',
				'checked' => EliteTrainerSiteThemeCustomizer::is_online_plan_enabled(),
				'label' => __( 'Mostrar plan online', $this->get_text_domain() ),
				'required' => false
			)
		);

		$price_field = $this->add_number_field(
			'price',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_price(),
				'label' => __( 'Precio', $this->get_text_domain() ),
				'required' => true,
				'min' => 0
			)
		);
		$price_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_PRICE_KEY ) );

		$price_color_field = $this->add_color_field(
			'pricecolor',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_price_color(),
				'label' => __( 'Color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$price_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_PRICE_COLOR_KEY ) );

		$price_font = EliteTrainerSiteThemeCustomizer::get_online_plan_price_font_family();
		$price_font_select = $this->add_font_select(
			'pricefontfamily',
			array(
				'label' => 'Fuente del precio'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$price_font_select->add_option(
				$key,
				sprintf( "%s (%s)", EliteTrainerSiteThemeCustomizer::get_online_plan_price(), $label ),
				array( 'selected' => $key == $price_font )
			);

		$price_font_size_field = $this->add_number_field(
			'pricefontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_price_font_size(),
				'label' => __( 'Tamaño del precio', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 200
			)
		);
		$price_font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_PRICE_FONT_SIZE_KEY ) );

/*
		$desc_field = $this->add_text_field(
			'desc',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_desc(),
				'label' => __( 'Descripción', $this->get_text_domain() ),
				'required' => false
			)
		);
		$desc_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_DESC_KEY ) );

		$desc_color_field = $this->add_color_field(
			'color',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_desc_color(),
				'label' => __( 'Color', $this->get_text_domain() ),
				'required' => true
			)
		);
		$desc_color_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_DESC_COLOR_KEY ) );

		$title_font = EliteTrainerSiteThemeCustomizer::get_online_plan_desc_font_family();
		$title_font_select = $this->add_font_select(
			'fontfamily',
			array(
				'label' => 'Fuente de la descripción'
			)
		);
		foreach( EliteTrainerSiteThemeCustomizer::get_available_fonts() as $key => $label )
			$title_font_select->add_option(
				$key,
				sprintf( "%s (%s)", mb_substr( 'Descripción', 0, 20 ), $label ),
				array( 'selected' => $key == $title_font )
			);

		$font_size_field = $this->add_number_field(
			'fontsize',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_desc_font_size(),
				'label' => __( 'Tamaño de la descripción', $this->get_text_domain() ),
				'required' => true,
				'min' => 8,
				'max' => 50
			)
		);
		$font_size_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_DESC_FONT_SIZE_KEY ) );
*/
/*
		$this->add_wp_editor_field(
			'onlinefeatures',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_features(),
				'label' => __( 'Características', $this->get_text_domain() ),
				'editor_args' => array( 'quicktags' => 'visual', 'media_buttons' => true ),
				'required' => false
			)
		);
*/

/*
		$this->add_tinymce_field(
			'onlinefeatures',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_features(),
				'label' => __( 'Características', $this->get_text_domain() ),
				'required' => false
			)
		);
*/

/*
		$button_text_field = $this->add_text_field(
			'buttontext',
			array(
				'value' => EliteTrainerSiteThemeCustomizer::get_online_plan_button_text(),
				'label' => __( 'Texto del botón', $this->get_text_domain() ),
				'required' => true
			)
		);
		$button_text_field->set_datalist( EliteTrainerSiteThemeCustomizer::get_option_history( EliteTrainerSiteThemeCustomizer::PLANS_ONLINE_BUTTON_TEXT_KEY ) );
*/

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
			'elite-trainer-theme-update-online-plan',
			get_template_directory_uri() . '/js/readevents/online-plan.js',
			array( 'jquery' ),
			EliteTrainerSiteTheme::get_version(),
			true
		);
	}

	protected function process_form()
	{
		$enabled = $this->get_field_by_name( 'onlineplanenabled' )->is_checked();
//		$features = $this->get_field_by_name( 'onlinefeatures' )->get_value();
	//	$button_text = $this->get_field_by_name( 'buttontext' )->get_value();

		$price = $this->get_field_by_name( 'price' )->get_value();
		$pricecolor = $this->get_field_by_name( 'pricecolor' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_price_color( $pricecolor );

		$pricefont = $this->get_field_by_name( 'pricefontfamily' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_price_font_family( $pricefont );

		$pricesize = $this->get_field_by_name( 'pricefontsize' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_price_font_size( $pricesize );
/*
		$desc = $this->get_field_by_name( 'desc' )->get_value();
		$color = $this->get_field_by_name( 'color' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_desc_color( $color );

		$font = $this->get_field_by_name( 'fontfamily' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_desc_font_family( $font );

		$size = $this->get_field_by_name( 'fontsize' )->get_value();
		EliteTrainerSiteThemeCustomizer::set_online_plan_desc_font_size( $size );
*/

		EliteTrainerSiteThemeCustomizer::set_online_plan_enabled( $enabled ? 'yes' : 'no' );
//		EliteTrainerSiteThemeCustomizer::set_online_plan_desc( $desc );
		EliteTrainerSiteThemeCustomizer::set_online_plan_price( $price );
//		EliteTrainerSiteThemeCustomizer::set_online_plan_features( $features );
	//	EliteTrainerSiteThemeCustomizer::set_online_plan_button_text( $button_text );

		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateOnlinePlan',
				'args' => array(
//					'onlinePlanDesc' => EliteTrainerSiteThemeCustomizer::get_online_plan_desc(),
					'onlinePlanPrice' =>  EliteTrainerSiteThemeCustomizer::get_online_plan_price()
				)
			) )
		) );
		$response->add( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateStyle',
				'args' => array()
			) )
		) );
		$response->send();


//		return __( 'Settings saved successfully', $this->get_text_domain() );
	}
}

} // class_exists
