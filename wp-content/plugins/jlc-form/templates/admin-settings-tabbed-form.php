<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="jlc-custom-form-tabbed-admin-form">
	<h2 class="nav-tab-wrapper">
	<?php foreach( $this->get_tabs() as $tab_key => $tab ) : ?>
		<a class="nav-tab <?php if( $this->is_active_tab( $tab_key ) ) : ?>nav-tab-active<?php endif; ?>" href="#" data-target="<?php echo esc_attr( $tab_key ); ?>"><?php echo esc_html( $tab['label'] ); ?></a>
	<?php endforeach; ?>
	</h2>
	<div class="jlc-custom-form-tabs-layer">
	<?php foreach( $this->get_tabs() as $tab_key => $tab ) : ?>
		<div class="jlc-custom-form-tab-layer <?php if( $this->is_active_tab( $tab_key ) ) : ?>active<?php endif; ?>" data-tab="<?php echo esc_attr( $tab_key ); ?>">
			<table class="form-table"><tbody>
			<?php foreach( $tab['fields'] as $field ) : ?>
				<?php $field->print_admin(); ?>
			<?php endforeach; ?>
			</tbody></table>
		</div>
	<?php endforeach; ?>
	</div>
	<?php $untabbed = $this->get_untabbed_fields(); ?>
	<?php if( !empty( $untabbed ) ) : ?>
	<table class="form-table"><tbody>
	<?php foreach( $untabbed as $field ) : ?>
		<?php $field->print_admin(); ?>
	<?php endforeach; ?>
	</tbody></table>
	<?php endif; ?>
</div>
