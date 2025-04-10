<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 
//add_filter( 'body_class', function( $classes ){ $classes[] = 'no-padding';return $classes; } );

$trainers = array();
$sites = get_sites();
foreach( $sites as $site )
{
	$users = get_users( array(
		'blog_id' => $site->blog_id,
		'role' => EpointPersonalTrainer::TRAINER_ROLE
	) );
	foreach( $users as $user )
	{
		if( !array_key_exists( $user->ID, $trainers ) )
		{
			$user->sitio = $site;
			$trainers[$user->ID] = $user;
		}
	}
}

$page_url = get_permalink( get_option( PersonalTrainerTheme::SUPERTRAINER_PAGE_TRAINERS_KEY ) );
?><?php
get_header('noopen');
?>
<?php if( empty( $_GET['trainer'] ) ) : ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-center">Entrenadores - Super</h1>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Email</th>
						<th>Sitio</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach( $trainers as $trainer ) : ?>
					<tr>
						<td><a href="<?php echo $page_url; ?>?trainer=<?php echo $trainer->ID; ?>"><?php echo esc_html( $trainer->display_name ); ?></a></td>
						<td><?php echo esc_html( $trainer->user_email ); ?></td>
						<td><?php echo esc_html( $trainer->sitio->blogname ); ?></td>
						<td><?php echo get_user_meta( $trainer->ID, 'first_name', true ); ?> <?php echo get_user_meta( $trainer->ID, 'last_name', true ); ?></td>
						<td><a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>" class="btn btn-primary" target="_blank">Ir al sitio</a></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
				
		</div>
	</div>
</div>
<?php else : ?>
<?php
$trainer = get_user_by( 'ID', (int)$_GET['trainer'] );
?>
<?php if( true || $trainer && in_array( EpointPersonalTrainer::TRAINER_ROLE, $trainer->roles ) ) : ?>
<?php
$sites = get_blogs_of_user( $trainer->ID );
$trainer->sitio = current( $sites );
$trainer_info = EpointPersonalTrainer::get_user_trainer_info( $trainer->ID );
$attributes = $trainer_info->get_attributes();
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-center"><?php echo $trainer->display_name; ?></h1>
			<?php foreach( $trainer_info::get_available_attributes() as $attr_name => $label ) : ?>
				<?php if( $attr_name == 'public_photo' ) : ?>
					<?php if( !empty( $attributes[$attr_name] ) ) : ?>
						<?php switch_to_blog( $trainer->sitio->userblog_id ); ?>
						<img src="<?php echo wp_get_attachment_image_url( $attributes[$attr_name] , 'full'  ); ?>" class="img-responsive center-block" style="width:300px;" />
						<hr />
						<?php restore_current_blog(); ?>
					<?php endif; ?>
				<?php elseif( $attr_name == 'sex' ) : ?>
					<p><strong><?php echo esc_html( $label ); ?></strong></p>
					<p><?php echo $attributes[$attr_name] == 'm' ? 'Mujer' : 'Hombre'; ?></p>
				<?php else : ?>
					<p><strong><?php echo esc_html( $label ); ?></strong></p>
					<p><?php echo $attributes[$attr_name]; ?></p>
				<?php endif; ?>
			<?php endforeach; ?>	
		</div>
	</div>
</div>
<?php endif; // trainer ?>
<?php endif; ?>
<?php get_footer('noclose'); ?>
