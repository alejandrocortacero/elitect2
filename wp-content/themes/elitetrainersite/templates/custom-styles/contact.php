<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

.contact-container > .row {
/*
    background-color: <?php echo $main_color; ?>;
    background-image: -webkit-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $main_color_darker; ?> 100%);
    background-image: -o-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $main_color_darker; ?> 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,from(<?php echo $main_color; ?>),to(<?php echo $main_color_darker; ?>));
    background-image: linear-gradient(to bottom,<?php echo $main_color; ?> 0,<?php echo $main_color_darker; ?> 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $main_color; ?>', endColorstr='<?php echo $main_color_darker; ?>', GradientType=0);
    background-repeat: repeat-x;
*/
}

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.contact-container > .row', EliteTrainerSiteThemeCustomizer::get_footer_contact_form_bg(), false ); ?>

.contact-container > .row {
	color: <?php echo EliteTrainerSiteThemeCustomizer::get_footer_contact_form_text_color(); ?>;
	font-size: <?php echo EliteTrainerSiteThemeCustomizer::get_footer_contact_form_font_size(); ?>px;
	font-family: '<?php echo EliteTrainerSiteThemeCustomizer::get_footer_contact_form_font_family(); ?>';
}
.contact-container .tel {
	color: <?php echo EliteTrainerSiteThemeCustomizer::get_footer_contact_form_text_color(); ?>;
}
.contact-container .tel a {
	color: <?php echo EliteTrainerSiteThemeCustomizer::color_luminance( EliteTrainerSiteThemeCustomizer::get_footer_contact_form_text_color(), .2 ); ?>;
	font-weight:bold;
}
.contact-container form label
{
	color: <?php echo EliteTrainerSiteThemeCustomizer::get_footer_contact_form_text_color(); ?>;
}

<?php EliteTrainerSiteThemeCustomizer::print_custom_button_style( 'contact', '.contact-container .link a' ); ?>
/*
.contact-container .tel a
{
	color: <?php echo $secondary_color; ?>;
}
.contact-container .tel a:hover
{
	color: <?php echo $secondary_color_darker; ?>;
}
*/
