<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );

$target_cover_bg = EliteTrainerSiteThemeCustomizer::get_target_cover_bg_url();
$target_cover_bg_v = EliteTrainerSiteThemeCustomizer::get_target_cover_bg_url( false );

$target_cover_bg_x = 0;//EliteTrainerSiteThemeCustomizer::get_target_cover_bg_x() .'%';
$target_cover_bg_y = 0;//EliteTrainerSiteThemeCustomizer::get_target_cover_bg_y() .'%';
$target_cover_bg_v_x = 0;//EliteTrainerSiteThemeCustomizer::get_target_cover_bg_x( false ) .'%';
$target_cover_bg_v_y = 0;//EliteTrainerSiteThemeCustomizer::get_target_cover_bg_y( false ) .'%';

$target_cover_link_color_bg = EliteTrainerSiteThemeCustomizer::get_target_cover_button_color_bg();
$target_cover_link_color_bg_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $target_cover_link_color_bg, -.3 );
$target_cover_link_color = EliteTrainerSiteThemeCustomizer::get_target_cover_button_color();
 ?>

.target-container
{
	background-image:url('<?php echo $target_cover_bg; ?>?time=<?php echo time(); ?>');
	background-position:<?php echo $target_cover_bg_x; ?> <?php echo $target_cover_bg_y; ?>;
}

@media (orientation:portrait)
{
	.target-container
	{
		background-image:url('<?php echo $target_cover_bg_v; ?>?time=<?php echo time(); ?>');
		background-position:<?php echo $target_cover_bg_x; ?> <?php echo $target_cover_bg_y; ?>;
		
	}
}

.target-container .target-col .content .target-title-layer h2
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_target_cover_title_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_target_cover_title_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_target_cover_title_font_family(); ?>';
}
/*
.target-container .target-col .content .target-link-layer a
{
	background-color:<?php echo $target_cover_link_color_bg; ?>;
	color:<?php echo $target_cover_link_color; ?>;
}
.target-container .target-col .content .target-link-layer a:hover
{
	background-color:<?php echo $target_cover_link_color_bg_dark; ?>;
}
*/
<?php EliteTrainerSiteThemeCustomizer::print_custom_button_style( 'targetcover', '.target-container .target-col .content .target-link-layer a' ); ?>
