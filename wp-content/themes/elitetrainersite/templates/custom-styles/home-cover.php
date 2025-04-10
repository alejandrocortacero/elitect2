<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );

$home_cover_bg = EliteTrainerSiteThemeCustomizer::get_home_cover_bg_url();
$home_cover_bg_v = EliteTrainerSiteThemeCustomizer::get_home_cover_bg_url( false );

$home_cover_title_type_bg = EliteTrainerSiteThemeCustomizer::get_home_cover_title_type_bg();
$home_cover_title_color_bg = EliteTrainerSiteThemeCustomizer::get_home_cover_title_color_bg();
$home_cover_title_color_bg_1 = EliteTrainerSiteThemeCustomizer::get_home_cover_title_color_bg( 1 );
$home_cover_title_opacity_bg = EliteTrainerSiteThemeCustomizer::get_home_cover_title_opacity_bg();
$home_cover_title_opacity_bg_1 = EliteTrainerSiteThemeCustomizer::get_home_cover_title_opacity_bg( 1 );
$home_cover_title_color_bg_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $home_cover_title_color_bg, -.3 );
$home_cover_title_color_bg = EliteTrainerSiteThemeCustomizer::rgba_color( $home_cover_title_color_bg, $home_cover_title_opacity_bg );
$home_cover_title_color_bg_1 = EliteTrainerSiteThemeCustomizer::rgba_color( $home_cover_title_color_bg_1, $home_cover_title_opacity_bg_1 );

$home_cover_link_type_bg = EliteTrainerSiteThemeCustomizer::get_home_cover_button_type_bg();
$home_cover_link_color_bg = EliteTrainerSiteThemeCustomizer::get_home_cover_button_color_bg();
$home_cover_link_color_bg_1 = EliteTrainerSiteThemeCustomizer::get_home_cover_button_color_bg( 1 );
$home_cover_link_color_bg_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $home_cover_link_color_bg, -.3 );
$home_cover_link_color_bg_1_dark = EliteTrainerSiteThemeCustomizer::color_luminance( $home_cover_link_color_bg_1, -.3 );
$home_cover_link_color = EliteTrainerSiteThemeCustomizer::get_home_cover_button_color();

/*
$home_cover_bg_x = EliteTrainerSiteThemeCustomizer::get_home_cover_bg_x();
$home_cover_bg_x = ( $home_cover_bg_x == 'center' ? '50%' : ( $home_cover_bg_x == 'left' ? '0' : '100%' ) );
$home_cover_bg_y = EliteTrainerSiteThemeCustomizer::get_home_cover_bg_y();
$home_cover_bg_y = ( $home_cover_bg_y == 'center' ? '50%' : ( $home_cover_bg_y == 'top' ? '0' : '100%' ) );
*/
$home_cover_bg_x = '50%';//EliteTrainerSiteThemeCustomizer::get_home_cover_bg_x() .'%';
$home_cover_bg_y = '50%';//EliteTrainerSiteThemeCustomizer::get_home_cover_bg_y() .'%';
$home_cover_bg_v_x = '50%';//EliteTrainerSiteThemeCustomizer::get_home_cover_bg_x( false ) .'%';
$home_cover_bg_v_y = '50%';//EliteTrainerSiteThemeCustomizer::get_home_cover_bg_y( false ) .'%';
 ?>

.home-cover .home-cover-col .home-cover-col-bg
{
	background-image:url('<?php echo $home_cover_bg; ?>?ts=<?php echo time(); ?>');
	background-position:<?php echo $home_cover_bg_x; ?> <?php echo $home_cover_bg_y; ?>;
}
@media (orientation:portrait)
{
	.home-cover .home-cover-col .home-cover-col-bg
	{
		background-image:url('<?php echo $home_cover_bg_v; ?>');
		background-position:<?php echo $home_cover_bg_v_x; ?> <?php echo $home_cover_bg_v_y; ?>;
	}
}

.home-cover .home-cover-col .sup .title-layer .title
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_home_cover_title_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_home_cover_title_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_home_cover_title_font_family(); ?>';
	background-color:<?php echo $home_cover_title_color_bg; ?>;
	<?php if( $home_cover_title_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $home_cover_title_color_bg; ?> 0, <?php echo $home_cover_title_color_bg_1; ?> 100%);
	<?php elseif( $home_cover_title_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $home_cover_title_color_bg; ?> 0, <?php echo $home_cover_title_color_bg_1; ?> 100%);
	<?php endif; ?>
}


/*
.home-cover .home-cover-col .left .join-link-layer .join-link
{
	color:<?php echo $home_cover_link_color; ?>;

	background-color:<?php echo $home_cover_link_color_bg; ?>;
	<?php if( $home_cover_link_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $home_cover_link_color_bg; ?> 0, <?php echo $home_cover_link_color_bg_1; ?> 100%);
	<?php elseif( $home_cover_link_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $home_cover_link_color_bg; ?> 0, <?php echo $home_cover_link_color_bg_1; ?> 100%);
	<?php endif; ?>
}
.home-cover .home-cover-col .left .join-link-layer .join-link:hover
{
	background-color:<?php echo $home_cover_link_color_bg_dark; ?>;
	<?php if( $home_cover_link_type_bg == 'gradient' ) : ?>
		background-image:linear-gradient(to right, <?php echo $home_cover_link_color_bg_dark; ?> 0, <?php echo $home_cover_link_color_bg_1_dark; ?> 100%);
	<?php elseif( $home_cover_link_type_bg == 'gradient_v' ) : ?>
		background-image:linear-gradient(to bottom, <?php echo $home_cover_link_color_bg_dark; ?> 0, <?php echo $home_cover_link_color_bg_1_dark; ?> 100%);
	<?php endif; ?>
}
*/

<?php EliteTrainerSiteThemeCustomizer::print_custom_button_style( 'homecover', '.home-cover .home-cover-col .left .join-link-layer .join-link', '#ffffff', 18, null, json_encode( array( 'type' => 'solid', 'color_0' => '#999999', 'color_1' => self::get_secondary_color() ) ) ); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'realcasesvideotext',
	'.home-cover .home-cover-col .right .video-title h3',
	'#fff',//default_color
	20,//default_font_size
	null//default_font_family
); ?>
