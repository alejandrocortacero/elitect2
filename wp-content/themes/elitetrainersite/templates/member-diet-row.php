<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>

<?php if( EliteTrainerSiteTheme::is_site_trainer() || $tt->active ) : ?>
<div class="row diet-row <?php if( $tt->active ) : ?>diet-active<?php else : ?>diet-inactive<?php endif; ?>" data-training="<?php echo esc_attr( $tt->ID ); ?>">
	<div class="col-xs-12 col-sm-4 diet-col">
		<div class="diet-col-content">
			<p><span class="glyphicon glyphicon-calendar"></span> Desde <span class="date"><?php echo esc_html( strftime( '%d/%m/%y', strtotime( $tt->start ) ) ); ?></span></p>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 diet-col diet-col-2">
		<div class="diet-col-content diet-col-content-2">
			<p><span class="glyphicon glyphicon-calendar"></span> Hasta <span class="date"><?php echo esc_html( strftime( '%d/%m/%y', strtotime( $tt->end ) ) ); ?></span></p>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 diet-col">
		<a data-toggle="collapse" href="#diet-info-col-<?php echo esc_attr( $tt->ID ); ?>" role="button">
			<div class="diet-col-content">
				<p><span class="glyphicon glyphicon-chevron-right"></span> Ver Dieta</p>
				<p class="diet-name"><?php echo esc_html( $tt->name ); ?></p>
			</div>
		</a>
	</div>
	<div class="col-xs-12 diet-col diet-info-col"><div class="diet-info-col-content collapse" id="diet-info-col-<?php echo esc_attr( $tt->ID ); ?>">
		<div class="actions">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
			<a class="diet-button edit-diet" href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
			<a class="diet-button remove-diet" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-trash"></span> Quitar</a>
			<a class="diet-button hide-diet" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::HIDE_DIET_ACTION; ?>&diet=<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span> <?php if( $tt->active ) : ?>Ocultar<?php else : ?>Mostrar<?php endif; ?></a>
			<?php endif; ?>
			<a class="diet-button" href="#diet-info-col-<?php echo esc_attr( $tt->ID ); ?>" data-toggle="collapse"><span class="glyphicon glyphicon-remove"></span> Cerrar</a>
		</div>
		<h3><?php echo esc_html( $tt->name ); ?></h3>
		<?php $objectives_names = EpointPersonalTrainerMapper::get_diet_objectives_names( $tt->ID ); ?>
		<p><strong>Objetivos:</strong> <?php echo esc_html( implode( ', ', $objectives_names ) ); ?></p>
		<?php $restrictions_names = EpointPersonalTrainerMapper::get_diet_restrictions_names( $tt->ID ); ?>	
		<p><strong>Restricciones:</strong> <?php echo esc_html( implode( ', ', $restrictions_names ) ); ?></p>
		<?php if( !empty( $tt->video ) ) : ?>
			<?php if( false ) : ?><p class="text-center"><a href="<?php echo esc_attr( $tt->video ); ?>" rel="external" target="_blank" class="btn btn-primary">Ver vídeo</a></p><?php endif; ?>
			<div class="video-layer" style="position:relative">
				<div class="video">
					<?php echo wp_kses( EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( $tt->video ), array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allow' => array(), 'allowfullscreen' => array() ) ) ); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if( false && !empty( $tt->description ) ) : ?>
			<hr />
			<div class="description">
				<?php echo wp_kses_post( $tt->description ); ?>
			</div>
		<?php endif; ?>
		<?php if( !empty( $tt->observations ) ) : ?>
			<hr />
			<div class="observations">
				<h4>Observaciones</h4>
				<?php echo wp_kses_post( $tt->observations ); ?>
			</div>
		<?php endif; ?>
		<hr />
		<h3>Horario</h3>
		<div class="intervals">
		<?php $intervals = EpointPersonalTrainerMapper::get_diet_intervals( $tt->ID ); ?>
		<?php $indexes = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3); ?>
		<?php foreach( $indexes as $ind ) : ?>
			<?php if( !empty( $intervals[$ind] ) ) : ?>
			<?php $interval = $intervals[$ind]; ?>
				<?php if( !empty( $interval->food ) && !empty( $interval->description ) ) : ?>
				<div class="interval">
					<hr />
					<p><strong><?php echo sprintf( '%02d:00', $ind ); ?></strong> <?php if( !empty( $interval->food ) ) : ?>(<?php echo implode( ', ', array_map( function($a) { return EpointPersonalTrainerMapper::get_food( $a )->name; }, $interval->food ) ); ?>)<?php endif; ?></p>
					<p><?php echo $interval->description; ?></p>
					<hr />
				</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>

		</div>
		
	</div></div>

</div>

<?php endif; // is_site_trainer || is_active ?>
