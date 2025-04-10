<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<?php get_header(); ?>
<?php if( have_posts() ) : the_post(); ?>
	<article>
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<div class="row">
					<div class="col-xs-12 post-content">
						<header>
						<?php if( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large', array ('class' => 'img-responsive center-block' ) ); ?>
						<?php endif; ?>
						</header>
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			<div class="hidden-xs col-sm-4 col-md-3">
				<?php get_sidebar( 'blog' ); ?>
			</div>
		</div>
	</article>
<?php else : ?>
	<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
<?php endif; ?>
<?php get_footer(); ?>
