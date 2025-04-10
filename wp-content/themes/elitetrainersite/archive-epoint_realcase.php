<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>
<div class="container archive-cases-container first-container">
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'archivecasesbg' ); ?>
	<div class="row title-row">
		<div class="col-xs-12">
			<h1 class="text-center"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'archiverealcasestitle', 'Fotos y vídeos de cambios reales' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'archiverealcasestitle' ); ?></h1>
			<div class="video-layer">
				<div class="video">
					<?php echo wp_kses( EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( EliteTrainerSiteThemeCustomizer::get_home_cover_video_link() ), array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allow' => array(), 'allowfullscreen' => array() ) ) ); ?>
				</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'homecovervideo' ); ?>
			</div>
			<h2 class="text-center"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'realcasesvideosubtitle', 'Míralo tu mismo' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'realcasesvideosubtitle' ); ?></h2>
		</div>
	</div>
</div>
<div class="container-fluid cases-container">
	<div class="row title-row">
		<div class="col-xs-12">
			<h2><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'realcasestitle', 'Casos reales' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'realcasestitle' ); ?></h2>
			
		</div>
	</div>
	<?php if( have_posts() ) : ?>
		<?php $i = 0; ?>
		<?php while( have_posts() ) : the_post(); ?>
			<div class="row case-<?php echo !($i % 2 ) ? 'odd' : 'even'; ?>" data-case="<?php echo esc_attr( get_the_ID() ); ?>">
			<?php $c = new stdClass; $c->ID = get_the_ID(); $c->post_title = get_the_title(); $c->post_content = get_the_content(); ?>
			<?php if( !( $i % 2 ) ) : ?>
				<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-photo.php' ) ) ); ?>
				<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-text.php' ) ) ); ?>
			<?php else : ?>
				<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-text.php' ) ) ); ?>
				<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-photo.php' ) ) ); ?>
			<?php endif; ?>
			</div>
			<?php $i++; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<div class="row case-<?php echo !($i % 2 ) ? 'odd' : 'even'; ?>" data-case="0">
			<div class="col-xs-12 col-sm-6 photo">
				<div class="real-case-photo real-case-photo-before" data-photo-id="0" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/before.jpg');" data-photo-url="0"></div>
				<div class="real-case-photo real-case-photo-after" data-photo-id="0" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/after.jpg');"  data-photo-url="0"></div>
			</div>
			<div class="col-xs-12 col-sm-6 text">
				<h3>Caso de muestra</h3>
				<div class="inner-text">Texto de ejemplo</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php if( EliteTrainerSiteThemeCustomizer::can_edit() ) : ?>
<div class="container-fluid add-case-container">
	<div class="row">
		<div class="col-xs-12 text-center">
			<hr />
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#edit-case-modal" data-case="">Añadir caso</button>
			<hr />
		</div>
	</div>
</div>
<?php endif; ?>

<?php
wp_enqueue_script(
	'elitetrainertheme-edit-case',
	get_template_directory_uri() . '/js/edit-case.js',
	array(),
	'1.0.0',
	true
);
?>

<?php get_footer('noclose'); ?>
