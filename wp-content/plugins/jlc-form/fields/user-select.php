<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormUserSelectField' ) )
{

if( !class_exists( 'JLCCustomFormSelectField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'select.php' );


class JLCCustomFormUserSelectField extends JLCCustomFormSelectField
{
	protected $preselected;
	protected $query_args;

	public function __construct(
		$name,
		$preselected = array(),
		$query_args = array(),
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
			false,//allow new options
			$label,
			$help,
			$id,
			$class,
			$required,
			$disabled,
			$readonly
		);

		$this->preselected = $preselected;
		$this->query_args = $query_args;

		$this->load_users();
	}

	public function set_query_args( $query_args )
	{
		$this->query_args = $query_args;
	}

	public function load_users()
	{
		if( !$this->is_required() && !$this->is_multiple() )
			$this->add_option(
				'0',
				__( 'None', JLCCustomForm::TEXT_DOMAIN ),
				array(
					'selected' => empty( $this->preselected )
				)
			);

		if( function_exists( 'get_users' ) )
		{
			$users = get_users( $this->query_args );
			foreach( $users as $user )
			{
				$this->add_option(
					$user->ID,
					$user->display_name,
					array(
						'selected' => $this->is_multiple() && is_array( $this->preselected ) ? in_array( $user->ID, $this->preselected ) : $user->ID == $this->preselected
					)
				);
			}
		}
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		$users = get_users( $this->query_args );
		foreach( $this->get_options() as $option )
		{
			if( $option->is_selected() && !empty( $option->get_value() ) )
			{
				$included = false;
				foreach( $users as $user )
				{
					if( $user->ID == $option->get_value() )
					{
						$included = true;
						break;
					}
				}

				if( !$included )
					return array( 'code' => JLCCustomForm::FORM_DATA_ERROR, 'text' => sprintf( __( 'Selection in %s is not valid.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() ) );
			}
		}

		return null;
	}
}

} // class_exists


