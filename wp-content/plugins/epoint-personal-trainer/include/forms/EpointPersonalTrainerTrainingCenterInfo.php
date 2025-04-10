<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerTrainingCenterInfoForm' ) )
{

EpointPersonalTrainer::load_trainer_info_management();

class JLCEpointPersonalTrainerTrainingCenterInfoForm extends JLCCustomForm
{
	protected $success_page_id;

	public function __construct( $internal_id, $args )
	{
		$text_domain = isset( $args['text_domain'] ) ? $args['text_domain'] : null;
		$this->success_page_id = isset( $args['success_page_id'] ) ? $args['success_page_id'] : null;


		parent::__construct(
			__DIR__,
			$internal_id,
			$text_domain,
			'epoint_personal_trainer_trainer_info',
			false,//ajax
			true,//wordpress_method
			$this->get_current_url(),
			true
		);

		$personal_info = new EpointPersonalTrainerTrainerInfo( get_current_user_id() );
		$personal_info_attr = $personal_info->get_attributes();

		//$this->add_honeypot();


		$this->add_ajax_upload_image_cropper_field(
			'public_photo',
			array(
				'value' => isset( $personal_info_attr['public_photo'] ) ? (int)$personal_info_attr['public_photo'] : '',
				'label' => __( 'Logo o foto del centro', $this->get_text_domain() ),
				'required' => false,
				'help' => __( 'Esta foto se utilizará para promocionar tu sitio en nuestro sitio principal. Es recomendable utilizar una foto con el fondo transparente. Utilice archivos jpg, o .png (Máx: 15MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 30 * 524288
			)
		);



		$this->add_text_field(
			'company_name',
			array(
				'value' => isset( $personal_info_attr['company_name'] ) ? $personal_info_attr['company_name'] : '',
				'label' => __( 'Nombre del centro', $this->get_text_domain() ),
				'maxlength' => 50,
				'required' => true
			)
		);

		$this->add_number_field(
			'company_year',
			array(
				'value' => isset( $personal_info_attr['company_year'] ) ? $personal_info_attr['company_year'] : '',
				'label' => __( 'Año de creación', $this->get_text_domain() ),
				'min' => 1800,
				'max' => date( 'Y' ),
				'step' => 1,
				'required' => true
			)
		);

		$this->add_number_field(
			'company_workers',
			array(
				'value' => isset( $personal_info_attr['company_workers'] ) ? $personal_info_attr['company_workers'] : '',
				'label' => __( 'Número de trabajadores', $this->get_text_domain() ),
				'min' => 1,
				'max' => 2000,
				'step' => 1,
				'required' => true
			)
		);

		$province_field = $this->add_spanish_province_select(
			'province',
			array(
				'label' => __( 'Provincia', $this->get_text_domain() ),
				'multiple' => false,
				'required' => true
			)
		);
		$province = isset( $personal_info_attr['province'] ) ? $personal_info_attr['province'] : '';
		if( !empty( $province ) )
			$province_field->select_value( $province );

		$this->add_text_field(
			'company_m2',
			array(
				'value' => isset( $personal_info_attr['company_m2'] ) ? $personal_info_attr['company_m2'] : '',
				'label' => __( 'Superficie del centro', $this->get_text_domain() ),
				'help' => 'En m&sup2;',
				'maxlength' => 100,
				'required' => false
			)
		);


		$this->add_text_field(
			'company_activities',
			array(
				'value' => isset( $personal_info_attr['company_activities'] ) ? $personal_info_attr['company_activities'] : '',
				'label' => __( 'Actividades', $this->get_text_domain() ),
				'maxlength' => 200,
				'required' => true
			)
		);

		$this->add_text_field(
			'company_equipment',
			array(
				'value' => isset( $personal_info_attr['company_equipment'] ) ? $personal_info_attr['company_equipment'] : '',
				'label' => __( 'Equipamiento', $this->get_text_domain() ),
				'maxlength' => 200,
				'required' => true
			)
		);

		$parking_field = $this->add_select(
			'company_parking',
			array(
				'label' => __( 'Parking privado', $this->get_text_domain() ),
				'required' => true
			)
		);
		$parking_field->add_option(
			'yes',
			'Sí',
			array( 'selected' => isset( $personal_info_attr['company_parking'] ) && $personal_info_attr['company_parking'] == 'yes' )
		);
		$parking_field->add_option(
			'no',
			'No',
			array( 'selected' => isset( $personal_info_attr['company_parking'] ) && $personal_info_attr['company_parking'] != 'yes' )
		);

		$air_conditioning_field = $this->add_select(
			'company_air_conditioning',
			array(
				'label' => __( 'Aire acondicionado', $this->get_text_domain() ),
				'required' => true
			)
		);
		$air_conditioning_field->add_option(
			'yes',
			'Sí',
			array( 'selected' => isset( $personal_info_attr['company_air_conditioning'] ) && $personal_info_attr['company_air_conditioning'] == 'yes' )
		);
		$air_conditioning_field->add_option(
			'no',
			'No',
			array( 'selected' => isset( $personal_info_attr['company_air_conditioning'] ) && $personal_info_attr['company_air_conditioning'] != 'yes' )
		);

		$this->add_heading( array(
			'content' => 'Conocimientos concretos',
			'size' => 3
		) );

		$this->add_html( array(
			'content' => '<p>Valora del 1 al 10 los conocimientos que consideras que tienes en estas especialidades.</p>'
		) );


		$this->add_jquery_slider(
			'dietetics',
			array(
				'value' => !empty( $personal_info_attr['dietetics'] ) ? $personal_info_attr['dietetics'] : 1,
				'label' => __( 'Dietética', $this->get_text_domain() ),
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'required' => true
			)
		);

		$this->add_jquery_slider(
			'hypertrophy',
			array(
				'value' => !empty( $personal_info_attr['hypertrophy'] ) ? $personal_info_attr['hypertrophy'] : 1,
				'label' => __( 'Hipertrofia muscular', $this->get_text_domain() ),
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'required' => true
			)
		);

		$this->add_jquery_slider(
			'slimming',
			array(
				'value' => !empty( $personal_info_attr['slimming'] ) ? $personal_info_attr['slimming'] : 1,
				'label' => __( 'Adelgazamiento', $this->get_text_domain() ),
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'required' => true
			)
		);

		$this->add_jquery_slider(
			'examinations',
			array(
				'value' => !empty( $personal_info_attr['examinations'] ) ? $personal_info_attr['examinations'] : 1,
				'label' => __( 'Oposiciones', $this->get_text_domain() ),
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'required' => true
			)
		);

		$this->add_jquery_slider(
			'rehab',
			array(
				'value' => !empty( $personal_info_attr['rehab'] ) ? $personal_info_attr['rehab'] : 1,
				'label' => __( 'Rehabilitación', $this->get_text_domain() ),
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'required' => true
			)
		);

		$sports_group = $this->add_checkbox_group(
			'sports',
			array(
				'label' => __( '¿En que deportes estás especializado?', $this->get_text_domain() ),
				'required' => false
			)
		);
		$sports = array(
			'athletics' => 'Atletismo',
			'swimming' => 'Natación',
			'football' => 'Fútbol',
			'gymnastics' => 'Gimnasia',
			'tennis' => 'Tenis',
			'padel' => 'Padel',
			'contact' => 'De contacto',
			'golf' => 'Golf',
			'climb' => 'Escalada',
			'trekking' => 'Senderismo'
		);
		foreach( $sports as $key => $label )
			$sports_group->add_checkbox( array(
				'value' => $key,
				'label' => $label,
				'checked' => isset( $personal_info_attr['sports'] ) && is_array( $personal_info_attr['sports'] ) && in_array( $key, $personal_info_attr['sports'] )
			) );
		

		$this->add_textarea_field(
			'company_comments',
			array(
				'value' => isset( $personal_info_attr['company_comments'] ) ? $personal_info_attr['company_comments'] : '',
				'label' => __( 'Comentarios', $this->get_text_domain() ),
				'maxlength' => 3000,
				'required' => true
			)
		);

		$this->add_textarea_field(
			'company_prices',
			array(
				'value' => isset( $personal_info_attr['company_prices'] ) ? $personal_info_attr['company_prices'] : '',
				'label' => __( 'Precios', $this->get_text_domain() ),
				'maxlength' => 1000,
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
		if( !is_user_logged_in() || !is_user_member_of_blog() )
			return array( array(
				'code' => self::FATAL_ERROR,
				'text' => __( 'You are not member of this site.', $this->get_text_domain() )
			) );

		$old_info = EpointPersonalTrainer::get_user_trainer_info( get_current_user_id() );

		$has_filled = $old_info->has_filled_trainer_info();

		$user_id = get_current_user_id();
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'public_photo', $this->get_field_by_name( 'public_photo' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_name', $this->get_field_by_name( 'company_name' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_year', $this->get_field_by_name( 'company_year' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_workers', $this->get_field_by_name( 'company_workers' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'province', $this->get_field_by_name( 'province' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_m2', $this->get_field_by_name( 'company_m2' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_activities', $this->get_field_by_name( 'company_activities' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_equipment', $this->get_field_by_name( 'company_equipment' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_parking', $this->get_field_by_name( 'company_parking' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_air_conditioning', $this->get_field_by_name( 'company_air_conditioning' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_comments', stripslashes( $this->get_field_by_name( 'company_comments' )->get_value() ) );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'company_prices', $this->get_field_by_name( 'company_prices' )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'dietetics', $this->get_field_by_name( 'dietetics' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'rehab', $this->get_field_by_name( 'rehab' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'examinations', $this->get_field_by_name( 'examinations' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'slimming', $this->get_field_by_name( 'slimming' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'hypertrophy', $this->get_field_by_name( 'hypertrophy' )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'sports', $this->get_field_by_name( 'sports' )->get_value() );

		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'filled', 'yes' );


		if( $this->success_page_id )
		{
			$url = get_permalink( $this->success_page_id );
			wp_redirect( $url );
			exit;
		}
		else
		{
			if( !$has_filled )
			{
				wp_redirect( site_url() );
				exit;
			}
			return __( 'Saved successfully. Now you can use your site.', $this->get_text_domain() );
		}
	}


}

} // class_exists




