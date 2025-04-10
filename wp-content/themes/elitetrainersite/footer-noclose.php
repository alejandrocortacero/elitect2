<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<?php get_template_part( 'templates/footer', 'menu' ); ?>

<?php if( false && EliteTrainerSiteThemeCustomizer::can_edit() ) : ?>
<div class="page-bg-layer">
	<?php EliteTrainerSiteThemeCustomizer::include_modal_without_button('pagebg'); ?>
	<button class="page-bg-button" data-toggle="modal" data-target="#page-bg-modal"><span class="glyphicon glyphicon-text-background"></span></button>
</div>

<?php endif; ?>


<?php do_action( 'elitetrainersitetheme_footer_after_static_content' ); ?>
<?php if( class_exists( 'JLCCookies' ) ) JLCCookies::print_cookies_message(); ?>
<?php //get_template_part( 'templates/social', 'fixed' ); ?>
<?php do_action( 'elitetrainersitetheme_modal_windows' ); ?>

<?php get_template_part( 'templates/trainer-vertical', 'menu' ); ?>

<?php get_template_part( 'templates/wecallyou', 'modal' ); ?>

<?php //get_template_part( 'templates/headernavbar', 'modal' ); ?>

<?php //get_template_part( 'templates/homecover', 'modal' ); ?>
<?php //get_template_part( 'templates/homecoverbg', 'modal' ); ?>
<?php //get_template_part( 'templates/homecovervideo', 'modal' ); ?>

<?php get_template_part( 'templates/mainoptions', 'modal' ); ?>

<?php get_template_part( 'templates/editcase', 'modal' ); ?>
	
<?php if( false && EliteTrainerSiteThemeCustomizer::can_edit() ) : ?>
<div class="main-options-layer">
	<button class="main-options-button" data-toggle="modal" data-target="#main-options-modal"><span class="glyphicon glyphicon-wrench"></span></button>
</div>

<?php endif; ?>


<?php if( is_user_logged_in() ) : ?>
<div class="user-fixed-layer">
	<button type="button" class="user-menu-button">
		<span class="glyphicon glyphicon-user"></span>
	</button>
	<?php if( false && EpointPersonalTrainer::is_site_trainer() ) : ?>
	<button type="button" class="trainer-edit-button" data-toggle="modal" data-target="#trainer-edit-menu-modal">
		<span class="glyphicon glyphicon-cog"></span>
	</button>
	<?php endif; ?>
	<?php if( EpointPersonalTrainer::is_site_trainer() ) : ?>
	<a href="<?php echo EliteTrainerSiteTheme::get_trainer_help_page_url(); ?>">
		<button class="trainer-help-link">
			<span class="glyphicon glyphicon-question-sign"></span>
		</button>
	</a>
	<?php endif; ?>
	<?php if( class_exists( 'EpointPersonalTrainer', false ) && EpointPersonalTrainer::is_site_client() ) : ?>
		<?php if( false ) : ?>
		<button type="button" class="trainer-edit-button" data-toggle="modal" data-target="#member-trainer-valoration-modal">
			<span class="glyphicon glyphicon-thumbs-up"></span>
		</button>
		<?php else: ?>
		<a href="<?php echo EliteTrainerSiteTheme::get_trainer_valoration_page_url(); ?>">
			<button class="trainer-help-link">
				<span class="glyphicon glyphicon-thumbs-up"></span>
			</button>
		</a>
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php if( true ) get_template_part( 'templates/trainereditmenu', 'modal' ); ?>

<?php if( false ) get_template_part( 'templates/membertrainervaloration', 'modal' ); ?>

<?php if( EliteTrainerSiteTheme::must_show_trainer_help_modal() ) get_template_part( 'templates/trainerhelp', 'modal' ); ?>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
