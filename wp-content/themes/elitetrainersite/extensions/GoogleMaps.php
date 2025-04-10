<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class EliteTrainerSiteThemeGoogleMaps
{
	const API_KEY_KEY = 'elitetrainersite_google_maps_api_key';

	protected static $maps;
	protected static $markers;

	public static function initialize()
	{
		self::$maps = array();
		self::$markers = array();

		add_filter( 'elitetrainersite_settings_form_fields', array( get_class(), 'settings_fields' ) );

		add_action( 'wp_footer', array( get_class(), 'print_api_script' ) );
	}

	public static function settings_fields( $fields )
	{
		$fields[] = array(
			'type' => 'heading',
			'args' => array(
				'content' => __( 'Google Maps', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'size' => 2
			)
		);

		$fields[] = array(
			'type' => 'text_field',
			'name' => self::API_KEY_KEY,
			'args' => array(
				'value' => get_option( self::API_KEY_KEY ),
				'label' => __( 'Google Maps API key', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'help' => __( 'Leave blank if another source is inserting and managing Google Maps scripts', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'required' => false
			)
		);

		return $fields;
	}

	public static function get_api_key()
	{
		return get_option( self::API_KEY_KEY );
	}

	public static function get_maps()
	{
		return self::$maps;
	}

	public static function add_map( $map_name, $map_id, $attributes )
	{
		self::$maps[$map_name] = array(
			'id' => $map_id,
			'attributes' => $attributes
		);
	}

	public static function remove_map( $map_name )
	{
		if( isset( self::$maps[$map_name] ) )
			unset( self::$maps[$map_name] );
	}

	public static function get_markers()
	{
		return self::$markers;
	}

	public static function add_marker( $marker_name, $map_name, $attributes  )
	{
		self::$markers[$marker_name] = array(
			'attributes' => array_merge(
				$attributes,
				array(
					'map' => "|var:hololuGoogleMaps['" . $map_name . "']|"
				)
			)
		);
	}

	public static function remove_marker( $marker_name )
	{
		if( isset( self::$markers[$marker_name] ) )
			unset( self::$markers[$marker_name] );
	}

	public static function print_api_script()
	{
		get_template_part( 'templates/footer', 'googlemaps' );
	}

	/**
	 * Used to pass javascript variables.
	 *
	 * Syntax examples:
	 * for variable named pipi: "|var:pipi|"
	 * for variable named pipi["popo"]: "|var:pipi['popo']|"
	 * 
	 * Remerber to enclose |var:xxxxx| between double quotes
	 * and for indexes |var:xxxxx['iiiii'] use single quotes
	 */
	public static function parse_vars( $obj )
	{
		$enc = json_encode( $obj );
		return preg_replace( '/["\']\|var:([\w\d._\'\[\]]*)\|["\']/', '${1}', $enc );
	}
}
