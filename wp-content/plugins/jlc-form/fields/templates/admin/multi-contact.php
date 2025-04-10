<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php if( $wrapped ) : ?>
<tr>
	<th scope="row">
		<?php if( !empty( $this->get_label() ) ) : ?>
		<label
			for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		>
			<?php echo esc_html( $this->get_label() ); ?>
		</label>
		<?php endif; ?>
	</th>
	<td>
<?php else : ?>
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
<?php endif; ?>
		<input
			type="hidden"
			name="<?php echo esc_attr( $this->get_name() ); ?>"
			value="<?php echo esc_attr( $this->get_value() ); ?>"
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
		/>
	<?php foreach( $this->get_addresses() as $addr ) : ?>
		<table
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() . ' jlc-custom-form-multi-contact-table jlc-custom-form-multi-contact-table-' . $this->get_name() . ' jlc-custom-form-multi-contact-table-' . $this->get_name() . '-stored' : 'jlc-custom-form-multi-contact-table jlc-custom-form-multi-contact-table-' . $this->get_name() . ' jlc-custom-form-multi-contact-table-' . $this->get_name() . '-stored wp-list-table widefat striped posts' ); ?>"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		><tbody>
			<tr class="new-contact-row">
				<th colspan="4"><?php echo esc_html( __( 'Contact', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
			</tr>
			<tr class="city-row">
				<th><?php echo esc_html( __( 'City', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="city"
						value="<?php echo esc_attr( $addr['city'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Post code', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="postcode"
						value="<?php echo esc_attr( $addr['postcode'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="state-row">
				<th><?php echo esc_html( __( 'State / Province', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						class="state"
						type="text"
						value="<?php echo esc_attr( $addr['state'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Country', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						class="country"
						type="text"
						value="<?php echo esc_attr( $addr['country'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="address-row">
				<th><?php echo esc_html( __( 'Address', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td colspan="3">
					<input
						type="text"
						class="address"
						value="<?php echo esc_attr( $addr['address'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="coordinates-row">
				<th><?php echo esc_html( __( 'Longitude', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="longitude"
						value="<?php echo esc_attr( $addr['longitude'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Latidude', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="latitude"
						value="<?php echo esc_attr( $addr['latitude'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="email-row">
				<th><?php echo esc_html( __( 'Email', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="email"
						class="email"
						value="<?php echo esc_attr( $addr['email'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Phone', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="phone"
						value="<?php echo esc_attr( $addr['phone'] ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>

			<tr>
				<th></th>
				<td colspan="3"><button class="button button-primary jlc-custom-form-multi-contact-remove" data-field="<?php echo $this->get_name(); ?>"><?php echo esc_html( __( 'Remove', JLCCustomForm::TEXT_DOMAIN ) ); ?></button></td>
			</tr>
			
		</tbody></table>
	<?php endforeach; ?>
		<table
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() . ' jlc-custom-form-multi-contact-table jlc-custom-form-multi-contact-table-' . $this->get_name() . ' jlc-custom-form-multi-contact-table-' . $this->get_name() . '-new' : 'jlc-custom-form-multi-contact-table jlc-custom-form-multi-contact-table-' . $this->get_name() . ' jlc-custom-form-multi-contact-table-' . $this->get_name() . '-new wp-list-table widefat striped posts' ); ?>"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		><tbody>
			<tr class="new-contact-row">
				<th colspan="4"><?php echo esc_html( __( 'New address', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
			</tr>
			<tr class="city-row">
				<th><?php echo esc_html( __( 'City', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="city"
						id="<?php echo esc_attr( $this->get_name() . '_city_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'New city', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Post code', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="postcode"
						id="<?php echo esc_attr( $this->get_name() . '_postcode_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'New postcode', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="state-row">
				<th><?php echo esc_html( __( 'State / Province', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						class="state"
						type="text"
						placeholder="<?php echo esc_attr( __( 'New state', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						id="<?php echo esc_attr( $this->get_name() . '_state_new' ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Country', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						class="country"
						type="text"
						id="<?php echo esc_attr( $this->get_name() . '_country_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'New country', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="address-row">
				<th><?php echo esc_html( __( 'Address', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td colspan="3">
					<input
						type="text"
						class="address"
						id="<?php echo esc_attr( $this->get_name() . '_address_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'New address', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="coordinates-row">
				<th><?php echo esc_html( __( 'Longitude', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="longitude"
						id="<?php echo esc_attr( $this->get_name() . '_longitude_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'In º (e.g. 4.567531)', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Latidude', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="latitude"
						id="<?php echo esc_attr( $this->get_name() . '_latitude_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'In º (e.g. 10.23145', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>
			<tr class="email-row">
				<th><?php echo esc_html( __( 'Email', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="email"
						class="email"
						id="<?php echo esc_attr( $this->get_name() . '_email_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'New email', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
				<th><?php echo esc_html( __( 'Phone', JLCCustomForm::TEXT_DOMAIN ) ); ?></th>
				<td>
					<input
						type="text"
						class="phone"
						id="<?php echo esc_attr( $this->get_name() . '_phone_new' ); ?>"
						placeholder="<?php echo esc_attr( __( 'New phone', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
						<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
						<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
					/>
				</td>
			</tr>

			<tr>
				<th></th>
				<td colspan="3"><button class="button button-primary jlc-custom-form-multi-contact-add" data-field="<?php echo $this->get_name(); ?>"><?php echo esc_html( __( 'Add', JLCCustomForm::TEXT_DOMAIN ) ); ?></button></td>
			</tr>
			
		</tbody></table>
		<?php if( !empty( $this->get_help() ) ) : ?>
			<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
		<?php endif; ?>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>
