<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' ); ?>

.plans-container .title-col h2
{
	color: <?php echo EliteTrainerSiteThemeCustomizer::get_plans_title_text_color(); ?>;
	font-size: <?php echo EliteTrainerSiteThemeCustomizer::get_plans_title_font_size(); ?>px;
	font-family: '<?php echo EliteTrainerSiteThemeCustomizer::get_plans_title_font_family(); ?>';
}

<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( '.plans-container .title-col', EliteTrainerSiteThemeCustomizer::get_plans_title_bg(), false ); ?>

.plans-container > .row .col-xs-12 .type
{
	color:<?php echo $main_color; ?>;
}

.plans-container > .row .col-xs-12 .know-more
{
	background-color:<?php echo $main_color; ?>;
}
.plans-container > .row .col-xs-12 .know-more:hover
{
	background-color:<?php echo $main_color_darker; ?>;
}

.plans-container .online-col .price
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_price_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_price_font_size(); ?>px !important;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_price_font_family(); ?>';
}

.plans-container > .row .online-col .type
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_title_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_title_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_title_font_family(); ?>';
}

.plans-container .online-col .desc
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_desc_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_desc_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_desc_font_family(); ?>';
}

.plans-container .presencial-col .price
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_plan_price_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_plan_price_font_size(); ?>px !important;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_plan_price_font_family(); ?>';
}

.plans-container .presencial-col .desc
{
	color:<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_plan_desc_color(); ?>;
	font-size:<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_plan_desc_font_size(); ?>px;
	font-family:'<?php echo EliteTrainerSiteThemeCustomizer::get_presencial_plan_desc_font_family(); ?>';
}


<?php EliteTrainerSiteThemeCustomizer::print_custom_button_style( 'knowpresenciallink', '.plans-container > .row .col-xs-12.presencial-col .know-more-layer .know-more' ); ?>
<?php EliteTrainerSiteThemeCustomizer::print_custom_button_style( 'knowonlinelink', '.plans-container > .row .col-xs-12.online-col .know-more-layer .know-more' ); ?>


<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'onlineplandesc',
	'.plans-container > .row .col-xs-12.online-col .desc',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	26,//default_font_size
	null//default_font_family
); ?>

<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'presencialplantitle',
	'.plans-container > .row .col-xs-12.presencial-col .type',
	EliteTrainerSiteThemeCustomizer::get_main_color(),//default_color
	30,//default_font_size
	null//default_font_family
); ?>
<?php EliteTrainerSiteThemeCustomizer::print_custom_text_style(
	'presencialplandesc',
	'.plans-container > .row .col-xs-12.presencial-col .desc',
	EliteTrainerSiteThemeCustomizer::get_text_color(),//default_color
	26,//default_font_size
	null//default_font_family
); ?>
