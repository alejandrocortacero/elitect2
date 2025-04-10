<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'archiverealcasestitle',
	'.archive-cases-container .title-row h1',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	36,//default_font_size
	null//default_font_family
); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'realcasesvideosubtitle',
	'.archive-cases-container .title-row h2',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	30,//default_font_size
	null//default_font_family
); ?>
.archive-cases-container .title-row h2
{
	position:relative;
}
