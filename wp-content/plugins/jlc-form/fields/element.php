<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !interface_exists( 'JLCCustomFormElement', false ) )
{

interface JLCCustomFormElement
{
	public function get_type();

	public function print_admin( $wrapped = true );
	public function print_public();
}

} //interface_exists
