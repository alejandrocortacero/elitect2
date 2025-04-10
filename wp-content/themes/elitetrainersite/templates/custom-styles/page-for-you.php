<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

.for-you-container
{
	margin-bottom:40px;
}

.for-you-container h1
{
	margin-top:40px;
	margin-bottom:30px;
}

.for-you-container h2.section-title
{
	position:relative;
}
.for-you-container .section-text
{
	position:relative;
}

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'foryoupagetitle',
	'.for-you-container .for-you-title-col h1',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	36,//default_font_size
	null//default_font_family
); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'foryoupagesection1title',
	'.for-you-container .for-you-section-1-col h2.section-title',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	30,//default_font_size
	null//default_font_family
); ?>


<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'foryoupagesection2title',
	'.for-you-container .for-you-section-2-col h2.section-title',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	30,//default_font_size
	null//default_font_family
); ?>


<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'foryoupagesection3title',
	'.for-you-container .for-you-section-3-col h2.section-title',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	30,//default_font_size
	null//default_font_family
); ?>


<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'foryoupagesection4title',
	'.for-you-container .for-you-section-4-col h2.section-title',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	30,//default_font_size
	null//default_font_family
); ?>


<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'foryoupagesection5title',
	'.for-you-container .for-you-section-5-col h2.section-title',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	30,//default_font_size
	null//default_font_family
); ?>

