<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormSpanishProvinceSelectField' ) )
{

if( !class_exists( 'JLCCustomFormSelectField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'select.php' );


class JLCCustomFormSpanishProvinceSelectField extends JLCCustomFormSelectField
{
	public function __construct(
		$name,
		$multiple = false,
		$label = "",
		$help = null,
		$id = null,
		$class = null,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			array(),
			$multiple,
			false,//allow_new_options
			$label,
			$help,
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->load_provinces();
	}

	protected function load_provinces()
	{
		if( !$this->is_required() )
			$this->add_option( '', __( 'None', JLCCustomForm::TEXT_DOMAIN ) );

		foreach( self::get_provinces() as $code => $name )
			$this->add_option( $code, $name );
	}

	public static function get_provinces()
	{
		return array(
			'VI' => __( 'Alava', JLCCustomForm::TEXT_DOMAIN ),
			'AB' => __( 'Albacete', JLCCustomForm::TEXT_DOMAIN ),
			'A' => __( 'Alicante', JLCCustomForm::TEXT_DOMAIN ),
			'AL' => __( 'Almeria', JLCCustomForm::TEXT_DOMAIN ),
			'O' => __( 'Asturias', JLCCustomForm::TEXT_DOMAIN ),
			'AV' => __( 'Avila', JLCCustomForm::TEXT_DOMAIN ),
			'BA' => __( 'Badajoz', JLCCustomForm::TEXT_DOMAIN ),
			'PM' => __( 'Baleares', JLCCustomForm::TEXT_DOMAIN ),
			'B' => __( 'Barcelona', JLCCustomForm::TEXT_DOMAIN ),
			'BU' => __( 'Burgos', JLCCustomForm::TEXT_DOMAIN ),
			'CC' => __( 'Caceres', JLCCustomForm::TEXT_DOMAIN ),
			'CA' => __( 'Cadiz', JLCCustomForm::TEXT_DOMAIN ),
			'S' => __( 'Cantabria', JLCCustomForm::TEXT_DOMAIN ),
			'CS' => __( 'Castellon', JLCCustomForm::TEXT_DOMAIN ),
			'CE' => __( 'Ceuta', JLCCustomForm::TEXT_DOMAIN ),
			'CR' => __( 'Ciudad Real', JLCCustomForm::TEXT_DOMAIN ),
			'CO' => __( 'Cordoba', JLCCustomForm::TEXT_DOMAIN ),
			'CU' => __( 'Cuenca', JLCCustomForm::TEXT_DOMAIN ),
			'GI' => __( 'Gerona', JLCCustomForm::TEXT_DOMAIN ),
			'GR' => __( 'Granada', JLCCustomForm::TEXT_DOMAIN ),
			'GU' => __( 'Guadalajara', JLCCustomForm::TEXT_DOMAIN ),
			'SS' => __( 'Guipuzcoa', JLCCustomForm::TEXT_DOMAIN ),
			'H' => __( 'Huelva', JLCCustomForm::TEXT_DOMAIN ),
			'HU' => __( 'Huesca', JLCCustomForm::TEXT_DOMAIN ),
			'J' => __( 'Jaen', JLCCustomForm::TEXT_DOMAIN ),
			'C' => __( 'La Coruña', JLCCustomForm::TEXT_DOMAIN ),
			'LO' => __( 'La Rioja', JLCCustomForm::TEXT_DOMAIN ),
			'GC' => __( 'Las Palmas', JLCCustomForm::TEXT_DOMAIN ),
			'LE' => __( 'Leon', JLCCustomForm::TEXT_DOMAIN ),
			'L' => __( 'Lerida', JLCCustomForm::TEXT_DOMAIN ),
			'LU' => __( 'Lugo', JLCCustomForm::TEXT_DOMAIN ),
			'M' => __( 'Madrid', JLCCustomForm::TEXT_DOMAIN ),
			'MA' => __( 'Malaga', JLCCustomForm::TEXT_DOMAIN ),
			'ML' => __( 'Melilla', JLCCustomForm::TEXT_DOMAIN ),
			'MU' => __( 'Murcia', JLCCustomForm::TEXT_DOMAIN ),
			'NA' => __( 'Navarra', JLCCustomForm::TEXT_DOMAIN ),
			'OR' => __( 'Orense', JLCCustomForm::TEXT_DOMAIN ),
			'P' => __( 'Palencia', JLCCustomForm::TEXT_DOMAIN ),
			'PO' => __( 'Pontevedra', JLCCustomForm::TEXT_DOMAIN ),
			'SA' => __( 'Salamanca', JLCCustomForm::TEXT_DOMAIN ),
			'TF' => __( 'Santa Cruz de Tenerife', JLCCustomForm::TEXT_DOMAIN ),
			'SG' => __( 'Segovia', JLCCustomForm::TEXT_DOMAIN ),
			'SE' => __( 'Sevilla', JLCCustomForm::TEXT_DOMAIN ),
			'SO' => __( 'Soria', JLCCustomForm::TEXT_DOMAIN ),
			'T' => __( 'Tarragona', JLCCustomForm::TEXT_DOMAIN ),
			'TE' => __( 'Teruel', JLCCustomForm::TEXT_DOMAIN ),
			'TO' => __( 'Toledo', JLCCustomForm::TEXT_DOMAIN ),
			'V' => __( 'Valencia', JLCCustomForm::TEXT_DOMAIN ),
			'VA' => __( 'Valladolid', JLCCustomForm::TEXT_DOMAIN ),
			'BI' => __( 'Vizcaya', JLCCustomForm::TEXT_DOMAIN ),
			'ZA' => __( 'Zamora', JLCCustomForm::TEXT_DOMAIN ),
			'Z' => __( 'Zaragoza', JLCCustomForm::TEXT_DOMAIN ),
		);
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( !empty( $val ) || $this->is_required() )
		{
			$codes = array_keys( self::get_provinces() );
			if( !$this->is_multiple() )
			{
				if( !in_array( $val, $codes ) )
					return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Invalid province in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );
			}
			else
			{
				foreach( $val as $v )
				{
					if( !in_array( $v, $codes ) )
						return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Invalid province in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );
				}
			}
		}

		return null;
	}
}

} // class_exists


