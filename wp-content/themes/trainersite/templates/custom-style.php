<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );

$main_color = esc_attr( TrainerSiteTheme::get_main_color() );
$main_color_lighter = TrainerSiteTheme::color_luminance( $main_color, .7 );
$main_color_darker = TrainerSiteTheme::color_luminance( $main_color, -.3 );
$main_color_darkest = TrainerSiteTheme::color_luminance( $main_color, -.7 );
$main_color_transparent = TrainerSiteTheme::rgba_color( $main_color, 0 );
$secondary_color = esc_attr( TrainerSiteTheme::get_secondary_color() );
$secondary_color_lighter = TrainerSiteTheme::color_luminance( $secondary_color, .7 );
$bg_color = esc_attr( TrainerSiteTheme::get_background_color() );
$text_color = esc_attr( TrainerSiteTheme::get_text_color() );
$heading_color = esc_attr( TrainerSiteTheme::get_heading_color() );

?>
<style id="trainer-site-custom-style">
body
{
	background-color:<?php echo $bg_color; ?>;
	color:<?php echo $text_color; ?>;
}
h1,h2,h3,h4,h5,h6
{
	color:<?php echo $heading_color; ?>;
}

.cool-heading {
    color: <?php echo $secondary_color; ?>;
    background-image: -webkit-radial-gradient(center,circle,<?php echo $main_color; ?> 0,<?php echo $main_color_transparent; ?> 100%);
    background-image: -o-radial-gradient(center,circle,<?php echo $main_color; ?> 0,<?php echo $main_color_transparent; ?> 100%);
    background-image: radial-gradient(circle at center,<?php echo $main_color; ?> 0,<?php echo $main_color_transparent; ?> 100%);
}


.navbar-default {
    background-image: -webkit-linear-gradient(top, 0,<?php echo $main_color; ?> 100%);
    background-image: -o-linear-gradient(top,<?php echo $main_color_lighter; ?> 0,<?php echo $main_color; ?> 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,from(<?php echo $main_color_lighter; ?>),to(<?php echo $main_color; ?>));
    background-image: linear-gradient(to bottom,<?php echo $main_color_lighter; ?> 0,<?php echo $main_color; ?> 100%);

	border-color:<?php echo $secondary_color; ?>;
}
.navbar-default .navbar-nav>li>a {
    color: <?php echo $secondary_color; ?>;
}
.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
    color: <?php echo $main_color; ?>;
    background-color: <?php echo $secondary_color; ?>;
}


.main-footer {
    background-color: <?php echo $main_color; ?>;
    border-top-color: <?php echo $secondary_color; ?>;
}
.main-footer a {
    color: <?php echo $secondary_color; ?>;
}
.main-footer a:hover, .main-footer a:focus {
    color: <?php echo $secondary_color_lighter; ?>;
}


.btn-primary {
    color: <?php echo $secondary_color; ?>;
    background-color: <?php echo $main_color; ?>;
    border-color: <?php echo $main_color_darker; ?>;
	background-image: -webkit-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $main_color_darker; ?> 100%);
    background-image: -o-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $main_color_darker; ?> 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,from(<?php echo $main_color; ?>),to(<?php echo $main_color_darker; ?>));
    background-image: linear-gradient(to bottom,<?php echo $main_color; ?> 0,<?php echo $main_color_darker; ?> 100%);
    background-repeat: repeat-x;
}
.btn-primary.active, .btn-primary:active {
    background-color: <?php echo $main_color_darker; ?>;
    border-color: <?php echo $main_color_darkest; ?>;
}
.btn.active, .btn:active {
    background-image: none;
}
.btn-primary:focus, .btn-primary:hover {
    background-color: <?php echo $main_color_darker; ?>;
    background-position: 0 -15px;
}

.btn-primary:hover {
    color: <?php echo $secondary_color_lighter; ?>;
    border-color: <?php echo $main_color_darkest; ?>;
}

body.home .user-form-layer form {
    background-color: <?php echo $main_color; ?>;
    border-color: <?php echo $secondary_color; ?>
}


.settings-menu .settings-menu-col a
{
	border:2px solid <?php echo $main_color; ?>;
	background-image:radial-gradient(circle at center, <?php echo $main_color_lighter; ?> 0, <?php echo $main_color; ?> 100%);
}
.settings-menu .settings-menu-col a:hover
{
	box-shadow:0 0 3px 0 <?php echo $main_color; ?>;
	border:2px solid <?php echo $secondary_color; ?>;
	background-image:radial-gradient(circle at center, <?php echo $secondary_color_lighter; ?> 0, <?php echo $secondary_color; ?> 100%);
}

.settings-menu .settings-menu-col svg path
{
	stroke:<?php echo $secondary_color; ?> !important;
}
.settings-menu .settings-menu-col a:hover svg path
{
	stroke:<?php echo $main_color; ?> !important;
}

.trainer-settings-content .links a .image {
    background-image: -webkit-radial-gradient(center,circle,<?php echo $main_color_lighter; ?> 0,<?php echo $main_color; ?> 100%);
    background-image: -o-radial-gradient(center,circle,<?php echo $main_color_lighter; ?> 0,<?php echo $main_color; ?> 100%);
    background-image: radial-gradient(circle at center,<?php echo $main_color_lighter; ?> 0,<?php echo $main_color; ?> 100%);
    border: 2px solid <?php echo $main_color; ?>;
}
.trainer-settings-content .links a .image svg path {
    stroke: <?php echo $secondary_color; ?> !important;
}
.trainer-settings-content .links a .text p {
    color: <?php echo $secondary_color; ?>;
}
.trainer-settings-content .links a:hover .image {
    background-image: -webkit-radial-gradient(center,circle,<?php echo $secondary_color; ?> 0, <?php echo $secondary_color_lighter; ?> 100%);
    background-image: -o-radial-gradient(center,circle,<?php echo $secondary_color; ?> 0, <?php echo $secondary_color_lighter; ?> 100%);
    background-image: radial-gradient(circle at center,<?php echo $secondary_color; ?> 0, <?php echo $secondary_color_lighter; ?> 100%);
    border: 2px solid <?php echo $secondary_color; ?>;
    -webkit-box-shadow: 0 0 3px 0 <?php echo $main_color; ?>;
    box-shadow: 0 0 3px 0 <?php echo $main_color; ?>;
}
.trainer-settings-content .links a:hover .image svg path {
    stroke: <?php echo $main_color; ?>!important;
}
.trainer-settings-content .links a:hover .text p {
    color: <?php echo $main_color; ?>;
}

</style>
