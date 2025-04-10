<?php
/**
 * Plugin Name: JLC Customizable Forms
 * Plugin URI:
 * Description: Plugin for developers. Provides logic for easy form creation with OOP.
 * Version: 1.4.21
 * Author: JLC
 * AUthor URI: www.jlc.es
 * Text Domain: jlc-custom-form-textdomain
 * License: EULA
 */

// Version 1.2.6 - Checkboxes get their status from transient
// Version 1.3.0 - Fields get values through read_values_from_request( $method )
//				 - new interface JLCCustomFormElement
//				 - IBAN field addedd
//				 - notify_administrators included (empty)
// Version 1.3.1 - Allow Downloads
// Version 1.3.2 - No required numbers fixed
// Version 1.4.0 - Field loader added
//				 - AdminSettingsTabbedForm added
//				 - FieldsArray added
// Version 1.4.1 - Reloads fields values at process_forms errors
// Version 1.4.2 - New color field
// Version 1.4.3 - getCurrentUrl() modified
// Version 1.4.4 - upload ajax files
// Version 1.4.5 - tinymce field extended
//				 - password toggle added (need more work)
// Version 1.4.6 - get_current_url() REDIRECT_URL option corrected
// Version 1.4.7 - font selector added
// Version 1.4.8 - public ajax upload images
//				 - datalist added to text field and subclasses
// Version 1.4.9 - public ajax upload images with position
//				 - selection window for ajax upload images
//				 - background field added with opacity
// Version 1.4.10 - jquery slider abstract added
//				 - jquery slider simple added
//				 - background field: several opacity options (number and slider)
// Version 1.4.11 - upload ajax image field: action 'jlc_custom_form_upload_ajax_image_process_uploaded' added
// Version 1.4.12 - upload ajax image field: action 'jlc_custom_form_upload_ajax_image_pre_upload' added
//				  - upload ajax image field: action 'jlc_custom_form_upload_ajax_image_post_upload' added
// Version 1.4.13 - tinymce args are included in namespace
// Version 1.4.14 - HTML field option for no kses
// Version 1.4.15 - ajax.js: FormData(f.context) has been changed to FormData(f[0])
// Version 1.4.16 - select fields can accept options defined by user
// Version 1.4.17 - upload ajax image multiple field added
//					jlc_custom_form_upload_ajax_image_preview_size filter added
//					file validation added for upload-ajax-image field
//					upload-ajax.js pass the form instead the field as 3rd argument to readAjaxResponse (WATCH THIS)
//					upload-ajax-image field send given image size (jlc_custom_form_upload_ajax_image_preview_size filter) in AJAX request (before sends full image)
// Version 1.4.18 - checkboxesGroup is prepared to work
//					printable-field trait added and used only in checkboxesGroup (no recuredo por que decidi no usar traits)
//					class jlc-custom-form added to all forms
//					class jlc-custom-ajax-form added to admin forms
//					class jlc-custom-ajax-form added to admin settings tabbed forms
//					global.js added (allows to check extra validation for own fields or user custom
//					added yes_no_radio_group (not new field, only add options by default)
//					in global.js and ajax.js: Can be add ajaxResponseReaders for non default actions
//					email field: empty values are allowed if not required
// Version 1.4.19 - added filter in field upload-ajax-image at procces_ajax_upload_image() in succces: jlc_custom_form_update_ajax_image_upload_response
//					see get_current_url() method
//					remover break at field processing in initialize_reading()
// Version 1.4.20 - upload-ajax-image.php accepts capitalized extensions
// Version 1.4.21 - upload-ajax-image.php has new filter to image URL: jlc_custom_form_upload_ajax_image_field_url
//					upload-ajax.js function has been encapsulated in JLCCustomFormUploadAjaxImage
defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomForm' ) )
{

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'request-reader.php' ) ) );

if( !class_exists( 'JLCCustomFormFieldLoader', false ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'FieldLoader.php' ) ) );

abstract class JLCCustomForm
{
	const VERSION = '1.4.21';

	const TEXT_DOMAIN = 'jlc-custom-form-textdomain';

	const FORM_DATA_ERROR 			= 1;
	const FATAL_ERROR 				= 2;
	const MAX_UPLOAD_SIZE_ERROR		= 3;
	const INVALID_UPLOAD_FORMAT_ERROR = 4;
	const AJAX_FIELD_ERROR			= 5;

	const SENT_SUCCESSFULLY				= 1001;
	const PERSONAL_DATA_SUCCESSFULLY 	= 1002;

	const ADMIN_SETTINGS_PAGE_SLUG = 'jlc_custom_forms_settings_page';

	const REGISTERED_FORMS_KEY	= 'jlc_custom_forms_registered_forms';
	const ADMIN_REGISTERED_FORMS_PAGE_SLUG = 'jlc_custom_forms_registered_forms_page';

	protected static $loaded_forms = array();
	protected static $registered_forms_table = null;

	protected static $user_cookie;

	protected static $current_printing_form;

	protected $base_dir;
	protected $internal_id;

	protected $text_domain;

	protected $fields;

	protected $action;
	protected $ajax;
	protected $wordpress_method;
	protected $return_url;
	protected $private; // true if form is only for logged users

	protected $enctype;
	protected $method;

	protected $id;
	protected $class;

	protected $return_url_changed;

	protected $attributes;

	protected static function get_user_cookie()
	{
		if( !empty( self::$user_cookie ) )
			return self::$user_cookie;

		if( !empty( $_COOKIE['jlc_custom_form_user'] ) )
		{
			self::$user_cookie = $_COOKIE['jlc_custom_form_user'];
			return self::$user_cookie;
		}

		$cookie = uniqid( md5( $_SERVER['REMOTE_ADDR'] ) );
		
		if( setcookie( 'jlc_custom_form_user', $cookie, 0, '/' ) )
			self::$user_cookie = $cookie;

		return self::$user_cookie;
	}

	public static function get_current_printing_form()
	{
		return self::$current_printing_form;
	}

	public static function load_text_domain()
	{
		$plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages';
		load_plugin_textdomain( self::TEXT_DOMAIN, false, $plugin_rel_path );
	}

	public static function register_form( $internal_id, $dir, $file, $args, $from )
	{
		$registered_forms = get_option( self::REGISTERED_FORMS_KEY, array() );

		// TODO: Revisa si hay una opción más guay para esto y comprueba que se gestione este mismo error al eleminar los registros y en la tabla.
		if( !is_array( $registered_forms ) )
			wp_die( 'JLCCustomForm registered forms data has been corrupted (option: ' . self::REGISTERED_FORMS_KEY . '). Check if data can be recovered or remove this option' );

		if( preg_match( '*^' . ABSPATH . '*', $dir ) )
			$dir = mb_substr( $dir, mb_strlen( ABSPATH ) );

		$already_registered = false;
		foreach( $registered_forms as $form )
		{
			if( isset( $form['internal_id'] ) &&
				isset( $form['dir'] ) &&
				isset( $form['file'] ) &&
				$form['internal_id'] == $internal_id &&
				$form['dir'] == $dir &&
				$form['file'] == $file )
			{
				$already_registered = true;
				break;
			}
		}

		if( !$already_registered )
		{
			$registered_forms[] = array(
				'dir' => $dir,
				'file' => $file,
				'from' => $from,
				'internal_id' => $internal_id,
				'args' => $args
			);

			update_option( self::REGISTERED_FORMS_KEY, $registered_forms );
		}
	}

	/**
	 * Unregister given form.
	 *
	 * Also remove invalid forms.
	 *
	 * @param string
	 * @param string
	 * @param string
	 */
	public static function unregister_form( $internal_id, $dir, $file )
	{
		$registered_forms = get_option( self::REGISTERED_FORMS_KEY, array() );
		$new_forms = array();

		if( preg_match( '*^' . ABSPATH . '*', $dir ) )
			$dir = mb_substr( $dir, mb_strlen( ABSPATH ) );

		foreach( $registered_forms as $form )
			if( isset( $form['internal_id'] ) &&
				isset( $form['dir'] ) &&
				isset( $form['file'] ) &&
				$form['internal_id'] !== $internal_id &&
				$form['dir'] !== $dir &&
				$form['file'] !== $file )
				$new_forms[] = $form;

		update_option( self::REGISTERED_FORMS_KEY, $new_forms );
	}

	public static function initialize_forms_reading()
	{
		// initializes user cookie if not exists
		self::get_user_cookie();

		if( empty( $_REQUEST ) && empty( $_REQUEST['action'] ) || empty( $_REQUEST['jlc_custom_form'] ) )
			return;

		$registered_forms = get_option( self::REGISTERED_FORMS_KEY, array() );

		foreach( $registered_forms as $form )
		{
			$matches = array();
			if( $_REQUEST['jlc_custom_form'] == $form['internal_id'] &&
				is_dir( ABSPATH . $form['dir'] ) &&
				is_readable( ABSPATH . $form['dir'] . DIRECTORY_SEPARATOR . $form['file'] ) &&
				preg_match( '/^(.*)\.php$/', $form['file'], $matches )
			) {
				$form = self::get_form( $_REQUEST['jlc_custom_form'], $form['dir'], $matches[1], $form['args'] );
				$form->initialize_reading();
			}
		}
	}

	public static function is_form_loaded( $internal_id )
	{
		return !empty( self::$loaded_forms[$internal_id] );
	}

	public static function get_form( $internal_id, $dir, $name, $args = null )
	{
		if( self::is_form_loaded( $internal_id ) )
			return self::$loaded_forms[$internal_id];

		if( false !== strpos( $name, '.php' ) )
			$name = substr( $name, 0, strpos( $name, '.php' ) );

		if( !preg_match( '*^' . ABSPATH . '*', $dir ) )
			$dir = ABSPATH . $dir;

		$class_name = 'JLC' . $name . 'Form';
		if( !class_exists( $class_name ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( $dir, $name . '.php' ) ) );

		if( $args !== null )
			self::$loaded_forms[$internal_id] = new $class_name( $internal_id, $args );
		else
			self::$loaded_forms[$internal_id] = new $class_name( $internal_id );

		return self::$loaded_forms[$internal_id];
	}

	public static function register_admin_pages()
	{
		$registered_forms = get_option( self::REGISTERED_FORMS_KEY, array() );

		$title = __( 'JLC Custom Forms', self::TEXT_DOMAIN );
		$hook = add_submenu_page(
			'options-general.php',
			$title,
			$title,
			'administrator',
			self::ADMIN_SETTINGS_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_settings_page',
			)
		);
		
		$title = __( 'Registered JLC Forms', self::TEXT_DOMAIN );
		$hook = add_submenu_page(
			'options-general.php',
			$title,
			$title,
			'administrator',
			self::ADMIN_REGISTERED_FORMS_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_registered_forms_page',
			)
		);
		add_action( "load-$hook", array( get_class(), 'screen_custom_forms_options' ) );
	}

	public static function print_admin_settings_page()
	{
		$file = __DIR__ . '/templates/admin/settings.php';

		$settings_form = self::get_form(
			'jlc_custom_forms_settings',	
			__DIR__,
			'SelfSettings.php',
			array(
				'admin_page_slug' => self::ADMIN_SETTINGS_PAGE_SLUG,
				'text_domain' => self::TEXT_DOMAIN
			),
			__FILE__
		);

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
			return;
		}

		include( $file );
	}

	public static function screen_custom_forms_options()
	{
		if( !isset( $_GET['help'] ) )
		{
			$option = "per_page";
			$args = array(
				'label' => __( 'Forms', self::TEXT_DOMAIN ),
				'default' => 20,
				'option' => 'forms_per_page'
			);

			add_screen_option( $option, $args );
			if( !class_exists( 'JLCCustomFormRegisteredFormsTable', false ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'registered-forms-table.php' ) ) );

			self::$registered_forms_table = new JLCCustomFormRegisteredFormsTable();
		}
	}

	public static function print_admin_registered_forms_page()
	{
		if( isset( $_GET['help'] ) )
		{
			$file = __DIR__ . '/help.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
				return;
			}

			include( $file );
		}
		else
		{
			$file = __DIR__ . '/templates/admin/registered-forms.php';

			$settings_form = self::get_form(
				'jlc_custom_forms_settings',	
				__DIR__,
				'SelfSettings.php',
				array(
					'admin_page_slug' => self::ADMIN_REGISTERED_FORMS_PAGE_SLUG,
					'text_domain' => self::TEXT_DOMAIN
				),
				__FILE__
			);

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
				return;
			}

			$list_table = self::$registered_forms_table;

			include( $file );
		}
	}

	protected function get_status_message( $code )
	{
		switch( $code )
		{
			case self::SENT_SUCCESSFULLY:
				return __( 'Form sent successfully.', self::TEXT_DOMAIN );
			case self::PERSONAL_DATA_SUCCESSFULLY:
				return __( 'Personal data sent successfully.', self::TEXT_DOMAIN );
			default:
				return '';
		}
	}

	public function get_error_message( $code )
	{
		switch( $code )
		{
			case self::FORM_DATA_ERROR:
				return __( 'Invalid form data', self::TEXT_DOMAIN );
			case self::FATAL_ERROR:
				return __( 'There was an error. Try again later please.', self::TEXT_DOMAIN );
			case self::MAX_UPLOAD_SIZE_ERROR:
				return __( 'Upload file size limit exceeded.', self::TEXT_DOMAIN );
			case self::INVALID_UPLOAD_FORMAT_ERROR:
				return __( 'Upload file format is invalid.', self::TEXT_DOMAIN );
			case self::AJAX_FIELD_ERROR:
				return __( 'There was an error. Refresh the page and try again please.', self::TEXT_DOMAIN );
			default:
				return '';
		}
	}

	public function print_public_notices()
	{
		$transient_name = $this->get_messages_transient_name();
		if( !$transient_name ) return;
		$messages = get_transient( $transient_name );

		if( is_array( $messages ) )
		{
			delete_transient( $transient_name );
			foreach( $messages as $msg )
			{
				$message = $msg['text'];
				if( !$msg['code'] )
					include( $this->look_for_file( 'success_notice.php' ) );
				else
					include( $this->look_for_file( 'error_notice.php' ) );
			}
		}
	}

	public static function external_print_public_notices( $transient_name, $delete = false )
	{
		if( !$transient_name )
			return;

		$messages = get_transient( $transient_name );

		if( is_array( $messages ) )
		{
			if( $delete )
				delete_transient( $transient_name );

			foreach( $messages as $msg )
			{
				$message = $msg['text'];
				if( !$msg['code'] )
					include( realpath( implode(
						DIRECTORY_SEPARATOR,
						array(
							__DIR__,
							'templates', 
							'success_notice.php'
						)
					) ) );
				else
					include( realpath( implode(
						DIRECTORY_SEPARATOR,
						array(
							__DIR__,
							'templates', 
							'error_notice.php'
						)
					) ) );
			}
		}
	}

	public static function get_messages_from( $transient_name, $delete = false )
	{
		if( !$transient_name )
			return null;

		$messages = get_transient( $transient_name );
		if( $delete )
			delete_transient( $transient_name );

		return $messages;
	}

	public function clean_messages()
	{
		$transient_name = $this->get_messages_transient_name();
		if( !$transient_name )
			return;

		delete_transient( $transient_name );
	}

	public function print_admin_notices()
	{
		$transient_name = $this->get_messages_transient_name();
		if( !$transient_name )
			return;
		$messages = get_transient( $transient_name );

		if( is_array( $messages ) )
		{
			delete_transient( $transient_name );
			foreach( $messages as $msg )
			{
				$message = $msg['text'];
				if( !$msg['code'] )
					include( $this->look_for_file( 'admin/success_notice.php' ) );
				else
					include( $this->look_for_file( 'admin/error_notice.php' ) );
			}
		}
	}

	public static function notify_administrators( $code, $message, $extra = null )
	{
	}

	/**
	 * $ignore_simple_permalink_structure exists because
	 * if simple permalink structure is selected, removing
	 * query string will always return home URL. So it is false
	 * by default, avoiding problems in this case if the
	 * developer does not set it to true.
	 *
	 * If permalink structure is not simple, this argument does
	 * not affect the result.
	 */
	public static function get_current_url( $include_query_string = true, $ignore_simple_permalink_structure = false )
	{
		if( !$ignore_simple_permalink_structure )
		{
			$structure = get_option( 'permalink_structure' );
			if( !empty( $structure ) )
				$ignore_simple_permalink_structure = true;
		}

		if( !empty( $_SERVER['REDIRECT_URL'] ) )
		{
//TODO: RECHECK THIS URGENT he comentado la siguiente linea y añadido una copia sin HTTP_HOST ni lo precedente
// También ten en cuenta lo siguiente:
//searched $_SERVER["REDIRECT_URL"] for a while and noted that it is not mentioned in php documentation page itself. look like this is only generated by apache server(not others) and using   $_SERVER["REQUEST_URI"] will be useful in some cases as mine.
			//$url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL'];
			$url = $_SERVER['REDIRECT_URL'];

			if( !$ignore_simple_permalink_structure || ( $include_query_string && !empty( $_SERVER['QUERY_STRING'] ) ) )
				$url .= '?' . $_SERVER['QUERY_STRING'];
		}
		elseif( !empty( $_SERVER['PATH_INFO'] ) )
		{
			$url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];

			if( !$ignore_simple_permalink_structure || ( $include_query_string && !empty( $_SERVER['QUERY_STRING'] ) ) )
				$url .= '?' . $_SERVER['QUERY_STRING'];
		}
		else
		{
			$url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			if( $ignore_simple_permalink_structure && !$include_query_string && !empty( $_SERVER['QUERY_STRING'] ) )
				$url = mb_substr( $url, 0, mb_strpos( $url, '?' ) );
		}

		return $url;
	}


	public static function is_downloadable( $file_path )
	{
		if( function_exists( 'wp_upload_dir' ) &&
			( $upload_dir = wp_upload_dir() ) &&
			!empty( $upload_dir['basedir'] ) &&
			mb_strpos( $file_path, $upload_dir['basedir'] ) === 0 )
		{
			return true;
		}
		else
		{
			return defined( 'JLC_CUSTOM_FORM_ALLOW_DOWNLOADS' ) && JLC_CUSTOM_FORM_ALLOW_DOWNLOADS;
		}
	}

	public static function get_download_file_url( $file_path, $force_form_use = false )
	{
		if( !$force_form_use &&
			function_exists( 'wp_upload_dir' ) &&
			( $upload_dir = wp_upload_dir() ) &&
			!empty( $upload_dir['basedir'] ) &&
			mb_strpos( $file_path, $upload_dir['basedir'] ) === 0 )
		{
			return $upload_dir['baseurl'] . mb_substr( $file_path, mb_strlen( $upload_dir['basedir'] ) );
		}
		else
		{
			return admin_url( 'admin-post.php' ) . '?action=jlc_custom_form_download_file&jlc_custom_form=jlc_download_files&_wpnonce=' . wp_create_nonce( 'jlc_download_files_jlc_custom_form_download_file' ) . '&file=' . $file_path ;
		}
		
	}

	public function get_return_url()
	{
		return $this->return_url;
	}

	public function set_return_url( $url )
	{
		$this->return_url = $url;
		$this->return_url_changed = true;
	}

	public function add_endpoint_to_return_url( $endpoint )
	{
		$add = preg_match( '/\/$/', $this->return_url ) ? $endpoint : '/' . $endpoint;
		$this->return_url .= $add;
		$this->return_url_changed = true;
	}

	public function __construct(
		$base_dir,
		$internal_id,
		$text_domain = null,
		$action = "",
		$ajax = true,
		$wordpress_method = true,
		$return_url = null,
		$private = false,
		$enctype = null,
		$method = null,
		$id = null,
		$class = null,
		$transient_time = 60
	) {

		$this->base_dir = $base_dir;
		$this->internal_id = $internal_id;

		$this->text_domain = $text_domain;

		$this->fields = array();
/*
		if( !empty( $action ) )
		{
*/
			$this->action = $action;
			$this->wordpress_method = $wordpress_method;
			$this->ajax = $ajax;
			$this->private = $private;
			$this->return_url = $return_url;
/*
		}
*/

		$this->method = $method;
		$this->enctype = $enctype;

		$this->class = $class;
		$this->id = $id;

		$this->transient_time = $transient_time;

		$this->return_url_changed = false;

		$this->attributes = array();
	}

	public function get_attributes()
	{
		return apply_filters( 'jlc_custom_form_get_attributes', $this->attributes, $this );
	}

	public function set_attributes( $attributes )
	{
		if( is_array( $attributes ) )
			$this->attributes = $attributes;
	}

	public function add_attribute( $key, $value )
	{
		$this->attributes[$key] = $value;
	}

	public function get_action()
	{
		return $this->action;
	}

	public function get_form_action()
	{
		if( $this->wordpress_method )
		{
			if( $this->ajax )
				return admin_url( 'admin-ajax.php' );
			else
				return admin_url( 'admin-post.php' );
		}
		else
		{
			return $this->action;
		}
	}

	protected function get_text_domain()
	{
		return !empty( $this->text_domain ) ? $this->text_domain : self::TEXT_DOMAIN;
	}

	public function get_fields()
	{
		return $this->fields;
	}

	public function get_hidden_fields()
	{
		if( !class_exists( 'JLCCustomFormHiddenField' ) )
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'hidden.php' ) ) );

		$ret = array();
		foreach( $this->get_fields() as $field )
			if( is_a( $field, 'JLCCustomFormHiddenField' ) )
				$ret[] = $field;
		
		return $ret;
	}

	public function get_data_fields()
	{
		$fields = array();
		foreach( $this->get_fields() as $field )
			if( method_exists( $field, 'get_name' ) )
				$fields[] = $field;

		return $fields;
	}

	public function get_field_by_name( $name, $include_internal_id = false )
	{
		$name = $include_internal_id ? $this->internal_id . '_' . $name :  $name;

		foreach( $this->get_data_fields() as $field )
			if( $field->get_name() === $name )
				return $field;

		return null;
	}

	//protected function add_field( JLCCustomFormRequestReader $field )
	protected function add_field( JLCCustomFormElement $field )
	{
		$this->fields[] = $field;
		return $field;
	}

	protected function add_fields_from_array( $fields )
	{
		if( is_array( $fields ) )
		{
			foreach( $fields as $field )
			{
				if( !empty( $field['type'] ) &&
					is_string( $field['type'] ) &&
					isset( $field['args'] ) &&
					is_array( $field['args'] ) &&
					( $method_name = 'add_' . $field['type'] ) &&
					method_exists( $this, $method_name )
				) {
					if( !empty( $field['name'] ) &&
						is_string( $field['name'] )
					)
						$this->$method_name( $field['name'], $field['args'] );
					else
						$this->$method_name( $field['args'] );
				}
			}
		}
	}

	public function initialize_reading()
	{
		if( $this->wordpress_method )
		{
			foreach( $this->get_data_fields() as $field )
			{
				if( $field->get_ajax_callable() )
				{
					//TODO: VERY IMPORTANT be sure two field does not enter in conflict
					add_action( 'wp_ajax_' . $this->action . '_field', array( $this, 'process_ajax_field' ) );
					if( !$this->private )
						add_action( 'wp_ajax_nopriv_' . $this->action . '_field', array( $this, 'process_ajax_field' ) );

					//break; REMOVED TODO:check que no sea una mangada
				}

				if( is_a( $field, 'JLCCustomFormUploadAjaxImageField' ) )
				{
					add_action( 'wp_ajax_' . sprintf( $field::AJAX_UPLOAD_IMAGE_ACTION, $this->internal_id, $field->get_name() ), array( $field, 'procces_ajax_upload_image' ) );
					if( !$this->private )
						add_action( 'wp_ajax_nopriv_' . sprintf( $field::AJAX_UPLOAD_IMAGE_ACTION, $this->internal_id, $field->get_name() ), array( $field, 'procces_ajax_upload_image' ) );

					if( $field->has_selection_window() )
					{
						$selection_window = $field->get_selection_window();
						add_action( 'wp_ajax_' . sprintf( $field::AJAX_IMAGE_SELECTION_WINDOW_GET_IMAGES, $this->internal_id, $field->get_name() ), $selection_window['callback'] );
					}
				}
			}

			if( !$this->ajax )
			{
				if( !empty( $_POST['return_url'] ) && filter_var( $_POST['return_url'], FILTER_VALIDATE_URL ) )
					$this->set_return_url( $_POST['return_url'] );
					
				add_action( 'admin_post_' . $this->action, array( $this, 'process_action' ) );
				if( !$this->private )
					add_action( 'admin_post_nopriv_' . $this->action, array( $this, 'process_nopriv_action' ) );

			}
			else
			{
				add_action( 'wp_ajax_' . $this->action, array( $this, 'process_ajax_action' ) );
				if( !$this->private )
					add_action( 'wp_ajax_nopriv_' . $this->action, array( $this, 'process_ajax_nopriv_action' ) );
			}
		}
	}

	protected function add_hidden_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_hidden_field( $name, $args ) );
	}

	protected function add_text_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_text_field( $name, $args ) );
	}

	protected function add_password_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_password_field( $name, $args ) );
	}

	protected function add_number_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_number_field( $name, $args ) );
	}

	protected function add_color_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_color_field( $name, $args ) );
	}

	/**
	 * The method assumes address max length in 254 by default,
	 * but class constructor assumes 100 (wordpress user email lenght).
	 * This fact implies that the wordpress limit must be specified
	 * if it is requried.
	 */
	protected function add_email_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_email_field( $name, $args ) );
	}

	protected function add_date_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_date_field( $name, $args ) );
	}

	protected function add_textarea_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_textarea_field( $name, $args ) );
	}

	protected function add_wp_editor_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_wp_editor_field( $name, $args ) );
	}

	protected function add_tinymce_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_tinymce_field( $name, $args ) );
	}

	protected function add_checkbox_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_checkbox_field( $name, $args ) );
	}

	protected function add_checkbox_group( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_checkbox_group( $name, $args ) );
	}

	protected function add_radio_group( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_radio_group( $name, $args ) );
	}

	protected function add_yes_no_radio_group( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_yes_no_radio_group( $name, $args ) );
	}

	protected function add_select( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_select( $name, $args ) );
	}

	protected function add_post_select( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_post_select( $name, $args ));
	}

	protected function add_term_select( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_term_select( $name, $args ) );
	}

	protected function add_font_select( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_font_select( $name, $args ) );
	}
	
	protected function add_multi_contact_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_multi_contact_field( $name, $args ) );
	}

	protected function add_submit_button( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_submit_button( $name, $args ) );
	}

	protected function add_save_and_add_buttons( $name = 'save', $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_save_and_add_buttons( $name, $args ) );
	}

	protected function add_ajax_upload_image_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_ajax_upload_image_field( $name, $args ) );
	}

	protected function add_ajax_upload_image_position_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_ajax_upload_image_position_field( $name, $args ) );
	}

	protected function add_ajax_upload_image_multiple_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_ajax_upload_image_multiple_field( $name, $args ) );
	}

	// TODO: Revisa este método al completo
	protected function add_upload_image_field( $name, $value, $label = "", $placeholder = "",  $required = false, $disabled = false, $readonly = false )
	{
		$this->fields[$name] = new JLCCustomFormField( $value, 'upload_image', $label, $placeholder, $required, $disabled, $readonly );
		if( $this->enctype === null )
		{
			$this->enctype = "multipart/form-data";
			if( !is_admin() )
			{
				wp_enqueue_script(
					'jlc-custom-form-upload-file-script',
					plugins_url( '/js/upload-file.js', __FILE__ ),
					array( 'jquery' ),
					self::VERSION,
					true
				);
				wp_enqueue_style(
					'jlc-custom-form-upload-file-style',
					plugins_url( '/css/upload-file.css', __FILE__ ),
					array(),
					self::VERSION
				);
			}
		}
		
	}

	protected function add_upload_field( $name, $args )
	{
		if( $this->enctype === null )
			$this->enctype = "multipart/form-data";

		return $this->add_field( JLCCustomFormFieldLoader::get_upload_field( $name, $args ) );
		
	}

/*
	protected function add_checkbox_group( $name, $label, $options )
	{
		$options_objs = array();
		foreach( $options as $opt_name => $option )
		{
			$options_objs[$opt_name] = new JLCCustomFormCheckboxField( $option['value'], !empty( $option['checked'] ), $option['label'] );
		}
		$this->fields[$name] = new JLCCustomFormCheckboxGroup( $label, $options_objs );
	}
*/

	protected function add_google_captcha()
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_google_captcha() );
	}

	protected function add_honeypot( $name = 'wp_source_info' )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_honeypot( $name ) );
	}

	protected function add_jquery_slider( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_jquery_slider( $name, $args ) );
	}

	protected function add_jquery_range_slider( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_jquery_range_slider( $name, $args ) );
	}

	protected function add_dni_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_dni_field( $name, $args ) );
	}

	protected function add_nif_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_nif_field( $name, $args ) );
	}

	protected function add_spanish_province_select( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_spanish_province_select( $name, $args ) );
	}

	protected function add_iban_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_iban_field( $name, $args ) );
	}

	protected function add_background_field( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_background_field( $name, $args ) );
	}

	protected function add_fields_array( $name, $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_fields_array( $name, $args ) );
	}


	protected function add_separator( $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_separator( $args ) );
	}

	protected function add_heading( $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_heading( $args ) );
	}

	protected function add_html( $args = array() )
	{
		return $this->add_field( JLCCustomFormFieldLoader::get_html( $args ) );
	}

	protected function look_for_file( $filename )
	{
		$theme_file = implode(
			DIRECTORY_SEPARATOR,
			array(
				get_stylesheet_directory(),
				'jlc-form', 
				$this->internal_id,
				$filename
			)
		);

		if( is_readable( $theme_file ) && is_file( $theme_file ) )
			return $theme_file;

		$custom_file = realpath( implode(
			DIRECTORY_SEPARATOR,
			array(
				$this->base_dir,
				'templates', 
				$filename
			)
		) );

		if( is_readable( $custom_file ) && is_file( $custom_file ) )
			return $custom_file;

		return realpath( implode(
			DIRECTORY_SEPARATOR,
			array(
				__DIR__,
				'templates', 
				$filename
			)
		) );
	}

	protected function preload_field_values_from_transient( $remove = true )
	{
		$transient_name = $this->get_values_transient_name();
		if( !$transient_name )
			return;

		$values = get_transient( $transient_name );
		if( !empty( $values ) )
		{
			if( !class_exists( 'JLCCustomFormCheckboxField' ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'checkbox.php' ) ) );

			foreach( $this->get_data_fields() as $field )
			{
				//TODO: review this for all checkable fields y el class_exists anterior
				if( is_a( $field, 'JLCCustomFormCheckboxField' ) )
				{
					if( isset( $values[ $field->get_name() ] ) )
						$field->set_checked( true );
				}
				else
				{
					if( isset( $values[ $field->get_name() ] ) )
						$field->set_value( $values[ $field->get_name() ] );
				}
			}
		}

		if( $remove )
			delete_transient( $transient_name );
		
	}

	protected function enqueue_global_script()
	{
		if( true || !wp_script_is( 'jlc-custom-form-global-js', 'enqueued' ) )
		{
			wp_enqueue_script(
				'jlc-custom-form-global-js',
				plugins_url( '/templates/js/global.js', __FILE__ ),
				array( 'jquery' ),
				self::VERSION,
				true
			);
/*
			wp_localize_script(
				'jlc-custom-form-global-ajax-js',
				'JLCCustomFormAjaxNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'defaultError' => $default_error,
					'defaultFieldError' => $default_field_error
				)
			);
*/
		}
	}

	/**
	 * Enqueues required javascript to run AJAX forms.
	 * It is called when every form is printed and
	 * enqueues the file if one of them uses AJAX
	 * and follows the Wordpress method.
	 *
	 * UPDATED: Also includes ajax script if an ajax
	 * callable field exists
	 *
	 * TODO: Debes hacer que sea completamente
	 * personalizable que scripts se ejecutan
	 * para cada formulario
	 */
	protected function enqueue_global_ajax_script()
	{
		if( $this->has_ajax_callable_fields() || ( $this->ajax && $this->wordpress_method ) )
		{
			ob_start();
			$message = self::get_error_message( self::FATAL_ERROR );
			include( $this->look_for_file( 'error_notice.php' ) );
			$default_error = ob_get_clean();

			ob_start();
			$message = self::get_error_message( self::AJAX_FIELD_ERROR );
			include( $this->look_for_file( 'error_notice.php' ) );
			$default_field_error = ob_get_clean();

			wp_enqueue_script(
				'jlc-custom-form-global-ajax-js',
				plugins_url( '/templates/js/ajax.js', __FILE__ ),
				array( 'jquery' ),
				self::VERSION,
				true
			);
			wp_localize_script(
				'jlc-custom-form-global-ajax-js',
				'JLCCustomFormAjaxNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'defaultError' => $default_error,
					'defaultFieldError' => $default_field_error
				)
			);
		}
	}
	protected function enqueue_password_script()
	{
			wp_enqueue_script(
				'jlc-custom-form-password-js',
				plugins_url( '/templates/js/password.js', __FILE__ ),
				array( 'jquery' ),
				self::VERSION,
				true
			);
	}

	protected function has_ajax_callable_fields()
	{
		foreach( $this->get_data_fields() as $field )
			if( $field->get_ajax_callable() )
				return true;

		return false;
	}

	public function print_public_form_opening()
	{
		include( $this->look_for_file( 'default-public-form-opening.php' ) );
	}

	public function print_public_form_body()
	{
		include( $this->look_for_file( 'default-public-form.php' ) );
	}

	public function print_public_form_closing()
	{
		include( $this->look_for_file( 'default-public-form-closing.php' ) );
	}

	public function print_admin_form_opening()
	{
		include( $this->look_for_file( 'default-admin-form-opening.php' ) );
	}

	public function print_admin_form_body()
	{
		include( $this->look_for_file( 'default-admin-form.php' ) );
	}

	public function print_admin_form_closing()
	{
		include( $this->look_for_file( 'default-admin-form-closing.php' ) );
	}

	public function print_public_form( $hide_messages = false )
	{
		self::$current_printing_form = $this->internal_id;

		if( !$hide_messages )
			$this->print_public_notices();

		$this->print_public_form_opening();

		$this->preload_field_values_from_transient();

		$this->print_public_form_body();
		$this->print_public_form_closing();

		self::$current_printing_form = null;

		$this->enqueue_global_script();
		$this->enqueue_global_ajax_script();
		$this->enqueue_password_script();
	}

	public function print_admin_form( $readonly_form = false )
	{
		self::$current_printing_form = $this->internal_id;

		$this->print_admin_notices();

		$this->print_admin_form_opening();

		if( $readonly_form )
			foreach( $this->get_fields() as $field )
				if( method_exists( $field, 'set_readonly' ) )
					$field->set_readonly( true );

		$this->preload_field_values_from_transient();

		$this->print_admin_form_body();
		$this->print_admin_form_closing();

		self::$current_printing_form = null;

		$this->enqueue_global_script();
		$this->enqueue_global_ajax_script();
		$this->enqueue_password_script();
	}

	//protected abstract function check_fields();

	protected function get_transient_name( $prefix )
	{
		$max = 172; //From wordpress reference
		$prefix .= '_';
		$user_cookie = self::get_user_cookie();
		if( empty( $user_cookie ) )
			return null;

		$prefix_length = strlen( $prefix );
		$user_cookie_length = strlen( $user_cookie );
		$internal_length = strlen( $this->internal_id );

		if( $prefix_length + $internal_length + $user_cookie_length <= $max )
			return $user_cookie . $prefix . $this->internal_id;
		elseif( $prefix_length + $user_cookie_length < $max )
			return $user_cookie . $prefix . substr( $this->internal_id, $prefix_length + $user_cookie_length - $max );
		else
			return null;
	}

	protected function get_messages_transient_name()
	{
		return $this->get_transient_name( 'jlc_custom_form_messages' );
	}

	protected function get_values_transient_name()
	{
		return $this->get_transient_name( 'jlc_custom_form_values' );
	}

	protected function store_submitted_field_values()
	{
// TODO: En el siguiente parrafo se ha excluido a los campos FILE de ser almacenados en
// el transient, pero quizá no haya que hacerlo
				$values = array();

				if( !class_exists( 'JLCCustomFormCheckboxField' ) )
					require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'fields', 'checkbox.php' ) ) );

				foreach( $this->get_fields() as $field )
				{
					if( method_exists( $field, 'get_name' ) /*&& !$field->is_file_input()*/ )
					{
						// TODO: tambien revisar esto. Ver preload_field_values_from_transient()
						if( is_a( $field, 'JLCCustomFormCheckboxField' ) )
						{
							if( $field->is_checked() )
								$values[ $field->get_name() ] = $field->get_value();
						}
						else
						{
							$values[ $field->get_name() ] = $field->get_value();
						}
					}
				}

				$transient_name = $this->get_values_transient_name();

				if( $transient_name )
					set_transient( $transient_name, $values, $this->transient_time );
	}

	public function load_values_from_request()
	{
		$errors = array();

		$method = is_string( $this->method ) ? strtoupper( $this->method ) : 'POST';
/*
		if( $method == 'POST' )
		{
			if( !empty( $_POST ) )
			{
				foreach( $this->get_fields() as $field )
				{
					if( ( method_exists( $field, 'get_name' ) && !$field->is_file_input() ) &&
						null !== ( $error = $field->read_request( isset( $_POST[ $field->get_name() ] ) ? $_POST[ $field->get_name() ] : null ) ) )
						$errors[] = $error;
				}
			}
		}
		elseif( $method == 'GET' )
		{
			if( !empty( $_GET ) )
			{
				foreach( $this->fields as $key => $field )
				{
					if( (  method_exists( $field, 'get_name' ) && !$field->is_file_input() ) &&
						null !== ( $error = $field->read_request( isset( $_GET[ $field->get_name() ] ) ? $_GET[ $field->get_name() ] : null ) ) )
						$errors[] = $error;
				}
			}
		}

		if( !empty( $_FILES ) )
		{
			foreach( $this->get_fields() as $field )
			{
				if( ( method_exists( $field, 'get_name' ) && $field->is_file_input() ) &&
					null !== ( $error = $field->read_request( isset( $_FILES[ $field->get_name() ] ) ? $_FILES[ $field->get_name() ] : null ) ) )
					$errors[] = $error;
			}
		}
*/
		foreach( $this->get_data_fields() as $field )
		{
			if( null !== ( $error = $field->read_request( $field->read_values_from_request( $method ) ) ) )
				$errors[] = $error;
		}

		if( !empty( $errors ) )
		{
// TODO: procesar $_FILES en AJAX
			if( !$this->ajax )
			{
				$transient_name = $this->get_messages_transient_name();
				if( $transient_name )
					set_transient( $transient_name, $errors, $this->transient_time );

				$this->store_submitted_field_values();
			}
			else
			{
				$this->generate_wpajax_response( $errors );
				wp_die();
			}

			return false;
		}

		return true;
	}

	public function process_ajax_field()
	{
		if( !empty( $_POST['jlc_custom_form_field'] ) &&
			( $field_name = $_POST['jlc_custom_form_field'] ) &&
			( $field = $this->get_field_by_name( $field_name ) ) &&
			is_a( $field, 'JLCCustomFormRequestReader' ) &&
			( $callable = $field->get_ajax_callable() )
		) 
			call_user_func( $callable );
	}

	/**
 	 * This methdos checks and process form submission.
	 * It always ends creating a refirection and setting
	 * messages in a transient.
	 *
	 * Child methods can set messages and redirect on their own,
	 * but is recommended to use the common system for this task.
	 * See process_public_form() description for more info about.
	 * TODO: Esta descripción hay que dividirla entre este método y quien lo contenga
	 */
	protected function process_action_values()
	{
		if( $this->check_nonce() && $this->load_values_from_request() )
		{
			if( ( $result = $this->process_form() ) !== null )
			{
				$transient_name = $this->get_messages_transient_name();
				if( $transient_name )
				{
					if( $result === true )
					{
						set_transient( $transient_name, array( array( 'code' => 0, 'text' => __( 'Form sent successfully.', self::TEXT_DOMAIN ) ) ), $this->transient_time );
					}
					elseif( $result === false )
					{
						set_transient( $transient_name, array( array( 'code' => self::FATAL_ERROR, 'text' => __( 'There was an error while processing the form. Try again later please.', self::TEXT_DOMAIN ) ) ), $this->transient_time );
						$this->store_submitted_field_values();
					}
					elseif( is_string( $result ) )
					{
						set_transient( $transient_name, array( array( 'code' => 0, 'text' => $result ) ), $this->transient_time );
					}
					elseif( is_array( $result ) )
					{
						foreach( $result as $r )
						{
							if( !isset( $r['code'] ) || $r['code'] !== 0 )
							{
								$this->store_submitted_field_values();
								break;
							}
						}

						set_transient( $transient_name, $result, $this->transient_time );
					}
				}
			}
		}
	}
	// @deprecated
	public function process_public_action() { return $this->process_action(); }
	public function process_action()
	{
		$this->process_action_values();

		wp_safe_redirect( $this->get_return_url() );
		exit;
	}


	// @deprecated
	public function process_public_nopriv_action() { return $this->process_nopriv_action(); }
	public function process_nopriv_action()
	{
		if( $this->private )
		{
			wp_safe_redirect( $this->get_return_url() );
			exit;
		}

		$this->process_public_action();
	}

	protected function generate_wpajax_response( $responses )
	{
		if( $responses !== null )
		{
			ob_start();
			foreach( $responses as $r )
			{
				$message = $r['text'];
				if( !$r['code'] )
					include( $this->look_for_file( 'success_notice.php' ) );
				else
					include( $this->look_for_file( 'error_notice.php' ) );
			}
		
			$response_html = ob_get_clean();

			$response = new WP_Ajax_Response( array(
				'what' => 'html',
				'action' => 'prepend',
				'id' => 1,
				'data' => $response_html
			) );
			$response->send();
		}
		else
		{
			$response = new WP_Ajax_Response( array(
				'what' => 'html',
				'action' => 'prepend',
				'id' => 0,
				'data' => 'Error'
			) );
			$response->send();
		}
	}

	// @deprecated
	public function process_ajax_public_action() { return $this->process_ajax_action(); }
	public function process_ajax_action()
	{
		$responses = null;

		if( $this->check_ajax_nonce() && $this->load_values_from_request() )
		{
			if( ( $result = $this->process_form() ) !== null )
			{
				if( $result === true )
					$responses = array( array( 'code' => 0, 'text' => __( 'Form sent successfully.', self::TEXT_DOMAIN ) ) );
				elseif( $result === false )
					$responses = array( array( 'code' => self::FATAL_ERROR, 'text' => __( 'There was an error while processing the form. Try again later please.', self::TEXT_DOMAIN ) ) );
				elseif( is_string( $result ) )
					$responses = array( array( 'code' => 0, 'text' => $result ) );
				elseif( is_array( $result ) )
					$responses = $result;
			}
		}
		
		$this->generate_wpajax_response( $responses );

		wp_die();
	}

	// @deprecated
	public function process_ajax_nopriv_public_action() { return $this->process_ajax_nopriv_action(); }
	public function process_ajax_nopriv_action()
	{
		if( $this->private )
			wp_die();
			

		$this->process_ajax_action();

		wp_die();
	}

	/**
	 * This method performs the child form particular task.
	 *
	 * It can take on redirecting and setting messages,
	 * but if you want to use the common system, the
	 * method must return one of theese:
	 *
	 * true - A default success message will be set.
	 *
	 * string - This string will be use as succcess message.
	 *
	 * array - This must be an array of messages, successful
	 * or not. Remember the format of each message element:
	 *   array( 'code' => int, 'text' => string )
	 * 
	 * false - A default error message will be set.
	 * Error messages are usually processed in 
	 * load_values_from_request(), and if not,
	 * an array of error messages should be returned
	 * by this method.
	 */
	protected abstract function process_form();

	protected function get_nonce_action()
	{
		return $this->internal_id . '_' . $this->action;
	}

	protected function check_nonce()
	{
		$method = is_string( $this->method ) ? strtoupper( $this->method ) : 'POST';

		$nonce_key = '_wpnonce';

		if( $method == 'POST' && isset( $_POST[ $nonce_key ] ) )
			$nonce = $_POST[ $nonce_key ];
		elseif( $method == 'GET' && isset( $_GET[ $nonce_key ] ) )
			$nonce = $_GET[ $nonce_key ];
		else
			return false;

		return wp_verify_nonce( $nonce, $this->get_nonce_action() );
	}

	protected function check_ajax_nonce()
	{
return true;
		return check_ajax_referer( $this->get_nonce_action() );
	}

	// TODO: añadir esto al campo upload_file y hacer static
	public function get_file_upload_max_size() {

		$post_max_size = $this->parse_size(ini_get('post_max_size'));

		if ($post_max_size > 0)
			$max_size = $post_max_size;
		else
			$max_size = -1;

		$upload_max = $this->parse_size(ini_get('upload_max_filesize'));

		if ($upload_max > 0 && $upload_max < $max_size)
			$max_size = $upload_max;

		return $max_size;
	}

	protected function parse_size($size) {
	  $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
	  $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
	  if ($unit) {
		// Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
		return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
	  }
	  else {
		return round($size);
		}
	}
}

register_activation_hook( __FILE__, function(){
	JLCCustomForm::register_form(
		'jlc_custom_forms_settings',
		__DIR__,
		'SelfSettings.php',
		array(
			'admin_page_slug' => JLCCustomForm::ADMIN_SETTINGS_PAGE_SLUG,
			'text_domain' => JLCCustomForm::TEXT_DOMAIN
		),
		__FILE__
	);

	if( defined( 'JLC_CUSTOM_FORM_ALLOW_DOWNLOADS' ) && JLC_CUSTOM_FORM_ALLOW_DOWNLOADS )
	{
		JLCCustomForm::register_form(
			'jlc_download_files',
			__DIR__,
			'DownloadFiles.php',
			array(
				'text_domain' => JLCCustomForm::TEXT_DOMAIN
			),
			__FILE__
		);
	}
});
register_deactivation_hook( __FILE__, function(){
	JLCCustomForm::unregister_form(
		'jlc_download_files',
		__DIR__,
		'DownloadFiles.php'
	);
	JLCCustomForm::unregister_form(
		'jlc_custom_forms_settings',
		__DIR__,
		'SelfSettings.php'
	);
});

if( !has_action( 'init', array( 'JLCCustomForm', 'initialize_forms_reading' ) ) )
	add_action( 'init', array( 'JLCCustomForm', 'initialize_forms_reading' ) );

if( !has_action( 'admin_menu', array( 'JLCCustomForm', 'register_admin_pages' ) ) )
	add_action( 'admin_menu', array( 'JLCCustomForm', 'register_admin_pages' ) );

if( !has_action( 'plugins_loaded', array( 'JLCCustomForm', 'load_text_domain' ) ) )
	add_action( 'plugins_loaded', array( 'JLCCustomForm', 'load_text_domain' ) );

} // class_exists
