<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>
<div class="container-fluid home-cover first-container">
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'pagebg' ); ?>
	<div class="row">
		<div class="col-xs-12 home-cover-col">
			<div class="home-cover-col-bg"></div>
			<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'homecoverbg' ); ?>
			<?php //EliteTrainerSiteThemeCustomizer::print_bg_image_arrows( 'homecoverbg' ); ?>
			<div class="sup">
				<div class="title-layer">
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'homecovertitle' ); ?>
					<h2 class="title">
						<?php echo esc_html(  EliteTrainerSiteThemeCustomizer::get_home_cover_title() ); ?>
					</h2>
				</div>
			</div>
			<div class="left">
				<div class="text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_home_cover_text() ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'homecover' ); ?>
				</div>
				<div class="join-link-layer">
					<a class="join-link" href="<?php echo get_permalink(get_blog_option( get_current_blog_id(), EliteTrainerSiteTheme::ONLINE_SYSTEM_PAGE_KEY )); ?>"><span class="inner-text"><?php echo esc_html(  EliteTrainerSiteThemeCustomizer::get_home_cover_button_text() ); ?></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'homecoverlink' ); ?>
				</div>
			</div>
			<div class="right">
				<div class="video-title">
					<h3 class="text-center"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_text_text( 'realcasesvideotext', 'Casos reales' ) ); ?></h3>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'homecovervideotitle' ); ?>
				</div>
				<div class="video-layer">
					<div class="video">
						<?php if( false ) : ?>
							<?php echo wp_kses(  EliteTrainerSiteThemeCustomizer::get_home_cover_video(), array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allow' => array(), 'allowfullscreen' => array() ) ) ); ?>
						<?php else : ?>
							<?php echo wp_kses( EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( EliteTrainerSiteThemeCustomizer::get_home_cover_video_link() ), array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allow' => array(), 'allowfullscreen' => array() ) ) ); ?>
						<?php endif; ?>
					</div>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'homecovervideo' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if( !empty( ( $real_cases = EliteTrainerSiteTheme::get_real_cases() ) ) ) : ?>
<?php $i = 0; ?>
<div class="container-fluid cases-container">
	<div class="row title-row">
		<div class="col-xs-12">
			<h2><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'realcasestitle', 'Casos reales' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'realcasestitle' ); ?></h2>
			
		</div>
	</div>
<?php foreach( $real_cases as $c ) : ?>
	<div class="row case-<?php echo !($i % 2 ) ? 'odd' : 'even'; ?>" data-case="<?php echo esc_attr( $c->ID ); ?>">
	<?php if( !( $i % 2 ) ) : ?>
		<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-photo.php' ) ) ); ?>
		<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-text.php' ) ) ); ?>
	<?php else : ?>
		<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-text.php' ) ) ); ?>
		<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'real-case-photo.php' ) ) ); ?>
	<?php endif; ?>
	</div>
	<?php $i++; ?>
	<?php if( $i > 1 ) break; ?>
<?php endforeach; ?>
</div>
<div class="container-fluid more-cases-container">
	<a class="more-cases-link" href="<?php echo get_post_type_archive_link( EpointRealCases::POST_TYPE ); ?>"><span class="inner-text"><?php echo esc_html(  EliteTrainerSiteThemeCustomizer::get_button_text( 'morecaseslink', 'Ver más casos') ); ?></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'morecaseslink' ); ?>
</div>
<?php else : ?>
<div class="container-fluid cases-container">
	<div class="row title-row">
		<div class="col-xs-12">
			<h2><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'realcasestitle', 'Casos reales' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'realcasestitle' ); ?></h2>
			
		</div>
	</div>
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
</div>
<?php endif; ?>
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

<div class="container-fluid target-container">
	<div class="row">
		<div class="col-xs-12 target-col">
			<div class="content">
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'targetcoverbg' ); ?>
				<div class="target-title-layer">
					<h2><?php echo EliteTrainerSiteThemeCustomizer::get_target_cover_title(); ?></h2>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'targetcovertitle' ); ?>
				</div>
				<div class="inner-text">
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'targetcovertext' ); ?>
					<div class="editable">
						<?php echo wp_kses_post( EliteTrainerSiteThemeCustomizer::get_target_cover_text() ); ?>
					</div>
				</div>
				<div class="target-link-layer">
					<a href="<?php echo get_permalink(get_blog_option( get_current_blog_id(), EliteTrainerSiteTheme::HOW_IT_WORKS_PAGE_KEY )); ?>"><span class="inner-text"><?php echo EliteTrainerSiteThemeCustomizer::get_button_text( 'targetcover', 'Así puede ser tu entrenamiento' ); ?></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'targetcoverlink' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid plans-container">
	<div class="row">
		<div class="col-xs-12 title-col">
			<h2 class="text-center"><?php echo EliteTrainerSiteThemeCustomizer::get_plans_title(); ?></h2>
			<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'planstitle' ); ?>
		</div>
		<?php $online_enabled = EliteTrainerSiteThemeCustomizer::is_online_plan_enabled(); ?>
		<?php $presencial_enabled = EliteTrainerSiteThemeCustomizer::is_presencial_plan_enabled(); ?>
		<?php if( !$online_enabled ) : ?>
		<div class="col-xs-12 title-col">
			<h3 class="text-center">Editar plan online</h2>
			<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplan' ); ?>
		</div>
		<?php endif; ?>
		<?php if( !$presencial_enabled ) : ?>
		<div class="col-xs-12 title-col">
			<h3 class="text-center">Editar plan presencial</h2>
			<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'presencialplan' ); ?>
		</div>
		<?php endif; ?>
		<?php if( $online_enabled ) : ?>
		<div class="online-col col-xs-12 col-sm-6 <?php if( !$presencial_enabled ) : ?>col-sm-offset-3<?php endif; ?>">
			<span class="price"><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplan' ); ?><span class="quantity"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_online_plan_price() ); ?></span> <sup>€</sup></span>
			<br>
			<span class="type"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_online_plan_title(); ?></span> <?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplantitle' ); ?></span>
			<br>
			<span class="desc"><span class="text"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_text_text( 'onlineplandesc', 'Seguimiento a distancia personalizado dietetico-deportivo' ) ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplandesc' ); ?></span>
			<div class="features">
				<div class="text">
					<?php echo wp_kses_post( EliteTrainerSiteThemeCustomizer::get_online_plan_features() ); ?>	
				</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanfeatures' ); ?>
			</div>
			<div class="know-more-layer">
				<a class="know-more" href="<?php echo get_permalink(get_blog_option( get_current_blog_id(), EliteTrainerSiteTheme::ONLINE_SYSTEM_PAGE_KEY )); ?>"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_button_text( 'knowonlinelink', 'Saber más' ) ); ?></a>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'knowonlinelink' ); ?>
			</div>
		</div>
		<?php endif; ?>
		<?php if( $presencial_enabled ) : ?>
		<div class="presencial-col col-xs-12 col-sm-6 <?php if( !$online_enabled ) : ?>col-sm-offset-3<?php endif; ?>">
			
			<span class="price"><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'presencialplan' ); ?><small>Desde</small> <span class="quantity"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_presencial_plan_price() ); ?></span> <sup>€</sup></span>
			<br>
			<span class="type"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'presencialplantitle', 'Presencial' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'presencialplantitle' ); ?></span>
			<br>
			<span class="desc"><span class="text"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_text_text( 'presencialplandesc', '' ) ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'presencialplandesc' ); ?></span>
			<div class="features">
				<div class="text">
					<?php echo wp_kses_post( EliteTrainerSiteThemeCustomizer::get_presencial_plan_features() ); ?>	
				</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'presencialplanfeatures' ); ?>
			</div>
			<div class="know-more-layer">
				<a class="know-more" href="<?php echo get_permalink(get_blog_option( get_current_blog_id(), EliteTrainerSiteTheme::PRESENCIAL_SYSTEM_PAGE_KEY )); ?>"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_button_text( 'knowpresenciallink', 'Saber más' ) ); ?></a>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'knowpresenciallink' ); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php if( class_exists( 'JLCContact' ) ) : ?>
<?php $phone = esc_attr( EliteTrainerSiteThemeCustomizer::get_contact_phone() ); ?>
<div class="container-fluid contact-container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<div class="link-layer">
				<p class="link"><a href="<?php echo get_permalink(get_blog_option( get_current_blog_id(), EliteTrainerSiteTheme::HOW_IT_WORKS_PAGE_KEY )); ?>"><span class="text-inner"><?php echo esc_html(  EliteTrainerSiteThemeCustomizer::get_button_text( 'contact' ) ); ?></span> <span class="glyphicon glyphicon-chevron-right"></span></a></p>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'contactlink' ); ?>
			</div>
			<p class="tel">¡También puedes contactar por teléfono!</p>
			<p class="tel">
				<a class="tel-link" href="tel:<?php echo preg_replace( '/\D/', '', esc_attr( $phone ) ); ?>" rel="nofollow" >Llámanos</a> o
				<?php if( false ) : ?><a class="whatsapp-link" href="whatsapp://send/?phone=<?php echo preg_replace( '/\D/', '', esc_attr( $phone ) ); ?>&text&source&data&app_absent" rel="nofollow" >envía un Whatsapp</a><?php endif; ?>
				<a class="whatsapp-link" href="https://api.whatsapp.com/send?phone=+34<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow">envía un Whatsapp</a> 
			</p>
			<p class="tel">O si lo prefieres <a href="#" rel="nofollow" data-toggle="modal" data-target="#we-call-you-modal"> te llamamos</a></p>
			<div class="contact-form-layer">
				<?php echo JLCContact::get_contact_form(); ?>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'footercontactform' ); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_footer('noclose'); ?>
