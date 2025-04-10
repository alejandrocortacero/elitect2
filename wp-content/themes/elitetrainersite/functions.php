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

if( !class_exists( 'EliteTrainerSiteThemeMapper', false ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'include', 'mapper.php' ) ) );


class EliteTrainerSiteTheme
{
	const TEXT_DOMAIN = 'elitetrainersitethemetextdomain';

	const IS_INSTALLED_KEY = 'trainersite_is_installed';

	const ADMIN_SETTINGS_PAGE_SLUG = 'elitetrainersite_admin_settings_page';
	const ADMIN_SAVE_SETTINGS_ACTION = 'elitetrainersite_admin_save_settings';

	const ADMIN_SETTINGS_FORM_INTERNAL_ID = 'elitetrainersite_admin_form_internal_id';
	const SITE_STYLE_FORM_INTERNAL_ID = 'elitetrainersite_site_style_form_internal_id';
	const HOME_SETTINGS_FORM_INTERNAL_ID = 'elitetrainersite_home_settings_form_internal_id';

	const PAGE_BG_FORM_INTERNAL_ID = 'elitetrainersite_page_bg_form_internal_id';
	const ARCHIVE_CASES_BG_FORM_INTERNAL_ID = 'elitetrainersite_archive_cases_bg_form_internal_id';

	const HEADER_NAVBAR_FORM_INTERNAL_ID = 'elitetrainersite_header_navbar_form_internal_id';
	const HOME_COVER_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_home_cover_title_form_internal_id';
	const HOME_COVER_FORM_INTERNAL_ID = 'elitetrainersite_home_cover_form_internal_id';
	const HOME_COVER_BG_FORM_INTERNAL_ID = 'elitetrainersite_home_cover_bg_form_internal_id';
	const HOME_COVER_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_home_cover_video_form_internal_id';
	const HOME_COVER_VIDEO_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_home_cover_video_title_form_internal_id';
	const HOME_COVER_LINK_FORM_INTERNAL_ID = 'elitetrainersite_home_cover_link_form_internal_id';

	const REAL_CASES_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_real_cases_title_form_internal_id';
	const MORE_CASES_LINK_FORM_INTERNAL_ID = 'elitetrainersite_more_cases_link_form_internal_id';

	const TARGET_COVER_BG_FORM_INTERNAL_ID = 'elitetrainersite_target_cover_bg_form_internal_id';
	const TARGET_COVER_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_target_cover_title_form_internal_id';
	const TARGET_COVER_TEXT_FORM_INTERNAL_ID = 'elitetrainersite_target_cover_text_form_internal_id';
	const TARGET_COVER_LINK_FORM_INTERNAL_ID = 'elitetrainersite_target_cover_link_form_internal_id';

	const PLANS_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_plans_title_form_internal_id';

	const ONLINE_PLAN_FORM_INTERNAL_ID = 'elitetrainersite_plans_online_form_internal_id';
	const ONLINE_PLAN_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_plans_online_title_form_internal_id';
	const ONLINE_PLAN_DESC_FORM_INTERNAL_ID = 'elitetrainersite_plans_online_desc_form_internal_id';
	const ONLINE_PLAN_FEATURES_FORM_INTERNAL_ID = 'elitetrainersite_plans_online_features_form_internal_id';
	const ONLINE_KNOW_LINK_FORM_INTERNAL_ID = 'elitetrainersite_plans_online_know_link_form_internal_id';
	const PRESENCIAL_PLAN_FORM_INTERNAL_ID = 'elitetrainersite_plans_presencial_form_internal_id';
	const PRESENCIAL_PLAN_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_plans_presencial_title_form_internal_id';
	const PRESENCIAL_PLAN_DESC_FORM_INTERNAL_ID = 'elitetrainersite_plans_presencial_desc_form_internal_id';
	const PRESENCIAL_PLAN_FEATURES_FORM_INTERNAL_ID = 'elitetrainersite_plans_presencial_features_form_internal_id';
	const PRESENCIAL_KNOW_LINK_FORM_INTERNAL_ID = 'elitetrainersite_plans_presencial_know_link_form_internal_id';

	const CONTACT_BUTTON_FORM_INTERNAL_ID = 'elitetrainersite_contact_button_form_internal_id';
	const FOOTER_CONTACT_FORM_FORM_INTERNAL_ID = 'elitetrainersite_footer_contact_form_form_internal_id';

	const MAIN_OPTIONS_FORM_INTERNAL_ID = 'elitetrainersite_main_options_form_internal_id';

	const CONTACT_DATA_FORM_INTERNAL_ID = 'elitetrainersite_contact_data_form_internal_id';

	const MAIN_MENU_FORM_INTERNAL_ID = 'elitetrainersite_main_menu_form_internal_id';
	const SUBMENU_FORM_INTERNAL_ID = 'elitetrainersite_submenu_form_internal_id';
	const SUBMENU2_FORM_INTERNAL_ID = 'elitetrainersite_submenu2_form_internal_id';

	const FOOTER_FORM_INTERNAL_ID = 'elitetrainersite_footer_form_internal_id';

	const EDIT_PRESENCIAL_PLAN_FORM_INTERNAL_ID = 'elitetrainersite_edit_presencial_plan_form_internal_id';

	const EDIT_REAL_CASE_FORM_INTERNAL_ID = 'elitetrainersite_edit_real_case_form_internal_id';

	const ARCHIVE_REAL_CASES_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_archive_real_cases_title_form_internal_id';
	const REAL_CASES_VIDEO_SUBTITLE_FORM_INTERNAL_ID = 'elitetrainersite_real_cases_video_subtitle_form_internal_id';

	const FOR_YOU_PAGE_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_for_you_page_title_form_internal_id';
	const FOR_YOU_SECTION_1_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_1_title_form_internal_id';
	const FOR_YOU_SECTION_1_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_1_video_form_internal_id';
	const FOR_YOU_SECTION_1_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_1_content_form_internal_id';
	const FOR_YOU_SECTION_2_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_2_title_form_internal_id';
	const FOR_YOU_SECTION_2_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_2_video_form_internal_id';
	const FOR_YOU_SECTION_2_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_2_content_form_internal_id';
	const FOR_YOU_SECTION_3_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_3_title_form_internal_id';
	const FOR_YOU_SECTION_3_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_3_video_form_internal_id';
	const FOR_YOU_SECTION_3_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_3_content_form_internal_id';
	const FOR_YOU_SECTION_4_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_4_title_form_internal_id';
	const FOR_YOU_SECTION_4_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_4_video_form_internal_id';
	const FOR_YOU_SECTION_4_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_4_content_form_internal_id';
	const FOR_YOU_SECTION_5_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_5_title_form_internal_id';
	const FOR_YOU_SECTION_5_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_5_video_form_internal_id';
	const FOR_YOU_SECTION_5_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_for_you_section_5_content_form_internal_id';

	const HOW_WORKS_PAGE_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_page_title_form_internal_id';
	const HOW_WORKS_PAGE_TITLE_2_FORM_INTERNAL_ID = 'elitetrainersite_how_works_plan_page_title_form_internal_id';
	const HOW_WORKS_PAGE_SUBTITLE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_plan_page_subtitle_form_internal_id';
	const HOW_WORKS_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_how_works_plan_page_header_video_form_internal_id';

	const HOW_WORKS_SECTION_1_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_1_content_form_internal_id';
	const HOW_WORKS_SECTION_1_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_1_image_form_internal_id';
	const HOW_WORKS_SECTION_2_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_2_title_form_internal_id';
	const HOW_WORKS_SECTION_2_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_2_video_form_internal_id';
	const HOW_WORKS_SECTION_2_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_2_content_form_internal_id';
	const HOW_WORKS_SECTION_2_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_2_image_form_internal_id';
	const HOW_WORKS_SECTION_3_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_3_content_form_internal_id';
	const HOW_WORKS_SECTION_3_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_3_image_form_internal_id';
	const HOW_WORKS_SECTION_4_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_4_content_form_internal_id';
	const HOW_WORKS_SECTION_4_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_4_image_form_internal_id';
	const HOW_WORKS_SECTION_5_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_5_title_form_internal_id';
	const HOW_WORKS_SECTION_5_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_5_video_form_internal_id';
	const HOW_WORKS_SECTION_5_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_5_content_form_internal_id';
	const HOW_WORKS_SECTION_5_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_5_image_form_internal_id';
	const HOW_WORKS_SECTION_6_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_6_content_form_internal_id';
	const HOW_WORKS_SECTION_6_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_6_image_form_internal_id';
	const HOW_WORKS_SECTION_7_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_7_content_form_internal_id';
	const HOW_WORKS_SECTION_7_IMAGE_1_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_7_image_1_form_internal_id';
	const HOW_WORKS_SECTION_7_IMAGE_2_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_7_image_2_form_internal_id';
	const HOW_WORKS_SECTION_7_IMAGE_3_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_7_image_3_form_internal_id';
	const HOW_WORKS_SECTION_8_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_8_title_form_internal_id';
	const HOW_WORKS_SECTION_8_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_8_video_form_internal_id';
	const HOW_WORKS_SECTION_8_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_8_content_form_internal_id';
	const HOW_WORKS_SECTION_8_IMAGE_1_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_8_image_1_form_internal_id';
	const HOW_WORKS_SECTION_8_IMAGE_2_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_8_image_2_form_internal_id';
	const HOW_WORKS_SECTION_8_IMAGE_3_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_8_image_3_form_internal_id';
	const HOW_WORKS_SECTION_9_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_9_content_form_internal_id';
	const HOW_WORKS_SECTION_9_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_9_image_form_internal_id';
	const HOW_WORKS_SECTION_10_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_10_content_form_internal_id';
	const HOW_WORKS_SECTION_10_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_10_image_form_internal_id';
	const HOW_WORKS_SECTION_11_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_how_works_section_11_content_form_internal_id';

	const ONLINE_PLAN_PAGE_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_page_title_form_internal_id';
	const ONLINE_PLAN_PAGE_SUBTITLE_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_page_subtitle_form_internal_id';
	const ONLINE_PLAN_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_page_header_video_form_internal_id';

	const ONLINE_PLAN_SECTION_0A_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_0a_content_form_internal_id';
	const ONLINE_PLAN_SECTION_0B_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_0b_content_form_internal_id';
	const ONLINE_TO_PRESENCIAL_LINK_FORM_INTERNAL_ID = 'elitetrainersite_online_to_presencial_link_form_internal_id';

	const ONLINE_PLAN_SECTION_1_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_1_title_form_internal_id';
	const ONLINE_PLAN_SECTION_1_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_1_video_form_internal_id';
	const ONLINE_PLAN_SECTION_1_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_1_content_form_internal_id';
	const ONLINE_PLAN_SECTION_2_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_2_title_form_internal_id';
	const ONLINE_PLAN_SECTION_2_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_2_video_form_internal_id';
	const ONLINE_PLAN_SECTION_2_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_2_content_form_internal_id';
	const ONLINE_PLAN_SECTION_3_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_3_title_form_internal_id';
	const ONLINE_PLAN_SECTION_3_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_3_video_form_internal_id';
	const ONLINE_PLAN_SECTION_3_CONTENT_FORM_INTERNAL_ID = 'elitetrainersite_online_plan_section_3_content_form_internal_id';

	const PRESENCIAL_PLAN_PAGE_TITLE_FORM_INTERNAL_ID = 'elitetrainersite_presencial_plan_page_title_form_internal_id';
	const PRESENCIAL_PLAN_PAGE_SUBTITLE_FORM_INTERNAL_ID = 'elitetrainersite_presencial_plan_page_subtitle_form_internal_id';
	const PRESENCIAL_PLAN_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID = 'elitetrainersite_presencial_plan_page_header_video_form_internal_id';
	const PRESENCIAL_TABLE_HEAD_FORM_INTERNAL_ID = 'elitetrainersite_presencial_table_head_form_internal_id';

	const CORPORAL_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID = 'elitetrainersite_corporal_measures_header_form_internal_id';
	const CORPORAL_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_corporal_measures_header_image_form_internal_id';

	const STRENGTH_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID = 'elitetrainersite_strength_measures_header_form_internal_id';
	const STRENGTH_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_strength_measures_header_image_form_internal_id';
	const SPEED_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID = 'elitetrainersite_speed_measures_header_form_internal_id';
	const SPEED_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_speed_measures_header_image_form_internal_id';
	const DISTANCE_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID = 'elitetrainersite_distance_measures_header_form_internal_id';
	const DISTANCE_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID = 'elitetrainersite_distance_measures_header_image_form_internal_id';

	const USER_DIETS_STYLE_FORM_INTERNAL_ID = 'elitetrainersite_user_diets_style_form_internal_id';
	const USER_TRAINING_STYLE_FORM_INTERNAL_ID = 'elitetrainersite_user_training_style_form_internal_id';

	//const SEARCH_PRODUCTS_ACTION = 'elitetrainersite_search';

	// PAGES
	const HOME_PAGE_KEY = 'trainer_site_home_page';
	const BLOG_PAGE_KEY = 'trainer_site_blog_page';
	const ACCOUNT_PAGE_KEY = 'trainer_site_account_page';
	const SETTINGS_PAGE_KEY = 'trainer_site_settings_page';
	const SITE_STYLE_PAGE_KEY = 'trainer_site_site_style_page';
	const HOME_SETTINGS_PAGE_KEY = 'trainer_site_home_settings_page';

	const PERSONAL_QUESTIONNAIRE_PAGE_KEY = 'trainer_site_trainer_personal_questionnaire_page';
	const DEACTIVATED_PAGE_KEY = 'trainer_site_trainer_deactivated_page';
	const TRAINER_INFO_PAGE_KEY = 'trainer_site_trainer_trainer_info_page';
	const MEMBERS_LIST_PAGE_KEY = 'trainer_site_members_list_page';
	const DELETE_MEMBERS_LIST_PAGE_KEY = 'trainer_site_delete_members_list_page';
	const EDIT_MEMBER_PAGE_KEY = 'trainer_site_edit_member_page';
	const VIEW_MEMBER_PAGE_KEY = 'trainer_site_view_member_page';
	const VIEW_MEMBER_TRAINING_PAGE_KEY = 'trainer_site_view_member_training_page';

	const TRAINER_EXERCISES_PAGE_KEY = 'trainer_site_trainer_exercises_page';
	const EDIT_EXERCISE_PAGE_KEY = 'trainer_site_edit_exercise_page';

	const TRAINER_TRAINING_GALLERY_PAGE_KEY = 'trainer_site_trainer_training_gallery_page';
	const EDIT_TRAINING_PAGE_KEY = 'trainer_site_edit_training_page';

	const TRAINER_OBJECTIVES_GALLERY_PAGE_KEY = 'trainer_site_trainer_objectives_gallery_page';
	const EDIT_OBJECTIVE_PAGE_KEY = 'trainer_site_edit_objective_page';
	const EDIT_ENVIRONMENT_PAGE_KEY = 'trainer_site_edit_environment_page';

	const MY_TRAINING_PAGE_KEY = 'trainer_site_my_training_page';

	const TRAINER_VALORATION_PAGE_KEY = 'trainer_site_trainer_valoration_page';

	const TRAINER_FOOD_GALLERY_PAGE_KEY = 'trainer_site_trainer_food_gallery_page';
	const EDIT_FOOD_PAGE_KEY = 'trainer_site_edit_food_page';

	const TRAINER_DIET_OBJECTIVES_GALLERY_PAGE_KEY = 'trainer_site_trainer_diet_objectives_gallery_page';
	const EDIT_DIET_OBJECTIVE_PAGE_KEY = 'trainer_site_edit_diet_objective_page';
	const EDIT_DIET_RESTRICTION_PAGE_KEY = 'trainer_site_edit_diet_restriction_page';
	const TRAINER_DIET_GALLERY_PAGE_KEY = 'trainer_site_diet_gallery_page';
	const EDIT_DIET_PAGE_KEY = 'trainer_site_edit_diet_page';
	const USER_DIETS_KEY = 'trainer_site_user_diets_page';
	const USER_FOOD_QUESTIONNAIRE_KEY = 'trainer_site_food_questionnaire_page';
	const USER_HABITS_KEY = 'trainer_site_user_habits_page';

	const MEMBER_DIETS_KEY = 'trainer_site_member_diets_page';
	const MEMBER_FOOD_QUESTIONNAIRE_KEY = 'trainer_site_member_food_questionnaire_page';
	const MEMBER_HABITS_KEY = 'trainer_site_member_habits_page';

	const TRAINER_BODY_MEASURES_PAGE_KEY = 'trainer_site_body_measures_page';
	const TRAINER_STRENGTH_EXERCISES_PAGE_KEY = 'trainer_site_strength_exercises_page';
	const TRAINER_SPEED_EXERCISES_PAGE_KEY = 'trainer_site_speed_exercises_page';
	const TRAINER_DISTANCE_EXERCISES_PAGE_KEY = 'trainer_site_distance_exercises_page';
	const CORPORAL_MEASURES_PAGE_KEY = 'trainer_site_corporal_measures_page';
	const PHYSICAL_TEST_PAGE_KEY = 'trainer_site_physical_test_page';
	const EVOLUTION_PHOTOS_PAGE_KEY = 'trainer_site_evolution_photos_page';
	const MEMBER_CORPORAL_MEASURES_PAGE_KEY = 'trainer_site_member_corporal_measures_page';
	const MEMBER_PHYSICAL_TEST_PAGE_KEY = 'trainer_site_member_physical_test';
	const MEMBER_EVOLUTION_PHOTOS_PAGE_KEY = 'trainer_site_member_evolution_photos';

	const CREATION_ZONE_PAGE_KEY = 'trainer_site_member_creation_zone_page';

	const ALERTS_SETTINGS_PAGE_KEY = 'trainer_site_alert_settings_page';

	const WHAT_CAN_WE_DO_PAGE_KEY = 'trainer_site_what_can_we_do_page';
	const HOW_IT_WORKS_PAGE_KEY = 'trainer_site_how_it_works_page';
	const ONLINE_SYSTEM_PAGE_KEY = 'trainer_site_online_system_page';
	const PRESENCIAL_SYSTEM_PAGE_KEY = 'trainer_site_presencial_system_page';
	const CONTACT_PAGE_KEY = 'trainer_site_contact_page';
	const TRAINER_HELP_PAGE_KEY = 'trainer_site_trainer_help_page';
	const NOT_SHOW_TRAINER_HELP_KEY = 'trainer_site_not_showtrainer_help';

	// ACTIONS

	const CONFIRM_ACTIONS_ACTION = 'epoint_personal_trainer_confirm_actions';

	const DUPLICATE_EXERCISE_ACTION = 'epoint_personal_trainer_duplicate_exercise';
	const DELETE_EXERCISE_ACTION = 'epoint_personal_trainer_delete_exercise';

	const DELETE_EXERCISE_CATEGORY_ACTION = 'epoint_personal_trainer_delete_exercise_category';

	const GET_AVAILABLE_TRAINING_ITEMS_ACTION = 'epoint_personal_trainer_get_available_training_items';
	const GET_AVAILABLE_DIET_ITEMS_ACTION = 'epoint_personal_trainer_get_available_diet_items';

	const DUPLICATE_TRAINING_ACTION = 'epoint_personal_trainer_duplicate_training';
	const DELETE_TRAINING_ACTION = 'epoint_personal_trainer_delete_training';
	const ASSIGN_TRAINING_ACTION = 'epoint_personal_trainer_assign_training';
	const CREATE_AND_ASSIGN_TRAINING_ACTION = 'epoint_personal_trainer_create_and_assign_training';
	const HIDE_TRAINING_ACTION = 'epoint_personal_trainer_hide_training';
	const SAVE_TRAINING_ACTION = 'epoint_personal_trainer_save_training';

	const DELETE_OBJECTIVE_ACTION = 'epoint_personal_trainer_delete_objective';
	const DELETE_ENVIRONMENT_ACTION = 'epoint_personal_trainer_delete_environment';

	const DELETE_FOOD_CATEGORY_ACTION = 'epoint_personal_trainer_delete_food_category';
	const DELETE_FOOD_ACTION = 'epoint_personal_trainer_delete_food';

	const DELETE_DIET_OBJECTIVE_ACTION = 'epoint_personal_trainer_delete_diet_objective';
	const DELETE_DIET_RESTRICTION_ACTION = 'epoint_personal_trainer_delete_diet_restriction';

	const DUPLICATE_DIET_ACTION = 'epoint_personal_trainer_duplicate_diet';
	const DELETE_DIET_ACTION = 'epoint_personal_trainer_delete_diet';
	const ASSIGN_DIET_ACTION = 'epoint_personal_trainer_assign_diet';
	const HIDE_DIET_ACTION = 'epoint_personal_trainer_hide_diet';

	const GET_DIET_PREVIEW_ACTION = 'epoint_personal_trainer_get_diet_preview';
	const GET_TRAINING_PREVIEW_ACTION = 'epoint_personal_trainer_get_training_preview';

	const DELETE_EVOLUTION_MAGNITUDE_ACTION = 'epoint_personal_trainer_delete_evolution_magnitude';

	const DELETE_REAL_CASE_ACTION = 'epoint_personal_trainer_delete_real_case';

	const SKIP_CORPORAL_MEASURES_FORM_ACTION = 'epoint_personal_trainer_skip_corporal_measures_form';
	const SKIP_EVOLUTION_PHOTOS_FORM_ACTION = 'epoint_personal_trainer_skip_evolution_photos_form';

	// COOKIES

	const FILTER_EXERCISE_CATEGORY_COOKIE = 'trainer_site_filter_exercise_category';
	const FILTER_TRAINING_OBJECTIVES_COOKIE = 'trainer_site_filter_training_objectives';
	const FILTER_TRAINING_ENVIRONMENTS_COOKIE = 'trainer_site_filter_training_environments';
	const FILTER_FOOD_CATEGORY_COOKIE = 'trainer_site_filter_food_category';
	const FILTER_DIET_OBJECTIVES_COOKIE = 'trainer_site_filter_diet_objectives';
	const FILTER_DIET_RESTRICTIONS_COOKIE = 'trainer_site_filter_diet_restrictions';

	const TRAINING_TAB_COOKIE = 'trainer_site_training_tab';
	const TRAINING_LAST_DUPLICATED_COOKIE = 'trainer_site_training_last_duplicated';
	const TRAINING_OBJECTIVES_TAB_COOKIE = 'trainer_site_training_objectives_tab';
	const EXERCISE_TAB_COOKIE = 'trainer_site_exercise_tab';
	const EXERCISE_LAST_DUPLICATED_COOKIE = 'trainer_site_exercise_last_duplicated';
	const DIET_OBJECTIVES_TAB_COOKIE = 'trainer_site_diet_objectives_tab';
	const DIET_TAB_COOKIE = 'trainer_site_diet_tab';
	const DIET_LAST_DUPLICATED_COOKIE = 'trainer_site_diet_last_duplicated';

	const PHYSICAL_TEST_TAB_COOKIE = 'trainer_site_physical_test_tab';

	const LAST_FOOD_COOKIE = 'trainer_site_last_food';

	const LAST_PAGE_COOKIE = 'trainer_site_last_page';

	// CONFIRM OPTIONS
	const SHOW_DUPLICATE_EXERCISE_CONFIRMARTION_KEY = 'trainer_site_show_duplicate_exercise_confirmation';
	const SHOW_EDIT_EXERCISE_CONFIRMARTION_KEY = 'trainer_site_show_edit_exercise_confirmation';
	const SHOW_DELETE_EXERCISE_CONFIRMARTION_KEY = 'trainer_site_show_delete_exercise_confirmation';

	const SHOW_DUPLICATE_TRAINING_CONFIRMARTION_KEY = 'trainer_site_show_duplicate_training_confirmation';
	const SHOW_EDIT_TRAINING_CONFIRMARTION_KEY = 'trainer_site_show_edit_training_confirmation';
	const SHOW_DELETE_TRAINING_CONFIRMARTION_KEY = 'trainer_site_show_delete_training_confirmation';

	const SHOW_DELETE_DIET_CONFIRMARTION_KEY = 'trainer_site_show_delete_diet_confirmation';
	const SHOW_EDIT_DIET_CONFIRMARTION_KEY = 'trainer_site_show_edit_diet_confirmation';
	const SHOW_DUPLICATE_DIET_CONFIRMARTION_KEY = 'trainer_site_show_duplicate_diet_confirmation';

	const EVOLUTION_IMAGE_SIZE = 'trainer_site_evolution_size';

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

		add_image_size( self::EVOLUTION_IMAGE_SIZE, 600, 600, true );

		add_action( 'after_setup_theme', array( get_class(), 'check_required_plugins' ) );
		add_action( 'after_setup_theme', array( get_class(), 'after_setup_theme' ) );
		add_action( 'after_switch_theme', array( get_class(), 'after_switch_theme' ) );

		add_action( 'switch_theme', array( get_class(), 'switch_theme' ) );

		add_filter( 'clean_url', array( get_class(), 'defer_parsing_of_js' ), 11, 1 );

		remove_action( 'wp_head', 'wp_generator' );

		add_filter( 'script_loader_tag', array( get_class(), 'jquery_inlined' ), 99, 3 );
		add_action( 'wp_enqueue_scripts', array( get_class(), 'enqueue_scripts' ), 90 );
		add_action( 'get_footer', array( get_class(), 'enqueue_footer_styles' ), 99 );

		register_nav_menu( 'elitetrainersite-header-menu', __( 'Site header menu', self::TEXT_DOMAIN ) );

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

		add_action( 'wp_ajax_' . self::CONFIRM_ACTIONS_ACTION, array( get_class(), 'confirm_actions' ) );

		add_action( 'admin_post_' . self::DUPLICATE_EXERCISE_ACTION, array( get_class(), 'duplicate_exercise' ) );
		add_action( 'admin_post_' . self::DELETE_EXERCISE_ACTION, array( get_class(), 'delete_exercise' ) );

		add_action( 'admin_post_' . self::DELETE_EXERCISE_CATEGORY_ACTION, array( get_class(), 'delete_exercise_category' ) );


		add_action( 'wp_ajax_' . self::GET_AVAILABLE_TRAINING_ITEMS_ACTION, array( get_class(), 'get_available_training_items' ) );
		add_action( 'wp_ajax_' . self::GET_AVAILABLE_DIET_ITEMS_ACTION, array( get_class(), 'get_available_diet_items' ) );

		add_action( 'admin_post_' . self::DUPLICATE_TRAINING_ACTION, array( get_class(), 'duplicate_training' ) );
		add_action( 'admin_post_' . self::DELETE_TRAINING_ACTION, array( get_class(), 'delete_training' ) );
		add_action( 'wp_ajax_' . self::ASSIGN_TRAINING_ACTION, array( get_class(), 'assign_training' ) );
		add_action( 'wp_ajax_' . self::CREATE_AND_ASSIGN_TRAINING_ACTION, array( get_class(), 'create_and_assign_training' ) );
		add_action( 'admin_post_' . self::HIDE_TRAINING_ACTION, array( get_class(), 'hide_training' ) );
		add_action( 'wp_ajax_' . self::SAVE_TRAINING_ACTION, array( get_class(), 'save_training' ) );

		add_action( 'admin_post_' . self::DELETE_OBJECTIVE_ACTION, array( get_class(), 'delete_objective' ) );
		add_action( 'admin_post_' . self::DELETE_ENVIRONMENT_ACTION, array( get_class(), 'delete_environment' ) );

		add_action( 'admin_post_' . self::DELETE_FOOD_CATEGORY_ACTION, array( get_class(), 'delete_food_category' ) );
		add_action( 'admin_post_' . self::DELETE_FOOD_ACTION, array( get_class(), 'delete_food' ) );

		add_action( 'admin_post_' . self::DELETE_DIET_OBJECTIVE_ACTION, array( get_class(), 'delete_diet_objective' ) );
		add_action( 'admin_post_' . self::DELETE_DIET_RESTRICTION_ACTION, array( get_class(), 'delete_diet_restriction' ) );

		add_action( 'admin_post_' . self::DUPLICATE_DIET_ACTION, array( get_class(), 'duplicate_diet' ) );
		add_action( 'admin_post_' . self::DELETE_DIET_ACTION, array( get_class(), 'delete_diet' ) );
		add_action( 'admin_post_' . self::HIDE_DIET_ACTION, array( get_class(), 'hide_diet' ) );

		add_action( 'wp_ajax_' . self::ASSIGN_DIET_ACTION, array( get_class(), 'assign_diet' ) );

		add_action( 'wp_ajax_' . self::GET_DIET_PREVIEW_ACTION, array( get_class(), 'get_diet_preview' ) );
		add_action( 'wp_ajax_' . self::GET_TRAINING_PREVIEW_ACTION, array( get_class(), 'get_training_preview' ) );

		add_action( 'admin_post_' . self::DELETE_EVOLUTION_MAGNITUDE_ACTION, array( get_class(), 'delete_evolution_magnitude' ) );

		add_action( 'admin_post_' . self::DELETE_REAL_CASE_ACTION, array( get_class(), 'delete_real_case' ) );

		add_action( 'admin_post_' . self::SKIP_CORPORAL_MEASURES_FORM_ACTION, array( get_class(), 'skip_corporal_measures_form' ) );
		add_action( 'admin_post_' . self::SKIP_EVOLUTION_PHOTOS_FORM_ACTION, array( get_class(), 'skip_evolution_photos_form' ) );

		add_action( 'template_redirect', array( get_class(), 'redirect_to_personal_questionnaire' ) );
		add_action( 'template_redirect', array( get_class(), 'redirect_to_deactivated_page' ) );
		add_action( 'template_redirect', array( get_class(), 'redirect_to_trainer_info_page' ) );
	}

	public static function redirect_to_personal_questionnaire()
	{
		if( get_user_meta( get_current_user_id(), 'is_deactivated', true ) == 'yes' )
			return;


		if( class_exists( 'EpointPersonalTrainer', false ) &&
			EpointPersonalTrainer::is_site_client() &&
			get_user_meta( get_current_user_id(), 'personal_trainer_first_info_filled', true ) !== 'yes'
		) {
			$info = EpointPersonalTrainer::get_user_personal_info( get_current_user_id() );
			if( !$info->has_filled_personal_questionnaire() )
			{
				$page_id = get_blog_option( null, self::PERSONAL_QUESTIONNAIRE_PAGE_KEY, null );

				if( $page_id &&
					!is_page( $page_id ) &&
					( $url = get_permalink( $page_id ) )
				) {
					wp_redirect( $url );
					exit;
				}
			}
			else
			{
				$info_date = get_user_meta( get_current_user_id(), 'personal_trainer_food_questionnaire_date', true );
				if( empty( $info_date ) )
				{
					$page_id = get_blog_option( null, self::USER_FOOD_QUESTIONNAIRE_KEY, null );

					if( $page_id &&
						!is_page( $page_id ) &&
						( $url = get_permalink( $page_id ) )
					) {
						wp_redirect( $url );
						exit;
					}
				}
				else
				{
					$user_habits = get_user_meta( get_current_user_id(), 'personal_trainer_user_habits', true );
					if( empty( $user_habits ) )
					{
						$page_id = get_blog_option( null, self::MEMBER_HABITS_KEY, null );
						if( $page_id &&
							!is_page( $page_id ) &&
							( $url = get_permalink( $page_id ) )
						) {
							wp_redirect( $url );
							exit;
						}
					}
					else
					{
						//$corporal_measures = EpointPersonalTrainerMapper::get_last_user_evolution_values_by_type( get_current_user_id(), 'corporal' );
						$corporal_measures_set = get_user_meta( get_current_user_id(), 'personal_trainer_corporal_measures_set', true ) === 'yes';
						
						//if( empty( $corporal_measures ) )
						if( !$corporal_measures_set )
						{
							$page_id = get_blog_option( null, self::MEMBER_CORPORAL_MEASURES_PAGE_KEY, null );
							if( $page_id &&
								!is_page( $page_id ) &&
								( $url = get_permalink( $page_id ) )
							) {
								wp_redirect( $url );
								exit;
							}
						}
						else
						{
							//$photos = EpointPersonalTrainerMapper::get_user_evolution_photos( get_current_user_id() );
							$photos_set = get_user_meta( get_current_user_id(), 'personal_trainer_evolution_photos_set', true ) === 'yes';
							
							//if( empty( $photos ) )
							if( !$photos_set )
							{
								$page_id = get_blog_option( null, self::MEMBER_EVOLUTION_PHOTOS_PAGE_KEY, null );
								if( $page_id &&
									!is_page( $page_id ) &&
									( $url = get_permalink( $page_id ) )
								) {
									wp_redirect( $url );
									exit;
								}
							}
							else
							{
								$page_id = get_blog_option( null, self::ACCOUNT_PAGE_KEY, null );
								if( $page_id &&
									!is_page( $page_id ) &&
									( $url = get_permalink( $page_id ) )
								) {
									wp_redirect( $url );
									exit;
								}
							}
						}
					}

				}
			}
		}
	}

	public static function redirect_to_deactivated_page()
	{
		$page_id = get_blog_option( null, self::DEACTIVATED_PAGE_KEY, null );

		if( $page_id &&
			!is_page( $page_id ) &&
			is_user_logged_in() &&
			get_user_meta( get_current_user_id(), 'is_deactivated', true ) == 'yes' &&
			( $url = get_permalink( $page_id ) ) )
		{
			wp_redirect( $url );
			exit;
		}
	}

	public static function redirect_to_trainer_info_page()
	{
		if( get_user_meta( get_current_user_id(), 'is_deactivated', true ) == 'yes' )
			return;

		$page_id = (int)get_blog_option( null, self::TRAINER_INFO_PAGE_KEY, null );

		if( $page_id &&
			self::is_site_trainer() &&
			!is_page( $page_id ) &&
			class_exists( 'EpointPersonalTrainer', false ) &&
			( $url = get_permalink( $page_id ) ) )
		{
			$info = EpointPersonalTrainer::get_user_trainer_info( get_current_user_id() );
			if( !$info->has_filled_trainer_info() )
			{
				wp_redirect( $url );
				exit;
			}
		}
	}


	public static function must_show_trainer_help_modal()
	{
		$trainer_info_page_id = (int)get_blog_option( null, self::TRAINER_INFO_PAGE_KEY, null );
		if( is_page( $trainer_info_page_id ) )
			return false;

		$page_id = get_blog_option( null, self::TRAINER_HELP_PAGE_KEY, null );
		$not_show = get_blog_option( null, self::NOT_SHOW_TRAINER_HELP_KEY, null ) == 'yes';

		return
			$page_id &&
			!$not_show &&
			self::is_site_trainer() &&
			!is_page( $page_id ) &&
			( $url = get_permalink( $page_id ) );
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

			self::install_tables();

			self::install_presencial_plans();

			update_blog_option( get_current_blog_id(), self::IS_INSTALLED_KEY, 'yes' );

			$blog_details = get_blog_details( get_current_blog_id() );
			wp_redirect( $blog_details->siteurl );
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
				'post_title' => __( 'Personal questionnaire', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-personal-questionnaire',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::PERSONAL_QUESTIONNAIRE_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Your account is deactivated', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-deactivated',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::DEACTIVATED_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Trainer info', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-info',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_INFO_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Exercises Gallery', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-exercises',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_EXERCISES_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Edit exercise', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-edit-exercise',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_EXERCISE_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Training Gallery', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-training-gallery',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_TRAINING_GALLERY_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Edit training', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-edit-training',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_TRAINING_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Objectives and environments gallery', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-objectives-gallery',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_OBJECTIVES_GALLERY_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Edit objective', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-edit-objective',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_OBJECTIVE_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Edit environment', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-edit-environment',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_ENVIRONMENT_PAGE_KEY, $page_id );

// Food
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Food Gallery', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-food-gallery',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_FOOD_GALLERY_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Edit food', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-edit-food',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_FOOD_PAGE_KEY, $page_id );

// diet objectives and restrictions
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Diet objectives and restrictions', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-diet-objectives-gallery',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_DIET_OBJECTIVES_GALLERY_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Diet objective', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-edit-diet-objective',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_DIET_OBJECTIVE_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Diet restriction', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-edit-diet-restriction',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_DIET_RESTRICTION_PAGE_KEY, $page_id );

// trainer diets
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Diet Gallery', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-diet-gallery',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_DIET_GALLERY_PAGE_KEY, $page_id );
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Edit diet', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-edit-diet',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_DIET_PAGE_KEY, $page_id );

// trainer - user diets section
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Custom diets', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-user-diets',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::USER_DIETS_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Food questionnaire', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-user-food-questionnaire',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::USER_FOOD_QUESTIONNAIRE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'View/Edit habits', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-user-habits',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::USER_HABITS_KEY, $page_id );

// member diets section
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'My diets', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-member-diets',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MEMBER_DIETS_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Food questionnaire', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-member-food-questionnaire',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MEMBER_FOOD_QUESTIONNAIRE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'My habits', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-member-habits',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MEMBER_HABITS_KEY, $page_id );

// trainer - creation zone - evoluton pages
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Add or edit body measures', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-body-measures',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_BODY_MEASURES_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Add or edit strength exercises', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-strength-exercises',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_STRENGTH_EXERCISES_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Add or edit speed exercises', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-speed-exercises',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_SPEED_EXERCISES_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Add or edit distance exercises', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-distance-exercises',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_DISTANCE_EXERCISES_PAGE_KEY, $page_id );
// trainer - view member evoluton pages
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Weight zone and corporal measures', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-corporal-measures',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::CORPORAL_MEASURES_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Physical test', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-physical-test',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::PHYSICAL_TEST_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Evolution photos', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-evolution-photos',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EVOLUTION_PHOTOS_PAGE_KEY, $page_id );

// trainer - alerts

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Alerts settings', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-alert-settings',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::ALERTS_SETTINGS_PAGE_KEY, $page_id );

// member - evoluton pages
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Weight zone and corporal measures', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-member-corporal-measures',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MEMBER_CORPORAL_MEASURES_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Physical test', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-member-physical-test',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MEMBER_PHYSICAL_TEST_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Evolution photos', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-member-evolution-photos',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MEMBER_EVOLUTION_PHOTOS_PAGE_KEY, $page_id );

// --

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Creation zone', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-creation-zone',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::CREATION_ZONE_PAGE_KEY, $page_id );
//----
			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'My Account', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-my-account',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::ACCOUNT_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Members list', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-member-list',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MEMBERS_LIST_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Delete Members list', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-delete-member-list',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::DELETE_MEMBERS_LIST_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Edit member', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-edit-member',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::EDIT_MEMBER_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'View member', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-view-member',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::VIEW_MEMBER_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'View member training', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-view-member-training',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::VIEW_MEMBER_TRAINING_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'My training', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-my-training',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::MY_TRAINING_PAGE_KEY, $page_id );

			$page_id = wp_insert_post( array(
				'post_content' => '',
				'post_title' => __( 'Trainer valoration', self::TEXT_DOMAIN ),
				'post_name' => 'trainersite-trainer-valoration',
				'post_status' => 'publish',
				'post_type' => 'page'
			) );
			update_blog_option( get_current_blog_id(), self::TRAINER_VALORATION_PAGE_KEY, $page_id );
		}

		$page_id = wp_insert_post( array(
			'post_content' => self::get_page_default_content( 'whatcanwedo' ),
			'post_title' => __( '¿Qué podemos hacer por ti?', self::TEXT_DOMAIN ),
			'post_name' => 'que-podemos-hacer-por-ti',
			'post_status' => 'publish',
			'post_type' => 'page'
		) );
		update_blog_option( get_current_blog_id(), self::WHAT_CAN_WE_DO_PAGE_KEY, $page_id );

		$page_id = wp_insert_post( array(
			'post_content' => self::get_page_default_content( 'howitworks' ),
			'post_title' => __( 'Así funciona Elite Club Training', self::TEXT_DOMAIN ),
			'post_name' => 'asi-funciona',
			'post_status' => 'publish',
			'post_type' => 'page'
		) );
		update_blog_option( get_current_blog_id(), self::HOW_IT_WORKS_PAGE_KEY, $page_id );

		$page_id = wp_insert_post( array(
			'post_content' => self::get_page_default_content( 'online' ),
			'post_title' => __( 'Sistema Online', self::TEXT_DOMAIN ),
			'post_name' => 'sistema-online',
			'post_status' => 'publish',
			'post_type' => 'page'
		) );
		update_blog_option( get_current_blog_id(), self::ONLINE_SYSTEM_PAGE_KEY, $page_id );

		$page_id = wp_insert_post( array(
			'post_content' => self::get_page_default_content( 'presencial' ),
			'post_title' => __( 'Sistema Presencial', self::TEXT_DOMAIN ),
			'post_name' => 'sistema-presencial',
			'post_status' => 'publish',
			'post_type' => 'page'
		) );
		update_blog_option( get_current_blog_id(), self::PRESENCIAL_SYSTEM_PAGE_KEY, $page_id );

		$page_id = wp_insert_post( array(
			'post_content' => self::get_page_default_content( 'contact' ),
			'post_title' => __( 'Contacto', self::TEXT_DOMAIN ),
			'post_name' => 'contacto',
			'post_status' => 'publish',
			'post_type' => 'page'
		) );
		update_blog_option( get_current_blog_id(), self::CONTACT_PAGE_KEY, $page_id );

		$page_id = wp_insert_post( array(
			'post_content' => '',
			'post_title' => __( 'Ayuda', self::TEXT_DOMAIN ),
			'post_name' => 'ayuda-entrenador',
			'post_status' => 'publish',
			'post_type' => 'page'
		) );
		update_blog_option( get_current_blog_id(), self::TRAINER_HELP_PAGE_KEY, $page_id );
	}

	public static function install_presencial_plans()
	{
		if( !class_exists( 'EpointPresencialPlans', false ) )
			return;

		$plan_id = wp_insert_post( array(
			'post_content' => '<ul> <li>PLAN DIETÉTICO A MEDIDA</li> <li>ENTRENAMIENTO PERSONAL (1H)</li> <li>ASESORÍA SUPLEMENTACIÓN</li> <li>MEDICIÓN Y CONTROL DE PESO SEMANAL</li> <li>FOTOGRAFÍAS DE EVOLUCIÓN MENSUALES</li> </ul>',
			'post_title' => __( 'Básico', self::TEXT_DOMAIN ),
			'post_name' => 'plan-presencial-basico',
			'post_status' => 'publish',
			'post_type' => EpointPresencialPlans::POST_TYPE
		) );
		EpointPresencialPlans::set_valoration( $plan_id, 1 );
		EpointPresencialPlans::set_type( $plan_id, __( 'Básico', self::TEXT_DOMAIN ) );
		EpointPresencialPlans::set_times( $plan_id, '<p>1 Clase / Mes (1H)</p>' );
		EpointPresencialPlans::set_prices( $plan_id, '<p><strong>50€ / MES&nbsp;</strong><br>(FUERA DE NUESTRAS INSTALACIONES COLABORADORAS)</p> <p><strong>30€ / MES&nbsp;</strong><br>(DENTRO DE NUESTRAS INSTALACIONES COLABORADORAS)</p>' );

		$plan_id = wp_insert_post( array(
			'post_content' => '<ul> <li>PLAN DIETÉTICO A MEDIDA</li> <li>ENTRENAMIENTO PERSONAL (1H)</li> <li>ASESORÍA SUPLEMENTACIÓN</li> <li>MEDICIÓN Y CONTROL DE PESO SEMANAL</li> <li>FOTOGRAFÍAS DE EVOLUCIÓN MENSUALES</li> </ul>',
			'post_title' => __( 'Bronce', self::TEXT_DOMAIN ),
			'post_name' => 'plan-presencial-bronce',
			'post_status' => 'publish',
			'post_type' => EpointPresencialPlans::POST_TYPE
		) );
		EpointPresencialPlans::set_valoration( $plan_id, 2 );
		EpointPresencialPlans::set_type( $plan_id, __( 'Bronce', self::TEXT_DOMAIN ) );
		EpointPresencialPlans::set_times( $plan_id, '<p>2 Clases / Mes (1H)</p>' );
		EpointPresencialPlans::set_prices( $plan_id, '<p><strong>100€ / MES </strong><br>(FUERA DE NUESTRAS INSTALACIONES COLABORADORAS)</p><p><strong>60€ / MES</strong><br>(DENTRO DE NUESTRAS INSTALACIONES COLABORADORAS)</p>' );

		$plan_id = wp_insert_post( array(
			'post_content' => '<ul> <li>PLAN DIETÉTICO A MEDIDA</li> <li>ENTRENAMIENTO PERSONAL (1H)</li> <li>ASESORÍA SUPLEMENTACIÓN</li> <li>MEDICIÓN Y CONTROL DE PESO SEMANAL</li> <li>FOTOGRAFÍAS DE EVOLUCIÓN MENSUAL</li> <li>ATENCIÓN TELEFÓNICA</li> </ul>',
			'post_title' => __( 'Plata', self::TEXT_DOMAIN ),
			'post_name' => 'plan-presencial-plata',
			'post_status' => 'publish',
			'post_type' => EpointPresencialPlans::POST_TYPE
		) );
		EpointPresencialPlans::set_valoration( $plan_id, 3 );
		EpointPresencialPlans::set_type( $plan_id, __( 'Plata', self::TEXT_DOMAIN ) );
		EpointPresencialPlans::set_times( $plan_id, '<p>1 Clase / Semana (1H)</p>' );
		EpointPresencialPlans::set_prices( $plan_id, '<p><strong>200€ / MES </strong><br>(FUERA DE NUESTRAS INSTALACIONES COLABORADORAS)</p><p><strong>120€ / MES</strong><br>(DENTRO DE NUESTRAS INSTALACIONES COLABORADORAS)</p>' );

		$plan_id = wp_insert_post( array(
			'post_content' => '<ul> <li>PLAN DIETÉTICO A MEDIDA</li> <li>ENTRENAMIENTO PERSONAL (1H)</li> <li>ASESORÍA SUPLEMENTACIÓN</li> <li>MEDICIÓN Y CONTROL DE PESO SEMANAL</li> <li>FOTOGRAFÍAS DE EVOLUCIÓN MENSUAL</li> <li>ATENCIÓN TELEFÓNICA</li> <li>1 SESIÓN FISIOTERAPIA MENSUAL</li> </ul>',
			'post_title' => __( 'Oro', self::TEXT_DOMAIN ),
			'post_name' => 'plan-presencial-oro',
			'post_status' => 'publish',
			'post_type' => EpointPresencialPlans::POST_TYPE
		) );
		EpointPresencialPlans::set_valoration( $plan_id, 4 );
		EpointPresencialPlans::set_type( $plan_id, __( 'Oro', self::TEXT_DOMAIN ) );
		EpointPresencialPlans::set_times( $plan_id, '<p>2 Clases / Semana (1H)</p>' );
		EpointPresencialPlans::set_prices( $plan_id, '<p><strong>400€ / MES</strong><br>(FUERA DE NUESTRAS INSTALACIONES COLABORADORAS)</p> <p><strong>240€ / MES</strong><br>(DENTRO DE NUESTRAS INSTALACIONES COLABORADORAS)</p>' );


		$plan_id = wp_insert_post( array(
			'post_content' => '<ul> <li>PLAN DIETÉTICO A MEDIDA</li> <li>ENTRENAMIENTO PERSONAL (1H)</li> <li>ASESORÍA SUPLEMENTACIÓN</li> <li>MEDICIÓN Y CONTROL DE PESO SEMANAL</li> <li>FOTOGRAFÍAS DE EVOLUCIÓN MENSUAL</li> <li>ATENCIÓN TELEFÓNICA</li> <li>1 SESIÓN FISIOTERAPIA MENSUAL</li> </ul>',
			'post_title' => __( 'Platino', self::TEXT_DOMAIN ),
			'post_name' => 'plan-presencial-platino',
			'post_status' => 'publish',
			'post_type' => EpointPresencialPlans::POST_TYPE
		) );
		EpointPresencialPlans::set_valoration( $plan_id, 5 );
		EpointPresencialPlans::set_type( $plan_id, __( 'Platino', self::TEXT_DOMAIN ) );
		EpointPresencialPlans::set_times( $plan_id, '<p>3 Clases / Semana (1H)</p>' );
		EpointPresencialPlans::set_prices( $plan_id, '<p><strong>600€ / MES</strong><br>(FUERA DE NUESTRAS INSTALACIONES COLABORADORAS)</p> <p><strong>360€ / MES</strong><br>(DENTRO DE NUESTRAS INSTALACIONES COLABORADORAS)</p>' );
	}

	public static function get_page_default_content( $page )
	{
		$file = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'defaultpages', $page . '.php' ) );

		ob_start();
		include( $file );
		return ob_get_clean();
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

					if( $form_id == EpointPersonalTrainer::EDIT_MEMBER_FORM_INTERNAL_ID )
						$form['args']['success_page_id'] = get_blog_option( null, self::EDIT_MEMBER_PAGE_KEY, null );

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

	public static function install_tables()
	{
		EliteTrainerSiteThemeMapper::install();
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
/*
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
			),
*/
			self::PAGE_BG_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PageBackground.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ARCHIVE_CASES_BG_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ArchiveCasesBackground.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),


			self::HEADER_NAVBAR_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HeaderNavbar.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::CONTACT_DATA_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ContactData.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::MAIN_MENU_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'MainMenu.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::SUBMENU_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'SubMenu.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::SUBMENU2_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'SubMenu2.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOME_COVER_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HomeCoverTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOME_COVER_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HomeCover.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOME_COVER_BG_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HomeCoverBG.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOME_COVER_LINK_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HomeCoverLink.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOME_COVER_VIDEO_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'RealCasesVideoText.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOME_COVER_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HomeCoverVideo.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::REAL_CASES_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'RealCasesTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::MORE_CASES_LINK_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'MoreCasesLink.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::TARGET_COVER_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'TargetCoverTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::TARGET_COVER_BG_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'TargetCoverBG.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::TARGET_COVER_TEXT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'TargetCoverText.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::TARGET_COVER_LINK_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'TargetCoverLink.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::PLANS_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PlansTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::ONLINE_PLAN_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlan.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_DESC_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanDesc.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_FEATURES_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanFeatures.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_KNOW_LINK_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanButton.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::PRESENCIAL_PLAN_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPlan.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::PRESENCIAL_PLAN_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPlanTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::PRESENCIAL_PLAN_DESC_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPlanDesc.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::PRESENCIAL_PLAN_FEATURES_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPlanFeatures.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::PRESENCIAL_KNOW_LINK_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPlanButton.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::CONTACT_BUTTON_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ContactButton.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOOTER_CONTACT_FORM_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'FooterContactForm.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::FOOTER_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'Footer.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_PRESENCIAL_PLAN_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'EditPresencialPlan.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::EDIT_REAL_CASE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'EditRealCase.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::ARCHIVE_REAL_CASES_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ArchiveRealCasesTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::REAL_CASES_VIDEO_SUBTITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'RealCasesVideoSubtitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::FOR_YOU_PAGE_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouPageTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_1_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection1Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_1_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection1Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_1_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection1Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_2_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection2Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_2_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection2Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_2_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection2Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_3_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection3Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_3_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection3Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_3_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection3Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_4_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection4Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_4_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection4Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_4_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection4Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_5_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection5Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_5_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection5Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::FOR_YOU_SECTION_5_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'ForYouSection5Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::HOW_WORKS_PAGE_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksPageTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::HOW_WORKS_PAGE_TITLE_2_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksPageTitle2.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_PAGE_SUBTITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksPageSubtitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksHeaderVideo.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_1_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection1Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_1_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection1Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_2_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection2Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_2_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection2Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_2_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection2Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_2_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection2Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_3_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection3Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_3_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection3Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_4_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection4Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_4_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection4Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_5_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection5Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_5_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection5Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_5_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection5Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_5_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection5Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_6_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection6Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_6_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection6Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_7_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection7Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_7_IMAGE_1_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection7Image1.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_7_IMAGE_2_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection7Image2.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_7_IMAGE_3_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection7Image3.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_8_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection8Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_8_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection8Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_8_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection8Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_8_IMAGE_1_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection8Image1.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_8_IMAGE_2_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection8Image2.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_8_IMAGE_3_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection8Image3.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_9_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection9Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_9_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection9Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_10_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection10Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_10_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection10Image.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::HOW_WORKS_SECTION_11_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'HowWorksSection11Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::ONLINE_PLAN_PAGE_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanPageTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_PAGE_SUBTITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanPageSubtitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePageHeaderVideo.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::ONLINE_PLAN_SECTION_0A_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection0AContent.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_0B_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection0BContent.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_TO_PRESENCIAL_LINK_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlineToPresencialLink.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::ONLINE_PLAN_SECTION_1_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection1Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_1_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection1Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_1_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection1Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_2_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection2Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_2_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection2Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_2_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection2Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_3_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection3Title.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_3_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection3Video.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::ONLINE_PLAN_SECTION_3_CONTENT_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'OnlinePlanSection3Content.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),


			self::PRESENCIAL_PLAN_PAGE_TITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPlanPageTitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::PRESENCIAL_PLAN_PAGE_SUBTITLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPlanPageSubtitle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::PRESENCIAL_PLAN_PAGE_HEADER_VIDEO_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialPageHeaderVideo.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::PRESENCIAL_TABLE_HEAD_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'PresencialTableHead.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::CORPORAL_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'CorporalMeasuresPageHeader.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::CORPORAL_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'CorporalMeasuresPageHeaderImage.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::STRENGTH_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'StrengthMeasuresPageHeader.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::STRENGTH_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'StrengthMeasuresPageHeaderImage.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::SPEED_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'SpeedMeasuresPageHeader.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::SPEED_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'SpeedMeasuresPageHeaderImage.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::DISTANCE_MEASURES_PAGE_HEADER_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'DistanceMeasuresPageHeader.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::DISTANCE_MEASURES_PAGE_HEADER_IMAGE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'DistanceMeasuresPageHeaderImage.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),

			self::USER_DIETS_STYLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'UserDietsStyle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),
			self::USER_TRAINING_STYLE_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'UserTrainingStyle.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			),


			self::MAIN_OPTIONS_FORM_INTERNAL_ID => array(
				'dir' => $dir,
				'file' => 'MainOptions.php',
				'args' => array(
					'text_domain' => self::TEXT_DOMAIN
				)
			)
		);
	}


	public static function get_default_menu_items()
	{
		$ret = apply_filters( 'elitetrainersitetheme_default_menu_items', array() );

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

		$ret['home'] = array( 'url' => get_bloginfo( 'url' ), 'text' => __( 'Inicio', self::TEXT_DOMAIN ) );
		$ret['real'] = array( 'url' => get_post_type_archive_link( EpointRealCases::POST_TYPE ), 'text' => __( 'Testimonios - Casos reales', self::TEXT_DOMAIN ) );
		$ret['what'] = array( 'url' => get_permalink( get_option( self::WHAT_CAN_WE_DO_PAGE_KEY ) ), 'text' => __( '¿Qué podemos hacer por ti?', self::TEXT_DOMAIN ) );
		$ret['training'] = array( 'url' => get_permalink( get_option( self::HOW_IT_WORKS_PAGE_KEY ) ), 'text' => __( 'Asi puede ser tu entrenamiento', self::TEXT_DOMAIN ) );
		$ret['join'] = array(
			'url' => get_permalink( get_option( self::ONLINE_SYSTEM_PAGE_KEY ) ),
			'text' => __( 'Únete y consigue tu objetivo', self::TEXT_DOMAIN ),
			'children' => array(
				'online' => array(
					'url' => get_permalink( get_option( self::ONLINE_SYSTEM_PAGE_KEY ) ),
					'text' => __( 'Plan online', self::TEXT_DOMAIN ),
				),
				'presencial' => array(
					'url' => get_permalink( get_option( self::PRESENCIAL_SYSTEM_PAGE_KEY ) ),
					'text' => __( 'Plan presencial', self::TEXT_DOMAIN ),
				)
			)
		);

		$contact_url = self::get_contact_page_url();
		$ret['contact'] = array( 'url' => $contact_url, 'text' => __( 'Solicita información', self::TEXT_DOMAIN ) );

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


		return apply_filters( 'elitetrainersitetheme_legal_menu_items', $ret );
	}

	public static function get_site_trainer()
	{
		if( !class_exists( 'EpointPersonalTrainer', false ) )
			return null;

		$admin_users = get_users( array( 'role' => EpointPersonalTrainer::TRAINER_ROLE ) );

		if( is_array( $admin_users ) && !empty( $admin_users ) )
		{
			return current( $admin_users );
		}

		return null;
	}

	public static function is_site_trainer()
	{
		return
			current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) &&
			is_user_member_of_blog();
	}

	public static function get_contact_page_url()
	{
		$theme_url = get_permalink( get_option( self::CONTACT_PAGE_KEY ) );
		if( !empty( $theme_url ) )
			return $theme_url;
		
		if( !class_exists( 'JLCContact' ) )
			return null;

		$contact = JLCContact::get_contact_page();
		$contact_link = $contact ? get_permalink( $contact ) : '#';

		return $contact_link;
	}

	public static function get_trainer_help_page_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_HELP_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_my_account_url()
	{
		$account_id = get_blog_option( null, self::ACCOUNT_PAGE_KEY, null );

		return $account_id ? get_permalink( $account_id ) : null;
	}

	public static function get_members_list_url()
	{
		$page_id = get_blog_option( null, self::MEMBERS_LIST_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_delete_members_list_url()
	{
		$page_id = get_blog_option( null, self::DELETE_MEMBERS_LIST_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_edit_member_url( $member_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_MEMBER_PAGE_KEY, null );

		$extra = !empty( $member_id ) ? '?member=' . $member_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_view_member_url( $member_id = null )
	{
		$page_id = get_blog_option( null, self::VIEW_MEMBER_PAGE_KEY, null );

		$extra = !empty( $member_id ) ? '?member=' . $member_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_view_member_training_url( $member_id = null )
	{
		$page_id = get_blog_option( null, self::VIEW_MEMBER_TRAINING_PAGE_KEY, null );

		$extra = !empty( $member_id ) ? '?member=' . $member_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_my_training_url()
	{
		$page_id = get_blog_option( null, self::MY_TRAINING_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_trainer_valoration_page_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_VALORATION_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_real_cases( $numberposts = -1 )
	{
		if( !class_exists( 'EpointRealCases' ) )
			return array();

		$cases = get_posts( array(
			'numberposts' => $numberposts,
			'post_type' => EpointRealCases::POST_TYPE
		) );

		return $cases;
	}

	
	public static function get_personal_questionnaire_url()
	{
		$page_id = get_blog_option( null, self::PERSONAL_QUESTIONNAIRE_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}
	
	public static function get_trainer_info_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_INFO_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_exercises_list_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_EXERCISES_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_edit_exercise_url( $exercise_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_EXERCISE_PAGE_KEY, null );

		$extra = !empty( $exercise_id ) ? '?exercise=' . $exercise_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_exercise_image( $exercise, $image_type, $image_size = 'full' )
	{
		if( !$exercise )
			return null;

		if( is_int( $exercise ) )
			$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise );

		$image_id = null;
		switch( $image_type )
		{
			case 'start':
				$image_id = $exercise->image_start;
				break;
			case 'end':
				$image_id = $exercise->image_end;
				break;
			default:
		}

		if( !$exercise->trainer )
			switch_to_blog( 1 );

		$url = wp_get_attachment_image_url( $image_id, $image_size );

		if( !$exercise->trainer )
			restore_current_blog();

		return !empty( $url ) ? $url : get_template_directory_uri() . '/img/buttons/exercises.svg';
	}

	public static function get_training_list_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_TRAINING_GALLERY_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_edit_training_url( $training_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_TRAINING_PAGE_KEY, null );

		$extra = !empty( $training_id ) ? '?training=' . $training_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_objectives_list_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_OBJECTIVES_GALLERY_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_edit_objective_url( $objective_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_OBJECTIVE_PAGE_KEY, null );

		$extra = !empty( $objective_id ) ? '?objective=' . $objective_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_edit_environment_url( $environment_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_ENVIRONMENT_PAGE_KEY, null );

		$extra = !empty( $environment_id ) ? '?environment=' . $environment_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_food_list_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_FOOD_GALLERY_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_edit_food_url( $food_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_FOOD_PAGE_KEY, null );

		$extra = !empty( $food_id ) ? '?food=' . $food_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_diet_objectives_list_url( )
	{
		$page_id = get_blog_option( null, self::TRAINER_DIET_OBJECTIVES_GALLERY_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_edit_diet_objective_url( $objective_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_DIET_OBJECTIVE_PAGE_KEY, null );

		$extra = !empty( $objective_id ) ? '?objective=' . $objective_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_edit_diet_restriction_url( $restriction_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_DIET_RESTRICTION_PAGE_KEY, null );

		$extra = !empty( $restriction_id ) ? '?restriction=' . $restriction_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_diets_list_url()
	{
		$page_id = get_blog_option( null, self::TRAINER_DIET_GALLERY_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_edit_diet_url( $diet_id = null )
	{
		$page_id = get_blog_option( null, self::EDIT_DIET_PAGE_KEY, null );

		$extra = !empty( $diet_id ) ? '?diet=' . $diet_id : '';

		return $page_id ? get_permalink( $page_id ) . $extra : null;
	}

	public static function get_user_diets_url( $user_id )
	{
		$page_id = get_blog_option( null, self::USER_DIETS_KEY, null );

		return $page_id ? get_permalink( $page_id ) . '?member=' . $user_id : null;
	}

	public static function get_user_food_questionnaire_url( $user_id )
	{
		$page_id = get_blog_option( null, self::USER_FOOD_QUESTIONNAIRE_KEY, null );

		return $page_id ? get_permalink( $page_id ) . '?member=' . $user_id : null;
	}

	public static function get_user_habits_url( $user_id )
	{
		$page_id = get_blog_option( null, self::USER_HABITS_KEY, null );

		return $page_id ? get_permalink( $page_id ) . '?member=' . $user_id : null;
	}

	public static function get_member_diets_url()
	{
		$page_id = get_blog_option( null, self::MEMBER_DIETS_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_member_food_questionnaire_url()
	{
		$page_id = get_blog_option( null, self::MEMBER_FOOD_QUESTIONNAIRE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_member_habits_url()
	{
		$page_id = get_blog_option( null, self::MEMBER_HABITS_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

// evolution pages for creation zone

	public static function get_trainer_body_measures_url( $measure_id = null )
	{
		$page_id = get_blog_option( null, self::TRAINER_BODY_MEASURES_PAGE_KEY, null );

		if( !$page_id )
			return null;

		return get_permalink( $page_id ) . ( $measure_id ? '?measure=' . $measure_id : '' );
	}

	public static function get_trainer_strength_exercises_url( $measure_id = null )
	{
		$page_id = get_blog_option( null, self::TRAINER_STRENGTH_EXERCISES_PAGE_KEY, null );

		if( !$page_id )
			return null;

		return get_permalink( $page_id ) . ( $measure_id ? '?measure=' . $measure_id : '' );
	}

	public static function get_trainer_speed_exercises_url( $measure_id = null )
	{
		$page_id = get_blog_option( null, self::TRAINER_SPEED_EXERCISES_PAGE_KEY, null );

		if( !$page_id )
			return null;

		return get_permalink( $page_id ) . ( $measure_id ? '?measure=' . $measure_id : '' );
	}

	public static function get_trainer_distance_exercises_url( $measure_id = null )
	{
		$page_id = get_blog_option( null, self::TRAINER_DISTANCE_EXERCISES_PAGE_KEY, null );

		if( !$page_id )
			return null;

		return get_permalink( $page_id ) . ( $measure_id ? '?measure=' . $measure_id : '' );
	}

// evolution pages for trainer view member 

	public static function get_corporal_measures_url( $member_id )
	{
		$page_id = get_blog_option( null, self::CORPORAL_MEASURES_PAGE_KEY, null );

		return $page_id ? ( get_permalink( $page_id ) . '?member=' . $member_id ) : null;
	}

	public static function get_physical_test_url( $member_id )
	{
		$page_id = get_blog_option( null, self::PHYSICAL_TEST_PAGE_KEY, null );

		return $page_id ? ( get_permalink( $page_id ) . '?member=' . $member_id ) : null;
	}

	public static function get_evolution_photos_url( $member_id )
	{
		$page_id = get_blog_option( null, self::EVOLUTION_PHOTOS_PAGE_KEY, null );

		return $page_id ? ( get_permalink( $page_id ) . '?member=' . $member_id ) : null;
	}

// alerts settings page

	public static function get_alerts_settings_page_url()
	{
		$page_id = get_blog_option( null, self::ALERTS_SETTINGS_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

// evolution pages for member

	public static function get_member_corporal_measures_url()
	{
		$page_id = get_blog_option( null, self::MEMBER_CORPORAL_MEASURES_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_member_physical_test_url()
	{
		$page_id = get_blog_option( null, self::MEMBER_PHYSICAL_TEST_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

	public static function get_member_evolution_photos_url()
	{
		$page_id = get_blog_option( null, self::MEMBER_EVOLUTION_PHOTOS_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
	}

// creation zone

	public static function get_creation_zone_url()
	{
		$page_id = get_blog_option( null, self::CREATION_ZONE_PAGE_KEY, null );

		return $page_id ? get_permalink( $page_id ) : null;
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
		if( !has_nav_menu( 'elitetrainersite-header-menu' ) )
		{
			$menu_items = self::get_default_menu_items();
			get_template_part( 'templates/header', 'defaultmenu' );
		}
		else
		{
			get_template_part( 'templates/header', 'custommenu' );
/*
			wp_nav_menu( array(
				'menu' => 'elitetrainersite-header-menu',
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
/*
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
*/
	public static function initialize_extensions()
	{
		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'PageMeta.php' ) ) );
		EliteTrainerSiteThemePageMeta::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'LazyLoad.php' ) ) );
		EliteTrainerSiteThemeLazyLoad::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'Facebook.php' ) ) );
		EliteTrainerSiteThemeFacebook::initialize();

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'GoogleMaps.php' ) ) );
		EliteTrainerSiteThemeGoogleMaps::initialize();
	
		
		if( is_plugin_active( 'woocommerce/woocommerce.php' ) )
		{	
			require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'WooCommerce.php' ) ) );
			EliteTrainerSiteThemeWooCommerce::initialize();
		}

		require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'extensions', 'Customizer.php' ) ) );
		EliteTrainerSiteThemeCustomizer::initialize();
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

	//	wp_enqueue_style( 'custom-fontawesome-css', get_template_directory_uri() . '/css/all.min.css', array(), $version );

		//wp_enqueue_script( 'jquery-ui-draggable' );
		//wp_enqueue_script( 'jquery-ui-droppable' );


		wp_enqueue_style( 'elitetrainersite-font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), $version );
		wp_enqueue_style( 'elitetrainersite-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), $version );
		wp_enqueue_style( 'elitetrainersite-bootstrap-theme-css', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), $version );

		//wp_enqueue_script( 'elitetrainersite-select2-script', get_template_directory_uri() . '/js/select2.min.js', array( 'jquery' ), $version, true );

		wp_enqueue_script( 'elitetrainersite-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), $version, true );

		//wp_enqueue_script( 'jquery-ui-autocomplete' );

		//wp_enqueue_script( 'elitetrainersite-images-loaded-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), $version, true );
		//wp_enqueue_script( 'elitetrainersite-masonry-js', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), $version, true );

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

		wp_enqueue_script( 'elitetrainersite-navigation-js', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), $version, true );

		wp_enqueue_script( 'elitetrainersite-global-js', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), $version, true );

/*
		wp_localize_script( 'elitetrainersite-global-js', 'EliteTrainerSite', array(
			//'search_product_url' => admin_url( 'admin-ajax.php' ) . '?action=' . self::SEARCH_PRODUCTS_ACTION
		) );
*/
		wp_enqueue_style(
			'hololu-jquery-ui-css',
			'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
		);
	}

	public static function enqueue_footer_styles()
	{
		$version = self::get_version();

		//wp_enqueue_style( 'elitetrainersite-select2-style', get_template_directory_uri() . '/css/select2.min.css', array(), $version );

		//wp_enqueue_style( 'jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	}

	public static function register_widgets()
	{
	}

	public static function register_sidebars()
	{
		register_sidebar( array(
			'name' => __( 'Side sidebar', self::TEXT_DOMAIN ),
			'id' => 'elitetrainersite-side-sidebar',
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
		$title = __( 'EliteTrainerSite theme', self::TEXT_DOMAIN );
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
					'elitetrainersite-mindfulness-instances-style',
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
	public static function get_form( $form_id )
	{
		$forms = self::get_forms();

		return JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);
	}

	public static function get_edit_case_form()
	{
		return self::get_form( self::EDIT_REAL_CASE_FORM_INTERNAL_ID );
	}

	public static function get_edit_presencial_plan_form()
	{
		return self::get_form( self::EDIT_PRESENCIAL_PLAN_FORM_INTERNAL_ID );
	}

	public static function get_header_navbar_form()
	{
		$form_id = self::HEADER_NAVBAR_FORM_INTERNAL_ID;

		$forms = self::get_forms();

		return JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);
	}
	

	public static function get_home_cover_form()
	{
		$form_id = self::HOME_COVER_FORM_INTERNAL_ID;

		$forms = self::get_forms();

		return JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);
	}

	public static function get_home_cover_bg_form()
	{
		$form_id = self::HOME_COVER_BG_FORM_INTERNAL_ID;

		$forms = self::get_forms();

		return JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);
	}

	public static function get_home_cover_video_form()
	{
		$form_id = self::HOME_COVER_VIDEO_FORM_INTERNAL_ID;

		$forms = self::get_forms();

		return JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);
	}

	public static function get_main_options_form()
	{
		$form_id = self::MAIN_OPTIONS_FORM_INTERNAL_ID;

		$forms = self::get_forms();

		return JLCCustomForm::get_form(
			$form_id,
			$forms[$form_id]['dir'],
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);
	}

	///////////////////////////////////////
	// TEMPLATES
	///////////////////////////////////////

	public static function print_exercise_filters()
	{
		if( ! class_exists( 'EpointPersonalTrainerMapper', false ) )
			return;

		$categories = EpointPersonalTrainerMapper::get_available_exercise_categories( get_current_user_id(), null, null, 'name', 'ASC' );

		$selected_category = isset( $_COOKIE[self::FILTER_EXERCISE_CATEGORY_COOKIE] ) ? (int)$_COOKIE[self::FILTER_EXERCISE_CATEGORY_COOKIE] : null;

		wp_enqueue_script( 'elitetrainersite-exercise-filters-js', get_template_directory_uri() . '/js/exercises-filters.js', array( 'jquery', 'elitetrainersite-navigation-js' ), self::get_version(), true );
		wp_localize_script(
			'elitetrainersite-exercise-filters-js',
			'EliteTrainerSiteExerciseFiltersNS',
			array(
				'filterExerciseCategoryCookie' => self::FILTER_EXERCISE_CATEGORY_COOKIE
			)
		);

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-filters.php' ) ) );
	}

	public static function print_training_filters()
	{
		if( ! class_exists( 'EpointPersonalTrainerMapper', false ) )
			return;

		$objectives = EpointPersonalTrainerMapper::get_trainer_objectives( get_current_user_id() );
		$environments = EpointPersonalTrainerMapper::get_trainer_environments( get_current_user_id() );

		$selected_objectives = isset( $_COOKIE[self::FILTER_TRAINING_OBJECTIVES_COOKIE] ) ? explode( ',', $_COOKIE[self::FILTER_TRAINING_OBJECTIVES_COOKIE] ) : array();
		$selected_environments = isset( $_COOKIE[self::FILTER_TRAINING_ENVIRONMENTS_COOKIE] ) ? explode( ',', $_COOKIE[self::FILTER_TRAINING_ENVIRONMENTS_COOKIE] ) : array();

		wp_enqueue_script( 'elitetrainersite-training-filters-js', get_template_directory_uri() . '/js/training-filters.js', array( 'jquery', 'elitetrainersite-navigation-js' ), self::get_version(), true );
		wp_localize_script(
			'elitetrainersite-training-filters-js',
			'EliteTrainerSiteTrainingFiltersNS',
			array(
				'filterTrainingObjectivesCookie' => self::FILTER_TRAINING_OBJECTIVES_COOKIE,
				'filterTrainingEnvironmentsCookie' => self::FILTER_TRAINING_ENVIRONMENTS_COOKIE
			)
		);

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'training-filters.php' ) ) );
	}

	public static function print_food_filters()
	{
		if( ! class_exists( 'EpointPersonalTrainerMapper', false ) )
			return;

		$categories = EpointPersonalTrainerMapper::get_blog_food_categories( get_current_blog_id(), null, null, 'name', 'ASC' );

		$selected_category = isset( $_COOKIE[self::FILTER_FOOD_CATEGORY_COOKIE] ) ? (int)$_COOKIE[self::FILTER_FOOD_CATEGORY_COOKIE] : null;
/*
		wp_enqueue_script( 'elitetrainersite-food-filters-js', get_template_directory_uri() . '/js/food-filters.js', array( 'jquery', 'elitetrainersite-navigation-js' ), self::get_version(), true );
		wp_localize_script(
			'elitetrainersite-food-filters-js',
			'EliteTrainerSiteFoodFiltersNS',
			array(
				'filterFoodCategoryCookie' => self::FILTER_FOOD_CATEGORY_COOKIE
			)
		);
*/

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'food-filters.php' ) ) );
	}

	public static function print_diet_filters()
	{
		if( ! class_exists( 'EpointPersonalTrainerMapper', false ) )
			return;

		$user = wp_get_current_user();
		$objectives = EpointPersonalTrainerMapper::get_trainer_diet_objectives( $user->ID );
		$restrictions = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( $user->ID );

		$selected_objectives = array();//isset( $_COOKIE[self::FILTER_TRAINING_OBJECTIVES_COOKIE] ) ? explode( ',', $_COOKIE[self::FILTER_TRAINING_OBJECTIVES_COOKIE] ) : array();
		$selected_restrictions = array();//isset( $_COOKIE[self::FILTER_TRAINING_ENVIRONMENTS_COOKIE] ) ? explode( ',', $_COOKIE[self::FILTER_TRAINING_ENVIRONMENTS_COOKIE] ) : array();
/*
		$categories = EpointPersonalTrainerMapper::get_blog_food_categories( get_current_blog_id(), null, null, 'name', 'ASC' );

		$selected_category = isset( $_COOKIE[self::FILTER_FOOD_CATEGORY_COOKIE] ) ? (int)$_COOKIE[self::FILTER_FOOD_CATEGORY_COOKIE] : null;
*/
/*
		wp_enqueue_script( 'elitetrainersite-food-filters-js', get_template_directory_uri() . '/js/food-filters.js', array( 'jquery', 'elitetrainersite-navigation-js' ), self::get_version(), true );
		wp_localize_script(
			'elitetrainersite-food-filters-js',
			'EliteTrainerSiteFoodFiltersNS',
			array(
				'filterFoodCategoryCookie' => self::FILTER_FOOD_CATEGORY_COOKIE
			)
		);
*/
		wp_enqueue_script( 'elitetrainersite-diet-filters-js', get_template_directory_uri() . '/js/diet-filters.js', array( 'jquery', 'elitetrainersite-navigation-js' ), self::get_version(), true );
		wp_localize_script(
			'elitetrainersite-diet-filters-js',
			'EliteTrainerSiteDietFiltersNS',
			array(
				'filterDietObjectivesCookie' => self::FILTER_DIET_OBJECTIVES_COOKIE,
				'filterDietRestrictionsCookie' => self::FILTER_DIET_RESTRICTIONS_COOKIE
			)
		);

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'diet-filters.php' ) ) );
	}

	///////////////////////////////////////
	// CONFIRMATION
	///////////////////////////////////////

	public static function must_show_duplicate_exercise_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_DUPLICATE_EXERCISE_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_delete_exercise_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_DELETE_EXERCISE_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_edit_exercise_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_EDIT_EXERCISE_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_duplicate_training_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_DUPLICATE_TRAINING_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_delete_training_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_DELETE_TRAINING_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_edit_training_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_EDIT_TRAINING_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_delete_diet_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_DELETE_DIET_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_duplicate_diet_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_DUPLICATE_DIET_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	public static function must_show_edit_diet_confirmation( $user_id = null )
	{
		if( $user_id === null )
			$user_id = get_current_user_id();

		$val = get_user_meta( $user_id, self::SHOW_EDIT_DIET_CONFIRMARTION_KEY, true);
		return $val != 'no';
	}

	///////////////////////////////////////
	// EXERCISE ACTIONS
	///////////////////////////////////////

	public static function confirm_actions()
	{
		$type = sanitize_text_field( $_POST['type'] );
		$value = sanitize_text_field( $_POST['value'] );

		$key = null;

		switch( $type )
		{
			case 'exercise_duplication':
				$key = self::SHOW_DUPLICATE_EXERCISE_CONFIRMARTION_KEY;
				break;
			case 'exercise_deletion':
				$key = self::SHOW_DELETE_EXERCISE_CONFIRMARTION_KEY;
				break;
			case 'exercise_edition':
				$key = self::SHOW_EDIT_EXERCISE_CONFIRMARTION_KEY;
				break;
			case 'training_duplication':
				$key = self::SHOW_DUPLICATE_TRAINING_CONFIRMARTION_KEY;
				break;
			case 'training_deletion':
				$key = self::SHOW_DELETE_TRAINING_CONFIRMARTION_KEY;
				break;
			case 'training_edition':
				$key = self::SHOW_EDIT_TRAINING_CONFIRMARTION_KEY;
				break;
			case 'diet_deletion':
				$key = self::SHOW_DELETE_DIET_CONFIRMARTION_KEY;
				break;
			case 'diet_edition':
				$key = self::SHOW_EDIT_DIET_CONFIRMARTION_KEY;
				break;
			case 'diet_duplication':
				$key = self::SHOW_DUPLICATE_DIET_CONFIRMARTION_KEY;
				break;
			default:
				http_response_code( 500 );
				exit;
		}

		update_user_meta(
			get_current_user_id(),
			$key,
			$value == 'no' ? 'no' : 'yes'
		);

echo get_user_meta( get_current_user_id(), $key, true );
/*
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

	protected static function create_attachment( $filename )
	{
		if( empty( $filename ) || !is_string( $filename ) || !is_readable( $filename ) )
			return null;
			
		$filetype = wp_check_filetype( basename( $filename ), null );
 
		$wp_upload_dir = wp_upload_dir();

		$extra = '';
		do
		{
			$new_filename = $wp_upload_dir['path'] . DIRECTORY_SEPARATOR . $extra . basename( $filename );
			if( !is_int( $extra ) )
				$extra = 0;

			$extra++;
		} while( file_exists( $new_filename ) );

		copy( $filename, $new_filename );
 
		// Prepare an array of post data for the attachment.
		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename( $new_filename ), 
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $new_filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);
		 
		// Insert the attachment.
		$attach_id = wp_insert_attachment( $attachment, $new_filename, $parent_post_id );
		if( !$attach_id )
			return null;
 
		// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		 
		// Generate the metadata for the attachment, and update the database record.
		$attach_data = wp_generate_attachment_metadata( $attach_id, $new_filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return $attach_id;
	}

	public static function duplicate_exercise()
	{
		$exercise_id = (int)$_REQUEST['exercise'];

		$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );

		if( !$exercise )
		{
			wp_redirect( self::get_exercises_list_url() );
			exit;
		}

		$categories = EpointPersonalTrainerMapper::get_exercise_related_categories( $exercise_id, true );
		if( empty( $categories ) )
			$categories = array();

		$image_start = $exercise->image_start;
		$image_end = $exercise->image_end;
		if( !$exercise->trainer && ( $image_start || $image_end ) )
		{
			switch_to_blog( 1 );

			$start_filename = $image_start ? get_attached_file( $image_start ) : null;
			$end_filename = $image_end ? get_attached_file( $image_end ) : null;

			restore_current_blog();

			if( $start_filename )
				$image_start = self::create_attachment( $start_filename );

			if( $end_filename )
				$image_end = self::create_attachment( $end_filename );

		}

		$new_ex = EpointPersonalTrainerMapper::create_exercise(
			$exercise->name,
			$exercise->position,
			$exercise->active,
			$exercise->description,
			$exercise->video,
			$image_start,
			$image_end,
			$categories,//categories
			array(),//corrections
			get_current_user_id()
		);	

		setCookie( self::EXERCISE_TAB_COOKIE, '#my-exercises', time() + 24*60*60*1000, '/' );
		setCookie( self::EXERCISE_LAST_DUPLICATED_COOKIE, $new_ex, time() + 24*60*60*1000, '/' );

		wp_redirect( self::get_exercises_list_url() );
		exit;
	}

	public static function get_available_training_items()
	{
		$trainer_id = get_current_user_id();

		$objective = !empty( $_REQUEST['objective'] ) && is_numeric( $_REQUEST['objective'] ) ? (int)$_REQUEST['objective'] : null;
		$environment = !empty( $_REQUEST['environment'] ) && is_numeric( $_REQUEST['environment'] ) ? (int)$_REQUEST['environment'] : null;

		$training_items = EpointPersonalTrainerMapper::get_unassigned_trainer_available_training_items( $trainer_id, null, null, 'name', 'ASC', $objective, $environment );

		$ret = array();
		foreach( $training_items as $tt )
		{
			$ret[] = array( 'ID' => esc_attr( $tt->ID ), 'name' => esc_attr( $tt->name ) );
		}

		echo json_encode( $ret );
		exit;
	}

	public static function get_available_diet_items()
	{
		$trainer_id = get_current_user_id();

		$objective = !empty( $_REQUEST['objective'] ) && is_numeric( $_REQUEST['objective'] ) ? (int)$_REQUEST['objective'] : null;
		$restriction = !empty( $_REQUEST['restriction'] ) && is_numeric( $_REQUEST['restriction'] ) ? (int)$_REQUEST['restriction'] : null;

		$diet_items = EpointPersonalTrainerMapper::get_unassigned_trainer_available_diet_items( $trainer_id, null, null, 'name', 'ASC', $objective, $restriction );

		$ret = array();
		foreach( $diet_items as $tt )
		{
			$ret[] = array( 'ID' => esc_attr( $tt->ID ), 'name' => esc_attr( $tt->name ) );
		}

		echo json_encode( $ret );
		exit;
	}

	public static function duplicate_training()
	{
		$training_id = (int)$_REQUEST['training'];

		$training = EpointPersonalTrainerMapper::get_training( $training_id );

		if( !$training )
		{
			wp_redirect( self::get_training_list_url() );
			exit;
		}
/*
		$ex_arr = array();
		$exercises = EpointPersonalTrainerMapper::get_training_exercises_data( $training_id );
		foreach( $exercises as $exercise )
		{
			$ex_arr[$exercise->exercise_id] = array(
				'exercise' => $exercise->exercise_id,
				'position' => $exercise->position,
				'description' => $exercise->description,
				'series' => $exercise->series,
				'repetitions' => $exercise->repetitions,
				'loads' => $exercise->loads
			);
		}

		$objectives = EpointPersonalTrainerMapper::get_training_objectives( $training_id );
		foreach( $objectives as $objective )
		{
			$ex_arr[$objective->objective_id] = array(
				'objective' => $objective->objective_id
			);
		}

		$environments = EpointPersonalTrainerMapper::get_training_environments( $training_id );
		foreach( $environments as $environment )
		{
			$ex_arr[$environment->environment_id] = array(
				'environment' => $environment->environment_id
			);
		}

		$new_training_id = EpointPersonalTrainerMapper::create_training(
			$training->name,
			$training->position,
			$training->active,
			$training->description,
			$training->start,
			$training->end,
			null,//$training->user,//$user
			get_current_user_id(),
			$ex_arr,//array()//$exercises
			$objectives,
			$environments
		);
*/
		//$new_training_id = EpointPersonalTrainerMapper::duplicate_training( $training_id, get_current_user_id() );
		$new_training_id = EpointPersonalTrainerMapper::duplicate_training( $training_id, get_current_user_id(), null );
		$new_training = EpointPersonalTrainerMapper::get_training( $new_training_id );

		if( $new_training && !empty( $_REQUEST['after'] ) && $_REQUEST['after'] == 'edit' )
		{
			wp_redirect( self::get_edit_training_url( $new_training_id ) );
		}
		else
		{
			setCookie( self::TRAINING_TAB_COOKIE, $new_training->user ? '#user-training' : '#my-training-templates', time() + 24*60*60*1000, '/' );
			setCookie( self::TRAINING_LAST_DUPLICATED_COOKIE, $new_training_id, time() + 24*60*60*1000, '/' );

			wp_redirect( self::get_training_list_url() );
		}
		exit;
	}

	public static function assign_training()
	{
		$training_id = (int)$_REQUEST['training'];
		$member_id = (int)$_REQUEST['member'];
		$start = $_REQUEST['start'];
		$end = $_REQUEST['end'];

		$training = EpointPersonalTrainerMapper::get_training( $training_id );
		$member = get_user_by( 'id', $member_id );

		if( !$training || !$member || !$start || !$end )
		{
			http_response_code( 500 );
			exit;
		}
/*
		$ex_arr = array();
		$exercises = EpointPersonalTrainerMapper::get_training_exercises_data( $training_id );
		foreach( $exercises as $exercise )
		{
			$ex_arr[$exercise->exercise_id] = array(
				'exercise' => $exercise->exercise_id,
				'position' => $exercise->position,
				'description' => $exercise->description,
				'series' => $exercise->series,
				'repetitions' => $exercise->repetitions,
				'loads' => $exercise->loads
			);
		}

		$new_training_id = EpointPersonalTrainerMapper::create_training(
			$training->name,
			$training->position,
			$training->active,
			$training->description,
			date( 'Y-m-d', strtotime( $start ) ),
			date( 'Y-m-d', strtotime( $end ) ),
			$member_id,//$user
			get_current_user_id(),
			$ex_arr//array()//$exercises
		);
*/
		$new_training_id = EpointPersonalTrainerMapper::duplicate_training(
			$training_id, 
			get_current_user_id(),
			$member_id,
			date( 'Y-m-d', strtotime( $start ) ),
			date( 'Y-m-d', strtotime( $end ) )
		);

		$tt = EpointPersonalTrainerMapper::get_training( $new_training_id );
		if( !$tt )
		{
			http_response_code( 500 );
			exit;
		}

		$observations = !empty( $_REQUEST['observations'] ) ? sanitize_textarea_field( $_REQUEST['observations'] ) : null;
		$video = !empty( $_REQUEST['video'] ) ? sanitize_textarea_field( $_REQUEST['video'] ) : null;
		EpointPersonalTrainerMapper::set_training_observations( $new_training_id, $observations );
		EpointPersonalTrainerMapper::set_training_video( $new_training_id, $video );

		if( class_exists( 'EpointPersonalTrainerAlerts', false ) )
		{
			$send_alert = EpointPersonalTrainerAlerts::must_sent_member_new_training_alert();

			if( $send_alert )
			{
				$member = get_user_by( 'ID', $member_id );
				if( $member )
				{
					$sent = EpointPersonalTrainerAlerts::send_member_new_training_alert( $member->user_email, $member->display_name, $tt );
				}
			}
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

		exit;
	}

	public static function create_and_assign_training()
	{
		//$training_id = (int)$_REQUEST['training'];
		$member_id = (int)$_REQUEST['member'];
		$start = $_REQUEST['start'];
		$end = $_REQUEST['end'];

		//$training = EpointPersonalTrainerMapper::get_training( $training_id );
		$member = get_user_by( 'id', $member_id );

		if( !$member || !$start || !$end )
		{
			http_response_code( 500 );
			exit;
		}

		$objectives = !empty( $_REQUEST['objectives'] ) ? $_REQUEST['objectives'] : array();
		$environments = !empty( $_REQUEST['environments'] ) ? $_REQUEST['environments'] : array();

		$objectives_arr = array();
		foreach( $objectives as $ob )
			$objectives_arr[(int)$ob] = (int)$ob;

		$environments_arr = array();
		foreach( $environments as $ob )
			$environments_arr[(int)$ob] = (int)$ob;

		$exercises = !empty( $_REQUEST['exercises'] ) ? $_REQUEST['exercises'] : array();

		$name = !empty( $_REQUEST['name'] ) ? sanitize_text_field( $_REQUEST['name'] ) : '';
		$observations = !empty( $_REQUEST['observations'] ) ? stripslashes( sanitize_textarea_field( $_REQUEST['observations'] ) ) : '';
		$video = !empty( $_REQUEST['video'] ) ? sanitize_text_field( $_REQUEST['video'] ) : '';

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

		$new_training_id = EpointPersonalTrainerMapper::create_training(
			$name,
			1,//position
			1,//active
			'',//$description,
			date( 'Y-m-d', strtotime( $start ) ),
			date( 'Y-m-d', strtotime( $end ) ),
			$member_id,//$user
			get_current_user_id(),
			$ex_arr,//array()//$exercises,
			$objectives_arr,
			$environments_arr,
			$observations
		);
/*
		$new_training_id = EpointPersonalTrainerMapper::duplicate_training(
			$training_id, 
			get_current_user_id(),
			$member_id,
			date( 'Y-m-d', strtotime( $start ) ),
			date( 'Y-m-d', strtotime( $end ) )
		);
*/

		$tt = EpointPersonalTrainerMapper::get_training( $new_training_id );
		if( !$tt )
		{
			http_response_code( 500 );
			exit;
		}
		EpointPersonalTrainerMapper::set_training_video( $new_training_id, $video );

		if( class_exists( 'EpointPersonalTrainerAlerts', false ) )
		{
			$send_alert = EpointPersonalTrainerAlerts::must_sent_member_new_training_alert();

			if( $send_alert )
			{
				$member = get_user_by( 'ID', $member_id );
				if( $member )
				{
					$sent = EpointPersonalTrainerAlerts::send_member_new_training_alert( $member->user_email, $member->display_name, $tt );
				}
			}
		}

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

		exit;
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
		$observations = !empty( $_REQUEST['observations'] ) ? sanitize_textarea_field( $_REQUEST['observations'] ) : '';
		$observations = preg_replace( '/\\\\"/', '"', $observations );
		$observations = preg_replace( "/\\\\'/", "'", $observations );
		$video = !empty( $_REQUEST['video'] ) ? $_REQUEST['video'] : '';

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


		$duplicate_training = !empty( $_REQUEST['duplicate'] ) && $_REQUEST['duplicate'] == 'yes';

		if( $duplicate_training )
		{
			$duplicated_training_id = EpointPersonalTrainerMapper::create_training(
				$name,
				1,//position
				1,//active
				'',//$description,
				null,//date( 'Y-m-d', strtotime( $start ) ),
				null,//date( 'Y-m-d', strtotime( $end ) ),
				null,//$member_id,//$user
				get_current_user_id(),
				$ex_arr,//array()//$exercises,
				$objectives_arr,
				$environments_arr,
				$observations
			);

			if( !$duplicated_training_id )
			{
				http_response_code( 500 );
				exit;
			}

			EpointPersonalTrainerMapper::set_training_observations( $duplicated_training_id, $observations );
			EpointPersonalTrainerMapper::set_training_video( $duplicated_training_id, $video );
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
				get_current_user_id(),
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

			EpointPersonalTrainerMapper::set_training_video( $new_training_id, $video );

			//setCookie( 'updated-training', 'created', time() + 60, '/' );
			

			if( $member &&
				!empty( $_COOKIE[EliteTrainerSiteTheme::LAST_PAGE_COOKIE] ) &&
				$_COOKIE[EliteTrainerSiteTheme::LAST_PAGE_COOKIE] === 'view-member-training' )
			{
				echo json_encode( array( 'redirect' => EliteTrainerSiteTheme::get_view_member_training_url( $member->ID ) ) );
			}
			else
			{
				setCookie( EliteTrainerSiteTheme::TRAINING_TAB_COOKIE, $tt->user ? '#user-training' : '#my-training-templates', time() + 24*60*60*1000, '/' );
				setCookie( EliteTrainerSiteTheme::TRAINING_LAST_DUPLICATED_COOKIE, $tt->ID, time() + 24*60*60*1000, '/' );
				echo json_encode( array( 'redirect' => EliteTrainerSiteTheme::get_training_list_url() ) );
			}
			exit;
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
				$tt->start,
				$tt->end,
				$tt->user,//$member_id,//$user
				get_current_user_id(),
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
			EpointPersonalTrainerMapper::set_training_video( $training_id, $video );

			
			if( $member &&
				!empty( $_COOKIE[EliteTrainerSiteTheme::LAST_PAGE_COOKIE] ) &&
				$_COOKIE[EliteTrainerSiteTheme::LAST_PAGE_COOKIE] === 'view-member-training' )
			{
				echo json_encode( array( 'redirect' => EliteTrainerSiteTheme::get_view_member_training_url( $member->ID ) ) );
			}
			else
			{
				setCookie( 'updated-training', 'updated', time() + 60, '/' );

				setCookie( EliteTrainerSiteTheme::TRAINING_TAB_COOKIE, $tt->user ? '#user-training' : '#my-training-templates', time() + 24*60*60*1000, '/' );
				setCookie( EliteTrainerSiteTheme::TRAINING_LAST_DUPLICATED_COOKIE, $tt->ID, time() + 24*60*60*1000, '/' );
				echo json_encode( array( 'redirect' => EliteTrainerSiteTheme::get_training_list_url() ) );
			}
			exit;
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

	public static function delete_exercise()
	{
		$exercise_id = (int)$_REQUEST['exercise'];

		$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );

		if( !$exercise || !$exercise->trainer || $exercise->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_exercises_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_exercise( $exercise_id );

		wp_redirect( self::get_exercises_list_url() );
		exit;
	}

	public static function delete_exercise_category()
	{
		$cat_id = (int)$_REQUEST['category'];

		$category = EpointPersonalTrainerMapper::get_exercise_category( $cat_id );

		if( !$category || !$category->trainer || $category->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_exercises_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_exercise_category( $cat_id, true );

		wp_redirect( self::get_exercises_list_url() );
		exit;
	}

	public static function hide_training()
	{
		$training_id = (int)$_REQUEST['training'];

		$training = EpointPersonalTrainerMapper::get_training( $training_id );

		if( !$training || !$training->trainer || $training->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_training_list_url() );
			exit;
		}

		$is_active = EpointPersonalTrainerMapper::is_training_active( $training_id );
		EpointPersonalTrainerMapper::set_training_active( $training_id, !$is_active );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( self::get_training_list_url() );
		exit;
	}

	public static function delete_training()
	{
		$training_id = (int)$_REQUEST['training'];

		$training = EpointPersonalTrainerMapper::get_training( $training_id );

		if( !$training || !$training->trainer || $training->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_training_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_training( $training_id );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( self::get_training_list_url() );
		exit;
	}

	public static function delete_objective()
	{
		$objective_id = (int)$_REQUEST['objective'];

		$objective = EpointPersonalTrainerMapper::get_objective( $objective_id );

		if( !$objective || !$objective->trainer || $objective->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_objectives_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_objective( $objective_id );

		wp_redirect( self::get_objectives_list_url() );
		exit;
	}

	public static function delete_environment()
	{
		$environment_id = (int)$_REQUEST['environment'];

		$environment = EpointPersonalTrainerMapper::get_environment( $environment_id );

		if( !$environment || !$environment->trainer || $environment->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_objectives_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_environment( $environment_id );

		wp_redirect( self::get_objectives_list_url() );
		exit;
	}

	public static function delete_food_category()
	{
		$cat_id = (int)$_REQUEST['category'];

		$category = EpointPersonalTrainerMapper::get_food_category( $cat_id );

		if( !$category || !$category->trainer || $category->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_food_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_food_category( $cat_id );

		wp_redirect( self::get_food_list_url() );
		exit;
	}

	public static function delete_food()
	{
		$food_id = (int)$_REQUEST['food'];

		$food = EpointPersonalTrainerMapper::get_food( $food_id );

		if( !$food || !$food->trainer || $food->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_food_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_food( $food_id );

		wp_redirect( self::get_food_list_url() );
		exit;
	}

	public static function delete_diet_objective()
	{
		$objective_id = (int)$_REQUEST['objective'];

		$objective = EpointPersonalTrainerMapper::get_diet_objective( $objective_id );

		if( !$objective || !$objective->trainer || $objective->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_diet_objectives_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_diet_objective( $objective_id );

		wp_redirect( self::get_diet_objectives_list_url() );
		exit;
	}

	public static function delete_diet_restriction()
	{
		$restriction_id = (int)$_REQUEST['restriction'];

		$restriction = EpointPersonalTrainerMapper::get_diet_restriction( $restriction_id );

		if( !$restriction || !$restriction->trainer || $restriction->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_diet_objectives_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_diet_restriction( $restriction_id );

		wp_redirect( self::get_diet_objectives_list_url() );
		exit;
	}

	public static function duplicate_diet()
	{
		$diet_id = (int)$_REQUEST['diet'];

		$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );

		if( !$diet )
		{
			wp_redirect( self::get_diets_list_url() );
			exit;
		}

		// Duplicar tal cual, asignando solo el entrenador actual
		//$new_diet_id = EpointPersonalTrainerMapper::duplicate_diet( $diet_id, get_current_user_id() );

		// Duplicar quitando el usuario
		$new_diet_id = EpointPersonalTrainerMapper::duplicate_diet( $diet_id, get_current_user_id(), null );

		$new_diet = EpointPersonalTrainerMapper::get_diet( $new_diet_id );

		if( $new_diet && !empty( $_REQUEST['after'] ) && $_REQUEST['after'] == 'edit' )
		{
			wp_redirect( self::get_edit_diet_url( $new_diet_id ) );
		}
		else
		{
			setCookie( self::DIET_TAB_COOKIE, $new_diet->user ? '#user-diets' : '#my-diets-templates', time() + 24*60*60*1000, '/' );
			setCookie( self::DIET_LAST_DUPLICATED_COOKIE, $new_diet_id, time() + 24*60*60*1000, '/' );

			wp_redirect( self::get_diets_list_url() );
		}

		exit;
	}

	public static function hide_diet()
	{
		$diet_id = (int)$_REQUEST['diet'];

		$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );

		if( !$diet || !$diet->trainer || $diet->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_diets_list_url() );
			exit;
		}

		$is_active = !empty( $diet->active );
		EpointPersonalTrainerMapper::set_diet_active( $diet_id, !$is_active );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( self::get_diets_list_url() );
		exit;
	}

	public static function delete_diet()
	{
		$diet_id = (int)$_REQUEST['diet'];

		$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );

		if( !$diet || !$diet->trainer || $diet->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_diets_list_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_diet( $diet_id );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( self::get_diets_list_url() );
		exit;
	}

	public static function assign_diet()
	{
		$diet_id = (int)$_REQUEST['diet'];
		$member_id = (int)$_REQUEST['member'];
		$start = $_REQUEST['start'];
		$end = $_REQUEST['end'];

		$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );
		$member = get_user_by( 'id', $member_id );

		if( !$diet || !$member || !$start || !$end )
		{
			http_response_code( 500 );
			exit;
		}

		$new_diet_id = EpointPersonalTrainerMapper::duplicate_diet(
			$diet_id, 
			get_current_user_id(),
			$member_id,
			date( 'Y-m-d', strtotime( $start ) ),
			date( 'Y-m-d', strtotime( $end ) )
		);

		$tt = EpointPersonalTrainerMapper::get_diet( $new_diet_id );
		if( !$tt )
		{
			http_response_code( 500 );
			exit;
		}

		$observations = !empty( $_REQUEST['observations'] ) ? sanitize_textarea_field( $_REQUEST['observations'] ) : null;
		
		EpointPersonalTrainerMapper::set_diet_observations( $new_diet_id, $observations );
		//EpointPersonalTrainerMapper::set_training_observations( $new_training_id, $observations );



		//$objectives = EpointPersonalTrainerMapper::get_trainer_objectives( get_current_user_id() );
		//$environments = EpointPersonalTrainerMapper::get_trainer_environments( get_current_user_id() );

		if( class_exists( 'EpointPersonalTrainerAlerts', false ) )
		{
			$send_alert = EpointPersonalTrainerAlerts::must_sent_member_new_diet_alert();

			if( $send_alert )
			{
				$member = get_user_by( 'ID', $member_id );
				if( $member )
				{
					$sent = EpointPersonalTrainerAlerts::send_member_new_diet_alert( $member->user_email, $member->display_name, $tt );
				}
			}
		}
/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'assigned-training-row.php' ) ) );
		$row = ob_get_clean();
*/
		set_transient( 'assign_diet_msg_' . get_current_user_id(), 'Dieta asignada correctamente', 10 );

		$response = new WP_Ajax_Response( array(
			'what' => 'html',
			'action' => 'append',
			'id' => 1,
			'data' => ''//$row
		) );
		$response->send();

		exit;
	}

	public static function get_diet_preview()
	{
		$diet_id = (int)$_REQUEST['diet'];

		$diet = EpointPersonalTrainerMapper::get_diet( $diet_id );

		if( !$diet )
		{
			http_response_code( 500 );
			exit;
		}

		$objectives_names = EpointPersonalTrainerMapper::get_diet_objectives_names( $diet->ID );
		$restrictions_names = EpointPersonalTrainerMapper::get_diet_restrictions_names( $diet->ID );

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'diet-preview.php' ) ) );

		exit;
	}

	public static function get_training_preview()
	{
		$training_id = (int)$_REQUEST['training'];

		$training = EpointPersonalTrainerMapper::get_training( $training_id );

		if( !$training )
		{
			http_response_code( 500 );
			exit;
		}

		$objectives_names = EpointPersonalTrainerMapper::get_training_objectives_names( $training->ID );
		$environments_names = EpointPersonalTrainerMapper::get_training_environments_names( $training->ID );

		$exercise_categories = EpointPersonalTrainer::get_training_exercises_categorized( $training->ID );

		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'training-preview.php' ) ) );

		exit;
	}

	public static function delete_evolution_magnitude()
	{
		$magnitude_id = (int)$_REQUEST['magnitude'];

		$magnitude = EpointPersonalTrainerMapper::get_evolution_magnitude( $magnitude_id );

		if( !$magnitude || !$magnitude->trainer || $magnitude->trainer != get_current_user_id() )
		{
			wp_redirect( self::get_creation_zone_url() );
			exit;
		}

		EpointPersonalTrainerMapper::delete_evolution_magnitude( $magnitude_id );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( self::get_creation_zone_url() );
		exit;
	}

	public static function delete_real_case()
	{
		$case_id = (int)$_REQUEST['case'];

		wp_delete_post( $case_id, true );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( get_site_url() );
		exit;
	}

	public static function skip_corporal_measures_form()
	{
		update_user_meta( get_current_user_id(), 'personal_trainer_corporal_measures_set', 'yes' );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( get_site_url() );
		exit;
	}

	public static function skip_evolution_photos_form()
	{
		update_user_meta( get_current_user_id(), 'personal_trainer_evolution_photos_set', 'yes' );

		if( !empty( $_SERVER['HTTP_REFERER'] ) )
			wp_redirect( $_SERVER['HTTP_REFERER'] );
		else
			wp_redirect( get_site_url() );
		exit;
	}


}

// mark.mordvin@epoint.es
function enqueue_tinymce_scripts() {
    if (!is_admin()) { // Ensure it's loaded on frontend pages, not admin
        wp_enqueue_script('wp-tinymce');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_tinymce_scripts');

function fix_tinymce_code_plugin_path($init) {
    $init['external_plugins'] = json_encode(array(
        'code' => includes_url('js/tinymce/tinymce.min.js'), // Correct path to the code plugin
    ));
    return $init;
}
add_filter('tiny_mce_before_init', 'fix_tinymce_code_plugin_path');

function remove_broken_tinymce_plugins($init) {
    if (!empty($init['plugins'])) {
        $init['plugins'] = str_replace('code', '', $init['plugins']); // Remove broken 'code' reference
    }
    return $init;
}
add_filter('tiny_mce_before_init', 'remove_broken_tinymce_plugins');


EliteTrainerSiteTheme::initialize();


