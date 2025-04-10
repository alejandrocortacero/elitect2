<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );

$main_color = esc_attr( EliteTrainerSiteThemeCustomizer::get_main_color() );
$main_color_lighter = EliteTrainerSiteThemeCustomizer::color_luminance( $main_color, .7 );
$main_color_darker = EliteTrainerSiteThemeCustomizer::color_luminance( $main_color, -.3 );
$main_color_darkest = EliteTrainerSiteThemeCustomizer::color_luminance( $main_color, -.7 );
$main_color_transparent = EliteTrainerSiteThemeCustomizer::rgba_color( $main_color, 0 );
$secondary_color = esc_attr( EliteTrainerSiteThemeCustomizer::get_secondary_color() );
$secondary_color_darker = EliteTrainerSiteThemeCustomizer::color_luminance( $secondary_color, -.3 );
$body_bg = esc_attr( EliteTrainerSiteThemeCustomizer::get_body_bg() );
$bg_color = esc_attr( EliteTrainerSiteThemeCustomizer::get_body_bg_color() );
$text_color = esc_attr( EliteTrainerSiteThemeCustomizer::get_text_color() );

?>
<style id="trainer-site-custom-style">
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'global.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'page-bg.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'archive-cases-bg.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'customize-buttons.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'header-navbar.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'main-menu.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'submenu-navbar.php' ) ) ); ?>

<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'home-cover.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'target-cover.php' ) ) ); ?>

<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'cases.php' ) ) ); ?>

<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'plans.php' ) ) ); ?>

<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'contact.php' ) ) ); ?>

<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'footer.php' ) ) ); ?>


<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'archive-real-cases.php' ) ) ); ?>

<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'page-for-you.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'page-how-works.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'page-online-plan.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'page-presencial-plan.php' ) ) ); ?>

<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'page-user-diets.php' ) ) ); ?>
<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'custom-styles', 'page-user-training.php' ) ) ); ?>
</style>
