<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormCountrySelectField' ) )
{

if( !class_exists( 'JLCCustomFormSelectField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'select.php' );


class JLCCustomFormCountrySelectField extends JLCCustomFormSelectField
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

		$this->load_countries();
	}

	protected function load_countries()
	{
		if( !$this->is_required() && !$this->is_multiple() )
			$this->add_option( '', __( 'None', JLCCustomForm::TEXT_DOMAIN ) );

		foreach( self::get_countries() as $code => $name )
			$this->add_option( $code, $name );
	}

	public static function get_countries()
	{
		$text_domain = JLCCustomForm::TEXT_DOMAIN;

		// ISO CODES 2021-12-12
		$countries = array(
			'AF' => __( 'Afghanistan', $text_domain ),
			'AX' => __( 'Åland Islands', $text_domain ),
			'AL' => __( 'Albania', $text_domain ),
			'DZ' => __( 'Algeria', $text_domain ),
			'AS' => __( 'American Samoa', $text_domain ),
			'AD' => __( 'Andorra', $text_domain ),
			'AO' => __( 'Angola', $text_domain ),
			'AI' => __( 'Anguilla', $text_domain ),
			'AQ' => __( 'Antarctica', $text_domain ),
			'AG' => __( 'Antigua and Barbuda', $text_domain ),
			'AR' => __( 'Argentina', $text_domain ),
			'AM' => __( 'Armenia', $text_domain ),
			'AW' => __( 'Aruba', $text_domain ),
			'AU' => __( 'Australia', $text_domain ),
			'AT' => __( 'Austria', $text_domain ),
			'AZ' => __( 'Azerbaijan', $text_domain ),
			'BS' => __( 'Bahamas', $text_domain ),
			'BH' => __( 'Bahrain', $text_domain ),
			'BD' => __( 'Bangladesh', $text_domain ),
			'BB' => __( 'Barbados', $text_domain ),
			'BY' => __( 'Belarus', $text_domain ),
			'BE' => __( 'Belgium', $text_domain ),
			'BZ' => __( 'Belize', $text_domain ),
			'BJ' => __( 'Benin', $text_domain ),
			'BM' => __( 'Bermuda', $text_domain ),
			'BT' => __( 'Bhutan', $text_domain ),
			'BO' => __( 'Bolivia, Plurinational State of', $text_domain ),
			'BQ' => __( 'Bonaire, Sint Eustatius and Saba', $text_domain ),
			'BA' => __( 'Bosnia and Herzegovina', $text_domain ),
			'BW' => __( 'Botswana', $text_domain ),
			'BV' => __( 'Bouvet Island', $text_domain ),
			'BR' => __( 'Brazil', $text_domain ),
			'IO' => __( 'British Indian Ocean Territory', $text_domain ),
			'BN' => __( 'Brunei Darussalam', $text_domain ),
			'BG' => __( 'Bulgaria', $text_domain ),
			'BF' => __( 'Burkina Faso', $text_domain ),
			'BI' => __( 'Burundi', $text_domain ),
			'KH' => __( 'Cambodia', $text_domain ),
			'CM' => __( 'Cameroon', $text_domain ),
			'CA' => __( 'Canada', $text_domain ),
			'CV' => __( 'Cape Verde', $text_domain ),
			'KY' => __( 'Cayman Islands', $text_domain ),
			'CF' => __( 'Central African Republic', $text_domain ),
			'TD' => __( 'Chad', $text_domain ),
			'CL' => __( 'Chile', $text_domain ),
			'CN' => __( 'China', $text_domain ),
			'CX' => __( 'Christmas Island', $text_domain ),
			'CC' => __( 'Cocos (Keeling) Islands', $text_domain ),
			'CO' => __( 'Colombia', $text_domain ),
			'KM' => __( 'Comoros', $text_domain ),
			'CG' => __( 'Congo', $text_domain ),
			'CD' => __( 'Congo, the Democratic Republic of the', $text_domain ),
			'CK' => __( 'Cook Islands', $text_domain ),
			'CR' => __( 'Costa Rica', $text_domain ),
			'CI' => __( 'Côte d\'Ivoire', $text_domain ),
			'HR' => __( 'Croatia', $text_domain ),
			'CU' => __( 'Cuba', $text_domain ),
			'CW' => __( 'Curaçao', $text_domain ),
			'CY' => __( 'Cyprus', $text_domain ),
			'CZ' => __( 'Czech Republic', $text_domain ),
			'DK' => __( 'Denmark', $text_domain ),
			'DJ' => __( 'Djibouti', $text_domain ),
			'DM' => __( 'Dominica', $text_domain ),
			'DO' => __( 'Dominican Republic', $text_domain ),
			'EC' => __( 'Ecuador', $text_domain ),
			'EG' => __( 'Egypt', $text_domain ),
			'SV' => __( 'El Salvador', $text_domain ),
			'GQ' => __( 'Equatorial Guinea', $text_domain ),
			'ER' => __( 'Eritrea', $text_domain ),
			'EE' => __( 'Estonia', $text_domain ),
			'ET' => __( 'Ethiopia', $text_domain ),
			'FK' => __( 'Falkland Islands (Malvinas)', $text_domain ),
			'FO' => __( 'Faroe Islands', $text_domain ),
			'FJ' => __( 'Fiji', $text_domain ),
			'FI' => __( 'Finland', $text_domain ),
			'FR' => __( 'France', $text_domain ),
			'GF' => __( 'French Guiana', $text_domain ),
			'PF' => __( 'French Polynesia', $text_domain ),
			'TF' => __( 'French Southern Territories', $text_domain ),
			'GA' => __( 'Gabon', $text_domain ),
			'GM' => __( 'Gambia', $text_domain ),
			'GE' => __( 'Georgia', $text_domain ),
			'DE' => __( 'Germany', $text_domain ),
			'GH' => __( 'Ghana', $text_domain ),
			'GI' => __( 'Gibraltar', $text_domain ),
			'GR' => __( 'Greece', $text_domain ),
			'GL' => __( 'Greenland', $text_domain ),
			'GD' => __( 'Grenada', $text_domain ),
			'GP' => __( 'Guadeloupe', $text_domain ),
			'GU' => __( 'Guam', $text_domain ),
			'GT' => __( 'Guatemala', $text_domain ),
			'GG' => __( 'Guernsey', $text_domain ),
			'GN' => __( 'Guinea', $text_domain ),
			'GW' => __( 'Guinea-Bissau', $text_domain ),
			'GY' => __( 'Guyana', $text_domain ),
			'HT' => __( 'Haiti', $text_domain ),
			'HM' => __( 'Heard Island and McDonald Islands', $text_domain ),
			'VA' => __( 'Holy See (Vatican City State)', $text_domain ),
			'HN' => __( 'Honduras', $text_domain ),
			'HK' => __( 'Hong Kong', $text_domain ),
			'HU' => __( 'Hungary', $text_domain ),
			'IS' => __( 'Iceland', $text_domain ),
			'IN' => __( 'India', $text_domain ),
			'ID' => __( 'Indonesia', $text_domain ),
			'IR' => __( 'Iran, Islamic Republic of', $text_domain ),
			'IQ' => __( 'Iraq', $text_domain ),
			'IE' => __( 'Ireland', $text_domain ),
			'IM' => __( 'Isle of Man', $text_domain ),
			'IL' => __( 'Israel', $text_domain ),
			'IT' => __( 'Italy', $text_domain ),
			'JM' => __( 'Jamaica', $text_domain ),
			'JP' => __( 'Japan', $text_domain ),
			'JE' => __( 'Jersey', $text_domain ),
			'JO' => __( 'Jordan', $text_domain ),
			'KZ' => __( 'Kazakhstan', $text_domain ),
			'KE' => __( 'Kenya', $text_domain ),
			'KI' => __( 'Kiribati', $text_domain ),
			'KP' => __( 'Korea, Democratic People\'s Republic of', $text_domain ),
			'KR' => __( 'Korea, Republic of', $text_domain ),
			'KW' => __( 'Kuwait', $text_domain ),
			'KG' => __( 'Kyrgyzstan', $text_domain ),
			'LA' => __( 'Lao People\'s Democratic Republic', $text_domain ),
			'LV' => __( 'Latvia', $text_domain ),
			'LB' => __( 'Lebanon', $text_domain ),
			'LS' => __( 'Lesotho', $text_domain ),
			'LR' => __( 'Liberia', $text_domain ),
			'LY' => __( 'Libya', $text_domain ),
			'LI' => __( 'Liechtenstein', $text_domain ),
			'LT' => __( 'Lithuania', $text_domain ),
			'LU' => __( 'Luxembourg', $text_domain ),
			'MO' => __( 'Macao', $text_domain ),
			'MK' => __( 'Macedonia, the Former Yugoslav Republic of', $text_domain ),
			'MG' => __( 'Madagascar', $text_domain ),
			'MW' => __( 'Malawi', $text_domain ),
			'MY' => __( 'Malaysia', $text_domain ),
			'MV' => __( 'Maldives', $text_domain ),
			'ML' => __( 'Mali', $text_domain ),
			'MT' => __( 'Malta', $text_domain ),
			'MH' => __( 'Marshall Islands', $text_domain ),
			'MQ' => __( 'Martinique', $text_domain ),
			'MR' => __( 'Mauritania', $text_domain ),
			'MU' => __( 'Mauritius', $text_domain ),
			'YT' => __( 'Mayotte', $text_domain ),
			'MX' => __( 'Mexico', $text_domain ),
			'FM' => __( 'Micronesia, Federated States of', $text_domain ),
			'MD' => __( 'Moldova, Republic of', $text_domain ),
			'MC' => __( 'Monaco', $text_domain ),
			'MN' => __( 'Mongolia', $text_domain ),
			'ME' => __( 'Montenegro', $text_domain ),
			'MS' => __( 'Montserrat', $text_domain ),
			'MA' => __( 'Morocco', $text_domain ),
			'MZ' => __( 'Mozambique', $text_domain ),
			'MM' => __( 'Myanmar', $text_domain ),
			'NA' => __( 'Namibia', $text_domain ),
			'NR' => __( 'Nauru', $text_domain ),
			'NP' => __( 'Nepal', $text_domain ),
			'NL' => __( 'Netherlands', $text_domain ),
			'NC' => __( 'New Caledonia', $text_domain ),
			'NZ' => __( 'New Zealand', $text_domain ),
			'NI' => __( 'Nicaragua', $text_domain ),
			'NE' => __( 'Niger', $text_domain ),
			'NG' => __( 'Nigeria', $text_domain ),
			'NU' => __( 'Niue', $text_domain ),
			'NF' => __( 'Norfolk Island', $text_domain ),
			'MP' => __( 'Northern Mariana Islands', $text_domain ),
			'NO' => __( 'Norway', $text_domain ),
			'OM' => __( 'Oman', $text_domain ),
			'PK' => __( 'Pakistan', $text_domain ),
			'PW' => __( 'Palau', $text_domain ),
			'PS' => __( 'Palestine, State of', $text_domain ),
			'PA' => __( 'Panama', $text_domain ),
			'PG' => __( 'Papua New Guinea', $text_domain ),
			'PY' => __( 'Paraguay', $text_domain ),
			'PE' => __( 'Peru', $text_domain ),
			'PH' => __( 'Philippines', $text_domain ),
			'PN' => __( 'Pitcairn', $text_domain ),
			'PL' => __( 'Poland', $text_domain ),
			'PT' => __( 'Portugal', $text_domain ),
			'PR' => __( 'Puerto Rico', $text_domain ),
			'QA' => __( 'Qatar', $text_domain ),
			'RE' => __( 'Réunion', $text_domain ),
			'RO' => __( 'Romania', $text_domain ),
			'RU' => __( 'Russian Federation', $text_domain ),
			'RW' => __( 'Rwanda', $text_domain ),
			'BL' => __( 'Saint Barthélemy', $text_domain ),
			'SH' => __( 'Saint Helena, Ascension and Tristan da Cunha', $text_domain ),
			'KN' => __( 'Saint Kitts and Nevis', $text_domain ),
			'LC' => __( 'Saint Lucia', $text_domain ),
			'MF' => __( 'Saint Martin (French part)', $text_domain ),
			'PM' => __( 'Saint Pierre and Miquelon', $text_domain ),
			'VC' => __( 'Saint Vincent and the Grenadines', $text_domain ),
			'WS' => __( 'Samoa', $text_domain ),
			'SM' => __( 'San Marino', $text_domain ),
			'ST' => __( 'Sao Tome and Principe', $text_domain ),
			'SA' => __( 'Saudi Arabia', $text_domain ),
			'SN' => __( 'Senegal', $text_domain ),
			'RS' => __( 'Serbia', $text_domain ),
			'SC' => __( 'Seychelles', $text_domain ),
			'SL' => __( 'Sierra Leone', $text_domain ),
			'SG' => __( 'Singapore', $text_domain ),
			'SX' => __( 'Sint Maarten (Dutch part)', $text_domain ),
			'SK' => __( 'Slovakia', $text_domain ),
			'SI' => __( 'Slovenia', $text_domain ),
			'SB' => __( 'Solomon Islands', $text_domain ),
			'SO' => __( 'Somalia', $text_domain ),
			'ZA' => __( 'South Africa', $text_domain ),
			'GS' => __( 'South Georgia and the South Sandwich Islands', $text_domain ),
			'SS' => __( 'South Sudan', $text_domain ),
			'ES' => __( 'Spain', $text_domain ),
			'LK' => __( 'Sri Lanka', $text_domain ),
			'SD' => __( 'Sudan', $text_domain ),
			'SR' => __( 'Suriname', $text_domain ),
			'SJ' => __( 'Svalbard and Jan Mayen', $text_domain ),
			'SZ' => __( 'Swaziland', $text_domain ),
			'SE' => __( 'Sweden', $text_domain ),
			'CH' => __( 'Switzerland', $text_domain ),
			'SY' => __( 'Syrian Arab Republic', $text_domain ),
			'TW' => __( 'Taiwan, Province of China', $text_domain ),
			'TJ' => __( 'Tajikistan', $text_domain ),
			'TZ' => __( 'Tanzania, United Republic of', $text_domain ),
			'TH' => __( 'Thailand', $text_domain ),
			'TL' => __( 'Timor-Leste', $text_domain ),
			'TG' => __( 'Togo', $text_domain ),
			'TK' => __( 'Tokelau', $text_domain ),
			'TO' => __( 'Tonga', $text_domain ),
			'TT' => __( 'Trinidad and Tobago', $text_domain ),
			'TN' => __( 'Tunisia', $text_domain ),
			'TR' => __( 'Turkey', $text_domain ),
			'TM' => __( 'Turkmenistan', $text_domain ),
			'TC' => __( 'Turks and Caicos Islands', $text_domain ),
			'TV' => __( 'Tuvalu', $text_domain ),
			'UG' => __( 'Uganda', $text_domain ),
			'UA' => __( 'Ukraine', $text_domain ),
			'AE' => __( 'United Arab Emirates', $text_domain ),
			'GB' => __( 'United Kingdom', $text_domain ),
			'US' => __( 'United States', $text_domain ),
			'UM' => __( 'United States Minor Outlying Islands', $text_domain ),
			'UY' => __( 'Uruguay', $text_domain ),
			'UZ' => __( 'Uzbekistan', $text_domain ),
			'VU' => __( 'Vanuatu', $text_domain ),
			'VE' => __( 'Venezuela, Bolivarian Republic of', $text_domain ),
			'VN' => __( 'Viet Nam', $text_domain ),
			'VG' => __( 'Virgin Islands, British', $text_domain ),
			'VI' => __( 'Virgin Islands, U.S.', $text_domain ),
			'WF' => __( 'Wallis and Futuna', $text_domain ),
			'EH' => __( 'Western Sahara', $text_domain ),
			'YE' => __( 'Yemen', $text_domain ),
			'ZM' => __( 'Zambia', $text_domain ),
			'ZW' => __( 'Zimbabwe', $text_domain )
		);

		natsort( $countries );

		return $countries;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( !empty( $val ) || $this->is_required() )
		{
			$codes = array_keys( self::get_countries() );
			if( !$this->is_multiple() )
			{
				if( !in_array( $val, $codes ) )
					return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Invalid country in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );
			}
			else
			{
				foreach( $val as $v )
				{
					if( !in_array( $v, $codes ) )
						return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Invalid country in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );
				}
			}
		}

		return null;
	}
}

} // class_exists
