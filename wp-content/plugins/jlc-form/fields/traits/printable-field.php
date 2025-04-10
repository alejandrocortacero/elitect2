<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !trait_exists( 'JLCCustomFormPrintableField', false ) )
{

trait JLCCustomFormPrintableField
{
	abstract public function get_type();

	protected function enqueue_field_script( $admin = false ) {}

	public function print_admin( $wrapped = true )
	{
		$this->enqueue_field_script( true );

		include( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'templates', 'admin', $this->get_type() . '.php' ) ) ) );
	}
	public function print_public()
	{
		$this->enqueue_field_script( false );

		include( $this->look_for_field( $this->get_type() . '.php' ) );
	}

	protected function look_for_field( $filename )
	{
		$form = JLCCustomForm::get_current_printing_form();

		if( $form )
		{
			$theme_file = implode(
				DIRECTORY_SEPARATOR,
				array(
					get_stylesheet_directory(),
					'jlc-form', 
					$form,
					'fields',
					$filename
				)
			);

			if( is_readable( $theme_file ) && is_file( $theme_file ) )
				return $theme_file;
		}

		$theme_file = implode(
			DIRECTORY_SEPARATOR,
			array(
				get_stylesheet_directory(),
				'jlc-form', 
				'fields',
				$filename
			)
		);

		if( is_readable( $theme_file ) && is_file( $theme_file ) )
			return $theme_file;

		return realpath( implode(
			DIRECTORY_SEPARATOR,
			array(
				__DIR__,
				'..',
				'templates', 
				$filename
			)
		) );
	}
}

} //class_exists
