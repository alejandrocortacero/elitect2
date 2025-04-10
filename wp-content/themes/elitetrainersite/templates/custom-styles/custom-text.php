<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
/*
$link_type_bg = EliteTrainerSiteThemeCustomizer::get_button_type_bg( $button );
$link_color_bg = EliteTrainerSiteThemeCustomizer::get_button_color_bg( $button );
$link_color_bg_1 = EliteTrainerSiteThemeCustomizer::get_button_color_bg( $button, 1 );
$link_color_bg_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $link_color_bg, -.3 );
$link_color_bg_1_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $link_color_bg_1, -.3 );
*/
$text_color = EliteTrainerSiteThemeCustomizer::get_text_text_color( $text_name, $default_color );
$text_font_size = EliteTrainerSiteThemeCustomizer::get_text_font_size( $text_name, $default_font_size );
$text_font_family = EliteTrainerSiteThemeCustomizer::get_text_font_family( $text_name, $default_font_family );
?>

<?php echo $selector; ?>
{
	color:<?php echo $text_color; ?>;
	font-size:<?php echo $text_font_size; ?>px;
	font-family:'<?php echo $text_font_family; ?>';
<?php if( false ) : ?>
	background-color:<?php echo $link_color_bg; ?>;
	<?php if( $link_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $link_color_bg; ?> 0, <?php echo $link_color_bg_1; ?> 100%);
	<?php elseif( $link_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $link_color_bg; ?> 0, <?php echo $link_color_bg_1; ?> 100%);
	<?php endif; ?>
<?php endif; ?>
}

