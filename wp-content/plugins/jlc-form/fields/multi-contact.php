<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormMultiContactField', false ) )
{

if( !class_exists( 'AbstractJLCCustomFormField', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

class JLCCustomFormMultiContactField extends AbstractJLCCustomFormField
{
	protected $help;

	protected $addresses;

	public function __construct(
		$name,
		$value = null,
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
			$value,
			$label,
			"multi-contact",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->help = $help;

		$this->addresses = $this->parse_addresses( $value );
	}

	public function get_help()
	{
		return $this->help;
	}

	public function get_addresses()
	{
		return $this->addresses;
	}

	protected function parse_addresses( $value )
	{
		$addresses = array();
		$value = json_decode( $value, true );
		if( is_array( $value ) )
		{
			foreach( $value as $addr )
			{
				$addresses[] = array(
					'city' => isset( $addr['city'] ) && is_string( $addr['city'] ) ? $addr['city'] : '',
					'state' => isset( $addr['state'] ) && is_string( $addr['state'] ) ? $addr['state'] : '',
					'postcode' => isset( $addr['postcode'] ) && is_string( $addr['postcode'] ) ? $addr['postcode'] : '',
					'country' => isset( $addr['country'] ) && is_string( $addr['country'] ) ? $addr['country'] : '',
					'address' => isset( $addr['address'] ) && is_string( $addr['address'] ) ? $addr['address'] : '',
					'longitude' => isset( $addr['longitude'] ) && is_string( $addr['longitude'] ) ? $addr['longitude'] : '',
					'latitude' => isset( $addr['latitude'] ) && is_string( $addr['latitude'] ) ? $addr['latitude'] : '',
					'email' => isset( $addr['email'] ) && is_string( $addr['email'] ) ? $addr['email'] : '',
					'phone' => isset( $addr['phone'] ) && is_string( $addr['phone'] ) ? $addr['phone'] : ''
				);
			}
		}

		return $addresses;
	}

	public function get_value()
	{
		return json_encode( $this->get_addresses() );
	}

	public function set_value( $value )
	{
		$this->addresses = $this->parse_addresses( $value );
	}

	public function print_admin( $wrapped = true )
	{
		parent::print_admin( $wrapped );

		wp_enqueue_script(
			'jlc-custom-form-multi-select-field-js',
			plugins_url( 'templates/js/multi-contact.js', __FILE__ ),
			array( 'jquery' ),
			JLCCustomForm::VERSION,
			true
		);
		wp_localize_script(
			'jlc-custom-form-multi-select-field-js',
			'JLCCustomFormMultiContactNamespace',
			array(
				'contact' => __( 'Contact', JLCCustomForm::TEXT_DOMAIN ),
				'remove' => __( 'Remove', JLCCustomForm::TEXT_DOMAIN )
			)
		);

		add_action( 'admin_print_footer_scripts', array( get_class(), 'add_admin_style' ) );
	}

	public static function add_admin_style()
	{
		$data = '<style>.jlc-custom-form-multi-contact-table th{padding:8px 10px;}.jlc-custom-form-multi-contact-table td{padding:8px 10px;}</style>';

		echo $data;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( !is_string( $val ) )
			return array(
				'code' => JLCCustomForm::FORM_DATA_ERROR,
				'text' => sprintf( __( 'Field %s contains invalid data.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
			);

		$this->set_value( stripslashes( $val ) );

		return null;
	}
}

} //class_exists
