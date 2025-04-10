<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 
 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
					

						<h1>Lista de miembros<button class="btn btn-primary pull-right" type="button" data-toggle="collapse" data-target="#member-filter-layer" aria-expanded="false" aria-controls="member-filter-layer">Filtrar</button></h1>
						<div class="collapse" id="member-filter-layer">
							<?php echo EpointPersonalTrainerPublic::get_members_filter_form(); ?>
						</div>
						<?php if( false ): ?><p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url(); ?>">Añadir nuevo socio</a></p><?php endif; ?>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<?php $users = get_users( array(
							'role' => EpointPersonalTrainer::SPORTSMAN_ROLE
						) ); ?>
						<div class="member-search-results">
							<?php $table_template = locate_template( 'templates/members/members-table.php' ); ?>
							<?php if( $table_template ) include( $table_template ); ?>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>
<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
