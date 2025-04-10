<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormOption' ) )
{

class JLCCustomFormOption
{
	protected $value;
	protected $label;
	protected $selected;
	protected $disabled;

	public function __construct(
		$value = "",
		$label = "",
		$selected = false,
		$disabled = false
	) {
		$this->value = $value;

		$this->label = $label;

		$this->selected = $selected;

		$this->disabled = $disabled;
	}

	public function get_value()
	{
		return $this->value;
	}

	public function get_label()
	{
		return $this->label;
	}

	public function is_selected()
	{
		return $this->selected;
	}

	public function set_selected( $selected )
	{
		$this->selected = $selected;
	}
	
	public function is_disabled()
	{
		return $this->disabled;
	}
}

} //class_exists


