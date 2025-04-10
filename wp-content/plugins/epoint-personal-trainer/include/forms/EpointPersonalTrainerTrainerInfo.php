<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCEpointPersonalTrainerTrainerInfoForm' ) )
{

EpointPersonalTrainer::load_trainer_info_management();

class JLCEpointPersonalTrainerTrainerInfoForm extends JLCCustomForm
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
				'value' => isset( $personal_info_attr['public_photo'] ) ? $personal_info_attr['public_photo'] : '',
				'label' => __( 'Tu foto', $this->get_text_domain() ),
				'required' => false,
				'help' => __( 'Esta foto se utilizará para promocionar tu sitio en nuestro sitio principal. Es recomendable utilizar una foto con el fondo transparente. Utilice archivos jpg, o .png (Máx: 6MB)', $this->get_text_domain() ), 
				'allowed_extensions' => array( 'jpg', 'jpeg', 'png' ),
				'allowed_mime_types' => array( 'image/jpeg', 'image/png' ),
				'max_size' => 12 * 524288
			)
		);


		$sex_field = $this->add_select(
			'sex',
			array(
				'label' => __( 'Sexo', $this->get_text_domain() ),
				'required' => true
			)
		);
		$sex_field->add_option(
			'v',
			'Varón',
			array( 'selected' => isset( $personal_info_attr['sex'] ) && $personal_info_attr['sex'] == 'v' )
		);
		$sex_field->add_option(
			'm',
			'Mujer',
			array( 'selected' => isset( $personal_info_attr['sex'] ) && $personal_info_attr['sex'] == 'm' )
		);
			
		$this->add_number_field(
			'age',
			array(
				'value' => isset( $personal_info_attr['age'] ) ? (int)$personal_info_attr['age'] : 18,
				'label' => __( 'Edad', $this->get_text_domain() ),
				'required' => true,
				'min' => 18,
				'max' => 120,
				'step' => 1
			)
		);

		$this->add_text_field(
			'city',
			array(
				'value' => isset( $personal_info_attr['city'] ) ? $personal_info_attr['city'] : '',
				'label' => __( 'Ciudad de residencia', $this->get_text_domain() ),
				'maxlength' => 100,
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
			'phone',
			array(
				'value' => isset( $personal_info_attr['phone'] ) ? $personal_info_attr['phone'] : '',
				'label' => __( 'Teléfono', $this->get_text_domain() ),
				'maxlength' => 20,
				'required' => true
			)
		);

			
		$this->add_number_field(
			'presential_price',
			array(
				'value' => isset( $personal_info_attr['presential_price'] ) ? (int)$personal_info_attr['presential_price'] : 20,
				'label' => __( 'Precio de la hora presencial', $this->get_text_domain() ),
				'required' => true,
				'min' => 1,
				'max' => 10000,
				'step' => 0.05
			)
		);

		$this->add_number_field(
			'online_price',
			array(
				'value' => isset( $personal_info_attr['online_price'] ) ? (int)$personal_info_attr['online_price'] : 20,
				'label' => __( 'Precio del seguimiento online', $this->get_text_domain() ),
				'required' => true,
				'min' => 1,
				'max' => 10000,
				'step' => 0.05
			)
		);

		$this->add_number_field(
			'experience_years',
			array(
				'value' => isset( $personal_info_attr['experience_years'] ) ? (int)$personal_info_attr['experience_years'] : 18,
				'label' => __( 'Años de experiencia', $this->get_text_domain() ),
				'required' => true,
				'min' => 0,
				'max' => 100,
				'step' => 1
			)
		);

		$this->add_textarea_field(
			'experience',
			array(
				'value' => isset( $personal_info_attr['experience'] ) ? $personal_info_attr['experience'] : '',
				'label' => __( 'Experiencia laboral', $this->get_text_domain() ),
				'maxlength' => 3000,
				'required' => true
			)
		);

		$this->add_textarea_field(
			'studies',
			array(
				'value' => isset( $personal_info_attr['studies'] ) ? $personal_info_attr['studies'] : '',
				'label' => __( 'Estudios', $this->get_text_domain() ),
				'maxlength' => 3000,
				'required' => true
			)
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
			'comments',
			array(
				'value' => isset( $personal_info_attr['comments'] ) ? $personal_info_attr['comments'] : '',
				'label' => __( 'Comentario personal', $this->get_text_domain() ),
				'maxlength' => 3000,
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
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'sex', $this->get_field_by_name( 'sex' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'age', $this->get_field_by_name( 'age' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'city', $this->get_field_by_name( 'city' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'province', $this->get_field_by_name( 'province' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'phone', $this->get_field_by_name( 'phone' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'presential_price', $this->get_field_by_name( 'presential_price' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'online_price', $this->get_field_by_name( 'online_price' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'experience_years', $this->get_field_by_name( 'experience_years' )->get_value() );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'experience', stripslashes( $this->get_field_by_name( 'experience' )->get_value() ) );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'studies', stripslashes( $this->get_field_by_name( 'studies' )->get_value() ) );
		update_user_meta( $user_id, EpointPersonalTrainerTrainerInfo::TRAINER_INFO_PREFIX . 'comments', stripslashes( $this->get_field_by_name( 'comments' )->get_value() ) );

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



