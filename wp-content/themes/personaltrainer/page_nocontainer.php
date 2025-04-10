<?php /* Template Name: No Content Container */
defined('ABSPATH') or die( 'Wrong Access' );
?><?php get_header('noopen'); ?>
<?php if( have_posts() ) : the_post(); ?>
<div class="container">
	<div class="row">
		<nav class="col-xxs-12 col-xs-12">
			<?php PersonalTrainerTheme::print_breadcrumbs(); ?>
		</nav>
	</div>
	<div class="row">
		<div class="col-xxs-12 col-xs-12">
			<h1 class="text-center zoom3d"><?php the_title(); ?></h1>
		</div>
	</div>
</div>
<?php the_content(); ?>
<?php else : ?>
	<h1><?php echo esc_html( __( 'Not found.', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h1>
<?php endif; ?>
<?php get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>

