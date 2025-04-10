<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

body.page-view-member-diets .user-diets-col .diet-row
{
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_user_diets_font_family(); ?>';
}

<?php
$color1 = EliteTrainerSiteThemeCustomizer::get_user_diets_color_1();
$color2 = EliteTrainerSiteThemeCustomizer::get_user_diets_color_2();
$color3 = EliteTrainerSiteThemeCustomizer::get_user_diets_color_3();
$color4 = EliteTrainerSiteThemeCustomizer::get_user_diets_color_4();
?>

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body.page-view-member-diets .user-diets-col .diet-row .diet-col .diet-col-content', EliteTrainerSiteThemeCustomizer::get_user_diets_bg_1(), false ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body.page-view-member-diets .user-diets-col .diet-row .diet-info-col .diet-info-col-content', EliteTrainerSiteThemeCustomizer::get_user_diets_bg_2(), false ); ?>

body.page-view-member-diets .user-diets-col .diet-row .diet-col .diet-col-content
{
	color:<?php echo $color1; ?>;
}

body.page-view-member-diets .user-diets-col .diet-row .diet-col .diet-col-content .date
{
	color:<?php echo $color3; ?>;
}

body.page-view-member-diets .user-diets-col .diet-row .diet-col a,
body.page-view-member-diets .user-diets-col .diet-row .diet-col a:hover
{
	text-decoration:none;
}

body.page-view-member-diets .user-diets-col .diet-row .diet-info-col .diet-info-col-content
{
	color:<?php echo $color4; ?>;
}

body.page-view-member-diets .user-diets-col .diet-row .diet-info-col .diet-info-col-content hr
{
	background-color:<?php echo $color4; ?>;
}

body.page-view-member-diets .user-diets-col .diet-row .diet-col.diet-info-col .diet-info-col-content .actions .diet-button
{
	background-color:<?php echo $color4; ?>;
	color:<?php echo $color3; ?>;
}
body.page-view-member-diets .user-diets-col .diet-row .diet-col.diet-info-col .diet-info-col-content .actions .diet-button:hover
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::color_luminance( $color3, .1 ); ?>;
}
