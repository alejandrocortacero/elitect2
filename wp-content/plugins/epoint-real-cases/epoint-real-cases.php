<?php
/**
 * Plugin Name: Epoint Real Cases
 * Plugin URI:
 * Description: Manage real cases
 * Version: 1.1
 * Author: Epoint
 * AUthor URI: https://epoint.es/
 * Text Domain: epoint-real-cases-textdomain
 * License: EULA
 */

defined( 'ABSPATH' ) or die( 'Wrong Access' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'jlc-form/jlc-form.php' ) ) {

if( !class_exists( 'JLCCustomForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'jlc-form.php' ) ) );

//if( !class_exists( 'EpointPersonalTrainerMapper' ) )
	//require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'mapper.php' ) ) );

class EpointRealCases
{
	const TEXT_DOMAIN = 'epoint-real-cases-textdomain';
	const VERSION = '1.1';

	const POST_TYPE = 'epoint_realcase';

	const FLUSH_REWRITE_RULES_KEY = 'epoint_real_cases_flush_rewrite_rule';

	// FORMS

	const ADMIN_SETTINGS_FORM_INTERNAL_ID = 'epoint_real_cases_settings_form';
	const REGISTER_TRAINER_FORM_INTERNAL_ID = 'epoint_real_cases_register_trainer_form';
	//const REGISTER_USER_FORM_INTERNAL_ID = 'epoint_real_cases_register_user_form';

	//const EDIT_EXERCISE_FORM_INTERNAL_ID = 'epoint_real_cases_edit_exercise_form';

	// OPTIONS

	const NOTIFICATION_ADDR_KEY = 'epoint_real_cases_notification_addr';
	const CONTACT_EMAIL_KEY = 'epoint_real_cases_contact_email';

	// ADMIN PAGES

	const ADMIN_PAGE_SLUG = 'epoint_real_cases-scoring-firm-admin-page';
	const ADMIN_SETTINGS_PAGE_SLUG = 'epoint_real_cases-scoring-firm-settings';

	// ROLES

	const TRAINER_ROLE = 'epoint_personal_trainer_trainer';
	const SPORTSMAN_ROLE = 'epoint_personal_trainer_sportsman';

	// META

	const AFTER_PHOTO_KEY = 'epoint_real_cases_after';

	public static function initialize()
	{
		// INSTALLATION
		register_activation_hook(
			__FILE__,
			array(
				get_class(),
				'install'
			)
		);
		register_deactivation_hook(
			__FILE__,
			array(
				get_class(),
				'uninstall'
			)
		);

		add_action(
			'plugins_loaded',
			function(){
				$plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages';
				load_plugin_textdomain( self::TEXT_DOMAIN, false, $plugin_rel_path );
			}
		);

		add_action( 'after_setup_theme', array( get_class(), 'register_types' ) );
		add_action( 'after_setup_theme', array( get_class(), 'maybe_flush_rules' ) );
/*
		add_action( 'init', array( get_class(), 'redsys_merchanturl_endpoint' ) );
		add_action( 'wp', array( get_class(), 'redsys_read_merchanturl_data' ) );
		add_action( 'template_redirect', array( get_class(), 'redsys_validate_return_page' ) );
*/

		//add_action( 'admin_menu', array( get_class(), 'register_admin_pages' ) );
		//add_filter( 'set-screen-option', array( get_class(), 'set_screen' ), 10, 3 );

		//add_shortcode( 'epoint_real_cases_register_trainer', array( get_class(), 'get_register_trainer_form' ) );
	}

	protected static function get_forms()
	{
		$dir = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) );

		return array(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID => array(
				'ID' => self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerSettings.php',
				'dir' => $dir,
				'args' => array(
					'admin_page_slug' => self::ADMIN_SETTINGS_PAGE_SLUG,
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::REGISTER_TRAINER_FORM_INTERNAL_ID => array(
				'ID' => self::REGISTER_TRAINER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerRegisterTrainer.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			)
		);
	}

	public static function get_subsites_forms()
	{
		$dir = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) );

		return array(
			self::REGISTER_USER_FORM_INTERNAL_ID => array(
				'ID' => self::REGISTER_USER_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerRegisterUser.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::EDIT_EXERCISE_FORM_INTERNAL_ID => array(
				'ID' => self::EDIT_EXERCISE_FORM_INTERNAL_ID,
				'file' => 'EpointPersonalTrainerEditExercise.php',
				'dir' => $dir,
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			)
		);
	}

	public static function install()
	{
		//add_role( self::TRAINER_ROLE, __( 'Trainer', self::TEXT_DOMAIN ), array( 'read' => true ) );
		//add_role( self::SPORTSMAN_ROLE, __( 'Sportsman', self::TEXT_DOMAIN ), array( 'read' => true ) );

		//EpointPersonalTrainerMapper::install();

		foreach( self::get_forms() as $form_id => $form )
			JLCCustomForm::register_form(
				$form_id,
				$form['dir'],
				$form['file'],
				$form['args'],
				__FILE__
			);

		//self::redsys_merchanturl_endpoint();
		//self::signaturit_eventsurl_endpoint();
		//flush_rewrite_rules();
	}

	public static function uninstall()
	{
		$dir = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) );

		foreach( self::get_forms() as $form_id => $form )
			JLCCustomForm::unregister_form(
				$form_id,
				$form['dir'],
				$form['file']
			);

		//EpointPersonalTrainerMapper::uninstall();

		//remove_role( 'epoint_real_cases_trainer' );
		//remove_role( 'epoint_real_cases_sportsman' );

		//flush_rewrite_rules();
		delete_option( self::FLUSH_REWRITE_RULES_KEY );
	}

	/**
	 * Registers entities and taxonomies and flush
	 * rewrite rules.
	 */
	public static function rewrite_flush()
	{
		update_option( self::FLUSH_REWRITE_RULES_KEY, 'yes' );
		self::register_types();
		flush_rewrite_rules();
	}

	public static function maybe_flush_rules()
	{
		if( get_option( self::FLUSH_REWRITE_RULES_KEY ) === 'yes' )
		{
			flush_rewrite_rules();
			update_option( self::FLUSH_REWRITE_RULES_KEY, 'no' );
		}

	}

	public static function register_types()
	{
		// houses
		$labels = array(
			'name'               => __( 'Real cases', self::TEXT_DOMAIN ),
			'singular_name'      => __( 'Real case', self::TEXT_DOMAIN ),
			'menu_name'          => __( 'Real cases', self::TEXT_DOMAIN ),
			'name_admin_bar'     => __( 'Real cases', self::TEXT_DOMAIN ),
			'add_new'            => __( 'Add real case', self::TEXT_DOMAIN ),
			'add_new_item'       => __( 'Add real case', self::TEXT_DOMAIN ),
			'new_item'           => __( 'Add real case', self::TEXT_DOMAIN ),
			'edit_item'          => __( 'Edit real case', self::TEXT_DOMAIN ),
			'view_item'          => __( 'View real case', self::TEXT_DOMAIN ),
			'all_items'          => __( 'All real cases', self::TEXT_DOMAIN ),
			'search_items'       => __( 'Search real cases', self::TEXT_DOMAIN ),
			'parent_item_colon'  => __( 'Parent real case:', self::TEXT_DOMAIN ),
			'not_found'          => __( 'No real cases found.', self::TEXT_DOMAIN ),
			'not_found_in_trash' => __( 'No real cases found in Trash.', self::TEXT_DOMAIN )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Manage houses with the power of Wordpress posts.', self::TEXT_DOMAIN ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array(
				'slug' => __( 'real-case', self::TEXT_DOMAIN ),
				'with_front' => false
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 7,
			'menu_icon'			 => 'dashicons-admin-home',
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/////////////////////////////
	// META
	/////////////////////////////

	public static function get_before_photo( $case_id )
	{
		return get_post_thumbnail_id( $case_id );
	}

	public static function get_after_photo( $case_id )
	{
		return get_post_meta( $case_id, self::AFTER_PHOTO_KEY, true );
	}

	public static function set_before_photo( $case_id, $photo_id )
	{
		set_post_thumbnail( $case_id, $photo_id );
	}

	public static function set_after_photo( $case_id, $photo_id )
	{
		update_post_meta( $case_id, self::AFTER_PHOTO_KEY, $photo_id );
	}


	/////////////////////////////
	// FORMS
	/////////////////////////////

	public static function get_register_trainer_form()
	{
		$forms = self::get_forms();
		$form_id = self::REGISTER_TRAINER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_register_user_form()
	{
		$forms = self::get_subsites_forms();
		$form_id = self::REGISTER_USER_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}


	/////////////////////////////////
	// MAIL
	/////////////////////////////////

	public static function get_contact_email()
	{
		return get_option( self::CONTACT_EMAIL_KEY );
	}

	public static function get_notification_addresses()
	{
		$val = get_option( self::NOTIFICATION_ADDR_KEY );
		if( !is_string( $val ) )
			return array();

		$ret = array();
		$aux = explode( ',', $val );
		foreach( $aux as $addr )
		{
			$addr = trim( $addr );
			if( filter_var( $addr, FILTER_VALIDATE_EMAIL ) )
				$ret[] = $addr;
		}

		return $ret;
	}

	public static function get_mail_headers( $reply_to = null )
	{
		$ret = array( 'Content-type: text/html; charset=utf-8' );

		$contact_addr = self::get_contact_email();
		if( !empty( $contact_addr ) && filter_var( $contact_addr, FILTER_VALIDATE_EMAIL ) )
		{
			$site = get_bloginfo( 'name' );

			$reply_to_addr = $reply_to !== null ? $reply_to : $contact_addr;

			$ret[] = "From: $site <$contact_addr>";
			$ret[] = "Reply-to: $reply_to_addr";
		}
	
		return $ret;
	}

	public static function wrap_mail( $email_heading, $message )
	{
		if( function_exists( 'WC' ) )
		{
			$mailer = WC()->mailer();
			$email_obj = new WC_Email();
			$message = apply_filters( 'woocommerce_mail_content', $email_obj->style_inline( $mailer->wrap_message( $email_heading, $message ) ) );
		}
		else
		{
			ob_start();
			include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'wrap.php' ) ) );
			$message = ob_get_clean();
		}

		return $message;
	}

	public static function send_new_site_notification( $email, $site_name, $site_url )
	{
		$mail_heading = __( 'Site created', self::TEXT_DOMAIN );
		// TODO: send admin url
		$mail_message = sprintf(
			__( 'Your site %s (%s) has been created successfully. \n\nNow you can configure it. Just go to "My Account" to log in and a new link "Settings" will appear. Here you can manage the site style and the sport data.', self::TEXT_DOMAIN ),
			$site_name,
			sprintf( '<a href="%s">%s</a>', $site_url, $site_url )
		);

		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		//$to = self::get_notification_addresses();
		$to = $email;

		wp_mail(
			$to,
			__( 'Site created', self::TEXT_DOMAIN ),
			$mail_message,
			self::get_mail_headers()
		);
	}

	///////////////////////////////////////
	// DATE AND TIME
	///////////////////////////////////////

	public static function get_public_datetime_format()
	{
		return __( "Y/m/d H:i:s", self::TEXT_DOMAIN );
	}
}

EpointRealCases::initialize();

}
