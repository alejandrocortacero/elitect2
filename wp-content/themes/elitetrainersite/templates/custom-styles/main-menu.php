<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );
$main_menu_type_bg = EliteTrainerSiteThemeCustomizer::get_main_menu_type_bg();
$main_menu_color_bg = EliteTrainerSiteThemeCustomizer::get_main_menu_color_bg();
$main_menu_color_bg_1 = EliteTrainerSiteThemeCustomizer::get_main_menu_color_bg( 1 );

$hide_main_menu_on_desktop = EliteTrainerSiteThemeCustomizer::must_hide_main_menu_on_desktop();
 ?>

#navigation-links-bar
{
	background-color:<?php echo $main_menu_color_bg; ?>;
	<?php if( $main_menu_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $main_menu_color_bg; ?> 0, <?php echo $main_menu_color_bg_1; ?> 100%);
	<?php elseif( $main_menu_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $main_menu_color_bg; ?> 0, <?php echo $main_menu_color_bg_1; ?> 100%);
	<?php endif; ?>
}

<?php if( $hide_main_menu_on_desktop ) : ?>
@media (min-width:768px)
{
	#navigation-links-bar
	{
		display:none !important;
	}
	#navigation-links-bar.in
	{
		display:block !important;
	}
}
<?php endif; ?>

#navigation-links-bar a
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_main_menu_text_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_main_menu_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_main_menu_font_family(); ?>';
}
#navigation-links-bar a:hover
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::color_luminance ( EliteTrainerSiteThemeCustomizer::get_main_menu_text_color(), -.1 ); ?>;
}
#navigation-links-bar a:active, #navigation-links-bar a:focus
{
	background-color:transparent;
}


#navigation-links-bar .dropdown .dropdown-menu
{
	background-color:<?php echo $main_menu_color_bg; ?>;
	<?php if( $main_menu_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $main_menu_color_bg; ?> 0, <?php echo $main_menu_color_bg_1; ?> 100%);
	<?php elseif( $main_menu_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $main_menu_color_bg; ?> 0, <?php echo $main_menu_color_bg_1; ?> 100%);
	<?php endif; ?>
}
#navigation-links-bar .dropdown .dropdown-menu a
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_main_menu_text_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_main_menu_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_main_menu_font_family(); ?>';
}
