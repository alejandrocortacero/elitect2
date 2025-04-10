<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'realcasestitle',
	'.cases-container .title-row h2',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	32,//default_font_size
	null//default_font_family
); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_button_style( 'morecaseslink', '.more-cases-container .more-cases-link' ); ?>
