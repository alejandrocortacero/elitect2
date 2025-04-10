<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php echo wp_kses_post( sprintf(
			__( 'Contact from %s (%s - %s) at %s', self::TEXT_DOMAIN ),
			$contact->name,
			sprintf( '<a href="mailto:%s">%s</a>', $contact->user_email, $contact->user_email ),
			sprintf( '<a href="tel:%s">%s</a>', $contact->phone, $contact->phone ),
			date( self::get_public_datetime_format(), strtotime( $contact->date ) )
		) ); ?>
	</h1>
	<hr />
	<table class="form-table"><tbody>
		<tr>
			<th scope="row">
				<label
					for="subject"
				>
					<?php _e( 'Subject', self::TEXT_DOMAIN ); ?>
				</label>
			</th>
			<td>
				<input
					type="text"
					id="subject"
					class="regular-text"
					readonly="readonly"
					value="<?php echo esc_attr( $contact->subject ); ?>"
				/>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label
					for="Message"
				>
					<?php _e( 'Message', self::TEXT_DOMAIN ); ?>
				</label>
			</th>
			<td>
				<textarea
					id="message"
					rows="5"
					readonly="readonly"
					style="width:100%;"
				><?php echo  esc_html( $contact->message ) ; ?></textarea>
			</td>
		</tr>
	</table>
</div>
