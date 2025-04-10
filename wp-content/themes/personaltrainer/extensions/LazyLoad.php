<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

class PersonalTrainerThemeLazyLoad
{
	const LAZY_LOAD_ACTION = 'personaltrainer_lazy_load';

	public static function initialize()
	{
		add_action( 'wp_enqueue_scripts', array( get_class(), 'enqueue_scripts' ), 90 );

		add_action(
			'wp_ajax_' . self::LAZY_LOAD_ACTION,
			array(
				get_class(),
				'lazy_content'
			)
		);
		add_action(
			'wp_ajax_nopriv_' . self::LAZY_LOAD_ACTION,
			array(
				get_class(),
				'lazy_content'
			)
		);
	}

	public static function enqueue_scripts()
	{
		$version = PersonalTrainerTheme::get_version();

		wp_enqueue_script( 'personaltrainer-lazy-js', get_template_directory_uri() . '/js/lazy.js', array( 'jquery' ), $version, true );

		wp_localize_script( 'personaltrainer-lazy-js', 'PersonalTrainerLazy', array(
			'lazyLoadAction' => self::LAZY_LOAD_ACTION,
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
	}

	public static function lazy_content()
	{
		if( !empty( $_POST['layer'] ) &&
			is_readable( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'lazy', sanitize_text_field( $_POST['layer'] ) . '.php' ) ) )
		) {
			include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'lazy', sanitize_text_field( $_POST['layer'] ) . '.php' ) ) );
		}

		wp_die();
	}
}
