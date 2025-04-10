<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );

$logo_pos = EliteTrainerSiteThemeCustomizer::get_header_logo_position();
$logo_size = EliteTrainerSiteThemeCustomizer::get_header_logo_size();
?>
.header-navbar
{
	
}

<?php if( false ) : ?>
.header-navbar > .container, .header-navbar > .container-fluid
{
	background-color:<?php echo EliteTrainerSiteThemeCustomizer::get_header_bg_color(); ?>;
}
<?php endif; ?>
<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.header-navbar > .container, .header-navbar > .container-fluid', EliteTrainerSiteThemeCustomizer::get_header_bg(), false ); ?>

.header-navbar > .container .navbar-header .navbar-brand .text .site-title, .header-navbar > .container-fluid .navbar-header .navbar-brand .text .site-title
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_header_title_color(); ?>;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_header_title_font(); ?>';
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_header_title_font_size(); ?>px;
}

.header-navbar > .container .navbar-header .navbar-brand .text .site-description, .header-navbar > .container-fluid .navbar-header .navbar-brand .text .site-description
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_header_subtitle_color(); ?>;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_header_subtitle_font(); ?>';
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_header_subtitle_font_size(); ?>px;
}


@keyframes contact-link-lighting {
     0% {text-shadow:0px 0px 2px #666;}
     50% {text-shadow:0 0 2px #fff, 0px 0px 6px <?php echo $main_color; ?>;}
     100% {text-shadow:0px 0px 2px #666;}
}

.header-navbar>.container .phone-layer a, .header-navbar>.container-fluid .phone-layer a
{
    -webkit-animation-name: contact-link-lighting;
    -o-animation-name: contact-link-lighting;
    animation-name: contact-link-lighting;
    -webkit-animation-duration: 1s;
    -o-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-iteration-count: infinite;
    -o-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
}

.header-navbar>.container .phone-layer a, .header-navbar>.container-fluid .phone-layer a .fa
{
	color: <?php echo $main_color; ?>;
}
.header-navbar>.container .phone-layer a, .header-navbar>.container-fluid .phone-layer a:hover .fa
{
	color: <?php echo $main_color_lighter; ?>;
}

<?php if( $logo_pos == 'right' ) : ?>
@media (min-width:768px)
{
	.header-navbar > .container .navbar-header, .header-navbar > .container-fluid .navbar-header 
	{
		float:right;
	}
	.header-navbar > .container .navbar-header .navbar-brand .logo, .header-navbar > .container-fluid .navbar-header  .navbar-brand .logo
	{
		order:2;
		margin-left:10px;
	}
	.header-navbar > .container .navbar-header .navbar-brand .text, .header-navbar > .container-fluid .navbar-header  .navbar-brand .text
	{
		text-align:right;
	}
	.header-navbar>.container .phone-layer, .header-navbar>.container-fluid .phone-layer
	{
		float:left;
	}
}
@media (max-width:767px) and (orientation:landscape)
{
	.header-navbar > .container .navbar-header, .header-navbar > .container-fluid .navbar-header 
	{
		float:right;
	}
	.header-navbar > .container .navbar-header .navbar-brand, .header-navbar > .container-fluid .navbar-header  .navbar-brand
	{
	}
	.header-navbar > .container .navbar-header .navbar-brand .logo, .header-navbar > .container-fluid .navbar-header  .navbar-brand .logo
	{
		order:2;
	}
	.header-navbar > .container .navbar-header .navbar-brand .logo img, .header-navbar > .container-fluid .navbar-header  .navbar-brand .logo img
	{
	}
	.header-navbar > .container .navbar-header .navbar-brand .text, .header-navbar > .container-fluid .navbar-header  .navbar-brand .text
	{
		text-align:right;
	}
	.header-navbar>.container .phone-layer, .header-navbar>.container-fluid .phone-layer
	{
		float:left;
	}

	.header-navbar > .container .navbar-header .navbar-toggle, .header-navbar > .container-fluid .navbar-header .navbar-toggle
	{
		display:none;
	}
	.header-navbar > .container .phone-layer .navbar-toggle, .header-navbar > .container-fluid .phone-layer .navbar-toggle
	{
		display:block;
		position:absolute;
		top:0;
		left:0;
		padding-left:0;
	}
}
<?php elseif( $logo_pos == 'center' ) : ?>
@media (min-width:768px)
{
<?php if( false ) : //old centering style ?>
	.header-navbar > .container .navbar-header, .header-navbar > .container-fluid .navbar-header 
	{
		position:absolute;
		top:50%;
		left:50%;
		transform:translate(-50%,-50%);
	}
<?php else : ?>
	.header-navbar > .container .navbar-header, .header-navbar > .container-fluid .navbar-header 
	{
		width:50%;
	}
	.header-navbar > .container .navbar-header .navbar-brand, .header-navbar > .container-fluid .navbar-header .navbar-brand
	{
		width:100%;
		justify-content:space-between;
		padding-right:0;
		margin-left:0;
	}
	.header-navbar > .container .navbar-header .navbar-brand .logo, .header-navbar > .container-fluid .navbar-header .navbar-brand .logo
	{
		order:2;
		transform:translate(50%,0);
		margin-right:0;
	}
<?php endif; ?>

	.header-navbar>.container .phone-layer, .header-navbar>.container-fluid .phone-layer
	{
		padding-bottom:30px;
	}
}
@media (min-width:768px) and (max-width:991px)
{
	.header-navbar > .container .navbar-header, .header-navbar > .container-fluid .navbar-header 
	{
		margin-left:0;
	}
}
@media (max-width:767px) and (orientation:landscape)
{
	.header-navbar > .container .navbar-header, .header-navbar > .container-fluid .navbar-header 
	{
		width:50%;
		max-width:50%;
	}
	.header-navbar > .container .navbar-header .navbar-brand, .header-navbar > .container-fluid .navbar-header .navbar-brand
	{
		width:100%;
		justify-content:space-between;
		padding-right:0;
		margin-left:0;
		padding-left:40px;

	}
	.header-navbar > .container .navbar-header .navbar-brand .logo, .header-navbar > .container-fluid .navbar-header .navbar-brand .logo
	{
		order:2;
		transform:translate(50%,0);
		margin-right:0;
	}
	.header-navbar>.container .phone-layer, .header-navbar>.container-fluid .phone-layer
	{
		padding-bottom:30px;
	}

	.header-navbar > .container .navbar-header .navbar-toggle, .header-navbar > .container-fluid .navbar-header .navbar-toggle
	{
		display:none;
	}
	.header-navbar > .container .phone-layer .navbar-toggle, .header-navbar > .container-fluid .phone-layer .navbar-toggle
	{
		display:block;
		position:absolute;
		top:0;
		right:35px;
		padding-right:0;
	}
}
<?php else : //logo izq ?>
@media (max-width:767px) and (orientation:landscape)
{

	.header-navbar > .container .navbar-header .navbar-toggle, .header-navbar > .container-fluid .navbar-header .navbar-toggle
	{
		display:none;
	}

	.header-navbar > .container .phone-layer .navbar-toggle, .header-navbar > .container-fluid .phone-layer .navbar-toggle
	{
		display:block;
		float:right;
		position:absolute;
		top:0;
		right:24px;
	}
}
<?php endif; ?>

<?php if( $logo_size == 'small' ) : ?>
@media (min-width:768px)
{
	.header-navbar > .container .navbar-header .navbar-brand .logo img, .header-navbar > .container-fluid .navbar-header .navbar-brand .logo img
	{
		height:60px;
		max-width:120px;
	}

}
@media (max-width:767px) and (orientation:landscape)
{
	.header-navbar
	{
		min-height:80px;
	}
	.header-navbar > .container .navbar-header .navbar-brand, .header-navbar > .container-fluid .navbar-header .navbar-brand
	{
		height:80px;
	}
	.header-navbar > .container .navbar-header .navbar-brand .logo img, .header-navbar > .container-fluid .navbar-header .navbar-brand .logo img
	{
		height:60px;
		max-width:120px;
	}
	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:40px;
		padding-bottom:0;
		font-size:18px;
	}
	.header-navbar > .container .phone-layer a, .header-navbar > .container-fluid .phone-layer a .fa
	{
		font-size:30px;
	}
}
	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:40px;
		padding-bottom:0;
	}
@media (orientation:portrait) and (max-width:767px)
{
	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:5px;
	}
}
<?php elseif( $logo_size == 'big' ) : ?>
@media (min-width:768px)
{

	.header-navbar > .container .navbar-header .navbar-brand, .header-navbar > .container-fluid .navbar-header .navbar-brand
	{
		height:160px;
	}
	.header-navbar > .container .navbar-header .navbar-brand .logo img, .header-navbar > .container-fluid .navbar-header .navbar-brand .logo img
	{
		height:140px;
		max-width:280px;
	}

	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:50px;
		padding-bottom:50px;
	}
}
@media (max-width:767px) and (orientation:landscape)
{
	.header-navbar > .container .navbar-header, .header-navbar > .container-fluid .navbar-header
	{
		max-width:50%;
	}
	.header-navbar > .container .navbar-header .navbar-brand, .header-navbar > .container-fluid .navbar-header .navbar-brand
	{
		height:160px;
		padding-left:10px;
		padding-right:10px;
	}
	.header-navbar > .container .navbar-header .navbar-brand .logo img, .header-navbar > .container-fluid .navbar-header .navbar-brand .logo img
	{
		height:140px;
		max-width:280px;
		margin:auto;
	}

}
	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:100px;
		padding-bottom:0px;
	}
@media (orientation:portrait) and (max-width:767px)
{
	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:5px;
	}
}
<?php else : //logo normal ?>

.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
{
	padding-top:60px;
	padding-bottom:0;
}
/*
@media (max-width:767px) and (orientation:landscape)
{
	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:60px;
		padding-bottom:0;
	}
}
*/
@media (orientation:portrait) and (max-width:767px)
{
	.header-navbar > .container .phone-layer, .header-navbar > .container-fluid .phone-layer
	{
		padding-top:5px;
		padding-bottom:0;
	}
}
<?php endif; ?>


<?php if( EliteTrainerSiteThemeCustomizer::must_hide_main_menu_on_desktop() ) : ?>
@media (min-width:768px)
{
	.header-navbar > .container .phone-layer .navbar-toggle, .header-navbar > .container-fluid .phone-layer .navbar-toggle
	{
		display:block;
		position:absolute;
		<?php if( $logo_pos == 'right' ) : ?>
		top:0;
		left:0;
		padding-left:0;
		<?php else : ?>
		top:0;
		right:35px;
		padding-right:0;
		<?php endif; ?>

	}
}
<?php endif; ?>
