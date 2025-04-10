<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

body.page-view-member-training .user-training-col .training-row
{
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_user_training_font_family(); ?>';
}

<?php
$color1 = EliteTrainerSiteThemeCustomizer::get_user_training_color_1();
$color2 = EliteTrainerSiteThemeCustomizer::get_user_training_color_2();
$color3 = EliteTrainerSiteThemeCustomizer::get_user_training_color_3();
$color4 = EliteTrainerSiteThemeCustomizer::get_user_training_color_4();
?>

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body.page-view-member-training .user-training-col .training-row .training-col .training-col-content', EliteTrainerSiteThemeCustomizer::get_user_training_bg_1(), false ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body.page-view-member-training .user-training-col .training-row .training-info-col .training-info-col-content', EliteTrainerSiteThemeCustomizer::get_user_training_bg_2(), false ); ?>
<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body.page-view-member-training .page-content .training-row .training-col .training-col-content', EliteTrainerSiteThemeCustomizer::get_user_training_bg_1(), false ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body.page-view-member-training .page-content .training-row .training-info-col .training-info-col-content', EliteTrainerSiteThemeCustomizer::get_user_training_bg_2(), false ); ?>

body.page-view-member-training .user-training-col .training-row .training-col .training-col-content,
body.page-view-member-training .page-content .training-row .training-col .training-col-content
{
	color:<?php echo $color1; ?>;
}

body.page-view-member-training .user-training-col .training-row .training-col .training-col-content .date,
body.page-view-member-training .page-content .training-row .training-col .training-col-content .date
{
	color:<?php echo $color3; ?>;
}

body.page-view-member-training .user-training-col .training-row .training-col a,
body.page-view-member-training .user-training-col .training-row .training-col a:hover,
body.page-view-member-training .page-content .training-row .training-col a,
body.page-view-member-training .page-content .training-row .training-col a:hover
{
	text-decoration:none;
}

body.page-view-member-training .user-training-col .training-row .training-info-col .training-info-col-content,
body.page-view-member-training .page-content .training-row .training-info-col .training-info-col-content
{
	color:<?php echo $color4; ?>;
}

body.page-view-member-training .user-training-col .training-row .training-info-col .training-info-col-content hr,
body.page-view-member-training .page-content .training-row .training-info-col .training-info-col-content hr
{
	background-color:<?php echo $color4; ?>;
}

body.page-view-member-training .user-training-col .training-row .training-col.training-info-col .training-info-col-content .actions .training-button,
body.page-view-member-training .page-content .training-row .training-col.training-info-col .training-info-col-content .actions .training-button
{
	background-color:<?php echo $color4; ?>;
	color:<?php echo $color3; ?>;
}
body.page-view-member-training .user-training-col .training-row .training-col.training-info-col .training-info-col-content .actions .training-button:hover,
body.page-view-member-training .page-content .training-row .training-col.training-info-col .training-info-col-content .actions .training-button:hover
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::color_luminance( $color3, .1 ); ?>;
}

body.page-view-member-training .user-training-col .training-row .training-col.training-info-col .training-info-col-content .exercises .btn-primary,
body.page-view-member-training .page-content .training-row .training-col.training-info-col .training-info-col-content .exercises .btn-primary
{
	background-color:<?php echo $color4; ?>;
	color:<?php echo $color3; ?>;
	background-image:none;
	border:0;
}
