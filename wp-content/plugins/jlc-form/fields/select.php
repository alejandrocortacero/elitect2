<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormSelectField', false ) )
{

if( !class_exists( 'AbstractJLCCustomFormField', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'abstract-field.php' );

if( !class_exists( 'JLCCustomFormOption', false ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'option.php' );

class JLCCustomFormSelectField extends AbstractJLCCustomFormField
{
	protected $options;

	protected $groups;

	protected $multiple;
	protected $allows_new_options;

	protected $help;

	protected $user_selection;// Used when $allows_new_options == true

	public function __construct(
		$name,
		$options = array(),
		$multiple = false,
		$allows_new_options = false,
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
			"",
			$label,
			"select",
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		if( !is_array( $options ) )
			$options = array();

		$this->options = array();

		foreach( $options as $opt )
		{
			if( is_a( $opt, 'JLCCustomFormOption' ) )
			{
				$this->options[] = $opt;
			}
			elseif( is_array( $opt ) && isset( $opt['value'] ) && isset( $opt['label'] ) )
			{
				$this->add_option(
					$opt['value'],
					$opt['label'],
					array(
						'selected' => isset( $opt['selected'] ) ? $opt['selected'] : false,
						'disabled' => isset( $opt['disabled'] ) ? $opt['disabled'] : false,
						'group' => isset( $opt['group'] ) ? $opt['group'] : null
					)
				);
			}
		}

		$this->groups = array();

		$this->multiple = $multiple;
		$this->allows_new_options = $allows_new_options;

		$this->help = $help;

		$this->user_selection = $multiple ? array() : null;
	}

	public function is_multiple()
	{
		return $this->multiple;
	}

	public function allows_new_options()
	{
		return $this->allows_new_options;
	}

	public function get_help()
	{
		return $this->help;
	}

	public function get_options()
	{
		return $this->options;
	}

	public function add_option( $value, $label, $args = array() )
	{
		$new_option = new JLCCustomFormOption(
			$value,
			$label,
			isset( $args['selected'] ) ? $args['selected'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false
		);

		$this->options[] = $new_option;

		if( !empty( $args['group'] ) )
			$this->add_option_to_group( $new_option, $args['group'] );
	}

	public function prepend_option( $value, $label, $args = array() )
	{
		$new_option = new JLCCustomFormOption(
			$value,
			$label,
			isset( $args['selected'] ) ? $args['selected'] : false,
			isset( $args['disabled'] ) ? $args['disabled'] : false
		);

		$this->options = array_merge( array( $new_option ), $this->options );

		if( !empty( $args['group'] ) )
			$this->add_option_to_group( $new_option, $args['group'] );
	}

	public function clear_options()
	{
		$this->options = array();
	}

	public function get_groups()
	{
		return $this->groups;
	}

	public function set_groups( $groups )
	{
		$this->groups = $groups;
	}

	public function add_group( $key, $label )
	{
		$this->groups[$key] = array( 'label' => $label, 'options' => array() );
	}

	public function add_option_to_group( $option, $group )
	{
		if( $group &&
			array_key_exists( $group, $this->get_groups() )
		) {
			$this->groups[$group]['options'][] = $option;
		}
	}

	public function get_ungrouped_options()
	{
		$options = $this->get_options();
		$groups = $this->get_groups();
		$ret = array();

		foreach( $options as $option )
		{
			$in_group = false;

			foreach( $groups as $group )
			{
				if( in_array( $option, $group['options'] ) )
				{
					$in_group = true;
					break;
				}
			}

			if( !$in_group )
				$ret[] = $option;
		}

		return $ret;
	}

	public function get_value()
	{
		if( !$this->allows_new_options() )
		{
			if( !$this->is_multiple() )
			{
				foreach( $this->get_options() as $option )
					if( $option->is_selected() )
						return $option->get_value();

				return null;
			}
			else
			{
				$ret = array();

				foreach( $this->get_options() as $option )
					if( $option->is_selected() )
						$ret[] = $option->get_value();

				return $ret;
			}
		}
		else
		{
			return $this->user_selection;
		}
	}

	public function set_value( $value )
	{
		$this->select_value( $value );
	}

	public function select_value( $value )
	{
		if( !$this->allows_new_options() )
		{
			foreach( $this->get_options() as $option )
				$option->set_selected(
					$this->is_multiple() && is_array( $value ) ?
						in_array( $option->get_value(), $value ) :
						$option->get_value() == $value
				);
		}
		else
		{
			$this->user_selection = $value;
		}
	}
	
	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( ( $this->is_multiple() && !is_array( $val ) && $val !== null ) ||
			( !$this->is_multiple() && is_array( $val ) ) )
			return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'The field %s must contain a valid selection.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );

		$this->select_value( $val );
	}
}

} //class_exists

