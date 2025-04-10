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

class PersonalTrainerTheme
{
	const TEXT_DOMAIN = 'personaltrainerthemetextdomain';

	const ADMIN_SETTINGS_PAGE_SLUG = 'personaltrainer_admin_settings_page';
	const ADMIN_SAVE_SETTINGS_ACTION = 'personaltrainer_admin_save_settings';

	const ADMIN_SETTINGS_FORM_INTERNAL_ID = 'personaltrainer_admin_form_internal_id';

	const TRAINER_LANDING_PAGE_KEY = 'personaltrainer_trainer_landing_page';
	const SPORTSMAN_LANDING_PAGE_KEY = 'personaltrainer_sportsman_landing_page';

	const SUPERTRAINER_PAGE_GENERAL_KEY = 'personaltrainer_supertrainer_general_page';
	const SUPERTRAINER_PAGE_EXERCISES_KEY = 'personaltrainer_supertrainer_exercises_page';
	const SUPERTRAINER_PAGE_TRAINING_KEY = 'personaltrainer_supertrainer_training_page';
	const SUPERTRAINER_PAGE_TRAINERS_KEY = 'personaltrainer_supertrainer_trainers_page';

	//const SEARCH_PRODUCTS_ACTION = 'personaltrainer_search';
	const SAVE_TRAINING_ACTION = 'personaltrainer_global_trainer_save_training';

	protected static $version;

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

		add_action( 'switch_theme', array( get_class(), 'switch_theme' ) );

		add_filter( 'clean_url', array( get_class(), 'defer_parsing_of_js' ), 11, 1 );

		remove_action( 'wp_head', 'wp_generator' );

		add_filter( 'script_loader_tag', array( get_class(), 'jquery_inlined' ), 99, 3 );
		add_action( 'wp_enqueue_scripts', array( get_class(), 'enqueue_scripts' ), 90 );
		add_action( 'get_footer', array( get_class(), 'enqueue_footer_styles' ), 99 );

		register_nav_menu( 'personaltrainer-header-menu', __( 'Site header menu', self::TEXT_DOMAIN ) );

		add_action( 'widgets_init', array( get_class(), 'register_widgets' ) );
		add_action( 'widgets_init', array( get_class(), 'register_sidebars' ) );


		// MAIN_QUERY
		//add_action( 'pre_get_posts', array( get_class(), 'edit_search_query' ) );

		// FEED
		//add_filter( 'request', array( get_class(), 'feed_request' ) );


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

		add_action( 'wp_ajax_' . self::SAVE_TRAINING_ACTION, array( get_class(), 'save_training' ) );
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


	public static function get_default_menu_items()
	{
		$ret = apply_filters( 'personaltrainertheme_default_menu_items', array() );

		foreach( get_post_types() as $post_type )
		{
			if( isset( $post_type->rewrite->has_archive ) &&
				$post_type->rewrite->has_archive
			) {	
				$archive_link = get_post_type_archive_link( JLCProjector::PROJECT_POST_TYPE );
				if( $archive_link )
					$ret['archive_' . $post_type->name] = array( 'url' => $archive_link, 'text' => $post_type->label );
			}
		}

		$contact_url = self::get_contact_page_url();
		$ret['contact'] = array( 'url' => $contact_url, 'text' => __( 'Contact', self::TEXT_DOMAIN ) );

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


		return apply_filters( 'personaltrainertheme_legal_menu_items', $ret );
	}


	public static function get_contact_page_url()
	{
		if( !class_exists( 'JLCContact' ) )
			return null;

		$contact = JLCContact::get_contact_page();
		$contact_link = $contact ? get_permalink( $contact ) : '#';

		return $contact_link;
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
		if( !has_nav_menu( 'personaltrainer-header-menu' ) )
		{
			$menu_items = self::get_default_menu_items();
			get_template_part( 'templates/header', 'defaultmenu' );
		}
		else
		{
			get_template_part( 'templates/header', 'custommenu' );
/*
			wp_nav_menu( array(
				'menu' => 'personaltrainer-header-menu',
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
				'epoint-personal-trainer/epoint-personal-trainer.php',
				$plugins
			) &&
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

		if( class_exists( 'JLCCustomForm' ) )
		{
			JLCCustomForm::register_form(
				self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
				implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
				'ThemeSettings.php',
				array(
					'admin_page_slug' => 'themes.php?page=' . self::ADMIN_SETTINGS_PAGE_SLUG,
					'text_domain' => self::TEXT_DOMAIN
				),
				__FILE__
			);
		}
	}

	public static function switch_theme( $new_theme )
	{
		if( class_exists( 'JLCCustomForm' ) )
		{
			JLCCustomForm::unregister_form(
				self::ADMIN_SETTINGS_FORM_INTERNAL_ID,
				implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'forms' ) ),
				'ThemeSettings.php'
			);
		}
	}

	public static function initialize_extensions()
	{
		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'PageMeta.php' ) ) );
		PersonalTrainerThemePageMeta::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'LazyLoad.php' ) ) );
		PersonalTrainerThemeLazyLoad::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'Facebook.php' ) ) );
		PersonalTrainerThemeFacebook::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'GoogleMaps.php' ) ) );
		PersonalTrainerThemeGoogleMaps::initialize();
	
		
		if( is_plugin_active( 'woocommerce/woocommerce.php' ) )
		{	
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'WooCommerce.php' ) ) );
			PersonalTrainerThemeWooCommerce::initialize();
		}
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


		//wp_enqueue_style( 'personaltrainer-font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), $version );
		wp_enqueue_style( 'personaltrainer-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), $version );
		wp_enqueue_style( 'personaltrainer-bootstrap-theme-css', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), $version );

		//wp_enqueue_script( 'personaltrainer-select2-script', get_template_directory_uri() . '/js/select2.min.js', array( 'jquery' ), $version, true );

		wp_enqueue_script( 'personaltrainer-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), $version, true );

		//wp_enqueue_script( 'jquery-ui-autocomplete' );

		//wp_enqueue_script( 'personaltrainer-images-loaded-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), $version, true );
		//wp_enqueue_script( 'personaltrainer-masonry-js', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), $version, true );

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

		wp_enqueue_script( 'personaltrainer-global-js', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), $version, true );

/*
		wp_localize_script( 'personaltrainer-global-js', 'PersonalTrainer', array(
			//'search_product_url' => admin_url( 'admin-ajax.php' ) . '?action=' . self::SEARCH_PRODUCTS_ACTION
		) );
*/
	}

	public static function enqueue_footer_styles()
	{
		$version = self::get_version();

		//wp_enqueue_style( 'personaltrainer-select2-style', get_template_directory_uri() . '/css/select2.min.css', array(), $version );

		//wp_enqueue_style( 'jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	}

	public static function register_widgets()
	{
	}

	public static function register_sidebars()
	{
		register_sidebar( array(
			'name' => __( 'Side sidebar', self::TEXT_DOMAIN ),
			'id' => 'personaltrainer-side-sidebar',
			'before_title' => '',
			'after_title' => ''
			
		) );

	}

	/////////////////////////////////////////
	// From elitetrainersite theme
	/////////////////////////////////////////

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
			$dec[$i] = min( max( 0, $dec[$i] ), 255 ); 
		}		
		
		return sprintf( 'rgba(%s,%s,%s,%s)', $dec[0], $dec[1], $dec[2], $opacity );
	}

	public static function print_bg_rules( $selector, $bg, $with_hover = true )
	{
		if( is_string( $bg ) )
			$bg = json_decode( $bg );

		$type = isset( $bg->type ) ? $bg->type : 'solid';

		$index_name = 'color_0';
		$color0 = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		$index_name = 'color_1';
		$color1 = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		$color0_darker = self::color_luminance( $color0, -.1 );
		$color1_darker = self::color_luminance( $color1, -.1 );

		$index_name = 'color_0_opacity';
		$color0_opacity = isset( $bg->$index_name ) ? $bg->$index_name : 1;
		$index_name = 'color_1_opacity';
		$color1_opacity = isset( $bg->$index_name ) ? $bg->$index_name : 1;

		$color0 = self::rgba_color( $color0, $color0_opacity );
		$color1 = self::rgba_color( $color1, $color1_opacity );
		$color0_darker = self::rgba_color( $color0_darker, $color0_opacity );
		$color1_darker = self::rgba_color( $color1_darker, $color1_opacity );
		

		$path = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'custom-styles', 'bg-rules.php' ) ) );
		include( $path );
	}

	public static function print_text_rules( $selector, $color, $with_hover = true )
	{
		$color_hover = self::color_luminance( $color, -.1 );

		$path = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'custom-styles', 'text-rules.php' ) ) );
		include( $path );
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
		$title = __( 'PersonalTrainer theme', self::TEXT_DOMAIN );
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
					'personaltrainer-mindfulness-instances-style',
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

	public static function save_training()
	{
		$training_id = (int)$_REQUEST['training'];
		$member_id = (int)$_REQUEST['member'];
		//$start = $_REQUEST['start'];
		//$end = $_REQUEST['end'];

		//$training = EpointPersonalTrainerMapper::get_training( $training_id );
		$member = get_user_by( 'id', $member_id );

/*
		if( !$member || !$start || !$end )
		{
			http_response_code( 500 );
			exit;
		}
*/
		$objectives = !empty( $_REQUEST['objectives'] ) ? $_REQUEST['objectives'] : array();
		$environments = !empty( $_REQUEST['environments'] ) ? $_REQUEST['environments'] : array();

		$objectives_arr = array();
		foreach( $objectives as $ob )
			$objectives_arr[(int)$ob] = (int)$ob;

		$environments_arr = array();
		foreach( $environments as $ob )
			$environments_arr[(int)$ob] = (int)$ob;

		$exercises = !empty( $_REQUEST['exercises'] ) ? $_REQUEST['exercises'] : array();

		$name = !empty( $_REQUEST['name'] ) ? $_REQUEST['name'] : '';
		$observations = !empty( $_REQUEST['observations'] ) ? $_REQUEST['observations'] : '';

		$ex_arr = array();
		//$exercises = EpointPersonalTrainerMapper::get_training_exercises_data( $training_id );
		$i = 1;
		foreach( $exercises as $cat_id => $exerlist )
		{
			foreach( $exerlist as $ex_id => $exer )
				$ex_arr[(int)$ex_id] = array(
					'exercise' => (int)$ex_id,
					'position' => $i++,
					'description' => '',
					'series' => $exer['series'],
					'repetitions' => $exer['repetitions'],
					'loads' => $exer['loads']
				);
		}

		if( !$training_id )
		{
			$new_training_id = EpointPersonalTrainerMapper::create_training(
				$name,
				1,//position
				1,//active
				'',//$description,
				null,//date( 'Y-m-d', strtotime( $start ) ),
				null,//date( 'Y-m-d', strtotime( $end ) ),
				null,//$member_id,//$user
				null,//get_current_user_id(),
				$ex_arr,//array()//$exercises,
				$objectives_arr,
				$environments_arr,
				$observations
			);

			$tt = EpointPersonalTrainerMapper::get_training( $new_training_id );
			if( !$tt )
			{
				http_response_code( 500 );
				exit;
			}

			setCookie( 'updated-training', 'created', time() + 60, '/' );
		}
		else
		{
			$tt = EpointPersonalTrainerMapper::get_training( $training_id );
			if( !$tt )
			{
				http_response_code( 500 );
				exit;
			}

			$updated = EpointPersonalTrainerMapper::update_training(
				$training_id,
				$name,
				1,//position
				1,//active
				'',//$description,
				$training->start,
				$training->end,
				$training->user,//$member_id,//$user
				null,//get_current_user_id(),
				$ex_arr,//array()//$exercises,
				$objectives_arr,
				$environments_arr
			);

			if( !$updated )
			{
				http_response_code( 500 );
				exit;
			}
		
		
			EpointPersonalTrainerMapper::set_training_observations( $training_id, $observations );

			
			setCookie( 'updated-training', 'updated', time() + 60, '/' );
		}

/*
		$duplicate_training = !empty( $_REQUEST['duplicate'] ) && $_REQUEST['duplicate'] == 'yes';

		if( $duplicate_training )
		{
			$new_training_id = EpointPersonalTrainerMapper::create_training(
				$name,
				1,//position
				1,//active
				'',//$description,
				date( 'Y-m-d', strtotime( $start ) ),
				date( 'Y-m-d', strtotime( $end ) ),
				null,//$user
				get_current_user_id(),
				$ex_arr,//array()//$exercises,
				$objectives_arr,
				$environments_arr,
				$observations
			);
		}

		$objectives = EpointPersonalTrainerMapper::get_trainer_objectives( get_current_user_id() );
		$environments = EpointPersonalTrainerMapper::get_trainer_environments( get_current_user_id() );
		

		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'assigned-training-row.php' ) ) );
		$row = ob_get_clean();

		$response = new WP_Ajax_Response( array(
			'what' => 'html',
			'action' => 'append',
			'id' => 1,
			'data' => $row
		) );
		$response->send();
*/

		exit;
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
	public static function get_maximum_max( $min, $max )
	{
		$step = self::get_maximum_step( $min, $max );
		$diff = $max - $min;

		$val = $min;

		while( $val < $max )
		{
			$val += $step;
		}

		return $val;
	}

	public static function get_maximum_step( $min, $max )
	{
		$diff = $max - $min;
		if( $diff <= 0 )
			return 1;
		elseif( $diff < 20 )
			return 1;
		elseif( $diff < 40 )
			return 2;
		elseif( $diff < 100 )
			return 5;
		elseif( $diff < 200 )
			return 10;
		elseif( $diff < 300 )
			return 20;
		elseif( $diff < 500 )
			return 25;
		else
			return 50;
	}
	
}

PersonalTrainerTheme::initialize();


