<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
// TODO: mira el todo de los comentarios
/*
 * Index:
 * - GETTERS
 * - INIT
 * - FEED
 * - MAIN_QUERY
 * - WOOCOMMERCE
 * - COMMENTS
 * - ADMIN
 * - AJAX
 * - LAZY LOAD
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if( is_plugin_active( 'jlc-form/jlc-form.php' ) &&
	!class_exists( 'JLCCustomForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'jlc-form.php' ) ) );

class TrainerSiteTheme
{
	const TEXT_DOMAIN = 'trainersitethemetextdomain';

	const IS_INSTALLED_KEY = 'trainersite_is_installed';

	const ADMIN_SETTINGS_PAGE_SLUG = 'trainersite_admin_settings_page';
	const ADMIN_SAVE_SETTINGS_ACTION = 'trainersite_admin_save_settings';

	const ADMIN_SETTINGS_FORM_INTERNAL_ID = 'trainersite_admin_form_internal_id';
	const SITE_STYLE_FORM_INTERNAL_ID = 'trainersite_site_style_form_internal_id';
	const HOME_SETTINGS_FORM_INTERNAL_ID = 'trainersite_home_settings_form_internal_id';

	//const SEARCH_PRODUCTS_ACTION = 'trainersite_search';

	// PAGES
	const HOME_PAGE_KEY = 'trainer_site_home_page';
	const BLOG_PAGE_KEY = 'trainer_site_blog_page';
	const ACCOUNT_PAGE_KEY = 'trainer_site_account_page';
	const SETTINGS_PAGE_KEY = 'trainer_site_settings_page';
	const SITE_STYLE_PAGE_KEY = 'trainer_site_site_style_page';
	const HOME_SETTINGS_PAGE_KEY = 'trainer_site_home_settings_page';

	const TRAINER_EXERCISES_PAGE_KEY = 'trainer_site_trainer_exercises_page';

	// CUSTOMIZATION
	const SITE_BIG_LOGO_KEY = 'trainer_site_big_logo';
	const SITE_SMALL_LOGO_KEY = 'trainer_site_small_logo';

	const MAIN_COLOR_KEY = 'trainer_site_main_color';
	const SECONDARY_COLOR_KEY = 'trainer_site_secondary_color';
	const BACKGROUND_COLOR_KEY = 'trainer_site_background_color';
	const TEXT_COLOR_KEY = 'trainer_site_text_color';
	const HEADING_COLOR_KEY = 'trainer_site_heading_color';

	const COVER_BACKGROUND_KEY = 'trainer_site_cover_background';
	const HOME_SUBTITLE_KEY = 'trainer_site_home_subtitle';

	// ACTIONS
	const NEW_EXERCISE_FORM_ACTION = 'trainer_site_new_exercise_form';
	const LOAD_EXERCISE_ACTION = 'trainer_site_load_exercise';
	const INSERT_EXERCISE_ACTION = 'trainer_site_insert_exercise';
	const EDIT_EXERCISE_ACTION = 'trainer_site_edit_exercise';
	const CLONE_EXERCISE_ACTION = 'trainer_site_clone_exercise';
	const DELETE_EXERCISE_ACTION = 'trainer_site_delete_exercise';

	protected static $version;

	protected static $installed;

	public static function initialize()
	{
		// INIT ACTIONS
		add_action( 'after_setup_theme', function(){
			load_theme_textdomain(
				self::TEXT_DOMAIN,
				get_template_directory().DIRECTORY_SEPARATOR.'/languages'
			);
		});

		add_action( 'after_setup_theme', array( get_class(), 'check_required_plugins' ) );
		add_action( 'after_setup_theme', array( get_class(), 'after_setup_theme' ) );
		add_action( 'after_switch_theme', array( get_class(), 'after_switch_theme' ) );

		add_action( 'switch_theme', array( get_class(), 'switch_theme' ) );

		add_filter( 'clean_url', array( get_class(), 'defer_parsing_of_js' ), 11, 1 );

		remove_action( 'wp_head', 'wp_generator' );

		add_filter( 'script_loader_tag', array( get_class(), 'jquery_inlined' ), 99, 3 );
		add_action( 'wp_enqueue_scripts', array( get_class(), 'enqueue_scripts' ), 90 );
		add_action( 'get_footer', array( get_class(), 'enqueue_footer_styles' ), 99 );

		register_nav_menu( 'trainersite-header-menu', __( 'Site header menu', self::TEXT_DOMAIN ) );

		add_action( 'widgets_init', array( get_class(), 'register_widgets' ) );
		add_action( 'widgets_init', array( get_class(), 'register_sidebars' ) );

		add_filter( 'template_include', array( get_class(), 'template_include' ), 99 );

		add_filter( 'display_post_states', array( get_class(), 'post_states' ), 10, 2 );

		// MAIN_QUERY
		//add_action( 'pre_get_posts', array( get_class(), 'edit_search_query' ) );

		// FEED
		//add_filter( 'request', array( get_class(), 'feed_request' ) );

		add_action( 'wp_head', array( get_class(), 'print_custom_style' ), 99, 0 );


		// ADMIN
		add_action(
			'admin_menu',
			array(
				get_class(),
				'register_admin_pages'
			)
		);

		// AJAX
/*
		add_action(
			'wp_ajax_' . self::SEARCH_PRODUCTS_ACTION,
			array(
				get_class(),
				'ajax_search_products'
			)
		);
		add_action(
			'wp_ajax_nopriv_' . self::SEARCH_PRODUCTS_ACTION,
			array(
				get_class(),
				'ajax_search_products'
			)
		);
*/

		self::initialize_extensions();

		add_action( 'wp_ajax_' . self::NEW_EXERCISE_FORM_ACTION, array( get_class(), 'new_exercise_form' ) );
		add_action( 'wp_ajax_' . self::LOAD_EXERCISE_ACTION, array( get_class(), 'load_exercise_card' ) );
		add_action( 'wp_ajax_' . self::INSERT_EXERCISE_ACTION, array( get_class(), 'load_exercise_icon' ) );
		add_action( 'wp_ajax_' . self::EDIT_EXERCISE_ACTION, array( get_class(), 'edit_exercise_form' ) );
		add_action( 'wp_ajax_' . self::CLONE_EXERCISE_ACTION, array( get_class(), 'clone_exercise' ) );
		add_action( 'wp_ajax_' . self::DELETE_EXERCISE_ACTION, array( get_class(), 'delete_exercise' ) );
	}
	
	/////////////////////////////////////////
	// GETTERS
	/////////////////////////////////////////

	public static function get_version()
	{
		if( self::$version )
			return self::$version;
	
		$theme = wp_get_theme();
		self::$version = !$theme ? null : $theme->get( 'Version' );

		return self::$version;
	}

	protected static function is_installed()
	{
		if( self::$installed === null )
			self::$installed = get_blog_option( null, self::IS_INSTALLED_KEY ) == 'yes';

		return self::$installed;
	}

	protected static function get_forms()
	{
		$dir = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) );

		return array(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ThemeSettings.php',
				'args' => array(
					'admin_page_slug' => 'themes.php?page=' . self::ADMIN_SETTINGS_PAGE_SLUG,
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::SITE_STYLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'SiteStyle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOME_SETTINGS_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HomeSettings.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			)
		);
	}


	public static function get_default_menu_items()
	{
		$ret = apply_filters( 'trainersitetheme_default_menu_items', array() );

		$my_account = get_post( get_blog_option( null, self::ACCOUNT_PAGE_KEY ) );
		if( $my_account )
			$ret['account'] = array( 'url' => get_permalink( $my_account->ID ), 'text' => $my_account->post_title );

		if( class_exists( 'EpointPersonalTrainer' ) && current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) )
		{
			$settings = get_post( get_blog_option( null, self::SETTINGS_PAGE_KEY ) );
			if( $settings )
				$ret['settings'] = array( 'url' => get_permalink( $settings->ID ), 'text' => $settings->post_title );
		}

		$contact_url = self::get_contact_page_url();
		$ret['contact'] = array( 'url' => $contact_url, 'text' => __( 'Contact', self::TEXT_DOMAIN ) );

		if( is_user_logged_in() )
		{
			$ret['logout'] = array( 'url' => wp_logout_url(), 'text' => __( 'Log out', self::TEXT_DOMAIN ) );
			
		}

		return $ret;
	}

	public static function get_legal_menu_items()
	{
		$ret = array();

		$privacy_id = (int) get_option( 'wp_page_for_privacy_policy' );
		$privacy_link = $privacy_id ? get_permalink( $privacy_id ) : '#';
		$ret['privacy'] = array( 'url' => $privacy_link, 'text' => __( 'Privacy policy', self::TEXT_DOMAIN ) );

		if( class_exists( 'JLCCookies' ) &&
			( $cookies_id = JLCCookies::get_cookies_page_id() ) &&
			( $cookies_page = get_post( $cookies_id ) ) &&
			$cookies_page->post_status == 'publish' &&
			( $cookies_link = get_permalink( $cookies_id ) ) )
			$ret['cookies'] = array( 'url' => $cookies_link, 'text' => $cookies_page->post_title );


		return apply_filters( 'trainersitetheme_legal_menu_items', $ret );
	}


	public static function get_contact_page_url()
	{
		if( !class_exists( 'JLCContact' ) )
			return null;

		$contact = JLCContact::get_contact_page();
		$contact_link = $contact ? get_permalink( $contact ) : '#';

		return $contact_link;
	}

	public static function get_svg_file_content( $file, $rel = true )
	{
		if( is_array( $file ) )
			$file = implode( DIRECTORY_SEPARATOR, $file );

		if( $rel )
			$file = __DIR__ . DIRECTORY_SEPARATOR . $file;

		if( !is_readable( $file ) )
			return;

		ob_start();
		include( $file );
		$content = ob_get_clean();

		$content = preg_replace( '/^<\?xml([^?])*\?>/', '', $content );
		
		return $content;
	}

	/////////////////////////////////////////
	// CUSTOMIZATION
	/////////////////////////////////////////

	public static function get_big_logo_url()
	{
		$default = get_template_directory_uri() . '/img/logo.png';

		$logo_attachment = get_blog_option( null, self::SITE_BIG_LOGO_KEY );
		if( !$logo_attachment )
			return $default;

		$url = wp_get_attachment_url( $logo_attachment );
		
		return $url ? $url : $default;
	}

	public static function get_small_logo_url()
	{
		$default = get_template_directory_uri() . '/img/logo.png';

		$logo_attachment = get_blog_option( null, self::SITE_SMALL_LOGO_KEY );
		if( !$logo_attachment )
			return $default;

		$url = wp_get_attachment_url( $logo_attachment );
		
		return $url ? $url : $default;
	}

	public static function get_main_color()
	{
		return get_blog_option( null, self::MAIN_COLOR_KEY, '#d8d54b' );
	}

	public static function get_secondary_color()
	{
		return get_blog_option( null, self::SECONDARY_COLOR_KEY, '#3b3b3b' );
	}

	public static function get_background_color()
	{
		return get_blog_option( null, self::BACKGROUND_COLOR_KEY, '#FFFFFF' );
	}

	public static function get_text_color()
	{
		return get_blog_option( null, self::TEXT_COLOR_KEY, '#111111' );
	}

	public static function get_heading_color()
	{
		return get_blog_option( null, self::HEADING_COLOR_KEY, '#000000' );
	}

	public static function color_luminance( $hex, $percent ) {
	
		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';
		
		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		
		// convert to decimal and change luminosity
		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $hex, $i*2, 2 ) );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
			$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}		
		
		return $new_hex;
	}

	public static function rgba_color( $hex, $opacity ) {
	
		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		
		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		
		$dec = array();	
		for ($i = 0; $i < 3; $i++) {
			$dec[$i] = hexdec( substr( $hex, $i*2, 2 ) );
			$dec[$i] = min( max( 0, $dec ), 255 ); 
		}		
		
		return sprintf( 'rgba(%s,%s,%s,%s)', $dec[0], $dec[1], $dec[2], $opacity );
	}

	public static function get_home_cover_background_url()
	{
		$default = get_template_directory_uri() . '/img/photos/default_home_cover.jpg';

		$bg_attachment = get_blog_option( null, self::COVER_BACKGROUND_KEY );
		if( !$bg_attachment )
			return $default;

		$url = wp_get_attachment_url( $bg_attachment );
		
		return $url ? $url : $default;
	}

	/////////////////////////////////////////
	// PRINTERS
	/////////////////////////////////////////

	protected static function sort_menu_items( $items, $parent )
	{
		$ret = array();
		$unsorted = array();

		while( !empty( $items ) )
		{
			$item = array_shift( $items );
			if( (int)$item->menu_item_parent == (int)$parent )
				$ret[$item->ID] = $item;
			else
				$unsorted[$item->ID] = $item;
		}

		foreach( $ret as $item )
		{
			$item->children = self::sort_menu_items( $unsorted, $item->ID );
			$unsorted = array_diff_key( $unsorted, $item->children );
		}

		return $ret;
	}

	public static function get_menu_items( $menu_name )
	{
		$locations = get_nav_menu_locations();
		$menu_id = $locations[ $menu_name ] ;
		$menu_object = wp_get_nav_menu_object($menu_id);
		$items = wp_get_nav_menu_items( $menu_object );

		return self::sort_menu_items( $items, null );
	}
	
	public static function print_header_menu()
	{
		if( !has_nav_menu( 'trainersite-header-menu' ) )
		{
			$menu_items = self::get_default_menu_items();
			get_template_part( 'templates/header', 'defaultmenu' );
		}
		else
		{
			get_template_part( 'templates/header', 'custommenu' );
/*
			wp_nav_menu( array(
				'menu' => 'trainersite-header-menu',
				'menu_class' => 'nav navbar-nav navbar-right',
				'container' => false,
				'echo' => true
			) );
*/
		}
	}

	public static function print_menu_item( $item )
	{
		$template = locate_template( implode( DIRECTORY_SEPARATOR, array( 'templates', 'menu-item.php' ) ) );
		if( is_readable( $template ) )
			include( $template );
	}

	public static function print_custom_style()
	{
		$template = locate_template( implode( DIRECTORY_SEPARATOR, array( 'templates', 'custom-style.php' ) ) );
		if( is_readable( $template ) )
			include( $template );
	
	}

/*
	public static function print_social_links()
	{
		$template_uri = get_template_directory_uri() . '/img/social/';

		$links = array(
			array(
				'url' => '#',
				'rel' => 'nofollow',
				'imgurl' => $template_uri . 'mail.png',
				'title' => __( 'Send mail', self::TEXT_DOMAIN )
			),
			array(
				'url' => '#',
				'rel' => 'external',
				'imgurl' => $template_uri . 'facebook.png',
				'title' => __( 'Facebook', self::TEXT_DOMAIN )
			),
			array(
				'url' => '#',
				'rel' => 'external',
				'imgurl' => $template_uri . 'instagram.png',
				'title' => __( 'Instagram', self::TEXT_DOMAIN )
			),
			array(
				'url' => '#',
				'rel' => 'external',
				'imgurl' => $template_uri . 'star.png',
				'title' => __( 'Reverbnation', self::TEXT_DOMAIN )
			),
			array(
				'url' => '#',
				'rel' => 'external',
				'imgurl' => $template_uri . 'youtube.png',
				'title' => __( 'YouTube', self::TEXT_DOMAIN )
			),
			array(
				'url' => '#',
				'rel' => 'external',
				'imgurl' => $template_uri . 'twitter.png',
				'title' => __( 'Twitter', self::TEXT_DOMAIN )
			),
			array(
				'url' => get_bloginfo( 'rss2_url' ),
				'rel' => 'bookmark',
				'imgurl' => $template_uri . 'rss.png',
				'title' => __( 'RSS', self::TEXT_DOMAIN )
			)
		);

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'social-links.php' ) ) );
	}
*/

/*
	public static function comments_popup_link()
	{
		comments_popup_link(
			__( 'No comments', self::TEXT_DOMAIN ),
			__( '1 Comment', self::TEXT_DOMAIN ),
			__( '% Comments', self::TEXT_DOMAIN ),
			'list-comment-link'
		);
	}
*/

	/////////////////////////////////////////
	// INIT
	/////////////////////////////////////////

	public static function check_required_plugins()
	{
		$plugins = apply_filters(
			'active_plugins',
			get_option( 'active_plugins' )
		);

		$well =
			in_array(
				'jlc-form/jlc-form.php',
				$plugins
			);

		$well = true;

		if( !$well )
		{
			if( !is_admin() )
			{
				wp_redirect( get_template_directory_uri() . '/unavailable.php' );
				exit;
			}
			else
			{
				add_action( 'admin_notices', function(){echo '<div class="error" style="padding:10px;font-size:20px;">' . __( 'Some required plugin by current theme is not activated.', self::TEXT_DOMAIN ) . '</div>';} );

			}
		}
	}

	public static function after_setup_theme()
	{
		add_theme_support( 'post-thumbnails' );

		if( !current_user_can( 'administrator' ) )
			show_admin_bar( false );

			self::install_forms();
		if( !self::is_installed() )
		{
			self::install_roles();
			self::install_pages();
			self::install_forms();

			update_blog_option( get_current_blog_id(), self::IS_INSTALLED_KEY, 'yes' );

			$blog_details = get_blog_details( get_current_blog_id() );
			wp_redirect( $blog_details->siteurl );
		}

	}

	protected static function install_forms()
	{
		if( class_exists( 'JLCCustomForm' ) )
		{
			foreach( self::get_forms() as $form_id => $form )
				JLCCustomForm::register_form(
					$form_id,
					$form['dir'],
					$form['file'],
					$form['args'],
					__FILE__
				);

			if( class_exists( 'EpointPersonalTrainer' ) )
			{
				foreach( EpointPersonalTrainer::get_subsites_forms() as $form_id => $form )
				{
					if( $form_id == EpointPersonalTrainer::REGISTER_USER_FORM_INTERNAL_ID )
						$form['args']['success_page_id'] = get_blog_option( null, self::ACCOUNT_PAGE_KEY, null );

					JLCCustomForm::register_form(
						$form_id,
						$form['dir'],
						$form['file'],
						$form['args'],
						__FILE__
					);
				}
			}
			
		}
	}

	protected static function install_roles()
	{
		if( class_exists( 'EpointPersonalTrainer' ) )
		{
			if( !get_role( EpointPersonalTrainer::TRAINER_ROLE ) )
				add_role( EpointPersonalTrainer::TRAINER_ROLE, __( 'Trainer', self::TEXT_DOMAIN ), array( 'read_private_pages' => true ) );

			if( !get_role( EpointPersonalTrainer::SPORTSMAN_ROLE ) )
				add_role( EpointPersonalTrainer::SPORTSMAN_ROLE, __( 'Sportsman', self::TEXT_DOMAIN ), array() );
		}
	}

	protected static function install_pages()
	{
		if( class_exists( 'EpointPersonalTrainer' ) )
		{
			$blog_details = get_blog_details( get_current_blog_id() );

			update_blog_option( get_current_blog_id(), 'show_on_front', 'page' );

			$body_content = '<hr /><h2 style="text-align: center;">Personalice el contenido</h2><h3 style="text-align: center;">Acceda a la sección "Ajustes" para editar el contenido de esta página.</h3><hr />';

			$page_id = wp_insert_post( array(
				'post_content' => $body_content,
				'post_title' => $blog_details->blogname,
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::HOME_PAGE_KEY, $page_id );
			update_blog_option( get_current_blog_id(), 'page_on_front', $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '[trainersite_latest_posts /]',
				'post_title' => __( 'Blog', self::TEXT_DOMAIN ),
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::BLOG_PAGE_KEY, $page_id );
			update_blog_option( get_current_blog_id(), 'page_for_posts', $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Settings', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-settings',
				'post_status' => 'private',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::SETTINGS_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Site style', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-site-style',
				'post_status' => 'private',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::SITE_STYLE_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Home Settings', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-home-settings',
				'post_status' => 'private',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::HOME_SETTINGS_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Exercises Gallery', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-exercises',
				'post_status' => 'private',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_EXERCISES_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'My Account', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-my-account',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::ACCOUNT_PAGE_KEY, $page_id );
		}
	}

	public static function after_switch_theme()
	{
	}

	public static function switch_theme( $new_theme )
	{
		if( class_exists( 'JLCCustomForm' ) )
		{
			foreach( self::get_forms() as $form_id => $form )
				JLCCustomForm::unregister_form(
					$form_id,
					$form['dir'],
					$form['file']
				);
		}
	}

	public static function initialize_extensions()
	{
		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'PageMeta.php' ) ) );
		TrainerSiteThemePageMeta::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'LazyLoad.php' ) ) );
		TrainerSiteThemeLazyLoad::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'Facebook.php' ) ) );
		TrainerSiteThemeFacebook::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'GoogleMaps.php' ) ) );
		TrainerSiteThemeGoogleMaps::initialize();
	
		
		if( is_plugin_active( 'woocommerce/woocommerce.php' ) )
		{	
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'WooCommerce.php' ) ) );
			TrainerSiteThemeWooCommerce::initialize();
		}
	}

	public static function template_include( $template )
	{
		if( !self::is_installed() )
		{
		}

		return $template;
	}

	public static function post_states( $post_states, $post )
	{
		if( $post->ID == get_blog_option( null, self::SETTINGS_PAGE_KEY ) )
			$post_states[self::SETTINGS_PAGE_KEY] = __( 'Trainer Settings Page', self::TEXT_DOMAIN );

		if( $post->ID == get_blog_option( null, self::SITE_STYLE_PAGE_KEY ) )
			$post_states[self::SITE_STYLE_PAGE_KEY] = __( 'Site Style Page', self::TEXT_DOMAIN );

		if( $post->ID == get_blog_option( null, self::HOME_SETTINGS_PAGE_KEY ) )
			$post_states[self::HOME_SETTINGS_PAGE_KEY] = __( 'Home Settings Page', self::TEXT_DOMAIN );

		if( $post->ID == get_blog_option( null, self::TRAINER_EXERCISES_PAGE_KEY ) )
			$post_states[self::TRAINER_EXERCISES_PAGE_KEY] = __( 'Trainer Exercises Page', self::TEXT_DOMAIN );

		if( $post->ID == get_blog_option( null,  self::ACCOUNT_PAGE_KEY ) )
			$post_states[self::ACCOUNT_PAGE_KEY] = __( 'My Account Page', self::TEXT_DOMAIN );

		return $post_states;
	}

	public static function defer_parsing_of_js ( $url )
	{
		if ( FALSE === strpos( $url, '.js' ) ) return $url;
		if ( is_admin() || strpos( $url, 'ampproject' ) || strpos( $url, 'jquery.js' ) ) return $url;
		return "$url' defer='defer";
	}

	public static function jquery_inlined( $tag, $handle, $src )
	{
		if( is_admin() || $handle !== 'jquery-core' )
			return $tag;

		ob_start();
?><script type="text/javascript"><?php
		include( implode( DIRECTORY_SEPARATOR, array( WPINC, 'js', 'jquery', 'jquery.js' ) ) );
?></script><?php
		return ob_get_clean();
	}

	public static function enqueue_scripts()
	{
		$version = self::get_version();

		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );

		//wp_enqueue_style( 'custom-fontawesome-css', get_template_directory_uri() . '/css/all.min.css', array(), $version );

		//wp_enqueue_script( 'jquery-ui-draggable' );
		//wp_enqueue_script( 'jquery-ui-droppable' );


		wp_enqueue_style( 'trainersite-font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), $version );
		wp_enqueue_style( 'trainersite-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), $version );
		wp_enqueue_style( 'trainersite-bootstrap-theme-css', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), $version );

		//wp_enqueue_script( 'trainersite-select2-script', get_template_directory_uri() . '/js/select2.min.js', array( 'jquery' ), $version, true );

		wp_enqueue_script( 'trainersite-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), $version, true );
		//wp_enqueue_script( 'jquery-ui-autocomplete' );

		//wp_enqueue_script( 'trainersite-images-loaded-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), $version, true );
		//wp_enqueue_script( 'trainersite-masonry-js', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), $version, true );

		/*
		if( is_page_template( 'page_gallery.php' ) ) {
			global $woocommerce;
			if( !empty( $woocommerce ) )
			{
				wp_enqueue_script( 'photoswipe' );
				wp_enqueue_script( 'photoswipe-ui-default' );

				wp_enqueue_style( 'photoswipe' );
				wp_enqueue_style( 'photoswipe-default-skin' );

				add_action( 'wp_footer', 'woocommerce_photoswipe' );
			}
		}
		*/

		wp_enqueue_script( 'trainersite-global-js', get_template_directory_uri() . '/js/global.js', array( 'jquery'), $version, true );

/*
		wp_localize_script( 'trainersite-global-js', 'TrainerSite', array(
			//'search_product_url' => admin_url( 'admin-ajax.php' ) . '?action=' . self::SEARCH_PRODUCTS_ACTION
		) );
*/
	}

	public static function enqueue_footer_styles()
	{
		$version = self::get_version();

		//wp_enqueue_style( 'trainersite-select2-style', get_template_directory_uri() . '/css/select2.min.css', array(), $version );

		//wp_enqueue_style( 'jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	}

	public static function register_widgets()
	{
	}

	public static function register_sidebars()
	{
		register_sidebar( array(
			'name' => __( 'Side sidebar', self::TEXT_DOMAIN ),
			'id' => 'trainersite-side-sidebar',
			'before_title' => '',
			'after_title' => ''
			
		) );

	}
	
	/////////////////////////////////////////
	// FEED
	/////////////////////////////////////////
/*
	public static function feed_request( $query )
	{
		if( isset( $query['feed'] ) )
			$query['post_type'] = array( EpointNews::POST_TYPE );

		return $query;
	}
*/


	public static function print_breadcrumbs()
	{
       
		// Settings
		$home_title         = __( 'Home', self::TEXT_DOMAIN );
		  
		// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
		// Get the query & post information
		global $post,$wp_query;
		   
		// Do not display on the homepage
		if ( !is_front_page() ) {
		   
			// Build the breadcrums
			echo '<ol class="breadcrumb">';
			echo '<li><span class="glyphicon glyphicon-map-marker"></span></li>';
			   
			// Home page
			echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
			   
			if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
				  
				echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title('', false) . '</strong></li>';
				  
			} else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
				  
				// If post is a custom post type
				$post_type = get_post_type();
				  
				// If it is a custom post type display name and link
				if( $post_type && $post_type != 'post') {
					  
					$post_type_object = get_post_type_object($post_type);
					$post_type_archive = get_post_type_archive_link($post_type);
				  
					echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
				  
				}
				  
				$custom_tax_name = get_queried_object()->name;
				echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
				  
			} else if ( is_single() ) {
				  
				// If post is a custom post type
				$post_type = get_post_type();
				  
				// If it is a custom post type display name and link
				if($post_type != 'post') {
					  
					if( $post_type == 'product' )
					{
						$post_type_object = get_post_type_object($post_type);
						$post_type_archive = self::get_shop_link();
					}
					else
					{
						$post_type_object = get_post_type_object($post_type);
						$post_type_archive = get_post_type_archive_link($post_type);
					}
				  
					echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
				  
				}
				  
				// Get post category info
				$category = get_the_category();
				 
				if(!empty($category)) {
				  
					// Get last category post is in
					$cats_values = array_values($category);
					$last_category = end($cats_values);
					  
					// Get parent any categories and create array
					$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
					$cat_parents = explode(',',$get_cat_parents);
					  
					// Loop through parent categories and store in variable $cat_display
					$cat_display = '';
					foreach($cat_parents as $parents) {
						$cat_display .= '<li class="item-cat">'.$parents.'</li>';
					}
				 
				}
				  
				$custom_taxonomy = null;
				if( $post_type == 'product' )
					$custom_taxonomy = 'product_cat';

				// If it's a custom post type within a custom taxonomy
				$taxonomy_exists = taxonomy_exists($custom_taxonomy);
				if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
					   
					$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
					if( !empty( $taxonomy_terms ) )
					{
						$cat_id         = $taxonomy_terms[0]->term_id;
						$cat_nicename   = $taxonomy_terms[0]->slug;
						$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
						$cat_name       = $taxonomy_terms[0]->name;
					}
				}
				  
				// Check if the post is in a category
				if(!empty($last_category)) {
					echo $cat_display;
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
					  
				// Else if post is in a custom taxonomy
				} else if(!empty($cat_id)) {
					  
					echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
				  
				} else {
					  
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
					  
				}
				  
			} else if ( is_category() ) {
				   
				// Category page
				echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
				   
			} else if ( is_page() ) {
				   
				// Standard page
				if( $post->post_parent ){
					   
					// If child page, get parents 
					$anc = get_post_ancestors( $post->ID );
					   
					// Get parents in the right order
					$anc = array_reverse($anc);
					   
					// Parent page loop
					if ( !isset( $parents ) ) $parents = null;
					foreach ( $anc as $ancestor ) {
						$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
					}
					   
					// Display parent pages
					echo $parents;
					   
					// Current page
					echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
					   
				} else {
					   
					// Just display current page if not parents
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
					   
				}
				   
			} else if ( is_tag() ) {
				   
				// Tag page
				   
				// Get tag information
				$term_id        = get_query_var('tag_id');
				$taxonomy       = 'post_tag';
				$args           = 'include=' . $term_id;
				$terms          = get_terms( $taxonomy, $args );
				$get_term_id    = $terms[0]->term_id;
				$get_term_slug  = $terms[0]->slug;
				$get_term_name  = $terms[0]->name;
				   
				// Display the tag name
				echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
			   
			} elseif ( is_day() ) {
				   
				// Day archive
				   
				// Year link
				echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html( __( 'Archives', self::TEXT_DOMAIN ) ) . '</a></li>';
				   
				// Month link
				echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html( __( 'Archives', self::TEXT_DOMAIN ) ) . '</a></li>';
				   
				// Day display
				echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . esc_html( __( 'Archives', self::TEXT_DOMAIN ) ) . '</strong></li>';
				   
			} else if ( is_month() ) {
				   
				// Month Archive
				   
				// Year link
				echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html( __( 'Archives', self::TEXT_DOMAIN ) ) . '</a></li>';
				   
				// Month display
				echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
				   
			} else if ( is_year() ) {
				   
				// Display year archive
				echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' ' . esc_html( __( 'Archives', self::TEXT_DOMAIN ) ) . '</strong></li>';
				   
			} else if ( is_author() ) {
				   
				// Auhor archive
				   
				// Get the author information
				global $author;
				$userdata = get_userdata( $author );
				   
				// Display author name
				echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . esc_html( __( 'Author:', self::TEXT_DOMAIN ) ) . ' ' . $userdata->display_name . '</strong></li>';
			   
			} else if ( get_query_var('paged') ) {
				   
				// Paginated archives
				echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">' . esc_html( __( 'Page', self::TEXT_DOMAIN ) ) . ' ' . get_query_var('paged') . '</strong></li>';
				   
			} else if ( is_search() ) {
			   
				// Search results page
				echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">' . esc_html( __( 'Search results for:', self::TEXT_DOMAIN ) ) . ' ' . get_search_query() . '</strong></li>';
			   
			} elseif ( is_404() ) {
				   
				// 404 page
				echo '<li>' . 'Error 404' . '</li>';
			}
		   
			echo '</ol>';
			   
		}
	}

	/////////////////////////////////////////
	// MAIN_QUERY
	/////////////////////////////////////////
/*
	public static function edit_search_query( $query )
	{
		if( $query->is_main_query() && $query->is_search() )
		{
			$query->query_vars['post_type'] = 'product';
		}
	}
*/


	//--------------------------------------
	// ADMIN
	//--------------------------------------
	public static function register_admin_pages()
	{
		$title = __( 'TrainerSite theme', self::TEXT_DOMAIN );
		$hook = add_submenu_page(
			'themes.php',
			$title,
			$title,
			'administrator',
			self::ADMIN_SETTINGS_PAGE_SLUG,
			array(
				get_class(),
				'print_admin_settings_page',
			)
		);
/*
		add_action(
			'admin_print_styles-' . $hook,
			function(){
				wp_enqueue_style(
					'trainersite-mindfulness-instances-style',
					plugins_url( '/css/admin_instances.css', __FILE__ ),
					array(),
					self::VERSION
				);
			}
		);
*/
	}

	public static function print_admin_settings_page()
	{
		$file = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'admin', 'settings.php' ) );
		$saved = null;

		if( !is_readable( $file ) )
		{
			echo __( 'Reinstall the plugin', self::TEXT_DOMAIN );
			return;
		}

		$form = JLCCustomForm::get_form(
			self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
			implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
			'ThemeSettings.php',
			array(
				'admin_page_slug' => 'themes.php?page=' . self::ADMIN_SETTINGS_PAGE_SLUG,
				'text_domain' => self::TEXT_DOMAIN
			)
		);

		include( $file );
	}

	//////////////////////////////////////////////
	// OG
	/////////////////////////////////////////////

	// AJAX
/*
	public static function ajax_search_products()
	{
		if( !isset( $_GET['term'] ) )
		{
			echo json_encode( array('pimpi') );
			wp_die();
		}

		$search = sanitize_text_field( $_GET['term'] );
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 5,
			's' => $search
		);

		$query = new WP_Query( $args );

		$posts = $query->get_posts();
		$products = array();
		foreach( $posts as $post )
			$products[] = array( 'label' => $post->post_title, 'desc' => 'zingaro', 'url' => get_permalink( $post->ID ), 'value' => $search, 'image' => get_the_post_thumbnail_url( $post->ID, 'thumbnail' ) );
	
		echo json_encode( $products );
		wp_die();
	}
*/
	// UTIL
/*
	public static function get_directory_images( $dir, $prev_dir = null )
	{
		$ret = array();

		$relpath = $prev_dir ? $prev_dir . DIRECTORY_SEPARATOR . basename( $dir ) : basename( $dir );

		if( is_dir( $dir ) )
		{
			$files = scandir( $dir );
			if( is_array( $files ) )
			{
				foreach( $files as $file )
				{
					$filepath = $dir . DIRECTORY_SEPARATOR . $file;
					if( is_dir( $filepath ) && $file != '.' && $file != '..' )
					{
						$ret = array_merge( $ret, self::get_directory_images( $filepath, $relpath ) );
					}
					elseif( is_file( $filepath ) && preg_match( '/^image/', mime_content_type( $filepath ) ) && is_array( $size = getimagesize( $filepath ) ) )
					{
						$ret[] = array(
							'name' => $file,
							'path' => $filepath,
							'relpath' => $relpath,
							'width' => $size[0],
							'height' => $size[1]
						);
					}
				}
			}
		}
		
		return $ret;
	}
*/
	public static function new_exercise_form()
	{
		$exercise_form = TrainerSiteTheme::get_edit_exercise_form();
		echo $exercise_form;
	}

	public static function get_exercise_card( $exercise_id )
	{
		$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-card.php' ) ) );
	}

	public static function load_exercise_card()
	{
		$exercise_id = isset( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;

		$user_id = get_current_user_id();

		echo self::get_exercise_card( $exercise_id );
		die();
	}

	public static function load_exercise_icon()
	{
		$exercise_id = isset( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;

		$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-icon.php' ) ) );
		die();
	}

	public static function edit_exercise_form()
	{
		$exercise_id = isset( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;

		$exercise_form = TrainerSiteTheme::get_edit_exercise_form( $exercise_id );
		echo $exercise_form;

		die();
	}

	public static function clone_exercise()
	{
		$exercise_id = isset( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;

		$old_exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );
		if( !$old_exercise )
			die();

		$new_exercise_id = EpointPersonalTrainerMapper::create_exercise(
			$old_exercise->name . ' (Clonado)',
			$old_exercise->position,
			$old_exercise->active,
			$old_exercise->description,
			$old_exercise->video,
			$old_exercise->image_start,
			$old_exercise->image_end,
			array(),
			array(),
			get_current_user_id()
		);

		$exercise = EpointPersonalTrainerMapper::get_exercise( $new_exercise_id );

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-icon.php' ) ) );
		die();
	}

	public static function delete_exercise()
	{
		$exercise_id = isset( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;

		EpointPersonalTrainerMapper::delete_exercise( $exercise_id );

		echo $exercise_id;
		die();
	}

	// TOOLS

	public static function get_exercise_image( $image_id )
	{
		$url = wp_get_attachment_url( $image_id );

		return !empty( $url ) ? $url : get_template_directory_uri() . '/img/buttons/exercises.svg';
	}

	// FORMS

	public static function get_site_style_form()
	{
		$form_id = self::SITE_STYLE_FORM_INTERNAL_ID;

		$forms = self::get_forms();

		$form = JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	public static function get_home_settings_form()
	{
		$form_id = self::HOME_SETTINGS_FORM_INTERNAL_ID;

		$forms = self::get_forms();

		$form = JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}
	
	public static function get_edit_exercise_form( $exercise_id = null )
	{
		$form_id = EpointPersonalTrainer::EDIT_EXERCISE_FORM_INTERNAL_ID;

		$forms = EpointPersonalTrainer::get_subsites_forms();

		if( is_numeric( $exercise_id ) )
		{
			$forms[$form_id]['args']['exercise'] = $exercise_id;
		}

		$form = JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}
}

TrainerSiteTheme::initialize();


