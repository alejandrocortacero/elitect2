<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'EpointPersonalTrainerPersonalInfo', false ) )
{

class EpointPersonalTrainerPersonalInfo
{
	// USER META
	const PERSONAL_QUESTIONNAIRE_PREFIX = 'epoint_personal_trainer_pq_';

	protected $member_id;

	public static function get_available_attributes()
	{
		return array(
			'objectives' => __( 'Objetivos', EpointPersonalTrainer::TEXT_DOMAIN ),
			'injured' => __( 'Lesionado', EpointPersonalTrainer::TEXT_DOMAIN ),
			'injuries' => __( 'Lesiones', EpointPersonalTrainer::TEXT_DOMAIN ),
			'illness' => __( 'Enfermo', EpointPersonalTrainer::TEXT_DOMAIN ),
			'illness_list' => __( 'Enfermedades', EpointPersonalTrainer::TEXT_DOMAIN ),
			'medication' => __( 'Medicado', EpointPersonalTrainer::TEXT_DOMAIN ),
			'medication_list' => __( 'Medicamentos', EpointPersonalTrainer::TEXT_DOMAIN ),
			'tension' => __( 'Tensión', EpointPersonalTrainer::TEXT_DOMAIN ),
			'do_sport' => __( 'Deportista habitual', EpointPersonalTrainer::TEXT_DOMAIN ),
			'sport' => __( 'Deporte', EpointPersonalTrainer::TEXT_DOMAIN ),
			'other_sport' => __( 'Otro deporte', EpointPersonalTrainer::TEXT_DOMAIN ),
			'when_sport' => __( 'Practicando deporte', EpointPersonalTrainer::TEXT_DOMAIN ),
			'frequency_sport' => __( 'Frecuencia de práctica deportiva', EpointPersonalTrainer::TEXT_DOMAIN ),
			'frequency_training' => __( 'Días disponibles', EpointPersonalTrainer::TEXT_DOMAIN ),
			'available_hours' => __( 'Horas disponibles', EpointPersonalTrainer::TEXT_DOMAIN ),
			'occupation' => __( 'Ocupación', EpointPersonalTrainer::TEXT_DOMAIN ),
			'occupation_type' => __( 'Tipo de ocupación', EpointPersonalTrainer::TEXT_DOMAIN ),
			'sleep_hours' => __( 'Horas de sueño', EpointPersonalTrainer::TEXT_DOMAIN ),
			'feed' => __( 'Alimentación saludable', EpointPersonalTrainer::TEXT_DOMAIN ),
			'feed_frequency' => __( 'Comidas al día', EpointPersonalTrainer::TEXT_DOMAIN ),
			'suplements_use' => __( 'Uso de suplementos', EpointPersonalTrainer::TEXT_DOMAIN ),
			'suplements' => __( 'Suplementos', EpointPersonalTrainer::TEXT_DOMAIN ),
			'other_suplement' => __( 'Otro suplemento', EpointPersonalTrainer::TEXT_DOMAIN ),
		);
	}

	public static function get_available_objectives()
	{
		return array(
			'health' => __( 'Salud', EpointPersonalTrainer::TEXT_DOMAIN ),
			'lose_fat' => __( 'Perder grasa corporal', EpointPersonalTrainer::TEXT_DOMAIN ),
			'remove_tension' => __( 'Eliminar tensiones', EpointPersonalTrainer::TEXT_DOMAIN ),
			'postural_improvement' => __( 'Mejoramiento postural', EpointPersonalTrainer::TEXT_DOMAIN ),
			'physical_improvement' => __( 'Mejorar físicamente', EpointPersonalTrainer::TEXT_DOMAIN ),
			'gain_muscle' => __( 'Aumentar masa muscular', EpointPersonalTrainer::TEXT_DOMAIN ),
			'strength_or_power' => __( 'Fuerza o potencia', EpointPersonalTrainer::TEXT_DOMAIN ),
			'lose_volume' => __( 'Redurcir volumen', EpointPersonalTrainer::TEXT_DOMAIN ),
			'injury_recovery' => __( 'Recuperación de lesión', EpointPersonalTrainer::TEXT_DOMAIN ),
			'physical_resistance' => __( 'Resistencia física', EpointPersonalTrainer::TEXT_DOMAIN ),
			'oppositions' => __( 'Oposiciones', EpointPersonalTrainer::TEXT_DOMAIN ),
			'ohter' => __( 'Otro', EpointPersonalTrainer::TEXT_DOMAIN ),
		);
	}

	public static function get_available_suplements()
	{
		return array(
			'proteins_dust' => 'Proteínas en polvo',
			'proteins_bar' => 'Barritas de proteínas',
			'vitamins' => 'Vitaminas',
			'fats_burner' => 'Quemadores de grasa',
			'articular_protector' => 'Protectores articulares',
			'food_substitute' => 'Sustitutivos de comidas',
			'weight_aumenter' => 'Aumentador de peso corporal',
			'other' => 'Otro'
		);
	}
	

	public function __construct( $member_id )
	{
		$this->member_id = $member_id;
	}

	public function has_filled_personal_questionnaire()
	{
		return
			$this->member_id &&
			get_user_meta( $this->member_id, self::PERSONAL_QUESTIONNAIRE_PREFIX . 'filled', true ) == 'yes';
	}

	public function get_attributes()
	{
		$ret = array();

		foreach( self::get_available_attributes() as $key => $label )
			$ret[$key] = get_user_meta( $this->member_id, self::PERSONAL_QUESTIONNAIRE_PREFIX . $key, true );

		return $ret;
	}
}

} // class_exists
