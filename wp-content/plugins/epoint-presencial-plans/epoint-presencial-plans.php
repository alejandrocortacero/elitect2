<?php
/**
 * Plugin Name: Epoint Presencial Plans
 * Plugin URI:
 * Description: Manage presencial plans
 * Version: 1.0
 * Author: Epoint
 * AUthor URI: https://epoint.es/
 * Text Domain: epoint-presencial-plans-textdomain
 * License: EULA
 */

defined( 'ABSPATH' ) or die( 'Wrong Access' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'jlc-form/jlc-form.php' ) ) {

if( !class_exists( 'JLCCustomForm' ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( ABSPATH, PLUGINDIR, 'jlc-form', 'jlc-form.php' ) ) );

//if( !class_exists( 'EpointPersonalTrainerMapper' ) )
	//require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'mapper.php' ) ) );

class EpointPresencialPlans
{
	const TEXT_DOMAIN = 'epoint-presencial-plans-textdomain';
	const VERSION = '1.1';

	const POST_TYPE = 'epoint_presplan';

	const FLUSH_REWRITE_RULES_KEY = 'epoint_presencial_plans_flush_rewrite_rule';

	// META

	const TYPE_KEY = 'epoint_presencial_plan_type';
	const TIMES_KEY = 'epoint_presencial_plan_times';
	const PRICES_KEY = 'epoint_presencial_plan_prices';
	const VALORATION_KEY = 'epoint_presencial_plan_valoration';

	//const AFTER_PHOTO_KEY = 'epoint_presencial_plans_after';

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
	}


	public static function install()
	{
	}

	public static function uninstall()
	{
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
			'name'               => __( 'Presencial plans', self::TEXT_DOMAIN ),
			'singular_name'      => __( 'Presencial plan', self::TEXT_DOMAIN ),
			'menu_name'          => __( 'Presencial plans', self::TEXT_DOMAIN ),
			'name_admin_bar'     => __( 'Presencial plans', self::TEXT_DOMAIN ),
			'add_new'            => __( 'Add presencial plan', self::TEXT_DOMAIN ),
			'add_new_item'       => __( 'Add presencial plan', self::TEXT_DOMAIN ),
			'new_item'           => __( 'Add presencial plan', self::TEXT_DOMAIN ),
			'edit_item'          => __( 'Edit presencial plan', self::TEXT_DOMAIN ),
			'view_item'          => __( 'View presencial plan', self::TEXT_DOMAIN ),
			'all_items'          => __( 'All presencial plans', self::TEXT_DOMAIN ),
			'search_items'       => __( 'Search presencial plans', self::TEXT_DOMAIN ),
			'parent_item_colon'  => __( 'Parent presencial plan:', self::TEXT_DOMAIN ),
			'not_found'          => __( 'No presencial plans found.', self::TEXT_DOMAIN ),
			'not_found_in_trash' => __( 'No presencial plans found in Trash.', self::TEXT_DOMAIN )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Manage plans with the power of Wordpress posts.', self::TEXT_DOMAIN ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => false,
/*
			'rewrite'            => array(
				'slug' => __( 'presencial-plan', self::TEXT_DOMAIN ),
				'with_front' => false
			),
*/
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 40,
			'menu_icon'			 => 'dashicons-admin-home',
			'supports'           => array( 'title', 'editor' )
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/////////////////////////////
	// PLANS
	/////////////////////////////

	public static function get_plans()
	{
		return get_posts( array(
			'post_type' => self::POST_TYPE,
			'numberposts' => -1,
			'order' => 'ASC',
			'orderby' => 'meta_value_num',
			'meta_key' => self::VALORATION_KEY
		) );
	}

	/////////////////////////////
	// META
	/////////////////////////////

	public static function get_type( $plan_id )
	{
		$type = get_post_meta( $plan_id, self::TYPE_KEY, true );
		if( $type )
			return $type;

		$plan = get_post( $plan_id );
		return $plan->post_title;
	}
	public static function set_type( $plan_id, $type )
	{
		update_post_meta( $plan_id, self::TYPE_KEY, $type );
	}

	public static function get_times( $plan_id )
	{
		return get_post_meta( $plan_id, self::TIMES_KEY, true );
	}
	public static function set_times( $plan_id, $times )
	{
		update_post_meta( $plan_id, self::TIMES_KEY, $times );
	}

	public static function get_prices( $plan_id )
	{
		return get_post_meta( $plan_id, self::PRICES_KEY, true );
	}
	public static function set_prices( $plan_id, $prices )
	{
		update_post_meta( $plan_id, self::PRICES_KEY, $prices );
	}

	public static function get_valoration( $plan_id )
	{
		return get_post_meta( $plan_id, self::VALORATION_KEY, true );
	}
	public static function set_valoration( $plan_id, $valoration )
	{
		update_post_meta( $plan_id, self::VALORATION_KEY, $valoration );
	}



	///////////////////////////////////////
	// DATE AND TIME
	///////////////////////////////////////

	public static function get_public_datetime_format()
	{
		return __( "Y/m/d H:i:s", self::TEXT_DOMAIN );
	}
}

EpointPresencialPlans::initialize();

}
