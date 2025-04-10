<?php
/**
 * Plugin Name: JLC We Call You
 * Plugin URI:
 * Description: Recieve call requests
 * Version: 1.1
 * Author: JLC
 * AUthor URI: www.jlc.es
 * Text Domain: jlc-we-call-you-textdomain
 * License: EULA
 */

defined( 'ABSPATH' ) or die( 'Wrong Access' );

require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'mapper.php' ) ) );
//require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'form.php' ) ) );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'jlc-form/jlc-form.php' ) ) {


if( !class_exists( 'JLCCustomForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'jlc-form.php' ) ) );

class JLCWeCallYou
{
	const TEXT_DOMAIN = 'jlc-we-call-you-textdomain';
	const VERSION = '1.1';

	const ADMIN_PAGE_SLUG = 'jlc-we-call-you-admin-page';
	const ADMIN_SETTINGS_PAGE_SLUG = 'jlc-we-call-you-settings-admin-page';

	const ADMIN_SETTINGS_FORM_INTERNAL_ID = 'jlc_we_call_you_settings_form';
	const WE_CALL_YOU_FORM_INTERNAL_ID = 'jlc_we_call_you_contact_form';
	

	const NOTIFICATION_ADDR_KEY = 'jlc-we-call-you-notification-addresses';
	//const PRIVACY_POLICY_PAGE_KEY = 'jlc-we-call-you-privacy-policy-page';
	const INFO_TEXT_KEY = 'jlc-we-call-you-info-text';
	const USE_AJAX_FORM_KEY = 'jlc-we-call-you-use-ajax-form';
	const THANKS_PAGE_KEY = 'jlc-we-call-you-thanks-page';
	const GTAG_EVENT_CONVERSION_KEY = 'jlc-we-call-you-gtag-event-conversion-key';

	protected static $contact_table;

	protected static $using_ajax_form;

	protected static $privacy_policy_id;
	protected static $privacy_policy_exists;
	protected static $privacy_policy_url;

	protected static $privacy_policy_short;

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

		// LOADING
		add_action(
			'plugins_loaded',
			function(){
				$plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages';
				load_plugin_textdomain( self::TEXT_DOMAIN, false, $plugin_rel_path );
			}
		);

		// ADMIN

		add_action(
			'admin_menu',
			array(
				get_class(),
				'register_admin_pages'
			)
		);

		add_filter( 'set-screen-option', array( get_class(), 'set_screen' ), 10, 3 );

		// SHORTCODES
		add_shortcode( 'jlc_we_call_you_form', array( get_class(), 'get_we_call_you_form' ) );
	}

	public static function install()
	{
		JLCWeCallYouMapper::install();

		JLCCustomForm::register_form(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCWeCallYouSettings.php',
			array(
				'admin_page_slug' => self::ADMIN_SETTINGS_PAGE_SLUG,
				'text_domain' => self::TEXT_DOMAIN
			),
			__FILE__
		);

		JLCCustomForm::register_form(
			self::WE_CALL_YOU_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCWeCallYouContact.php',
			array(
				'thanks_page_option' => self::THANKS_PAGE_KEY,
				'text_domain' => self::TEXT_DOMAIN
			),
			__FILE__
		);
	}

	public static function uninstall()
	{
		JLCCustomForm::unregister_form(
			self::WE_CALL_YOU_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCWeCallYouContact.php'
		);

		JLCCustomForm::unregister_form(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCWeCallYouSettings.php'
		);

		JLCWeCallYouMapper::uninstall();
	}

	public static function is_using_ajax_form()
	{
		if( self::$using_ajax_form === null )
			self::$using_ajax_form = get_option( self::USE_AJAX_FORM_KEY ) === 'yes';

		return self::$using_ajax_form;
	}

	public static function get_privacy_policy_id()
	{
		if( empty( self::$privacy_policy_id ) )
			self::$privacy_policy_id = (int) get_option( 'wp_page_for_privacy_policy' );
			//self::$privacy_policy_id = get_option( self::PRIVACY_POLICY_PAGE_KEY );

		return self::$privacy_policy_id;
	}

	public static function privacy_policy_exists()
	{
		if( self::$privacy_policy_exists !== null )
			return self::$privacy_policy_exists;
		
		$page_id = self::get_privacy_policy_id();

		if( empty( $page_id ) )
		{
			self::$privacy_policy_exists = false;
			return false;
		}

		$page = get_post( $page_id );
		self::$privacy_policy_exists = !empty( $page );
		return self::$privacy_policy_exists;
	}

	public static function get_privacy_policy_url()
	{
		if( !empty( self::$privacy_policy_url ) )
			return self::$privacy_policy_url;

		if( !self::privacy_policy_exists() )
			return null;

		//self::$privacy_policy_url = get_permalink( self::get_privacy_policy_id() );
		self::$privacy_policy_url = get_privacy_policy_url();
		return self::$privacy_policy_url;
	}

	public static function get_privacy_policy_short()
	{
		if( empty( self::$privacy_policy_short ) )
		{
			$text = get_option( self::INFO_TEXT_KEY );
			$privacy_policy_url = self::get_privacy_policy_url();
			self::$privacy_policy_short = preg_replace( '/{privacy_policy}/', $privacy_policy_url ? $privacy_policy_url : '#', $text );
		}

		return self::$privacy_policy_short;
	}


	///////////////////////////////////////
	// ADMIN
	///////////////////////////////////////

	public static function register_admin_pages()
	{
		$title = __( 'We call you', self::TEXT_DOMAIN );
		$hook = add_menu_page(
			$title,
			$title,
			'administrator',
			self::ADMIN_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_page'
			),
			'dashicons-phone',
			40
		);
		add_action( "load-$hook", array( get_class(), 'screen_option' ) );

		$title = __( 'Settings', self::TEXT_DOMAIN );
		$hook = add_submenu_page(
			self::ADMIN_PAGE_SLUG,
			$title,
			$title,
			'administrator',
			self::ADMIN_SETTINGS_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_settings_page',
			)
		);
	}

	public static function set_screen( $status, $option, $value )
	{
		return $value;
	}

	public static function screen_option() {

		if( empty( $_GET['action'] ) ||
			empty( $_GET['contact'] ) ||
			$_GET['action'] !== 'edit' ||
			!is_numeric( $_GET['contact'] )
		) {

			$option = 'per_page';
			$args   = [
				'label'   => __( 'Call requests', self::TEXT_DOMAIN ),
				'default' => 5,
				'option'  => 'contacts_per_page'
			];

			add_screen_option( $option, $args );

			if ( ! class_exists( 'JLCWeCallYouTable' ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'contact-table.php' ) ) );

			self::$contact_table = new JLCWeCallYouTable();
		}
	}

	public static function print_admin_page()
	{
		//self::print_admin_notices();
/*
		if( !empty( $_GET['action'] ) &&
			!empty( $_GET['contact'] ) &&
			$_GET['action'] === 'edit' &&
			is_numeric( $_GET['contact'] )
		) {
			$file = __DIR__ . '/templates/admin/edit-contact.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
				return;
			}

			$contact = JLCWeCallYouMapper::get_contact( (int)$_GET['contact'] );

			include( $file );
		}
		else
		{
*/
			$file = __DIR__ . '/templates/admin/main.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
				return;
			}

			$list_table = self::$contact_table;

			include( $file );
/*
		}
*/
	}

	public static function print_admin_settings_page()
	{
		$file = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', 'settings.php' ) );

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
			return;
		}

		$form = JLCCustomForm::get_form(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCWeCallYouSettings.php',
			array(
				'admin_page_slug' => self::ADMIN_SETTINGS_PAGE_SLUG,
				'text_domain' => self::TEXT_DOMAIN
			)
		);

		include( $file );
	}

	////////////////////////////////
	// PUBLIC FORM
	////////////////////////////////

	/////////////////////////////////
	// MAIL
	/////////////////////////////////

	public static function get_notification_addresses()
	{
		//$val = get_option( self::NOTIFICATION_ADDR_KEY );
		$val = get_bloginfo( 'admin_email' );
		
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
/*
		$contact_addr = self::get_contact_email();
		if( !empty( $contact_addr ) && filter_var( $contact_addr, FILTER_VALIDATE_EMAIL ) )
		{
			$site = get_bloginfo( 'name' );

			//$reply_to_addr = $reply_to !== null ? $reply_to : $contact_addr;

			$ret[] = "From: $site <$contact_addr>";
			//$ret[] = "Reply-to: $reply_to_addr";
		}
*/	
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

	public static function send_contact_notification( $contact_id, $phone, $from_page, $from_url )
	{
		$mail_heading = get_bloginfo( 'name' ) . ' - ' . __( 'New contact', JLCWeCallYou::TEXT_DOMAIN );

		if( $from_page )
		{
			$page = get_post( (int)$from_page );
			if( $page )
				$from = sprintf( '%s (%s)', $page->post_title, get_permalink( $page->ID ) );
			elseif( $from_url )
				$from = $form_url;
			else
				$from = __( 'Unknown', self::TEXT_DOMAIN );
		}
		elseif( $from_url )
		{
			$from = $form_url;
		}
		else
		{
			$from = __( 'Unknown', self::TEXT_DOMAIN );
		}

		$mail_message = sprintf(
			__( 'The user %s has requested a phone call.\nFrom: %s\nYou can manage it at %s.', JLCWeCallYou::TEXT_DOMAIN ),
			sprintf( '<a href="tel:%s">%s</a>', preg_replace( '/ /', '', $phone ), $phone ),
			$from,
			'<a href="'.admin_url( 'admin.php?page=' . JLCWeCallYou::ADMIN_PAGE_SLUG  ).'">' . get_bloginfo( 'name' ) . '</a>'
		);

		$mail_message = JLCWeCallYou::wrap_mail( $mail_heading, $mail_message );

		$to = self::get_notification_addresses();

		wp_mail(
			$to,
			get_bloginfo( 'name' ) . ' - ' . __( 'New Call Request', JLCWeCallYou::TEXT_DOMAIN ),
			$mail_message,
			self::get_mail_headers( $email )
		);
	}

	// SHORTCODE

	public static function get_we_call_you_form( $atts = array(), $content = '' )
	{
		$form = JLCCustomForm::get_form(
			self::WE_CALL_YOU_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCWeCallYouContact.php',
			array(
				'thanks_page_option' => self::THANKS_PAGE_KEY,
				'text_domain' => self::TEXT_DOMAIN
			)
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	///////////////////////////////////////
	// DATE AND TIME
	///////////////////////////////////////
	public static function get_public_datetime_format()
	{
		return __( "Y/m/d H:i:s", self::TEXT_DOMAIN );
	}
}

JLCWeCallYou::initialize();

}
