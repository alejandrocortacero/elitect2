<?php /* Template Name: 100vh - Menu opaque */
defined( 'ABSPATH' ) or die( 'Wrong Access' ); 
$i = 0;
get_header( 'noopen' ); ?>
<?php if( have_posts() ) : the_post(); ?>
	<?php $main_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
	<?php if( $main_image_src ) : ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 template-header-col">
				<div id="carousel-template" class="carousel slide" data-ride="carousel" data-interval="4000">
					<div class="carousel-inner" role="listbox">
						<div
							class="item <?php if( !$i ) : ?>active<?php endif; ?> item-<?php echo $i; ?>"
							<?php if( !empty( $main_image_src[0] ) ) : ?>
							style="background-image:url('<?php echo $main_image_src[0]; ?>');"
							<?php endif; ?>
						>
							<div class="trainersite-caption photo-<?php echo $i; ?>">
								<h1 class="text-center"><?php the_title(); ?></h1>
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php else : ?>
	<div class="container">
		<div class="row">
			<nav class="col-xxs-12 col-xs-12">
				<?php TrainerSiteTheme::print_breadcrumbs(); ?>
			</nav>
		</div>
		<div class="row">
			<div class="col-xxs-12 col-xs-12 height-90vh">
				<h1 class="text-center"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php else : ?>
	<h1><?php echo esc_html( __( 'Not found.', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
<?php endif; ?>
<?php get_footer( 'noclose' ); ?>
