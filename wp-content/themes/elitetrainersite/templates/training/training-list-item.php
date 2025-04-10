<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="training">
	<div class="name">
		<h2><a href="?training=<?php echo (int)$tt->ID; ?>" rel="bookmark"><?php echo esc_html( $tt->name ); ?></a> <a class="btn btn-primary pull-right" href="?training=<?php echo (int)$tt->ID; ?>">Ver</a></h2>
	</div>
	<div class="dates">
		<div class="date-start">
			<div class="title">Inicio</div>
			<div class="content"><?php echo strftime( '%d/%m/%y', strtotime( $tt->start ) ); ?></div>
		</div>
		<div class="date-end">
			<div class="title">Fin</div>
			<div class="content"><?php echo strftime( '%d/%m/%y', strtotime( $tt->end ) ); ?></div>
		</div>
	</div>
	<div class="others">
		<div class="objectives">
			<?php $objectives_names = EpointPersonalTrainerMapper::get_training_objectives_names( $tt->ID ); ?>	
			<div class="title">Objetivos</div>
			<div class="content"><p><?php echo esc_html( implode( ', ', $objectives_names ) ); ?></p></div>
		</div>
		<div class="environments">
			<?php $environments_names = EpointPersonalTrainerMapper::get_training_environments_names( $tt->ID ); ?>	
			<div class="title">Entornos</div>
			<div class="content"><p><?php echo esc_html( implode( ', ', $environments_names ) ); ?></p></div>
		</div>
	</div>
	<div class="description">
		<?php $desc = wp_kses_post( $tt->description ); ?>
		<?php if( mb_strlen( $desc ) > 100 ) echo mb_substr( $desc, 0, 100 ) . ' [...]'; else echo $desc; ?>
	</div>
</div>
