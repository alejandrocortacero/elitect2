<?php
/**
 * Plugin Name: JLC Contact
 * Plugin URI:
 * Description: Custom contact form
 * Version: 2.4
 * Author: JLC
 * AUthor URI: www.jlc.es
 * Text Domain: jlc-contact-textdomain
 * License: EULA
 */

defined( 'ABSPATH' ) or die( 'Wrong Access' );

require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'mapper.php' ) ) );
//require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'form.php' ) ) );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'jlc-form/jlc-form.php' ) ) {


if( !class_exists( 'JLCCustomForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'jlc-form.php' ) ) );

class JLCContact
{
	const TEXT_DOMAIN = 'jlc-contact-textdomain';
	const VERSION = '2.4';
/*
	const FORM_DATA_ERROR 			= 1;
	const FATAL_ERROR 				= 2;
	const INEXISTENT_INSTANCE_ERROR = 3;
	const NO_MAIL_ERROR				= 4;

	const SETTINGS_SAVED	= 2051;
*/
	const ADMIN_PAGE_SLUG = 'jlc-contact-admin-page';
	const ADMIN_SETTINGS_PAGE_SLUG = 'jlc-contact-settings-admin-page';

	//const ADMIN_SAVE_SETTINGS_ACTION = 'jlc_contact_save_settins';
	//const READ_FORM_ACTION = 'jlc_contact_read';

	const ADMIN_SETTINGS_FORM_INTERNAL_ID = 'jlc_contact_settings_form';
	const CONTACT_FORM_INTERNAL_ID = 'jlc_contact_contact_form';
	

	const NOTIFICATION_ADDR_KEY = 'jlc-contact-notification-addresses';
	const CONTACT_EMAIL_KEY = 'jlc-contact-mail-address';
	const CONTACT_PAGE_KEY = 'jlc-contact-contact-page';// not referenced in any place except the settings form
	const CONTACT_PHONE_KEY = 'jlc-contact-phone';
	const CONTACT_MOBILE_KEY = 'jlc-contact-mobile';
	const CONTACT_WHATSAPP_KEY = 'jlc-contact-whatsapp';
	//const PRIVACY_POLICY_PAGE_KEY = 'jlc-contact-privacy-policy-page';
	const INFO_TEXT_KEY = 'jlc-contact-info-text';
	const USE_AJAX_FORM_KEY = 'jlc-contact-use-ajax-form';
	const THANKS_PAGE_KEY = 'jlc-contact-thanks-page';
	const CONTACT_ADDRESSES_LIST_KEY = 'jlc-contact-addresses-list';
	const GTAG_EVENT_CONVERSION_KEY = 'jlc-contact-gtag-event-conversion-key';

	protected static $contact_table;

	protected static $using_ajax_form;

	protected static $privacy_policy_id;
	protected static $privacy_policy_exists;
	protected static $privacy_policy_url;

	protected static $privacy_policy_short;

	protected static $contact_mail;
	protected static $contact_phone;
	protected static $contact_mobile;
	protected static $contact_whatsapp;
	protected static $contact_page;

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
		add_shortcode( 'jlc_contact_phone_link', array( get_class(), 'phone_link_shortcode' ) );
		add_shortcode( 'jlc_contact_mobile_link', array( get_class(), 'mobile_link_shortcode' ) );
		add_shortcode( 'jlc_contact_whatsapp_link', array( get_class(), 'whatsapp_link_shortcode' ) );
		add_shortcode( 'jlc_contact_email_link', array( get_class(), 'email_link_shortcode' ) );
		add_shortcode( 'jlc_contact_form', array( get_class(), 'get_contact_form' ) );
	}

	public static function install()
	{
		JLCContactMapper::install();

		JLCCustomForm::register_form(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCContactSettings.php',
			array(
				'admin_page_slug' => self::ADMIN_SETTINGS_PAGE_SLUG,
				'text_domain' => self::TEXT_DOMAIN
			),
			__FILE__
		);

		JLCCustomForm::register_form(
			self::CONTACT_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCContactContact.php',
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
			self::CONTACT_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCContactContact.php'
		);

		JLCCustomForm::unregister_form(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCContactSettings.php'
		);

		JLCContactMapper::uninstall();
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

	public static function get_contact_email()
	{
		if( self::$contact_mail === null )
			self::$contact_mail = get_option( self::CONTACT_EMAIL_KEY );

		return self::$contact_mail;
	}

	public static function get_contact_email_link( $text = null, $label = null )
	{
		$email = self::get_contact_email();

		if( !is_string( $email ) )
			return null;

		if( !is_string( $text ) )
			$text = $email;
		else
			$text = preg_replace( '/{email}/', $email, $text );

		if( !current_user_can( 'administrator' ) && ( !defined( 'WP_DEBUG' ) || !WP_DEBUG ) )
		{
			if( is_string( $label ) )
				$event = "gtag('event','click',{'event_category':'email','label':'$label'});";
			else
				$event = "gtag('event','click',{'event_category':'email'});";

			return sprintf( '<a href="mailto:%s" rel="nofollow" onclick="%s">%s</a>',
				$email,
				$event,
				$text
			);
		}
		else
		{
			return sprintf( '<a href="mailto:%s" rel="nofollow">%s</a>',
				$email,
				$text
			);
		}
	}

	public static function get_contact_phone()
	{
		if( self::$contact_phone === null )
			self::$contact_phone = get_option( self::CONTACT_PHONE_KEY );

		return self::$contact_phone;
	}

	public static function get_contact_mobile()
	{
		if( self::$contact_mobile === null )
			self::$contact_mobile = get_option( self::CONTACT_MOBILE_KEY );

		return self::$contact_mobile;
	}

	public static function get_contact_whatsapp()
	{
		if( self::$contact_whatsapp === null )
			self::$contact_whatsapp = get_option( self::CONTACT_WHATSAPP_KEY );

		return self::$contact_whatsapp;
	}
	

	public static function get_contact_phone_link( $text = null, $label = null )
	{
		$phone = self::get_contact_phone();

		if( !is_string( $phone ) )
			return null;

		$short_phone = preg_replace( '/\s/', '', $phone );

		if( !is_string( $text ) )
			$text = $phone;
		else
			$text = preg_replace( '/{phone}/', $phone, $text );

		if( !current_user_can( 'administrator' ) && ( !defined( 'WP_DEBUG' ) || !WP_DEBUG ) )
		{
			$gtag = get_option( self::GTAG_EVENT_CONVERSION_KEY );
			
			if( !empty( $gtag ) )
			{
				if( is_string( $label ) )
					$event = "gtag('event','click',{'event_category':'phone','label':'$label'});";
				else
					$event = "gtag('event','click',{'event_category':'phone'});";

				return sprintf( '<a href="tel:%s" target="_blank" rel="nofollow" onclick="%s">%s</a>',
					$short_phone,
					$event,
					$text
				);
			}
			else
			{
				return sprintf( '<a href="tel:%s" target="_blank" rel="nofollow">%s</a>',
					$short_phone,
					$text
				);
			}
		}
		else
		{
			return sprintf( '<a href="tel:%s" target="_blank" rel="nofollow">%s</a>',
				$short_phone,
				$text
			);
		}
	}

	public static function get_contact_mobile_link( $text = null, $label = null )
	{
		$phone = self::get_contact_mobile();

		if( !is_string( $phone ) )
			return null;

		$short_phone = preg_replace( '/\s/', '', $phone );

		if( !is_string( $text ) )
			$text = $phone;
		else
			$text = preg_replace( '/{phone}/', $phone, $text );

		if( !current_user_can( 'administrator' ) && ( !defined( 'WP_DEBUG' ) || !WP_DEBUG ) )
		{
			$gtag = get_option( self::GTAG_EVENT_CONVERSION_KEY );
			
			if( !empty( $gtag ) )
			{
				if( is_string( $label ) )
					$event = "gtag('event','click',{'event_category':'phone','label':'$label'});";
				else
					$event = "gtag('event','click',{'event_category':'phone'});";

				return sprintf( '<a href="tel:%s" target="_blank" rel="nofollow" onclick="%s">%s</a>',
					$short_phone,
					$event,
					$text
				);
			}
			else
			{
				return sprintf( '<a href="tel:%s" target="_blank" rel="nofollow">%s</a>',
					$short_phone,
					$text
				);
			}
		}
		else
		{
			return sprintf( '<a href="tel:%s" target="_blank" rel="nofollow">%s</a>',
				$short_phone,
				$text
			);
		}
	}

	public static function get_contact_whatsapp_link( $text = null, $label = null )
	{
		$phone = self::get_contact_whatsapp();

		if( !is_string( $phone ) )
			return null;

		$short_phone = preg_replace( '/[^\d]/', '', $phone );

		if( !is_string( $text ) )
			$text = $phone;
		else
			$text = preg_replace( '/{phone}/', $phone, $text );

		if( !current_user_can( 'administrator' ) && ( !defined( 'WP_DEBUG' ) || !WP_DEBUG ) )
		{
			$gtag = get_option( self::GTAG_EVENT_CONVERSION_KEY );
			
			if( !empty( $gtag ) )
			{
				if( is_string( $label ) )
					$event = "gtag('event','click',{'event_category':'phone','label':'$label'});";
				else
					$event = "gtag('event','click',{'event_category':'phone'});";

				return sprintf( '<a href="whatsapp://send/?phone=%s&text&source&data&app_absent" target="_blank" rel="nofollow" onclick="%s">%s</a>',
					$short_phone,
					$event,
					$text
				);
			}
			else
			{
				return sprintf( '<a href="whatsapp://send/?phone=%s&text&source&data&app_absent" target="_blank" rel="nofollow">%s</a>',
					$short_phone,
					$text
				);
			}
		}
		else
		{
			return sprintf( '<a href="whatsapp://send/?phone=%s&text&source&data&app_absent" target="_blank" rel="nofollow">%s</a>',
				$short_phone,
				$text
			);
		}
	}

	public static function get_contact_addresses_list()
	{
		return json_decode( get_option( self::CONTACT_ADDRESSES_LIST_KEY, array() ) );
	}

	public static function get_contact_page()
	{
		if( self::$contact_page === null )
			self::$contact_page = get_option( self::CONTACT_PAGE_KEY );

		return self::$contact_page;
	}

	///////////////////////////////////////
	// ADMIN
	///////////////////////////////////////

	public static function register_admin_pages()
	{
		$title = __( 'Contact', self::TEXT_DOMAIN );
		$hook = add_menu_page(
			$title,
			$title,
			'administrator',
			self::ADMIN_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_page'
			),
			'dashicons-email-alt',
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
				'label'   => __( 'Contact', self::TEXT_DOMAIN ),
				'default' => 5,
				'option'  => 'contacts_per_page'
			];

			add_screen_option( $option, $args );

			if ( ! class_exists( 'JLCContactTable' ) )
				require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'contact-table.php' ) ) );

			self::$contact_table = new JLCContactTable();
		}
	}

	public static function print_admin_page()
	{
		//self::print_admin_notices();

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

			$contact = JLCContactMapper::get_contact( (int)$_GET['contact'] );

			include( $file );
		}
		else
		{
			$file = __DIR__ . '/templates/admin/main.php';

			if( !is_readable( $file ) )
			{
				echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
				return;
			}

			$list_table = self::$contact_table;

			include( $file );
		}
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
			'JLCContactSettings.php',
			array(
				'admin_page_slug' => self::ADMIN_SETTINGS_PAGE_SLUG,
				'text_domain' => self::TEXT_DOMAIN
			)
		);

		include( $file );
	}
/*
	public static function save_settings()
	{
		$status = 1;

		if( !isset( $_POST[self::NOTIFICATION_ADDR_KEY] ) ||
			!isset( $_POST[self::CONTACT_PHONE_KEY] ) ||
			!isset( $_POST[self::CONTACT_EMAIL_KEY] ) ||
			!isset( $_POST[self::PRIVACY_POLICY_PAGE_KEY] ) ||
			!isset( $_POST[self::THANKS_PAGE_KEY] ) ||
			!isset( $_POST[self::GTAG_EVENT_CONVERSION_KEY] ) ||
			!isset( $_POST[self::INFO_TEXT_KEY] )
		) {
			$status = 0;
		}

		if( $status )
		{
			update_option( self::NOTIFICATION_ADDR_KEY, sanitize_text_field( $_POST[self::NOTIFICATION_ADDR_KEY] ) );
			update_option( self::CONTACT_EMAIL_KEY, sanitize_email( $_POST[self::CONTACT_EMAIL_KEY] ) );
			update_option( self::CONTACT_PHONE_KEY, sanitize_text_field( $_POST[self::CONTACT_PHONE_KEY] ) );
			update_option( self::PRIVACY_POLICY_PAGE_KEY, (int)sanitize_text_field( $_POST[self::PRIVACY_POLICY_PAGE_KEY] ) );
			update_option( self::GTAG_EVENT_CONVERSION_KEY, sanitize_text_field( $_POST[self::GTAG_EVENT_CONVERSION_KEY] ) );

			update_option( self::USE_AJAX_FORM_KEY, isset( $_POST[self::USE_AJAX_FORM_KEY] ) ? 'yes' : 'no' );
			update_option( self::THANKS_PAGE_KEY, (int)$_POST[self::THANKS_PAGE_KEY] );

			update_option( self::INFO_TEXT_KEY, wp_kses_post( $_POST[self::INFO_TEXT_KEY] ) );

			wp_safe_redirect(admin_url( 'admin.php?page=' . self::ADMIN_SETTINGS_PAGE_SLUG . '&status=' . self::SETTINGS_SAVED ) );
			exit;
		}

		wp_safe_redirect(admin_url( 'admin.php?page=' . self::ADMIN_SETTINGS_PAGE_SLUG . '&zrerror=' . self::FORM_DATA_ERROR ) );
		exit;
	}
*/
/*
	public static function answer_question()
	{
		// TODO: check NONCE
		if( empty( $_POST ) ||
			//!check_admin_referer( self::ADMIN_NEW_INSTANCE_ACTION, self::ADMIN_INSTANCE_NONCE ) ||
			empty( $_POST['question'] ) ||
			empty( $_POST['answer'] ) ||
			!is_numeric( $_POST['question'] ) ||
			!is_string( $_POST['answer'] ) )
		{
			wp_safe_redirect(admin_url( 'admin.php?page=' . self::ADMIN_QUESTIONS_PAGE_SLUG . '&error=' . self::FORM_DATA_ERROR ) );
			exit;
		}

		$consultation_id = (int)$_POST['question'];
		$answer = sanitize_textarea_field( $_POST['answer'] );
		$specialist = wp_get_current_user();

		$consultation = JLCSpecialistsMapper::get_consultation( $consultation_id );

		if( !$consultation )
		{
			wp_safe_redirect(admin_url( 'admin.php?page=' . self::ADMIN_QUESTIONS_PAGE_SLUG . '&error=' . self::FORM_DATA_ERROR ) );
			exit;
		}

		$user = new WP_User( $consulation->user );
		if( $user && $user->exists() )
			$user_name = !empty( $user->display_name ) ? $user->display_name : $user->user_login;
		else
			$user_name = $consultation->email;


		if(	false !== JLCSpecialistsMapper::answer_consultation(
			$consultation->ID,
			$answer,
			$specialist->ID,
			$consultation->email
		) ) {

			$email_heading = get_bloginfo( 'name' ) . ' - ' . __( 'Answer from our specialist', self::TEXT_DOMAIN );

			$mail_message = sprintf(
				__( "<b>Hi %s\n\nOur specialist has answered your question:</b>\n\n%s\n\n<b>Specialist answer:</b>\n\n%s\n\n<b>Thanks for use our services.</b>\n%s", self::TEXT_DOMAIN ),
				$user_name,
				$consultation->question,
				$answer,
				get_bloginfo('name')
			);

			$mail_message = self::wrap_mail( $email_heading, $mail_message );

			if( wp_mail(
				$consultation->email,
				get_bloginfo( 'name' ) . ' - ' . __( 'Specialists service', self::TEXT_DOMAIN ),
				$mail_message,
				array( 'Content-type: text/html; charset=utf-8' )
			) ) {

				wp_mail(
					array( 'marketing@jlc.es', 'info@zrsalud.es' ),
					get_bloginfo( 'name' ) . ' - ' . __( 'Specialists service', self::TEXT_DOMAIN ),
					$mail_message,
					array( 'Content-type: text/html; charset=utf-8' )
				);
				
				wp_safe_redirect(admin_url( 'admin.php?page=' . self::ADMIN_QUESTIONS_PAGE_SLUG . '&consultation=' . $consultation->ID . '$action=view&status=' . self::QUESTION_ANSWERED ) );
			}
			else
			{
				wp_safe_redirect(admin_url( 'admin.php?page=' . self::ADMIN_QUESTIONS_PAGE_SLUG . '&error=' . self::NO_MAIL_ERROR ) );
			}
			exit;
		}
		else
		{
			wp_safe_redirect(admin_url( 'admin.php?page=' . self::ADMIN_QUESTIONS_PAGE_SLUG . '&error=' . self::FATAL_ERROR ) );
			exit;
		}
	}
*/

	////////////////////////////////
	// PUBLIC FORM
	////////////////////////////////

	//TODO: Process non ajax request
/*
	public static function read_form()
	{
		if( ( !defined( 'DOING_AJAX') || !DOING_AJAX ) &&
			isset( $_POST['action'] ) &&
			$_POST['action'] === self::READ_FORM_ACTION 
		) {
			$result = JLCContactForm::read_non_ajax_form();
//var_dump( $result );
//echo '<hr />';
			if( isset( $result['code'] ) &&
				$result['code'] === 0 )
			{
				$thanks_page_id = get_option( self::THANKS_PAGE_KEY );
				if( !empty( $thanks_page_id ) &&
					$url = get_permalink( $thanks_page_id ) )
				{
					wp_safe_redirect( $url );
					exit;
				}
			}
		}
	}

	public static function print_footer_scripts()
	{
		global $post;

		$thanks_page = (int)get_option( self::THANKS_PAGE_KEY );
		if( $post && $thanks_page == $post->ID )
		{
			$gtag_conversion = get_option( self::GTAG_EVENT_CONVERSION_KEY );
			if( !empty( $gtag_conversion ) )
			{
			?>
				<script type="text/javascript">
					gtag('event', 'conversion', {'send_to': '<?php echo $gtag_conversion; ?>' });
				</script>
			<?php
			}
		}
	}

	public static function read_ajax_form()
	{
		echo JLCContactForm::read_ajax_form();
		wp_die();
	}
*/
	/////////////////////////////////
	// MAIL
	/////////////////////////////////

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

	public static function send_contact_notification( $contact_id, $name, $email, $phone, $subject, $message )
	{
		$mail_heading = get_bloginfo( 'name' ) . ' - ' . __( 'New contact', JLCContact::TEXT_DOMAIN );
		$mail_message = sprintf(
			__( 'The user %s (%s - %s) has contact us in %s:\nSubject:\n%s\nMessage:\n%s\n\n\n\nYou can manage it at %s.', JLCContact::TEXT_DOMAIN ),
			$name,
			sprintf( '<a href="mailto:%s">%s</a>', $email, $email ),
			sprintf( '<a href="tel:%s">%s</a>', preg_replace( '/ /', '', $phone ), $phone ),
			get_bloginfo( 'name' ),
			$subject,
			$message,
			'<a href="'.admin_url( 'admin.php?page=' . JLCContact::ADMIN_PAGE_SLUG . '&contact=' . $contact_id . '&action=edit' ).'">' . get_bloginfo( 'name' ) . '</a>'
		);

		$mail_message = JLCContact::wrap_mail( $mail_heading, $mail_message );

		$to = self::get_notification_addresses();

		wp_mail(
			$to,
			get_bloginfo( 'name' ) . ' - ' . __( 'New contact', JLCContact::TEXT_DOMAIN ),
			$mail_message,
			self::get_mail_headers( $email )
		);
	}

	// SHORTCODE

	public static function phone_link_shortcode( $atts, $content = '' )
	{
		$label = isset( $atts['label'] ) ? $atts['label'] : null;

		if( empty( $content ) )
			$content = null;
		
		return self::get_contact_phone_link( $content, $label );
	}

	public static function mobile_link_shortcode( $atts, $content = '' )
	{
		$label = isset( $atts['label'] ) ? $atts['label'] : null;

		if( empty( $content ) )
			$content = null;
		
		return self::get_contact_mobile_link( $content, $label );
	}

	public static function whatsapp_link_shortcode( $atts, $content = '' )
	{
		$label = isset( $atts['label'] ) ? $atts['label'] : null;

		if( empty( $content ) )
			$content = null;
		
		return self::get_contact_whatsapp_link( $content, $label );
	}

	public static function email_link_shortcode( $atts, $content = '' )
	{
		$label = isset( $atts['label'] ) ? $atts['label'] : null;

		if( empty( $content ) )
			$content = null;
		
		return self::get_contact_email_link( $content, $label );
	}

	public static function get_contact_form( $atts = array(), $content = '' )
	{
		$form = JLCCustomForm::get_form(
			self::CONTACT_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'JLCContactContact.php',
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

JLCContact::initialize();

}
