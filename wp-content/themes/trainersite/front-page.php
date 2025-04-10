<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');

$blog_details = get_blog_details( get_current_blog_id() );

$cover_background_url = TrainerSiteTheme::get_home_cover_background_url();
?>
<div class="container-fluid home-cover" <?php if( !empty( $cover_background_url ) ) : ?>style="background-image:url('<?php echo $cover_background_url; ?>');"<?php endif; ?>>
	<div class="row">
		<div class="col-xs-12 home-cover-col">
			<div class="title-section">
				<img class="logo" src="<?php echo TrainerSiteTheme::get_big_logo_url(); ?>" alt="<?php echo esc_attr( $blog_details->blogname ); ?>" />
				<h1><?php echo esc_html( $blog_details->blogname ); ?></h1>
			</div>
			<div class="subtitle-section">
				<?php $subtitle = get_blog_option( get_current_blog_id(), TrainerSiteTheme::HOME_SUBTITLE_KEY ); ?>
				<?php if( !empty( $subtitle ) && is_string( $subtitle ) ) : ?>
				<h2><?php echo esc_html( $subtitle ); ?></h2>
				<?php endif; ?>
				<div class="links">
					<?php if( !is_user_member_of_blog() ) : ?>
						<a href="#" rel="bookmark" class="scroll-join-now"><?php echo esc_html( __( 'Join now!', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></a>
					<?php else : ?>
						<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::ACCOUNT_PAGE_KEY, null ) ); ?>" rel="bookmark"><?php echo esc_html( __( 'Go to my account', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php while( have_posts() ) : the_post(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 post-content">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php if( !is_user_member_of_blog() ) : ?>
<div class="container" id="join-now-layer">
	<div class="row">
		<div class="col-xs-12">
			<h2 class="cool-heading"><?php echo esc_html( __( 'Join now!', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
		</div>
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 user-form-layer">
			<?php echo EpointPersonalTrainer::get_register_user_form(); ?>
		</div>
	</div>
</div>
<?php else : ?>
	<?php if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2 class="cool-heading"><?php echo esc_html( __( 'Alerts', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			</div>
			<div class="col-xs-12">
				<p>Ultimas alertas de mis clientes</p>
			</div>
		</div>
	</div>
	<?php else : ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2 class="cool-heading"><?php echo esc_html( __( 'My progression', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			</div>
			<div class="col-xs-12">
				<p>Resumen de datos del cliente actual</p>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php endif; ?>

<?php get_footer('noclose'); ?>
