<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormPostSelectField' ) )
{

if( !class_exists( 'JLCCustomFormSelectField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'select.php' );


class JLCCustomFormPostSelectField extends JLCCustomFormSelectField
{
	protected $preselected;
	protected $query_args;

	protected $none_label;

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

		$this->none_label = null;

		$this->load_posts();
	}

	public function get_none_label()
	{
		return !empty( $this->none_label ) ? $this->none_label : __( 'None', JLCCustomForm::TEXT_DOMAIN );
	}

	public function set_none_label( $label )
	{
		$this->none_label = $label;
	}

	public function set_query_args( $query_args )
	{
		$this->query_args = $query_args;
	}

	public function load_posts()
	{
		if( !$this->is_required() && !$this->is_multiple() )
			$this->add_option(
				'0',
				$this->get_none_label(),
				array(
					'selected' => empty( $this->preselected )
				)
			);

		if( function_exists( 'get_posts' ) )
		{
			$posts = get_posts( $this->query_args );
			foreach( $posts as $post )
			{
				$this->add_option(
					$post->ID,
					$post->post_title,
					array(
						'selected' => $this->is_multiple() && is_array( $this->preselected ) ? in_array( $post->ID, $this->preselected ) : $post->ID == $this->preselected
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

		$posts = get_posts( $this->query_args );
		foreach( $this->get_options() as $option )
		{
			if( $option->is_selected() && !empty( $option->get_value() ) )
			{
				$included = false;
				foreach( $posts as $post )
				{
					if( $post->ID == $option->get_value() )
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

