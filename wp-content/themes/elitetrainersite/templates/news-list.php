<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php
	global $wp_query;
	$featured = array();
	$no_featured = array();
	while( have_posts() )
	{
		the_post();

		$post_id = get_the_ID();
		$is_featured = get_post_meta( $post_id, EpointNews::FEATURED_KEY, true ) === 'yes';
		if( false && $is_featured )
			$featured[] = $post_id;
		else
			$no_featured[] = $post_id;
	}

	wp_reset_postdata();
?>
<main>
	<?php if( !empty( $featured ) ) : ?>
	<div class="row">
		<div class="col-xxs-12 news-featured-slider-col">
			<div id="carousel-featured-news" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				<?php for( $i = 0; $i < count( $featured ); $i++ ) : ?>
				<li
					data-target="#carousel-featured-news"
					data-slide-to="<?php echo $i; ?>"
					<?php if( !$i ) : ?>class="active"<?php endif; ?>>
				</li>
				<?php endfor; ?>
			  </ol>

			  <div class="carousel-inner" role="listbox">
				<?php $i = 0; ?>
				<?php while( have_posts() ) : the_post(); ?>
					<?php if( in_array( get_the_ID(), $featured ) ) : ?>
						<div class="item <?php if( !$i ) : ?>active<?php endif; ?>">
						  <?php $attach = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'news-slide' ); ?>
						  <img src="<?php echo esc_url( $attach[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="carousel-img" />
						  <div class="carousel-caption">
							<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
								<h2><?php echo esc_html( get_the_title() ); ?></h2>
							</a>
							<div class="slider-buttons">
								<?php get_template_part( 'templates/news', 'buttons' ); ?>
							</div>
						  </div>
						</div>
						<?php $i++; ?>
					<?php endif; ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-featured-news" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only"><?php echo esc_html( __( 'Previous', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></span>
			  </a>
			  <a class="right carousel-control" href="#carousel-featured-news" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only"><?php echo esc_html( __( 'Next', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></span>
			  </a>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if( !empty( $no_featured ) ) : ?>
	<div class="row news-no-featured">
	<?php while( have_posts() ) : the_post(); ?>
		<?php if( in_array( get_the_ID(), $no_featured ) ) : ?>
		  <?php $attach = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'news-photo-col' ); ?>
			<div class="col-xxs-12 news-grid-col">
				<article>
					<div class="row equal-height">
						<div class="col-xxs-12 col-xs-3 news-item-img-col">
							<figure>
								<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
								  <img class="img-responsive center-block" src="<?php echo esc_url( $attach[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
								</a>
							</figure>
						</div>
						<div class="col-xxs-12 col-xs-9 news-item-body-col">
							<?php if( get_the_terms( get_the_ID(), EpointNews::TAXONOMY_TAG ) ) : ?>
							<div class="news-tags">
								<span class="fa fa-tags"></span>
								<?php the_terms( get_the_ID(), EpointNews::TAXONOMY_TAG ); ?>
							</div>
							<?php endif; ?>
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="news-title" rel="bookmark">
								<h4><?php echo esc_html( get_the_title() ); ?></h4>
							</a>
							<div class="excerpt">
								<?php echo wp_kses_post( get_the_excerpt() ); ?>
							</div>
						</div>
					</div>
							<div class="buttons">
								<?php get_template_part( 'templates/news', 'buttons' ); ?>
							</div>
				</article>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
	</div>
	<?php endif; ?>
<?php if( false ) : ?>
	<div class="row">
		<div class="col-xxs-12">
			<nav class="news-social-buttons">
				<?php EliteTrainerSiteTheme::print_social_links() ; ?>
			</nav>
		</div>
	</div>
<?php endif; ?>

</main>
