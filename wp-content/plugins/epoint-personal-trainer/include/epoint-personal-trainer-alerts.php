<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class EpointPersonalTrainerAlerts
{
	// USER META
	const TRAINER_CHANGE_TRAINING_ALERT = 'ept_alert_trainer_change_training';
	//const TRAINER_CHANGE_TRAINING_DAYS = 'ept_alert_trainer_change_training_days';
	const TRAINER_CHANGE_DIET_ALERT = 'ept_alert_trainer_change_diet';
	//const TRAINER_CHANGE_DIET_DAYS = 'ept_alert_trainer_change_diet_days';
	const TRAINER_TAKE_WEIGHT_ALERT = 'ept_alert_trainer_weight';
	const TRAINER_TAKE_WEIGHT_DAYS = 'ept_alert_trainer_weight_days';
	const TRAINER_TAKE_CORPORAL_MEASURES_ALERT = 'ept_alert_trainer_corporal';
	const TRAINER_TAKE_CORPORAL_MEASURES_DAYS = 'ept_alert_trainer_corporal_days';
	const TRAINER_TAKE_STRENGTH_TEST_ALERT = 'ept_alert_trainer_strength';
	const TRAINER_TAKE_STRENGTH_TEST_DAYS = 'ept_alert_trainer_strength_days';
	const TRAINER_TAKE_SPEED_TEST_ALERT = 'ept_alert_trainer_speed';
	const TRAINER_TAKE_SPEED_TEST_DAYS = 'ept_alert_trainer_speed_days';
	const TRAINER_TAKE_DISTANCE_TEST_ALERT = 'ept_alert_trainer_distance';
	const TRAINER_TAKE_DISTANCE_TEST_DAYS = 'ept_alert_trainer_distance_days';
	const TRAINER_TAKE_RENOVAL_ALERT = 'ept_alert_trainer_renoval';
	const TRAINER_TAKE_RENOVAL_DAYS = 'ept_alert_trainer_renoval_days';

	const MEMBER_TRAINING_CHANGED_ALERT = 'ept_alert_member_training';
	const MEMBER_DIET_CHANGED_ALERT = 'ept_alert_member_diet';
	const MEMBER_TAKE_WEIGHT_ALERT = 'ept_alert_member_weight';
	const MEMBER_TAKE_WEIGHT_DAYS = 'ept_alert_member_weight_days';
	const MEMBER_TAKE_CORPORAL_MEASURES_ALERT = 'ept_alert_member_corporal';
	const MEMBER_TAKE_CORPORAL_MEASURES_DAYS = 'ept_alert_member_corporal_days';
	const MEMBER_TAKE_STRENGTH_TEST_ALERT = 'ept_alert_member_strength';
	const MEMBER_TAKE_STRENGTH_TEST_DAYS = 'ept_alert_member_strength_days';
	const MEMBER_TAKE_SPEED_TEST_ALERT = 'ept_alert_member_speed';
	const MEMBER_TAKE_SPEED_TEST_DAYS = 'ept_alert_member_speed_days';
	const MEMBER_TAKE_DISTANCE_TEST_ALERT = 'ept_alert_member_distance';
	const MEMBER_TAKE_DISTANCE_TEST_DAYS = 'ept_alert_member_distance_days';
	const MEMBER_TAKE_RENOVAL_ALERT = 'ept_alert_member_renoval';
	const MEMBER_TAKE_RENOVAL_DAYS = 'ept_alert_member_renoval_days';

	const DEBUG_ADDRESS = 'joseluisc6m6@gmail.com';

	// ACTIONS 
	//const DELETE_EXERCISE_HISTORIAL_ELEMENT_ACTION = 'epoint_personal_trainer_delete_exercise_historial_element';

	protected static $base_dir;

	public static function initialize()
	{
		self::$base_dir = realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' );

		add_action( 'epoint_personal_trainer_send_alerts', array( get_class(), 'send_alerts' ) );
/*
		add_shortcode( 'epoint_personal_trainer_register_trainer', array( get_class(), 'get_register_trainer_form' ) );
		add_shortcode( 'epoint_personal_trainer_already_trainer', array( get_class(), 'get_already_trainer_form' ) );

		add_action( 'wp_ajax_' . self::GET_TRAINING_EXERCISES_ACTION, array( get_class(), 'get_training_exercises_html' ) );

		add_action( 'wp_ajax_' . self::GET_CLONE_EXERCISE_AND_ASSING_FORM_ACTION, array( get_class(), 'get_clone_exercise_and_assign_form' ) );

		add_action( 'wp_ajax_' . self::CLEAR_EXERCISE_HISTORIAL_ACTION, array( get_class(), 'clear_exercise_historial' ) );
		add_action( 'wp_ajax_' . self::DELETE_EXERCISE_HISTORIAL_ELEMENT_ACTION, array( get_class(), 'delete_exercise_historial_element' ) );
*/
	}

	/////////////////////////////
	// FORMS
	/////////////////////////////

	public static function get_alerts_settings_form()
	{
		$forms = EpointPersonalTrainer::get_subsites_forms();
		$form_id = EpointPersonalTrainer::ALERTS_SETTINGS_FORM_INTERNAL_ID;

		$form = JLCCustomForm::get_form(
			$form_id,
			implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'include', 'forms' ) ),
			$forms[$form_id]['file'],
			$forms[$form_id]['args']
		);

		ob_start();
		$form->print_public_form();
		return ob_get_clean();
	}

	
	/////////////////////////////////
	// ACTIONS
	/////////////////////////////////

	public static function send_alerts()
	{
		$now = date_create( 'now', wp_timezone() );
		if( !$now )
			return;

		$end_training = EpointPersonalTrainerMapper::get_training_items_ending_in_date( $now->format( 'Y-m-d' ) );

		if( is_array( $end_training ) )
		{
			foreach( $end_training as $et )
			{
				if( self::must_sent_member_new_training_alert( $et->trainer ) )
					self::send_trainer_trainer_end_alert( $et );
			}
		}

		$end_diets = EpointPersonalTrainerMapper::get_diets_ending_in_date( $now->format( 'Y-m-d' ) );

		if( is_array( $end_diets ) )
		{
			foreach( $end_diets as $ed )
			{
				if( self::must_sent_member_new_diet_alert( $ed->trainer ) )
					self::send_trainer_diet_end_alert( $ed );
			}
		}

		//var_dump( EpointPersonalTrainerMapper::get_users_with_measures_in_date( '2021-06-15', 'corporal' ) );
		//$days = self::get_trainer_take_weight_days( $trainer_id );
/*
	const TRAINER_TAKE_WEIGHT_ALERT = 'ept_alert_trainer_weight';
	const TRAINER_TAKE_WEIGHT_DAYS = 'ept_alert_trainer_weight_days';
	const TRAINER_TAKE_CORPORAL_MEASURES_ALERT = 'ept_alert_trainer_corporal';
	const TRAINER_TAKE_CORPORAL_MEASURES_DAYS = 'ept_alert_trainer_corporal_days';
	const TRAINER_TAKE_STRENGTH_TEST_ALERT = 'ept_alert_trainer_strength';
	const TRAINER_TAKE_STRENGTH_TEST_DAYS = 'ept_alert_trainer_strength_days';
	const TRAINER_TAKE_SPEED_TEST_ALERT = 'ept_alert_trainer_speed';
	const TRAINER_TAKE_SPEED_TEST_DAYS = 'ept_alert_trainer_speed_days';
	const TRAINER_TAKE_DISTANCE_TEST_ALERT = 'ept_alert_trainer_distance';
	const TRAINER_TAKE_DISTANCE_TEST_DAYS = 'ept_alert_trainer_distance_days';
	const TRAINER_TAKE_RENOVAL_ALERT = 'ept_alert_trainer_renoval';
	const TRAINER_TAKE_RENOVAL_DAYS = 'ept_alert_trainer_renoval_days';
*/
/*
		foreach( self::get_day_session_reserves( $now->format( 'Y-m-d' ), true ) as $r )
		{
			$reserve = self::parse_user_meta_reserve( $r );

			$reserve_date = $reserve['date'];

			$reserve_dt = date_create( $reserve_date, wp_timezone() );
			$diff = $reserve_dt->getTimestamp() - $now->getTimestamp();

			if( $diff > 0 && $diff <= 3600 )
			{
				$user = get_user_by( 'ID', $reserve['user'] );
				
				ArturvedaMailing::send_session_hour_remember( 
					$user->user_email,
					$user->display_name,
					$reserve['session'],
					$reserve['date'],
					$reserve['meeting_url']
				);
			}
		}

		$now->add( new DateInterval( 'P1D' ) );
*/
	}
/*
	public static function clear_exercise_historial()
	{
		$training_id = !empty( $_POST['training'] ) ? (int)$_POST['training'] : null;
		$exercise_id = !empty( $_POST['exercise'] ) ? (int)$_POST['exercise'] : null;

		if( !$training_id || !$exercise_id )
			exit;

		$exercise = EpointPersonalTrainerMapper::get_exercise( $exercise_id );
		$training = EpointPersonalTrainerMapper::get_training( $training_id );

		if( !$exercise || !$training || $training->trainer != get_current_user_id() )
			exit;

		$res = EpointPersonalTrainerMapper::clear_training_exercises_historial( $training_id, $exercise_id );

		echo 'deleted';

		exit;
	}
*/
	/////////////////////////////////
	// OPTIONS
	/////////////////////////////////

	// FOR TRAINERS

	public static function must_sent_trainer_end_training_alert( $user_id = null )
	{
		return get_user_meta( $user_id === null ? get_current_user_id() : $user_id, self::TRAINER_CHANGE_TRAINING_ALERT, true ) == 'yes';
	}

	public static function must_sent_trainer_end_diet_alert( $user_id = null )
	{
		return get_user_meta( $user_id === null ? get_current_user_id() : $user_id, self::TRAINER_CHANGE_DIET_ALERT, true ) == 'yes';
	}

	public static function get_trainer_take_weight_days( $trainer_id )
	{
		return (int)get_user_meta( $trainer_id === null ? get_current_user_id() : $trainer_id, self::TRAINER_TAKE_CORPORAL_MEASURES_DAYS, true );
	}

	// FOR MEMBERS

	public static function must_sent_member_new_training_alert( $user_id = null )
	{
		return get_user_meta( $user_id === null ? get_current_user_id() : $user_id, self::MEMBER_TRAINING_CHANGED_ALERT, true ) == 'yes';
	}

	public static function must_sent_member_new_diet_alert( $user_id = null )
	{
		return get_user_meta( $user_id === null ? get_current_user_id() : $user_id, self::MEMBER_DIET_CHANGED_ALERT, true ) == 'yes';
	}

	/////////////////////////////////
	// MAILING
	/////////////////////////////////

	
	public static function get_contact_email()
	{
		//return get_option( self::CONTACT_EMAIL_KEY );
		return 'contacto@contacto.es';
	}

	public static function get_notification_addresses()
	{
		return self::DEBUG_ADDRESS;
/*
		$val = get_option( self::NOTIFICATION_ADDR_KEY );
		if( !is_string( $val ) )
			return array();

		$ret = array();
		$aux = explode( ',', $val );
		foreach( $aux as $addr )
		{
			$addr = trim( $addr );
			if( filter_var( $addr, FILTER_VALIDATE_EMAIL ) )
				$ret[] = $addr;
		}

		return $ret;
*/
	}

	public static function get_mail_headers( $reply_to = null )
	{
		$ret = array( 'Content-type: text/html; charset=utf-8' );

		$contact_addr = self::get_contact_email();
		if( !empty( $contact_addr ) && filter_var( $contact_addr, FILTER_VALIDATE_EMAIL ) )
		{
			$site = get_bloginfo( 'name' );

			$reply_to_addr = $reply_to !== null ? $reply_to : $contact_addr;

			$ret[] = "From: $site <$contact_addr>";
			$ret[] = "Reply-to: $reply_to_addr";
		}
	
		return $ret;
	}

	public static function wrap_mail( $email_heading, $message )
	{
		if( false && function_exists( 'WC' ) )
		{
			$mailer = WC()->mailer();
			$email_obj = new WC_Email();
			$message = apply_filters( 'woocommerce_mail_content', $email_obj->style_inline( $mailer->wrap_message( $email_heading, $message ) ) );
		}
		else
		{
			//$privacy_url = get_permalink( (int)get_option( 'wp_page_for_privacy_policy' ) );
			$logo_url = class_exists( 'EliteTrainerSiteThemeCustomizer', false ) ? EliteTrainerSiteThemeCustomizer::get_header_logo_url() : null;

			ob_start();
			include( implode( DIRECTORY_SEPARATOR, array( self::$base_dir, 'templates', 'alerts', 'mail', 'wrap.php' ) ) );
			$message = ob_get_clean();
		}

		return $message;
	}

	protected static function get_image_heading( $img, $alt )
	{
/*
		$img_url = plugins_url( 'img/headings/' . $img, __FILE__ );
		
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'image_heading.php' ) ) );
		return ob_get_clean();
*/
		return '';
	}

	public static function send_member_new_training_alert( $email, $name, $training )
	{
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Nuevo entrenamiento';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Se te ha asignado un nuevo entrenamiento: %s.</p><p>De %s a %s.</p>', $training->name, $training->start, $training->end );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_member_modified_training_alert( $email, $name, $training )
	{
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Entrenamiento modificado';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Se ha modificicado el entrenamiento que tienes asignado: %s.</p><p>De %s a %s.</p>', $training->name, $training->start, $training->end );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_member_new_diet_alert( $email, $name, $diet )
	{
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Nueva dieta';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Se te ha asignado una nueva dieta: %s.</p><p>De %s a %s.</p>', $diet->name, $diet->start, $diet->end );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_member_modified_diet_alert( $email, $name, $diet )
	{
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Dieta modificada';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Se ha modificicado una dieta que tienes asignada: %s.</p><p>De %s a %s.</p>', $diet->name, $diet->start, $diet->end );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_trainer_trainer_end_alert( $training )
	{
		$trainer = get_user_by( 'ID', $training->trainer );
		$member = get_user_by( 'ID', $training->user );

		if( !$trainer || !$member )
			return false;
			
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Entrenamiento caducado';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>El entrenamiento %s de %s ha caducado.</p>', $training->name, $member->display_name );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$trainer->user_email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_trainer_diet_end_alert( $diet )
	{
		$trainer = get_user_by( 'ID', $training->trainer );
		$member = get_user_by( 'ID', $training->user );

		if( !$trainer || !$member )
			return false;
			
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Dieta terminada';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>La dieta %s de %s ha caducado.</p>', $training->name, $member->display_name );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$trainer->user_email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_trainer_corporal_measures_changed_alert( $member, $trainer )
	{
		if( !$member )
			return false;
			
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Medidas corporales cambiadas';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Las medidas corporales de %s han cambiado.</p>', $member->display_name );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$trainer->user_email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_trainer_strength_measures_changed_alert( $member, $trainer )
	{
		if( !$member )
			return false;
			
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Pruebas de fuerza cambiadas';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Las pruebas de fuerza de %s han cambiado.</p>', $member->display_name );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$trainer->user_email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_trainer_speed_measures_changed_alert( $member, $trainer )
	{
		if( !$member )
			return false;
			
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Pruebas de velocidad cambiadas';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Las pruebas de velocidad de %s han cambiado.</p>', $member->display_name );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$trainer->user_email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

	public static function send_trainer_distance_measures_changed_alert( $member, $trainer )
	{
		if( !$member )
			return false;
			
		//$mail_heading = __( 'Nuevo entrenamiento', self::TEXT_DOMAIN );
		$mail_heading = 'Pruebas de distancia cambiadas';

		//$mail_message = self::get_image_heading( 'mailing-mensaje.jpg', __( 'Someone has written you', self::TEXT_DOMAIN ) );
		$mail_message = sprintf( '<p>Las pruebas de distancia de %s han cambiado.</p>', $member->display_name );


/*
		ob_start();
		include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'mail', 'messages', 'message-alert.php' ) ) );
		$mail_message .= ob_get_clean();
*/
		$mail_message = self::wrap_mail( $mail_heading, $mail_message );

		return wp_mail(
			self::DEBUG_ADDRESS,//$trainer->user_email,
			$mail_heading,
			$mail_message,
			self::get_mail_headers()
		);
	}

}


