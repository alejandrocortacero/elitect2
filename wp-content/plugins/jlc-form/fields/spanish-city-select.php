<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormSpanishCitySelectField' ) )
{

if( !class_exists( 'JLCCustomFormSelectField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'select.php' );


class JLCCustomFormSpanishCitySelectField extends JLCCustomFormSelectField
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

		$this->load_cities();
	}

	protected function load_cities()
	{
		if( !$this->is_required() )
			$this->add_option( '', __( 'None', JLCCustomForm::TEXT_DOMAIN ) );

		$provinces = self::get_provinces();
		foreach( $provinces as $code => $name )
			$this->add_group( $code, $name);

		$cities = self::get_cities();
		foreach( $cities as $ind => $city )
			$this->add_option( $ind, $city['name'], array( 'group' => $city['province'] ) );
	}

	public static function get_provinces()
	{
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'geography', 'spain', 'provinces.php' ) ) );

		return $provinces;
	}

	public static function get_cities()
	{
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'geography', 'spain', 'cities.php' ) ) );

		return $cities;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( !empty( $val ) || $this->is_required() )
		{
			$city_index = array_keys( self::get_cities() );
			if( !$this->is_multiple() )
			{
				if( !in_array( $val, $city_index ) )
					return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Invalid city in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );
			}
			else
			{
				foreach( $val as $v )
				{
					if( !in_array( $v, $city_index ) )
						return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Invalid city in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );
				}
			}
		}

		return null;
	}
}

} // class_exists
