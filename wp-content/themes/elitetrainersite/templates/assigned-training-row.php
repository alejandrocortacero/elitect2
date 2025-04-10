<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<tr>
	<td class="small-full-width"><a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a></td>
	<td class="small-medium-width"><?php echo esc_html( $tt->start ); ?></td>
	<td class="small-medium-width"><?php echo esc_html( $tt->end ); ?></td>
	<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $environment->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
	<td class="actions">
	<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
		<?php if( false ) : ?><a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>" class="duplicate-training" data-training="<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-duplicate"></span></a><?php endif; ?>
		<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
	<?php endif; ?>
	</td>

</tr>
