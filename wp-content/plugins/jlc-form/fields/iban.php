<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormIBANField' ) )
{

if( !class_exists( 'AbstractJLCCustomFormField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

/*
	The following character representations are used in this document:
		n Digits (numeric characters 0 to 9 only)
		a Upper case letters (alphabetic characters A-Z only)
		c upper and lower case alphanumeric characters (A-Z, a-z and 0-9)
		e blank space
	The following length indications are used in this document:
		nn! fixed length
		nn maximum length

	Code	Country name			Structure					Electronic format example			Print format example

	AD		Andorra		  			AD2!n4!n4!n12!c				AD1200012030200359100100			AD12 0001 2030 2003 5910 0100
	AE		United Arab Emirates	AE2!n3!n16!n				AE070331234567890123456				AE07 0331 2345 6789 0123 456
	AL		Albania					AL2!n8!n16!c				AL47212110090000000235698741		AL47 2121 1009 0000 0002 3569 8741
	AT		Austria					AT2!n5!n11!n				AT611904300234573201				AT61 1904 3002 3457 3201
	AZ		Azerbaijan				AZ2!n4!a20!c				AZ21NABZ00000000137010001944		AZ21 NABZ 0000 0000 1370 1000 1944
	BA		Bosnia and Herzegovina	BA2!n3!n3!n8!n2!n			BA391290079401028494				BA39 1290 0794 0102 8494
	BE		Belgium					BE2!n3!n7!n2!n				BE68539007547034					BE68 5390 0754 7034
	BG		Bulgaria				BG2!n4!a4!n2!n8!c			BG80BNBG96611020345678				BG80 BNBG 9661 1020 3456 78
	BH		Bahrain					BH2!n4!a14!c				BH67BMAG00001299123456				BH67 BMAG 0000 1299 1234 56
	BR		Brazil					BR2!n8!n5!n10!n1!a1!c		BR1800360305000010009795493C1		BR18 0036 0305 0000 1000 9795 493C 1
	BY		Republic of Belarus		BY2!n4!c4!n16!c				BY13NBRB3600900000002Z00AB00		BY13 NBRB 3600 9000 0000 2Z00 AB00
	CH		Switzerland				CH2!n5!n12!c				CH9300762011623852957				CH93 0076 2011 6238 5295 7
	CR		Costa Rica				CR2!n4!n14!n				CR05015202001026284066				CR05 0152 0200 1026 2840 66
	CY		Cyprus					CY2!n3!n5!n16!c				CY17002001280000001200527600		CY17 0020 0128 0000 0012 0052 7600
	CZ		Czech Republic			CZ2!n4!n6!n10!n				CZ6508000000192000145399			CZ65 0800 0000 1920 0014 5399
	DE		Germany					DE2!n8!n10!n				DE89370400440532013000				DE89 3704 0044 0532 0130 00
	DK		Denmark					DK2!n4!n9!n1!n				DK5000400440116243					DK50 0040 0440 1162 43
	DO		Dominican Republic		DO2!n4!c20!n				DO28BAGR00000001212453611324		DO28 BAGR 0000 0001 2124 5361 1324
	EE		Estonia					EE2!n2!n2!n11!n1!n			EE382200221020145685				EE38 2200 2210 2014 5685
	EG		Egypt					EG2!n4!n4!n17!n				EG380019000500000000263180002		EG380019000500000000263180002
	ES		Spain					ES2!n4!n4!n1!n1!n10!n		ES9121000418450200051332			ES91 2100 0418 4502 0005 1332
	FI		Finland					FI2!n3!n11!n				FI2112345600000785					FI21 1234 5600 0007 85
	FO		Faroe Islands			FO2!n4!n9!n1!n				FO6264600001631634					FO62 6460 0001 6316 34
	FR		France					FR2!n5!n5!n11!c2!n			FR1420041010050500013M02606			FR14 2004 1010 0505 0001 3M02 606
	GB		United Kingdom			GB2!n4!a6!n8!n				GB29NWBK60161331926819				GB29 NWBK 6016 1331 9268 19
	GE		Georgia					GE2!n2!a16!n				GE29NB0000000101904917				GE29 NB00 0000 0101 9049 17
	GI		Gibraltar				GI2!n4!a15!c				GI75NWBK000000007099453				GI75 NWBK 0000 0000 7099 453
	GL		Greenland				GL2!n4!n9!n1!n				GL8964710001000206					GL89 6471 0001 0002 06
	GR		Grece					GR2!n3!n4!n16!c				GR1601101250000000012300695			GR16 0110 1250 0000 0001 2300 695
	GT		Guatemala				GT2!n4!c20!c				GT82TRAJ01020000001210029690		GT82 TRAJ 0102 0000 0012 1002 9690
	HR		Croatia					HR2!n7!n10!n				HR1210010051863000160				HR12 1001 0051 8630 0016 0
	HU		Hungary					HU2!n3!n4!n1!n15!n1!n		HU42117730161111101800000000		HU42 1177 3016 1111 1018 0000 0000
	IE		Ireland					IE2!n4!a6!n8!n				IE29AIBK93115212345678				IE29 AIBK 9311 5212 3456 78
	IL		Israel					IL2!n3!n3!n13!n				IL620108000000099999999				IL62 0108 0000 0009 9999 999
	IQ		Iraq					IQ2!n4!a3!n12!n				IQ98NBIQ850123456789012				IQ98 NBIQ 8501 2345 6789 012
	IS		Iceland					IS2!n4!n2!n6!n10!n			IS140159260076545510730339			IS14 0159 2600 7654 5510 7303 39
	IT		Italy					IT2!n1!a5!n5!n12!c			IT60X0542811101000000123456			IT60 X054 2811 1010 0000 0123 456
	JO		Jordania				JO2!n4!a4!n18!c				JO94CBJO0010000000000131000302		JO94 CBJO 0010 0000 0000 0131 0003 02
	KW		Kuwait					KW2!n4!a22!c				KW81CBKU0000000000001234560101		KW81 CBKU 0000 0000 0000 1234 5601 01
	KZ		Kazakhstan				KZ2!n3!n13!c				KZ86125KZT5004100100				KZ86 125K ZT50 0410 0100
	LB		Lebanon					LB2!n4!n20!c				LB62099900000001001901229114		LB62 0999 0000 0001 0019 0122 9114
	LC		Saint Lucia				LC2!n4!a24!c				LC55HEMM000100010012001200023015	LC55 HEMM 0001 0001 0012 0012 0002 3015
	LI		Liechtenstein			LI2!n5!n12!c				LI21088100002324013AA				LI21 0881 0000 2324 013A A
	LT		Lithuania				LT2!n5!n11!n				LT121000011101001000				LT12 1000 0111 0100 1000
	LU		Luxembourg				LU2!n3!n13!c				LU280019400644750000				LU28 0019 4006 4475 0000
	LV		Latvia					LV2!n4!a13!c				LV80BANK0000435195001				LV80 BANK 0000 4351 9500 1
	MC		Monaco					MC2!n5!n5!n11!c2!n			MC5811222000010123456789030			MC58 1122 2000 0101 2345 6789 030
	MD		Moldova					MD2!n2!c18!c				MD24AG000225100013104168			MD24 AG00 0225 1000 1310 4168
	ME		Montenegro				ME2!n3!n13!n2!n				ME25505000012345678951				ME25 5050 0001 2345 6789 51
	MK		Macedonia				MK2!n3!n10!c2!n				MK07250120000058984					MK07 2501 2000 0058 984
	MR		Mauritania				MR2!n5!n5!n11!n2!n			MR1300020001010000123456753			MR13 0002 0001 0100 0012 3456 753
	MT		Malta					MT2!n4!a5!n18!c				MT84MALT011000012345MTLCAST001S		MT84 MALT 0110 0001 2345 MTLC AST0 01S
	MU		Mauritius				MU2!n4!a2!n2!n12!n3!n3!a	MU17BOMM0101101030300200000MUR		MU17 BOMM 0101 1010 3030 0200 000M UR
	NL		Netherlands				NL2!n4!a10!n				NL91ABNA0417164300					NL91 ABNA 0417 1643 00
	NO		Norway					NO2!n4!n6!n1!n				NO9386011117947						NO93 8601 1117 947
	PK		Pakistan				PK2!n4!a16!c				PK36SCBL0000001123456702			PK36 SCBL 0000 0011 2345 6702
	PL		Poland					PL2!n8!n16!n				PL61109010140000071219812874		PL61 1090 1014 0000 0712 1981 2874
	PS		Palestina, State of		PS2!n4!a21!c				PS92PALS000000000400123456702		PS92 PALS 0000 0000 0400 1234 5670 2
	PT		Portugal				PT2!n4!n4!n11!n2!n			PT50000201231234567890154			PT50 0002 0123 1234 5678 9015 4
	QA		Qatar					QA2!n4!a21!c				QA58DOHB00001234567890ABCDEFG		QA58 DOHB 0000 1234 5678 90AB CDEF G
	RO		Romania					RO2!n4!a16!c				RO49AAAA1B31007593840000			RO49 AAAA 1B31 0075 9384 0000
	RS		Serbia					RS2!n3!n13!n2!n				RS35260005601001611379				RS35 2600 0560 1001 6113 79
	SA		Saudi Arabia			SA2!n2!n18!c				SA0380000000608010167519			SA03 8000 0000 6080 1016 7519
	SC		Seychelles				SC2!n4!a2!n2!n16!n3!a		SC18SSCB11010000000000001497USD		SC18 SSCB 1101 0000 0000 0000 1497 USD
	SE		Sweden					SE2!n3!n16!n1!n				SE4550000000058398257466			SE45 5000 0000 0583 9825 7466
	SI		Slovenia				SI2!n5!n8!n2!n				SI56263300012039086					SI56 2633 0001 2039 086
	SK		Slovakia				SK2!n4!n6!n10!n				SK3112000000198742637541			SK31 1200 0000 1987 4263 7541
	SM		San Marino				SM2!n1!a5!n5!n12!c			SM86U0322509800000000270100			SM86 U032 2509 8000 0000 0270 100
	ST		Sao Tome and Principe	ST2!n4!n4!n11!n2!n			ST68000200010192194210112			ST68 0002 0001 0192 1942 1011 2
	SV		El Salvador				SV2!n4!a20!n				SV62CENR00000000000000700025		SV 62 CENR 00000000000000700025
	TL		Timor-Leste				TL2!n3!n14!n2!n				TL380080012345678910157				TL38 0080 0123 4567 8910 157
	TN		Tunisia					TN2!n2!n3!n13!n2!n			TN5910006035183598478831			TN59 1000 6035 1835 9847 8831
	TR		Turkey					TR2!n5!n1!n16!c				TR330006100519786457841326			TR33 0006 1005 1978 6457 8413 26
	UA		Ukraine					UA2!n6!n19!c				UA213223130000026007233566001		UA21 3223 1300 0002 6007 2335 6600 1
	VA		Vatican City State		VA2!n3!n15!n				VA59001123000012345678				VA59 001 1230 0001 2345 678
	VG		Virgin Islands			VG2!n4!a16!n				VG96VPVG0000012345678901			VG96 VPVG 0000 0123 4567 8901
	XK		Kosovo					XK2!n4!n10!n2!n				XK051212012345678906				XK05 1212 0123 4567 8906
*/

class JLCCustomFormIBANField extends AbstractJLCCustomFormField
{
	protected $help;

	protected $country;
	protected $single_field;

	public static function get_countries()
	{
		$text_domain = JLCCustomForm::TEXT_DOMAIN;

		return array(
			'AD' => __( 'Andorra', $text_domain ),
			'AE' => __( 'United Arab Emirates', $text_domain ),
			'AL' => __( 'Albania', $text_domain ),
			'AT' => __( 'Austria', $text_domain ),
			'AZ' => __( 'Azerbaijan', $text_domain ),
			'BA' => __( 'Bosnia and Herzegovina', $text_domain ),
			'BE' => __( 'Belgium', $text_domain ),
			'BG' => __( 'Bulgaria', $text_domain ),
			'BH' => __( 'Bahrain', $text_domain ),
			'BR' => __( 'Brazil', $text_domain ),
			'BY' => __( 'Republic of Belarus', $text_domain ),
			'CH' => __( 'Switzerland', $text_domain ),
			'CR' => __( 'Costa Rica', $text_domain ),
			'CY' => __( 'Cyprus', $text_domain ),
			'CZ' => __( 'Czech Republic', $text_domain ),
			'DE' => __( 'Germany', $text_domain ),
			'DK' => __( 'Denmark', $text_domain ),
			'DO' => __( 'Dominican Republic', $text_domain ),
			'EE' => __( 'Estonia', $text_domain ),
			'EG' => __( 'Egypt', $text_domain ),
			'ES' => __( 'Spain', $text_domain ),
			'FI' => __( 'Finland', $text_domain ),
			'FO' => __( 'Faroe Islands', $text_domain ),
			'FR' => __( 'France', $text_domain ),
			'GB' => __( 'United Kingdom', $text_domain ),
			'GE' => __( 'Georgia', $text_domain ),
			'GI' => __( 'Gibraltar', $text_domain ),
			'GL' => __( 'Greenland', $text_domain ),
			'GR' => __( 'Grece', $text_domain ),
			'GT' => __( 'Guatemala', $text_domain ),
			'HR' => __( 'Croatia', $text_domain ),
			'HU' => __( 'Hungary', $text_domain ),
			'IE' => __( 'Ireland', $text_domain ),
			'IL' => __( 'Israel', $text_domain ),
			'IQ' => __( 'Iraq', $text_domain ),
			'IS' => __( 'Iceland', $text_domain ),
			'IT' => __( 'Italy', $text_domain ),
			'JO' => __( 'Jordania', $text_domain ),
			'KW' => __( 'Kuwait', $text_domain ),
			'KZ' => __( 'Kazakhstan', $text_domain ),
			'LB' => __( 'Lebanon', $text_domain ),
			'LC' => __( 'Saint Lucia', $text_domain ),
			'LI' => __( 'Liechtenstein', $text_domain ),
			'LT' => __( 'Lithuania', $text_domain ),
			'LU' => __( 'Luxembourg', $text_domain ),
			'LV' => __( 'Latvia', $text_domain ),
			'MC' => __( 'Monaco', $text_domain ),
			'MD' => __( 'Moldova', $text_domain ),
			'ME' => __( 'Montenegro', $text_domain ),
			'MK' => __( 'Macedonia', $text_domain ),
			'MR' => __( 'Mauritania', $text_domain ),
			'MT' => __( 'Malta', $text_domain ),
			'MU' => __( 'Mauritius', $text_domain ),
			'NL' => __( 'Netherlands', $text_domain ),
			'NO' => __( 'Norway', $text_domain ),
			'PK' => __( 'Pakistan', $text_domain ),
			'PL' => __( 'Poland', $text_domain ),
			'PS' => __( 'Palestina', $text_domain ),
			'PT' => __( 'Portugal', $text_domain ),
			'QA' => __( 'Qatar', $text_domain ),
			'RO' => __( 'Romania', $text_domain ),
			'RS' => __( 'Serbia', $text_domain ),
			'SA' => __( 'Saudi Arabia', $text_domain ),
			'SC' => __( 'Seychelles', $text_domain ),
			'SE' => __( 'Sweden', $text_domain ),
			'SI' => __( 'Slovenia', $text_domain ),
			'SK' => __( 'Slovakia', $text_domain ),
			'SM' => __( 'San Marino', $text_domain ),
			'ST' => __( 'Sao Tome and Principe', $text_domain ),
			'SV' => __( 'El Salvador', $text_domain ),
			'TL' => __( 'Timor-Leste', $text_domain ),
			'TN' => __( 'Tunisia', $text_domain ),
			'TR' => __( 'Turkey', $text_domain ),
			'UA' => __( 'Ukraine', $text_domain ),
			'VA' => __( 'Vatican City State', $text_domain ),
			'VG' => __( 'Virgin Islands', $text_domain ),
			'XK' => __( 'Kosovo', $text_domain )
		);
	}

	public static function get_country_length( $country )
	{
		switch( $country )
		{
			case 'NO':
				return 15;
			case 'BE':
				return 16;
			case 'DK':
			case 'FI':
			case 'FO':
			case 'GL':
			case 'NL':
				return 18;
			case 'MK':
			case 'SI':
				return 19;
			case 'AT':
			case 'BA':
			case 'EE':
			case 'KZ':
			case 'LT':
			case 'LU':
			case 'XK':
				return 20;
			case 'CH':
			case 'HR':
			case 'LI':
			case 'LV':
				return 21;
			case 'BG':
			case 'BH':
			case 'CR':
			case 'DE':
			case 'GB':
			case 'GE':
			case 'IE':
			case 'ME':
			case 'RS':
			case 'VA':
				return 22;
			case 'AE':
			case 'GI':
			case 'IL':
			case 'IQ':
			case 'TL':
				return 23;
			case 'PT':
			case 'ST':
				return 25;
			case 'IS':
			case 'TR':
				return 26;
			case 'FR':
			case 'GR':
			case 'IT':
			case 'MC':
			case 'MR':
			case 'SM':
				return 27;
			case 'AL':
			case 'AZ':
			case 'BY':
			case 'CY':
			case 'DO':
			case 'GT':
			case 'HU':
			case 'LB':
			case 'PL':
			case 'SV':
				return 28;
			case 'BR':
			case 'EG':
			case 'PS':
			case 'QA':
			case 'UA':
				return 29;
			case 'JO':
			case 'KW':
			case 'MU':
				return 30;
			case 'MT':
			case 'SC':
				return 31;
			case 'LC':
				return 32;
			default: // AD, CZ, ES, MD, PK, RO, SA, SE, SK, TN, VG
				return 24;
		}
	}

	public static function get_country_pattern( $country_code )
	{
		$patterns = array(
			'AD' => '/^AD\d{2}\d{4}\d{4}[0-9a-zA-Z]{12}$/', //AD2!n4!n4!n12!c
			'AE' => '/^AE\d{2}\d{3}\d{16}$/', //AE2!n3!n16!n
			'AL' => '/^AL\d{2}\d{8}[0-9a-zA-Z]{16}$/', //AL2!n8!n16!c
			'AT' => '/^AT\d{2}\d{5}\d{11}$/', //AT2!n5!n11!n
			'AZ' => '/^AZ\d{2}[A-Z]{4}[0-9a-zA-Z]{20}$/', //AZ2!n4!a20!c
			'BA' => '/^BA\d{2}\d{3}\d{3}\d{8}\d{2}$/', //BA2!n3!n3!n8!n2!n
			'BE' => '/^BE\d{2}\d{3}\d{7}\d{2}$/', //BE2!n3!n7!n2!n
			'BG' => '/^BG\d{2}[A-Z]{4}\d{4}\d{2}[A-Za-z0-9]{8}$/', //BG2!n4!a4!n2!n8!c
			'BH' => '/^BH\d{2}[A-Z]{4}[A-Za-z0-9]{14}$/', //BH2!n4!a14!c
			'BR' => '/^BR\d{2}\d{8}\d{5}\d{10}[A-Z][A-Za-z0-9]$/', //BR2!n8!n5!n10!n1!a1!c
			'BY' => '/^BY\d{2}[A-Za-z0-9]{4}\d{4}[A-Za-z0-9]{16}$/', //BY2!n4!c4!n16!c
			'CH' => '/^CH\d{2}\d{5}[A-Za-z0-9]{12}$/', //CH2!n5!n12!c
			'CR' => '/^CR\d{2}\d{4}\d{14}$/', //CR2!n4!n14!n
			'CY' => '/^CY\d{2}\d{3}\d{5}[A-Za-z0-9]{16}$/', //CY2!n3!n5!n16!c
			'CZ' => '/^CZ\d{2}\d{4}\d{6}\d{10}$/', //CZ2!n4!n6!n10!n
			'DE' => '/^DE\d{2}\d{8}\d{10}$/', //DE2!n8!n10!n
			'DK' => '/^DK\d{2}\d{4}\d{9}\d$/', //DK2!n4!n9!n1!n
			'DO' => '/^DO\d{2}[A-Za-z0-9]{4}\d{20}$/', //DO2!n4!c20!n
			'EE' => '/^EE\d{2}\d{2}\d{2}\d{11}\d$/', //EE2!n2!n2!n11!n1!n
			'EG' => '/^EG\d{2}\d{4}\d{4}\d{17}$/', //EG2!n4!n4!n17!n
			'ES' => '/^ES\d{2}\d{4}\d{4}\d\d\d{10}$/', //ES2!n4!n4!n1!n1!n10!n
			'FI' => '/^FI\d{2}\d{3}\d{11}$/', //FI2!n3!n11!n
			'FO' => '/^FO\d{2}\d{4}\d{9}\d$/',//FO2!n4!n9!n1!n
			'FR' => '/^FR\d{2}\d{5}\d{5}[A-Za-z0-9]{11}\d{2}$/', //FR2!n5!n5!n11!c2!n
			'GB' => '/^GB\d{2}[A-Z]{4}\d{6}\d{8}$/', //GB2!n4!a6!n8!n
			'GE' => '/^GE\d{2}[A-Z]{2}\d{16}$/', //GE2!n2!a16!n	
			'GI' => '/^GI\d{2}[A-Z]{4}[A-Za-z0-9]{15}$/', //GI2!n4!a15!c
			'GL' => '/^GL\d{2}\d{4}\d{9}\d$/', //GL2!n4!n9!n1!n
			'GR' => '/^GR\d{2}\d{3}\d{4}[A-Za-z0-9]{16}$/', //GR2!n3!n4!n16!c
			'GT' => '/^GT\d{2}[A-Za-z0-9]{4}[A-Za-z0-9]{20}$/', //GT2!n4!c20!c
			'HR' => '/^HR\d{2}\d{7}\d{10}$/', //HR2!n7!n10!n
			'HU' => '/^HU\d{2}\d{3}\d{4}\d\d{15}\d$/', //HU2!n3!n4!n1!n15!n1!n
			'IE' => '/^IE\d{2}[A-Z]{4}\d{6}\d{8}$/', //IE2!n4!a6!n8!n
			'IL' => '/^IL\d{2}\d{3}\d{3}\d{13}$/', //IL2!n3!n3!n13!n
			'IQ' => '/^IQ\d{2}[A-Z]{4}\d{3}\d{12}$/', //IQ2!n4!a3!n12!n
			'IS' => '/^IS\d{2}\d{4}\d{2}\d{6}\d{10}$/', //IS2!n4!n2!n6!n10!n
			'IT' => '/^IT\d{2}[A-Z]\d{5}\d{5}[A-Za-z0-9]{12}$/', //IT2!n1!a5!n5!n12!c
			'JO' => '/^JO\d{2}[A-Z]{4}\d{4}[A-Za-z0-9]{18}$/', //JO2!n4!a4!n18!c
			'KW' => '/^KW\d{2}[A-Z]{4}[A-Za-z0-9]{22}$/', //KW2!n4!a22!c
			'KZ' => '/^KZ\d{2}\d{3}[A-Za-z0-9]{13}$/', //KZ2!n3!n13!c
			'LB' => '/^LB\d{2}\d{4}[A-Za-z0-9]{20}$/', //LB2!n4!n20!c
			'LC' => '/^LC\d{2}[A-Z]{4}[A-Za-z0-9]{24}$/', //LC2!n4!a24!c
			'LI' => '/^LI\d{2}\d{5}[A-Za-z0-9]{12}$/', //LI2!n5!n12!c
			'LT' => '/^LT\d{2}\d{5}\d{11}$/', //LT2!n5!n11!n
			'LU' => '/^LU\d{2}\d{3}[A-Za-z0-9]{13}$/', //LU2!n3!n13!c
			'LV' => '/^LV\d{2}[A-Z]{4}[A-Za-z0-9]{13}$/', //LV2!n4!a13!c
			'MC' => '/^MC\d{2}\d{5}\d{5}[A-Za-z0-9]{11}\d{2}$/', //MC2!n5!n5!n11!c2!n
			'MD' => '/^MD\d{2}[A-Za-z0-9]{2}[A-Za-z0-9]{18}$/', //MD2!n2!c18!c
			'ME' => '/^ME\d{2}\d{3}\d{13}\d{2}$/', //ME2!n3!n13!n2!n
			'MK' => '/^MK\d{2}\d{3}[A-Za-z0-9]{10}\d{2}$/', //MK2!n3!n10!c2!n
			'MR' => '/^MR\d{2}\d{5}\d{5}\d{11}\d{2}$/', // MR2!n5!n5!n11!n2!n
			'MT' => '/^MT\d{2}[A-Z]{4}\d{5}[A-Za-z0-9]{18}$/', //MT2!n4!a5!n18!c
			'MU' => '/^MU\d{2}[A-Z]{4}\d{2}\d{2}\d{12}\d{3}[A-Z]{3}$/', //MU2!n4!a2!n2!n12!n3!n3!a
			'NL' => '/^NL\d{2}[A-Z]{4}\d{10}$/', //NL2!n4!a10!n
			'NO' => '/^NO\d{2}\d{4}\d{6}\d$/', //NO2!n4!n6!n1!n
			'PK' => '/^PK\d{2}[A-Z]{4}[A-Za-z0-9]{16}$/', //PK2!n4!a16!c
			'PL' => '/^PL\d{2}\d{8}\d{16}$/', //PL2!n8!n16!n
			'PS' => '/^PS\d{2}[A-Z]{4}[A-Za-z0-9]{21}$/', //PS2!n4!a21!c
			'PT' => '/^PT\d{2}\d{4}\d{4}\d{11}\d{2}$/', //PT2!n4!n4!n11!n2!n
			'QA' => '/^QA\d{2}[A-Z]{4}[A-Za-z0-9]{21}$/', //QA2!n4!a21!c
			'RO' => '/^RO\d{2}[A-Z]{4}[A-Za-z0-9]{16}$/', //RO2!n4!a16!c
			'RS' => '/^RS\d{2}\d{3}\d{13}\d{2}$/', //RS2!n3!n13!n2!n
			'SA' => '/^SA\d{2}\d{2}[A-Za-z0-9]{18}$/', //SA2!n2!n18!c
			'SC' => '/^SC\d{2}[A-Z]{4}\d{2}\d{2}\d{16}[A-Z]{3}$/', //SC2!n4!a2!n2!n16!n3!a
			'SE' => '/^SE\d{2}\d{3}\d{16}\d{1}$/', //SE2!n3!n16!n1!n
			'SI' => '/^SI\d{2}\d{5}\d{8}\d{2}$/', //SI2!n5!n8!n2!n
			'SK' => '/^SK\d{2}\d{4}\d{6}\d{10}$/', //SK2!n4!n6!n10!n
			'SM' => '/^SM\d{2}[A-Z]\d{5}\d{5}[A-Za-z0-9]{12}$/', //SM2!n1!a5!n5!n12!c
			'ST' => '/^ST\d{2}\d{4}\d{4}\d{11}\d{2}$/', //ST2!n4!n4!n11!n2!n
			'SV' => '/^SV\d{2}[A-Z]{4}\d{20}$/', //SV2!n4!a20!n
			'TL' => '/^TL\d{2}\d{3}\d{14}\d{2}$/', //TL2!n3!n14!n2!n
			'TN' => '/^TN\d{2}\d{2}\d{3}\d{13}\d{2}$/', //TN2!n2!n3!n13!n2!n
			'TR' => '/^TR\d{2}\d{5}\d[A-Za-z0-9]{16}$/', //TR2!n5!n1!n16!c
			'UA' => '/^UA\d{2}\d{6}[A-Za-z0-9]{19}$/', //UA2!n6!n19!c
			'VA' => '/^VA\d{2}\d{3}\d{15}$/', //VA2!n3!n15!n
			'VG' => '/^VG\d{2}[A-Z]{4}\d{16}$/', //VG2!n4!a16!n
			'XK' => '/^XK\d{2}\d{4}\d{10}\d{2}$/' //XK2!n4!n10!n2!n
		);

		return array_key_exists( $country_code, $patterns ) ? $patterns[$country_code] : null;
	}

	/**
	 * $electronic must be a string without spaces.
	 */
	public static function check_control_digit( $electronic )
	{
		if( empty( $electronic ) || !is_string( $electronic ) )
			return false;

		$electronic = strtoupper( $electronic );
		$chars = str_split( substr( $electronic, 4 ) . substr( $electronic, 0, 4 ) );
		$numbers = array( 'A' => '10', 'B' => '11', 'C' => '12', 'D' => '13', 'E' => 14, 'F' => '15', 'G' => '16', 'H' => '17', 'I' => '18', 'J' => '19', 'K' => '20', 'L' => '21', 'M' => '22', 'N' => '23', 'O' => '24', 'P' => '25', 'Q' => '26', 'R' => '27', 'S' => '28', 'T' => '29', 'U' => '30', 'V' => '31', 'W' => '32', 'X' => '33', 'Y' => '34', 'Z' => '35' );
		$number_str = '';

		foreach( $chars as $char )
		{
			if( !is_numeric( $char ) )
				$char = $numbers[$char];

			$number_str .= $char;
		}

		if( function_exists( 'bcmod' ) )
			return bcmod( $number_str, '97') == 1;
		else
			return self::mod( $number_str, 97 ) == 1;
			//return fmod( (float)$number_str, 97 ) == 1;
	}

	protected static function mod( $number_str, $divisor )
	{
		$number_str = preg_replace( '/\D/', '', $number_str );
		$number_str = preg_replace( '/^0*/', '', $number_str );

		$divisor = (int)$divisor;
		$mod = 0;

		$chars = str_split( $number_str );

		for( $i = 0; $i < count( $chars ); $i++ )
		{
			$digit = (int)$chars[$i];

			$mod = $mod * 10 + $digit;

			$mod = $mod % $divisor;
		}
		
		return $mod;
	}

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$help = null,
		$country = null, // IBAN prefix country code (ISO 3166). null for all countries
		$single_field = false,
		$id = null,
		$class = null,
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			$value,
			$label,
			"iban",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->help = $help;

		$this->country = is_string( $country ) ? strtoupper( $country ) : null;
		$this->single_field = $single_field;
	}

	public function get_help()
	{
		return $this->help;
	}

	public function get_country()
	{
		return $this->country;
	}

	public function is_single_field()
	{
		return $this->single_field;
	}

	// These print methods are added to allow template files
	// access the static methods (TODO: deberías quitar los SELF y ahorrarte esto )
	public function print_admin( $wrapped = true )
	{
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', $this->get_type() . '.php' ) ) );
	}
	public function print_public()
	{
		include( $this->look_for_field( $this->get_type() . '.php' ) );
	}

	public function read_values_from_request( $method )
	{
		$val = parent::read_values_from_request( $method );

		if( is_array( $val ) )
			return implode( '', $val );
		else
			return $val;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( !empty( $val ) || $this->is_required() )
		{
			if( !is_string( $val ) )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Field %s contains invalid data.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);

			$electronic = preg_replace( '/\s/', '', sanitize_text_field( $val ) );
			// Convert to uppercase country code to avoid error to the user
			$electronic = strtoupper( substr( $electronic, 0, 2 ) ) . substr( $electronic, 2 );

			$country_code = $this->get_country();

			if( empty( $country_code ) )
			{
				$valid_digit = self::check_control_digit( $electronic );
			}
			else
			{
				$countries = self::get_countries();
				if( !array_key_exists( $country_code, $countries ) )
				{
					JLCCustomForm::notify_administrators(
						JLCCustomForm::FATAL_ERROR,
						sprintf( __( '%s field of type IBAN is missconfigured: Country %s is not available.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $country_code ),
						debug_backtrace()
					);

					return array(
						'code' => JLCCustomForm::FATAL_ERROR,
						'text' => __( 'There was an error. Please try again later.', JLCCustomForm::TEXT_DOMAIN )
					);
				}
				
				$pattern = self::get_country_pattern( $country_code );
				if( !preg_match( $pattern, $electronic ) )
					return array(
						'code' => JLCCustomForm::FORM_DATA_ERROR,
						'text' => sprintf( __( '%s field is not a valid IBAN for %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label(), $countries[$country_code] )
					);
					
	//echo '<p><strong>' . $country_code . '</strong></p>';
				$valid_digit = self::check_control_digit( $electronic );
			}

			if( !$valid_digit )
				return array(
					'code' => JLCCustomForm::FORM_DATA_ERROR,
					'text' => sprintf( __( 'Invalid IBAN in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
				);
		}
		
		$this->set_value( $electronic );
		
		return null;
	}
}

} //class_exists
