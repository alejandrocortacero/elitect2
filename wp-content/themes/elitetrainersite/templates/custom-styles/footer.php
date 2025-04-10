<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );

$footer_color = EliteTrainerSiteThemeCustomizer::get_footer_text_color();
$footer_link_color = EliteTrainerSiteThemeCustomizer::get_footer_link_color();
$footer_fontsize = EliteTrainerSiteThemeCustomizer::get_footer_font_size();
$footer_fontfamily = EliteTrainerSiteThemeCustomizer::get_footer_font_family();

$footer_bg = EliteTrainerSiteThemeCustomizer::get_footer_bg();
?>

.main-footer
{
	color:<?php echo $footer_color; ?>;
	font-size: <?php echo $footer_fontsize; ?>px;
	font-family: '<?php echo $footer_fontfamily; ?>';
}

.main-footer a
{
	color:<?php echo $footer_link_color; ?>;
}
.main-footer a:hover
{
	color:<?php echo $footer_link_color; ?>;
}

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.main-footer', $footer_bg, false ); ?>
