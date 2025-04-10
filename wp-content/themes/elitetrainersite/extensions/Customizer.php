<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class EliteTrainerSiteThemeCustomizer
{
	const IS_CUSTOMIZATION_ACTIVE_KEY = 'elitetrainersite_is_custom_active';

	const GET_IMAGE_BY_ID_ACTION = 'elitetrainersite_get_image_by_id';
	const MOVE_IMAGE_ACTION = 'elitetrainersite_move_image';
	const UPDATE_STYLE_ACTION = 'elitetrainersite_update_style';
	const READ_HISTORY_ACTION = 'elitetrainersite_read_history';

	const MAIN_COLOR_KEY = 'elitetrainersite_main_color';
	const SECONDARY_COLOR_KEY = 'elitetrainersite_secondary_color';
	const BODY_BG_COLOR_KEY = 'elitetrainersite_body_bg_color';
	const TEXT_COLOR_KEY = 'elitetrainersite_text_color';

	const GLOBAL_FONT_KEY = 'elitetrainersite_global_font';

	const PAGE_BG_PREFIX = 'elitetrainersite_page_bg_';
	const ARCHIVE_CASES_BG_KEY = 'elitetrainersite_archive_cases_bg';

	const MAIN_MENU_HIDE_ON_DESKTOP = 'elitetrainersite_main_menu_hide_on_desktop';
	const MAIN_MENU_TEXT_COLOR_KEY = 'elitetrainersite_main_menu_text_color';
	const MAIN_MENU_BG_KEY = 'elitetrainersite_main_menu_bg';
	const MAIN_MENU_FONT_SIZE_KEY = 'elitetrainersite_main_menu_font_size';
	const MAIN_MENU_FONT_FAMILY_KEY = 'elitetrainersite_main_menu_font_family';

	const SUBMENU_TEXT_COLOR_KEY = 'elitetrainersite_submenu_text_color';
	const SUBMENU_BG_KEY = 'elitetrainersite_submenu_bg';
	const SUBMENU_FONT_SIZE_KEY = 'elitetrainersite_submenu_font_size';
	const SUBMENU_FONT_FAMILY_KEY = 'elitetrainersite_submenu_font_family';

	const SUBMENU2_TEXT_COLOR_KEY = 'elitetrainersite_submenu2_text_color';
	const SUBMENU2_BG_KEY = 'elitetrainersite_submenu2_bg';
	const SUBMENU2_FONT_SIZE_KEY = 'elitetrainersite_submenu2_font_size';
	const SUBMENU2_FONT_FAMILY_KEY = 'elitetrainersite_submenu2_font_family';
/*
	const TITLE_FONT_KEY = 'elitetrainersite_title_font';
	const SUBTITLE_FONT_KEY = 'elitetrainersite_subtitle_font';
*/
	const CONTACT_PHONE_KEY = 'elitetrainersite_contact_phone';

	const HEADER_BG_COLOR_KEY = 'elitetrainersite_header_bg_color';
	const HEADER_LOGO_KEY = 'elitetrainersite_header_logo';
	const HEADER_LOGO_POS_KEY = 'elitetrainersite_header_logo_post';
	const HEADER_LOGO_SIZE_KEY = 'elitetrainersite_header_logo_size';
	const HEADER_TITLE_KEY = 'elitetrainersite_header_title';
	const HEADER_TITLE_COLOR_KEY = 'elitetrainersite_header_title_color';
	const HEADER_TITLE_FONT_KEY = 'elitetrainersite_header_title_font';
	const HEADER_TITLE_FONT_SIZE_KEY = 'elitetrainersite_header_title_font_size';
	const HEADER_SUBTITLE_KEY = 'elitetrainersite_header_subtitle';
	const HEADER_SUBTITLE_COLOR_KEY = 'elitetrainersite_header_subtitle_color';
	const HEADER_SUBTITLE_FONT_KEY = 'elitetrainersite_header_subtitle_font';
	const HEADER_SUBTITLE_FONT_SIZE_KEY = 'elitetrainersite_header_subtitle_font_size';

	const HOME_COVER_TITLE_KEY = 'elitetrainersite_home_cover_title';
	const HOME_COVER_TITLE_COLOR_KEY = 'elitetrainersite_home_cover_title_color';
	const HOME_COVER_TITLE_FONT_SIZE_KEY = 'elitetrainersite_home_cover_title_font_size';
	const HOME_COVER_TITLE_FONT_FAMILY_KEY = 'elitetrainersite_home_cover_title_font_family';
	const HOME_COVER_TITLE_BG_KEY = 'elitetrainersite_home_cover_title_bg';
	const HOME_COVER_TEXT_KEY = 'elitetrainersite_home_cover_text';
	const HOME_COVER_BUTTON_TEXT_KEY = 'elitetrainersite_home_cover_button_text';
	const HOME_COVER_BUTTON_COLOR_KEY = 'elitetrainersite_home_cover_button_color';
	const HOME_COVER_BUTTON_COLOR_BG_KEY = 'elitetrainersite_home_cover_button_color_bg';
	const HOME_COVER_VIDEO_KEY = 'elitetrainersite_home_cover_video';
	const HOME_COVER_VIDEO_LINK_KEY = 'elitetrainersite_home_cover_video_link';
	const HOME_COVER_BG_KEY = 'elitetrainersite_home_cover_bg';
	const HOME_COVER_BG_V_KEY = 'elitetrainersite_home_cover_bg_v';
	const HOME_COVER_BG_X_KEY = 'elitetrainersite_home_cover_x';
	const HOME_COVER_BG_Y_KEY = 'elitetrainersite_home_cover_y';

	const TARGET_COVER_TITLE_KEY = 'elitetrainersite_target_cover_title';
	const TARGET_COVER_TITLE_COLOR_KEY = 'elitetrainersite_target_cover_title_color';
	const TARGET_COVER_TITLE_FONT_SIZE_KEY = 'elitetrainersite_target_cover_title_font_size';
	const TARGET_COVER_TITLE_FONT_FAMILY_KEY = 'elitetrainersite_target_cover_title_font_family';
	const TARGET_COVER_TEXT_KEY = 'elitetrainersite_target_cover_text';
	const TARGET_COVER_BUTTON_TEXT_KEY = 'elitetrainersite_target_cover_button_text';
	const TARGET_COVER_BUTTON_COLOR_KEY = 'elitetrainersite_target_cover_button_color';
	const TARGET_COVER_BUTTON_COLOR_BG_KEY = 'elitetrainersite_target_cover_button_color_bg';
	const TARGET_COVER_BG_KEY = 'elitetrainersite_target_cover_bg';
	const TARGET_COVER_BG_V_KEY = 'elitetrainersite_target_cover_bg_v';

	const PLANS_TITLE_KEY = 'elitetrainersite_plans_title';
	const PLANS_TITLE_TEXT_COLOR_KEY = 'elitetrainersite_plans_title_text_color';
	const PLANS_TITLE_BG_KEY = 'elitetrainersite_plans_title_bg';
	const PLANS_TITLE_FONT_SIZE_KEY = 'elitetrainersite_plans_title_font_size';
	const PLANS_TITLE_FONT_FAMILY_KEY = 'elitetrainersite_plans_title_font_family';

	const PLANS_ONLINE_ENABLED_KEY = 'elitetrainersite_plans_online_enabled';
	const PLANS_ONLINE_PRICE_KEY = 'elitetrainersite_plans_online_price';
	const PLANS_ONLINE_PRICE_COLOR_KEY = 'elitetrainersite_plans_online_price_color';
	const PLANS_ONLINE_PRICE_FONT_SIZE_KEY = 'elitetrainersite_plans_online_price_font_size';
	const PLANS_ONLINE_PRICE_FONT_FAMILY_KEY = 'elitetrainersite_plans_online_price_font_family';
	const PLANS_ONLINE_TITLE_KEY = 'elitetrainersite_plans_online_title';
	const PLANS_ONLINE_TITLE_COLOR_KEY = 'elitetrainersite_plans_online_title_color';
	const PLANS_ONLINE_TITLE_FONT_SIZE_KEY = 'elitetrainersite_plans_online_title_font_size';
	const PLANS_ONLINE_TITLE_FONT_FAMILY_KEY = 'elitetrainersite_plans_online_title_font_family';
	const PLANS_ONLINE_DESC_KEY = 'elitetrainersite_plans_online_desc';
	const PLANS_ONLINE_DESC_COLOR_KEY = 'elitetrainersite_plans_online_desc_color';
	const PLANS_ONLINE_DESC_FONT_SIZE_KEY = 'elitetrainersite_plans_online_desc_font_size';
	const PLANS_ONLINE_DESC_FONT_FAMILY_KEY = 'elitetrainersite_plans_online_desc_font_family';
	const PLANS_ONLINE_FEATURES_KEY = 'elitetrainersite_plans_online_features';
	const PLANS_ONLINE_BUTTON_TEXT_KEY = 'elitetrainersite_plans_online_button_text';
	const PLANS_PRESENCIAL_ENABLED_KEY = 'elitetrainersite_plans_presencial_enabled';
	const PLANS_PRESENCIAL_PRICE_KEY = 'elitetrainersite_plans_presencial_price';
	const PLANS_PRESENCIAL_PRICE_COLOR_KEY = 'elitetrainersite_plans_presencial_price_color';
	const PLANS_PRESENCIAL_PRICE_FONT_SIZE_KEY = 'elitetrainersite_plans_presencial_price_font_size';
	const PLANS_PRESENCIAL_PRICE_FONT_FAMILY_KEY = 'elitetrainersite_plans_presencial_price_font_family';
	const PLANS_PRESENCIAL_DESC_KEY = 'elitetrainersite_plans_presencial_desc';
	const PLANS_PRESENCIAL_DESC_COLOR_KEY = 'elitetrainersite_plans_presencial_desc_color';
	const PLANS_PRESENCIAL_DESC_FONT_SIZE_KEY = 'elitetrainersite_plans_presencial_desc_font_size';
	const PLANS_PRESENCIAL_DESC_FONT_FAMILY_KEY = 'elitetrainersite_plans_presencial_desc_font_family';
	const PLANS_PRESENCIAL_FEATURES_KEY = 'elitetrainersite_plans_presencial_features';
	const PLANS_PRESENCIAL_BUTTON_TEXT_KEY = 'elitetrainersite_plans_presencial_button_text';
	const PRESENCIAL_TABLE_HEAD_COLOR_KEY = 'elitetrainersite_plans_presencial_table_head_color';
	const PRESENCIAL_TABLE_HEAD_FONT_SIZE_KEY = 'elitetrainersite_plans_presencial_table_head_font_size';
	const PRESENCIAL_TABLE_HEAD_FONT_FAMILY_KEY = 'elitetrainersite_plans_presencial_table_head_font_family';

	const FOOTER_CONTACT_FORM_TEXT_COLOR_KEY = 'elitetrainersite_footer_contact_form_text_color';
	const FOOTER_CONTACT_FORM_BG_KEY = 'elitetrainersite_footer_contact_form_bg';
	const FOOTER_CONTACT_FORM_FONT_SIZE_KEY = 'elitetrainersite_footer_contact_form_font_size';
	const FOOTER_CONTACT_FORM_FONT_FAMILY_KEY = 'elitetrainersite_footer_contact_form_font_family';

	const FOOTER_TEXT_COLOR_KEY = 'elitetrainersite_footer_text_color';
	const FOOTER_LINK_COLOR_KEY = 'elitetrainersite_footer_link_color';
	const FOOTER_BG_KEY = 'elitetrainersite_footer_bg';
	const FOOTER_FONT_SIZE_KEY = 'elitetrainersite_footer_font_size';
	const FOOTER_FONT_FAMILY_KEY = 'elitetrainersite_footer_font_family';

	const CUSTOM_BUTTON_TEXT_PREFIX = 'elitetrainersite_custom_button_text_';
	const CUSTOM_BUTTON_TEXT_COLOR_PREFIX = 'elitetrainersite_custom_button_text_color_';
	const CUSTOM_BUTTON_BG_PREFIX = 'elitetrainersite_custom_button_bg_';
	const CUSTOM_BUTTON_FONT_SIZE_PREFIX = 'elitetrainersite_custom_button_font_size_';
	const CUSTOM_BUTTON_FONT_FAMILY_PREFIX = 'elitetrainersite_custom_button_font_family_';

	const CUSTOM_TEXT_TEXT_PREFIX = 'elitetrainersite_custom_text_text_';
	const CUSTOM_TEXT_TEXT_COLOR_PREFIX = 'elitetrainersite_custom_text_text_color_';
	const CUSTOM_TEXT_BG_PREFIX = 'elitetrainersite_custom_text_bg_';
	const CUSTOM_TEXT_FONT_SIZE_PREFIX = 'elitetrainersite_custom_text_font_size_';
	const CUSTOM_TEXT_FONT_FAMILY_PREFIX = 'elitetrainersite_custom_text_font_family_';

	const CUSTOM_HTML_CONTENT_PREFIX = 'elitetrainersite_custom_html_content_';

	const CUSTOM_VIDEO_LINK_PREFIX = 'elitetrainersite_custom_video_link_';
	const CUSTOM_IMAGE_ID_PREFIX = 'elitetrainersite_custom_image_id_';

	const PAGE_HEADER_VIDEO_ENABLED_PREFIX = 'elitetrainersite_page_header_video_enabled_';
	const PAGE_VIDEO_ENABLED_PREFIX = 'elitetrainersite_page_video_enabled_';
	const PAGE_IMAGE_ENABLED_PREFIX = 'elitetrainersite_page_image_enabled_';

	const USER_DIETS_FONT_FAMILY_KEY = 'elitetrainersite_user_diets_font_family';
	const USER_DIETS_BG_1_KEY = 'elitetrainersite_user_diets_bg_1';
	const USER_DIETS_BG_2_KEY = 'elitetrainersite_user_diets_bg_2';
	const USER_DIETS_COLOR_1_KEY = 'elitetrainersite_user_diets_color_1';
	const USER_DIETS_COLOR_2_KEY = 'elitetrainersite_user_diets_color_2';
	const USER_DIETS_COLOR_3_KEY = 'elitetrainersite_user_diets_color_3';
	const USER_DIETS_COLOR_4_KEY = 'elitetrainersite_user_diets_color_4';

	const USER_TRAINING_FONT_FAMILY_KEY = 'elitetrainersite_user_training_font_family';
	const USER_TRAINING_BG_1_KEY = 'elitetrainersite_user_training_bg_1';
	const USER_TRAINING_BG_2_KEY = 'elitetrainersite_user_training_bg_2';
	const USER_TRAINING_COLOR_1_KEY = 'elitetrainersite_user_training_color_1';
	const USER_TRAINING_COLOR_2_KEY = 'elitetrainersite_user_training_color_2';
	const USER_TRAINING_COLOR_3_KEY = 'elitetrainersite_user_training_color_3';
	const USER_TRAINING_COLOR_4_KEY = 'elitetrainersite_user_training_color_4';

	protected static $modals = array();

	protected static $common_updated = null;

	protected static $can_edit = null;

	public static function initialize()
	{
		//add_filter( 'pre_get_document_title', array( get_class(), 'filter_document_title' ), 90, 1 );
		//add_action( 'wp_head', array( get_class(), 'print_header_tags' ), 10, 0 );
		add_action( 'wp_head', array( get_class(), 'print_custom_style' ), 99, 0 );
		add_action( 'wp_head', array( get_class(), 'print_custom_fonts' ), 0, 0 );

		add_action( 'wp_footer', array( get_class(), 'print_modals' ), 0 );

		add_action( 'admin_post_toggle_customization', function(){

			$option = get_blog_option( null, self::IS_CUSTOMIZATION_ACTIVE_KEY ) == 'yes';

			update_blog_option( null, self::IS_CUSTOMIZATION_ACTIVE_KEY, $option ? 'no' : 'yes' );

			if( !empty( $_SERVER['HTTP_REFERER'] ) )
				wp_redirect( $_SERVER['HTTP_REFERER'] );	
			else
				wp_redirect( get_home_url() );	

			die();
		});

		add_action( 'wp_ajax_' . self::GET_IMAGE_BY_ID_ACTION, array( get_class(), 'get_image_by_id' ) );

		add_action( 'wp_ajax_' . self::MOVE_IMAGE_ACTION, array( get_class(), 'update_image_position' ) );
		add_action( 'wp_ajax_' . self::UPDATE_STYLE_ACTION, array( get_class(), 'get_custom_style' ) );

		add_action( 'wp_ajax_' . self::READ_HISTORY_ACTION, array( get_class(), 'read_history' ) );

		add_action( 'wp_enqueue_scripts', function(){
			wp_enqueue_script(
				'elite-trainer-theme-update-custom-style',
				get_template_directory_uri() . '/js/readevents/update-style.js',
				array( 'jquery' ),
				EliteTrainerSiteTheme::get_version(),
				true
			);
			wp_localize_script(
				'elite-trainer-theme-update-custom-style',
				'EliteTrainerSiteStyleNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'updateAction' => self::UPDATE_STYLE_ACTION,
					'moveImageAction' => self::MOVE_IMAGE_ACTION
				)
			);
			wp_enqueue_script(
				'elite-trainer-theme-move-image-script',
				get_template_directory_uri() . '/js/move-image.js',
				array( 'jquery', 'elite-trainer-theme-update-custom-style' ),
				EliteTrainerSiteTheme::get_version(),
				true
			);

			wp_enqueue_script(
				'elite-trainer-theme-history-script',
				get_template_directory_uri() . '/js/history.js',
				array( 'jquery' ),
				EliteTrainerSiteTheme::get_version(),
				true
			);
			wp_localize_script(
				'elite-trainer-theme-history-script',
				'EliteTrainerSiteHistoryNS',
				array(
					'adminUrl' => admin_url( 'admin-ajax.php' ),
					'readHistoryAction' => self::READ_HISTORY_ACTION,
					'getImageByIdAction' => self::GET_IMAGE_BY_ID_ACTION
				)
			);

			wp_enqueue_script(
				'elite-trainer-theme-restore-script',
				get_template_directory_uri() . '/js/readevents/restore.js',
				array( 'jquery' ),
				EliteTrainerSiteTheme::get_version(),
				true
			);
		});
	}

	public static function print_custom_style()
	{
		$template = locate_template( implode( DIRECTORY_SEPARATOR, array( 'templates', 'custom-style.php' ) ) );
		if( is_readable( $template ) )
			include( $template );
	}

	public static function get_custom_style()
	{
		self::print_custom_style();
		wp_die();
	}

	public static function print_custom_fonts()
	{
/*
		$family_name = self::get_global_font();

		echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' . $family_name . '">';
*/

		$fonts = self::get_available_fonts();
		foreach( $fonts as $font )
			echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' . $font . '">';

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
		

		$path = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'custom-styles', 'bg-rules.php' ) ) );
		include( $path );
	}

	public static function update_image_position()
	{
		$section = sanitize_text_field( $_POST['section'] );
		$direction = sanitize_text_field( $_POST['direction'] );

		if( $section == 'homecoverbg' )
		{
			if( $direction == 'top' )
			{
				$y = self::get_home_cover_bg_y();

				if( $y == 'center' )
					self::set_home_cover_bg_y( 'top' );
				elseif( $y == 'bottom' )
					self::set_home_cover_bg_y( 'center' );
				else
					self::set_home_cover_bg_y( 'top' );

echo $y . '=>' . self::get_home_cover_bg_y();
			}
			elseif( $direction == 'bottom' )
			{
				$y = self::get_home_cover_bg_y();

				if( $y == 'center' )
					self::set_home_cover_bg_y( 'bottom' );
				elseif( $y == 'top' )
					self::set_home_cover_bg_y( 'center' );
				else
					self::set_home_cover_bg_y( 'bottom' );

echo $y . '=>' . self::get_home_cover_bg_y();
			}
			elseif( $direction == 'left' )
			{
				$x = self::get_home_cover_bg_x();

				if( $x == 'center' )
					self::set_home_cover_bg_x( 'left' );
				elseif( $x == 'right' )
					self::set_home_cover_bg_x( 'center' );
				else
					self::set_home_cover_bg_x( 'left' );

echo $x . '=>' . self::get_home_cover_bg_x();
			}
			elseif( $direction == 'right' )
			{
				$x = self::get_home_cover_bg_x();

				if( $x == 'center' )
					self::set_home_cover_bg_x( 'right' );
				elseif( $x == 'left' )
					self::set_home_cover_bg_x( 'center' );
				else
					self::set_home_cover_bg_x( 'right' );
			}
		}
die();
/*
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeUpdateStyle',
				'args' => array()
			) )
		) );
		$response->send();
*/
		//die();
	}

	protected static function get_common_updated()
	{
		if( empty( self::$common_updated ) )
			self::$common_updated = date( 'Y-m-d h:i:s' );

		return self::$common_updated;
	}

	public static function update_blog_option( $blog_id, $key, $value, $updated = null )
	{
		update_blog_option( $blog_id, $key, $value );

		if( class_exists( 'EliteTrainerSiteThemeMapper', false ) )
		{
			$updated = $updated ? $updated : self::get_common_updated();

			EliteTrainerSiteThemeMapper::add_historical_option( $key, $value, $updated );
		}
	}

	public static function get_option_history( $option_name, $limit = 5 )
	{
		$rows = EliteTrainerSiteThemeMapper::get_option_history( $option_name, $limit );
		if( empty( $rows ) )
			return array();

		$ret = array();
		foreach( $rows as $row )
			$ret[] = $row->option_value;

		return $ret;
	}

	public static function get_filtered_options_group( $values, $options )
	{
		$ret = array();
		$i = 0;
		$flip = array_flip( $options );

		foreach( $values as $date => $value )
		{
			if( !array_key_exists( $date, $ret ) )
				$ret[$date] = array();

			foreach( $value as $opt )
			{
				foreach( $opt as $a )
					$ret[$date][$flip[$a->option_name]] = $a->option_value;
			}

			if( count( $ret[$date] ) < count( $options ) )
				unset( $ret[$date] );
		}

		return $ret;
	}

	public static function read_history()
	{
		//$section = sanitize_text_field( $_POST['section'] );
		$form_id = sanitize_text_field( $_POST['form'] );

		$form = EliteTrainerSiteTheme::get_form( $form_id );
		if( !$form )
			return 'NO FORM';

		$options = $form::get_form_options();
		if( empty( $options ) )
			return 'NO OPTIONS';

		$values = EliteTrainerSiteThemeMapper::get_options_group_history( $options );
		$values = self::get_filtered_options_group( $values, $options );

//echo json_encode( $values );die();

		$table_path = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'history-table.php' ) ) );
		include( $table_path );
		die();
/*
		$response = new WP_Ajax_Response( array(
			'what' => 'json',
			'action' => 'event',
			'id' => 1,
			'data' => json_encode( array(
				'name' => 'eliteTrainerThemeHistoryList',
				'args' => array( 'values' => $values )
			) )
		) );
		$response->send();
*/
	}

	public static function get_image_by_id()
	{
		$id = !empty( $_POST['id'] ) && is_numeric( $_POST['id'] ) ? (int)$_POST['id'] : null;
		if( !$id )
		{
			echo json_encode( array( 'url' => '' ) );
			die();
		}

		$url = wp_get_attachment_url( $id );
		if( !$url )
			$url = '';

		echo json_encode( array( 'url' => $url ) );
		die();
	}

	public static function get_available_fonts()
	{
		return array(
			'Audiowide' => 'Audiowide',
			'Bangers' => 'Bangers',
			'Black Ops One' => 'Black Ops One',
			'Ewert' => 'Ewert',
			'Merriweather' => 'Merriweather',
			'Monoton' => 'Monoton',
			'Open Sans' => 'Open Sans',
			'Oswald' => 'Oswald',
			'Roboto' => 'Roboto',
			'Special Elite' => 'Special Elite',
			'Tangerine' => 'Tangerine',
			'Unica One' => 'Unica One'
		);
	}

	public static function get_global_font()
	{
		return get_blog_option( null, self::GLOBAL_FONT_KEY, 'Roboto' );
	}
	public static function set_global_font( $font )
	{
		self::update_blog_option( null, self::GLOBAL_FONT_KEY, $font );
	}
/*
	public static function get_title_font()
	{
		return get_blog_option( null, self::TITLE_FONT_KEY, 'Roboto' );
	}
	public static function set_title_font( $font )
	{
		update_blog_option( null, self::TITLE_FONT_KEY, $font );
	}

	public static function get_subtitle_font()
	{
		return get_blog_option( null, self::SUBTITLE_FONT_KEY, 'Roboto' );
	}
	public static function set_subtitle_font( $font )
	{
		update_blog_option( null, self::SUBTITLE_FONT_KEY, $font );
	}
*/
	/////////////////////////////
	// FORMS
	/////////////////////////////

	public static function get_sections()
	{
		return array(
			'pagebg' => array(
				'target' => 'page-bg-modal',
				'title' => __( 'Fondo de esta página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PAGE_BG_FORM_INTERNAL_ID
			),
			'archivecasesbg' => array(
				'target' => 'archive-cases-bg-modal',
				'title' => __( 'Fondo de esta página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ARCHIVE_CASES_BG_FORM_INTERNAL_ID
			),

			'headernavbar' => array(
				'target' => 'header-navbar-modal',
				'title' => __( 'Cabecera principal', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HEADER_NAVBAR_FORM_INTERNAL_ID
			),
			'contactdata' => array(
				'target' => 'contact-data-modal',
				'title' => __( 'Datos de contacto', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::CONTACT_DATA_FORM_INTERNAL_ID
			),
			'mainmenu' => array(
				'target' => 'main-menu-modal',
				'title' => __( 'Menú principal', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::MAIN_MENU_FORM_INTERNAL_ID
			),
			'submenu' => array(
				'target' => 'sub-menu-modal',
				'title' => __( 'Submenú: Mi perfil', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::SUBMENU_FORM_INTERNAL_ID
			),
			'submenu2' => array(
				'target' => 'sub-menu-modal2',
				'title' => __( 'Submenú: Te llamamos', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::SUBMENU2_FORM_INTERNAL_ID
			),
			'homecovertitle' => array(
				'target' => 'home-cover-title-modal',
				'title' => __( 'Título de inicio', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOME_COVER_TITLE_FORM_INTERNAL_ID
			),
			'homecover' => array(
				'target' => 'home-cover-modal',
				'title' => __( 'Portada de inicio', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOME_COVER_FORM_INTERNAL_ID
			),
			'homecoverbg' => array(
				'target' => 'home-cover-bg-modal',
				'title' => __( 'Fondo de portada', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOME_COVER_BG_FORM_INTERNAL_ID
			),
			'homecoverlink' => array(
				'target' => 'home-cover-link-modal',
				'title' => __( 'Botón de la portada', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOME_COVER_LINK_FORM_INTERNAL_ID
			),
			'homecovervideo' => array(
				'target' => 'home-cover-video-modal',
				'title' => __( 'Vídeo de inicio', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOME_COVER_VIDEO_FORM_INTERNAL_ID
			),
			'homecovervideotitle' => array(
				'target' => 'home-cover-video-title-modal',
				'title' => __( 'Título del vídeo', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOME_COVER_VIDEO_TITLE_FORM_INTERNAL_ID
			),

			'realcasestitle' => array(
				'target' => 'real-cases-title-modal',
				'title' => __( 'Título para casos', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::REAL_CASES_TITLE_FORM_INTERNAL_ID
			),
			'morecaseslink' => array(
				'target' => 'more-cases-link-modal',
				'title' => __( 'Botón Más Casos', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::MORE_CASES_LINK_FORM_INTERNAL_ID
			),

			'targetcoverbg' => array(
				'target' => 'target-cover-bg-modal',
				'title' => __( 'Imagen de fondo', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::TARGET_COVER_BG_FORM_INTERNAL_ID
			),
			'targetcovertitle' => array(
				'target' => 'target-cover-title-modal',
				'title' => __( 'Título', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::TARGET_COVER_TITLE_FORM_INTERNAL_ID
			),
			'targetcovertext' => array(
				'target' => 'target-cover-text-modal',
				'title' => __( 'Texto', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::TARGET_COVER_TEXT_FORM_INTERNAL_ID
			),
			'targetcoverlink' => array(
				'target' => 'target-cover-link-modal',
				'title' => __( 'Enlace', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::TARGET_COVER_LINK_FORM_INTERNAL_ID
			),

			'planstitle' => array(
				'target' => 'plans-title-modal',
				'title' => __( 'Título', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PLANS_TITLE_FORM_INTERNAL_ID
			),

			'onlineplan' => array(
				'target' => 'online-plan-modal',
				'title' => __( 'Plan online', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_FORM_INTERNAL_ID
			),
			'onlineplantitle' => array(
				'target' => 'online-plan-title-modal',
				'title' => __( 'Título del plan online', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_TITLE_FORM_INTERNAL_ID
			),
			'onlineplandesc' => array(
				'target' => 'online-plan-desc-modal',
				'title' => __( 'Descripción del plan online', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_DESC_FORM_INTERNAL_ID
			),
			'onlineplanfeatures' => array(
				'target' => 'online-plan-features-modal',
				'title' => __( 'Plan online: Características', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_FEATURES_FORM_INTERNAL_ID
			),
			'knowonlinelink' => array(
				'target' => 'know-online-link-modal',
				'title' => __( 'Botón de plan online', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_KNOW_LINK_FORM_INTERNAL_ID
			),

			'presencialplan' => array(
				'target' => 'presencial-plan-modal',
				'title' => __( 'Plan presencial', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_PLAN_FORM_INTERNAL_ID
			),
			'presencialplantitle' => array(
				'target' => 'presencial-plan-title-modal',
				'title' => __( 'Título del plan presencial', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_PLAN_TITLE_FORM_INTERNAL_ID
			),
			'presencialplandesc' => array(
				'target' => 'presencial-plan-desc-modal',
				'title' => __( 'Descripción del plan presencial', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_PLAN_DESC_FORM_INTERNAL_ID
			),
			'presencialplanfeatures' => array(
				'target' => 'presencial-plan-features-modal',
				'title' => __( 'Plan presencial: Características', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_PLAN_FEATURES_FORM_INTERNAL_ID
			),
			'knowpresenciallink' => array(
				'target' => 'know-presencial-link-modal',
				'title' => __( 'Botón de plan presencial', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_KNOW_LINK_FORM_INTERNAL_ID
			),


			'contactlink' => array(
				'target' => 'contact-link-modal',
				'title' => __( 'Contact Button', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::CONTACT_BUTTON_FORM_INTERNAL_ID
			),
			'footercontactform' => array(
				'target' => 'footer-contact-form-modal',
				'title' => __( 'Contact Form', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOOTER_CONTACT_FORM_FORM_INTERNAL_ID
			),

			'footer' => array(
				'target' => 'footer-modal',
				'title' => __( 'Pie', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOOTER_FORM_INTERNAL_ID
			),

			'archiverealcasestitle' => array(
				'target' => 'archive-real-cases-title-modal',
				'title' => __( 'Título de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ARCHIVE_REAL_CASES_TITLE_FORM_INTERNAL_ID
			),
			'realcasesvideosubtitle' => array(
				'target' => 'real-cases-video-subtitle-modal',
				'title' => __( 'Subtítulo del video', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::REAL_CASES_VIDEO_SUBTITLE_FORM_INTERNAL_ID
			),

			'foryoupagetitle' => array(
				'target' => 'for-you-page-title-modal',
				'title' => __( 'Título de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_PAGE_TITLE_FORM_INTERNAL_ID
			),
			'foryoupagesection1title' => array(
				'target' => 'for-you-page-section-1-title-modal',
				'title' => __( 'Título de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_1_TITLE_FORM_INTERNAL_ID
			),
			'foryoupagesection1video' => array(
				'target' => 'for-you-page-section-1-video-modal',
				'title' => __( 'Vídeo de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_1_VIDEO_FORM_INTERNAL_ID
			),
			'foryoupagesection1content' => array(
				'target' => 'for-you-page-section-1-content-modal',
				'title' => __( 'Contenido de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_1_CONTENT_FORM_INTERNAL_ID
			),
			'foryoupagesection2title' => array(
				'target' => 'for-you-page-section-2-title-modal',
				'title' => __( 'Título de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_2_TITLE_FORM_INTERNAL_ID
			),
			'foryoupagesection2video' => array(
				'target' => 'for-you-page-section-2-video-modal',
				'title' => __( 'Vídeo de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_2_VIDEO_FORM_INTERNAL_ID
			),
			'foryoupagesection2content' => array(
				'target' => 'for-you-page-section-2-content-modal',
				'title' => __( 'Contenido de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_2_CONTENT_FORM_INTERNAL_ID
			),
			'foryoupagesection3title' => array(
				'target' => 'for-you-page-section-3-title-modal',
				'title' => __( 'Título de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_3_TITLE_FORM_INTERNAL_ID
			),
			'foryoupagesection3video' => array(
				'target' => 'for-you-page-section-3-video-modal',
				'title' => __( 'Vídeo de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_3_VIDEO_FORM_INTERNAL_ID
			),
			'foryoupagesection3content' => array(
				'target' => 'for-you-page-section-3-content-modal',
				'title' => __( 'Contenido de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_3_CONTENT_FORM_INTERNAL_ID
			),
			'foryoupagesection4title' => array(
				'target' => 'for-you-page-section-4-title-modal',
				'title' => __( 'Título de la sección 4', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_4_TITLE_FORM_INTERNAL_ID
			),
			'foryoupagesection4video' => array(
				'target' => 'for-you-page-section-4-video-modal',
				'title' => __( 'Vídeo de la sección 4', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_4_VIDEO_FORM_INTERNAL_ID
			),
			'foryoupagesection4content' => array(
				'target' => 'for-you-page-section-4-content-modal',
				'title' => __( 'Contenido de la sección 4', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_4_CONTENT_FORM_INTERNAL_ID
			),
			'foryoupagesection5title' => array(
				'target' => 'for-you-page-section-5-title-modal',
				'title' => __( 'Título de la sección 5', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_5_TITLE_FORM_INTERNAL_ID
			),
			'foryoupagesection5video' => array(
				'target' => 'for-you-page-section-5-video-modal',
				'title' => __( 'Vídeo de la sección 5', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_5_VIDEO_FORM_INTERNAL_ID
			),
			'foryoupagesection5content' => array(
				'target' => 'for-you-page-section-5-content-modal',
				'title' => __( 'Contenido de la sección 5', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::FOR_YOU_SECTION_5_CONTENT_FORM_INTERNAL_ID
			),

			// en desuso
			'howworkspagetitle' => array(
				'target' => 'how-works-page-title-modal',
				'title' => __( 'Título de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_PAGE_TITLE_FORM_INTERNAL_ID
			),
			/////

			'howworkspagetitle2' => array(
				'target' => 'how-works-page-title-modal',
				'title' => __( 'Título de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_PAGE_TITLE_2_FORM_INTERNAL_ID
			),
			'howworkspagesubtitle' => array(
				'target' => 'how-works-page-subtitle-modal',
				'title' => __( 'Subtítulo de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_PAGE_SUBTITLE_FORM_INTERNAL_ID
			),
			'howworksheadervideo' => array(
				'target' => 'how-works-page-video-modal',
				'title' => __( 'Vídeo de cabecera', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID
			),
			'howworkspagesection1content' => array(
				'target' => 'how-works-page-section-1-content-modal',
				'title' => __( 'Contenido de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_1_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection1image' => array(
				'target' => 'how-works-page-section-1-image-modal',
				'title' => __( 'Imagen de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_1_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection2title' => array(
				'target' => 'how-works-page-section-2-title-modal',
				'title' => __( 'Título de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_2_TITLE_FORM_INTERNAL_ID
			),
			'howworkspagesection2video' => array(
				'target' => 'how-works-page-section-2-video-modal',
				'title' => __( 'Vídeo de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_2_VIDEO_FORM_INTERNAL_ID
			),
			'howworkspagesection2content' => array(
				'target' => 'how-works-page-section-2-content-modal',
				'title' => __( 'Contenido de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_2_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection2image' => array(
				'target' => 'how-works-page-section-2-image-modal',
				'title' => __( 'Imagen de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_2_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection3content' => array(
				'target' => 'how-works-page-section-3-content-modal',
				'title' => __( 'Contenido de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_3_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection3image' => array(
				'target' => 'how-works-page-section-3-image-modal',
				'title' => __( 'Imagen de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_3_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection4content' => array(
				'target' => 'how-works-page-section-4-content-modal',
				'title' => __( 'Contenido de la sección 4', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_4_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection4image' => array(
				'target' => 'how-works-page-section-4-image-modal',
				'title' => __( 'Imagen de la sección 4', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_4_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection5title' => array(
				'target' => 'how-works-page-section-5-title-modal',
				'title' => __( 'Título de la sección 5', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_5_TITLE_FORM_INTERNAL_ID
			),
			'howworkspagesection5video' => array(
				'target' => 'how-works-page-section-5-video-modal',
				'title' => __( 'Vídeo de la sección 5', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_5_VIDEO_FORM_INTERNAL_ID
			),
			'howworkspagesection5content' => array(
				'target' => 'how-works-page-section-5-content-modal',
				'title' => __( 'Contenido de la sección 5', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_5_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection5image' => array(
				'target' => 'how-works-page-section-5-image-modal',
				'title' => __( 'Imagen de la sección 5', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_5_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection6content' => array(
				'target' => 'how-works-page-section-6-content-modal',
				'title' => __( 'Contenido de la sección 6', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_6_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection6image' => array(
				'target' => 'how-works-page-section-6-image-modal',
				'title' => __( 'Imagen de la sección 6', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_6_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection7content' => array(
				'target' => 'how-works-page-section-7-content-modal',
				'title' => __( 'Contenido de la sección 7', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_7_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection7image1' => array(
				'target' => 'how-works-page-section-7-image-1-modal',
				'title' => __( 'Imagen 1 de la sección 7', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_7_IMAGE_1_FORM_INTERNAL_ID
			),
			'howworkssection7image2' => array(
				'target' => 'how-works-page-section-7-image-2-modal',
				'title' => __( 'Imagen 2 de la sección 7', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_7_IMAGE_2_FORM_INTERNAL_ID
			),
			'howworkssection7image3' => array(
				'target' => 'how-works-page-section-7-image-3-modal',
				'title' => __( 'Imagen 3 de la sección 7', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_7_IMAGE_3_FORM_INTERNAL_ID
			),
			'howworkspagesection8title' => array(
				'target' => 'how-works-page-section-8-title-modal',
				'title' => __( 'Título de la sección 8', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_8_TITLE_FORM_INTERNAL_ID
			),
			'howworkspagesection8video' => array(
				'target' => 'how-works-page-section-8-video-modal',
				'title' => __( 'Vídeo de la sección 8', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_8_VIDEO_FORM_INTERNAL_ID
			),
			'howworkspagesection8content' => array(
				'target' => 'how-works-page-section-8-content-modal',
				'title' => __( 'Contenido de la sección 8', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_8_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection8image1' => array(
				'target' => 'how-works-page-section-8-image-1-modal',
				'title' => __( 'Imagen 1 de la sección 8', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_8_IMAGE_1_FORM_INTERNAL_ID
			),
			'howworkssection8image2' => array(
				'target' => 'how-works-page-section-8-image-2-modal',
				'title' => __( 'Imagen 2 de la sección 8', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_8_IMAGE_2_FORM_INTERNAL_ID
			),
			'howworkssection8image3' => array(
				'target' => 'how-works-page-section-8-image-3-modal',
				'title' => __( 'Imagen 3 de la sección 8', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_8_IMAGE_3_FORM_INTERNAL_ID
			),
			'howworkspagesection9content' => array(
				'target' => 'how-works-page-section-9-content-modal',
				'title' => __( 'Contenido de la sección 9', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_9_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection9image' => array(
				'target' => 'how-works-page-section-9-image-modal',
				'title' => __( 'Imagen de la sección 9', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_9_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection10content' => array(
				'target' => 'how-works-page-section-10-content-modal',
				'title' => __( 'Contenido de la sección 10', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_10_CONTENT_FORM_INTERNAL_ID
			),
			'howworkssection10image' => array(
				'target' => 'how-works-page-section-10-image-modal',
				'title' => __( 'Imagen de la sección 10', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_10_IMAGE_FORM_INTERNAL_ID
			),
			'howworkspagesection11content' => array(
				'target' => 'how-works-page-section-11-content-modal',
				'title' => __( 'Contenido de la sección 11', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::HOW_WORKS_SECTION_11_CONTENT_FORM_INTERNAL_ID
			),

			'onlineplanpagetitle' => array(
				'target' => 'online-plan-page-title-modal',
				'title' => __( 'Título de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_PAGE_TITLE_FORM_INTERNAL_ID
			),
			'onlineplanpagesubtitle' => array(
				'target' => 'online-plan-page-subtitle-modal',
				'title' => __( 'Subtítulo de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_PAGE_SUBTITLE_FORM_INTERNAL_ID
			),
			'onlineheadervideo' => array(
				'target' => 'online-plan-page-video-modal',
				'title' => __( 'Vídeo de cabecera', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID
			),


			'onlineplanpagesection0acontent' => array(
				'target' => 'online-plan-page-section-0a-content-modal',
				'title' => __( 'Contenido de la sección 0', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_0A_CONTENT_FORM_INTERNAL_ID
			),
			'onlineplanpagesection0bcontent' => array(
				'target' => 'online-plan-page-section-0b-content-modal',
				'title' => __( 'Contenido de la sección 0', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_0B_CONTENT_FORM_INTERNAL_ID
			),
			'onlinetopresenciallink' => array(
				'target' => 'online-to-presencial-link-modal',
				'title' => __( 'Botón', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_TO_PRESENCIAL_LINK_FORM_INTERNAL_ID
			),

			'onlineplanpagesection1title' => array(
				'target' => 'online-plan-page-section-1-title-modal',
				'title' => __( 'Título de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_1_TITLE_FORM_INTERNAL_ID
			),
			'onlineplansection1video' => array(
				'target' => 'online-plan-page-section-1-video-modal',
				'title' => __( 'Vídeo de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_1_VIDEO_FORM_INTERNAL_ID
			),
			'onlineplanpagesection1content' => array(
				'target' => 'online-plan-page-section-1-content-modal',
				'title' => __( 'Contenido de la sección 1', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_1_CONTENT_FORM_INTERNAL_ID
			),
			'onlineplanpagesection2title' => array(
				'target' => 'online-plan-page-section-2-title-modal',
				'title' => __( 'Título de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_2_TITLE_FORM_INTERNAL_ID
			),
			'onlineplansection2video' => array(
				'target' => 'online-plan-page-section-2-video-modal',
				'title' => __( 'Vídeo de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_2_VIDEO_FORM_INTERNAL_ID
			),
			'onlineplanpagesection2content' => array(
				'target' => 'online-plan-page-section-2-content-modal',
				'title' => __( 'Contenido de la sección 2', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_2_CONTENT_FORM_INTERNAL_ID
			),
			'onlineplanpagesection3title' => array(
				'target' => 'online-plan-page-section-3-title-modal',
				'title' => __( 'Título de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_3_TITLE_FORM_INTERNAL_ID
			),
			'onlineplansection3video' => array(
				'target' => 'online-plan-page-section-3-video-modal',
				'title' => __( 'Vídeo de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_3_VIDEO_FORM_INTERNAL_ID
			),
			'onlineplanpagesection3content' => array(
				'target' => 'online-plan-page-section-3-content-modal',
				'title' => __( 'Contenido de la sección 3', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::ONLINE_PLAN_SECTION_3_CONTENT_FORM_INTERNAL_ID
			),


			'presencialplanpagetitle' => array(
				'target' => 'presencial-plan-page-title-modal',
				'title' => __( 'Título de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_PLAN_PAGE_TITLE_FORM_INTERNAL_ID
			),
			'presencialplanpagesubtitle' => array(
				'target' => 'presencial-plan-page-subtitle-modal',
				'title' => __( 'Subtítulo de la página', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_PLAN_PAGE_SUBTITLE_FORM_INTERNAL_ID
			),
			'presencialheadervideo' => array(
				'target' => 'presencial-plan-page-video-modal',
				'title' => __( 'Vídeo de cabecera', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_PLAN_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID
			),
			'presencialtablehead' => array(
				'target' => 'presencial-table-head-modal',
				'title' => __( 'Cabeceras de la tabla', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::PRESENCIAL_TABLE_HEAD_FORM_INTERNAL_ID
			),

			'corporalmeasuresheadertext' => array(
				'target' => 'corporal-measures-header-content-modal',
				'title' => __( 'Contenido de medidas corporales', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::CORPORAL_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID
			),
			'corporalmeasuresheaderimage' => array(
				'target' => 'corporal-measures-header-image-modal',
				'title' => __( 'Imagen de medidas corporales', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::CORPORAL_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID
			),

			'strengthmeasuresheadertext' => array(
				'target' => 'strength-measures-header-content-modal',
				'title' => __( 'Contenido de medidas de fuerza', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::STRENGTH_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID
			),
			'strengthmeasuresheaderimage' => array(
				'target' => 'strength-measures-header-image-modal',
				'title' => __( 'Imagen de medidas de fuerza', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::STRENGTH_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID
			),
			'speedmeasuresheadertext' => array(
				'target' => 'speed-measures-header-content-modal',
				'title' => __( 'Contenido de medidas de velocidad', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::SPEED_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID
			),
			'speedmeasuresheaderimage' => array(
				'target' => 'speed-measures-header-image-modal',
				'title' => __( 'Imagen de medidas de velocidad', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::SPEED_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID
			),
			'distancemeasuresheadertext' => array(
				'target' => 'distance-measures-header-content-modal',
				'title' => __( 'Contenido de medidas de distancia', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::DISTANCE_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID
			),
			'distancemeasuresheaderimage' => array(
				'target' => 'distance-measures-header-image-modal',
				'title' => __( 'Imagen de medidas de distancia', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::DISTANCE_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID
			),

			'userdietsstyle' => array(
				'target' => 'user-diets-style-modal',
				'title' => __( 'Estilo para dietas', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::USER_DIETS_STYLE_FORM_INTERNAL_ID
			),
			'usertrainingstyle' => array(
				'target' => 'user-training-style-modal',
				'title' => __( 'Estilo para entrenamientos', EliteTrainerSiteTheme::TEXT_DOMAIN ),
				'form' => EliteTrainerSiteTheme::USER_TRAINING_STYLE_FORM_INTERNAL_ID
			),
		);
	}

	public static function get_section( $key )
	{
		$sections = self::get_sections();
		return array_key_exists( $key, $sections ) ? $sections[$key] : null;
	}

	public static function can_edit()
	{
		if( self::$can_edit === null )
		{
			self::$can_edit =
				current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) &&
				get_blog_option( null, self::IS_CUSTOMIZATION_ACTIVE_KEY ) == 'yes';
		}

		return self::$can_edit;
	}

	public static function print_edit_button( $section_key )
	{
		if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) &&
			get_blog_option( null, self::IS_CUSTOMIZATION_ACTIVE_KEY ) == 'yes'
		) {
			$section = self::get_section( $section_key );
			if( $section )
			{
				self::$modals[$section_key] = $section;

				echo '<button class="edit-section-button" data-toggle="modal" data-target="#' . $section['target'] . '"><span class="glyphicon glyphicon-wrench"></span></button>';
			}
		}
	}

	public static function include_modal_without_button( $section_key )
	{
		if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) &&
			get_blog_option( null, self::IS_CUSTOMIZATION_ACTIVE_KEY ) == 'yes'
		) {
			$section = self::get_section( $section_key );
			if( $section )
			{
				self::$modals[$section_key] = $section;
			}
		}
	}

	public static function print_bg_image_arrows( $section_key )
	{
		if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) &&
			get_blog_option( null, self::IS_CUSTOMIZATION_ACTIVE_KEY ) == 'yes'
		) {
			$section = self::get_section( $section_key );
			if( $section )
			{
				//self::$modals[$section_key] = $section;

				echo '<button class="move-image-arrow move-image-arrow-top" data-direction="top" data-section="' . $section['target'] . '"><span class="glyphicon glyphicon-arrow-up"></span></button>';
				echo '<button class="move-image-arrow move-image-arrow-right" data-direction="right" data-section="' . $section['target'] . '"><span class="glyphicon glyphicon-arrow-right"></span></button>';
				echo '<button class="move-image-arrow move-image-arrow-bottom" data-direction="bottom" data-section="' . $section['target'] . '"><span class="glyphicon glyphicon-arrow-down"></span></button>';
				echo '<button class="move-image-arrow move-image-arrow-left" data-direction="left" data-section="' . $section['target'] . '"><span class="glyphicon glyphicon-arrow-left"></span></button>';
			}
		}
	}

	public static function print_modals()
	{
		$modal_path = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'edit-section-modal.php' ) ) );
		foreach( self::$modals as $modal )
		{
			include( $modal_path );
		}
	}

	public static function print_custom_button_style( $button, $selector, $default_color = null, $default_font_size = null, $default_font_family = null, $default_bg = null )
	{
		$style = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'custom-styles', 'custom-button.php' ) ) );

		include( $style );
	}

	public static function print_custom_text_style( $text_name, $selector, $default_color = null, $default_font_size = null, $default_font_family = null )
	{
		$style = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'custom-styles', 'custom-text.php' ) ) );

		include( $style );
	}

	public static function get_bg_pages()
	{
		return get_posts( array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'fields' => 'ids',
			'numberposts' => -1
		) );
	}

	public static function get_page_bg( $page_id )
	{
		$default = null;

		$color = get_blog_option( null, self::PAGE_BG_PREFIX . $page_id, $default );

		return $color;
	}

	public static function set_page_bg( $page_id, $bg )
	{
		self::update_blog_option( null, self::PAGE_BG_PREFIX . $page_id, $bg );
	}

	public static function get_archive_cases_bg()
	{
		$default = null;

		$color = get_blog_option( null, self::ARCHIVE_CASES_BG_KEY, $default );

		return $color;
	}

	public static function set_archive_cases_bg( $bg )
	{
		self::update_blog_option( null, self::ARCHIVE_CASES_BG_KEY, $bg );
	}


	public static function print_page_header_video(
		$title_key,
		$default_title,
		$video_key,
		$subtitle_key,
		$default_subtitle
	) {

		$template = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'page-headervideo.php' ) ) );

		include $template;
	}

	public static function print_page_video( $video_key)
	{

		$template = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'page-video.php' ) ) );

		include $template;
	}

	public static function print_page_image( $image_key, $default_image_url = null )
	{

		$template = realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'page-image.php' ) ) );

		include $template;
	}


	/////////////////////////////
	// COLOR MANIPULATION
	/////////////////////////////

    public static function color_luminance( $hex, $percent ) {

        $hex = preg_replace( '/[^0-9a-f]/i', '', $hex );


        if ( strlen( $hex ) === 3 ) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }


        if ( strlen( $hex ) !== 6 ) {
            return '#000000'; 
        }

        $new_hex = '#';

        if ( !is_numeric( $percent ) ) {
            $percent = 0;
        }


        for ( $i = 0; $i < 3; $i++ ) {
            $dec = hexdec( substr( $hex, $i * 2, 2 ) );
            $adjusted = $dec + ($dec * $percent);
            $adjusted = min( max( 0, $adjusted ), 255 ); // Clamp values between 0 and 255
            $new_hex .= str_pad( dechex( (int) $adjusted ), 2, '0', STR_PAD_LEFT );
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

	/////////////////////////////
	// GLOBAL COLORS
	/////////////////////////////

	public static function get_main_color()
	{
		$main_color = get_blog_option( null, self::MAIN_COLOR_KEY, '#b6c352' );

		return $main_color;
	}
	public static function set_main_color( $color )
	{
		self::update_blog_option( null, self::MAIN_COLOR_KEY, $color );
	}

	public static function get_secondary_color()
	{
		$color = get_blog_option( null, self::SECONDARY_COLOR_KEY, '#dddddd' );

		return $color;
	}
	public static function set_secondary_color( $color )
	{
		self::update_blog_option( null, self::SECONDARY_COLOR_KEY, $color );
	}

	public static function get_body_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#FFFFFF', 'color_1' => '#FFFFFF' ) );

		$color = get_blog_option( null, self::BODY_BG_COLOR_KEY, $default );

		return $color;
	}

	public static function get_body_bg_color( $index = 0 )
	{
		$bg = json_decode( self::get_body_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#ffffff';

		return $color;
	}

	public static function set_body_bg_color( $color )
	{
		self::update_blog_option( null, self::BODY_BG_COLOR_KEY, $color );
	}

	public static function get_text_color()
	{
		$color = get_blog_option( null, self::TEXT_COLOR_KEY, '#111111' );

		return $color;
	}
	public static function set_text_color( $color )
	{
		self::update_blog_option( null, self::TEXT_COLOR_KEY, $color );
	}

	/////////////////////////////
	// MAIN MENU
	/////////////////////////////

	public static function must_hide_main_menu_on_desktop()
	{
		$hide = get_blog_option( null, self::MAIN_MENU_HIDE_ON_DESKTOP, false );

		return $hide === 'yes';
	}
	public static function set_hide_main_menu_on_desktop( $hide )
	{
		self::update_blog_option( null, self::MAIN_MENU_HIDE_ON_DESKTOP, $hide ? 'yes' : 'no' );
	}

	public static function get_main_menu_text_color()
	{
		$color = get_blog_option( null, self::MAIN_MENU_TEXT_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_main_menu_text_color( $color )
	{
		self::update_blog_option( null, self::MAIN_MENU_TEXT_COLOR_KEY, $color );
	}

	public static function get_main_menu_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => self::get_main_color(), 'color_1' => self::get_secondary_color() ) );

		$bg = get_blog_option( null, self::MAIN_MENU_BG_KEY, $default );

		return $bg;
	}
	public static function get_main_menu_type_bg()
	{
		$bg = json_decode( self::get_main_menu_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_main_menu_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_main_menu_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : self::get_main_color();

		return $color;
	}
	public static function set_main_menu_bg( $bg )
	{
		self::update_blog_option( null, self::MAIN_MENU_BG_KEY, $bg );
	}

	public static function get_main_menu_font_size()
	{
		$size = get_blog_option( null, self::MAIN_MENU_FONT_SIZE_KEY, 13 );

		return $size;
	}
	public static function set_main_menu_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::MAIN_MENU_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_main_menu_font_family()
	{
		$size = get_blog_option( null, self::MAIN_MENU_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_main_menu_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::MAIN_MENU_FONT_FAMILY_KEY, $title_font_family );
	}

	/////////////////////////////
	// SUB MENU
	/////////////////////////////

	public static function get_submenu_text_color()
	{
		$color = get_blog_option( null, self::SUBMENU_TEXT_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_submenu_text_color( $color )
	{
		self::update_blog_option( null, self::SUBMENU_TEXT_COLOR_KEY, $color );
	}

	public static function get_submenu_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => self::get_secondary_color(), 'color_1' => self::get_secondary_color() ) );

		$bg = get_blog_option( null, self::SUBMENU_BG_KEY, $default );

		return $bg;
	}
	public static function get_submenu_type_bg()
	{
		$bg = json_decode( self::get_submenu_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_submenu_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_submenu_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		return $color;
	}
	public static function set_submenu_bg( $bg )
	{
		self::update_blog_option( null, self::SUBMENU_BG_KEY, $bg );
	}

	public static function get_submenu_font_size()
	{
		$size = get_blog_option( null, self::SUBMENU_FONT_SIZE_KEY, 13 );

		return $size;
	}
	public static function set_submenu_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::SUBMENU_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_submenu_font_family()
	{
		$size = get_blog_option( null, self::SUBMENU_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_submenu_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::SUBMENU_FONT_FAMILY_KEY, $title_font_family );
	}

	/////////////////////////////
	// SUB MENU 2
	/////////////////////////////

	public static function get_submenu2_text_color()
	{
		$color = get_blog_option( null, self::SUBMENU2_TEXT_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_submenu2_text_color( $color )
	{
		self::update_blog_option( null, self::SUBMENU2_TEXT_COLOR_KEY, $color );
	}

	public static function get_submenu2_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => self::get_main_color(), 'color_1' => self::get_main_color() ) );

		$bg = get_blog_option( null, self::SUBMENU2_BG_KEY, $default );

		return $bg;
	}
	public static function get_submenu2_type_bg()
	{
		$bg = json_decode( self::get_submenu2_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_submenu2_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_submenu2_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		return $color;
	}
	public static function set_submenu2_bg( $bg )
	{
		self::update_blog_option( null, self::SUBMENU2_BG_KEY, $bg );
	}

	public static function get_submenu2_font_size()
	{
		$size = get_blog_option( null, self::SUBMENU2_FONT_SIZE_KEY, 13 );

		return $size;
	}
	public static function set_submenu2_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::SUBMENU2_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_submenu2_font_family()
	{
		$size = get_blog_option( null, self::SUBMENU2_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_submenu2_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::SUBMENU2_FONT_FAMILY_KEY, $title_font_family );
	}

	/////////////////////////////
	// FOOTER CONTACT FORM
	/////////////////////////////

	public static function get_footer_contact_form_text_color()
	{
		$color = get_blog_option( null, self::FOOTER_CONTACT_FORM_TEXT_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_footer_contact_form_text_color( $color )
	{
		self::update_blog_option( null, self::FOOTER_CONTACT_FORM_TEXT_COLOR_KEY, $color );
	}

	public static function get_footer_contact_form_bg()
	{
		$default = json_encode( array( 'type' => 'gradient', 'color_0' => self::get_main_color(), 'color_1' => self::get_secondary_color() ) );

		$bg = get_blog_option( null, self::FOOTER_CONTACT_FORM_BG_KEY, $default );

		return $bg;
	}
	public static function get_footer_contact_form_type_bg()
	{
		$bg = json_decode( self::get_footer_contact_form_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_footer_contact_form_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_footer_contact_form_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		return $color;
	}
	public static function set_footer_contact_form_bg( $bg )
	{
		self::update_blog_option( null, self::FOOTER_CONTACT_FORM_BG_KEY, $bg );
	}

	public static function get_footer_contact_form_font_size()
	{
		$size = get_blog_option( null, self::FOOTER_CONTACT_FORM_FONT_SIZE_KEY, 16 );

		return $size;
	}
	public static function set_footer_contact_form_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::FOOTER_CONTACT_FORM_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_footer_contact_form_font_family()
	{
		$size = get_blog_option( null, self::FOOTER_CONTACT_FORM_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_footer_contact_form_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::FOOTER_CONTACT_FORM_FONT_FAMILY_KEY, $title_font_family );
	}
	/////////////////////////////
	// CONTACT
	/////////////////////////////
	public static function get_contact_phone()
	{
		$contact_phone = get_blog_option( null, self::CONTACT_PHONE_KEY, '123 456 789' );

		return $contact_phone;
	}
	public static function set_contact_phone( $phone )
	{
		self::update_blog_option( null, self::CONTACT_PHONE_KEY, $phone );
	}

	/////////////////////////////
	// HEADER
	/////////////////////////////
	public static function get_header_bg_color()
	{
		$color = get_blog_option( null, self::HEADER_BG_COLOR_KEY, '#000000' );

		return $color;
	}
	public static function set_header_bg_color( $color )
	{
		self::update_blog_option( null, self::HEADER_BG_COLOR_KEY, $color );
	}
	public static function get_header_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#000000', 'color_1' => '#000000' ) );

		$bg = get_blog_option( null, self::HEADER_BG_COLOR_KEY, $default );

		return $bg;
	}
	public static function get_header_type_bg()
	{
		$bg = json_decode( self::get_header_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_header_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_header_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		return $color;
	}
	public static function set_header_bg( $bg )
	{
		self::update_blog_option( null, self::HEADER_BG_COLOR_KEY, $bg );
	}

	public static function get_header_logo()
	{
		return get_blog_option( null, self::HEADER_LOGO_KEY );
	}

	public static function get_header_logo_url()
	{
		$logo_id = get_blog_option( null, self::HEADER_LOGO_KEY );
		return $logo_id && $logo_id != 'false' ? wp_get_attachment_url( $logo_id ) : get_template_directory_uri() . '/img/logo.png';
	}

	public static function set_header_logo( $logo_id )
	{
		self::update_blog_option( null, self::HEADER_LOGO_KEY, $logo_id );
	}

	public static function get_header_logo_position()
	{
		return get_blog_option( null, self::HEADER_LOGO_POS_KEY, 'left' );
	}
	public static function set_header_logo_position( $position )
	{
		self::update_blog_option( null, self::HEADER_LOGO_POS_KEY, $position );
	}

	public static function get_header_logo_size()
	{
		return get_blog_option( null, self::HEADER_LOGO_SIZE_KEY, 'normal' );
	}
	public static function set_header_logo_size( $size )
	{
		self::update_blog_option( null, self::HEADER_LOGO_SIZE_KEY, $size );
	}

	public static function get_header_title()
	{
		$title = get_blog_option( null, self::HEADER_TITLE_KEY, get_bloginfo( 'name' )  );

		return $title;
	}
	public static function set_header_title( $title )
	{
		self::update_blog_option( null, self::HEADER_TITLE_KEY, $title );
	}

	public static function get_header_title_color()
	{
		$color = get_blog_option( null, self::HEADER_TITLE_COLOR_KEY, '#ffffff' );

		return $color;
	}
	public static function set_header_title_color( $title_color )
	{
		self::update_blog_option( null, self::HEADER_TITLE_COLOR_KEY, $title_color );
	}

	public static function get_header_title_font()
	{
		$font = get_blog_option( null, self::HEADER_TITLE_FONT_KEY, 'Roboto' );

		return $font;
	}
	public static function set_header_title_font( $title_font )
	{
		self::update_blog_option( null, self::HEADER_TITLE_FONT_KEY, $title_font );
	}

	public static function get_header_title_font_size()
	{
		$size = get_blog_option( null, self::HEADER_TITLE_FONT_SIZE_KEY, 22 );

		return $size;
	}
	public static function set_header_title_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::HEADER_TITLE_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_header_subtitle()
	{
		$title = get_blog_option( null, self::HEADER_SUBTITLE_KEY, get_bloginfo( 'description' )  );

		return $title;
	}
	public static function set_header_subtitle( $subtitle )
	{
		self::update_blog_option( null, self::HEADER_SUBTITLE_KEY, $subtitle );
	}

	public static function get_header_subtitle_color()
	{
		$color = get_blog_option( null, self::HEADER_SUBTITLE_COLOR_KEY, '#ffffff' );

		return $color;
	}
	public static function set_header_subtitle_color( $subtitle_color )
	{
		self::update_blog_option( null, self::HEADER_SUBTITLE_COLOR_KEY, $subtitle_color );
	}

	public static function get_header_subtitle_font()
	{
		$font = get_blog_option( null, self::HEADER_SUBTITLE_FONT_KEY, 'Roboto' );

		return $font;
	}
	public static function set_header_subtitle_font( $subtitle_font )
	{
		self::update_blog_option( null, self::HEADER_SUBTITLE_FONT_KEY, $subtitle_font );
	}

	public static function get_header_subtitle_font_size()
	{
		$size = get_blog_option( null, self::HEADER_SUBTITLE_FONT_SIZE_KEY, 12 );

		return $size;
	}
	public static function set_header_subtitle_font_size( $subtitle_font_size )
	{
		self::update_blog_option( null, self::HEADER_SUBTITLE_FONT_SIZE_KEY, $subtitle_font_size );
	}

	/////////////////////////////
	// HOME COVER
	/////////////////////////////
	public static function get_home_cover_title()
	{
		$title = get_blog_option( null, self::HOME_COVER_TITLE_KEY, 'Transforma tu Cuerpo gracias a nuestros entrenamientos Online y Presenciales' );

		return $title;
	}
	public static function set_home_cover_title( $title )
	{
		self::update_blog_option( null, self::HOME_COVER_TITLE_KEY, $title );
	}

	public static function get_home_cover_title_color()
	{
		$default = '#ffffff';//self::get_text_color();

		$color = get_blog_option( null, self::HOME_COVER_TITLE_COLOR_KEY, $default );

		return $color;
	}
	public static function set_home_cover_title_color( $color )
	{
		self::update_blog_option( null, self::HOME_COVER_TITLE_COLOR_KEY, $color );
	}

	public static function get_home_cover_title_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#000000', 'color_1' => self::get_secondary_color() ) );

		$bg = get_blog_option( null, self::HOME_COVER_TITLE_BG_KEY, $default );

		return $bg;
	}
	public static function get_home_cover_title_type_bg()
	{
		$bg = json_decode( self::get_home_cover_title_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_home_cover_title_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_home_cover_title_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		return $color;
	}
	public static function get_home_cover_title_opacity_bg( $index = 0 )
	{
		$bg = json_decode( self::get_home_cover_title_bg() );
		$index_name = 'color_' . $index . '_opacity';
		$color = isset( $bg->$index_name ) ? $bg->$index_name : 0.5;

		return $color;
	}
	public static function set_home_cover_title_bg( $bg )
	{
		self::update_blog_option( null, self::HOME_COVER_TITLE_BG_KEY, $bg );
	}

	public static function get_home_cover_title_font_family()
	{
		$size = get_blog_option( null, self::HOME_COVER_TITLE_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_home_cover_title_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::HOME_COVER_TITLE_FONT_FAMILY_KEY, $title_font_family );
	}

	public static function get_home_cover_title_font_size()
	{
		$size = get_blog_option( null, self::HOME_COVER_TITLE_FONT_SIZE_KEY, 36 );

		return $size;
	}
	public static function set_home_cover_title_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::HOME_COVER_TITLE_FONT_SIZE_KEY, $title_font_size );
	}


	public static function get_home_cover_text()
	{
		$default = '<ul><li>Personal trainer presencial</li><li>Personal trainer online</li><li>Dietas y alimentación personalizada</li><li>Transformación corporal</li><li>Programas de entrenamiento personalizados</li><li>Mantén tu cuerpo en forma</li></ul>';

		$text = get_blog_option( null, self::HOME_COVER_TEXT_KEY, $default );

		return $text;
	}
	public static function set_home_cover_text( $text )
	{
		self::update_blog_option( null, self::HOME_COVER_TEXT_KEY, $text );
	}

	public static function get_home_cover_button_text()
	{
		$default = 'Comienza ahora mismo y no lo dejes para mañana';

		$text = get_blog_option( null, self::HOME_COVER_BUTTON_TEXT_KEY, $default );

		return $text;
	}
	public static function set_home_cover_button_text( $text )
	{
		self::update_blog_option( null, self::HOME_COVER_BUTTON_TEXT_KEY, $text );
	}

	public static function get_home_cover_button_color()
	{
		$default = self::get_text_color();

		$color = get_blog_option( null, self::HOME_COVER_BUTTON_COLOR_KEY, $default );

		return $color;
	}
	public static function set_home_cover_button_color( $color )
	{
		self::update_blog_option( null, self::HOME_COVER_BUTTON_COLOR_KEY, $color );
	}

	public static function get_home_cover_button_bg()
	{
		//$default = self::get_main_color();
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#fff'/*self::get_main_color()*/, 'color_1' => self::get_secondary_color() ) );

		$color = get_blog_option( null, self::HOME_COVER_BUTTON_COLOR_BG_KEY, $default );

		return $color;
	}
	public static function get_home_cover_button_type_bg()
	{
		$bg = json_decode( self::get_home_cover_button_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_home_cover_button_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_home_cover_button_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#fff';//self::get_main_color();
return '#fff';
		return $color;
	}
	public static function set_home_cover_button_color_bg( $color )
	{
		self::update_blog_option( null, self::HOME_COVER_BUTTON_COLOR_BG_KEY, $color );
	}


	public static function get_home_cover_video()
	{
		$default = '<iframe width="560" height="315" src="https://www.youtube.com/embed/z-AUsKVQL6o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

		$video = get_blog_option( null, self::HOME_COVER_VIDEO_KEY, $default );

		return $video;
	}
	public static function set_home_cover_video( $video )
	{
		self::update_blog_option( null, self::HOME_COVER_VIDEO_KEY, $video );
	}
	public static function get_home_cover_video_link()
	{
		//$default = 'https://youtu.be/z-AUsKVQL6o';
		$default = 'https://youtu.be/yhtI6UkilRs';

		$video = get_blog_option( null, self::HOME_COVER_VIDEO_LINK_KEY, $default );

		return $video;
	}
	public static function set_home_cover_video_link( $video_link )
	{
		self::update_blog_option( null, self::HOME_COVER_VIDEO_LINK_KEY, $video_link );
	}


	public static function get_home_cover_bg( $horizontal = true )
	{
		$default = null;

		//$id = get_blog_option( null, $horizontal ? self::HOME_COVER_BG_KEY : self::HOME_COVER_BG_V_KEY, $default );
		$val = get_blog_option( null, $horizontal ? self::HOME_COVER_BG_KEY : self::HOME_COVER_BG_V_KEY, $default );

		return $val;
	}
	public static function get_home_cover_bg_id( $horizontal = true )
	{
		/* PARA  add_ajax_upload_image_position_field
		$val = self::get_home_cover_bg( $horizontal );
		$val = json_decode( $val );
		$id = isset( $val->id ) ? $val->id : null;
		*/
		$id = self::get_home_cover_bg( $horizontal );

		return $id;
	}

	public static function get_home_cover_bg_url( $horizontal = true )
	{
		$id = self::get_home_cover_bg_id( $horizontal );

		if( !$id )
			return get_template_directory_uri() . '/img/photos/home-cover.jpg';

		return wp_get_attachment_url( $id );
	}
	public static function set_home_cover_bg( $id, $horizontal = true )
	{
		self::update_blog_option( null, $horizontal ? self::HOME_COVER_BG_KEY : self::HOME_COVER_BG_V_KEY, $id );
	}

	public static function get_home_cover_bg_x( $horizontal = true )
	{
/*
		$default = 'center';

		$pos = get_blog_option( null, self::HOME_COVER_BG_X_KEY, $default );

		return $pos;
*/
		$default = 50;

		$val = get_blog_option( null, $horizontal ? self::HOME_COVER_BG_KEY : self::HOME_COVER_BG_V_KEY, $default );
		$val = json_decode( $val );
		$id = isset( $val->x ) ? $val->x : null;

		return $id;
	}
	public static function set_home_cover_bg_x( $x )
	{
		self::update_blog_option( null, self::HOME_COVER_BG_X_KEY, $x );
	}

	public static function get_home_cover_bg_y( $horizontal = true )
	{
/*
		$default = 'center';

		$pos = get_blog_option( null, self::HOME_COVER_BG_Y_KEY, $default );

		return $pos;
*/
		$default = 50;

		$val = get_blog_option( null, $horizontal ? self::HOME_COVER_BG_KEY : self::HOME_COVER_BG_V_KEY, $default );
		$val = json_decode( $val );
		$id = isset( $val->y ) ? $val->y : null;

		return $id;
	}
	public static function set_home_cover_bg_y( $y )
	{
		self::update_blog_option( null, self::HOME_COVER_BG_Y_KEY, $y );
	}


	// TARGET
	public static function get_target_cover_title()
	{
		$title = get_blog_option( null, self::TARGET_COVER_TITLE_KEY, 'Eres nuestro objetivo' );

		return $title;
	}
	public static function set_target_cover_title( $title )
	{
		self::update_blog_option( null, self::TARGET_COVER_TITLE_KEY, $title );
	}

	public static function get_target_cover_title_color()
	{
		$default = self::get_text_color();

		$color = get_blog_option( null, self::TARGET_COVER_TITLE_COLOR_KEY, $default );

		return $color;
	}
	public static function set_target_cover_title_color( $color )
	{
		self::update_blog_option( null, self::TARGET_COVER_TITLE_COLOR_KEY, $color );
	}

	public static function get_target_cover_title_font_family()
	{
		$size = get_blog_option( null, self::TARGET_COVER_TITLE_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_target_cover_title_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::TARGET_COVER_TITLE_FONT_FAMILY_KEY, $title_font_family );
	}

	public static function get_target_cover_title_font_size()
	{
		$size = get_blog_option( null, self::TARGET_COVER_TITLE_FONT_SIZE_KEY, 30 );

		return $size;
	}
	public static function set_target_cover_title_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::TARGET_COVER_TITLE_FONT_SIZE_KEY, $title_font_size );
	}


	public static function get_target_cover_text()
	{
		$default = '<p>Diseñamos, preparamos y seguimos tu entrenamiento personal y dieta para conseguir tu objetivo.</p> <p>Te acompañamos y motivamos a lo largo de todo el camino</p> <hr /> <p>Te enseñamos trucos y técnicas para conseguirlo y lo que es más importante: <strong>Mantenerte</strong></p> <hr /> <p>Nos adaptamos al tiempo que tengas disponible y a tus habitos</p> <hr /> <p>Nos comprometemos contigo y con tus objetivos</p>';

		$text = get_blog_option( null, self::TARGET_COVER_TEXT_KEY, $default );

		return $text;
	}
	public static function set_target_cover_text( $text )
	{
		self::update_blog_option( null, self::TARGET_COVER_TEXT_KEY, $text );
	}

	public static function get_target_cover_button_text()
	{
		$default = 'Así puede ser tu entrenamiento';

		$text = get_blog_option( null, self::TARGET_COVER_BUTTON_TEXT_KEY, $default );

		return $text;
	}
	public static function set_target_cover_button_text( $text )
	{
		self::update_blog_option( null, self::TARGET_COVER_BUTTON_TEXT_KEY, $text );
	}

	public static function get_target_cover_button_color()
	{
		$default = self::get_text_color();

		$color = get_blog_option( null, self::TARGET_COVER_BUTTON_COLOR_KEY, $default );

		return $color;
	}
	public static function set_target_cover_button_color( $color )
	{
		self::update_blog_option( null, self::TARGET_COVER_BUTTON_COLOR_KEY, $color );
	}

	public static function get_target_cover_button_color_bg()
	{
		$default = self::get_main_color();

		$color = get_blog_option( null, self::TARGET_COVER_BUTTON_COLOR_BG_KEY, $default );

		return $color;
	}
	public static function set_target_cover_button_color_bg( $color )
	{
		self::update_blog_option( null, self::TARGET_COVER_BUTTON_COLOR_BG_KEY, $color );
	}



	public static function get_target_cover_bg( $horizontal = true )
	{
		$default = null;

		$id = get_blog_option( null, $horizontal ? self::TARGET_COVER_BG_KEY : self::TARGET_COVER_BG_V_KEY, $default );

		return $id;
	}
	public static function get_target_cover_bg_id( $horizontal = true )
	{
		/* PARA  add_ajax_upload_image_position_field
		$val = self::get_target_cover_bg( $horizontal );
		$val = json_decode( $val );
		$id = isset( $val->id ) ? $val->id : null;
		*/
		$id = self::get_target_cover_bg( $horizontal );

		return $id;
	}
	public static function get_target_cover_bg_url( $horizontal = true )
	{
		$id = self::get_target_cover_bg_id( $horizontal );

		if( !$id )
			return get_template_directory_uri() . '/img/photos/banner-servicios-2.jpg';

		return wp_get_attachment_url( $id );
	}
	public static function set_target_cover_bg( $id, $horizontal = true )
	{
		self::update_blog_option( null, $horizontal ? self::TARGET_COVER_BG_KEY : self::TARGET_COVER_BG_V_KEY, $id );
	}
	public static function get_target_cover_bg_x( $horizontal = true )
	{
		$default = 50;

		$val = get_blog_option( null, $horizontal ? self::TARGET_COVER_BG_KEY : self::TARGET_COVER_BG_V_KEY, $default );
		$val = json_decode( $val );
		$id = isset( $val->x ) ? $val->x : null;

		return $id;
	}

	public static function get_target_cover_bg_y( $horizontal = true )
	{
		$default = 50;

		$val = get_blog_option( null, $horizontal ? self::TARGET_COVER_BG_KEY : self::TARGET_COVER_BG_V_KEY, $default );
		$val = json_decode( $val );
		$id = isset( $val->y ) ? $val->y : null;

		return $id;
	}

	// PLANS
	public static function get_plans_title()
	{
		$title = get_blog_option( null, self::PLANS_TITLE_KEY, 'Elije tu opción' );

		return $title;
	}
	public static function set_plans_title( $title )
	{
		self::update_blog_option( null, self::PLANS_TITLE_KEY, $title );
	}

	public static function get_plans_title_text_color()
	{
		$color = get_blog_option( null, self::PLANS_TITLE_TEXT_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_plans_title_text_color( $color )
	{
		self::update_blog_option( null, self::PLANS_TITLE_TEXT_COLOR_KEY, $color );
	}

	public static function get_plans_title_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#FFFFFF', 'color_1' => self::get_secondary_color() ) );

		$bg = get_blog_option( null, self::PLANS_TITLE_BG_KEY, $default );

		return $bg;
	}
	public static function get_plans_title_type_bg()
	{
		$bg = json_decode( self::get_plans_title_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_plans_title_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_plans_title_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		return $color;
	}
	public static function set_plans_title_bg( $bg )
	{
		self::update_blog_option( null, self::PLANS_TITLE_BG_KEY, $bg );
	}

	public static function get_plans_title_font_size()
	{
		$size = get_blog_option( null, self::PLANS_TITLE_FONT_SIZE_KEY, 30 );

		return $size;
	}
	public static function set_plans_title_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::PLANS_TITLE_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_plans_title_font_family()
	{
		$size = get_blog_option( null, self::PLANS_TITLE_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_plans_title_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::PLANS_TITLE_FONT_FAMILY_KEY, $title_font_family );
	}



	// ONLINE PLAN

	public static function is_online_plan_enabled()
	{
		$default = 'yes';

		$enabled = get_blog_option( null, self::PLANS_ONLINE_ENABLED_KEY, $default );

		return $enabled == 'yes';
	}
	public static function set_online_plan_enabled( $enabled )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_ENABLED_KEY, $enabled );
	}

	public static function get_online_plan_price()
	{
		$default = 48;

		$price = get_blog_option( null, self::PLANS_ONLINE_PRICE_KEY, $default );

		return $price;
	}
	public static function set_online_plan_price( $price )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_PRICE_KEY, $price );
	}

	public static function get_online_plan_price_color()
	{
		$color = get_blog_option( null, self::PLANS_ONLINE_PRICE_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_online_plan_price_color( $color )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_PRICE_COLOR_KEY, $color );
	}

	public static function get_online_plan_price_font_size()
	{
		$size = get_blog_option( null, self::PLANS_ONLINE_PRICE_FONT_SIZE_KEY, 120 );

		return $size;
	}
	public static function set_online_plan_price_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_PRICE_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_online_plan_price_font_family()
	{
		$family = get_blog_option( null, self::PLANS_ONLINE_PRICE_FONT_FAMILY_KEY, self::get_global_font() );

		return $family;
	}
	public static function set_online_plan_price_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_PRICE_FONT_FAMILY_KEY, $title_font_family );
	}

	// ONLINE PLAN TITLE

	public static function get_online_plan_title()
	{
		$default = 'Online';

		$text = get_blog_option( null, self::PLANS_ONLINE_TITLE_KEY, $default );

		return $text;
	}
	public static function set_online_plan_title( $text )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_TITLE_KEY, $text );
	}

	public static function get_online_plan_title_color()
	{
		$color = get_blog_option( null, self::PLANS_ONLINE_TITLE_COLOR_KEY, self::get_main_color() );

		return $color;
	}
	public static function set_online_plan_title_color( $color )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_TITLE_COLOR_KEY, $color );
	}

	public static function get_online_plan_title_font_size()
	{
		$size = get_blog_option( null, self::PLANS_ONLINE_TITLE_FONT_SIZE_KEY, 30 );

		return $size;
	}
	public static function set_online_plan_title_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_TITLE_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_online_plan_title_font_family()
	{
		$family = get_blog_option( null, self::PLANS_ONLINE_TITLE_FONT_FAMILY_KEY, self::get_global_font() );

		return $family;
	}
	public static function set_online_plan_title_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_TITLE_FONT_FAMILY_KEY, $title_font_family );
	}

	// ONLINE PLAN DESC

	public static function get_online_plan_desc()
	{
		$default = 'Seguimiento a distancia personalizado dietetico-deportivo';

		$text = get_blog_option( null, self::PLANS_ONLINE_DESC_KEY, $default );

		return $text;
	}
	public static function set_online_plan_desc( $text )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_DESC_KEY, $text );
	}

	public static function get_online_plan_desc_color()
	{
		$color = get_blog_option( null, self::PLANS_ONLINE_DESC_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_online_plan_desc_color( $color )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_DESC_COLOR_KEY, $color );
	}

	public static function get_online_plan_desc_font_size()
	{
		$size = get_blog_option( null, self::PLANS_ONLINE_DESC_FONT_SIZE_KEY, 24 );

		return $size;
	}
	public static function set_online_plan_desc_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_DESC_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_online_plan_desc_font_family()
	{
		$family = get_blog_option( null, self::PLANS_ONLINE_DESC_FONT_FAMILY_KEY, self::get_global_font() );

		return $family;
	}
	public static function set_online_plan_desc_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_DESC_FONT_FAMILY_KEY, $title_font_family );
	}

	public static function get_online_plan_features()
	{
		$default = '<p>Alimentación personalizada según tus gustos y objetivos</p> <hr /> <p>Entrenamiento diseño según tu tiempo disponible</p> <hr /> <p>Evolución</p>';

		$text = get_blog_option( null, self::PLANS_ONLINE_FEATURES_KEY, $default );

		return $text;
	}
	public static function set_online_plan_features( $text )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_FEATURES_KEY, $text );
	}

	public static function get_online_plan_button_text()
	{
		$default = 'Saber más';

		$text = get_blog_option( null, self::PLANS_ONLINE_BUTTON_TEXT_KEY, $default );

		return $text;
	}
	public static function set_online_plan_button_text( $text )
	{
		self::update_blog_option( null, self::PLANS_ONLINE_BUTTON_TEXT_KEY, $text );
	}

	// PRESENCIAL PLAN

	public static function is_presencial_plan_enabled()
	{
		$default = 'yes';

		$enabled = get_blog_option( null, self::PLANS_PRESENCIAL_ENABLED_KEY, $default );

		return $enabled == 'yes';
	}
	public static function set_presencial_plan_enabled( $enabled )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_ENABLED_KEY, $enabled );
	}

	public static function get_presencial_plan_price()
	{
		$default = 30;

		$price = get_blog_option( null, self::PLANS_PRESENCIAL_PRICE_KEY, $default );

		return $price;
	}
	public static function set_presencial_plan_price( $price )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_PRICE_KEY, $price );
	}

	public static function get_presencial_plan_price_color()
	{
		$color = get_blog_option( null, self::PLANS_PRESENCIAL_PRICE_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_presencial_plan_price_color( $color )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_PRICE_COLOR_KEY, $color );
	}

	public static function get_presencial_plan_price_font_size()
	{
		$size = get_blog_option( null, self::PLANS_PRESENCIAL_PRICE_FONT_SIZE_KEY, 120 );

		return $size;
	}
	public static function set_presencial_plan_price_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_PRICE_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_presencial_plan_price_font_family()
	{
		$family = get_blog_option( null, self::PLANS_PRESENCIAL_PRICE_FONT_FAMILY_KEY, self::get_global_font() );

		return $family;
	}
	public static function set_presencial_plan_price_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_PRICE_FONT_FAMILY_KEY, $title_font_family );
	}



	public static function get_presencial_plan_desc()
	{
		$default = '';

		$text = get_blog_option( null, self::PLANS_PRESENCIAL_DESC_KEY, $default );

		return $text;
	}
	public static function set_presencial_plan_desc( $text )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_DESC_KEY, $text );
	}

	public static function get_presencial_plan_desc_color()
	{
		$color = get_blog_option( null, self::PLANS_PRESENCIAL_DESC_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_presencial_plan_desc_color( $color )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_DESC_COLOR_KEY, $color );
	}

	public static function get_presencial_plan_desc_font_size()
	{
		$size = get_blog_option( null, self::PLANS_PRESENCIAL_DESC_FONT_SIZE_KEY, 24 );

		return $size;
	}
	public static function set_presencial_plan_desc_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_DESC_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_presencial_plan_desc_font_family()
	{
		$family = get_blog_option( null, self::PLANS_PRESENCIAL_DESC_FONT_FAMILY_KEY, self::get_global_font() );

		return $family;
	}
	public static function set_presencial_plan_desc_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_DESC_FONT_FAMILY_KEY, $title_font_family );
	}


	public static function get_presencial_plan_features()
	{
		$default = '<p>Plan dietético a medida</p> <hr /> <p>Entrenamiento personal</p> <hr /> <p>Medición y control de peso semanal</p> <hr /> <p>Fotografías de evolución mensual</p> <hr /> <p>Atención teléfonica</p> <hr /> <p>Sesión fisioterapia mensual</p>';

		$text = get_blog_option( null, self::PLANS_PRESENCIAL_FEATURES_KEY, $default );

		return $text;
	}
	public static function set_presencial_plan_features( $text )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_FEATURES_KEY, $text );
	}

	public static function get_presencial_plan_button_text()
	{
		$default = 'Saber más';

		$text = get_blog_option( null, self::PLANS_PRESENCIAL_BUTTON_TEXT_KEY, $default );

		return $text;
	}
	public static function set_presencial_plan_button_text( $text )
	{
		self::update_blog_option( null, self::PLANS_PRESENCIAL_BUTTON_TEXT_KEY, $text );
	}


	public static function get_presencial_table_head_color()
	{
		$default = self::get_text_color();

		$color = get_blog_option( null, self::PRESENCIAL_TABLE_HEAD_COLOR_KEY, $default );

		return $color;
	}
	public static function set_presencial_table_head_color( $color )
	{
		self::update_blog_option( null, self::PRESENCIAL_TABLE_HEAD_COLOR_KEY, $color );
	}

	public static function get_presencial_table_head_font_family()
	{
		$size = get_blog_option( null, self::PRESENCIAL_TABLE_HEAD_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_presencial_table_head_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::PRESENCIAL_TABLE_HEAD_FONT_FAMILY_KEY, $title_font_family );
	}

	public static function get_presencial_table_head_font_size()
	{
		$size = get_blog_option( null, self::PRESENCIAL_TABLE_HEAD_FONT_SIZE_KEY, 14 );

		return $size;
	}
	public static function set_presencial_table_head_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::PRESENCIAL_TABLE_HEAD_FONT_SIZE_KEY, $title_font_size );
	}

	/////////////////////////////
	// USER DIETS STYLE
	/////////////////////////////

	public static function get_user_diets_font_family()
	{
		$size = get_blog_option( null, self::USER_DIETS_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_user_diets_font_family( $font_family )
	{
		self::update_blog_option( null, self::USER_DIETS_FONT_FAMILY_KEY, $font_family );
	}

	public static function get_user_diets_bg_1()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#DDDDDD', 'color_1' => '#FFFFFF' ) );

		$bg = get_blog_option( null, self::USER_DIETS_BG_1_KEY, $default );

		return $bg;
	}
	public static function set_user_diets_bg_1( $bg )
	{
		self::update_blog_option( null, self::USER_DIETS_BG_1_KEY, $bg );
	}

	public static function get_user_diets_bg_2()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => self::get_main_color(), 'color_1' => '#FFFFFF' ) );

		$bg = get_blog_option( null, self::USER_DIETS_BG_2_KEY, $default );

		return $bg;
	}
	public static function set_user_diets_bg_2( $bg )
	{
		self::update_blog_option( null, self::USER_DIETS_BG_2_KEY, $bg );
	}

	public static function get_user_diets_color_1()
	{
		$color = get_blog_option( null, self::USER_DIETS_COLOR_1_KEY, '#444444' );

		return $color;
	}
	public static function set_user_diets_color_1( $color )
	{
		self::update_blog_option( null, self::USER_DIETS_COLOR_1_KEY, $color );
	}

	public static function get_user_diets_color_2()
	{
		$color = get_blog_option( null, self::USER_DIETS_COLOR_2_KEY, '#dddddd' );

		return $color;
	}
	public static function set_user_diets_color_2( $color )
	{
		self::update_blog_option( null, self::USER_DIETS_COLOR_2_KEY, $color );
	}

	public static function get_user_diets_color_3()
	{
		$color = get_blog_option( null, self::USER_DIETS_COLOR_3_KEY, '#b6c532' );

		return $color;
	}
	public static function set_user_diets_color_3( $color )
	{
		self::update_blog_option( null, self::USER_DIETS_COLOR_3_KEY, $color );
	}

	public static function get_user_diets_color_4()
	{
		$color = get_blog_option( null, self::USER_DIETS_COLOR_4_KEY, '#ffffff' );

		return $color;
	}
	public static function set_user_diets_color_4( $color )
	{
		self::update_blog_option( null, self::USER_DIETS_COLOR_4_KEY, $color );
	}

	/////////////////////////////
	// USER TRAINING STYLE
	/////////////////////////////

	public static function get_user_training_font_family()
	{
		$size = get_blog_option( null, self::USER_TRAINING_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_user_training_font_family( $font_family )
	{
		self::update_blog_option( null, self::USER_TRAINING_FONT_FAMILY_KEY, $font_family );
	}

	public static function get_user_training_bg_1()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#DDDDDD', 'color_1' => '#FFFFFF' ) );

		$bg = get_blog_option( null, self::USER_TRAINING_BG_1_KEY, $default );

		return $bg;
	}
	public static function set_user_training_bg_1( $bg )
	{
		self::update_blog_option( null, self::USER_TRAINING_BG_1_KEY, $bg );
	}

	public static function get_user_training_bg_2()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => self::get_main_color(), 'color_1' => '#FFFFFF' ) );

		$bg = get_blog_option( null, self::USER_TRAINING_BG_2_KEY, $default );

		return $bg;
	}
	public static function set_user_training_bg_2( $bg )
	{
		self::update_blog_option( null, self::USER_TRAINING_BG_2_KEY, $bg );
	}

	public static function get_user_training_color_1()
	{
		$color = get_blog_option( null, self::USER_TRAINING_COLOR_1_KEY, '#444444' );

		return $color;
	}
	public static function set_user_training_color_1( $color )
	{
		self::update_blog_option( null, self::USER_TRAINING_COLOR_1_KEY, $color );
	}

	public static function get_user_training_color_2()
	{
		$color = get_blog_option( null, self::USER_TRAINING_COLOR_2_KEY, '#dddddd' );

		return $color;
	}
	public static function set_user_training_color_2( $color )
	{
		self::update_blog_option( null, self::USER_TRAINING_COLOR_2_KEY, $color );
	}

	public static function get_user_training_color_3()
	{
		$color = get_blog_option( null, self::USER_TRAINING_COLOR_3_KEY, '#b6c532' );

		return $color;
	}
	public static function set_user_training_color_3( $color )
	{
		self::update_blog_option( null, self::USER_TRAINING_COLOR_3_KEY, $color );
	}

	public static function get_user_training_color_4()
	{
		$color = get_blog_option( null, self::USER_TRAINING_COLOR_4_KEY, '#ffffff' );

		return $color;
	}
	public static function set_user_training_color_4( $color )
	{
		self::update_blog_option( null, self::USER_TRAINING_COLOR_4_KEY, $color );
	}


	/////////////////////////////
	// FOOTER
	/////////////////////////////

	public static function get_footer_text_color()
	{
		$color = get_blog_option( null, self::FOOTER_TEXT_COLOR_KEY, self::get_text_color() );

		return $color;
	}
	public static function set_footer_text_color( $color )
	{
		self::update_blog_option( null, self::FOOTER_TEXT_COLOR_KEY, $color );
	}

	public static function get_footer_link_color()
	{
		$color = get_blog_option( null, self::FOOTER_LINK_COLOR_KEY, self::get_main_color() );

		return $color;
	}
	public static function set_footer_link_color( $color )
	{
		self::update_blog_option( null, self::FOOTER_LINK_COLOR_KEY, $color );
	}

	public static function get_footer_bg()
	{
		$default = json_encode( array( 'type' => 'solid', 'color_0' => '#FFFFFF', 'color_1' => self::get_main_color() ) );

		$bg = get_blog_option( null, self::FOOTER_BG_KEY, $default );

		return $bg;
	}
	public static function get_footer_type_bg()
	{
		$bg = json_decode( self::get_footer_bg() );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_footer_color_bg( $index = 0 )
	{
		$bg = json_decode( self::get_footer_bg() );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#000000';

		return $color;
	}
	public static function set_footer_bg( $bg )
	{
		self::update_blog_option( null, self::FOOTER_BG_KEY, $bg );
	}

	public static function get_footer_font_size()
	{
		$size = get_blog_option( null, self::FOOTER_FONT_SIZE_KEY, 14 );

		return $size;
	}
	public static function set_footer_font_size( $title_font_size )
	{
		self::update_blog_option( null, self::FOOTER_FONT_SIZE_KEY, $title_font_size );
	}

	public static function get_footer_font_family()
	{
		$size = get_blog_option( null, self::FOOTER_FONT_FAMILY_KEY, self::get_global_font() );

		return $size;
	}
	public static function set_footer_font_family( $title_font_family )
	{
		self::update_blog_option( null, self::FOOTER_FONT_FAMILY_KEY, $title_font_family );
	}

	//////////////////////////////
	// CUSTOM HTML
	//////////////////////////////

	public static function get_html_content( $text_name, $default = null )
	{
		if( $default === null )
			$default = '<p>Soy un texto de muestra</p>';

		$text = get_blog_option( null, self::CUSTOM_HTML_CONTENT_PREFIX . $text_name, $default );

		return $text;
	}

	public static function set_html_content( $text_name, $text )
	{
		self::update_blog_option( null, self::CUSTOM_HTML_CONTENT_PREFIX . $text_name, $text );
	}

	//////////////////////////////
	// CUSTOM VIDEO
	//////////////////////////////

	public static function get_video_link( $video_name )
	{
		$link = get_blog_option( null, self::CUSTOM_VIDEO_LINK_PREFIX . $video_name, null );

		return $link;
	}

	public static function set_video_link( $video_name, $link )
	{
		self::update_blog_option( null, self::CUSTOM_VIDEO_LINK_PREFIX . $video_name, $link );
	}

	//////////////////////////////
	// CUSTOM IMAGE (for images used for page images)
	//////////////////////////////

	public static function get_image_id( $image_name )
	{
		$id = (int)get_blog_option( null, self::CUSTOM_IMAGE_ID_PREFIX . $image_name, null );

		return $id;
	}

	public static function get_image_url( $image_name )
	{
		$id = self::get_image_id( $image_name );

		return wp_get_attachment_image_url( $id, 'full' );
	}

	public static function set_image_id( $image_name, $id )
	{
		self::update_blog_option( null, self::CUSTOM_IMAGE_ID_PREFIX . $image_name, (int)$id );
	}

	//////////////////////////////
	// CUSTOM TEXT
	//////////////////////////////

	public static function get_text_text( $text_name, $default = null )
	{
		if( $default === null )
			$default = 'Texto';

		$text = get_blog_option( null, self::CUSTOM_TEXT_TEXT_PREFIX . $text_name, $default );

		return $text;
	}
	public static function set_text_text( $text_name, $text )
	{
		self::update_blog_option( null, self::CUSTOM_TEXT_TEXT_PREFIX . $text_name, $text );
	}

	public static function get_text_text_color( $text_name, $default_color = null )
	{
		$default = $default_color !== null ? $default_color : self::get_text_color();

		$color = get_blog_option( null, self::CUSTOM_TEXT_TEXT_COLOR_PREFIX . $text_name, $default );

		return $color;
	}
	public static function set_text_text_color( $text_name, $color )
	{
		self::update_blog_option( null, self::CUSTOM_TEXT_TEXT_COLOR_PREFIX . $text_name, $color );
	}
/*
	public static function get_button_bg( $button )
	{
		//$default = self::get_main_color();
		$default = json_encode( array( 'type' => 'solid', 'color_0' => self::get_main_color(), 'color_1' => self::get_secondary_color() ) );

		$bg = get_blog_option( null, self::CUSTOM_BUTTON_BG_PREFIX . $button, $default );

		return $bg;
	}
	public static function get_button_type_bg( $button )
	{
		$bg = json_decode( self::get_button_bg( $button ) );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_button_color_bg( $button, $index = 0 )
	{
		$bg = json_decode( self::get_button_bg( $button ) );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : '#fff';//self::get_main_color();

		return $color;
	}
	public static function set_button_bg( $button, $bg )
	{
		self::update_blog_option( null, self::CUSTOM_BUTTON_BG_PREFIX . $button, $bg );
	}
*/
	public static function get_text_font_size( $text_name, $default = null )
	{
		$default = $default !== null ? $default : 16;

		$size = get_blog_option( null, self::CUSTOM_TEXT_FONT_SIZE_PREFIX . $text_name, $default );

		return $size;
	}
	public static function set_text_font_size( $text_name, $size )
	{
		self::update_blog_option( null, self::CUSTOM_TEXT_FONT_SIZE_PREFIX . $text_name, $size );
	}

	public static function get_text_font_family( $text_name, $default = null )
	{
		$default = $default !== null ? $default : self::get_global_font();

		$family = get_blog_option( null, self::CUSTOM_TEXT_FONT_FAMILY_PREFIX . $text_name, $default );

		return $family;
	}
	public static function set_text_font_family( $text_name, $family )
	{
		self::update_blog_option( null, self::CUSTOM_TEXT_FONT_FAMILY_PREFIX . $text_name, $family );
	}

	//////////////////////////////
	// CUSTOM BUTTON
	//////////////////////////////
	public static function get_button_text( $button, $default = null )
	{
		if( $default === null )
			$default = 'Comienza ahora mismo y no lo dejes para mañana';

		$text = get_blog_option( null, self::CUSTOM_BUTTON_TEXT_PREFIX . $button, $default );

		return $text;
	}
	public static function set_button_text( $button, $text )
	{
		self::update_blog_option( null, self::CUSTOM_BUTTON_TEXT_PREFIX . $button, $text );
	}

	public static function get_button_color( $button, $default = null )
	{
		if( $default === null )
			$default = self::get_text_color();

		$color = get_blog_option( null, self::CUSTOM_BUTTON_TEXT_COLOR_PREFIX . $button, $default );

		return $color;
	}
	public static function set_button_color( $button, $color )
	{
		self::update_blog_option( null, self::CUSTOM_BUTTON_TEXT_COLOR_PREFIX . $button, $color );
	}

	public static function get_button_bg( $button, $default = null )
	{
		//$default = self::get_main_color();
		if( $default === null )
			$default = json_encode( array( 'type' => 'solid', 'color_0' => self::get_main_color(), 'color_1' => self::get_secondary_color() ) );

		$bg = get_blog_option( null, self::CUSTOM_BUTTON_BG_PREFIX . $button, $default );

		return $bg;
	}
	public static function get_button_type_bg( $button, $default = null )
	{
		$bg = json_decode( self::get_button_bg( $button, $default ) );
		$color = isset( $bg->type ) ? $bg->type : 'solid';

		return $color;
	}
	public static function get_button_color_bg( $button, $index = 0, $default = null )
	{
		$bg = json_decode( self::get_button_bg( $button, $default ) );
		$index_name = 'color_' . $index;
		$color = isset( $bg->$index_name ) ? $bg->$index_name : self::get_main_color();

		return $color;
	}
	public static function get_button_opacity_bg( $button, $index = 0, $default = null )
	{
		$bg = json_decode( self::get_button_bg( $button, $default ) );
		$index_name = 'color_' . $index . '_opacity';
		$opacity = isset( $bg->$index_name ) ? $bg->$index_name : 1;

		return $opacity;
	}
	public static function set_button_bg( $button, $bg )
	{
		self::update_blog_option( null, self::CUSTOM_BUTTON_BG_PREFIX . $button, $bg );
	}

	public static function get_button_font_size( $button, $default = null )
	{
		$default = $default !== null ? $default : 16;

		$size = get_blog_option( null, self::CUSTOM_BUTTON_FONT_SIZE_PREFIX . $button, $default );

		return $size;
	}
	public static function set_button_font_size( $button, $size )
	{
		self::update_blog_option( null, self::CUSTOM_BUTTON_FONT_SIZE_PREFIX . $button, $size );
	}

	public static function get_button_font_family( $button, $default = null )
	{
		$default = $default !== null ? $default : self::get_global_font();

		$size = get_blog_option( null, self::CUSTOM_BUTTON_FONT_FAMILY_PREFIX . $button, $default );

		return $size;
	}
	public static function set_button_font_family( $button, $family )
	{
		self::update_blog_option( null, self::CUSTOM_BUTTON_FONT_FAMILY_PREFIX . $button, $family );
	}

	//////////////////////////////
	// PAGE HEADER VIDEO
	//////////////////////////////

	public static function is_page_header_video_enabled( $video_name )
	{
		$enabled = get_blog_option( null, self::PAGE_HEADER_VIDEO_ENABLED_PREFIX . $video_name, 'no' );

		return $enabled === 'yes';
	}

	public static function set_page_header_video_enabled( $video_name, $enabled )
	{
		self::update_blog_option( null, self::PAGE_HEADER_VIDEO_ENABLED_PREFIX . $video_name, $enabled ? 'yes' : 'no' );
	}

	//////////////////////////////
	// PAGE VIDEO
	//////////////////////////////

	public static function is_page_video_enabled( $video_name )
	{
		$enabled = get_blog_option( null, self::PAGE_VIDEO_ENABLED_PREFIX . $video_name, 'no' );

		return $enabled === 'yes';
	}

	public static function set_page_video_enabled( $video_name, $enabled )
	{
		self::update_blog_option( null, self::PAGE_VIDEO_ENABLED_PREFIX . $video_name, $enabled ? 'yes' : 'no' );
	}

	//////////////////////////////
	// PAGE IMAGE
	//////////////////////////////

	public static function is_page_image_enabled( $image_name )
	{
		$enabled = get_blog_option( null, self::PAGE_IMAGE_ENABLED_PREFIX . $image_name, 'no' );

		return $enabled === 'yes';
	}

	public static function set_page_image_enabled( $image_name, $enabled )
	{
		self::update_blog_option( null, self::PAGE_IMAGE_ENABLED_PREFIX . $image_name, $enabled ? 'yes' : 'no' );
	}

	//////////////////////////////
	// UTIL
	//////////////////////////////

	public static function get_video_iframe_from_link( $link )
	{
		$matches = array();
		if( preg_match( '/^https:\/\/youtu\.be\/(.*)$/', $link, $matches ) )
		{
			$video_id = $matches[1];

			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		elseif( preg_match( '/^https:\/\/vimeo\.com\/(.*)$/', $link, $matches ) )
		{
			$video_id = $matches[1];

			return '<iframe src="https://player.vimeo.com/video/' . $video_id . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
		}
		else
		{
			return esc_html( $link );
		}
	}
}
