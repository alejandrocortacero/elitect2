<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

/**
 * This class is used to embed code within Wordpress forms. 
 *
 * A container form is the form where the partial form is
 * embedded. Not to be confused with the parent form.
 */

if( !class_exists( 'JLCPartialForm' ) )
{

if( !class_exists( 'JLCCustomForm' ) )
	require_once( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'form.php' ) ) ) );

abstract class JLCPartialForm extends JLCCustomForm
{
	public function __construct(
		$base_dir,
		$internal_id,
		$text_domain = null,
		$action = "",
		$wordpress_method = true,
		$private = false
	) {
		parent::__construct(
			$base_dir,
			$internal_id,
			$text_domain,
			$action,
			false,//$ajax,
			$wordpress_method,
			null,//$return_url,
			$private,
			null,//$enctype,
			null,//$method,
			null,//$id,
			null,//$class,
			null//$transient_time
		);
	}

	public abstract function register_hooks();

	/**
	 * This method is empty in this class, like
	 * if it was abstract.
	 */ 
	protected function initialize_form_reading()
	{
		if( $this->wordpress_method )
		{
			$this->initialize_data_fields_reading();
		}
	}

	
	public function print_public_form( $hide_messages = false )
	{
		$this->print_public_form_body();

/*
		$this->enqueue_global_script();
		$this->enqueue_global_ajax_script();
		$this->enqueue_password_script();
*/
	}

	public function print_admin_form( $readonly_form = false )
	{
		$this->print_admin_form_body();

/*
		$this->enqueue_global_script();
		$this->enqueue_global_ajax_script();
		$this->enqueue_password_script();
*/
	}
}

} // class_exists

