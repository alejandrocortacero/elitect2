<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class PersonalTrainerThemeFacebook
{
	const FACEBOOK_APP_ID_KEY = 'personaltrainer_facebook_app_id';
	const ENABLE_LIKE_BUTTON_SUPPORT_KEY = 'personaltrainer_facebook_enable_like_button';

	const OPEN_GRAPH_IMAGE_SIZE = 'facebook-open-graph';

	public static function initialize()
	{
		add_image_size( self::OPEN_GRAPH_IMAGE_SIZE, 1200, 630, false );

		add_filter( 'personaltrainer_settings_form_fields', array( get_class(), 'settings_fields' ) );

		add_action( 'wp_head', array( get_class(), 'print_header_tags' ), 10, 0 );

		add_action( 'personaltrainertheme_footer_after_static_content', array( get_class(), 'print_footer_tags' ), 90, 0 );
	}

	public static function settings_fields( $fields )
	{
		$fields[] = array(
			'type' => 'text_field',
			'name' => self::FACEBOOK_APP_ID_KEY,
			'args' => array(
				'value' => get_option( self::FACEBOOK_APP_ID_KEY ),
				'label' => __( 'Facebook app ID', PersonalTrainerTheme::TEXT_DOMAIN ),
				'required' => false
			)
		);

		$fields[] = array(
			'type' => 'checkbox_field',
			'name' => self::ENABLE_LIKE_BUTTON_SUPPORT_KEY,
			'args' => array(
				'value' => 'yes',
				'label' => __( 'Enable Facebook like button support', PersonalTrainerTheme::TEXT_DOMAIN ),
				'checked' => get_option( self::ENABLE_LIKE_BUTTON_SUPPORT_KEY ) === 'yes'
			)
		);

		return $fields;
	}

	public static function print_header_tags()
	{
		get_template_part( 'templates/header', 'facebookmeta' );
	}

	public static function print_footer_tags()
	{
		if( self::must_include_like_script() )
			get_template_part( 'templates/footer', 'like' );
	}

	public static function get_facebook_app_id()
	{
		return get_option( self::FACEBOOK_APP_ID_KEY );
	}

	public static function get_og_description()
	{
		global $post;

		if( function_exists( 'is_shop' ) && is_shop() )
		{
			if( class_exists( 'JLCPageMeta' ) )
			{
				$ret = JLCPageMeta::get_page_description( get_option('woocommerce_shop_page_id') );
				if( !empty( $ret ) )
					return $ret;
			}
		}
		elseif( is_home() )
		{
			return sprintf( __( 'Read the latest articles from %s', PersonalTrainerTheme::TEXT_DOMAIN ), get_bloginfo( 'name' ) );
		}
		elseif( is_singular() )
		{
			if( class_exists( 'JLCPageMeta' ) )
			{
				$ret = JLCPageMeta::get_page_description( $post->ID );
				if( !empty( $ret ) )
					return $ret;
			}

			$ret = strip_tags( $post->post_excerpt );
			if( !empty( $ret ) )
				return $ret;

			$ret = strip_tags( $post->post_content );
			if( !empty( $ret ) )
				return $ret;
		}

		return get_bloginfo( 'description' );
	}

	public static function get_og_title()
	{
		$title = array(
			'title' => '',
		);

		// If it's a 404 page, use a "Page not found" title.
		if ( is_404() ) {
			$title['title'] = __( 'Page not found' );

		// If it's a search, use a dynamic search results title.
		} elseif ( is_search() ) {
			$title['title'] = sprintf( __( 'Search Results for &#8220;%s&#8221;' ), get_search_query() );

		} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
			$title['title'] = get_bloginfo( 'name', 'display' ) . ' - ' . __( 'Catalog', PersonalTrainerTheme::TEXT_DOMAIN );
		// If on the front page, use the site title.
		} elseif ( is_front_page() ) {
			$title['title'] = get_bloginfo( 'name', 'display' );

		// If on a post type archive, use the post type archive title.
		} elseif ( is_post_type_archive() ) {
			$title['title'] = post_type_archive_title( '', false );

		// If on a taxonomy archive, use the term title.
		} elseif ( is_tax() ) {
			$title['title'] = single_term_title( '', false );

		} elseif ( is_home() || is_singular() ) {
			$title['title'] = single_post_title( '', false );

		// If on a category or tag archive, use the term title.
		} elseif ( is_category() || is_tag() ) {
			$title['title'] = single_term_title( '', false );

		// If on an author archive, use the author's display name.
		} elseif ( is_author() && $author = get_queried_object() ) {
			$title['title'] = $author->display_name;

		// If it's a date archive, use the date as the title.
		} elseif ( is_year() ) {
			$title['title'] = get_the_date( _x( 'Y', 'yearly archives date format' ) );

		} elseif ( is_month() ) {
			$title['title'] = get_the_date( _x( 'F Y', 'monthly archives date format' ) );

		} elseif ( is_day() ) {
			$title['title'] = get_the_date();
		}

		$title = $title['title'];
		$title = wptexturize( $title );
		$title = convert_chars( $title );
		$title = esc_html( $title );
		$title = capital_P_dangit( $title );

		return $title;
	}

	public static function get_og_image()
	{
		global $post;
		if( is_singular() && ($thumb_id = get_post_thumbnail_id( $post->ID ) ) )
		{
			$img = wp_get_attachment_image_src( $thumb_id, 'facebook-open-graph' );
			if( $img )
				return $img[0];
		}

		return get_template_directory_uri() . '/img/logos/logo_home_og.png';
	}

	public static function get_og_url()
	{
		global $wp;
		return add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	}

	public static function must_include_like_script()
	{
		return get_option( self::ENABLE_LIKE_BUTTON_SUPPORT_KEY ) == 'yes';
	}
}
