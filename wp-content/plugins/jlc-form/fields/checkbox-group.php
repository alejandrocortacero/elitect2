<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormCheckboxGroup' ) )
{

if( !class_exists( 'JLCCustomFormFieldsGroup' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'group.php' );

if( !class_exists( 'JLCCustomFormCheckboxField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'checkbox.php' );

if( !trait_exists( 'JLCCustomFormPrintableField', false ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'traits', 'printable-field.php' ) ) );

class JLCCustomFormCheckboxGroup extends JLCCustomFormFieldsGroup
{
	use JLCCustomFormPrintableField;

	protected $required;

	public function __construct(
		$name,
		$label = "",
		$required = false,
		$options = array(),
		$id = null,
		$class = null
	)
	{
		parent::__construct( $label, $options, $id, $class );

		$this->name = $name;

		$this->required = $required;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_type()
	{
		return 'checkbox-group';
	}

	public function get_id()
	{
		return $this->id;
	}

	public function get_class()
	{
		return $this->class;
	}

	public function is_required()
	{
		return $this->required;
	}

	public function get_value()
	{
		$ret = array();

		foreach( $this->options as $option )
			if( $option->is_checked() )
				$ret[] = $option->get_value();

		return $ret;
	}

	public function set_value( $values )
	{
		foreach( $this->options as $option )
			$option->set_checked( in_array( $option->get_value(), $values ) );
	}

	public function enqueue_field_script( $admin = false )
	{
		if( !wp_script_is( 'jlc-custom-form-checkbox-group-script', 'enqueued' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-checkbox-group-script',
				plugins_url( '/templates/js/checkbox-group.js', __FILE__ ),
				array( 'jquery', 'jlc-custom-form-global-js' ),
				JLCCustomForm::VERSION,
				true
			);
		}
	}

	/**
	 * Do not specify id unless strictly necessary
	 */
	public function add_checkbox( $args = array() )
	{
		$current = count( $this->get_options() );
		$current++;

		if( !isset( $args['id'] ) )
			$args['id'] = sprintf( '%s-%d', $this->get_name(), $current );


		$field = JLCCustomFormFieldLoader::get_checkbox_field(
			sprintf( '%s[]', $this->get_name() ),
			$args
		);

		return $this->add_option( $field );
	}

	public function read_values_from_request( $method )
	{
		if( $method == 'POST' )
			$input = isset( $_POST[ $this->get_name() ] ) ? $_POST[ $this->get_name() ] : null;
		else
			$input = isset( $_GET[ $this->get_name() ] ) ? $_GET[ $this->get_name() ] : null;

		return is_array( $input ) ? $input : array();
	}

	public function read_request( $val )
	{
		foreach( $this->get_options() as $option )
			if( $option->is_required() && ( !is_array( $val ) || !in_array( $option->get_value(), $val ) ) )
				return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'The option %s in %s must be selected.', JLCCustomForm::TEXT_DOMAIN ), $option->get_label(), $this->get_label() ) );

		foreach( $this->get_options() as $option )
			if( null !== ( $ret = $option->read_request( is_array( $val ) && ( false !== ( $key = array_search( $option->get_value(), $val ) ) ) ? $val[$key] : null ) ) )
				return $ret;


		return null;
	}

}

} //class_exists


