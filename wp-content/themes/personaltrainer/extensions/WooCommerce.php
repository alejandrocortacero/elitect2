<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class PersonalTrainerThemeWooCommerce
{
	const ENABLE_FIXED_CART_KEY = 'personaltrainer_settings_woo_fixed_cart';

	protected static $featured_query;

	protected static $shop_link;
	protected static $cart_link;

	public static function initialize()
	{
		add_action( 'after_setup_theme', array( get_class(), 'after_setup_theme' ) );

		add_action('get_header', array( get_class(), 'remove_generator_tags' ) );

		//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		// Adds bootstrap class to woocommerce controls
		//add_filter( 'woocommerce_form_field_args', array( get_class(), 'bootstrapize_fields' ), 10, 3 );

		add_filter( 'personaltrainer_settings_form_fields', array( get_class(), 'settings_fields' ) );

		add_action( 'init', array( get_class(), 'remove_woocommerce_breadcrumbs' ) );

		// Remove "Add to Cart" button in single product
		//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

		// Add custom size for archive product photos
		//add_image_size( 'NAME_FOR_PRODUCT_ARCHIVE', W, H, true );
		//add_filter( 'single_product_archive_thumbnail_size', function($size){return 'NAME_FOR_PRODUCT_ARCHIVE';} );
	
		// show brands in loop
		if( is_plugin_active( 'perfect-woocommerce-brands/main.php' ) )
		{
			add_action( 'woocommerce_before_shop_loop_item', array( get_class(), 'print_brand_in_loop' ), 5 );

			// hide title on brand page
			//add_filter( 'woocommerce_show_page_title', function( $show ){ return is_tax( 'pwb-brand' ) ? false : $show; }, 99 );

			//add_image_size( 'personaltrainer-brand', 400, 0, false );
			//add_image_size( 'personaltrainer-small-brand', 100, 0, false );
		}

		// Add icons to product tabs
		//add_filter( 'woocommerce_product_tabs', array( get_class(), 'add_tabs_icons' ) );

/*
		// Browser title will be shop page title
		add_filter(
			'document_title_parts',
			function( $title ){
				if(!is_shop()) return $title;
				global $wp_query;
				return array( get_the_title(get_option('woocommerce_shop_page_id')), get_bloginfo( 'name' ));
			},
			99
		);
*/

		// Remove strikethroug price of "On Sale" prices
		//add_filter( 'woocommerce_format_sale_price', function( $price, $regular_price, $sale_price ){return preg_replace( '/<del>.*<\/del>/', '', $price );}, 99, 3 );

		
		if( self::is_fixed_cart_enabled() )
		{
			add_filter( 'woocommerce_add_to_cart_fragments', array( get_class(), 'update_cart' ) );

			add_action( 'personaltrainertheme_footer_after_static_content', array( get_class(), 'print_fixed_cart' ) );
		}

		add_filter( 'personaltrainertheme_default_menu_items', array( get_class(), 'default_menu_items' ) );
		add_filter( 'personaltrainertheme_legal_menu_items', array( get_class(), 'legal_menu_items' ) );
	}

	public static function after_setup_theme()
	{
		add_theme_support( 'woocommerce' );

		//add_theme_support( 'wc-product-gallery-zoom' );
		//add_theme_support( 'wc-product-gallery-lightbox' );
		//add_theme_support( 'wc-product-gallery-slider' );
	}

	public static function remove_generator_tags()
	{
		remove_action( 'get_the_generator_html', 'wc_generator_tag', 10, 2 );
		remove_action( 'get_the_generator_xhtml', 'wc_generator_tag', 10, 2 );
	}

	public static function settings_fields( $fields )
	{
		$fields[] = array(
			'type' => 'checkbox_field',
			'name' => self::ENABLE_FIXED_CART_KEY,
			'args' => array(
				'value' => 'yes',
				'label' => __( 'Enable WooCommerce fixed cart', PersonalTrainerTheme::TEXT_DOMAIN ),
				'checked' => get_option( self::ENABLE_FIXED_CART_KEY ) === 'yes'
			)
		);

		return $fields;
	}

	public static function remove_woocommerce_breadcrumbs()
	{
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
		remove_action( 'woo_main_before', 'woo_display_breadcrumbs', 10 );
	}

	public static function print_brand_in_loop()
	{
		if( !is_tax( 'pwb-brand' ) )
			get_template_part( 'templates/pwb', 'brandsloop' );	
	}


	// FEATURED PRODUCTS

	public static function get_featured_products_query( $posts_per_page = -1 )
	{
		if( self::$featured_query )
			return self::$featured_query;
			
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $posts_per_page,
			'tax_query' => array(
				array(
					'taxonomy' => 'product_visibility',
					'field' => 'name',
					'terms' => 'featured',
					'operator' => 'IN'
				)
			)
		);

		self::$featured_query = new WP_Query( $args );

		return self::$featured_query;
	}

	public static function bootstrapize_fields( $args, $key, $value )
	{
		if( in_array( $args['type'], array( 'text', 'tel', 'email', 'textarea', 'password' ) ) )
		{
			$args['class'][] = 'form-group';
			$args['input_class'][] = 'form-control';
		}
		elseif( $args['type'] == 'checkbox' )
		{
			$args['class'][] = 'checkbox';
		}

		return $args;
	}

	public static function get_shop_link()
	{
		if( !self::$shop_link )
		{
			$shop_page_id = get_option('woocommerce_shop_page_id');
			if( $shop_page_id )
			{
				self::$shop_link = get_permalink( $shop_page_id );
			}
		}

		return self::$shop_link;
	}

	public static function get_cart_link()
	{
		if( !self::$cart_link )
		{
			$cart_id = get_option('woocommerce_cart_page_id');
			if( $cart_id )
			{
				self::$cart_link = get_permalink( $cart_id );
			}
		}

		return self::$cart_link;
	}

	public static function get_my_account_url()
	{
		$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
		
		$myaccount_page_url = $myaccount_page_id ? get_permalink( $myaccount_page_id ) : '#';

		return $myaccount_page_url;
	}

	public static function is_fixed_cart_enabled()
	{
		return get_option( self::ENABLE_FIXED_CART_KEY ) == 'yes';
	}

	public static function get_cart_products_count()
	{
		global $woocommerce;
		if( empty( $woocommerce ) )
			return 0;

		return $woocommerce->cart->cart_contents_count;
	}

	public static function update_cart( $fragments )
	{
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( get_template_directory(), 'templates', 'cart-fixedlayer.php' ) ) );
		$fragments['.cart-fixed'] = ob_get_clean();
		 
		return $fragments;
	}

	public static function print_fixed_cart()
	{
		get_template_part( 'templates/cart', 'fixedlayer' );
	}

	public static function get_parent_product_categories()
	{
		return get_terms( array(
			'taxonomy' => 'product_cat',
			'hide_empty' => true,
			'parent' => 0
		));
	}

	public static function add_tabs_icons( $tabs )
	{
		$new_tabs = array();
		$icons = array(
			'description' => 'list-alt',
			'additional_information' => 'info-sign',
			'reviews' => 'pencil'
		);
		foreach( $tabs as $key => $tab )
		{
			$tab['icon'] = array_key_exists( $key, $icons ) ?  $icons[$key] : 'question-sign';

			$new_tabs[$key] = $tab;
		}

		return $new_tabs;
	}

	public static function default_menu_items( $items )
	{
		$shop_page_link = self::get_shop_link();
		$shop_title = get_the_title( get_option('woocommerce_shop_page_id') );
		if( $shop_page_link )
		{
			$items['shop'] = array( 'url' => $shop_page_link , 'text' => !empty( $shop_title ) ? $shop_title : __( 'Products', PersonalTrainerTheme::TEXT_DOMAIN ) );
		}

		$items['account'] = array( 'url' => self::get_my_account_url(), 'text' => __( 'My Account', PersonalTrainerTheme::TEXT_DOMAIN ), 'icon' => 'user' );
		//$ret['cart'] = array( 'url' => self::get_cart_link(), 'text' => __( 'My Cart', PersonalTrainerTheme::TEXT_DOMAIN ) );

		return $items;
	}

	public static function legal_menu_items( $items )
	{
		$terms_id = (int)get_option( 'woocommerce_terms_page_id' );
		$terms_link = $terms_id ? get_permalink( $terms_id ) : null;
		$terms_page = get_post( $terms_id );
		if( $terms_link )
			$items['terms'] = array( 'url' => $terms_link, 'text' => $terms_page->post_title );

		return $items;
	}
}
