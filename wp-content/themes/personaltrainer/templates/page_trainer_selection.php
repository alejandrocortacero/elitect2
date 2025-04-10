<?php /* Template Name: Trainer Selection */
defined('ABSPATH') or die( 'Wrong Access' );
?><?php get_header('noopen'); ?>

<?php $trainers = array(); ?>
<?php $sites = get_sites(); ?>
<?php foreach( $sites as $site ) : ?>
	<?php $users = get_users( array(
		'blog_id' => $site->blog_id,
		'role' => EpointPersonalTrainer::TRAINER_ROLE
	) ); ?>
	<?php
		foreach( $users as $user )
		{
			if( !array_key_exists( $user->ID, $trainers ) )
			{
				$user->sitio = $site;
				$trainers[$user->ID] = $user;
			}
		}
	?>
<?php endforeach; ?>
<?php foreach( $trainers as $trainer ) : ?>
	<?php $blog_details = get_blog_details( $trainer->sitio->blog_id ); ?>
<?php endforeach; ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table">
					<thead><tr>
						<th>Sitio</th>
						<th>Entrenador</th>
						<th></th>
					</tr></thead>
					<tbody>
					<?php foreach( $trainers as $trainer ) : ?>
						<tr>
							<td><?php echo $blog_details->blogname; ?></td>
							<td><?php echo $trainer->display_name; ?></td>
							<td><a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>" class="btn btn-primary">Ir al sitio</a></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>

