<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<?php if( have_posts() ) : ?>
	<?php while( have_posts() ) : the_post(); ?>
		<div class="row">
		<article>
		<?php if( has_post_thumbnail() ) : ?>
			<div class="col-xs-12 col-sm-4 post-left-col">
				<?php the_post_thumbnail( 'personaltrainer-thumbnail', array( 'class' => 'img-responsive center-block' ) ); ?>
				<?php get_template_part( 'templates/post', 'social' ); ?>
			</div>
			<div class="col-xs-12 col-sm-8">
				<header>
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<?php if( get_post_type() === 'post' ) : ?>
				<span class="post-date">
					<small><?php the_time( get_option( 'date_format' ) ); ?></small>
				</span>
				<span class="categories"><?php the_category( ' ' ); ?></span>
				<span class="comments">
					<?php if( get_comments_number() > 0 ) : ?>
						<?php PersonalTrainerTheme::comments_popup_link(); ?>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				<span class="tags"><?php the_tags( '', ' ' ); ?></span>
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
				<div class="post-footer">
					<a href="<?php the_permalink(); ?>" title="<?php echo __( 'Read more', PersonalTrainerTheme::TEXT_DOMAIN ); ?>" rel="bookmark" class="read-more"><?php echo __( 'Read more', PersonalTrainerTheme::TEXT_DOMAIN ); ?></a>
				</div>
			</div>
		<?php else : ?>
			<div class="col-xs-12 col-sm-8 col-sm-offset-4">
				<header>
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<?php if( get_post_type() === 'post' ) : ?>
				<span class="post-date">
					<small><?php the_time( get_option( 'date_format' ) ); ?></small>
				</span>
				<span class="categories"><?php the_category( ' ' ); ?></span>
				<span class="comments">
					<?php if( get_comments_number() > 0 ) : ?>
						<?php PersonalTrainerTheme::comments_popup_link(); ?>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				<span class="tags"><?php the_tags( '', ' ' ); ?></span>
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
				<div class="post-footer">
					<a href="<?php the_permalink(); ?>" title="<?php echo __( 'Read more', PersonalTrainerTheme::TEXT_DOMAIN ); ?>" rel="bookmark" class="read-more"><?php echo __( 'Read more', PersonalTrainerTheme::TEXT_DOMAIN ); ?></a>
				</div>
			</div>
		<?php endif; ?>
		</article>
		</div>
		<hr />
	<?php endwhile; ?>
	<div class="row pagination-row">
		<div class="col-xs-12">
			<?php echo paginate_links(); ?>
		</div>
	</div>
<?php else : ?>
	<p><?php _e( 'No results found.', PersonalTrainerTheme::TEXT_DOMAIN ); ?></p>
<?php endif; ?>
