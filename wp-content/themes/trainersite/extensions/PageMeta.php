<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class TrainerSiteThemePageMeta
{
	public static function initialize()
	{
		add_filter( 'pre_get_document_title', array( get_class(), 'filter_document_title' ), 90, 1 );
		add_action( 'wp_head', array( get_class(), 'print_header_tags' ), 10, 0 );
	}

	public static function filter_document_title( $title )
	{
		$_title = self::get_page_title();
		if( !empty( $_title ) )
			return $_title;

		return $title;
	}

	public static function print_header_tags()
	{
		get_template_part( 'templates/header', 'pagemeta' );
	}

	protected static function is_shop()
	{
		return
			function_exists( 'is_shop' ) &&
			is_shop();
	}

	// Use function wp_get_document_title to get the title in templates
	protected static function get_page_title()
	{
		if( ( !is_singular() && !self::is_shop() ) ||
			!class_exists( 'JLCPageMeta' ) )
			return '';

		$_post = !self::is_shop() ? get_queried_object() : get_post( get_option('woocommerce_shop_page_id') );

		if( !isset( $_post->ID ) )
			return '';

		$title = JLCPageMeta::get_page_title( $_post->ID );
		if( empty( $title ) )
			return '';

		$sep = apply_filters( 'document_title_separator', '-' );
		return sprintf( "%s %s %s", $title, $sep, get_bloginfo( 'name' ) );
	}

	public static function get_page_description()
	{
		global $post;

		if( self::is_shop() )
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
			return sprintf( __( 'Read the latest articles from %s', TrainerSiteTheme::TEXT_DOMAIN ), get_bloginfo( 'name' ) );
		}
		elseif( is_singular() )
		{
			if( class_exists( 'JLCPageMeta' ) )
			{
				$ret = JLCPageMeta::get_page_description( $post->ID );
				if( !empty( $ret ) )
					return $ret;
			}

			$ret = mb_substr( strip_tags( $post->post_excerpt ), 0, 160 );
			if( !empty( $ret ) )
				return $ret;

			$ret = mb_substr( strip_tags( $post->post_content ), 0, 160 );
			if( !empty( $ret ) )
				return $ret;
		}

		return mb_substr( get_bloginfo( 'description' ), 0, 160 );
	}

}
