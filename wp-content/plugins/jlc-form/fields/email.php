<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

if( !class_exists( 'JLCCustomFormEmailField' ) )
{

if( !class_exists( 'JLCCustomFormTextField' ) )
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'text.php' );

class JLCCustomFormEmailField extends JLCCustomFormTextField
{
	protected $separator;

	public function __construct(
		$name,
		$value = "",
		$label = "",
		$separator = null, // add separator for multiple email field
		$placeholder = "",
		$help = null, // set to "" for empty help, else auto help will be added if separator exists
		$id = null,
		$class = null,
		$maxlength = 100,// wordpress user email, it can be greater althoug
		$required = false,
		$disabled = false,
		$readonly = false
	) {
		parent::__construct(
			$name,
			$value,
			$label,
			$placeholder,
			$help,
			$id,
			$class,
			$maxlength,
			$required,
			$disabled,
			$readonly
		);

		$this->type = 'email';

		$this->separator = $separator;
	}

	public function get_separator()
	{
		return $this->separator;
	}

	public function get_help()
	{
		$separator = $this->get_separator();

		if( is_string( $separator ) && $this->help === null )
			return sprintf( __( 'Separate email addresses with %s', JLCCustomForm::TEXT_DOMAIN ), $separator );

		return $this->help;
	}

	public function read_request( $val )
	{
		$parent = parent::read_request( $val );
		if( null !== $parent )
			return $parent;

		if( is_string( $this->get_separator() ) )
		{
			if( $this->is_required() || !empty( $val ) )
			{
				$mails = explode( $this->get_separator(), $val );
				$mails = array_map( 'trim', $mails );

				foreach( $mails as $mail )
					if( !filter_var( $mail, FILTER_VALIDATE_EMAIL ) )
						return array(
							'code' => JLCCustomForm::FORM_DATA_ERROR,
							'text' => sprintf( __( 'Invalid email provided in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
						);
				$mails = array_map( 'sanitize_email', $mails );
				$val = implode( $this->get_separator(), $mails );
			}
		}
		else
		{
			$val = trim( $val );
			if( $this->is_required() || !empty( $val ) )
			{ 
				if( !filter_var( $val, FILTER_VALIDATE_EMAIL ) )
					return array(
						'code' => JLCCustomForm::FORM_DATA_ERROR,
						'text' => sprintf( __( 'Invalid email provided in field %s.', JLCCustomForm::TEXT_DOMAIN ), $this->get_label() )
					);
			}

			if( !empty( $val ) )
				$val = sanitize_email( $val );
		}

		$this->set_value( $val );
		
		return null;
	}
}

} //class_exists

