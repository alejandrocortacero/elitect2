<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'presencialplanpagetitle',
	'.page-header-video-presencialheadervideo .title-row h1',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	36,//default_font_size
	null//default_font_family
); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'presencialplanpagesubtitle',
	'.page-header-video-presencialheadervideo .title-row h2',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	26,//default_font_size
	null//default_font_family
); ?>

.presencial-table-head
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_table_head_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_table_head_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_table_head_font_family(); ?>';
}
