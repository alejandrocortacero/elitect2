<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
$link_type_bg = EliteTrainerSiteThemeCustomizer::get_button_type_bg( $button, $default_bg );
$link_color_bg = EliteTrainerSiteThemeCustomizer::get_button_color_bg( $button, 0, $default_bg );
$link_color_bg_opacity = EliteTrainerSiteThemeCustomizer::get_button_opacity_bg( $button, 0, $default_bg );
$link_color_bg_1 = EliteTrainerSiteThemeCustomizer::get_button_color_bg( $button, 1, $default_bg );
$link_color_bg_opacity_1 = EliteTrainerSiteThemeCustomizer::get_button_opacity_bg( $button, 1, $default_bg );
$link_color_bg_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $link_color_bg, -.3 );
$link_color_bg_1_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $link_color_bg_1, -.3 );
$link_color = EliteTrainerSiteThemeCustomizer::get_button_color( $button, $default_color );
$link_font_size = EliteTrainerSiteThemeCustomizer::get_button_font_size( $button, $default_font_size );
$link_font_family = EliteTrainerSiteThemeCustomizer::get_button_font_family( $button, $default_font_family );

$link_color_bg = EliteTrainerSiteThemeCustomizer::rgba_color( $link_color_bg, $link_color_bg_opacity );
$link_color_bg_1 = EliteTrainerSiteThemeCustomizer::rgba_color( $link_color_bg_1, $link_color_bg_opacity_1 );
$link_color_bg_dark = EliteTrainerSiteThemeCustomizer::rgba_color( $link_color_bg_dark, $link_color_bg_opacity );
$link_color_bg_1_dark = EliteTrainerSiteThemeCustomizer::rgba_color( $link_color_bg_1_dark, $link_color_bg_opacity_1 );

?>

<?php echo $selector; ?>
{
	color:<?php echo $link_color; ?>;
	font-size:<?php echo $link_font_size; ?>px;
	font-family:'<?php echo $link_font_family; ?>';

	background-color:transparent;
	<?php if( $link_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $link_color_bg; ?> 0, <?php echo $link_color_bg_1; ?> 100%);
	<?php elseif( $link_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $link_color_bg; ?> 0, <?php echo $link_color_bg_1; ?> 100%);
	<?php else : ?>
		background-color:<?php echo $link_color_bg; ?>;
	<?php endif; ?>
}
<?php echo $selector; ?>:hover
{
	background-color:transparent;
	<?php if( $link_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $link_color_bg_dark; ?> 0, <?php echo $link_color_bg_1_dark; ?> 100%);
	<?php elseif( $link_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $link_color_bg_dark; ?> 0, <?php echo $link_color_bg_1_dark; ?> 100%);
	<?php else : ?>
		background-color:<?php echo $link_color_bg_dark; ?>;
	<?php endif; ?>
}

