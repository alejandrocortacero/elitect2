<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCPostMetaBoxForm' ) )
{

if( !class_exists( 'JLCPartialForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'partial-form.php' ) ) ) );

abstract class JLCPostMetaBoxForm extends JLCPartialForm
{
	protected static $printed_forms = array();

	protected $meta_box_title;
	protected $post_type;

	protected $meta_box_id;
	protected $meta_box_context;
	protected $meta_box_priority;

	protected $editing_post;

	public function __construct(
		$base_dir,
		$internal_id,
		$text_domain = null,

		$meta_box_title,
		$post_type,

		$meta_box_id = null,
		$meta_box_context = 'side',
		$meta_box_priority = 'low'

	) {
		parent::__construct(
			$base_dir,
			$internal_id,
			$text_domain,
			$internal_id,//$action,
			true,//$wordpress_method,
			true//$private
		);

		$this->meta_box_title = $meta_box_title;
		$this->post_type = $post_type;

		$this->meta_box_id = is_string( $meta_box_id ) ? $meta_box_id : $internal_id;
		$this->meta_box_context = $meta_box_context;
		$this->meta_box_priority = $meta_box_priority;

		$this->editing_post = !empty( $_GET['post'] ) && is_numeric( $_GET['post'] ) ? (int)$_GET['post'] : null;
	}

	protected static function get_selector_line( $ides, $selector )
	{
		$arr = array();
		foreach( $ides as $id )
		{
			$arr[] = $id . ' ' . $selector;
		}

		return implode( ',', $arr );
	}

	public static function print_fields_style()
	{
		$meta_box_ides = array();
		foreach( self::$printed_forms as $pf )
		{
			$meta_box_ides[] = '#' . $pf;
		}

		include( self::get_default_template_path( implode( DIRECTORY_SEPARATOR, array( 'admin', 'css', 'post-meta-box-form.php' ) ) ) );
	}

	public function register_hooks()
	{
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 10, 2);

		//add_action( 'save_post', array( $this, 'save_post' ), 10, 3 );
		add_action( 'post_updated', array( $this, 'save_post' ), 10, 3 );

		if( $this->enctype == 'multipart/form-data' )
			add_action( 'post_edit_form_tag', function($post){ echo ' enctype="multipart/form-data"'; }, 10, 1 );

		add_action( 'admin_notices', array( $this, 'print_admin_notices' ) );
	}

	public function add_meta_boxes( $post_type, $post )
	{
		if( is_array( $this->post_type ) && !in_array( $post_type, $this->post_type ) )
			return;

		if( is_string( $this->post_type ) && $post_type != $this->post_type )
			return;

		add_meta_box(
			$this->meta_box_id,
			$this->meta_box_title,
			array( $this, 'print_meta_box' ),
			$this->post_type,
			$this->meta_box_context,
			$this->meta_box_priority
		);
	}

	public function print_meta_box()
	{
		$this->preload_field_values_from_transient();

		foreach( $this->fields as $key => $field )
		{
			$field->print_admin( false );
		}

		$this->enqueue_global_script();
		$this->enqueue_global_ajax_script();
		$this->enqueue_password_script();

		if( !has_action( 'admin_footer', array( get_class(), 'print_fields_style' ) ) )
			add_action( 'admin_footer', array( get_class(), 'print_fields_style' ) );

		self::$printed_forms[] = $this->meta_box_id;
	}

	//public function save_post( $post_id, $post, $update )
	public function save_post( $post_id, $post_after, $post_before )
	{
		if( is_string( $this->post_type ) && $this->post_type !== get_post_type( $post_id ) )
			return;

		if( is_array( $this->post_type ) && !in_array( get_post_type( $post_id ), $this->post_type ) )
			return;

		if( !isset( $_REQUEST['action'] ) || $_REQUEST['action'] != 'editpost' )
			return;

		$this->editing_post = $post_id;

		if( $this->load_values_from_request() )
		{
			if( ( $result = $this->process_form() ) !== null )
			{
				$this->store_response( $result );
			}
		}
	}
}

} // class_exists
