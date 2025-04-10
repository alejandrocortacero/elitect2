<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>
body
{
	/*background-color:<?php echo $bg_color; ?>;*/
	color:<?php echo $text_color; ?>;

	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_global_font(); ?>';
}
<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body', EliteTrainerSiteThemeCustomizer::get_body_bg(), false ); ?>

hr
{
	border:0;
	height:1px;
	background-color:<?php echo $main_color; ?>;
}

.tox.tox-tinymce
{
	min-height:500px;
}

