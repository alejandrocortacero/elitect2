<?php defined( 'ABSPATH' ) or die(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php get_template_part( 'templates/header', 'favicons' ); ?>

<title><?php echo wp_get_document_title(); ?></title>

<?php if( !defined( 'WP_DEBUG' ) || !WP_DEBUG ) : ?>
	<?php if( !current_user_can( 'administrator' ) ) : ?>
	<?php endif; ?>
<?php endif; ?>


<?php wp_head(); ?>
</head>
