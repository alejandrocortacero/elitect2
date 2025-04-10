<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );

$submenu_color = EliteTrainerSiteThemeCustomizer::get_submenu_text_color();
$submenu_fontsize = EliteTrainerSiteThemeCustomizer::get_submenu_font_size();
$submenu_fontfamily = EliteTrainerSiteThemeCustomizer::get_submenu_font_family();

$submenu_bg = EliteTrainerSiteThemeCustomizer::get_submenu_bg();

$submenu2_color = EliteTrainerSiteThemeCustomizer::get_submenu2_text_color();
$submenu2_fontsize = EliteTrainerSiteThemeCustomizer::get_submenu2_font_size();
$submenu2_fontfamily = EliteTrainerSiteThemeCustomizer::get_submenu2_font_family();

$submenu2_bg = EliteTrainerSiteThemeCustomizer::get_submenu2_bg();
?>

.header-separator
{
	width:100%;
	height:20px;
	//background-color:<?php echo EliteTrainerSiteThemeCustomizer::get_header_bg_color(); ?>;
}
<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.header-separator', EliteTrainerSiteThemeCustomizer::get_header_bg(), false ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.submenu-navbar > .container-fluid .two-links-row .my-profile-col', $submenu_bg ); ?>
<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.submenu-navbar > .container .two-links-row .my-profile-col', $submenu_bg ); ?>

.submenu-navbar > .container-fluid .two-links-row .my-profile-col a,
.submenu-navbar > .container .two-links-row .my-profile-col a {
	color: <?php echo $submenu_color; ?>;
	font-size: <?php echo $submenu_fontsize; ?>px;
	font-family: '<?php echo $submenu_fontfamily; ?>';
}

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.submenu-navbar > .container-fluid .two-links-row .call-you-col', $submenu2_bg ); ?>
<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.submenu-navbar > .container .two-links-row .call-you-col', $submenu2_bg ); ?>

.submenu-navbar > .container-fluid .two-links-row .call-you-col a,
.submenu-navbar > .container .two-links-row .call-you-col a {
	color: <?php echo $submenu2_color; ?>;
	font-size: <?php echo $submenu2_fontsize; ?>px;
	font-family: '<?php echo $submenu2_fontfamily; ?>';
}

.user-navbar > .container .user-menu-col .user-links .user-menu-button
{
	color: <?php echo $secondary_color_darker; ?>;
    background-color: <?php echo $secondary_color; ?>;
}
.user-navbar > .container .user-menu-col .user-links .user-menu-button:hover
{
	color: <?php echo $secondary_color; ?>;
    background-color: <?php echo $secondary_color_darker; ?>;
}

.user-navbar > .container .user-menu-col .we-call-you-layer
{
    background-color: <?php echo $main_color; ?>;
}
.user-navbar > .container .user-menu-col .we-call-you-layer:hover
{
    background-color: <?php echo $main_color_darker; ?>;
}
