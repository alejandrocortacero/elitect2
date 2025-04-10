<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !interface_exists( 'JLCCustomFormRequestReader', false ) )
{

if( !interface_exists( 'JLCCustomFormElement', false ) )
	require_once( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'element.php' ) ) );

interface JLCCustomFormRequestReader extends JLCCustomFormElement
{
	public function get_name();
	//public function get_type();
	public function get_value();

	public function read_values_from_request( $method );
	public function read_request( $val );

	//public function print_admin( $wrapped = true );
	//public function print_public();

	//public function is_file_input();

	public function get_ajax_callable();
	public function set_ajax_callable( $ajax_callable );

}

} //interface_exists
