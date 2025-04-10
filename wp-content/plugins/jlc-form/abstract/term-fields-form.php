<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCTermFieldsForm' ) )
{

if( !class_exists( 'JLCPartialForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'partial-form.php' ) ) ) );

abstract class JLCTermFieldsForm extends JLCPartialForm
{
	//protected static $printed_forms = array();

	protected $taxonomy;

	protected $include_in;

	protected $add_priority;
	protected $edit_priority;

	protected $editing_term;

	public function __construct(
		$base_dir,
		$internal_id,
		$text_domain = null,

		$taxonomy = 'category',

		$include_in = 'both',

		$add_priority = 10,
		$edit_priority = 10
	) {
		parent::__construct(
			$base_dir,
			$internal_id,
			$text_domain,
			$internal_id,//$action,
			true,//$wordpress_method,
			true//$private
		);

		$this->taxonomy = $taxonomy;

		$this->include_in = $include_in;

		$this->add_priority = $add_priority;
		$this->edit_priority = $edit_priority;

		$this->editing_term = !empty( $_GET['tag_ID'] ) && is_numeric( $_GET['tag_ID'] ) ? $_GET['tag_ID'] : null;
	}
/*
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
*/
	protected function get_taxonomy()
	{
		return $this->taxonomy;
	}

	protected function get_include_in()
	{
		return $this->include_in;
	}

	protected function get_add_priority()
	{
		return $this->add_priority;
	}

	protected function get_edit_priority()
	{
		return $this->edit_priority;
	}

	public function register_hooks()
	{
		$include_in = $this->get_include_in();

		if( $include_in === 'both' || $include_in === 'add' )
		{
			add_action( $this->get_taxonomy() . '_add_form_fields', array( $this, 'add_term_form_fields'), $this->get_add_priority(), 1 );
			add_action( 'created_' . $this->get_taxonomy(), array( $this, 'save_created_term' ), 10, 2 );
		}

		if( $include_in === 'both' || $include_in === 'edit' )
		{
			add_action( $this->get_taxonomy() . '_edit_form_fields', array( $this, 'edit_term_form_fields'), $this->get_edit_priority(), 2 );
			add_action( 'edited_' . $this->get_taxonomy(), array( $this, 'save_edited_term' ), 10, 2 );
		}

		

/*
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 10, 2);

		//add_action( 'save_post', array( $this, 'save_post' ), 10, 3 );
		add_action( 'post_updated', array( $this, 'save_post' ), 10, 3 );

		if( $this->enctype == 'multipart/form-data' )
			add_action( 'post_edit_form_tag', function($post){ echo ' enctype="multipart/form-data"'; }, 10, 1 );

		add_action( 'admin_notices', array( $this, 'print_admin_notices' ) );
*/
	}

	public function add_term_form_fields( $taxonomy )
	{
		foreach( $this->get_fields() as $key => $field )
		{
			echo '<div class="form-field">';
			$field->print_admin( false );
			echo '</div>';
		}

		$this->enqueue_global_script();
		$this->enqueue_global_ajax_script();
		$this->enqueue_password_script();

		wp_enqueue_script(
			'jlc-custom-form-term-fields-ajax-js',
			plugins_url( '/templates/js/term-fields-form.js', realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'jlc-form.php' ) ),
			array( 'jquery' ),
			self::VERSION,
			true
		);
	}

	public function edit_term_form_fields( $term, $taxonomy )
	{
		$this->preload_field_values_from_transient();

		foreach( $this->get_fields() as $key => $field )
		{
			$field->print_admin( true );
		}

		$this->enqueue_global_script();
		$this->enqueue_global_ajax_script();
		$this->enqueue_password_script();
	}

	public function save_created_term( $term_id, $tt_id )
	{
		$this->editing_term = $term_id;

		if( $this->load_values_from_request() )
		{
			if( ( $result = $this->process_form() ) !== null )
			{
				$this->store_response( $result );
			}
		}
	}

	public function save_edited_term( $term_id, $tt_id )
	{
		$this->save_created_term( $term_id, $tt_id );
	}

	/**
	 * Saves the fields values in term meta using
	 * fields names as keys.
	 *
	 * Maybe you need to overwrite this method. 
	 */
	public function process_form()
	{
		$term_id = $this->editing_term;

		foreach( $this->get_data_fields() as $field  )
			update_term_meta( $term_id, $field->get_name(), $field->get_value() );
		
		return null;
	}

/*
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
*/

}

} // class_exists
