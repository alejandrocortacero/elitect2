<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'EpointPersonalTrainerTrainerInfo', false ) )
{

class EpointPersonalTrainerTrainerInfo
{
	// USER META
	const TRAINER_INFO_PREFIX = 'epoint_personal_trainer_tinfo_';

	protected $member_id;

	public static function get_available_attributes()
	{
		return array(
			'public_photo' => __( 'Tu foto', EpointPersonalTrainer::TEXT_DOMAIN ),
			'sex' => __( 'Sexo', EpointPersonalTrainer::TEXT_DOMAIN ),
			'age' => __( 'Edad', EpointPersonalTrainer::TEXT_DOMAIN ),
			'city' => __( 'Ciudad de residencia', EpointPersonalTrainer::TEXT_DOMAIN ),
			'province' => __( 'Provincia', EpointPersonalTrainer::TEXT_DOMAIN ),
			'phone' => __( 'Teléfono', EpointPersonalTrainer::TEXT_DOMAIN ),
			'presential_price' => __( 'Precio de la hora presencial', EpointPersonalTrainer::TEXT_DOMAIN ),
			'online_price' => __( 'Precio del seguimiento online', EpointPersonalTrainer::TEXT_DOMAIN ),
			'experience_years' => __( 'Años de experiencia laboral', EpointPersonalTrainer::TEXT_DOMAIN ),
			'experience' => __( 'Experiencia laboral', EpointPersonalTrainer::TEXT_DOMAIN ),
			'studies' => __( 'Estudios', EpointPersonalTrainer::TEXT_DOMAIN ),
			'comments' => __( 'Comentario personal', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_name' => __( 'Nombre del centro', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_year' => __( 'Año de creación', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_workers' => __( 'Número de trabajadores', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_m2' => __( 'M2 del centro', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_activities' => __( 'Actividades', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_equipment' => __( 'Equipamiento', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_parking' => __( 'Aparcamiento privado', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_air_conditioning' => __( 'Climatización', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_comments' => __( 'Comentarios', EpointPersonalTrainer::TEXT_DOMAIN ),
			'company_prices' => __( 'Precios', EpointPersonalTrainer::TEXT_DOMAIN ),

			'dietetics' => __( 'Conocimientos dietéticos', EpointPersonalTrainer::TEXT_DOMAIN ),
			'hypertrophy' => __( 'Hipertrofia muscular', EpointPersonalTrainer::TEXT_DOMAIN ),
			'slimming' => __( 'Adelgazamiento', EpointPersonalTrainer::TEXT_DOMAIN ),
			'examinations' => __( 'Oposiciones', EpointPersonalTrainer::TEXT_DOMAIN ),
			'rehab' => __( 'Rehabilitación', EpointPersonalTrainer::TEXT_DOMAIN ),

			'sports' => __( 'Deportes', EpointPersonalTrainer::TEXT_DOMAIN ),
		);
	}


	public function __construct( $member_id )
	{
		$this->member_id = $member_id;
	}

	public function has_filled_trainer_info()
	{
		return
			$this->member_id &&
			get_user_meta( $this->member_id, self::TRAINER_INFO_PREFIX . 'filled', true ) == 'yes';
	}

	public function get_attributes()
	{
		$ret = array();

		foreach( self::get_available_attributes() as $key => $label )
			$ret[$key] = get_user_meta( $this->member_id, self::TRAINER_INFO_PREFIX . $key, true );

		return $ret;
	}
}

} // class_exists

